let addButton = document.getElementById("addButton");
addButton.addEventListener("click", addElement);

window.onload = function() {
    hideButton();
  };

function hideButton()
{
    let addButton = document.getElementById("addButton");
    let input = document.getElementsByClassName("input-answer");
    if (input.length >= 5)
    {
        addButton.style.display = "none";
    } else {
        addButton.style.display = "block";
    }
}

function addElement() 
{
    let button = document.getElementById("addButton");
    let a = document.createElement('a');
    let inputAnswer = document.createElement('input');
    let inputValid = document.createElement('input');
    let label = document.createElement('label');
    let span = document.createElement('span');
    let br = document.createElement('br');

    inputAnswer.setAttribute('type', 'text');
    inputAnswer.setAttribute('class', 'form-control input-answer');
    inputAnswer.setAttribute('name', 'answers[]');
    inputAnswer.setAttribute('placeholder', 'Réponse de la question');

    a.setAttribute('href', '#');
    a.setAttribute('class', 'btn btn-danger btn-sm delete-answer');
    a.innerText = 'Supprimer';
    a.addEventListener('click', event => {a.parentNode.remove();});

    inputValid.setAttribute('type', 'checkbox');
    inputValid.setAttribute('name', 'valid[]');
    inputValid.setAttribute('class', 'valid');

    label.setAttribute('for', 'valid');
    label.innerText = 'Valide';

    span.appendChild(label);
    span.appendChild(inputValid);
    span.appendChild(inputAnswer);
    span.appendChild(a);
    span.appendChild(br);

    button.parentNode.insertBefore(span, button);
    button.remove;
    hideButton();
}

function insertAfter(referenceNode, newNode) 
{
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}