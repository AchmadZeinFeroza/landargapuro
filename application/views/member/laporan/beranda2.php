<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/fav.png" type="image/ico">
  <title>PT Argopuro</title>
  <meta name="author" content="Paber">
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/magnific-popup/magnific-popup.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/theme.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/skins/default.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/theme-custom.css">
  <!-- Specific Page Vendor CSS -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/morris/morris.css" />
  <script src="<?php echo base_url() ?>assets/vendor/modernizr/modernizr.js"></script>
</head>
<body class="bgbody">
  <section class="body">

   <!-- start: header -->
   <?php $this->load->view("komponen/header.php")?>
   <!-- end: header -->

   <div class="inner-wrapper">
    <!-- start: sidebar -->
    <?php $this->load->view("komponen/sidebar.php")?>
    <!-- end: sidebar -->

    <section role="main" class="content-body">
     <header class="page-header">
      <h2>Laporan</h2>
  </header>


        <div class="inner-body mg-main" style="margin-left: 0px;">
            <div class="row" style="margin-top:-25px;">
                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                            <p style="font-size: 13px; color: black;"><b>MASTER PERUMAHAN</b></p>
                        </header>
                        <div class="panel-body">
                            <a href="<?php echo base_url() ?>master/perumahan" class="btn btn-primary"><i class="fa fa-folder"></i> Master Perumahan</a>
                        </div>
                    </section>
                </div>

                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                            <p style="font-size: 13px; color: black;"><b>MASTER TANAH</b></p>
                        </header>
                        <div class="panel-body">
                            <a href="<?php echo base_url() ?>master/items" class="btn btn-primary"><i class="fa fa-folder"></i> Master Tanah</a>
                        </div>
                    </section>
                </div>

                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                            <p style="font-size: 13px; color: black;"><b>MANAJEMEN EXCEL</b></p>
                        </header>
                        <div class="panel-body">
                            <a href="<?php echo base_url() ?>master/excel" class="btn btn-primary"><i class="fa fa-folder"></i> Master EXCEL</a>
                        </div>
                    </section>
                </div>
                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                            <p style="font-size: 13px; color: black;"><b>MASTER SURAT</b></p>
                        </header>
                        <div class="panel-body">
                            <a href="<?php echo base_url() ?>master/sertifikat_tanah" class="btn btn-primary"><i class="fa fa-folder"></i> Master Surat</a>
                        </div>
                    </section>
                </div>

                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                            <p style="font-size: 13px; color: black;"><b>MASTER JENIS PENGALIHAN</b></p>
                        </header>
                        <div class="panel-body">
                            <a href="<?php echo base_url() ?>master/jenis_pengalihan" class="btn btn-primary"><i class="fa fa-folder"></i> Master Jenis Pengalihan</a>
                        </div>
                    </section>
                </div>

                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                            <p style="font-size: 13px; color: black;"><b>1. EVALUASI PROSES DAN IJIN LOKASI TANAH</b></p>
                        </header>
                        <div class="panel-body">
                            <a href="<?php echo base_url() ?>laporan/rekap_proses_ijin_lokasi" class="btn btn-primary"><i class="fa fa-folder"></i> Detail Proses Ijin Lokasi </a>
                            <a href="<?php echo base_url() ?>laporan/list_ijin" class="btn btn-primary"><i class="fa fa-folder"></i> Rincian Ijin Lokasi</a>
                        </div>
                    </section>
                </div>

                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                            <p style="font-size: 13px; color: black;"><b>2. EVALUASI PEMBELIAN TANAH</b></p>
                        </header>
                        <div class="panel-body">
                            <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_pembelian_detail" class="btn btn-primary"><i class="fa fa-folder"></i> Detail Evaluasi Pembelian</a>
                            <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_pembelian" class="btn btn-primary"><i class="fa fa-folder"></i> Rekap Evaluasi Pembelian</a>
                        </div>
                    </section>
                </div>

                <div class="col-md-4">
                    <section class="panel">
                        <header class="panel-heading">
                           <p style="font-size: 13px; color: black;"><b>3. EVALUASI LAND BANK</b></p>
                       </header>
                       <div class="panel-body">
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_land_bank" class="btn btn-primary"><i class="fa fa-folder"></i> Land Bank Rekap</a>
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_land_bank_per" class="btn btn-primary"><i class="fa fa-folder"></i> Land Bank Perumahan</a>
                    </div>
                </section>
            </div>

            <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="font-size: 13px; color: black;"><b>4. EVALUASI TANAH PROYEK BELUM SHGB</b></p>
                    </header>
                    <div class="panel-body">
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_tanah_belum_shgb" class="btn btn-primary"><i class="fa fa-folder"></i>  Rekap Tanah Belum SHGB</a>
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_tanah_belum_shgb_per" class="btn btn-primary"><i class="fa fa-folder"></i>Tanah Belum SHGB Perumahan</a>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="font-size: 13px; color: black;"><b>5. EVALUASI PROSES INDUK</b></p>
                    </header>
                    <div class="panel-body">
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_proses_induk" class="btn btn-warning"><i class="fa fa-folder"></i>  Rekap Penyelesaian Induk</a>
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_proses_induk_per" class="btn btn-primary"><i class="fa fa-folder"></i>Penyelesaian Induk Perumahan</a>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="font-size: 13px; color: black;"><b>6. EVALUASI PENGGABUNGAN DAN REVISI SPLIT</b></p>
                    </header>
                    <div class="panel-body">
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_penggabungan_split" class="btn btn-warning"><i class="fa fa-folder"></i>  Rekap Penggabungan </a>
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_penggabungan_split_per" class="btn btn-warning"><i class="fa fa-folder"></i>Penggabungan Perumahan</a>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="font-size: 13px; color: black;"><b>7. EVALUASI TANAH PROYEK SUDAH SHGB</b></p>
                    </header>
                    <div class="panel-body">
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_tanah_shgb" class="btn btn-warning"><i class="fa fa-folder"></i>  Rekap Tanah SHGB</a>
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_tanah_shgb_per" class="btn btn-warning"><i class="fa fa-folder"></i>Tanah SHGB Perumahan</a>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="font-size: 13px; color: black;"><b>8. EVALUASI PROSES SPLITSING</b></p>
                    </header>
                    <div class="panel-body">
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_splitsing" class="btn btn-warning"><i class="fa fa-folder"></i>  Rekap Splitsing</a>
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_splitsing_per" class="btn btn-primary"><i class="fa fa-folder"></i> Splitsing Perumahan</a>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="font-size: 13px; color: black;"><b>9. EVALUASI HUTANG SERT BELUM SPLIT </b></p>
                    </header>
                    <div class="panel-body">
                        <a href="<?php echo base_url() ?>laporan/" class="btn btn-warning"><i class="fa fa-folder"></i>  Rekap Hutang Sertifikat </a>
                        <a href="<?php echo base_url() ?>laporan/laporan_hutangsertifikat" class="btn btn-primary"><i class="fa fa-folder"></i>Hutang Sertifikat Perumahan</a>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="font-size: 13px; color: black;"><b>10. EVALUASI STOK SPLITSING</b></p>
                    </header>
                    <div class="panel-body">
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_stok_split" class="btn btn-warning"><i class="fa fa-folder"></i>  Rekap Stok Splitsing</a>
                        <a href="<?php echo base_url() ?>laporan/laporan_evaluasi_stok_split_per" class="btn btn-primary"><i class="fa fa-folder"></i>Splitsing Per Perumahan</a>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="font-size: 13px; color: black;"><b>11. EVALUASI BALIK NAMA</b></p>
                    </header>
                    <div class="panel-body">
                        <a href="<?php echo base_url() ?>laporan/" class="btn btn-warning"><i class="fa fa-folder"></i>  Rekap Balik Nama</a>
                        <a href="<?php echo base_url() ?>laporan/laporan_baliknama" class="btn btn-primary"><i class="fa fa-folder"></i>Balik Nama Per Perumahan</a>
                    </div>
                </section>
            </div>
                <div class="col-md-4">
                <section class="panel">
                    <header class="panel-heading">
                        <p style="font-size: 13px; color: black;"><b>12. Laporan Penjualan</b></p>
                    </header>
                    <div class="panel-body">
                        <a href="<?php echo base_url() ?>laporan/laporan_penjualan" class="btn btn-primary"><i class="fa fa-folder"></i>  Laporan Penjualan</a>

                    </div>
                </section>
            </div>
        </div>

    </div>
</section>
</div>

</section>


<!-- Vendor -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
<script src="<?php echo base_url() ?>assets/javascripts/theme.js"></script>
<script src="<?php echo base_url() ?>assets/javascripts/admin.min.js"></script>
<script src="<?php echo base_url() ?>assets/javascripts/theme.init.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/raphael/raphael.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/morris/morris.js"></script>
<script>



 $.ajax({
        url: '<?php echo base_url() ?>dashboard/cash_2_minggu', // getchart.php
        dataType: 'JSON',
        type: 'GET',
        success: function(response) {

           Morris.Line({
            resize: true,
            element: 'GrafikCash',
            data: response,
            xkey: 'tanggal',
            ykeys: ['masuk','keluar'],
            labels: ['Uang Masuk (Rp) ','Uang Keluar (Rp) '],
            hideHover: true,
            lineColors: ['#0088cc', '#734ba9'],
            xLabelFormat: function (d) {
                return ("0" + d.getDate()).slice(-2) + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear();
            },
            xLabelAngle: 45,
        });
       }
   });


 $.ajax({
        url: '<?php echo base_url() ?>dashboard/laporan_ringkas', // getchart.php
        dataType: 'JSON',
        type: 'GET',
        success: function(response) {
            $.each(response, function(i, item) {
                $('#akan_jatuh_tempo').html(item.akan_jatuh_tempo);
                $('#dibayar_minggu_ini').html(item.dibayar_minggu);
                $('#total_hutang_belum_bayar').html(item.total_hutang_belum_bayar);
                $('#sudah_jatuh_tempo').html(item.sudah_jatuh_tempo);
            });
        }
    });
 $.ajax({
    type: 'GET',
    url: '<?php echo base_url() ?>dashboard/produk_kadaluarsa',
    dataType 	: 'json',
    success: function(response) {
        var i = 0;
        var datarow ='';
        $.each(response.datasub, function(i, itemsub) {
            i = i + 1;
            datarow+="<tr><td>"+i+"</td>";
            datarow+="<td>"+itemsub.kode_item+"</td>";
            datarow+="<td>"+itemsub.nama_item+"</td>";
            datarow+="<td>"+itemsub.tgl_expired+"</td>";
            datarow+="</tr>";
        });
        if(datarow == '' ){
            $('#kadaluarsa').append('<tr><td colspan="4" align="center"> Tidak ada produk akan kadaluarsa</td></tr>');
        }else{
            $('#kadaluarsa').append(datarow);
        }
    }
});

 $.ajax({
    type: 'GET',
    url: '<?php echo base_url() ?>dashboard/produk_terlaris',
    dataType 	: 'json',
    success: function(response) {
        var i = 0;
        var datarow ='';
        $.each(response.datasub, function(i, itemsub) {
            i = i + 1;
            datarow+="<tr><td>"+i+"</td>";
            datarow+="<td>"+itemsub.kode_item+"</td>";
            datarow+="<td>"+itemsub.nama_item+"</td>";
            datarow+="<td>"+itemsub.total+"</td>";
            datarow+="</tr>";
        });
        if(datarow == '' ){
            $('#produk_terlaris').append('<tr><td colspan="4" align="center"> Tidak ada produk data</td></tr>');
        }else{
            $('#produk_terlaris').append(datarow);
        }
    }
});

 $.ajax({
        url: '<?php echo base_url() ?>dashboard/penjualan_2_minggu', // getchart.php
        dataType: 'JSON',
        type: 'GET',
        data: {get_values: true},
        success: function(response) {
           Morris.Line({
            resize: true,
            element: 'GrafikPenjualan',
            data: response,
            xkey: 'tanggal',
            ykeys: ['jumlah'],
            labels: ['Jumlah Transaksi'],
            hideHover: true,
            lineColors: ['#0088cc'],
            xLabelFormat: function (d) {
                return ("0" + d.getDate()).slice(-2) + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear();
            },
            xLabelAngle: 45,
        });
       }
   });
</script>

</body>
</html>