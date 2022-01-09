document.querySelectorAll('.delete-user').forEach(item => {
  item.addEventListener('click', event => {
    //alert("Vous allez supprimer un utilisateur");
    item.parentNode.parentNode.remove();
  })
})

document.querySelectorAll('.delete-question').forEach(item => {
    item.addEventListener('click', event => {
        //alert("Vous allez supprimer cette question");
        item.parentNode.parentNode.remove();
    })
  })

document.querySelectorAll('.delete-answer').forEach(item => {
    item.addEventListener('click', event => {
        //alert("Vous allez supprimer cette réponse");
        item.parentNode.remove();
    })
  })