<?php
require('inc/function.php');

        $banner = mysqli_query($conn, "SELECT * FROM tbl_banner where bnr_id = '10'");
        $banner_cont = mysqli_fetch_assoc($banner);

        $contact = mysqli_query($conn, "SELECT * FROM tbl_contact where con_id = '1'");
        $contact_con = mysqli_fetch_assoc($contact);
        

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Visit | SG Foodees</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php include('inc/head.php'); ?>
<!-- page wrapper -->
</head>


<body>
    
    <div class="boxed_wrapper">

        <!-- preloader -->
        <?php include('inc/preloader.php'); ?>
        <!-- preloader end -->
         <?php include('inc/header.php'); ?>
        <!-- Page Title -->
        <?php
        if(!empty($banner_cont['bnr_image'])){
        ?>
        <section class="page-title centred">
            <div class="bg-layer"
                style="background-image: url(uploads/banner/<?= $banner_cont['bnr_image'] ?>); background-size: cover; background-position: bottom;">
            </div>
            <div class="auto-container">
                <div class="content-box">
                    
                   <div class="fg-logo"> <h2 class="mb-3">Visitor Profile</h2> <img src="uploads/banner/<?= $banner_cont['bnr_logo'] ?>" class="img-fluid" alt=""></div>

                </div>
            </div>
        </section>
        <?php } ?>
        <!-- End Page Title -->

<?php
        $visit = mysqli_query($conn, "SELECT heading,image,description FROM tbl_visit where status = '1' ORDER BY sort");
        if(mysqli_num_rows($visit) > 0){
            $count = 1;
            while($visit_row = mysqli_fetch_assoc($visit)){
?>                             
<?php if($count%2 == 1){ ?>
        <section class="about-style-two sec-pad  position-relative overflow-hidden  visit-bg" >
            <div class="auto-container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 p-2 p-md-5 mb-4 mb-lg-0 align-self-baseline " data-aos="fade-right" data-aos-delay="200" data-aos-duration="800">

                        <div class="visit-about" >
                            <img src="uploads/visit/<?= $visit_row['image'] ?>" class="c-page-box img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-left" data-aos-delay="400" data-aos-duration="1000">
                        <div class="visit-card">
                            <div class="visit-card-head"> <div class="visit-tag"><?= $visit_row['heading'] ?></div></div>
                            
                            <?= $visit_row['description'] ?>
                        </div>

                    </div>
                </div>
            </div>
        </section>
<?php } ?>
        
        <?php if($count%2 == 0){ ?>
        <section class="about-style-two sec-pad  position-relative overflow-hidden  visit-bg visit-bg-left" style="background-color: #80808015;" >
            <div class="auto-container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-6" data-aos="fade-right" data-aos-delay="200" data-aos-duration="800">
                        <div class="visit-card ">
                            <div class="visit-card-head"> <div class="visit-tag"><?= $visit_row['heading'] ?></div></div>
                           
                            <?= $visit_row['description'] ?>
                        </div>

                    </div>

                    <div class="col-lg-6 p-2 p-md-5 align-self-baseline " data-aos="fade-left" data-aos-delay="400" data-aos-duration="1000">

                        <div class="visit-about visit-about-right">
                            <img src="uploads/visit/<?= $visit_row['image'] ?>" class="c-page-box img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        
<?php
$count++;
  } 
    }
?>

</div>

<?php require('inc/footer.php'); ?>
 <?php require('inc/footer-data.php'); ?>

</body>

</html>