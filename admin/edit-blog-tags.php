<?php
require('checksession.php'); 
require('../inc/function.php');

$b=$_REQUEST['bid'];
$bdata=mysqli_query($conn,"SELECT * FROM `tbl_blog_tags` where `id`='$b'");
$brec=mysqli_fetch_array($bdata);
if(isset($_POST['update']))
{

	$title = mysqli_real_escape_string($conn,$_POST['title']);
    $sort = mysqli_real_escape_string($conn,$_POST['sort']);
	$status = mysqli_real_escape_string($conn,$_POST['status']); 
    $prourls = mysqli_real_escape_string($conn,$_POST['url']);
    $prourrl = str_replace(array( '\'', '"', ' ', ',' , ';', '*', ',', '/', '&', '_', '$', '--', '-', '<', '>','.','?' ), '-', $prourls);
    $url = strtolower($prourrl);

   $query=mysqli_query($conn,"UPDATE `tbl_blog_tags` SET `title`='$title',`url`='$url',`sort`='$sort',`status`='$status' WHERE `id`='$b'");
   if($query==true)
      {
	  $_SESSION['success']="Blog Tags Updated Successfully";	
	  header("refresh:3;url=manage-blog-tags.php");
      }
      else 
      {
	   $_SESSION['error']="Something went wrong. Please try again";		
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
				<li class="breadcrumb-item"><a href="javascript:;">Blog Tags Management</a></li>
				<li class="breadcrumb-item active">Edit Blog Tags</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Blog Tags </h1>
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
							<h4 class="panel-title"> Edit Blog Tags</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
			<form role="form"  method="POST"  enctype="multipart/form-data">
              <div class="box-body">
               
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="exampleInputPassword1">Title</label>
							<input type="text" name="title" value="<?= $brec['title']; ?>" class="form-control" id="title" placeholder="Enter Title Here!">
						</div>
				
				 <div class="form-group">
                  <label for="exampleInputPassword1">Blog Tags URL</label>
                  <input type="text" name="url" class="form-control" id="url" value="<?= $brec['url']; ?>" placeholder="Enter Explore Package URL">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Position</label>
                  <input type="text" name="sort" class="form-control" id="exampleInputPassword1" value="<?= $brec['sort']; ?>">
                </div>
         
            
                <div class="form-group">
                <input type="radio" value="1" id="optionsRadios3" name="status" <?php if($brec['status']=='1'){ echo 'checked';}?>>
                <label for="optionsRadios3">Active</label>
                
                <input type="radio" value="0" id="optionsRadios4" name="status" <?php if($brec['status']=='0'){ echo 'checked';}?>>
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
    window.onload = function() {
    var src = document.getElementById("title"),
        dst = document.getElementById("url");
    src.addEventListener('input', function() {
        dst.value = src.value;
    });
  }

</script>
    	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
		});
	</script>
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
</body>
</html>
