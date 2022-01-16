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

echo "<table class='table table-dark'>
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
$_REQUEST["characterID"] = $characterID;

$sql = ("SELECT username FROM users WHERE id =".$userID);
$result = $con->query($sql);
if ($result->num_rows > 0) {
    ($row = $result->fetch_assoc());
    $username = $row['username'];
        echo "<td>" . $username . "</td>";
} else {
    echo "<td>N/A</td>";
}

echo "<td>" . $nickname . "</td>";


$sql = ("SELECT profession_name FROM professions WHERE profession_id =".$professionID);
$result = $con->query($sql);
if ($result->num_rows > 0) {
    ($row = $result->fetch_assoc());
    $profession = $row['profession_name'];
    echo "<td class='image $profession'>.'N/A'.</td>";
    echo "<td id='$profession'>" . $profession . "</td>";
} else {
    echo "<td>N/A</td>";
    echo "<td>N/A</td>";
}

$sql = ("SELECT specialisation_name FROM specialisations WHERE specialisation_id =".$specialisationID);
$result = $con->query($sql);
if ($result->num_rows > 0) {
    ($row = $result->fetch_assoc());
    $specialisation = $row['specialisation_name'];
    echo "<td class='image $specialisation'>.'N/A'.</td>";
    echo "<td id='$specialisation'>".$specialisation."</td>";
} else {
    echo "<td>N/A</td>";
    echo "<td>N/A</td>";
}

$sql = ("SELECT race_name FROM races WHERE race_id =".$raceID);
$result = $con->query($sql);
if ($result->num_rows > 0) {
    ($row = $result->fetch_assoc());
    $race = $row['race_name'];
    echo "<td class='image $race'>" . $race . "</td>";
} else {
    echo "<td>N/A</td>";
}

$sql = ("SELECT gender_name FROM genders WHERE gender_id =".$genderID);
$result = $con->query($sql);
if ($result->num_rows > 0) {
    ($row = $result->fetch_assoc());
    $gender = $row['gender_name'];
    echo "<td class='image $gender'></td>";
    echo "<td class='GenderTableData' id='$gender'>" . $gender . "</td>";
} else {
    echo "<td>N/A</td>";
}

echo "</tr>";

echo "</table>";
echo "<form method='Post'>
                            <ul class='nav-item p-1' >
                                <input type='text' name='characterID' style='display: none' value='".$characterID."'></input>
                                <button class='btn btn-secondary btn-danger' type='submit' name='zmazatCharakter'>Zmazat Charakter
                                </button>
                            </ul>
                        </form>";
mysqli_close($con);
