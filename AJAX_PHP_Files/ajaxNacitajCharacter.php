<?php

$charNickname = strval($_GET["q"]);


$con = mysqli_connect('localhost', 'root', 'dtb456', 'databaza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql = $con->prepare("SELECT * FROM characters WHERE nickname = ? ");
$sql->bind_param("s", $charNickname);
$sql->execute();
$result = $sql->get_result();

echo "<div class='container' id='ZobrazCharakterContainer'>";
echo "<table class='table table-dark'  id='tableList' >
        <thead class='thead-light'>
            <tr>
                <th class='fluid'>Character ID</th>
                <th class='fluid'>User </th>
                <th class='fluid'>Nickname </th>
                <th class='fluid'></th>
                <th class='fluid'>Profession </th>
                <th class='fluid'></th>
                <th class='fluid'>Specification </th>
                <th class='fluid'>Race </th>
                <th class='fluid'></th>
                <th class='fluid'>Gender</th>
            </tr>
        </thead>";

$characterID = "";
$userID = "";
$nickname = "";
$professionID = "";
$SpecialisationID = "";
$raceID = "";
$genderID = "";

while ($row = $result->fetch_assoc()) {
    $characterID = $row['character_id'];
    $userID = $row['user_id'];
    $nickname = $row['nickname'];
    $professionID = $row['character_prof_id'];
    $specialisationID = $row['character_spec_id'];
    $raceID = $row['character_race_id'];
    $genderID = $row['character_gender_id'];
}


echo "<tr>";

echo "<td>#" . $characterID . "</td>";

$sql = $con->prepare("SELECT username FROM users WHERE id = ? ");
$sql->bind_param("s", $userID);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    ($row = $result->fetch_assoc());
    $username = $row['username'];
    echo "<td>" . $username . "</td>";
} else {
    echo "<td>N/A</td>";
}
$result = $sql->get_result();
echo "<td>" . $nickname . "</td>";


$sql = $con->prepare("SELECT profession_name FROM professions WHERE profession_id = ? ");
$sql->bind_param("s", $professionID);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    ($row = $result->fetch_assoc());
    $profession = $row['profession_name'];
    echo "<td class='image $profession'>.'N/A'.</td>";
    echo "<td id='$profession'>" . $profession . "</td>";
} else {
    echo "<td>N/A</td>";
    echo "<td>N/A</td>";
}
$result->free_result();


$sql = $con->prepare("SELECT specialisation_name FROM specialisations WHERE specialisation_id = ? ");
$sql->bind_param("s", $specialisationID);
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
    ($row = $result->fetch_assoc());
    $specialisation = $row['specialisation_name'];
    echo "<td class='image $specialisation'>.'N/A'.</td>";
    echo "<td id='$specialisation'>" . $specialisation . "</td>";
} else {
    echo "<td>N/A</td>";
    echo "<td>N/A</td>";
}
$result->free_result();

$sql = $con->prepare("SELECT race_name FROM races WHERE race_id = ? ");
$sql->bind_param("s", $raceID);
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
    ($row = $result->fetch_assoc());
    $race = $row['race_name'];
    echo "<td class='image $race'>" . $race . "</td>";
} else {
    echo "<td>N/A</td>";
}
$result->free_result();

$sql = $con->prepare("SELECT gender_name FROM genders WHERE gender_id = ? ");
$sql->bind_param("s", $raceID);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    ($row = $result->fetch_assoc());
    $gender = $row['gender_name'];
    echo "<td class='image $gender'></td>";
    echo "<td class='GenderTableData' id='$gender'>" . $gender . "</td>";
} else {
    echo "<td>N/A</td>";
}
$result->free_result();

echo "</tr>";

echo "</table>          
                    <nav class='navbar navbar-expand-sm justify-content-center'>
                        <ul class='navbar nav'>
                            <li class='nav-item p-1'>
                                <form method='Post'>
                                    <input class='form-control mb-3 mr-3' type='text' name='newCharacterName'></input>
                                    <input type='text' name='characterID' style='display: none' value='" . $characterID . "'></input>
                                    <button class='btn btn-secondary btn-success' type='submit' name='premenovatCharakter'>Premenovat
                                    </button>
                                </form>
                            </li>
                            <li class='nav-item p-5'></li>
                            <li class='nav-item p-1'>
                                <form method='Post'>
                                    <input type='text' name='characterID' style='display: none' value='" . $characterID . "'></input>
                                    <button class='btn btn-secondary btn-danger' type='submit' name='zmazatCharakter'>Zmazat Charakter
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </nav>";

echo "</div>";
mysqli_close($con);
