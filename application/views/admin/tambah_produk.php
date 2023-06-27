<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p></p>
					<h1>TAMBAH PRODUK</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

		<div class="container mt-3 mb-5">
			<div class="row pt-5">
				<div class="col-sm text-center">
					<?= $this->session->flashdata('message'); ?>
				</div>
			</div>
			<!-- <div class="row pt-2">
				<div class="col-sm text-center">
					<h3>Tambah Produk</h3>
				</div>
			</div> -->

			<div class="row justify-content-center mt-3">
				<div class="col-sm-8">
					<form action="<?= base_url('Admin/tambah_produk') ?>" method="post" enctype="multipart/form-data">
					  <div class="form-group row">
					    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
					    <div class="col-sm-10">
						  <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="<?= set_value('nama_produk') ?>">
						  <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>') ?>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="harga_produk" class="col-sm-2 col-form-label">Harga Produk</label>
					    <div class="col-sm-10">
						  <input type="text" class="form-control" id="harga_produk" name="harga_produk" placeholder="Mis. 10000" value="<?= set_value('harga_produk') ?>">
						  <?= form_error('harga_produk', '<small class="text-danger pl-3">', '</small>') ?>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="berat_produk" class="col-sm-2 col-form-label">Berat Produk (gram)</label>
					    <div class="col-sm-10">
						  <input type="text" class="form-control" id="berat_produk" name="berat_produk" placeholder="Mis. 4.9" value="<?= set_value('berat_produk') ?>">
						  <?= form_error('berat_produk', '<small class="text-danger pl-3">', '</small>') ?>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
					    <div class="col-sm-10">
						  <input type="text" class="form-control" id="stok" name="stok" placeholder="" value="<?= set_value('stok') ?>">
						  <?= form_error('stok', '<small class="text-danger pl-3">', '</small>') ?>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
					    <div class="col-sm-10">
						  <textarea class="form-control" name="keterangan" id="keterangan" rows="10"></textarea>
						  <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>') ?>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="gambar_produk" class="col-sm-2 col-form-label">Gambar</label>
					    <div class="col-sm-10">
						  <input type="file" class="form-control" id="gambar_produk" name="gambar_produk[]" accept="image/*" multiple>
						  <?= form_error('address', '<small class="text-danger pl-3">', '</small>') ?>
					    </div>
					  </div>
					  <div class="form-group row justify-content-center">
						  <a href="<?= base_url('Admin/index') ?>" class="btn btn-sm btn-outline-secondary mr-1">Back</a>
						  <button type="submit" class="btn btn-sm btn-outline-primary mr-1">Simpan</button>
					  </div>
					  
					</form>
				</div>
			</div>
		</div>
		
		<script>
			$(document).ready(function(){
				$('#clear').on('click', function(){
					$('#name').val('');
					$('#email').val('');
					$('#address').val('');
				})
			});
		</script>
		
