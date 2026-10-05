<?php
$to = $argv[1];
$subject = $argv[2];
$body = $argv[3];
$email = $argv[4];


// $headers  = "From: SG FOODS Enquiry <" . strip_tags($email) . ">\r\n";
// $headers .= "Reply-To: " . strip_tags($email) . "\r\n";
// // $headers .= "CC: digital@thewebtycoons.com\r\n";
// $headers .= "MIME-Version: 1.0\r\n";
// $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            // $headers .= "CC: digital@thewebtycoons.com\r\n";
            $headers .= "From: SG FOODS Enquiry <" . strip_tags($email) . ">\r\n";


mail($to, $subject, $body, $headers);
?>
