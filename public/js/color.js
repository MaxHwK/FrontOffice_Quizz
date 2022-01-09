let selectsobject = document.querySelectorAll('#select-color');
let form = document.getElementById("myform");

form.addEventListener("submit", function(e){
    let selectsobject = document.querySelectorAll('#select-color');
    for(let select of selectsobject){
        if (select.previousElementSibling.previousElementSibling.previousElementSibling.value !== ""){
            if(select.value === ""){
                alert(`Veuillez choisir la couleur de ${select.previousElementSibling.previousElementSibling.previousElementSibling.value} !`);
                e.preventDefault(); 
            }
            else {
                select.disabled = false;
                for (let i=0; i < select.length; i++) {
                    select.options[i].disabled = false;
                }
            }
        }
    }
    return true; 
});

for(let select of selectsobject){
    select.addEventListener('change', function(){
        disabledColor(select.value);
        this.disabled = true;
    } , false);
}

function disabledColor(color){
    let selectsobject = document.querySelectorAll('#select-color');
    for(let select of selectsobject){
        for (let i=0; i < select.length; i++) {
            if (select.options[i].value === color){
                select.options[i].disabled = true;
            }
        }
    }
}