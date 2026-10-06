<?php require('function.php');

?>
 <!-- main-footer -->
        <footer class="main-footer bg-color-1">
            <div class="footer-top py-4">
                <div class="container-fluid" style="overflow:hidden">
                    <div class="row align-items-center clearfix justify-content-center">

                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget schedule-widget ">
                                <div class="widget-title">
                                    <h3 class="heading-with-lines position-relative d-inline-block">Quick Links</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="list clearfix">
                                        <li><a href="<?= SITE_URL ?>introduction" class="text-dark text-decoration-none">About us</a></li>
                                        <li><a href="<?= SITE_URL ?>contact" class="text-dark text-decoration-none">Contact us</a></li>
                                        <li><a href="<?= SITE_URL ?>exhibit" class="text-dark text-decoration-none">Exhibitor</a></li>
                                        <li><a href="<?= SITE_URL ?>resources" class="text-dark text-decoration-none">Resources</a></li>
                                        <li><a href="<?= SITE_URL ?>blogs" class="text-dark text-decoration-none">Blogs</a></li>
                                        <!--<li><a href="https://sgfoodees.in/spices-exhibition-services-in-india.php" class="text-dark text-decoration-none">Food & Backery Exhibition</a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-5 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget logo-widget text-center">
                                <div class="shape">
                                    <div class="shape-1"
                                        style="background-image: url(assets/images/shape/shape-19.png);"></div>
                                    <div class="shape-2"
                                        style="background-image: url(assets/images/shape/shape-20.png);"></div>
                                </div>
                                <div class="widget-content">
                                    <figure class="footer-logo"><a href="#"><img class="img-fluid px-5 py-0"
                                                src="<?= SITE_URL ?>/uploads/<?= $profile['pro_dark_logo'] ?>" alt=""></a></figure>
                                    <!-- <div class="text">
                                        <p>Tincidunt neque pretium lectus donec risus. Mauris mi tempor nunc orc leo
                                            consequat vitae erat gravida lobortis nec et sagittis.</p>
                                    </div> -->
                                    <!-- <ul class="social-links clearfix">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    </ul> -->
                                </div>
                            </div>
                        </div>
                        <!-- 
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget schedule-widget ">
                                <div class="widget-title">
                                    <h3 class="heading-with-lines position-relative d-inline-block">Support</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="list clearfix">
                                        <li>Want to Visit?</li>
                                        <li>FAQs</li>
                                        <li>Travel</li>
                                        <li>Accommodation</li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->


                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column ">
                            <div class=" footer-widget contact-widget " style="text-align: end;">
                                <div class="widget-title">
                                    <h3 class="heading-with-lines position-relative d-inline-block">Contact Info</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="info-list clearfix">
                                        <li><span>Address: </span><?= $contact['con_address'] ?></li>
                                        <li><span>Email: </span><a href="mailto:<?= $contact['con_email2'] ?>"><?= $contact['con_email1'] ?></a>
                                        </li>
                                        <li><span>Call: </span>
                                        <?php 
                                        $footer_phones = [];
                                        if(!empty($contact['con_phone1'])) $footer_phones[] = '<a href="tel:' . $contact['con_phone1'] . '">' . $contact['con_phone1'] . '</a>';
                                        if(!empty($contact['con_phone2'])) $footer_phones[] = '<a href="tel:' . $contact['con_phone2'] . '">' . $contact['con_phone2'] . '</a>';
                                        if(!empty($contact['con_phone3'])) $footer_phones[] = '<a href="tel:' . $contact['con_phone3'] . '">' . $contact['con_phone3'] . '</a>';
                                        echo implode(', ', $footer_phones);
                                        ?>
                                        </li>
                                    </ul>
                                </div>

                                <ul class="d-flex align-items-center g-3 justify-content-end s-link">
                                     <?php if(!empty($contact['con_facebook'])){ ?>
                                            <li>
                                                <a target="_blank" href="<?=$contact['con_facebook']?>">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <?php }
                                                if(!empty($contact['con_instagram'])){
                                            ?>
                                            <li>
                                                <a target="_blank" href="<?=$contact['con_instagram']?>">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <?php }
                                                if(!empty($contact['con_twitter'])){
                                            ?>
                                            <li>
                                                <a target="_blank" href="<?=$contact['con_twitter']?>">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <?php }
                                                if(!empty($contact['con_linkedin'])){
                                            ?>
                                            <li>
                                                <a target="_blank" href="<?=$contact['con_linkedin']?>">
                                                    <i class="fab fa-linkedin"></i>
                                                </a>
                                            </li>
                                            <?php }
                                                if(!empty($contact['con_youtube'])){
                                            ?>
                                            <li>
                                                <a target="_blank" href="<?=$contact['con_youtube']?>">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <?php }
                                                if(!empty($contact['con_whatsaap'])){
                                            ?>
                                            <li>
                                                <a target="_blank" href="https://wa.me/<?=$contact['con_whatsaap']?>">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </li>
                                            <?php } ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom centred py-1 bg-color-1">
                <div class="auto-container">
                    <div class="copyright">
                       <p class="text-light">Copyright © 2024-2025 SGFoodees All Rights Reserved. Managed by Expert Digital India® - <a href="https://expertdigitalindia.com" class="text-light">Google Promotion Services</a> , <a href="https://expertdigitalindia.com/google-promotion-delhi.php" class="text-light">Google Promotion Company In Delhi</a> </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- main-footer end -->
        
        
        
            <div class="modal fade " id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog login-card p-3">
            <div class="modal-content">

                <div class="modal-body">

                    <div class=" ">
                        <!-- <div><small>2025</small></div> -->

                        <div class="login-card-child login-cardbg position-relative px-4 px-lg-0 pt-4 pb-0">
                            <div class="text-center mb-5 position-relative " style="z-index:1111;">

                                <h2 class="position-relative side-border px-3 d-inline-block mb-0 fw-bold">Get your pass
                                    now </h2>
                            </div>
                            <!-- <hr> -->
                            <div>

                                <!--<form class="position-relative" style="z-index:11" method="POST" action="<?=SITE_URL?>registerMail.php">-->
                                <form target="_blank" class="position-relative" style="z-index:11" method="POST" action="<?=SITE_URL?>testpng/passtest/submit">
                                    <div class="row justify-content-center align-items-center">

                                        <div class="col-lg-5">
                                            <div class="mb-2">
                                                <div class=" mb-2 contact-field">
                                                    <span>*</span>
                                                    <i class="fa-solid fa-user"></i> <label for="EmailID"
                                                        class="form-label m-0"> Full Name</label>
                                                </div>
                                                <input type="text" class="form-control" required="" id="EmailID" name="name" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-5">
                                            <div class="mb-2">
                                                <div class=" mb-2 contact-field">
                                                    <span>*</span>
                                                    <i class="fa-solid fa-phone"></i> <label for="EmailID"
                                                        class="form-label m-0">Phone Number</label>
                                                </div>
                                                <input type="text" class="form-control" required="" name="phone" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-10">
                                            <div class="mb-2">
                                                <div class=" mb-2 contact-field">
                                                    <span>*</span>
                                                    <i class="fa-solid fa-envelope"></i> <label for="EmailID"
                                                        class="form-label m-0">Email</label>
                                                </div>
                                                <input type="email" class="form-control" required="" name="email" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-10">
                                            <div class="mb-2">
                                                <div class=" mb-2 contact-field">
                                                    <span>*</span>
                                                    <i class="fa-solid fa-building"></i> <label for="EmailID"
                                                        class="form-label m-0"> Company Name</label>
                                                </div>
                                                <input type="text" class="form-control" required="" id="EmailID" name="company" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-10">
                                            <div class="mb-2">
                                                <div class=" mb-2 contact-field">
                                                    <span>*</span>
                                                    <i class="fa-solid fa-address-card"></i> <label for="EmailID"
                                                        class="form-label m-0"> Designation</label>
                                                </div>
                                                <input type="text" class="form-control" required="" id="EmailID" name="designation" required>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-10">
                                            <div class="mb-2 cus-select">
                                                <div class=" mb-2 contact-field">
                                                    <span>*</span>
                                                    <i class="fa-solid fa-address-card"></i> <label for="EmailID"
                                                        class="form-label m-0">Attendee Type</label>
                                                </div>
                                                <input type="text" class="form-control" readonly value="Visitor" name="exibitor" required>
                                            </div>
                                        </div>                                         



                                    </div>

                                    <div class="c-btn mt-4 text-center col-lg-8 text-center mx-auto">
                                        <button type="submit" name="submit" class=" " style="background: linear-gradient(58deg, rgba(224, 28, 28, 1) 0%, rgba(2, 57, 132, 1) 85%);">Register</button>


                                    </div>
                                    <hr class="my-2 mt-4">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-md-3 col-3">
                                            <img src="assets/img/logo.png" class="img-fluid" alt="SG Foodees Infotech LLP">
                                        </div>
                                        <div class="col-md-3 col-3 text-end">
                                            <img src="assets/img/food.png" class="img-fluid" alt="5th Global Food & Bakery Expo">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>



                </div>

                <i data-bs-dismiss="modal" class="fa-regular fa-circle-xmark close-btn"></i>



            </div>
        </div>
    </div>

    <!-- modal-end -->
    <!--------contact-modal-------->
      <div class="modal fade " id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog  p-3">
            <div class="modal-content">

                <div class="modal-body">

                        <div class=" contact-blob">
                    <form class="position-relative c-contact-form px-4 py-5" style="z-index:11" method="post" action="<?= SITE_URL ?>enquire_1">
                        <h2 class="text-light fw-semibold mb-4">Buyer Enquiry Form</h2>
                        <div class="row justify-content-center align-items-center">

                         
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <div class=" mb-2 contact-field">
                                        <span class="text-light">*</span>
                                        <i class="fa-solid fa-user text-light"></i> <label for="EmailID"
                                            class="form-label m-0 text-light">Name</label>
                                    </div>
                                    <input type="text" class="form-control" required="" id="EmailID"
                                        name="name">
                                </div>
                            </div>
                                  <div class="col-lg-6">
                                <div class="mb-2">
                                    <div class=" mb-2 contact-field">
                                        <span class="text-light">*</span>
                                        <i class="fa-solid fa-phone text-light"></i> <label for="EmailID"
                                            class="form-label m-0 text-light"> Phone no</label>
                                    </div>
                                    <input type="number" class="form-control" required="" id="EmailID"
                                        name="phone">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <div class=" mb-2 contact-field">
                                        <span class="text-light">*</span>
                                        <i class="fa-solid fa-building text-light"></i> <label for="EmailID"
                                            class="form-label m-0 text-light"> Company Name</label>
                                    </div>
                                    <input type="text" class="form-control" required="" id="EmailID"
                                        name="c_name">
                                </div>
                            </div>

                      

                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <div class=" mb-2 contact-field">
                                        <span class="text-light">*</span>
                                        <i class="fa-solid fa-globe text-light"></i> <label for="EmailID"
                                            class="form-label m-0 text-light"> Country</label>
                                    </div>
                                   <div>
                                    <select name="country" id="" class="w-100 mb-3">
                                        <option value="">Select a Country</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BR">Brazil</option>
                                        <option value="CA">Canada</option>
                                        <option value="CN">China</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                        <option value="IN">India</option>
                                        <option value="IT">Italy</option>
                                        <option value="JP">Japan</option>
                                        <option value="MX">Mexico</option>
                                        <option value="RU">Russia</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="ES">Spain</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="VN">Vietnam</option>
                                    </select>
                                   </div>
                                    <!-- <input type="text" class="form-control" required="" id="EmailID"
                                        name="EmailID"> -->
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <div class=" mb-2 contact-field">
                                        <span class="text-light">*</span>
                                        <i class="fa-solid fa-city text-light"></i> <label for="EmailID"
                                            class="form-label m-0 text-light"> City</label>
                                    </div>
                                    <input type="text" class="form-control" required="" id="EmailID" 
                                        name="city">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <div class=" mb-2 contact-field">
                                        <span class="text-light">*</span>
                                        <i class="fa-solid fa-comment text-light"></i> <label for="EmailID"
                                            class="form-label m-0 text-light"> Comments</label>
                                    </div>
                                    <textarea name="comment" id=""></textarea>
                                </div>
                            </div>

                           
                        </div>

                        <div class="c-btn mt-4 text-end col-lg-8 text-center mx-auto">
                            <button type="submit" class=" bg-light text-dark"
                                style="color: white;">Submit</button>
                        </div>
                      
                    </form>
                </div>






                </div>

                <i data-bs-dismiss="modal" class="fa-regular fa-circle-xmark close-btn text-light " style="z-index: 1;"></i>



            </div>
        </div>
    </div>
    <!--------contact-modal-end------->
    <div class="whatsapp-fix  " style="bottom: 100px;">
        <a href="#" data-bs-toggle="modal" data-bs-target="#myModal"
            class="animate__pulse animate__animated faster animate__infinite " target="_blank"> <img
                src="<?= SITE_URL ?>assets/img/t-6.png" alt="WhatsApp Icon"> </a>
    </div>

    <div class="whatsapp-fix  ">
        <a href="tel:9811151444" class="animate__pulse animate__animated faster animate__infinite " target="_blank">
            <img src="<?= SITE_URL ?>assets/img/telephone-call.png" alt="WhatsApp Icon"> </a>
    </div>
