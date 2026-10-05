<?php

require('checksession.php');
require('../inc/function.php');
// require("includes/image_compressure.php");

if (isset($_POST['submit'])) {

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

    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    //=============|image|============//
	$bimages=$_FILES['bimage']['name'];
	if($bimages!="")
	{
		$bimage=time()."_".$bimages;
		move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/jobs/".$bimage);
	}
	else
	{
		$bimage="";	
	}
    

    // $bimages = $_FILES['bimage']['name'];
    // if ($bimages != '') {
    //     $bimage = $_FILES['bimage'], "../uploads/jobs/";
    // } else {
    //     $bimage = '';
    // }

    $query = mysqli_query($conn, "INSERT INTO `tbl_career`(`job_title`, `job_res`,`job_location`, `job_short_des`, `job_long_des`,`job_req_skills`, `job_tags`, `apply_last_date`, `logo`, `publish_date`, `status`, `sort`, `publish_by`) VALUES ('$title','$response','$location', '$sh_des','$lg_des','$skills','$tags','$apply_date','$bimage','$publish_date','$status','$sort','$publish_by')");
    if ($query == true) {
        $_SESSION['success'] = "Job Added successfully";
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
                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item active">Add Career</li>
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
                            <h4 class="panel-title">Add Career</h4>
                        </div>
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <div class="box-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title"> Job Title</label>
                                                <input type="text" name="j_title" class="form-control" id="name" placeholder="Enter Job Title">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title"> Job Location</label>
                                                <input type="text" name="j_location" class="form-control" id="location" placeholder="Enter Job Location">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="heading">Job Responsibility</label>
                                                <textarea name="j_res" class="form-control" id="editor1" placeholder="Enter Job Responsibility"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Job Short Description</label>
                                                <textarea name="j_sh_desc" placeholder="Enter Short Description" class="form-control" id="editor2"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Job Long Description</label>
                                                <textarea name="j_lg_desc" placeholder="Enter Long Description" class="form-control" id="editor3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Job Skill Required</label>
                                                <textarea name="j_skills" placeholder="Enter Required Skills" class="form-control" id="editor4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Job Tags <code>Enter tags using comma ( , ).</code></label>
                                                <input type="text" name="j_tags" placeholder="Enter Job Related Tags" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Last Date to Apply</label>
                                                <input type="date" name="j_apply_date" placeholder="Enter Job Last Date to Apply" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Logo / Images</label>
                                                <input type="file" name="bimage" class="form-control" id="exampleInputPassword1" multiple>
                                                <p class="help-block">Image dimension must be 1366 × 767 px & must be jpg format</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Publish Date</label>
                                                <input type="date" name="j_publish_date" placeholder="Enter Job Publish Date" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Publish By</label>
                                                <input type="text" name="j_publish_by" placeholder="Enter Job Publish By" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bannerlink">Position</label>
                                                <input type="text" name="j_position" placeholder="Enter Job Position" class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="radio" value="1" id="optionsRadios3" name="status" checked>
                                        <label for="optionsRadios3">Active</label>
                                        <input type="radio" value="0" id="optionsRadios4" name="status">
                                        <label for="optionsRadios4">Inactive</label>
                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Click To Submit Data</button>
                                    <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
</body>

</html>