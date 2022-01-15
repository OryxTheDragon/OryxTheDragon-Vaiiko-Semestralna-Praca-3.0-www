    var Meno;
    var Professia;
    var Specializacia
    var Rasa;
    var Pohlavie;

    function zvolSiProfesiu(profesia){
    Professia =  profesia;
    console.log("Zvolena profesia - " + Professia);
}

    function zvolSiSpecializaciu(specializacia){
    Specializacia =  specializacia;
    console.log("Zvolena profesia - " + Professia);
}
    function nacitajSpecializacie(){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState===4 && this.status===200) {
                document.getElementById("specializacie").innerHTML=this.responseText;
                console.log(this.responseText);
            }
        }
        xhr.open("GET","../AJAX_PHP_Files/ajaxNacitajSpecializacie.php?q="+Professia,true);
        xhr.send();
    }
