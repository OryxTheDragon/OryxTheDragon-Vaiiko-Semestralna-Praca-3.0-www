<?php


use Classes\Authenticator;
use Classes\Character;
use Classes\DBStorage;

$data = file_get_contents("php://input");
$data = json_decode($data);

$characterNickname = $data[0];
$characterProfession = intval($data[1]);
$characterSpecialisation = intval($data[2]);
$characterRace = intval($data[3]);
$characterGender = intval($data[4]);
$username = strval($data[5]);


$con = mysqli_connect('localhost', 'root', 'dtb456', 'databaza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql = $con->prepare("SELECT id FROM users WHERE username = ? ");
$sql->bind_param("s", $username);
$sql->execute();
$dbResult = $sql->get_result();
if ($dbResult->num_rows > 0) {
    if($record = $dbResult->fetch_assoc()) {
        $characterUserID = $record['id'];
    }
}
$dbResult->free_result();

$stmt = $con->prepare("INSERT INTO characters(user_id,nickname,character_prof_id,character_spec_id,character_race_id,character_gender_id) VALUES (?,?,?,?,?,?)");
$stmt->bind_param('ssssss',$characterUserID,$characterNickname,$characterProfession,$characterSpecialisation,$characterRace,$characterGender);

if ($stmt->execute()){
    $this->checkDBErrors();
    return true;
}



