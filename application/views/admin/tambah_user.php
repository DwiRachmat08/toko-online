<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p></p>
					<h1>TAMBAH USER</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<div class="container mt-3 ">
	<div class="row text-center">
		<div class="col-sm">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>
	
	<!-- <div class="row text-center mt-5">
		<div class="col-sm">
			<h3 style="color: white">Tambah User</h3>
		</div>
	</div> -->

	<div class="row mt-4 justify-content-center">
		<div class="col-sm-8">
			
			<form action="" method="post">
			  <div class="form-group row">
			    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>">
			      <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="username" class="col-sm-2 col-form-label">Username</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>">
			      <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="password" class="col-sm-2 col-form-label">Password</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password'); ?>">
			      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
			    </div>
			  </div>
			  <!-- <div class="form-group row">
				<label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
				<div class="col-sm-10">
					<select name="provinsi" id="provinsi" class="form-control">
						<option value="">-- Pilih Provinsi --</option>
						<?php foreach($provinsi as $p) : ?>
							<option value="<?= $p['province_id']; ?>"><?= $p['province']; ?></option>
						<?php endforeach; ?>
					</select>
					<?= form_error('provinsi', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>
			  </div>
			  <div class="form-group row">
				<label for="kota" class="col-sm-2 col-form-label">Kota</label>
				<div class="col-sm-10">
					<select class="form-control" name="kota" id="kota" disabled>
						<option value="">-- Pilih Kota --</option>
					</select>
					<?= form_error('kota', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>
			  </div>
			  <div class="form-group row">
			    <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" value="<?= set_value('alamat_lengkap'); ?>">
			      <?= form_error('alamat_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
			    </div>
			  </div> -->
			  <div class="form-group row">
			    <label for="telp" class="col-sm-2 col-form-label">No.Telp</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="telp" name="telp" value="<?= set_value('telp'); ?>">
			      <?= form_error('telp', '<small class="text-danger pl-3">', '</small>'); ?>
			    </div>
			  </div>
			  
			  <div class="form-group row text-center">
			    <div class="col-sm-10">
			    	<a class="btn btn-outline-dark" href="<?= base_url('Admin/user'); ?>">Kembali</a>
			     	<button type="submit" class="btn btn-outline-primary">Buat akun</button>
			    </div>
			  </div>
			</form>

		</div>
	</div>



</div>

	
