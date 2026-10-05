<?php
require('checksession.php');
require('../inc/function.php');
$b = $_REQUEST['bid'];
$bdata = mysqli_query($conn, "SELECT * FROM `tbl_main_banner` where `id`='$b'");
$brec = mysqli_fetch_array($bdata);

if (isset($_POST['update'])) {
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
	$content = mysqli_real_escape_string($conn, $_POST['content']);
	$link1 = mysqli_real_escape_string($conn, $_POST['link1']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$status = mysqli_real_escape_string($conn, $_POST['status']);
    $old = mysqli_real_escape_string($conn, $_POST['oldimg']);
    $oldvideo = mysqli_real_escape_string($conn, $_POST['oldvideo']);

  $bimage = $_FILES['bimage']['name'];
  if($bimage!=''){
      $bimage = time() . "_" . $bimage;
      @unlink("../uploads/banner/" . $old);
      move_uploaded_file($_FILES["bimage"]["tmp_name"], "../uploads/banner/" . $bimage);
  } else {
    $bimage = $brec['main_image'];
  }

  $video = $_FILES['video']['name'];
  if($video!=''){
      $video = time() . "_" . $video;
      @unlink("../uploads/banner/" . $oldvideo);
      move_uploaded_file($_FILES["video"]["tmp_name"], "../uploads/banner/" . $video);
  } else {
    $video = $oldvideo;
  }

  $query = mysqli_query($conn, "UPDATE `tbl_main_banner` SET `heading`='$title',`subheading`='$subtitle', `content`='$content',`url1`='$link1', `sort`='$position', `status`='$status', `video`='$video', `main_image`='$bimage' WHERE `id`='$b'");
  if ($query == true) {
    $_SESSION['success'] = "Updated Successfully";
    header("refresh:3;url=manage-main-banner.php");
  } else {
    $_SESSION['error'] = "Something went wrong. Please try again";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>

<body>
  <!-- begin #page-container -->
  <?php require("includes/header.php"); ?>
  <!-- begin #sidebar -->
  <?php require("includes/left.php"); ?>
  <!-- begin #content -->
  <div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item"><a href="javascript:;">Hero Management</a></li>
      <li class="breadcrumb-item active">Edit Hero</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Hero </h1>
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
            <h4 class="panel-title"> Edit Hero</h4>
          </div>
          <!-- begin panel-body -->
          <div class="panel-body">
            <form role="form" method="POST" enctype="multipart/form-data">
              <div class="box-body">
            <div class="row">
                <div class="form-group col-6">
                  <label for="banner">Banner Title</label>
                  <input type="text" name="title" class="form-control" id="banner" value="<?= $brec['heading']; ?>">
                </div>

                <div class="form-group col-6">
                  <label for="banner">Banner Subtitle</label>
                  <input type="text" name="subtitle" class="form-control" id="banner" value="<?= $brec['subheading']; ?>">
                </div>
            </div>    
                
            <div class="form-group">
                <label for="banner">Banner Description</label>
                <textarea type="text" name="content" class="form-control" id="editor1" rows="5"><?= $brec['content']; ?></textarea>
            </div>

            <div class="row">
                <div class="form-group col-6">
                  <label for="bannerlink">Youtube Video Url</label>
                  <input type="text" name="link1" class="form-control" id="bannerlink" value="<?= $brec['url1']; ?>">
                </div>

                <div class="form-group col-6">
                  <label for="exampleInputPassword1">Position</label>
                  <input type="number" name="position" class="form-control" id="exampleInputPassword1" value="<?= $brec['sort']; ?>">
                </div>
            </div>    

            <div class="row">
                <div class="form-group col-6">
                  <label for="exampleInputFile">Background Image</label>
                  <input type="file" name="bimage" class="form-control" id="exampleInputFile">
                  <input type="hidden" name="oldimg" value="<?= $brec['main_image']; ?>">
                  <p class="help-block">Image dimension must be 900 X 600 px & must be jpg format</p>
                  <?php if(!empty($brec['main_image'])): ?>
                    <img src="../uploads/banner/<?= $brec['main_image']; ?>" style="width:20%; margin-top:5px; border-radius:4px;">
                  <?php endif; ?>
                </div>
                
                <div class="form-group col-6">
                    <label for="exampleInputFile">Video File (Optional if using YouTube)</label>
                    <input type="file" name="video" class="form-control" id="exampleInputFile" accept="video/*">
                    <input type="hidden" name="oldvideo" value="<?= $brec['video']; ?>">
                    <p class="help-block">Must be a video file (mp4, avi, mov etc.)</p>
                
                    <?php if(!empty($brec['video'])): ?>
                        <video width="30%" controls style="margin-top:8px;">
                            <source src="../uploads/banner/<?= $brec['video']; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
              <label style="display:block;">Status</label>
              <input type="radio" value="1" id="optionsRadios3" name="status" <?php if ($brec['status'] == '1') { echo 'checked'; } ?>>
              <label for="optionsRadios3">Active</label>

              <input type="radio" value="0" id="optionsRadios4" name="status" <?php if ($brec['status'] == '0') { echo 'checked'; } ?> style="margin-left:15px;">
              <label for="optionsRadios4">Inactive</label>
            </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="update" class="btn btn-primary">Click Here To Update</button>
                <!--<button type="reset" name="reset" class="btn btn-danger">Reset</button>-->
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
      });
</script>

</body>

</html>