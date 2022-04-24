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
      <h2>Evaluasi Proses Induk  </h2>
  </header>
  <!-- start: page -->
  <div class="row">
      <section class="panel col-md-12">
        <header class="panel-heading">
            <div class="row show-grid">
                <div class="col-md-8" align="left"><h2 class="panel-title">EVALUASI PROSES PENYELESAIAN INDUK</h2>
                </div>

                <form action="" method="get">
                    <div class="form-group mt-lg nama_target">
                      <div class="col-sm-5">
                        <select data-plugin-selectTwo class="form-control" onchange='this.form.submit()' required name="id_perumahan">
                          <option value="">Pilih Lokasi</option>
                          <?php foreach ($perumahan as $aa): ?>
                             <option value="<?php echo $aa->id; ?>" <?php if ($id_perumahan == $aa->id) {
    echo 'selected';
}
?> ><?php echo $aa->nama_regional; ?> ( <?php echo $aa->nama_status; ?> )</option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-primary" href="<?php echo site_url('Export_excel/excellaporanprosesinduk/') . $id_perumahan ?>"> cetak </a>
                </div>
                <div class="col-sm-5">
                 <?php
echo level_user('master', 'proses_induk', $this->session->userdata('kategori'), 'add') > 0 ? '<div class="col-md-6 pull-right" align="right"><a class="btn btn-success" href="#"  data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah</a></div>' : '';
?>
             </div>
         </div>
     </form>
 </div>
</header>
<div id="kontendata"></div>
</section>
</div>
</section>
<div class="modal fade bd-example-modal-lg" data-keyboard="false" data-backdrop="static"  id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('laporan/prosesinduktambah', ' id="FormulirTambah" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Item</h2>
                </header>
                <div class="panel-body">

                    <div class="form-group Penjual">
                        <label class="col-sm-3 control-label">Penjual</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="penjual" class="form-control"  required />
                            <input type="hidden" name="id_perumahan" value="<?php echo $id_perumahan ?>" class="form-control"  required />
                        </div>
                    </div>
                    <div class="form-group no_gambar2">
                        <label class="col-sm-3 control-label">No Gambar</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="no_gambar2" class="form-control"  required />
                        </div>
                    </div>
                    <div class="form-group no_surat_tanah">
                        <label class="col-sm-3 control-label">No Surat</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="no_surat_tanah" class="form-control"  required />
                        </div>
                    </div>
                    <div class="form-group nama_surat_tanah">
                        <label class="col-sm-3 control-label">Atas Nama</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_surat_tanah" class="form-control"  required />
                        </div>
                    </div>
                    <div class="form-group luas">
                        <label class="col-sm-3 control-label">Luas (m2)</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="luas" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group tanggal_pengalihan">
                        <label class="col-sm-3 control-label"> Detail Luas </span></label>
                        <div class="col-sm-4">
                            <input type="text" name="luas_daftar" style="color: grey; text-align: center;vertical-align: middle;" class="form-control" placeholder="Luas Daftar" title="Luas Daftar" required />
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="luas_terbit" class="form-control" placeholder="Luas Terbit" required />
                        </div>
                    </div>

                    <div class="form-group tanggal_pengalihan">
                        <label class="col-sm-3 control-label"> Detail Daftar SK </span></label>
                        <div class="col-sm-4">
                            <input type="text" name="tanggal_daftar_sk_hak" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Daftar SK Hak" title="Tanggal Daftar SK Hak" />
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="no_daftar_sk_hak" class="form-control" placeholder="No Daftar SK Hak" />
                        </div>
                    </div>

                    <div class="form-group tanggal_pengalihan">
                        <label class="col-sm-3 control-label"> Detail Terbit SK </span></label>
                        <div class="col-sm-4">
                            <input type="text" name="tanggal_terbit_sk_hak" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Terbit SK Hak" title="Tanggal Terbit SK Hak"  />
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="no_terbit_sk_hak" class="form-control" placeholder="No Terbit SK Hak"  />
                        </div>
                    </div>

                    <div class="form-group tanggal_pengalihan">
                        <label class="col-sm-3 control-label"> Detail Daftar SHGB </span></label>
                        <div class="col-sm-4">
                            <input type="text" name="tanggal_daftar_shgb" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Daftar SHGB" title="Tanggal Daftar SHGB"  />
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="no_daftar_shgb" class="form-control" placeholder="No Daftar SHGB"  />
                        </div>
                    </div>

                    <div class="form-group tanggal_pengalihan">
                        <label class="col-sm-3 control-label"> Detail Terbit SHGB </span></label>
                        <div class="col-sm-3">
                            <input type="text" name="tanggal_terbit_shgb" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Terbit SHGB" title="Tanggal Terbit SHGB"  />
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="no_terbit_shgb" class="form-control" placeholder="No Terbit SHGB"  />
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="masa_berlaku_shgb" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Masa Berlaku SHGB" title="Masa Berlaku SHGB"  />
                        </div>
                    </div>

                    <div class="form-group luas">
                        <label class="col-sm-3 control-label">Target Penyelesaian</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="target_penyelesaian" class="form-control tanggal"  />
                        </div>
                    </div>

                    <div class="form-group mt-lg nama_target">
                        <label class="col-sm-3 control-label">Status Proses Induk<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" name="status" required>
                                <option value="">Pilih status</option>
                                <option value="belum">Belum</option>
                                <option value="terbit">Terbit</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group keterangan">
                        <label class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea rows="2" class="form-control" name="keterangan"></textarea>
                        </div>
                    </div>

                    <div class="row" style="overflow-x: auto;white-space: nowrap;">
                        <div class="col-md-12">
                            <h3>Rincian Item Yang Dibeli</h3>
                            <a type="button" class="mb-xs mt-xs mr-xs btn btn-primary" id="tambahItem"><i class="fa fa-plus"></i> Tambah Item</a>
                            <div class="table-ressplitsingnsive" style="max-height:420px;">
                                <table class="table table-bordered table-hover table-striped dataTable no-footer listitem">
                                    <thead>
                                        <tr>
                                            <th style="min-width:200px;">Kode Tanah</th>
                                            <th style="min-width:200px;">Nama Penjual</th>
                                            <th style="min-width:400px;">NO Gambar</th>
                                            <th style="min-width:100px;">No PBB</th>
                                            <th style="min-width:100px;">Tanggal Proses</th>
                                            <th style="min-width:100px;">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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
<div class="modal fade bd-example-modal-lg" id="detailData"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="row">
                        <div class="col-md-3 text-left">
                            <h2 class="panel-title">Evaluasi Proses</h2>
                        </div>
                        <div class="col-md-9 text-right">
                            <a class="btn btn-success" id="linkprint" target="_blank"><i class="fa fa-print"></i> Print</a>
                            <a class="btn btn-success" id="linkpdf" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
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
<div class="modal fade bd-example-modal-lg" id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
          <section class="panel panel-primary">
            <?php echo form_open('laporan/prosesindukedit', ' id="FormulirEdit"  enctype="multipart/form-data"'); ?>
            <input type="hidden" name="idd" id="idd">
            <header class="panel-heading">
                <h2 class="panel-title">Edit Data Tanah/Aset</h2>
            </header>
            <div class="panel-body">

             <div class="form-group Penjual">
                <label class="col-sm-3 control-label">Penjual</span></label>
                <div class="col-sm-9">
                    <input type="text" name="penjual" id="penjual" class="form-control"  required />
                    <input type="hidden" name="id_perumahan" id="id_perumahan" value="<?php echo $id_perumahan ?>" class="form-control"  required />
                </div>
            </div>
            <div class="form-group no_gambar2">
                <label class="col-sm-3 control-label">No Gambar</span></label>
                <div class="col-sm-9">
                    <input type="text" name="no_gambar2" id="no_gambar2" class="form-control"  required />
                </div>
            </div>
            <div class="form-group no_surat_tanah">
                <label class="col-sm-3 control-label">No Surat</span></label>
                <div class="col-sm-9">
                    <input type="text" name="no_surat_tanah" id="no_surat_tanah" class="form-control"  required />
                </div>
            </div>
            <div class="form-group nama_surat_tanah">
                <label class="col-sm-3 control-label">Atas Nama</span></label>
                <div class="col-sm-9">
                    <input type="text" name="nama_surat_tanah" id="nama_surat_tanah" class="form-control"  required />
                </div>
            </div>
            <div class="form-group luas">
                <label class="col-sm-3 control-label">Luas (m2)</span></label>
                <div class="col-sm-9">
                    <input type="text" name="luas" id="luas" class="form-control"  />
                </div>
            </div>
            <div class="form-group tanggal_pengalihan">
                <label class="col-sm-3 control-label"> Detail Luas </span></label>
                <div class="col-sm-4">
                    <input type="text" name="luas_daftar" id="luas_daftar" style="color: grey; text-align: center;vertical-align: middle;" class="form-control" placeholder="Luas Daftar" title="Luas Daftar" required />
                </div>
                <div class="col-sm-5">
                    <input type="text" name="luas_terbit" id="luas_terbit" class="form-control" placeholder="Luas Terbit" required />
                </div>
            </div>

            <div class="form-group tanggal_pengalihan">
                <label class="col-sm-3 control-label"> Detail Daftar SK </span></label>
                <div class="col-sm-4">
                    <input type="text" name="tanggal_daftar_sk_hak" id="tanggal_daftar_sk_hak" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Daftar SK Hak" title="Tanggal Daftar SK Hak" />
                </div>
                <div class="col-sm-5">
                    <input type="text" name="no_daftar_sk_hak" id="no_daftar_sk_hak" class="form-control" placeholder="No Daftar SK Hak" />
                </div>
            </div>

            <div class="form-group tanggal_pengalihan">
                <label class="col-sm-3 control-label"> Detail Terbit SK </span></label>
                <div class="col-sm-4">
                    <input type="text" name="tanggal_terbit_sk_hak" id="tanggal_terbit_sk_hak" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Terbit SK Hak" title="Tanggal Terbit SK Hak"  />
                </div>
                <div class="col-sm-5">
                    <input type="text" name="no_terbit_sk_hak" id="no_terbit_sk_hak" class="form-control" placeholder="No Terbit SK Hak"  />
                </div>
            </div>

            <div class="form-group tanggal_pengalihan">
                <label class="col-sm-3 control-label"> Detail Daftar SHGB </span></label>
                <div class="col-sm-4">
                    <input type="text" name="tanggal_daftar_shgb" id="tanggal_daftar_shgb" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Daftar SHGB" title="Tanggal Daftar SHGB"  />
                </div>
                <div class="col-sm-5">
                    <input type="text" name="no_daftar_shgb" id="no_daftar_shgb" class="form-control" placeholder="No Daftar SHGB"  />
                </div>
            </div>

            <div class="form-group tanggal_pengalihan">
                <label class="col-sm-3 control-label"> Detail Terbit SHGB </span></label>
                <div class="col-sm-3">
                    <input type="text" name="tanggal_terbit_shgb" id="tanggal_terbit_shgb" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Terbit SHGB" title="Tanggal Terbit SHGB"  />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="no_terbit_shgb" id="no_terbit_shgb" class="form-control" placeholder="No Terbit SHGB"  />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="masa_berlaku_shgb" id="masa_berlaku_shgb" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Masa Berlaku SHGB" title="Masa Berlaku SHGB"  />
                </div>
            </div>

            <div class="form-group luas">
                <label class="col-sm-3 control-label">Target Penyelesaian</span></label>
                <div class="col-sm-9">
                    <input type="text" name="target_penyelesaian" id="target_penyelesaian" class="form-control tanggal"  />
                </div>
            </div>

            <div class="form-group mt-lg nama_target">
                <label class="col-sm-3 control-label">Status Proses Induk<span class="required">*</span></label>
                <div class="col-sm-9">
                    <select data-plugin-selectTwo class="form-control" id="status" name="status" required>
                        <option value="">Pilih status</option>
                        <option value="belum">Belum</option>
                        <option value="terbit">Terbit</option>
                    </select>
                </div>
            </div>
            <div class="form-group keterangan">
                <label class="col-sm-3 control-label">Keterangan</label>
                <div class="col-sm-9">
                    <textarea rows="2" class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>
            </div>
            <div class="row" style="overflow-x: auto;white-space: nowrap;">
                <div class="col-md-12">
                    <h3>Rincian Item Yang Dibeli</h3>
                    <a type="button" class="mb-xs mt-xs mr-xs btn btn-primary" id="tambahItemedit"><i class="fa fa-plus"></i> Tambah Item</a>
                    <div class="table-ressplitsingnsive" style="max-height:420px;">
                        <table class="table table-bordered table-hover table-striped dataTable no-footer listitemedit">
                            <thead>
                                <tr>
                                    <th style="min-width:200px;">Kode Tanah</th>
                                    <th style="min-width:200px;">Nama Penjual</th>
                                    <th style="min-width:400px;">NO Gambar</th>
                                    <th style="min-width:100px;">No PBB</th>
                                    <th style="min-width:100px;">Tanggal Proses</th>
                                    <th style="min-width:100px;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
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


<div class="modal fade bd-example-modal-lg" id="modal-listitems" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <section class="panel">
        <header class="panel-heading">
          <h2 class="panel-title">Data Item</h2>
      </header>
      <div class="panel-body">
          <table class="table table-bordered table-hover table-striped data" id="itemsdata">
            <thead>
              <tr>
                <th>Kode Item</th>
                <th>Nama Item</th>
                <th>Lokasi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <?php echo form_open('laporan/hapusdataprosesinduk', ' id="FormulirHapus"'); ?>
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
	$(document).ready(function(){
        refresh();
    });
  $('.tanggal').datepicker({
    format: 'yyyy-mm-dd' ,
    autoClose:true
});
</script>
<script type="text/javascript">

    tableitems();
    function tableitems() {
        $('#itemsdata').DataTable({
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo base_url() ?>master/pilihanitem",
                    "type": "GET",
                    "data": function(data) {
                        data.id_perumahan = '<?php echo $id_perumahan ?>'
                  }
              },
              "columnDefs": [
              {
                "targets": [ 3 ],
                "orderable": false,
            },
            ],
        });
    }


    function laporan_ringkas(){
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>pembelian/po_data',
            dataType    : 'json',
            success: function(response) {
                $.each(response, function(i, item) {
                    $('#po_bulan_ini').html(item.po_bulan);
                    $('#po_minggu_ini').html(item.po_minggu);
                    $('#po_hari_ini').html(item.po_hari);
                });
            }
        });
        return false;
    }
    //laporan_ringkas();
    function detail(elem){
        var dataId = $(elem).data("id");
        $('#detailData').modal();
        $('#showdetail').html('Loading...');
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>laporan/proses_indukdetailsplit',
            data: 'id=' + dataId,
            dataType    : 'json',
            success: function(response) {
                var datarow='<div class="row">';
                $.each(response.datarows, function(i, item) {
                    document.getElementById('linkprint').setAttribute('href', '<?php echo base_url() ?>pembelian/printpo/'+item.nomor_po);
                    document.getElementById('linkpdf').setAttribute('href', '<?php echo base_url() ?>pembelian/pdfpo/'+item.nomor_po);

                    datarow+='<div class="col-md-6">';
                    datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
                    datarow+="<tr><td>Tanggal Daftar SK</td><td>: "+item.tanggal_daftar_sk_hak+"</td></tr>";
                    datarow+="<tr><td>No Daftar SK </td><td>: "+item.no_daftar_sk_hak+"</td></tr>";
                    datarow+="<tr><td>Nama Surat</td><td>: "+item.nama_surat_tanah+"</td></tr>";
                    datarow+="</table>";
                    datarow+='</div>';
                    datarow+='<div class="col-md-6">';
                    datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
                    datarow+="<tr><td>Nomor Gambar</td><td>: "+item.no_gambar+"</td></tr>";
                    datarow+="<tr><td>luas</td><td>: "+item.luas+"</td></tr>";
                    datarow+="</table>";
                    datarow+='</div>';
                });
                datarow+='</div>';
                datarow+='<div class="row"><div class="col-md-12">';
                datarow+='<h3>Rincian</h3>';
                datarow+='<div class="table-responsive" style="max-height:420px;">';
                datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
                datarow+="<thead><tr>";
                datarow+="<th>ID Item</th>";
                datarow+="<th>Tgl Proses</th>";
                datarow+="<th>Keterangan</th>";
                datarow+="</tr></thead>";
                datarow+="<tbody>";

                $.each(response.datasub, function(i, itemsub) {
                    datarow+="<tr>";
                    datarow+="<td>"+itemsub.id_master_item+"</td>";
                    datarow+="<td>"+itemsub.tgl_proses_induk+"</td>";
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

    $(document).on('shown.bs.modal','#modal-listitems', function (e) {
        var urutan = $(e.relatedTarget).data('urutan');
        createCookie("urutan-row-item", urutan, 30);

        // tableitems();
    });
    function pilihitem(elem){
        urutan = readCookie("urutan-row-item");
        var nama_regional = $(elem).data("nama_regional");
        var no_gambar = $(elem).data("no_gambar");
        var no_pbb = $(elem).data("no_pbb");
        var keterangan = $(elem).data("keterangan");
        var kode_item = $(elem).data("kode_item");
        var nama_penjual = $(elem).data("nama_penjual");
        $('.kode_item'+urutan).val(kode_item);
        $('.no_gambar'+urutan).val(no_gambar);
        $('.no_pbb'+urutan).val(no_pbb);
        $('.keterangandetail'+urutan).val(keterangan);
        $('.nama_penjual'+urutan).val(nama_penjual);
        $('#modal-listitems').modal('hide');
        eraseCookie("urutan-row-item");
    }

    document.getElementById("FormulirTambah").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform").setAttribute('disabled','disabled');
        $('#submitform').html('Loading ...');
        var form = $('#FormulirTambah')[0];
        var formData = new FormData(form);
        var xhrAjax = $.ajax({
            type        : 'POST',
            url         : $(this).attr('action'),
            data        : formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType    : 'json'
        }).done(function(data) {
            if ( ! data.success) {
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
                    if(key == 'jumlah_obat'){
                        alert(data.errors[key]);
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
                refresh();
                //laporan_ringkas();
                document.getElementById("submitform").removeAttribute('disabled');
                document.getElementById("FormulirTambah").reset();
                $('#submitform').html('Submit');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                $('#tambahData').modal('hide');
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

    var max_fields      = 1000;
    var wrapperItem     = $(".listitem");
    var add_button_mg   = $("#tambahItem");
    var x = 0;
    $(add_button_mg).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x=x+1;
            var formtambah='<tr>';
            formtambah+='<td><div class="input-group input-group-icon" style="width:150px;"><input type="text" data-urutan="'+x+'" data-toggle="modal" data-target="#modal-listitems"  class="form-control kode_item'+x+'" placeholder="Pilih Item"><span class="input-group-addon"><span class="icon"><i class="fa fa-search"></i></span></span></div></td>';
            formtambah+='<input type="hidden" class="kode_item'+x+'" name="kode_item[]">';
            formtambah+='<td> <input type="text" name="nama_penjual[]" class="form-control nama_penjual'+x+' required"></td>';
            formtambah+='<td><input type="text" name="no_gambar[]" size="3" class="form-control no_gambar'+x+' required"></td>';
            formtambah+='<td><input type="text" name="no_pbb[]" size="3" class="form-control no_pbb'+x+'" required></td>';
            formtambah+='<td><input type="text" name="tgl_proses_induk[]" class="form-control tanggal" required></td>';
            formtambah+='<td><input type="text" name="keterangandetail[]" class="form-control keterangandetail'+x+' required"></td>';
            formtambah+='<td><a href="javascript:void(0);" class="mb-xs mt-xs mr-xs btn btn-danger deleterow"><i class="fa fa-trash-o"></i></a></td></tr>';
            $(wrapperItem).append(formtambah);
            $('.tanggal').datepicker({
                format: 'yyyy-mm-dd'
            });
        }
        else
        {
            document.getElementById("tambahItem").setAttribute('disabled','disabled');
            alert('Maksimal '+max_fields+' form')
        }
    });
    $(wrapperItem).on("click",".deleterow", function(e){
        e.preventDefault(); $(this).parent().parent().remove();
        document.getElementById("tambahItem").removeAttribute('disabled');
    })

    var x = 0;
    function edit(elem){
        var dataId = $(elem).data("id");
        document.getElementById("idd").setAttribute('value', dataId);
        $(".listitemedit").find("tr:not(:first)").remove();
        $('#editData').modal();
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>laporan/prosesindukdetail',
            data: 'id=' + dataId,
            dataType    : 'json',
            success: function(response) {
                $.each(response.datarows, function(i, item) {
                    document.getElementById("penjual").value = item.penjual;
                    document.getElementById("no_gambar2").value = item.no_gambar;
                    document.getElementById("nama_surat_tanah").value = item.nama_surat_tanah;
                    document.getElementById("no_surat_tanah").value = item.no_surat_tanah;
                    document.getElementById("luas").value = item.luas;
                    document.getElementById("luas_daftar").value = item.luas_daftar;
                    document.getElementById("luas_terbit").value = item.luas_terbit;
                    document.getElementById("tanggal_daftar_sk_hak").value = item.tanggal_daftar_sk_haktampil;
                    document.getElementById("no_daftar_sk_hak").value = item.no_daftar_sk_hak;
                    document.getElementById("tanggal_terbit_sk_hak").value = item.tanggal_terbit_sk_haktampil;
                    document.getElementById("no_terbit_sk_hak").value = item.no_terbit_sk_hak;
                    document.getElementById("tanggal_daftar_shgb").value = item.tanggal_daftar_shgbtampil;
                    document.getElementById("no_daftar_shgb").value = item.no_daftar_shgb;
                    document.getElementById("tanggal_terbit_shgb").value = item.tanggal_terbit_shgbtampil;
                    document.getElementById("no_terbit_shgb").value = item.no_terbit_shgb;
                    document.getElementById("target_penyelesaian").value = item.target_penyelesaiantampil;
                    document.getElementById("keterangan").value = item.keterangan;
                    $("#status").select2("val", item.status);

                });

                var datarow='';
                $.each(response.datasub, function(i, itemsub) {
                    x= x + 1;
                    datarow+='<tr><td><div class="input-group input-group-icon" style="width:150px;"><input type="text" data-urutan="'+x+'" data-toggle="modal" data-target="#modal-listitems" value="'+itemsub.id_master_item+'" name="kode_item[]"  class="form-control kode_item'+x+'" placeholder="Pilih Item"><span class="input-group-addon"><span class="icon"><i class="fa fa-search"></i></span></span></div></td>';
                    datarow+='<input type="hidden" value="'+itemsub.id_dtl_proses_induk+'" class="id_dtl_proses_induk'+x+'" name="id_dtl_proses_induk[]">';
                    datarow+='<td><input type="text" value="'+itemsub.nama_penjual+'"  class="form-control nama_penjual'+x+'"></td>';
                    datarow+='<td><input type="text" value="'+itemsub.no_gambar+'"  class="form-control no_gambar'+x+'"></td>';
                    datarow+='<td><input type="text"  value="'+itemsub.no_pbb+'"  name="no_pbb[]"  class="form-control no_pbb'+x+'"></td>';
                    datarow+='<td><input type="text"  value="'+itemsub.tgl_proses_induk+'"  name="tgl_proses_induk[]" class="form-control tanggal"></td>';
                    datarow+='<td><input type="text"  value="'+itemsub.keterangan+'"  name="keterangandetail[]" class="form-control keterangandetail'+x+'"></td>';
                    datarow+='<td><a href="javascript:void(0);" class="mb-xs mt-xs mr-xs btn btn-danger deleterowedit"><i class="fa fa-trash-o"></i></a></td></tr>';
                });
                $('.listitemedit').append(datarow);
                $('.mask_priceedit').maskMoney();
                $('.tgl_expirededit').datepicker({
                    format: 'yyyy-mm-dd'
                });

            }
        });
        return false;
    }

    var max_fieldsEdit      = 1000;
    var wrapperItemEdit     = $(".listitemedit");
    var add_button_mgEdit   = $("#tambahItemedit");
    var x = 0;
    $(add_button_mgEdit).click(function(e){
        e.preventDefault();
        if(x < max_fieldsEdit){
           x=x+1;
           var formtambah='<tr>';
           formtambah+='<td><div class="input-group input-group-icon" style="width:150px;"><input type="text" data-urutan="'+x+'" data-toggle="modal" data-target="#modal-listitems"  class="form-control kode_item'+x+'" placeholder="Pilih Item"><span class="input-group-addon"><span class="icon"><i class="fa fa-search"></i></span></span></div></td>';
           formtambah+='<input type="hidden" class="kode_item'+x+'" name="kode_item[]">';
           formtambah+='<td> <input type="text" name="nama_penjual[]" class="form-control nama_penjual'+x+' required"></td>';
           formtambah+='<td><input type="text" name="no_gambar[]" size="3" class="form-control no_gambar'+x+' required"></td>';
           formtambah+='<td><input type="text" name="no_pbb[]" size="3" class="form-control no_pbb'+x+'" required></td>';
           formtambah+='<td><input type="text" name="tgl_proses_induk[]" class="form-control tanggal" required></td>';
           formtambah+='<td><input type="text" name="keterangandetail[]" class="form-control keterangandetail'+x+' required"></td>';
           formtambah+='<td><a href="javascript:void(0);" class="mb-xs mt-xs mr-xs btn btn-danger deleterow"><i class="fa fa-trash-o"></i></a></td></tr>';
           $(wrapperItemEdit).append(formtambah);
           $('.tanggal').datepicker({
            format: 'yyyy-mm-dd'
        });
       }
       else
       {
        document.getElementById("tambahItemedit").setAttribute('disabled','disabled');
        alert('Maksimal '+max_fields+' form')
    }
});
    $(wrapperItemEdit).on("click",".deleterowedit", function(e){
        e.preventDefault(); $(this).parent().parent().remove();
        document.getElementById("tambahItemedit").removeAttribute('disabled');
    })
    document.getElementById("FormulirEdit").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformEdit").setAttribute('disabled','disabled');
        $('#submitformEdit').html('Loading ...');
        var form = $('#FormulirEdit')[0];
        var formData = new FormData(form);
        var xhrAjax = $.ajax({
            type        : 'POST',
            url         : $(this).attr('action'),
            data        : formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType    : 'json'
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
                    if(key == 'jumlah_obat'){
                        alert(data.errors[key]);
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
                refresh();
                //laporan_ringkas();
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
            type        : 'POST',
            url         : $(this).attr('action'),
            data        : formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType    : 'json'
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
                refresh();
                //laporan_ringkas();
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


    $(document).on('hidden.bs.modal', '.modal', function () {
        $('.modal:visible').length && $(document.body).addClass('modal-open');
    });
    function refresh() {

        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>laporan/pageevaluasiprosesinduk/'+'<?php echo $id_perumahan ?>',
            data: 'id_perumahan=<?php echo $id_perumahan ?>',
            success: function (html) {
                $('#kontendata').html(html);
            }
        });
    }
</script>
</script>
</body>
</html>