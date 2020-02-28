<?php
 $db = mysqli_connect('localhost', 'root', '', 'db_ambs');

 if (!$db) {
    unset($_SESSION['userID']);
   echo ('<script>window.location.assign("error.php");</script>');
 }
?>