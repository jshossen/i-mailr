<!DOCTYPE html>
<html lang="en">

  <head>
    <script type="text/javascript">var base = "<?php echo BASE;?>";</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="google-site-verification" content="8VlNhZlEnMLgxDF_91986HCkQq55SR86rCmCDRI2caw" />

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo BASE; ?>/files/images/fab/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo BASE; ?>/files/images/fab/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo BASE; ?>/files/images/fab/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo BASE; ?>/files/images/fab/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo BASE; ?>/files/images/fab/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo BASE; ?>/files/images/fab/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo BASE; ?>/files/images/fab/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo BASE; ?>/files/images/fab/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE; ?>/files/images/fab/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo BASE; ?>/files/images/fab/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE; ?>/files/images/fab/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo BASE; ?>/files/images/fab/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE; ?>/files/images/fab/favicon-16x16.png">

    <title><?php echo TITLE;?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?php echo BASE; ?>/files/home/css/coming-soon.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/files/home/css/funnyText.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/files/home/css/style.css">
    <link href="<?php echo BASE; ?>/files/css/style.css" rel="stylesheet">

    <script type="text/javascript">
      window.fbAsyncInit = function() {
      FB.init({
        appId      : '296472054161027',
        cookie     : true,
        xfbml      : true,
        version    : 'v2.8'
      });
      FB.AppEvents.logPageView();
    };

    (function(d, s, id){
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {return;}
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript" src="https://connect.facebook.net/en_US/sdk.js"></script>

  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav" style=" background-color: #2c4869; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
      <div class="container">
        <a class="navbar-brand" href="<?php echo BASE.'/home';?>"><?php echo TITLE;?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo BASE.'/home';?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo BASE.'/contact';?>">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo BASE.'/pricing';?>">Pricing</a>
            </li>
            <?php 
              if (!logged_in()) {
            ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo BASE.'/sign_up';?>">Sign up</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo BASE.'/sign_in';?>">Sign in</a>
                </li>
            <?php
              }
              else {
            ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo BASE.'/dashboard';?>">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo BASE; ?>/revoke_me/?provider=bulkmail">Log out</a>
                </li>
            <?php
              }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo BASE.'/tutorial';?>">Tutorial</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo BASE.'/api';?>">API</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="social-icons" style="display: none;">
      <ul class="list-unstyled text-center mb-0">
        <li class="list-unstyled-item">
          <a href="#"><i class="fa fa-twitter"></i></a>
        </li>
        <li class="list-unstyled-item">
          <a href="#"><i class="fa fa-facebook"></i></a>
        </li>
        <li class="list-unstyled-item">
          <a href="#"><i class="fa fa-instagram"></i></a>
        </li>
      </ul>
    </div>