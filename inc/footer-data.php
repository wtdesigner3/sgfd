   <!-- jequery plugins -->
    <script src="<?=SITE_URL?>assets/js/jquery.js"></script>
    <script src="<?=SITE_URL?>assets/js/popper.min.js"></script>
    <script src="<?=SITE_URL?>assets/js/bootstrap.min.js"></script>
    <script src="<?=SITE_URL?>assets/js/owl.js"></script>
    <script src="<?=SITE_URL?>assets/js/wow.js"></script>
    <script src="<?=SITE_URL?>assets/js/validation.js"></script>
    <script src="<?=SITE_URL?>assets/js/jquery.fancybox.js"></script>
    <script src="<?=SITE_URL?>assets/js/appear.js"></script>
    <script src="<?=SITE_URL?>assets/js/scrollbar.js"></script>
    <script src="<?=SITE_URL?>assets/js/isotope.js"></script>
    <script src="<?=SITE_URL?>assets/js/jquery.nice-select.min.js"></script>
    <script src="<?=SITE_URL?>assets/js/parallax-scroll.js"></script>
    <script src="<?=SITE_URL?>assets/js/text_animation.js"></script>
    <script src="<?=SITE_URL?>assets/js/text_plugins.js"></script>
    <script src="<?=SITE_URL?>assets/js/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- main-js -->
    <script src="<?=SITE_URL?>assets/js/script.js"></script>
   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<!-- Placeholder -->
<script>
    $('.exhibit-list-left').slick({
  slidesToShow: 6,
  slidesToScroll: 1,
  arrows:false,
  autoplay: true,
  autoplaySpeed: 0,
  speed: 8000,
  pauseOnHover: true,
  cssEase: 'linear',
  
  
});

$('.exhibit-list-right').slick({
  slidesToShow: 6,
  slidesToScroll: 1,
  arrows:false,
  autoplay: true,
  autoplaySpeed: 0,
  speed: 8000,
  pauseOnHover: true,
  cssEase: 'linear',
  
});
</script>

<script>

    document.addEventListener("DOMContentLoaded", function () {
    const video = document.getElementById("lazyVideo");

    if (video) {
        loadLazyVideo(video);
    } else {
        const observer = new MutationObserver(() => {
            const video = document.getElementById("lazyVideo");
            if (video) {
                loadLazyVideo(video);
                observer.disconnect(); // Stop observing once the element is found
            }
        });

        observer.observe(document.body, { childList: true, subtree: true });
    }
});

function loadLazyVideo(video) {
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
        video.src = video.getAttribute("data-src");
        video.load();
    }
}

</script>


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<script>
(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var enquiryStatus = urlParams.get('enquiry_status') || urlParams.get('status');

    if (enquiryStatus === 'success') {
        // Clean URL parameter so refreshing does not re-trigger
        if (window.history && window.history.replaceState) {
            var cleanUrl = window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);
        }

        // Show visual floating status alert card
        var toast = document.createElement('div');
        toast.id = 'enquirySuccessAlert';
        toast.setAttribute('style', 'position: fixed; top: 30px; right: 30px; z-index: 9999999; background: #ffffff; color: #1e293b; border-left: 6px solid #28a745; box-shadow: 0 12px 36px rgba(0,0,0,0.22); border-radius: 8px; padding: 18px 24px; display: flex; align-items: center; gap: 16px; min-width: 320px; max-width: 90vw; font-family: inherit; transition: opacity 0.4s ease;');
        toast.innerHTML = '<i class="fa-solid fa-circle-check" style="color: #28a745; font-size: 28px;"></i>' +
                          '<div style="flex: 1;">' +
                          '  <div style="font-weight: 700; font-size: 16px; color: #15803d; margin-bottom: 3px;">Form Submission Successful!</div>' +
                          '  <div style="font-size: 13.5px; color: #475569;">Thank you! Your enquiry has been submitted.</div>' +
                          '</div>' +
                          '<button type="button" onclick="this.parentElement.remove();" style="background: none; border: none; font-size: 22px; color: #94a3b8; cursor: pointer; line-height: 1; padding: 0 4px;">&times;</button>';
        
        function appendToast() {
            if (document.body) {
                document.body.appendChild(toast);
                setTimeout(function() {
                    if (toast && toast.parentElement) {
                        toast.style.opacity = '0';
                        setTimeout(function() { toast.remove(); }, 400);
                    }
                }, 2000);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', appendToast);
        } else {
            appendToast();
        }

    } else if (enquiryStatus === 'error') {
        if (window.history && window.history.replaceState) {
            var cleanUrl = window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);
        }
        var errorToast = document.createElement('div');
        errorToast.id = 'enquiryErrorAlert';
        errorToast.setAttribute('style', 'position: fixed; top: 30px; right: 30px; z-index: 9999999; background: #ffffff; color: #1e293b; border-left: 6px solid #dc3545; box-shadow: 0 12px 36px rgba(0,0,0,0.22); border-radius: 8px; padding: 18px 24px; display: flex; align-items: center; gap: 16px; min-width: 320px; max-width: 90vw; font-family: inherit; transition: opacity 0.4s ease;');
        errorToast.innerHTML = '<i class="fa-solid fa-circle-exclamation" style="color: #dc3545; font-size: 28px;"></i>' +
                               '<div style="flex: 1;">' +
                               '  <div style="font-weight: 700; font-size: 16px; color: #b91c1c; margin-bottom: 3px;">Submission Incomplete</div>' +
                               '  <div style="font-size: 13.5px; color: #475569;">Please fill up all required fields (Name, Phone).</div>' +
                               '</div>' +
                               '<button type="button" onclick="this.parentElement.remove();" style="background: none; border: none; font-size: 22px; color: #94a3b8; cursor: pointer; line-height: 1; padding: 0 4px;">&times;</button>';
        
        function appendErrorToast() {
            if (document.body) {
                document.body.appendChild(errorToast);
                setTimeout(function() {
                    if (errorToast && errorToast.parentElement) {
                        errorToast.style.opacity = '0';
                        setTimeout(function() { errorToast.remove(); }, 400);
                    }
                }, 3000);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', appendErrorToast);
        } else {
            appendErrorToast();
        }
    }
})();
</script>
