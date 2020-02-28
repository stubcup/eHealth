<?php
require_once './vendor/autoload.php';

session_start;
include('connect.php');

$id = $_POST['idno'];

$query = "SELECT * FROM user WHERE `userID` = '$id'";
$result = mysqli_query($db, $query);

$body = "Good Day";

// Create the Transport
$transport = (new Swift_SmtpTransport('mail.psycho-tech.co.za', 25))
    ->setUsername('mahlomolamoses@psycho-tech.co.za')
    ->setPassword('Street,kong1');

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);



// Create a message
$message = (new Swift_Message('mokokotlong'))
    ->setFrom(['mahlomolamoses@gmail.com' => 'MOSES'])
    ->setTo(['xsmasilela@yahoo.com', 'djbeeftronix@gmail.com' => 'Steve wonder'])
    ->setBody('hello');

// Send the message
$result = $mailer->send($message);

if ($result) {
    echo "E vaile";
} else {
    echo "o thomme go gafa";
}
 



?>