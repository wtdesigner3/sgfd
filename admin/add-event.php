<?php
require('checksession.php'); 
include '../inc/function.php'; 

if (isset($_POST['submit'])) { 
    if($_POST['category']!=''){
    $title = mysqli_real_escape_string($conn, $_POST['category']);
    }else{
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    }
    $category_id = mysqli_real_escape_string($conn, $_POST['add_category']);
    $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $insertedSuccessfully = true;

    //=============|image|============//
    foreach ($_FILES['image']['name'] as $key => $image) {
        if ($image != "") {
            $bimage = time() . "_" . basename($image);
            $targetPath = "../uploads/event/" . $bimage;

            if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $targetPath)) {
                $alt = mysqli_real_escape_string($conn, $_POST['alt'][$key]);

                $query = mysqli_query($conn, "INSERT INTO `tbl_event`(`title`,`text`,`image`,`alt`, `sort`, `status`,`category_id`) VALUES ('$title','$subtitle','$bimage','$alt','$position','$status','$category_id')");
                if (!$query) {
                    $_SESSION['error'] = "Something went wrong. Please try again";
                    $insertedSuccessfully = false;
                }
            } else {
                $_SESSION['error'] = "Failed to upload image: $image";
                $insertedSuccessfully = false;
                break;
            }
        }
    }

    if ($insertedSuccessfully) {
        $_SESSION['success'] = "Event Inserted successfully";
        header("refresh:3;url=manage-event.php");
    } else {
		$_SESSION['error'] = "Something went wrong. Please try again";
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
				<li class="breadcrumb-item"><a href="javascript:;"> Manage Event</a></li>
				<li class="breadcrumb-item active">Add  Event</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Event</h1>
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
							<h4 class="panel-title">Add Event</h4>
						</div>
						<!-- begin panel-body -->
						<div class="panel-body">
			<form role="form"  method="POST"  enctype="multipart/form-data">
              <div class="box-body">
                  
                <div class="form-group">
                  <label for="exampleInputPassword1">Add Event in Category</label>
                  <select name="add_category" class="form-control" id="exampleInputPassword1" placeholder="Enter Event Category">
                      <option value="">Choose One</option>
                      <?php $mqryy = mysqli_query($conn,"select * from tbl_event_category order by `name`");
                      while($mqryy_data= mysqli_fetch_array($mqryy)){
                      ?>
                      <option value="<?=$mqryy_data['id']?>"><?=$mqryy_data['name']?></option>
                      <?php } ?>
                  </select>
                </div>
                  
               <div class="form-group">
                  <label for="exampleInputPassword1">Available Event Category</label>
                  <select name="category" class="form-control" id="exampleInputPassword1" placeholder="Enter Event Category">
                      <option value="">Choose One</option>
                      <?php $mqryy = mysqli_query($conn,"select * from tbl_event group by `title`");
                      while($mqryy_data= mysqli_fetch_array($mqryy)){
                      ?>
                      <option value="<?=$mqryy_data['title']?>"><?=$mqryy_data['title']?></option>
                      <?php } ?>
                  </select>
                </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">New Event Category</label>
                  <input type="text" name="title" class="form-control" id="exampleInputPassword1" placeholder="Enter New Event Category">
                </div>

                <div id="formRows">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Alt</label>
                            <input type="text" name="alt[]" class="form-control" placeholder="Enter Alt">
                        </div>
                        <div class="form-group col-6">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" name="image[]" class="form-control">
                            <p class="help-block">Image dimension must be 128 X 128 & must be png format</p>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                <button type="button" class="btn btn-primary align-right" onclick="appendRow()">Add More</button>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Position</label>
                  <input type="number" name="position" class="form-control" id="exampleInputPassword1" placeholder="1-10">
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
	});
</script>
<script>
function appendRow() {
    // Get the formRows container
    var formRows = document.getElementById('formRows');
    
    // Clone the existing row
    var newRow = formRows.children[0].cloneNode(true);

    // Clear the values in the cloned input fields
    var inputs = newRow.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type === 'text') {
            inputs[i].value = '';
        } else if (inputs[i].type === 'file') {
            inputs[i].value = null;
        }
    }

    // Append the cloned row to the formRows container
    formRows.appendChild(newRow);
}

</script>
</body>
</html>
