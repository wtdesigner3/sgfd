<?php
require('checksession.php');
include '../inc/function.php';
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_plant`");
$brec = mysqli_fetch_array($bdata);
if (isset($_POST['update'])) {

	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);
	  $old1 = mysqli_real_escape_string($conn,$_POST['oldimg1']); 	
	  $old2 = mysqli_real_escape_string($conn,$_POST['oldimg2']); 	
	  $old3 = mysqli_real_escape_string($conn,$_POST['oldimg3']); 	
	  $old4 = mysqli_real_escape_string($conn,$_POST['oldimg4']); 	
	  $old5 = mysqli_real_escape_string($conn,$_POST['oldimg5']); 	
	  $old6 = mysqli_real_escape_string($conn,$_POST['oldimg6']); 	
	  $old7 = mysqli_real_escape_string($conn,$_POST['oldimg7']); 
	  
	  $alt = mysqli_real_escape_string($conn,$_POST['alt']); 

      $ach_image1=$_FILES['ach_image1']['name'];
  
  if($ach_image1!='')
  {
      $ach_images1=time()."_".$ach_image1;
      @unlink("../uploads/homeproduct/".$old1);
      move_uploaded_file($_FILES["ach_image1"]["tmp_name"], "../uploads/homeproduct/".$ach_images1);
  }
  else{
      $ach_images1=$old1;	
  }
  
    $ach_image2=$_FILES['ach_image2']['name'];
    
  if($ach_image2!='')
  {
      $ach_images2=time()."_".$ach_image2;
      @unlink("../uploads/homeproduct/".$old2);
      move_uploaded_file($_FILES["ach_image2"]["tmp_name"], "../uploads/homeproduct/".$ach_images2);
  }
  else{
      $ach_images2=$old2;	
  }
  
    $ach_image3=$_FILES['ach_image3']['name'];
  if($ach_image3!='')
  {
      $ach_images3=time()."_".$ach_image3;
      @unlink("../uploads/homeproduct/".$old3);
      move_uploaded_file($_FILES["ach_image3"]["tmp_name"], "../uploads/homeproduct/".$ach_images3);
  }
  else{
      $ach_images3=$old3;	
  }
  
    $ach_image4=$_FILES['ach_image4']['name'];
  if($ach_image4!='')
  {
      $ach_images4=time()."_".$ach_image4;
      @unlink("../uploads/homeproduct/".$old4);
      move_uploaded_file($_FILES["ach_image4"]["tmp_name"], "../uploads/homeproduct/".$ach_images4);
  }
  else{
      $ach_images4=$old4;	
  }
  
    $ach_image5=$_FILES['ach_image5']['name'];
  if($ach_image5!='')
  {
      $ach_images5=time()."_".$ach_image5;
      @unlink("../uploads/homeproduct/".$old5);
      move_uploaded_file($_FILES["ach_image5"]["tmp_name"], "../uploads/homeproduct/".$ach_images5);
  }
  else{
      $ach_images5=$old5;	
  }
  
    $ach_image6=$_FILES['ach_image6']['name'];
  if($ach_image6 !='')
  {
      $ach_images6=time()."_".$ach_image6;
      @unlink("../uploads/homeproduct/".$old6);
      move_uploaded_file($_FILES["ach_image6"]["tmp_name"], "../uploads/homeproduct/".$ach_images6);
  }
  else{
      $ach_images6=$old6;	
  }
  
    $ach_image7=$_FILES['ach_image7']['name'];
  if($ach_image7!='')
  {
      $ach_images7=time()."_".$ach_image7;
      @unlink("../uploads/homeproduct/".$old7);
      move_uploaded_file($_FILES["ach_image7"]["tmp_name"], "../uploads/homeproduct/".$ach_images7);
  }
  else{
      $ach_images7=$old7;	
  }

	$query = mysqli_query($conn, "UPDATE `tbl_plant` SET `title`='$title',`subtitle`='$subtitle',`image1`='$ach_images1' ,`image2`='$ach_images2' ,`image3`='$ach_images3' ,`image4`='$ach_images4' ,`image5`='$ach_images5' ,`image6`='$ach_images6' ,`image7`='$ach_images7',`alt`='$alt',`status`='$status'");
	if ($query == true) {
		$_SESSION['success'] = "Our Manufacturing Plant Updated Successfully";
		header("refresh:3;url=manage-our-manufaturing-plant.php");
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
				<li class="breadcrumb-item"><a href="javascript:;"> Manage Our Manufacturing Plant</a></li>
				<li class="breadcrumb-item active">Edit Our Manufacturing Plant</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Our Manufacturing Plant</h1>
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
							<h4 class="panel-title"> Edit Our Manufacturing Plant</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST" enctype="multipart/form-data">
								<div class="box-body">

	                               <div class="form-group">
										<label for="banner"> Enter Title</label>
										<input type="text" name="title" class="form-control" id="" placeholder="Enter Title" value="<?= $brec['title']; ?>">
									</div>
									
									<div class="form-group">
										<label for="banner"> Enter Sub Title</label>
										<input type="text" name="subtitle" class="form-control" id="" placeholder="Enter Title" value="<?= $brec['subtitle']; ?>">
									</div>

                                        <div class="row">
										<div class="form-group col-3">
											<label for="exampleInputFile">File input 1</label>
											<input type="file" name="ach_image1" class="form-control" >
											<input type="hidden" name="oldimg1"  value="<?= $brec['image1']; ?>">
										    <p class="help-block">Image dimension must be 500 X 364 & must be jpg format</p>
											<img src="../uploads/homeproduct/<?= $brec['image1']; ?>" style="width:10%;">
										</div>
											
										<div class="form-group col-3">
											<label for="exampleInputFile">File input 2</label>
											<input type="file" name="ach_image2" class="form-control" >
											<input type="hidden" name="oldimg2"  value="<?= $brec['image2']; ?>">
										    <p class="help-block">Image dimension must be 500 X 364 & must be jpg format</p>
											<img src="../uploads/homeproduct/<?= $brec['image2']; ?>" style="width:10%;">
										</div>
											
										<div class="form-group col-3">
											<label for="exampleInputFile">File input 3</label>
											<input type="file" name="ach_image3" class="form-control" >
											<input type="hidden" name="oldimg3"  value="<?= $brec['image3']; ?>">
										    <p class="help-block">Image dimension must be 500 X 364 & must be jpg format</p>
											<img src="../uploads/homeproduct/<?= $brec['image3']; ?>" style="width:10%;">
										</div>
											
										<div class="form-group col-3">
											<label for="exampleInputFile">File input 4</label>
											<input type="file" name="ach_image4" class="form-control" >
											<input type="hidden" name="oldimg4"  value="<?= $brec['image4']; ?>">
										    <p class="help-block">Image dimension must be 500 X 364 & must be jpg format</p>
											<img src="../uploads/homeproduct/<?= $brec['image4']; ?>" style="width:10%;">
									    </div>	
									    </div>
									    
									   <div class="row">
										<div class="form-group col-3">
											<label for="exampleInputFile">File input 5</label>
											<input type="file" name="ach_image5" class="form-control" >
											<input type="hidden" name="oldimg5"  value="<?= $brec['image5']; ?>">
										    <p class="help-block">Image dimension must be 500 X 364 & must be jpg format</p>
											<img src="../uploads/homeproduct/<?= $brec['image5']; ?>" style="width:10%;">
										</div>
											
										<div class="form-group col-3">
											<label for="exampleInputFile">File input 6</label>
											<input type="file" name="ach_image6" class="form-control" >
											<input type="hidden" name="oldimg6"  value="<?= $brec['image6']; ?>">
										    <p class="help-block">Image dimension must be 500 X 364 & must be jpg format</p>
											<img src="../uploads/homeproduct/<?= $brec['image6']; ?>" style="width:10%;">
										</div>
											
										<div class="form-group col-3">
											<label for="exampleInputFile">File input 7</label>
											<input type="file" name="ach_image7" class="form-control" >
											<input type="hidden" name="oldimg7"  value="<?= $brec['image7']; ?>">
										    <p class="help-block">Image dimension must be 500 X 364 & must be jpg format</p>
											<img src="../uploads/homeproduct/<?= $brec['image7']; ?>" style="width:10%;">
										</div>
											
									    </div>

                                    <div class="form-group">
										<label for="banner"> Enter Alt</label>
										<input type="text" name="alt" class="form-control" id="" placeholder="Enter Alt" value="<?= $brec['alt']; ?>">
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