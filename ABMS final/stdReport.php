<?php

Include('connect.php');

$typeOfSam = $_POST['typeOfSam'];

//Sammury Type

if ($typeOfSam == 1) {
    //All
    $query = "Select * FROM student";
    $type = "All Time";
    $date = "Last Record";
}elseif ($typeOfSam == 2) {
    //Week
    $today = date('d-M-Y');
    $date = date('d-M-Y', strtotime($today. '-7 days'));

    $query = "Select * FROM student WHERE `createdOn` >= '$date'";
    $type = "Week Sammury";
}elseif ($typeOfSam == 3) {
    //Month
    $today = date('d-M-Y');
    $date = date('d-M-Y', strtotime($today. '-29 days'));

    $query = "Select * FROM student WHERE `createdOn` >= '$date'";
    $type = "1 Month Sammury";
}elseif ($typeOfSam == 4) {
    //3 months
    $today = date('d-M-Y');
    $date = date('d-M-Y', strtotime($today. '-90 days'));

    $query = "Select * FROM student WHERE `createdOn` >= '$date'";
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


    //No Of Students

    $totStd = mysqli_num_rows($result);
    $totStdBus = 0;
    $totStdNoBus = 0;
    $totStdMale = 0;
    $totStdFmale = 0;
    $totDeleted = 0;

    while($row = mysqli_fetch_array($result)) {
        
        //No of students using Bus
        if (!empty($row['passW'])) {
            $totStdBus += 1;
        }else {
            //No of Students Not Using
            $totStdNoBus += 1;
        }

        //No Males
        if (getGender($row['IDNo']) == 'Male') {
            $totStdMale += 1;
        }else {
            //No Females
            $totStdFmale +=1;
        }

        if ($row['deleted'] == 1) {
            $totDeleted +=1;
        }

        
    }
}
echo('<script>$("#show").html("Student Sammury")</script>');
?>
<h5>Student Report</h5>
<div class="divider"></div>
<p><i class="grey-text"><?php echo($type. " From ". $date) ?></i></p>


<!--No Students Using Bus-->
<h5><span class="blue-text"><b><?php echo(round($totStdBus/$totStd * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totStdBus/$totStd * 100, 2)) ?>%;"></div>
</div>
<p>Number of Students Using Bus: <?php echo($totStdBus) ?> </p><br>

<!--No Students Not Using Bus-->
<h5><span class="blue-text"><b><?php echo(round($totStdNoBus/$totStd * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totStdNoBus/$totStd * 100, 2)) ?>%;"></div>
</div>
<p>Number of Students Not Using Bus: <?php echo($totStdNoBus) ?></p><br>

<!--No Male Students-->
<h5><span class="blue-text"><b><?php echo(round($totStdMale/$totStd * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totStdMale/$totStd * 100, 2)) ?>%;"></div>
</div>
<p>Number of Male Students: <?php echo($totStdMale) ?></p><br>

<!--No Females Students-->
<h5><span class="blue-text"><b><?php echo(round($totStdFmale/$totStd * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totStdFmale/$totStd * 100, 2)) ?>%;"></div>
</div>
<p>Number of Female Students: <?php echo($totStdFmale) ?></p><br>

<!--No Of Deleted-->
<h5><span class="blue-text"><b><?php echo(round($totDeleted/$totStd * 100, 2)) ?>%</b></span></h5>
<div class="progress blue lighten-4" style="height: 15px;">
    <div class="determinate blue lighten-2" style="width: <?php echo(round($totDeleted/$totStd * 100, 2)) ?>%;"></div>
</div>
<p>Number of Deleted Students: <?php echo($totDeleted) ?></p><br>


<p></p>
<p></p>

