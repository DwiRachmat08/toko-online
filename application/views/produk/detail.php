<style>
body {
  font-family: Arial;
  margin: 0;
}

* {
  box-sizing: border-box;
}

img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: #f8f9fa;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #f8f9fa;
  padding: 2px 16px;
  color: white;
}

.row_gambar:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
</style>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p></p>
					<h1>DETAIL PRODUK</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<div class="container">

	<div class="row mt-3 text-center">
		<div class="col-sm">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>
		
	<!-- <div class="row mt-3 text-center">
		<div class="col-sm">
			<h5>Data Produk</h5>
		</div>
	</div> -->

	<div class="row mt-3 bg-light">
		<div class="col-sm">

			<div class="row pt-3">
				<!-- gambar -->
				<div class="col-md-6 col-sm col-xs">
					<?php if($produk->gambar_produk != ''){ ?>
						<div class="mySlides">
							<img src="<?= base_url('assets/uploads/produk/'.$produk->gambar_produk) ?>" style="width:100%">
						</div>
					<?php } ?>
					<?php if(!empty($gambar_produk)) { ?>
						<?php foreach($gambar_produk as $gambar){ ?>
							<div class="mySlides">
								<img src="<?= base_url('assets/uploads/produk/'.$gambar->nama_gambar) ?>" style="width:100%">
							</div>
						<?php } ?>
					<?php } ?>
						
					<a class="prev" onclick="plusSlides(-1)">❮</a>
					<a class="next" onclick="plusSlides(1)">❯</a>

					<div class="caption-container">
						<p id="caption"></p>
					</div>

					<div class="row_gambar">
						<?php 
							$n=1; 
						?>
						<?php if($produk->gambar_produk != ''){ ?>
							<div class="column">
								<img class="demo cursor" src="<?= base_url('assets/uploads/produk/'.$produk->gambar_produk) ?>" style="width:100%" onclick="currentSlide(<?= $n ?>)" alt="<?= $produk->gambar_produk ?>">
							</div>
							<?php $n++; ?>
						<?php } ?>
						<?php if(!empty($gambar_produk)) { ?>
							<?php foreach($gambar_produk as $gambar){ ?>
								<div class="column">
									<img class="demo cursor" src="<?= base_url('assets/uploads/produk/'.$gambar->nama_gambar) ?>" style="width:100%" onclick="currentSlide(<?= $n ?>)" alt="<?= $gambar->nama_gambar ?>">
								</div>
								<?php $n++; ?>
							<?php } ?>
						<?php } ?>

					</div>
				</div>
				<!-- detail -->
				<div class="col-md-6 col-sm col-xs">
					
					<form action="<?= base_url('Produk/transaksi/') . $produk->id ?>" method="post">
					  <div class="form-group row">
					    <div class="col-sm-10">
					      <input type="hidden" readonly class="form-control" id="id_produk" name="id_produk" value="<?= $produk->id ?>">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="nama" class="col-sm-5 col-form-label">Cari Produk Berdasarkan Toko Ini : </label>
					    <div class="col-sm-7" style="padding-top: 7px;">
					      <a href="<?= base_url('Produk/index/'.md5($produk->user_id)) ?>" style="color: black;"><b><?= $produk->nama ?></b></a>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
					    <div class="col-sm-10">
					      <input type="text" readonly class="form-control" id="nama" name="nama" value="<?= $produk->nama_produk ?>">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
					    <div class="col-sm-10">
					      <input type="text" readonly class="form-control" id="harga" name="harga" value="Rp <?= number_format($produk->harga_produk) ?>">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="berat" class="col-sm-2 col-form-label">Berat</label>
					    <div class="col-sm-10">
					      <input type="text" readonly class="form-control" id="berat" name="berat" value="<?= $produk->berat_produk ?> gram">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
					    <div class="col-sm-10">
					      <input type="text" readonly class="form-control" id="stok" name="stok" value="<?= $produk->stok ?>">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="keterangan" readonly class="col-sm-2 col-form-label">Keterangan</label>
					    <div class="col-sm-10">
					      <textarea type="text" readonly class="form-control" id="keterangan" name="keterangan" rows="5"><?= $produk->keterangan ?></textarea>
					    </div>
					  </div>
					  <div class="form-group row text-right">
					    <div class="col-sm-10">
					    	<a class="btn btn-sm btn-outline-dark" href="javascript:window.history.go(-1)">Kembali</a>
							<a href="#" class="btn btn-sm btn-outline-secondary <?= $produk->stok<1 ? 'disabled' : '' ?>" data-id='<?= md5($produk->id) ?>' onclick="addCart(this)">Add to cart</a>
							<a href="<?= base_url('Home/beli/'.md5($produk->id)) ?>" class="btn btn-sm btn-outline-primary <?= $produk->stok<1 ? 'disabled' : '' ?>" target="_blank">Beli</a>
					    </div>
					  </div>
					</form>

				</div>
				
			</div>

		</div>

	</div>

</div>

<script>
	let slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
		showSlides(slideIndex += n);
	}

	function currentSlide(n) {
		showSlides(slideIndex = n);
	}

	function showSlides(n) {
		let i;
		let slides = document.getElementsByClassName("mySlides");
		let dots = document.getElementsByClassName("demo");
		let captionText = document.getElementById("caption");
		if (n > slides.length) {slideIndex = 1}
		if (n < 1) {slideIndex = slides.length}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[slideIndex-1].style.display = "block";
		dots[slideIndex-1].className += " active";
		// captionText.innerHTML = dots[slideIndex-1].alt;
	}
</script>