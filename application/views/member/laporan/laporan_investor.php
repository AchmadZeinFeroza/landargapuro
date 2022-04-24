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
      </form>
      <?php 
      $total = 0;
      $total_hargabeli=0;
      foreach($data_penjualan as $post): 

       $laba_rugi=($post['harga'] * $post['kuantiti'])- ($post['harga_beli'] *$post['kuantiti']);
       ?> 
       <?php 
       $total += $post['total'];
       $total_hargabeli += $post['harga_beli'];
       ?>
     <?php endforeach;?>  
     <?php 
     $total_hutang = 0;
     if(isset($data_hutang))
     {
      foreach ($data_hutang as $r) { 
        $sisa =  $r['nominal'] - $r['nominal_dibayar'];

        ?>
        <?php 
        $total_hutang+=$sisa;
      } 
    }?>

    <?php 
    $total_operasional = 0;
    if(isset($data_operasional))
    {
      foreach($data_operasional as $post): ?> 
        <?php 
        $total_operasional += $post['jumlah'];
        ?>
      <?php endforeach;
    }?>  
<?php $laba_rugi=$total-($total_hutang+$total_operasional+$total_hargabeli); ?>

    <section class="panel" style=""> 
      <div class="panel-body"> 
       <div class="row">
        <div class=" col-md-12">
         <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Laporan Data Investor</h3>
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
                   <th>nama investor</th>
                   <th>Alamat</th>
                   <th>Kota</th>
                   <th>Kontak </th>
                   <th>Tanggal Investasi</th>
                   <th>Tanggal Expired</th>
                   <th>Total Keuntungan</th>
                 </tr>
               </thead>
               <tbody>
                 <?php 
                 $total = 0;
                 $total_hargabeli=0;
                 foreach($data_investor as $post): 

                   ?> 
                   <tr>
                    <td><?php echo $post['nama_investor']; ?></td>
                    <td><?php echo $post['alamat']; ?></td>
                    <td><?php echo $post['kota']; ?></td>
                    <td><?php echo $post['kontak']; ?></td>
                    <td><?php echo tgl_indo($post['tgl_investasi']); ?></td>
                    <td><?php echo tgl_indo($post['tgl_expired']); ?></td>
                    <td><?php echo rupiah($laba_rugi*($post['besar_invest']/100)); ?></td>
                  </tr> 
                  
                <?php endforeach;?>  
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
</section>

<!-- end: page -->
</section>
</div>
</section>



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