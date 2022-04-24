   <section class="panel">
      <header class="panel-heading">    
        <div class="row show-grid">
          <div class="col-md-6" align="left"><h2 class="panel-title">Nama Perumahan | Proses Tahun 2019</h2></div>
          <form action="" method="get">
            <div class="form-group mt-lg nama_target">
              <div class="col-sm-5">
              </div>
            </form>

          </div>
        </header>
        <div class="panel-body"> 
<div class="table" style="overflow-x: auto;white-space: nowrap;">
         <table class="table table-bordered table-hover table-striped" id="itemsdata">
          <thead>

           <tr>
             <th style="text-align: center;vertical-align: middle;">NO</th>
             <th style="text-align: center;vertical-align: middle;">Aksi</th>
             <th style="text-align: center;vertical-align: middle;">INDUK</th>
             <th style="text-align: center;vertical-align: middle;">Jumlah Unit</th>
             <th style="text-align: center;vertical-align: middle;">KETERANGAN</th>

           </tr>

           

         </thead>
         <tbody>

           <?php 
                $no=1;
                foreach ($splitseb as $r) { 
                    // $tombolhapus = level_user('master','items',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="'.$this->security->xss_clean($r->id_split).'">Hapus</a></li>':'';
                    $tomboledit = level_user('master','items',$this->session->userdata('kategori'),'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="'.$this->security->xss_clean($r->id_split).'">Edit</a></li>':'';
                    $tombol = ' 
                    <div class="btn-group dropup">
                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
                    <ul class="dropdown-menu" role="menu"> 
                    <li><a href="#" onclick="detail(this)" data-id="'.$this->security->xss_clean($r->id_split).'">Detail</a></li> 
                    '.$tomboledit.'
                    </ul>
                    </div>
                    ';

                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $tombol; ?></td>
                        <td><?php echo $r->id_proses_induk ?></td>
                        <td><?php echo 'jumlah unit' ?></td>
                        <td><?php echo $r->keterangan ?></td>
                     
                    </tr>
                <?php } ?>
                
           <tr>
             <th colspan="13" bgcolor="grey"></th>

           </tr>
           <tr>

             <th colspan="2">JUMLAH A</th>

             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
           </tr> <tr>

             <th colspan="2">TOTAL </th>

             <th></th>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
           </tr>
         </tbody>
       </table> 
     </div>
             </div>
      </section>

        <section class="panel">
        <header class="panel-heading">    
          <div class="row show-grid">
            <div class="col-md-6" align="left"><h2 class="panel-title">Nama Perumahan | Proses Tahun 2020</h2></div>
            <?php  
            echo level_user('master','items',$this->session->userdata('kategori'),'add') > 0 ? '<div class="col-md-6" align="right"><a class="btn btn-success" href="#"  data-toggle="modal" data-target="#tambahData"><i class="fa fa-plus"></i> Tambah</a></div>':'';
            ?> 
          </div>
        </header>
        <div class="panel-body"> 
          <div class="table" style="overflow-x: auto;white-space: nowrap;">
            <table class="table table-bordered table-hover table-striped" id="prosesbaru">
              <thead>

           <tr>
             <th style="text-align: center;vertical-align: middle;">NO</th>
             <th style="text-align: center;vertical-align: middle;">Aksi</th>
             <th style="text-align: center;vertical-align: middle;">INDUK</th>
             <th style="text-align: center;vertical-align: middle;">Jumlah Unit</th>
             <th style="text-align: center;vertical-align: middle;">KETERANGAN</th>

           </tr>




             </thead>
             <tbody>
               <?php 
                $no=1;
                foreach ($splitses as $r) { 
                    // $tombolhapus = level_user('master','items',$this->session->userdata('kategori'),'delete') > 0 ? '<li><a href="#" onclick="hapus(this)" data-id="'.$this->security->xss_clean($r->id_split).'">Hapus</a></li>':'';
                    $tomboledit = level_user('master','items',$this->session->userdata('kategori'),'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="'.$this->security->xss_clean($r->id_split).'">Edit</a></li>':'';
                    $tombol = ' 
                    <div class="btn-group dropup">
                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
                    <ul class="dropdown-menu" role="menu"> 
                    <li><a href="#" onclick="detail(this)" data-id="'.$this->security->xss_clean($r->id_split).'">Detail</a></li> 
                    '.$tomboledit.'
                    </ul>
                    </div>
                    ';

                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $tombol; ?></td>
                        <td><?php echo $r->id_proses_induk ?></td>
                        <td><?php echo 'jumlah unit' ?></td>
                        <td><?php echo $r->keterangan ?></td>
                     
                    </tr>
                <?php } ?>
             <tr>
               <th colspan="13" bgcolor="grey"></th>

             </tr>
             <tr>

               <th colspan="2">JUMLAH A</th>

               <th></th>
               <th></th>
               <th></th>
               <th></th>
               <th></th>
             </tr>
             <tr>

               <th colspan="2">TOTAL </th>

               <th></th>
               <th></th>
               <th></th>
               <th></th>
               <th></th>
             </tr>

           </tbody>

         </table> 
       </div>
     </div>
   </section>
