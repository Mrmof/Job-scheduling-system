<?php
  include('function.php');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ECU-clinic</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/all.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu single_page_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="<?=ROOT_URL?>index.php"> <img src="img/logo.png" alt="logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                          <ul class="navbar-nav">
                              <li class="nav-item">
                                  <a class="nav-link" href="<?=ROOT_URL?>index.php">Home</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="<?=ROOT_URL?>contact.php">Contact Us</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="<?=ROOT_URL?>aboutus.php">About Us</a>
                              </li>
                              
                              <li class="nav-item">
                                  <a class="nav-link" href="<?=ROOT_URL?>signin.php">Sign In/Sign Up</a>
                              </li>
                          </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!--::Header part end::-->

    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container" style="margin-top: 150px; margin-bottom: 160px;">
            <div class="row mt-5">
              <div class="col-lg-5">
                <img src="img/banner_img.png" alt="">
              </div>
          <div class="col-lg-5">
          <form class="" action="<?=ROOT_URL?>/php/signin.php" method="post" >
            <div class="row">
            <h5>
            <?php if (isset($_SESSION['message'])) {
               echo $_SESSION['message'];
               unset($_SESSION['message']);
           
             }?> 
          </h5>
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="email" type="email" 
                    placeholder='Enter your valid email'>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="password" type="password" 
                    placeholder='Enter your password'>
                </div>
              </div>
              
              
              <div class="col-sm-12">
                <div class="form-group">
                  <input class="form-control" name="signin"  type="submit" 
                    value='Sign in'>
                </div>
              </div>
            </div>
            <div class="col-sm-12 mt-3">
              <h6>Don't have an account? <a href="signup.php">Sign up</a></h6>
            </div>
          </form>
        </div> 
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

  <!-- ================ contact section start ================= -->
 
  <!-- ================ contact section end ================= -->

  <!--::footer_part start::-->
  <footer class="footer_part">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-md-4 col-lg-4">
                <div class="single_footer_part">
                    <a href="index.html" class="footer_logo_iner"> <img src="img/footer_logo.png" alt="#"> </a>
                    <p>Gathered. Under is whose you'll to make years is mat lights thing together fish made
                        forth thirds cattle behold won't. Fourth creeping first female.
                    </p>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-2">
                <div class="single_footer_part">
                    <h4>About Us</h4>
                    <ul class="list-unstyled">
                        <li><a href="">Managed Website</a></li>
                        <!-- <li><a href="">Manage Reputation</a></li>
                        <li><a href="">Power Tools</a></li>
                        <li><a href="">Marketing Service</a></li>
                        <li><a href="">Customer Service</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-2">
                <div class="single_footer_part">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="">Store Hours</a></li>
                        <li><a href="">Brand Assets</a></li>
                        <!-- <li><a href="">Investor Relations</a></li>
                        <li><a href="">Terms of Service</a></li>
                        <li><a href="">Privacy & Policy</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-2">
                <div class="single_footer_part">
                    <h4>My Account</h4>
                    <ul class="list-unstyled">
                        <li><a href="">Sign In</a></li>
                        <li><a href="">Sign Up</a></li>
                        <!-- <li><a href="">Investor Relations</a></li>
                        <li><a href="">Terms of Service</a></li> -->
                    </ul>
                </div>
            </div>
            <!-- <div class="col-sm-4 col-md-3 col-lg-2">
                <div class="single_footer_part">
                    <h4>Resources</h4>
                    <ul class="list-unstyled">
                        <li><a href="">Application Security</a></li>
                        <li><a href="">Software Policy</a></li>
                        <li><a href="">Supply Chain</a></li>
                        <li><a href="">Agencies Relation</a></li>
                        <li><a href="">Manage Reputation</a></li>
                    </ul>
                </div>
            </div> -->
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-8">
                <div class="copyright_text">
                    <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
                </div>
            </div>
            <!-- <div class="col-lg-4">
                <div class="footer_icon social_icon">
                    <ul class="list-unstyled">
                        <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
                        <li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</footer>
  <!--::footer_part end::-->

  <!-- jquery plugins here-->
  <script src="js/jquery-1.12.1.min.js"></script>
  <!-- popper js -->
  <script src="js/popper.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.min.js"></script>
  <!-- easing js -->
  <script src="js/jquery.magnific-popup.js"></script>
  <!-- swiper js -->
  <script src="js/swiper.min.js"></script>
  <!-- swiper js -->
  <script src="js/masonry.pkgd.js"></script>
  <!-- particles js -->
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <!-- slick js -->
  <script src="js/slick.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/contact.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/mail-script.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
</body>

</html>