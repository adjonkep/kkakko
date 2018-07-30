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
    <div id="invoice-div">
    <p align="center">I want to send a <b><?php if(isset($type)){ echo $type;} ?></b></p>
    </div>
    <div id ="app">
      <form id="from-to-form" align="center" onsubmit="return false;">
        <select id="from">
          <option value="" disabled selected>From</option>
          <option v-for="city in cities">{{ city.cityName }}</option>
        </select>
        <select id="to">
          <option value="" disabled selected>To</option>
          <option v-for="city in cities">{{ city.cityName }}</option>
        </select>
        <button id="submit" v-on:click="fromToEnter()">Enter</button>
      </form>
      <form id="volume-weight-form" align="center" style="display:none;" onsubmit="return false;">
        <div id="volume-div">
          <a>Volume</a>
          <input type="range" min="1" max="100" value="50" class="slider" id="volume-slider"> 
          <a>Cm3</a>
        </div>
        <div id="weight-div">
          <a>Weight</a>
          <input type="range" min="1" max="100" value="50" class="slider" id="weight-slider">
          <a>Kg</a>
        </div>
        <button id="submit" v-on:click="volumeWeightEnter()">Enter</button>
      </form>
      <form id="containing-form" align="center" style="display:none;" onsubmit="return false;">
        <h3>Containing</h3>
        <div id="checkbox-div">
          <input type="checkbox"  value="batteries">Batteries</input>
          <input type="checkbox"  value="fragile-items">Fragile Items</input>
          <input type="checkbox"  value="documents">Documents</input>
          <input type="checkbox"  value="irreplacables">Irreplacables</input>
        </div>
        <button id="submit" v-on:click="containingEnter()">Enter</button>
      </form>
      <form id="value-form" align="center" style="display:none;" onsubmit="return false;">
        <h3>Valued at</h3>
        <input type="text" id="value-text" placeholder="Value">
        <select id="currency">
          <option>Euro</option>
          <option>Dollar</option>
          <option>CFA</option>
        </select>
        <input type="submit">
      </form>
      <form id="shipping-form" align="center" style="display:none;" onsubmit="return false;">
        <h3>Shipping Option</h3>
        <input type="radio" value="standard"><b>Standard</b>, 5 days shipping<br>
        <input type="radio" value="fast"><b>Fast</b>, 3 days shipping<br>
        <input type="radio" value="Overnight"><b>Overight</b>, Tomorrow!
        <div>
        <button id="price-button">Price</button>
        <button id="checkout-button">Checkout</button>
        </div>
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
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
    <script>

      Vue.component('fromToParagraph', {
        props: ['from', 'to'],
        template: '<p>From:{{ from }} To: {{ to }}</p>'
        });

      var vm = new Vue({
          el: '#app',
          data: { 
              cities: <?php echo json_encode($infos)?>
          },
          methods: {
            fromToEnter: function(){
              var from = $("#from option:selected").text();
              var to = $("#to option:selected").text();
              $.ajax({
              type: 'post',
              dataType: 'text',
              url: 'send',
              data: {'from':from,'to':to},
              cache: false,
              success: function(data, textStatus, jQxhr){
              $("#from-to-form").hide() ;
              $("<p align='center'>From: " + from + " To: " + to + "</p>").appendTo($("#invoice-div"));
              $("#volume-weight-form").show();
              },
              error: function( jqXhr, textStatus, errorThrown ){
              console.log( errorThrown );
              }
              })
            },
            volumeWeightEnter: function(){
              var volume = $("#volume-slider").val();
              var weight = $("#weight-slider").val();
              $.ajax({
              type: 'post',
              dataType: 'text',
              url: 'send',
              data: {'volume':volume,'weight':weight},
              cache: false,
              success: function(data, textStatus, jQxhr){
              $("#volume-weight-form").hide() ;
              $("<p align='center'>Volume: " + volume + " Weight: " + weight + "</p>").appendTo($("#invoice-div"));
              $("#containing-form").show();
              },
              error: function( jqXhr, textStatus, errorThrown ){
              console.log( errorThrown );
              }
              })
            },
            containingEnter: function(){
              var selected = "";
              $('#checkbox-div input:checkbox').each(function () {
              selected = (this.checked ? $(this).val() : "");
              });
              $.ajax({
              type: 'post',
              dataType: 'text',
              url: 'send',
              data: selected,
              cache: false,
              success: function(data, textStatus, jQxhr){
              $("#containing-form").hide() ;
              $("<p align='center'>Containing: "+selected+"</p>").appendTo($("#invoice-div"));
              $("#value-form").show();
              },
              error: function( jqXhr, textStatus, errorThrown ){
              console.log( errorThrown );
              }
              })
            }
          }
      })
    </script>
  </body>
</html>