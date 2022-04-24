<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html class="fixed sidebar-left-collapsed">
<head>  
    <meta charset="UTF-8"> 
    <link rel="shortcut icon" href="<?php echo base_url()?>/assets/images/favicon.png" type="image/ico">   
    <title>PT Airlangga sentral internasional</title>    
    <meta name="author" content="Paber">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/select2/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/skins/default.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme-custom.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/pnotify/pnotify.custom.css" />

    <!-- Head Libs -->
    <script src="<?php echo base_url()?>/assets/vendor/modernizr/modernizr.js"></script>
</head>
<body class="bgbody">
    <section class="body">

        <?php $this->load->view("komponen/header.php") ?>
        <div class="inner-wrapper"> 
            <?php $this->load->view("komponen/sidebar.php") ?>
            <section role="main" class="content-body">
                <header class="page-header">  
                    <h2>Laporan Stok</h2>
                </header>  
                <form id="Formulir" method="GET" action="<?php echo base_url();?>laporan/excel_stok/" target="_blank">
                    <!-- start: page --> 
                    <section class="panel"> 
                        <div class="panel-body">  
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Awal</label>
                                        <input type="text" id="firstdate"  name="firstdate" class="form-control tanggal">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Akhir</label>
                                        <input type="text" id="lastdate" name="lastdate" class="form-control tanggal">
                                    </div>
                                </div> 
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="control-label">Nama Obat</label>
                                        <select  data-plugin-selectTwo class="form-control"  id="obat" name="obat">  
                                            <option value="">Semua Obat</option>
                                            <?php foreach ($obat as $supp): ?>
                                                <option value="<?php echo $supp->kode_item;?>"><?php echo $supp->nama_item;?></option>
                                            <?php endforeach; ?>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer class="panel-footer">
                            <span onclick="searchFilter()" class="btn btn-primary" id="TampilkanHTML">
                                <i class="fa fa-search"></i> Tampilkan HTML
                            </span>
                            <button type="submit"  class="btn btn-primary" id="ExportKeExcel">
                                <i class="fa fa-file-excel-o"></i> Export Excel
                            </button>
                            <button type="reset" class="btn btn-danger" id="ResetBtn">
                                <i class="fa fa-history"></i> Reset
                            </button>
                        </footer>
                    </section>
                </form>
                <section class="panel" id="KontenHTML" > 
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
            </section>
        </div>
    </section>


    <!-- Vendor -->
    <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/select2/select2.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
    <script src="<?php echo base_url()?>assets/javascripts/theme.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/pnotify/pnotify.custom.js"></script>
    <script src="<?php echo base_url()?>assets/javascripts/theme.init.js"></script> 
    <script type="text/javascript">
        $('.tanggal').datepicker({
            format: 'yyyy-mm-dd' 
        });   
        function searchFilter(page_num) { 
            page_num = page_num?page_num:0; 
            var firstdate = $('#firstdate').val();
            var lastdate = $('#lastdate').val();
            var obat = $('#obat').val();
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>laporan/laporanstokkritis/'+page_num,
                data: 'page='+page_num+'&obat='+obat+'&firstdate='+firstdate+'&lastdate='+lastdate,success: function (html) { 
                    $('#postList').html(html);
                    document.getElementById("KontenHTML").style.display = "block";  
                }
            }); 
        }

        document.getElementById("ResetBtn").addEventListener("click", function (e) {  
            document.getElementById("Formulir").reset();  
            document.getElementById("KontenHTML").style.display = "none";   
        });


    </script>
</body>
</html>