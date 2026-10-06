<?php 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$first_part = basename($path);


$sqqll ="SELECT `pro_id`, `pro_logo`,`pro_dark_logo`, `pro_favicon` , `pro_title`, `pro_keyword`, `pro_detail` FROM `tbl_profile`";
$resulltt = $conn->query($sqqll);
$rowww = $resulltt->fetch_assoc();
?>
<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image bg-light">
								<img src="../uploads/<?= $rowww['pro_favicon']; ?>" alt="<?= $adminrec['name'];?>" />
							</div>
							<div class="info">
								<b class="caret pull-right"></b>
								  <?= $adminrec['name'];?>
								<small><?= $adminrec['email'];?></small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
							<li><a href="manage-profile.php"><i class="fa fa-cog"></i> Settings</a></li>
							<li><a href="manage-contact.php"><i class="fa fa-edit"></i> Contact Setting</a></li>
							<li><a href="includes/logout.php" onClick="if(confirm('Are you sure you want to log out?')){ return true;} else { return false; }"><i class="fa fa-sign-out"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					<li class="has-sub <?php if($first_part=="index.php") { echo "active"; } ?>">
						<a href="index.php">
							<b class="caret"></b>
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
						</a>
					</li>
                     <li class="has-sub <?php if($first_part=="manage-banner.php" || $first_part=="add-banner.php"  || $first_part=="manage-main-banner.php" || $first_part=="edit-banner.php" || $first_part=="manage-design.php" || $first_part=="manage-team.php" || $first_part=="add-team.php" || $first_part=="edit-team.php" || $first_part=="manage-home-product-extra.php" || $first_part=="manage-home-product.php" || $first_part=="manage-acheivements.php" || $first_part=="add-acheivements.php" || $first_part=="edit-acheivements.php" || $first_part=="manage-text-industry.php" || $first_part=="manage-industry.php" || $first_part=="edit-industry.php" || $first_part=="manage-feature-extra.php" || $first_part=="manage-feature.php" || $first_part=="edit-feature.php"){ echo "active"; } ?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-home"></i>
							<span>Home Management</span> 
						</a>
						<ul class="sub-menu">
                        	<li><a href="manage-main-banner.php">Banner Management </a></li>
                        	<!--<li><a href="manage-banner.php">Banner Management </a></li>-->
                        	<li><a href="manage-overview.php">Overview Management </a></li>
                        	<li><a href="manage-key-highlight.php">Key High. Management </a></li>
                        	<li><a href="manage-director.php">Director Management </a></li>
                        	<li><a href="manage-support-association.php">Associa. Management </a></li>
                        	<li><a href="manage-venue.php">Venue Management </a></li>
                        	<li><a href="manage-testimonial.php">Testimonials</a></li>
                        	<li><a href="manage-video-testimonials.php">Video Testimonials</a></li>
        					<!--<li><a href="manage-acheivements.php">Achievements Manag..</a></li>-->
        			  <!--    	<li><a href="manage-clients.php">Clients Manag..</a></li>-->
        			  <!--    	<li><a href="manage-get-in-touch.php">Get In Touch Manag..</a></li>-->
        			  <!--    	<li><a href="manage-work-process.php">Work Process Manag..</a></li>-->
        			  <!--    	<li><a href="manage-our-manufaturing-plant.php">Our Manufacturing Manag..</a></li>-->
						</ul>
					</li>
					
					<li class="has-sub <?php if($first_part=="manage-food-backery.php" || $first_part=="edit-food-backery.php" || $first_part=="manage-key-element.php" || $first_part=="manage-dinner.php" || $first_part=="edit-dinner.php" || $first_part=="add-key-element.php" || $first_part=="edit-key-element.php" || $first_part=="manage-meet.php"){ echo "active"; } ?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-home"></i>
							<span>Intro. Management</span> 
						</a>
						<ul class="sub-menu">
						    <li><a href="manage-food-backery.php">Manage F & Backery</a></li>
						    <li><a href="manage-key-element.php">Manage key Element</a></li>
						    <li><a href="manage-dinner.php">Manage Dinner</a></li>
						    <li><a href="manage-meet.php">Manage Meet</a></li>
						</ul>
					</li>
					
					
					<li class="has-sub <?php if($first_part=="manage-previous.php" || $first_part=="manage-participantion.php" ||$first_part=="edit-heading.php" ||$first_part=="manage-heading.php" ||$first_part=="manage-elevate.php" || $first_part=="add-elevate.php" || $first_part=="edit-elevate.php" || $first_part=="manage-profile.php" ){ echo "active"; } ?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-home"></i>
							<span>Exibhit Management</span> 
						</a>
						<ul class="sub-menu">
						    <li><a href="manage-elevate.php">Manage Elevate</a></li>
						    <li><a href="manage-heading.php">Manage Headings</a></li>
						    <li><a href="manage-exibit-profile.php">Manage Profile</a></li>
						    <li><a href="manage-option.php">Manage Option</a></li>
						    <li><a href="manage-participation.php">Manage Participant</a></li>
						    <li><a href="manage-previous.php">Manage Previous</a></li>
						</ul>
					</li>
					
					<li class="has-sub <?php if($first_part=="edit-home.php" || $first_part=="manage-home.php" ||$first_part=="manage-visit.php" || $first_part=="edit-visit.php" ||$first_part=="add-visit.php"){ echo "active"; } ?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-home"></i>
    							<span>Visit Management</span> 
						</a>
						<ul class="sub-menu">
						    <li><a href="manage-visit.php">Manage Visit</a></li>
						    <li><a href="manage-home.php">Manage Home</a></li>
						</ul>
					</li>
					
					<li class="has-sub <?php if($first_part=="manage-gallery.php" || $first_part=="edit-gallery.php" ||$first_part=="add-gallery.php" || $first_part=="manage-brochure.php" || $first_part=="edit-brochure.php" ||$first_part=="add-brochure.php"){ echo "active"; } ?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-home"></i>
    							<span>Resource Management</span> 
						</a>
						<ul class="sub-menu">
						    <li><a href="manage-gallery.php">Manage Gallery</a></li>
						    <li><a href="manage-brochure.php">Manage Brochure</a></li>
						</ul>
					</li>
					
					<li class="has-sub d-none <?php if($first_part=="manage-meta.php" || $first_part=="edit-meta.php") { echo "active"; } ?>">
						<a href="manage-meta.php">
							<b class="caret"></b>
							<i class="fa fa-align-left"></i> 
							<span>Meta Management</span>
						</a>
					</li>
					
					<li class="has-sub  <?php if($first_part=="manage-register-enquiry.php") { echo "active"; } ?>">
						<a href="manage-register-enquiry.php">
							<b class="caret"></b>
							<i class="fa fa-align-left"></i> 
							<span>Register Enquiry</span>
						</a>
					</li> 
					
					<li class="has-sub <?php if($first_part=="manage-pass-enquiry.php") { echo "active"; } ?>">
						<a href="manage-pass-enquiry.php">
							<b class="caret"></b>
							<i class="fa fa-align-left"></i> 
							<span>Visitor Pass Enquiry</span>
						</a>
					</li> 
					
					<li class="has-sub <?php if($first_part=="manage-magazine.php") { echo "active"; } ?>">
						<a href="manage-magazine.php">
							<b class="caret"></b>
							<i class="fa fa-align-left"></i> 
							<span>Magazine Management</span>
						</a>
					</li> 
					
						<li class="has-sub  <?php if($first_part=="manage-pgsponser.php") { echo "active"; } ?>">
						<a href="manage-pgsponser.php">
							<b class="caret"></b>
							<i class="fa fa-align-left"></i> 
							<span>PG Sponsor Management</span>
						</a>
					</li> 
					
					<!-- <li class="has-sub <?php if($first_part=="manage-about.php"){ echo "active"; } ?>">-->
					<!--	<a href="javascript:;">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-home"></i>-->
					<!--		<span>About Us Management</span> -->
					<!--	</a>-->
					<!--	<ul class="sub-menu">-->
					<!--	    <li><a href="manage-about.php">Manage About</a></li>-->
					<!--	    <li><a href="manage-group-companies.php">Group Company</a></li>-->
					<!--	</ul>-->
					<!--</li>-->
					
					
					<!--<li class="has-sub  <?php if($first_part=="manage-outsourcing.php") { echo "active"; } ?>">-->
					<!--	<a href="manage-outsourcing.php">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-align-left"></i> -->
					<!--		<span>Outsourcing Manage..</span>-->
					<!--	</a>	-->
					<!--</li> -->
					
					<!--<li class="has-sub  <?php if($first_part=="manage-homeextra-text.php") { echo "active"; } ?>">-->
					<!--	<a href="javascript:;">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-align-left"></i> -->
					<!--		<span>Extra Management</span>-->
					<!--	</a>-->
					<!--	<ul class="sub-menu">-->
					<!--	    <li><a href="manage-homeextra-text.php">Homepage Extra Text</a></li>-->
					<!--	</ul>-->
					<!--</li>-->
					
					 <li class="has-sub <?php if($first_part=="manage-blogcategory.php" || $first_part=="add-blogcategory.php" || $first_part=="edit-blogcategory.php" || $first_part=="manage-blogs.php" || $first_part=="add-blogs.php" || $first_part=="edit-blogs.php" ){ echo "active"; } ?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-home"></i>
							<span>Blogs Management</span> 
						</a>
						<ul class="sub-menu">
                            <li><a href="manage-blogs.php">Blogs Management</a></li>
						</ul>
					</li>
                     
					<li class="has-sub <?php if(in_array($first_part, ['manage-testimonial.php', 'add-testimonial.php', 'edit-testimonial.php', 'manage-video-testimonials.php', 'add-video-testimonials.php', 'edit-video-testimonials.php'])) { echo 'active'; } ?>">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-comments"></i> 
							<span>Testimonials</span>
						</a>
						<ul class="sub-menu">
							<li class="<?php if(in_array($first_part, ['manage-testimonial.php', 'add-testimonial.php', 'edit-testimonial.php'])) { echo 'active'; } ?>"><a href="manage-testimonial.php">Written Reviews</a></li>
							<li class="<?php if(in_array($first_part, ['manage-video-testimonials.php', 'add-video-testimonials.php', 'edit-video-testimonials.php'])) { echo 'active'; } ?>"><a href="manage-video-testimonials.php">Video Testimonials</a></li>
						</ul>
					</li>
					
     <!--               <li class="has-sub  <?php if($first_part=="manage-focusingon.php") { echo "active"; } ?>">-->
					<!--	<a href="manage-focusingon.php">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-align-left"></i> -->
					<!--		<span>Facilities Manage..</span>-->
					<!--	</a>-->
					<!--</li> -->
					
					<!--<li class="has-sub <?php if($first_part=="manage-event.php"){ echo "active"; } ?>">-->
					<!--	<a href="javascript:;">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-home"></i>-->
					<!--		<span>Event Management</span> -->
					<!--	</a>-->
					<!--	<ul class="sub-menu">-->
					<!--	    <li><a href="manage-event.php">Manage Event</a></li>-->
					<!--	    <li><a href="manage-event-category.php">Event Category</a></li>-->
					<!--	</ul>-->
					<!--</li>-->
					
					<!--<li class="has-sub  <?php if($first_part=="manage-event.php") { echo "active"; } ?>">-->
					<!--	<a href="manage-event.php">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-align-left"></i> -->
					<!--		<span>Event Manage..</span>-->
					<!--	</a>-->
					<!--</li> -->
					
					<!--<li class="has-sub  <?php if($first_part=="manage-event-category.php") { echo "active"; } ?>">-->
					<!--	<a href="manage-event-category.php">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-align-left"></i> -->
					<!--		<span>Event Category Manage..</span>-->
					<!--	</a>-->
					<!--</li> -->
					
					<!--<li class="has-sub  <?php if($first_part=="manage-award.php") { echo "active"; } ?>">-->
					<!--	<a href="manage-award.php">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-align-left"></i> -->
					<!--		<span>Award Manage..</span>-->
					<!--	</a>-->
					<!--</li> -->
					
					<!--<li class="has-sub  <?php if($first_part=="manage-career.php") { echo "active"; } ?>">-->
					<!--	<a href="manage-career.php">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-align-left"></i> -->
					<!--		<span>Career Manage..</span>-->
					<!--	</a>-->
					<!--</li> -->
					
				
					<!--<li class="has-sub <?php if($first_part=="manage-category.php" || $first_part=="add-category.php" || $first_part=="edit-category.php" || $first_part=="manage-subcategory.php" || $first_part=="add-subcategory.php" || $first_part=="edit-subcategory.php" || $first_part=="manage-product.php" || $first_part=="add-product.php" || $first_part=="edit-product.php" ){ echo "active"; } ?>">-->
					<!--	<a href="javascript:;">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-product-hunt"></i>-->
					<!--		<span>Product Management</span> -->
					<!--	</a>-->
					<!--	<ul class="sub-menu">-->
     <!--                       <li><a href="manage-product.php">Product Management</a></li>-->
					<!--	</ul>-->
					<!--</li>-->
					<!--<li class="has-sub <?php if($first_part=="manage-servicesupport.php") { echo "active"; } ?>">-->
					<!--	<a href="manage-servicesupport.php">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-file"></i>-->
					<!--		<span>Our Capabilities Ma..</span>-->
					<!--	</a>-->
					<!--</li>-->
					<!--<li class="has-sub <?php if($first_part=="manage-accreditation.php") { echo "active"; } ?>">-->
					<!--	<a href="manage-accreditation.php">-->
					<!--		<b class="caret"></b>-->
					<!--		<i class="fa fa-file"></i>-->
					<!--		<span>Accreditation Ma..</span>-->
					<!--	</a>-->
					<!--</li>-->
					
                    <li class="has-sub <?php if($first_part=="manage-breadcrumb.php" || $first_part=="edit-breadcrumb.php" ) { echo "active"; } ?>">
						<a href="manage-breadcrumb.php">
							<b class="caret"></b>
							<i class="fa fa-file-image-o"></i>
							<span>Breadcrumb Manag..</span>
						</a>
					</li>
					
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
<div class="sidebar-bg"></div>

