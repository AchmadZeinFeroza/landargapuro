 <header class="panel-heading">    
        <form action="" method="get">
          <div class="row show-grid">
            <div class="col-sm-3">
              <h2 class="panel-title">Nama Perumahan </h2>
              <select data-plugin-selectTwo class="form-control" onchange='this.form.submit()' required name="id_perumahan">  
                <option value="">Pilih Lokasi</option>
                <?php foreach ($perumahan as $aa): ?>
                 <option value="<?php echo $aa->id;?>" <?php if ($id_perumahan == $aa->id ) echo 'selected' ; ?> ><?php echo $aa->nama_regional;?> ( <?php echo $aa->nama_status;?> )</option>
               <?php endforeach; ?>
             </select> 
           </div>
           <div class="col-sm-2">
            <h2 class="panel-title">Status Surat </h2>
            <select data-plugin-selectTwo class="form-control" onchange='this.form.submit()' required name="status_surat">  
              <option  value="semua" <?php if ($status_surat == 'semua') echo 'selected' ; ?>>Semua</option>
              <option value="jual" <?php if ($status_surat == 'jual') echo 'selected' ; ?>>Jual</option>
              <option value="batal" <?php if ($status_surat == 'batal') echo 'selected' ; ?>>Batal</option>
            </select> 
          </div>
          <div class="col-sm-2">
            <h2 class="panel-title">Tanggal Awal</h2>
            <input type="text" name="tgl_awal" onchange="this.form.submit()" value="<?php echo $tgl_awal ?>" class="form-control tanggal">
          </div>
          <div class="col-sm-2">
            <h2 class="panel-title">Tanggal Akhir</h2>
            <input type="text" name="tgl_akhir" onchange="this.form.submit()" value="<?php echo $tgl_akhir ?>" class="form-control tanggal">

          </div>
          <div class="col-sm-2">

          </div>
          <div class="col-sm-3" style="text-align: right;">
            <a class="btn btn-success">jumlah Penjualan <div id="total_penjualan"></div></a>
          </div>
        </form>
      </form>
    </header>
   <div class="panel-body"> 
    <div class="table-responsive" style="white-space: nowrap;">
     <table class="table table-bordered table-hover table-striped tableitem" id="itemsdata">
      <thead style="position: sticky;">
       <tr>
         <th rowspan="2" style="text-align: center;vertical-align: middle;">NO</th>
         <th rowspan="2" style="text-align: center;vertical-align: middle;">Aksi</th>
         <th rowspan="2" style="text-align: center;vertical-align: middle;">Pembeli</th>

         <th rowspan="2" style="text-align: center;vertical-align: middle;">BLOK</th>
         <th rowspan="2" style="text-align: center;vertical-align: middle;">NIK</th>
         <th rowspan="2" style="text-align: center;vertical-align: middle;">Pekerjaan</th>
         <th rowspan="2" style="text-align: center;vertical-align: middle;">Tanggal Terima Nego</th>
         <th rowspan="2" style="text-align: center;vertical-align: middle;">Tanggal Penjualan</th>
         <th rowspan="2" style="text-align: center;vertical-align: middle;">Sistem Pembayaran</th>
         <th rowspan="2" style="text-align: center;vertical-align: middle;">Harga</th>
         <th rowspan="2" style="text-align: center;vertical-align: middle;">KETERANGAN</th>
       </tr>


     </thead>
     <tbody>

      <?php $no=1; foreach ($datastok as $data){ ?>

      <?php 
      $tombolhapus = level_user('master','items',$this->session->userdata('kategori'),'edit') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="'.$this->security->xss_clean($data->id_jual).'">Hapus</a></li>':'';
      $tombol='
      <div class="btn-group dropup">
      <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action</button>
      <ul class="dropdown-menu" role="menu"> 
      '.$tombolhapus.'
      </ul>
      </div>
      ';
       $tombolbatal='
    <a class="btn btn-danger" href="'.base_url('master/batal_jual/' . $data->id_jual).'">Batal</a>
      ';
      $luas_teknik = $data->luas_teknik;
      // $dataitem = $this->master_model->getfullstoksplit($data->id_stok_split);
      $datajual = $this->master_model->getdatapenjualan($data->id_jual);

      $status_jual = garr($datajual, 'status_jual');
      ?>

      <tr>
        <td><?php echo $no++; ?></td>
<?php if ($status_jual=='1'): ?>
        <td><?php echo $tombol; ?></td>
  <?php else: ?>
        <td><?php echo $tombolbatal; ?></td>

<?php endif ?>
        <td><?php echo garr($datajual, 'nama_pembeli'); ?></td>
        <td><?php echo $data->blok; ?></td>
        <!-- <td><?php echo  $luas_teknik ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td> -->
        <td><?php echo garr($datajual, 'nik'); ?></td>
        <td><?php echo garr($datajual, 'pekerjaan'); ?></td>
        <td><?php echo tgl_indo(garr($datajual, 'tgl_terima_nego')) ?></td>
        <td><?php echo tgl_indo(garr($datajual, 'tgl_penjualan')) ?></td>
        <td><?php echo garr($datajual, 'sistem_pembayaran'); ?></td>
        <td><?php echo rupiah(garr($datajual, 'harga')) ?></td>
        <td></td>
      </tr>
   
        <?php 
    } ?> 
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
       </tr>
     </tfoot>
   </table> 
 </div>
</div>
</section>
<script type="text/javascript">
  $('.tanggal').datepicker({
    format: 'yyyy-mm-dd'
  });
</script>
<script type="text/javascript">
    $('#total_penjualan').html("<?php echo $no-1 ?>");
</script>
