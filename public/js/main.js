function valid(){
    let valid = document.getElementsByClassName("valid");

    for (let i = 0; i < valid.length; i++) {
        if(valid[i].checked){
            return true;
        }
    }
    alert("Veuillez cocher au moins une bonne réponse !");
    return false;
}