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
          <h2>Evaluasi Pembelian Tanah</h2>
      </header>
      <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6" align="left"><h2 class="panel-title">Evaluasi Pembelian Tanah </h2></div>

        </div>
            <div class="form-group mt-lg" >
      <form action="" method="get">

            <div class="row" style="width: 100%; padding: 4px;margin-left: 0%;">
                <label class="col-sm-1 control-label">Lokasi<span class="required">*</span></label>

                <div class="col-sm-4">
                   <div class="form-group nama_target">
                    <select data-plugin-selectTwo class="form-control" onchange="refresh()" required id="id_perumahan" name="id_perumahan">
                        <option value="">Semua Lokasi</option>
                        <?php foreach ($perumahan as $aa): ?>
                            <option value="<?php echo $aa->id; ?>"><?php echo $aa->nama_regional; ?> ( <?php echo $aa->nama_status; ?> )</option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <label class="col-sm-1 control-label">Periode<span class="required">*</span></label>

            <div class="col-sm-2">
                <input type="text" name="firstdate" id="firstdate" class="form-control tanggal" onchange="refresh()" value="<?php echo $firstdate ?>" data-plugin-datepicker required/>
            </div>
            <div class="col-sm-2">
                <input type="text" name="lastdate" id="lastdate" class="form-control tanggal" onchange="refresh()" value="<?php echo $lastdate ?>" data-plugin-datepicker required/>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-primary" href="<?php echo site_url('Export_excel/excel_laporan1_evaluasi_pembelian_detail/') . $firstdate . '/' . $lastdate ?>">   <i class="fa fa-print"></i>cetak </a>
            </div>
        </div>

</form>
 </div>
    </header>
      <!-- start: page -->

<div id="kontendata"></div>
</section>
</div>
</section>



<!--<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <section class="panel panel-primary">-->
<!--                <?php echo form_open('master/itemstambah', ' id="FormulirTambah" enctype="multipart/form-data"'); ?>  -->
<!--                <header class="panel-heading">-->
<!--                    <h2 class="panel-title">Tambah Item</h2>-->
<!--                </header>-->
<!--                <div class="panel-body">-->


<!--                    <div class="form-group mt-lg nama_target">-->
<!--                        <label class="col-sm-3 control-label">Lokasi<span class="required">*</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <select data-plugin-selectTwo class="form-control" required name="id_perumahan">  -->
<!--                                <option value="">Pilih Lokasi</option>-->
<!--                                <?php foreach ($perumahan2 as $aa): ?>-->
<!--                                    <option value="<?php echo $aa->id; ?>"><?php echo $aa->nama_regional; ?></option>-->
<!--                                <?php endforeach;?>-->
<!--                            </select> -->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group mt-lg nama_item">-->
<!--                        <label class="col-sm-3 control-label">Nama Tanah<span class="required">*</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="nama_item" class="form-control" required/>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group tanggal_pembelian">-->
<!--                        <label class="col-sm-3 control-label">Tanggal Pembelian</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="tanggal_pembelian" class="form-control tanggal"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group nama_penjual">-->
<!--                        <label class="col-sm-3 control-label">Data Surat Tanah</span></label>-->
<!--                        <div class="col-sm-4">-->
<!--                            <input type="text" name="nama_penjual" class="form-control" placeholder="Nama Penjual"  />-->
<!--                        </div>-->
<!--                        <div class="col-sm-5">-->
<!--                            <select data-plugin-selectTwo class="form-control" required name="status_surat_tanah">  -->
<!--                                <option value="">Pilih Jenis</option>-->
<!--                                <?php foreach ($sertifikat_tanah as $aa): ?>-->
<!--                                    <option value="<?php echo $aa->id_sertifikat_tanah; ?>"><?php echo $aa->kode_sertifikat; ?> / <?php echo $aa->nama_sertifikat; ?></option>-->
<!--                                <?php endforeach;?>-->
<!--                            </select> -->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group nama_surat_tanah">-->
<!--                        <label class="col-sm-3 control-label">Nama Surat</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="nama_surat_tanah" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group no_gambar">-->
<!--                        <label class="col-sm-3 control-label">No Gambar</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="no_gambar" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group jumlah_bidang">-->
<!--                        <label class="col-sm-3 control-label">Jumlah Bidang</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="jumlah_bidang" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group luas_surat">-->
<!--                        <label class="col-sm-3 control-label">Luas (m2)</span></label>-->
<!--                        <div class="col-sm-5">-->
<!--                            <input type="number" name="luas_surat" class="form-control" placeholder="Luas surat"  />-->
<!--                        </div>-->
<!--                        <div class="col-sm-4">-->
<!--                            <input type="number" name="luas_ukur" class="form-control"  placeholder="Luas Ukur" />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group no_pbb">-->
<!--                        <label class="col-sm-3 control-label">PBB</span></label>-->
<!--                        <div class="col-sm-3">-->
<!--                            <input type="text" name="no_pbb" class="form-control" placeholder="No PBB"  />-->
<!--                        </div>-->
<!--                        <div class="col-sm-2">-->
<!--                            <input type="text" name="luas_pbb_bangunan" class="form-control" placeholder="Luas PBB (m2)"  />-->
<!--                        </div>-->
<!--                        <div class="col-sm-3">-->
<!--                            <input type="text" name="njop_bangunan" class="form-control" placeholder="njop_bangunan" />-->
<!--                        </div>-->

<!--                    </div>-->
<!--                    <div class="form-group satuan_harga_pengalihan">-->
<!--                        <label class="col-sm-3 control-label">Harga Pengalihan Hak</span></label>-->

<!--                        <div class="col-sm-4">-->
<!--                            <input type="text" name="total_harga_pengalihan" class="form-control" placeholder="Total Harga Pengalihan" />-->
<!--                        </div>-->
<!--                    </div><div class="form-group nama_makelar">-->
<!--                        <label class="col-sm-3 control-label">Makelar</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="nama_makelar" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group nilai">-->
<!--                        <label class="col-sm-3 control-label">Nilai</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="nilai" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group tanggal_pengalihan">-->
<!--                        <label class="col-sm-3 control-label"> Detail Pengalihan </span></label>-->
<!--                        <div class="col-sm-3">-->
<!--                            <input type="text" name="tanggal_pengalihan" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Pengalihan" title="Tanggal Pengalihan"  />-->
<!--                        </div>-->
<!--                        <div class="col-sm-2">-->
<!--                            <input type="text" name="akta_pengalihan" class="form-control" placeholder="Akta"  />-->
<!--                        </div>-->
<!--                        <div class="col-sm-4">-->
<!--                            <input type="text" name="nama_pengalihan" class="form-control" placeholder="Nama Pengalihan" />-->
<!--                        </div>-->
<!--                    </div><div class="form-group pematangan">-->
<!--                        <label class="col-sm-3 control-label">Pematangan</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="pematangan" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group ganti_rugi">-->
<!--                        <label class="col-sm-3 control-label">Ganti Rugi</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="ganti_rugi" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group pbb">-->
<!--                        <label class="col-sm-3 control-label">PBB</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="pbb" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group lain">-->
<!--                        <label class="col-sm-3 control-label">Lain-lain</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="lain" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group harga_perm">-->
<!--                        <label class="col-sm-3 control-label"></span>Harga / M^2</label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="harga_perm" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group keterangan">-->
<!--                        <label class="col-sm-3 control-label">Keterangan</label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <textarea rows="2" class="form-control" name="keterangan"></textarea>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <footer class="panel-footer">-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12 text-right">-->
<!--                            <button class="btn btn-primary modal-confirm" type="submit" id="submitform">Submit</button>-->
<!--                            <button class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </footer>-->
<!--            </form>-->
<!--        </section>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->

<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="detailData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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

<!--<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="detailData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <section class="panel panel-primary">   -->
<!--                <header class="panel-heading">-->
<!--                    <h2 class="panel-title">Detail Tanah / Asset</h2>-->
<!--                </header>-->
<!--                <div class="panel-body" id="showdetail"> -->
<!--                </div>-->
<!--                <footer class="panel-footer">-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12 text-right">-->
<!--                            <button class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </footer> -->
<!--            </section>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog">-->
<!--        <div class="modal-content">-->
<!--            <section class="panel panel-primary">-->
<!--                <?php echo form_open('master/itemsedit', ' id="FormulirEdit"  enctype="multipart/form-data"'); ?>  -->
<!--                <input type="hidden" name="idd" id="idd">-->
<!--                <header class="panel-heading">-->
<!--                    <h2 class="panel-title">Edit Data Tanah/Aset</h2>-->
<!--                </header>-->
<!--                <div class="panel-body">-->

<!--                    <div class="form-group mt-lg nama_target">-->
<!--                        <label class="col-sm-3 control-label">Lokasi<span class="required">*</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <select data-plugin-selectTwo class="form-control" required id="id_perumahan" name="id_perumahan">  -->
<!--                                <option value="">Pilih Lokasi</option>-->
<!--                                <?php foreach ($perumahan2 as $supp): ?>-->
<!--                                    <option value="<?php echo $aa->id; ?>"><?php echo $aa->nama_regional; ?> ( <?php echo $aa->nama_status; ?> )</option>-->
<!--                                <?php endforeach;?>-->
<!--                            </select> -->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group mt-lg nama_item">-->
<!--                        <label class="col-sm-3 control-label">Nama tanah<span class="required">*</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="nama_item" id="nama_item" class="form-control" required/>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group tanggal_pembelian">-->
<!--                        <label class="col-sm-3 control-label">Tanggal Pembelian</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control tanggal"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group nama_penjual">-->
<!--                        <label class="col-sm-3 control-label">Nama Penjual</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="nama_penjual" id="nama_penjual" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group nama_surat_tanah">-->
<!--                        <label class="col-sm-3 control-label">Nama Surat</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="nama_surat_tanah" id="nama_surat_tanah" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group mt-lg nama_target">-->
<!--                        <label class="col-sm-3 control-label">Sertifikat<span class="required">*</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <select data-plugin-selectTwo class="form-control" required name="status_surat_tanah" id="status_surat_tanah">  -->
<!--                                <option value="">Pilih Lokasi</option>-->
<!--                                <?php foreach ($sertifikat_tanah as $aa): ?>-->
<!--                                    <option value="<?php echo $aa->id_sertifikat_tanah; ?>"><?php echo $aa->nama_sertifikat; ?> / <?php echo $aa->nama_sertifikat; ?></option>-->
<!--                                <?php endforeach;?>-->
<!--                            </select> -->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group no_gambar">-->
<!--                        <label class="col-sm-3 control-label">No Gambar</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="no_gambar" id="no_gambar" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group jumlah_bidang">-->
<!--                        <label class="col-sm-3 control-label">Jumlah Bidang</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="jumlah_bidang" id="jumlah_bidang" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group luas_surat">-->
<!--                        <label class="col-sm-3 control-label">Luas Surat</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="luas_surat" id="luas_surat" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group luas_ukur">-->
<!--                        <label class="col-sm-3 control-label">Luas Ukur</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="luas_ukur" id="luas_ukur" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group no_pbb">-->
<!--                        <label class="col-sm-3 control-label">No PBB</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="no_pbb" id="no_pbb" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group luas_pbb_bangunan">-->
<!--                        <label class="col-sm-3 control-label">Luas PBB</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="luas_pbb_bangunan" id="luas_pbb_bangunan" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group njop_bangunan">-->
<!--                        <label class="col-sm-3 control-label">njop_bangunan</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="njop_bangunan" id="njop_bangunan" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group total_harga_pengalihan">-->
<!--                        <label class="col-sm-3 control-label">Total Harga Pengalihan</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="total_harga_pengalihan" id="total_harga_pengalihan" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group nama_makelar">-->
<!--                        <label class="col-sm-3 control-label">Makelar</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="nama_makelar" id="nama_makelar" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group nilai">-->
<!--                        <label class="col-sm-3 control-label">Nilai</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="nilai" id="nilai" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group tanggal_pengalihan">-->
<!--                        <label class="col-sm-3 control-label">Tanggal Pengalihan</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="tanggal_pengalihan" id="tanggal_pengalihan" class="form-control tanggal"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group akta_pengalihan">-->
<!--                        <label class="col-sm-3 control-label">Akta Pengalihan</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="akta_pengalihan" id="akta_pengalihan" class="form-control" />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group nama_pengalihan">-->
<!--                        <label class="col-sm-3 control-label">Nama Pengalihan</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="nama_pengalihan" id="nama_pengalihan" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group pematangan">-->
<!--                        <label class="col-sm-3 control-label">Pematangan</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="pematangan" id="pematangan" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group ganti_rugi">-->
<!--                        <label class="col-sm-3 control-label">Ganti Rugi</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="ganti_rugi" id="ganti_rugi" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group pbb">-->
<!--                        <label class="col-sm-3 control-label">PBB</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="pbb" id="pbb" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group lain">-->
<!--                        <label class="col-sm-3 control-label">Lain-lain</span></label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="lain" id="lain" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div><div class="form-group harga_perm">-->
<!--                        <label class="col-sm-3 control-label"></span>Harga / M^2</label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <input type="text" name="harga_perm" id="harga_perm" class="form-control"  />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group keterangan">-->
<!--                        <label class="col-sm-3 control-label">Keterangan</label>-->
<!--                        <div class="col-sm-9">-->
<!--                            <textarea rows="2" class="form-control" name="keterangan" id="keterangan"></textarea>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                </div>-->
<!--                <footer class="panel-footer">-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12 text-right">-->
<!--                            <button class="btn btn-primary modal-confirm" type="submit" id="submitformEdit">Submit</button>-->
<!--                            <button class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </footer>-->
<!--            </form>-->
<!--        </section>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->

<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('master/itemsedit', ' id="FormulirEdit"  enctype="multipart/form-data"'); ?>
                <input type="hidden" name="idd" id="idd">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Data Tanah/Aset</h2>
                </header>
                <div class="panel-body">
                   <div class="form-group mt-lg nama_target">
                    <label class="col-sm-3 control-label">Lokasi<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <select data-plugin-selectTwo class="form-control" required id="id_perumahan" name="id_perumahan">
                            <option value="">Pilih Lokasi</option>
                            <?php foreach ($perumahan2 as $aa): ?>
                                <option value="<?php echo $aa->id; ?>"><?php echo $aa->nama_regional; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group mt-lg nama_item">
                    <label class="col-sm-3 control-label">Nama Penjual<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="nama_penjual" id="nama_penjual" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group tanggal_pembelian">
                    <label class="col-sm-3 control-label">Tanggal Pembelian</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control tanggal"  />
                    </div>
                </div>
                <div class="form-group tanggal_pembelian">
                    <label class="col-sm-3 control-label">Atas Nama Surat</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="nama_surat_tanah" id="nama_surat_tanah" class="form-control"  />
                    </div>
                </div>
                <div class="form-group nama_penjual">
                    <label class="col-sm-3 control-label">Data Surat Tanah 1</span></label>

                    <div class="col-sm-5">
                        <select data-plugin-selectTwo class="form-control" id="status_surat_tanah1" required name="status_surat_tanah1">
                            <option value="">Pilih Jenis</option>
                            <?php foreach ($sertifikat_tanah as $aa): ?>
                                <option value="<?php echo $aa->id_sertifikat_tanah; ?>"><?php echo $aa->kode_sertifikat; ?> / <?php echo $aa->nama_sertifikat; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="keterangan1" class="form-control" id="keterangan1" placeholder="keterangan 1"  />
                    </div>
                </div>
                <div class="form-group nama_penjual">
                    <label class="col-sm-3 control-label">Data Surat Tanah 2</span></label>

                    <div class="col-sm-5">
                        <select data-plugin-selectTwo class="form-control" required id="status_surat_tanah2" name="status_surat_tanah2">
                            <option value="">Pilih Jenis</option>
                            <?php foreach ($sertifikat_tanah as $aa): ?>
                                <option value="<?php echo $aa->id_sertifikat_tanah; ?>"><?php echo $aa->kode_sertifikat; ?> / <?php echo $aa->nama_sertifikat; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="keterangan2" id="keterangan2" class="form-control" placeholder="Keterangan 2"  />
                    </div>
                </div>
                <div class="form-group no_gambar">
                    <label class="col-sm-3 control-label">No Gambar</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="no_gambar" name="no_gambar" class="form-control"  />
                    </div>
                </div>
                <div class="form-group jumlah_bidang">
                    <label class="col-sm-3 control-label">Jumlah Bidang</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="jumlah_bidang" name="jumlah_bidang" class="form-control"  />
                    </div>
                </div>
                <div class="form-group luas_surat">
                    <label class="col-sm-3 control-label">Luas (m2)</span></label>
                    <div class="col-sm-5">
                        <input type="number" id="luas_surat" name="luas_surat" class="form-control" placeholder="Luas surat"  />
                    </div>
                    <div class="col-sm-4">
                        <input type="number" id="luas_ukur" name="luas_ukur" class="form-control"  placeholder="Luas Ukur" />
                    </div>
                </div>
                <div class="form-group no_pbb">
                    <label class="col-sm-3 control-label">PBB</span></label>
                    <div class="col-sm-4">
                        <input type="text" id="no_pbb" name="no_pbb" class="form-control" placeholder="PBB"  />
                    </div>
                    <div class="col-sm-4">
                        <input type="text" id="atas_nama_pbb" name="atas_nama_pbb" class="form-control" placeholder="Atas Nama PBB"  />
                    </div>
                </div>
                <div class="form-group no_pbb">
                    <label class="col-sm-3 control-label"></span></label>

                    <div class="col-sm-3">
                        <input type="text" id="luas_pbb_bangunan" name="luas_pbb_bangunan" class="form-control" placeholder="Luas Bangunan PBB (m2)"  />
                        <br>
                        <input type="text" id="luas_pbb_bumi" name="luas_pbb_bumi" class="form-control" placeholder="Luas Bumi PBB (m2)"  />
                    </div>
                    <div class="col-sm-3">
                        <input type="text" id="njop_bangunan" name="njop_bangunan" class="form-control" placeholder="NJOP Bangunan" />
                        <br>
                        <input type="text" id="njop_bumi" name="njop_bumi" class="form-control" placeholder="NJOP Bumi" />
                    </div>

                </div>
                <div class="form-group satuan_harga_pengalihan">
                    <label class="col-sm-3 control-label">Harga Pengalihan Hak</span></label>

                    <div class="col-sm-9">
                        <input type="text" id="total_harga_pengalihan" name="total_harga_pengalihan" class="form-control" placeholder="Total Harga Pengalihan" />
                    </div>
                </div><div class="form-group nama_makelar">
                    <label class="col-sm-3 control-label">Nama Makelar</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="nama_makelar" name="nama_makelar" class="form-control"  />
                    </div>
                </div><div class="form-group nilai">
                    <label class="col-sm-3 control-label">Nilai</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="nilai" name="nilai" class="form-control"  />
                    </div>
                </div>
                <div class="form-group nama_penjual">
                    <label class="col-sm-3 control-label">Jenis Pengalihan</span></label>

                    <div class="col-sm-5">
                        <select data-plugin-selectTwo class="form-control" required id="jenis_pengalihan" name="jenis_pengalihan">
                            <option value="">Pilih Jenis</option>
                            <?php foreach ($jenis_pengalihan as $aa): ?>
                                <option value="<?php echo $aa->id_pengalihan; ?>"><?php echo $aa->kode_pengalihan; ?> / <?php echo $aa->nama_pengalihan; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <!-- <div class="form-group tanggal_pengalihan">
                    <label class="col-sm-3 control-label"> Detail Pengalihan </span></label>
                    <div class="col-sm-3">
                        <input type="text" id="tanggal_pengalihan" name="tanggal_pengalihan" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Pengalihan" title="Tanggal Pengalihan"  />
                    </div>
                    <div class="col-sm-3">
                        <input type="text" id="akta_pengalihan" name="akta_pengalihan" class="form-control" placeholder="No Akta"  />
                    </div>
                    <div class="col-sm-3">
                        <input type="text" id="nama_pengalihan" name="nama_pengalihan" class="form-control" placeholder="Nama Pejabat" />
                    </div>
                </div> -->
                <!-- <div class="form-group ganti_rugi">
                    <label class="col-sm-3 control-label">Ganti Rugi</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="ganti_rugi" name="ganti_rugi" class="form-control mask_price"  />
                    </div>
                </div>
                <div class="form-group pbb">
                    <label class="col-sm-3 control-label">Biaya PBB</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="pbb" name="pbb" class="form-control mask_price"  />
                    </div>
                </div> -->
                <div class="form-group lain">
                    <label class="col-sm-3 control-label">Biaya Lain-lain</span></label>
                    <div class="col-sm-5">
                        <input type="text" id="lain" name="lain" class="form-control mask_price"  />
                    </div>
                    <div class="col-sm-4">
                        <textarea rows="2" class="form-control" name="keterangan_lain" id="keterangan_lain" placeholder="keterangan Lain-lain"></textarea>

                    </div>
                </div>
                <div class="form-group keterangan">
                    <label class="col-sm-3 control-label">Keterangan</label>
                    <div class="col-sm-9">
                        <textarea rows="2" id="keterangan" class="form-control" name="keterangan"></textarea>
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
                            <?php echo form_open('master/itemshapus', ' id="FormulirHapus"'); ?>
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
<div class="modal fade bd-example-modal-lg" id="detailpembayaran"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="row">
                        <div class="col-md-3 text-left">
                            <h2 class="panel-title">Detail Pembayaran</h2>
                        </div>
                        <div class="col-md-9 text-right">
                            <a class="btn btn-success" id="linkprint" target="_blank"><i class="fa fa-print"></i> Print</a>
                            <a class="btn btn-success" id="linkpdf" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
                            <a class="btn btn-success" id="btnbayar" target="_blank"><i class="fa fa-money"></i> Bayar</a>
                        </div>
                    </div>
                </header>
                <div class="panel-body" id="showdetailpembayaran">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Pembayaran</th>
                                <th>Tanggal pembayaran</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="Tbody">

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
     $('.data').DataTable();
 });
    $('.tanggal').datepicker({
        format: 'yyyy-mm-dd' ,
        autoClose:true
    });
    function refresh() {

        var firstdate = $('#firstdate').val();
        var lastdate = $('#lastdate').val();
        var id_perumahan = $('#id_perumahan').val();
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>Master/pageitem?',
            data: 'firstdate='+firstdate+'&lastdate='+lastdate+'&id_perumahan='+id_perumahan,
            success: function (html) {
                $('#kontendata').html(html);
            }
        });
    }
    function bayar(elem){
      var dataId = $(elem).data("id");
      $('#detailpembayaran').modal();
      $('#showdetailpembayaran').html('Loading...');
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url() ?>keuangan/keuangandetail',
        data: 'id=' + dataId,
        dataType    : 'json',
        success: function(response) {
          var datarow='<div class="row">';
          $.each(response.datarows, function(i, item) {
            // document.getElementById('linkprint').setAttribute('href', '<?php echo base_url() ?>pembelian/printpenerimaan/'+item.nomor_rec);
            // document.getElementById('linkpdf').setAttribute('href', '<?php echo base_url() ?>pembelian/pdfpenerimaan/'+item.nomor_rec);

            document.getElementById('btnbayar').setAttribute('href', '<?php echo base_url() ?>keuangan/bayar_tanah/'+item.kode_item);
            datarow+='<div class="col-md-6">';
            datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
            datarow+="<tr><td>Nama Penjual</td><td>: "+item.nama_penjual+"</td></tr>";
            datarow+="<tr><td>status_surat_tanah</td><td>: "+item.status_surat_tanah+"</td></tr>";
            datarow+="<tr><td>Tanggal Pembelian</td><td>: "+item.tanggal_pembelian+"</td></tr>";
            datarow+="</table>";
            datarow+='</div>';
            datarow+='<div class="col-md-6">';
            datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';

        // datarow+="<tr><td>Total Harga Item</td><td>: "+item.total_harga_item+"</td></tr>";
        // datarow+="<tr><td>Jenis Penjualan</td><td>: "+item.jenis_penjualan+"</td></tr>";
        datarow+="</table>";
        datarow+='</div>';
    });
          datarow+='</div>';
          datarow+='<div class="row"><div class="col-md-12">';
          datarow+='<h3>Rincian Pembayaran</h3>';
          datarow+='<div class="table-responsive" style="max-height:420px;">';
          datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';
          datarow+="<thead><tr>";
          datarow+="<th>Id Pembayaran</th>";
          datarow+="<th>Tanggal Pembayaran</th>";
          datarow+="<th>Total Bayar</th>";
          datarow+="</tr></thead>";
          datarow+="<tbody>";

          $.each(response.datasub, function(i, itemsub) {
            datarow+="<tr>";
            datarow+="<td>"+itemsub.id_pembayaran+"</td>";
            datarow+="<td>"+itemsub.tanggal_pembayaran+"</td>";
            datarow+="<td>"+itemsub.total_bayar+"</td>";
            datarow+="</tr>";
        });
          datarow+="</tbody>";
          datarow+="</table>";
          datarow+="</div>";
          datarow+='</div></div>';
          $('#showdetailpembayaran').html(datarow);
      }
  });
      return false;
  }



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
        tableitems.ajax.reload();
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


// function detail(elem){
//       var dataId = $(elem).data("id");
//       $('#detailData').modal();
//       $('#showdetail').html('Loading...');
//       $.ajax({
//         type: 'GET',
//         url: '<?php echo base_url() ?>master/itemdetail',
//         data: 'id=' + dataId,
//         dataType 	: 'json',
//         success: function(response) {
//             var datarow='';
//             $.each(response, function(i, item) {
//                 datarow+='<table class="table table-bordered table-hover table-striped dataTable no-footer">';

//                 datarow+="<tr><td>kode_item</td><td>: "+item.kode_item+"</td></tr>";
//                 datarow+="<tr><td>tanggal_pembelian</td><td>: "+item.tanggal_pembelian+"</td></tr>";
//                 datarow+="<tr><td>nama_penjual</td><td>: "+item.nama_penjual+"</td></tr>";
//                 datarow+="<tr><td>Atas Nama</td><td>: "+item.nama_surat_tanah+"</td></tr>";
//                 datarow+="<tr><td>Jenis Surat 1</td><td>: "+item.nama_sertifikat1+"</td></tr>";
//                 datarow+="<tr><td>Keterangan 1</td><td>: "+item.keterangan1+"</td></tr>";
//                 datarow+="<tr><td>Jenis Surat 2</td><td>: "+item.nama_sertifikat2+"</td></tr>";
//                 datarow+="<tr><td>Keterangan 2</td><td>: "+item.keterangan2+"</td></tr>";
//                 datarow+="<tr><td>no_gambar</td><td>: "+item.no_gambar+"</td></tr>";
//                 datarow+="<tr><td>jumlah_bidang</td><td>: "+item.jumlah_bidang+"</td></tr>";
//                 datarow+="<tr><td>luas_surat</td><td>: "+item.luas_surat+"</td></tr>";
//                 datarow+="<tr><td>luas_ukur</td><td>: "+item.luas_ukur+"</td></tr>";
//                 datarow+="<tr><td>no_pbb</td><td>: "+item.no_pbb+"</td></tr>";
//                 datarow+="<tr><td>luas_pbb_bangunan</td><td>: "+item.luas_pbb_bangunan+"</td></tr>";
//                 datarow+="<tr><td>njop_bangunan</td><td>: "+item.njop_bangunan+"</td></tr>";
//                 datarow+="<tr><td>luas_pbb_bumi</td><td>: "+item.luas_pbb_bumi+"</td></tr>";
//                 datarow+="<tr><td>njop_bumi</td><td>: "+item.njop_bumi+"</td></tr>";
//                 datarow+="<tr><td>satuan_harga_pengalihan</td><td>: "+item.satuan_harga_pengalihantampil+"</td></tr>";
//                 datarow+="<tr><td>total_harga_pengalihan</td><td>: "+item.total_harga_pengalihantampil+"</td></tr>";
//                 datarow+="<tr><td>nama_makelar</td><td>: "+item.nama_makelar+"</td></tr>";
//                 datarow+="<tr><td>nilai</td><td>: "+item.nilaitampil+"</td></tr>";
//                 datarow+="<tr><td>tanggal_pengalihan</td><td>: "+item.tanggal_pengalihan+"</td></tr>";
//                 datarow+="<tr><td>akta_pengalihan</td><td>: "+item.akta_pengalihan+"</td></tr>";
//                 datarow+="<tr><td>nama_pengalihan</td><td>: "+item.nama_pengalihan+"</td></tr>";
//                 datarow+="<tr><td>lain</td><td>: "+item.laintampil+"</td></tr>";
//                 datarow+="<tr><td>keterangan lain</td><td>: "+item.keterangan_lain+"</td></tr>";
//                 datarow+="<tr><td>harga_perm</td><td>: "+item.harga_permtampil+"</td></tr>";
//                 datarow+="<tr><td>keterangan</td><td>: "+item.keterangan+"</td></tr>";
//                 datarow+="<tr><td>Lokasi</td><td>: "+item.nama_regional+"</td></tr>";
//                 datarow+="</table>";
//             });
//             $('#showdetail').html(datarow);
//         }
//     });
//       return false;
//   }



  function edit(elem){
      var dataId = $(elem).data("id");
      document.getElementById("idd").setAttribute('value', dataId);
      $('#editData').modal();
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url() ?>master/itemdetail',
        data: 'id=' + dataId,
        dataType 	: 'json',
        success: function(response) {
            $.each(response, function(i, item) {
             document.getElementById("tanggal_pembelian").setAttribute('value', item.tanggal_pembelian);
             document.getElementById("nama_penjual").setAttribute('value', item.nama_penjual);
             document.getElementById("nama_surat_tanah").setAttribute('value', item.nama_surat_tanah);
             document.getElementById("keterangan1").setAttribute('value', item.keterangan1);
             document.getElementById("keterangan2").setAttribute('value', item.keterangan2);
             document.getElementById("no_gambar").setAttribute('value', item.no_gambar);
             document.getElementById("jumlah_bidang").setAttribute('value', item.jumlah_bidang);
             document.getElementById("luas_surat").setAttribute('value', item.luas_surat);
             document.getElementById("luas_ukur").setAttribute('value', item.luas_ukur);
             document.getElementById("no_pbb").setAttribute('value', item.no_pbb);
             document.getElementById("luas_pbb_bangunan").setAttribute('value', item.luas_pbb_bangunan);
             document.getElementById("njop_bangunan").setAttribute('value', item.njop_bangunan);
  document.getElementById("luas_pbb_bumi").setAttribute('value', item.luas_pbb_bumi);
             document.getElementById("njop_bumi").setAttribute('value', item.njop_bumi);
             document.getElementById("total_harga_pengalihan").setAttribute('value', item.total_harga_pengalihan);
             document.getElementById("nama_makelar").setAttribute('value', item.nama_makelar);
             document.getElementById("nilai").setAttribute('value', item.nilai);
             document.getElementById("lain").setAttribute('value', item.lain);
             document.getElementById("keterangan").value = item.keterangan;
             document.getElementById("keterangan_lain").value = item.keterangan_lain;
             document.getElementById("atas_nama_pbb").value = item.atas_nama_pbb;
             $("#id_perumahan").select2("val", item.id_perumahan);
             $("#status_surat_tanah2").select2("val", item.status_surat_tanah2);
             $("#status_surat_tanah1").select2("val", item.status_surat_tanah1);
             $("#jenis_pengalihan").select2("val", item.jenis_pengalihan);

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
        tableitems.ajax.reload();
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


function detail(elem){
      var dataId = $(elem).data("id");
      $('#detailData').modal();
      $('#showdetail').html('Loading...');
      $.ajax({
        type: 'GET',
        url: '<?php echo base_url() ?>master/itemdetail',
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
                datarow+="<tr><td>Jenis Surat 1</td><td>: "+item.nama_sertifikat1+"</td></tr>";
                datarow+="<tr><td>Keterangan 1</td><td>: "+item.keterangan1+"</td></tr>";
                datarow+="<tr><td>Jenis Surat 2</td><td>: "+item.nama_sertifikat2+"</td></tr>";
                datarow+="<tr><td>Keterangan 2</td><td>: "+item.keterangan2+"</td></tr>";
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