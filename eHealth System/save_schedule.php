<?php


session_start();
$errors = array();
include('connect.php');

$time_v = "";
$bus_v = "";
$driver_v = "";
$from_v = "";
$to_v = "";

$time = $_POST['id'];
$date = $_POST['dater'];
$bus = $_POST['bus'];
$driver = $_POST['driver'];
$from = $_POST['loc'];
$to = $_POST['loc2'];


$query = "SELECT * FROM schedule";
$result = mysqli_query($db, $query);
if (empty($from) || empty($to) || empty($driver) || empty($time) || empty($bus)) {
    array_push($errors, 'all fileds should be filled');
} else {
    if (empty($from) || empty($to)) {
        array_push($errors, 'Please Select Both Departure and Destination');
    } elseif ($from == $to) {
        array_push($errors, 'Your Departure and Destination can not be the same');
    }
    while ($row = mysqli_fetch_array($result)) {
        $date_v = $row['schedule_date'];
        $time_v = $row['time'];
        $bus_v = $row['bus'];
        $driver_v = $row['driver'];
        $from_v = $row['from'];
        $to_v = $row['to'];


        if ($time_v == $time && $date_v == $date && $bus_v == $bus && $driver_v == $driver && $from_v == $from && $to == $to) {
            array_push($errors, 'Trip Already Scheduled for today');
        } elseif ($time_v == $time && $date_v == $date && $bus_v == $bus) {
            array_push($errors, 'Bus Can not be Scheduled twice in an Hour');
        } elseif ($time_v == $time && $date_v == $date && $driver_v == $driver) {
            array_push($errors, 'Driver Can not be Scheduled twice in an Hour');
        } elseif ($time_v != $time && $date_v == $date  && $bus_v == $bus && $from_v == $from && $to_v == $to) {
            array_push($errors, 'Bus Can not be Scheduled same trip in consecutive hours');
        } elseif ($time_v == $time && $date_v == $date && $bus_v == $bus && $from_v == $from && $to_v == $to) {
            array_push($errors, 'Trip Already Scheduled');
        } elseif (($time_v + 1 == $time || $time_v - 1 == $time) && $date_v == $date && $bus_v == $bus && $from_v == $from) {
            array_push($errors, 'Bus Can not be Scheduled same trip in consecutive hours');
        }
    }
}



if (count($errors) == 0) {

    $query3 = "SELECT * FROM bus WHERE `regNo` = '$bus'";
    $result3 = mysqli_query($db, $query3);

    while ($row3 = mysqli_fetch_array($result3)) {
        $occupance = $row3['occupance'];
    }

    $query = "INSERT INTO schedule (`time`, `schedule_date`,`bus`,`driver`,`from`,`to`, `occupance`) VALUES ('$time', '$date','$bus','$driver','$from','$to', '$occupance')";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo ("<script>$('#adm_mod').modal('close');</script>");

        $query1 = "UPDATE bus SET `onDuty` = '1' WHERE `regNo` = '$bus'";
        $result1 = mysqli_query($db, $query1);

        $query2 = "UPDATE user SET `active` = '1' WHERE `userID` = '$driver'";
        $result2 = mysqli_query($db, $query2);
        ?>
<script>
    $(document).ready(function() {
        var dater = $('#dater').val();

        $.ajax({
            type: "post",
            url: "mod/all_schedules.php",
            data: {
                dater: dater
            },
            success: function(response) {
                $('#table_content').html(response);
            }
        });
    });
</script>

<?php

}
}

include('errors.php');

?> 