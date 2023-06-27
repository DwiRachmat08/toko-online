<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p></p>
					<h1>DATA HISTORY PENJUALAN</h1>
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
			<h3>Data History Penjualan</h3>
		</div>
	</div> -->

	<div class="row mt-3 justify-content-center">
		<div class="col-sm">
		
			<div class="table-responsive">
				<table class="table" id="admin-table-history">
					<thead class="thead-dark">
						<tr class="text-center">
							<th scope="col">No</th>
							<th scope="col" colspan="2">Produk</th>
							<th scope="col">Harga</th>
							<th scope="col">Jumlah</th>
							<th scope="col">Total Harga</th>
							<?php if($this->session->userdata('role') == 1) { ?>
								<th scope="col">Pemilik</th>
							<?php } ?>
							<th scope="col">Status Pesanan</th>
							<?php if($this->session->userdata('role') == 1) { ?>
								<th scope="col">Aksi</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;foreach($history as $p) : ?>
							<tr>
								<td class="text-center"><?= $i++; ?></td>
								<td style="width: 150px;"><img src="<?=  base_url('assets/uploads/produk/'.$p->gambar_produk) ?>" alt="<?= $p->gambar_produk ?>" style="max-width:150px; max-height: 150px;"></td>
								<td class="text-center"><?= $p->nama_produk ?></td>
								<td class="text-right"><?= number_format($p->harga_produk) ?></td>
								<td class="text-center"><?= $p->jumlah_produk ?></td>
								<td class="text-right">
									<?php
										$total_harga = intval($p->harga_produk)*intval($p->jumlah_produk);
										echo number_format($total_harga);
									?>
								</td>
								<?php if($this->session->userdata('role') == 1) { ?>
									<td class="text-center"><?= $p->nama ?></td>
								<?php } ?>
								<td class="text-center"><?= $p->status_pesanan ?></td>
								<?php if($this->session->userdata('role') == 1) { ?>
									<td class="text-center" style="white-space: nowrap;">
										<?php if($p->status_pesanan == 'Belum Dikonfirmasi') { ?>
											<a href="<?= base_url('Admin/konfirmasi_pesanan/'.md5($p->id).'/'.md5('terima')) ?>" class="btn btn-sm btn-success" title="Terima"><i class="fas fa-check"></i></a>
											<a href="<?= base_url('Admin/konfirmasi_pesanan/'.md5($p->id).'/'.md5('tolak')) ?>" class="btn btn-sm btn-danger" title="Tolak"><i class="fas fa-times"></i></a>
											<a href="<?= base_url('Admin/hapus_pesanan/'.md5($p->id)) ?>" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></a>
										<?php }elseif ($p->status_pesanan == 'Diterima') { ?>
											<a href="<?= base_url('Admin/konfirmasi_pesanan/'.md5($p->id).'/'.md5('selesai')) ?>" class="btn btn-sm btn-success" title="Selesai"><i class="fas fa-check-double"></i></a>
											<a href="<?= base_url('Admin/hapus_pesanan/'.md5($p->id)) ?>" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></a>
										<?php }elseif ($p->status_pesanan == 'Ditolak') { ?>
											<a href="<?= base_url('Admin/hapus_pesanan/'.md5($p->id)) ?>" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash-alt"></i></a>
										<?php } ?>
									</td>
								<?php } ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	
</div>