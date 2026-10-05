<?php 
require('checksession.php'); 
require('../inc/function.php');

 $totalBanners=mysqli_query($conn,"SELECT count(*) FROM `tbl_banner` where bnr_status='1'");
$banners=mysqli_fetch_assoc($totalBanners);

 $totalTestimonials=mysqli_query($conn,"SELECT count(*) FROM `tbl_testimonial` where tt_status='1'");
 $testimonials=mysqli_fetch_assoc($totalTestimonials);
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<?php require('includes/header.php'); ?>
		<!-- begin #sidebar -->
		<?php require('includes/left.php'); ?>
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header mb-3">Dashboard</h1>
			<!-- end page-header -->
			<!-- begin daterange-filter -->
			<div class="d-sm-flex align-items-center mb-3">
				<a href="#" class="btn btn-inverse mr-2 text-truncate" id="daterange-filter">
					<i class="fa fa-calendar fa-fw text-white-transparent-5 ml-n1"></i> 
					<span id="timestamp"></span>
				</a>
			</div>
			<!-- end daterange-filter -->
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats" style="background-color: #000000!important;">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-inr fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">EDIT</div>
							<div class="stats-number"> WEBSITE DETAILS</div>
							<div class="stats-progress progress">
								<div class="progress-bar" style="width: 70.1%;"></div>
							</div>
							<div class="stats-desc"><a href="manage-contact.php" style="text-decoration:none; color:#FFF;">Update Details</a></div>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-orange">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-image fa-fw"></i></div>
						<div class="stats-info">
							<h4>TOTAL BANNERS</h4>
							<p style="font-size: 27px;"><?php echo $banners["count(*)"]; ?></p>	
						</div>
						<div class="stats-link">
							<a href="manage-banner.php">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<!--<div class="col-lg-3 col-md-6">-->
				<!--	<div class="widget widget-stats bg-black-lighter">-->
				<!--		<div class="stats-icon stats-icon-lg"><i class="fa fa-address-card "></i></div>-->
				<!--		<div class="stats-info">-->
				<!--			<h4>TOTAL TESTIMONIALS</h4>-->
				<!--			<p style="font-size: 27px;"><?php echo $testimonials["count(*)"]; ?></p>	-->
				<!--		</div>-->
				<!--		<div class="stats-link">-->
				<!--			<a href="manage-testimonial.php">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
				<!-- end col-3 -->
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
		});
	</script>
    <script>	
		//---time-----//
		$(document).ready(function() {
			setInterval(timestamp, 1000);
		});
		function timestamp() {
			$.ajax({
			  url: 'includes/time.php',
			  success: function(data) {
		 	  $('#timestamp').html(data);
			  },
			});
		}
	</script>
</body>
</html>
