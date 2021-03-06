<?php

use Classes\App;
use Classes\Authenticator;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "../Classes/Authenticator.php";
require_once "../Classes/Redirektor.php";
require "../Classes/App.php";
$app = new App();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Guild Wars 2 - nastavenia profilu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/nastavenieView.css">
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    <div class="col-8 text-left">
        <h2>Guild Wars 2 - Character Simulator</h2>
    </div>
    <div class="col-1">
        <ul class="navbar-nav">
            <?php if (Authenticator::isLogged()) { ?>
                <li class="nav-item m-1 ">
                    <form method="get">
                        <button class="btn btn-primary" type="submit" name="odhlasit" value="odhlasit">
                            Odhlasit
                        </button>
                    </form>
                </li>
            <?php } ?>
            <li class="nav-item p-1">
                <form method="get">
                    <button class="btn btn-secondary btn-success" type="submit" name="redirectRegistracia"
                            value="redirectRegistracia">Registrovat
                    </button>
                </form>
            </li>
            <li class="nav-item m-1 ">
                <form method="get">
                    <button class="btn btn-secondary btn" type="submit" name="redirectDomov" value="redirectDomov">
                        Domov
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <div class="col-1"></div>
</nav>
<div class="container">

    <?php if (Authenticator::isLogged()) { ?>
        <nav class="navbar navbar-expand-sm justify-content-center">
            <div class="col-2 text-center innerbox">
                <h2>Zmena Hesla</h2>
                <hr>
                <form method="post" class="username">
                    <label for="oldPassword">Star?? heslo:</label>
                    <input type="password" class="form-control mb-2" name="oldPassword" id="oldPassword"
                           placeholder="Star?? heslo">
                    <label for="newPassword">Nov?? heslo:</label>
                    <input type="password" class="form-control mb-2" name="newPassword" id="newPassword"
                           placeholder="Nov?? heslo">
                    <button class="btn btn-primary btn " type="submit" name="zmenitHeslo" value="zmenitHeslo">Zmeni??
                        Heslo
                    </button>
                </form>
            </div>

            <div class="col-2 text-center innerbox">
                <h2>Zmena Mena</h2>
                <hr>
                <form method="post" class="username">
                    <label for="newUsername">Nov?? meno:</label>
                    <input type="Text" class="form-control mb-2" id="newUsername" name="newUsername"
                           placeholder="Nov?? Meno">
                    <br>
                    <button class="btn btn-primary btn " type="submit" name="premenovat" value="premenovat">Zmeni?? Meno
                    </button>
                </form>
            </div>
        </nav>
        <nav class="navbar justify-content-center">

            <div class="col text-center">
                <form method="post">
                    <button class="btn btn-secondary btn btn-danger" type="submit" name="zmazatUcet" value="asdasd"
                            onclick="this.value=confirm('Ste si isty, ze chcete zmazat vas ucet?')">
                        Zmaza?? ????et
                    </button>
                </form>
            </div>

        </nav>
    <?php } else { ?>
        <nav class="navbar justify-content-center">

            <div class="col text-center">
                <h3>Pros??m, prihl??ste sa.</h3>
            </div>


        </nav>
        <nav class="navbar justify-content-center">
            <form method="get">
                <button class="btn btn-primary " type="submit" name="redirectPrihlasenie"
                        value="redirectPrihlasenie">Prihlasit
                </button>
            </form>
        </nav>
    <?php } ?>
</div>
</body>
</html>
