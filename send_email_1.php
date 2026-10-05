<?php
$to = $argv[1];
$subject = $argv[2];
$body = $argv[3];
$email = $argv[4];


$headers  = 'From: foodees.drgupta@gmail.com' . "\r\n";
$headers .= 'Reply-To: foodees.drgupta@gmail.com' . "\r\n";
// $headers .= "CC: digital@thewebtycoons.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";



mail($to, $subject, $body, $headers);
?>
