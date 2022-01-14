<?php

use Classes\App;

if (session_status() == PHP_SESSION_NONE)
{
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
    <title>Guild Wars 2 - Character Simulator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
    <div class="container">
        <a class="navbar-brand" href="">Guild Wars 2 - Character Simulator</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <form method="redirectDomov">
                    <li class="nav-item">
                        <button class="btn btn-secondary btn" type="submit" name="redirectDomov" value="redirectDomov">Domov</button>
                    </li>
                </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-right">
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-2">
            <form method="premenovat" class="justify-content-center username ">
                <label for="newUsername">Nove meno:</label>
                <input type="Text" class="form-control mb-2" id="newUsername" name="newUsername">
                <button class="btn btn-primary btn " type="submit" name="premenovat" value="premenovat">Zmenit Meno</button>
            </form>
        </div>
        <div class="col-xs-2"></div>
    </div>
</nav>
</body>
</html>
