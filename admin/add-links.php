<?php
require('checksession.php'); 
include '../inc/function.php'; 

if(isset($_POST['submit']))
{ 
	$position = mysqli_real_escape_string($conn,$_POST['position']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$status = mysqli_real_escape_string($conn,$_POST['status']);
	$link = mysqli_real_escape_string($conn,$_POST['link']); 
//=============|image|============//



	$query=mysqli_query($conn,"INSERT INTO `tbl_links`(`name`,`link`,`sort`, `status`) VALUES ('$name','$link','$position','$status')");
    if($query==true)
    {
        $_SESSION['success']="Links Inserted successfully";
        header("refresh:3;url=manage-links.php");
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
				<li class="breadcrumb-item"><a href="javascript:;"> Manage Links</a></li>
				<li class="breadcrumb-item active">Add Links</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Links</h1>
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
							<h4 class="panel-title">Add Links</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
			<form role="form"  method="POST"  enctype="multipart/form-data">
          

              <div class="box-body">
			  <div class="form-group">
				<label for="banner"> Enter Name</label>
				<input type="text" name="name" class="form-control" id="" placeholder="Enter Name" >
			</div>
              
                <div class="form-group">
                  <label for="exampleInputPassword1">Link</label>
                  <input type="text" name="link" class="form-control" id="exampleInputPassword1" placeholder="Enter Link">
                </div> 
                <div class="form-group">
                  <label for="exampleInputPassword1">Position</label>
                  <input type="number" name="position" class="form-control" id="exampleInputPassword1" placeholder="1-10">
                </div> 
                
                
                <div class="form-group">
                <input type="radio" value="1" id="optionsRadios3" name="status" checked>
                <label for="optionsRadios3">Active</label>
                <input type="radio" value="0" id="optionsRadios4" name="status">
                <label for="optionsRadios4">Inactive</label>
                </div>
              
              </div>
              <!-- /.box-body -->

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
	});
</script>

</body>
</html>
