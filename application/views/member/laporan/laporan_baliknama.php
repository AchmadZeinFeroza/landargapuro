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
      <h2>Laporan Balik Nama </h2>
    </header>  
    <!-- start: page -->
     <section class="panel">
    <div id="tampilstok">

    </div>

    <!-- end: page -->
  </section>
</div>
</section>


<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <section class="panel  panel-primary">
        <?php echo form_open('master/stok_splittambah',' id="FormulirTambah"');?>  
        <header class="panel-heading">
          <h2 class="panel-title">Tambah Stok Split</h2>
        </header>
        <div class="panel-body">
          <div class="form-group mt-lg blok">
            <label class="col-sm-3 control-label">Nama Blok<span class="required">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="blok" class="form-control" required/>
              <input type="hidden" name="id_perumahan" value="<?php echo $id_perumahan ?>" class="form-control" required/>

            </div>
          </div>  
          <div class="form-group mt-lg luas_teknik">
            <label class="col-sm-3 control-label">Luas Teknik<span class="required">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="luas_teknik" class="form-control" required/>
            </div>
          </div>  
        </div>
        <footer class="panel-footer">
          <div class="row">
            <div class="col-md-12 text-right">
              <button class="btn btn-primary modal-confirm" type="submit" id="submitform">Submit</button>
              <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </footer>
      </form>
    </section>
  </div>
</div>
</div>

<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <section class="panel  panel-primary">
        <?php echo form_open('master/baliknamaedit',' id="FormulirEdit"');?>  
        <input type="hidden" name="id_perumahan" value="<?php echo $id_perumahan ?>" class="form-control" required/>
        <input type="hidden" name="id_jual" id="id_jual">
        <input type="hidden" name="id_stok_split" id="id_stok_split">
        <input type="hidden" name="id_dtl_split" id="id_dtl_split">
        <input type="hidden" name="id_proses_induk" id="id_proses_induk">
        <header class="panel-heading">
          <h2 class="panel-title">Edit Data </h2>
        </header>
        <div class="panel-body">
          <!--<div class="form-group mt-lg blok">-->
          <!--  <label class="col-sm-3 control-label">Nama Blok<span class="required">*</span></label>-->
          <!--  <div class="col-sm-9">-->
          <!--    <input type="text" name="blok" id="blok" class="form-control" required/>-->
          <!--  </div>-->
          <!--</div>   -->
          <!--<div class="form-group mt-lg luas_teknik">-->
          <!--  <label class="col-sm-3 control-label">Luas Teknik<span class="required">*</span></label>-->
          <!--  <div class="col-sm-9">-->
          <!--    <input type="text" name="luas_teknik" id="luas_teknik" class="form-control" required/>-->
          <!--  </div>-->
          <!--</div>  -->
          
            <div class="form-group mt-lg luas_terbit_blok">
              <label class="col-sm-3 control-label">Luas Sertifikat<span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="number" name="luas_terbit_blok" id="luas_terbit_blok" class="form-control" required/>
              </div>
            </div>  
            <div class="form-group mt-lg no_terbit_shgb">
              <label class="col-sm-3 control-label">No Induk<span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="number" name="no_terbit_shgb" id="no_terbit_shgb" class="form-control" required/>
              </div>
            </div>  
            <div class="form-group mt-lg no_shgb_blok">
              <label class="col-sm-3 control-label">No Sertifikat<span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="number" name="no_shgb_blok" id="no_shgb_blok" class="form-control" required/>
              </div>
            </div>
            <div class="form-group mt-lg tgl_daftar_blok">
              <label class="col-sm-3 control-label">Tanggal Daftar<span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="text" name="tgl_daftar_blok" id="tgl_daftar_blok" class="form-control tanggal" required/>
              </div>
            </div>
            <div class="form-group mt-lg tgl_terbit_blok">
              <label class="col-sm-3 control-label">Tanggal Terbit<span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="text" name="tgl_terbit_blok" id="tgl_terbit_blok" class="form-control tanggal" required/>
              </div>
            </div>
            <div class="form-group mt-lg masa_berlaku_shgb">
              <label class="col-sm-3 control-label">Batas Waktu SHGB<span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="text" name="masa_berlaku_shgb" id="masa_berlaku_shgb" class="form-control tanggal" required/>
              </div>
            </div>
            <div class="form-group mt-lg tgl_terima_nego">
              <label class="col-sm-3 control-label">Tanggal Terima Nego <span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="text" name="tgl_terima_nego" id="tgl_terima_nego" class="form-control tanggal" required/>
              </div>
            </div>  
            <div class="form-group mt-lg tgl_penjualan">
              <label class="col-sm-3 control-label">Tanggal Penjualan <span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="text" name="tgl_penjualan" id="tgl_penjualan" class="form-control tanggal" required/>
              </div>
            </div>  
    
            <div class="form-group mt-lg nama_pembeli">
              <label class="col-sm-3 control-label">Nama Pembeli<span class="required">*</span></label>
              <div class="col-sm-9">
                <!--<input type="hidden" name="id_stok_split" id="idjual">-->
                <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" required/>
              </div>
            </div>  
            <div class="form-group mt-lg nik">
              <label class="col-sm-3 control-label">NIK Pembeli<span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="number" name="nik" id="nik" class="form-control" required/>
              </div>
            </div> 
            <!--<div class="form-group mt-lg nik">-->
            <!--  <label class="col-sm-3 control-label">Alamat Pembeli<span class="required">*</span></label>-->
            <!--  <div class="col-sm-9">-->
            <!--    <input type="text" name="nik" class="form-control" required/>-->
            <!--  </div>-->
            <!--</div>  -->
            <div class="form-group mt-lg pekerjaan">
              <label class="col-sm-3 control-label">Pekerjaan Pembeli<span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" required/>
              </div>
            </div>  
    
            <!--<div class="form-group mt-lg harga">-->
            <!--  <label class="col-sm-3 control-label">Tipe <span class="required">*</span></label>-->
            <!--  <div class="col-sm-9">-->
            <!--    <input type="text" name="harga" class="form-control" required/>-->
            <!--  </div>-->
            <!--</div>  -->
            <div class="form-group mt-lg blok">
              <label class="col-sm-3 control-label">Blok<span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="text" name="blok" id="blok" class="form-control" readonly />
    
              </div>
            </div> 
            <div class="form-group mt-lg harga">
              <label class="col-sm-3 control-label">Harga Penjualan <span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="text" name="harga" id="harga" class="form-control mask_price" required/>
              </div>
            </div> 
    
             <div class="form-group mt-lg tipe">
              <label class="col-sm-3 control-label">Tipe Penjualan <span class="required">*</span></label>
              <div class="col-sm-9">
                <input type="text" name="tipe" id="tipe" class="form-control" required/>
              </div>
            </div>  
            <div class="form-group mt-lg sistem_pembayaran">
              <label class="col-sm-3 control-label">Sistem Pembayaran<span class="required">*</span></label>
              <div class="col-sm-9">
                <select data-plugin-selectTwo class="form-control" required name="sistem_pembayaran" id="sistem_pembayaran">  
                  <option value="in house">In House</option>
                  <option value="cash">Cash</option>
                  <option value="kpr subsidi">KPR Subsidi</option>
                  <option value="kpr komersil">KPR Komersil</option>
                </select> 
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

<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="detailData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <section class="panel panel-primary">   
        <header class="panel-heading">
          <h2 class="panel-title">Detail Stok Split</h2>
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

<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="uploaddata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <section class="panel panel-primary">
        <header class="panel-heading">
          <h2 class="panel-title">Upload Stok Split Format Excel</h2>
        </header>         
        <?php  
        if(level_user('tools','import_item',$this->session->userdata('kategori'),'add') > 0){
          ?>  
          <?php echo form_open('tools/view_upload',' id="uploadform" enctype="multipart/form-data"');?>  
        <?php } ?>
        <div class="panel-body">  
          <div class="form-group excelfile">
            <label class="col-sm-3 control-label">Upload File Excel</label>
            <div class="col-sm-9">
              <input type="file" name="excelfile" class="form-control" required/>
              <input type="hidden" name="id_perumahan" value="<?php echo $id_perumahan ?>" class="form-control" required/>
            </div>
          </div> 
          <div class="form-group"> 
            <div class="col-sm-9"> 
              Catatan : 
            </div>
          </div>  
        </div>  
        <footer class="panel-footer">
          <div class="row">
            <div class="col-md-12 text-right">    
              <?php  
              if(level_user('tools','import_item',$this->session->userdata('kategori'),'add') > 0){
                ?>  
                <button class="btn btn-primary modal-confirm" type="submit" id="submitform"><i class="fa fa-upload"></i>Upload</button>
              <?php } ?>
              <a class="btn btn-warning" href="<?php echo base_url()?>excel/formatupload.xlsx" target="_blank"><i class="fa fa-download"></i> Download Format</a>
              <button class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
          </div>
        </footer>
      </form>
    </section>  
  </div>
</div>
</div>

<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <section class="panel  panel-danger">
        <header class="panel-heading">
          <h2 class="panel-title">Konfirmasi Hapus Data</h2>
        </header>
        <div class="panel-body">
          <div class="modal-wrapper">
            <div class="modal-icon">
              <i class="fa fa-question-circle"></i>
            </div>
            <div class="modal-text">
              <h4>Yakin ingin menghapus data ini ?</h4> 
            </div>
          </div>
        </div>
        <footer class="panel-footer"> 
          <div class="row">
            <div class="col-md-12 text-right"> 
              <?php echo form_open('master/hapus_jual',' id="FormulirHapus"');?>  
              <input type="hidden" name="id_jual" id="idddelete">
              <button type="submit" class="btn btn-danger" id="submitformHapus">Delete</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
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
<script src="<?php echo base_url()?>assets/javascripts/admin.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/theme.init.js"></script> 
<script type="text/javascript">
  $(document).ready(function(){
   refresh();    
 });
</script>
<?php  
if(level_user('tools','import_item',$this->session->userdata('kategori'),'add') > 0){
  ?>  
  <script>

 document.getElementById("FormulirTambah").addEventListener("submit", function (e) {  
      blurForm();       
      $('.help-block').hide();
      $('.form-group').removeClass('has-error');
      document.getElementById("submitform").setAttribute('disabled','disabled');
      $('#submitform').html('Loading ...');
      var form = $('#FormulirTambah')[0];
      var formData = new FormData(form);
      var xhrAjax = $.ajax({
      type    : 'POST',
      url     : $(this).attr('action'),
      data    : formData, 
      processData: false,
      contentType: false,
      cache: false, 
      dataType  : 'json'
      }).done(function(data) { 
      if ( ! data.success) {     
                    $('input[name=<?php echo $this->security->get_csrf_token_name();?>]').val(data.token);
                    document.getElementById("submitform").removeAttribute('disabled');  
                    $('#submitform').html('Submit');    
                    var objek = Object.keys(data.errors);  
                    for (var key in data.errors) {
                        if (data.errors.hasOwnProperty(key)) { 
                            var msg = '<div class="help-block" for="'+key+'">'+data.errors[key]+'</span>';
                            $('.'+key).addClass('has-error');
                            $('input[name="' + key + '"]').after(msg);  
                            $('textarea[name="' + key + '"]').after(msg);  
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
                    // tablekategori.ajax.reload();  
                    refresh(); 
                    document.getElementById("submitform").removeAttribute('disabled'); 
                    $('#tambahData').modal('hide'); 
                    document.getElementById("FormulirTambah").reset();  
                    $('#submitform').html('Submit');   
                    new PNotify({
                        title: 'Notifikasi',
                        text: data.message,
                        type: 'success'
                    });  
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
    function edit(elem){
      var dataId = $(elem).data("id");
      document.getElementById("id_stok_split").setAttribute('value', dataId);
      $('#editData').modal();        
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url()?>master/baliknamadetail',
        data: 'id_stok_split=' + dataId,
        dataType  : 'json',
        success: function(response) {  
          $.each(response, function(i, item) { 
            document.getElementById("id_jual").setAttribute('value', item.id_jual);
            document.getElementById("id_dtl_split").setAttribute('value', item.id_dtl_split);
            document.getElementById("id_proses_induk").setAttribute('value', item.id_proses_induk);
            document.getElementById("blok").setAttribute('value', item.blok);
            document.getElementById("luas_terbit_blok").setAttribute('value', item.luas_terbit_blok);
            document.getElementById("no_terbit_shgb").setAttribute('value', item.no_terbit_shgb);
            document.getElementById("no_shgb_blok").setAttribute('value', item.no_shgb_blok);
            document.getElementById("tgl_daftar_blok").setAttribute('value', item.tgl_daftar_blok);
            document.getElementById("tgl_terbit_blok").setAttribute('value', item.tgl_terbit_blok);
            document.getElementById("masa_berlaku_shgb").setAttribute('value', item.masa_berlaku_shgb);
            document.getElementById("tgl_terima_nego").setAttribute('value', item.tgl_terima_nego);
            document.getElementById("tgl_penjualan").setAttribute('value', item.tgl_penjualan);
            document.getElementById("nama_pembeli").setAttribute('value', item.nama_pembeli);
            document.getElementById("nik").setAttribute('value', item.nik);
            document.getElementById("pekerjaan").setAttribute('value', item.pekerjaan);
            document.getElementById("harga").setAttribute('value', item.harga);
            document.getElementById("tipe").setAttribute('value', item.tipe);
            document.getElementById("sistem_pembayaran").setAttribute('value', item.sistem_pembayaran);
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
       type     : 'POST',
       url    : $(this).attr('action'),
       data     : formData, 
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
        // tablekategori.ajax.reload();   
        refresh(); 
        document.getElementById("submitformEdit").removeAttribute('disabled'); 
        $('#editData').modal('hide');        
        document.getElementById("FormulirEdit").reset();    
        $('#submitformEdit').html('Submit');   
        new PNotify({
          title: 'Notifikasi',
          text: data.message,
          type: 'success'
        });
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
    function hapus(elem){ 
      var dataId = $(elem).data("id");
      document.getElementById("idddelete").setAttribute('value', dataId);
      $('#modalHapus').modal();        
    }
    document.getElementById("FormulirHapus").addEventListener("submit", function (e) {  
     blurForm();       
     $('.help-block').hide();
     $('.form-group').removeClass('has-error');
     document.getElementById("submitformHapus").setAttribute('disabled','disabled');
     $('#submitformHapus').html('Loading ...');
     var form = $('#FormulirHapus')[0];
     var formData = new FormData(form);
     var xhrAjax = $.ajax({
       type     : 'POST',
       url    : $(this).attr('action'),
       data     : formData, 
       processData: false,
       contentType: false,
       cache: false, 
       dataType   : 'json'
     }).done(function(data) { 
       if ( ! data.success) {    
        $('input[name=<?php echo $this->security->get_csrf_token_name();?>]').val(data.token);
        document.getElementById("submitformHapus").removeAttribute('disabled');  
        $('#submitformHapus').html('Delete');     
        var objek = Object.keys(data.errors);  
        for (var key in data.errors) { 
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
        // tablekategori.ajax.reload();
        refresh();
        document.getElementById("submitformHapus").removeAttribute('disabled'); 
        $('#modalHapus').modal('hide');        
        document.getElementById("FormulirHapus").reset();    
        $('#submitformHapus').html('Delete'); 
        new PNotify({
          title: 'Notifikasi',
          text: data.message,
          type: 'success'
        });  
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

    function detail(elem){
      var dataId = $(elem).data("id");   
      $('#detailData').modal();    
      $('#showdetail').html('Loading...'); 
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url()?>laporan/stoksplitdetail',
        data: 'id=' + dataId,
        dataType    : 'json',
        success: function(response) { 
          var datarow='<div class="row">';
          $.each(response.datarows, function(i, item) {
            // document.getElementById('linkprint').setAttribute('href', '<?php echo base_url()?>pembelian/printpo/'+item.nomor_po);
            // document.getElementById('linkpdf').setAttribute('href', '<?php echo base_url()?>pembelian/pdfpo/'+item.nomor_po);
            datarow+='<div class="col-md-6">';
            datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
            datarow+="<tr><td>Lokasi</td><td>: "+item.nama_regional+"</td></tr>";
            datarow+="<tr><td>Blok</td><td>: "+item.blok+"</td></tr>";
            datarow+="</table>";
            datarow+='</div>';
            datarow+='<div class="col-md-6">';
            datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
            datarow+="<tr><td>Luas Kavling</td><td>: "+item.luas_teknik+"</td></tr>";
            datarow+="<tr><td>luas Sertipikat</td><td>: "+item.luas_stok+"</td></tr>"; 
            datarow+="<tr><td>Luas Belum Terbit</td><td>: "+item.sisa_luas+"</td></tr>"; 
            datarow+="</table>";
            datarow+='</div>';
          });
          datarow+='</div>';
          datarow+='<div class="row"><div class="col-md-12">';
          datarow+='<h3>Rincian</h3>';
          datarow+='<div class="table-responsive" style="max-height:420px;">';  
          datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
          datarow+="<thead><tr>";
          datarow+="<th>Blok</th>";
          datarow+="<th>Luas Daftar</th>";
          datarow+="<th>Luas Terbit</th>";
          datarow+="<th>Sisa Luas</th>";
          datarow+="<th>No SHGB</th>";
          datarow+="<th>Masa Berlaku</th>";
          datarow+="<th>No Daftar</th>";
          datarow+="<th>Tgl Daftar</th>";
          datarow+="<th>Tgl Terbit</th>";
          datarow+="<th>Keterangan</th>";
          datarow+="</tr></thead>";
          datarow+="<tbody>";

          $.each(response.datasub, function(i, itemsub) {
            datarow+="<tr>";
            datarow+="<td>"+itemsub.blok+"</td>"; 
            datarow+="<td>"+itemsub.luas_daftar_blok+"</td>";
            datarow+="<td>"+itemsub.luas_terbit_blok+"</td>"; 
            datarow+="<td>"+itemsub.sisa_luas+"</td>"; 
            datarow+="<td>"+itemsub.no_shgb_blok+"</td>"; 
            datarow+="<td>"+itemsub.masa_berlaku_bloktampil+"</td>"; 
            datarow+="<td>"+itemsub.no_daftar_blok+"</td>"; 
            datarow+="<td>"+itemsub.tgl_daftar_bloktampil+"</td>"; 
            datarow+="<td>"+itemsub.tgl_terbit_bloktampil+"</td>"; 
            datarow+="<td>"+itemsub.keterangan+"</td>"; 
            datarow+="</tr>"; 
          });  
          datarow+="</tbody>";
          datarow+="</table>";
          datarow+="</div>";
          datarow+='</div></div>';
          $('#showdetail').html(datarow);
        }
      });  
      return false;
    }

    document.getElementById("uploadform").addEventListener("submit", function (e) {  
      blurForm();       
      PNotify.removeAll();   
      $('.help-block').hide();
      $('.form-group').removeClass('has-error');
      document.getElementById("submitform").setAttribute('disabled','disabled');
      $('#submitform').html('Loading ...');
      var form = $('#uploadform')[0];
      var formData = new FormData(form);
      var xhrAjax = $.ajax({
        type    : 'POST',
        url     : $(this).attr('action'),
        data    : formData, 
        processData: false,
        contentType: false,
        cache: false, 
        dataType  : 'json'
      }).done(function(data) { 
        if ( ! data.success) {     
          $('input[name=<?php echo $this->security->get_csrf_token_name();?>]').val(data.token);
          document.getElementById("submitform").removeAttribute('disabled');  
          $('#submitform').html('Submit');    
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
                text: 'gagal mengupload semua data, pastikan data terisi dengan benar dan sudah memilih lokasi',
                type: 'danger'
              }); 
            }
          }
        } else { 
          $('input[name=<?php echo $this->security->get_csrf_token_name();?>]').val(data.token);
          document.getElementById("submitform").removeAttribute('disabled'); 
          $('#uploaddata').modal('hide'); 
          document.getElementById("uploadform").reset();  
          $('#submitform').html('Submit');   
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
        // window.setTimeout(function() {  location.reload();}, 2000);
      }); 
      e.preventDefault(); 
    }); 
    
  </script>
<?php } ?>
<script type="text/javascript">
  function refresh() { 
    var id_perumahan = '<?php echo $id_perumahan ?>';
    var tgl_awal = '<?php echo $tgl_awal ?>';
    var tgl_akhir = '<?php echo $tgl_akhir ?>';
    $.ajax({
      type: 'GET',
      url: '<?php echo base_url(); ?>laporan/ajaxbaliknama/',
      data: 'id_perumahan='+id_perumahan+'&tgl_awal='+tgl_awal+'&tgl_akhir='+tgl_akhir,
      success: function (html) {
        $('#tampilstok').html(html); 
      }
    }); 
  }
</script>
</body>
</html>