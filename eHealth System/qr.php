<?php

session_start();

include('libs/phpqrcode/qrlib.php');
$tempDir = 'images/'; 
$filename =$_SESSION['userID'];
$body =  "www.dmhtraining.co.za";
$codeContents = $body;
QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);


?>

<script type="text/javascript" src="script/jquery.min.js"></script>
    <script type="text/javascript" src="script/materialize.min.js"></script>

    <script>
        $(document).ready(function() {

           


            $('#qrdown').click(function(e) {
                //e.preventDefault();
               

                $('#regbtn').addClass('btn_load');

              

                var stdNo = $('#stdNo').val();
                var mail = $('#mail').val();
                var passW = $('#passW').val();
                var passW1 = $('#passW1').val();

                $.ajax({
                    type: "post",
                    url: "regcpu.php",
                    data: {
                        stdNo: stdNo,
                        mail: mail,
                        passW: passW,
                        passW1: passW1
                    },
                    success: function(response) {
                        $('#output').html(response);
                        $('#regbtn').removeClass('btn_load');
                    }
                });

            });
        });
    </script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate</title>
    <link rel="stylesheet" type="text/css" href="css/flexboxgrid.css" />
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/Style.css">
</head>

<body>

    <nav class="blue lighten-2">
        <div class="nav-wrapper">
            <div class="container-fluid">
                <a href="#" class="brand-logo">Logo</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="sass.html"><i class="fa fa-exclamation"></i></a></li>
                    <li><a href="badges.html"><i class="fa fa-info-circle  "></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="form pushed_top">
        <div class="container">
            <h4 class="start-lg center-xs">Booking Completed</h4>
            <div class="divider"></div>

            <div class="row">
                <form method="post" class="col s12 m12">
                <h4 style="text-align:left">QR Code</h4>
                <div class="qrframe" style="border:2px solid black; width:210px; height:210px;">
                <?php echo '<img src="images/'. @$filename.'.png" style="width:200px; height:200px;"><br>'; ?>
                </div>

                <a type="submit" style="width:210px; margin:5px 0;" name="qrdown" id="qrdown" class="btn blue lighten-2 waves-effect waves-dark round-btn col s12"  href="download.php?file=<?php echo $filename; ?>.png "><i class="fa fa-download"> </i>Download</a>

                
                </form>
   
            </div>

            
            </div>
        </div>
    </div>

    <!-- Scripts -->
    
</body>

</html> 