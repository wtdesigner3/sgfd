<?php
require('inc/function.php');

        $home = mysqli_query($conn, "SELECT * FROM tbl_home where id = '1'");
        $home_cont = mysqli_fetch_assoc($home); 

?>

<?php require('inc/head.php');  ?>

<body >





    <div class="home-bg" style="overflow: hidden;">
        <!-- <div class="home-blob"> <img src="assets/img/home-bg.jpeg" class="img-fluid" alt=""></div> -->
       <div class="row align-items-center ">
        <div class="col-lg-7">
            <img src="<?= SITE_URL ?>/uploads/home/<?= $home_cont['image'] ?>" class="img-fluid" alt="">
        </div>
        <div class="col-lg-5 px-5">
            <div class="home-logo mb-5"><img src="<?= SITE_URL ?>/uploads/home/<?= $home_cont['image1'] ?>" class="img-fluid pb-0" alt=""></div>
            <div class="row justify-content-between mt-4">
                <div class="col-md-6">
                    <a href="<?=SITE_URL?>home" class="home-list">
                        <img src="assets/img/home (1).png" class="img-fluid" alt="">
                        <p>Home</p>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="<?=SITE_URL?>introduction" class="home-list">
                        <img src="assets/img/presentation (1).png" class="img-fluid" alt="">
                        <p>Introduction</p>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="<?=SITE_URL?>visit" class="home-list">
                        <img src="assets/img/registration.png" class="img-fluid" alt="">
                        <p>Visitor Registration</p>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="<?=SITE_URL?>exhibit#exhibit" class="home-list">
                        <img src="assets/img/profile.png" class="img-fluid" alt="">
                        <p>Exhibitor’s Profile </p>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="<?=SITE_URL?>exhibit#participation" class="home-list">
                        <img src="assets/img/participation (1).png" class="img-fluid" alt="">
                        <p>Participation</p>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="<?=SITE_URL?>resources" class="home-list">
                        <img src="assets/img/red-carpet.png" class="img-fluid" alt="">
                        <p>Glimpse of Previous Event</p>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="<?=SITE_URL?>exhibit#profile" class="home-list">
                        <img src="assets/img/travel-agent.png" class="img-fluid" alt="">
                        <p>Previous Exhibitors</p>
                    </a>
                </div>

                <div class="col-md-6">
                    <a  href="<?=SITE_URL?>resources#brochure" class="home-list">
                        <img src="assets/img/brochure.png" class="img-fluid" alt="">
                        <p>Food & Bakery Brochure</p>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="<?=SITE_URL?>home#venu" class="home-list">
                        <img src="assets/img/location-pin.png" class="img-fluid" alt="">
                        <p>Venue</p>
                    </a>
                </div>

                <div class="col-md-6">
                    <a href="<?=SITE_URL?>contact" class="home-list">
                        <img src="assets/img/customer-service.png" class="img-fluid" alt="">
                        <p>Contact us</p>
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