<?php
require('checksession.php');
require('../inc/function.php');

$bdata = mysqli_query($conn, "SELECT * FROM `tbl_work_process`");
$brec = mysqli_fetch_array($bdata);
if (isset($_POST['update'])) {
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
	
    if($_FILES['video']['name'] != ''){
        $video = uniqid().'.'.pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['video']['tmp_name'], '../uploads/homeproduct/'.$video);
        @unlink('../uploads/homeproduct/'.$brec['video']);
    }else{
        $video = $brec['video'];
    }
	
	$query = mysqli_query($conn, "UPDATE `tbl_work_process` SET `title`='$title',`subtitle`='$subtitle',`video`='$video'");
	if ($query == true) {
		$_SESSION['success'] = "Work Process Updated Successfully";
		header("refresh:3;url=manage-work-process.php");
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
			<li class="breadcrumb-item"><a href="javascript:;">Work Process Management</a></li>
			<li class="breadcrumb-item active">Edit Work Process</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Work Process</h1>
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
						<h4 class="panel-title"> Edit Work Process</h4>
					</div>
					<!-- begin panel-body -->
					<div class="panel-body">
						<form role="form" method="POST" enctype="multipart/form-data">
							<div class="box-body">

								<div class="form-group">
									<label for="banner"> Title</label>
									<input type="text" name="title" class="form-control" id="" value="<?= $brec['title']; ?>">
								</div>
								<div class="form-group">
									<label for="banner"> Sub Title</label>
									<textarea name="subtitle" id="editor1" class="form-control" rows="3"><?= $brec['subtitle']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="banner"> Video</label>
									<input type="file" name="video" class="form-control">
									<br>
									<video style="margin:-2px 0 -10px;" class="vid vsrc" width="30%" autoplay="true" muted="unmuted" webkit-playsinline="">
                                        <source src="../uploads/homeproduct/<?=$brec['video']?>" type="video/mp4">
                                    </video>
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

</body>

</html>