<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterGambarModel extends CI_Model {
    
    public function TambahGambar($data){
        $this->db->insert('master_gambar', $data);
        return $this->db->affected_rows();
        // return $this->db->insert_id();
    }

    public function UbahGambar($data,$id){
        $this->db->update('master_gambar', $data, ['md5(gambar_id)' => $id]);
        return $this->db->affected_rows();
    }

    public function hapusGambarById($id){
        $this->db->delete('master_gambar', ['md5(gambar_id)' => $id]);
        return $this->db->affected_rows();
    }

    public function getGambarByProdukId($id){
        return $this->db->get_where('master_gambar', ['md5(produk_id)'=>$id])->result();
    }

    public function getGambarById($id){
        return $this->db->get_where('master_gambar', ['md5(gambar_id)'=>$id])->row();
    }

}