<?php
require('checksession.php');
include '../inc/function.php';
$b = $_REQUEST['bid'];
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_event` where `id`='$b'");
$brec = mysqli_fetch_array($bdata);
if (isset($_POST['update'])) {
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$category_id = mysqli_real_escape_string($conn, $_POST['add_category']);
	$subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);
	  $old = mysqli_real_escape_string($conn,$_POST['oldimg']); 
	  	  $alt = mysqli_real_escape_string($conn,$_POST['alt']); 

  $ach_image=$_FILES['image']['name'];
  if($ach_image!='')
  {
      $ach_images=time()."_".$ach_image;
      @unlink("../uploads/event/".$old);
      move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/event/".$ach_images);
  }
  else{
      $ach_images=$old;	
  }


	$query = mysqli_query($conn, "UPDATE `tbl_event` SET `title`='$title',`text`='$subtitle',`image`='$ach_images',`alt`='$alt',`sort`='$position',`status`='$status', `category_id`='$category_id' WHERE `id`='$b'");
	if ($query == true) {
		$_SESSION['success'] = "Event Updated Successfully";
		header("refresh:3;url=manage-event.php");
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
				<li class="breadcrumb-item"><a href="javascript:;"> Manage Event</a></li>
				<li class="breadcrumb-item active">Edit Event</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Event</h1>
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
							<h4 class="panel-title"> Edit Event</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST" enctype="multipart/form-data">
								<div class="box-body">
								    
								     <div class="form-group">
                                      <label for="exampleInputPassword1">Add Event in Category</label>
                                      <select name="add_category" class="form-control" id="exampleInputPassword1" placeholder="Enter Event Category">
                                          <?php $mqryy = mysqli_query($conn,"select * from tbl_event_category order by `name`");
                                          while($mqryy_data= mysqli_fetch_array($mqryy)){
                                          ?>
                                          <option value="<?=$mqryy_data['id']?>" <?php if($mqryy_data['id'] == $brec['category_id']) echo "selected" ?>><?=$mqryy_data['name']?></option>
                                          <?php } ?>
                                      </select>
                                    </div>

	                               <div class="form-group">
										<label for="banner">Enter Category</label>
										<input type="text" name="title" class="form-control" id="" placeholder="Enter Achievement Title" value="<?= $brec['title']; ?>">
									</div>
                                	<div class="form-group d-none">
										<label for="banner"> Enter Subtitle</label>
										<input type="text" name="subtitle" class="form-control" id="" placeholder="Enter Achievement Subtitle" value="<?= $brec['text']; ?>">
									</div>


										<div class="form-group">
											<label for="exampleInputFile">File input</label>
											<input type="file" name="image" class="form-control" >
											<input type="hidden" name="oldimg"  value="<?= $brec['image']; ?>">
										<p class="help-block">Image dimension must be 128 X 128 & must be png format</p>
											<img src="../uploads/event/<?= $brec['image']; ?>" style="width:10%;">
											</div>
											
                    						<div class="form-group">
                    							<label for="exampleInputPassword1"> Alt</label>
                    							<input type="text" name="alt" class="form-control" id="exampleInputPassword1" value="<?= $brec['alt']; ?>" placeholder="Enter Alt">
                    						</div>
                    					

						

									<div class="form-group">
										<label for="exampleInputPassword1">Position</label>
										<input type="number" name="position" class="form-control" id="exampleInputPassword1" placeholder="1-10" value="<?= $brec['sort']; ?>">
									</div> 



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
			TableManageResponsive.init();
		});
	</script>

</body>

</html>