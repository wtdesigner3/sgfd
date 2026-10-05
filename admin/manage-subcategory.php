<?php

require('checksession.php'); 
require '../inc/function.php'; 
if(isset($_POST['Dectivate']) && $bb!='')
{
		foreach($bb as $act)
		{
			mysqli_query($conn,"update tbl_subcategory set status='0' where id='$act'");
		}
}

		
if(isset($_POST['Activate']) && $bb!='')
{
		foreach($bb as $act)
		{
			mysqli_query($conn,"update tbl_subcategory set status='1' where id='$act'");
		}
}
		

if(isset($_POST['Delete']) && $bb!='')
{
		foreach($bb as $act)
		{
			    $b=$act;
                $catData=mysqli_query($conn,"select * from tbl_subsubcategory where subcategory_id='$b'");
                if(mysqli_num_rows($catData)>0)
                {
                	echo "<script>alert('Please First Delete All Subsubcategory Of This SubCategory'); </script>";
                	header("Refresh:1;url=manage-subcategory.php");
                }
                else
                {
                	$data=mysqli_query($conn,"DELETE FROM `tbl_subcategory` WHERE `id`='$b'");
                }
		}
		echo "<script>alert('Subcategory Deleted successfully'); </script>";
		header("Refresh:1;url=manage-subcategory.php");
}
		
		$mqry="select * from tbl_subcategory ";
		$mqry.=" order by sort asc";

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
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Sub Category Management</a></li>
				<li class="breadcrumb-item active">Manage Sub Category</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Manage Sub Category </h1>
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
							<h4 class="panel-title">Manage Sub Category</h4>
						</div>
						<!-- end panel-heading -->
                       <form name="myform" method="post" action=""> 
						<!-- begin alert -->
						<div class="alert alert-secondary fade show">
							<button type="button" class="close" data-dismiss="alert">
							<span aria-hidden="true">&times;</span>
							</button>
							<div class="btn-group btn-group-justified">
                               <a href="add-subcategory.php" class="btn btn-default active"><i class="fa fa-plus"></i> Add New Sub Category</a>
							   <input type="Submit" name="Activate" value="Activate" class="btn btn-info btn-flat"> 
                              <input type="Submit" name="Dectivate" value="Dectivate" class="btn btn-warning btn-flat"> 
                              <input type="Submit" name="Delete" class="btn btn-danger btn-flat" value="Delete" onClick="if(confirm('Are You Sure Want To Delete This Record')){ return true;} else { return false; }">
                            </div>
						</div>
						<!-- end alert -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<table id="data-table-responsive" class="table table-striped table-bordered table-responsive">
								<thead>
									<tr>
										<th width="1%">S.No.</th>
										<th class="text-nowrap">Intro Image</th>
										<th class="text-nowrap">Categories</th>
                                        <th class="text-nowrap">Sub Categories</th>
										<th class="text-nowrap">Status</th>
										<th class="text-nowrap">Edit</th>
										<th class="text-nowrap">Delete</th>
                                        <th width="1%">
											 <input type="checkbox" id="select_all">
                                         </th>
									</tr>
								</thead>
								<tbody>
                                <?php $count=1; $fetch=mysqli_query($conn,$mqry);
			                          while($web=mysqli_fetch_array($fetch)) { 
									  $pcdata=mysqli_query($conn,"select * from `tbl_category` where `id`='$web[category_id]'");
                                      $pcrec=mysqli_fetch_array($pcdata);
			                    ?>
									<tr class="odd gradeX">
 										<td width="1%" class="f-s-600 text-inverse"><?php echo $count;?></td>
                                 	<td width="1%" class="with-img"><?php if($web['image']==''){ ?><img src="../uploads/no.png" class="img-rounded height-40 width-60" /><?php }else{ ?><img src="../uploads/products/<?php echo $web['image'];?>" class="img-rounded height-40 width-60" /><?php } ?></td>
	                              <td style="font-weight:700; color:#000;"><?= $pcrec['name'];?></td>
										<td style="font-weight:700; color:#333;"><?php echo $web['name'];?></td>
						
                                        <td><div class="switcher">
                                              <input type="checkbox" onClick="updateId('<?php echo $web['id']; ?>')" name="switcher_checkbox_1" id="switcher_checkbox_<?php echo $count;?>" <?php if( $web['status']=='1'){ echo "checked"; }else {} ?> value="1">
                                              <label for="switcher_checkbox_<?php echo $count;?>"></label>
                                            </div>
                                        </td>
										
										<td><a href="edit-subcategory.php?cid=<?php echo $web['id'];?>" class='label label-sm label-primary' title="Edit"><i class="fa fa-edit"></i> Edit</a></td>
										<td><a href="delete/subcategory.php?cid=<?php echo $web['id'];?>" onClick="if(confirm('Are You Sure Want To Delete This Record')){ return true;} else { return false; }" class='label label-sm label-danger' title="Delete"><i class="fa fa-trash"></i> Delete</a></td>
                                        <td>
                                          <input type="checkbox" class="checkbox" value="<?php echo $web['id']; ?>" name="bb[]" id="bb[]">
                                        </td>
									</tr>
								<?php $count++; }?>	
                                   
								</tbody>
							</table>
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
	
<?php require("includes/footer.php"); ?>
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
		});
	</script>
<!------------------------------>    
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
    xmlhttp.open("GET", "status/subcategory.php?id=" +id, true);
    xmlhttp.send();
}
</script>
 <!--------------------------------------->  
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
