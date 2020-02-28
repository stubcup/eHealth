
<?php
session_start();
include('connect.php');
$errors = array();

require_once('vendor/autoload.php');

$idNo = $_POST['stdNo'];

$query = "SELECT * FROM student WHERE `studentID` = '$idNo'";
$result = mysqli_query($db, $query);

if ($result) {
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_array($result)) {
            $stud = $row['studentID'];
        }
    }
}

if (empty($idNo)) {
    array_push($errors, 'Please Enter Student Number');
} else {
    $idNo = strip_tags($idNo);
    $idNo = $db->real_escape_string($idNo);

    if ($idNo != $stud) {
        array_push($errors, 'Student Number do not exist, try Again..');
    } else {
        if (empty($idNo) || (strlen($idNo) != 9)) {
            array_push($errors, 'Please Enter a Valid Student Number');
        } else {
            $idNo = strip_tags($idNo);
            $idNo = $db->real_escape_string($idNo);
        }
    }
}

if (count($errors) == 0) {
    $query = "SELECT * FROM student WHERE `studentID` = '$idNo'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_array($result)) {
                $email = $row['email'];
                $username = $row['sname']. ' '. $row['name'];
                
                //Generate Code
                $letters = array_merge(range('a','z'),range('A','Z')); 

                $one = rand(000,999). $letters[rand(0,26)]. rand(0,9);
                $two = rand(000,999). $letters[rand(0,26)]. rand(0,9);
                $three = rand(000,999). $letters[rand(0,26)]. rand(0,9);
                $four = rand(000,999). $letters[rand(0,26)]. rand(0,9);
        
                $code = $one. "-". $two . "-". $three . "-". $four;

                $message = '
                    <style>
                        *{
                            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                            text-align: center;
                        }
                        h1 {
                            background-color: #08acea;
                            color: #fff;
                        }
                    
                        h3 {
                            color: #454545;
                            font-family: "Courier New", Courier, monospace;
                            background-color: #ccc;
                            margin-left: 30%;
                            margin-right: 30%;
                            padding: 50px;
                        }
                    </style>
                    <h1>Hello '. $username .'</h1>
                    <h4><b>We have recieved a request to Reset Your Password</b></h4>
                    <p>The Code below will help you to reset your Password.</p>
                    
                    <h3>'. $code .'</h3>
                    
                    <p style="color: #ccc;"><i>Advanced Bus Management System &copy; 2019</i></p>
                ';




                // Create the Transport
                $transport = (new Swift_SmtpTransport('mail.psycho-tech.co.za', 25))
                ->setUsername('stevens@psycho-tech.co.za')
                ->setPassword('#Steve102')
                ;

                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

                // Create a message
                $message = (new Swift_Message('Password Reset'))
                ->setFrom(['djbeeftronix@gmail.com' => 'AMBS'])
                ->setTo([$email => $username])
                ->setBody($message, 'text/html');

                // Send the message
                $sent = $mailer->send($message);
                    

                if ($mailer->send($message)){
                    echo "<script>window.location.replace('password.php?code={$code}&id={$idNo}'); $('#result').html('Email Sent, Check Your Mails');</script>";
                }else{
                    echo "Failed\n";
                }

                /*}else {
                    array_push($errors, "Something went wrong, Please retry");
                }*/
            }
        } else {
            array_push($errors, 'Incorrect Student Number');
        }
    } else {
    }
}

include 'errors.php';

?>