<?php
session_start();
$errors = array();
include('connect.php');

$loc = $_POST['loc'];

if (empty($loc) || (strlen($loc) < 2)) {
    array_push($errors, "Please Enter a vaild Location!");
} else {
    $loc = strip_tags($loc);
    $loc = $db->real_escape_string($loc);

    $loc = ucwords($loc);

    $query = "SELECT * FROM `location` WHERE `location` = '$loc'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            array_push($errors, "Location Already Registered");
        }
    }
}

if (count($errors) == 0) {
    $query = "INSERT INTO `location` (`location`) VALUES ('$loc')";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo (" <script>alert('Successfully Registered', 4000, 'rounded');</script>");
        echo ("<script>$('#adm_mod').modal('close');</script>");
        ?>
<script>
    $.ajax({
        url: "mod/all_loc.php",
        success: function(response) {
            $('#content').html(response);
        }
    });
</script>

<?php

}
}




include('errors.php');

?> 