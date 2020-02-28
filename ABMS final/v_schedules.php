<?php

session_start();
include('connect.php');

if (empty($_SESSION['adminID'])) {
    header('location: adm_login.php');
} else {
    $userID = $_SESSION['adminID'];

    $query = "SELECT * FROM administrator WHERE `adminID` = '$userID'";
    $result = mysqli_query($db, $query);

    while ($row = mysqli_fetch_array($result)) {
        $userName = $row['sname'] . ' ' . $row['name'];

        $d_id = $row['adminID'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/flexboxgrid.css" />
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/Style.css">
</head>

<body>

    <!-- Modal Structure -->
    <div id="adm_mod" class="modal modal-fixed-footer valign-wrapper">
        <span id="mod_content" class="valign-wrapper" style="padding-top: 20px;"></span>
    </div>

    <nav class="blue lighten-2">
        <div class="nav-wrapper">
            <div class="container-fluid">
                <a href="admin.php" class="brand-logo">Advanced Bus Management System</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="admin_dashboard.php"><i class="fa fa-angle-double-left"></i> Back to Dashboard</a></li>
                    <li><a href="logout_adm.php"><i class="fa fa-power-off"></i> Logout</a></li>
                    <li><a href="sass.html"><i class="fa fa-exclamation"></i></a></li>
                    <li><a href="badges.html"><i class="fa fa-info-circle  "></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content" id="printable">
        <div class="container-fluid">
            <h4 id="admin"><?php echo ($userName); ?></h4>
            <h6 class="grey-text"><i><?php echo ($d_id); ?></i></h6>
            <div class="divider"></div>
            <br>

            <div class="container">
                <div class="row">
                    <div class="col s4">
                        <h5><i class="fa fa-search"></i> Search:</h5>
                    </div>
                    <div class="col s2">
                        <div class="input-field">
                            <input type="text" name="v_dater" id="v_dater" class="datepicker">
                            <label for="dater">Select Date</label>
                        </div>
                    </div>
                    <div class="col s2">
                        <div class="input-field">
                            <input type="text" name="v_bus" id="v_bus">
                            <label for="v_bus">Bus</label>
                        </div>
                    </div>
                    <div class="col s4">
                        <div class="input-field">
                            <input type="number" name="v_id" id="v_id">
                            <label for="v_id">Staff Number [Driver]</label>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn blue lighten-2 waves-effect waves-dark" id="btn_print"><i class="fa fa-print"></i></button>
            <span id="respond"></span>
        </div>
    </div>
    <!-- Scripts -->
    <script type="text/javascript" src="script/jquery.min.js"></script>
    <script type="text/javascript" src="script/materialize.min.js"></script>
    <script type="text/javascript" src="script/jquery.PrintArea.js"></script>

    <script>
        $('#btn_print').click(function(e) {
            e.preventDefault();
            var mode = 'iframe';
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };

            $('#printable, respond').printArea(options);
        });

        //Init Date picker
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });

        function v_schedules() {
            var v_dater = $('#v_dater').val();
            var v_bus = $('#v_bus').val();
            var v_id = $('#v_id').val();

            $.ajax({
                type: "post",
                url: "v_schedules_filter.php",
                data: {
                    v_dater: v_dater,
                    v_bus: v_bus,
                    v_id: v_id
                },
                success: function(response) {
                    $('#respond').html(response);
                }
            });
        }

        $('#v_dater').change(function(e) {
            e.preventDefault();
            v_schedules();
        });

        $('#v_bus').keyup(function(e) {
            v_schedules();
        });

        $('#v_id').keyup(function(e) {
            v_schedules();
        });

        v_schedules();
    </script>

</body>



</html>