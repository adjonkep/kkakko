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

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/kkakko.css" >
  </head>

  <body>

    <header>
    </header>
    <div id ="app">
        <h2>{{ product}} are in stock.</h2>
    </div>
    <footer class="text-muted">
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="js/vendor/holder.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vue.js"
    <script>
      const app = new Vue({
          el: '#app',
          data: {product: 'Boots'}
      })
    </script>
  </body>
</html>