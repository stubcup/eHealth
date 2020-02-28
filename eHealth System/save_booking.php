<?php


session_start();
include('connect.php');

$id = $_POST['id'];
$bus = $_POST['bus'];
$time = $_POST['time'];
$stdNo = $_SESSION['userID'];
$today = date('d-m-Y');


$query = "SELECT * FROM booking WHERE `stdNo` = '$stdNo' AND `time` = '$time' AND `bus` = '$bus'  AND `book_date` = '$today'";
$result = mysqli_query($db, $query);

$query5="SELECT * FROM booking WHERE `stdNo` = '$stdNo' AND `time` = '$time'";
$result5=mysqli_query($db, $query5);

if ($result) {


    if (mysqli_num_rows($result5) > 0) 
    {
        if(mysqli_num_rows($result) > 0)
        {
            echo ("<script>alert('You Have Already Booked This Bus');</script>");
            
        }else{
            echo ("<script>alert('ALREADY BOOKED FOR THIS TIME!');</script>");
        }
        


    } else {

        $qr_generate = rand(0000000, 9999999);
        //Generate QR Value
        while ($row = mysqli_fetch_array($result)) {

            if ($row['qr'] != $qr_generate) {
                $qr = $qr_generate;
            }
        }

        $query3 = "SELECT * FROM schedule WHERE `time` = '$time' AND `schedule_date` = '$today' AND `bus` = '$bus'";
        $result3 = mysqli_query($db, $query3);

        $query5="SELECT * FROM booking WHERE `time` = `$time`";
        $result5=mysqli_query($db, $query5);

        
        while ($row3 = mysqli_fetch_array($result3)) {
            $from = $row3['from'];
            $to = $row3['to'];
            if($result5)
            {
                echo ("<script>alert('is working');</script>"); 
            }else{
                if (mysqli_num_rows($result) <= $row3['occupance']) {
                    $query2 = "INSERT INTO booking (`stdNo`,`time`,`book_date`,`bus`,`from`,`to`,`qr`) VALUES ('$stdNo','$time','$today','$bus','$from','$to','$qr_generate')";
                    $result2 = mysqli_query($db, $query2);
                } else 
                {
                    echo ("<script>alert('Bus is fully Booked');</script>");
                }
            }
            


            if ($result2) :

                include('libs/phpqrcode/qrlib.php');
                $tempDir = 'images/';
                $filename = $today . $time . $bus . $_SESSION['userID'];
                $body =  $qr_generate;
                $codeContents = $body;
                QRcode::png($codeContents, $tempDir . '' . $filename . '.png', QR_ECLEVEL_L, 5);
                echo ("<script>alert('Successfully Booked');</script>");
                ?>


<script>
    var depart = $('#from select').val();
    var dest = $('#to select').val();
    var time = new Date();

    $.ajax({
        type: "post",
        url: "mod/avail_trips.php",
        data: {
            depart: depart,
            dest: dest,
            time: time.getHours(),
        },
        success: function(response) {
            $('#output').html(response);
        }
    });
</script>

<?php endif ?>

<?php

}
}
}
?> 