 <?php
 require('inc/function.php');
 
$url = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);

 $venue_heading = mysqli_query($conn, "SELECT * FROM tbl_heading where id = '2'");
$venue_detail = mysqli_fetch_assoc($venue_heading);

$magazine = mysqli_fetch_assoc(mysqli_query($conn,"SELECT magazine FROM `tbl_magazine`"));
 
 ?>
 
 <!-- main header -->
         <header class="main-header">
           
            <div class="header-lower py-lg-0 py-2">
                <div class="px-4">
                    <div class="outer-box">
                        <div class="logo-box">
                            <figure class="logo img-fluid"><a href="<?= SITE_URL ?>"><img src="<?= SITE_URL ?>uploads/<?= $profile['pro_logo']; ?>" alt=""></a>
                            </figure>
                        </div>
                        <div class="menu-area clearfix ">
                           
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                            </div>
                            <div class="header-top px-5 d-none d-lg-block ">
                                <div class="top-inner justify-content-center">
                                    <div class="left-column">
                                        <ul class="info clearfix">
                                            <li><i class="fa-solid fa-location-dot"></i><?= $venue_detail['heading'] ?></li>

                                        </ul>


                                    </div>
                                    <!-- <div class="right-column">
                                        <ul class="social-links clearfix">
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                            <hr class="mb-0">
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent"> 
                                    <ul class="navigation clearfix">
                                        <li class="dropdown <?php if($url == '/'){ echo 'current';}else{ echo '';} ?>"><a href="<?= SITE_URL ?>">Home</a>
                                            <ul>
                                                <li class=""><a href="<?= SITE_URL ?>#outro">Introduction
                                                    </a>

                                                </li>
                                                <li class=""><a href="<?= SITE_URL ?>#high">Key highlights
                                                    </a>

                                                </li>
                                                <li class=""><a href="<?= SITE_URL ?>#d-profile">Director profile
                                                    </a>

                                                </li>


                                            </ul>
                                        </li>

                                        <li class="dropdown <?php if($url == 'introduction'){ echo 'current';}else{ echo '';} ?>"><a href="<?= SITE_URL ?>introduction">An introduction
                                            </a>
                                            <ul>
                                                <li class=""><a href="<?= SITE_URL ?>introduction#overview">Overview
                                                    </a>

                                                </li>
                                                <li class=""><a href="<?= SITE_URL ?>introduction#elements">Key elements
                                                    </a>

                                                </li>
                                                <li class=""><a href="<?= SITE_URL ?>introduction#buyer">Buyer seller meet
                                                    </a>

                                                </li>


                                            </ul>
                                        </li>
                                        <li class="dropdown <?php if($url == 'exhibit'){ echo 'current';}else{ echo '';} ?>"><a href="<?= SITE_URL ?>exhibit">exhibit
                                            </a>
                                            <ul>
                                                <li class=""><a href="<?= SITE_URL ?>exhibit#why">Why exhibit

                                                    </a>

                                                </li>
                                                <li class=""><a href="<?= SITE_URL ?>exhibit#exhibit">Who Can Exhibit

                                                    </a>

                                                </li>
                                                <li class=""><a href="<?= SITE_URL ?>exhibit#participation">Participation options

                                                    </a>

                                                </li>

                                                <li class=""><a href="<?= SITE_URL ?>contact">Want To Exhibit


                                                    </a>

                                                </li>

                                                <li class=""><a href="<?= SITE_URL ?>exhibit#profile">Previous exhibitors list
                                                    </a>

                                                </li>
                                            </ul>
                                        </li>

                                        <li class="dropdown <?php if($url == 'visit'){ echo 'current';}else{ echo '';} ?>"><a href="<?= SITE_URL ?>visit">visit
                                            </a>
                                            <ul>
                                                <li class=""><a href="<?= SITE_URL ?>visit"> Visitor profile
                                                    </a>

                                                </li>
                                                <li class=""><a href="#" data-bs-toggle="modal" data-bs-target="#myModal">Get your tickets

                                                    </a>

                                                </li>
                                                <?php
                                                if(!empty($magazine['magazine'])){
                                                ?>
                                                <li class=""><a target = "_blank" href="<?= SITE_URL ?>uploads/magazine/<?= $magazine['magazine']; ?>">Magazine</a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>

                                        <li class="<?php if($url == 'resources'){ echo 'current';}else{ echo '';} ?>"><a href="<?= SITE_URL ?>resources">Gallery</a></li>
                                        <li class="<?php if($url == 'testimonial'){ echo 'current';}else{ echo '';} ?>"><a href="<?= SITE_URL ?>testimonial">Testimonials</a></li>
                                        <li class="<?php if($url == 'contact'){ echo 'current';}else{ echo '';} ?>"><a href="<?= SITE_URL ?>contact">Contact Us</a></li>
                                        <!--<li class="<?php if($url == '#'){ echo 'current';}else{ echo '';} ?>"><a href="#">Magazine</a></li>-->
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="logo-box d-none d-lg-block">
                            <figure class="logo img-fluid"><a href="<?= SITE_URL ?>"><img src="<?= SITE_URL ?>uploads/<?= $profile['pro_dark_logo']; ?>" alt=""></a>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>

            <!--sticky Header-->
            <div class="sticky-header py-2">
                <div class="px-4">
                    <div class="outer-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="<?= SITE_URL ?>"><img src="<?= SITE_URL ?>uploads/<?= $profile['pro_logo']; ?>" alt=""></a></figure>
                        </div>
                        <div class="menu-area clearfix">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                        <div class="logo-box">
                            <figure class="logo img-fluid"><a href="<?= SITE_URL ?>"><img src="<?= SITE_URL ?>uploads/<?= $profile['pro_dark_logo']; ?>" alt=""></a>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->
        
        
            <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>

            <nav class="menu-box">
                <div class="nav-logo"><a href="#"><img src="assets/img/logo.png" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                </div>
                <div class="contact-info">
                    <h4>Contact Info</h4>
                    <ul>
                        <li><?= $contact['con_address'] ?></li>
                        <li><a href="tel: <?= $contact['con_phone2'] ?>"> <?= $contact['con_phone2'] ?></a></li>
                        <li><a href="mailto:<?= $contact['con_email2'] ?>"><?= $contact['con_email2'] ?></a></li>
                    </ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->