<?php

session_start();
$errors = array();
include('connect.php');

$idno = $_POST['idno'];


$query2="SELECT * FROM user WHERE `userID` = '$idno' AND `active` = '1'";

$result2= mysqli_query($db, $query2);

if($result2)
{
    if (mysqli_num_rows($result2) >0)
    {
        echo(" <script>alert('Employee is on dutty!! cant be deleted');</script>");
        $result=false;
    }else {
    
        $query = "SELECT * FROM user WHERE `userID` = '$idno'";
        $result = mysqli_query($db, $query);
        }
    

}




if ($result) {
    $query1 = "UPDATE user SET `deleted` = '1', `active` = '0' WHERE `userID` = '$idno'";
    $result1 = mysqli_query($db, $query1);

    if ($result1) {
        echo(" <script>alert('Successully Deleted');</script>");
    }
}

?>