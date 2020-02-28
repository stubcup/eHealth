<?php

Include('connect.php');

$typeOfSam = $_POST['typeOfSam'];

//Sammury Type

if ($typeOfSam == 1) {
    //All
    $query = "SELECT * FROM booking";
    $type = "All Time";

    $date = "Last Record";
}elseif ($typeOfSam == 2) {
    //Week
    $today = date('d-M-Y');
    $date = date('d-M-Y', strtotime($today. '-7 days'));

    $query = "SELECT * FROM booking WHERE `book_date` >= '$date'";
    $type = "Week Sammury";
}elseif ($typeOfSam == 3) {
    //Month
    $today = date('d-M-Y');
    $date = date('d-M-Y', strtotime($today. '-29 days'));

    $query = "SELECT * FROM booking WHERE `book_date` >= '$date'";
    $type = "1 Month Sammury";
}elseif ($typeOfSam == 4) {
    //3 months
    $today = date('d-M-Y');
    $date = date('d-M-Y', strtotime($today. '-90 days'));

    $query = "SELECT * FROM booking WHERE `book_date` >= '$date'";
    $type = "3 Months";
}

$result = mysqli_query($db, $query);

if ($result) {

    //No Of Bookings

    $totBooks = mysqli_num_rows($result);
    $totSuccBook = 0;
    $totCancelBook = 0;
    $totNoBook = 0;
   

    while($row = mysqli_fetch_array($result)) {
        
        //No Successfull
        if ($row['book_status'] == 1) {
            $totSuccBook += 1;
        }elseif ($row['book_status'] == 2) {
            //No of Staff Members Not Registered
            $totCancelBook += 1;
        }else {
            $totNoBook += 1;
        }
    }
}

echo('<script>$("#show").html("Bookings Sammury")</script>');
?>
<h5>Bookings Report</h5>
<div class="divider"></div>
<p><i class="grey-text"><?php echo($type. " From ". $date) ?></i></p>

<!--Bookings-->
<h5><span class="blue-text"><b><?php echo(round($totBooks/$totBooks * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4 wow slideInLeft" style="height: 15px;" data-wow-delay="2s">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totBooks/$totBooks * 100, 2)) ?>%;"></div>
</div>
<p>Todal Bookings: <?php echo($totBooks) ?> </p><br>

<!--No Of Succefull-->
<h5><span class="blue-text"><b><?php echo(round($totSuccBook/$totBooks * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4 wow slideInLeft" style="height: 15px;" data-wow-delay="4s">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totSuccBook/$totBooks * 100, 2)) ?>%;"></div>
</div>
<p>Successful Bookings: <?php echo($totSuccBook) ?></p><br>

<!--No Unsuccessful-->
<h5><span class="blue-text"><b><?php echo(round($totNoBook/$totBooks * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4 wow slideInLeft" style="height: 15px;" data-wow-delay="6s">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totNoBook/$totBooks * 100, 2)) ?>%;"></div>
</div>
<p>Unsuccessful Bookings: <?php echo($totNoBook) ?></p><br>

<!--No Of Cancelled-->
<h5><span class="blue-text"><b><?php echo(round($totCancelBook/$totBooks * 100)) ?>%</b></span></h5>
<div class="progress blue lighten-4 wow slideInLeft" style="height: 15px;" data-wow-delay="8s">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totCancelBook/$totBooks * 100)) ?>%;"></div>
</div>
<p>Cancelled Bookings: <?php echo($totCancelBook) ?></p><br>


<p></p>
<p></p>

