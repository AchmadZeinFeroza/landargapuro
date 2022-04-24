<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html class="fixed sidebar-left-collapsed">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/favicon.png" type="image/ico">
  <title>PT Airlangga sentral internasional</title>
  <meta name="author" content="Paber">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/magnific-popup/magnific-popup.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/select2/select2.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/theme.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/skins/default.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/theme-custom.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/pnotify/pnotify.custom.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/AdminLTE.min.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/_all-skins.min.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/_all-skins.css" />
  <!-- 
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css"> -->
  <!--   <link rel="stylesheet" href="dist/css/skins/"> -->

  <!-- Head Libs -->
  <script src="<?php echo base_url() ?>/assets/vendor/modernizr/modernizr.js"></script>
</head>

<body class="bgbody">
  <section class="body">

    <?php $this->load->view("komponen/header.php") ?>
    <div class="inner-wrapper">
      <?php $this->load->view("komponen/sidebar.php") ?>
      <section role="main" class="content-body">
        <header class="page-header">
          <h2>Zakat</h2>
        </header>
        <form method="GET" action="">
          <!-- start: page -->
          <section class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-2">
                  <div class="form-group">
                    <label class="control-label">Tanggal Awal</label>
                    <input type="text" id="firstdate" value="<?php if ($this->input->get('firstdate') != '') echo ($this->input->get('firstdate')) ?>" name="firstdate" class="form-control tanggal">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group">
                    <label class="control-label">Tanggal Akhir</label>
                    <input type="text" id="lastdate" value="<?php if ($this->input->get('lastdate') != '') echo ($this->input->get('lastdate')) ?>" name="lastdate" class="form-control tanggal">
                  </div>
                </div>
                <div class="col-sm-4" style="margin-top: 2.2%;">
                  <button type="submit" class="btn btn-primary" id="TampilkanHTML">
                    <i class="fa fa-search"></i> Tampilkan Data
                  </button>
                  <!--  <button type="submit"  class="btn btn-primary" id="ExportKeExcel">
          <i class="fa fa-file-excel-o"></i> Export Excel
        </button> -->
                  <button type="reset" class="btn btn-danger" id="ResetBtn">
                    <i class="fa fa-history"></i> Reset
                  </button>
                </div>
              </div>
            </div>
          </section>
          <section class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-4">
                  <div class="row">
                    <div class="col-md-12 col-xl-12">
                      <section class="panel">
                        <header class="panel-heading">
                          <h2 class="panel-title">Laporan Zakat</h2>
                        </header>
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-4">
                              <!-- Widget: user widget style 1 -->
                              <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-yellow" style="background-color: #f39c12; color: white;padding:  2px; border-radius: 5px; text-align: center;vertical-align: middle; font-size: 14px; ">
                                  <div class="widget-user-image">
                                    <!--   <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar"> -->
                                  </div>
                                  <!-- /.widget-user-image -->
                                  <h3 class="widget-user-username"><?php if ($this->input->get('firstdate') != '') echo (tgl_indo($this->input->get('firstdate'))) ?> - <?php if ($this->input->get('lastdate') != '') echo (tgl_indo($this->input->get('lastdate'))) ?></h3>
                                </div>
                                <div class="box-footer no-padding">
                                  <!-- <ul class="nav nav-stacked">
                              <li><a href="#"  style="font-size: 13px; color:  black;">Total Penjualan <span class="pull-right badge bg-blue" style=" background-color: #0090d9;">31</span></a></li>
                              <li><a href="#"  style="font-size: 13px; color:  black;">Pembelian <span class="pull-right badge bg-aqua">5</span></a></li>
                              <li><a href="#"  style="font-size: 13px; color:  black;">Hutang <span class="pull-right badge bg-green">12</span></a></li>
                              <li><a href="#"  style="font-size: 13px; color:  black;">Operasional <span class="pull-right badge bg-red">842</span></a></li>

                            </ul> -->
                                  <div class="table-responsive">
                                    <table class="table">
                                      <tbody>
                                        <tr>
                                          <td>Aset Beli</td>
                                          <td> <button class=" btn btn-primary " style="color:  white;float: right; border-radius: 15px; font-size: 12px;"><b><label class="amount" id="aset_beli"></b></button></td>
                                        </tr>

                                        <tr>
                                          <td>Hutang</td>
                                          <td> <button class=" btn btn-warning " style="color:  white;float: right; border-radius: 15px; font-size: 12px;"><b><label class="amount" id="total_hutang1"></b></button></td>
                                        </tr>
                                        <tr>
                                          <td>Laba Bersih</td>
                                          <td> <button class=" btn btn-primary " style="color:  white;float: right; border-radius: 15px; font-size: 12px;"><b> <label class="amount" id="laba"></b></button></td>
                                        </tr>


                                        <tr>
                                          <!--  <td style=" font-size: 12px;color: black;" colspan="2"></td> -->
                                          <td colspan="2"> <button class=" btn btn-info " style="color:  white; border-radius: 15px;float: right; font-size: 12px;"><b>Zakat : <label class="amount" id="total1"></b></button></td>
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
                                        <h4 class="title">Total Aset Beli</h4>
                                        <div class="info">
                                          <strong class="amount" id="total_aset_beli"></strong>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </section>
                            </div>
                            <div class="col-md-3 col-xl-12">
                              <section class="panel">
                                <div id="panelprekusor" class="panel-body bg-warning">
                                  <div class="widget-summary">
                                    <div class="widget-summary-col">
                                      <div class="summary">
                                        <h4 class="title">Total Hutang</h4>
                                        <div class="info">
                                          <strong class="amount" id="total_hutang"></strong>


                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </section>
                            </div>

                            <div class="col-md-3 col-xl-12">
                            </div>
                            <div class="col-md-3 col-xl-12">
                              <section class="panel">
                                <div id="panelppn" class="panel-body bg-primary">
                                  <div class="widget-summary">
                                    <div class="widget-summary-col">
                                      <div class="summary">
                                        <h4 class="title">Total Laba</h4>
                                        <div class="info">
                                          <strong class="amount" id="total_laba"></strong>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </section>
                            </div>

                            <div class="col-md-6 col-xl-12">
                              <section class="panel">
                                <div id="paneloot" class="panel-body bg-info">
                                  <div class="widget-summary">
                                    <div class="widget-summary-col">
                                      <div class="summary">
                                        <h4 class="title">Total Zakat</h4>
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

        <?php
        $total = 0;
        $total_hargabeli = 0;
        foreach ($data_penjualan as $post) :

          $laba_rugi = ($post['harga'] * $post['kuantiti']) - ($post['harga_beli'] * $post['kuantiti']);

          $total += $post['total'];
          $total_hargabeli += $post['harga_beli'];
        endforeach; ?>

        <?php
        $total_piutang = 0;
        if (isset($data_piutang)) {
          foreach ($data_piutang as $r) {
            $sisa =  $r['nominal'] - $r['nominal_dibayar'];
            if ($r['sudah_lunas'] == '1') {
              $statuslunas = '<span class="btn btn-success btn-xs">Sudah</span>';
            } else {
              $statuslunas = '<span class="btn btn-danger btn-xs">Belum</span>';
            }
            $total_piutang += $sisa;
          }
        } ?>

        <?php
        $total_operasional = 0;
        if (isset($data_operasional)) {
          foreach ($data_operasional as $post) :
            $total_operasional += $post['jumlah'];
          endforeach;
        } ?>

        <?php
        $total_hutang = 0;
        if (isset($data_hutang)) {
          foreach ($data_hutang as $r) {
            $sisa =  $r['nominal'] - $r['nominal_dibayar'];
            if ($r['sudah_lunas'] == '1') {
              $statuslunas = '<span class="btn btn-success btn-xs">Sudah</span>';
            } else {
              $statuslunas = '<span class="btn btn-danger btn-xs">Belum</span>';
            }
            $total_hutang += $sisa;
          }
        } ?>


        <!-- end: page -->
      </section>
    </div>
  </section>

  <?php
  $laba_rugi = ($total + $total_piutang) - ($total_hargabeli + $total_operasional + $total_hutang);
  $zakat = (($data_aset->total - $total_hutang) + $laba_rugi) * 0.25;
  ?>


  <!-- Vendor -->
  <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/adminlte.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/select2/select2.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
  <script src="<?php echo base_url() ?>assets/javascripts/theme.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/pnotify/pnotify.custom.js"></script>
  <script src="<?php echo base_url() ?>assets/javascripts/theme.init.js"></script>
  <script type="text/javascript">
    $('.tanggal').datepicker({
      format: 'yyyy-mm-dd'
    });
    $('#total_penjualan').html('<?= rupiah($total) ?>');
    $('#total_beli').html('<?= rupiah($total_hargabeli) ?>');
    $('#total_operasional').html('<?= rupiah($total_operasional) ?>');
    $('#total_piutang').html('<?= rupiah($total_piutang) ?>');
    $('#total_penjualan1').html('<?= rupiah($total) ?>');
    $('#total_beli1').html('<?= rupiah($total_hargabeli) ?>');
    $('#total_operasional1').html('<?= rupiah($total_operasional) ?>');
    $('#total_hutang1').html('<?= rupiah($total_hutang) ?>');
    $('#laba').html('<?= rupiah($laba_rugi) ?>');
    $('#total1').html('<?= rupiah($zakat) ?>');
    $('#aset_beli').html('<?= rupiah($data_aset->total) ?>');

    $('#total_hutang').html('<?= rupiah($total_hutang) ?>');
    $('#total_laba').html('<?= rupiah($laba_rugi) ?>');
    $('#total').html('<?= rupiah($zakat) ?>');
    $('#total_aset_beli').html('<?= rupiah($data_aset->total) ?>');
    console.log($data_aset);
  </script>
</body>

</html>