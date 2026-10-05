<?php 
require('inc/function.php');
if(isset($_POST['submit'])){ 
    
    if(!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['company']) && !empty($_POST['designation'])){ 
        //  if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
        //      $secretKey = RECAPCHA_SECRET_KEY; 
        //      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']); 
        //      $responseData = json_decode($verifyResponse); 
        //      if($responseData->success){ 
                
                $name = isset($_POST['name']) ? trim($_POST['name']) : ''; 
                $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
                $email = isset($_POST['email']) ? trim($_POST['email']) : ''; 
                $company = isset($_POST['company']) ? trim($_POST['company']) : ''; 
                $designation = isset($_POST['designation']) ? trim($_POST['designation']) : ''; 
                
                $s_name = mysqli_real_escape_string($conn, $name);
                $s_phone = mysqli_real_escape_string($conn, $phone);
                $s_email = mysqli_real_escape_string($conn, $email);
                $s_company = mysqli_real_escape_string($conn, $company);
                $s_designation = mysqli_real_escape_string($conn, $designation);
                
                mysqli_query($conn, "INSERT INTO `tbl_register_mail`(`name`, `phone`, `email`, `company`, `designation`) VALUES ('$s_name','$s_phone','$s_email','$s_company','$s_designation')");
                
                $to = SITE_EMAIL;
                
                $subject = "Register Enquiry Details" ; 
                $htmlContent = " 
                    <div style='font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;'>
    <table style='width: 100%;'>
      <tr>
        <td></td>
        <td bgcolor='#fff '>
          <div style='padding: 15px; max-width: 600px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid black;'>
            <table style='width: 100%;background: #fff ;'>
              <tr>
                <td></td> 
                <td>
                  <div>
                    <table width='100%'>
                      <tr>
                        <td rowspan='2' style='text-align:center;padding:10px;'>
                            <img style='float:left;' width='200' src='https://sgfoodees.in/uploads/logo.png' /> 
                            <span style='color:black;float:right;font-size: 13px;font-style: italic;margin-top: 20px; padding:10px; font-size: 14px; font-weight:normal;'>
                            <b><span>Register Enquiry Details</span></b><span></span></span>
                        </td>
                      </tr>
                    </table>
                  </div>
                </td>
                <td></td>
              </tr>
            </table>
            <table style='padding: 10px;font-size:14px; width:100%;'>
              <tr>
                <td style='padding:10px;font-size:14px; width:100%;'>
                    <p><b>Name :-</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".htmlspecialchars($name)." </p>
                   <p><b>Phone No :-</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".htmlspecialchars($phone)." </p>
                    <p><b>Email :-</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".htmlspecialchars($email)." </p>
                    <p><b>Company :-</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".htmlspecialchars($company)." </p>
                    <p><b>Designation :-</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".htmlspecialchars($designation)." </p>
                 </td>
              </tr>
              <tr> 
              <td>
                 <div align='center' style='font-size:12px; margin-top:20px; padding:5px; color:#fff; width:100%; background:#27aae1;'>
                    © ".date("Y")." <a href='".SITE_URL."' target='_blank' style='color:#fff; text-decoration: none;'>[ '".SITE_NAME."' ]</a>
                  </div>
                </td>
              </tr>
            </table>
          </div>
                "; 
                $headers = "MIME-Version: 1.0" . "\r\n"; 
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
                $headers .= 'From:SGFoods' . "\r\n"; 
                $headers .= 'Cc: wtdeveloper.chandani@gmail.com' . "\r\n";
                @mail($to,$subject,$htmlContent,$headers); 
	            echo '<script>window.location.href="'.SITE_URL.'thank-you.php";</script>';
            }else{ 
	            
	   //          echo "<script>alert('Robot verification failed, please try again');window.location.href='".SITE_URL."';</script>";
    //       } 
    //      }else{ 
			 // echo "<script>alert('Please check on the reCAPTCHA box');window.location.href='".SITE_URL."';</script>";
			
    //     } 
    // }
    // else{ 
		 echo "<script>alert('Please fill all the mandatory fields');window.location.href='".SITE_URL."';</script>";
	
    } 
 }
?>