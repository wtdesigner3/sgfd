<?php

require('checksession.php'); 
require('../inc/function.php');


$bdata = mysqli_query($conn, "SELECT * FROM `tbl_footer_catalog`");
$brec = mysqli_fetch_array($bdata);
if (isset($_POST['update'])) {
	$status = mysqli_real_escape_string($conn, $_POST['status']);
	  $old = mysqli_real_escape_string($conn,$_POST['oldimg']); 

  $ach_image=$_FILES['ach_image']['name'];
  if($ach_image!='')
  {
      $ach_images=time()."_".$ach_image;
      @unlink("../uploads/catalog/".$old);
      move_uploaded_file($_FILES["ach_image"]["tmp_name"], "../uploads/catalog/".$ach_images);
  }
  else{
      $ach_images=$old;	
  }

	$query = mysqli_query($conn, "UPDATE `tbl_footer_catalog` SET `pdf`='$ach_images',`status`='$status'");
	if ($query == true) {
		$_SESSION['success'] = "Footer Catalog Updated Successfully";
		header("refresh:3;url=manage-homeextra-text.php");
	} else {
		$_SESSION['error'] = "Something went wrong. Please try again";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>
<body>
		<!-- begin #header -->
		<?php require('includes/header.php'); ?>
		<!-- begin #sidebar -->
		<?php require('includes/left.php'); ?>
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
				<li class="breadcrumb-item active">Homepage Extra Text Management</li>
			</ol>
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Homepage Extra Text</h1>
			<!-- begin row -->
			<div class="row">
				<!-- begin col-12 -->
				<div class="col-lg-12">
					<!-- begin panel -->
					<div class="panel panel-inverse">
						<!-- begin panel-heading -->
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-refresh"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Manage Homepage Extra Text</h4>
						</div>
						<!-- end panel-heading -->
                     <form name="myform" method="post" action="">
						<!-- begin panel-body -->
						<div class="panel-body">
                         <div class="table-responsive">
							<table id="data-table-responsive" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="1%">No</th>  
										<th width="1%">For</th>    
								        <th>Text</th>
										<th width="1%">Edit</th>
                                      </tr>
								</thead>
								<tbody>
                                <?php
								     $mqry="select * from tbl_homepage_extra_text order by `id` DESC"; 
								     $count=1; 
									 $fetch=mysqli_query($conn,$mqry);
			                         while($web=mysqli_fetch_array($fetch)) {
										
			                    ?>
									<tr class="odd gradeX">
									    <td width="1%" class="f-s-600 text-inverse"><?= $count; ?></td> 
									    <td  width="20%" style="font-weight:500; color:#000;"><?= $web['for'];?></td>
									    <td style="font-weight:500; color:#000;"><?= $web['text'];?></td>
										<td width="20%">
                                          <a href="edit-homeextra-text.php?id=<?php echo $web['id'];?>" class='label label-sm label-primary' data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
									</tr>
                                    <?php $count++; } ?>
								</tbody>
							</table>
                         </div>   
						</div>
						<!-- end panel-body -->
                     </form>  
                     
                     
                     	<div class="panel-heading">
							<h4 class="panel-title">Manage Footer Catalog</h4>
						</div>
                     
                     <form role="form" method="POST" enctype="multipart/form-data">
                         	<div class="panel-body">
								<div class="box-body">

										<div class="form-group">
											<label for="exampleInputFile">Catalog PDF File input</label>
											<input type="file" name="ach_image" class="form-control" >
											<input type="hidden" name="oldimg"  value="<?= $brec['pdf']; ?>">
										<p class="help-block">Image dimension must be 500 X 364 & must be jpg format</p>
										<?php if($brec['pdf']>''){ ?>
									     	<a href="../uploads/catalog/<?=$brec['pdf']?>" target="_blank">
											   <i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i>
											</a>
											<?php } ?>
											</div>

                

									<div class="form-group">
										<input type="radio" value="1" id="optionsRadios3" name="status" <?php if ($brec['status'] == '1') {
																			echo 'checked';
																										} ?>>
										<label for="optionsRadios3">Active</label>

										<input type="radio" value="0" id="optionsRadios4" name="status" <?php if ($brec['status'] == '0') {
																			echo 'checked';
																										} ?>>
										<label for="optionsRadios4">Inactive</label>
									</div>

								</div>
								<!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" name="update" class="btn btn-primary">Click Here To Update</button>
									<button type="reset" name="reset" class="btn btn-danger">Reset</button>
								</div>
								</div>
							</form>
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
	<?php require('includes/footer.php'); ?>
	<script>
    $(document).ready(function() {
    App.init();
    TableManageResponsive.init();
    });
    </script>
    <script>
    function updateId(id)
    {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystaquaange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
    {
    //alert(xmlhttp.responseText);
    }
    };
    xmlhttp.open("GET", "status/product.php?id=" +id, true);
    xmlhttp.send();
    }
    </script>
	 <script type="text/javascript">
    $(document).ready(function(){
        $('#select_all').on('click',function(){
            if(this.checked){
                $('.checkbox').each(function(){
                    this.checked = true;
                });
            }else{
                 $('.checkbox').each(function(){
                    this.checked = false;
                });
            }
        });
        
        $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#select_all').prop('checked',true);
            }else{
                $('#select_all').prop('checked',false);
            }
        });
    });
    </script> 
</body>
</html>
