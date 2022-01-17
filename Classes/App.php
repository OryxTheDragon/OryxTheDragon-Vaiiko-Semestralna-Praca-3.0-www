<?php

namespace Classes;


require "User.php";
require "IStorage.php";
require "DBStorage.php";

class App
{
    private $storage;

    public function __construct()
    {
        ob_start();
        if ($this->storage == null) {
            $this->storage = new DBStorage();
        }
        /** Komunikacia s databazov */


        /** POST metody*/
        if (isset($_POST["registrovat"])) {
            $this->storage->createUser(new User($_POST['username'], ($_POST['password'])));
        }
        if (isset($_POST["vytvoritCharakter"])) {
            $this->storage->createCharacter(new Character($this->storage->getUserID(), $_POST['nickname'], $_POST['profession'], $_POST['specialisation'], $_POST['race'], $_POST['gender']));
        }
        if (isset($_POST["zmazatUcet"])) {
            $bool = boolval($_POST['zmazatUcet']);
            if (!$bool){
                echo "<script>alert('Mazanie uctu bolo zamietnute.')</script>";
                return -2;
            }
            echo "<script>alert('Mazanie uctu bolo uspesne.')</script>";
            $this->storage->deleteUser();
            Redirektor::navratDomov();
        }
        if (isset($_POST["premenovat"])) {
            $this->storage->updateUsername($_POST['newUsername']);
        }
        if (isset($_POST["zmenitHeslo"])) {
            $this->storage->updatePassword($this->encryptPassword($_POST['oldPassword']), $this->encryptPassword($_POST['newPassword']));
        }
        if (isset($_POST["zmazatCharakter"])) {
            $this->storage->deleteCharacter($_POST['characterID']);
        }
        if (isset($_POST["premenovatCharakter"])) {
            if (!strval($_POST['newCharacterName']) < 3 && !strval($_POST['newCharacterName'] > 15)){
                echo "<script>alert('Zadali ste nevyhovujuce meno. Zadajte nové, ktoré má viac ako 3 a menej ako 15 charakterov.')</script>";
                return -2;
            }
            $this->storage->renameCharacter($_POST['characterID'],$_POST['newCharacterName']);
        }
        if (isset($_POST["premenovatSpecializaciu"])) {
            $this->storage->updateSpecialisationName($_POST['specialisationID'],$_POST['newSpecialisationName']);
        }
        if (isset($_POST["premenovatProfesiu"])) {
            $this->storage->updateProfessionName($_POST['professionID'],$_POST['newProfessionName']);
        }
        if (isset($_POST["premenovatRasu"])) {
            $this->storage->updateRaceName($_POST['raceID'],$_POST['newRaceName']);
        }
        if (isset($_POST["premenovatPohlavie"])) {
            $this->storage->updateGenderName($_POST['genderID'],$_POST['newGenderName']);
        }


        /** GET metody*/
        if (isset($_GET["prihlasit"])) {
            $this->storage->getAuthentication($_GET['username'], $_GET['password']);
        }
        if (isset($_GET["getUserId"])) {
            $this->storage->getUserID();
        }
        if (isset($_GET["odhlasit"])) {
            Authenticator::logout();
        }
        if (isset($_GET["getGender"])) {
            $this->storage->getGender($_GET["genderID"]);
        }
        if (isset($_GET["getRasu"])) {
            $this->storage->getRace($_GET["raceID"]);
        }
        if (isset($_GET["getSpecializaciu"])) {
            $this->storage->getSpecialisation($_GET["specialisationID"]);
        }
        if (isset($_GET["getProfesiu"])) {
            $this->storage->getProfession($_GET["professionID"]);
        }



        /** Redirekty */
        if (isset($_GET["redirectDomov"])) {
            Redirektor::navratDomov();
        }
        if (isset($_GET["redirectPrihlasenie"])) {
            Redirektor::prihlasenie();
        }
        if (isset($_GET["redirectRegistracia"])) {
            Redirektor::registracia();
        }
        if (isset($_GET["vytvoritCharakter"])) {
            Redirektor::tvorbaCharakteru();
        }
        if (isset($_GET["redirectTvorbaCharactera"])) {
            Redirektor::redirectTvorbaCharaktera();
        }
        if (isset($_GET["redirectNastavenia"])) {
            Redirektor::redirectNastavenia();
        }
    }

    private function encryptPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function getAllData()
    {
        return $this->storage->getAllData();
    }

    public function listCharacterData()
    {
        return $this->storage->getUserCharacters();
    }
}