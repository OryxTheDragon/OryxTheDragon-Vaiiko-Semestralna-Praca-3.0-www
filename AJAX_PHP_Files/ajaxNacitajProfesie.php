<?php

$con = mysqli_connect('localhost', 'root', 'dtb456', 'databaza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

    $sql = ("SELECT * FROM professions");
    $result = $con->query($sql);
    while ($row = mysqli_fetch_row($result)) {
        $profID = $row[0];
        $profName = $row[1];
        echo ("<option value=".'"'.$profID.'"'.">".$profName."</option>");
    }
    $result->free_result();
mysqli_close($con);
