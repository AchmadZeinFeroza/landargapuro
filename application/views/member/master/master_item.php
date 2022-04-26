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
      <h2>Master Data Tanah</h2>
  </header>
  <!-- start: page -->
  <section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6" align="left"><h2 class="panel-title">Master Data Tanah </h2></div>
            <?php
echo level_user('master', 'items', $this->session->userdata('kategori'), 'add') > 0 ? '<div class="col-md-6" align="right"><a class="btn btn-success" href="#"  data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah</a></div>' : '';
?>
        </div>

        <div class="form-group mt-lg">
            <form action="<?php echo site_url('Export_excel/laporan_master_tanah/') ?>" method="get">

                <div class="row" style="width: 100%; padding: 4px;margin-left: 0%;">
                    <label class="col-sm-1 control-label">Lokasi<span class="required">*</span></label>

                    <div class="col-sm-2">
                        <div class="form-group nama_target">
                            <select data-plugin-selectTwo class="form-control" onchange="refresh()" id="id_perumahan"
                                name="id_perumahan">
                                <option value="">Semua Lokasi</option>
                                <?php foreach ($perumahan2 as $aa): ?>
                            <option value="<?php echo $aa->id; ?>"><?php echo $aa->nama_regional; ?></option>
                        <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group nama_target">
                            <select data-plugin-selectTwo class="form-control" onchange="refresh()" id="status"
                                name="status">
                                <option value="">Semua Status</option>
                                <?php foreach ($status as $aa): ?>
                            <option value="<?php echo $aa['id_status_regional']; ?>"><?php echo $aa['nama_status']; ?></option>
                        <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="firstdate" id="firstdate" class="form-control tanggal" onchange="refresh()" data-plugin-datepicker placeholder="Tanggal Awal" autocomplete="off"/>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="lastdate" id="lastdate" class="form-control tanggal" onchange="refresh()"  data-plugin-datepicker placeholder="Tanggal Akhir" autocomplete="off"/>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-hover pr-5" type="submit">
                        <i class="fa fa-print"></i> cetak </button>
                    </div>
                </div>

            </form>
        </div>

        <div class="form-group mt-lg">
            <form action="<?php echo site_url('Export_excel/laporan_pembayaran/') ?>" method="get">

                <div class="row" style="width: 100%; padding: 4px;margin-left: 0%;">
                    <div class="col-sm-4">
                        <div class="form-group nama_target">
                            <select data-plugin-selectTwo class="form-control" id="status"
                                name="status">
                                <option value="">Semua Pembayaran</option>
                                <option value="1"> Lunas </option>
                                <option value="0"> Belum Lunas </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="firstdate" id="firstdate" class="form-control tanggal" data-plugin-datepicker placeholder="Tanggal Awal" autocomplete="off"/>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="lastdate" id="lastdate" class="form-control tanggal"  data-plugin-datepicker placeholder="Tanggal Akhir" autocomplete="off"/>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-hover pr-5" type="submit">
                        <i class="fa fa-print"></i> Cetak Semua Pembayaran</button>
                    </div>
                </div>

            </form>

        </div>
        <div class="form-group mt-lg">
        <div class="col-sm-4">
                        <a class="btn btn-primary btn-hover pr-5" href="<?php echo site_url('Export_excel/excel_laporan1_evaluasi_pembelian_detail/') ?>">
                        <i class="fa fa-print"></i> Cetak Laporan Evaluasi Pembelian Tanah</a>
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary btn-hover pr-5" type="submit">
                        <i class="fa fa-print"></i> Cetak Rekap Evaluasi Pembelian Tanah</button>
                    </div>
        </div>


    </header>
    <div class="panel-body">
      <div >
          <table class="table table-bordered table-hover table-striped data" id="itemsdata" style="overflow-x: auto;white-space: nowrap;">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;"></th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;">Lokasi</th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;">Kode Item </th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;">Tanggal Pembelian</th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;">Nama Penjual</th>
                    <th colspan="2" style="text-align: center;vertical-align: middle;">Data Surat Tanah</th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;">No Gambar</th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;">Jml Bidang</th>
                    <th colspan="2" style="text-align: center;vertical-align: middle;">Luas (m2)</th>
                    <th colspan="3" style="text-align: center;vertical-align: middle;">PBB</th>
                    <th colspan="2" style="text-align: center;vertical-align: middle;">Harga Pengalihan Hak</th>
                    <th colspan="2" style="text-align: center;vertical-align: middle;">Makelar</th>
                    <th colspan="3" style="text-align: center;vertical-align: middle;">Pengalihan Hak</th>
                    <th colspan="2" style="text-align: center;vertical-align: middle;">Biaya Lain-lain</th>
                    <th rowspan ="2" style="text-align: center;vertical-align: middle;" >Total Harga</th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;" >Harga / M^2</th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;">Keterangan</th>


                </tr>
                <tr>
                    <th style="text-align: center;vertical-align: middle;">Nama</th>
                    <th style="text-align: center;vertical-align: middle;">Surat</th>
                    <!-- <th style="text-align: center;vertical-align: middle;">Surat 2</th> -->
                    <th style="text-align: center;vertical-align: middle;">Surat</th>
                    <th style="text-align: center;vertical-align: middle;">Ukur</th>
                    <th style="text-align: center;vertical-align: middle;">Nomor</th>
                    <th style="text-align: center;vertical-align: middle;">Luas</th>
                    <th style="text-align: center;vertical-align: middle;">njop_bangunan</th>
                    <th style="text-align: center;vertical-align: middle;">Satuan</th>
                    <th style="text-align: center;vertical-align: middle;">Total</th>
                    <th style="text-align: center;vertical-align: middle;">Nama</th>
                    <th style="text-align: center;vertical-align: middle;">Nilai</th>
                    <th style="text-align: center;vertical-align: middle;">Tanggal</th>
                    <th style="text-align: center;vertical-align: middle;">Akte</th>
                    <th style="text-align: center;vertical-align: middle;">Nama</th>
                    <th style="text-align: center;vertical-align: middle;">Lain2</th>
                    <th style="text-align: center;vertical-align: middle;">Keterangan Lain</th>

                </tr>
            </thead>
            <tbody id="content">
            </tbody>
        </table>
    </div></div>
</section>
<!-- end: page -->
</section>
</div>
</section>



<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('master/itemstambah', ' id="FormulirTambah" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Item</h2>
                </header>
                <div class="panel-body">


                    <div class="form-group mt-lg nama_target">
                        <label class="col-sm-3 control-label">Lokasi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" required name="id_perumahan">
                                <option value="">Pilih Lokasi</option>
                                <?php foreach ($perumahan2 as $aa): ?>
                                    <option value="<?php echo $aa->id; ?>"><?php echo $aa->nama_regional; ?> ( <?php echo $aa->nama_status; ?> )</option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-lg nama_item">
                        <label class="col-sm-3 control-label">Nama Penjual<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_penjual" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group tanggal_pembelian">
                        <label class="col-sm-3 control-label">Tanggal Pembelian</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="tanggal_pembelian" class="form-control tanggal"  />
                        </div>
                    </div>
                    <div class="form-group tanggal_pembelian">
                        <label class="col-sm-3 control-label">Atas Nama Surat</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_surat_tanah" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group nama_penjual">
                        <label class="col-sm-3 control-label">Data Surat Tanah 1</span></label>

                        <div class="col-sm-5">
                            <select data-plugin-selectTwo class="form-control" required name="status_surat_tanah1">
                                <option value="">Pilih Jenis</option>
                                <?php foreach ($sertifikat_tanah as $aa): ?>
                                    <option value="<?php echo $aa->id_sertifikat_tanah; ?>"><?php echo $aa->kode_sertifikat; ?> / <?php echo $aa->nama_sertifikat; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="keterangan1" class="form-control" placeholder="keterangan 1"  />
                        </div>
                    </div>
                    <!-- <div class="form-group nama_penjual">
                        <label class="col-sm-3 control-label">Data Surat Tanah 2</span></label>

                        <div class="col-sm-5">
                            <select data-plugin-selectTwo class="form-control" name="status_surat_tanah2">
                                <option value="">Pilih Jenis</option>
                                <?php foreach ($sertifikat_tanah as $aa): ?>
                                    <option value="<?php echo $aa->id_sertifikat_tanah; ?>"><?php echo $aa->kode_sertifikat; ?> / <?php echo $aa->nama_sertifikat; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="keterangan2" class="form-control" placeholder="Keterangan 2"  />
                        </div>
                    </div> -->
                    <div class="form-group no_gambar">
                        <label class="col-sm-3 control-label">No Gambar</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="no_gambar" class="form-control"  />
                        </div>
                    </div>
                    <input type="hidden" name="jumlah_bidang" class="form-control"  value="1"/>
                    <div class="form-group luas_surat">
                        <label class="col-sm-3 control-label">Luas (m2)</span></label>
                        <div class="col-sm-5">
                            <input type="number" name="luas_surat" class="form-control" placeholder="Luas surat"  />
                        </div>
                        <div class="col-sm-4">
                            <input type="number" name="luas_ukur" class="form-control"  placeholder="Luas Ukur" />
                        </div>
                    </div>
                    <div class="form-group no_pbb">
                        <label class="col-sm-3 control-label">PBB</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="no_pbb" class="form-control" placeholder="No PBB"  />
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="atas_nama_pbb" class="form-control" placeholder="Atas Nama"  />
                        </div>
                    </div>
                    <div class="form-group no_pbb">
                        <label class="col-sm-3 control-label"></span></label>
                        <div class="col-sm-4">
                            <!-- <input type="text" name="luas_pbb_bangunan" class="form-control" placeholder="Luas PBB (m2)"  /> -->
                            <input type="text" name="luas_pbb_bangunan" class="form-control" placeholder="Luas Bangunan PBB (m2)"  />
                            <br>
                            <input type="text" name="luas_pbb_bumi" class="form-control" placeholder="Luas Bumi PBB (m2)"  />
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="njop_bangunan" class="form-control" placeholder="NJOP Bangunan" />
                            <br>
                            <input type="text" name="njop_bumi" class="form-control" placeholder="NJOP Bumi" />
                        </div>

                    </div>
                    <div class="form-group satuan_harga_pengalihan">
                        <label class="col-sm-3 control-label">Harga Pengalihan Hak</span></label>

                        <div class="col-sm-4">
                            <input type="text" name="total_harga_pengalihan" class="form-control mask_price" placeholder="Total Harga Pengalihan" />
                        </div>
                    </div><div class="form-group nama_makelar">
                        <label class="col-sm-3 control-label">Nama Makelar</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_makelar" class="form-control"  />
                        </div>
                    </div><div class="form-group nilai">
                        <label class="col-sm-3 control-label">Nilai</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nilai" class="form-control mask_price"  />
                        </div>
                    </div>
                    <div class="form-group nama_penjual">
                        <label class="col-sm-3 control-label">Jenis Pengalihan</span></label>

                        <div class="col-sm-5">
                            <select data-plugin-selectTwo class="form-control" required name="jenis_pengalihan">
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
                            <input type="text" name="tanggal_pengalihan" style="color: grey; text-align: center;vertical-align: middle;" class="form-control tanggal" placeholder="Tanggal Pengalihan" title="Tanggal Pengalihan"  />
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="akta_pengalihan" class="form-control" placeholder="No Akta"  />
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="nama_pengalihan" class="form-control" placeholder="Nama Pejabat" />
                        </div>
                    </div> -->
                    <!-- <div class="form-group ganti_rugi">
                        <label class="col-sm-3 control-label">Ganti Rugi</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="ganti_rugi" class="form-control mask_price"  />
                        </div>
                    </div>
                    <div class="form-group pbb">
                        <label class="col-sm-3 control-label">Biaya PBB</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="pbb" class="form-control mask_price"  />
                        </div>
                    </div> -->
                    <div class="form-group lain">
                        <label class="col-sm-3 control-label">Biaya Lain-lain</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="lain" placeholder="Nilai" class="form-control mask_price"  />
                        </div>
                        <div class="col-sm-5">

                            <textarea rows="2" class="form-control" name="keterangan_lain" placeholder="Keterangan Lain-lain" ></textarea>
                        </div>
                    </div>
                    <div class="form-group keterangan">
                        <label class="col-sm-3 control-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea rows="2" class="form-control" name="keterangan"></textarea>
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
                <!-- <div class="form-group nama_penjual">
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
                </div> -->
                <div class="form-group no_gambar">
                    <label class="col-sm-3 control-label">No Gambar</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="no_gambar" name="no_gambar" class="form-control"  />
                    </div>
                </div>
                    <input type="hidden" id="jumlah_bidang" name="jumlah_bidang" class="form-control" value="1" />
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
                        <input type="text" id="total_harga_pengalihan" name="total_harga_pengalihan" class="form-control mask_price" placeholder="Total Harga Pengalihan" />
                    </div>
                </div><div class="form-group nama_makelar">
                    <label class="col-sm-3 control-label">Nama Makelar</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="nama_makelar" name="nama_makelar" class="form-control"  />
                    </div>
                </div><div class="form-group nilai">
                    <label class="col-sm-3 control-label">Nilai</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="nilai" name="nilai" class="form-control mask_price"  />
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
                        <input type="text" id="lain" name="lain" class="form-control mask_price"/>
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
    format: 'yyyy-mm-dd'
});

function refresh(){
    // $('#itemsdata').data.reload();
    table = $('#itemsdata').DataTable();
    table.destroy();

    $table = $('#itemsdata').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url() ?>master/dataitems",
            "type": "GET",
            "data": {
                firstdate: function() { return $('#firstdate').val() },
                lastdate: function() { return $('#lastdate').val() },
                id_perumahan: function() { return $('#id_perumahan').val() },
                status: function() { return $('#status').val() }
            }
        },
        "columnDefs": [
        {
            "targets": [ 0 ],
            "orderable": false,
        },
        ],
    });


}
var tableitems = $('#itemsdata').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url() ?>master/dataitems",
            "type": "GET",
            "data": {
                firstdate: function() { return $('#firstdate').val() },
                lastdate: function() { return $('#lastdate').val() },
                id_perumahan: function() { return $('#id_perumahan').val() }
            }
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
           type 		:'POST',
           url 		: $(this).attr('action'),
           data 		: formData,
          processData: false,
          contentType: false,
          cache: false,
          dataType 	: 'JSON'
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
                // datarow+="<tr><td>Jenis Surat 2</td><td>: "+item.nama_sertifikat2+"</td></tr>";
                // datarow+="<tr><td>Keterangan 2</td><td>: "+item.keterangan2+"</td></tr>";
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
            //  document.getElementById("keterangan2").setAttribute('value', item.keterangan2);
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
            //  $("#status_surat_tanah2").select2("val", item.status_surat_tanah2);
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

</script>
</body>
</html>