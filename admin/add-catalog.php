<?php
require('checksession.php');
require('../inc/function.php');

if (isset($_POST['submit'])) {
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$desc = mysqli_real_escape_string($conn, $_POST['desclong']);	
	$alt = mysqli_real_escape_string($conn, $_POST['alt']);

	$old = mysqli_real_escape_string($conn, $_POST['oldimg']);
	$old1 = mysqli_real_escape_string($conn, $_POST['oldimg1']);
	$old2 = mysqli_real_escape_string($conn, $_POST['oldimg2']);
$status = mysqli_real_escape_string($conn,$_POST['status']); 
$sort = mysqli_real_escape_string($conn,$_POST['sort']); 
	

	$bimage2 = $_FILES['bimage2']['name'];
	if ($bimage2 != "") {
		$bimage2 = time() . "_" . $bimage2;
		@unlink("../uploads/catalog/" . $brec['ab_image']);
		move_uploaded_file($_FILES["bimage2"]["tmp_name"], "../uploads/catalog/" . $bimage2);
	} else {
		$bimage2 = '';
	}
	
		$pdf = $_FILES['pdf']['name'];
	if ($pdf != "") {
		$pdfs = time() . "_" . $pdf;
		@unlink("../uploads/catalog/" . $brec['ab_pdf']);
		move_uploaded_file($_FILES["pdf"]["tmp_name"], "../uploads/catalog/" . $pdfs);
	} else {
		$pdfs = '';
	}

	$query = mysqli_query($conn, "INSERT INTO `tbl_catalog` (`ab_alt`, `ab_title`, `ab_desc`, `ab_image`, `ab_pdf`,`ab_status`,`ab_sort`)  VALUES ('$alt', '$title', '$desc', '$bimage2', '$pdfs','$status','$sort')");
	if ($query == true) {
		$_SESSION['success'] = "Catalog Inserted Successfully";
		header("refresh:3;url=manage-catalog.php");
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
			<li class="breadcrumb-item"><a href="javascript:;">Catalog Management</a></li>
			<li class="breadcrumb-item active">Edit Catalog</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Catalog</h1>
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
						<h4 class="panel-title"> Edit Catalog</h4>
					</div>
					<!-- begin panel-body -->
					<div class="panel-body">
						<form role="form" method="POST" enctype="multipart/form-data">
							<div class="box-body">

								<div class="form-group">
									<label for="banner"> Enter Title</label>
									<input type="text" name="title" class="form-control" id="" placeholder="Enter Title">
								</div>


								<div class="form-group">
									<label for="bannerlink"> Enter Description </label>
									<textarea name="desclong" id="editor2" class="form-control" rows="3"></textarea>
								</div>
							
							
                                <div class="row">
                                   <div class="col-4">
								<div class="form-group">
									<label for="exampleInputFile">Image File</label>
									<input type="file" name="bimage2" class="form-control" id="exampleInputFile">
									<p class="help-block">Image dimension must be 388 X 500 & must be jpg format</p>
								</div>
								</div>
								<div class="col-4">
								  <div class="form-group">
									<label for="banner"> Enter Alt</label>
									<input type="text" name="alt" class="form-control" id="" placeholder="Enter alt">
								</div>
								</div>
								<div class="col-4">
								<div class="form-group">
									<label for="exampleInputFile">PDF File</label>
									<input type="file" name="pdf" class="form-control" id="exampleInputFile">
								</div>
                                </div>
								</div>

							</div>
							<!-- /.box-body -->
                        <div class="form-group">
                          <label for="exampleInputPassword1">Position</label>
                          <input type="number" name="sort" class="form-control" placeholder="1-10" >
                        </div>
                        <div class="form-group">
                            <input type="radio" value="1" id="optionsRadios3" name="status" checked>
                            <label for="optionsRadios3">Active</label>
                            <input type="radio" value="0" id="optionsRadios4" name="status">
                            <label for="optionsRadios4">Inactive</label>
                        </div>
							<div class="box-footer">
								<button type="submit" name="submit" class="btn btn-primary">Click Here To Submit</button>
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