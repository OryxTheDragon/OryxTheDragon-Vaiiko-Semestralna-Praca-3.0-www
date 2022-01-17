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
            $this->storage->deleteUser();
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
            $this->storage->renameCharacter($_POST['characterID'],$_POST['newCharacterName']);
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
        if (isset($_GET["listCharacters"])) {
            $this->storage->getUserCharacters();
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