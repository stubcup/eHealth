<?php

Include('connect.php');

$typeOfSam = $_POST['typeOfSam'];



//Sammury Type

$busQuery = "SELECT * FROM bus";
$busResult = mysqli_query($db, $busQuery);


if ($busResult) {

    //Buses Total
    $totBus = mysqli_num_rows($busResult);?>

    <h5>Buses Report</h5>
    <div class="divider"></div>

    <!--Total-->
    <p>Total Number of Buses: <?php echo($totBus) ?> </p><br>

    <?php while($busRow = mysqli_fetch_array($busResult)) {
        
        $bus = $busRow['regNo'];

    if ($typeOfSam == 1) {
        //All
        $query = "Select * FROM schedule WHERE `bus` = '$bus'";
        $type = "All Time";
        $date = "Last Record";
        echo('<p><i class="grey-text"><?php echo($type. " From ". $date) ?></i></p>');
    }elseif ($typeOfSam == 2) {
        //Week
        $today = date('d-M-Y');
        $date = date('d-M-Y', strtotime($today. '-7 days'));

        $query = "Select * FROM schedule WHERE `bus` = '$bus', `schedule_date` >= '$date'";
        $type = "Week Sammury";
        echo('<p><i class="grey-text"><?php echo($type. " From ". $date) ?></i></p>');
    }elseif ($typeOfSam == 3) {
        //Month
        $today = date('d-M-Y');
        $date = date('d-M-Y', strtotime($today. '-29 days'));

        $query = "Select * FROM schedule WHERE `bus` = '$bus', `schedule_date` >= '$date'";
        $type = "1 Month Sammury";
        echo('<p><i class="grey-text"><?php echo($type. " From ". $date) ?></i></p>');
    }elseif ($typeOfSam == 4) {
        //3 months
        $today = date('d-M-Y');
        $date = date('d-M-Y', strtotime($today. '-90 days'));

        $query = "Select * FROM schedule WHERE `bus` = '$bus', `schedule_date` >= '$date'";
        $type = "3 Months";
        echo('<p><i class="grey-text"><?php echo($type. " From ". $date) ?></i></p>');
    }

    $result = mysqli_query($db, $query);


    if ($result) {

        $totSchedules = mysqli_num_rows($result);
  

        while($row = mysqli_fetch_array($result)) {
            
            
        }
    }
    echo('<script>$("#show").html("Buses Sammury")</script>');
    ?>
    
    <!--Schedules-->
    <h5><span class="blue-text"><b><?php echo(round($totSchedules/$totBus * 100, 2)) ?>% of Schedules</b></span></h5>
    <div class="progress blue lighten-4" style="height: 15px;">
        <div class="determinate blue lighten-2" style="width: <?php echo(round($totSchedules/$totBus * 100, 2)) ?>%;"></div>
    </div>
    <p>Bus: <?php echo($bus. " ". $totSchedules) ?> </p><br>


<?php
    }
}
?>

