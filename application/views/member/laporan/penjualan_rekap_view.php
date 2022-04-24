<table class="table table-bordered table-striped table-condensed mb-none">
    <thead>
        <tr>
            <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
            <th>Terjual</th>
            <th>Sisa Stok</th>
            
        </tr>
    </thead>
    <tbody> 
        <?php 
        $no = 1;
        foreach($posts as $post): 
         // $tombolhapus =  '<li><a href="#" onclick="hapus(this)" data-id="'.$post['id'].'">Hapus</a></li>';

         // $tombolaksi = ' 
         // <div class="btn-group dropup">
         // <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Action </button>
         // <ul class="dropdown-menu" role="menu">
         // <li><a href="#" onclick="detail(this)"  data-id="'.$this->security->xss_clean($post['id']).'">Detail</a></li> 
         // '.$tombolhapus.'
         // </ul>
         // </div>
         // ';
         ?> 
         <tr>
            <td><?php echo $no++; ?></td> 
            <td><?php echo $post['kode_item']; ?></td> 
            <td><?php echo $post['nama_item']; ?></td> 
            <td><?php echo $post['terjual']; ?> <?php echo $post['satuan']; ?></td>
            <td><?php echo $post['stok']; ?> <?php echo $post['satuan']; ?></td> 
        </tr>  
       
    <?php endforeach;?>  
   
</tbody>
</table>
<ul class="pagination">
    <?php echo $this->ajax_pagination->create_links(); ?>
</ul> 

  