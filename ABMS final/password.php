<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/flexboxgrid.css" />
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/Style.css">
</head>

<body>

    <nav class="blue lighten-2">
        <div class="nav-wrapper">
            <div class="container-fluid">
                <a href="#" class="brand-logo">Password Recovery</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="sass.html"><i class="fa fa-exclamation"></i></a></li>
                    <li><a href="badges.html"><i class="fa fa-info-circle  "></i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal Structure -->
    <div id="password_Modal" class="modal modal-fixed-footer">
        <div class="modal-content center-xs">
            <div class="container">
            <h4>Create New Pssword</h4>
            <div class="divider"></div>
            <div class="input-field">
                <span id="mod_result"></span>
            </div>
            <div class="input-field">
                <input type="password" name="create_passW" id="create_passW">
                <label for="create_passW">Password</label>
            </div>
            <div class="input-field">
                <input type="text" name="create_passW1" id="create_passW1">
                <label for="create_passW1">Confirm Password</label>
            </div>
            <div class="row middle-xs ">
                <button type="submit" name="btn_save_pass" id="btn_save_pass" class="btn waves-effect waves-dark blue lighten-2 col s12 m4 round-btn">Save</button>
            </div>
            </div>
        </div>  
    </div>

    <div class="form pushed_top">
        <div class="container">
            <h4 class="start-lg center-xs">Recover Password</h4>
            <div class="divider"></div>
            <div class="row start-lg center-xs">
                <div class="col s12 m8 pull-m2">
                    <form action="" method="post">
                        <h5>We have sent you an email with the Code to Enter Below.</h5> <i class="grey-text">Inlude the Dashes(-)</i>
                        <div class="input-field">
                            <input type="text" name="confirm" id="confirm">
                            <label for="confirm">Enter Code</label>
                        </div>

                        <div class="input-field">
                            <span id="result"></span>
                        </div>

                        <div class="row middle-xs ">
                            <button type="submit" name="btn_confirm" id="btn_confirm" class="btn waves-effect waves-dark blue lighten-2 col s12 m4 round-btn">Confirm</button>
                            <div id="recbtn" class="col s12 m8">Didn't Recieve Email? <a href="#">Resend Email</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Scripts -->
    <script type="text/javascript" src="script/jquery.min.js"></script>
    <script type="text/javascript" src="script/materialize.min.js"></script>

    <script>

    $('.modal').modal();

    $('#btn_confirm').click(function(e) {
        e.preventDefault();

        var passW = $('#create_passW').val();
        var passW1 = $('#create_passW1').val();
        var confirm = $('#confirm').val();
        var code = '<?php echo($_REQUEST['code']);?>';

        if (code != confirm) {
            $('#result').html("Codes Don't Match");
        }else {
            $('#password_Modal').modal('open');
        }
    });

    $('#btn_save_pass').click(function(e) {
        e.preventDefault();
        var passW = $('#create_passW').val();
        var passW1 = $('#create_passW1').val();
        var id = '<?php echo($_REQUEST['id']) ?>';

        $.ajax({
            type: "post",
            url: 'savePass.php',
            data: {
                passW: passW, passW1: passW1, id: id
            },
            success: function(response) {
                $('#mod_result').html(response);
            }
        });
    });

    $('#recbtn').click(function(e) {
        e.preventDefault();

        var stdNo = '<?php echo($_REQUEST['id']) ?>';

        $('#result').html('<i class="fa fa-refresh fa-spin"></i>  Please Wait...');

        $.ajax({
            type: "post",
            url: "forgot.php",
            data: {
                stdNo: stdNo,
            },
            success: function(response) {
                $('#result').html(response);
            }
        });


    });


    </script>

</body>



</html> 