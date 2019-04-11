<?php
include("db/opendb.php");
$instance = ConnectDb::getInstance();
$con = $instance->getConnection();
ob_start();
session_start();
// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user'])!="" ) {
  header("Location: Home.php");
  exit;
}
?>

<!doctype html>
<html lang="en">

<head>

  <!-- Basic -->
  <title>CVC-Free Project Management</title>

  <!-- Define Charset -->
  <meta charset="utf-8">

  <!-- Responsive Metatag -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Page Description and Author -->
  <meta name="description" content="Margo - Responsive HTML5 Template">
  <meta name="author" content="iThemesLab">

  <!-- Bootstrap CSS  -->
  <link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" media="screen">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">

  <!-- Slicknav -->
  <link rel="stylesheet" type="text/css" href="css/slicknav.css" media="screen">

  <!-- Margo CSS Styles  -->
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">

  <!-- Responsive CSS Styles  -->
  <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">

  <!-- Css3 Transitions Styles  -->
  <link rel="stylesheet" type="text/css" href="css/animate.css" media="screen">

  <!-- Color CSS Styles  -->
  <link rel="stylesheet" type="text/css" href="css/colors/green.css" title="green" media="screen" />

  <!-- Margo JS  -->
  <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="js/jquery.migrate.js"></script>
  <script type="text/javascript" src="js/modernizrr.js"></script>
  <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.fitvids.js"></script>
  <script type="text/javascript" src="js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
  <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
  <script type="text/javascript" src="js/jquery.appear.js"></script>
  <script type="text/javascript" src="js/count-to.js"></script>
  <script type="text/javascript" src="js/jquery.textillate.js"></script>
  <script type="text/javascript" src="js/jquery.lettering.js"></script>
  <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
  <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
  <script type="text/javascript" src="js/jquery.parallax.js"></script>
  <script type="text/javascript" src="js/mediaelement-and-player.js"></script>
  <script type="text/javascript" src="js/jquery.slicknav.js"></script>
  

  <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>

<body>

  <!-- Full Body Container -->
  <div id="container">


    <!-- Start Header Section -->
    <div class="hidden-header"></div>
    <header class="clearfix">

      <!-- Start  Logo & Naviagtion  -->
      <div class="navbar navbar-default navbar-top">
          
        <div class="container">
            
          <div class="navbar-header">
            <!-- Stat Toggle Nav Link For Mobiles -->

              
            <!-- End Toggle Nav Link For Mobiles -->
            
              <a class="navbar-brand" href="index.html">
              <img class="img-responsive" style="margin-top: -17px; height: 80px; width: 82px;" src="images/logo1.png" alt="logo">
            </a>
              
          </div>
          <div class="navbar-collapse">
            <!-- Start Navigation List -->
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a class="active" href="index.php">Home</a>
              </li>
              <li>
                <a href="#serv">About</a>
              </li>
              <li>
                <a href="#">User Corner</a>
                <ul class="dropdown">
                  <li><a href="login.php">Login</a>
                  </li>
                  <li><a href="signup.php">Sign Up</a>
                  </li>
                </ul>
              </li>
            </ul>
            <!-- End Navigation List -->
          </div>
        </div>

        <!-- Mobile Menu Start -->
        <ul class="wpb-mobile-menu">
          <li>
            <a class="active" href="index.php">Home</a>
          </li>
          <li>
            <a href="#serv">About</a>
          </li>
          <li>
            <a href="#">User Corner</a>
            <ul class="dropdown">
              <li><a href="login.php">Login</a>
              </li>
              <li><a href="signup.php">Sign Up</a>
              </li>
            </ul>
          </li>
        </ul>
        <!-- Mobile Menu End -->

      </div>
      <!-- End Header Logo & Naviagtion -->

    </header>
    <!-- End Header Section -->


    <!-- Start Home Page Slider -->
    <section id="home">
      <!-- Carousel -->
      <div id="main-slide" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#main-slide" data-slide-to="0" class="active"></li>
          <li data-target="#main-slide" data-slide-to="1"></li>
          <li data-target="#main-slide" data-slide-to="2"></li>
        </ol>
        <!--/ Indicators end-->

        <!-- Carousel inner -->
        <div class="carousel-inner">
          <div class="item active">
            <img class="img-responsive" src="images/slider/bg1.jpg" alt="slider">
            <div class="slider-content">
              <div class="col-md-12 text-center">
                <h2 class="animated2">
                  <span>Welcome to <strong>CVC</strong></span>
                </h2>
                <h3 class="animated3">
                  <span>We are Collaborative Virtual Camp<br/></span>
				  <br>Helping your Group Efforts 
                </h3>
                <p class="animated4"><a href="signup.php" class="slider btn btn-system btn-large">Click here to Join us</a>
                </p>
              </div>
            </div>
          </div>
          <!--/ Carousel item end -->
          <div class="item">
            <img class="img-responsive" src="images/slider/bg2.jpg" alt="slider">
            <div class="slider-content">
              <div class="col-md-12 text-center">
                <h2 class="animated4">
                  <span> We believe in <strong>Work Division </strong></span>
                </h2>
                <h3 class="animated5">
                  <span>Divide and Conquer</span>
                </h3>
                <p class="animated6"><a href="login.php" class="slider btn btn-system btn-large">Click here to Login</a>
                </p>
              </div>
            </div>
          </div>
          <!--/ Carousel item end -->
          <div class="item">
            <img class="img-responsive" src="images/slider/bg3.jpg" alt="slider">
            <div class="slider-content">
              <div class="col-md-12 text-center">
                <h2 class="animated7 white">
                  <span>The way of <strong>Success</strong></span>
                </h2>
                <h3 class="animated8 white">
                  <span>Why you are waiting</span>
                </h3>
                <div class="">
                  <a class="animated4 slider btn btn-system btn-large btn-min-block" href="signup.php">Join us today</a>
                </div>
              </div>
            </div>
          </div>
          <!--/ Carousel item end -->
        </div>
        <!-- Carousel inner end-->

        <!-- Controls -->
        <a class="left carousel-control" href="#main-slide" data-slide="prev">
          <span><i class="fa fa-angle-left"></i></span>
        </a>
        <a class="right carousel-control" href="#main-slide" data-slide="next">
          <span><i class="fa fa-angle-right"></i></span>
        </a>
      </div>
      <!-- /carousel -->
    </section>
    <!-- End Home Page Slider -->


    <!-- Start Services Section -->
    <div class="section service">
      <div class="container">
        <div class="row">

          <!-- Start Big Heading -->
          <div class="big-title text-center">
            <h1>We empower people to <span class="accent-color">work together</span> whether you have <span class="accent-color">wedding plans</span>, organizing a <span class="accent-color">camping trip</span> or leading a <span class="accent-color">work project</span>.</h1>
            <p class="title-desc">Working from home or at the office. CVC is in the center of it all.</p>
          </div>
          <!-- End Big Heading -->

          <!-- Start Memebr 1 -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="team-member">
              <!-- Memebr Photo, Name & Position -->
              <div class="member-photo">
                <img alt="" src="images/architect.jpg" />
                <div class="member-name">FREELANCE <span>Team</span></div>
              </div>
            </div>
          </div>
          <!-- End Memebr 1 -->

          <!-- Start Memebr 2 -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="team-member">
              <!-- Memebr Photo, Name & Position -->
              <div class="member-photo">
                <img alt="" src="images/business.jpg" />
                <div class="member-name">BUSINESS <span>Group</span></div>
              </div>
            </div>
          </div>
          <!-- End Memebr 2 -->

          <!-- Start Memebr 3 -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="team-member">
              <!-- Memebr Photo, Name & Position -->
              <div class="member-photo">
                <img alt="" src="images/designer.jpg" />
                <div class="member-name">DESIGNERS <span>Squad</span></div>
              </div>
            </div>
          </div>
          <!-- End Memebr 3 -->

          <!-- Start Memebr 4 -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="team-member">
              <!-- Memebr Photo, Name & Position -->
              <div class="member-photo">
                <img alt="" src="images/travel.jpg" />
                <div class="member-name">TRAVEL <span>Agency</span></div>
              </div>
            </div>
          </div>
          <!-- End Memebr 4 -->
        </div>
        <div class="row">

          <!-- Start Memebr 5 -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="team-member">
              <!-- Memebr Photo, Name & Position -->
              <div class="member-photo">
                <img alt="" src="images/camping.jpg" />
                <div class="member-name">JCAMPING <span>Trips</span></div>
              </div>
            </div>
          </div>
          <!-- End Memebr 5 -->

          <!-- Start Memebr 6 -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="team-member">
              <!-- Memebr Photo, Name & Position -->
              <div class="member-photo">
                <img alt="" src="images/school.jpg" />
                <div class="member-name">SCHOOL <span>Projects</span></div>
              </div>
            </div>
          </div>
          <!-- End Memebr 6 -->

          <!-- Start Memebr 7 -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="team-member">
              <!-- Memebr Photo, Name & Position -->
              <div class="member-photo">
                <img alt="" src="images/client.jpg" />
                <div class="member-name">CLIENT <span>Work</span></div> 
              </div>
            </div>
          </div>
          <!-- End Memebr 7 -->

          <!-- Start Memebr 8 -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="team-member">
              <!-- Memebr Photo, Name & Position -->
              <div class="member-photo">
                <img alt="" src="images/shopping.jpg" />
                <div class="member-name">SHOPPING <span>Centre</span></div>
              </div>
            </div>
          </div>
          <!-- End Memebr 8 -->

        </div>
        <!-- .row -->
      </div>
      <!-- .container -->
    </div>
    <!-- End Services Section -->


    <!-- Start Services Section -->
    <div class="section service">
      <div class="container">
        <div class="row">
          <h1 class="classic-title"><span>How do you stay organized?</span></h1>
          <!-- Start Big Heading -->
          <div class="big-title text-center">
            <h4>For decades we have relied on different methods to help us stay organized. We provide you a digital version of those same systems to use by yourself or as a group!</h4>
          </div>
          <!-- End Big Heading -->

          <!-- Start Memebr 1 -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="team-member">
              <!-- Memebr Photo, Name & Position -->
              <div class="member-photo">
                <img alt="" src="images/tasklist.png" style="width: 550px;" />
                <div class="member-name">Task <span>Lists</span></div>
              </div>
              <!-- Memebr Words -->
              <div class="member-info">
                <p>Have you ever pulled up a piece of paper and jotted down a list of tasks? Then as you complete them you drew a line through each item giving you the satisfaction of completion and progress. Our system offers this type of list organization with a great deal of advanced features.</p>
              </div>
            </div>
          </div>
          <!-- End Memebr 1 -->

          <!-- Start Memebr 2 -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="team-member">
              <!-- Memebr Photo, Name & Position -->
              <div class="member-photo">
                <img alt="" src="images/stickynotes.png" style="width: 550px;" />
                <div class="member-name">Sticky <span>Notes</span></div>
              </div>
              <!-- Memebr Words -->
              <div class="member-info">
                <p>Like to use sticky notes? Great! The kanban board was invented a long time ago in Japan and is a phenomenal way to work on a set of tasks - simply move them from left to right as you begin and complete work on a task. It provides a very fast overview of what you and your team are working on.</p>
              </div>
            </div>
          </div>
          <!-- End Memebr 2 -->
        </div>
        <!-- .row -->
      </div>
      <!-- .container -->
    </div>
    <!-- End Services Section -->


    <!-- Start Footer Section -->
    <footer>
      <div class="container">

        <!-- Start Copyright -->
        <div class="copyright-section">
          <div class="row">
            <div class="col-md-6">
              <p>&copy; 2016 CVC - All Rights Reserved <a href="">FYP</a></p>
            </div>
            <!-- .col-md-6 -->
            <div class="col-md-6">
              <ul class="footer-nav">
                <li><a href="#" style="color:white;">Contact</a></li>
                <li><a href="#" style="color:white;">FAQs</a></li>
                <li><a href="#" style="color:white;">Privacy Policy</a></li>
                <li><a href="#" style="color:white;">Terms of Use</a></li>
              </ul>
            </div>
            <!-- .col-md-6 -->
          </div>
          <!-- .row -->
        </div>
        <!-- End Copyright -->

      </div>
    </footer>
    <!-- End Footer Section -->


  </div>
  <!-- End Full Body Container -->

  <!-- Go To Top Link -->
  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <div id="loader">
    <div class="spinner">
      <div class="dot1"></div>
      <div class="dot2"></div>
    </div>
  </div>

  <script type="text/javascript" src="js/script.js"></script>

</body>

</html>