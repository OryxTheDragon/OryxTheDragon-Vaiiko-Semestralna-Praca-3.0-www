<?php

use Classes\App;
use Classes\Authenticator;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require "../Classes/App.php";
require "../Classes/Redirektor.php";
require_once "../Classes/Authenticator.php";
$app = new App();

if (!\Classes\Authenticator::isLogged()) {
    \Classes\Redirektor::navratDomov();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Guild Wars 2 - Tvorba noveho charakteru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="../JSFiles/ajaxVytvorCharacter.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../JSFiles/ajaxVytvorCharacter.js">
    <link rel="stylesheet" href="../CSS/vytvaranieCharakteruView.css">
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    <div class="col-8 text-left">
        <h2>Guild Wars 2 - Character Simulator</h2>
    </div>
    <div class="col-1 text-right">
        <div class="collapse navbar-collapse justify-content-end " id="collapsibleNavbar">
            <ul class="navbar-nav">
                <?php if (Authenticator::isLogged()) { ?>
                    <form method="odhlasit">
                        <li class="nav-item p-1">
                            <button class="btn btn-primary" type="submit" name="odhlasit" value="odhlasit">
                                Odhlasit
                            </button>
                        </li>
                    </form>
                    <form method="redirectNastavenia">
                        <li class="nav-item p-1">
                            <button class="btn btn-secondary" type="submit" name="redirectNastavenia"
                                    value="redirectNastavenia">Nastavenia
                            </button>
                        </li>
                    </form>
                <?php } else { ?>
                    <form method="redirectPrihlasenie">
                        <li class="nav-item p-1">
                            <button class="btn btn-primary" type="submit" name="redirectPrihlasenie"
                                    value="redirectPrihlasenie">Prihlasit
                            </button>
                        </li>
                    </form>
                    <form method="redirectRegistracia">
                        <li class="nav-item p-1">
                            <button class="btn btn-secondary" type="submit" name="redirectRegistracia"
                                    value="redirectRegistracia">Registrovat
                            </button>
                        </li>
                    </form>
                <?php } ?>
                <form method="Post">
                    <li class="nav-item p-1">
                        <button class="btn btn-secondary" type="submit" name="redirectDomov" value="redirectDomov">
                            Domov
                        </button>
                    </li>
                </form>
            </ul>
        </div>
    </div>

    <div class="col-1 text-right"></div>
</nav>
<div class="container">
<nav class="navbar navbar-expand-sm justify-content-center text-center">
    <form>
        <div>
            <label for="nickname">Nickname</label>
            <input class="form-control" id="nickname" placeholder="Zadaj Nickname" oninput="zvolSiMeno(this.value)">
        </div>
    </form>
</nav>
<nav class="navbar navbar-expand-sm justify-content-center text-center">
    <div class="col-2 m-2">
        <form>
            <label for="profesie">Vyberte Profesiu</label>
            <select class="form-select" aria-label="Default select example" id="profesie"
                    onchange="zvolSiProfesiu(this.value),nacitajSpecializacie()">
                <option selected>Mesmer</option>
            </select>
        </form>
    </div>
    <div class="col-2 m-2">
        <form>
            <label for="specializacie">Vyberte Specializaciu</label>
            <select class="form-select" id="specializacie" aria-label="Default select example"
                    onchange="zvolSiSpecializaciu(this.value)">
                <option selected>Mesmer</option>
            </select>
        </form>
    </div>
    <div class="col-2 m-2">
        <form>
            <label for="rasy">Vyberte Rasu</label>
            <select class="form-select" id="rasy" aria-label="Default select example"
                    onchange="zvolSiRasu(this.value)">
                <option selected>Human</option>
            </select>
        </form>
    </div>
    <div class="col-2 m-2">
        <form>
            <label for="pohlavia">Vyberte Pohlavie</label>
            <select class="form-select" id="pohlavia" aria-label="Default select example"
                    onchange="zvolSiPohlavie(this.value)">
                <option selected>Female</option>
            </select>
        </form>
    </div>
</nav>
<nav class="navbar navbar-expand-sm justify-content-center text-center">
    <form>
        <button type="button" class="btn btn-primary" onclick="vytvorNovyCharakter()">Vytvoriť Charakter</button>
    </form>
</nav>
</div>
</body>
<script>
    UserID = "<?php echo Authenticator::getName(); ?>";
    nacitajProfesie();
    zvolSiProfesiu(1);
    nacitajSpecializacie();
    zvolSiSpecializaciu(18);
    nacitajRasy();
    zvolSiRasu(1);
    nacitajPohlavia();
    zvolSiRasu(1);
</script>
</html>
