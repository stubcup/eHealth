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
                    <li><a id="students_btn">Students</a></li>
                    <li><a id="staff_btn">staff Member</a></li>
                    <li><a id="bus_btn">Buses</a></li>
                    <li><a id="loc_btn">Locations</a></li>
                    <li><a id="schedules_btn">Schedules</a></li>
                    <li><a href="reports.php">Reports</a></li>
                    <li><a id="btn_prof"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="logout_adm.php"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container">
            <h4 id="admin"><?php echo ($userName); ?></h4>
            <h6 class="grey-text"><i><?php echo ($d_id); ?></i></h6>
            <div class="divider"></div>
            <br>
            <!--staff Nav-->
            <nav class="grey darken-4" id="staff_nav" style="border-bottom: #08acea medium solid; border-top: #08acea medium solid;">
                <div class="container-fluid">
                    <div class="nav-wrapper">
                        <ul id="nav-mobile" class="hide-on-med-and-down">
                            <li><a id="new_staff_btn">Register New staff Member</a></li>
                            <li><a id="v_staff_duty_btn">View staff On Duty</a></li>
                            <li><a id="v_staff_btn">View All staff</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!--Bus Nav-->
            <nav class="grey darken-4" id="bus_nav" style="border-bottom: #08acea medium solid; border-top: #08acea medium solid;">
                <div class="container-fluid">
                    <div class="nav-wrapper">
                        <ul id="nav-mobile" class="hide-on-med-and-down">
                            <li><a id="new_bus_btn">Register New Bus</a></li>
                            <li><a id="v_bus_duty_btn">View Buses On Duty</a></li>
                            <li><a id="v_bus_btn">View All Buses</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!--Location Nav-->
            <nav class="grey darken-4" id="loc_nav" style="border-bottom: #08acea medium solid; border-top: #08acea medium solid;">
                <div class="container-fluid">
                    <div class="nav-wrapper">
                        <ul id="nav-mobile" class="hide-on-med-and-down">
                            <li><a id="new_loc_btn">Register New Location</a></li>
                            <li><a id="v_loc_btn">View All Location</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!--Bus Schedules-->
            <nav class="grey darken-4" id="schedule_nav" style="border-bottom: #08acea medium solid; border-top: #08acea medium solid;">
                <div class="container-fluid">
                    <div class="nav-wrapper">
                        <ul id="" class="hide-on-med-and-down">
                            <li><a id="new_schedule_btn">Planner</a></li>
                            <li><a href="v_schedules.php">Schedules</a></li>
                            <li><a id="notify_btn">Notify</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <span id="content"></span>
        </div>
    </div>



    <!-- Scripts -->
    <script type="text/javascript" src="script/jquery.min.js"></script>
    <script type="text/javascript" src="script/materialize.min.js"></script>
    <script type="text/javascript" src="script/jquery.PrintArea.js"></script>

    <script>
        //Hide Nav Bars
        $('#staff_nav').slideUp();
        $('#bus_nav').slideUp();
        $('#loc_nav').slideUp();
        $('#schedule_nav').slideUp();
        $(document).ready(function() {

            $.ajax({
                type: "post",
                url: "admAbout.html",
                success: function (response) {
                    $('#content').html(response);
                }
            });

            //Init Modal
            $('.modal').modal();

            //Init Dropdown
            $('.dropdown-trigger').dropdown({
                alignment: 'left',
            });

            //Show staff Nav
            $('#staff_btn').click(function() {
                $('#staff_nav').slideDown();
                $('#bus_nav').slideUp();
                $('#loc_nav').slideUp();
                $('#schedule_nav').slideUp();
                $('#content').html('');
            });

            //Show Bus Nav
            $('#bus_btn').click(function() {
                $('#staff_nav').slideUp();
                $('#bus_nav').slideDown();
                $('#loc_nav').slideUp();
                $('#schedule_nav').slideUp();
                $('#content').html('');
            });

            //Show Location Nav
            $('#loc_btn').click(function() {
                $('#staff_nav').slideUp();
                $('#bus_nav').slideUp();
                $('#loc_nav').slideDown();
                $('#schedule_nav').slideUp();
                $('#content').html('');
            });

            //Show Schedules Nav
            $('#schedules_btn').click(function() {
                $('#staff_nav').slideUp();
                $('#bus_nav').slideUp();
                $('#loc_nav').slideUp();
                $('#schedule_nav').slideDown();
                $('#content').html('');
            });

            $('#students_btn').click(function() {
                $('#staff_nav').slideUp();
                $('#bus_nav').slideUp();
                $('#loc_nav').slideUp();
                $('#schedule_nav').slideUp();
                $('#content').html('');

                $.ajax({
                    type: "post",
                    url: "students.php",
                    data: "data",
                    success: function(response) {
                        $('#content').html(response);
                    }
                });
            });

            //________Secondary Nav_________________

            //staff
            $('#new_staff_btn').click(function() {
                $.ajax({
                    url: "mod/regStaff.html",
                    success: function(response) {
                        $('#mod_content').html(response);
                        $('#adm_mod').modal('open');
                    }
                });
            });

            $('#v_staff_duty_btn').click(function(e) {

                $.ajax({
                    url: "mod/duty_admin.php",
                    success: function(response) {
                        $('#content').html(response);
                    }
                });

                $.ajax({
                    url: "mod/onDuty_staff.php",
                    success: function(response) {
                        $('#content').html(response);
                    }
                });

            });

            $('#v_staff_btn').click(function() {
                $.ajax({
                    url: "mod/all_staff.php",
                    success: function(response) {
                        $('#content').html(response);
                    }
                });
            });

            //Bus
            $('#new_bus_btn').click(function() {
                $.ajax({
                    url: "mod/regBus.html",
                    success: function(response) {
                        $('#mod_content').html(response);
                        $('#adm_mod').modal('open');
                    }
                });
            });

            $('#v_bus_duty_btn').click(function() {
                $.ajax({
                    url: "mod/onDuty_bus.php",
                    success: function(response) {
                        $('#content').html(response);
                    }
                });
            });

            $('#v_bus_btn').click(function() {
                $.ajax({
                    url: "mod/all_bus.php",
                    success: function(response) {
                        $('#content').html(response);
                    }
                });
            });

            //Location
            $('#new_loc_btn').click(function() {

                $.ajax({
                    url: "mod/regLoc.html",
                    success: function(response) {
                        $('#mod_content').html(response);
                        $('#adm_mod').modal('open');
                    }
                });
            });



            $('#v_loc_btn').click(function() {
                $.ajax({
                    url: "mod/all_loc.php",
                    success: function(response) {
                        $('#content').html(response);
                    }
                });
            });


            //Schedule
            $('#new_schedule_btn').click(function() {
                $('#btn-date').slideDown();
                $.ajax({
                    url: "schedules.php",
                    success: function(response) {
                        $('#content').html(response);
                    }
                });
            });

            $('#notify_btn').click(function() {
                $.ajax({
                    url: "mod/newNotice.php",
                    success: function(response) {
                        $('#content').html(response);
                    }
                });
            });


            //Profile
            function v_profile(userID) {
                $.ajax({
                    type: "post",
                    url: "user_profile.php",
                    data: {
                        userID: userID
                    },
                    success: function(response) {
                        $('.modal').modal('open');
                        $('#mod_content').html(response);
                    }
                });
            };

            $('#btn_prof').click(function (e) { 
                e.preventDefault();
                
                v_profile('<?php echo($userID) ?>');
            });

            //=========================================

            //Reset

            function reset() {
                $.ajax({
                    type: "post",
                    url: "reset.php",
                    success: function(response) {
                        $('#content').html(response);
                    }
                });

            }
            setInterval(() => {
                var d = new Date();

                if (d.getHours() >= 21) {
                    reset();
                }
            }, 1000);

        });
    </script>

</body>



</html>