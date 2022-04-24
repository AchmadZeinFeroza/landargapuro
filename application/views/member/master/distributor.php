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
              <h2>Master Data distributor</h2>  
          </header>  
          <!-- start: page -->
          <section class="panel">
            <header class="panel-heading">    
                <div class="row show-grid">
                    <div class="col-md-6" align="left"><h2 class="panel-title">Data distributor</h2></div>
                    <?php  
                    echo level_user('master','target',$this->session->userdata('kategori'),'add') > 0 ? '<div class="col-md-6" align="right"><a class="btn btn-success" href="#"  data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah</a></div>':'';
                    ?> 
                </div>
            </header>
            <div class="panel-body"> 
                <table class="table table-bordered table-hover table-striped" id="distributordata">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama distributor</th>
                            <th>Regional</th>
                            <th>Telepon</th>
                            <th>Alamat</th> 
                            <th>penjual</th> 
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table> 
            </div>
        </section>
        <!-- end: page -->
    </section>
</div>
</section>


<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel  panel-primary">
                <?php echo form_open('master/distributortambah',' id="FormulirTambah"');?>  
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah distributor</h2>
                </header>
                <div class="panel-body">
                    <!-- apotek -->
                    <div class="form-group mt-lg nama_distributor">
                        <label class="col-sm-3 control-label">Nama distributor<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_distributor" class="form-control" required/>
                        </div>
                    </div> 
                       <div class="form-group mt-lg nama_distributor">
                        <label class="col-sm-3 control-label">Regional<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" required id="id_regional" name="id_regional">  
                            <option value="">Pilih Regional</option>
                            <?php foreach ($regional as $supp): ?>
                                <option value="<?php echo $aa->id;?>"><?php echo $aa->nama_regional;?> ( <?php echo $aa->nama_status;?> )</option>
                            <?php endforeach; ?>
                        </select> 
                        </div>
                    </div>
                <div class="form-group alamat">
                    <label class="col-sm-3 control-label">Alamat distributor<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <textarea rows="2" class="form-control" name="alamat" required></textarea>
                    </div>
                </div>

                <div class="form-group telepon">
                    <label class="col-sm-3 control-label">Telepon</label>
                    <div class="col-sm-9">
                        <input type="text" name="telepon" class="form-control" />
                    </div>
                            <!-- bank -->
                            <div class="form-group mt-lg nama_distributor">
                                <label class="col-sm-3 control-label">penjual<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="penjual" class="form-control" readonly value="<?php echo $this->session->userdata('nama_admin'); ?>" required/>
                                    <input type="hidden" name="penjual" class="form-control" value="<?php echo $this->session->userdata('idadmin'); ?>" required/>
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
                    <?php echo form_open('master/distributoredit',' id="FormulirEdit"');?>  
                    <input type="hidden" name="idd" id="idd">
                    <header class="panel-heading">
                        <h2 class="panel-title">Edit Data distributor</h2>
                    </header>
                    <div class="panel-body">
                        <!-- apotek -->
                        <div class="form-group mt-lg nama_distributor">
                            <label class="col-sm-3 control-label">Nama distributor<span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" name="nama_distributor" id="nama_distributor" class="form-control" required/>
                            </div>
                        </div> 
                        <div class="form-group mt-lg id_regional_edit">
                        <label class="col-sm-3 control-label">Regional<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" required id="id_regional_edit" name="id_regional">  
                            <option value="">Pilih Regional</option>
                            <?php foreach ($regional as $supp): ?>
                                <option value="<?php echo $aa->id;?>"><?php echo $aa->nama_regional;?> ( <?php echo $aa->nama_status;?> )</option>
                            <?php endforeach; ?>
                        </select> 
                        </div>
                    </div>
                        <div class="form-group telepon">
                            <label class="col-sm-3 control-label">Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" name="telepon" id="telepon" class="form-control" />
                            </div>
                        </div> 
                        <div class="form-group alamat">
                            <label class="col-sm-3 control-label">Alamat distributor<span class="required">*</span></label>
                            <div class="col-sm-9">
                                <textarea rows="2" class="form-control" name="alamat" id="alamat" required></textarea>
                            </div>
                        </div>
                        <div class="form-group mt-lg nama_distributor">
                            <label class="col-sm-3 control-label">penjual<span class="required">*</span></label>
                            <div class="col-sm-9">
                                <select data-plugin-selectTwo class="form-control" required id="id_penjual_edit" name="id_penjual">  
                            <option value="">Pilih penjual</option>
                            <?php foreach ($penjual as $supp): ?>
                                <option value="<?php echo $supp->id;?>"><?php echo $supp->nama_penjual;?></option>
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
                            <?php echo form_open('master/distributorhapus',' id="FormulirHapus"');?>  
                            <input type="hidden" name="idd" id="idddelete">
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
    $('.tanggal_masa').datepicker({
        format: 'yyyy-mm-dd' 
    });
    $('.tanggal_sipa').datepicker({
        format: 'yyyy-mm-dd' 
    });
    $('.tanggal_sipaedit').datepicker({
        format: 'yyyy-mm-dd' 
    });
    var tabledistributor = $('#distributordata').DataTable({  
        "serverSide": true, 
        "order": [], 
        "ajax": {
            "url": "<?php echo base_url()?>master/datadistributor",
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
            tabledistributor.ajax.reload();   
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
        // window.setTimeout(function() {  location.reload();}, 2000);
    }); 
    e.preventDefault(); 
}); 

    function edit(elem){
      var dataId = $(elem).data("id");   
      document.getElementById("idd").setAttribute('value', dataId);
      $('#editData').modal();        
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url()?>master/distributordetail',
        data: 'id=' + dataId,
        dataType 	: 'json',
        success: function(response) {  
            $.each(response, function(i, item) { 
                document.getElementById("nama_distributor").setAttribute('value', item.nama_distributor);
                document.getElementById("alamat").value = item.alamat;
                document.getElementById("telepon").setAttribute('value', item.telepon);
                document.getElementById("id_regional_edit").value = item.id_regional;
                document.getElementById("id_penjual_edit").value = item.id_penjual;
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
            tabledistributor.ajax.reload();    
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
            tabledistributor.ajax.reload();
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