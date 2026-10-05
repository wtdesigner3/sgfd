<?php
require('checksession.php'); 
include '../inc/function.php';     

$b=$_REQUEST['bid'];
$bdata=mysqli_query($conn,"SELECT * FROM `tbl_category` where `id`='$b'");
$brec=mysqli_fetch_array($bdata);
if(isset($_POST['update']))
{

  $heading = mysqli_real_escape_string($conn,$_POST['heading']); 
  	$producturl = mysqli_real_escape_string($conn, $_POST['url']);
    $purl = str_replace(array('\'', '"', ' ', ',', ';', '.', '!', '@', '(', ')', '(', '#', '^', '*', ',', '/', '&', '_', '$', '--', '-', '<', '>', '%','=',':','?','[',']','~','+','`','{','}','|'), '-', $producturl);
    $prourl = strtolower($purl);
  $metatag = mysqli_real_escape_string($conn,$_POST['metatag']);  
  $keyword = mysqli_real_escape_string($conn,$_POST['keyword']); 
  $metadesc = mysqli_real_escape_string($conn,$_POST['metadescription']);  
  $position = mysqli_real_escape_string($conn,$_POST['position']); 
  $description = mysqli_real_escape_string($conn,$_POST['description']);  
  $status = mysqli_real_escape_string($conn,$_POST['status']); 
  $radio_css_inline = mysqli_real_escape_string($conn,$_POST['radio_css_inline']); 
  $old = mysqli_real_escape_string($conn,$_POST['oldimg']); 
  $old2 = mysqli_real_escape_string($conn,$_POST['oldimg2']);
  $alt = mysqli_real_escape_string($conn,$_POST['alt']);  
  
    $bimage=$_FILES['bimage']['name'];
    if($bimage!='')
    {
      $bimage=time()."_".$bimage;      
      @unlink("../uploads/products/".$old); 
      move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/products/".$bimage);

    }
    else{
      $bimage=$old;
    }
   
    $broadimage=$_FILES['broadimage']['name'];
    if($broadimage!='')
    {
      $broadimage=time()."_".$broadimage;      
      @unlink("../uploads/products/".$old2); 
      move_uploaded_file($_FILES["broadimage"]["tmp_name"], "../uploads/products/".$broadimage);

    }
    else{
      $broadimage=$old2;
    }
      $query=mysqli_query($conn,"UPDATE `tbl_category` SET `broadimage`='$broadimage',`alt`='$alt',`name`='$heading',`url`='$prourl',`title`='$metatag', `keyword`='$keyword', `metadesc`='$metadesc', `sort`='$position', `image`='$bimage', `desc`='$description', `status`='$status',`is_page`='$radio_css_inline' WHERE `id`='$b'");
  
      if($query==true)
        {
    $_SESSION['success']="Category updated successfully";
    header("refresh:3;url=manage-category.php");    
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
				<li class="breadcrumb-item"><a href="javascript:;">Category Management</a></li>
				<li class="breadcrumb-item active">Edit Category</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Category </h1>
		
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
							<h4 class="panel-title">Edit Category</h4>
						</div>
						<!-- end panel-heading -->
						
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST"  enctype="multipart/form-data">
              <div class="box-body">
             
              
                <div class="form-group">
                  <label for="heading">Category Name</label>
                  <input type="text"  name="heading" class="form-control" id="heading" value="<?= $brec['name']; ?>">
                </div>
                 <div class="form-group">
                    <label for="heading">Category URL<code>Same as Category name & avoid Special Characters</code></label>
                    <input type="text" name="url" class="form-control" value="<?= $brec['url']; ?>" id="url" placeholder="Enter Category Url" required>
                </div>
                <div class="form-group">
                  <label for="bannerlink">Image File</label>
                  <input type="file"  name="bimage"  class="form-control" id="bannerlink">
                  <input type="hidden" name="oldimg"  value="<?= $brec['image']; ?>">
                  <img src="../uploads/products/<?= $brec['image']; ?>" width="20%" >
                  <p class="help-block">Image dimension must be 1600 X 600 & must be jpg format</p>
                </div>
                  <div class="form-group">
                  <label for="banner">Alt</label>
                  <input type="text" name="alt" class="form-control" value="<?= $brec['alt']; ?>">
                </div>
                 <div class="form-group">
                  <label for="bannerlink">Breadcrumb Image File</label>
                  <input type="file"  name="broadimage"  class="form-control" id="bannerlink">
                  <input type="hidden" name="oldimg2"  value="<?= $brec['broadimage']; ?>">
                  <p class="help-block">Image dimension must be 1920 X 500 & must be jpg format</p>
                  <?php
                  if($brec['broadimage']>0){
                  ?>
                  <img src="../uploads/products/<?= $brec['broadimage']; ?>" width="20%" >
                <?php
                  }
                ?>
                </div>
                	<div class="form-group">
					<label for="exampleInputPassword1">Sort Number</label>
					<input type="number" name="position" class="form-control" id="exampleInputPassword1" value="<?= $brec['sort']; ?>">
				</div>
      
                <div class="form-group row m-b-10">
                  <label class="col-md-1 col-form-label">Menu For :-</label>
                  <div class="col-md-9">
                    <div class="radio radio-css radio-inline">
                      <input type="radio" name="radio_css_inline" id="inlineCssRadio1" value="Submenu"  <?php if($brec['is_page']=="Submenu"){echo "checked"; } ?>>
                      <label for="inlineCssRadio1">Submenu</label>
                    </div>
                    <div class="radio radio-css radio-inline">
                      <input type="radio" name="radio_css_inline" id="inlineCssRadio2" value="Newpage" <?php if($brec['is_page']=="Newpage"){echo "checked"; } ?>>
                      <label for="inlineCssRadio2">New Page</label>
                    </div>
                  </div>
                </div>
              
              <div class="Newpage box">  
            
                <div class="form-group">
                  <label>Description</label>
                  <textarea  name="description" class="form-control" id="editor1" placeholder="Enter text ..." rows="6"><?= $brec['desc']; ?></textarea>
                </div>

              

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
              

                <div id="dvPassport" style="display:none; border: 1px solid #242a30;padding: 10px;background: #fdfbef;"> 
                 <div class="form-group">
                  <label for="metatag">Meta Title</label>
                  <input type="text" name="metatag" id="metatag" value="<?= $brec['title']; ?>" class="form-control" >
                 </div>
                 
                  <div class="form-group">
                  <label for="keyword">Meta Keyword</label>
                  <textarea name="keyword" id="keyword" class="form-control" ><?= $brec['keyword']; ?></textarea>
                 </div>
                 
                 <div class="form-group">
                  <label for="metadescription">Meta Description</label>
                  <textarea name="metadescription" id="metadescription"  class="form-control" ><?= $brec['metadesc']; ?></textarea>
                 </div>
                </div><br>
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="update" class="btn btn-primary">Click Here To Update</button>
                <input id="btnPassport" type="button" class="btn btn-warning" value="Use Seo tools" name="btnPassport" /> 
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
  defult();
CKEDITOR.replace('editor1', {
    filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
});
CKEDITOR.replace('editor2', {
    filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
});
});
</script>
<!------------------>
<script>
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});

function defult()
{
 
    var inputValue = $('input[type="radio"]:checked').attr("value");
    if(inputValue=="Submenu")
    {
      var targetBox = $("." + inputValue);
      $(".box").not(targetBox).hide();
      $(targetBox).show();
    }
    else{
      var targetBox = $("." + inputValue);
      $(".box").not(targetBox).hide();
      $(targetBox).show();
    }
   
    
}

</script>
<!----Seo tool----->
<!----Seo tool----->  
<script type="text/javascript">
$(function () {
$("#btnPassport").click(function () {
if ($(this).val() == "Use Seo tools") {
$("#dvPassport").show();
$(this).val("Close Seo tools");
} else {
$("#dvPassport").hide();
$(this).val("Use Seo tools");
}
});
});
</script> 
<!----Get Image----->
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
<!----End Get Image----->
<script>
    window.onload = function() {
    var src = document.getElementById("heading"),
        dst = document.getElementById("url");
    src.addEventListener('input', function() {
        dst.value = src.value;
    });
  }

</script>

</body>
</html>
