<html class="fixed sidebar-left-collapsed">
<head>  
  <meta charset="UTF-8"> 
  <link rel="shortcut icon" href="<?php echo base_url()?>/assets/images/fav.png" type="image/ico">   
  <title>PT Argopuro</title>    
  <meta name="author" content="Paber"> 
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/font-awesome/css/font-awesome.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/magnific-popup/magnific-popup.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme.css" /> 
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/skins/default.css" /> 
  <link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme-custom.css"> 
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/pnotify/pnotify.custom.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/isotope/jquery.isotope.css" />

  <script src="<?php echo base_url()?>assets/vendor/modernizr/modernizr.js"></script>  
  <style type="text/css" media="print">
    #tabel1{
        width: 280px;
    }
</style>
</head>
<body style="background:white;">
    <div class="row">
        <div class="col-md-3" style="margin-left: 10px;color: black;">

            PT Argopuro<br>
            Jalan Manggis No 11 Patrang- Jember<br>
            0853-3149-8686
        </div>
        <div class="col-md-4" style="margin-left: 10px; color:  black; font-size: 14px;">
            Faktur Penjualan No : <?=$penjualan?> <br>
            Tanggal Transaksi   : <?=date('d M Y')?>
        </div>
        <div class="col-md-3 " style=" float: right;">
            <img src="<?php echo base_url()?>assets/images/logo.png ?>" />
        </div>
        <!-- <div class="col-md-1" style="background: rgb(35,103,9);
        background: linear-gradient(90deg, rgba(35,103,9,1) 0%, rgba(238,170,33,1) 35%, rgba(236,137,28,1) 100%);"></div> -->
    </div>
    <table class="table table-condensed">
<!--     <tr>
        <td>
                    <img src="<?php echo base_url()?>assets/images/<?php echo $this->db->get_where('profil_apotek', array('id' => '1'),1)->row()->logo; ?>" height="35" alt="Logo" />
        </td>
        <?php foreach ($apotik as $key) {?>
        <td width="50%"><h3><b><?=ucwords(strtolower($key['nama_apotek']))?></b></h3>
		</td>
        <?php
        }?>
        <td></td>
        <td style="text-align: right;"><h3> Faktur Penjualan</h3></td>
    </tr> -->
    <tr>

    </tr>
    <tr>
        <td>
            <table class="table table-borderless" style=" border: 1px solid black;">
                <tr>
                    <td>No.</td><td>:</td><td><?=date('dmy')."/".$penjualan?></td>
                </tr>
                <tr>
                    <td>Tanggal</td><td>:</td><td><?=date('d M Y')?></td>
                </tr>
                               <tr>
                    <td>No. Order/penjual</td><td>:</td><td><?=$penjualan?>/<?= $penjual; ?></td>
                </tr>
            </table>
        </td>
        <td><table style="outline: thick solid #AAAAAA;" class="table"> <td align="center">
            <h3><b> PELANGGAN </b></h3></td>
        </table></td>
        <td>
            <table class="table table-borderless" style=" border: 1px solid black;">
                <?php
                foreach ($pembeli as $key) {
                    ?>
                    <tr>
                        <td>Kepada</td><td>:</td><td><?=ucwords(strtolower($key['nama_pembeli']))?>
                    </td>
                </tr>
                <tr>
                    <td></td><td></td><td><?=ucwords(strtolower($key['alamat']))?>
                </td>
            </tr>
        <?php
    }
    ?>
</table>
</td>
</tr>
<tr>
    <td colspan="3">
        <table class="table table-bordered" style=" border: 1px solid black;">
            <tr>
                <th>Jumlah</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
            
            <?php
            $ttl1 = 0;
            $ttl2 = 0;
            foreach ($keranjang as $key) {
                ?>
                <tr>

                    <td><?=$key['kuantiti']?></td>
                    <td><?=$key['nama_item']?></td>
                    <td><?=$key['harga']?></td>
                    <td align="right"><?=rupiah($key['total'])?></td>
                </tr>

                <?php
                $ttl1 += $key['total'];
            }
            ?>
        </table>
    </td>
</tr>
<tr>
    <td>
        <table class="table table-borderless" style=" border: 1px solid black;">
            <tr>
                <td>Terbilang</td><td>:</td><td><?=terbilang($ttl1)?></td>
            </tr>

        </table>
    </td>
    <td></td>
    <td>
        <table id="tabel1" class="table table-borderless" style=" border: 1px solid black;">
                <tr>
                    <td><b> Total Akhir </b></td><td>:</td><td align="right"><?=rupiah($ttl1)?></td>
                </tr>
                <tr>
                    <td><b> Total Bayar </b></td><td>:</td><td align="right"><?=rupiah($totalbayar)?></td>
                </tr>
                <tr>
                    <td><b> Kembalian </b></td><td>:</td><td align="right"><?=rupiah($totalbayar-$ttl1)?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <?php foreach ($apotik as $keys) {?>
            <table class="table table-borderless">
                <tr style="margin-bottom:50px;">
                    <td align="center">Penerima</td>
                    <td align="center">Hormat Kami, <?=ucwords(strtolower($keys['nama_apotek']))?><br><br><br><br></td>
                </tr>
                <tr>
                    <?php
                    foreach ($pembeli as $key) {
                        ?>
                        <td align="center"><?=ucwords(strtolower($key['nama_pembeli']))?></td>    
                        <td align="center"><?=ucwords(strtolower($penjual))?>
                    </td>

                </tr>
            </table>
        </tr>
        <?php
    }
}?>
</table>
</body>