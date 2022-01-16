<?php

use Classes\App;

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
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">
    <link rel="stylesheet" href="../CSS/IntermediateMode.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
    <div class="container">
        <a class="navbar-brand" href="">Guild Wars 2 - Character Simulator</a>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <form method="redirectDomov">
                    <li class="nav-item">
                        <button class="btn btn-secondary btn" type="submit" name="redirectDomov" value="redirectDomov">
                            Domov
                        </button>
                    </li>
                </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar  bg-dark navbar-dark justify-content-center">
    <div class="col-2 text-center innerbox">
        <h3>Zmena Hesla</h3>
        <hr>
        <form method="zmenitHeslo" class="username">
            <label for="oldPassword"><h4>Staré heslo:</h4></label>
            <input type="password" class="form-control mb-2" name="oldPassword" id="oldPassword"
                   placeholder="Staré heslo">
            <label for="newPassword"><h4>Nové heslo:</h4></label>
            <input type="password" class="form-control mb-2" name="newPassword" id="newPassword"
                   placeholder="Nové heslo">
            <button class="btn btn-primary btn " type="submit" name="zmenitHeslo" value="zmenitHeslo">Zmeniť Heslo
            </button>
        </form>
    </div>

    <div class="col-2 text-center innerbox">
        <h3>Zmena Hesla</h3>
        <hr>
        <form method="premenovat" class="username">
            <label for="newUsername"><h4>Nové meno:</h4></label>
            <br>
            <br>
            <input type="Text" class="form-control mb-2" id="newUsername" name="newUsername" placeholder="Nové Meno">
            <br>
            <button class="btn btn-primary btn " type="submit" name="premenovat" value="premenovat">Zmeniť Meno</button>
        </form>
    </div>
</nav>
<nav class="navbar  bg-dark navbar-dark justify-content-center">

<div class="col text-center">
    <form method="zmazatUcet">
        <button class="btn btn-secondary btn btn-danger" type="submit" name="zmazatUcet" value="zmazatUcet">
            Zmazať Účet
        </button>
</form>
</div>
</nav>
</body>
</html>
