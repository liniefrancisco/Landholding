<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php if(isset($title)){ echo $title; }else{ echo "Land Holding Management System"; } ?></title>

    <link rel="icon" href="<?php echo base_url();?>assets/logo/icon1.png">

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/import/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/import/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/import/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets/import/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url();?>assets/import/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url();?>assets/import/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>assets/import/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap date-timepicker -->
    <link href="<?php echo base_url();?>assets/import/all_my_own_css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <!-- Dropzone.js -->
    <link href="<?php echo base_url();?>assets/import/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/vendors/dropify/css/dropify.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/vendors/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/import/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>node_modules/flatpickr/dist/flatpickr.min.css">
    <!-- Animate -->
    <link href="<?php echo base_url();?>assets/import/vendors/animate.css/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/import/build/css/bootstrap-datetimepicker.min.css">
      <!-- Datatables -->
    <link href="<?php echo base_url();?>assets/import/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/vendors/photoviewer/dist/photoviewer.min.css" rel="stylesheet">
    <!-- Custom Button Css -->
    <link href="<?php echo base_url();?>assets/import/all_my_own_css/button.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/my-custom-style.css" rel="stylesheet">
    <!-- BootstrapDialogue -->
    <link href="<?php echo base_url();?>assets/import/src/scss/bootstrap-dialog.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/assets/bootstrap-dialog/css/bootstrap-dialog.min.css" rel="stylesheet">
     <!-- <link href="<?php echo base_url();?>assets/import/css/bootstrap-theme.min.css" rel="stylesheet"> -->
     <link href="<?php echo base_url();?>assets/style.css" rel="stylesheet">
    <!-- /BootstrapDialogue -->

     <!-- PNotify -->
    <link href="<?php echo base_url();?>assets/import/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- qtip -->
    <link href="<?php echo base_url();?>assets/import/qtip/jquery.qtip.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/qtip/jquery.qtip.min.css" rel="stylesheet">
    <!-- jquery ui -->
    <link href="<?php echo base_url();?>assets/import/vendors/jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/import/vendors/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>assets/import/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/import/vendors/photoviewer/dist/photoviewer.min.js"></script>
    <script src="<?php echo base_url();?>assets/import/vendors/sweetalert2/sweetalert2.min.js"></script>
<!-- STYLE FOR LOADING2 ======================================================================================================================================================================================================================================================================================================== -->
    <style type="text/css">
    .a-right {
        text-align: right;
      }
      @page {
        size: landscape;        
        margin: 3%;
      }
      @media print {
        body {transform: scale(1);}
        table {page-break-inside: avoid;}
      }
      #loading, .tile-link, .tile-link .tile-link-overlay {
        top:0px;
        right:0px;
        width:100%;
        height:100%;
      }
      #loading {
        position: fixed;        
        background-color:#666;
        background-repeat:no-repeat;
        background-position:center;
        z-index:10000000;
        opacity: 0.75;
        filter: alpha(opacity=50); /* For IE8 and earlier */
      }
      .tile-link {
        position: absolute;             
        display: none;  
        z-index:100;     
      }   
      .tile-link .tile-link-overlay {
        position: absolute;             
        background-color:#666;
        opacity: 0.5;
        filter: alpha(opacity=50); /* For IE8 and earlier */
        z-index:10;
      }
      .tile-link .tile-link-content {       
        position:relative;
        width: 50%;
        margin: 0 auto;  
        top: 50%;
        transform: translateY(-50%);  
        z-index:1000;      
      }
      .dashboard-tile:hover .tile-link {
        display:block;
      }
      .v-middle {
        vertical-align: middle;   
      }


      .modal-content {
            border-radius:0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;
            webkit-box-shadow: none;
            box-shadow:none;
        }
        .bootstrap-dialog .modal-header {
            border-top-left-radius: 0px;!important;
            border-top-right-radius: 0px;!important;
        }
       /* .btn {
            border-radius: 0px;
            -webkit-border-radius: 0px;
            -moz-border-radius: 0px;

        }*/
        .modal-footer {
            padding: 6px;

        }

        .modal.fade .modal-dialog 
        {
          -webkit-transform: translate(0);
          -moz-transform: translate(0);
          transform: translate(0);
         }


    </style> 
<!-- END STYLE FOR LOADING2 ======================================================================================================================================================================================================================================================================================================== -->

  </head>