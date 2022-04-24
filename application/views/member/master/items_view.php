
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">IP Proyek - <?php echo $dataperumahan['nama_status'] ?></h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>

        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
</div>
<!-- /.box-header -->
<div class="box-body">
    <section class="panel">
          <?php
        if ($perumahan!=null): 
           $totalbidang=0;
           $totalluassurat=0;
           $totalluasukur=0;
           $totalhargasatuan=0;
           $totalnilaimakelar=0;
           $totalhargatotal=0;
           $totalhargabiaya=0;
           $totalhargam=0;
           $totalgantirugi =0;
           $totalpbb =0;
           $totallain=0;
           $totalakhirbiayalain=0;
           ?>
        <header class="panel-heading">    
            <div class="row show-grid">
                <div class="col-md-6" align="left"><h2 class="panel-title">Proyek <?php echo $dataperumahan['nama_regional']; ?> </h2></div>

            </div>
        </header>
       
           <div class="panel-body"> 
            <div class="table" style="overflow-x: auto;white-space: nowrap;">
                <table class="table table-responsive table-bordered table-hover table-striped data" >
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
                        <th colspan="5" style="text-align: center;vertical-align: middle;">PBB</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">Harga Pengalihan Hak</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">Makelar</th>
                        <th colspan="3" style="text-align: center;vertical-align: middle;">Pengalihan Hak</th>
                        <th colspan="3" style="text-align: center;vertical-align: middle;">Biaya Lain-lain</th>
                        <th rowspan ="2" style="text-align: center;vertical-align: middle;" >Total Harga + biaya</th>
                        <th rowspan="2" style="text-align: center;vertical-align: middle;" >Harga / M^2</th>
                        <th rowspan="2" style="text-align: center;vertical-align: middle;">Keterangan</th>


                    </tr>
                    <tr>
                        <th style="text-align: center;vertical-align: middle;">Nama</th>
                        <th style="text-align: center;vertical-align: middle;">Status</th>
                        <th style="text-align: center;vertical-align: middle;">Surat</th>
                        <th style="text-align: center;vertical-align: middle;">Ukur</th>
                        <th style="text-align: center;vertical-align: middle;">Nomor</th>
                        <th style="text-align: center;vertical-align: middle;">Luas Bangunan</th>
                        <th style="text-align: center;vertical-align: middle;">NJOP Bangunan</th>
                          <th style="text-align: center;vertical-align: middle;">Luas Bumi</th>
                        <th style="text-align: center;vertical-align: middle;">NJOP Bumi</th>
                        <th style="text-align: center;vertical-align: middle;">Satuan</th>
                        <th style="text-align: center;vertical-align: middle;">Total</th>
                        <th style="text-align: center;vertical-align: middle;">Nama</th>
                        <th style="text-align: center;vertical-align: middle;">Nilai</th>
                        <th style="text-align: center;vertical-align: middle;">Tanggal</th>
                        <th style="text-align: center;vertical-align: middle;">Akte</th>
                        <th style="text-align: center;vertical-align: middle;">Nama</th>
                        <th style="text-align: center;vertical-align: middle;">Lain2</th>
                        <th style="text-align: center;vertical-align: middle;">Keterangan Lain2</th>
                        <th style="text-align: center;vertical-align: middle;">Total</th>

                    </tr>

                </thead>
             
                <?php foreach ($perumahan as $value => $data):?>
                   <tr>
                     <?php 
                     $tombolhapus = level_user('master','items',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" id="hapus" onclick="hapus(this)" data-id="'.$this->security->xss_clean($data->kode_item).'">Hapus</a></li>':'';
                      $tombolbayar = level_user('master','items',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="bayar(this)" data-id="'.$this->security->xss_clean($data->kode_item).'">Laporan Pembayaran</a></li>':'';
                      $tomboldetailbayar = level_user('master','items',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="'.site_url('keuangan/bayar_tanah/').$this->security->xss_clean($data->kode_item).'">Daftar Pembayaran</a></li>':'';
                     $tomboledit = level_user('master','items',$this->session->userdata('kategori'),'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="'.$this->security->xss_clean($data->kode_item).'">Edit</a></li>':'';
                     $tombol='
                     <div class="btn-group dropup">
                     <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
                     <ul class="dropdown-menu" role="menu"> 
                     <li><a href="#" onclick="detail(this)" data-id="'.$this->security->xss_clean($data->kode_item).'">Detail</a></li> 
                     '.$tombolbayar.'
                     '.$tomboldetailbayar.'
                     '.$tomboledit.'
                     '.$tombolhapus.' 
                     </ul>
                     </div>
                     ';

                     if ($data->tanggal_pengalihan!=null) {
                        $tgl_pengalihan = tgl_indo($data->tanggal_pengalihan);
                    }else{
                        $tgl_pengalihan = '-';
                    }
                    if ($data->id_perumahan=='0') {
                        $perumahan = 'Tidak ada';
                    }else{
                        $perumahan = $data->nama_regional;
                    }
                    if ($data->total_harga_pengalihan==0) {
                        $harga_satuan = 0;
                        $data->total_harga_pengalihan=0;
                    }else{
                        $harga_satuan = $data->total_harga_pengalihan/$data->luas_surat;            
                    }              
                    if ($data->lain=='') {
                        $data->lain=0;
                    }
                    if ($data->nilai=='') {
                        $data->nilai=0;
                    }                 
                    $totalbiayalain = $data->lain;
                    $totalharga_biaya = $data->total_harga_pengalihan+$data->nilai+$totalbiayalain;
                    if ($totalharga_biaya==0) {
                        $harga_perm=0;
                    }else{
                        $harga_perm = $totalharga_biaya/$data->luas_surat;

                    }
                    $totalbidang+=$data->jumlah_bidang;
                    $totalluassurat+=$data->luas_surat;
                    $totalluasukur+=$data->luas_ukur;
                    $totalhargasatuan+=$harga_satuan;
                    $totalhargatotal+=$data->total_harga_pengalihan;
                    $totalnilaimakelar+=$data->nilai;
                    $totalhargabiaya+=$totalharga_biaya;
                    $totalhargam+=$harga_perm;
                    $totallain+=$data->lain;
                    $totalakhirbiayalain +=$totalbiayalain;
                    ?>
                    <td><?= $tombol ?></td>
                    <td><?=$perumahan?></td>
                    <td><?=$data->kode_item?></td> 
                    <td><?=tgl_indo($data->tanggal_pembelian)?></td>
                    <td><?=$data->nama_penjual?></td>  
                    <td><?=$data->nama_surat_tanah?></td>  
                    <td><?=$data->kode_sertifikat?></td>  
                    <td><?=$data->no_gambar?></td>  
                    <td><?=$data->jumlah_bidang?></td>  
                    <td><?=$data->luas_surat?></td>  
                    <td><?=$data->luas_ukur?></td>  
                    <td><?=$data->no_pbb?></td>  
                    <td><?=$data->luas_pbb_bangunan?></td>  
                    <td><?=$data->njop_bangunan?></td>  
                    <td><?=$data->luas_pbb_bumi?></td>  
                    <td><?=$data->njop_bumi?></td>  
                    <td><?=rupiah($harga_satuan)?></td>  
                    <td><?=rupiah($data->total_harga_pengalihan)?></td>  
                    <td><?=$data->nama_makelar?></td>  
                    <td><?=rupiah($data->nilai)?></td>  
                    <td><?=$tgl_pengalihan?></td>  
                    <td><?=$data->akta_pengalihan?></td>  
                    <td><?=$data->nama_pengalihan?></td>  
                    <td><?=rupiah($data->lain)?></td>  
                    <td><?=$data->keterangan_lain?></td>  
                    <td><?=rupiah($totalbiayalain)?></td>  
                    <td><?=rupiah($totalharga_biaya)?></td>  
                    <td><?=rupiah($harga_perm)?></td>  
                    <td><?=$data->keterangan?></td>
                <?php endforeach ?>
            </tr>
            <tr>
                <td></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>


            </tr>
            <tr>
                <td colspan="4" align="right"><b style="color: black">Total  <?php echo $dataperumahan['nama_regional']; ?> </b></td>

                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ><?php echo $totalbidang; ?></td>
                <td ><?php echo $totalluassurat ?></td>
                <td ><?php echo $totalluasukur; ?></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ><?php echo rupiah($totalhargasatuan); ?></td>
                <td ><?php echo rupiah($totalhargatotal); ?></td>
                <td ></td>
                <td ></td>
                <td ><?php echo rupiah($totalnilaimakelar); ?></td>
                <td ></td>
                <td ></td>
                <td ><?php echo rupiah($totallain); ?></td>
                <td ><?php echo rupiah($totalakhirbiayalain); ?></td>
                <td ><?php echo rupiah($totalhargabiaya); ?></td>
                <td ><?php echo rupiah($totalhargam); ?></td>
                <td ></td>


            </tr>
        </tbody>
    </table> 
</div>
</div>
<?php else: ?>
    data kosong
<?php endif ?>

</section>
</div>
</div>