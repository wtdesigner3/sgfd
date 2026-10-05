<?php
require('checksession.php'); 
require('../inc/function.php');

if(isset($_GET['id'])){
    
    $id = $_GET['id'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE `p_id` = '$id'"));
    
}else{
    header('Location:manage-product.php');
}

function slugify($text, string $divider = '-')
{
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, $divider);
  $text = preg_replace('~-+~', $divider, $text);
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

if(isset($_POST['submit'])){
    
	$p_showhome = mysqli_real_escape_string($conn,$_POST['p_showhome']); 
	$p_title = mysqli_real_escape_string($conn,$_POST['p_title']);
	
	$p_num = mysqli_real_escape_string($conn,$_POST['p_num']);
	$p_subtitle = mysqli_real_escape_string($conn,$_POST['p_subtitle']);
	
	$p_detail = mysqli_real_escape_string($conn,$_POST['p_detail']);
	$p_description = mysqli_real_escape_string($conn,$_POST['p_description']);
	
	$p_url = slugify(mysqli_real_escape_string($conn,$_POST['p_url']));
	
	$sort = mysqli_real_escape_string($conn,$_POST['sort']); 
	$alt = mysqli_real_escape_string($conn,$_POST['alt']); 
	$status = mysqli_real_escape_string($conn,$_POST['status']);

	$metatag = mysqli_real_escape_string($conn,$_POST['metatag']);
	$keyword = mysqli_real_escape_string($conn,$_POST['keyword']);
	$metadesc = mysqli_real_escape_string($conn,$_POST['metadescription']);
	
	$b1image=$_FILES['b1_image']['name'];
	if($b1image!=''){
        $b1images=time()."_".$b1image;
	    move_uploaded_file($_FILES["b1_image"]["tmp_name"], "../uploads/product/".$b1images);
	}
	else{
	    $b1images=$edit['p_image'];	
	}

  $b1pdf=$_FILES['b1_pdf']['name'];
	if($b1pdf!=''){
        $b1pdfs=time()."_".$b1pdf;
	    move_uploaded_file($_FILES["b1_pdf"]["tmp_name"], "../uploads/product/".$b1pdfs);
	}
	else{
	    $b1pdfs=$edit['p_pdf'];	
	}

	$query = mysqli_query($conn, "UPDATE `tbl_product` SET `p_showhome` = '$p_showhome', `p_title` = '$p_title', `p_url` = '$p_url', `p_num` = '$p_num', `p_subtitle` = '$p_subtitle', `p_detail` = '$p_detail', `p_image` = '$b1images', `p_pdf` = '$b1pdfs', `alt` = '$alt', `p_sort` = '$sort', `metatag` = '$metatag', `metakeyword` = '$keyword', `metadesc` = '$metadesc', `p_status` = '$status', `p_description` = '$p_description' WHERE `p_id` = '$id'");

	if($query==true)
	{
		$_SESSION['success']="Product Updated successfully";
		header("refresh:3;url=manage-product.php");
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
<style>
.file-input {
    display: block;
    margin-top: 5px;
}

#add-file-input {
    margin-top: 10px;
}
</style>

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
                <li class="breadcrumb-item active">Add Product</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)"
                    class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i
                        class="fa fa-arrow-left"></i></a> Manage Product</h1>
            <!-- begin row -->
            <div class="row">
                <!-- begin col-10 -->
                <div class="col-lg-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                                    data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                                    data-click="panel-reload"><i class="fa fa-redo"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                                    data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                                    data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Add Product</h4>
                        </div>
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <div class="box-body">


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="title">Show on home page</label>
                                                <select name="p_showhome" class="form-control"
                                                    placeholder="Enter Show On Home Page" style="width:100%">
                                                    <option value="" required>Choose One</option>
                                                    <option value="1" <?php if($edit['p_showhome'] == '1'){ echo 'selected'; } ?> >Yes</option>
                                                    <option value="0" <?php if($edit['p_showhome'] == '0'){ echo 'selected'; } ?> >No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Product Name</label>
                                                <input type="text" name="p_title" class="form-control" id="urlname"
                                                    placeholder="Enter Product Name" value="<?=$edit['p_title']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="heading">
                                                    URL<code>Same as Product name & avoid Special Characters</code></label>
                                                <input type="text" name="p_url" class="form-control" id="url"
                                                    placeholder="Enter Url" required value="<?=$edit['p_url']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="heading">Number</label>
                                                <input type="number" name="p_num" class="form-control"
                                                    placeholder="Enter number" value="<?=$edit['p_num']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-8 d-none">
                                            <div class="form-group">
                                                <label for="heading">Text</label>
                                                <input type="text" name="p_subtitle" class="form-control"
                                                    placeholder="Enter Text For Number section" value="<?=$edit['p_subtitle']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="bannerlink">Enter Short Description</label>
                                                <textarea type="text" name="p_detail" class="form-control"
                                                    id="editor4"><?=$edit['p_detail']?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="bannerlink">Enter Long Description</label>
                                                <textarea type="text" name="p_description" class="form-control"
                                                    id="editor3"><?=$edit['p_description']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Main Image</label>
                                                <input type="file" name="b1_image" class="form-control"
                                                    id="exampleInputPassword1" multiple>
                                                <p class="help-block">Image dimension must be 500 X 364 px & must be jpg
                                                    format</p>
                                                <img src="../uploads/product/<?php echo $edit['p_image'];?>" class="img-rounded height-40 width-60" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Image Alt</label>
                                                <input type="text" name="alt" class="form-control"
                                                    id="exampleInputPassword1" placeholder="Enter Image Alt" value="<?=$edit['alt']?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 d-none">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Breadcrumb Image</label>
                                                <input type="file" name="broad_image" class="form-control"
                                                    id="exampleInputPassword1" multiple>
                                                <p class="help-block">Image dimension must be 1920 X 850 px & must be
                                                    jpg format</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">PDF (catalog)</label>
                                                <input type="file" name="b1_pdf" class="form-control"
                                                    id="exampleInputPassword1">
                                                <a href="../uploads/product/<?php echo $edit['p_pdf'];?>" target="_blank">View Doc</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Position</label>
                                                <input type="number" name="sort" class="form-control"
                                                    id="exampleInputPassword1" placeholder="1-10" value="<?=$edit['p_sort']?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div id="myDIV" style="display:none;border: 1px solid #000; padding: 9px;">
                                        <div class="form-group">
                                            <label for="metatag">Meta Title</label>
                                            <input type="text" name="metatag" id="metatag" placeholder="Meta Title"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="keyword">Meta Keyword</label>
                                            <textarea name="keyword" id="keyword" placeholder="Meta Keyword"
                                                class="form-control"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="metadescription">Meta Description</label>
                                            <textarea name="metadescription" id="metadescription"
                                                placeholder="Meta Description" class="form-control"></textarea>
                                        </div>
                                    </div><br>

                                    <div class="form-group">
                                        <input type="radio" value="1" id="optionsRadios3" name="status" <?php if($edit['p_status'] == '1'){ echo 'checked'; } ?>>
                                        <label for="optionsRadios3">Active</label>
                                        <input type="radio" value="0" id="optionsRadios4" name="status" <?php if($edit['p_status'] == '0'){ echo 'checked'; } ?>>
                                        <label for="optionsRadios4">Inactive</label>
                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Click To Submit
                                        Data</button>
                                    <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                                    <button type="button" onclick="myFunction()" class="btn btn-warning">Seo
                                        tools</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
            data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    <!-- end page container -->
    <?php require("includes/footer.php"); ?>
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css"
        rel="stylesheet"> <!-- for live demo page -->
    <link href="select2-bootstrap4.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script>
    <script>
    $(function() {
        $('select').each(function() {
            $(this).select2({
                theme: 'bootstrap4',
                width: 'style',
                placeholder: $(this).attr('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        });
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
        CKEDITOR.replace('editor3', {
            filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
        });
        CKEDITOR.replace('editor4', {
            filebrowserUploadUrl: 'assets/ckeditor/samples/get_imagelink.php',
        });
    });
    </script>
    <script>
    window.onload = function() {
        var src = document.getElementById("urlname"),
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
    <script type="text/javascript">
    function getdistrict(val) {
        $.ajax({
            type: "POST",
            url: "ajax/subcat.php",
            data: 'sub_cat=' + val,
            //data1:'department_name='+val,
            success: function(data) {
                $("#packagesub").html(data);
                // alert(data);
            }
        });
    }
    </script>
    <script>
    $(document).on('click', '#add-edu', function(e) {
        e.preventDefault();
        var i = 100;
        i++;
        $html =
            "<div class='form-group'><label for='exampleInputPassword1'>Image (Detail Page)</label><input type='file' name='b2_image[]' class='form-control' id='exampleInputPassword1' multiple><p class='help-block'>Image dimension must be 500 X 500 px & must be jpg format</p></div>";
        $('#dynamic_field_edu').append($html);
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</body>

</html>