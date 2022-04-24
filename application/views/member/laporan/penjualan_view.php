<table class="table table-bordered table-striped table-condensed mb-none">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Barang</th>
            <th>Harga Item</th>
            <th>Kuantiti</th>
            <th>Total Harga</th>
            <th>Stok Sisa</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody> 
    <?php 
$total = 0;
foreach($posts as $post): ?> 
<tr>
    <td><?php echo tgl_indo($post['tanggal']); ?></td>
    <td><?php echo $post['nama_item']; ?></td>
    <td class="text-right"><?php echo rupiah($post['harga']); ?></td>
    <td class="text-right"><?php echo $post['kuantiti']; ?></td>
    <td class="text-right"><?php echo rupiah($post['total']); ?></td>
    <td class="text-right"><?php echo $post['stok_sisa']; ?></td> 
    <td class="text-right"><?php echo $post['nama_admin']; ?></td> 
</tr> 
<?php 
    $total += $post['total'];
?>
<?php endforeach;?>  
<tr>
    <td colspan="3"></td>
    <td><b>Total</b></td>
    <td class="text-right"><b> <?=rupiah($total)?></b></td>
</tr>
</tbody>
</table>
<ul class="pagination">
<?php echo $this->ajax_pagination->create_links(); ?>
</ul> 