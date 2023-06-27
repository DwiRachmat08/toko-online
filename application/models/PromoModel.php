<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PromoModel extends CI_Model {
    
    public function getGambarPromo(){
        return $this->db->get_where('gambar_promo', ['is_aktif'=>1])->result();
    }

}