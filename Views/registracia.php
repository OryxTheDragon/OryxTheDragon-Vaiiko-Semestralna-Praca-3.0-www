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
    <title>Guild Wars 2 - registracia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/registraciaView.css">
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">

    <script>


        let Link;
        let PP;
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

        function delay(n) {
            return new Promise(function (resolve) {
                setTimeout(resolve, n * 1000);
            });
        }

        function validaciaRegistracie() {
            let username = document.forms["registracia"]["username"].value;
            let password = document.forms["registracia"]["password"].value;
            if (username.length < 4) {
                alert("Username must be at least 4 characters long.");
                return false;
            }
            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    <div class="col-8 text-left">
        <h2>Guild Wars 2 - Character Simulator</h2>
    </div>
    <div class="col-1 text-center">
        <ul class="navbar-nav">
            <?php if (!Authenticator::isLogged()) { ?>
                <form method="redirectPrihlasenie">
                    <li class="nav-item">
                        <button class="btn btn-secondary btn" type="submit" name="redirectPrihlasenie"
                                value="redirectPrihlasenie">Prihlasit
                        </button>
                    </li>
                </form>
            <?php } ?>
            <form method="redirectDomov">
                <li class="nav-item">
                    <button class="btn btn-secondary btn" type="submit" name="redirectDomov" value="redirectDomov">
                        Domov
                    </button>
                </li>
            </form>
        </ul>
    </div>
        <div class="col-1"></div>
</nav>

<div class="container">
    <?php if (!Authenticator::isLogged()) { ?>
        <nav class="navbar justify-content-center">
            <div class="row">
                <div class="col-xs-2"></div>
                <div class="col-xs-2 text-center">
                    <form method="get" class="username" name="registracia" onsubmit="return validaciaRegistracie()">
                        <label for="Username">Username:</label>
                        <input type="Text" class="form-control" id="username" name="username"><br>
                        <label for="Password">Password:</label>
                        <input class="mb-4 form-control" type="password" id="password" name="password"
                               placeholder="Password">
                        <form>
                            <p><input type="checkbox" name="checkbox" value="check"/> Potvrdzujem, ze suhlasim s
                                <script>makeLink()</script>
                            </p>
                            <button onclick="if(!this.form.checkbox.checked){alert('Najprv musite odsuhlasit privacy policy!');return false}"
                                    class="btn btn-primary btn" type="submit" name="registrovat" value="registrovat">
                                Registrovat
                            </button>
                        </form>
                    </form>
                </div>
                <div class="col-xs-2"></div>
            </div>
        </nav>
    <?php } else { ?>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <h2>Ste prihlaseny.</h2>
                <script>
                    alert("Ste uz prihlaseny. Pre novu registraciu sa najskor odhlaste.");
                </script>
            </div>
            <div class="col"></div>
        </div>
    <?php } ?>
</div>
</body>
</html>
