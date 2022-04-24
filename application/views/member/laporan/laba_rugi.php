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
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/magnific-popup/magnific-popup.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/select2/select2.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/skins/default.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme-custom.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/pnotify/pnotify.custom.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/AdminLTE.min.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/_all-skins.min.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/_all-skins.css" />
<!-- 
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css"> -->
  <!--   <link rel="stylesheet" href="dist/css/skins/"> -->

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
      <h2>Laporan Penjualan</h2>
    </header>  
    <form method="GET" action="">
     <!-- start: page --> 

     <section class="panel"> 
      <div class="panel-body">  
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label class="control-label">Tanggal Awal</label>
              <input type="text" id="firstdate" value="<?php if($this->input->get('firstdate')!='') echo($this->input->get('firstdate')) ?>"  name="firstdate" class="form-control tanggal">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label class="control-label">Tanggal Akhir</label>
              <input type="text" id="lastdate" value="<?php if($this->input->get('lastdate')!='') echo($this->input->get('lastdate')) ?>" name="lastdate" class="form-control tanggal">
            </div>
          </div>
        </div>
      </div>
      <footer class="panel-footer">
        <button type="submit" class="btn btn-primary" id="TampilkanHTML">
          <i class="fa fa-search"></i> Tampilkan Data
        </button>
       <!--  <button type="submit"  class="btn btn-primary" id="ExportKeExcel">
          <i class="fa fa-file-excel-o"></i> Export Excel
        </button> -->
        <button type="reset" class="btn btn-danger" id="ResetBtn">
          <i class="fa fa-history"></i> Reset
        </button>
      </footer>
    </section>
    <section class="panel">
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-xl-4">
            <div class="row">
              <div class="col-md-12 col-xl-12">
                <section class="panel">
                  <header class="panel-heading">
                    <h2 class="panel-title">Laporan Laba Rugi</h2>
                  </header>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-4">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2" style=" ">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header bg-yellow" style="background-color: #f39c12; color: white;padding:  2px; border-radius: 5px; text-align: center;vertical-align: middle; font-size: 14px; ">
                            <div class="widget-user-image">
                              <!--   <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar"> -->
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username"><?php if($this->input->get('firstdate')!='') echo(tgl_indo($this->input->get('firstdate'))) ?> - <?php if($this->input->get('lastdate')!='') echo(tgl_indo($this->input->get('lastdate'))) ?></h3>
                          </div>
                          <div class="box-footer no-padding">
                            <!-- <ul class="nav nav-stacked">
                              <li><a href="#"  style="font-size: 13px; color:  black;">Total Penjualan <span class="pull-right badge bg-blue" style=" background-color: #0090d9;">31</span></a></li>
                              <li><a href="#"  style="font-size: 13px; color:  black;">Pembelian <span class="pull-right badge bg-aqua">5</span></a></li>
                              <li><a href="#"  style="font-size: 13px; color:  black;">Piutang <span class="pull-right badge bg-green">12</span></a></li>
                              <li><a href="#"  style="font-size: 13px; color:  black;">Operasional <span class="pull-right badge bg-red">842</span></a></li>

                            </ul> -->
                            <div class="table-responsive">
                              <table class="table">
                               <tbody>
                                <tr>
                                  <td>Total Penjualan</td>
                                  <td> <button class=" btn btn-primary " style="color:  white; float: right;border-radius: 15px; font-size: 12px;"><b> <label class="amount" id="total_penjualan1"></label></b></button></td>
                                </tr>
                                <tr>
                                  <td>Pembelian</td>
                                  <td> <button class=" btn btn-warning " style="color:  white;float: right; border-radius: 15px; font-size: 12px;"><b> <label class="amount" id="total_beli1"></b></button></td>
                                  </tr>
                                  <tr>
                                    <td>Piutang</td>
                                    <td> <button class=" btn btn-warning " style="color:  white;float: right; border-radius: 15px; font-size: 12px;"><b><label class="amount" id="total_piutang1"></b></button></td>
                                    </tr>
                                    <tr>
                                      <td>Operasional</td>
                                      <td> <button class=" btn btn-warning " style="color:  white;float: right; border-radius: 15px; font-size: 12px;"><b> <label class="amount" id="total_operasional1"></b></button></td>
                                      </tr>
                                      <tr>
                                       <!--  <td style=" font-size: 12px;color: black;" colspan="2"></td> -->
                                       <td colspan="2"> <button class=" btn btn-danger " style="color:  white; border-radius: 15px;float: right; font-size: 12px;"><b>Laba / Rugi :  <label class="amount" id="total1"></b></button></td>
                                       </tr>
                                     </tbody>
                                   </table>
                                 </div>
                               </div>
                             </div>
                             <!-- /.widget-user -->
                           </div>
                           <div class="col-md-3 col-xl-12">
                            <section class="panel">
                              <div id="panelppn" class="panel-body bg-primary">
                                <div class="widget-summary">
                                  <div class="widget-summary-col">
                                    <div class="summary">
                                      <h4 class="title">Total Penjualan</h4>
                                      <div class="info">
                                        <strong class="amount" id="total_penjualan"></strong>

                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </div>
                          <div class="col-md-3 col-xl-12">
                            <section class="panel">
                              <div id="panelppn" class="panel-body bg-primary">
                                <div class="widget-summary">
                                  <div class="widget-summary-col">
                                    <div class="summary">
                                      <h4 class="title">Total Harga Beli</h4>
                                      <div class="info">
                                        <strong class="amount" id="total_beli"></strong>

                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </div>
                          <div class="col-md-3 col-xl-12">
                            <section class="panel">
                              <div id="panelnonppn" class="panel-body bg-primary">
                                <div class="widget-summary">
                                  <div class="widget-summary-col">
                                    <div class="summary">
                                      <h4 class="title">Total Operasional</h4>
                                      <div class="info">
                                        <strong class="amount" id="total_operasional"></strong>


                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </div>
                          <div class="col-md-3 col-xl-12">
                            <section class="panel">
                              <div id="panelprekusor" class="panel-body bg-primary">
                                <div class="widget-summary">
                                  <div class="widget-summary-col">
                                    <div class="summary">
                                      <h4 class="title">Total Piutang</h4>
                                      <div class="info">
                                        <strong class="amount" id="total_piutang"></strong>


                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </div>
                          <div class="col-md-3 col-xl-12">
                            <section class="panel">
                              <div id="paneloot" class="panel-body bg-warning">
                                <div class="widget-summary">
                                  <div class="widget-summary-col">
                                    <div class="summary">
                                      <h4 class="title">Total Laba Rugi</h4>
                                      <div class="info">
                                        <strong class="amount" id="total"></strong>


                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                          </div>

                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </form>
      <section class="panel" style=""> 
        <div class="panel-body"> 
         <div class="row">
          <div class=" col-md-12">
           <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Penjualan</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                     <th>Tanggal</th>
                     <th>Barang</th>
                     <th>Total Harga</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php 
                   $total = 0;
                   $total_hargabeli=0;
                   ?>
                   <?php 
                   $total_hargabeli=0;
                   if ($data_penjualan!=null) {
                     foreach($data_penjualan as $post): ?> 
                      <tr>
                        <td><?php echo tgl_indo($post['tanggal']); ?></td>
                        <td><?php echo $post['nama_item']; ?></td>
                        <td class="text-right"><?php echo rupiah($post['total']); ?></td>
                      </tr> 
                      <?php 
                      $total += $post['total'];
                      $total_hargabeli += $post['harga_beli'];
                    endforeach;
                  }else{
                    echo "data kosong";
                  }
                  ?>  
                  <tr>
                    <td colspan="1"></td>
                    <td><b>Total</b></td>
                    <td class="text-right"><b> <?=rupiah($total)?></b></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->

          <!-- /.box-footer -->
        </div>

      </div>
    </div>





  </div>
  <br>
  <section class="panel"> 
    <div class="panel-body">  
      <div class="row">
        <div class="col-md-5">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Operasional</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Tgl Operasional</th>
                      <th>Keterangan</th>
                      <th>Jumlah</th>
                      <th>Editor</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $total_operasional = 0;
                    ?>
                    <?php 
                    $total_operasional=0;
                    if ($data_operasional!=null) {
                      foreach($data_operasional as $post): ?> 
                        <tr>
                          <td><?php echo tgl_indo($post['tgl_operasional']); ?></td>
                          <td><?php echo $post['keterangan']; ?></td>
                          <td class="text-right"><?php echo rupiah($post['jumlah']); ?></td>
                          <td><?php echo $post['editor']; ?></td> 
                        </tr> 
                        <?php 
                        $total_operasional += $post['jumlah'];
                      endforeach;
                    }else{
                echo "data kosng";
              }
                    ?>  
                    <tr>
                      <td colspan="2"></td>
                      <td><b>Total</b></td>
                      <td class="text-right"><b> <?=rupiah($total_operasional)?></b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
          </div>
        </div>
        <br>
        <div class="col-md-7">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Piutang</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Judul</th>
                      <th>Nomor Faktur</th>
                   <!--  <th>Tanggal</th>
                    <th>Nominal</th> -->
                    <th>Jatuh Tempo</th>
                    <!--    <th>Dibayar</th> -->
                    <th>sisa</th>
                    <th>status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $total_hutang = 0;
                  if ($data_hutang!=null) {
                    foreach ($data_hutang as $r) { 
                      $sisa =  $r['nominal'] - $r['nominal_dibayar'];
                      if($r['sudah_lunas'] == '1'){
                        $statuslunas ='<span class="btn btn-success btn-xs">Sudah</span>';
                      }else{
                        $statuslunas ='<span class="btn btn-danger btn-xs">Belum</span>';
                      }
                      ?>
                      <tr>
                        <td><?php echo $r['judul']; ?></td>
                        <td><?php echo $r['nomor_faktur']; ?></td>
                   <!--    <td><?php echo tgl_indo($r['tanggal']); ?></td>
                    <td><?php echo rupiah($r['nominal']); ?></td> -->
                    <td><?php echo tgl_indo($r['tanggal_jatuh_tempo']); ?></td>
                    <!--    <td><?php echo rupiah($r['nominal_dibayar']); ?></td> -->
                    <td><?php echo rupiah($sisa); ?></td>
                    <td><?php echo $statuslunas; ?></td>
                  </tr>
                  <?php 
                  $total_hutang+=$sisa;
                }
              }else{
                echo "data kosng";
              }
              ?>
              <tr>
                <td></td>
                <td></td>
                <td>Total</td>
                <td><?php echo rupiah($total_hutang); ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->

    <!-- /.box-footer -->
  </div>
</div>
</div>
</div>

</section>
</section>

<!-- end: page -->
</section>
</div>
</section>

<?php $laba_rugi=$total-($total_hutang+$total_operasional+$total_hargabeli); ?>


<!-- Vendor -->
<script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/adminlte.min.js"></script>
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
  $('.tanggal').datepicker({
    format: 'yyyy-mm-dd'
  });
  $('#total_penjualan').html('<?=rupiah($total)?>');
  $('#total_beli').html('<?=rupiah($total_hargabeli)?>');
  $('#total_operasional').html('<?=rupiah($total_operasional)?>');
  $('#total_piutang').html('<?=rupiah($total_hutang)?>');
  $('#total').html('<?=rupiah($laba_rugi)?>');
  $('#total_penjualan1').html('<?=rupiah($total)?>');
  $('#total_beli1').html('<?=rupiah($total_hargabeli)?>');
  $('#total_operasional1').html('<?=rupiah($total_operasional)?>');
  $('#total_piutang1').html('<?=rupiah($total_hutang)?>');
  $('#total1').html('<?=rupiah($laba_rugi)?>');
</script>
</body>
</html>