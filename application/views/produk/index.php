<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Kami Menjual Produk-Produk Berkualitas</p>
					<h1>PRODUK</h1>
					<p><?= !empty($toko) ? '<b>(<i class="fa fa-store"></i> '.$toko->nama.')</b>' : '' ?></p>
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
			<h5>Produk <?= !empty($toko) ? 'dari toko <b>'.$toko->nama.'</b>' : '' ?></h5>
		</div>
	</div> -->

	<div class="row mt-4">
		<div class="col-sm">

			<div class="row mt-2 justify-content-center">
				<?php foreach($produk as $p) : ?>
					<div class="col-sm-4 col-md-3 col-6 col-md-offset-2 mt-4">
						
						<div class="card h-100" style="border-color: #3d4585">
						  <img src="<?= base_url('assets/uploads/produk/') . $p->gambar_produk ?>" class="card-img-top" alt="..." style="width: auto;height: 200px;">
						  <div class="card-body">
						    <h5 class="card-title"><?= $p->nama_produk; ?></h5>
						    <!-- <p class="card-text">Rp <?= number_format($p->harga_produk) ?></p> -->
							<!-- <p class="card-text">Stok : <b><?= $p->stok ?></b></p> -->
							<div class="card-text">
								<span style="display: inline-block; width: 50%">Rp <?= number_format($p->harga_produk) ?></span>
								<span style="display: inline-block; width: 45%; text-align: right">Stok : <b><?= $p->stok ?></b></span>
							</div>

							<div class="mt-3 text-center">
								<a href="#" class="btn btn-sm btn-outline-secondary <?= $p->stok<1 ? 'disabled' : '' ?>" data-id='<?= md5($p->id) ?>' onclick="addCart(this)">Add to cart</a>
								<a href="<?= base_url('Produk/detail/') . md5($p->id) ?>" class="btn btn-sm btn-outline-warning">Detail</a>

							</div>
							
						  </div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

</div>