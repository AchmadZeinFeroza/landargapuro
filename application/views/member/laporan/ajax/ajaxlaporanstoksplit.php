  <header class="panel-heading">
    <form action="" method="get">
     Pilih Lokasi dan Jenis Evaluasi <br>
     <div class="row show-grid">

      <div class="col-md-4">

        <div class="row" >
          <div class="col-md-5">
           <select data-plugin-selectTwo class="form-control" onchange='this.form.submit()' required name="id_perumahan">
            <option value="">Pilih Lokasi</option>
            <?php foreach ($perumahan as $aa): ?>
             <option value="<?php echo $aa->id; ?>" <?php if ($id_perumahan == $aa->id) {
    echo 'selected';
}
?>><?php echo $aa->nama_regional; ?> ( <?php echo $aa->nama_status; ?> )</option>
           <?php endforeach;?>
         </select>

       </div>
       <div class="col-md-4" >
         <select data-plugin-selectTwo class="form-control " onchange='this.form.submit()' required name="status_surat">
          <option  value="semua" <?php if ($status_surat == 'semua') {
    echo 'selected';
}
?>>Semua</option>
          <option value="belum" <?php if ($status_surat == 'belum') {
    echo 'selected';
}
?>>Belum</option>
          <option value="proses" <?php if ($status_surat == 'proses') {
    echo 'selected';
}
?>>Proses</option>
          <option value="terbit" <?php if ($status_surat == 'terbit') {
    echo 'selected';
}
?>>Terbit</option>
        </select>
      </div>
      <div class="col-md-3">
       <a class="btn btn-primary btn-block btn-hover " href="<?php echo site_url('Export_excel/laporan_rekap_evaluasi_kavling_efektif/') ?>"><i class="fa fa-print"></i>  cetak </a>
     </div>
   </div>
 </div>
 <div class="col-md-2">
   <a class="btn btn-danger" href="#"  data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> </a>
   <a class="btn btn-primary" href="#"  data-toggle="modal" data-target="#uploaddata"><i class="fa fa-upload"></i> </a>
 </div>
 <div class="col-md-6">
  <a class="btn btn-info">Stok SHM<b><div id="total_stok"> </b></div></a>
  <a class="btn btn-success">Stok SHM terbit<b> <div id="total_stok_terbit_split"></b></div></a>
  <a class="btn btn-primary">Stok SHM Proses<b><div id="total_stok_efektif"> </b></div></a>
  <a class="btn btn-warning">Stok SHM Belum Terbit<b><div id="total_stok_belum_terbit"></b></div></a>
</div>
</div>
</form>
</header>
<div class="panel-body">
  <div class="table" style="white-space: nowrap;">
   <table class="table table-bordered table-hover table-striped tableitem" id="itemsdata">
    <thead style="position: sticky;">
     <tr>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">NO</th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">Aksi</th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">Jual</th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">BLOK</th>
       <th colspan="3" rowspan="1" style="text-align: center;vertical-align: middle;">L. TANAH</th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">NO INDUK</th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">NO SERT </th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">TGL DAFTAR</th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">TGL TERBIT</th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">BATAS WAKTU HGB</th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">KETERANGAN</th>
     </tr>
     <tr>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">TECHNIC</th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">SERT</th>
       <th rowspan="2" style="text-align: center;vertical-align: middle;">SELISIH</th>
     </tr>


   </thead>
   <tbody>

    <?php
$total_stok = 0;
$total_stok_efektif = 0;
$total_stok_terbit_split = 0;
$total_stok_belum_terbit = 0;
$no = 1;foreach ($datastok as $data) {?>

      <?php
$total_stok++;
    $tomboljual = level_user('master', 'items', $this->session->userdata('kategori'), 'edit') > 0 ? '<a href="#" class="mb-xs mt-xs mr-xs btn btn-success" onclick="jual(this)" data-id="' . $this->security->xss_clean($data->id_stok_split) . '" data-blok_jual="' . $this->security->xss_clean($data->blok) . '">Jual</a>' : '';
    $tomboledit = level_user('master', 'items', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $this->security->xss_clean($data->id_stok_split) . '">Edit</a></li>' : '';
    $tombolsplit = level_user('master', 'items', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="split(this)" data-id="' . $this->security->xss_clean($data->id_stok_split) . '">Split</a></li>' : '';

    $tombolhapus = level_user('master', 'items', $this->session->userdata('kategori'), 'edit') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="' . $this->security->xss_clean($data->id_stok_split) . '">Hapus</a></li>' : '';
    $tombol = '
      <div class="btn-group dropup">
      <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action</button>
      <ul class="dropdown-menu" role="menu">
      <li><a href="#" onclick="detail(this)" data-id="' . $this->security->xss_clean($data->id_stok_split) . '">Detail</a></li>
      ' . $tomboledit . '
      ' . $tombolsplit . '
      ' . $tombolhapus . '
      </ul>
      </div>
      ';
    $luas_teknik = $data->luas_teknik;
    $dataitem = $this->master_model->getfullstoksplit($data->id_stok_split);

    ?>

      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $tombol; ?></td>
        <td><?php echo $tomboljual; ?></td>
        <td><?php echo $data->blok; ?></td>
        <td><?php echo $luas_teknik ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <?php

    foreach ($dataitem as $key => $value) {
        $kolom = '';
        $stat = '';

        ?>

        <?php if ($value['tgl_terbit_blok'] == '0000-00-00' || $value['tgl_terbit_blok'] == '') {
            if ($value['tgl_daftar_blok'] == '0000-00-00' || $value['tgl_daftar_blok'] == '') {
                $total_stok_belum_terbit++;
                $stat = 'belum';
                $kolom .= '<tr style="background-color:#ffbaba">';
            } else {
                $total_stok_belum_terbit++;
                $stat = 'proses';
                $kolom .= '<tr style="background-color:#ffd56b">';
            }
        } else {
            $total_stok_terbit_split++;
            $stat = 'selesai';
            $kolom .= '<tr style="background-color:#c0ffba">';
        }
        $kolom .= '<td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>' . $luas_teknik . '</td>
        <td>' . $value["luas_terbit_blok"] . '</td>';
        $luas_teknik -= $value['luas_terbit_blok'];
        $kolom .= '<td>' . $luas_teknik . '</td>
        <td>' . $value["no_terbit_shgb"] . '</td>
        <td>' . $value["no_shgb_blok"] . '</td>
        <td>' . tgl_indo($value["tgl_daftar_blok"]) . '</td>
        <td>' . tgl_indo($value["tgl_terbit_blok"]) . '</td>
        <td>ini dapat darimana</td>
        <td>' . $value['keterangan'] . '</td>
        </tr>';
        if ($luas_teknik == '0') {
            $total_stok_efektif++;
        }
        if ($status_surat == 'semua') {
            echo $kolom;
        } else {
            if ($status_surat == $stat) {
                echo $kolom;
            }
        }
    }
}?>
  </tbody>
  <tfoot>
   <tr>
     <td colspan="2">TOTAL </td>

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

<script type="text/javascript">
    $('#total_stok').html("<?php echo $total_stok ?>");
    $('#total_stok_efektif').html("<?php echo $total_stok_efektif ?>");
    $('#total_stok_belum_terbit').html("<?php echo $total_stok_belum_terbit ?>");
    $('#total_stok_terbit_split').html("<?php echo $total_stok_terbit_split ?>");
</script>