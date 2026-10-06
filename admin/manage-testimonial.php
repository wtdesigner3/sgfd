<?php
require('checksession.php');
$bb = isset($_POST['bb']) && is_array($_POST['bb']) ? array_map('intval', $_POST['bb']) : [];
include '../inc/function.php'; 

if(isset($_POST['Deactivate']) && !empty($bb))
{
	foreach($bb as $act)
	{
		mysqli_query($conn,"update tbl_testimonial set tt_status='0' where tt_id='$act'");
	}
	$_SESSION['info'] = "Selected testimonials deactivated successfully";
}

if(isset($_POST['Activate']) && !empty($bb))
{
	foreach($bb as $act)
	{
		mysqli_query($conn,"update tbl_testimonial set tt_status='1' where tt_id='$act'");
	}
	$_SESSION['success'] = "Selected testimonials activated successfully";
}

if(isset($_POST['Delete']) && !empty($bb))
{
	foreach($bb as $act)
	{
		$res = mysqli_query($conn, "select tt_image from tbl_testimonial where tt_id='$act'");
		if($rowImg = mysqli_fetch_assoc($res)) {
			if(!empty($rowImg['tt_image']) && file_exists("../uploads/testimonial/".$rowImg['tt_image'])) {
				@unlink("../uploads/testimonial/".$rowImg['tt_image']);
			}
		}
		mysqli_query($conn,"delete from tbl_testimonial where tt_id='$act'");
	}
	$_SESSION['warning'] = "Selected testimonials deleted successfully";
}

$mqry = "select * from tbl_testimonial order by `tt_sort` ASC, `tt_id` DESC";
?>
<!DOCTYPE html>
<html lang="en">
<?php require("includes/head.php"); ?>
<body>
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<?php require("includes/header.php"); ?>
		<?php require("includes/left.php"); ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Testimonials</a></li>
				<li class="breadcrumb-item active">Written Testimonials</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"><a href="javascript:;" onClick="javascript:history.go(-1)" class="btn btn-l btn-icon btn-circle btn-primary"><i class="fa fa-arrow-left"></i></a> Manage Written Testimonials</h1>
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
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
							<h4 class="panel-title">Manage Written Testimonials</h4>
						</div>
						<!-- end panel-heading -->
						<form name="myform" method="post" action=""> 
						<!-- begin alert -->
						<div class="alert alert-secondary fade show">
							<div class="btn-group btn-group-justified">
								<a href="add-testimonial.php" class="btn btn-primary active"><i class="fa fa-plus"></i> Add New Testimonial</a>
								<input type="Submit" name="Activate" value="Activate" class="btn btn-info btn-flat"> 
								<input type="Submit" name="Deactivate" value="Deactivate" class="btn btn-warning btn-flat"> 
								<input type="Submit" name="Delete" class="btn btn-danger btn-flat" value="Delete" onClick="if(confirm('Are You Sure Want To Delete Selected Testimonial(s)?')){ return true;} else { return false; }">
							</div>
						</div>
						<!-- end alert -->
						<!-- begin panel-body -->
						<div class="panel-body">
							<table id="data-table-responsive" class="table table-striped table-bordered align-middle">
								<thead>
									<tr>
										<th width="1%">S.No.</th>
										<th width="1%">Photo</th>
										<th class="text-nowrap">Name</th>
										<th class="text-nowrap">Title / Company</th>
										<th class="text-nowrap">Review Snippet</th>
										<th width="1%" class="text-center">Order</th>
										<th width="1%" class="text-center">Status</th>
										<th width="1%" class="text-center">Edit</th>
										<th width="1%" class="text-center">Delete</th>
										<th width="1%" class="text-center">
											<input type="checkbox" id="select_all">
										</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$count = 1; 
								$fetch = mysqli_query($conn, $mqry);
								while($web = mysqli_fetch_array($fetch)) { 
									$imgFile = $web['tt_image'];
									$imgPath = "../uploads/testimonial/" . $imgFile;
									$hasRealImg = (!empty($imgFile) && file_exists($imgPath));

									// Monogram fallback
									$np = explode(' ', trim($web['tt_name']));
									$ini = '';
									foreach($np as $p) {
										if(!empty($p)) $ini .= strtoupper($p[0]);
										if(strlen($ini) >= 2) break;
									}
									if(empty($ini)) $ini = 'SG';
								?>
									<tr class="odd gradeX">
										<td width="1%" class="f-s-600 text-inverse text-center"><?php echo $count;?></td>
										<td width="1%" class="with-img text-center">
											<?php if($hasRealImg): ?>
												<img src="<?php echo $imgPath; ?>" class="img-rounded" style="width:46px; height:46px; object-fit:cover; border-radius:50%; border:1px solid #ddd;" />
											<?php else: ?>
												<span style="display:inline-flex; width:44px; height:44px; align-items:center; justify-content:center; border-radius:50%; background:linear-gradient(135deg, #ec2626, #b81515); color:#fff; font-weight:700; font-size:14px; text-transform:uppercase; box-shadow:0 2px 6px rgba(0,0,0,0.15);"><?= $ini; ?></span>
											<?php endif; ?>
										</td>
										<td style="font-weight:700;" class="f-s-600 text-inverse"><?= htmlspecialchars($web['tt_name']);?></td>
										<td class="text-muted"><small style="font-weight:600; font-size:12px;"><?= htmlspecialchars($web['tt_location']);?></small></td>
										<td style="max-width:280px; font-size:12px; line-height:1.4; color:#555;">
											<?= htmlspecialchars(mb_substr(strip_tags($web['tt_detail']), 0, 95)); ?><?php if(mb_strlen(strip_tags($web['tt_detail'])) > 95) echo '...'; ?>
										</td>
										<td width="1%" class="text-center font-weight-bold">
											<span class="badge badge-default" style="font-size:11px;"><?= $web['tt_sort'];?></span>
										</td>
										<td class="text-center">
											<div class="switcher">
												<input type="checkbox" onClick="updateId('<?php echo $web['tt_id']; ?>')" name="switcher_checkbox_1" id="switcher_checkbox_<?php echo $count;?>" <?php if($web['tt_status']=='1'){ echo "checked"; } ?> value="1">
												<label for="switcher_checkbox_<?php echo $count;?>"></label>
											</div>
										</td>
										<td class="text-center">
											<a href="edit-testimonial.php?cid=<?php echo $web['tt_id'];?>" class='label label-sm label-primary' title="Edit"><i class="fa fa-edit"></i> Edit</a>
										</td>
										<td class="text-center">
											<a href="delete/testimonial.php?bid=<?php echo $web['tt_id'];?>" onClick="if(confirm('Are You Sure Want To Delete This Testimonial?')){ return true;} else { return false; }" class='label label-sm label-danger' title="Delete"><i class="fa fa-trash"></i> Delete</a>
										</td>
										<td class="text-center">
											<input type="checkbox" class="checkbox" value="<?php echo $web['tt_id']; ?>" name="bb[]">
										</td>
									</tr>
								<?php $count++; } ?>	
								</tbody>
							</table>
						</div>
						<!-- end panel-body -->
						</form>
					</div>
					<!-- end panel -->
				</div>
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

		function updateId(id) {
			$.ajax({
				url: "status/testimonial.php",
				type: "GET",
				data: { id: id },
				success: function(response) {
					// status updated silently
				},
				error: function(err) {
					console.error("Status update error: ", err);
				}
			});
		}
	</script>
</body>
</html>
