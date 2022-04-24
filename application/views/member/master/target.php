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
              <h2>Master Data Target</h2>  
          </header>  
          <!-- start: page -->
          <section class="panel">
            <header class="panel-heading">    
                <div class="row show-grid">
                    <div class="col-md-6" align="left"><h2 class="panel-title">Data Target</h2></div>
                    <?php  
                    echo '<div class="col-md-6" align="right"><a class="btn btn-success" href="#"  data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah</a></div>';
                    ?> 
                </div>
            </header>
            <div class="panel-body"> 
                <table class="table table-bordered table-hover table-striped" id="targetdata">
                    <thead>
                       <tr>
                        <th rowspan="2">Aksi</th>
                        <th rowspan="2">Perumahan</th>
                        <th rowspan="2">Tahun</th>
                        <th colspan="2"  style="text-align: center;vertical-align: middle;">JAN</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">FEB</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">MAR</th>
                        <th colspan="2"  style="text-align: center;vertical-align: middle;">APR</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">MEI</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">JUN</th>
                        <th colspan="2"  style="text-align: center;vertical-align: middle;">JUL</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">AGU</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">SEP</th>
                        <th colspan="2"  style="text-align: center;vertical-align: middle;">OKT</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">NOV</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">DES</th>



                    </tr>
                    <tr>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>
                        <th   style="text-align: center;vertical-align: middle;">BID </th>
                        <th style="text-align: center;vertical-align: middle;">LUAS</th>



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
                <?php echo form_open('master/targettambah',' id="FormulirTambah"');?>  
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Target</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mt-lg nama_target">
                        <label class="col-sm-3 control-label">Regional<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_perumahan" value="<?php echo $id_perumahan ?>" class="form-control" />
                            <input type="text" readonly="" value="<?php echo $nama_regional[0]->nama_regional ?>" class="form-control" />
                            
                        </div>
                    </div>

                    <div class="form-group telepon">
                        <label class="col-sm-3 control-label">Tahun</label>
                        <div class="col-sm-9">
                            <input type="text" name="tahun" class="form-control tanggal" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3">Data Target</label>
                        <div class="col-sm-9">
                            <table class=" table table-bordered table-hover table-striped">
                                <tr>
                                    <td>Bulan</td>
                                    <td>BID</td>
                                    <td>LUAS</td>
                                </tr>
                                <tr>
                                    <td>Januari</td>
                                    <td><input type="text" name="bid1" class="form-control " /></td>
                                    <td><input type="text" name="luas1" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Febuari</td>
                                    <td><input type="text" name="bid2" class="form-control " /></td>
                                    <td><input type="text" name="luas2" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Maret</td>
                                    <td><input type="text" name="bid3" class="form-control " /></td>
                                    <td><input type="text" name="luas3" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>April</td>
                                    <td><input type="text" name="bid4" class="form-control " /></td>
                                    <td><input type="text" name="luas4" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Mei</td>
                                    <td><input type="text" name="bid5" class="form-control " /></td>
                                    <td><input type="text" name="luas5" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Juni</td>
                                    <td><input type="text" name="bid6" class="form-control " /></td>
                                    <td><input type="text" name="luas6" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Juli</td>
                                    <td><input type="text" name="bid7" class="form-control " /></td>
                                    <td><input type="text" name="luas7" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Agustus</td>
                                    <td><input type="text" name="bid8" class="form-control " /></td>
                                    <td><input type="text" name="luas8" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>September</td>
                                    <td><input type="text" name="bid9" class="form-control " /></td>
                                    <td><input type="text" name="luas9" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Oktober</td>
                                    <td><input type="text" name="bid10" class="form-control " /></td>
                                    <td><input type="text" name="luas10" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>November</td>
                                    <td><input type="text" name="bid11" class="form-control " /></td>
                                    <td><input type="text" name="luas11" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Desember</td>
                                    <td><input type="text" name="bid12" class="form-control " /></td>
                                    <td><input type="text" name="luas12" class="form-control " /></td>
                                </tr>
                            </tr>
                        </table>
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
                <?php echo form_open('master/targetedit',' id="FormulirEdit"');?>  
                <input type="hidden" name="idd" id="idd">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Data Target</h2>
                </header>
                 <div class="panel-body">
                    <div class="form-group mt-lg nama_target">
                        <label class="col-sm-3 control-label">Regional<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_perumahan" value="<?php echo $id_perumahan ?>" class="form-control" />
                            <input type="text" readonly="" value="<?php echo $nama_regional[0]->nama_regional ?>" class="form-control" />
                            
                        </div>
                    </div>

                    <div class="form-group telepon">
                        <label class="col-sm-3 control-label">Tahun</label>
                        <div class="col-sm-9">
                            <input type="text" name="tahun" class="form-control tanggal" />
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3">Data Target</label>
                        <div class="col-sm-9">
                            <table class=" table table-bordered table-hover table-striped">
                                <tr>
                                    <td>Bulan</td>
                                    <td>BID</td>
                                    <td>LUAS</td>
                                </tr>
                                <tr>
                                    <td>Januari</td>
                                    <td><input type="text" name="bid1" id="bid1"  class="form-control " /></td>
                                    <td><input type="text" name="luas1" id="luas1" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Febuari</td>
                                    <td><input type="text" name="bid2" id="bid2" class="form-control " /></td>
                                    <td><input type="text" name="luas2" id="luas2" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Maret</td>
                                    <td><input type="text" name="bid3" id="bid3" class="form-control " /></td>
                                    <td><input type="text" name="luas3" id="luas3" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>April</td>
                                    <td><input type="text" name="bid4" id="bid4" class="form-control " /></td>
                                    <td><input type="text" name="luas4" id="luas4" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Mei</td>
                                    <td><input type="text" name="bid5" id="bid5" class="form-control " /></td>
                                    <td><input type="text" name="luas5" id="luas5" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Juni</td>
                                    <td><input type="text" name="bid6" id="bid6" class="form-control " /></td>
                                    <td><input type="text" name="luas6" id="luas6" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Juli</td>
                                    <td><input type="text" name="bid7" id="bid7" class="form-control " /></td>
                                    <td><input type="text" name="luas7" id="luas7" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Agustus</td>
                                    <td><input type="text" name="bid8" id="bid8" class="form-control " /></td>
                                    <td><input type="text" name="luas8" id="luas8" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>September</td>
                                    <td><input type="text" name="bid9" id="bid9" class="form-control " /></td>
                                    <td><input type="text" name="luas9" id="luas9" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Oktober</td>
                                    <td><input type="text" name="bid10" id="bid10" class="form-control " /></td>
                                    <td><input type="text" name="luas10" id="luas10" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>November</td>
                                    <td><input type="text" name="bid11" id="bid11" class="form-control " /></td>
                                    <td><input type="text" name="luas11" id="luas11" class="form-control " /></td>
                                </tr>
                                  <tr>
                                    <td>Desember</td>
                                    <td><input type="text" name="bid12" id="bid12" class="form-control " /></td>
                                    <td><input type="text" name="luas12" id="luas12" class="form-control " /></td>
                                </tr>
                            </tr>
                        </table>
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
                            <?php echo form_open('master/targethapus',' id="FormulirHapus"');?>  
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
    $('.tanggal').datepicker({
        format: 'yyyy-mm-dd' ,
        viewMode: "years", 
        minViewMode: "years"

    });
    var tabletarget = $('#targetdata').DataTable({  
        "serverSide": true, 
        "order": [1],
        "searching": false,
        "ajax": {
            "url": "<?php echo base_url()?>master/datatarget/"+'<?php echo $id_perumahan ?>',
            data: function (data) {
              for (var i = 0, len = data.columns.length; i < len; i++) {
                if (! data.columns[i].search.value) delete data.columns[i].search;
                if (data.columns[i].searchable === true) delete data.columns[i].searchable;
                if (data.columns[i].orderable === true) delete data.columns[i].orderable;
                if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
            }
            delete data.search.regex;
        },
        "type": "GET"
    }, 
    "columnDefs": [
    { 
        "targets": [0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25], 
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
            tabletarget.ajax.reload();   
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
      document.getElementById("idd").setAttribute('value', dataId);
      $('#editData').modal();        
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url()?>master/targetdetail',
        data: 'id=' + dataId,
        dataType 	: 'json',
        success: function(response) {  
            $.each(response, function(i, item) { 
                document.getElementById("nama_target").setAttribute('value', item.nama_target);
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
            tabletarget.ajax.reload();    
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
        // window.setTimeout(function() {  location.reload();}, 2000); 
    }); 
    e.preventDefault(); 
}); 
  function hapus(elem){ 
      var dataId = $(elem).data("id");
      document.getElementById("idddelete").setAttribute('value', dataId);
      $('#submitformHapus').on('click', function(){
          console.log(dataId);
      })
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
            tabletarget.ajax.reload();
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
        // window.setTimeout(function() {  location.reload();}, 2000);
    }); 
    e.preventDefault(); 
}); 

</script>
</body>
</html>