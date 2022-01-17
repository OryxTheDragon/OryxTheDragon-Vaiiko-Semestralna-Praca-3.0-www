var Link;
var PP;
PP = Math.floor(Math.random() * 3);
switch (PP) {
    case 0:
        Link = "https://twitter.com/en/privacy";
        break;
    case 1:
        Link = "https://www.facebook.com/about/basics/privacy-principles";
        break;
    case 2:
        Link = "https://help.instagram.com/519522125107875";
        break;
    default:
        Link = "https://about.9gag.com/privacy";
        break;
}

function makeLink() {
    document.write('<a target="_blank" href="' + Link + ' " +>privacy policy</a>');
}

function validaciaRegistracie() {
    let username = document.forms["registracia"]["username"].value;
    let password = document.forms["registracia"]["password"].value;
    if ((username.length < 4) && (username.length > 15)) {
        alert('Zadane meno nevyhovuje podmienkam. Prosim zadajte meno ktore ma aspon 3 znakov a maximalne 15 znakov.');
        return false;
    }
    if (password.length < 8) {
        alert('Zadane heslo nevyhovuje podmienkam. Prosim zadajte heslo ktore ma aspon 8 znakov.');
        return false;
    }
    return true;
}