<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="//kkakko.com/uploads/site_favicon.png">

    <title>KkaKko - Reinventing International Delivery</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"  >
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/kkakko.css" >
  </head>

  <body>
    <header>
      <div class="topnav">
        <div class="logo">
          <a href="#">
            <img src="<?php echo base_url(); ?>assets/images/kkakko-logos-13.png">
          </a>
        </div>
        <div class="header-util">
            <button class="w3-button">Login</button>
            <button class="w3-button">Register</button>
        </div>
      </div>
    </header>
    <div class="welcome-div">
      <h3 align="center">Bienvenue sur <span class="logo-inside"><img alt="KkakKo Logo" class="img-responsive" src="<?php echo base_url(); ?>assets/images/kkakko.png"/></span>,</br>Votre nouvelle fa&ccedil;on d&#39;exp&eacute;dier courriers et petits colis &agrave; travers le monde.</h3>
    </div>
    <?php
    session_start($newdata = array(
        'username'  => 'johndoe',
        'email'     => 'johndoe@some-site.com',
        'logged_in' => FALSE
    ));
    
    $this->session->set_userdata($newdata);
    ?>
    <div class="send-div" align="center">
      <form action="index.php/send" method="post">
        <p class="send-label-div">I want to send</p>
        <input type="submit" class="btn btn-primary my-2" name='parcel' value="parcel">
        <input type="submit" class="btn btn-primary my-2" name='courier' value="courier">
      </form>
    </div>
    <footer>
      <div class="footer-div">
      <div class="footer-left">
        <p class="listing-left">
          <a>The Journey of kkakko</a>
          <a>About Us</a>
          <a>Contact Us</a>          
          <a>The Contract</a>
          <a>The Pricing</a>
        </p>
      </div>
      <div class="footer-icon">
        <p>
          <a href="http://twitter.kkakko.com"><i class="fab fa-twitter"></i></a>
          <a href="http://facebook.kkakko.com"><i class="fab fa-facebook"></i></a>
          <a href="http://linkedin.kkakko.com"><i class="fab fa-linkedin"></i></a>
        </p>
      </div>
      <div class="footer-right">
        <p class="listing-right">
          <a>F.A.Q</a>
          <a>Privacy</a>
          <a>Terms and Conditions</a>
        </p>
      </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>