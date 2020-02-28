<?php

session_start();
include '../connect.php';

$time = $_POST['time'];
$bus = $_POST['bus'];
$qrdata = $_POST['qrdata'];
$stNO = '';

if ($time == ' ') {
    $time = '00:00';
}

if ($bus == ' ') {
    $bus = 'none';
}

$query = "SELECT * FROM booking WHERE `qr` = '$qrdata' AND `book_status`'0'";
$result = mysqli_query($db, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        //Confirm QR Code

        while ($row = mysqli_fetch_array($result)) {
            if (mysqli_num_rows($result) > 0) {
                $path = '../images/';
                $filename = $row['book_date'].$row['time'].$row['bus'].$row['stdNo'].'.png';
                $stdNo = $row['stdNo'];
                if (file_exists($path.$filename)) {
                    unlink($path.$filename);
                }
            }

            $query1 = "UPDATE booking SET `book_status` = '1' WHERE `qr` = '$qrdata'";
            $result1 = mysqli_query($db, $query1);

            if ($result1) {
                echo " <script>
                $('#modal1').modal('open');
                </script>";

                echo 'next...';
            }
        }
    }
} else {
    echo 'QR Code Does Not Exist';
}

?>

