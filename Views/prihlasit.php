<?php

use Classes\App;
use Classes\Authenticator;

if (session_status() == PHP_SESSION_NONE)
{
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
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">
    <link rel="stylesheet" href="../CSS/IntermediateMode.css">
</head>
<script>
    function validaciaPrihlasenia() {
        let username = document.forms["prihlasenie"]["username"].value;
        let password = document.forms["prihlasenie"]["password"].value;
        if (username === "" || password === "") {
            if (username === ""){
                alert("Both Username and Password must be filled out!");
            }
            return false;
        }
    }
</script>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
    <div class="container">
        <a class="navbar-brand" href="">Guild Wars 2 - Character Simulator</a>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <?php if (!Authenticator::isLogged()) { ?>
                    <form method="redirectRegistracia">
                        <li class="nav-item">
                            <button class="btn btn-secondary btn" type="submit" name="redirectRegistracia" value="redirectRegistracia">Registracia</button>
                        </li>
                    </form>
                <?php } ?>
                <form method="redirectDomov">
                    <li class="nav-item">
                        <button class="btn btn-secondary btn" type="submit" name="redirectDomov" value="redirectDomov">Domov</button>
                    </li>
                </form>
            </ul>
        </div>
    </div>
</nav>
<?php if (!Authenticator::isLogged()) { ?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
        <div class="row">
            <div class="col-xs-2"></div>
                <div class="col-xs-2">
                    <form name="prihlasenie" method="get" class="username" onsubmit="return validaciaPrihlasenia()">
                        <label for="Username">Username:</label>
                        <input type="Text" class="form-control" id="username" name="username"><br>
                        <label  for="Password">Password:</label>
                        <input  type="password" class="mb-4 form-control" id="password" name="password" placeholder="Password"><br>
                        <button class="btn btn-primary btn" id="button" type="submit" name="prihlasit" value="prihlasit">Prihlasit</button>
                    </form>
                </div>
            <div class="col-xs-2"></div>
        </div>
</nav>
<?php }
    else { ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
            <p class="navbar-brand username"> Vytaj <?php echo(Authenticator::getName()) ?> !</p>
        </nav>
    <?php } ?>
</body>
</html>
