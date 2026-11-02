</main> <!-- Close main-content -->

<style>
/* Enhanced Professional Footer Styling */
.itlc-main-footer {
  position: relative;
  background-color: #03233e;
  background-image: linear-gradient(135deg, rgba(3, 35, 62, 0.94) 0%, rgba(6, 72, 122, 0.90) 100%), url('<?php echo !empty($base_url) ? $base_url : ''; ?>/images/footer-bg.jpg');
  background-position: center center;
  background-size: cover;
  background-repeat: no-repeat;
  color: #d1d9e2;
  font-family: "Trebuchet MS", sans-serif;
  overflow: hidden;
}

.itlc-main-footer .footer-top {
  padding: 65px 0 45px;
}

.itlc-main-footer .footer-logo-img {
  max-width: 175px;
  height: auto;
  display: block;
  transition: transform 0.3s ease;
}

.itlc-main-footer .footer-logo-img:hover {
  transform: scale(1.03);
}

.itlc-main-footer .footer-heading {
  color: #ffffff;
  font-size: 19px;
  font-weight: 700;
  margin-bottom: 10px;
  letter-spacing: 0.3px;
}

.itlc-main-footer .footer-title-bar {
  width: 38px;
  height: 2px;
  background-color: #ffbc3b;
  border-radius: 2px;
  margin-bottom: 22px;
}

.itlc-main-footer .footer-contact-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.itlc-main-footer .footer-contact-list li {
  margin-bottom: 12px;
  font-size: 14.5px;
  line-height: 1.6;
  color: #e2e8f0;
}

.itlc-main-footer .footer-contact-list a {
  color: #e2e8f0;
  text-decoration: none;
  transition: color 0.25s ease;
}

.itlc-main-footer .footer-contact-list a:hover {
  color: #ffbc3b !important;
  text-decoration: none;
}

.itlc-main-footer .footer-nav-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.itlc-main-footer .footer-nav-list li {
  margin-bottom: 12px;
}

.itlc-main-footer .footer-nav-list a {
  color: #e2e8f0;
  font-size: 14.5px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  transition: all 0.25s ease;
}

.itlc-main-footer .footer-nav-list a i {
  font-size: 11px;
  margin-right: 8px;
  color: #ffbc3b;
  transition: transform 0.25s ease;
}

.itlc-main-footer .footer-nav-list a:hover {
  color: #ffbc3b !important;
  transform: translateX(4px);
}

.itlc-main-footer .footer-nav-list a:hover i {
  transform: translateX(2px);
}

.itlc-main-footer .footer-about-text {
  color: #e2e8f0;
  font-size: 14.5px;
  line-height: 1.8;
  margin-bottom: 14px;
  text-align: left;
}

.itlc-main-footer .footer-about-more {
  color: #ffbc3b;
  font-weight: 700;
  font-size: 14.5px;
  display: inline-flex;
  align-items: center;
  text-decoration: none;
  transition: all 0.2s ease;
}

.itlc-main-footer .footer-about-more:hover {
  color: #ffffff;
  text-decoration: underline;
}

.itlc-main-footer .footer-bottom {
  background-color: rgba(2, 20, 36, 0.75);
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  padding: 20px 0;
}

.itlc-main-footer .copyright-text {
  color: #cbd5e1;
  font-size: 13.5px;
  margin: 0;
}

.itlc-main-footer .copyright-text a {
  color: #ffbc3b;
  text-decoration: none;
  font-weight: 600;
}

.itlc-main-footer .copyright-text a:hover {
  color: #ffffff;
  text-decoration: underline;
}

.itlc-main-footer .footer-social-icons {
  list-style: none;
  padding: 0;
  margin: 0;
}

.itlc-main-footer .footer-social-icons li {
  display: inline-block;
  margin-left: 8px;
}

.itlc-main-footer .footer-social-icons a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.1);
  color: #ffffff;
  font-size: 14px;
  transition: all 0.3s ease;
  text-decoration: none;
}

.itlc-main-footer .footer-social-icons a:hover {
  background: #ffbc3b;
  color: #06487a !important;
  transform: translateY(-3px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

.itlc-main-footer .footer-top .row {
  margin-left: -20px;
  margin-right: -20px;
}

.itlc-main-footer .footer-top .col-lg-3 {
  padding-left: 20px;
  padding-right: 20px;
}

@media (max-width: 991px) {
  .itlc-main-footer .footer-top {
    padding: 50px 0 20px;
  }
}
</style>

<!-- footer -->
<footer class="itlc-main-footer">
  <!-- footer top content -->
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <!-- Column 1: Logo & Brief Intro -->
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <a class="d-inline-block mb-3" href="<?php echo !empty($base_url) ? $base_url : 'index.php'; ?>">
            <img class="img-fluid footer-logo-img" src="<?php echo !empty($base_url) ? $base_url : ''; ?>/images/logo/logo_footer.png" alt="IT Leadership Community">
          </a>
          <p class="text-white-50 small mb-0" style="line-height: 1.7;">
            The premier platform empowering IT leaders and technology executives across Bangladesh to connect, collaborate, and innovate.
          </p>
        </div>

        <!-- Column 2: Contact Us (from old web footer) -->
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <h4 class="footer-heading">Contact Us</h4>
          <div class="footer-title-bar"></div>
          <ul class="footer-contact-list">
            <li class="font-weight-bold text-white mb-2">
              <i class="ti-home text-warning mr-2"></i>ITLC
            </li>
            <li class="mb-2">
              <i class="ti-location-pin text-warning mr-2"></i>Dhaka, Bangladesh
            </li>
            <li class="mb-2">
              <i class="ti-mobile text-warning mr-2"></i>Phone: <a href="tel:+8801710817997">+8801710817997</a>
            </li>
            <li class="mb-2">
              <i class="ti-email text-warning mr-2"></i><a href="mailto:fokrulislamrasel@gmail.com">fokrulislamrasel@gmail.com</a>
            </li>
          </ul>
        </div>

        <!-- Column 3: Important Links -->
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <h4 class="footer-heading">Important Links</h4>
          <div class="footer-title-bar"></div>
          <ul class="footer-nav-list">
            <li><a href="<?php echo !empty($base_url) ? $base_url : ''; ?>/contact.php"><i class="ti-angle-right"></i>Contact Us</a></li>
            <li><a href="<?php echo !empty($base_url) ? $base_url : ''; ?>/member.php"><i class="ti-angle-right"></i>Members</a></li>
            <li><a href="<?php echo !empty($base_url) ? $base_url : ''; ?>/events.php"><i class="ti-angle-right"></i>Events</a></li>
            <li><a href="<?php echo !empty($base_url) ? $base_url : ''; ?>/news.php"><i class="ti-angle-right"></i>News</a></li>
            <li><a href="<?php echo !empty($base_url) ? $base_url : ''; ?>/photo-gallery.php"><i class="ti-angle-right"></i>Photo Gallery</a></li>
          </ul>
        </div>

        <!-- Column 4: About ITLC (from old web footer) -->
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <h4 class="footer-heading">About ITLC</h4>
          <div class="footer-title-bar"></div>
          <p class="footer-about-text">
            The IT Leadership Community (ITLC) is a non-profit, non-political organization comprised of senior IT leaders, including CIOs, CTOs, Head of IT, IT Managers, and Project Managers.
          </p>
          <a href="<?php echo !empty($base_url) ? $base_url : ''; ?>/about.php" class="footer-about-more">
            See More
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- copyright bar -->
  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-7 text-center text-md-left mb-3 mb-md-0">
          <p class="copyright-text">
            Copyright &copy; <script>
              var CurrentYear = new Date().getFullYear();
              document.write(CurrentYear);
            </script> <strong class="text-white">IT Leadership Community (ITLC)</strong>. All Rights Reserved.
          </p>
        </div>
        <div class="col-md-5 text-center text-md-right">
          <ul class="footer-social-icons">
            <li><a href="#" target="_blank" title="Facebook"><i class="ti-facebook"></i></a></li>
            <li><a href="#" target="_blank" title="Twitter"><i class="ti-twitter-alt"></i></a></li>
            <li><a href="#" target="_blank" title="LinkedIn"><i class="ti-linkedin"></i></a></li>
            <li><a href="#" target="_blank" title="YouTube"><i class="ti-youtube"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- /footer -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo $base_url; ?>/plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="<?php echo $base_url; ?>/plugins/slick/slick.min.js"></script>
<!-- aos -->
<script src="<?php echo $base_url; ?>/plugins/aos/aos.js"></script>
<!-- venobox popup -->
<script src="<?php echo $base_url; ?>/plugins/venobox/venobox.min.js?v=<?php echo file_exists(__DIR__ . '/../plugins/venobox/venobox.min.js') ? filemtime(__DIR__ . '/../plugins/venobox/venobox.min.js') : time(); ?>"></script>
<!-- mixitup filter -->
<script src="<?php echo $base_url; ?>/plugins/mixitup/mixitup.min.js"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
<script src="<?php echo $base_url; ?>/plugins/google-map/gmap.js"></script>

<!-- Main Script -->
<script src="<?php echo $base_url; ?>/js/script.js?v=<?php echo file_exists(__DIR__ . '/../js/script.js') ? filemtime(__DIR__ . '/../js/script.js') : time(); ?>"></script>

</body>
</html>