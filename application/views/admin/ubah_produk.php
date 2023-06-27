<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p></p>
					<h1>UBAH PRODUK</h1>
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
					<h3>Ubah Produk</h3>
				</div>
			</div> -->

			<div class="row justify-content-center mt-3">
				<div class="col-sm-8">
					<form action="" method="post" enctype="multipart/form-data">
					  <div class="form-group row">
					    <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
					    <div class="col-sm-10">
							<input type="hidden" name="id" value="<?= $produk->id ?>">
						  <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk" value="<?= $produk->nama_produk ?>">
						  <?= form_error('nama_produk', '<small class="text-danger pl-3">', '</small>') ?>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="harga_produk" class="col-sm-2 col-form-label">Harga Produk</label>
					    <div class="col-sm-10">
						  <input type="text" class="form-control" id="harga_produk" name="harga_produk" placeholder="Mis. 10000" value="<?= $produk->harga_produk ?>">
						  <?= form_error('harga_produk', '<small class="text-danger pl-3">', '</small>') ?>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="berat_produk" class="col-sm-2 col-form-label">Berat Produk (gram)</label>
					    <div class="col-sm-10">
						  <input type="text" class="form-control" id="berat_produk" name="berat_produk" placeholder="Mis. 4.9" value="<?= $produk->berat_produk ?>">
						  <?= form_error('berat_produk', '<small class="text-danger pl-3">', '</small>') ?>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
					    <div class="col-sm-10">
						  <input type="text" class="form-control" id="stok" name="stok" placeholder="" value="<?= $produk->stok ?>">
						  <?= form_error('stok', '<small class="text-danger pl-3">', '</small>') ?>
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
					    <div class="col-sm-10">
						  <textarea class="form-control" name="keterangan" id="keterangan" rows="10"><?= $produk->keterangan ?></textarea>
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
					  <!-- gambar -->
					  <div class="form-group row">
					    <label for="" class="col-sm-2 col-form-label"></label>
					    <div class="col-sm-10">

							<table class="table">
								<tbody>
									<!-- tampilkan gambar dari master_produk -->
									<?php if($produk->gambar_produk != ""){ ?>
										<tr>
											<td>
												<img src="<?= base_url('assets/uploads/produk/'.$produk->gambar_produk); ?>" class="" alt="<?= $produk->gambar_produk ?>" style="max-width: 180px; max-height: 180px;">
											</td>
											<td>
												<!-- edit -->
												<a href="javascript:void(0)" class="btn btn-sm btn-warning" title="Edit" onclick="UbahGambar(<?= $produk->id ?>,<?= $produk->id ?>,'master_produk')"><i class="fas fa-edit"></i></a>
												<!-- hapus -->
												<a href="<?= base_url('admin/hapus_gambar_produk/'.md5($produk->id).'/'.md5($produk->id).'/'.md5('master_produk')) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah anda yakin menghapus gambar ini?')"><i class="fas fa-trash-alt"></i></a>
											</td>
										</tr>
									<?php } ?>

									<!-- tampilkan gambar dari master_gambar -->
									<?php if(!empty($gambar_produk)) { ?>
									<?php foreach($gambar_produk as $gambar) { ?>
										<tr>
											<td>
												<img src="<?= base_url('assets/uploads/produk/'.$gambar->nama_gambar); ?>" class="" alt="<?= $gambar->nama_gambar ?>" style="max-width: 180px; max-height: 180px;">
											</td>
											<td>
												<!-- edit -->
												<a href="javascript:void(0)" class="btn btn-sm btn-warning" title="Edit" onclick="UbahGambar(<?= $produk->id ?>,<?= $gambar->gambar_id ?>,'master_gambar')"><i class="fas fa-edit"></i></a>
												<!-- hapus -->
												<a href="<?= base_url('admin/hapus_gambar_produk/'.md5($produk->id).'/'.md5($gambar->gambar_id).'/'.md5('master_gambar')) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah anda yakin menghapus gambar ini?')"><i class="fas fa-trash-alt"></i></a>
											</td>
										</tr>
									<?php } ?>
									<?php } ?>
								</tbody>
							</table>

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

<!-- Modal -->
<div class="modal fade" id="ModalUbahGambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  	<form action="<?= base_url('admin/ubah_gambar_produk') ?>" method="post" enctype="multipart/form-data">
      	<div class="modal-body">
		  	<div class="form-group row">
				<label for="gambar_produk" class="col-sm-2 col-form-label">Gambar</label>
				<div class="col-sm-10">
					<input type="hidden" name="id_produk" id="id_produk" value="">
					<input type="hidden" name="id_gambar" id="id_gambar" value="">
					<input type="hidden" name="letak" id="letak" value="">
					<input type="file" class="form-control" id="gambar_produk" name="gambar_produk" accept="image/*">
					<?= form_error('address', '<small class="text-danger pl-3">', '</small>') ?>
				</div>
			</div>
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
			<button type="submit" class="btn btn-sm btn-primary mr-1">Simpan</button>
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

	function UbahGambar(id_produk, id_gambar, table){
		$('#ModalUbahGambar').find('#id_produk').val(id_produk);
		$('#ModalUbahGambar').find('#id_gambar').val(id_gambar);
		$('#ModalUbahGambar').find('#letak').val(table);
		$('#ModalUbahGambar').modal('show');
	}
	
</script>