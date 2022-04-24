<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
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
	<link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme.css" /> 
	<link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/skins/default.css" /> 
	<link rel="stylesheet" href="<?php echo base_url()?>assets/stylesheets/theme-custom.css"> 
	<script src="<?php echo base_url()?>assets/vendor/modernizr/modernizr.js"></script>  

</head>
<body class="bgbody">
	<section class="body">

		<!-- start: header -->
		<?php $this->load->view("komponen/header.php") ?>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<?php $this->load->view("komponen/sidebar.php") ?>
			<!-- end: sidebar -->

			<section role="main" class="content-body">
				<header class="page-header">  
					<h2>Master Data</h2>  
				</header>  

				<!-- start: page -->
				<section class="content-with-menu content-with-menu-has-toolbar media-gallery">
					<div class="content-with-menu-container">
						<div class="inner-menu-toggle">
							<a href="#" class="inner-menu-expand" data-open="inner-menu">
								Show Bar <i class="fa fa-chevron-right"></i>
							</a>
						</div> 
						<menu id="content-menu" class="inner-menu" role="menu">
							<div class="nano">
								<div class="nano-content"> 

									<div class="inner-menu-toggle-inside">
										<a href="#" class="inner-menu-collapse">
											<i class="fa fa-chevron-up visible-xs-inline"></i><i class="fa fa-chevron-left hidden-xs-inline"></i> Hide Bar
										</a>
										<a href="#" class="inner-menu-expand" data-open="inner-menu">
											Show Bar <i class="fa fa-chevron-down"></i>
										</a>
									</div>

									<div class="inner-menu-content">  

										<div class="sidebar-widget m-none"> 
											<div class="widget-content">
												<ul class="mg-folders" style="background-color: #003659;">

													<?php if( $this->session->userdata('kategori')==31){?>
														<li>
															<a href="<?php echo base_url()?>master/perumahan" class="menu-item" style="color: white"><i class="fa fa-folder"></i> Master Perumahan</a>
															<div class="item-options">
																<a href="<?php echo base_url()?>master/perumahan">
																	<i class="fa fa-arrow-circle-o-left"></i>
																</a> 
															</div>
														</li> 
														
														<?php
													}?>
													<!-- <?php if( $this->session->userdata('kategori')==31){?>
														<li>
															<a href="<?php echo base_url()?>master/penjual" class="menu-item" style="color: white"><i class="fa fa-folder"></i> Master penjual</a>
															<div class="item-options">
																<a href="<?php echo base_url()?>master/penjual">
																	<i class="fa fa-arrow-circle-o-left"></i>
																</a> 
															</div>
														</li> 
														<?php
													}?>
													<?php if( $this->session->userdata('kategori')==31){?>
														<li>
															<a href="<?php echo base_url()?>master/pembeli" class="menu-item" style="color: white"><i class="fa fa-folder"></i> Master Pembeli</a>
															<div class="item-options">
																<a href="<?php echo base_url()?>master/pembeli">
																	<i class="fa fa-arrow-circle-o-left"></i>
																</a> 
															</div>
														</li> 
														<?php
													}?> -->
												
													<?php if( $this->session->userdata('kategori')==31 || $this->session->userdata('kategori')==33){?>
														<li>
															<a href="<?php echo base_url()?>master/items" class="menu-item" style="color: white"><i class="fa fa-folder"></i> Master Tanah</a>
															<div class="item-options">
																<a href="<?php echo base_url()?>master/items">
																	<i class="fa fa-arrow-circle-o-left"></i>
																</a> 
															</div>
														</li> 

														<li>
															<a href="<?php echo base_url()?>master/sertifikat_tanah" class="menu-item" style="color: white"><i class="fa fa-folder"></i> Master Surat</a>
															<div class="item-options">
																<a href="<?php echo base_url()?>master/sertifikat_tanah">
																	<i class="fa fa-arrow-circle-o-left"></i>
																</a> 
															</div>
														</li> 
														<li>
															<a href="<?php echo base_url()?>master/jenis_pengalihan" class="menu-item" style="color: white"><i class="fa fa-folder"></i> Master Jenis Pengalihan</a>
															<div class="item-options">
																<a href="<?php echo base_url()?>master/jenis_pengalihan">
																	<i class="fa fa-arrow-circle-o-left"></i>
																</a> 
															</div>
														</li> 
														<?php
													}?>

												<!-- 	<?php if( $this->session->userdata('kategori')==31){?>
														<li>
															<a href="<?php echo base_url()?>master/proses_induk" class="menu-item" style="color: white"><i class="fa fa-folder"></i> Master Serah Terima Teknik</a>
															<div class="item-options">
																<a href="<?php echo base_url()?>master/proses_induk">
																	<i class="fa fa-arrow-circle-o-left"></i>
																</a> 
															</div>
														</li>
														<?php
													}?> -->
												</ul>
											</div>
										</div>

									</div>
								</div>
							</div>
						</menu>
						<div class="inner-body mg-main"> 
							<div class="row" style="margin-top:-30px;"> 
								<div class="col-md-6 col-lg-12 col-xl-6">
									<div class="row">
										<div class="col-md-12 col-lg-6 col-xl-6">
											<section class="panel panel-featured-left panel-featured-primary">
												<div class="panel-body">
													<div class="widget-summary">
														<div class="widget-summary-col widget-summary-col-icon">
															<div class="summary-icon bg-primary">
																<i class="fa fa-user"></i>
															</div>
														</div>
														<div class="widget-summary-col">
															<div class="summary">
																<h4 class="title">Jumlah penjual</h4>
																<div class="info">
																	<strong class="amount"><?php echo $total_penjual;?> orang</strong>
																</div>
															</div> 
														</div>
													</div>
												</div>
											</section>
										</div>
										<!-- <div class="col-md-12 col-lg-6 col-xl-6">
											<section class="panel panel-featured-left panel-featured-secondary">
												<div class="panel-body">
													<div class="widget-summary">
														<div class="widget-summary-col widget-summary-col-icon">
															<div class="summary-icon bg-secondary">
																<i class="fa fa-users"></i>
															</div>
														</div>
														<div class="widget-summary-col">
															<div class="summary">
																<h4 class="title">Jumlah Petani</h4>
																<div class="info">
																	<strong class="amount"><?php echo $total_pembeli;?> orang</strong>
																</div>
															</div> 
														</div>
													</div>
												</div>
											</section>
										</div> -->
										<!-- <div class="col-md-12 col-lg-6 col-xl-6">
											<section class="panel panel-featured-left panel-featured-tertiary">
												<div class="panel-body">
													<div class="widget-summary">
														<div class="widget-summary-col widget-summary-col-icon">
															<div class="summary-icon bg-tertiary">
																<i class="fa fa-truck"></i>
															</div>
														</div>
														<div class="widget-summary-col">
															<div class="summary">
																<h4 class="title">Jumlah Agen</h4>
																<div class="info">
																	<strong class="amount"><?php echo $total_agen;?> Orang</strong>
																</div>
															</div> 
														</div>
													</div>
												</div>
											</section>
										</div>
										<div class="col-md-12 col-lg-6 col-xl-6">
											<section class="panel panel-featured-left panel-featured-tertiary">
												<div class="panel-body">
													<div class="widget-summary">
														<div class="widget-summary-col widget-summary-col-icon">
															<div class="summary-icon bg-tertiary">
																<i class="fa fa-truck"></i>
															</div>
														</div>
														<div class="widget-summary-col">
															<div class="summary">
																<h4 class="title">Jumlah Dsitributor</h4>
																<div class="info">
																	<strong class="amount"><?php echo $total_distributor;?> Orang</strong>
																</div>
															</div> 
														</div>
													</div>
												</div>
											</section>
										</div> -->
										<div class="col-md-12 col-lg-6 col-xl-6">
											<section class="panel panel-featured-left panel-featured-secondary">
												<div class="panel-body">
													<div class="widget-summary">
														<div class="widget-summary-col widget-summary-col-icon">
															<div class="summary-icon bg-secondary">
																<i class="fa fa-building"></i>
															</div>
														</div>
														<div class="widget-summary-col">
															<div class="summary">
																<h4 class="title">Jumlah Lokasi Perumahan</h4>
																<div class="info">
																	<strong class="amount"><?php echo $total_regional;?></strong>
																</div>
															</div> 
														</div>
													</div>
												</div>
											</section>
										</div>

										<div class="col-md-12 col-lg-6 col-xl-6">
											<section class="panel panel-featured-left panel-featured-primary">
												<div class="panel-body">
													<div class="widget-summary">
														<div class="widget-summary-col widget-summary-col-icon">
															<div class="summary-icon bg-primary">
																<i class="fa fa-barcode"></i>
															</div>
														</div>
														<div class="widget-summary-col">
															<div class="summary">
																<h4 class="title">Jumlah Tanah</h4>
																<div class="info">
																	<strong class="amount"><?php echo $total_item;?> Tanah</strong>
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
						<!-- 	<div class="row" style="margin-top:-30px;">  

								<div class="col-md-12"> 
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

							</div> -->
						</div>
					</div>
				</section>
				<!-- end: page -->
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
	<script src="<?php echo base_url()?>assets/javascripts/theme.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/admin.min.js"></script> 
	<script src="<?php echo base_url()?>assets/javascripts/theme.init.js"></script>  
	<script>

		$.ajax({
			type: 'GET',
			url: '<?php echo base_url()?>dashboard/produk_terlaris', 
			dataType 	: 'json',
			success: function(response) { 
				var i = 0; 
				var datarow =''; 
				$.each(response.datasub, function(i, itemsub) {
					i = i + 1;
					datarow+="<tr><td>"+i+"</td>"; 
					datarow+="<td>"+itemsub.kode_item+"</td>"; 
					datarow+="<td>"+itemsub.nama_item+"</td>"; 
					datarow+="<td>"+itemsub.total+"</td>";   
					datarow+="</tr>"; 
				});   
				if(datarow == '' ){ 
					$('#produk_terlaris').append('<tr><td colspan="4" align="center"> Tidak ada produk data</td></tr>');
				}else{
					$('#produk_terlaris').append(datarow);
				}
			}
		}); 
	</script>

</body>
</html>