<?php

Include('connect.php');

$typeOfSam = $_POST['typeOfSam'];

//Sammury Type

if ($typeOfSam == 1) {
    //All
    $query = "Select * FROM administrator UNION SELECT * FROM driver";
    $type = "All Time";

    $date = "Last Record";
}elseif ($typeOfSam == 2) {
    //Week
    $today = date('d-M-Y');
    $date = date('d-M-Y', strtotime($today. '-7 days'));

    $query = "Select * FROM administrator UNION SELECT * FROM driver WHERE `createdOn` >= '$date'";
    $type = "Week Sammury";
}elseif ($typeOfSam == 3) {
    //Month
    $today = date('d-M-Y');
    $date = date('d-M-Y', strtotime($today. '-29 days'));

    $query = "Select * FROM administrator UNION SELECT * FROM driver WHERE `createdOn` >= '$date'";
    $type = "1 Month Sammury";
}elseif ($typeOfSam == 4) {
    //3 months
    $today = date('d-M-Y');
    $date = date('d-M-Y', strtotime($today. '-90 days'));

    $query = "Select * FROM administrator UNION SELECT * FROM driver WHERE `createdOn` >= '$date'";
    $type = "3 Months";
}

$result = mysqli_query($db, $query);

//Get Gender
function getGender($identity)
{
    $gender = (int)substr($identity, 6, 1);

    return ($gender >= 0 && $gender <= 4) ? 'Female' : 'Male';
}


if ($result) {


    //No Of Staff Members

    $totStaff = mysqli_num_rows($result);
    $totStaffBus = 0;
    $totStaffNoBus = 0;
    $totStaffMale = 0;
    $totStaffFmale = 0;
    $totDriver = 0;
    $totAdmin = 0;
    $totDeleted = 0;

    while($row = mysqli_fetch_array($result)) {
        
        //No of Staff Members Registered
        if (!empty($row['passW'])) {
            $totStaffBus += 1;
        }else {
            //No of Staff Members Not Registered
            $totStaffNoBus += 1;
        }

        //No Males
        if (getGender($row['IDNo']) == 'Male') {
            $totStaffMale += 1;
        }else {
            //No Females
            $totStaffFmale +=1;
        }

        //Driver
        if ($row['role'] == 2) {
            $totDriver +=1;
        }elseif ($row['role'] == 1) {
            $totAdmin +=1;
        }

        //Deleted
        if ($row['deleted'] == 1) {
            $totDeleted +=1;
        }

        
    }
}

echo('<script>$("#show").html("Staff Sammury")</script>');
?>
<h5>Staff Report</h5>
<div class="divider"></div>
<p><i class="grey-text"><?php echo($type. " From ". $date) ?></i></p>

<!--No Staff Members Registered-->
<h5><span class="blue-text"><b><?php echo(round($totStaffBus/$totStaff * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totStaffBus/$totStaff * 100, 2)) ?>%;"></div>
</div>
<p>Number of Staff Members Registered: <?php echo($totStaffBus) ?> </p><br>

<!--No Staff Members Not Registered-->
<h5><span class="blue-text"><b><?php echo(round($totStaffNoBus/$totStaff * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totStaffNoBus/$totStaff * 100, 2)) ?>%;"></div>
</div>
<p>Number of Staff Members Not Registered: <?php echo($totStaffNoBus) ?></p><br>

<!--No Male Staff Members-->
<h5><span class="blue-text"><b><?php echo(round($totStaffMale/$totStaff * 100)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totStaffMale/$totStaff * 100)) ?>%;"></div>
</div>
<p>Number of Male Staff Members: <?php echo($totStaffMale) ?></p><br>

<!--No Females Staff Members-->
<h5><span class="blue-text"><b><?php echo(round($totStaffFmale/$totStaff * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totStaffFmale/$totStaff * 100, 2)) ?>%;"></div>
</div>
<p>Number of Female Staff Members: <?php echo($totStaffFmale) ?></p><br>

<!--No Drivers-->
<h5><span class="blue-text"><b><?php echo(round($totDriver/$totStaff * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totDriver/$totStaff * 100, 2)) ?>%;"></div>
</div>
<p>Number of Drivers: <?php echo($totDriver) ?></p><br>

<!--No Admins-->
<h5><span class="blue-text"><b><?php echo(round($totAdmin/$totStaff * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totAdmin/$totStaff * 100, 2)) ?>%;"></div>
</div>
<p>Number of Administrators: <?php echo($totAdmin) ?></p><br>

<!--No Of Deleted-->
<h5><span class="blue-text"><b><?php echo(round($totDeleted/$totStaff * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totDeleted/$totStaff * 100, 2)) ?>%;"></div>
</div>
<p>Number of Deleted Staff Members: <?php echo($totDeleted) ?></p><br>


<p></p>
<p></p>

