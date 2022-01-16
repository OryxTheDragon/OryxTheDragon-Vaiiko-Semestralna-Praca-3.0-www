
    var UserID;
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
    console.log("Zvolena specializacia - " + Specializacia);
}

    function zvolSiRasu(rasa){
        Rasa =  rasa;
        console.log("Zvolena rasa - " + Rasa);
    }

    function zvolSiPohlavie(pohlavie){
        Pohlavie =  pohlavie;
        console.log("Zvolena pohlavie - " + Pohlavie);

    }

    function zvolSiMeno(meno){
        Meno =  meno;
        console.log("Zvolene meno - " + Meno);
    }


    function nacitajProfesie(){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState===4 && this.status===200) {
                document.getElementById("profesie").innerHTML=this.responseText;
                console.log(this.responseText);
            }
        }
        xhr.open("GET","../AJAX_PHP_Files/ajaxNacitajProfesie.php?",true);
        xhr.send();
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

    function nacitajRasy(){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState===4 && this.status===200) {
                document.getElementById("rasy").innerHTML=this.responseText;
                console.log(this.responseText);
            }
        }
        xhr.open("GET","../AJAX_PHP_Files/ajaxNacitajRasy.php?",true);
        xhr.send();
    }


    function nacitajPohlavia(){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState===4 && this.status===200) {
                document.getElementById("pohlavia").innerHTML=this.responseText;
                console.log(this.responseText);
            }
        }
        xhr.open("GET","../AJAX_PHP_Files/ajaxNacitajPohlavia.php?",true);
        xhr.send();
    }

    function vytvorNovyCharakter(){
        if (!(Meno.length > 3)){
            alert('Zadany nickname je prilis kratky!');
            return -2;
        }
        if (!(Meno.length <= 15)){
            alert('Zadany nickname je prilis dlhy!');
            return -2;
        }
        //TODO treba zavolat zmenu profesie este po nacitani z DB.
        if (!(Professia > 0 && Professia <= 9)){
            alert('Zle zadana profesia!');
            return -2;
        }
        if (!(Specializacia >= (Professia*3 + 15) && Specializacia<= (Professia*3 + 17))){
            alert('Zle zadana specializacia!');
            return -2;
        }
        if (!(Rasa > 0 && Rasa<= 5)){
            alert('Zle zadana rasa!');
            return -2;
        }
        if (!(Pohlavie > 0 && Pohlavie<= 3)){
            alert('Zle zadane pohlavie!');
            return -2;
        }
        var poleDat = [Meno,Professia,Specializacia,Rasa,Pohlavie,UserID];

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState===4 && this.status===200) {
                alert("Charakter uspesne vytvoreny.");
                return true;
            }
        }
        xhr.open("POST","../AJAX_PHP_Files/ajaxVytvorNovyCharakter.php?",true);
        xhr.send(JSON.stringify(poleDat));
    }