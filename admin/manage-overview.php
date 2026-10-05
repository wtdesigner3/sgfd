<?php

require('checksession.php'); 
require('../inc/function.php');
if(isset($_POST['Deactivate']) && $bb!='')
{
    print_r($_POST);
    die();
  foreach($bb as $act)
  {
	  mysqli_query($conn,"update tbl_overview set status='0' where id='$act'");
  }
}
if(isset($_POST['Activate']) && $bb!='')
{
  foreach($bb as $act)
  {
	  mysqli_query($conn,"update tbl_overview set status='1' where id='$act'");
  }
}
if(isset($_POST['Delete']) && $bb!='')
{
  foreach($bb as $act)
  {
	  mysqli_query($conn,"delete from tbl_overview where id='$act'");
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
				<li class="breadcrumb-item active">Overview Management</li>
			</ol>
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Overview</h1>
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
							<h4 class="panel-title">Manage Overview</h4>
						</div>
						<!-- end panel-heading -->
                     <form name="myform" method="post" action=""> 
					
						<!-- end alert -->
						<!-- begin panel-body -->
						<div class="panel-body">
                         <div class="table-responsive">
							<table id="data-table-responsive" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="1%">No</th> 
										<th width="1%">Main Image</th>  
								        <th width="1%">Heading</th>
                                        <!--<th width="1%">Status</th>-->
										<th width="1%">Edit</th>
										<!--<th width="1%">Delete</th>-->
										<th width="1%">
											 <input type="checkbox" id="select_all">
                                        </th>
                                      </tr>
								</thead>
								<tbody>
                                <?php
								     $mqry="select * from tbl_overview where id= 1"; 
								     $count=1; 
									 $fetch=mysqli_query($conn,$mqry);
			                         while($web=mysqli_fetch_array($fetch)) { 
										
			                    ?>
									<tr class="odd gradeX">
										<td width="1%" class="f-s-600 text-inverse"><?= $count; ?></td>
										<td width="1%" class="with-img"><?php if($web['image']==''){ ?><img src="../uploads/no.png" class="img-rounded height-40 width-60" /><?php }else{ ?><img src="../uploads/overview/<?php echo $web['image'];?>" class="img-rounded height-40 width-60" /><?php } ?></td>
									    <td  width="20%" style="font-weight:500; color:#000;"><?= $web['heading'];?></td>
                                    
										<td>
                                          <a href="edit-overview.php?id=<?php echo $web['id'];?>" class='label label-sm label-primary' data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
										<!--<td>-->
          <!--                                <a href="delete/product.php?bid=<?php echo $web['p_id'];?>" onClick="if(confirm('Are You Sure Want To Delete This Record')){ return true;} else { return false; }" data-toggle="tooltip" title="Delete" class='label label-sm label-danger'><i class="fa fa-trash"></i> Delete</a>-->
          <!--                               </td>-->
                                        
										 <td width="1%">
                                          <input type="checkbox" class="checkbox"  value="<?php echo $web['id']; ?>" name="bb[]" id="bb[]">
                                        </td>
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