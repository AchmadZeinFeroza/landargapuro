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
      <h2>EVALUASI LAND BANK</h2>
  </header>  
  <!-- start: page -->
  <section class="panel">
    <header class="panel-heading">    
        <div class="row">
            <div class="col-sm-3" align="left"><h2 class="panel-title">EVALUASI LAND BANK</h2></div>
            <form action="" method="get">
                <div class="form-group mt-lg nama_target">
                    <div class="col-sm-5">
                        <select data-plugin-selectTwo class="form-control" onchange='refresh()' required id="id_perumahan" name="id_perumahan">  
                            <option value="">Pilih Lokasi</option>
                            <?php foreach ($perumahan as $aa): ?>
                                <option value="<?php echo $aa->id;?>" <?php if ($id_perumahan == $aa->id ) echo 'selected' ; ?> ><?php echo $aa->nama_regional;?> (<?php echo $aa->nama_status;?>)</option>
                            <?php endforeach; ?>
                        </select> 
                        <a class="btn btn-primary" onclick="cetak()"> cetak </a>
                    </div>
                </div>
            </form>
        </div>
    </header>

    <div id="kontendata">

    </div>

</section>
<!-- end: page -->
</section>
</div>
</section>


<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="detailData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <section class="panel panel-primary">   
                <header class="panel-heading">
                    <h2 class="panel-title">Detail Obat / Alkes</h2>
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

<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('master/editlandbank',' id="FormulirEdit"  enctype="multipart/form-data"');?>  
                <input type="hidden" name="idd" id="idd">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Data Tanah/Aset</h2>
                </header>
                <div class="panel-body">

                    <!-- <div class="form-group mt-lg nama_target">
                        <label class="col-sm-3 control-label">Posisi Surat<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" id="id_posisi_surat" name="id_posisi_surat">  
                                <option value="">Pilih Lokasi</option>
                                
                            </select> 
                        </div>
                    </div> -->
                    <div class="form-group mt-lg nama_penjual">
                        <label class="col-sm-3 control-label">Nama Penjual<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_penjual" id="nama_penjual" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group mt-lg nama_surat_tanah">
                        <label class="col-sm-3 control-label">Atas Nama Surat<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_surat_tanah" id="nama_surat_tanah" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group tanggal_pembelian">
                        <label class="col-sm-3 control-label">Tanggal Pembelian</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control tanggal"  />
                        </div>
                    </div>
                    <div class="form-group nama_penjual">
                        <label class="col-sm-3 control-label">Data Surat Tanah</span></label>

                        <div class="col-sm-5">
                            <select data-plugin-selectTwo class="form-control" id="status_surat_tanah1" required name="status_surat_tanah">  
                                <option value="">Pilih Jenis</option>
                                <?php foreach ($sertifikat_tanah as $aa): ?>
                                    <option value="<?php echo $aa->id_sertifikat_tanah;?>"><?php echo $aa->kode_sertifikat;?> / <?php echo $aa->nama_sertifikat;?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="keterangan1" class="form-control" id="keterangan1" placeholder="keterangan"  />
                        </div>
                    </div>

                    <div class="form-group total_harga_pengalihan">
                        <label class="col-sm-3 control-label">Total Harga Pengalihan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="total_harga_pengalihan" id="total_harga_pengalihan" class="form-control mask_price"  />
                        </div>
                    </div><div class="form-group nama_makelar">
                        <label class="col-sm-3 control-label">Makelar</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_makelar" id="nama_makelar" class="form-control"  />
                        </div>
                    </div><div class="form-group nilai">
                        <label class="col-sm-3 control-label">Nilai</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nilai" id="nilai" class="form-control"  />
                        </div>
                    </div>

                    <div class="form-group mt-lg status_order_akta">
                        <label class="col-sm-3 control-label">Status Akta<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" required name="status_order_akta" id="status_order_akta">  
                                <option value="">Pilih Status</option>
                                <option value="belum">Belum</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">selesai</option>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group tanggal_pengalihan">
                        <label class="col-sm-3 control-label">Tanggal Pengalihan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="tanggal_pengalihan" id="tanggal_pengalihan" class="form-control tanggal"  />
                        </div>
                    </div><div class="form-group akta_pengalihan">
                        <label class="col-sm-3 control-label">Akta Pengalihan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="akta_pengalihan" id="akta_pengalihan" class="form-control"  />
                        </div>
                    </div>

                    <div class="form-group mt-lg jenis_pengalihan_hak">
                        <label class="col-sm-3 control-label">Status Jenis Hak<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" required name="jenis_pengalihan_hak" id="jenis_pengalihan_hak">  
                                <option value="">Pilih Status</option>
                                <option value="pribadi">Pribadi</option>
                                <option value="pt">PT</option>
                            </select> 
                        </div>
                    </div> 
                    <div class="form-group nama_pengalihan">
                        <label class="col-sm-3 control-label">Nama Pengalihan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pengalihan" id="nama_pengalihan" class="form-control"  />
                        </div>
                    </div>
                   <div class="form-group lain">
                        <label class="col-sm-3 control-label">Biaya Lain-lain</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="lain" id="lain" placeholder="Nilai" class="form-control mask_price"  />
                        </div>
                        <div class="col-sm-5">

                            <textarea rows="2" class="form-control" id="keterangan_lain" name="keterangan_lain" placeholder="Keterangan Lain-lain" ></textarea>
                        </div>
                    </div>
                  <div class="form-group harga_perm">
                        <label class="col-sm-3 control-label"></span>Harga / M^2</label>
                        <div class="col-sm-9">
                            <input type="text" name="harga_perm" readonly id="harga_perm" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group mt-lg status_teknik">
                        <label class="col-sm-3 control-label">Status Teknik<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" required name="status_teknik" id="status_teknik">  
                                <option value="">Pilih Status</option>
                                <option value="belum">Belum</option>
                                <option value="sudah">Sudah</option>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group keterangan">
                        <label class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea rows="2" class="form-control" name="keterangan" id="keterangan"></textarea>
                        </div>
                    </div>

                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" type="submit" id="submitformEdit">Submit</button>
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>
</div>
</div>


<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="modalHapusPembayaran" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Data </h4>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data ini ?</p>
            </div>
            <div class="modal-footer"> 
                <?php echo form_open('laporan/hapus_Land_Bank_Perum',' id="FormulirHapus"');?> 
                <input type="hidden" name="id" id="id">
                <button type="submit" class="btn btn-danger" id="submitformHapusPembayaran">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
        </div>
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
<script src="<?php echo base_url()?>assets/javascripts/admin.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/theme.init.js"></script> 
<script type="text/javascript">
	$(document).ready(function(){

        refresh();
        var tableitems = $('#itemsdata').DataTable({  
            "serverSide": false, 
            "order": [], 

            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],  
        }); 

        var tableitems2 = $('#itemsdata2').DataTable({  
            "serverSide": false, 
            "order": [], 

            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            ],  
        }); 
    });
</script>
<script type="text/javascript">
  $('.tanggal').datepicker({
    format: 'yyyy-mm-dd' 
});   
  function edit(elem){
      var dataId = $(elem).data("id");   
      document.getElementById("idd").setAttribute('value', dataId);
      $('#editData').modal();        
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url()?>master/itemdetail',
        data: 'id=' + dataId,
        dataType    : 'json',
        success: function(response) {  
            $.each(response, function(i, item) { 
               document.getElementById("nama_surat_tanah").setAttribute('value', item.nama_surat_tanah);

               document.getElementById("nama_penjual").setAttribute('value', item.nama_penjual); 
               document.getElementById("tanggal_pembelian").setAttribute('value', item.tanggal_pembelian); 
               document.getElementById("total_harga_pengalihan").setAttribute('value', item.total_harga_pengalihan); 
               document.getElementById("nama_makelar").setAttribute('value', item.nama_makelar); 
               document.getElementById("nilai").setAttribute('value', item.nilai); 
               document.getElementById("tanggal_pengalihan").setAttribute('value', item.tanggal_pengalihan); 
               document.getElementById("akta_pengalihan").setAttribute('value', item.akta_pengalihan); 
               document.getElementById("nama_pengalihan").setAttribute('value', item.nama_pengalihan); 
               document.getElementById("lain").setAttribute('value', item.lain); 
               document.getElementById("harga_perm").setAttribute('value', item.harga_permtampil); 
               document.getElementById("keterangan").value = item.keterangan; 
               document.getElementById("keterangan_lain").value = item.keterangan_lain; 
               document.getElementById("keterangan1").setAttribute('value', item.keterangan1);   
               $("#status_surat_tanah1").select2("val", item.status_surat_tanah1);    
               $("#status_order_akta").select2("val", item.status_order_akta);   
               $("#jenis_pengalihan_hak").select2("val", item.jenis_pengalihan_hak);   
               $("#status_teknik").select2("val", item.status_teknik);   



           }); 
        }
    });  
      return false;
  }
  document.getElementById("FormulirEdit").addEventListener("submit", function (e) {  
     blurForm();       
     $('.help-block').hide();
     $('.form-group').removeClass('has-error');
     document.getElementById("submitformEdit").setAttribute('disabled','disabled');
     $('#submitformEdit').html('Loading ...');
     var form = $('#FormulirEdit')[0];
     var formData = new FormData(form);
     var xhrAjax = $.ajax({
         type       : 'POST',
         url        : $(this).attr('action'),
         data       : formData, 
         processData: false,
         contentType: false,
         cache: false, 
         dataType   : 'json'
     }).done(function(data) { 
         if ( ! data.success) {  
            $('input[name=<?php echo $this->security->get_csrf_token_name();?>]').val(data.token);
            document.getElementById("submitformEdit").removeAttribute('disabled');  
            $('#submitformEdit').html('Submit');    
            var objek = Object.keys(data.errors);  
            for (var key in data.errors) {
                if (data.errors.hasOwnProperty(key)) { 
                    var msg = '<div class="help-block" for="'+key+'">'+data.errors[key]+'</span>';
                    $('.'+key).addClass('has-error');
                    $('input[name="' + key + '"]').after(msg);  
                }
                if (key == 'fail') {   
                    new PNotify({
                        title: 'Notifikasi',
                        text: data.errors[key],
                        type: 'danger'
                    }); 
                }
            }
        } else { 
            $('input[name=<?php echo $this->security->get_csrf_token_name();?>]').val(data.token);
            PNotify.removeAll();
            document.getElementById("submitformEdit").removeAttribute('disabled'); 
            $('#editData').modal('hide');        
            document.getElementById("FormulirEdit").reset();    
            $('#submitformEdit').html('Submit');   
            new PNotify({
                title: 'Notifikasi',
                text: data.message,
                type: 'success'
            });  
            refresh();    

        }
    }).fail(function(data) { 
        new PNotify({
            title: 'Notifikasi',
            text: "Request gagal, browser akan direload",
            type: 'danger'
        }); 
                    window.setTimeout(function() {  location.reload();}, 2000);
                }); 
    e.preventDefault(); 
}); 
  function refresh() { 
    var id_perumahan = $('#id_perumahan').val();

    $.ajax({
        type: 'GET',
        url: '<?php echo base_url(); ?>laporan/pageevaluasilandbankper/',
        data: 'id_perumahan='+id_perumahan,
        success: function (html) { 
            $('#kontendata').html(html); 
        }
    }); 
}
function cetak() {
    var id_perumahan = $('#id_perumahan').val();
    var link = "<?php echo site_url('export_excel/excel_laporan2rekap/') ?>"+id_perumahan;
    window.open(link);
}



    function hapus(elem){ 
        var id = $(elem).data("id"); 
        document.getElementById("id").setAttribute('value', id);
        $('#modalHapusPembayaran').modal();        
    } 

    document.getElementById("FormulirHapus").addEventListener("submit", function (e) {  
     blurForm();        
     $('.help-block').hide();
     document.getElementById("submitformHapusPembayaran").setAttribute('disabled','disabled');
     $('#submitformHapusPembayaran').html('Loading ...');
     var form = $('#FormulirHapus')[0];
     var formData = new FormData(form);
     var xhrAjax = $.ajax({
         type 		: 'POST',
         url 		: $(this).attr('action'),
         data 		: formData, 
         processData: false,
         contentType: false,
         cache: false, 
         dataType 	: 'json'
     }).done(function(data) { 
         if (!data.success) {		 
            $('input[name=<?php echo $this->security->get_csrf_token_name();?>]').val(data.token);
            window.setTimeout(function() {  
                document.getElementById("submitformHapusPembayaran").removeAttribute('disabled');  
                $('#submitformHapusPembayaran').html('Delete');     
                new PNotify({
                    title: 'Warning',
                    text: 'terjadi kesalahan, refresh browser anda',
                    type: 'danger'
                });    
            }, 500);
            return false;
        } else { 
            $('input[name=<?php echo $this->security->get_csrf_token_name();?>]').val(data.token);
            PNotify.removeAll();
            window.setTimeout(function() {   
                document.getElementById("submitformHapusPembayaran").removeAttribute('disabled'); 
                $('#modalHapusPembayaran').modal('hide');        
                document.getElementById("FormulirHapusPembayaran").reset();    
                $('#submitformHapusPembayaran').html('Delete');
                tablehutang.ajax.reload();  
            }, 1000);
            window.setTimeout(function() {  
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                }); 
            }, 500); 
        }
    }).fail(function(data) {   
        alert('request gagal');
        location.reload();
    }); 
    e.preventDefault(); 
}); 


function detail(elem){
      var dataId = $(elem).data("id");   
      $('#detailData').modal();    
      $('#showdetail').html('Loading...'); 
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url()?>master/itemdetail',
        data: 'id=' + dataId,
        dataType 	: 'json',
        success: function(response) { 
            var datarow='';
            $.each(response, function(i, item) {
                datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';

                datarow+="<tr><td>kode_item</td><td>: "+item.kode_item+"</td></tr>";
                datarow+="<tr><td>tanggal_pembelian</td><td>: "+item.tanggal_pembelian+"</td></tr>";
                datarow+="<tr><td>nama_penjual</td><td>: "+item.nama_penjual+"</td></tr>";
                datarow+="<tr><td>Atas Nama</td><td>: "+item.nama_surat_tanah+"</td></tr>";
                datarow+="<tr><td>Jenis Surat</td><td>: "+item.nama_sertifikat1+"</td></tr>";
                datarow+="<tr><td>Keterangan</td><td>: "+item.keterangan1+"</td></tr>";
                datarow+="<tr><td>no_gambar</td><td>: "+item.no_gambar+"</td></tr>";
                datarow+="<tr><td>jumlah_bidang</td><td>: "+item.jumlah_bidang+"</td></tr>";
                datarow+="<tr><td>luas_surat</td><td>: "+item.luas_surat+"</td></tr>";
                datarow+="<tr><td>luas_ukur</td><td>: "+item.luas_ukur+"</td></tr>";
                datarow+="<tr><td>no_pbb</td><td>: "+item.no_pbb+"</td></tr>";
                datarow+="<tr><td>luas_pbb_bangunan</td><td>: "+item.luas_pbb_bangunan+"</td></tr>";
                datarow+="<tr><td>njop_bangunan</td><td>: "+item.njop_bangunan+"</td></tr>";
                datarow+="<tr><td>luas_pbb_bumi</td><td>: "+item.luas_pbb_bumi+"</td></tr>";
                datarow+="<tr><td>njop_bumi</td><td>: "+item.njop_bumi+"</td></tr>";
                datarow+="<tr><td>satuan_harga_pengalihan</td><td>: "+item.satuan_harga_pengalihantampil+"</td></tr>";
                datarow+="<tr><td>total_harga_pengalihan</td><td>: "+item.total_harga_pengalihantampil+"</td></tr>";
                datarow+="<tr><td>nama_makelar</td><td>: "+item.nama_makelar+"</td></tr>";
                datarow+="<tr><td>nilai</td><td>: "+item.nilaitampil+"</td></tr>";
                datarow+="<tr><td>tanggal_pengalihan</td><td>: "+item.tanggal_pengalihan+"</td></tr>";
                datarow+="<tr><td>akta_pengalihan</td><td>: "+item.akta_pengalihan+"</td></tr>";
                datarow+="<tr><td>nama_pengalihan</td><td>: "+item.nama_pengalihan+"</td></tr>";
                datarow+="<tr><td>lain</td><td>: "+item.laintampil+"</td></tr>";
                datarow+="<tr><td>keterangan lain</td><td>: "+item.keterangan_lain+"</td></tr>";
                datarow+="<tr><td>harga_perm</td><td>: "+item.harga_permtampil+"</td></tr>";
                datarow+="<tr><td>keterangan</td><td>: "+item.keterangan+"</td></tr>";
                datarow+="<tr><td>Lokasi</td><td>: "+item.nama_regional+"</td></tr>";
                datarow+="</table>";
            });
            $('#showdetail').html(datarow);
        }
    });  
      return false;
  }

</script>
</body>
</html>