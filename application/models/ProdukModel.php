<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdukModel extends CI_Model {
    public function getProdukAll($user_id=null){
        if(empty($user_id)){
            $this->db->select('master_produk.*, master_user.nama');
            $this->db->from('master_produk');
            $this->db->join('master_user', 'master_produk.user_id = master_user.id');
            $this->db->where('master_produk.is_aktif',1);
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get_where('master_produk',['md5(user_id)'=>$user_id, 'is_aktif'=>1])->result();
        }
        return $query;
        // return $this->db->get_where('master_produk', ['is_aktif'=>1])->result();
    }

    public function getProdukAllAdmin($user_id=null){
        if(empty($user_id)){
            $this->db->select('master_produk.*, master_user.nama');
            $this->db->from('master_produk');
            $this->db->join('master_user', 'master_produk.user_id = master_user.id');
            $query = $this->db->get()->result();
        }else{
            $query = $this->db->get_where('master_produk',['user_id'=>$user_id])->result();
        }
        return $query;
    }

    public function getProdukById($id){
        $this->db->select('master_produk.*, master_user.nama');
        $this->db->from('master_produk');
        $this->db->join('master_user', 'master_produk.user_id = master_user.id');
        $this->db->where('md5(master_produk.id)',$id);
        $query = $this->db->get()->row();
        return $query;
        // return $this->db->get_where('master_produk', ['md5(id)'=>$id])->row();
    }

    public function TambahProduk($data){
        $this->db->insert('master_produk', $data);
        // return $this->db->affected_rows();
        return $this->db->insert_id();
    }

    public function UbahProduk($data,$id){
        $this->db->update('master_produk', $data, ['md5(id)' => $id]);
        return $this->db->affected_rows();
    }

    public function getProdukTerbaru(){
		$this->db->select('*');
		$this->db->from('master_produk');
        $this->db->where('is_aktif',1);
		$this->db->order_by('created_at','DESC');
		$this->db->limit(4);
		return $this->db->get()->result();
	}

    public function hapusProdukById($produk_id){
        $this->db->delete('master_produk', ['md5(id)' => $produk_id]);
        return $this->db->affected_rows();
    }

    public function cekStokProduk($id){
        return $this->db->get_where('master_produk',['id'=>$id])->row();
    }
}