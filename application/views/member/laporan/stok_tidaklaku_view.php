<table class="table table-bordered table-striped table-condensed mb-none">
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Kode Item</th>
			<th>Nama Item</th>
			<th>Stok Sisa</th> 
			<th>Satuan</th>  
			<th>Harga Jual 1</th>
			<th>Harga Jual 2</th>
			<th>Harga Jual 3</th>
			<th>Harga Jual 4</th>										
			<th>Komisi</th>										
			<th>Harga Beli</th>										
			<th>Stok min</th>										
			<th>Jenis</th>  
			<th>Ket</th>
		</tr>
	</thead>
	<tbody> 
		<?php 
		if (empty($posts)) {
			echo '<td colspan="8" align="center">Data Bulan Ini Kosong</td>';
		}else{
			foreach($posts as $post): ?> 
				<tr> 
					<td><?php echo $post['kode_item']; ?></td> 
					<td><?php echo $post['nama_item']; ?></td> 
					<td><?php echo $post['stok_akhir']; ?></td>
					<td><?php echo $post['satuan_kecil']; ?></td>
					<td><?php echo $post['harga_jual']; ?></td>  
					<td><?php echo $post['harga_jual_distributor']; ?></td>
					<td><?php echo $post['harga_jual_3']; ?></td>
					<td><?php echo $post['harga_jual_4']; ?></td>
					<td><?php echo $post['komisi']; ?></td>
					<td><?php echo $post['harga_beli']; ?></td>
					<td><?php echo $post['stok_sisa']; ?></td>
					<td><?php echo $post['jenis']; ?></td>
					<td><?php echo $post['keterangan']; ?></td> 
				</tr> 
			<?php endforeach;
			} ?>

		</tbody>
	</table>
	<ul class="pagination">
		<?php echo $this->ajax_pagination->create_links(); ?>
	</ul> 
</div>
</div>