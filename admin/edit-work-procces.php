<?php
require('checksession.php'); 
require('../inc/function.php');

$b=$_REQUEST['bid'];
$bdata=mysqli_query($conn,"SELECT * FROM `tbl_visa_steps` where `vs_id`='$b'");
$brec=mysqli_fetch_array($bdata);
if(isset($_POST['update']))
{

   $sort = mysqli_real_escape_string($conn,$_POST['sort']); 
   	$alt = mysqli_real_escape_string($conn,$_POST['alt']);
   $title = mysqli_real_escape_string($conn,$_POST['title']);
   $subtitle = mysqli_real_escape_string($conn,$_POST['subtitle']);
   $status = mysqli_real_escape_string($conn,$_POST['status']); 
   $old = mysqli_real_escape_string($conn,$_POST['oldimg']); 
   $bimage=$_FILES['vs_image']['name'];
   if($bimage!="")
   {
    $bimage=time()."_".$bimage;
    @unlink("../uploads/visasteps/".$old); 
    move_uploaded_file($_FILES["vs_image"]["tmp_name"], "../uploads/workprocess/".$bimage);

   }
    else
   {
	  $bimage=$brec['vs_image'];
   }
   $query=mysqli_query($conn,"UPDATE `tbl_visa_steps` SET `vs_sort`='$sort', `vs_image`='$bimage', `alt`='$alt', `vs_status`='$status', `vs_title`='$title', `vs_subtitle`='$subtitle' WHERE `vs_id`='$b'");
   if($query==true)
      {
	  $_SESSION['success']="Work Procces Updated Successfully";	
	  header("refresh:3;url=manage-work-procces.php");
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
				<li class="breadcrumb-item"><a href="javascript:;">Work Process Steps Management</a></li>
				<li class="breadcrumb-item active">Edit Work Process Steps</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Work Process Steps </h1>
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
							<h4 class="panel-title"> Edit Work Process Step</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
			<form role="form"  method="POST"  enctype="multipart/form-data">
              <div class="box-body">
                

			  <div class="row">
				 
			
				   <div class="col-sm-12">
						<div class="form-group">
							<label for="exampleInputPassword1">Title</label>
							<input type="text" name="title" class="form-control" id="exampleInputPassword1" value="<?= $brec['vs_title']; ?>">
						</div>
				  </div>
				  <div class="col-sm-12">
						<div class="form-group">
							<label for="exampleInputPassword1">Sub Title</label>
							<input type="text" name="subtitle" class="form-control" id="exampleInputPassword1" value="<?= $brec['vs_subtitle']; ?>">
						</div>
				  </div>
			  </div>
				

                <div class="form-group d-none">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" name="vs_image" class="form-control" id="exampleInputFile">
                  <input type="hidden" name="oldimg"  value="<?= $brec['vs_image']; ?>">
                   <p class="help-block">Image dimension must be 128 X 128 & must be jpg format</p>
                   <img src="../uploads/workprocess/<?= $brec['vs_image']; ?>" style="width:10%;">
                </div>
                <div class="form-group d-none">
							<label for="exampleInputPassword1">Alt</label>
							<input type="text" name="alt" class="form-control" value="<?= $brec['alt']; ?>">
						</div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Position</label>
                  <input type="text" name="sort" class="form-control" id="exampleInputPassword1" value="<?= $brec['vs_sort']; ?>">
                </div>
                
                <div class="form-group">
                <input type="radio" value="1" id="optionsRadios3" name="status" <?php if($brec['vs_status']=='1'){ echo 'checked';}?>>
                <label for="optionsRadios3">Active</label>
                
                <input type="radio" value="0" id="optionsRadios4" name="status" <?php if($brec['vs_status']=='0'){ echo 'checked';}?>>
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
