<?php
require_once('PHPMailLiabrary/send_email.php');

$send = send_mail('demo@test-links.com','Subject1','body');

echo $send;