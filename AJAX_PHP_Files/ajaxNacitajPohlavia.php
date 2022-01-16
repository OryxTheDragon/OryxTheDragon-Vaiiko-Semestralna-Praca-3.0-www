<?php

$con = mysqli_connect('localhost', 'root', 'dtb456', 'databaza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql = ("SELECT * FROM genders");
$result = $con->query($sql);
while ($row = mysqli_fetch_row($result)) {
    $genderID = $row[0];
    $genderName = $row[1];
    echo ("<option value=".'"'.$genderID.'"'.">".$genderName."</option>");
}
$result->free_result();
mysqli_close($con);
