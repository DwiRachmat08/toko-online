<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryModel extends CI_Model {
    public function getAllHistory($user_id=null){
        $this->db->select('history.id,history.produk_id, history.user_ip,history.jumlah_produk, history.status_pesanan, mp.nama_produk, mp.keterangan, mp.harga_produk, mp.gambar_produk, mp.berat_produk, mp.stok, mp.is_aktif, mu.nama');
        $this->db->from('history');
        $this->db->join('master_produk AS mp', 'history.produk_id = mp.id');
        $this->db->join('master_user AS mu', 'mp.user_id = mu.id');
        if(!empty($user_id)){
            $this->db->where('mp.user_id',$user_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function simpanHistory($user_ip, $produk_id, $jumlah_produk){
        $data = [
            'user_ip'   => $user_ip,
            'produk_id' => $produk_id,
            'jumlah_produk' => $jumlah_produk,
            'status_pesanan' => 'Belum Dikonfirmasi',
            'created_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('history', $data);

		return $this->db->affected_rows();
    }

    public function UbahHistory($data,$id){
        $this->db->update('history', $data, ['md5(id)' => $id]);
        return $this->db->affected_rows();
    }

    public function cekHistoryProdukSelesai($produk_id){
        return $this->db->get_where('history',['md5(produk_id)'=>$produk_id, 'status_pesanan'=>'Selesai'])->result();
    }

    public function cekHistoryByProduk($produk_id){
        return $this->db->get_where('history',['md5(produk_id)'=>$produk_id])->result();
    }

    public function hapusHistoryByProduk($produk_id){
        $this->db->delete('history', ['md5(produk_id)' => $produk_id]);
        return $this->db->affected_rows();
    }
}