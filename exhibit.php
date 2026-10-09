<?php

require('inc/function.php');

$ex_heading = [];
$ex_image = [];

$exibit_profile = mysqli_query($conn, "SELECT heading,image FROM tbl_exibitor_profile where status = '1' ORDER BY sort");
if(mysqli_num_rows($exibit_profile) > 0){
    while($exibit_row = mysqli_fetch_assoc($exibit_profile)){
        array_push($ex_heading,$exibit_row['heading']);
        array_push($ex_image,$exibit_row['image']);
    }
}

$contact = mysqli_query($conn, "SELECT * FROM tbl_contact where con_id = '1'");
$contact_con = mysqli_fetch_assoc($contact);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Exhibit | SG Foodees</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php include('inc/head.php'); ?>
<!-- page wrapper -->
</head>


<!-- page wrapper -->

<body>
        <!-- preloader -->
        <?php include('inc/preloader.php'); ?>
        <!-- preloader end -->
        
        <?php include('inc/header.php'); ?>


        <!-- Page Title -->
        <?php 
        $banner = mysqli_query($conn, "SELECT * FROM tbl_banner where bnr_id = '9'");
        $banner_cont = mysqli_fetch_assoc($banner);
        include('inc/page-header.php');
        ?>
        <!-- End Page Title -->



                        <?php
                        
                        $elevate_heading = mysqli_query($conn, "SELECT * FROM tbl_heading WHERE id = '1'");
                        $ele_head = mysqli_fetch_assoc($elevate_heading);
                        if(!empty($ele_head)){
                        ?>
        <section class="about-style-two sec-pad  position-relative " id="why">

            <div class="auto-container" style="overflow:hidden;">

                <div class="s-style mb-0 mb-lg-5  pb-5">
                    <h1 class="text-dark"><?= $ele_head['heading'] ?></h1>
                </div>

                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <?php
                        
                        $elevate = mysqli_query($conn, "SELECT * FROM tbl_elevate_business WHERE status = '1' LIMIT 0, 4");
                        if(mysqli_num_rows($elevate) > 0){
                            while($row_elevate = mysqli_fetch_assoc($elevate)){
                                
                        ?>

                        <div class="row mb-4 pb-4 aos-init aos-animate" data-aos="fade-right" data-aos-delay="100"
                            data-aos-duration="600">
                            <div class="col-md-9 text-set  order-md-0 order-1 mt-4 mt-md-0 ">
                                <h4 class="col-primary fw-semibold">
                                    <?= $row_elevate['heading'] ?>
                                </h4>
                                <p><?= $row_elevate['description'] ?>
                                </p>
                            </div>
                            <div class="col-md-3 order-md-3 order-0">
                                <div class="about-blob bg-p-col pulse mt-4 mt-md-0">
                                    <img src="uploads/elevate/<?= $row_elevate['image'] ?>" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                        
                        <?php
                            }
                        } ?>

                    </div>
                    

                    <div class="col-lg-4 text-center aos-init aos-animate mb-5" data-aos="fade-up" data-aos-delay="150"
                        data-aos-duration="1000">
                        <img src="uploads/heading/<?= $ele_head['image'] ?>" class="img-fluid px-2" alt="">
                    </div>

                    <div class="col-lg-4">
                        <?php
                        
                        $elevate1 = mysqli_query($conn, "SELECT * FROM tbl_elevate_business WHERE status = '1' LIMIT 3, 4");
                        if(mysqli_num_rows($elevate1) > 0){
                            while($row_elevate1 = mysqli_fetch_assoc($elevate1)){
                                
                        ?>
                        
                        <div class="row mb-4 pb-4 aos-init aos-animate" data-aos="fade-left" data-aos-delay="150"
                            data-aos-duration="700">
                            <div class="col-md-3">
                                <div class="about-blob bg-f-col pulse mb-4 mb-md-0">
                                    <img src="uploads/elevate/<?= $row_elevate1['image'] ?>" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="col-md-9  text-set-start">
                                <h4 class="col-primary  fw-semibold">
                                   <?= $row_elevate1['heading'] ?>
                                </h4>
                                <p><?= $row_elevate1['description'] ?>
                                </p>
                            </div>
                        </div>

                    
                        <?php
                        
                            } }
                            ?>

                    </div>
                </div>


            </div>
        </section>
            <?php
                        } ?>


        <?php
        if(!empty($ex_heading) && !empty($ex_image)){
        ?>
        <section class="shop-section py-5" id="exhibit" style="background-color: #d3d3d321;">

            <div class="auto-container">
                <div class="s-style mb-5  pb-5">
                    <h1 class="text-dark">Exhibitor Profile</h1>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="gallery2">
                            <div class="gallery-wrapper2">
                                <div class="tall">
                                    <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[0] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[0] ?>">
                                </div>
                                <div class="wide">
                                     <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[1] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[1] ?>">
                                </div>
                                <div class="xl-wide">
                                     <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[2] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[2] ?>">
                                </div>
                                <div class="big">
                                    <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[3] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[3] ?>">

                                    
                                </div>

                                <div class="big">
                                    <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[4] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[4] ?>">

                                    
                                </div>
                                <div class="wide">
                                     <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[5] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[5] ?>">
                                </div>
                                <div class="wide">
                                     <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[6] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[6] ?>">
                                </div>


                                <div class="big">
                                     <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[7] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[7] ?>">
                                </div>
                                <div class="wide">
                                     <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[8] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[8] ?>">
                                </div>
                                <div class="tall">
                                    <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[9] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[9] ?>">
                                </div>
                                <div class="wide">
                                    <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[10] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[10] ?>">
                                </div>

                                <div class="wide">
                                     <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[11] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[11] ?>">
                                </div>
                                <div class="wide">
                                     <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[12] ?>
                                        </a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[12] ?>">
                                </div>
                                <div class="xl-wide">
                                     <div class="text-pro">
                                        <h3><a href="#"><?= $ex_heading[13] ?></a></h3>
                                    </div>
                                    <img src="uploads/exibit-profile/<?= $ex_image[13] ?>">
                                </div>

                            </div>
                            <!-- Add more images here -->
                        </div>
                    </div>

                </div>
            </div>



   
    </section>
        <?php
        } ?>



<?php 

$table_1213 = mysqli_query($conn, "SELECT * FROM tbl_option where status = '1' ORDER BY sort");
if(mysqli_num_rows($table_1213) > 0){
?>
    <section class="about-style-two sec-pad patt-bg position-relative " id="participation">


        <div class="auto-container">

            <div class="s-style mb-5  ">
                <h1 class="text-dark">Participation Options

                </h1>
            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="">

                        <div class="row justify-content-between">
                            <div class="col-md-4">
                                <p class="text-bold">Price Scheme</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-bold" style="text-align: end;">*Rs. per SQM</p>
                            </div>
                        </div>

                        <table class="table table-bordered text-center bg-light">
                            <thead class="table-danger">
                                <tr>
                                    <th>S.no</th>
                                    <th>Description</th>
                                    <th>Shell</th>
                                    <th>Bare</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $table = mysqli_query($conn, "SELECT * FROM tbl_option where status = '1' ORDER BY sort");
                                if(mysqli_num_rows($table) > 0){
                                    $count = 1;
                                    while($table_row = mysqli_fetch_assoc($table)){
                                ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $table_row['description'] ?></td>
                                    <td><?= $table_row['shell'] ?></td>
                                    <td><?= $table_row['bare'] ?></td>
                                </tr>
                                <!--<tr>-->
                                <!--    <td>2</td>-->
                                <!--    <td>Hanger (AC)*</td>-->
                                <!--    <td>7500</td>-->
                                <!--    <td>7000</td>-->
                                <!--</tr>-->
                                <?php
                                $count++;    } 
                                }
                                ?>
                            </tbody>
                        </table>

                        <p class="highlight-note text-center">*Standard Stall Size: Minimum 9 sqm.</p>
                    </div>

                </div>
            </div>
            <div class="row mt-5 pt-3">

<?php
$fasd = mysqli_query($conn, "SELECT * FROM tbl_participation_option ORDER BY id desc");
if(mysqli_num_rows($fasd) > 0){
    while($rows = mysqli_fetch_assoc($fasd)){

?>

                <div class="col-md-6">

                    <div class="shell-box">
                        <div class="shell-img"><img src="uploads/participant/<?= $rows['image'] ?>" class="img-fluid" alt=""></div>
                        <hr class="my-2">
                        <div class="text-dark px-2 py-3">
                            <h3 class="mb-2 fw-bold col-primary shell-subhead"><?= $rows['heading'] ?></h3>
                            <p class="text-dark text-justify"><?= $rows['description'] ?></p>

                        </div>

                    </div>

                </div>
                <?php
                        
    }
}

?>

              
            </div>


        </div>
    </section>
<?php
} ?>

        <?php 
        $previous_exibit123 = mysqli_query($conn, "SELECT * FROM tbl_previous_exhibit where status = '1' ORDER BY id");
        if(mysqli_num_rows($previous_exibit123) > 0){
        ?>
    <section class="about-style-two sec-pad  position-relative " id="profile">
        <div class="auto-container">

            <div class="s-style mb-5  ">
                <h1 class="text-dark">Our Previous Exhibitors

                </h1>
            </div>
            <?php 
            
            $previous_exibit = mysqli_query($conn, "SELECT * FROM tbl_previous_exhibit where status = '1' ORDER BY id");
            $total_per = ceil(mysqli_num_rows($previous_exibit)/4);
            $offset = 0;
            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="exhibit-list-right">
                        <?php
                        $previous_exibit = mysqli_query($conn, "SELECT * FROM tbl_previous_exhibit where status = '1' LIMIT $offset, $total_per ");
                        if(mysqli_num_rows($previous_exibit) > 0){
                            while($row_exibit_pre  = mysqli_fetch_assoc($previous_exibit)){
                            
                        ?>
                        <div class="ex-img">
                            <img src="uploads/previous-exibit/<?= $row_exibit_pre['image'] ?>" class="img-fluid" alt="<?= $row_exibit_pre['alt'] ?>">
                        </div>
                        <?php
                            }
                        }
                        ?>

                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1773SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->

                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1775SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->

                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1776SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->

                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1777SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->

                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1778SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->

                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1779SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->

                    </div>

                </div>

            </div>

            <div class="row mt-4 mt-lg-0">
                <div class="col-md-12">
                    <div class="exhibit-list-left">
                        
                        <?php
                        $offset += $total_per;
                        $previous_exibit1 = mysqli_query($conn, "SELECT * FROM tbl_previous_exhibit where status = '1' LIMIT $offset, $total_per ");
                        if(mysqli_num_rows($previous_exibit1) > 0){
                            while($row_exibit_pre1  = mysqli_fetch_assoc($previous_exibit1)){
                            
                        ?>
                        <div class="ex-img">
                            <img src="uploads/previous-exibit/<?= $row_exibit_pre1['image'] ?>" class="img-fluid" alt="<?= $row_exibit_pre1['alt'] ?>">
                        </div>
                        
                        <?php
                            } 
                        }
                        ?>
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1781SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1782SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1783SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1784SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1785SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1786SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1787SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1788SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1789SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->


                    </div>

                </div>

            </div>

            <div class="row mt-4 pt-5">
                <div class="col-md-12">
                    <div class="exhibit-list-right">
                        <?php
                        $offset += $total_per;
                        $previous_exibit12 = mysqli_query($conn, "SELECT * FROM tbl_previous_exhibit where status = '1' LIMIT $offset, $total_per ");
                        if(mysqli_num_rows($previous_exibit12) > 0){
                            while($row_exibit_pre12  = mysqli_fetch_assoc($previous_exibit12)){
                        ?>
                        <div class="ex-img">
                            <img src="uploads/previous-exibit/<?= $row_exibit_pre12['image'] ?>" class="img-fluid" alt="<?= $row_exibit_pre12['alt'] ?>">
                        </div>
                        
                        <?php
                            } 
                            
                        }
                        ?>
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1791SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1792SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1793SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1794SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1795SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1796SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1797SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1798SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1799SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->


                    </div>

                </div>

            </div>

            <div class="row mt-0">
                <div class="col-md-12">
                    <div class="exhibit-list-left">
                       <?php
                        $offset += $total_per;
                        $previous_exibit123 = mysqli_query($conn, "SELECT * FROM tbl_previous_exhibit where status = '1' LIMIT $offset, $total_per ");
                        if(mysqli_num_rows($previous_exibit123) > 0){
                            while($row_exibit_pre123  = mysqli_fetch_assoc($previous_exibit123)){
                        ?>
                        <div class="ex-img">
                            <img src="uploads/previous-exibit/<?= $row_exibit_pre123['image'] ?>" class="img-fluid" alt="<?= $row_exibit_pre123['alt'] ?>">
                        </div>
                        <?php
                            }
                        } ?>
                        
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1801SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1802SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1803SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1804SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1805SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1806SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1807SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1808SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->
                        <!--<div class="ex-img">-->
                        <!--    <img src="assets/img/exhibhit-list/Asset 1809SG Food .png" class="img-fluid" alt="">-->
                        <!--</div>-->



                    </div>

                </div>

            </div>


        </div>
    </section>
<?php } ?>


<?php include('inc/footer.php'); ?>

<?php include('inc/footer-data.php'); ?>


</body><!-- End of .page_wrapper -->

</html>