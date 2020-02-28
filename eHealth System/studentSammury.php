<?php


include('connect.php');
$user = 0;
$total = 0;
$not_user = 0;

$query = "SELECT * FROM user WHERE `role` = '3'";
$result = mysqli_query($db, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            if ($row['passW'] != "") {
                $user += 1;
            } else {
                $not_user += 1;
            }

            $total += 1;
        }
    }
}



?>

<div class="container" id="printable">
    <div class="row">
        <div class="col s12">
            <h1>Students Sammury</h1>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        <h4><?php echo (date('D d-m-Y H:i.s')) ?></h4>
    </div>
    <div class="row">
        <ul>
            <li>Using Bus: <?php echo ($user); ?></li>
            <li>Not using Bus: <?php echo ($not_user); ?></li>
            <li><b>Total: <?php echo ($total); ?></b></li>
            <li style="padding-top: 20px;"><button class="btn blue lighten-2 waves-effect waves-dark" id="btn_print"><i class="fa fa-print"></i></button></li>
        </ul>
    </div>
</div>

<script>
    $('#btn_print').click(function (e) { 
        e.preventDefault();
        var mode = 'iframe';
        var close=mode=="popup";
        var options = {mode: mode, popClose: close};

        $('#printable').printArea(options);
    });
</script>