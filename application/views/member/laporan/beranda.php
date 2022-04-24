<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>  
  <meta charset="UTF-8"> 
  <link rel="shortcut icon" href="<?php echo base_url()?>/assets/images/fav.png" type="image/ico">   
  <title>PT Argopuro</title>    
  <meta name="author" content="Paber"> 
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/magnific-popup/magnific-popup.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme.css" /> 
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/skins/default.css" /> 
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme-custom.css"> 
  <!-- Specific Page Vendor CSS -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/morris/morris.css" />
  <script src="<?php echo base_url()?>assets/vendor/modernizr/modernizr.js"></script>  
</head>
<body class="bgbody">
  <section class="body">

     <!-- start: header -->
     <?php $this->load->view("komponen/header.php") ?>
     <!-- end: header -->

     <div class="inner-wrapper">
        <!-- start: sidebar -->
        <?php $this->load->view("komponen/sidebar.php") ?>
        <!-- end: sidebar -->

        <section role="main" class="content-body">
           <header class="page-header">  
              <h2>Laporan</h2>  
          </header>  


          <div class="inner-body mg-main" style="margin-left: 0px;">  
            <div class="row">
                <div class="col-md-12"> 
                    <section class="panel">
                
                        <div class="panel-body">
                            <div class="form-group col-md-10">
                                <select class="form-control select2">
                                    <option>MENU 1</option>
                                    <option>MENU 2</option>
                                </select>
                            </div>
                            <div class="col-md-2"> <input type="submit" class="btn btn-block btn-primary" value="SUBMIT"> </div>
                        </div>
                    </section>
                </div> 
            </div>
            <div class="row">
                 <div class="col-md-6"> 
                    <section class="panel">
                
                        <button class="panel-body btn btn-primary btn-lg">
                             
                           <div class=" col-md-8 " ><b style="font-size: 30px;float: left;line-height: 30px;"><br>Rekap Proses Ijin Lokasi</b></div>
                           <div class=" col-md-4">
                               <img src="<?php echo base_url()?>assets/icon/1-02.png" style="width: 50%;height: 50%;float: right;" class="">
                             </div>
                        </button>
                    </section>
                </div> 
                  <div class="col-md-6"> 
                    <section class="panel">
                
                        <button class="panel-body btn btn-warning btn-lg">
                             
                           <div class=" col-md-8 " ><b style="font-size: 30px;float: left;line-height: 30px;"><br>Rincian Ijin Lokasi</b></div>
                           <div class=" col-md-4">
                               <img src="<?php echo base_url()?>assets/icon/1-02.png" style="width: 50%;height: 50%;float: right;" class="">
                             </div>
                        </button>
                    </section>
                </div> 
            </div>

          </div>
      </section>
  </div>

</section>


<!-- Vendor -->
<script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>  
<script src="<?php echo base_url()?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url()?>assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="<?php echo base_url()?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/theme.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/admin.min.js"></script> 
<script src="<?php echo base_url()?>assets/javascripts/theme.init.js"></script>   
<script src="<?php echo base_url()?>assets/vendor/raphael/raphael.js"></script>
<script src="<?php echo base_url()?>assets/vendor/morris/morris.js"></script>
<script> 




</script>

</body>
</html>