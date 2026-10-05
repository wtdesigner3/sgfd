<?php 
  $email = $_SESSION['admin_email'];
  $query = mysqli_query($conn,"SELECT * FROM `tbl_admin` WHERE `username` = '$email'");
  $adminrec = mysqli_fetch_array($query);
  
  
$sqqll ="SELECT `pro_id`, `pro_logo`,`pro_dark_logo`, `pro_favicon` , `pro_title`, `pro_keyword`, `pro_detail` FROM `tbl_profile`";
$resulltt = $conn->query($sqqll);
$rowww = $resulltt->fetch_assoc();
?>
<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="index.php" class="navbar-brand "><img src="../uploads/<?= $rowww['pro_logo']; ?>" /></a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header -->
			
			<!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<!--<li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle f-s-14">
						<i class="fa fa-bell"></i>
						<span class="label">5</span>
					</a>
					<ul class="dropdown-menu media-list dropdown-menu-right">
						<li class="dropdown-header">NOTIFICATIONS (5)</li>
						<li class="media">
							<a href="javascript:;">
								<div class="media-left">
									<i class="fa fa-plus media-object bg-silver-darker"></i>
								</div>
								<div class="media-body">
									<h6 class="media-heading"> New User Registered</h6>
									<div class="text-muted f-s-11">1 hour ago</div>
								</div>
							</a>
						</li>
						<li class="media">
							<a href="javascript:;">
								<div class="media-left">
									<i class="fa fa-envelope media-object bg-silver-darker"></i>
									<i class="fab fa-google text-warning media-object-icon f-s-14"></i>
								</div>
								<div class="media-body">
									<h6 class="media-heading"> New Email From John</h6>
									<div class="text-muted f-s-11">2 hour ago</div>
								</div>
							</a>
						</li>
						<li class="dropdown-footer text-center">
							<a href="javascript:;">View more</a>
						</li>
					</ul>
				</li>-->
				<li class="dropdown navbar-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?= SITE_URL ?>uploads/<?= $adminrec['image']; ?>" class="bg-light" alt="<?= $adminrec['name'];?>" /> 
						<span class="d-none d-md-inline"><?= $adminrec['name'];?></span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="manage-profile.php" class="dropdown-item"><i class="fa fa-user"></i> Edit Profile</a>
						<a href="manage-contact.php" class="dropdown-item"><i class="fa fa-cog"></i> Setting</a>
						<div class="dropdown-divider"></div>
						<a href="includes/logout.php" onClick="if(confirm('Are you sure you want to log out?')){ return true;} else { return false; }" class="dropdown-item"><i class="fa fa-sign-out"></i> Log Out</a>
					</div>
				</li>
			</ul>
			<!-- end header navigation right -->
		</div>