
<!DOCTYPE html>
<html lang="en">


<!-- HEAD PART ============================================================================================================ -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <link rel="icon" href="<?php echo base_url();?>assets/logo/icon1.png">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/import/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/import/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/import/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>assets/import/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/import/build/css/custom.min.css" rel="stylesheet">

    <!-- Custom Button Css -->
    <link href="<?php echo base_url();?>assets/import/all_my_own_css/button.css" rel="stylesheet">
      <link href="<?php echo base_url();?>assets/style.css" rel="stylesheet">
       <!-- <link href="<?php echo base_url();?>assets/bootstrap.css" rel="stylesheet"> -->

    <style type="text/css">
       #saved{
              display:none;
              position:fixed;
              z-index: 99; 
              top: 10px; 
              right: 10px;
              padding-right: 20px; 
              padding-left: 0px; 
              padding-top: 5px;
              padding-bottom: 5px
      }
      .body_wrapper{
            position:fixed;background-image:url(<?php echo base_url();?>assets/logo/pic2.png);
            background-repeat:no-repeat;
            background-size: cover;   
            width: 100%;
            height: 100%;
      }
      
      .animated h1{
        color: #fffdfd;
        line-height: 0;
        font-family:Sans-serif;
        font-weight: bold;
      }
      .animated h2{
        color: #fffdfd;
        line-height: 0;
        font-family:serif;
      }
      .btn{
        color: #7FFF00;
      }
      .login_content {
        border: 5px ridge #252725;
        opacity: 0.8;
        background-color: #050707;
        text-align: center;
        }
        .hr-lines{
        position: relative;
        max-width: 500px;
        text-align: center;

        }

        .hr-lines:before{
        content:" ";
        height: 2px;
        width: 121px;
        background: #fffdfd;
        display: block;
        top: 10%;
        left: 0;
        }

        .hr-lines:after{
        content:" ";
        height: 2px;
        width: 150px;
        background: #fffdfd;
        display: block;
        position: absolute;
        right: 0;
        }


      
    </style>
    
  </head>
<!-- END HEAD PART ============================================================================================================ -->


<!-- BODY PART =========================================================================================================== --> 
  <body>

      <!-- lOGIN FORM -->
        <div class="body_wrapper"><br><br><br><br>

            <div class="animated bounce">
             
                <center><h1 style="font-size: 30px; font-family:Times New Roman; text-shadow: 2px 2px black" >LAND HOLDING MANAGEMENT </h1></center><br>
                <center><h2 class="hr-lines" style="font-size: 20px;font-family: Georgia;  letter-spacing: 25px; text-shadow: 2px 2px black">  SYSTEM</h2></center>
              </div>

              <div class="login_wrapper">
              

              <div class="alert  alert-dismissible fade in animated slideInRight" role="alert"  id="saved">
                    <button type="button" class="close" id="clearMsg"><span aria-hidden="true">&times;</span></button>
                    <strong>&nbsp;<b><i id="success_icon"></i></b></strong> <span style="display: inline-block;" id="notif"></span>
              </div>
          
                <section class="login_content">
                 <!--  <img src="<?php echo base_url();?>assets/logo/leaf1.png" width="15%"> </img>
                  LHMS Login -->
                <?php $attributes = array('id' => 'systemLog'); echo form_open('#',$attributes); ?>
                        <div class="middle-box loginscreen" style="padding: 22px;">

                               <div class="form-group has-feedback" style="border-left: 8px solid #50C878; !important;">
                                      <input id="username" type="text" class="form-control form-control-login" style="border-radius: 0px;" name="username" value="" placeholder="Username" required autofocus>
                                      <span class="glyphicon glyphicon-user form-control-feedback"></span>
                               </div>
                               <div class="form-group has-feedback" style="border-left: 8px solid #50C878; !important;">
                                      <input id="password" type="password" class="form-control form-control-login" style="border-radius: 0px;" name="password" placeholder="Password" required >
                                      <span id="change" class="glyphicon glyphicon-eye-close form-control-feedback" type="button"></span>
                               </div>
                                <div class="pull-right col-md-6 col-md-offset-2" style="text-align:right;margin-top: -21px;margin-right: -24px;">
                                    <a href="#" id="icon"><c id="hp" style="display:none;">Hide Password</c>
                                    <d id="sp">Show Password</d></a>
                                </div>
                              <div> 
                                  <button type="submit" class="btn btn-custom-primary" id="logText"></button>
                              </div>
                        </div>
                </form>

             
                </section>

                </div>
        </div>
        <!--END lOGIN FORM -->


  </body>
<!-- END BODY PART =========================================================================================================================================================================================================== --> 


<!-- JQUERIES =========================================================================================================================================================================================================== --> 
<script src="<?php echo base_url();?>assets/import/vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
        //SHOW/HIDE PASSWORD 
         document.addEventListener("DOMContentLoaded", function(event) { 
                $("#icon").click(function(){
                  var p = $("#password").attr("type"); 
                    if(p == "text"){
                      $("#password").attr("type","password");
                      $("#change").attr("class", "glyphicon glyphicon-eye-close form-control-feedback");
                       document.getElementById('sp').style.display = '';
                      $("#hp").hide(); 
                    }
                    else
                    {
                      $("#password").attr("type","text");
                      $("#change").attr("class", "glyphicon glyphicon-eye-open form-control-feedback");
                      document.getElementById('hp').style.display = '';
                      document.getElementById('sp').style.display = 'none';
                      $("#sp").hide(); 
                    }
                });
         });
        //END SHOW/HIDE PASSWORD 
</script>

<script type="text/javascript">

  $(document).ready(function(){
    $('#logText').html('<i class="fa fa-sign-in"></i> Login');            
    $('#systemLog').submit(function(e){
              // $("#logText").attr("disabled", true);
              e.preventDefault();
              $('#logText').get(0).type = 'button';
              $('#logText').html('<i class="fa fa-key"></i> Checking Credentials...');
              var url = '<?php echo base_url(); ?>';
              var act_r = 0;
              //var user = $('#systemLog').serialize();

              var login = function(){
                  $.ajax({
                  type: 'POST',
                  url: url + 'auth/validate_credentials/',
                  dataType: 'json',
                  data: { username: $('#username').val(), password: $('#password').val() }, 
                  success:function(response){
                      $('#systemLog')[0].reset();
                    if(response.error){

                      $('#logText').get(0).type = 'submit';
                      $('#logText').html('<i class="fa fa-sign-in"></i> Login');
                      $('#success_icon').html('');
                      $('#notif').html(response.error);
                      $('#saved').removeClass('alert-success').addClass('alert-danger').show();

                    }
                    else{
                      $('#notif').html(response.notif);
                      $('#logText').html('Logging in...');
                      $('#success_icon').html('<i class="fa fa-unlock"></i>');
                      $('#saved').removeClass('alert-danger').addClass('alert-success').show();
                      setTimeout(function(){
                        location.reload();
                      }, 1500);
                    }

                  }

                });
              };
              setTimeout(login, 1500); //set time out to controller welcome/login for showing http response
              
              $('#saved').fadeOut(3000); //set interval for notification to be shown
        
    });

    $(document).on('click', '#clearMsg', function(){
      $('#saved').hide();
    });
  });
</script>

<!-- END JQUERIES =========================================================================================================================================================================================================== --> 

</html>
