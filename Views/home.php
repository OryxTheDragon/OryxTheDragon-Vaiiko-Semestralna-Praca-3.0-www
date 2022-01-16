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
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">
    <link rel="stylesheet" href="../CSS/homeView.css">
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
                <form method="redirectDomov">
                    <li class="nav-item p-1">
                        <button class="btn btn-secondary" type="submit" name="navratDomov" value="navratDomov">
                            Domov
                        </button>
                    </li>
                </form>
            </ul>
        </div>
    </div>
</nav>
<?php if (Authenticator::isLogged()) { ?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center text-center">
    <div class="col"></div>
    <div class="col navbar-brand"> Vytaj späť <?php echo(Authenticator::getName()) ?> !</div>
    <form method="redirectTvorbaCharactera">
        <div class="nav-item">
            <button class="btn btn-secondary btn-success" type="submit" name="redirectTvorbaCharactera"
            >Nový Charakter
            </button>
        </div>
    </form>
    <div class="col"></div>
</nav>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    <div class="container">
        <div class="col-8 text-left">
            <h4>Charakter:</h4>
        </div>
        <div class="col-2 text-center">
            Zvoľ si charakter
            <br>
            <form method="post">
                <select name="characters" onchange="showCharacterData(this.value)">
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
    </div>
</nav>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    <div class="col"></div>
    <div class="col  text-center">
        <div id="characterVypis"><b></b></div>
    </div>
    <div class="col"></div>
</nav>
</body>
</html>