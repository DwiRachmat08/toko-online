<div class="container mt-5">
	<div class="row text-center">
		<div class="col-sm">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-sm text-center">
			<h1 style="font-family: montserrat; font-size: 60px; color: #3d4585"><b>BISNIS CENTER UBHARA</b></h1>
		</div>
	</div>

	<div class="row justify-content-center mt-3">
		<div class="col-sm-4 kotak">
			<div class="row" style="margin-top: 70px;">
				<div class="col-sm text-center">
					<h3 style="color: white">Login</h3>
				</div>
			</div>
			<div class="row mt-3 mb-2">
				<div class="col-sm">
					<form action="<?= base_url('LoginController/index'); ?>" method="post">
					  <div class="form-group">
					    <input type="text" class="form-control" id="username" name="username" placeholder="username">
					    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
					  </div>
					  <div class="form-group">
					    <input type="password" class="form-control" id="password" name="password" placeholder="password">
					    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
					  </div>
					  <div class="form-group text-center">
					  	<button type="submit" class="btn btn-sm btn-outline-primary">Login</button>
						<a href="<?= base_url(); ?>" class="btn btn-sm btn-outline-dark">Ke Beranda</a>
					  </div>

					  <div class="form-group text-center">
					  	<!-- <a id="registrasi" href="<?= base_url('LoginController/registrasi'); ?>" style="color: white">Buat akun</a> -->
					  </div>
					  
					</form>
				</div>
			</div>
			
		</div>
	</div>


	<!-- <div class="row mt-3">
		<div class="col-sm-3">

			<div class="row">
				<div class="col-sm text-center">
					<h3 style="color: white">Login</h3>
				</div>
			</div>
			<div class="row justify-content-center mt-3">
				<div class="col-md-6 col-sm text-center">
					<form action="<?= base_url('LoginController/index'); ?>" method="post">
							<div>
								<input type="text" class="input mb-2" id="username" name="username" placeholder="Username" value="<?= set_value('username');?>"><br>

								<?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div>
								<input type="password" class="input mb-2" name="password" placeholder="Password"><br>

								<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div>
								<button type="submit" class="button mb-2" value="Login">Login</button>
								
							</div>
							<div>
								<a id="registrasi" href="<?= base_url('LoginController/registrasi'); ?>">Buat akun</a>
							</div>
							
						</form>
				</div>
			</div>

		</div>

		<div class="col-sm-9">
			<div class="row">
				<div class="col-sm">
					<h3 style="color: white">Selamat Datang di UPN-MARKET</h3>
				</div>
			</div>
		</div>
	</div> -->
	
</div>

	

