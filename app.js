const { Socket} = require('socket.io');
const express = require('express');

const app = express();
const http = require('http').createServer(app);
const path = require('path');
const port = 3000;
const fs = require('fs');

/**
 * @type {Socket}
 */
const io = require('socket.io')(http);

app.use('/bootstrap/css', express.static(path.join(__dirname, 'node_modules/bootstrap/dist/css')));
app.use('/bootstrap/js', express.static(path.join(__dirname, 'node_modules/bootstrap/dist/js')));
app.use('/jquery', express.static(path.join(__dirname, 'node_modules/jquery/dist')));
app.use(express.static('public'));

app.get('/games/Quizz-In', (req, res) => {
    user = req.query.user;
    roomId = req.query.hash;
    res.sendFile(path.join(__dirname, 'templates/game/quizz-in.html'));
});

http.listen(port, () => {
    console.log(`listening on *:${port}`);
});

let mysql = require('mysql');
let db = mysql.createConnection({
    host: '127.0.0.1'
  , database: 'projet_tutore_lambert_giron'
  , port: 3306
  , user: 'root'
  , password: ''});

let rooms = [];
let created = false;
let createdHost = false;
let user = '';
let roomId = '';
let listQuestions = [];
let listWinners = [];

let useQuestions = [];
useQuestions[1] = [];
useQuestions[2] = [];
useQuestions[3] = [];
useQuestions[4] = [];
useQuestions[5] = [];
useQuestions[6] = [];

io.on('connection', (socket) => {
    console.log(`[connection] ${socket.id}`);

    let rawdata = fs.readFileSync('dataPlayer.json');
    let playersData = JSON.parse(rawdata);
    let Questions = [];

    if(createdHost) {
        io.to(socket.id).emit('query username', user, roomId, playersData);
    } else {
        io.to(socket.id).emit('query username host', user, roomId, playersData);
        createdHost = true;
    }

    socket.on('playerData', (player) => {
        console.log(`[playerData] ${player.username}`);

        let room = null;

        if(!created) {
            created = true;
            room = createRoom(player);
            console.log(`[createRoom] ${room.id} - ${player.username}`);
        } else {
            room = rooms.find(r => r.id === player.roomId);

            if(room ===  undefined) {
                return
            }

            player.roomId = room.id;
            room.players.push(player);

            db.query('SELECT * FROM `question`', function(err, result, fields){
                if (err) throw err;
                for (let question of result) { 
                    const quest = new Object();
                    quest.id = question.id_question;
                    quest.label = question.label;
                    quest.level = question.level;
                    quest.answers = [];
                    db.query('SELECT * FROM `answer` WHERE `id_question` = ' + question.id_question, function(err, result, fields){
                        if (err) throw err;
                        for (let answer of result) {
                            const ans = new Object();
                            ans.id_answer = answer.id_answer;
                            ans.id_question = answer.id_question;
                            ans.label = answer.label;
                            ans.valid = answer.valid;
                            quest.answers.push(ans);
                        }
                        Questions.push(quest);
                        getAllQuestions(Questions);
                    });
                }
            });
        }
        socket.join(room.id);
        io.to(room.id).emit('join room', room.players, playersData.nbrPlayers);

        if(room.players.length === playersData.nbrPlayers) {
            io.in(room.id).emit('start game', room.players);
        }
    });

    socket.on('get rooms', () => {
        io.to(socket.id).emit('list rooms', rooms);
    });

    socket.on('updateScore', (players) => {

        for(let i =0; i < rooms.length; i++) {
            for(let y = 0; y < rooms[i].players.length; y++) {
                if(rooms[i].players[y].username === players[y].username) {
                    rooms[i].players[y].points = players[y].points;
                    rooms[i].players[y].turn = players[y].turn;
                    rooms[i].players[y].isWinner = players[y].isWinner;
                }
            }
            io.in(rooms[i].id).emit('show score', rooms[i].players);
        }
    });

    socket.on('play', (player, level) => {

        let room;

        rooms.forEach(r => {
            r.players.forEach(p => {
                if(p.roomId === r.id) {
                    room = r;
                }
            });
        });
        console.log(`[play] ${player.username}`);

        let randQuestion = randomQuestion(listQuestions, level, useQuestions);
        let html = generateHTML(randQuestion, level);
        io.in(room.id).emit('play', room.players, html, player.username);
    });

    socket.on('change turn', () => {
        changeTurn();
    });

    socket.on('disabled question', (player) => {
        io.in(player.roomId).emit('disabled');
    });

    socket.on('winner', (player) => {
        nextWinner = listWinners.find(p => p.username === player.username);

        if(nextWinner === undefined) {
            listWinners.push(player);
            console.log(`[winner] ${player.username}`);
        }
        io.in(player.roomId).emit('setup winner', listWinners, playersData.nbrPlayers);
    });

    socket.on('end game', (winner) => {
        let listScores = [];

        rooms.forEach(r => {
            r.players.forEach(p => {
                listScores.push(p);
            });
        });
        io.in(winner.roomId).emit('end game', listScores);
    });

    socket.on('disconnect', () => {
        console.log(`[disconnect] ${socket.id}`);
        let room = null;
        created = false;
        createdHost = false;
        user = '';
        roomId = '';
        listQuestions = [];
        listWinners = [];
        rooms = [];
        useQuestions = [];
        useQuestions[1] = [];
        useQuestions[2] = [];
        useQuestions[3] = [];
        useQuestions[4] = [];
        useQuestions[5] = [];
        useQuestions[6] = [];

        rooms.forEach(r => {
            r.players.forEach(p => {
                if(p.socketId === socket.id && p.host) {
                    room = r;
                    rooms = rooms.filter(r => r !== room);
                }
            });
        });
    });
});

function createRoom(player) {
    const room = {
        id: roomId,
        players: []
    };

    player.roomId = room.id;
    room.players.push(player);
    rooms.push(room);

    return room;
}

function changeTurn() {
    let room = null;
    let nextPlayer = undefined;

    rooms.forEach(r => {
        r.players.forEach(p => {
            if(p.turn) {
                room = r;
                nextPlayer = room.players.find(p => p.turn === false && p.isWinner === false);
            }
        });
    });

    if(room === null) {
        return;
    }

    if(nextPlayer === undefined) {
        room.players.forEach(p => {
            if(p.turn) {
                p.turn = false;
            }
        });
        for(let i = 0; i < room.players.length; i++) {
            if(!room.players[i].isWinner){
                nextPlayer = room.players[i];
                break;
            }
        }
    }

    nextPlayer.turn = true;
    io.in(room.id).emit('change turn', nextPlayer);    
}

function getAllQuestions(Questions) {
    let listLevel = [];
    let level1 = [];
    let level2 = [];
    let level3 = [];
    let level4 = [];
    let level5 = [];
    let level6 = [];
    for (let question of Questions) {
        switch(question.level) {
            case 1:
                level1.push(question);
                break;
            case 2:
                level2.push(question);
                break;
            case 3:
                level3.push(question);
                break;
            case 4:
                level4.push(question);
                break;
            case 5:
                level5.push(question);
                break;
            case 6:
                level6.push(question);
                break;
        }
    }
    listLevel[1] = level1;
    listLevel[2] = level2;
    listLevel[3] = level3;
    listLevel[4] = level4;
    listLevel[5] = level5;
    listLevel[6] = level6; 
    listQuestions = listLevel;
}

function randomQuestion(Questions, level) {
    let ok = false;
    let randQuestion;
    while (!ok) {
        randQuestion = Math.floor(Math.random() * Questions[level].length);
        let use = useQuestions[level].find(q => q.id === Questions[level][randQuestion].id);
        if(use === undefined) {
            ok = true;
            useQuestions[level].push(Questions[level][randQuestion]);
        } else {
            if(Questions[level].length === useQuestions[level].length) {
                const q = new Object();
                q.label = 'Aucune question de ce niveau disponible !';
                q.answers = [];
                ok = true;
                return q;
            }
            ok = false;
        }
    }
    return Questions[level][randQuestion];
}

function generateHTML(Question, level){

    let html =`<h5>${Question.label}</h5>`;
    if(Question.answers.length !== 0) {
        for(let answers of Question.answers){
            html += `<button class="btn btn-primary btn-block btn-answer" value="${level}" data-verif="${answers.valid}">${answers.label}</button>`;
        }
    } else {
        html += `<button class="btn btn-primary btn-block btn-select" value="">Changer de niveau</button>`;
    }
    return html;
}