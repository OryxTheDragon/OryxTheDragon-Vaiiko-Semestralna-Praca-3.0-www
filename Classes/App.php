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
        if (isset($_REQUEST["registrovat"])) {
            $this->storage->createUser(new User($_REQUEST['username'], ($_REQUEST['password'])));
        }
        // TODO: Implementacia pomocov "PREFERENCE"
        if (isset($_REQUEST["vytvoritCharakter"])) {
            $this->storage->createCharacter(new Character($_REQUEST['nickname'], $_REQUEST['profession'], $_REQUEST['specialisation'], $_REQUEST['race']));
        }
        if (isset($_REQUEST["prihlasit"])) {
            $this->storage->getAuthentication($_REQUEST['username'], $_REQUEST['password']);
        }

        if (isset($_REQUEST["odhlasit"])) {
            Authenticator::logout();
        }

        if (isset($_REQUEST["zmazatUcet"])) {
            $this->storage->deleteUser();
        }

        if (isset($_REQUEST["premenovat"])) {
            $this->storage->updateUsername($_REQUEST['newUsername']);
        }
        if (isset($_REQUEST["zmenitHeslo"])) {
            $this->storage->updatePassword($this->encryptPassword($_REQUEST['oldPassword']), $this->encryptPassword($_REQUEST['newPassword']));
        }


        if (isset($_REQUEST["listCharacters"])) {
            $this->storage->getUserCharacters();
        }

        /** Redirekty */
        if (isset($_REQUEST["redirectDomov"])) {
            Redirektor::navratDomov();
        }
        if (isset($_REQUEST["redirectPrihlasenie"])) {
            Redirektor::prihlasenie();
        }
        if (isset($_REQUEST["redirectRegistracia"])) {
            Redirektor::registracia();
        }
        if (isset($_REQUEST["vytvoritCharakter"])) {
            Redirektor::tvorbaCharakteru();
        }
        if (isset($_REQUEST["redirectTvorbaCharactera"])) {
            Redirektor::redirectTvorbaCharaktera();
        }
        if (isset($_REQUEST["redirectNastavenia"])) {
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