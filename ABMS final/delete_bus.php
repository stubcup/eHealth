<?php

session_start();
$errors = array();
include('connect.php');

$regNo = $_POST['regNo'];



$query2="SELECT * FROM bus WHERE `regNo` = '$regNo' AND `onDuty` = '1'";
$result2= mysqli_query($db, $query2);

if($result2)
{
    if (mysqli_num_rows($result2) >0)
    {
        echo (" <script>Alert('bus is on duty!! cant be deleted');</script>");
        
    }else {
        $query = "SELECT * FROM bus WHERE `regNo` = '$regNo'";
        $result = mysqli_query($db, $query);

        if ($result) {

            $query1 = "UPDATE bus SET `deleted` = '1' WHERE `regNo` = '$regNo'";
            $result1 = mysqli_query($db, $query1);
        
            if ($result1) {
                echo (" <script>Alert('Successfully Deleted');</script>");
            } 
        } 
    
    }
    
}

    



 