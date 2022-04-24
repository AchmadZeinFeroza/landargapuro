<table class="table table-bordered table-striped table-condensed mb-none">
                                <thead>
                                    <tr>
                                        <th>Waktu Aktifitas</th>
                                        <th>Nama User</th>
                                        <th>Kegiatan</th> 
                                        <th>Nama Komputer</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                            <?php 
                            $total = 0;
                            if (empty($data_log)) {
                                echo '<td colspan="8" align="center">Data Masih Kosong</td>';
                            }else{
                            foreach($data_log as $post): ?> 
                            <tr>
                                <td><?php echo date('H:i:s', strtotime($post['waktu_log'])).", ".tgl_indo(date('Y-m-d', strtotime($post['waktu_log']))); ?></td>
                                <td><?php echo $post['nama_admin']; ?></td>
                                <td><?php echo $post['kegiatan']; ?></td>
								<td><?php echo $post['nama_komputer']; ?></td>
                            </tr>
                            <?php endforeach;
                                    }
                            ?>  
                            </tbody>
                            </table>
                            <ul class="pagination">
                            <?php echo $this->ajax_pagination->create_links(); ?>
                            </ul>