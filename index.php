<?php
session_start();
$_SESSION['c'] += 1;
Header("Location:Views/home.php");
