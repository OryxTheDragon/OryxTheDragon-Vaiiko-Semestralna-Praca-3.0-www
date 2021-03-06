<?php

use Classes\App;
use Classes\Authenticator;
use Classes\Character;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require "../Classes/App.php";
require "../Classes/Redirektor.php";
require "../Classes/Character.php";
require_once "../Classes/Authenticator.php";

$app = new App();

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Guild Wars 2 - homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="../JSFiles/ajaxNacitatCharacter.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/homeView.css">
    <link rel="stylesheet" href="../CSS/ZobrazovanieCharakterov.css">
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">
</head>
<body>
<nav class="navbar navbar-expand-sm  bg-dark navbar-dark  justify-content-center">
    <div class="col-8 text-left">
        <h2>Guild Wars 2 - Character Simulator</h2>
    </div>
    <div class="col-1 text-center">
        <div class="collapse navbar-collapse justify-content-end " id="collapsibleNavbar">
            <ul class="navbar-nav">
                <?php if (Authenticator::isLogged()) { ?>
                    <li class="nav-item p-1">
                        <form method="get">
                            <button class="btn login" type="submit" name="redirectNastavenia"
                                    value="redirectNastavenia"><?php echo(Authenticator::getName()) ?>
                            </button>
                        </form>
                    </li>
                    <li class="nav-item p-1">
                        <form method="get">
                            <button class="btn btn-primary" type="submit" name="odhlasit" value="odhlasit">
                                Odhlasit
                            </button>
                        </form>
                    </li>
                <?php } else { ?>
                    <li class="nav-item p-1">
                        <form method="get">
                            <button class="btn btn-primary" type="submit" name="redirectPrihlasenie"
                                    value="redirectPrihlasenie">Prihlasit
                            </button>
                        </form>
                    </li>
                    <li class="nav-item p-1">
                        <form method="get">
                            <button class="btn btn-secondary btn-success" type="submit" name="redirectRegistracia"
                                    value="redirectRegistracia">Registrovat
                            </button>
                        </form>
                    </li>
                <?php } ?>
                <li class="nav-item p-1">
                    <form method="get">
                        <button class="btn btn-secondary" type="submit" name="navratDomov" value="navratDomov">
                            Domov
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

</nav>
<div class="container">
    <?php if (Authenticator::isLogged()) { ?>
    <nav class="navbar navbar-expand-sm  justify-content-center text-center">
        <div class="col-2 navbar-brand"></div>
        <div class="col-7"></div>
        <form method="get">
            <div class="nav-item">
                <button class="btn btn-secondary btn-success" type="submit" name="redirectTvorbaCharactera"
                >Nov?? Charakter
                </button>
            </div>
        </form>
    </nav>
    <nav class="navbar justify-content-center">
        <div class="col-9 text-left"></div>
        <div class="col-2 text-center">
            Zvo?? si charakter
            <form method="get">
                <select class="form-select text-center" name="characters" onchange="showCharacterData(this.value)">
                    <option>-none-</option>
                    <?php
                    /** @var Character $Character */
                    if ($app->listCharacterData() != false) {
                        foreach ($app->listCharacterData() as $Character) {
                            echo "<option>" . $Character->getNickname() . "</option>";
                        }
                    }
                    } ?>
                </select>
            </form>
        </div>
    </nav>
    <nav class="navbar navbar-expand-sm justify-content-center ">
        <div class="col"></div>
        <div class="col  text-center">
            <div id="characterVypis"><b></b></div>
        </div>
        <div class="col"></div>
    </nav>
</div>
</body>
</html>