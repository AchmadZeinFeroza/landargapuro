<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>  
  <meta charset="UTF-8"> 
  <link rel="shortcut icon" href="<?php echo base_url()?>/assets/images/fav.png" type="image/ico">   
  <title>PT Argopuro</title>    
  <meta name="author" content="Paber">   
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/bootstrap/css/bootstrap.css" />
  <?php $this->load->view('komponen/css'); ?>
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/magnific-popup/magnific-popup.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/select2/select2.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/stylesheets/theme.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/stylesheets/skins/default.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/stylesheets/theme-custom.css">
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/stylesheets/admin.min.css">
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
      <h2>Laporan 2</h2>
  </header>  
  <!-- start: page -->
  <div class="row">
      <section class="panel col-md-12">
        <header class="panel-heading">    
            <div class="row show-grid">
                <div class="col-md-8" align="left"><h2 class="panel-title"></h2></div> 
            </div>
            <form action="<?php echo site_url('Export_excel/laporan_land_bank_rekap/') ?>" method="get">

                <div class="row" style="width: 100%; padding: 4px;margin-left: 0%;">
                    <label class="col-sm-1 control-label">Lokasi<span class="required">*</span></label>

                    <div class="col-sm-4">
                        <div class="form-group nama_target">
                            <select data-plugin-selectTwo class="form-control" onchange="refresh()" id="id_perumahan"
                                name="id_perumahan">
                                <?php if(isset($nama_regional)):?>
                                        <option value="<?php echo $id; ?>"><?php echo $nama_regional; ?> ( <?= $status ?> ) </option>
                                    <?php endif; ?>
                                <option value="">Semua Lokasi</option>
                                <?php foreach ($perumahan as $aa): ?>
                                    <option value="<?php echo $aa->id; ?>"><?php echo $aa->nama_regional; ?> ( <?= $aa->nama_status?> )</option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary" type="submit"   >
                        <i class="fa fa-print"></i>cetak </button>
                    </div>
                </div>

            </form>
        </header>
        <div class="panel-body"> 
            <div class="table" style="overflow-x: auto;white-space: nowrap;">
                <table class="table table-bordered table-hover table-striped data" id="itemsdata">
                    <thead>
                        <tr>
                            <th colspan="2"></th>
                            <th colspan="3" style="text-align: center;vertical-align: middle; ">LAND BANK s/d <?= (date('Y')-1)?></th>
                            <th colspan="3" style="text-align: center;vertical-align: middle;">LAND BANK s/d <?= (date('Y'))?> </th>
                            <th colspan="3" style="text-align: center;vertical-align: middle;">TOTAL LAND BANK</th>
                            <th colspan="3" style="text-align: center;vertical-align: middle;">SERAH TERIMA TECHNIC</th>
                            <th colspan="3" style="text-align: center;vertical-align: middle;">SISA LAND BANK</th>
                            <th colspan="3" style="text-align: center;vertical-align: middle; background-color: green; color: white;">PROSES PERALIHAN BANK</th>
                            <th colspan="2" style="text-align: center;vertical-align: middle;background-color: green; color: white;">S TERIMA FINANCE </th>
                        </tr>
                        <tr>
                            <th rowspan="3">No</th>
                            <th rowspan="3">Lokasi</th>
                            <th  rowspan="2" style="text-align: center;vertical-align: middle;">BID</th>
                            <th colspan="2" style="text-align: center;vertical-align: middle;">LUAS m<sup>2</sup></th>
                            <th  rowspan="2" style="text-align: center;vertical-align: middle;">BID</th>
                            <th colspan="2" style="text-align: center;vertical-align: middle;">LUAS m<sup>2</sup></th>
                            <th  rowspan="2" style="text-align: center;vertical-align: middle;">BID</th>
                            <th colspan="2" style="text-align: center;vertical-align: middle;">LUAS m<sup>2</sup></th>
                            <th  rowspan="2" style="text-align: center;vertical-align: middle;">BID</th>
                            <th colspan="2" style="text-align: center;vertical-align: middle;">LUAS m<sup>2</sup></th>                        
                            <th  rowspan="2" style="text-align: center;vertical-align: middle;">BID</th>
                            <th colspan="2" style="text-align: center;vertical-align: middle;">LUAS m<sup>2</sup></th>
                            <th rowspan="2" style="text-align: center;vertical-align: middle;">ORDER </th>
                            <th rowspan="2" style="text-align: center;vertical-align: middle;">TERBIT </th>
                            <th rowspan="2" style="text-align: center;vertical-align: middle;">TOTAL </th>
                            <th rowspan="2" style="text-align: center;vertical-align: middle;">SUDAH </th>
                            <th rowspan="2" style="text-align: center;vertical-align: middle;">BELUM </th>
                        </tr>
                        <tr>
                            <th   style="text-align: center;vertical-align: middle;">SURAT</th>
                            <th   style="text-align: center;vertical-align: middle;">UKUR</th>
                            <th   style="text-align: center;vertical-align: middle;">SURAT</th>
                            <th   style="text-align: center;vertical-align: middle;">UKUR</th>
                            <th   style="text-align: center;vertical-align: middle;">SURAT</th>
                            <th   style="text-align: center;vertical-align: middle;">UKUR</th>
                            <th   style="text-align: center;vertical-align: middle;">SURAT</th>
                            <th   style="text-align: center;vertical-align: middle;">UKUR</th>
                            <th   style="text-align: center;vertical-align: middle;">SURAT</th>
                            <th   style="text-align: center;vertical-align: middle;">UKUR</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($list['rumah'])):?>
                        <tr>
                            <td colspan="20">IP Proyek - DALAM IJIN</td>
                        </tr>
                        <?php for ($i=0; $i <sizeof($list['dalamijin']); $i++) { 
                          ?>
                          <tr>
                            <?php for ($j=0; $j <sizeof($list['dalamijin'][$i]) ; $j++) { 
                              ?>  
                              <td><?php echo $list['dalamijin'][$i][$j] ?></td>
                              <?php
                          } ?>
                      </tr>
                      <?php
                  } ?>
                   <tr>
                            <td colspan="20">IP Proyek - Luar IJIN</td>
                        </tr>
                        <?php for ($i=0; $i <sizeof($list['luarijin']); $i++) { 
                          ?>
                          <tr>
                            <?php for ($j=0; $j <sizeof($list['luarijin'][$i]) ; $j++) { 
                              ?>  
                              <td><?php echo $list['luarijin'][$i][$j] ?></td>
                              <?php
                          } ?>
                      </tr>
                      <?php
                  } ?>
                   <tr>
                            <td colspan="20">IP Proyek - Lokasi</td>
                        </tr>
                        <?php for ($i=0; $i <sizeof($list['lokasi']); $i++) { 
                          ?>
                          <tr>
                            <?php for ($j=0; $j <sizeof($list['lokasi'][$i]) ; $j++) { 
                              ?>  
                              <td><?php echo $list['lokasi'][$i][$j] ?></td>
                              <?php
                          } ?>
                      </tr>
                      <?php
                  } ?>
                  <?php else : ?>
                    <tr>
                            <td colspan="20"><?= $list['status']?></td>
                        </tr>
                        <?php for ($i=0; $i <sizeof($list['rumah']); $i++) { 
                          ?>
                          <tr>
                            <?php for ($j=0; $j <sizeof($list['rumah'][$i]) ; $j++) { 
                              ?>  
                              <td><?php echo $list['rumah'][$i][$j] ?></td>
                              <?php
                          } ?>
                      </tr>
                      <?php
                  } ?>
                <?php endif;?>
              </tbody>
          </table> 
      </div>
  </div>
</section>

</div>

<!-- end: page -->
</section>
</div>
</section>

</div>  

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
<script src="<?php echo base_url()?>assets/javascripts/admin.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/theme.init.js"></script> 
<script type="text/javascript">
  var tableitems = $('#itemsdata').DataTable({  
    "serverSide": false, 
    "order": []
});
function refresh(){
        var cek = '<?= site_url('laporan/laporan_evaluasi_land_bank/')?>';
        location.replace( cek += "?id="+ $('#id_perumahan').val()+"");
    } 
</script>
</body>
</html>