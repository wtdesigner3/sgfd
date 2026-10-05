<?php
require('checksession.php');
require('../inc/function.php');

$bdata = mysqli_query($conn, "SELECT * FROM `tbl_outsourcing`");
$brec = mysqli_fetch_array($bdata);
if (isset($_POST['update'])) {
	$desc = mysqli_real_escape_string($conn, $_POST['desc']);
	$desc2 = mysqli_real_escape_string($conn, $_POST['desc2']);
	
	if($_FILES['image']['name'] != ''){
	    $image = uniqid().'.'.pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
        if (move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/outsourcing/' . $image)) {
            @unlink('../uploads/outsourcing/' . $brec['image']);
        }
	}else{
	    $image = $brec['image'];
	}
	
	$query = mysqli_query($conn, "UPDATE `tbl_outsourcing` SET `desc`='$desc', `desc2` = '$desc2', `image` = '$image'");
	if ($query == true) {
		$_SESSION['success'] = "Outsourcing Updated Successfully";
		header("refresh:3;url=manage-outsourcing.php");
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
			<li class="breadcrumb-item"><a href="javascript:;">Outsourcing Management</a></li>
			<li class="breadcrumb-item active">Edit Outsourcing</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Outsourcing</h1>
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
						<h4 class="panel-title"> Edit Outsourcing</h4>
					</div>
					<!-- begin panel-body -->
					<div class="panel-body">
						<form role="form" method="POST" enctype="multipart/form-data">
							<div class="box-body">

								<div class="form-group">
									<label for="banner"> Sub Title</label>
									<textarea name="desc" id="editor1" class="form-control" rows="3"><?= $brec['desc']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="banner">Image</label>
									<input type="file" name="image" class="form-control">
									<img src="../uploads/outsourcing/<?=$brec['image']?>" width="20%">
								</div>
								<div class="form-group">
									<label for="banner"> Sub Title below</label>
									<textarea name="desc2" id="editor2" class="form-control" rows="3"><?= $brec['desc2']; ?></textarea>
								</div>
							
							</div>
							<!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" name="update" class="btn btn-primary">Click Here To Update</button>
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

</body>

</html>