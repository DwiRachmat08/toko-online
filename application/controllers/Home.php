<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		
		$this->load->model('UserModel');
		$this->load->model('PromoModel');
		$this->load->model('CartModel');
		$this->load->model('ProdukModel');
		$this->load->model('BerandaModel');
		$this->load->model('HistoryModel');
	}

    public function index(){
		$data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
		$data['gambar_promo'] = $this->PromoModel->getGambarPromo();
		$data['setting'] = $this->BerandaModel->getBeranda();
		$data['terbaru'] = $this->ProdukModel->getProdukTerbaru();
		$data['galeri'] = $this->db->get_where('galeri',['is_aktif'=>1])->result();

		$this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('home/beranda', $data);
		$this->load->view('templates/home/footer');
    }

	public function cart(){
		$ip = $this->get_client_ip();
		// var_dump($ip);die;
		// $data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
		$data['cart_user'] = $this->CartModel->getCartByUser($ip);

		$this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('home/cart', $data);
		$this->load->view('templates/home/footer');
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

	public function beli($produk_id=null){
		$ip = $this->get_client_ip();
		// $session = $this->UserModel->datauser($this->session->userdata('id'));
		$cart_user = $this->CartModel->getCartByUser($ip);
		$setting = $this->BerandaModel->getBeranda();
		// $notelp = '6281216195260';
		$notelp = $setting->notelp;
		$total_keseluruhan = 0;
		$simpan = 1;

		if(empty($produk_id)){
			if(!empty($cart_user)){
				$teks = 'Pesanan Saya : %0A';
				foreach($cart_user as $cart){
					$cekStokProduk = $this->ProdukModel->cekStokProduk($cart->produk_id);
					if($cekStokProduk->stok < 1){
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						Stok Produk <b>'.$cekStokProduk->nama_produk.'</b> Sudah Habis!
						</div>');
						redirect('Home/cart');
					}
					$harga_total = intval($cart->harga_produk) * intval($cart->jumlah_produk);
					$teks .= '*'.$cart->nama_produk.'* |  Rp.'.number_format($cart->harga_produk).' | '.$cart->jumlah_produk.' | *Rp.'.number_format($harga_total).'*%0A';

					$total_keseluruhan += $harga_total;

					$simpan_history = $this->HistoryModel->simpanHistory($cart->user_ip,$cart->produk_id,$cart->jumlah_produk);
					if($simpan_history > 0){
						$this->db->delete('cart', ['id' => $cart->id]);
						if($this->db->affected_rows() > 0){
							$simpan &= 1;
						}else{
							$simpan &= 0;
						}
					}else{
						$simpan &= 0;
					}
				}
			}
		}else{
			$produk = $this->ProdukModel->getProdukById($produk_id);
			$harga_total = intval($produk->harga_produk);
			$teks = 'Pesanan Saya : %0A';
			$teks .= '*'.$produk->nama_produk.'* |  Rp.'.number_format($produk->harga_produk).' | 1 | *Rp.'.number_format($harga_total).'*%0A';

			$total_keseluruhan += $harga_total;

			$simpan_history = $this->HistoryModel->simpanHistory($ip,$produk_id,1);
			if($simpan_history > 0){
				$simpan &= 1;
			}else{
				$simpan &= 0;
			}
		}

		if($simpan != 1){
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Pembelian Gagal
            </div>');
			if(empty($produk_id)){
				redirect('Home/cart');
			}else{
				redirect('Produk/detail/'.$produk_id);
			}
		}

		$teks .= '%0A*Total Keseluruhan* : *Rp.'.number_format($total_keseluruhan).'*';
		$teks = str_replace(' ','%20',$teks);
		redirect('https://api.whatsapp.com/send?phone='.$notelp.'&text='.$teks);
	}

	public function about()
	{
		$data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
		$data['setting'] = $this->BerandaModel->getBeranda();

		$this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('home/about',$data);
		$this->load->view('templates/home/footer');
	}

	public function syaratketentuan()
	{
		$data['session'] = $this->UserModel->datauser($this->session->userdata('id'));
		$data['setting'] = $this->BerandaModel->getBeranda();

		$this->load->view('templates/home/header');
		$this->load->view('templates/home/navbar', $data);
		$this->load->view('home/syaratketentuan',$data);
		$this->load->view('templates/home/footer');
	}
}