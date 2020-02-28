<?php

session_start();
include('connect.php');
$userID = $_SESSION['adminID'];


$query = "UPDATE administrator SET `active` = '0' WHERE `adminID` = '$userID'";
$result = mysqli_query($db, $query);

if ($result) {
    unset($_SESSION['adminID']);
    session_destroy();
    header('location: adm_login.php');
}
 