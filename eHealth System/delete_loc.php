<?php

session_start();
$errors = array();
include('connect.php');

$loc = $_POST['loc'];

$query = "SELECT * FROM `location` WHERE `location` = '$loc'";
$result = mysqli_query($db, $query);

if ($result) {
    $query1 = "DELETE FROM `location` WHERE `location` = '$loc'";
    $result1 = mysqli_query($db, $query1);

    if ($result1) {
        echo (" <script>Materialize.toast('Successfully Deleted', 4000, 'rounded');</script>");
    } 
}
 