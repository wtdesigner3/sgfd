<?php 
require('checksession.php'); 
require('../inc/function.php');

$strl ="SELECT `id`, `name`, `username`, `email`, `image` FROM `tbl_admin`";
$rqrt = $conn->query($strl);
$roort = $rqrt->fetch_assoc();  

if(isset($_POST['update']))
{
$name = mysqli_real_escape_string($conn,$_POST['name']); 
$email = mysqli_real_escape_string($conn,$_POST['email']); 
$username= mysqli_real_escape_string($conn,$_POST['username']);  

  $image=$_FILES['image']['name'];
  if($image!='')
  {
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (in_array($ext, $allowed)) {
      $image=time()."_".$image; 
      // @unlink("../uploads/".$roort['image']);
      move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$image);
    } else {
      $image=$roort['image'];
      $erromsg = "Invalid image format. Allowed formats: jpg, jpeg, png, gif, webp.";
    }
  }
  else{
    $image=$roort['image'];
  }
 
      
    $query=mysqli_query($conn,"UPDATE `tbl_admin` SET `name`='$name',`email`='$email',`username`='$username',`image`='$image'");
    if($query)
    {
        $msg = "Updated Successfull";
        header("refresh: 3;");
    }
    else
    {
        $erromsg = "Something Error";
    }
    
}
 
?>
<?php 
if(isset($_POST['updatepassword']))
{ 
    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $con_password = $_POST['con_password'] ?? '';

    $chg_pwd = mysqli_query($conn,"SELECT * FROM `tbl_admin` WHERE `id`='1'");
    $chg_pwd1 = mysqli_fetch_array($chg_pwd);
    $data_pwd = $chg_pwd1['password'];

    $old_valid = false;
    if (strlen($data_pwd) === 32 && ctype_xdigit($data_pwd)) {
        $old_valid = (md5($old_password) === $data_pwd);
    } else {
        $old_valid = password_verify($old_password, $data_pwd);
    }

    if($old_valid){
        if(!empty($new_password) && $new_password === $con_password){
            if (strlen($new_password) < 8) {
                $_SESSION['error'] = "New password must be at least 8 characters long.";
                header("Refresh:3;url=manage-profile.php");
            } else {
                $hashed_new = password_hash($new_password, PASSWORD_DEFAULT);
                $update_pwd = mysqli_query($conn,"UPDATE `tbl_admin` SET `password`='$hashed_new' WHERE `id`='1'");
                $_SESSION['success'] = "Password Updated Successfully (Secure bcrypt)";
                header("Refresh:3;url=manage-profile.php");
            }
        } else {
            $_SESSION['error'] = "Your new and Retype Password do not match!";
            header("Refresh:3;url=manage-profile.php");
        }
    } else {
        $_SESSION['error'] = "Your old password is wrong!";
        header("Refresh:3;url=manage-profile.php"); 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>
<body>
	<!-- begin #page-loader -->
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<?php require("includes/header.php"); ?>
	<!-- end #header -->	
	<!-- begin #sidebar -->
	<?php require("includes/left.php"); ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content content-full-width">
			<!-- begin profile -->
			<div class="profile">
				<div class="profile-header">
					<!-- BEGIN profile-header-cover -->
					<div class="profile-header-cover"></div>
					<!-- END profile-header-cover -->
					<!-- BEGIN profile-header-content -->
					<div class="profile-header-content">
						<!-- BEGIN profile-header-img -->
						<div class="profile-header-img">
							<img src="<?=SITE_URL?>uploads/<?= $roort['image']; ?>" alt="">
						</div>
						<!-- END profile-header-img -->
						<!-- BEGIN profile-header-info -->
						<div class="profile-header-info">
							<h4 class="m-t-10 m-b-5"><?= $roort['name']; ?></h4>
							<p class="m-b-10"><?= $roort['email']; ?></p>
							<a href="manage-profile.php" class="btn btn-xs btn-yellow">Edit Profile</a>
						</div>
						<!-- END profile-header-info -->
					</div>
					<!-- END profile-header-content -->
					<!-- BEGIN profile-header-tab -->
					<ul class="profile-header-tab nav nav-tabs">
						<li class="nav-item"><a href="#profile-post" class="nav-link active" data-toggle="tab">Website Detail</a></li>

					</ul>
					<!-- END profile-header-tab -->
				</div>
			</div>
			<!-- end profile -->
			<!-- begin profile-content -->
			<div class="profile-content">
				<!-- begin tab-content -->
				<div class="tab-content p-0">
					<!-- begin #profile-post tab -->
					<div class="tab-pane fade show active" id="profile-post">
						<!-- begin timeline -->
						<ul class="timeline">
                             <div class="row">
                                <!-- begin col-10 -->
                                  <div class="col-lg-6">
                                    <!-- begin panel -->
                                    <div class="panel panel-inverse">
                                        <!-- begin panel-heading -->
                                        <div class="panel-heading">
                                            <div class="panel-heading-btn">
                                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                            </div>
                                            <h4 class="panel-title">Contact Detail</h4>
                                        </div>
                                        <!-- end panel-heading -->
                                          
                    
                                        <!-- begin panel-body -->
                                        <div class="panel-body">
                                            <form role="form"  method="POST"  enctype="multipart/form-data">
                              <div class="box-body">
                             
                              
                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" name="name" class="form-control" id="name" value="<?php echo $roort['name']; ?>">
                                </div>
                                
                                 <div class="form-group">
                                  <label for="username">Username</label>
                                  <input type="text"  name="username"  value="<?php echo $roort['username']; ?>" class="form-control" id="username">
                                </div>
                                
                                <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="text" name="email" class="form-control" id="email" value="<?php echo $roort['email']; ?>">
                                </div>
                                
                                 <div class="form-group">
                                  <label for="image">User Profile</label>
                                  <input type="file" name="image" class="form-control" id="image" value="<?php echo $roort['image']; ?>">
                                </div>
                                
                               
                                
                                
                                
                              </div>
                              <!-- /.box-body -->
                
                              <div class="box-footer">
                                <button type="submit" name="update" onClick="if(confirm('Are You Sure Want To Update Data')){ return true;} else { return false; }" class="btn btn-primary">Submit</button>
                                <button type="button" onclick="myFunction()" class="btn btn-warning">Change Password</button>
                              </div>
                            </form>
                                        </div>
                                        <!-- end panel-body -->
                                    </div>
                                    <!-- end panel -->
                                </div>
                                
                             
                                    <div class="col-lg-6">
                                       <div id="myDIV" style="display:none;">
                                    <!-- begin panel -->
                                    <div class="panel panel-inverse">
                                        <!-- begin panel-heading -->
                                        <div class="panel-heading">
                                            <div class="panel-heading-btn">
                                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                            </div>
                                            <h4 class="panel-title">Change Password</h4>
                                        </div>
                                        <!-- end panel-heading -->
                                        
                                        <!-- begin panel-body -->
                                        <div class="panel-body">
                                            <form role="form"  method="POST"  enctype="multipart/form-data">
                              <div class="box-body">
                             
                              
                                <div class="form-group">
                                  <label for="oldpassword">Old Password</label>
                                  <input type="password" name="old_password" class="form-control" id="oldpassword" placeholder="Enter Old Password">
                                </div>
                                
                                 <div class="form-group">
                                  <label for="newpassword">New Password</label>
                                  <input type="password"  name="new_password"   placeholder="Enter New Password" class="form-control" id="newpassword">
                                </div>
                                
                                <div class="form-group">
                                  <label for="conpassword">Confirm Password</label>
                                  <input type="password" name="con_password" class="form-control" id="conpassword" placeholder="Enter Confirm Password">
                                </div>
                              </div>
                              <!-- /.box-body -->
                
                              <div class="box-footer">
                                <button type="submit" name="updatepassword" onClick="if(confirm('Are You Sure')){ return true;} else { return false; }" class="btn btn-primary">Change Password</button>
                              </div>
                            </form>
                                        </div>
                                        <!-- end panel-body -->
                                    </div>
                                    <!-- end panel -->
                                </div>
                                </div>
                                <!-- end col-10 -->
                            </div>
                              
						</ul>
						<!-- end timeline -->
					</div>
                   
				</div>
				<!-- end tab-content -->
			</div>
			<!-- end profile-content -->
		</div>
		<!-- end #content -->
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	<?php require("includes/footer.php"); ?>
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
<script>
  function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>

</body>

</html>
