<?php
require_once('PHPMailLiabrary/send_email.php');

$subject = "Custom Order Request";
$to_email = $_POST['email'];
$body = "body";


$send = send_mail($to_email,$subject,$body);

echo $send;