<?php
require_once(__DIR__ . '/inc/function.php');
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://localhost/sgfoodees/');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'] ?? ''; 
    $c_name = $_POST['c_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $city = $_POST['city'] ?? ''; 
    $country = $_POST['country'] ?? '';
    $comment = $_POST['comment'] ?? '';
    // $message = $_POST['message'] ?? '';
    
    if (!empty($name) && !empty($phone)) {
        // $to = 'wtdeveloperpankaj@gmail.com'; 
        $to = 'wahasgfoodeesinfotechllp@gmail.com'; 
        $subject = 'SG FOOD Enquiry From '.$name;
        
        $body = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Email Template</title>
        </head>
        <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f8f9fa;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f8f9fa; padding: 20px 0;">
                <tr>
                    <td align="center">
                        <!-- Main container -->
                        <table width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; border: 1px solid #e6e6e6; border-radius: 8px; padding: 20px;">
                            <!-- Heading -->
                            <tr>
                                <td> 
                                    <img src="' . SITE_URL . 'uploads/logo.png" 
                                             alt="SG FOOD Logo" 
                                             style="display: block; display: block;
                                            max-width: 100%; 
                                            margin: 10px auto;
                                            width: 150px;
                                            margin: 0;
                                            background: black;
                                            padding: 10px;
                                            border-radius: 5px;" />
                                </td>
                            </tr>
                            <tr style="d-flex align-items-center justify-content-between">
                              
                                <td align="center" style="    font-size: 15px;
                                        font-weight: bold;
                                        color: #333333;
                                        padding: 10px 0;
                                        border-bottom: 1px solid #e6e6e6;
                                        text-align: end;"> 
                                ' . htmlspecialchars($subject) . '
                                </td>on
                               
                            </tr>
                            <!-- Content -->
                            <tr>
                                <td style="text-align: left; font-size: 16px; color: #555555; line-height: 1.6; padding: 20px;">
                                    <p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>
                                    <p><strong>Company Name:</strong> ' . htmlspecialchars($c_name) . '</p>
                                    <p><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</p>';
        if (!empty($city)) {
            $body .= '<p><strong>City:</strong> ' . htmlspecialchars($city) . '</p>';
        }
        if (!empty($country)) {
            $body .= '<p><strong>Country :</strong> ' . nl2br(htmlspecialchars($country)) . '</p>';
        }
        if (!empty($comment)) {
            $body .= '<p><strong>Comment :</strong> ' . nl2br(htmlspecialchars($comment)) . '</p>';
        }
        $body .= '
                                </td>
                            </tr>
                            <tr style="    background: rgb(240, 107, 30);
                                        text-align: center;
                                        color: white;
                                        padding: 15px 0px !important;
                                        border-radius: 5px;">
                                <a href="' . SITE_URL . '" target="_blank" style="color:white;     text-decoration: none;  ">©2026 SG Food</a>
                            </tr>
                            <!-- Footer -->
                            <tr>
                                <td align="center" style="font-size: 14px; color: #999999; padding: 10px 0; border-top: 1px solid #e6e6e6;">
                                    Thank you for reaching out to us. We will get back to you shortly.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        ';
        
        
        
        // Send the email
            try{
                // mail($to, $subject, $body, $headers);
                exec("php send_email_1.php " . escapeshellarg($to) . " " . escapeshellarg($subject) . " " . escapeshellarg($body) . " " . escapeshellarg($name) . "> /dev/null 2>&1 &");
            }catch(Exception $e){
                // handle error
            }
            header("Location: " . SITE_URL . "?enquiry_status=success");
            echo '<script>window.location.href="' . SITE_URL . '?enquiry_status=success";</script>';
            exit();

    } else {
        header("Location: " . SITE_URL . "?enquiry_status=error");
        echo '<script>window.location.href="' . SITE_URL . '?enquiry_status=error";</script>';
        exit();
    }
}

header("Location: " . SITE_URL);
echo '<script>window.location.href="' . SITE_URL . '";</script>';
exit();
?>
