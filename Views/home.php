<?php

use Classes\App;
use Classes\Authenticator;
use Classes\Character;

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
require "../Classes/App.php";
require "../Classes/Redirektor.php";
require "../Classes/Character.php";
require "../AJAX_PHP_Files/ajaxNacitatCharacter.php";
require_once "../Classes/Authenticator.php";

$app = new App();

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Guild Wars 2 - Character Simulator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../JSFiles/ajaxNacitatCharacter.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
    <div class="container">
        <p class="navbar-brand">Guild Wars 2 - Character Simulator</p>
        <div class="collapse navbar-collapse justify-content-end " id="collapsibleNavbar">
                <ul class="navbar-nav">
                <?php if (Authenticator::isLogged()) { ?>
                    <form method="odhlasit">
                        <li class="nav-item">
                            <button class="btn btn-primary btn" type="submit" name="odhlasit" value="odhlasit">Odhlasit</button>
                        </li>
                    </form>
                    <form method="redirectTvorbaCharactera">
                       <li class="nav-item">
                           <button class="btn btn-secondary btn " type="submit" name="redirectTvorbaCharactera" value="redirectTvorbaCharactera">Vytvorit Charakter</button>
                       </li>
                    </form>
                    <?php } else{ ?>
                    <form method="redirectPrihlasenie">
                        <li class="nav-item">
                            <button class="btn btn-primary btn" type="submit" name="redirectPrihlasenie" value="redirectPrihlasenie">Prihlasit</button>
                        </li>
                    </form>
                    <form method="redirectRegistracia">
                        <li class="nav-item mb-3">
                            <button class="btn btn-secondary btn" type="submit" name="redirectRegistracia" value="redirectRegistracia">Registrovat</button>
                        </li>
                    </form>
                    <?php } ?>
                    <form method="redirectDomov">
                        <li class="nav-item mb-3">
                            <button class="btn btn-secondary btn" type="submit" name="navratDomov" value="navratDomov">Domov</button>
                        </li>
                    </form>
                </ul>
        </div>
    </div>
</nav>
    <?php if (Authenticator::isLogged()) { ?>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
            <div class="col"></div>
            <div class="col">
            <p class="navbar-brand username"> Vytaj <?php echo(Authenticator::getName()) ?> !</p></div>
            <div class="col"></div>
            <div class="col"></div>
        </nav>
    <br>
        <ul>
            <form method="redirectPremenovanie">
                <div class="nav-item">
                    <button class="btn btn-secondary btn" type="submit" name="redirectPremenovanie" value="redirectPremenovanie">Zmenit Meno</button>
                </div>
            </form>
        <br>
            <form method="redirectZmenaHesla">
                <div class="nav-item">
                    <button class="btn btn-secondary btn" type="submit" name="redirectZmenaHesla" value="redirectZmenaHesla">Zmenit Heslo</button>
                </div>
            </form>
        <br>
            <form method="zmazatUcet">
                <div class="col nav-item">
                    <button class="btn btn-secondary btn btn-danger" type="submit" name="zmazatUcet" value="zmazatUcet">Zmazat Ucet</button>
                </div>
            </form>
        </ul>
        <br>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-Right">
        <h4>Character List:</h4>
    </nav>
    <br>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    <div>
        <form>
            Select a Character
            <br>
            <select name="characters" onchange="showCharacterData(this.value)">
            <option>-none-</option>
                <?php
                /** @var Character $Character */
                if($app->listCharacterData() != false){
                    foreach ($app->listCharacterData() as $Character) {
                        echo "<option>".$Character->getNickname()."</option>";
                    }
                }
                }?>
            </select>
        </form>
        <div id="characterVypis"><b>Character info will be listed here...</b></div>

        <br>

    </div>
    </nav>
</body>
</html>