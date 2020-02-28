<?php

include('connect.php');

$passW = $_POST['passW'];
$passW1 = $_POST['passW1'];
$id = $_POST['id'];

$errors = array();

if (empty($passW) || (strlen($passW) != 8)) {
    array_push($errors, "passsword must contain 8 characters");
} else {
    $passW = strip_tags($passW);
    $passW = $db->real_escape_string($passW);
}

if (empty($passW1) || (strlen($passW1) != 8)) {
    array_push($errors, "Confirmation passsword must contain 8 characters");
} else {
    $passW1 = strip_tags($passW1);
    $passW1 = $db->real_escape_string($passW1);
}

if (!preg_match("#[0-9]+#", $passW)) {

    array_push($errors, "Password must include at least one number! ");
}

if (strcspn($passW, '') != strlen($passW)) {

    array_push($errors, "Password must include at least one letter! ");
}

if (!preg_match("#[A-Z]+#", $passW)) {

    array_push($errors, "Password must include at least one CAPS! ");
}

if (!preg_match("#\W+#", $passW)) {

    array_push($errors, "Password must include at least one symbol! ");
}

if ($passW1 != $passW) {
    array_push($errors, "password does not match");
}else {
    $passW = md5($passW);
}

if (count($errors) == 0 ){
    $query = "UPDATE student SET `passW` = '$passW' WHERE `studentID` = '$id'";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo("<script>window.location.replace('login.php');</script>");
    }else {
        echo('Please Try again');
    }
}


include('errors.php');

?>