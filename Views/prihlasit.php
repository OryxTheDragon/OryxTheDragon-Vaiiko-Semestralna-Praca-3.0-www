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


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Guild Wars 2 - prihlasenie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../JSFiles/validaciaPrihlasenia.js">
    <link rel="stylesheet" href="../CSS/prihlasenieView.css">
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    <div class="col-8 text-left">
        <h2>Guild Wars 2 - Character Simulator</h2>
    </div>
    <div class="col-1 text-right">
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <?php if (!Authenticator::isLogged()) { ?>
                    <li class="nav-item m-1">
                        <form method="get">
                            <button class="btn btn-secondary btn-success" type="submit" name="redirectRegistracia"
                                    value="redirectRegistracia">Registracia
                            </button>
                        </form>
                    </li>
                <?php } ?>
                <li class="nav-item m-1">
                    <form method="get">
                        <button class="btn btn-secondary btn" type="submit" name="redirectDomov" value="redirectDomov">
                            Domov
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-1 text-right"></div>
</nav>
<div class="container">
    <?php if (!Authenticator::isLogged()) { ?>
        <nav class="navbar navbar-expand-sm justify-content-center text-center">
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-2">
                    <form name="prihlasenie" method="get" class="username" onsubmit="return validaciaPrihlasenia()">
                        <label for="username">Meno:</label>
                        <input type="Text" class="form-control" id="username" name="username" placeholder="Meno"><br>
                        <label for="password">Heslo:</label>
                        <input type="password" class="mb-4 form-control" id="password" name="password"
                               placeholder="Heslo"><br>
                        <button class="btn btn-primary btn" id="button" type="submit" name="prihlasit"
                                value="prihlasit">Prihlasit
                        </button>
                    </form>
                </div>
                <div class="col-xs-2"></div>
            </div>
            <div class="row"></div>
        </nav>
    <?php } else { ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
            <p class="navbar-brand username"> Vytaj <?php echo(Authenticator::getName()) ?>, uz si prihlaseny.</p>
        </nav>
    <?php } ?>
</div>
</body>
</html>
