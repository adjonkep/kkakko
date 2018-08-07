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
    
    <?php
    if (isset($_POST['parcel'])) {
        $type = $_POST['parcel'];
    }
    elseif (isset($_POST['courier'])) {
      $type = $_POST['courier'];
    }
    ?>
    
    <div id ="app">
      <button class="btn btn-primary" v-on:click="goBack()"><i class="fa fa-arrow-left"></i> Return</button>
      <div id="invoice-div">
        <p align="center">I want to send a <b><?php if(isset($type)){ echo $type;} ?></b></p>
      </div>
      <form id="from-to-form" align="center" onsubmit="return false;">
        <h3>Origin and Destination</h3>
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
        <h3>Volume and Weight</h3>
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
          <input type="checkbox"  value="batteries" name="content">Batteries</input>
          <input type="checkbox"  value="fragile-items" name="content">Fragile Items</input>
          <input type="checkbox"  value="documents" name="content">Documents</input>
          <input type="checkbox"  value="irreplacables" name="content">Irreplacables</input>
        </div>
        <button id="submit" v-on:click="containingEnter()">Enter</button>
      </form>
      <form id="value-form" align="center" style="display:none;" onsubmit="return false;">
        <h3>Value</h3>
        <input type="text" id="value-text" placeholder="Value">
        <select id="currency">
          <option>Euro</option>
          <option>Dollar</option>
          <option>CFA</option>
        </select>
        <input type="submit" v-on:click="valueEnter()">
      </form>
      <form id="shipping-form" align="center" style="display:none;" onsubmit="return false;">
        <h3>Shipping Options</h3>
        <input type="radio" value="standard" name="shipping-radio"><b>Standard</b>, 5 days shipping<br>
        <input type="radio" value="fast" name="shipping-radio"><b>Fast</b>, 3 days shipping<br>
        <input type="radio" value="Overnight" name="shipping-radio"><b>Overight</b>, Tomorrow!
        <div>
        <button id="price-button">Price</button>
        <button id="checkout-button" v-on:click="checkout()">Checkout</button>
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
              cities: <?php echo json_encode($infos)?>,
              navigationStack: [[],[]]
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
              $("<p id='from-to' align='center'>From: " + from + " To: " + to + "</p>").appendTo($("#invoice-div"));
              $("#volume-weight-form").show();
              vm.navigationStack[0].push($("#from-to-form"));
              vm.navigationStack[1].push($("#from-to"));
              vm.navigationStack[0].push($("#volume-weight-form"));
             
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
              $("<p id='volume-weight' align='center'>Volume: " + volume + " Weight: " + weight + "</p>").appendTo($("#invoice-div"));
              $("#containing-form").show();
              
              vm.navigationStack[0].push($("#containing-form"));
              vm.navigationStack[1].push($("#volume-weight"));
              
              },
              error: function( jqXhr, textStatus, errorThrown ){
              console.log( errorThrown );
              }
              })
            },
            containingEnter: function(){
              var selected = [];
              $.each($("input[name='content']:checked"), function(){            
                selected.push($(this).val());
              });
              $.ajax({
              type: 'post',
              dataType: 'text',
              url: 'send',
              data: selected,
              cache: false,
              success: function(data, textStatus, jQxhr){
              $("#containing-form").hide() ;
              $("<p id='containing' align='center'>Containing: "+selected+"</p>").appendTo($("#invoice-div"));
              $("#value-form").show();
              
              vm.navigationStack[0].push($("#value-form"));
              vm.navigationStack[1].push($("#containing"));
              
              },
              error: function( jqXhr, textStatus, errorThrown ){
              console.log( errorThrown );
              }
              })
            },
            valueEnter: function(){
              var value = $("#value-text").val();
              var currency = $("#currency option:selected").text();
              $.ajax({
              type: 'post',
              dataType: 'text',
              url: 'send',
              data: {'value':value,'currency':currency},
              cache: false,
              success: function(data, textStatus, jQxhr){
              $("#value-form").hide() ;
              $("<p id='value' align='center'>Valued at: " + value +" "+ currency + "</p>").appendTo($("#invoice-div"));
              $("#shipping-form").show();
              
              vm.navigationStack[0].push($("#shipping-form"));
              vm.navigationStack[1].push($("#value"));
              
              },
              error: function( jqXhr, textStatus, errorThrown ){
              console.log( errorThrown );
              }
              })
            },
            checkout: function(){
              var shipping = $("input[name='shipping-radio']:checked"). val();
              $.ajax({
              type: 'post',
              dataType: 'text',
              url: 'send',
              data: {'shipping':shipping},
              cache: false,
              success: function(data, textStatus, jQxhr){
              $("#shipping-form").hide() ;
              $("<p id='shipping' align='center'>shipping options: " + shipping +"</p>").appendTo($("#invoice-div"));
              vm.navigationStack[1].push($("#shipping"));
              },
              error: function( jqXhr, textStatus, errorThrown ){
              console.log( errorThrown );
              }
              })
            },
            goBack: function(){
              vm.navigationStack[0].pop().hide();
              vm.navigationStack[0][vm.navigationStack[0].length - 1].show();
              vm.navigationStack[1].pop().hide();
            }
          }
      })
    </script>
  </body>
</html>