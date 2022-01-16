<?php

$con = mysqli_connect('localhost', 'root', 'dtb456', 'databaza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql = ("SELECT * FROM races ORDER BY race_id ASC");
$result = $con->query($sql);
while ($row = mysqli_fetch_row($result)) {
    $raceID = $row[0];
    $raceName = $row[1];
    echo ("<option value=".'"'.$raceID.'"'.">".$raceName."</option>");
}
$result->free_result();
mysqli_close($con);
