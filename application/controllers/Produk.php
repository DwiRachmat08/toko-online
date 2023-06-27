<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		
		$this->load->model('UserModel');
		$this->load->model('PromoModel');
		$this->load->model('ProdukModel');
		$this->load->model('CartModel');
		$this->load->model('MasterGambarModel');
	}

    public function index($user_id=null){
        // $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
		if(!empty($user_id)){
			$data['toko'] = $this->UserModel->getUserById($user_id);
			$data['produk'] = $this->ProdukModel->getProdukAll($user_id);
		}else{
			$data['toko'] = [];
			$data['produk'] = $this->ProdukModel->getProdukAll();
		}

        $this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('produk/index', $data);
		$this->load->view('templates/home/footer');
    }

	public function detail($id){
		// $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
        $data['produk'] = $this->ProdukModel->getProdukById($id);
		$data['gambar_produk'] = $this->MasterGambarModel->getGambarByProdukId($id);

        $this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('produk/detail', $data);
		$this->load->view('templates/home/footer');
	}

	public function addtocart(){
		$data = [];
		// $user_id = $this->session->userdata('id');
		$user_ip = $this->get_client_ip();
		$id = $this->input->post('id');

		$produk = $this->ProdukModel->getProdukById($id);

		$cekProdukUser = $this->CartModel->cekProdukUser($user_ip,$produk->id);
		// var_dump($cekProdukUser);die;
		if(!empty($cekProdukUser)){
			$jumlah_produk = $cekProdukUser->jumlah_produk + 1;
			$simpankecart = $this->CartModel->ubahcart($cekProdukUser->id, $jumlah_produk);
		}else{
			$simpankecart = $this->CartModel->simpankecart($user_ip,$produk->id,1);
		}

		if($simpankecart != ''){
			$data['sukses'] = 1;
			$data['pesan'] = 'Berhasil Menambahkan ke Cart';
		}else{
			$data['sukses'] = 0;
			$data['pesan'] = 'Gagal Ditambahkan ke Cart';
		}
		// var_dump($data);die;
		echo json_encode($data);
	}

	function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function ubahjumlahcart(){
		$data = [];
		$cart_id = $this->input->post('cart_id');
		$jumlah_produk = $this->input->post('jumlah');

		$ubahcart = $this->CartModel->ubahcart($cart_id, $jumlah_produk);

		$cart = $this->CartModel->getCartById(md5($cart_id));
		$produk = $this->ProdukModel->getProdukById(md5($cart->produk_id));

		$total_baru = intval($produk->harga_produk) * intval($cart->jumlah_produk);
		$format_total_baru = number_format($total_baru);

		if($ubahcart > 0){
			$data['sukses'] = 1;
			$data['pesan'] = 'Berhasil Ubah dari Cart';
			$data['total_baru'] = $format_total_baru;
		}else{
			$data['sukses'] = 0;
			$data['pesan'] = 'Gagal Ubah dari Cart';
		}

		echo json_encode($data);
	}

	public function hapusdaricart(){
		$data = [];
		$cart_id = $this->input->post('cart_id');

		$hapuscart = $this->CartModel->hapuscart($cart_id);

		if($hapuscart > 0){
			$data['sukses'] = 1;
			$data['pesan'] = 'Berhasil Hapus dari Cart';
		}else{
			$data['sukses'] = 0;
			$data['pesan'] = 'Gagal Hapus dari Cart';
		}

		echo json_encode($data);
	}
}