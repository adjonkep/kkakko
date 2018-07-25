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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/send.css" >
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
    <a class="btn btn-primary" href="welcome"><i class="fa fa-arrow-left"></i>Back</a>
    <?php
    if (isset($_POST['parcel'])) {
        $type = $_POST['parcel'];
    }
    elseif (isset($_POST['courier'])) {
      $type = $_POST['courier'];
    }
    ?>
    <div id ="app">
      <p>I want to send a <?php if(isset($type)){ echo $type;} ?></p>
      <form>  
        <select id="from">
          <option value="0">From</option>
          <option v-for="city in cities" value="cityName">{{ city.cityName }}</option>
        </select>
        <select id="to">
          <option value="0">To</option>
          <option v-for="city in cities" value="cityName">{{ city.cityName }}</option>
        </select>
        <button type="submit" name="submit" value="enter">Enter</button>
      </form>
    </div>    
    <footer>
      <div class="footer-div">
      <div class="footer-left">
        <p><a>The Journey of kkakko</a></p>
        <p><a>About Us</a></p>
        <p><a>Contact Us</a></p>          
        <p><a>The Contract</a></p>
        <p><a>The Pricing</a></p>
      </div>
      <div class="footer-icon">
        <i class="fab fa-twitter"><a href="http://twitter.kkakko.com"></a></i>
        <i class="fab fa-facebook"><a href="http://facebook.kkakko.com"></a></i>
        <i class="fab fa-linkedin"><a href="http://linkedin.kkakko.com"></a></i>
      </div>
      <div class="footer-right">
        <p><a>F.A.Q</a></p>
        <p><a>Privacy</a></p>
        <p><a>Terms and Conditions</a></p>
      </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vue.js"></script>
    <script>
      const app = new Vue({
          el: '#app',
          data: { 
              cities: <?php echo json_encode($infos) ?>
          }
      })
    </script>
  </body>
</html>