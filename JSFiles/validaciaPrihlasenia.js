function validaciaPrihlasenia() {
    let username = document.forms["prihlasenie"]["username"].value;
    let password = document.forms["prihlasenie"]["password"].value;
    if (username === "" || password === "") {
        if (username === "") {
            alert("Musite zdat aj meno, aj heslo!");
        }
        return false;
    }
}