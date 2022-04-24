<div class="panel-body"> 
	<div class="table-responsive"  id="postList"> 
		<table class="table table-bordered table-striped table-condensed mb-none">
			<thead>
				<tr>
					<th>Kode Item</th>
					<th>Nama Item</th>
					<th>No Bet</th>
					<th>Stok Sisa</th> 
					<th>Merk</th>                                 
					<th>Harga Beli</th>                                     
					<th>Stok bawah</th>                                     
					<th>Stok atas</th>                                      
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
							<td><?php echo $post['no_bet']; ?></td> 
							<td><?php echo $post['stok_akhir']; ?></td>
							<td><?php echo $post['merk']; ?></td>
							<td><?php echo $post['harga_beli']; ?></td>
							<td><?php echo $post['stok_minimal']; ?></td>
							<td><?php echo $post['stok_minimalatas']; ?></td>
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