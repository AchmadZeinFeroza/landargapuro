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
            <h2>Data Pembayaran</h2>
        </header>
        <!-- start: page -->

        <section class="panel">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-4">
                        <div class="row">
                            <div class="col-md-4 col-xl-12">
                                <section class="panel">
                                    <div class="panel-body bg-primary">
                                        <div class="widget-summary">
                                            <div class="widget-summary-col">
                                                <div class="summary">
                                                    <h4 class="title">Total Belum Dibayar</h4>
                                                    <div class="info">
                                                        <strong class="amount" id="total_bayar_tanah_belum_dibayar"><?php echo $total_belum_dibayar ?></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <!-- <div class="col-md-4 col-xl-12">
                                <section class="panel">
                                    <div class="panel-body bg-primary">
                                        <div class="widget-summary">
                                            <div class="widget-summary-col">
                                                <div class="summary">
                                                    <h4 class="title">Pembayaran Terakhir</h4>
                                                    <div class="info">
                                                        <strong class="amount" id="akan_jatuh_tempo"><?php echo $pembayaran_terahir ?></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div> -->
                            <div class="col-md-4 col-xl-12">
                                <section class="panel">
                                    <div class="panel-body bg-primary">
                                        <div class="widget-summary">
                                            <div class="widget-summary-col">
                                                <div class="summary">
                                                    <h4 class="title">Total Terbayar</h4>
                                                    <div class="info">
                                                        <strong class="amount" id="sudah_jatuh_tempo"><?php echo $total_sudah_dibayar ?></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-4 col-xl-12">
                                <section class="panel">
                                    <div class="panel-body bg-primary">
                                        <div class="widget-summary">
                                            <div class="widget-summary-col">
                                                <div class="summary">
                                                    <h4 class="title">Total Harga Beli</h4>
                                                    <div class="info">
                                                        <strong class="amount" id="dibayar_minggu_ini"><?php echo $total_harga_pengalihan ?></strong>
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
                    <div class="col-md-6" align="left"><h2 class="panel-title">Data Pembayaran</h2></div>
                    <?php
echo '<div class="col-md-6" align="right"><a class="btn btn-success" href="#"  data-toggle="modal" data-target="#tambahbayarbayar_tanah"><i class="fa fa-plus"></i> Tambah</a>
                    <a class="btn btn-primary btn-hover pr-5 " href="http://localhost/landargopuro/Export_excel/laporan_pembayaran_master_tanah/' . $kode_item . '" ><i class="fa fa-print"></i>  cetak </a>
                    </div>';
?>
                </div>
            </header>
             <div class="panel-body">
                <b><h4 class="col-sm-3 control-label">Nama Penjual<span class="required"> </span></h4><h4><?php echo $tanah_milik ?></h4>

                 <h4 class="col-sm-3 control-label">Total Pembayaran<span class="required">  </span></h4><h4><?php echo $total_harga_pengalihan ?></h4></b>
                 </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover table-striped" id="pembayarandata">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID Pembayaran</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Tanggal Realisasi</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Keterangan</th>

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


<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="tambahbayarbayar_tanah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel">
                <?php echo form_open('keuangan/bayar_tanahtambahpembayaran', ' id="FormulirTambahPembayaran"'); ?>
                <input type="hidden" name="kode_item" value="<?php echo $kode_item ?>">
                <header class="panel-heading">
                    <h2 class="panel-title">Form Pembayaran </h2>
                </header>
                <div class="panel-body" style="overflow-y: scroll;">
                    <div class="container input_fields_wrap">
                        <div class="form-inline mt-2">
                            <input type="text"  id="tanggal_pembayaran" autocomplete="off" name="tanggal_pembayaran[]" class="form-control tanggalformat" placeholder="Tanggal Pembayaran"/>
                            <input type="text"  id="total_bayar" name="total_bayar[]"  class="form-control mask_price" placeholder="Nilai"/>
                            <select class="" required id="status_bayar" name="status_bayar[]">
                                    <option value="">Status Bayar</option>
                                    <option value="0">Belum Terbayar</option>
                                    <option value="1">Sudah Terbayar</option>
                            </select>
                            <input rows="2" class="form-control col-5" name="keterangan[]" placeholder="Keterangan">
                        </div>
                    </div>
                    <button class="add_field_button btn blue mt-lg" style="width: 100%;"><i class="fa fa-plus"></i>Tambah Form Baru</button>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" type="submit" id="submitformPembayaran">Submit</button>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('keuangan/bayar_tanahubahpembayaran', ' id="FormulirEdit"  enctype="multipart/form-data"'); ?>
                <input type="hidden" name="idd" id="idd">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Data Tanah/Aset</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mt-lg tanggal_pembayaran">
                        <label class="col-sm-3 control-label">Tanggal Pembayaran<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text"  id="tanggal_pembayaran_edit" autocomplete="off" name="tanggal_pembayaran" class="form-control tanggalformat" />
                        </div>
                    </div>
                    <div class="form-group mt-lg tanggal_pembayaran">
                        <label class="col-sm-3 control-label">Tanggal Realisasi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text"  id="tanggal_realisasi_edit" autocomplete="off" name="tanggal_realisasi" class="form-control tanggalformat" />
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Nilai Bayar<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text"  id="total_bayar_edit" name="total_bayar"  class="form-control mask_price" />
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label">Status Bayar<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" required id="status_bayar_edit" name="status_bayar">
                                    <option value="0">Belum Terbayar</option>
                                    <option value="1">Sudah Terbayar</option>
                                </select>
                        </div>
                    </div>
                    <div class="form-group keterangan">
                        <label class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea rows="2" class="form-control" name="keterangan" id="keterangan_edit"></textarea>
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
                <?php echo form_open('keuangan/bayar_tanahhapuspembayaran', ' id="FormulirHapusPembayaran"'); ?>
                <input type="hidden" name="id" id="id">
                <button type="submit" class="btn btn-danger" id="submitformHapusPembayaran">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </form>
        </div>
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
    $('.tanggalformat').datepicker({
        format: 'yyyy-mm-dd'
    });
    var tablehutang = $('#pembayarandata').DataTable({
        "ajax": {
            url : "<?php echo base_url() ?>keuangan/databayar_tanah/"+<?php echo $kode_item; ?>,
            type : 'GET'
        },
    });
    // function laporan_ringkas(){
    //     $.ajax({
    //         type: 'GET',
    //         url: '<?php echo base_url() ?>keuangan/bayar_tanah_data',
    //         dataType    : 'json',
    //         success: function(response) {
    //             $.each(response, function(i, item) {
    //                 $('#dibayar_minggu_ini').html(item.dibayar_minggu);
    //                 $('#total_bayar_tanah_belum_dibayar').html(item.total_bayar_tanah_belum_bayar);
    //                 $('#akan_jatuh_tempo').html(item.akan_jatuh_tempo);
    //                 $('#sudah_jatuh_tempo').html(item.sudah_jatuh_tempo);
    //             });
    //         }
    //     });
    //     return false;
    // }
    // laporan_ringkas();



    function hapus(elem){
        var id = $(elem).data("id");
        document.getElementById("id").setAttribute('value', id);
        $('#modalHapusPembayaran').modal();
    }

    document.getElementById("FormulirHapusPembayaran").addEventListener("submit", function (e) {
     blurForm();
     $('.help-block').hide();
     document.getElementById("submitformHapusPembayaran").setAttribute('disabled','disabled');
     $('#submitformHapusPembayaran').html('Loading ...');
     var form = $('#FormulirHapusPembayaran')[0];
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
            $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
            $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
    document.getElementById("FormulirTambahPembayaran").addEventListener("submit", function (e) {
     blurForm();
     $('.help-block').hide();
     $('.form-group').removeClass('has-error');
     document.getElementById("submitformPembayaran").setAttribute('disabled','disabled');
     $('#submitformPembayaran').html('Loading ...');
     var form = $('#FormulirTambahPembayaran')[0];
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
            $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
            window.setTimeout(function() {
                document.getElementById("submitformPembayaran").removeAttribute('disabled');
                $('#submitformPembayaran').html('Submit');
                var objek = Object.keys(data.errors);
                for (var key in data.errors) {
                    if (data.errors.hasOwnProperty(key)) {
                        var msg = '<div class="help-block" for="'+key+'">'+data.errors[key]+'</span>';
                        $('.'+key).addClass('has-error');
                        $('input[name="' + key + '"]').after(msg);
                    }
                }
            }, 500);
            return false;
        } else {
            $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
            PNotify.removeAll();
            window.setTimeout(function() {
                document.getElementById("submitformPembayaran").removeAttribute('disabled');
                document.getElementById("FormulirTambahPembayaran").reset();
                $('#submitformPembayaran').html('Submit');
                tablehutang.ajax.reload();
                $('#tambahbayarbayar_tanah').modal('hide');
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

function edit(elem){
      var dataId = $(elem).data("id");
      document.getElementById("idd").setAttribute('value', dataId);
      $('#editData').modal();
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url() ?>keuangan/itemdetail',
        data: 'id=' + dataId,
        dataType 	: 'json',
        success: function(response) {
            document.getElementById("tanggal_pembayaran_edit").setAttribute('value', response[0].tanggal_pembayaran);

            $("#total_bayar_edit").val(response[0].total_bayar);
            $("#status_bayar_edit").select2("val", response[0].status_bayar);
            $("#keterangan_edit").val(response[0].keterangan);
        //     //  $("#jenis_pengalihan").select2("val", item.jenis_pengalihan);

        //  });
        }
    })
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
       console.log(data);
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
        tablehutang.ajax.reload();
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

$(document).ready(function() {
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('' +
                        '<div class="form-inline mt-lg">'+
                            '<input type="text"  id="tanggal_pembayaran" autocomplete="off" name="tanggal_pembayaran[]" class="form-control tanggalformat" placeholder="Tanggal Pembayaran" required/> ' +
                            '<input type="text"  id="total_bayar" name="total_bayar[]"  class="form-control mask_price" placeholder="Nilai" required/> ' +
                            '<select required id="status_bayar" name="status_bayar[]"> '+
                                    '<option value="">Status Bayar</option>'+
                                    '<option value="0">Belum Terbayar</option>'+
                                    '<option value="1">Sudah Terbayar</option>'+
                            '</select> ' +
                            '<input rows="2" class="form-control col-5" name="keterangan[]" placeholder="Keterangan">          ' +
                            '<button class="remove_field btn btn-danger">Hapus Form Pembayaran</button>' +
                        '</div>'
                    ); //add input box
                }
                $('.tanggalformat').datepicker({
                    format: 'yyyy-mm-dd'
                });
                $('.mask_price').maskMoney();
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });
</script>
</body>
</html>