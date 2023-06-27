<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p></p>
					<h1>DATA PRODUK</h1>
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
			<h3>Data Produk</h3>
		</div>
	</div> -->

	<div class="row mt-3 justify-content-center">
		<div class="col-sm">
			
		<a class="btn btn-sm btn-outline-primary mb-2" href="<?= base_url('Admin/tambah_produk'); ?>">Tambah Produk</a>
			<div class="table-responsive">
				<table class="table" id="admin-table-produk">
					<thead class="thead-dark">
						<tr class="text-center">
							<th scope="col">No</th>
							<th scope="col" colspan="2">Nama Produk</th>
							<th scope="col">Keterangan</th>
							<th scope="col">Harga</th>
							<th scope="col">Berat (gram)</th>
							<th scope="col">Stok</th>
							<th scope="col">Aktif</th>
							<?php if($this->session->userdata('role') == 1) : ?>
							<th scope="col">Pemilik</th>
							<?php endif; ?>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;foreach($produk as $p) : ?>
							<tr>
								<td><?= $i++; ?></td>
								<td style="width: 150px;"><img src="<?=  base_url('assets/uploads/produk/'.$p->gambar_produk) ?>" alt="<?= $p->gambar_produk ?>" style="max-width:150px; max-height: 150px;"></td>
								<td><?= $p->nama_produk ?></td>
								<td><?= $p->keterangan ?></td>
								<td class="text-right"><b><?= number_format($p->harga_produk) ?></b></td>
								<td class="text-center"><?= $p->berat_produk ?></td>
								<td class="text-center"><?= $p->stok ?></td>
								<td class="text-center"><?= ($p->is_aktif==1)?'Aktif':'Tidak AKtif' ?></td>
								<?php if($this->session->userdata('role') == 1) : ?>
								<td class="text-center"><?= $p->nama ?></td>
								<?php endif; ?>
								<td class="text-center" style="white-space: nowrap;">
									<?php if($this->session->userdata('id') == $p->user_id) : ?>
										<a href="<?= base_url('Admin/ubah_produk/'.md5($p->id)) ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
										<?php if($p->is_aktif == 1) : ?>
											<a href="<?= base_url('Admin/nonaktifkan_produk/'.md5($p->id)) ?>" class="btn btn-sm btn-danger" title="Nonaktifkan"><i class="fas fa-lock"></i></a>
										<?php else : ?>
											<a href="<?= base_url('Admin/aktifkan_produk/'.md5($p->id)) ?>" class="btn btn-sm btn-success" title="Aktifkan"><i class="fas fa-lock-open"></i></a>
										<?php endif; ?>
										<a href="<?= base_url('Admin/hapus_produk/'.md5($p->id)) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash-alt"></i></a>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	
</div>