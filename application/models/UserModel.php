<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function datauser($id){
        $this->db->select('*');
		$this->db->from('master_user');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
    }

	public function getAllUser(){
		return $this->db->get('master_user')->result();
	}
	
	public function getUserById($id){
		return $this->db->get_where('master_user',['md5(id)'=>$id])->row();
	}

	public function UbahUser($data,$id){
        $this->db->update('master_user', $data, ['md5(id)' => $id]);
        return $this->db->affected_rows();
    }

}