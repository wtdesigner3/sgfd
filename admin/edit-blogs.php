<?php
require('checksession.php'); 
require('../inc/function.php');
$b=$_REQUEST['bid'];
$bdata=mysqli_query($conn,"SELECT * FROM `tbl_blogs` where `b_id`='$b'");
$brec=mysqli_fetch_array($bdata);
$uploadPath = "../uploads/blogs/"; 
if(isset($_POST['update']))
{
  $date = mysqli_real_escape_string($conn,$_POST['date']);
  	$tag= mysqli_real_escape_string($conn,$_POST['tag']);
  $category = mysqli_real_escape_string($conn,$_POST['category']);
	$title = mysqli_real_escape_string($conn,$_POST['title']);
  $prourls = mysqli_real_escape_string($conn,$_POST['prourl']);
  $prourrl = str_replace(array( '\'', '"', ' ', ',' , ';', '*', ',', '/', '&', '_', '$', '--', '-', '<', '>','.','?' ), '-', $prourls);
  $prourl = strtolower($prourrl);
	$desc = mysqli_real_escape_string($conn,$_POST['desc']);
	    $sort = mysqli_real_escape_string($conn,$_POST['sort']);
	$status = mysqli_real_escape_string($conn,$_POST['status']); 
  $old = mysqli_real_escape_string($conn,$_POST['oldimg']); 
    $old2 = mysqli_real_escape_string($conn,$_POST['oldimgbroad']); 

  $metatag = mysqli_real_escape_string($conn,$_POST['metatag']);
	$keyword = mysqli_real_escape_string($conn,$_POST['keyword']);
	$metadesc = mysqli_real_escape_string($conn,$_POST['metadescription']);
		$alt = mysqli_real_escape_string($conn,$_POST['alt']); 
		$alt2 = mysqli_real_escape_string($conn,$_POST['alt2']); 
  $bimages=$_FILES['bimage']['name'];
  if($bimages!='')
  {
      $bimage=time()."_".$bimages;
      @unlink("../uploads/blogs/".$old);
      move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/blogs/".$bimage);
  }
  else{
      $bimage=$old;	
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
   $query=mysqli_query($conn,"UPDATE `tbl_blogs` SET `b_image`='$bimage' ,`b_alt`='$alt' ,`broad_image`='$broadimage' ,`b_alt2`='$alt2' ,`b_category`='$category',`b_tag`='$tag', `b_title`='$title',`b_url`='$prourl',`b_description`='$desc',`b_sort`='$sort' ,`b_status`='$status',`b_date`='$date',`metatag`='$metatag',`metakeyword`='$keyword',`metadesc`='$metadesc'  WHERE `b_id`='$b'");
  if($query==true)
  {
  $_SESSION['success']="Blog Updated Successfully";	
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
				<li class="breadcrumb-item active">Edit Blogs</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Blogs </h1>
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
							<h4 class="panel-title"> Edit Blogs</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
			<form role="form"  method="POST"  enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group d-none">
                  <label for="title">Category</label>
                  <select name="category" id="category" class="form-control">
                    <option value="">Select Category</option>
                         <?php
               $sql1=mysqli_query($conn,"SELECT * FROM `tbl_blogcategory` WHERE `status`='1'");
                            while($crec_1=mysqli_fetch_array($sql1))
                            {
                             
                            if($crec_1['id']==$brec['b_category'])
                            {
                            echo "<option value='$crec_1[id]' selected> $crec_1[name]</option>";
                            }
                            else
                            {
                            echo "<option value='$crec_1[id]'>$crec_1[name]</option>";
                            }
                      } ?>  
                  </select>
                </div>
                 <div class="form-group d-none">
                  <label for="bannerlink"> Blog Tags</label>
                  <input type="text" name="tag" class="form-control" value="<?= $brec['b_tag']; ?>" >
                </div>
                <div class="form-group">
                  <label for="bannerlink"> Blog Title</label>
                  <input type="text" name="title" class="form-control" id="name" value="<?= $brec['b_title']; ?>" >
                </div>

                <div class="form-group">
                    <label for="heading">Blog URL<code>Same as Blog name & avoid Special Characters</code></label>
                    <input type="text"  name="prourl" class="form-control" id="url" placeholder="Enter Blog Url" value="<?= $brec['b_url']; ?>">
                </div>

                <div class="form-group">
                  <label for="bannerlink"> Description</label>
                  <textarea name="desc" id="editor1"  class="form-control"><?= $brec['b_description']; ?></textarea>
                </div>
               <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFile">Blog Image</label>
                  <input type="file" name="bimage" class="form-control" >
                  <input type="hidden" name="oldimg"  value="<?= $brec['b_image']; ?>">
                   <p class="help-block">Image dimension must be 1300 X 721 px & must be jpg format</p>
                   <img src="../uploads/blogs/<?= $brec['b_image']; ?>" style="width:20%;">
                </div>
                </div>
                 <div class="col-sm-6">
				 <div class="form-group">
                  <label for="title">Image Alt</label>
                  <input type="text" name="alt" class="form-control" placeholder="Enter Image Alt" value="<?= $brec['b_alt']; ?>">
                </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                  <label for="exampleInputFile">Breadcrumb Image</label>
                  <input type="file" name="broadimage" class="form-control" >
                  <input type="hidden" name="oldimgbroad"  value="<?= $brec['broad_image']; ?>">
                   <p class="help-block">Image dimension must be 1920 X 500 px & must be jpg format</p>
                   <img src="../uploads/blogs/<?= $brec['broad_image']; ?>" style="width:20%;">
                </div>
                </div>
                 <div class="col-sm-3 d-none">
				 <div class="form-group">
                  <label for="title">Breadcrumb Image Alt</label>
                  <input type="text" name="alt2" class="form-control" placeholder="Enter Breadcrumb Image Alt" value="<?= $brec['b_alt2']; ?>">
                </div>
                </div>
                </div>
                
                  <div class="form-group">
                      <label for="exampleInputPassword1"> Date</label>
                      <input type="date" name="date" class="form-control" id="exampleInputPassword1" value="<?= $brec['b_date']; ?>">
                  </div>
                   
                      <div class="form-group">
                  <label for="exampleInputPassword1">Position</label>
                  <input type="number" name="sort" class="form-control" placeholder="1-10" value="<?= $brec['b_sort']; ?>">
                </div>
                   
                <div id="myDIV" style="display:none;border: 1px solid #000; padding: 9px;"> 
                    <div class="form-group">
                      <label for="metatag">Meta Title</label>
                      <input type="text" name="metatag" id="metatag" placeholder="Meta Title" class="form-control" value="<?= $brec['metatag']; ?>">
                    </div>
                    
                      <div class="form-group">
                      <label for="keyword">Meta Keyword</label>
                      <textarea name="keyword" id="keyword" placeholder="Meta Keyword" class="form-control" ><?= $brec['metakeyword']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label for="metadescription">Meta Description</label>
                      <textarea name="metadescription" id="metadescription" placeholder="Meta Description" class="form-control" ><?= $brec['metadesc']; ?></textarea>
                    </div>
                </div><br>

              
                
                <div class="form-group">
                <input type="radio" value="1" id="optionsRadios3" name="status" <?php if($brec['b_status']=='1'){ echo 'checked';}?>>
                <label for="optionsRadios3">Active</label>
                
                <input type="radio" value="0" id="optionsRadios4" name="status" <?php if($brec['b_status']=='0'){ echo 'checked';}?>>
                <label for="optionsRadios4">Inactive</label>
                </div>
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="update" class="btn btn-primary">Click To Update Data</button>
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

</body>
</html>
