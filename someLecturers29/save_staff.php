<?php
session_start();
$errors = array();
include('connect.php');



$userID = rand(000000000,999999999);
$idno = $_POST['idno'];
$sname = $_POST['surname'];
$name = $_POST['name'];
$role = $_POST['role'];
$comp="";
$comp2="";
if (empty($idno) || (strlen($idno) != 13)) {
    array_push($errors, "Please Enter a vaild ID Number, ID Number ca only be 13 digits!");
}else  {
    $idno = strip_tags($idno);
    $idno = $db->real_escape_string($idno);

    $query = "SELECT * FROM stuff WHERE `stuffIDNo` = '$idno'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Stuff Member Already Registered");
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
    array_push($errors, "Please Select Role");
}else  {
    $role = strip_tags($role);
    $role = $db->real_escape_string($role);
}

if (count($errors) == 0) {
//add driver
    if($role==2)
    {
    $search_q = "SELECT * FROM driver ";
    $search_r = mysqli_query($db, $search_q);

    while ($row = mysqli_fetch_array($search_r))
    {
        $userID = rand(000000000, 999999999);
        $comp=$row['IDNo'];
    }
        

    if($comp!=$idno)
    {
    $query = "INSERT INTO driver (`driverID`, `IDNo`,`sname`,`name`,`role`) VALUES ('$userID','$idno','$sname','$name','$role')";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo (" <script>alert('Successfully Registered', 4000, 'rounded');</script>");
        echo ("<script>$('#adm_mod').modal('close');</script>");
    }

    }else{
        echo (" <script>alert('Driver already exist', 4000, 'rounded');</script>");
    }
    

    }

    //add admin
    
    if($role==1)
    {
    //if($_SESSION['adminID']==)
    
    $search_q = "SELECT * FROM administrator";
    $search_r = mysqli_query($db, $search_q);
    while ($row2 = mysqli_fetch_array($search_r))
    {
        $userID = rand(000000000, 999999999);
        $comp2=$row2['IDNo'];
    }
  

                
                    
    if( $comp2!=$idno)
    {
    $query = "INSERT INTO administrator (`adminID`, `IDNo`,`sname`,`name`,`role`) VALUES ('$userID','$idno','$sname','$name','$role')";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo (" <script>alert('Successfully Registered', 4000, 'rounded');</script>");
        echo ("<script>$('#adm_mod').modal('close');</script>");
    }

    }else{
        echo (" <script>alert('administrator already exist', 4000, 'rounded');</script>");
    }
    
    

}
    
    
}




include('errors.php');


?>