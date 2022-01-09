let inpUsers = document.getElementsByClassName('player');
let results = document.getElementsByClassName('results');
let body = document.getElementsByTagName('body')[0];

for(let i = 0; i < inpUsers.length; i++){
    inpUsers[i].addEventListener('focus' , function(){
        inpUsers[i].addEventListener('input', function(e){
          results[i].classList.remove('d-none');
          recherche(this, i);
          results[i].addEventListener('click', function(e) {
                let target = e.target;
                let input = document.getElementsByClassName('player')[i];
                input.value = target.innerText;
                results[i].classList.add('d-none');
            });
        })
      })
}

function recherche (input, key) {
    let regUser = input.value;
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://quizzin/autocomplete?Rec=' + regUser);
    xhr.send(null);
 
    xhr.addEventListener('load', function(e) {
        let tabs = xhr.responseText.split('|');
        results[key].innerText = ''; 
        for (let i = 0; i < 3; i++) { 
            if(tabs[i] !== undefined){
                let div = document.createElement('div');
                div.innerText = tabs[i]; 
                results[key].appendChild(div);
            }
        }
    }) 
}

body.addEventListener('click', function(e) {
    for(let res of results){
        res.classList.add('d-none');
    }
});


