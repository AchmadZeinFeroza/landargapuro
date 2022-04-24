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
      <h2>Master Data Perumahan / Lokasi</h2>  
    </header> 
    <!-- start: page -->
    <section class="panel">
      <header class="panel-heading">    
        <div class="row show-grid">
          <div class="col-md-6" align="left"><h2 class="panel-title">Data Perumahan / Lokasi</h2></div>
          <?php  
          echo level_user('master','perumahan',$this->session->userdata('kategori'),'add') > 0 ? '<div class="col-md-6" align="right"><a class="btn btn-success" href="#"  data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah</a></div>':'';
          ?> 
        </div>
      </header>
      <div class="panel-body"> 
        <table class="table table-bordered table-hover table-striped" id="kategoridata">
          <thead>
            <tr>
              <th></th>
              <th>id</th>
              <th>Nama Proyek / Lokasi</th>
              <th>Alamat</th>
              <th>Status</th>
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


<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <section class="panel  panel-primary">
        <?php echo form_open('master/kategoritambah',' id="FormulirTambah"');?>  
        <header class="panel-heading">
          <h2 class="panel-title">Tambah Data</h2>
        </header>
        <div class="panel-body">
          <div class="form-group mt-lg id">
            <label class="col-sm-3 control-label">Nama Perumahan / Proyek<span class="required">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="nama_regional" class="form-control" required/>
            </div>
          </div>  
          <div class="form-group mt-lg id">
            <label class="col-sm-3 control-label">Kabupaten<span class="required">*</span></label>
            <div class="col-sm-9">
              <!-- <input type="text" name="kabupaten" id="kabupaten" class="form-control" required/> -->
              <select name="id_kabupaten" id="kabupaten" class="form-control">
                <option value="0">-PILIH-</option>
                <?php foreach($listkabupaten as $row):?>
                  <option value="<?php echo $row->id_kabupaten;?>"><?php echo $row->nama_kabupaten;?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>  
          <div class="form-group mt-lg id">
            <label class="col-sm-3 control-label">Kecamatan<span class="required">*</span></label>
            <div class="col-sm-9">
              <select name="id_kecamatan" id="kecamatan" class="kecamatan form-control">
                <option value="0">-PILIH-</option>
              </select>
            </div>
          </div>  
          <div class="form-group mt-lg id">
            <label class="col-sm-3 control-label">Kelurahan / Desa<span class="required">*</span></label>
            <div class="col-sm-9">
              <select name="lokasi" class="desa form-control">
                <option value="0">-PILIH-</option>
              </select>
            </div>
          </div>  
          <div class="form-group mt-lg nama_target">
            <label class="col-sm-3 control-label">Status<span class="required">*</span></label>
            <div class="col-sm-9">
              <input type="hidden" name="status_regional" value="3" class="form-control" required/>
              <input type="text" readonly value="Luar Ijin" class="form-control" required/>
              
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


<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <section class="panel  panel-primary">
        <?php echo form_open('master/kategoriedit',' id="FormulirEdit"');?>  
        <input type="hidden" name="id" id="id">
        <header class="panel-heading">
          <h2 class="panel-title">Edit Data</h2>
        </header>
        <div class="panel-body">
          <div class="form-group mt-lg id">
            <label class="col-sm-3 control-label">Nama Perumahan / Lokasi<span class="required">*</span></label>
            <div class="col-sm-9">
              <input type="text" name="nama_regional" id="nama_regional" class="form-control" required/>
            </div>
          </div> 
          <div class="form-group mt-lg id">
            <label data-plugin-selectTwo class="col-sm-3 control-label">Kabupaten<span class="required">*</span></label>
            <div class="col-sm-9">
              <!-- <input type="text" name="kabupaten" id="kabupaten" class="form-control" required/> -->
              <select name="id_kabupaten" id="kabupatenedit" class="form-control">
                <option value="0">-PILIH-</option>
                <?php foreach($listkabupaten as $row):?>
                  <option value="<?php echo $row->id_kabupaten;?>"><?php echo $row->nama_kabupaten;?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>  
          <div class="form-group mt-lg id">
            <label data-plugin-selectTwo class="col-sm-3 control-label">Kecamatan<span class="required">*</span></label>
            <div class="col-sm-9">
              <select name="id_kecamatan" id="kecamatanedit" class="kecamatan form-control">
              </select>
            </div>
          </div>  
          <div class="form-group mt-lg id">
            <label data-plugin-selectTwo class="col-sm-3 control-label">Kelurahan / Desa<span class="required">*</span></label>
            <div class="col-sm-9">
              <select name="lokasi" id="lokasi" class="desa form-control">
              </select>
            </div>
          </div>  
          <div class="form-group mt-lg nama_target">
            <label class="col-sm-3 control-label">Status<span class="required">*</span></label>
            <div class="col-sm-9">
              <select data-plugin-selectTwo class="form-control" required id="status_regional" name="status_regional">  
                <option value="">Pilih Status</option>
                <?php foreach ($status as $supp): ?>
                  <option value="<?php echo $supp->id_status_regional;?>"><?php echo $supp->nama_status;?></option>
                <?php endforeach; ?>
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
              <?php echo form_open('master/kategorihapus',' id="FormulirHapus"');?>  
              <input type="hidden" name="id" id="idelete">
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
    $('#kabupaten').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>master/getkecamatan",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].id_kecamatan+'">'+data[i].nama_kecamatan+'</option>';
          }
          $('.kecamatan').html(html);

        }
      });
    });
    $('#kabupatenedit').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>master/getkecamatan",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].id_kecamatan+'">'+data[i].nama_kecamatan+'</option>';
          }
          $('.kecamatan').html(html);

        }
      });
    });
    $('#kecamatan').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>master/getdesa",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].id_desa+'">'+data[i].nama_desa+'</option>';
          }
          $('.desa').html(html);

        }
      });
    });
    $('#kecamatanedit').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>master/getdesa",
        method : "POST",
        data : {id: id},
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].id_desa+'">'+data[i].nama_desa+'</option>';
          }
          $('.desa').html(html);

        }
      });
    });
  });
</script>
<script type="text/javascript"> 
  var tablekategori = $('#kategoridata').DataTable({  
    "serverSide": true, 
    "order": [], 
    "ajax": {
      "url": "<?php echo base_url()?>master/datakategori/3",
      "type": "GET"
    }, 
    "columnDefs": [
    { 
      "targets": [ 0 ], 
      "orderable": false, 
    },
    ],  
  }); 
  document.getElementById("FormulirTambah").addEventListener("submit", function (e) {  
   blurForm();       
   $('.help-block').hide();
   $('.form-group').removeClass('has-error');
   document.getElementById("submitform").setAttribute('disabled','disabled');
   $('#submitform').html('Loading ...');
   var form = $('#FormulirTambah')[0];
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
      tablekategori.ajax.reload();   
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
    document.getElementById("id").setAttribute('value', dataId);
    $('#editData').modal();        
    $.ajax({
      type: 'GET',
      url: '<?php echo base_url()?>master/kategoridetail',
      data: 'id=' + dataId,
      dataType 	: 'json',
      success: function(response) {  
        $.each(response, function(i, item) { 
          document.getElementById("id").setAttribute('value', item.id);
          document.getElementById("nama_regional").setAttribute('value', item.nama_regional);
                // document.getElementById("status_kategori").setAttribute('value', item.status_kategori); 
                $("#status_regional").val(item.status_regional);
                $("#kabupatenedit").val(item.id_kabupaten);
                $("#kecamatanedit").append(new Option(item.nama_kecamatan, item.id_kecamatan));  
                $("#lokasi").append(new Option(item.nama_desa, item.lokasi));  
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
     type 		: 'POST',
     url 		: $(this).attr('action'),
     data 		: formData, 
     processData: false,
     contentType: false,
     cache: false, 
     dataType 	: 'json'
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
      tablekategori.ajax.reload();    
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
    document.getElementById("idelete").setAttribute('value', dataId);
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
     type 		: 'POST',
     url 		: $(this).attr('action'),
     data 		: formData, 
     processData: false,
     contentType: false,
     cache: false, 
     dataType 	: 'json'
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
      tablekategori.ajax.reload();
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

</script>
</body>
</html>