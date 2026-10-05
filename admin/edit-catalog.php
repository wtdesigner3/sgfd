<?php
require('checksession.php');
require('../inc/function.php');
$b=$_REQUEST['bid'];
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_catalog` where `id`='$b'");
$brec = mysqli_fetch_array($bdata);
if (isset($_POST['update'])) {
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$desc = mysqli_real_escape_string($conn, $_POST['desclong']);	
	$alt = mysqli_real_escape_string($conn, $_POST['alt']);

	$old = mysqli_real_escape_string($conn, $_POST['oldimg']);
	$old1 = mysqli_real_escape_string($conn, $_POST['oldimg1']);
	$old2 = mysqli_real_escape_string($conn, $_POST['oldimg2']);
	    $sort = mysqli_real_escape_string($conn,$_POST['sort']);
	$status = mysqli_real_escape_string($conn,$_POST['status']); 
	

	$bimage2 = $_FILES['bimage2']['name'];
	if ($bimage2 != "") {
		$bimage2 = time() . "_" . $bimage2;
		@unlink("../uploads/catalog/" . $brec['ab_image']);
		move_uploaded_file($_FILES["bimage2"]["tmp_name"], "../uploads/catalog/" . $bimage2);
	} else {
		$bimage2 = $brec['ab_image'];
	}
	
		$pdf = $_FILES['pdf']['name'];
	if ($pdf != "") {
		$pdfs = time() . "_" . $pdf;
		@unlink("../uploads/catalog/" . $brec['ab_pdf']);
		move_uploaded_file($_FILES["pdf"]["tmp_name"], "../uploads/catalog/" . $pdfs);
	} else {
		$pdfs = $brec['ab_pdf'];
	}

	$query = mysqli_query($conn, "UPDATE `tbl_catalog` SET `ab_alt`='$alt',`ab_title`='$title',`ab_desc`='$desc',`ab_image`='$bimage2',`ab_pdf`='$pdfs' ,`ab_sort`='$sort' ,`ab_status`='$status' WHERE `id`='$b'");
	if ($query == true) {
		$_SESSION['success'] = "Catalog Updated Successfully";
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
									<input type="text" name="title" class="form-control" id="" value="<?= $brec['ab_title']; ?>">
								</div>


								<div class="form-group">
									<label for="bannerlink"> Enter Description </label>
									<textarea name="desclong" id="editor2" class="form-control" rows="3"><?= $brec['ab_desc']; ?></textarea>
								</div>
							
							
                                <div class="row">
                                   <div class="col-4">
								<div class="form-group">
									<label for="exampleInputFile">Image File</label>
									<input type="file" name="bimage2" class="form-control" id="exampleInputFile">
									<input type="hidden" name="oldimg2" value="<?= $brec['ab_image']; ?>">
									<p class="help-block">Image dimension must be 605 X 412 & must be jpg format</p>
									<img src="../uploads/catalog/<?= $brec['ab_image']; ?>" style="width:10%;">
								</div>
								</div>
								<div class="col-4">
								  <div class="form-group">
									<label for="banner"> Enter Alt</label>
									<input type="text" name="alt" class="form-control" id="" value="<?= $brec['ab_alt']; ?>">
								</div>
								</div>
								<div class="col-4">
								<div class="form-group">
									<label for="exampleInputFile">PDF File</label>
									<input type="file" name="pdf" class="form-control" id="exampleInputFile">
									<input type="hidden" name="oldimg2" value="<?= $brec['ab_pdf']; ?>">
									<!--<p class="help-block">Image dimension must be 2416 X 1296 & must be jpg format</p>-->
									<?php if($brec['ab_pdf']>''){ ?>
								<a href="../uploads/catalog/<?= $brec['ab_pdf']; ?>">Download PDF</a>
								<?php } ?>
								</div>
                                </div>
								</div>

							</div>
							<!-- /.box-body -->
                            <div class="form-group">
                              <label for="exampleInputPassword1">Position</label>
                              <input type="number" name="sort" class="form-control" placeholder="1-10" value="<?= $brec['ab_sort']; ?>">
                            </div>
                            <div class="form-group">
                            <input type="radio" value="1" id="optionsRadios3" name="status" <?php if($brec['ab_status']=='1'){ echo 'checked';}?>>
                            <label for="optionsRadios3">Active</label>
                            
                            <input type="radio" value="0" id="optionsRadios4" name="status" <?php if($brec['ab_status']=='0'){ echo 'checked';}?>>
                            <label for="optionsRadios4">Inactive</label>
                            </div>
							<div class="box-footer">
								<button type="submit" name="update" class="btn btn-primary">Click Here To Update</button>
								<button type="reset" name="reset" class="btn btn-danger">Reset</button>
								<!--<button type="button" onclick="myFunction()" class="btn btn-warning">Seo tools</button>-->
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