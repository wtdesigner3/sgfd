<?php

error_reporting(E_ALL); // Report all PHP errors
ini_set('display_errors', 1); // Display errors in the output

require('checksession.php');
include '../inc/function.php';

$b = $_REQUEST['cid'];
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_career` where `id`='$b'");
$brec = mysqli_fetch_array($bdata);

if (isset($_POST['update'])) {

	$title = mysqli_real_escape_string($conn, $_POST['j_title']);
    $location = mysqli_real_escape_string($conn, $_POST['j_location']);
    $response = mysqli_real_escape_string($conn, $_POST['j_res']);
    $sh_des = mysqli_real_escape_string($conn, $_POST['j_sh_desc']);
    $lg_des = mysqli_real_escape_string($conn, $_POST['j_lg_desc']);
    $skills = mysqli_real_escape_string($conn, $_POST['j_skills']);
    $tags = mysqli_real_escape_string($conn, $_POST['j_tags']);
    $apply_date = mysqli_real_escape_string($conn, $_POST['j_apply_date']);
    $publish_date = mysqli_real_escape_string($conn, $_POST['j_publish_date']);
    $publish_by = mysqli_real_escape_string($conn, $_POST['j_publish_by']);
    $sort = mysqli_real_escape_string($conn, $_POST['j_position']);
	$old = mysqli_real_escape_string($conn,$_POST['oldimg']); 
    $status = mysqli_real_escape_string($conn, $_POST['status']);


  $ach_image=$_FILES['ach_image']['name'];
  if($ach_image!='')
  {
      $ach_images=time()."_".$ach_image;
      @unlink("../uploads/jobs/".$old);
      move_uploaded_file($_FILES["ach_image"]["tmp_name"], "../uploads/jobs/".$ach_images);
  }
  else{
      $ach_images=$old;	
  }




	$query = mysqli_query($conn, "UPDATE `tbl_career` SET `job_title`='$title',`job_res`='$response',`job_location`='$location',`job_short_des`='$sh_des',`job_long_des`='$lg_des',`job_req_skills`='$skills',`job_tags`='$tags',`apply_last_date`='$apply_date',`logo`='$ach_images',`publish_date`='$publish_date',`status`='$status',`sort`='$sort',`publish_by`='$publish_by' WHERE `id`='$b'");
	if ($query == true) {
		$_SESSION['success'] = "Careers Updated Successfully";
		header("refresh:3;url=manage-career.php");
	} else {
		$_SESSION['error'] = "Something went wrong. Please try again";
	}
}
?>




<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>

<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		<!-- begin #page-container -->
		<?php require("includes/header.php"); ?>
		<!-- begin #sidebar -->
		<?php require("includes/left.php"); ?>
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;"> Manage Career</a></li>
				<li class="breadcrumb-item active">Edit Career</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Career</h1>
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
							<h4 class="panel-title"> Edit Career</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST" enctype="multipart/form-data">
                                <div class="box-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title"> Job Title</label>
                                                <input type="text" name="j_title" class="form-control" value="<?= $brec['job_title']; ?>" id="name" placeholder="Enter Job Title">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title"> Job Location</label>
                                                <input type="text" name="j_location" class="form-control" value="<?= $brec['job_location']; ?>" id="location" placeholder="Enter Job Location">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="heading">Job Responsibility</label>
                                                <textarea name="j_res" class="form-control" id="editor1" placeholder="Enter Job Responsibility"><?= strip_tags($brec['job_res']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Job Short Description</label>
                                                <textarea name="j_sh_desc" placeholder="Enter Short Description" class="form-control" id="editor2"><?= $brec['job_short_des']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Job Long Description</label>
                                                <textarea name="j_lg_desc" placeholder="Enter Long Description" class="form-control" id="editor3"><?= $brec['job_long_des']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Job Skill Required</label>
                                                <textarea name="j_skills" placeholder="Enter Required Skills" class="form-control" id="editor4"><?= $brec['job_req_skills']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Job Tags <code>Enter tags using comma ( , ).</code></label>
                                                <input type="text" name="j_tags" placeholder="Enter Job Related Tags" value="<?= $brec['job_tags']; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Last Date to Apply</label>
                                                <input type="date" name="j_apply_date" placeholder="Enter Job Last Date to Apply" value="<?= $brec['apply_last_date']; ?>" class="form-control" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                        <div class="form-group">
											<label for="exampleInputFile">Logo / Images</label>
											<input type="file" name="ach_image" class="form-control" >
											<input type="hidden" name="oldimg"  value="<?= $brec['logo']; ?>">
										    <p class="help-block">Image dimension must be 128 X 128 & must be png format</p>
											<img src="../uploads/jobs/<?= $brec['logo']; ?>" style="width:10%; filter: invert(1);">
										</div>
										</div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Publish Date</label>
                                                <input type="date" name="j_publish_date" value="<?= $brec['publish_date']; ?>" placeholder="Enter Job Publish Date" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Publish By</label>
                                                <input type="text" name="j_publish_by" value="<?= $brec['publish_by']; ?>" placeholder="Enter Job Publish By" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Position</label>
                                                <input type="text" name="j_position" value="<?= $brec['sort']; ?>" placeholder="Enter Job Position" class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <!--<div class="form-group">-->
                                    <!--    <input type="radio" value="1" id="optionsRadios3" name="status" checked>-->
                                    <!--    <label for="optionsRadios3">Active</label>-->
                                    <!--    <input type="radio" value="0" id="optionsRadios4" name="status">-->
                                    <!--    <label for="optionsRadios4">Inactive</label>-->
                                    <!--</div>-->
                                    
                                    <div class="form-group">
										<input type="radio" value="1" id="optionsRadios3" name="status" <?php if ($brec['status'] == '1') {
																			echo 'checked';
																										} ?>>
										<label for="optionsRadios3">Active</label>

										<input type="radio" value="0" id="optionsRadios4" name="status" <?php if ($brec['status'] == '0') {
																			echo 'checked';
																										} ?>>
										<label for="optionsRadios4">Inactive</label>
									</div>

                                </div>
								<!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" name="update" class="btn btn-primary">Click Here To Update</button>
									<button type="reset" name="reset" class="btn btn-danger">Reset</button>
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
            initSample();
            CKEDITOR.replace('editor1', {
                filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
            });
            CKEDITOR.replace('editor2', {
                filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
            });
            CKEDITOR.replace('editor3', {
                filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
            });
            CKEDITOR.replace('editor4', {
                filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
            });
        });
    </script>
    <script>
        function myGetlink() {
            var x = document.getElementById("myIMG");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>
	<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
		});
	</script>

</body>

</html>