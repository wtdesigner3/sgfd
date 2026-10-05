<?php
require('checksession.php'); 
require('../inc/function.php');
$idd=$_REQUEST['idd'];
$b=$_REQUEST['bid'];
$bdata=mysqli_query($conn,"SELECT * FROM `tbl_specifications` where `id`='$b'");
$brec=mysqli_fetch_array($bdata);
if(isset($_POST['update']))
{
   $sort = mysqli_real_escape_string($conn,$_POST['sort']);
   $title = mysqli_real_escape_string($conn,$_POST['title']);
   $alt = mysqli_real_escape_string($conn,$_POST['alt']);
   $desc = mysqli_real_escape_string($conn,$_POST['desc']);
   $status = mysqli_real_escape_string($conn,$_POST['status']); 
   $old = mysqli_real_escape_string($conn,$_POST['oldimg']); 
   $bimage=$_FILES['bnr_image']['name'];
   if($bimage!="")
   {
    $bimage=time()."_".$bimage;
    @unlink("../uploads/products/".$old); 
    move_uploaded_file($_FILES["bnr_image"]["tmp_name"], "../uploads/products/".$bimage);

   }
    else
   {
	  $bimage=$brec['ach_image'];
   }
   $query=mysqli_query($conn,"UPDATE `tbl_specifications` SET `p_id`='$idd',`title`='$title',`alt`='$alt',`ach_image`='$bimage',`description`='$desc',`sort`='$sort',`status`='$status' WHERE `id`='$b'");
   if($query==true)
      {
	  $_SESSION['success']="Specifications Updated Successfully";	
	  header("refresh:3;url=manage-specifications.php?idd=$idd");
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
				<li class="breadcrumb-item"><a href="javascript:;">Specifications Management</a></li>
				<li class="breadcrumb-item active">Edit Specifications</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Specifications</h1>
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
							<h4 class="panel-title"> Edit Specifications</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
			<form role="form"  method="POST"  enctype="multipart/form-data">
              <div class="box-body">
			  <div class="row">
				  <div class="col-sm-12">
						<div class="form-group">
							<label for="exampleInputPassword1">Title</label>
							<input type="text" name="title" class="form-control" id="exampleInputPassword1" value="<?= $brec['title']; ?>">
						</div>
				  </div>
				  <div class="col-sm-12">
						<div class="form-group">
							<label for="exampleInputPassword1">Description</label>
							<textarea name="desc" class="form-control" id="editor1"><?= $brec['description']; ?></textarea>
						</div>
				  </div>
				  
				  <div class="col-sm-6">
    				<div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" name="bnr_image" class="form-control" id="exampleInputFile">
                      <input type="hidden" name="oldimg"  value="<?= $brec['ach_image']; ?>">
                       <p class="help-block">Image dimension must be 1200 X 780 & must be jpg format</p>
                       <img src="../uploads/products/<?= $brec['ach_image']; ?>" style="width:20%;">
                    </div>
				  </div>
				  	<div class="col-sm-6">
						<div class="form-group">
							<label for="exampleInputPassword1">Alt</label>
							<input type="text" name="alt" class="form-control" id="exampleInputPassword1" value="<?= $brec['alt']; ?>" placeholder="Enter Alt">
						</div>
					</div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Position</label>
                      <input type="text" name="sort" class="form-control" id="exampleInputPassword1" value="<?= $brec['sort']; ?>">
                      </div>
    				</div>
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
	});
</script>
</body>
</html>
