<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html class="fixed sidebar-left-collapsed">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/fav.png" type="image/ico">
    <title>PT Argopuro</title>
    <meta name="author" content="Paber">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/theme.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/skins/default.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/stylesheets/theme-custom.css">


    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/morris/morris.css" />

    <script src="<?php echo base_url() ?>assets/vendor/modernizr/modernizr.js"></script>
</head>

<body class="bgbody">
    <section class="body">

        <?php $this->load->view("komponen/header.php") ?>
        <div class="inner-wrapper">
            <?php $this->load->view("komponen/sidebar.php") ?>
            <section role="main" class="content-body">
                <header class="page-header">
                    <h2>Dashboard</h2>
                </header>
                <!-- start: page -->
                
                <section class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-4">
                                <div class="row">
                                    <div class="col-md-9 col-xl-12">
                                        <section class="panel">
                                            <header class="panel-heading">
                                                <h2 class="panel-title">Jumlah Transaksi Penjualan 2 Minggu Terakhir</h2>
                                            </header>
                                            <div class="panel-body">
                                                <div class="chart chart-md" id="GrafikPenjualan"></div>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-md-3 col-xl-12">
                                        <section class="panel">
                                            <div class="panel-body bg-primary">
                                                <div class="widget-summary">
                                                    <div class="widget-summary-col">
                                                        <div class="summary">
                                                            <h4 class="title">Total Penjualan Hari Ini</h4>
                                                            <div class="info">
                                                                <strong class="amount" id="penjualan_hari_ini"></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="panel">
                                            <div class="panel-body bg-primary">
                                                <div class="widget-summary">
                                                    <div class="widget-summary-col">
                                                        <div class="summary">
                                                            <h4 class="title">Total Penjualan Minggu Ini</h4>
                                                            <div class="info">
                                                                <strong class="amount" id="penjualan_minggu_ini"></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="panel">
                                            <div class="panel-body bg-primary">
                                                <div class="widget-summary">
                                                    <div class="widget-summary-col">
                                                        <div class="summary">
                                                            <h4 class="title">Total Penjualan Bulan Ini</h4>
                                                            <div class="info">
                                                                <strong class="amount" id="penjualan_bulan_ini"></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-9 col-lg-12 col-xl-4">
                                <div class="row">
                                    <div class="col-md-12 col-xl-12">
                                        <section class="panel">
                                            <header class="panel-heading">
                                                <h2 class="panel-title">Pemasukan dan Pengeluaran 2 Minggu Terakhir</h2>
                                            </header>
                                            <div class="panel-body">
                                                <div class="chart chart-md" id="GrafikCash"></div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="row">
                    <div class="col-md-5">
                        <section class="panel">
                            <header class="panel-heading">
                                <h2 class="panel-title">Komisi/penjual <?php echo date("m-Y"); ?></h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none" id="komisi">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama penjual</th>
                                                <th>Total Komisi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                <h2 class="panel-title">Catatan</h2>
                            </header>
                            <?php echo form_open('dashboard_penjual/catatantambah', ' id="FormulirTambah"'); ?>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none" id="catatan">
                                        <thead>
                                            <tr>
                                                <th><button class="btn btn-success btn-xs pull-right" type="submit" id="submitform">Simpan</button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group mt-lg">
                                                        <textarea rows="20" class="form-control" name="isi" id="isi" required></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-7">
                        <section class="panel">
                            <header class="panel-heading">
                                <h2 class="panel-title">Produk Terlaris</h2>
                            </header>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none" id="produk_terlaris">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Item</th>
                                                <th>Nama Produk</th>
                                                <th>Total Terjual</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- end: page -->
            </section>
        </div>
    </section>

    <!-- Vendor -->
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
    <script src="<?php echo base_url() ?>assets/javascripts/theme.js"></script>
    <script src="<?php echo base_url() ?>assets/javascripts/theme.init.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/raphael/raphael.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/morris/morris.js"></script>
    <script>
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>dashboard_penjual/catatan',
            dataType: 'json',
            success: function(response) {
                $.each(response.datasub, function(i, itemsub) {
                    document.getElementById("isi").value = itemsub.isi;
                });
            }
        });

        document.getElementById("FormulirTambah").addEventListener("submit", function(e) {
            blurForm();
            $('.help-block').hide();
            $('.form-group').removeClass('has-error');
            document.getElementById("submitform").setAttribute('disabled', 'disabled');
            $('#submitform').html('Loading ...');
            var form = $('#FormulirTambah')[0];
            var formData = new FormData(form);
            var xhrAjax = $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json'
            }).done(function(data) {
                if (!data.success) {
                    $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                    document.getElementById("submitform").removeAttribute('disabled');
                    $('#submitform').html('Submit');
                    var objek = Object.keys(data.errors);
                    for (var key in data.errors) {
                        if (data.errors.hasOwnProperty(key)) {
                            var msg = '<div class="help-block" for="' + key + '">' + data.errors[key] + '</span>';
                            $('.' + key).addClass('has-error');
                            $('input[name="' + key + '"]').after(msg);
                            $('textarea[name="' + key + '"]').after(msg);
                        }
                        if (key == 'fail') {
                            new PNotify({
                                title: 'Notifikasi',
                                text: data.errors[key],
                                type: 'danger'
                            });
                        }
                    }
                } else {
                    $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                    PNotify.removeAll();
                    tablepembeli.ajax.reload();
                    document.getElementById("submitform").removeAttribute('disabled');
                    $('#tambahData').modal('hide');
                    document.getElementById("FormulirTambah").reset();
                    $('#submitform').html('Submit');
                    new PNotify({
                        title: 'Notifikasi',
                        text: data.message,
                        type: 'success'
                    });
                }
            }).fail(function(data) {
                new PNotify({
                    title: 'Notifikasi',
                    text: "Request gagal, browser akan direload",
                    type: 'danger'
                });
                window.setTimeout(function() {
                    location.reload();
                }, 2000);
            });
            e.preventDefault();
        });

        $.ajax({
            url: '<?php echo base_url() ?>dashboard_penjual/penjualan_2_minggu', // getchart.php
            dataType: 'JSON',
            type: 'GET',
            data: {
                get_values: true
            },
            success: function(response) {
                Morris.Line({
                    resize: true,
                    element: 'GrafikPenjualan',
                    data: response,
                    xkey: 'tanggal',
                    ykeys: ['jumlah'],
                    labels: ['Jumlah Transaksi'],
                    hideHover: true,
                    lineColors: ['#0088cc'],
                    xLabelFormat: function(d) {
                        return ("0" + d.getDate()).slice(-2) + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear();
                    },
                    xLabelAngle: 45,
                });
            }
        });

        $.ajax({
            url: '<?php echo base_url() ?>dashboard_penjual/cash_2_minggu', // getchart.php
            dataType: 'JSON',
            type: 'GET',
            success: function(response) {

                Morris.Line({
                    resize: true,
                    element: 'GrafikCash',
                    data: response,
                    xkey: 'tanggal',
                    ykeys: ['masuk', 'keluar'],
                    labels: ['Uang Masuk (Rp) ', 'Uang Keluar (Rp) '],
                    hideHover: true,
                    lineColors: ['#0088cc', '#734ba9'],
                    xLabelFormat: function(d) {
                        return ("0" + d.getDate()).slice(-2) + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear();
                    },
                    xLabelAngle: 45,
                });
            }
        });


        $.ajax({
            url: '<?php echo base_url() ?>dashboard_penjual/laporan_ringkas', // getchart.php
            dataType: 'JSON',
            type: 'GET',
            success: function(response) {
                $.each(response, function(i, item) {
                    $('#akan_jatuh_tempo').html(item.akan_jatuh_tempo);
                    $('#dibayar_minggu_ini').html(item.dibayar_minggu);
                    $('#total_hutang_belum_bayar').html(item.total_hutang_belum_bayar);
                    $('#penjualan_hari_ini').html(item.total_penjualan_hari_ini);
                    $('#penjualan_minggu_ini').html(item.total_penjualan_minggu_ini);
                    $('#penjualan_bulan_ini').html(item.total_penjualan_bulan_ini);
                    $('#piutang_belum_dibayar').html(item.total_piutang_belum_bayar);
                    $('#sudah_jatuh_tempo').html(item.sudah_jatuh_tempo);
                    $('#total_po').html(item.total_po);
                    $('#total_pembelian').html(item.total_pembelian);
                    $('#total_penerimaan').html(item.total_penerimaan);
                    $('#total_retur').html(item.total_retur);
                    $('#target1').html(item.target1);
                    $('#target2').html(item.target2);
                    $('#target3').html(item.target3);
                    $('#target4').html(item.target4);
                    $('#total_jual_ppn').html(item.total_jual_ppn);
                    $('#total_jual_nonppn').html(item.total_jual_nonppn);
                    $('#total_jual_prekusor').html(item.total_jual_prekusor);
                    $('#total_jual_oot').html(item.total_jual_oot);
                    $('#total_target').html(item.total_target);
                    if (item.stattarget1) {
                     $("#panelppn").attr("class", "panel-body bg-success");
                 }
                 if (item.stattarget2) {
                     $("#panelnonppn").attr("class", "panel-body bg-success");
                 }
                 if (item.stattarget4) {
                     $("#panelprekusor").attr("class", "panel-body bg-success");
                 }
                 if (item.stattarget4) {
                     $("#paneloot").attr("class", "panel-body bg-success");
                 }
             });
            }
        });

        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>dashboard_penjual/produk_kadaluarsa',
            dataType: 'json',
            success: function(response) {
                var i = 0;
                var datarow = '';
                $.each(response.datasub, function(i, itemsub) {
                    i = i + 1;
                    datarow += "<tr><td>" + i + "</td>";
                    datarow += "<td>" + itemsub.kode_item + "</td>";
                    datarow += "<td>" + itemsub.nama_item + "</td>";
                    datarow += "<td>" + itemsub.tgl_expired + "</td>";
                    datarow += "</tr>";
                });
                if (datarow == '') {
                    $('#kadaluarsa').append('<tr><td colspan="4" align="center"> Tidak ada produk akan kadaluarsa</td></tr>');
                } else {
                    $('#kadaluarsa').append(datarow);
                }
            }
        });

        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>dashboard_penjual/produk_terlaris',
            dataType: 'json',
            success: function(response) {
                var i = 0;
                var datarow = '';
                $.each(response.datasub, function(i, itemsub) {
                    i = i + 1;
                    datarow += "<tr><td>" + i + "</td>";
                    datarow += "<td>" + itemsub.kode_item + "</td>";
                    datarow += "<td>" + itemsub.nama_item + "</td>";
                    datarow += "<td>" + itemsub.total + "</td>";
                    datarow += "</tr>";
                });
                if (datarow == '') {
                    $('#produk_terlaris').append('<tr><td colspan="4" align="center"> Tidak ada produk data</td></tr>');
                } else {
                    $('#produk_terlaris').append(datarow);
                }
            }
        });

        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>dashboard_penjual/komisi',
            dataType: 'json',
            success: function(response) {
                var i = 0;
                var datarow = '';
                $.each(response.datasub, function(i, itemsub) {
                    i = i + 1;
                    datarow += "<tr><td>" + i + "</td>";
                    datarow += "<td>" + itemsub.nama_penjual + "</td>";
                    datarow += "<td>" + itemsub.total + "</td>";
                    datarow += "</tr>";
                });
                if (datarow == '') {
                    $('#komisi').append('<tr><td colspan="4" align="center"> Tidak ada data untuk sementara ini</td></tr>');
                } else {
                    $('#komisi').append(datarow);
                }
            }
        });
    </script>
</body>

</html>