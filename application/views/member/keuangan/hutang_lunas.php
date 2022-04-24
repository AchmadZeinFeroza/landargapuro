<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>  
  <meta charset="UTF-8"> 
  <link rel="shortcut icon" href="<?php echo base_url()?>/assets/images/favicon.png" type="image/ico">   
  <title>PT Airlangga sentral internasional</title>    
  <meta name="author" content="Paber">  
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/magnific-popup/magnific-popup.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/select2/select2.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/stylesheets/theme.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/stylesheets/skins/default.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/stylesheets/theme-custom.css">
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
              <h2>Hutang</h2>  
          </header>  
          <!-- start: page -->
              <!-- start: page -->
     <!-- start: page --> 
     <section class="panel"> 
      <div class="panel-body">  
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label class="control-label">Tanggal Awal</label>
              <input type="text" id="firstdate"  name="firstdate" class="form-control tanggalformat">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label class="control-label">Tanggal Akhir</label>
              <input type="text" id="lastdate" name="lastdate" class="form-control tanggalformat">
            </div>
          </div>
        </div>
        <footer class="panel-footer">
          <span onclick="reloadtable()" class="btn btn-primary" id="TampilkanHTML">
            <i class="fa fa-search"></i> Tampilkan Data
          </span>
                      <!--   <button type="submit"  class="btn btn-primary" id="ExportKeExcel">
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
                            <div class="col-md-3 col-xl-12">
                                <section class="panel">
                                    <div class="panel-body bg-primary">
                                        <div class="widget-summary"> 
                                            <div class="widget-summary-col">
                                                <div class="summary">
                                                    <h4 class="title">Total Hutang Belum Dibayar</h4>
                                                    <div class="info">
                                                        <strong class="amount" id="total_hutang_belum_bayar"></strong>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div> 
                            <div class="col-md-3 col-xl-12">
                                <section class="panel">
                                    <div class="panel-body bg-primary">
                                        <div class="widget-summary"> 
                                            <div class="widget-summary-col">
                                                <div class="summary">
                                                    <h4 class="title">Hutang Akan Jatuh Tempo</h4>
                                                    <div class="info">
                                                        <strong class="amount" id="akan_jatuh_tempo"></strong>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div> 
                            <div class="col-md-3 col-xl-12">
                                <section class="panel">
                                    <div class="panel-body bg-primary">
                                        <div class="widget-summary"> 
                                            <div class="widget-summary-col">
                                                <div class="summary">
                                                    <h4 class="title">Sudah Jatuh Tempo</h4>
                                                    <div class="info">
                                                        <strong class="amount" id="sudah_jatuh_tempo"></strong>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div> 
                            <div class="col-md-3 col-xl-12">
                                <section class="panel">
                                    <div class="panel-body bg-primary">
                                        <div class="widget-summary"> 
                                            <div class="widget-summary-col">
                                                <div class="summary">
                                                    <h4 class="title">Sudah Dibayar Minggu Ini</h4>
                                                    <div class="info">
                                                        <strong class="amount" id="dibayar_minggu_ini"></strong>
                                                    </div>
                                                </div> 
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
        
        <section class="panel">
            <header class="panel-heading">    
                <div class="row show-grid">
                    <div class="col-md-6" align="left"><h2 class="panel-title">Data Hutang Lunas</h2></div>
                    
                </div>
            </header>
            <div class="panel-body"> 
                <table class="table table-bordered table-hover table-striped" id="hutangdata">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Nomor Faktur</th>
                            <th>Tanggal</th> 
                            <th>Nominal</th> 
                            <th>Jatuh Tempo</th> 
                            <th>Dibayar</th> 
                            <th>Sisa</th> 
                            <th>Lunas</th> 
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table> 
            </div>
        </section>


    </section>
</div>
</section>



<div class="modal fade bd-example-modal-lg" id="DetailbayarData"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">   
                <header class="panel-heading">
                    <div class="row">
                        <div class="col-md-3 text-left"> 
                            <h2 class="panel-title">Pembayaran Hutang</h2>  
                        </div> 
                    </div>
                </header>
                <div class="panel-body" id="showdetail"> 
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer> 
            </section>
        </div>
    </div>
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
<script src="<?php echo base_url()?>assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/theme.init.js"></script> 
<script type="text/javascript">
    $('.tanggalformat').datepicker({
        format: 'yyyy-mm-dd' 
    });  
    var tablehutang = $('#hutangdata').DataTable({  
        "serverSide": true, 
        "order": [], 
        "ajax": {
            "url": "<?php echo base_url()?>keuangan/datahutang_lunas",
            "type": "GET", 
            "data": function ( data ) {
                data.firstdate = $('#firstdate').val();
                data.lastdate = $('#lastdate').val();
              }
        }, 
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false, 
        },
        ], 
    });

function reloadtable() {
            tablehutang.ajax.reload();
            
          }
    function laporan_ringkas(){   
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url()?>keuangan/hutang_data', 
            dataType    : 'json',
            success: function(response) {  
                $.each(response, function(i, item) {  
                    $('#akan_jatuh_tempo').html(item.akan_jatuh_tempo);  
                    $('#dibayar_minggu_ini').html(item.dibayar_minggu);  
                    $('#total_hutang_belum_bayar').html(item.total_hutang_belum_bayar);  
                    $('#sudah_jatuh_tempo').html(item.sudah_jatuh_tempo);  
                }); 
            }
        });  
        return false;
    }
    laporan_ringkas();
    function getdataHutang(dataId){
        $('#showdetail').html('Loading...');  
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url()?>keuangan/hutangdetail',
            data: 'id=' + dataId,
            dataType 	: 'json',
            success: function(response) { 
                var datarow='<div class="row">';
                $.each(response.datarows, function(i, item) { 
                    datarow+='<div class="col-md-6">';
                    datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
                    datarow+="<tr><td>ID</td><td>: "+item.id+"</td></tr>";
                    datarow+="<tr><td>Judul</td><td>: "+item.judul+"</td></tr>";
                    datarow+="<tr><td>Nomor Faktur</td><td>: "+item.nomor_faktur+"</td></tr>"; 
                    datarow+="<tr><td>Tanggal </td><td>: "+item.tanggal+"</td></tr>";
                    datarow+="<tr><td>Jatuh Tempo</td><td>: "+item.tanggal_jatuh_tempo+"</td></tr>";
                    datarow+="<tr><td>Nominal</td><td>: "+item.nominal+"</td></tr>"; 
                    datarow+="<tr><td>Sudah Dibayar</td><td>: "+item.nominal_dibayar+"</td></tr>";
                    datarow+="<tr><td>Sisa</td><td>: "+item.sisa+"</td></tr>";   
                    datarow+='</table></div><div class="col-md-6">';
                    datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
                    datarow+="<tr><td>Status</td><td>: "+item.status+"</td></tr>";  
                    datarow+="<tr><td>Kode Supplier</td><td>: "+item.id_supplier+"</td></tr>";
                    datarow+="<tr><td>Supplier</td><td>: "+item.supplier+"</td></tr>";
                    datarow+="<tr><td>Telepon</td><td>: "+item.telepon+"</td></tr>";
                    datarow+="<tr><td>Alamat</td><td>: "+item.alamat+"</td></tr>";
                    datarow+="<tr><td>Keterangan</td><td>: "+item.keterangan+"</td></tr>";
                    datarow+="</table>"; 
                }); 
                datarow+='<h3>Rincian Pembayaran</h3>';
                datarow+='<div class="table-responsive" style="max-height:420px;">';  
                datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
                datarow+="<thead><tr>";
                datarow+="<th>Keterangan</th>"; 
                datarow+="<th>Tanggal</th>"; 
                datarow+="<th>Nominal</th>"; 
                datarow+="<th></th>";
                datarow+="</tr></thead>";
                datarow+="<tbody>"; 
                $.each(response.datasub, function(i, itemsub) {
                    if(itemsub.tanggal ==''){ 
                        datarow+="<tr>"; 
                        datarow+="<td colspan='4'> Belum ada pembayaran</td>"; 
                        datarow+="</tr>"; 
                    }else{ 
                        datarow+="<tr>";
                        datarow+="<td>"+itemsub.keterangan+"</td>"; 
                        datarow+="<td>"+itemsub.tanggal+"</td>"; 
                        datarow+="<td>"+itemsub.nominal+"</td>";  
                        datarow+="</tr>"; 
                    }
                });   
                datarow+="</tbody>";
                datarow+="</table>";
                datarow+="</div></div>";  
                $('#showdetail').html(datarow);
            }
        });  
        return false;
    }
    function detail(elem){ 
      var dataId = $(elem).data("id");    
      $('#DetailbayarData').modal();   
      getdataHutang(dataId) 
  }
</script>
</body>
</html>