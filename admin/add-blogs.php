<?php
require('checksession.php'); 
require('../inc/function.php');

if(isset($_POST['submit'])){
	$title = mysqli_real_escape_string($conn,$_POST['title']);
	$category = mysqli_real_escape_string($conn,$_POST['category']);
	$tag= mysqli_real_escape_string($conn,$_POST['tag']);
	$prourls = mysqli_real_escape_string($conn,$_POST['prourl']);
	$prourrl = str_replace(array( '\'', '"', ' ', ',' , ';', '*', ',', '/', '&', '_', '$', '--', '-', '<', '>','.','?' ), '-', $prourls);
	$prourl = strtolower($prourrl);

	$desc = mysqli_real_escape_string($conn,$_POST['desc']);
	$status = mysqli_real_escape_string($conn,$_POST['status']); 
	$date = mysqli_real_escape_string($conn,$_POST['date']); 
		$sort = mysqli_real_escape_string($conn,$_POST['sort']); 

	$metatag = mysqli_real_escape_string($conn,$_POST['metatag']);
	$keyword = mysqli_real_escape_string($conn,$_POST['keyword']);
	$metadesc = mysqli_real_escape_string($conn,$_POST['metadescription']);
		$alt = mysqli_real_escape_string($conn,$_POST['alt']); 
		$alt2 = mysqli_real_escape_string($conn,$_POST['alt2']); 
	$bimages=$_FILES['bimage']['name'];
	if($bimages!=''){
        $bimage=time()."_".$bimages;
	    move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/blogs/".$bimage);
	}
	else{
	    $bimage=0;	
	}
	$broadimages=$_FILES['broadimage']['name'];
	if($broadimages!='')
	{
		$broadimage=time()."_".$broadimages;
		@unlink("../uploads/blogs/".$old2);
		move_uploaded_file($_FILES["broadimage"]["tmp_name"], "../uploads/blogs/".$broadimage);
	}
	else{
		$broadimage=$old2;	
	}
	$query=mysqli_query($conn,"INSERT INTO `tbl_blogs`(`b_image`,`b_alt`,`broad_image`,`b_alt2`,`b_category`,`b_tag`, `b_title`,`b_url`, `b_description`,`b_sort`, `b_status`,`b_date`, `metatag`, `metakeyword`, `metadesc`) VALUES ('$bimage','$alt','$broadimage','$alt2','$category','$tag','$title','$prourl', '$desc','$sort','$status','$date','$metatag','$keyword','$metadesc')");
	if($query==true)
	{
		$_SESSION['success']="Blog Added successfully";
		header("refresh:3;url=manage-blogs.php");
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
				<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
				<li class="breadcrumb-item active">Add Blogs</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Blogs</h1>
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
							<h4 class="panel-title">Add Blogs</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
			<form role="form"  method="POST"  enctype="multipart/form-data">
              <div class="box-body">
			 
			    <div class="form-group d-none">
                  <label for="title">Categories</label>
                  <select name="category" id="category" class="form-control">
					  <option value="">Select Category</option>
					  <?php
					  	$blogCategories=mysqli_query($conn,"SELECT * FROM `tbl_blogcategory` where status='1' order by sort asc");
						  if(mysqli_num_rows($blogCategories)>0)
						  {
							  while($categoryBlog=mysqli_fetch_assoc($blogCategories))
							  {
								  ?>
								  	<option value="<?= $categoryBlog['id']; ?>"><?= $categoryBlog['name']; ?></option>
								  <?php
							  }
						  }
					  ?>
				  </select>
                </div>
			 
			  <div class="form-group d-none">
                  <label for="title">Choose Blog Tag</label>
                  <input type="text" name="tag" class="form-control" id="tag-input" placeholder="Choose Blog Tags Here!">
                </div>
                 <div class="form-group d-none">
                        <label for="title">Available Tags:</label>
                        <select class="form-control" id="tag-select" multiple>
                          
                            <!-- Add more options as needed -->
                        </select>
                    </div>

			    <div class="form-group">
                  <label for="title"> Blog Title</label>
                  <input type="text" name="title" class="form-control" id="name" placeholder="Enter  Blog Title">
                </div>

				<div class="form-group">
                    <label for="heading">Blog URL<code>Same as Blog name & avoid Special Characters</code></label>
                    <input type="text"  name="prourl" class="form-control" id="url" placeholder="Enter Blog Url" required>
                </div>


                <div class="form-group">
                  <label for="bannerlink">Blog Description</label>
                  <textarea  name="desc"  placeholder="Enter  Description" class="form-control" id="editor1"></textarea>
                </div>     
               

				<div class="row">
					
					<div class="col-sm-6">
						<div class="form-group">
							<label for="exampleInputPassword1">Blog Image</label>
							<input type="file" name="bimage" class="form-control" id="exampleInputPassword1" multiple>
							<p class="help-block">Image dimension must be 1300 X 721 px & must be jpg format</p>
						</div>
					</div>
				 <div class="col-sm-6">
				 <div class="form-group">
                  <label for="title">Image Alt</label>
                  <input type="text" name="alt" class="form-control" placeholder="Enter Image Alt">
                </div>
                </div>
                <div class="col-sm-12">
						<div class="form-group">
							<label for="title"> Blog Date</label>
							<input type="date" name="date" class="form-control" id="banner" placeholder="Select  Blog Date">
						</div>
					</div>
				<div class="col-md-6">
                    <div class="form-group">
                  <label for="exampleInputFile">Breadcrumb Image</label>
                  <input type="file" name="broadimage" class="form-control" >
                  	<p class="help-block">Image dimension must be 1920 X 500 px & must be jpg format</p>
                </div>
                </div>
                 <div class="col-sm-6 d-none">
				 <div class="form-group">
                  <label for="title">Breadcrumb Image Alt</label>
                  <input type="text" name="alt2" class="form-control" placeholder="Enter Breadcrumb Image Alt">
                </div>
                </div>
                </div>
				    <div class="form-group">
                  <label for="exampleInputPassword1">Position</label>
                  <input type="number" name="sort" class="form-control" placeholder="1-10" >
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
                </div><br>
                
                <div class="form-group">
                    <input type="radio" value="1" id="optionsRadios3" name="status" checked>
                    <label for="optionsRadios3">Active</label>
                    <input type="radio" value="0" id="optionsRadios4" name="status">
                    <label for="optionsRadios4">Inactive</label>
                </div>
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Click To Submit Data</button>
                <button type="reset" name="reset" class="btn btn-danger">Reset</button>
				<button type="button" onclick="myFunction()" class="btn btn-warning">Seo tools</button>
              </div>
            </form>
           </div>
        </div>
     </div>
  </div>
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
<script>
    window.onload = function() {
    var src = document.getElementById("name"),
        dst = document.getElementById("url");
    src.addEventListener('input', function() {
        dst.value = src.value;
    });
  }

</script>

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

     <script>
        // Get references to the input field and select element
        const tagInput = document.getElementById('tag-input');
        const tagSelect = document.getElementById('tag-select');

        // Add an event listener to the select element
        tagSelect.addEventListener('change', function () {
            // Get the selected options and their values
            const selectedOptions = Array.from(tagSelect.selectedOptions);
            const selectedValues = selectedOptions.map(option => option.value);
            
            // Append the selected values to the input field without clearing its previous value
            tagInput.value += ', ' + selectedValues.join(', ');
        });
    </script>
</body>
</html>

</body>
</html>
