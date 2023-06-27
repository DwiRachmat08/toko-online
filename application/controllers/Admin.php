<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nama'))
		{
			redirect('Home');
		}
		$this->load->model('LoginModel');
		$this->load->model('UserModel');
		$this->load->model('PromoModel');
		$this->load->model('CartModel');
		$this->load->model('ProdukModel');
		$this->load->model('HistoryModel');
		$this->load->model('MasterGambarModel');
	}

    public function index(){
        $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
        if($this->session->userdata('role') == 1){
            $data['produk'] = $this->ProdukModel->getProdukAllAdmin();
		}elseif ($this->session->userdata('role') == 2) {
            $data['produk'] = $this->ProdukModel->getProdukAllAdmin($this->session->userdata('id'));
        }

        $this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('admin/data_produk', $data);
		$this->load->view('templates/home/footer');
    }

    public function user(){
        $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
        $data['user'] = $this->UserModel->getAllUser();

        $this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('admin/data_user', $data);
		$this->load->view('templates/home/footer');
    }

    public function tambah_user()
	{
        $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
        $get_provinsi = $this->rajaongkir->province();
		$provinsi = json_decode($get_provinsi, true);
		$data['provinsi'] = $provinsi['rajaongkir']['results'];

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[20]|alpha_numeric_spaces');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]|alpha_numeric_spaces');
		// $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
		// $this->form_validation->set_rules('kota', 'Kota', 'required');
		// $this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'required|max_length[100]');
		$this->form_validation->set_rules('telp', 'No.Telp', 'required|is_natural|max_length[12]');

		if($this->form_validation->run() == false)
		{
			$this->load->view('templates/home/header');
            $this->load->view('templates/home/navbar', $data);
            $this->load->view('admin/tambah_user', $data);
            $this->load->view('templates/home/footer');
		}
		else{
            
			$this->load->model('LoginModel');
			if(!empty($this->LoginModel->tambah_akun())){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Akun telah berhasil dibuat
                </div>');
                redirect('Admin/user');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-error" role="alert">'.$this->db->error().'</div>');
                redirect('Admin/tambah_user');
            }
			
		}

	}

    public function ubah_user($id){
        $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
        $data['user'] = $this->UserModel->getUserById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[20]|alpha_numeric_spaces');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]|alpha_numeric_spaces');
		// $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
		// $this->form_validation->set_rules('kota', 'Kota', 'required');
		// $this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'required|max_length[100]');
		$this->form_validation->set_rules('telp', 'No.Telp', 'required|is_natural|max_length[12]');

        if($this->form_validation->run() == false){
            $this->load->view('templates/home/header');
            $this->load->view('templates/home/navbar', $data);
            $this->load->view('admin/ubah_user', $data);
            $this->load->view('templates/home/footer');
        }
        else{
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            // $provinsi = $this->input->post('provinsi');
            // $kota = $this->input->post('kota');
            // $alamat_lengkap = $this->input->post('alamat_lengkap');
            $telp = $this->input->post('telp');

            $user = [
                'nama' 		=> $nama,
                'username' 	=> $username,
                'password' 	=> md5($password),
                // 'provinsi'	=> $provinsi,
                // 'kota'	=> $kota,
                // 'alamat_lengkap'	=> $alamat_lengkap,
                'telp'	=> $telp,
                'role_id'	=> 2,
                'is_aktif' => 1,
                'updated_at' => date('Y-m-d H:i:s')

            ];
            $simpan_user = $this->UserModel->UbahUser($user,$id);

            if($simpan_user > 0){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Akun telah berhasil diubah
                </div>');
                
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal ubah data
                </div>');
            }
            redirect('Admin/user');
        }
    }

    public function nonaktifkan_user($id){
        $data = [
            'is_aktif' => 0,
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $simpan_user = $this->UserModel->UbahUser($data,$id);
        if($simpan_user > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil ubah data
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal ubah data
            </div>');
        }
        redirect('Admin/user');
    }
    
    public function aktifkan_user($id){
        $data = [
            'is_aktif' => 1,
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $simpan_user = $this->UserModel->UbahUser($data,$id);
        if($simpan_user > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil ubah data
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal ubah data
            </div>');
        }
        redirect('Admin/user');
    }

    public function tambah_produk(){
        $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));

        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga_produk', 'Harga Produk', 'required|integer');
        $this->form_validation->set_rules('berat_produk', 'Berat Produk', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required|integer');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        // $this->form_validation->set_rules('gambar_produk', 'Gambar Produk', 'required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/home/header');
            $this->load->view('templates/home/navbar', $data);
            $this->load->view('admin/tambah_produk', $data);
            $this->load->view('templates/home/footer');
        }
        else{
            // echo "<pre>";
            // var_dump($_FILES['gambar_produk']);die;
            
            $linkName = $_FILES['gambar_produk']['name'][0];
            $linkTempName = $_FILES['gambar_produk']['tmp_name'][0];
            $location = './assets/uploads/produk/';

            $rename = "PRODUK_".$linkName;
            $upload = move_uploaded_file($linkTempName, $location.$rename);
            if($upload){
                $photo = $rename;
            }
            else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal upload file!
                </div>');
                redirect('Admin/tambah_produk');
            }
            $new = [
                "nama_produk" => $this->input->post('nama_produk'),
                "keterangan" => $this->input->post('keterangan'),
                "harga_produk" => $this->input->post('harga_produk'),
                "gambar_produk" => $photo,
                "berat_produk" => $this->input->post('berat_produk'),
                "stok" => $this->input->post('stok'),
                "is_aktif" => 1,
                "created_at" => date('Y-m-d H:i:s'),
                "user_id" => $this->session->userdata('id')
            ];
            $simpan_produk = $this->ProdukModel->TambahProduk($new);

            if($simpan_produk > 0){
                unset($_FILES['gambar_produk']['name'][0]);
                unset($_FILES['gambar_produk']['tmp_name'][0]);

                $hitung_gambar = count($_FILES['gambar_produk']['name']);
                if($hitung_gambar > 0){
                    $simpan_gambar_sukses = true;
                    for($i=1; $i<=$hitung_gambar; $i++){
                        $linkName = $_FILES['gambar_produk']['name'][$i];
                        $linkTempName = $_FILES['gambar_produk']['tmp_name'][$i];
                        $location = './assets/uploads/produk/';

                        $rename = "PRODUK_".$linkName;
                        $upload = move_uploaded_file($linkTempName, $location.$rename);
                        if($upload){
                            $photo = $rename;
                        }
                        else{
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                            Gagal upload file! '.$i.'
                            </div>');
                            redirect('Admin/tambah_produk');
                        }

                        $new_gambar = [
                            "produk_id" => $simpan_produk,
                            "nama_gambar" => $photo,
                            "created_at" => date('Y-m-d H:i:s')
                        ];
                        $simpan_foto = $this->MasterGambarModel->TambahGambar($new_gambar);

                        if($simpan_foto > 0){
                            $simpan_gambar_sukses &= true;
                        }else{
                            $simpan_gambar_sukses &= false;
                        }
                    }

                    if($simpan_gambar_sukses == true){
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Berhasil menambah gambar
                        </div>');
                    }else{
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Gagal menambah gambar
                        </div>');
                    }
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil menambah data
                    </div>');
                }
                
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal menambah data
                </div>');
            }
            redirect('Admin');
        }
    }

    public function ubah_produk($id){
        $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
        $data['produk'] = $this->ProdukModel->getProdukById($id);
        $data['gambar_produk'] = $this->MasterGambarModel->getGambarByProdukId($id);

        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga_produk', 'Harga Produk', 'required|integer');
        $this->form_validation->set_rules('berat_produk', 'Berat Produk', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required|integer');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        // $this->form_validation->set_rules('gambar_produk', 'Gambar Produk', 'required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/home/header');
            $this->load->view('templates/home/navbar', $data);
            $this->load->view('admin/ubah_produk', $data);
            $this->load->view('templates/home/footer');
        }
        else{
            $sukses = true;
            
            $new = [
                "nama_produk" => $this->input->post('nama_produk'),
                "keterangan" => $this->input->post('keterangan'),
                "harga_produk" => $this->input->post('harga_produk'),
                // "gambar_produk" => $photo,
                "berat_produk" => $this->input->post('berat_produk'),
                "stok" => $this->input->post('stok'),
                // "is_aktif" => 1,
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $simpan_produk = $this->ProdukModel->UbahProduk($new,$id);

            if($simpan_produk > 0){
                $sukses &= true;

                // simpan gambar
                if(!empty($_FILES['gambar_produk'])){
                    $jumlah_gambar = count($_FILES['gambar_produk']['name']);
                    for ($i=0; $i < $jumlah_gambar; $i++) { 
                        $linkName = $_FILES['gambar_produk']['name'][$i];
                        $linkTempName = $_FILES['gambar_produk']['tmp_name'][$i];
                        $location = './assets/uploads/produk/';

                        $rename = "PRODUK_".$linkName;
                        $upload = move_uploaded_file($linkTempName, $location.$rename);
                        if($upload){
                            $photo = $rename;
                        }else{
                            $photo = '';
                        }

                        // cek gambar pada master_produk, kalo kosong update master_produk, kalo ada insert ke master_gambar
                        $cek_foto = $this->ProdukModel->getProdukById($id);
                        if($cek_foto->gambar_produk == ''){
                            $new = [
                                "gambar_produk" => $photo,
                                "updated_at" => date('Y-m-d H:i:s')
                            ];
                            $simpan_produk = $this->ProdukModel->UbahProduk($new,$id);
                            if($simpan_produk > 0){
                                $sukses &= true;
                            }else{
                                $sukses &= false;
                            }
                        }else{
                            if($photo != ''){
                                $new_gambar = [
                                    "produk_id" => $cek_foto->id,
                                    "nama_gambar" => $photo,
                                    "created_at" => date('Y-m-d H:i:s')
                                ];
                                $simpan_foto = $this->MasterGambarModel->TambahGambar($new_gambar);
        
                                if($simpan_foto > 0){
                                    $sukses &= true;
                                }else{
                                    $sukses &= false;
                                }
                            }else{
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                Gambar '.$linkName.' Gagal diupload.
                                </div>');
                                redirect('Admin/ubah_produk/'.$id);
                            }
                        }
                    }
                }
                
                if($sukses == true){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil ubah data
                    </div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal ubah data
                    </div>');
                }
                
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal ubah data
                </div>');
            }
            redirect('Admin');
        }
    }

    public function ubah_gambar_produk(){
        $id_produk = md5($this->input->post('id_produk'));
        $id_gambar = $this->input->post('id_gambar');
        $letak = $this->input->post('letak');
        $sukses = true;

        if($letak == 'master_produk'){
            $ambil_gambar = $this->ProdukModel->getProdukById($id_produk);
            $gambar_sekarang = $ambil_gambar->gambar_produk;

            $linkName = $_FILES['gambar_produk']['name'];
            $linkTempName = $_FILES['gambar_produk']['tmp_name'];
            $location = './assets/uploads/produk/';

            $rename = "PRODUK_".$linkName;
            $upload = move_uploaded_file($linkTempName, $location.$rename);
            if($upload){
                $photo = $rename;
            }
            else{
                if($ambil_gambar->gambar_produk != ''){
                    $photo = $ambil_gambar->gambar_produk;
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal upload file!
                    </div>');
                    redirect('Admin/ubah_produk/'.$id_produk);
                }
            }
            $new = [
                "gambar_produk" => $photo,
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $simpan_produk = $this->ProdukModel->UbahProduk($new,$id_produk);

            if($simpan_produk > 0){
                $sukses &= true;
                unlink(base_url('assets/uploads/produk/'.$gambar_sekarang));
            }else{
                $sukses &= false;
            }
        }elseif ($letak == 'master_gambar') {
            $ambil_gambar = $this->MasterGambarModel->getGambarById(md5($id_gambar));
            $gambar_sekarang = $ambil_gambar->nama_gambar;

            $linkName = $_FILES['gambar_produk']['name'];
            $linkTempName = $_FILES['gambar_produk']['tmp_name'];
            $location = './assets/uploads/produk/';

            $rename = "PRODUK_".$linkName;
            $upload = move_uploaded_file($linkTempName, $location.$rename);
            if($upload){
                $photo = $rename;
            }
            else{
                if($ambil_gambar->nama_gambar != ''){
                    $photo = $ambil_gambar->nama_gambar;
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal upload file!
                    </div>');
                    redirect('Admin/ubah_produk/'.$id_produk);
                }
            }
            $new = [
                "nama_gambar" => $photo,
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $simpan_gambar = $this->MasterGambarModel->UbahGambar($new,md5($id_gambar));

            if($simpan_gambar > 0){
                $sukses &= true;
                unlink(base_url('assets/uploads/produk/'.$gambar_sekarang));
            }else{
                $sukses &= false;
            }
        }

        if($sukses == true){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Ubah Gambar!
            </div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal Ubah Gambar!
            </div>');
        }
        redirect('Admin/ubah_produk/'.$id_produk); 
    }

    public function hapus_gambar_produk($id_produk, $id_gambar, $letak){
        $sukses = true;

        if($letak == md5('master_produk')){
            $ambil_gambar = $this->ProdukModel->getProdukById($id_produk);
            $gambar_sekarang = $ambil_gambar->gambar_produk;

            $new = [
                "gambar_produk" => '',
                "updated_at" => date('Y-m-d H:i:s')
            ];
            $simpan_gambar = $this->ProdukModel->UbahProduk($new,$id_produk);

            if($simpan_gambar > 0){
                $sukses &= true;
                unlink(base_url('assets/uploads/produk/'.$gambar_sekarang));
            }else{
                $sukses &= false;
            }
        }elseif ($letak == md5('master_gambar')) {
            $ambil_gambar = $this->MasterGambarModel->getGambarById($id_gambar);
            $gambar_sekarang = $ambil_gambar->nama_gambar;

            $hapus_gambar = $this->MasterGambarModel->hapusGambarById($id_gambar);

            if($hapus_gambar > 0){
                $sukses &= true;
                unlink(base_url('assets/uploads/produk/'.$gambar_sekarang));
            }else{
                $sukses &= false;
            }
        }

        if($sukses == true){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Hapus Gambar!
            </div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal Hapus Gambar!
            </div>');
        }
        redirect('Admin/ubah_produk/'.$id_produk); 
    }

    public function nonaktifkan_produk($id){
        $data = [
            'is_aktif' => 0,
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $simpan_produk = $this->ProdukModel->UbahProduk($data,$id);
        if($simpan_produk > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil ubah data
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal ubah data
            </div>');
        }
        redirect('Admin');
    }
    
    public function aktifkan_produk($id){
        $data = [
            'is_aktif' => 1,
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $simpan_produk = $this->ProdukModel->UbahProduk($data,$id);
        if($simpan_produk > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil ubah data
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal ubah data
            </div>');
        }
        redirect('Admin');
    }

    public function hapus_produk($id){
        $cek_history_selesai = $this->HistoryModel->cekHistoryProdukSelesai($id);
        if(!empty($cek_history_selesai)){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal Hapus Produk karna produk sudah tersimpan di history
            </div>');
        }else{
            $hapus_cart = 1;
            $hapus_history = 1;
            $cek_cart = $this->CartModel->cekCartByProduk($id);
            $cek_history = $this->HistoryModel->cekHistoryByProduk($id);

            if(!empty($cek_cart)){
                $hapus_cart = $this->CartModel->hapusCartByProduk($id);
            }
            if(!empty($cek_history)){
                $hapus_history = $this->HistoryModel->hapusHistoryByProduk($id);
            }

            if($hapus_cart>0 && $hapus_history>0){
                $hapus_produk = $this->ProdukModel->hapusProdukById($id);
                if($hapus_produk > 0){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil hapus produk
                    </div>');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Gagal Hapus Produk
                    </div>');
                }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal Hapus Produk
                </div>');
            }
        }
        redirect('Admin');
    }

    public function hapus_gambar($id)
	{
		$this->db->delete('gambar_promo', ['md5(id)' => $id]);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil hapus data
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal hapus data
            </div>');
        }
        redirect('Admin/carousel');
	}

    public function setting(){
        $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
        $data['setting'] = $this->db->get_where('beranda',['id'=>1])->row();

        $this->form_validation->set_rules('notelp', 'No.Telp', 'required');

        if($this->form_validation->run() == false){
            $this->load->view('templates/home/header');
            $this->load->view('templates/home/navbar', $data);
            $this->load->view('admin/setting', $data);
            $this->load->view('templates/home/footer');
        }else{
            $data = [
                'about' => $this->input->post('about'),
                'syarat_ketentuan' => $this->input->post('syarat_ketentuan'),
                'beranda' => $this->input->post('beranda'),
                'notelp' => $this->input->post('notelp')
            ];

            $this->db->update('beranda', $data, ['id' => 1]);

            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil ubah data</div>');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal ubah data</div>');
            }
            redirect('Admin/setting');
        }
    }

    public function carousel(){
		$data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
		$data['gambar'] = $this->db->get('gambar_promo')->result();

		$this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('admin/carousel',$data);
		$this->load->view('templates/home/footer');
	}

    public function nonaktifkan_gambar($id){
        $data = [
            'is_aktif' => 0,
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $this->db->update('gambar_promo', $data, ['md5(id)' => $id]);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil ubah data
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal ubah data
            </div>');
        }
        redirect('Admin/carousel');
    }
    
    public function aktifkan_gambar($id){
        $data = [
            'is_aktif' => 1,
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $this->db->update('gambar_promo', $data, ['md5(id)' => $id]);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil ubah data
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal ubah data
            </div>');
        }
        redirect('Admin/carousel');
    }

    public function tambah_carousel(){
        $files = $_FILES;
        $jumlahFile = count($files['listGambar']['name']);
        $simpan = 1;

        for ($i = 0; $i < $jumlahFile; $i++) {
            $linkName = $files['listGambar']['name'][$i];
            $linkTempName = $files['listGambar']['tmp_name'][$i];
            $location = './assets/uploads/promo/';

            $rename = "PROMO_".$linkName;
            $upload = move_uploaded_file($linkTempName, $location.$rename);
            if($upload){
                $photo = $rename;
            }
            else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal upload file!
                </div>');
                redirect('Admin/carousel');
            }

            $data = [
                'gambar' => $photo,
                'is_aktif' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('gambar_promo', $data);
            if($this->db->affected_rows() > 0){
                $simpan &= 1;
            }else{
                $simpan &= 0;
            }
        }

        if($simpan == 1){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil upload gambar
            </div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal upload gambar
            </div>');
        }
        redirect('Admin/carousel');
    }

    //Galeri
    public function galeri(){
		$data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
		$data['galeri'] = $this->db->get('galeri')->result();

		$this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('admin/galeri',$data);
		$this->load->view('templates/home/footer');
	}

    public function tambah_galeri(){
        $files = $_FILES;
        $jumlahFile = count($files['listGaleri']['name']);
        $simpan = 1;
        $this->db->trans_begin();

        for ($i = 0; $i < $jumlahFile; $i++) {
            $linkName = $files['listGaleri']['name'][$i];
            $linkTempName = $files['listGaleri']['tmp_name'][$i];
            $location = './assets/uploads/galeri/';

            $rename = "GALERI_".$linkName;
            $upload = move_uploaded_file($linkTempName, $location.$rename);
            if($upload){
                $photo = $rename;
            }
            else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal upload file!
                </div>');
                redirect('Admin/galeri');
            }

            $data = [
                'nama_galeri' => $photo,
                'is_aktif' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('galeri', $data);
            if($this->db->affected_rows() > 0){
                $simpan &= 1;
            }else{
                $simpan &= 0;
            }
        }

        if($simpan == 1){
            $this->db->trans_commit();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil upload gambar
            </div>');
        }else{
            $this->db->trans_rollback();
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal upload gambar
            </div>');
        }
        redirect('Admin/galeri');
    }

    public function nonaktifkan_galeri($id){
        $data = [
            'is_aktif' => 0,
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $this->db->update('galeri', $data, ['md5(id)' => $id]);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil ubah data
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal ubah data
            </div>');
        }
        redirect('Admin/galeri');
    }
    
    public function aktifkan_galeri($id){
        $data = [
            'is_aktif' => 1,
            "updated_at" => date('Y-m-d H:i:s')
        ];
        $this->db->update('galeri', $data, ['md5(id)' => $id]);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil ubah data
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal ubah data
            </div>');
        }
        redirect('Admin/galeri');
    }

    public function hapus_galeri($id)
	{
		$this->db->delete('galeri', ['md5(id)' => $id]);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil hapus data
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal hapus data
            </div>');
        }
        redirect('Admin/galeri');
	}
    //end Galeri

    public function history(){
        $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
        if($this->session->userdata('role') == 1){
            $data['history'] = $this->HistoryModel->getAllHistory();
        }elseif ($this->session->userdata('role') == 2) {
            $data['history'] = $this->HistoryModel->getAllHistory($this->session->userdata('id'));
        }

		$this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('admin/history',$data);
		$this->load->view('templates/home/footer');
    }

    public function konfirmasi_pesanan($id,$status){
        if($status == md5('terima')){
            $status = 'Diterima';
        }elseif ($status == md5('tolak')) {
            $status = 'Ditolak';
        }elseif ($status == md5('selesai')) {
            $status = 'Selesai';
        }

        $data = [
            'status_pesanan' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $simpan = $this->HistoryModel->UbahHistory($data,$id);
        if($simpan > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Konfirmasi
            </div>');
            
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal Konfirmasi
            </div>');
        }
        redirect('Admin/history');

    }

    public function hapus_pesanan($id){
        $this->db->delete('history', ['md5(id)'=>$id]);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Hapus Pesanan
            </div>');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Gagal Hapus Pesanan
            </div>');
        }
        redirect('Admin/history');
    }

}