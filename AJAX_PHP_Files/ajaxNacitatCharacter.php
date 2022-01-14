<?php

$charNickname = strval($_GET["q"]);

$con = mysqli_connect('localhost', 'root', 'dtb456', 'databaza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con, "ajax_demo");
$sql = $con->prepare("SELECT * FROM characters WHERE nickname = ? ");
$sql->bind_param("s", $charNickname);
$sql->execute();
$result = $sql->get_result();

echo "<table class='table table-dark'>
        <tr>
            <th>character_id</th>
            <th>user_id</th>
            <th>nickname</th>
            <th>character_prof_id</th>
            <th>character_spec_id</th>
            <th>character_race_id</th>
            <th>character_gender</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['character_id'] . "</td>";
    echo "<td>" . $row['user_id'] . "</td>";
    echo "<td>" . $row['nickname'] . "</td>";
    echo "<td>" . $row['character_prof_id'] . "</td>";
    echo "<td>" . $row['character_spec_id'] . "</td>";
    echo "<td>" . $row['character_race_id'] . "</td>";
    echo "<td>" . $row['character_gender'] . "</td>";
    echo "</tr>";
}

echo "</table>";

mysqli_close($con);
