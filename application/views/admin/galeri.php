<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p></p>
					<h1>DATA GALERI</h1>
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
    <div class="row pt-2">
        <div class="col-sm text-center">
            <h3>Tambah Galeri</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm text-center">
            <form action="<?= base_url('admin/tambah_galeri') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pilih Galeri</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="listGaleri[]" accept="image/*" multiple>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <button type="submit" class="btn btn-sm btn-outline-primary mr-1">Upload</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row pt-2">
        <div class="col-sm text-center">
            <h3>Galeri</h3>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-sm-8">

            <div class="table-responsive">
                <table class="table" id="admin-table-carousel">
                    <thead class="text-center">
                        <th>No</th>
                        <th colspan="2">Galeri</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($galeri as $gb) : ?>
                            <tr>
                                <td class="text-center"><?= $i++ ?></td>
                                <td><img src="<?= base_url('assets/uploads/galeri/'.$gb->nama_galeri) ?>" alt="<?= $gb->nama_galeri ?>" style="max-width: 100px"></td>
                                <td><?= $gb->nama_galeri ?></td>
                                <td class="text-center">
                                    <?php if($gb->is_aktif == 1) : ?>
										<a href="<?= base_url('Admin/nonaktifkan_galeri/'.md5($gb->id)) ?>" class="btn btn-sm btn-danger" title="Nonaktifkan"><i class="fas fa-lock"></i></a>
									<?php else : ?>
										<a href="<?= base_url('Admin/aktifkan_galeri/'.md5($gb->id)) ?>" class="btn btn-sm btn-success" title="Aktifkan"><i class="fas fa-lock-open"></i></a>
									<?php endif; ?>
                                    <a href="<?= base_url('Admin/hapus_galeri/'.md5($gb->id)) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>