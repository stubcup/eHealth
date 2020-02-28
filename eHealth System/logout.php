<?php

session_start();
include('connect.php');
$userID = $_SESSION['userID'];

$query = "UPDATE user SET `active` = '0' WHERE `userID` = '$userID'";
$result = mysqli_query($db, $query);

if ($result) {
    unset($_SESSION['userID']);
    session_destroy();
    header('location: login.php');
}

?>