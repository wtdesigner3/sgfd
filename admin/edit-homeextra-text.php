<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
require('checksession.php'); 
require('../inc/function.php');
$b=$_GET['id'];
$bdata=mysqli_query($conn,"SELECT * FROM `tbl_homepage_extra_text` where `id`='$b'");
$brec=mysqli_fetch_array($bdata);

if(isset($_POST['update']))
{
  $text = mysqli_real_escape_string($conn,$_POST['text']);
  $status = mysqli_real_escape_string($conn,$_POST['status']);
  
  $query=mysqli_query($conn,"UPDATE `tbl_homepage_extra_text` SET  `text`='$text',`status`='$status' WHERE `id`='$b'");
  if($query==true)
  {
  $_SESSION['success']="Extra Text Updated Successfully";  
  header("refresh:3;url=manage-homeextra-text.php");
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
 .color {
    display: block;
    text-align: center;
    width: 1.6rem;
    height: 1.6rem;
    border-radius: 50%;
    border: none;
    margin-right: 0;
    margin-top:5px;
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
        <li class="breadcrumb-item active">Edit Product</li>
      </ol>
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Product</h1>
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
              <h4 class="panel-title"> Edit Product</h4>
            </div>
            <!-- begin panel-body -->
            <div class="panel-body">
                <form role="form" action="" method="POST"  enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                   <label for="title">For</label>
                                   <input type="text" value="<?= $brec['for']; ?>" readonly class="form-control" id="urlname">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Text</label>
                                  <textarea class="form-control" name="text"><?=$brec['text']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <input type="radio" value="1" id="optionsRadios3" name="status" <?php if($brec['status']=='1'){ echo 'checked';}?>>
                        <label for="optionsRadios3">Active</label>
                        
                        <input type="radio" value="0" id="optionsRadios4" name="status" <?php if($brec['status']=='0'){ echo 'checked';}?>>
                        <label for="optionsRadios4">Inactive</label>
                    </div>
          
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="update" class="btn btn-primary">Click To Update Data</button>
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
<link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet"> <!-- for live demo page -->
  <link href="select2-bootstrap4.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
   <script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
  </script>
  <script>
    $(function () {
  $('select').each(function () {
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
  data:'sub_cat='+val,
  //data1:'department_name='+val,
  success: function(data){
    $("#subcategory").html(data);
    //alert(data);
  }
  });
} 
  </script>
  
  <script>
      function deleteImg(index){
        $.ajax({
            type: "POST",
            url: "ajax/deleteMultiImage.php",
            data: {
                'id' : "<?=$brec['p_id']?>",
                'index' : index,
            },
            success: function(data){
                console.log('done');
                 //alert(data);
            }
        });     
      }
  </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</body>
</html>
