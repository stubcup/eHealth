<?php

include('connect.php');
$errors = array();

$to = $_POST['to'];
$message = $_POST['message'];
$date = date('Y-m-d H:m:s');

if (empty($message)) {
    array_push($errors, "Please Enter Message");
}else {
    $message = strip_tags($message);
    $message = $db->real_escape_string($message);
}

if (count($errors) ==0) {
    $query = "INSERT INTO notice (`notice_to`, `notice`,`time`) VALUES ('$to', '$message', '$date')";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo("<script>alert('Message send');</script>");
    }
}

include('errors.php');

?>