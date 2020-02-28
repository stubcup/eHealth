

            <?php

            session_start();
            include('connect.php');


            if (empty($_SESSION['studentID'])) {
                header('location: login.php');
            } else {
                $stdNo = $_SESSION['studentID'];
            }

            $today = date('d-m-Y');


            $query = "SELECT * FROM booking WHERE `stdNo` = '$stdNo' AND `book_status` = '0' ORDER BY `time` ASC";
            $result = mysqli_query($db, $query);

           

            if ($result) 
            {

                ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>My Bookings</title>
                <link rel="stylesheet" type="text/css" href="css/flexboxgrid.css" />
                <link rel="stylesheet" href="css/materialize.min.css">
                <link rel="stylesheet" href="css/font-awesome.min.css">
                <link rel="stylesheet" href="css/Style.css">

                <script type="text/javascript">
                    function show(time, bus, id) {
                        $.ajax({
                            type: "post",
                            url: "delete_booking.php",
                            data: {
                                time: time,
                                bus: bus,
                                id: id
                            },
                            success: function(response) {
                                $('#' + time + bus + id).remove();
                                $('#output').html(response);
                                return true;
                            }
                        });
                    }
                </script>
            </head>

            <body>

                <nav class="blue lighten-2">
                    <div class="nav-wrapper">
                        <div class="container-fluid">
                            <a href="index.php" class="brand-logo">Advanced Bus Management System</a>
                            <a href="" data-activates="mobile-demo" class="button-collapse"><i class="fa fa-ellipsis-v"></i></a>
                            <ul id="nav-mobile" class="right hide-on-med-and-down">
                                <li><a href="index.php"><i class="fa fa-map-marker"></i> Make a Booking</a></li>
                                <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                <li><a href="sass.html"><i class="fa fa-exclamation"></i></a></li>
                                <li><a href="badges.html"><i class="fa fa-info-circle"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="container-fluid" style="margin-top: 30px;">
                    <div class="row center-xs">
                        <div class="col s12 m6 pull-m3">
                            <span id="today">
                                <h4 id="time"></h4>
                                <div class="divider"></div>
                                <h6 id="day" class="grey-text"></h6>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form pushed_top">
                    <div class="container">

                    <?php
                if (mysqli_num_rows($result) == 0) {
                echo ('<h4>No bookings Found');
                        }
                ?>

                        <span id="output"></span>
                        <ul class="collection middle-xs">
                            <?php while ($row = mysqli_fetch_array($result)) :

                                $time = $row['time'];
                                $bus = $row['bus'];

                                if (strlen($time) == 1) {
                                    $timer = "0" . $time . "H00";
                                } else {
                                    $timer = $time . "H00";
                                }

                                $img = $today . $time . $bus . $stdNo;
                                ?>
                            <a id="<?php echo ($img) ?>" class="collection-item avatar grey-text text-darken-4">
                                <li style="cursor: pointer;">
                                    <img src="images/<?php echo ($img) ?>.png" alt="" class="circle materialboxed">
                                    <h5><?php echo ($timer) ?></h5>
                                    <p>from: <?php echo ($row['from']) ?></p>
                                    <p>To: <?php echo ($row['to']) ?></p>
                                    <p class="grey-text"><i>Bus Registration: <?php echo ($bus) ?></i></p>
                                    <button type="submit" onclick="show('<?php echo ($time) ?>', '<?php echo ($bus) ?>', '<?php echo ($stdNo) ?>')" class="btn blue lighten-2 waves-effect waves-dark round-btn">Delete Booking</button>

                                    <button type="submit" style="width:210px; margin:5px 0;" name="qrdown" id="qrdown" class="btn blue lighten-2 waves-effect waves-dark round-btn col s12"  href="images/<?php echo ($img) ?>.png"><i class="fa fa-download"> </i>Download</button>
                                </li>
                            </a>
                            <?php endwhile ?>
                            <?php 
                        } else {
                            unset($_SESSION['studentID']);
                        } ?>
                        </ul>
                    </div>
                </div>
                </div>
                
               
               

                <!-- Scripts -->
                <script type="text/javascript" src="script/jquery.min.js"></script>
                <script type="text/javascript" src="script/materialize.min.js"></script>

                <script type="text/javascript">
                    //Init Side Nav
                    $('.button-collapse').sideNav();

                    $(document).ready(function() {
                        $('.materialboxed').materialbox();
                    });

                    function addZero(i) {
                        if (i < 10) {
                            i = "0" + i;
                        }
                        return i;
                    }

                    setInterval(() => {
                        var d = new Date();
                        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                        var days = ["Sun", "Mon", "Tues", "Wed", "Thurs", "Fri", "Sat"];

                        var h = addZero(d.getHours());
                        var m = addZero(d.getMinutes());
                        var s = addZero(d.getSeconds());

                        time = h + ":" + m + "." + s

                        var day = "<b>" + days[d.getDay()] + "</b> - " + d.getDate() + " " + months[d.getMonth()] + " " + d.getFullYear();
                        $('#time').html(time);
                        $('#day').html(day);
                    }, 1000);
                </script>
            </body>

            </html> 

