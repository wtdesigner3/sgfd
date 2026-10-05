<?php
require('checksession.php'); 
require('../inc/function.php');

if(isset($_GET['id'])){
    
    $pid = $_GET['pid'];
    $id = $_GET['id'];
    
    $prd = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE `p_id` = '$pid'"));
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_variation` WHERE `id` = '$id'"));
    
}else{
    header('Location:manage-variation.php?id='.$pid);
}

if(isset($_POST['submit'])){
	
	$sort = mysqli_real_escape_string($conn,$_POST['sort']); 
	$alt = mysqli_real_escape_string($conn,$_POST['alt']); 
	$status = mysqli_real_escape_string($conn,$_POST['status']);
	
	$b1image=$_FILES['image']['name'];
	if($b1image!=''){
        $b1images=time()."_".$b1image;
	    move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/product/".$b1images);
	}
	else{
	    $b1images = $edit['image'];
	}

	$query = mysqli_query($conn, "UPDATE `tbl_variation` SET `image` = '$b1images', `image_alt` = '$alt', `sort` = '$sort', `status` = '$status' WHERE `id` = '$id'");
	if($query==true)
	{
		$_SESSION['success']="Product Variation Added successfully";
		header("refresh:3;url=manage-variation.php?id=".$pid);
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
                <li class="breadcrumb-item active">Add Product Variation</li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)"
                    class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i
                        class="fa fa-arrow-left"></i></a> Manage Product Variation</h1>
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
                            <h4 class="panel-title">Add Product Variation</h4>
                        </div>
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Main Image</label>
                                                <input type="file" name="image" class="form-control"
                                                    id="exampleInputPassword1" multiple>
                                                <p class="help-block">Image dimension must be 500 X 364 px & must be jpg
                                                    format</p>
                                                <img src="../uploads/product/<?php echo $edit['image'];?>" class="img-rounded height-40 width-60" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Image Alt</label>
                                                <input type="text" name="alt" class="form-control"
                                                    id="exampleInputPassword1" placeholder="Enter Image Alt" value="<?=$edit['image_alt']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Position</label>
                                                <input type="number" name="sort" class="form-control"
                                                    id="exampleInputPassword1" placeholder="1-10" value="<?=$edit['sort']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="radio" value="1" id="optionsRadios3" name="status" <?php if($edit['status'] == '1'){ echo 'checked'; } ?>>
                                        <label for="optionsRadios3">Active</label>
                                        <input type="radio" value="0" id="optionsRadios4" name="status" <?php if($edit['status'] == '0'){ echo 'checked'; } ?>>
                                        <label for="optionsRadios4">Inactive</label>
                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Click To Submit
                                        Data</button>
                                    <button type="reset" name="reset" class="btn btn-danger">Reset</button>
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