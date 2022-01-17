<?php

$con = mysqli_connect('localhost', 'root', 'dtb456', 'databaza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$result = $con->query("SELECT * FROM races ORDER BY race_id ASC");
while ($row = mysqli_fetch_row($result)) {
    $raceID = $row[0];
    $raceName = $row[1];
    echo("<option value=" . '"' . $raceID . '"' . ">" . $raceName . "</option>");
}
$result->free_result();
mysqli_close($con);
