<?php

require('checksession.php');
require('../inc/function.php');
$b = $_REQUEST['bid'];
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_video_testimonia` where `id`='$b'");
$brec = mysqli_fetch_array($bdata);
if (isset($_POST['update'])) {
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
	$v_code = mysqli_real_escape_string($conn, $_POST['v_code']);
	$tag = mysqli_real_escape_string($conn, $_POST['tag']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);

//   $bimage = $_FILES['bimage']['name'];
//   if($bimage!=''){
//       $bimage = time() . "_" . $bimage;
//       @unlink("../uploads/banner/" . $old);
//       move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/banner/" . $bimage);
//   } else {
//     $bimage = $brec['bnr_image'];
//   }
  
//   $bnrlogo = $_FILES['bnrlogo']['name'];
// 	$bnr_logo = time() . "_" . $bnrlogo;
// 	if ($bnrlogo != '') {
// 	    @unlink("../uploads/banner/" . $old2);
// 		move_uploaded_file($_FILES["bnrlogo"]["tmp_name"], "../uploads/banner/" . $bnr_logo);
// 	} else {
// 		$bnr_logo = $brec['bnr_logo'];
// 	}

  $query = mysqli_query($conn, "UPDATE `tbl_video_testimonia` SET `title`='$title',`subtitle`='$subtitle', `v_code`='$v_code', `tag`='$tag', `sort`='$position', `status`='$status' WHERE `id`='$b'");
  if ($query == true) {
    $_SESSION['success'] = "Updated Successfully";
    header("refresh:3;url=manage-video-testimonials.php");
  } else {
    $_SESSION['error'] = "Something went wrong. Please try again";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>

<body>
  <!-- begin #page-container -->
  <?php require("includes/header.php"); ?>
  <!-- begin #sidebar -->
  <?php require("includes/left.php"); ?>
  <!-- begin #content -->
  <div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item"><a href="javascript:;">Video Testimonial Management</a></li>
      <li class="breadcrumb-item active">Edit Video Testimonial</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Video Testimonial</h1>
    <!-- begin row -->
    <div class="row">
      <!-- begin col-10 -->
      <div class="col-lg-12">
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
            <h4 class="panel-title"> Edit Video Testimonial</h4>
          </div>
          <!-- begin panel-body -->
          <div class="panel-body">
            <form role="form" method="POST" enctype="multipart/form-data">
              <div class="box-body">

   	                            <div class="form-group">
									<label for="banner">Video Code</label>
									<input type="text" name="v_code" class="form-control" value="<?= $brec['v_code']; ?>" placeholder="Enter Video Code">
								</div>

								<div class="form-group">
									<label for="banner">Title</label>
									<input type="text" name="title" class="form-control" value="<?= $brec['title']; ?>" placeholder="Enter title">
								</div>

								<div class="form-group">
									<label for="banner">SubTitle</label>
									<input type="text" name="subtitle" class="form-control" value="<?= $brec['subtitle']; ?>" placeholder="Enter subtitle">
								</div>

								<div class="form-group">
									<label for="banner">Tag</label>
									<input type="text" name="tag" class="form-control" value="<?= $brec['tag']; ?>" placeholder="Enter tag">
								</div>

                            <div class="form-group">
                              <label for="exampleInputPassword1">Video Testimonial position</label>
                              <input type="number" name="position" class="form-control" id="exampleInputPassword1" value="<?= $brec['sort']; ?>">
                            </div>
                      
            
                            <div class="form-group">
                              <input type="radio" value="1" id="optionsRadios3" name="status" <?php if ($brec['status'] == '1') { echo 'checked'; } ?>>
                              <label for="optionsRadios3">Active</label>
            
                              <input type="radio" value="0" id="optionsRadios4" name="status" <?php if ($brec['status'] == '0') { echo 'checked'; } ?>>
                              <label for="optionsRadios4">Inactive</label>
                            </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="update" class="btn btn-primary">Click Here To Update</button>
                <!--<button type="reset" name="reset" class="btn btn-danger">Reset</button>-->
              </div>
            </form>
          </div>
          <!-- end panel-body -->
        </div>
        <!-- end panel -->
      </div>
      <!-- end col-10 -->
    </div>
    <!-- end row -->
  </div>
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

</body>

</html>