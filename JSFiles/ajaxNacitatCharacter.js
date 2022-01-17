function showCharacterData(charNickname) {
    let name = charNickname;
    if (name === "") {
        document.getElementById("characterVypis").innerHTML = "";
        return false;
    }
    if (name === "-none-") {
        document.getElementById("characterVypis").innerHTML = "";
        return false;
    }
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("characterVypis").innerHTML = this.responseText;
            console.log(this.responseText);
        }
    }
    xhr.open("GET", "../AJAX_PHP_Files/ajaxNacitajCharacter.php?q=" + name, true);

    xhr.send();
    return true;
}