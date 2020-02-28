<?php

session_start();
$errors = array();
include 'connect.php';

$idno = $_POST['idno'];
$result = false;

$query2 = "SELECT * FROM administrator WHERE `adminID` = '$idno'";
$result2 = mysqli_query($db, $query2);

if ($result2) {
    while ($row = mysqli_fetch_array($result2)) {
        if ($row['active'] == '1') {
            echo " <script>alert('Employee is on dutty!! cant be deleted');</script>";
        } else {
            $query = "SELECT * FROM administrator WHERE `adminID` = '$idno'";
            $result = mysqli_query($db, $query);
        }
    }
}

if ($result) {
    $query1 = "UPDATE administrator SET `deleted` = '1', `active` = '0' WHERE `adminID` = '$idno'";
    $result1 = mysqli_query($db, $query1);

    if ($result1) {
        echo " <script>alert('Successully Deleted');</script>";
    }
}

$result4 = false;
$query3 = "SELECT * FROM driver WHERE `driverID` = '$idno'";
$result3 = mysqli_query($db, $query3);

if ($result3) {
    while ($row = mysqli_fetch_array($result3)) {
        if ($row['active'] == '1') {
            echo " <script>alert('Driver is on dutty!! cant be deleted');</script>";
        } else {
            $query = "SELECT * FROM driver WHERE `driverID` = '$idno'";
            $result4 = mysqli_query($db, $query);
        }
    }
}

if ($result4) {
    $query5 = "UPDATE driver SET `deleted` = '1', `active` = '0' WHERE `driverID` = '$idno'";
    $result5 = mysqli_query($db, $query5);

    if ($result5) {
        echo " <script>alert('Successully Deleted');</script>";
    }
}
