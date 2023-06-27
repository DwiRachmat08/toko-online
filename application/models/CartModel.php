<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CartModel extends CI_Model {

    public function simpankecart($user_ip,$produk_id,$jumlah_produk){
		$data_cart = [
            'user_ip'   => $user_ip,
            'produk_id' => $produk_id,
            'jumlah_produk' => $jumlah_produk,
            'created_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('cart', $data_cart);

		return $this->db->insert_id();
    }

    public function getCartById($id){
        return $this->db->get_where('cart', ['md5(id)'=>$id])->row();
    }

    public function getCartByUser($user_ip){
        $this->db->select('cart.id,cart.produk_id, cart.user_ip,cart.jumlah_produk, mp.nama_produk, mp.keterangan, mp.harga_produk, mp.gambar_produk, mp.berat_produk, mp.stok, mp.is_aktif');
        $this->db->from('cart');
        $this->db->join('master_produk AS mp', 'cart.produk_id = mp.id');
        $this->db->where('cart.user_ip',$user_ip);
        $query = $this->db->get();
        return $query->result();
    }

    public function ubahcart($cart_id, $jumlah_produk){
		$cart = [
			'jumlah_produk' => $jumlah_produk
		];
		$this->db->update('cart', $cart, ['id' => $cart_id]);

        return $this->db->affected_rows();
    }

    public function hapuscart($cart_id){
        $this->db->delete('cart', ['id' => $cart_id]);

        return $this->db->affected_rows();
    }

    public function cekProdukUser($user_ip, $produk_id){
        return $this->db->get_where('cart',['user_ip'=>$user_ip, 'produk_id'=>$produk_id])->row();
    }

    public function cekCartByProduk($produk_id){
        return $this->db->get_where('cart',['md5(produk_id)'=>$produk_id])->result();
    }

    public function hapusCartByProduk($produk_id){
        $this->db->delete('cart', ['md5(produk_id)' => $produk_id]);
        return $this->db->affected_rows();
    }

}