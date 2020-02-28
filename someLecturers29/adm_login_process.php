<?php
session_start();
include('connect.php');
$errors = array();

$idNo = $_POST['idno'];
$passW = $_POST['passW'];
$admin="000000000";
$driv="000000000";

$query = "SELECT * FROM administrator WHERE `adminID` = '$idNo'";
$result = mysqli_query($db,$query);

$query2 = "SELECT * FROM driver WHERE `driverID` = '$idNo'";
$result2 = mysqli_query($db,$query2);

if ($result OR $result2) {

   

    if (mysqli_num_rows($result) == 1) {
        while($row = mysqli_fetch_array($result)) {
            $admin=$row['adminID'] ;
          

        }
    }


    if (mysqli_num_rows($result2) == 1) {
        while($row2 = mysqli_fetch_array($result2)) {

            $driv=$row2['driverID'] ;
           

        }
    }
    echo( $driv);
    echo( " ".$idNo);
    

if($idNo==$driv)
{
    if (empty($idNo) || (strlen($idNo) != 9)) {
        array_push($errors, "Please Enter a Valid Staff Number");
    } else {
        $idNo = strip_tags($idNo);
        $idNo = $db->real_escape_string($idNo);
    }
    
    if (empty($passW)) {
        array_push($errors, "Please Enter Password");
    } else {
        $passW = strip_tags($passW);
        $passW = $db->real_escape_string($passW);
        $passW = md5($passW);
    }

}elseif ($idNo== $admin) {
    if (empty($idNo) || (strlen($idNo) != 9)) {
        array_push($errors, "Please Enter a Valid Staff Number");
    } else {
        $idNo = strip_tags($idNo);
        $idNo = $db->real_escape_string($idNo);
    }
    
    if (empty($passW)) {
        array_push($errors, "Please Enter Password");
    } else {
        $passW = strip_tags($passW);
        $passW = $db->real_escape_string($passW);
        $passW = md5($passW);
    }
    
}
else{
    array_push($errors, "staff Number do not exist, try Again..");


}
}

///


if (count($errors) == 0) {

    $query = "SELECT * FROM administrator WHERE `adminID` = '$idNo' AND `passW` = '$passW'";
    $result = mysqli_query($db, $query);

    
    if ($result) {

        
        if (mysqli_num_rows($result) == 1 OR (mysqli_num_rows($result2) == 1) )
        {

            while ($row = mysqli_fetch_array($result)) {
                $role = $row['role'];

                $active_q = "UPDATE administrator SET `active` = '1' WHERE `adminID` = '$idNo'";
                $active_r = mysqli_query($db, $active_q);

                if ($active_r) {
                    if ($role == 1) {
                        $_SESSION['adminID'] = $idNo;
                        echo ('<script>window.location.assign("admin_dashboard.php");</script>');
                    }
                }else {
                    echo('Something went wrong, Please retry');
                }
            }
        }
        
    } 
    
            $query2 = "SELECT * FROM driver WHERE `driverID` = '$idNo' AND `passW` = '$passW'";
            $result2 = mysqli_query($db, $query2);
        
            if ($result2) {
                while ($row2 = mysqli_fetch_array($result2)) {
                $role1 = $row2['role'];

                $active_2 = "UPDATE driver SET `active` = '1' WHERE `driverID` = '$idNo'";
                $active_2 = mysqli_query($db, $active_2);

                if ($active_2) {
                    if ($role1 == 2) {
                        $_SESSION['driverID'] = $idNo;
                        echo ('<script>window.location.assign("mod/verify.php");</script>');
                    }
                }else {
                    echo('Something went wrong, Please retry');
                }
            }

            } else {
            array_push($errors, "Incorrect Password");
            }
    }


include('errors.php');
 