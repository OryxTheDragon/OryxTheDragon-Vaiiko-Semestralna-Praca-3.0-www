function showCharacterData(charNickname) {
    let name = charNickname;
    if (name==="") {
        document.getElementById("characterVypis").innerHTML="";
        return false;
    }
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState===4 && this.status===200) {
            document.getElementById("characterVypis").innerHTML=this.responseText;
        }
    }
    xhr.open("GET","../AJAX_PHP_Files/ajaxNacitatCharacter.php?q="+name,true);

    xhr.send();

    return true;
}