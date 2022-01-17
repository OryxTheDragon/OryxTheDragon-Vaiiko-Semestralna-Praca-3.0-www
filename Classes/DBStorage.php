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
        if (!$this->validateUserLogin($user->getUsername())) {
            return -2;
        }
        if (!$this->validatePassword($user->getPassword())) {
            return -2;
        }
        $stmt = $this->db->prepare("INSERT INTO users(username,password) VALUES (?,?)");
        $username = $user->getUsername();
        $encryptedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $stmt->bind_param('ss', $username, $encryptedPassword);
        $stmt->execute();
        $this->checkDBErrors();
        $this->getAuthentication($username, $user->getPassword());
        Redirektor::navratDomov();
    }

    public function deleteUser()
    {
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
        if (!$this->validateUsername($newUsername)) {
            return -2;
        }
        if (!$this->validateUserLogin($newUsername)) {
            return -2;
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
        if (!$this->validatePassword($oldPassword)) {
            return -2;
        }

        if (!$this->validatePassword($newPassword)) {
            return -2;
        }
        if (Authenticator::isLogged()) {
            $username = Authenticator::getName();
            if (!$this->validateUsername($username)) {
                echo "<script>alert('How in the sweet guinea pig of Winnipeg have you managed this?.')</script>";
                return -10;
            }
            $query = ('SELECT password FROM users WHERE username = ?');
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (password_verify($oldPassword, $row["password"])) {
                        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE username = ?");
                        $passwordUpdate = password_hash($newPassword, PASSWORD_DEFAULT);
                        $stmt->bind_param("ss", $passwordUpdate, $username);
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
        if (!$this->validateUsername($username)) {
            return -2;
        }
        if (!$this->validatePassword($password)) {
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
                $result[] = new Character($record['user_id'], $record['nickname'], $record['character_prof_id'], $record['character_spec_id'], $record['character_race_id'], $record['character_gender_id']);
            }
        }
        return $result;
    }

    public function getUserID()
    {
        $userID = 0;
        $user = Authenticator::getName();
        $sql = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $sql->bind_param('s', $user);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            if ($record = $result->fetch_assoc()) {
                $userID = $record['id'];
            }
        }
        return $userID;
    }

    public function createCharacter(Character $character)
    {
        $sql = ("SELECT user_id FROM users WHERE username =" . '"' . Authenticator::login() . '"');
        $result = $this->db->query($sql);
        $characterUserID = $result['user_id'];
        $result->free_result();

        if (!$this->validateNickname($character->getNickname())) {
            return -2;
        }
        $characterNickname = $character->getNickname();

        if (!$this->validateProfession($character->getCharacterprofId())) {
            return -2;
        }

        $characterProfession = $character->getCharacterprofId();

        if (!$this->validateSpecialisation($characterProfession, $character->getCharacterSpecId())) {
            return -2;
        }
        $characterSpecialisation = $character->getCharacterSpecId();

        if (!$this->validateRace($character->getCharacterRaceId())) {
            return -2;
        }
        $characterRace = $character->getCharacterRaceId();

        if (!$this->validateGender($character->getCharacterGenderId())) {
            return -2;
        }
        $characterGender = $character->getCharacterGenderId();

        $stmt = $this->db->prepare("INSERT INTO characters(user_id,nickname,character_prof_id,character_spec_id,character_race_id,character_gender_id) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('ssssss', $characterUserID, $characterNickname, $characterProfession, $characterSpecialisation, $characterRace, $characterGender);
        $stmt->execute();
        $this->checkDBErrors();

        echo '<script>alert("Character uspesne vytvoreny.")</script>';
    }

    public function renameCharacter($characterID, $characterName)
    {
        if (!$this->validateNickname($characterName)) {
            return -2;
        }
        $newCharacterName = $characterName;
        $stmt = $this->db->prepare("UPDATE characters SET nickname = ? WHERE character_id = ? ");
        $stmt->bind_param('ss', $newCharacterName, $characterID);
        if ($stmt->execute()) {
            $this->checkDBErrors();
            echo '<script>alert("Character uspesne premenovany.")</script>';
            return true;
        }
        echo '<script>alert("Character sa nepodarilo premenovat.")</script>';
        return false;
    }

    public function deleteCharacter($characterID)
    {
        $userID = $this->getUserID();
        $stmt = $this->db->prepare("DELETE FROM characters WHERE character_id = ? AND user_id = ?");
        $stmt->bind_param('ss', $characterID, $userID);
        if ($stmt->execute()) {
            $this->checkDBErrors();
            echo '<script>alert("Character uspesne zmazany.")</script>';
            return true;
        }
        echo '<script>alert("Character sa nepodarilo zmazat.")</script>';
        return false;
    }


    /**
     *      2/4 CRUD Operácie nad vedľajšími tabuľkami.
     */
    public function getSpecialisation($specialisationID)
    {
        $specInfo[] = "";
        $this->validateSpecialisation($specialisationID);
        $sql = $this->db->prepare("SELECT * FROM specialisations ORDER BY specialisation_id ASC");
        $sql->bind_param('s', $specialisationID);
        $sql->execute();
        $result = $sql->get_result();

        while ($row = mysqli_fetch_row($result)) {
            $specInfo[0] = $row[0];
            $specInfo[1] = $row[1];
            $specInfo[2] = $row[2];
        }
        $result->free_result();
        return $specInfo;
    }

    public function updateSpecialisationName($specialisationID, $newSpecialisationName)
    {
        $this->validateSpecialisation($specialisationID);
        $sql = $this->db->prepare("UPDATE specialisations SET specialisation_name = ? WHERE specialisations_id = ?");
        $sql->bind_param('ss', $newSpecialisationName, $specialisationID);
        $sql->execute();
        if ($sql->execute()) {
            echo "<script>alert('Zmena nazvu specializacie prebehla uspesne.')</script>";
            return true;
        }
        echo "<script>alert('Zmena nazvu specializacie prebehla neuspesne.')</script>";
        return false;
    }


    public function getProfession($professionID)
    {
        $profInfo[] = "";
        $this->validateProfession($professionID);
        $sql = $this->db->prepare("SELECT * FROM professions WHERE profession_id = ?");
        $sql->bind_param('s', $professionID);
        $sql->execute();
        $result = $sql->get_result();
        while ($row = mysqli_fetch_row($result)) {
            $profInfo[0] = $row[0];
            $profInfo[1] = $row[1];
        }
        $result->free_result();
        return $profInfo;
    }

    public function updateProfessionName($professionID, $newProfessionName)
    {
        $this->validateProfession($professionID);
        $sql = $this->db->prepare("UPDATE professions SET profession_name = ? WHERE profession_id = ?");
        $sql->bind_param('ss', $newProfessionName, $professionID);
        $sql->execute();
        if ($sql->execute()) {
            echo "<script>alert('Zmena nazvu profesie prebehla uspesne')</script>";
            return true;
        }
        echo "<script>alert('Zmena nazvu profesie prebehla neuspesne')</script>";
        return false;
    }

    public function getRace($raceID)
    {
        $raceInfo[] = "";
        $this->validateRace($raceID);
        $sql = $this->db->prepare("SELECT * FROM races WHERE race_id = ?");
        $sql->bind_param('s', $raceID);
        $sql->execute();
        $result = $sql->get_result();
        while ($row = mysqli_fetch_row($result)) {
            $raceInfo[0] = $row[0];
            $raceInfo[1] = $row[1];
        }
        $result->free_result();
        return $raceInfo;
    }

    public function updateRaceName($raceID, $newRaceName)
    {
        $this->validateRace($raceID);
        $sql = $this->db->prepare("UPDATE races SET race_name = ? WHERE race_id = ?");
        $sql->bind_param('ss', $newRaceName, $raceID);
        $sql->execute();
        if ($sql->execute()) {
            echo "<script>alert('Zmena nazvu rasy prebehla uspesne.')</script>";
            return true;
        }
        echo "<script>alert('Zmena nazvu rasy prebehla neuspesne.')</script>";
        return false;
    }

    public function getGender($genderID)
    {
        $genderInfo[] = "";
        $this->validateGender($genderID);
        $sql = $this->db->prepare("SELECT * FROM genders WHERE gender_id = ?");
        $sql->bind_param('s', $genderID);
        $sql->execute();
        $result = $sql->get_result();
        while ($row = mysqli_fetch_row($result)) {
            $genderInfo[0] = $row[0];
            $genderInfo[1] = $row[1];
        }
        $result->free_result();
        return $genderInfo;
    }

    public function updateGenderName($genderID, $newGenderName)
    {
        $this->validateGender($genderID);
        $sql = $this->db->prepare("UPDATE genders SET gender_name = ? WHERE gender_id = ?");
        $sql->bind_param('ss', $newGenderName, $genderID);
        $sql->execute();
        if ($sql->execute()) {
            echo "<script>alert('Zmena nazvu pohlavia prebehla uspesne.')</script>";
            return true;
        }
        echo "<script>alert('Zmena nazvu pohlavia prebehla uspesne.')</script>";
        return false;
    }

    /**
     *      Validacia zo strany servra.
     * */
    private function validateUsername(string $getUsername)
    {

        if ((strlen($getUsername) < 4) && (strlen($getUsername) > 15)) {
            echo "<script>alert('Zadane meno nevyhovuje podmienkam. Prosim zadajte meno ktore ma aspon 3 znakov a maximalne 15 znakov.')</script>";
            return false;
        }

        return true;
    }

    private function validatePassword(string $getPassword)
    {
        if (strlen($getPassword) < 8) {
            echo "<script>alert('Zadane heslo nevyhovuje podmienkam. Prosim zadajte heslo ktore ma aspon 8 znakov.')</script>";
            return false;
        }
        return true;
    }

    private function validateGender(int $getGender)
    {
        if (!($getGender > 0 && $getGender <= 3)) {
            echo "<script>alert('Zle zadane pohlavie!')</script>";
            return false;
        }
        return true;
    }

    private function validateProfession(int $getProfession)
    {
        if (!($getProfession > 0 && $getProfession <= 9)) {
            echo "<script>alert('Zle zadana profesia!')</script>";
            return false;
        }
        return true;
    }

    private function validateRace(int $getRace)
    {
        if (!($getRace > 0 && $getRace <= 5)) {
            echo "<script>alert('Zle zadana rasa!')</script>";
            return false;
        }
        return true;
    }

    private function validateSpecialisation(int $getProfessia, $getSpecialisation)
    {
        if (!($getSpecialisation >= ($getProfessia * 3 + 15) && $getSpecialisation <= ($getProfessia * 3 + 17))) {
            echo "<script>alert('Zle zadana specializacia!')</script>";
            return false;
        }
        return true;
    }

    private function validateNickname(string $getNickname)
    {
        if (!(strlen($getNickname) > 3)) {
            echo "<script>alert('Zadany nickname je prilis kratky!')</script>";
            return false;
        }
        if (!(strlen($getNickname) <= 15)) {
            echo "<script>alert('Zadany nickname je prilis dlhy!)</script>";
            return false;
        }
        return true;
    }

    private function validateUserLogin($login)
    {

        $sql = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $sql->bind_param('s', $login);
        $sql->execute();
        $dbResult = $sql->get_result();

        if (!($dbResult->num_rows == 0)) {
            echo "<script>alert('Vybrany nazov charakteru uz je zabraty! Zvolte prosim iny nickname.')</script>";
            return false;
        }
        return true;
    }
}
