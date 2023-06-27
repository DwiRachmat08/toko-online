<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p></p>
					<h1>KERANJANG</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<div class="container mt-5">
	
    <div class="row mt-3 text-center">
		<div class="col-sm">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>

	<!-- <div class="row text-center">
		<div class="col-sm">
			<h3>Keranjang Anda</h3>
		</div>
	</div> -->

	<div class="row mt-3 justify-content-center bg-light">
		<div class="col-sm-11 text-justify py-3 table-responsive">
			
        <table class="table table-hover">
            <thead>
                <tr>
                    <!-- <th scope="col"></th> -->
                    <th scope="col" colspan="2" class="text-center">Produk</th>
                    <th scope="col" class="text-center">Harga</th>
                    <th scope="col" class="text-center">Jumlah</th>
                    <th scope="col" class="text-center">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($cart_user)) : ?>
                    <?php foreach($cart_user as $cart) : ?>
                        <?php if($cart->is_aktif == 1) : ?>
                        <tr>
                            <!-- <td>
                                <input type="checkbox" name="pilih[]" id="pilih">
                            </td> -->
                            <td style="width: 150px;"><img src="<?=  base_url('assets/uploads/produk/'.$cart->gambar_produk) ?>" alt="<?= $cart->gambar_produk ?>" style="max-width:150px; max-height: 150px;"></td>
                            <td><?= $cart->nama_produk ?></td>
                            <td class="text-right"><b><?= number_format($cart->harga_produk) ?></b></td>
                            <td class="text-center">
                                <input type="number" name="jumlah_produk[]" id="jumlah_produk" class="text-right" style="width:60px" min="0" max="<?= $cart->stok ?>" value="<?= $cart->jumlah_produk ?>" onchange="ubahjumlahproduk(this)">
                            </td>
                            <td class="text-right">
                                <input type="hidden" name="cart_id[]" value="<?= $cart->id ?>" id="cart_id">
                                <?php
                                    $harga_total = intval($cart->harga_produk) * intval($cart->jumlah_produk);
                                ?>
                                <b id="total_per_produk"><?= number_format($harga_total)  ?></b>
                            </td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">Data Tidak Ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <table class="table">
            <tbody>
                <tr>
                    <td colspan="5" class="text-right"><b>Total Keseluruhan</b></td>
                    <td class="text-right"><b id="total_keseluruhan"></b></td>
                </tr>
                <tr>
                    <td colspan="6" class="text-right">
                        <a href="<?= base_url('Home/beli') ?>" class="btn btn-sm btn-primary" target="_blank">Beli</a>
                    </td>
                </tr>
            </tbody>
        </table>

		</div>
	</div>

</div>