<?php
require('checksession.php'); 
require('../inc/function.php');   

$b=$_REQUEST['cid'];
$bdata=mysqli_query($conn,"SELECT * FROM `tbl_blogcategory` where `id`='$b'");
$brec=mysqli_fetch_array($bdata);
if(isset($_POST['update']))
{
  $heading = mysqli_real_escape_string($conn,$_POST['heading']); 
  $prourls = mysqli_real_escape_string($conn,$_POST['prourl']);
  $prourrl = str_replace(array( '\'', '"', ' ', ',' , ';', '*', ',', '/', '&', '_', '$', '--', '-', '<', '>' ), '-', $prourls);
  $prourl = strtolower($prourrl);
  $position = mysqli_real_escape_string($conn,$_POST['position']);
  $status = mysqli_real_escape_string($conn,$_POST['status']);

    $query=mysqli_query($conn,"UPDATE `tbl_blogcategory` SET `name`='$heading', `sort`='$position',`status`='$status',`url`='$prourl' WHERE `id`='$b'");
      
  
    if($query==true)
    {
      $_SESSION['success']="Blog Category updated successfully";
      header("refresh:3;url=manage-blogcategory.php");		
     
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

	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
	<!-- begin #page-container -->
	<?php require("includes/header.php"); ?>
	<!-- end #header -->	
	<!-- begin #sidebar -->
	<?php require("includes/left.php"); ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;"> Blog Category Management</a></li>
				<li class="breadcrumb-item active">Edit Blog Category</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a>Manage Blog Category</h1>
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
							<h4 class="panel-title">Edit Blog Category</h4>
						</div>
						<!-- end panel-heading -->
						
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST"  enctype="multipart/form-data">
              <div class="box-body">
             
              
                <div class="form-group">
                  <label for="heading">Category Name</label>
                  <input type="text"  name="heading" class="form-control" id="name" value="<?= $brec['name']; ?>">
                </div>

				<div class="form-group">
                    <label for="heading">Category URL<code>Same as Category name & avoid Special Characters</code></label>
                    <input type="text"  name="prourl" class="form-control" id="url" placeholder="Enter Category Url" value="<?= $brec['url']; ?>">
                </div>

                
                <div class="form-group">
                  <label for="exampleInputPassword1">Sort Number</label>
                  <input type="number" name="position" class="form-control" id="exampleInputPassword1" value="<?= $brec['sort']; ?>">
                </div>
                

                <div class="form-group row m-b-10">
                  <label class="col-md-1 col-form-label">Status :-</label>
                  <div class="col-md-9">
                    <div class="radio radio-css radio-inline">
                      <input type="radio" name="status" id="optionsRadios4" value="1" <?php if($brec['status']=='1'){ echo 'checked';}?>>
                      <label for="optionsRadios4">Active</label>
                    </div>
                    <div class="radio radio-css radio-inline">
                      <input type="radio" name="status" id="optionsRadios3" value="0" <?php if($brec['status']=='0'){ echo 'checked';}?>>
                      <label for="optionsRadios3">Inactive</label>
                    </div>
                  </div>
                </div>
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="update" class="btn btn-primary">Click Here To Update</button>
                <input id="reset" type="reset" class="btn btn-warning" value="reset" name="reset" /> 
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
			CKEDITOR.replace( 'editor1' );
		});
</script>
<!------------------>

<script>
    window.onload = function() {
    var src = document.getElementById("name"),
        dst = document.getElementById("url");
    src.addEventListener('input', function() {
        dst.value = src.value;
    });
  }

</script>
<!----End Get Image----->


</body>
</html>
