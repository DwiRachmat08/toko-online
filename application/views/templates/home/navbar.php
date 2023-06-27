<!-- navbar -->
<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.html">
              					<a class="navbar-brand" href="#" style="color: white !important"><img src="<?= base_url('assets/uploads/logo.png'); ?>" alt="logo.png" style="max-width: 40px; max-height: 40px;">BISNIS CENTER UBHARA</a>
								<!-- <img src="<?= base_url('assets/uploads/logo.png'); ?>" alt="logo"> -->
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a class="" href="<?= base_url('Home/index'); ?>" style="">Beranda</a></li>
								<li>
                  <?php if($this->session->userdata('role') !== null) : ?>
                    <a class="" href="<?= base_url('Admin/index'); ?>" style="">Produk</a>
                  <?php else : ?>
                    <a class="" href="<?= base_url('Produk/index'); ?>" style="">Produk</a>
                  <?php endif; ?>
                </li>
                <?php if($this->session->userdata('role') !== null && $this->session->userdata('role') == 2) : ?>
                  <li>
                    <a class="" href="<?= base_url('Admin/history'); ?>" style="">History</a>
                  </li>
                <?php endif; ?>

                <?php if($this->session->userdata('role') !== null && $this->session->userdata('role') == 1) : ?>
                  <li><a class="" href="<?= base_url('Admin/history'); ?>" style="">History</a></li>
                  <li><a class="" href="<?= base_url('Admin/user'); ?>" style="">User</a></li>
                  <li><a class="" href="<?= base_url('Admin/carousel'); ?>" style="">Carousel</a></li>
                  <li><a class="" href="<?= base_url('Admin/galeri'); ?>" style="">Galeri</a></li>
                  <li><a class="" href="<?= base_url('Admin/setting'); ?>" style="">Setting</a></li>
                <?php endif; ?>

								<li>
									<div class="header-icons">
                    <?php if(!$this->session->userdata('role')) : ?>
                      <a class="" href="<?= base_url('Home/cart'); ?>"><i class="fas fa-shopping-cart" style="" title="Keranjang"></i></a>
                    <?php endif; ?>
                    <?php if($this->session->userdata('role') !== null) : ?>
                      <a class="" href="#" ><i class="fas fa-user"></i> <?= $session['nama']; ?></a>
                      <ul class="sub-menu">
                        <li><a href="<?= base_url('LoginController/logout'); ?>">Keluar</a></li>
                      </ul>
                    <?php endif; ?>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->