<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/fav.png" type="image/ico">
  <title>PT Argopuro</title>
  <meta name="author" content="Paber">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/vendor/bootstrap/css/bootstrap.css" />
  <?php $this->load->view('komponen/css');?>
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/vendor/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/vendor/magnific-popup/magnific-popup.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/vendor/select2/select2.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/stylesheets/theme.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/stylesheets/skins/default.css" />
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/stylesheets/theme-custom.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/assets/stylesheets/admin.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/pnotify/pnotify.custom.css" />


  <!-- Head Libs -->
  <script src="<?php echo base_url() ?>/assets/vendor/modernizr/modernizr.js"></script>
</head>
<body class="bgbody">
  <section class="body">

     <?php $this->load->view("komponen/header.php")?>
     <div class="inner-wrapper">
        <?php $this->load->view("komponen/sidebar.php")?>
        <section role="main" class="content-body">
           <header class="page-header">
              <h2>Master Data Sertifikat Tanah</h2>
          </header>
          <!-- start: page -->
          <section class="panel">
            <header class="panel-heading">
                <div class="row show-grid">
                    <div class="col-md-6" align="left"><h2 class="panel-title">Data Manajemen Excel</h2></div>

                </div>
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-hover table-striped" id="sertifikat_tanahdata">
                    <thead>
                        <tr>
                            <th></th>
                            <th>id</th>
                            <th>Nama</th>
                            <th>Posisi</th>
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
            <section class="panel panel-primary">
                <?php echo form_open('master/sertifikat_tanahtambah', ' id="FormulirTambah"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Sertifikat Tanah</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mt-lg kode_sertifikat">
                        <label class="col-sm-3 control-label">Kode Sertifikat<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="idd" id="idd">
                            <input type="text" name="kode_sertifikat" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group mt-lg nama_sertifikat">
                        <label class="col-sm-3 control-label">Nama Sertifikat<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_sertifikat" class="form-control" required/>
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
            <section class="panel panel-primary">
                <?php echo form_open('master/data_excel_edit', ' id="FormulirEdit"'); ?>
                <input type="hidden" name="idd" id="idedit">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Sertifikat Tanah</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mt-lg nama">
                        <label class="col-sm-3 control-label">Nama<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" id="nama" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group mt-lg posisi">
                        <label class="col-sm-3 control-label">Posisi<span class="required"></span></label>
                        <div class="col-sm-9">
                            <input type="text" name="posisi" id="posisi" class="form-control"/>
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

<!-- Vendor -->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
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
<script src="<?php echo base_url() ?>assets/javascripts/admin.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="<?php echo base_url() ?>assets/javascripts/theme.init.js"></script>
<script type="text/javascript">
    var tablesertifikat_tanah = $('#sertifikat_tanahdata').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url() ?>master/data_excel",
            "type": "GET"
        },
        "columnDefs": [
        {
            "targets": [ 0 ],
            "orderable": false,
        },
        ],
    });

    function edit(elem){
      var dataId = $(elem).data("id");
      document.getElementById("idedit").setAttribute('value', dataId);
      $('#editData').modal();
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url() ?>master/data_excel_detail',
        data: 'id=' + dataId,
        dataType 	: 'json',
        success: function(response) {
            $.each(response, function(i, item) {
                document.getElementById("nama").setAttribute('value', item.nama);
                document.getElementById("posisi").setAttribute('value', item.posisi);
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
            $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
            $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
            PNotify.removeAll();
            tablesertifikat_tanah.ajax.reload();
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
            $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
            $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
            PNotify.removeAll();
            tablesertifikat_tanah.ajax.reload();
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