<?php
session_start();
$errors = array();
include('connect.php');

$userID = rand(000000000,999999999);
$idno = $_POST['idno'];
$sname = $_POST['surname'];
$name = $_POST['name'];
$role = $_POST['role'];

if (empty($idno) || (strlen($idno) != 13)) {
    array_push($errors, "Please Enter a vaild ID Number, ID Number ca only be 13 digits!");
}else  {
    $idno = strip_tags($idno);
    $idno = $db->real_escape_string($idno);

    $query = "SELECT * FROM stuff WHERE `stuffIDNo` = '$idno'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Admin Already Registered");
        }
    }

}

if (empty($name) || is_numeric($name)) {
    array_push($errors, "Please Enter Valid Name");
}else {
    $name = strip_tags($name);
    $name = $db->real_escape_string($name);
    $name = strtoupper($name);
}

if (empty($sname) || is_numeric($sname)) {
    array_push($errors, "Please Enter Valid Surname");
}else  {
    $sname = strip_tags($sname);
    $sname = $db->real_escape_string($sname);
    $sname = strtoupper($sname);
}

if (empty($role)) {
    array_push($errors, "Please Select Admin Role");
}else  {
    $role = strip_tags($role);
    $role = $db->real_escape_string($role);
}

if (count($errors) == 0) {

    $search_q = "SELECT * FROM user WHERE `userID` = '$userID'";
    $search_r = mysqli_query($db, $search_q);

    if (mysqli_num_rows($search_r) > 0 ) {
        $userID = rand(000000000, 999999999);
    }

    $query = "INSERT INTO user (`userID`, `IDNo`,`sname`,`name`,`role`) VALUES ('$userID','$idno','$sname','$name','$role')";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo (" <script>alert('Successfully Registered', 4000, 'rounded');</script>");
        echo ("<script>$('#adm_mod').modal('close');</script>");
    }
}




include('errors.php');


?>