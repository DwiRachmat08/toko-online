<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	public function cek_Akun()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		return $this->db->get_where('master_user',['username' => $username, 'password'=>md5($password)])->row_array();
	}

	public function tambah_akun()
	{
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
			'created_at' => date('Y-m-d H:i:s')
		];
		$this->db->insert('master_user', $user);

		return $this->db->insert_id();
		// echo $this->db->error();die;
	}

}
