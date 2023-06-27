<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p></p>
					<h1>DATA USER</h1>
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
			<h3>Data User</h3>
		</div>
	</div> -->

	<div class="row mt-3 justify-content-center">
		<div class="col-sm">
			
		<a class="btn btn-sm btn-outline-primary mb-2" href="<?= base_url('Admin/tambah_user'); ?>">Tambah User</a>
			<div class="table-responsive">
				<table class="table" id="admin-table-user">
					<thead class="thead-dark">
						<tr class="text-center">
							<th scope="col">No</th>
							<th scope="col">Nama</th>
							<th scope="col">Username</th>
							<th scope="col">No.Telp/WA</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;foreach($user as $p) : ?>
							<tr>
								<td class="text-center"><?= $i++; ?></td>
								<td class="text-center"><?= $p->nama ?></td>
								<td class="text-center"><?= $p->username ?></td>
								<td class="text-center"><?= $p->telp ?></td>
								<td class="text-center" style="white-space: nowrap;">
									<a href="<?= base_url('Admin/ubah_user/'.md5($p->id)) ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
									<?php if($p->is_aktif == 1) : ?>
										<a href="<?= base_url('Admin/nonaktifkan_user/'.md5($p->id)) ?>" class="btn btn-sm btn-danger" title="Nonaktifkan"><i class="fas fa-lock"></i></a>
									<?php else : ?>
										<a href="<?= base_url('Admin/aktifkan_user/'.md5($p->id)) ?>" class="btn btn-sm btn-success" title="Aktifkan"><i class="fas fa-lock-open"></i></a>
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