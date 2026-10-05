<?php
require('checksession.php');
require('../inc/function.php');

$bdata = mysqli_query($conn, "SELECT * FROM `tbl_privacy`");
$brec = mysqli_fetch_array($bdata);
if (isset($_POST['update'])) {
	$desc = mysqli_real_escape_string($conn, $_POST['desc']);

	$metatag = mysqli_real_escape_string($conn, $_POST['metatag']);
	$keyword = mysqli_real_escape_string($conn, $_POST['keyword']);
	$metadesc = mysqli_real_escape_string($conn, $_POST['metadescription']);


	$query = mysqli_query($conn, "UPDATE `tbl_privacy` SET `desc`='$desc',`meta_title`='$metatag',`meta_keyword`='$keyword',`meta_desc`='$metadesc'");
	if ($query == true) {
		$_SESSION['success'] = "Privacy Policy Updated Successfully";
		header("refresh:3;url=privacy-management.php");
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
			<li class="breadcrumb-item"><a href="javascript:;">Privacy & Policy Management</a></li>
			<li class="breadcrumb-item active">Edit Privacy & Policy</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Privacy & Policy</h1>
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
						<h4 class="panel-title"> Edit Privacy & Policy</h4>
					</div>
					<!-- begin panel-body -->
					<div class="panel-body">
						<form role="form" method="POST" enctype="multipart/form-data">
							<div class="box-body">
                               <div class="row">
                                 
								<div class="col-sm-12">
								<div class="form-group">
									<label for="bannerlink"> Enter Privacy & Policy</label>
									<textarea name="desc" id="editor1" class="form-control" rows="3"><?= $brec['desc']; ?></textarea>
								</div>
                                </div>
                                
								</div>
							
							
								<div id="myDIV" style="display:none;border: 1px solid #000; padding: 9px;">
									<div class="form-group">
										<label for="metatag">Meta Title</label>
										<input type="text" name="metatag" id="metatag" placeholder="Meta Title" class="form-control" value="<?= $brec['meta_title']; ?>">
									</div>

									<div class="form-group">
										<label for="keyword">Meta Keyword</label>
										<textarea name="keyword" id="keyword" placeholder="Meta Keyword" class="form-control"><?= $brec['meta_keyword']; ?></textarea>
									</div>

									<div class="form-group">
										<label for="metadescription">Meta Description</label>
										<textarea name="metadescription" id="metadescription" placeholder="Meta Description" class="form-control"><?= $brec['meta_desc']; ?></textarea>
									</div>
								</div><br>



							</div>
							<!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" name="update" class="btn btn-primary">Click Here To Update</button>
								<button type="reset" name="reset" class="btn btn-danger">Reset</button>
								<button type="button" onclick="myFunction()" class="btn btn-warning">Seo tools</button>
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