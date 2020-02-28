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

    <nav class="blue lighten-2">
        <div class="nav-wrapper">
            <div class="container-fluid">
                <a href="admin.php" class="brand-logo">Sammury Reports</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="admin_dashboard.php"><i class="fa fa-angle-double-left"></i> Back</a></li>
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
            <!--Reports Nav-->
            <nav class="grey darken-4" id="bus_nav" style="border-bottom: #08acea medium solid; border-top: #08acea medium solid;">
                <div class="container-fluid">
                    <div class="nav-wrapper">
                        <ul id="nav-mobile" class="hide-on-med-and-down">
                            <li><a id="btn_Std">Students Report</a></li>
                            <li><a id="btn_Staff">Staff Report</a></li>
                            <li><a id="btn_Book">Bookings Report</a></li>
                            <li><a id="btn_Bus">Buses Report</a></li>
                            <li class="right blue-text text-lighten-2"><span id="show"></span></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h4>
                <form action="">
                    <label>
                        <input id="typeOfSam" name="typeOfSam" type="radio" value="1" checked/>
                        <span>All</span>
                    </label>
                    <label>
                        <input id="typeOfSam" name="typeOfSam" type="radio" value="2"/>
                        <span>Week Sammury</span>
                    </label>
                    <label>
                        <input id="typeOfSam" name="typeOfSam" type="radio" value="3"/>
                        <span>1 Month Sammury</span>
                    </label>
                    <label>
                        <input id="typeOfSam" name="typeOfSam" type="radio" value="4"/>
                        <span>3 Months Samury</span>
                    </label>
                    <button class="btn blue lighten-2 waves-effect waves-dark eound-btn right" id="btn_print">Print Data</button>
                </form>
            </h4>

            <span id="content"></span>
        </div>
    </div>



    <!-- Scripts -->
    <script type="text/javascript" src="script/jquery.min.js"></script>
    <script type="text/javascript" src="script/materialize.min.js"></script>
    <script type="text/javascript" src="script/jquery.PrintArea.js"></script>

    <script>
        $(document).ready(function() {


            //Init Modal
            $('.modal').modal();

            //Students
            function stdSammury() { 
                var typeOfSam = $("input[name='typeOfSam']:checked").val();

                $.ajax({
                    type: "post",
                    url: "stdReport.php",
                    data: {typeOfSam: typeOfSam},
                    success: function (response) {
                        $('#content').html(response);
                    }
                });
                
            };

            //Saff
            function staffSammury() { 
                var typeOfSam = $("input[name='typeOfSam']:checked").val();

                $.ajax({
                    type: "post",
                    url: "staffReport.php",
                    data: {typeOfSam: typeOfSam},
                    success: function (response) {
                        $('#content').html(response);
                    }
                });
                
            };

            //Book
            function bookSammury() { 
                var typeOfSam = $("input[name='typeOfSam']:checked").val();

                $.ajax({
                    type: "post",
                    url: "bookReport.php",
                    data: {typeOfSam: typeOfSam},
                    success: function (response) {
                        $('#content').html(response);
                    }
                });
                
            };

            //Book
            function busSammury() { 
                var typeOfSam = $("input[name='typeOfSam']:checked").val();

                $.ajax({
                    type: "post",
                    url: "busReport.php",
                    data: {typeOfSam: typeOfSam},
                    success: function (response) {
                        $('#content').html(response);
                    }
                });
                
            };

            bookSammury();

            

            $('#btn_Std').click(function (e) { 
                e.preventDefault();
                stdSammury();
            });

            $('#btn_Staff').click(function (e) { 
                e.preventDefault();
                staffSammury();
            });

            $('#btn_Book').click(function (e) { 
                e.preventDefault();
                bookSammury();
            });

            $('#btn_Bus').click(function (e) { 
                e.preventDefault();
                busSammury();
            });
            
            


            //Filter Results
            $("input[name='typeOfSam']").change(function (e) { 
                e.preventDefault();
                

                if ($('#show').html() == "Student Sammury") {
                    stdSammury();
                }
                
                if ($('#show').html() == "Staff Sammury") {
                    staffSammury();
                }

                if ($('#show').html() == "Booking Sammury") {
                    bookSammury();
                }
            });

            //Print
            $('#btn_print').click(function(e) {
                e.preventDefault();
                var mode = 'iframe';
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };

                $('#content').printArea(options);
            });
            
        });
    </script>

</body>



</html>