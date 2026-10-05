<?php
require('checksession.php'); 
require '../inc/function.php';     

$b=$_REQUEST['cid'];
$bdata=mysqli_query($conn,"SELECT * FROM `tbl_subsubcategory` where `id`='$b'");
$brec=mysqli_fetch_array($bdata);
if(isset($_POST['update']))
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
  $old = mysqli_real_escape_string($conn,$_POST['oldimg']);

    $bimage=$_FILES['bimage']['name'];
    if($bimage!='')
    {
      $bimage=time()."_".$bimage;
      @unlink("../uploads/products/".$old); 
      move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/products/".$bimage);
    }
    else
    {
        $bimage=$old;
    }


        $query=mysqli_query($conn,"UPDATE `tbl_subsubcategory` SET `category_id`='$category',`subcategory_id`='$subcategory',`name`='$heading', `title`='$metatag', `keyword`='$keyword', `metadesc`='$metadesc', `sort`='$position', `desc`='$description', `status`='$status',`image`='$bimage' WHERE `id`='$b'");
      if($query==true)
        {
		$_SESSION['success']="Sub-Sub-Category Updated successfully";
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
				<li class="breadcrumb-item active">Edit SubSubcategory</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Managed SubSubcategory<small>...</small></h1>
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
							<h4 class="panel-title">Edit SubSubcategory</h4>
						</div>
						<!-- end panel-heading -->
						
						<!-- begin panel-body -->
						<div class="panel-body">
							<form role="form" method="POST"  enctype="multipart/form-data">
              <div class="box-body">

              <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Select Category<span class="vd_red">*</span></label>
                            <select name="category" class="form-control" onchange="test(this.value)"  required>
                              <option disabled>Select Category</option>
                              <?php
                                $cdata=mysqli_query($conn,"SELECT * FROM `tbl_category` WHERE `status`='1' and is_page='Submenu' ");
                                while($crec=mysqli_fetch_array($cdata))
                                {
                                if($crec['id']==$brec['category_id'])
                                {
                                echo "<option value='$crec[id]' selected>$crec[name]</option>";
                                }
                                else
                                {
                                echo "<option value='$crec[id]'>$crec[name]</option>";
                                }
                          } ?>      
                            </select>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Select Subcategory<span class="vd_red">*</span></label>
                          <select name="subcategory" class="form-control" id="sub"  required>
                            <option disabled>Select Subcategory</option>
                            <?php
                              $ctdata=mysqli_query($conn,"SELECT * FROM `tbl_subcategory` WHERE `status`='1' and is_page='Submenu'");
                              while($ctrec=mysqli_fetch_array($ctdata))
                              {
                              if($ctrec['id']==$brec['subcategory_id'])
                              {
                              echo "<option value='$ctrec[id]' selected>$ctrec[name]</option>";
                              }
                              else
                              {
                              echo "<option value='$ctrec[id]'>$ctrec[name]</option>";
                              }
                        } ?>      
                          </select>
                  </div>
                </div>
              </div>
             

                <div class="form-group">
                  <label for="heading">Sub Category  Title</label>
                  <input type="text"  name="heading" class="form-control" id="heading" value="<?= $brec['name']; ?>">
                </div>
                
                <div id="myDIV" style="display:none;"> 
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
                 </div>
                

                <div class="form-group">
                    <label for="exampleInputPassword1">Sort Number</label>
                    <input type="number" name="position" class="form-control" id="exampleInputPassword1" value="<?= $brec['sort']; ?>">
                </div>
             
                
                <div class="form-group">
                  <label for="bannerlink">Image File</label>
                  <input type="file"  name="bimage"  class="form-control" id="bannerlink">
                  <input type="hidden" name="oldimg"  value="<?= $brec['image']; ?>">
                  <p class="help-block">Image dimension must be 770 X 600 & must be jpg format</p>
                  <img src="../uploads/products/<?= $brec['image']; ?>" width="200px" height="200px">
                 
                </div>

                
                <div class="form-group">
                  <label>Description</label>
                  <textarea  name="description" class="form-control" id="editor1" placeholder="Enter text ..." rows="6"><?= $brec['desc']; ?></textarea>
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
  obj.open("GET","ajax/category.php?data="+t,true);
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
