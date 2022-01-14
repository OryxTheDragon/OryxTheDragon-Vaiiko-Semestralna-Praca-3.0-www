<?php

namespace Classes;

use mysqli;

require_once "App.php";
require_once "Authenticator.php";

class DBStorage implements IStorage
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', 'dtb456', 'databaza');
        $this->checkDBErrors();
    }

    public function getAllData()
    {
        $result = [];
        $sql = "SELECT * FROM users";
        $dbResult = $this->db->query($sql);
        if ($dbResult->num_rows > 0) {
            while ($record = $dbResult->fetch_assoc()) {
                $ID = $record['id'];
                echo $ID;
                $result[] = new User($record['username'], $record['password']);
            }
        }
        return $result;
    }

    public function createUser(User $user)
    {
        if (!$this->validateUsername($user->getUsername())){
            echo "<script>alert('Wrong username attempted for input into database.')</script>";
            return -3;
        }
        if (!$this->validatePassword($user->getPassword())){
            echo "<script>alert('Wrong password attempted for input into database.')</script>";
            return -2;
        }
        $stmt = $this->db->prepare("INSERT INTO users(username,password) VALUES (?,?)");
        $username = $user->getUsername();
        $encryptedPassword = password_hash($user->getPassword(),PASSWORD_DEFAULT);
        $stmt->bind_param('ss', $username, $encryptedPassword);
        $stmt->execute();
        $this->checkDBErrors();
        $this->getAuthentication($username, $user->getPassword());
        Redirektor::navratDomov();
    }

    public function deleteUser()
    {
        //TODO ste si isty ze chcete deletnut usera ? asi checkbox v html
        if (Authenticator::isLogged()) {
            $name = Authenticator::getName();
            $stmt = $this->db->prepare("DELETE FROM users WHERE username = ? ");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $this->checkDBErrors();
            echo '<script>alert("Ucet bol uspesne zmazany.")</script>';
            Authenticator::logout();
        } else {
            echo '<script>alert("Najskor sa musite prihlasit.")</script>';
        }
    }

    public function updateUsername($newUsername)
    {
        if (!$this->validateUsername($newUsername)){
            echo "<script>alert('Wrong new username attempted for input.')</script>";
            return -3;
        }
        if (Authenticator::isLogged()) {
            $stmt = $this->db->prepare("UPDATE users SET username = ? WHERE username = ? ");
            $oldUsername = Authenticator::getName();
            $stmt->bind_param("ss", $newUsername, $oldUsername);
            $stmt->execute();
            $this->checkDBErrors();
            $_SESSION['username'] = $newUsername;
            echo '<script>alert(Meno bolo uspesne zmenene. Nove meno : Authenticator::getName())</script>';
            Redirektor::navratDomov();
        } else {
            echo '<script>alert("Najskor sa musite prihlasit.")</script>';
        }
    }
    public function updatePassword($oldPassword, $newPassword)
    {
        if (!$this->validatePassword($oldPassword)){
            echo "<script>alert('Wrong old password attempted for input.')</script>";
            return -3;
        }

        if (!$this->validatePassword($newPassword)){
            echo "<script>alert('Wrong new password attempted for input.')</script>";
            return -2;
        }
        if (Authenticator::isLogged()) {
            $username = Authenticator::getName();
            if (!$this->validateUsername($username)){
                echo "<script>alert('Logged in user has a wrong username.')</script>";
                echo "<script>alert('How in the sweet guinea pig of Winnipeg have you managed this?.')</script>";
                return -10;
            }
            $query = ('SELECT password FROM users WHERE username = ' . '"' . $username . '"');
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (password_verify($oldPassword, $row["password"])) {
                        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE username = " . '"' . $username . '"');
                        $passwordUpdate = password_hash($newPassword , PASSWORD_DEFAULT);
                        $stmt->bind_param("s", $passwordUpdate);
                        $stmt->execute();
                        $this->checkDBErrors();
                        echo '<script>alert("Heslo bolo uspesne zmenene.")</script>';
                        Redirektor::navratDomov();
                    } else {
                        echo '<script>alert("Zadali ste nespravne stare heslo.")</script>';
                    }
                }
            }
        } else {
            echo '<script>alert("Najskor sa musite prihlasit.")</script>';
        }
    }

    public function getAuthentication($username, $password)
    {
        if (!$this->validateUsername($username)){
            echo "<script>alert('Wrong username attempted for input.')</script>";
            return -3;
        }
        if (!$this->validatePassword($password)){
            echo "<script>alert('Wrong password attempted for.')</script>";
            return -2;
        }
        $stmt = $this->db->prepare("SELECT password FROM users WHERE username = ? ");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (password_verify($password, $row['password'])) {
                    Authenticator::login($username);
                    Redirektor::navratDomov();
                } else {
                    echo '<script>alert("Nespravne prihlasovacie heslo.")</script>';
                }
            }
        } else {
            echo '<script>alert("Zadany pouzivatel neexistuje.")</script>';
        }
    }

    public function checkDBErrors()
    {
        if ($this->db->error) {
            die("DB error:" . $this->db->error);
        }
    }

    public function getUserCharacters()
    {
        $result = [];
        $sql = ("SELECT * FROM characters JOIN users ON characters.user_id = users.id WHERE users.id = (SELECT users.id FROM users WHERE users.username = " . '"' . Authenticator::getName() . '")');
        $dbResult = $this->db->query($sql);
        if ($dbResult->num_rows > 0) {
            while ($record = $dbResult->fetch_assoc()) {
                $result[] = new Character($record['character_id'], $record['user_id'], $record['nickname'], $record['character_prof_id'], $record['character_spec_id'], $record['character_race_id']);
            }
        }
        return $result;
    }

    public function createCharacter(Character $character)
    {
    }



    // Validacia zo strany servra.
    private function validateUsername(string $getUsername)
    {
        if (strlen($getUsername) < 4) {
            return false;
        }
        return true;
    }

    private function validatePassword(string $getPassword)
    {
        if (strlen($getPassword) < 8) {
            return false;
        }
        return true;
    }
}
