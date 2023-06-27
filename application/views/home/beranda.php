<!-- <div id="top" class="text-center"> -->
	<!-- <div class="row justify-content-center">
		<div class="col-sm col-xs col-md">
			<div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel">
				<div class="carousel-inner">
					<?php $i = 1; foreach($gambar_promo as $promo) : ?>
						<div class="carousel-item<?= $i==1 ? ' active' : '' ?>" data-interval="3000">
							<img src="<?= base_url('assets/uploads/promo/'.$promo->gambar) ?>" class="d-block" alt="..." style="height: 90vh; width: inherit">
						</div>
					<?php $i++; endforeach; ?>
				</div>
			</div>
		</div>
	</div> -->
		
<!-- </div> -->

<!-- home page slider -->
<div class="homepage-slider">
	<?php foreach($gambar_promo as $key=>$promo) : ?>
		
		<div class="single-homepage-slider" style="background-image: url(<?= base_url('assets/uploads/promo/'.$promo->gambar) ?>);">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">ANEKA PRODUK</p>
								<h1>Kreativitas Mahasiswa UBHARA</h1>
								<div class="hero-btns"> -->
									<!-- <a href="shop.html" class="boxed-btn">Fruit Collection</a> -->
									<!-- <a href="contact.html" class="bordered-btn">Contact Us</a> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php endforeach; ?>
	
</div>

<div class="container mt-3">
	<!-- Teks Beranda -->
	<section class="mt-5 bg-light">
		<div id="fh5co-product">
			<div class="row mt-2 px-2 animate-box">
				<div class="col-sm col-md-offset-2 text-justify" style="font-size: 18px;">
					<?= $setting->beranda ?>
				</div>
			</div>
		</div>
	</section>
	<!-- End Teks Beranda -->

	<!-- product section -->
	<section>
		<div class="product-section mt-150">
			<div class="container">
				<div class="row animate-box">
					<div class="col-lg-8 offset-lg-2 text-center">
						<div class="section-title">	
							<h3><span class="orange-text">Produk</span> Terbaru</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end product section -->

	<!-- advertisement section -->
	<section>
		<?php $i=1; foreach($terbaru as $t) : ?>
		<div class="abt-section mb-150">
			<div class="container">
				<div class="row animate-box">
					<?php if($i%2 == 0) { ?>
						<div class="col-lg-6 col-md-6 col-sm">
							<img src="<?= base_url('assets/uploads/produk/') . $t->gambar_produk ?>" class="card-img-top" alt="..." style="">	
						</div>
						<div class="col-lg-6 col-md-6 col-sm">
							<div class="abt-text">
								<p class="top-sub"></p>
								<h2><?= $t->nama_produk; ?></h2>
								<p><?= $t->keterangan; ?></p>
							</div>
						</div>
					<?php }else{ ?>
						<div class="col-lg-6 col-md-6 col-sm">
							<div class="abt-text">
								<p class="top-sub"></p>
								<h2><?= $t->nama_produk; ?></h2>
								<p><?= $t->keterangan; ?></p>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm">
							<img src="<?= base_url('assets/uploads/produk/') . $t->gambar_produk ?>" class="card-img-top" alt="..." style="">	
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php $i++;endforeach; ?>
	</section>
	<!-- end advertisement section -->

	<!-- Teks Galeri -->
	<section>
		<div class="product-section mt-150">
			<div class="container">
				<div class="row animate-box">
					<div class="col-lg-8 offset-lg-2 text-center">
						<div class="section-title">	
							<h3><span class="orange-text">GAL</span>ERI</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="mt-2 bg-light">
		<div id="fh5co-product">
			<div class="row mt-2 px-2 animate-box galeri-popup">
				<?php foreach($galeri as $gal) : ?>
				<div class="col-xs col-sm-6 col-md-2 col-md-offset-2 text-justify mb-3" style="font-size: 18px;">
					<a href="<?= base_url('assets/uploads/galeri/') . $gal->nama_galeri ?>" class="popup-link-mgf" target="_blank"><img src="<?= base_url('assets/uploads/galeri/') . $gal->nama_galeri ?>" alt="<?= $gal->nama_galeri ?>" class="img-galeri"></a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<!-- End Galeri -->

	<!-- <section class="mt-5">
		<div class="row justify-content-center">
			<div class="col-sm">
				<div class="row animate-box">
					<div class="col-sm text-center">
						<h5>Produk Terbaru</h5>
					</div>
				</div>
				<div class="row mt-3 justify-content-center animate-box">
					<?php foreach($terbaru as $t) : ?>
					<div class="col-sm-3">
						<div class="card h-100" style="border-color: #3d4585">
							<img src="<?= base_url('assets/uploads/produk/') . $t->gambar_produk ?>" class="card-img-top" alt="..." style="width: auto;height: 200px;">
							<div class="card-body">
								<h5 class="card-title"><?= $t->nama_produk; ?></h5>
								<div class="card-text">
									<span style="display: inline-block; width: 50%">Rp <?= number_format($t->harga_produk) ?></span>
									<span style="display: inline-block; width: 45%; text-align: right">Stok : <b><?= $t->stok ?></b></span>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section> -->





</div>