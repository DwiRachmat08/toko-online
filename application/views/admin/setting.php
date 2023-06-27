<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p></p>
					<h1>PENGATURAN APLIKASI</h1>
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
            <h3>Pengaturan Aplikasi</h3>
        </div>
    </div> -->

    <div class="row justify-content-center mt-3">
        <div class="col-sm-8">
            <form action="<?= base_url('Admin/setting') ?>" method="post">
                <div class="form-group row">
                    <label for="about" class="col-sm-2 col-form-label">About</label>
                    <div class="col-sm-10">
                    <textarea class="tinymce" name="about" id="about"><?= $setting->about ?></textarea>
                    <?= form_error('about', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="about" class="col-sm-2 col-form-label">Syarat & Ketentuan</label>
                    <div class="col-sm-10">
                    <textarea class="tinymce" name="syarat_ketentuan" id="syarat_ketentuan"><?= $setting->syarat_ketentuan ?></textarea>
                    <?= form_error('syarat_ketentuan', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="about" class="col-sm-2 col-form-label">Beranda</label>
                    <div class="col-sm-10">
                    <textarea class="tinymce" name="beranda" id="beranda"><?= $setting->beranda ?></textarea>
                    <?= form_error('beranda', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="notelp" class="col-sm-2 col-form-label">No.WA</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="notelp" id="notelp" value="<?= $setting->notelp ?>">
                    <?= form_error('notelp', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                
                <div class="form-group row justify-content-center">
                    <button type="submit" class="btn btn-sm btn-primary mr-1">Simpan</button>
                </div>
            
            </form>
        </div>
    </div>
</div>