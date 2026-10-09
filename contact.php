<?php
require('inc/function.php');

        $banner = mysqli_query($conn, "SELECT * FROM tbl_banner where bnr_id = '12' and bnr_status = '1'");
        $banner_cont = mysqli_fetch_assoc($banner); 
        
        $contact = mysqli_query($conn, "SELECT * FROM tbl_contact where con_id = '1'");
        $contact_con = mysqli_fetch_assoc($contact); 
        
        $heading = mysqli_query($conn, "SELECT * FROM tbl_heading where id = '2'");
        $heading_con = mysqli_fetch_assoc($heading); 
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Contact | SG Foodees</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php include('inc/head.php'); ?>
<!-- page wrapper -->
</head>

<body>

    <!-- modal-end -->
    <div class="boxed_wrapper">

        <!-- preloader -->
        <?php include('inc/preloader.php'); ?>
        <!-- preloader end -->
         <!-- main header -->
        
        <?php include('inc/header.php'); ?>
        <!-- main-header end -->

        <!-- Page Title -->
        <?php include('inc/page-header.php'); ?>
        <!-- End Page Title -->

        <section class="about-style-two sec-pad  position-relative patt-bg" id="why">


            <div class="auto-container">

                <!-- <div class="s-style mb-5  pb-5">
                    <h1 class="text-dark">Elevate Your Business

                    </h1>
                </div> -->

               <div class="row justify-content-between contact-box bg-light">
                <div class="col-md-7 ">
                    <div class="contact-head">
                       <div class="py-5 px-3">
                        <h1>Get in Touch</h1>
                        <!-- <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor vero reiciendis magni quod autem commodi.</p> -->
                  
                  
                        <ul class="mt-4">
                        <li>
                            <i class="fa-solid fa-location-dot"></i> <small><?= $contact_con['con_address'] ?></small>
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope"></i> <small><a href="mailto:<?= $contact_con['con_email1'] ?>"><?= $contact_con['con_email1'] ?></a> | <a href="mailto:<?= $contact_con['con_email2'] ?>"><?= $contact_con['con_email2'] ?></a> </small>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i> <small><a href="tel:<?= $contact_con['con_phone1'] ?>"><?= $contact_con['con_phone1'] ?></a> | <a href="tel:<?= $contact_con['con_phone2'] ?>"><?= $contact_con['con_phone2'] ?></a> | <a href="tel:<?= $contact_con['con_phone3'] ?>"><?= $contact_con['con_phone3'] ?></a></small>
                        </li>
                    </ul>
<hr class="my-4">
                        <?php
                        
                        $venue = mysqli_query($conn, "SELECT * FROM tbl_venue where id = '1'");
                        $venue_con = mysqli_fetch_assoc($venue); 
                        
                        ?>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="contact-distance">
                                <h5><i class="fa-solid fa-plane-departure "></i><?= $venue_con['heading1'] ?></h5>
                                <?= $venue_con['content1'] ?>
                            </div>
                            
                        </div>

                        <div class="col-md-6">
                            <div class="contact-distance">
                                <h5><i class="fa-solid fa-train-subway"></i> <?= $venue_con['heading2'] ?></h5>
                                <?= $venue_con['content2'] ?>
                            </div>
                           
                        </div>

                        <div class="col-md-6">
                            <div class="contact-distance">
                                <h5><i class="fa-solid fa-bus"></i> <?= $venue_con['heading3'] ?></h5>
                                <?= $venue_con['content3'] ?>
                            </div>
                           
                        </div>
                       </div>
                       </div>
                    
                    </div>
                </div>
                <div class="col-md-5 contact-blob">
                    <form class="position-relative c-contact-form px-4 py-5" style="z-index:11" method="post" action="<?= SITE_URL ?>enquire_1">
                        <h2 class="text-light fw-semibold mb-4">Buyer Enquiry Form</h2>
                        <div class="row justify-content-center align-items-center">

                         
                            <div class="col-lg-12">
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
             
                    <div class="col-lg-12" >
                                    <div class="py-5 map-responsives">
                                        <iframe src="<?= $contact_con['con_map'] ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                 
               </div>
               

            </div>
        </section>

    </div>

<?php require('inc/footer.php');  ?>
<?php require('inc/footer-data.php');  ?>

</body>
</html>