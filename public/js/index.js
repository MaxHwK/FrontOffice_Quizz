const player = {
    isHost: false,
    color: '',
    roomId: null,
    username: "",
    socketId: "",
    turn: false,
    isWinner: false,
    level: 0,
    points: 0,
};

const socket = io();
const gameCard = document.getElementById('game-card');
const bodyCard = document.getElementById('body-card');
const headerCard = document.getElementById('header-card');
const questionCard = document.getElementById('card-question');
const waitingArea = document.getElementById('waiting-area');
const roomsList = document.getElementById('rooms-list');
const turnmsg = document.getElementById('turn-message');
const displayPlayers = document.getElementById('display-players');
const levelCard = document.getElementById('level-card');
const endGame = document.getElementById('end-game');
const scoreboard = document.getElementById('scoreboard');

let alreadyPlayed = [];
let listPlayers = [];
let hostUsername = "";
let listQuestions = [];

socket.on('query username host', (user, roomid, playersData) => {

    player.username = user;
    for (const playerData of playersData.players) {
        if (playerData.name === player.username) {
            player.color = playerData.color;
            player.isHost = playerData.host;
            break;
        }
    }
    player.turn = true;
    player.socketId = socket.id
    player.roomId = roomid;

    waitingArea.classList.remove('d-none');
    socket.emit('playerData', player);
});

socket.on('query username', (user, roomid, playersData) => {

    player.username = user;
    for (const playerData of playersData.players) {
        if (playerData.name === player.username) {
            player.color = playerData.color;
            player.isHost = playerData.host;
            break;
        }
    }
    player.turn = false;
    player.socketId = socket.id
    player.roomId = roomid;

    waitingArea.classList.remove('d-none');
    socket.emit('playerData', player);
});

socket.on('get question', function (questions) {
    let questionByLvl = questionByLevel(questions);
});

$(".btn-level").click(function(){
    const level = parseInt($(this).val());
    player.level = level;
    $(".level-card").children().prop('disabled',true);
    socket.emit('play', player, level);
});

socket.on('join room', (players, nbrplayers) => {
    displayPlayers.innerHTML = `Nombre de joueurs : ${players.length} / ${nbrplayers} <i class="bi bi-wifi"></i> <br> <br>`;
    for(let player of players) {
        let text = document.createTextNode(`${player.username} nous a rejoint !`);
        let li = document.createElement('li');
        li.appendChild(text);
        displayPlayers.appendChild(li);
    }
});

socket.on('start game', (players) => {
    startGame(players);
});

socket.on('change turn', (nextPlayer) => {
    if (player.username === nextPlayer.username) {
        $(".level-card").children().prop('disabled',false);
        $(".card-question").children().prop('disabled',false);
        setTurnMessage('alert-info', 'alert-success', `<b>${nextPlayer.username}</b> c'est à ton tour de jouer !`);
    } else {
        $(".card-question").children().prop('disabled',true);
        $(".level-card").children().prop('disabled',true);
        setTurnMessage('alert-success', 'alert-info', `C'est au tour de <b>${nextPlayer.username}</b> de jouer !`);
    }
    socket.emit('disabled question', nextPlayer);
});

socket.on('disabled', () => {
    $(questionCard).addClass('d-none');
});

socket.on('play', (players,  html, username) => { 
    
    if(player.points !== 48){
        questionCard.innerHTML = html;
        if (player.username === username) {
            $(".card-question").children().prop('disabled',false);
        } else {
            $(".card-question").children().prop('disabled',true);
        }
    } 
    headerCard.classList.remove('d-none');
    questionCard.classList.remove('d-none');
    getAnswer(players);
});

socket.on('show score', (players) => {
    for (let p of players) {
        changeScore(p.username, p.points, p.color);
        if(p.points === 48 && player.username === p.username){
            setWinner(p);
        }
    }
});

socket.on('setup winner', (winners, nbrPlayers) => {
    for (let winner of winners) {
        if(player.username === winner.username){
            $(".level-card").children().prop('disabled',true);
            $(".card-question").children().prop('disabled',true);
        }
    }
    if(winners.length === (nbrPlayers - 1)){
        socket.emit('end game', player);
    }
});

socket.on('end game', (scores) => {
    gameCard.classList.add('d-none');
    bodyCard.classList.add('d-none');
    endGame.classList.remove('d-none');
    showAllScore(scores);
    setTurnMessage('alert-info', 'alert-success', `<b>Partie terminée ! Merci d'avoir joué à notre quizz ! 😉</b> `);
});

function startGame(players) {
    waitingArea.classList.add('d-none');
    gameCard.classList.remove('d-none');

    for (let p of players) {
        createBoard(p.color, p.username);
        changeScore(p.username, p.points, p.color);
        if(p.isHost && p.turn){
            hostUsername = p.username;
        }
    }

    if (hostUsername === player.username) {
        $(".level-card").children().prop('disabled',false);
        setTurnMessage('alert-info', 'alert-success', `<b>${hostUsername}</b> c'est à ton tour de jouer !`);
    } else {
        $(".level-card").children().prop('disabled',true);
        setTurnMessage('alert-success', 'alert-info', `C'est au tour de <b>${hostUsername}</b> de jouer !`);
    }
}

function setTurnMessage(classToRemove, classToAdd, html){
    turnmsg.classList.remove(classToRemove);
    turnmsg.classList.add(classToAdd);
    turnmsg.innerHTML = html;
    turnmsg.classList.remove('d-none');
}

function createBoard(color, username) {
    const playerName = document.createElement('h5');
    playerName.innerHTML = `<span style="color :${color}; background-color: white; border-top-left-radius: 5px;
    border-top-right-radius: 5px; padding: 5px; margin-bottom: -20px;">${username}</span>`;

    const table = document.createElement('table');
    table.id = `${username}`;

    const boardRow = document.createElement('tr');
    boardRow.classList.add('board-row');

    for (let i = 0; i < 49; i++) {
        const boardCol = document.createElement('td');
        boardCol.style.backgroundColor = color;
        boardCol.style.color = color;
        boardCol.innerHTML = i;
        boardCol.id = `${username}-${i}`;
        boardCol.classList.add('column');
        boardRow.appendChild(boardCol);
    }
    table.appendChild(boardRow);
    bodyCard.appendChild(playerName);
    bodyCard.appendChild(table);
}

function changeScore(username, points, color) {
    let table = document.querySelectorAll(`#${username} > tr > td`);
    table.forEach(td => {
        td.style.color = color;
    });
    const scorePlayer = document.getElementById(`${username}-${points}`);
    scorePlayer.style.color = "azure";
}

function questionByLevel(listQuestion){
    let listLevel = [];
    let level1 = [];
    let level2 = [];
    let level3 = [];
    let level4 = [];
    let level5 = [];
    let level6 = [];
    for (let question of listQuestion) {
        if (question.level === 1) {
            level1.push(question);
        } else if (question.level === 2) {
            level2.push(question);
        } else if (question.level === 3) {
            level3.push(question);
        } else if (question.level === 4) {
            level4.push(question);
        } else if (question.level === 5) {
            level5.push(question);
        } else if (question.level === 6) {
            level6.push(question);
        }
    }
    listLevel[1] = level1;
    listLevel[2] = level2;
    listLevel[3] = level3;
    listLevel[4] = level4;
    listLevel[5] = level5;
    listLevel[6] = level6;

    listQuestions = listLevel;
    return listLevel;
}

function getAnswer(players){
    $(".btn-answer").click(function(){
        const level = parseInt($(this).val());
        const valid = parseInt($(this).attr('data-verif'));
        if(valid === 1){
            if((player.points + level) >= 48){
                player.points = 48;
                player.isWinner = true;
                alert('Bonne réponse !');
            } else {
                player.points += level;
                alert('Bonne réponse !');
            }
        } else {
            if((player.points - level) < 0){
                player.points = 0;
                alert('Mauvaise réponse !');
            } else {
                player.points -= level;
                alert('Mauvaise réponse !');
            }
        } 
        for (let p of players) {
            if (p.username === player.username) {
                p.points = player.points;
                p.isWinner = player.isWinner;
            }
        }
        passScore(players);
        $(headerCard).removeClass('d-none');
        $(questionCard).addClass('d-none');
        socket.emit('change turn');
    });
    $(".btn-select").click(function(){
        $(".level-card").children().prop('disabled',false);
        $(questionCard).addClass('d-none');
    });
}

function passScore(players){
    socket.emit('updateScore', players);
}

function setWinner(player){
    socket.emit('winner', player);
}

function showAllScore(players){
    players.sort(function(a, b){
        return b.points - a.points;
    });
    console.log(players);
    let html = '';
    for (let p of players) {
        html += `<li>${p.username} : ${p.points} points</li>`;
    }
    scoreboard.innerHTML = html;
}
