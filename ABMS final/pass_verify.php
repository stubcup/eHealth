<?php

$errors = array();

$passW = $_POST['pass'];

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


include('errors.php');
?>