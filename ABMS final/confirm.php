<?php

$idno =$_REQUEST['idno'];
$email = $_REQUEST['email'];
$cell = $_REQUEST['cell'];
$passW = $_REQUEST['passW'];


//student
$search_q = "SELECT * FROM student WHERE `studentID`= '$idno'";
$search_r = mysqli_query($db, $search_q);

while ($row2 = mysqli_fetch_array($search_r))
{
$study=$row2['role'];
}


if($study==3)
{
    $query = "UPDATE `student` SET `email` = '$email',`cell` = '$cell',`passW` = '$passW' WHERE `studentID` = '$idno'";
    $result = mysqli_query($db, $query);

    if ($result) {
    $_SESSION["studentID"] = $idno;
    echo ('<script>$window.location.assign("index.php"); alert("Congradulations, Account Successfully Created");</script>');
    } 
}
?>