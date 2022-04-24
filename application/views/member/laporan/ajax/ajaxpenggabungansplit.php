    <style>
        #itemsdata thead tr {
            background-color: #34495e;
            color: #fff;
        }
    </style>
    <div class="panel-body"> 
        <div class="table" style="overflow-x: auto;overflow-y: auto;">
            <table class="table table-bordered table-hover table-striped data" id="itemsdata">
                <thead>
                    <tr>

                        <th rowspan="2" style="text-align: center;vertical-align: middle; ">NO</th>
                        <th rowspan="2" style="text-align: center;vertical-align: middle;">NO SHGB</th>
                        <th colspan="4" style="text-align: center;vertical-align: middle;">LUAS M<SUP>2</SUP></th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">TANGGAL</th>
                        <th colspan="2" style="text-align: center;vertical-align: middle;">NOMOR</th>
                        <th rowspan="2" style="text-align: center;vertical-align: middle;">TARGET PENYELESAIAN</th>
                        <th rowspan="2" style="text-align: center;vertical-align: middle;">KET</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;vertical-align: middle;">SURAT</th>
                        <th style="text-align: center;vertical-align: middle;">DAFTAR</th>
                        <th style="text-align: center;vertical-align: middle;">TERBIT</th>
                        <th style="text-align: center;vertical-align: middle;">SELISIH</th>
                        <th style="text-align: center;vertical-align: middle;">DAFTAR</th>
                        <th style="text-align: center;vertical-align: middle;">TERBIT</th>
                        <th style="text-align: center;vertical-align: middle;">BERKAS</th>
                        <th style="text-align: center;vertical-align: middle;">SHGB</th>

                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td>A</td>
                        <td colspan="3">Proses sd. Tahun 2019</td>
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
                $no=1;
                foreach ($terbitshgbseb as $r) { 
                    $row = array();
                    $tombolhapus = level_user('master','items',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="'.$this->security->xss_clean($r->id_proses_induk).'">Hapus</a></li>':'';
                    $tomboledit = level_user('master','items',$this->session->userdata('kategori'),'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="'.$this->security->xss_clean($r->id_proses_induk).'">Edit</a></li>':'';
                    $tombol = ' 
                    <div class="btn-group dropup">
                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
                    <ul class="dropdown-menu" role="menu"> 
                    <li><a href="#" onclick="detail(this)" data-id="'.$this->security->xss_clean($r->id_proses_induk).'">Detail</a></li> 
                    '.$tomboledit.'
                    '.$tombolhapus.' 
                    </ul>
                    </div>
                    ';

                    ?>
                    <tr>
                         <td><?php echo $no++; //echo $tombol; ?></td>
                        <!--<td><?php echo $r->nama_surat_tanah ?></td>-->
                        <td><?php echo $r->no_terbit_shgb ?></td>
                        <td><?php echo $r->no_surat_tanah ?></td>
                        <td><?php echo $r->luas ?></td>
                        <td><?php echo $r->luas_daftar ?></td>
                        <td><?php echo $r->luas_terbit ?></td>
                        <!--<td><?php echo $r->luas_daftar-$r->luas_terbit ?></td>-->
                        <td><?php echo tgl_indo($r->tanggal_daftar_sk_hak) ?></td>
                        <!--<td><?php echo $r->no_daftar_sk_hak ?></td>-->
                        <td><?php echo tgl_indo($r->tanggal_terbit_sk_hak) ?></td>
                        <!--<td><?php echo $r->no_terbit_sk_hak ?></td>-->
                        <!--<td><?php echo tgl_indo($r->tanggal_daftar_shgb) ?></td>-->
                        <td><?php echo $r->no_daftar_shgb ?></td>
                        <!--<td><?php echo tgl_indo($r->tanggal_terbit_shgb) ?></td>-->
                        <td><?php echo $r->no_terbit_shgb ?></td>
                        <!--<td><?php echo tgl_indo($r->masa_berlaku_shgb) ?></td>-->
                        <td><?php echo tgl_indo($r->target_penyelesaian) ?></td>
                        <td><?php echo $r->keterangan ?></td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td colspan="19"></td>

                    </tr>
                    <tr>
                        <td>-</td>
                        <td colspan="4">Jumlah A : </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="12"></td>
                    </tr>
                    <tr>
                        <td>B</td>
                        <td colspan="3">Proses Tahun 2020</td>
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
                $no=1;
                foreach ($terbitshgbses as $r) { 
                    $row = array();
                    $tombolhapus = level_user('master','items',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="'.$this->security->xss_clean($r->id_proses_induk).'">Hapus</a></li>':'';
                    $tomboledit = level_user('master','items',$this->session->userdata('kategori'),'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="'.$this->security->xss_clean($r->id_proses_induk).'">Edit</a></li>':'';
                    $tombol = ' 
                    <div class="btn-group dropup">
                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
                    <ul class="dropdown-menu" role="menu"> 
                    <li><a href="#" onclick="detail(this)" data-id="'.$this->security->xss_clean($r->id_proses_induk).'">Detail</a></li> 
                    '.$tomboledit.'
                    '.$tombolhapus.' 
                    </ul>
                    </div>
                    ';

                    ?>
                    <tr>
                       <td><?php echo $no++; ?></td>
                        <!--<td><?php echo $r->penjual ?></td>-->
                        <td><?php echo $r->no_terbit_shgb ?></td>
                        <td><?php echo $r->no_surat_tanah ?></td>
                        <!--<td><?php echo $r->nama_surat_tanah ?></td>-->
                     <!--    <td><?php echo $r->nama_surat_tanah ?></td>
                        <!--<td><?php echo $r->no_surat_tanah ?></td> -->-->
                        <td><?php echo $r->luas ?></td>
                        <td><?php echo $r->luas_daftar ?></td>
                        <td><?php echo $r->luas_terbit ?></td>
                        <!--<td><?php echo $r->luas_daftar-$r->luas_terbit ?></td>-->
                        <td><?php echo tgl_indo($r->tanggal_daftar_sk_hak) ?></td>
                        <!--<td><?php echo $r->no_daftar_sk_hak ?></td>-->
                        <td><?php echo tgl_indo($r->tanggal_terbit_sk_hak) ?></td>
                        <!--<td><?php echo $r->no_terbit_sk_hak ?></td>-->
                        <!--<td><?php echo tgl_indo($r->tanggal_daftar_shgb) ?></td>-->
                        <td><?php echo $r->no_daftar_shgb ?></td>
                        <!--<td><?php echo tgl_indo($r->tanggal_terbit_shgb) ?></td>-->
                        <td><?php echo $r->no_terbit_shgb ?></td>
                        <!--<td><?php echo tgl_indo($r->masa_berlaku_shgb) ?></td>-->
                        <td><?php echo tgl_indo($r->target_penyelesaian) ?></td>
                        <td><?php echo $r->keterangan ?></td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td>-</td>
                        <td colspan="4">Jumlah B : </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="12"></td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td colspan="4"><b>Total :</b>: </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </tbody>
            </table> 
        </div>

    </div>
