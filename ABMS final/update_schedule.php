<?php

include('connect.php');

$driver = $_POST['driver'];
$bus = $_POST['bus'];
$id = $_POST['id'];


$update_driver = $_POST['update_driver'];
$update_bus = $_POST['update_bus'];

if (empty($update_driver) || empty($update_bus)) {
    echo("<script>alert('Can not Update due to Empty Field(s)');</script>");
    exit;
}

$query = "SELECT * FROM schedule WHERE `scheduleID` = '$id'";
$result = mysqli_query($db, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $query2 = "UPDATE schedule SET `bus` = '$update_bus', `driver` = '$update_driver' WHERE `scheduleID` = '$id'";
        $result2 = mysqli_query($db, $query2);

        if ($result2) {
            echo ("<script>alert('Successfully Updated');</script>");
            ?>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "mod/all_schedules.php",
            success: function(response) {
                $('#table_content').html(response);
            }
        });
    });
</script>
<?php

}
}
}


?> 