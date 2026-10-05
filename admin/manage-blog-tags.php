<?php

require('checksession.php'); 
require('../inc/function.php');


$b=$_REQUEST['bid'];
//$cb=$_REQUEST['cid'];
$bdata=mysqli_query($conn,"SELECT * FROM `tbl_blogs` where `b_id`='$b'");
$brec=mysqli_fetch_array($bdata);
if(isset($_POST['Dectivate']) && $bb!='')
{
  foreach($bb as $act)
  {
	  mysqli_query($conn,"update tbl_blog_tags set status='0' where id='$act'");
  }
}

if(isset($_POST['Activate']) && $bb!='')
{
  foreach($bb as $act)
  {
	  mysqli_query($conn,"update tbl_blog_tags set status='1' where id='$act'");
  }
}

if(isset($_POST['Delete']) && $bb!='')
{
  foreach($bb as $act)
  {
	  mysqli_query($conn,"delete from tbl_blog_tags where id='$act'");
  }
}
		
$mqry="select * from tbl_blog_tags";
$mqry.=" order by sort asc";


if(isset($_POST['submit']))
{ 
	$idd = mysqli_real_escape_string($conn,$_POST['idd']);
	$title = mysqli_real_escape_string($conn,$_POST['title']);
	$prourls = mysqli_real_escape_string($conn,$_POST['url']);
	$prourrl = str_replace(array( '\'', '"', ' ', ',' , ';', '*', ',', '/', '&', '_', '$', '--', '-', '<', '>','.','?' ), '-', $prourls);
	$url = strtolower($prourrl);
    $sort = mysqli_real_escape_string($conn,$_POST['sort']);
	$status = mysqli_real_escape_string($conn,$_POST['status']); 
	$query=mysqli_query($conn,"INSERT INTO `tbl_blog_tags`(`b_id`,`title`,`url`, `sort`,`status`) VALUES ('$idd','$title','$url','$sort','$status')");
	if($query==true)
	{
		$_SESSION['success']="Blog Tags Inserted Successfully";
		//header("refresh:3;url=manage-itinerary.php?bid=$b ");
	}
	else 
	{
		$_SESSION['error']="Something went wrong. Please try again";
	} 
}
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
				<li class="breadcrumb-item"><a href="javascript:;">Manage Blog Tags</a></li>
				
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary" data-click="panel-remove"><i class="fa fa-arrow-left"></i></a> Manage Blog Tags </h1>
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

							<h4 class="panel-title">Manage Blog Tags </h4>
						</div>
						<!-- end panel-heading -->
          
					
<div class="panel-body">
			<form role="form"  method="POST"  enctype="multipart/form-data">
              <div class="box-body">

	                 <div class="form-group">
							<input type="hidden" name="idd"  value="<?php echo $brec['b_id'];?>" class="form-control" id="exampleInputPassword1" readonly>
						</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="exampleInputPassword1">Tags Title</label>
							<input type="text" name="title" class="form-control" id="title" placeholder="Enter Tags Title Here!">
						</div>
					</div>
	
				</div>

				 <div class="form-group">
                  <label for="exampleInputPassword1">Tags URL</label>
                  <input type="text" name="url" class="form-control" id="url" placeholder="Enter Tags URL">
                </div> 

                <div class="form-group">
                  <label for="exampleInputPassword1">Position</label>
                  <input type="text" name="sort" placeholder="1-10" class="form-control" id="exampleInputPassword1" >
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
                <button type="submit" name="submit" class="btn btn-primary">Click Here To Insert</button>
                <button type="reset" name="reset" class="btn btn-danger">Reset</button>
              </div>
            </form>
						</div>
						<!-- end panel-body -->
				           <form name="myform" method="post" action=""> 
                    	<div class="alert alert-secondary fade show">
							<button type="button" class="close" data-dismiss="alert">
							<span aria-hidden="true">&times;</span>
							</button>
							<div class="btn-group btn-group-justified">
                              <input type="Submit" name="Activate" value="Activate" class="btn btn-info btn-flat"> 
                              <input type="Submit" name="Dectivate" value="Dectivate" class="btn btn-warning btn-flat"> 
                              <input type="Submit" name="Delete" class="btn btn-danger btn-flat" value="Delete" onClick="if(confirm('Are You Sure Want To Delete This Record')){ return true;} else { return false; }">
                            </div>
						</div>

						<div class="panel-body">
                         <div class="table-responsive">
							<table id="data-table-responsive" class="table table-striped table-bordered">
								<thead>		 
									<tr>
										<th width="1%">No</th>
										<th width="1%">Title</th>
										<th width="1%">Status</th>
										<th width="1%">Edit</th>
                                    	<th width="1%">Delete</th>
                                        <th width="1%">
											 <input type="checkbox" id="select_all">
                                        </th>
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
										
									
										<td width="30%" class="f-s-600 text-inverse"><?= $web['title']; ?></td>
											<td>
                                          <div class="switcher">
                                              <input type="checkbox" onClick="updateId('<?php echo $web['id']; ?>')" name="switcher_checkbox_1" id="switcher_checkbox_<?php echo $count;?>" <?php if( $web['status']=='1'){ echo "checked"; }else {} ?> value="1">
                                              <label for="switcher_checkbox_<?php echo $count;?>"></label>
                                          </div>
                                        </td>
										<td>
                                          <a href="edit-blog-tags.php?bid=<?php echo $web['id'];?>" class='label label-sm label-primary' title="Edit"><i class="fa fa-edit"></i> Edit</a>
                                        </td>
                                        <td>
                                          <a href="delete/blogtags.php?bid=<?php echo $web['id'];?>" onClick="if(confirm('Are You Sure Want To Delete This Record')){ return true;} else { return false; }" class='label label-sm label-danger'><i class="fa fa-trash"></i> Delete</a>
                                         </td>
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
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	<?php require('includes/footer.php'); ?>
	<script>
    window.onload = function() {
    var src = document.getElementById("title"),
        dst = document.getElementById("url");
    src.addEventListener('input', function() {
        dst.value = src.value;
    });
  }

</script>
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
		  xmlhttp.open("GET", "status/blogtags.php?id=" +id, true);
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
