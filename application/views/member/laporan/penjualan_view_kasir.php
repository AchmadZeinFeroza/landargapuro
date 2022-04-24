<table class="table table-bordered table-striped table-condensed mb-none">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Stok Sisa</th>
        </tr>
    </thead>
    <tbody> 
    <?php 
$total = 0;
foreach($posts as $post): ?> 
<tr>
    <td><?php echo tgl_indo($post['tanggal']); ?></td>
    <td><?php echo $post['nama_item']; ?></td>
    <td><?php echo $post['kuantiti']; ?></td>
    <td><?php echo $post['satuan']; ?></td> 
    <td class="text-right"><?php echo $post['stok_sisa']; ?> <?php echo $post['satuan']; ?></td> 
</tr> 
<?php 
    $total += $post['total'];
?>
<?php endforeach;?>  
</tbody>
</table>
<ul class="pagination">
<?php echo $this->ajax_pagination->create_links(); ?>
</ul> 