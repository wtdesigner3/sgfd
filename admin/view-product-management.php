<?php


require('checksession.php'); 
require('../inc/function.php');
$b=$_REQUEST['bid'];
$mqryf="select * from order_products where `id`='$b'";
 $fetchh=mysqli_query($conn,$mqryf);
$webb=mysqli_fetch_array($fetchh);
$number= $webb['contact'];
$namee= $webb['name'];
$date= $webb['date'];
if(isset($_POST['Dectivate']) && $bb!='')
{
  foreach($bb as $act)
  {
	  mysqli_query($conn,"update order_products set status='0' where id='$act'");
  }
}

if(isset($_POST['Activate']) && $bb!='')
{
  foreach($bb as $act)
  {
	  mysqli_query($conn,"update order_products set status='1' where id='$act'");
  }
}

if(isset($_POST['Delete']) && $bb!='')
{
  foreach($bb as $act)
  {
	  mysqli_query($conn,"delete from order_products where id='$act'");
  }
}
		
$mqry="select * from order_products where `contact`='$number'";
$mqry.=" order by id Desc";

?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade in page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php require('includes/header.php'); ?>
		<!-- begin #sidebar -->
		<?php require('includes/left.php'); ?>
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;"><?= $namee ?> [<?= $date ?>]</a></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a><?= $namee ?> [<?= $date ?>]</h1>
			<!-- end page-header -->
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
							<h4 class="panel-title"><?= $namee ?> [<?= $date ?>]</h4>
						</div>
						<!-- end panel-heading -->
						<!-- begin alert -->
						<!-- <div class="alert alert-secondary fade show">
							<button type="button" class="close" data-dismiss="alert">
							<span aria-hidden="true">&times;</span>
							</button>
							<div class="btn-group btn-group-justified">
                              <a href="add-breadcrumb.php" class="btn btn-default active"><i class="fa fa-plus"></i> Add New Breadcrumb</a>
                              <input type="Submit" name="Activate" value="Activate" class="btn btn-info btn-flat"> 
                              <input type="Submit" name="Dectivate" value="Dectivate" class="btn btn-warning btn-flat"> 
                              <input type="Submit" name="Delete" class="btn btn-danger btn-flat" value="Delete" onClick="if(confirm('Are You Sure Want To Delete This Record')){ return true;} else { return false; }">
                            </div>
						</div> -->
						<!-- end alert -->
						<!-- begin panel-body -->
							<form role="form"  method="POST"  enctype="multipart/form-data">
						<div class="panel-body">
						    
              <div class="box-body">
			  <div class="row">
				  <div class="col-sm-4">
						<div class="form-group">
							<label for="exampleInputPassword1">Name</label>
							<input type="text" name="title" class="form-control" id="exampleInputPassword1" value="<?=$namee; ?>" readonly>
						</div>
				  </div>
				  <div class="col-sm-4">
						<div class="form-group">
							<label for="exampleInputPassword1">Email</label>
							<input type="text" name="subtitle" class="form-control" id="exampleInputPassword1" value="<?= $webb['email']; ?>" readonly>
						</div>
				  </div>
				   <div class="col-sm-4">
						<div class="form-group">
							<label for="exampleInputPassword1">Contact</label>
							<input type="text" name="subtitle" class="form-control" id="exampleInputPassword1" value="<?= $number; ?>" readonly>
						</div>
				  </div>
				  <div class="col-sm-12">
						<div class="form-group">
							<label for="exampleInputPassword1">Message</label>
							<texarea name="subtitle" class="form-control" id="exampleInputPassword1" readonly><?= $webb['message']; ?></textarea>
						</div>
				  </div>
			  </div>
             
              
                         <div class="table-responsive">
							<table id="data-table-responsive" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="1%">No</th>
										<th width="1%" data-orderable="false">Image</th>
									    <th class="text-nowrap">Product Category</th>
									    <th class="text-nowrap">Product Subcategory</th>
										<th class="text-nowrap">Model Name</th>
										<th class="text-nowrap">Quantity</th>
									
                                        <!-- <th width="1%">Delete</th> -->
                                        <!-- <th width="1%">
											 <input type="checkbox" id="select_all">
                                        </th> -->
                                      </tr>
								</thead>
								<tbody>
                                <?php 
								     $count=1; 
									 $fetch=mysqli_query($conn,$mqry);
			                         while($web=mysqli_fetch_array($fetch)) { 
			                    ?>
									<tr class="odd gradeX">
										<td width="1%" class="f-s-600 text-inverse"><?= $count;?></td>
										<td width="1%" class="with-img"><?php if($web['product_image']==''){ ?><img src="../uploads/no.png" class="img-rounded height-80" /><?php }else{ ?><img src="../uploads/product/<?php echo $web['product_image'];?>" class="img-rounded height-80" /><?php } ?></td>
										<td style="font-weight:700; color:#000;"><?= $web['category'];?></td>
									    <td style="font-weight:700; color:#000;"><?= $web['subcategory'];?></td>
										<td style="font-weight:700; color:#000;"><?= $web['product_name'];?></td>
										<td style="font-weight:700; color:#000;"><?= $web['product_quantity'];?></td>
									
									</tr>
                                    <?php $count++; } ?>
								</tbody>
							</table>
                         </div>   
						</div>
						<!-- end panel-body -->
                     </form>    
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
		  xmlhttp.onreadystatechange = function() {
			  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			  {
				  //alert(xmlhttp.responseText);
			  }
		  };
		  xmlhttp.open("GET", "status/breadcrumb.php?id=" +id, true);
		  xmlhttp.send();
	  }
   </script>
    <!----------------Check Box-----------------------> 
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
