<?php
require('checksession.php');
include '../inc/function.php'; 

if(isset($_POST['submit']))
{  
	$alt = mysqli_real_escape_string($conn,$_POST['alt']);
	$location = mysqli_real_escape_string($conn,$_POST['location']);	
	$officetype = mysqli_real_escape_string($conn,$_POST['officetype']);
	$branch = mysqli_real_escape_string($conn,$_POST['branch']);
	$cname = mysqli_real_escape_string($conn,$_POST['cname']);
	$phone1 = mysqli_real_escape_string($conn,$_POST['phone1']);
	$phone2 = mysqli_real_escape_string($conn,$_POST['phone2']);
	$email1 = mysqli_real_escape_string($conn,$_POST['email1']);
	$email2 = mysqli_real_escape_string($conn,$_POST['email2']);
	$map = mysqli_real_escape_string($conn,$_POST['map']);
	$status = mysqli_real_escape_string($conn,$_POST['status']);
	$sort = mysqli_real_escape_string($conn,$_POST['sort']);	
	$bimages=$_FILES['bimage']['name'];
	if($bimages!="")
	{
		$bimage=time()."_".$bimages;
		move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/contact/".$bimage);
	}
	else
	{
		$bimage="";	
	}

		
		$query=mysqli_query($conn,"INSERT INTO `tbl_contacts` (`officetype`, `branch`, `cname`, `location`, `phone1`,`phone2`,`email1`,`email2`,`bimage`,`alt`, `map`, `sort`, `status`) VALUES ('$officetype', '$branch', '$cname', '$location', '$phone1','$phone2','$email1','$email2','$bimage','$alt','$map','$sort','$status')");
		if($query==true)
		{
		$_SESSION['success']="Contact inserted successfully";
		header("refresh:3;url=manage-contacts.php");	
		}
		else 
		{
		// Message for unsuccessfull insertion
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
	<!-- end #header -->	
	<!-- begin #sidebar -->
	<?php require("includes/left.php"); ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Contact Location Management</a></li>
				<li class="breadcrumb-item active">Add Contact Location</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Add Contact Location</h1>
			<!-- end page-header -->
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
							<h4 class="panel-title">Add Contact Location</h4>
						</div>
						<!-- end panel-heading -->
						
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST"  enctype="multipart/form-data">
              <div class="box-body">
                  <div class="row">
		          <div class="col-sm-6 d-none">
						<div class="form-group">
							<label for="heading">Office Type</label>
							<input type="text"  name="officetype" class="form-control" id="heading" placeholder="Enter Office Type" >
						</div>
				  </div>
				   <div class="col-sm-6 d-none">
						<div class="form-group">
							<label for="heading">Branch</label>
							<input type="text"  name="branch" class="form-control" id="heading" placeholder="Enter Branch Name" >
						</div>
				  </div>
				  <div class="col-sm-6">
						<div class="form-group">
							<label for="heading">Location Name</label>
							<input type="text"  name="cname" class="form-control" id="heading" placeholder="Enter Location Name" >
						</div>
				  </div>
				  <div class="col-sm-6">
						<div class="form-group">
							<label for="bannerlink">Location</label>
							<input type="text"  name="location"  placeholder="Enter Location"  class="form-control" id="bannerlink">
						</div>
				  </div>
				  <div class="col-sm-6">
						<div class="form-group">
							<label for="bannerlink">Phone 1</label>
							<input type="text"  name="phone1"  placeholder="Enter Phone 1"  class="form-control" id="bannerlink">
						</div>
				  </div>
				   <div class="col-sm-6">
						<div class="form-group">
							<label for="bannerlink">Phone 2</label>
							<input type="text"  name="phone2"  placeholder="Enter Phone 2"  class="form-control" id="bannerlink">
						</div>
				  </div>
				   <div class="col-sm-6">
						<div class="form-group">
							<label for="bannerlink">Email 1</label>
							<input type="text"  name="email1"  placeholder="Enter Email 1"  class="form-control" id="bannerlink">
						</div>
				  </div>
				   <div class="col-sm-6">
						<div class="form-group">
							<label for="bannerlink">Email 2</label>
							<input type="text"  name="email2"  placeholder="Enter Email 2"  class="form-control" id="bannerlink">
						</div>
				  </div>
				  
			  </div>

               
                <div class="row">
        		  <div class="col-sm-6 d-none">
        			  <div class="form-group">
                          <label for="exampleInputFile">File input</label>
                          <input type="file" name="bimage" class="form-control" id="exampleInputFile">
                          <p class="help-block">Image dimension must be 400 X 400 & must be jpg format</p>
                        </div>
                        </div>
        			<div class="col-sm-6 d-none">
                     	<div class="form-group">
            				<label for="heading">Alt</label>
            				<input type="text"  name="alt" class="form-control" placeholder="Enter Alt" >
            			</div>
        			</div>
        			 <div class="col-sm-6">
						<div class="form-group">
							<label for="bannerlink">Map</label>
							<input type="text"  name="map"  placeholder="Enter map url"  class="form-control" id="bannerlink">
						</div>
				  </div>
        			<div class="col-sm-6">
				<div class="form-group">
                  <label for="bannerlink">Position</label>
                  <input type="number"  name="sort"  placeholder="1-10" class="form-control" id="bannerlink">
                </div>
            	</div>
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
		<!-- end #content -->
		
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
<?php require("includes/footer.php"); ?>

    	
<script>
	$(document).ready(function() {
		App.init();
		FormWysihtml5.init();
	});
</script>
<!------------------------>
<!------------------------------>
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
</body>
</html>
