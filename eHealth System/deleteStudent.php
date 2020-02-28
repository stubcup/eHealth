<?php

include('connect.php');

$stdNo = $_POST['id'];


$query = "SELECT * FROM user WHERE `userID` = '$stdNo'";
$result = mysqli_query($db, $query);

/*$queryB = "SELECT * FROM student WHERE `stdNo` = '$stdNo'";
$resultB = mysqli_query($db, $queryB);*/

if ($result)
 {

    $query1 = "DELETE FROM user WHERE `userID` = '$stdNo'";
    $result1 = mysqli_query($db, $query1);
    
    /*$query1B = "DELETE FROM student WHERE `stdNo` = '$stdNo'";
    $result1B = mysqli_query($db, $query1B);*/

    if ($result1) 
    {
        echo(" <script>alert('Successully Deleted');</script>");
        
    }
}    

?>


<script>
    function students() {
        $.ajax({
            type: "post",
            url: "students.php",
            data: "data",
            success: function(response) {
                $('#content').html(response);
            }
        });
    }

    students();
</script>
