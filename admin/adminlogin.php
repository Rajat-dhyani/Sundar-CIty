<?php
session_start();
$person = null;
if(isset($_SESSION['adminid'])){
  echo'<script>window.location= "admin.php";</script>';
  end();
}

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sundar City - Admin </title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../css/sundarcity.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">Sundar City</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="../index.php#portfolio">Before/After</a>
            </li>
            <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="../index.php#about">About</a>
          </li>
              <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="../index.php#contact">Contact us</a>
            </li>
            </ul>
        </div>
      </div>
    </nav>
    <div class="head">
    <div class="container">
      <div class="intro-text">
        <span class="skills">Please login to proceed further</span>
        <hr class="star-light">
      </div>
      <center>
    <div id="loginbox" class="mainbox col-md-6  col-sm-8 ">
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#" style="color:#FFC107">Forgot password?</a></div>
                    </div>

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                        <form id="loginform" class="form-horizontal" role="form" action="loginchk.php" method="post">
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input id="email" type="text" class="form-control" name="email"
                                         placeholder="email" required="required">
                                    </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input id="password" type="password" class="form-control" name="password"
                                        placeholder="password" required="required">
                                    </div>

                        <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                        </label>
                                      </div>
                                    </div>

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <input type="submit" class="btn btn-success btn-default pull-left" value="Login"
                                       id="loginsubmit" /> <span style="margin-left:4px;">

                                    </div>
                                </div>


                            </form>



                        </div>
                    </div>
        </div>
  </center>
</div>
  </div>
</body>
<!-- Footer -->
<footer class="text-center">
  <div class="footer-above">
    <div class="container">
      <div class="row">
        <div class="footer-col col-md-4">
          <h3>Location</h3>
          <p>34 kalpana vihar
            <br>Aam wala Tarla, Dehradun</p>
        </div>
        <div class="footer-col col-md-4">
          <h3>Around the Web</h3>
          <ul class="list-inline">
            <li class="list-inline-item">
              <a class="btn-social btn-outline" href="#">
                <i class="fa fa-fw fa-facebook"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-social btn-outline" href="#">
                <i class="fa fa-fw fa-google-plus"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-social btn-outline" href="#">
                <i class="fa fa-fw fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-social btn-outline" href="#">
                <i class="fa fa-fw fa-linkedin"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn-social btn-outline" href="#">
                <i class="fa fa-fw fa-dribbble"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="footer-col col-md-4">
          <h3>About Sundar City</h3>
          <p>Sundar City is free to use website for registring complaints against bad road conditions, wastes systems, ill public sectors and the likes.
            <a href="login.php">Register Your complaints</a>.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-below">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          Copyright &copy; Sundar City
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top d-lg-none">
  <a class="btn btn-primary js-scroll-trigger" href="#page-top">
    <i class="fa fa-chevron-up"></i>
  </a>
</div>
</html>
