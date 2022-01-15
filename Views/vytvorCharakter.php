<?php

use Classes\App;

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
require "../Classes/App.php";
require "../Classes/Redirektor.php";
require_once "../Classes/Authenticator.php";
$app = new App();

if (!\Classes\Authenticator::isLogged()){
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
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../JSFiles/ajaxVytvorCharacter.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../CSS/BasicDarkMode.css">
    <link rel="stylesheet" href="../JSFiles/ajaxVytvorCharacter.js">
</head>
<script>
        // $(document).ready(function () {
        //     $("#profesie").change(function () {
        //         console.log("Vybrana profesia = " + Professia);
        //         if ((Professia === '1')) {
        //             $("#specializacie").append("<option value='1'>Mesmer</option>");
        //             $("#specializacie").append("<option value='2'>Chronomancer</option>");
        //             $("#specializacie").append("<option value='3'>Mirage</option>");
        //         }
        //     });
        // });

</script>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    <div class="col-2 m-2">
    <form>
        <select class="form-select" aria-label="Default select example" id="profesie" onchange="zvolSiProfesiu(this.value),nacitajSpecializacie()">
            <option selected>Vyberte si profesiu.</option>
            <option value="1">Mesmer</option>
            <option value="2">Guardian</option>
            <option value="3">Necromancer</option>
            <option value="4">Ranger</option>
            <option value="5">Elementalist</option>
            <option value="6">Warrior</option>
            <option value="7">Thief</option>
            <option value="8">Engineer</option>
            <option value="9">Revenant</option>
        </select>
    </form>
    </div>
    <div class="col-2 m-2">
        <form>
            <select class="form-select" id="specializacie" aria-label="Default select example"
                    onchange="zvolSiSpecializaciu(this.value)">

            </select>
        </form>
    </div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    <button type="button" class="btn btn-primary">Vytvoriť Charakter</button>
</nav>


</body>
</html>
