<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class BerandaModel extends CI_Model {
    public function getBeranda(){
        return $this->db->get_where('beranda',['id'=>1])->row();
    }
}