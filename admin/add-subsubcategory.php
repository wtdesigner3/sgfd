<?php
require('checksession.php'); 
include '../inc/function.php';     
if(isset($_POST['submit']))
{  
    $category = mysqli_real_escape_string($conn,$_POST['category']);
	$subcategory = mysqli_real_escape_string($conn,$_POST['subcategory']);
	$heading = mysqli_real_escape_string($conn,$_POST['heading']);
	$metatag = mysqli_real_escape_string($conn,$_POST['metatag']);
	$keyword = mysqli_real_escape_string($conn,$_POST['keyword']);
	$metadesc = mysqli_real_escape_string($conn,$_POST['metadescription']);
	$position = mysqli_real_escape_string($conn,$_POST['position']);
	$description = mysqli_real_escape_string($conn,$_POST['description']);
	$status = mysqli_real_escape_string($conn,$_POST['status']);
	$bimage=$_FILES['bimage']['name'];
  if($bimage!='')
  {
    $bimage=time()."_".$bimage;
		move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/products/".$bimage);
  }
  else
  {
    $bimage='';

  }

		$query=mysqli_query($conn,"INSERT INTO `tbl_subsubcategory`(`id`, `category_id`, `subcategory_id`, `name`, `title`, `keyword`, `metadesc`, `sort`, `desc`, `status`,`image`) VALUES ('','$category','$subcategory','$heading','$metatag','$keyword','$metadesc','$position','$description','$status','$bimage')");
		if($query==true)
		{
		$_SESSION['success']="Sub-Sub Category Inserted successfully";
		header("refresh:3;url=manage-subsubcategory.php");	
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
	<!-- end #header -->	
	<!-- begin #sidebar -->
	<?php require("includes/left.php"); ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Category Management</a></li>
				<li class="breadcrumb-item active">Add Sub-Subcategory</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Manage Sub-Subcategory <small></small></h1>
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
							<h4 class="panel-title">Add Sub-Subcategory</h4>
						</div>
						<!-- end panel-heading -->
						
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST"  enctype="multipart/form-data">
              <div class="box-body">
              
              <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    <label for="heading">Select Category</label>
                      <select name="category" class="form-control" onchange="test(this.value)" required>
                        <option >Select Category</option>
                              <?php
                                $cdata=mysqli_query($conn,"SELECT * FROM `tbl_category` WHERE  `status`='1' and is_page='Submenu'");
                                while($crec=mysqli_fetch_array($cdata))
                                {
                              ?>    
                                <option value="<?= $crec['id']; ?>"><?= $crec['name']; ?></option>
                              <?php 
                              } 
                              ?>      
                      </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label for="heading">Select Subcategory </label>
                      <select name="subcategory" class="form-control" id="sub" required>
                        <option >Select Sub Category</option>   
                      </select>
                    </div>

                </div>
              </div>


               
              
                <div class="form-group">
                  <label for="heading">Sub Sub Category  Title</label>
                  <input type="text"  name="heading" class="form-control" id="heading" placeholder="Enter Page Title(Heading)">
                </div>
              
                
                <div id="myDIV" style="display:none;border: 1px solid #000; padding: 9px;"> 
                 <div class="form-group">
                  <label for="metatag">Meta Title</label>
                  <input type="text" name="metatag" id="metatag" placeholder="Meta Title" class="form-control" >
                 </div>
                 
                  <div class="form-group">
                  <label for="keyword">Meta Keyword</label>
                  <textarea name="keyword" id="keyword" placeholder="Meta Keyword" class="form-control" ></textarea>
                 </div>
                 
                 <div class="form-group">
                  <label for="metadescription">Meta Description</label>
                  <textarea name="metadescription" id="metadescription" placeholder="Meta Description" class="form-control" ></textarea>
                 </div>
                 </div>
                
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Sort Number</label>
                          <input type="number" name="position" class="form-control" id="exampleInputPassword1" placeholder="1-10">
                        </div>  
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Image File</label>
                          <input type="file" name="bimage" class="form-control" id="exampleInputPassword1" >
                          <p class="help-block">Image dimension must be 770 X 600 & must be jpg format</p>
                      </div>
                    </div>
                  </div>

                  
                
                 
                
                
                <div class="form-group">
                  <label>Description</label>
                  <textarea  name="description" class="form-control" id="editor1" placeholder="Enter text ..." rows="12"></textarea>
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
                <button type="button" onclick="myFunction()" class="btn btn-warning">Seo tools</button>
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
	initSample();
CKEDITOR.replace('editor1', {
    filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
});
CKEDITOR.replace('editor2', {
    filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
});
});
</script>
<!------------------------>
<script>
function test(t)
{
  var obj=new XMLHttpRequest();
  obj.open("GET","ajax/subcategory.php?data="+t,true);
  obj.send();
  obj.onreadystatechange= function(){
    if(obj.readyState==4)
    {
      document.getElementById("sub").innerHTML=obj.responseText;
    }
  }
}
</script>
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
