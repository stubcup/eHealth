<?php
session_start();
$errors = array();
include('connect.php');

$regNo = $_POST['regNo'];
$occupance = $_POST['occupance'];

if (empty($regNo) || (strlen($regNo) < 4)) {
    array_push($errors, "Please Enter a vaild Registration Number!");
} else {
    $regNo = strip_tags($regNo);
    $regNo = $db->real_escape_string($regNo);

    $regNo = strtoupper($regNo);

    $query = "SELECT * FROM bus WHERE `regNo` = '$regNo'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Buss Already Registered");
        }
    }
}

if (empty($occupance) || !is_numeric($occupance)) {
    array_push($errors, "Please Enter Valid Name");
} else {
    $occupance = strip_tags($occupance);
    $occupance = $db->real_escape_string($occupance);
}

if (count($errors) == 0) {
    $query = "INSERT INTO bus (`regNo`,`occupance`) VALUES ('$regNo','$occupance')";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo (" <script>alert('Successfully Registered', 4000, 'rounded');</script>");
        echo ("<script>$('#adm_mod').modal('close');</script>");
    }
}




include('errors.php');
 