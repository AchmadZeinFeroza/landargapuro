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
      <h2>Evaluasi PROSES INDUK</h2>
  </header>  
  <!-- start: page -->
  <div class="row">
      <section class="panel col-md-12">
        <header class="panel-heading">    
            <div class="row show-grid">
                <div class="col-md-8" align="left"><h2 class="panel-title"></h2></div>
            <form action="<?php echo site_url('Export_excel/excel_rekap_pembelian/') ?>" method="get">

                <div class="row" style="width: 100%; padding: 4px;margin-left: 0%;">
                    <label class="col-sm-1 control-label">Lokasi<span class="required">*</span></label>

                    <div class="col-sm-4">
                        <div class="form-group nama_target">
                            <select data-plugin-selectTwo class="form-control" onchange="refresh()" id="id_perumahan"
                                name="id_perumahan">
                                <?php if(isset($nama_regional)):?>
                                    <option value="<?php echo $id; ?>"><?php echo $nama_regional[0]->nama_regional; ?></option>
                                <?php endif; ?>
                                <option value="">Semua Lokasi</option>
                                <?php foreach ($perumahan as $aa): ?>
                                    <option value="<?php echo $aa->id; ?>"><?php echo $aa->nama_regional; ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary" type="submit">
                        <i class="fa fa-print"></i>cetak </button>
                    </div>
                </div>

            </form>
            </div>
        </header>
        <div class="panel-body"> 
            <div class="table table-responsive" style="white-space: nowrap;">
                <table class="table table-bordered table-hover table-striped data">
                    <thead>
                        <tr>

                            <th rowspan="3" style="text-align: center;vertical-align: middle; ">NO</th>
                            <th rowspan="3" style="text-align: center;vertical-align: middle; ">KETERANGAN</th>
                            <th rowspan="2" colspan="2" style="text-align: center;vertical-align: middle; ">TARGET s/d <?= date('Y')?></th>
                            <th  colspan="6" style="text-align: center;vertical-align: middle; ">REALISASI <?= date('Y')?></th>
                            <th  rowspan="2" colspan="3" style="text-align: center;vertical-align: middle;">EVALUASI</th>
                            <th  colspan="24" style="text-align: center;vertical-align: middle; color: white;background-color: green;">TARGET <?= date("Y") ?></th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align: center;vertical-align: middle;">Jan - AGS</th>
                            <th colspan="2" style="text-align: center;vertical-align: middle;">SEP</th>
                            <th colspan="2" style="text-align: center;vertical-align: middle;">TOTAL</th>

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
                            <th   style="text-align: center;vertical-align: middle;">% </th>

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
                        <?php if(isset($dalamijin)) {?>
                        <tr>
                            <td></td>
                            <td>A. IP PROYEK DALAM IJIN</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <?php $no=1; foreach ($dalamijin as $data): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_regional']; ?></td>
                            <td><?php echo $data['bidtarget']; ?></td>
                            <td><?php echo $data['luastarget']; ?></td>
                            <td><?php echo $data['bidrealsebelum']; ?></td>
                            <td><?php echo $data['luasrealsebelum']; ?></td>
                            <td><?php echo $data['bidrealsesudah']; ?></td>
                            <td><?php echo $data['luasrealsesudah']; ?></td>
                            <td><?php echo $data['bidrealsebelum']+$data['bidrealsesudah']; ?></td>
                            <td><?php echo $data['luasrealsesudah']+$data['luasrealsebelum']; ?></td>
                            <td><?php echo ($data['bidrealsebelum']+$data['bidrealsesudah'])-$data['bidtarget']; ?></td>
                            <td><?php echo ($data['luasrealsesudah']+$data['luasrealsebelum'])-$data['luastarget']; ?></td>
                            <?php
                            if  ($data['luastarget']==0||$data['bidtarget']==0){
                                echo'<td> 0 </td>';
                            }else{
                            ?>
                            <td><?php $hasil = ((($data['bidrealsebelum']+$data['bidrealsesudah'])-$data['bidtarget'])/$data['luastarget'])*100; echo number_format((float)$hasil, 2, '.', '');} ?>%</td>
                            <?php 
                            if ($data['datatarget']['luas']!=0) {

                                for ($i=0; $i <12 ; $i++) { ?>
                                    <td><?php echo $data['datatarget']['bid'][$i]; ?></td>
                                    <td><?php echo $data['datatarget']['luas'][$i]; ?></td>
                                <?php }}else{ ?>
                                    <?php 
                                    for ($i=0; $i <12 ; $i++) { ?>
                                        <td>0</td>
                                        <td>0</td>
                                    <?php }} ?>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td colspan="40" style="background-color: #CCCCCC;"></td>
                            </tr>
                            <tr>

                                <td colspan="2" align="right">TOTAL-A</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php }?>
                            <?php if(isset($luarijin)) {?>
                             <tr>
                            <td></td>
                            <td>B. IP PROYEK LUAR IJIN</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        // <?php
                        //     echo json_encode($luarijin);
                        //     die;
                        // ?>
                        <?php $no=1; foreach ($luarijin as $data): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_regional']; ?></td>
                            <td><?php echo $data['bidtarget']; ?></td>
                            <td><?php echo $data['luastarget']; ?></td>
                            <td><?php echo $data['bidrealsebelum']; ?></td>
                            <td><?php echo $data['luasrealsebelum']; ?></td>
                            <td><?php echo $data['bidrealsesudah']; ?></td>
                            <td><?php echo $data['luasrealsesudah']; ?></td>
                            <td><?php echo $data['bidrealsebelum']+$data['bidrealsesudah']; ?></td>
                            <td><?php echo $data['luasrealsesudah']+$data['luasrealsebelum']; ?></td>
                            <td><?php echo ($data['bidrealsebelum']+$data['bidrealsesudah'])-$data['bidtarget']; ?></td>
                            <td><?php echo ($data['luasrealsesudah']+$data['luasrealsebelum'])-$data['luastarget']; ?></td>
                            <?php if($data['bidrealsebelum'] != 0 || $data['bidrealsesudah'] != 0 || $data['bidtarget'] != 0 || $data['luastarget'] != 0) { ?>
                            <td><?php $hasil = ((($data['bidrealsebelum']+$data['bidrealsesudah'])-$data['bidtarget'])/$data['luastarget'])*100; echo number_format((float)$hasil, 2, '.', ''); ?>%</td>
                            <?php } else { ?>
                                <td>0</td>
                            <?php } ?>
                            <?php 
                            if ($data['datatarget']['luas']!=0) {

                                for ($i=0; $i <12 ; $i++) { ?>
                                    <td><?php echo $data['datatarget']['bid'][$i]; ?></td>
                                    <td><?php echo $data['datatarget']['luas'][$i]; ?></td>
                                <?php }}else{ ?>
                                    <?php 
                                    for ($i=0; $i <12 ; $i++) { ?>
                                        <td>0</td>
                                        <td>0</td>
                                    <?php }} ?>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td colspan="40" style="background-color: #CCCCCC;"></td>
                            </tr>
                            <tr>

                                <td colspan="2" align="right">TOTAL-B</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php }?>
                            <?php if(isset($lokasi)) { ?>
                             <tr>
                            <td></td>
                            <td>C. IP PROYEK LOKASI</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <?php $no=1; foreach ($lokasi as $data): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_regional']; ?></td>
                            <td><?php echo $data['bidtarget']; ?></td>
                            <td><?php echo $data['luastarget']; ?></td>
                            <td><?php echo $data['bidrealsebelum']; ?></td>
                            <td><?php echo $data['luasrealsebelum']; ?></td>
                            <td><?php echo $data['bidrealsesudah']; ?></td>
                            <td><?php echo $data['luasrealsesudah']; ?></td>
                            <td><?php echo $data['bidrealsebelum']+$data['bidrealsesudah']; ?></td>
                            <td><?php echo $data['luasrealsesudah']+$data['luasrealsebelum']; ?></td>
                            <td><?php echo ($data['bidrealsebelum']+$data['bidrealsesudah'])-$data['bidtarget']; ?></td>
                            <td><?php echo ($data['luasrealsesudah']+$data['luasrealsebelum'])-$data['luastarget']; ?></td>
                            <?php if($data['bidrealsebelum'] != 0 || $data['bidrealsesudah'] != 0 || $data['bidtarget'] != 0 || $data['luastarget'] != 0) { ?>
                            <td><?php $hasil = ((($data['bidrealsebelum']+$data['bidrealsesudah'])-$data['bidtarget'])/1)*100; echo number_format((float)$hasil, 2, '.', ''); ?>%</td>
                            <?php } else { ?>
                                <td>0</td>
                            <?php } ?>
                            <?php 
                            if ($data['datatarget']['luas']!=0) {

                                for ($i=0; $i <12 ; $i++) { ?>
                                    <td><?php echo $data['datatarget']['bid'][$i]; ?></td>
                                    <td><?php echo $data['datatarget']['luas'][$i]; ?></td>
                                <?php }}else{ ?>
                                    <?php 
                                    for ($i=0; $i <12 ; $i++) { ?>
                                        <td>0</td>
                                        <td>0</td>
                                    <?php }} ?>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td colspan="40" style="background-color: #CCCCCC;"></td>
                            </tr>
                            <tr>

                                <td colspan="2" align="right">TOTAL-C</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="2" align="right" style="background-color: green; color: white;">TOTAL ALL</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table> 
                </div>
            </div>
        </section>

    </div>

    <!-- end: page -->
</section>
</div>
</section>


<div class="modal fade" data-keyboard="false" data-backdrop="static"  id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('master/itemstambah',' id="FormulirTambah" enctype="multipart/form-data"');?>  
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Item</h2>
                </header>
                <div class="panel-body">

                    <div class="form-group mt-lg kode_item">
                        <label class="col-sm-3 control-label">Kode Tanah<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="kode_item" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group mt-lg nama_target">
                        <label class="col-sm-3 control-label">Lokasi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" required name="id_perumahan">  
                                <option value="">Pilih Lokasi</option>
                                <?php foreach ($perumahan as $supp): ?>
                                    <option value="<?php echo $aa->id;?>"><?php echo $aa->nama_regional;?> ( <?php echo $aa->nama_status;?> )</option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group mt-lg nama_item">
                        <label class="col-sm-3 control-label">Nama Item<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_item" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group tanggal_pembelian">
                        <label class="col-sm-3 control-label">Tanggal Pembelian</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="tanggal_pembelian" class="form-control tanggal"  />
                        </div>
                    </div>
                    <div class="form-group nama_penjual">
                        <label class="col-sm-3 control-label">Nama Penjual</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_penjual" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group nama_surat_tanah">
                        <label class="col-sm-3 control-label">Nama Surat</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_surat_tanah" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group mt-lg nama_target">
                        <label class="col-sm-3 control-label">Sertifikat<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" required name="status_surat_tanah">  
                                <option value="">Pilih Lokasi</option>
                                <?php foreach ($sertifikat_tanah as $aa): ?>
                                    <option value="<?php echo $aa->id_sertifikat_tanah;?>"><?php echo $aa->nama_sertifikat;?> / <?php echo $aa->nama_sertifikat;?></option>
                                <?php endforeach; ?>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group no_gambar">
                        <label class="col-sm-3 control-label">No Gambar</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="no_gambar" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group jumlah_bidang">
                        <label class="col-sm-3 control-label">Jumlah Bidang</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="jumlah_bidang" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group luas_surat">
                        <label class="col-sm-3 control-label">Luas Surat</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="luas_surat" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group luas_ukur">
                        <label class="col-sm-3 control-label">Luas Ukur</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="luas_ukur" class="form-control"  />
                        </div>
                    </div><div class="form-group no_pbb">
                        <label class="col-sm-3 control-label">No PBB</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="no_pbb" class="form-control"  />
                        </div>
                    </div><div class="form-group luas_pbb_bangunan">
                        <label class="col-sm-3 control-label">Luas PBB</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="luas_pbb_bangunan" class="form-control"  />
                        </div>
                    </div><div class="form-group njop_bangunan">
                        <label class="col-sm-3 control-label">njop_bangunan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="njop_bangunan" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group satuan_harga_pengalihan">
                        <label class="col-sm-3 control-label">Satuan Harga Pengalihan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="satuan_harga_pengalihan" class="form-control"  />
                        </div>
                    </div><div class="form-group total_harga_pengalihan">
                        <label class="col-sm-3 control-label">Total Harga Pengalihan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="total_harga_pengalihan" class="form-control"  />
                        </div>
                    </div><div class="form-group nama_makelar">
                        <label class="col-sm-3 control-label">Makelar</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_makelar" class="form-control"  />
                        </div>
                    </div><div class="form-group nilai">
                        <label class="col-sm-3 control-label">Nilai</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nilai" class="form-control"  />
                        </div>
                    </div><div class="form-group tanggal_pengalihan">
                        <label class="col-sm-3 control-label">Tanggal Pengalihan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="tanggal_pengalihan" class="form-control tanggal"  />
                        </div>
                    </div><div class="form-group akta_pengalihan">
                        <label class="col-sm-3 control-label">Akta Pengalihan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="akta_pengalihan" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group nama_pengalihan">
                        <label class="col-sm-3 control-label">Nama Pengalihan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama_pengalihan" class="form-control"  />
                        </div>
                    </div><div class="form-group pematangan">
                        <label class="col-sm-3 control-label">Pematangan</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="pematangan" class="form-control"  />
                        </div>
                    </div><div class="form-group ganti_rugi">
                        <label class="col-sm-3 control-label">Ganti Rugi</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="ganti_rugi" class="form-control"  />
                        </div>
                    </div><div class="form-group pbb">
                        <label class="col-sm-3 control-label">PBB</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="pbb" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group lain">
                        <label class="col-sm-3 control-label">Lain-lain</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="lain" class="form-control"  />
                        </div>
                    </div><div class="form-group harga_perm">
                        <label class="col-sm-3 control-label"></span>Harga / M^2</label>
                        <div class="col-sm-9">
                            <input type="text" name="harga_perm" class="form-control"  />
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
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('master/itemsedit',' id="FormulirEdit"  enctype="multipart/form-data"');?>  
                <input type="hidden" name="idd" id="idd">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Data Tanah/Aset</h2>
                </header>
                <div class="panel-body">
                 <div class="form-group mt-lg kode_item">
                    <label class="col-sm-3 control-label">Kode Tanah<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="kode_item" id="kode_item" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group mt-lg nama_target">
                    <label class="col-sm-3 control-label">Lokasi<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <select data-plugin-selectTwo class="form-control" required id="id_perumahan" name="id_perumahan">  
                            <option value="">Pilih Lokasi</option>
                            <?php foreach ($perumahan as $supp): ?>
                                <option value="<?php echo $aa->id;?>"><?php echo $aa->nama_regional;?> ( <?php echo $aa->nama_status;?> )</option>
                            <?php endforeach; ?>
                        </select> 
                    </div>
                </div>
                <div class="form-group mt-lg nama_item">
                    <label class="col-sm-3 control-label">Nama tanah<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="nama_item" id="nama_item" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group tanggal_pembelian">
                    <label class="col-sm-3 control-label">Tanggal Pembelian</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control tanggal"  />
                    </div>
                </div>
                <div class="form-group nama_penjual">
                    <label class="col-sm-3 control-label">Nama Penjual</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="nama_penjual" id="nama_penjual" class="form-control"  />
                    </div>
                </div>
                <div class="form-group nama_surat_tanah">
                    <label class="col-sm-3 control-label">Nama Surat</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="nama_surat_tanah" id="nama_surat_tanah" class="form-control"  />
                    </div>
                </div>
                <div class="form-group mt-lg nama_target">
                    <label class="col-sm-3 control-label">Sertifikat<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <select data-plugin-selectTwo class="form-control" required name="status_surat_tanah" id="status_surat_tanah">  
                            <option value="">Pilih Lokasi</option>
                            <?php foreach ($sertifikat_tanah as $aa): ?>
                                <option value="<?php echo $aa->id_sertifikat_tanah;?>"><?php echo $aa->nama_sertifikat;?> / <?php echo $aa->nama_sertifikat;?></option>
                            <?php endforeach; ?>
                        </select> 
                    </div>
                </div>
                <div class="form-group no_gambar">
                    <label class="col-sm-3 control-label">No Gambar</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="no_gambar" id="no_gambar" class="form-control"  />
                    </div>
                </div>
                <div class="form-group jumlah_bidang">
                    <label class="col-sm-3 control-label">Jumlah Bidang</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="jumlah_bidang" id="jumlah_bidang" class="form-control"  />
                    </div>
                </div>
                <div class="form-group luas_surat">
                    <label class="col-sm-3 control-label">Luas Surat</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="luas_surat" id="luas_surat" class="form-control"  />
                    </div>
                </div>
                <div class="form-group luas_ukur">
                    <label class="col-sm-3 control-label">Luas Ukur</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="luas_ukur" id="luas_ukur" class="form-control"  />
                    </div>
                </div><div class="form-group no_pbb">
                    <label class="col-sm-3 control-label">No PBB</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="no_pbb" id="no_pbb" class="form-control"  />
                    </div>
                </div><div class="form-group luas_pbb_bangunan">
                    <label class="col-sm-3 control-label">Luas PBB</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="luas_pbb_bangunan" id="luas_pbb_bangunan" class="form-control"  />
                    </div>
                </div><div class="form-group njop_bangunan">
                    <label class="col-sm-3 control-label">njop_bangunan</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="njop_bangunan" id="njop_bangunan" class="form-control"  />
                    </div>
                </div>
                <div class="form-group satuan_harga_pengalihan">
                    <label class="col-sm-3 control-label">Satuan Harga Pengalihan</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="satuan_harga_pengalihan" id="satuan_harga_pengalihan" class="form-control"  />
                    </div>
                </div><div class="form-group total_harga_pengalihan">
                    <label class="col-sm-3 control-label">Total Harga Pengalihan</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="total_harga_pengalihan" id="total_harga_pengalihan" class="form-control"  />
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
                </div><div class="form-group tanggal_pengalihan">
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
                <div class="form-group nama_pengalihan">
                    <label class="col-sm-3 control-label">Nama Pengalihan</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="nama_pengalihan" id="nama_pengalihan" class="form-control"  />
                    </div>
                </div><div class="form-group pematangan">
                    <label class="col-sm-3 control-label">Pematangan</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="pematangan" id="pematangan" class="form-control"  />
                    </div>
                </div><div class="form-group ganti_rugi">
                    <label class="col-sm-3 control-label">Ganti Rugi</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="ganti_rugi" id="ganti_rugi" class="form-control"  />
                    </div>
                </div><div class="form-group pbb">
                    <label class="col-sm-3 control-label">PBB</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="pbb" id="pbb" class="form-control"  />
                    </div>
                </div>
                <div class="form-group lain">
                    <label class="col-sm-3 control-label">Lain-lain</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="lain" id="lain" class="form-control"  />
                    </div>
                </div><div class="form-group harga_perm">
                    <label class="col-sm-3 control-label"></span>Harga / M^2</label>
                    <div class="col-sm-9">
                        <input type="text" name="harga_perm" id="harga_perm" class="form-control"  />
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
                            <?php echo form_open('master/itemshapus',' id="FormulirHapus"');?>  
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
<script>
    function refresh(){
        var cek = '<?= site_url('laporan/laporan_evaluasi_pembelian/')?>';
        if($('#id_perumahan').val() !== ""){
            location.replace( cek += "?id_perumahan="+ $('#id_perumahan').val()+"");
        }else{
            location.replace(cek);
        }
    }
</script>

</body>
</html>