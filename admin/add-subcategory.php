<?php
require('checksession.php'); 
require '../inc/function.php';     

if(isset($_POST['submit']))
{   

	$prourls = mysqli_real_escape_string($conn,$_POST['url']);
	$prourrl = str_replace(array( '\'', '"', ' ', ',' , ';', '*', ',', '/', '&', '_', '$', '--', '-', '<', '>','.','?',')','(' ), '-', $prourls);
	$prourl = strtolower($prourrl);
	
	$category = mysqli_real_escape_string($conn,$_POST['category']); 
	$intro = mysqli_real_escape_string($conn,$_POST['intro']); 
    $heading = mysqli_real_escape_string($conn,$_POST['heading']); 
	$subtitle = mysqli_real_escape_string($conn,$_POST['subtitle']); 
	$metatag = mysqli_real_escape_string($conn,$_POST['metatag']); 
	$keyword = mysqli_real_escape_string($conn,$_POST['keyword']); 
	$metadesc = mysqli_real_escape_string($conn,$_POST['metadescription']); 
	$position = mysqli_real_escape_string($conn,$_POST['position']); 
	$description = mysqli_real_escape_string($conn,$_POST['description']); 
	$ispage = mysqli_real_escape_string($conn,$_POST['radio_css_inline']); 
	$status = mysqli_real_escape_string($conn,$_POST['status']); 
	$showhome = mysqli_real_escape_string($conn,$_POST['showhome']);
	$alt = mysqli_real_escape_string($conn,$_POST['alt']);
	$alt2 = mysqli_real_escape_string($conn,$_POST['alt2']);
	$url = mysqli_real_escape_string($conn,$_POST['url']);
	$bimage=$_FILES['bnr_image']['name'];
	if($bimage!='')
	{
		$bimage=time()."_".$bimage;
		move_uploaded_file($_FILES["bnr_image"]["tmp_name"], "../uploads/products/".$bimage);
	}
	else{
		$bimage='';
	}
	
		$bimage2=$_FILES['bnr_image2']['name'];
	if($bimage2!='')
	{
		$bimage2=time()."_".$bimage2;
		move_uploaded_file($_FILES["bnr_image2"]["tmp_name"], "../uploads/products/".$bimage2);
	}
	else{
		$bimage2='';
	}
	
		$broadimage=$_FILES['bnr_broadimage']['name'];
	if($broadimage!='')
	{
		$broadimage=time()."_".$broadimage;
		move_uploaded_file($_FILES["bnr_broadimage"]["tmp_name"], "../uploads/products/".$broadimage);
	}
	else{
		$broadimage='';
	}
	
	$query=mysqli_query($conn,"INSERT INTO `tbl_subcategory`(`category_id`, `subtitle`,`name`,`intro`,`title`, `keyword`, `metadesc`, `sort`, `image`,`image2`, `alt`,`alt2`,`broadimage`, `desc`, `status`,`is_page`,`showhp`,`url`) VALUES ('$category','$subtitle','$heading','$intro','$metatag','$keyword','$metadesc','$position','$bimage','$bimage2','$alt','$alt2','$broadimage','$description','$status','$ispage','$showhome','$prourl')");
	if($query==true)
	{
	$_SESSION['success']="Sub-category inserted successfully";
	header("refresh:3;url=manage-subcategory.php");	
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
				<li class="breadcrumb-item"><a href="javascript:;">Sub Category Management</a></li>
				<li class="breadcrumb-item active">Add Sub Category</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Manage Sub Category <small>...</small></h1>
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
							<h4 class="panel-title">Add Sub Category</h4>
						</div>
						<!-- end panel-heading -->
						
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST"  enctype="multipart/form-data">
              <div class="box-body">
             

				<div class="form-group">
					<label for="heading">Categories</label>
					<select name="category" id="category" class="form-control" required>
					    <option value="">Select Category</option>
						<?php
							$sql=mysqli_query($conn,"select * from tbl_category where status='1' and is_page='Submenu'");
							if(mysqli_num_rows($sql)>0)
							{
								while($row=mysqli_fetch_assoc($sql))
								{
									?>
									<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
									<?php
								}
							}
						?>
					</select>
				</div>
              
                <div class="form-group">
                  <label for="heading">Sub Category</label>
                  <input type="text"  name="heading" class="form-control" id="heading" placeholder="Enter Sub Category" required>
                </div>


                  <div class="form-group">
                    <label for="heading">Sub Category URL<code>Same as Subcategory name & avoid Special Characters</code></label>
                    <input type="text" name="url" class="form-control" id="url" placeholder="Enter Sub Category Url" required>
                </div>
                
                <div class="form-group row m-b-10" style="display:none">
					<label class="col-md-1 col-form-label">Menu For :-</label>
					<div class="col-md-9">
						<div class="radio radio-css radio-inline">
							<input type="radio" name="radio_css_inline" id="inlineCssRadio1" value="Submenu" checked>
							<label for="inlineCssRadio1">Submenu</label>
						</div>
						<div class="radio radio-css radio-inline">
							<input type="radio" name="radio_css_inline" id="inlineCssRadio2" value="Newpage">
							<label for="inlineCssRadio2">New Page</label>
						</div>
					</div>
				</div>
            
            <div class="Newpage box">
				<div class="form-group d-none">
                  <label for="heading">Sub Category Subtitle</label>
                  <input type="text"  name="subtitle" class="form-control" id="heading" placeholder="Enter Subcategory Subtitle">
                </div>

               <div class="form-group">
                  <label for="heading">Introduction</label>
                  <textarea  name="intro" class="form-control" placeholder="Enter Subcategory Introduction" id="editor1"></textarea>
                </div>
                <div class="row">
                <div class="col-sm-6">
                 <div class="form-group">
                  <label for="exampleInputFile">Image</label>
                  <input type="file" name="bnr_image" class="form-control" id="exampleInputFile">
                  <p class="help-block">Image dimension must be 800 X 400 & must be webp format</p>
                </div></div>
                <div class="col-sm-6">
                  <div class="form-group">
						<label for="exampleInputPassword1">Image Alt</label>
						<input type="text" name="alt" class="form-control" id="exampleInputPassword1" placeholder="Enter Image Alt">
					</div></div>
					<div class="col-sm-6 d-none">
					<div class="form-group">
                      <label for="exampleInputPassword1">Image File 2</label>
                      <input type="file" name="bnr_image2" class="form-control" id="exampleInputPassword1" >
                      <p class="help-block">Image dimension must be 500 X 500 & must be jpg format</p>
                    </div></div>
					<div class="col-sm-6 d-none">
                    <div class="form-group">
						<label for="exampleInputPassword1">Image Alt 2</label>
						<input type="text" name="alt2" class="form-control" id="exampleInputPassword1" placeholder="Enter Image Alt">
					</div></div>
					</div>
                  <div class="form-group">
                  <label for="exampleInputFile">Breadcrumb Image</label>
                  <input type="file" name="bnr_broadimage" class="form-control" id="exampleInputFile">
                  <p class="help-block">Image dimension must be 1920 X 500 & must be webp format</p>
                </div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="exampleInputPassword1">Sort Number</label>
							<input type="number" name="position" class="form-control" id="exampleInputPassword1" placeholder="1-10">
						</div>
					</div>
					<div class="col-sm-6" style="display:none;">
						<div class="form-group">
							<label for="exampleInputPassword1">Show In Home Page</label>
							<select name="showhome" id="showhome" class="form-control">
								<option value="0"> No</option>
								<option value="1"> Yes</option>
							</select>
						</div>
					</div>
				</div>
               
                
                <div class="form-group" style="display:none">
                  <label>Description</label>
                  <textarea  name="description" class="form-control" id="editor1" placeholder="Enter text ..." rows="12"></textarea>
                </div>

				
                
            </div> 

                
                <div class="form-group row m-b-10">
					<label class="col-md-1 col-form-label">Status :-</label>
					<div class="col-md-9">
						<div class="radio radio-css radio-inline">
							<input type="radio" name="status" id="optionsRadios4" value="1" checked>
							<label for="optionsRadios4">Active</label>
						</div>
						<div class="radio radio-css radio-inline">
							<input type="radio" name="status" id="optionsRadios3" value="0">
							<label for="optionsRadios3">Inactive</label>
						</div>
					</div>
				</div>
 
				  
				<div id="dvPassport" style="display:none; border: 1px solid #242a30;padding: 10px;background: #fdfbef;"> 
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
                 </div>  <br/>
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Click Here To Submit</button>
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
<!------------------>

<script>
    window.onload = function() {
    var src = document.getElementById("heading"),
        dst = document.getElementById("url");
    src.addEventListener('input', function() {
        dst.value = src.value;
    });
  }

</script>
<script>
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});
</script>
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
</body>
</html>
