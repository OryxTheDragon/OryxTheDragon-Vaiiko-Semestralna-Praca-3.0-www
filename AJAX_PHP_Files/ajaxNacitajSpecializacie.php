<?php

$profID = strval($_GET["q"]);


$con = mysqli_connect('localhost', 'root', 'dtb456', 'databaza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


if ($profID > 0 && $profID <= 9) {
    $sql = $con->prepare("SELECT specialisation_id,specialisation_name FROM specialisations WHERE specialisation_prof_id = ? ORDER BY specialisation_id ASC");
    $sql->bind_param("s", $profID);
    $sql->execute();
    $result = $sql->get_result();

    while ($row = mysqli_fetch_row($result)) {
        $specID = $row[0];
        $specName = $row[1];
        echo("<option value=" . '"' . $specID . '"' . ">" . $specName . "</option>");
    }
    $result->free_result();
}
mysqli_close($con);
