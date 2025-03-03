<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Site Under Maintenance</title>
    <link href="http://localhost/landholding/assets/import/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg">
    <h1 class="head text-center">Site Under Maintenance</h1>
    <div class="container">
        <div class="content1"> 
            <center>
                <img src="http://localhost/landholding/assets/logo/UNDER-CONSTRUCTION.JPG" alt="under-construction" width="300px" height="150px">
            </center><br>
            <p class="text-center">Sorry for the inconvenience. To improve our services, we have momentarily shutdown our site.</p>
        </div>
            <p class="text-center">Try again after <b id="demo" style="color: red;"></b></p>
    </div>

            <script>
                    // Set the date we're counting down to
                    var countDownDate = new Date("Aug 31, 2019 1:40:00").getTime();

                    // Update the count down every 1 second
                    var x = setInterval(function() {

                      // Get today's date and time
                      var now = new Date().getTime();
                        
                      // Find the distance between now and the count down date
                      var distance = countDownDate - now;
                        
                      // Time calculations for days, hours, minutes and seconds
                      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        
                      // Output the result in an element with id="demo"
                      document.getElementById("demo").innerHTML =  hours + "h "
                      + minutes + "m " + seconds + "s ";
                        
                      // If the count down is over, write some text 
                      if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                      }
                    }, 1000);
            </script>

</body>
</html>