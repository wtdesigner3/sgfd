<?php
require('inc/function.php');

        $home = mysqli_query($conn, "SELECT * FROM tbl_home where id = '1'");
        $home_cont = mysqli_fetch_assoc($home); 

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from azim.commonsupport.com/SGFoodees/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Jan 2025 12:13:34 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>SG Foodees</title>

    <!-- Fav Icon -->
    <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caladea:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Zilla+Slab:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="assets/css/font-awesome-all.css" rel="stylesheet">
    <link href="assets/css/flaticon.css" rel="stylesheet">
    <link href="assets/css/owl.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/jquery.fancybox.min.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/nice-select.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">
    <link href="assets/css/color.css" rel="stylesheet">
    <link href="assets/css/elpath.css" rel="stylesheet">
    <link href="assets/css/style.css?v=<?= time() ?>" rel="stylesheet">
    <link href="assets/css/responsive.css?v=<?= time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>


<!-- page wrapper -->

<body >





    <div class="home-bg" style="overflow: hidden;">
        <!-- <div class="home-blob"> <img src="assets/img/home-bg.jpeg" class="img-fluid" alt=""></div> -->
       <div class="row align-items-center ">
        <div class="col-lg-7">
            <img src="<?= SITE_URL ?>/uploads/home/<?= $home_cont['image'] ?>" class="img-fluid" alt="">
        </div>
        <div class="col-lg-5 px-5">
            <div class="home-logo mb-5"><img src="<?= SITE_URL ?>/uploads/home/<?= $home_cont['image1'] ?>" class="img-fluid pb-0" alt=""></div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6 text-center">
                   <h1 class="text-light" style="    color: black !important;
    font-weight: 600;
    font-size: 50px;">
                      Thankyou 
                   </h1>
                   <a href="<?=SITE_URL?>" class="home-list" style="text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;">
                        <img src="<?=SITE_URL?>assets/img/home (1).png" class="img-fluid" alt="">
                        <p>Back to Home</p>
                    </a>
                </div>



            </div>

            
        </div>
       </div>
    </div>




    <!-- jequery plugins -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/jquery.fancybox.js"></script>
    <script src="assets/js/appear.js"></script>
    <script src="assets/js/scrollbar.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/parallax-scroll.js"></script>
    <script src="assets/js/text_animation.js"></script>
    <script src="assets/js/text_plugins.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- main-js -->
    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-player/1.4.3/lottie-player.js" integrity="sha512-gloNJjJNXOqLPOVxOJ/Sg9VN4jSPZpDdEQC+CDP0TczZ6OaOk0Ru1daFEOT/XAJY7fYABwFWVRXOx4HMFr6+lA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body><!-- End of .page_wrapper -->
<!-- Placeholder -->


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const video = document.getElementById("lazyVideo");

        if ("IntersectionObserver" in window) {
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        video.src = video.getAttribute("data-src");
                        video.load();
                        observer.disconnect();
                    }
                });
            });
            observer.observe(video);
        } else {
            // Fallback for older browsers
            video.src = video.getAttribute("data-src");
            video.load();
        }
    });
</script>

<script type="text/javascript">
    //    $(window).on('load', function() {
    //     setTimeout(function() {
    //         $('#myModal').modal('show');
    //     }, 0); // 5000 milliseconds = 5 seconds
    // });

    $(window).on('load', function () {
        let modalShown = false;

        $(window).scroll(function () {
            if (!modalShown && $(window).scrollTop() + $(window).height() >= $(document).height()) {
                $('#myModal').modal('show');
                modalShown = true;
            }
        });
    });
</script>
<script>
    (function ($) {
        $.fn.countTo = function (options) {
            // merge the default plugin settings with the custom options
            options = $.extend({}, $.fn.countTo.defaults, options || {});
            // how many times to update the value, and how much to increment the value on each update
            var loops = Math.ceil(options.speed / options.refreshInterval),
                increment = (options.to - options.from) / loops;

            return $(this).each(function () {
                var _this = this,
                    loopCount = 0,
                    value = options.from,
                    interval = setInterval(updateTimer, options.refreshInterval);

                function updateTimer() {
                    value += increment;
                    loopCount++;
                    $(_this).php(value.toFixed(options.decimals));

                    if (typeof (options.onUpdate) == 'function') {
                        options.onUpdate.call(_this, value);
                    }

                    if (loopCount >= loops) {
                        clearInterval(interval);
                        value = options.to;

                        if (typeof (options.onComplete) == 'function') {
                            options.onComplete.call(_this, value);
                        }
                    }
                }
            });
        };

        $.fn.countTo.defaults = {
            from: 0,
            to: 100,
            speed: 1000,
            refreshInterval: 100,
            decimals: 0,
            onUpdate: null,
            onComplete: null,
        };
    })(jQuery);


    function isViewed(selector) {

        var viewport = $(window),
            item = $(selector);

        var viewTop = viewport.scrollTop(),
            viewBtm = viewport.scrollTop() + viewport.height(),
            itemTop = item.offset().top,
            itemBtm = item.offset().top + item.height();

        return ((itemTop < viewBtm) && (itemTop > viewTop));
    };

    var counter = setInterval(function () { countdown() }, 500);

    var countdown = function () {
        var random1 = Math.floor(Math.random() * (343 - 14 + 1)) + 14;
        var random2 = Math.floor(Math.random() * (5891 - 5627 + 1)) + 5627;
        var random3 = Math.floor(Math.random() * (686 - 28 + 1)) + 28;
        var random4 = Math.floor(Math.random() * (5627 - 4872 + 1)) + 4872;
        if (isViewed('.milestone')) {
            clearInterval(counter);
            $('.timer1').countTo({
                from: 0,
                to: 5000,
                speed: 1000,
                refreshInterval: 20,
            });
            $('.timer2').countTo({
                from: 0,
                to: 129,
                speed: 1000,
                refreshInterval: 20,
            });
            $('.timer3').countTo({
                from: 0,
                to: 1,
                speed: 1000,
                refreshInterval: 20,
            });
            $('.timer4').countTo({
                from: 0,
                to: 150,
                speed: 1000,
                refreshInterval: 20,
            });
        };
    }
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>



</html>