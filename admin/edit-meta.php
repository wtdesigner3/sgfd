<?php
require('checksession.php');
include '../inc/function.php';

$b = $_REQUEST['eid'];
// echo "SELECT * FROM `tbl_client` where `id`='$b'";die();
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_meta` where `id`='$b'");
$brec = mysqli_fetch_array($bdata);

if (isset($_POST['update'])) {
	$page = mysqli_real_escape_string($conn, $_POST['page']);
	$meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
	$meta_keyword = mysqli_real_escape_string($conn,$_POST['meta_keyword']);
	$meta_desc = mysqli_real_escape_string($conn,$_POST['meta_desc']); 

 
	$query = mysqli_query($conn, "UPDATE `tbl_meta` SET `page`='$page',`meta_title`='$meta_title',`meta_keyword`='$meta_keyword',`meta_desc`='$meta_desc' WHERE `id`='$b'");
	if ($query == true) {
		$_SESSION['success'] = "Meta Updated Successfully";
		header("refresh:3;url=manage-meta.php");
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
				<li class="breadcrumb-item active">Edit Meta</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Client </h1>
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
							<h4 class="panel-title"> Edit Meta</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
			<form role="form" method="POST" enctype="multipart/form-data">
								<div class="box-body">

                                    <div class="form-group">
										<label for="banner"> Enter Page</label>
										<input type="text" name="page" class="form-control" placeholder="Enter Page" value="<?= $brec['page']; ?>" >
									</div>


									<div class="form-group">
										<label for="exampleInputPassword1">Meta Title</label>
										<input type="text" name="meta_title" class="form-control" id="exampleInputPassword1" placeholder="Meta Title" value="<?= $brec['meta_title']; ?>">
									</div> 
									
									<div class="form-group">
										<label for="exampleInputPassword1">Meta Keyword</label>
										<input type="text" name="meta_keyword" class="form-control" id="exampleInputPassword1" placeholder="Meta Keyword" value="<?= $brec['meta_keyword']; ?>">
									</div>
									
									<div class="form-group">
										<label for="exampleInputPassword1">Meta Desc</label>
										<input type="text" name="meta_desc" class="form-control" id="exampleInputPassword1" placeholder="Meta desc" value="<?= $brec['meta_desc']; ?>">
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
      });
</script>
<script>
    window.onload = function() {
    var src = document.getElementById("name"),
        dst = document.getElementById("url");
    src.addEventListener('input', function() {
        dst.value = src.value;
    });
  }

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