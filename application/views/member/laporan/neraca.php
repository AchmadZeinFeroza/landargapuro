<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>  
  <meta charset="UTF-8"> 
  <link rel="shortcut icon" href="<?php echo base_url()?>/assets/images/favicon.png" type="image/ico">   
  <title>PT Airlangga sentral internasional</title>    
  <meta name="author" content="Paber">  
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/magnific-popup/magnific-popup.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/select2/select2.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/skins/default.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme-custom.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/pnotify/pnotify.custom.css" />

  <!-- Head Libs -->
  <script src="<?php echo base_url()?>/assets/vendor/modernizr/modernizr.js"></script>
</head>
<body class="bgbody">
  <section class="body">

   <?php $this->load->view("komponen/header.php") ?>
   <div class="inner-wrapper"> 
    <?php $this->load->view("komponen/sidebar.php") ?>
    <section role="main" class="content-body">
     <header class="page-header">  
      <h2>Laporan Log Aktifitas</h2>
    </header>  
    <form id="Formulir" method="GET" action="<?php echo base_url();?>laporan/excel_log/" target="_blank">
     <!-- start: page --> 
     <section class="panel"> 
      <div class="panel-body">  
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Tanggal Awal</label>
              <input type="text" id="firstdate"  name="firstdate" class="form-control tanggal">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label class="control-label">Tanggal Akhir</label>
              <input type="text" id="lastdate" name="lastdate" class="form-control tanggal">
            </div>
          </div>

        </div>
      </div>
      <footer class="panel-footer">
        <span onclick="searchFilter()" class="btn btn-primary" id="TampilkanHTML">
          <i class="fa fa-search"></i> Tampilkan HTML
        </span>
                            <!--<button type="submit"  class="btn btn-primary" id="ExportKeExcel">
                                <i class="fa fa-file-excel-o"></i> Export Excel
                              </button>-->
                              <button type="reset" class="btn btn-danger" id="ResetBtn">
                                <i class="fa fa-history"></i> Reset
                              </button>
                            </footer>
                          </section>
                        </form>

                        <section class="panel"> 
                          <div class="panel-body">  
                            <?php echo "<pre>";
                            print_r ($laporan);
                            echo "</pre>"; ?>
                            <div class="row">
                              <table style="color: black;" class=" table table-bordered table-responsive table-hover">
                                <tr>
                                  <td colspan="2"><b>AKTIVA</b></td>
                                  <td colspan="2"><b>PASSIVA</b></td>
                                </tr>
                                <tr style="background-color: #ededed;color: black;">
                                  <td colspan="2">AKTIVA LANCAR</td>
                                  <td colspan="2">KEWAJIBAN</td>
                                </tr>
                                <!-- INI LOOPING -->
                                <tr align="right">
                                  <td>KAS</td>
                                  <td>Rp. 3.000.000</td>
                                  <td>UTANG LANCAR</td>
                                  <td>Rp.350.000</td>
                                </tr>
                                <tr align="right">
                                  <td>PERLENGKAPAN</td>
                                  <td>Rp. 3.000.000</td>
                                  <td>UTANG USAHA</td>
                                  <td>Rp.350.000</td>
                                </tr>
                                <!-- SAMPAI INI -->
                                <tr>
                                  <td colspan=""><b>JUMLAH AKTIVA</b></td>
                                  <TD></TD>
                                  <td colspan=""><b>JUMLAH UTANG LANCAR</b></td>
                                  <td></td>
                                </tr>
                                     <tr style="background-color: #ededed;color: black;">
                                  <td colspan="2">AKTIVA TETAP</td>
                                  <td colspan="">UTANG JANGKA PANJANG</td>
                                  <td></td>
                                </tr>
                                         <!-- INI LOOPING -->
                                <tr align="right">
                                  <td>TANAH</td>
                                  <td>Rp. 3.000.000</td>
                                  <td>JUMLAH KEWAJIBAN</td>
                                  <td>Rp.350.000</td>
                                </tr>
                                <tr align="right">
                                  <td>BANGUNAN</td>
                                  <td></td>
                                  <td>MODAL PEMILIK</td>
                                  <td>Rp. 2.000.000</td>
                                </tr>
                                <!-- SAMPAI INI -->
                                        <tr>
                                  <td colspan="">JUMLAH AKTIVA TETAP</td>
                                  <TD></TD>
                                  <td colspan="">MODAL PEMILIK</td>
                                  <td></td>
                                </tr>
                                <TFOOT>
                                  <tr style="background-color: #028cd6; color: white;">
                                    <td>JUMLAH AKTIVA</td>
                                    <td align="right">Rp.3.350.000</td>
                                        <td>JUMLAH UTANG DAN MODAL</td>
                                    <td align="right">Rp.3.350.000</td>
                                  </tr>.
                                </TFOOT>
                              </table>

                            </div>
                          </div>

                        </section>
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
                  <script src="<?php echo base_url()?>assets/vendor/select2/select2.js"></script>
                  <script src="<?php echo base_url()?>assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
                  <script src="<?php echo base_url()?>assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
                  <script src="<?php echo base_url()?>assets/javascripts/theme.js"></script>
                  <script src="<?php echo base_url()?>assets/vendor/pnotify/pnotify.custom.js"></script>
                  <script src="<?php echo base_url()?>assets/javascripts/theme.init.js"></script> 
                  <script type="text/javascript">
                    $('.tanggal').datepicker({
                      format: 'yyyy-mm-dd' 
                    }); 
                  </script>
                </body>
                </html>