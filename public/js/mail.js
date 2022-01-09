let inpMails = document.getElementsByClassName("mail-player");
let body = document.getElementById("mail-body");

for(let inpMail of inpMails){
    if(inpMail.value === ""){
        console.log(inpMail.value);
        inpMail.parentNode.classList.add('d-none');
    }
}

body.addEventListener("submit", function(e){
    alert('mails envoyés !');
    return true; 
});
