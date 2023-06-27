<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
    public function index()
	{
		$data['judul'] = 'BISNIS CENTER UBHARA';
		
		$this->form_validation->set_rules('username','Username', 'required');
		$this->form_validation->set_rules('password','Password', 'required');
		if($this->form_validation->run() == false){
			$this->load->view('login/loginheader',$data);
			$this->load->view('login/login');
			$this->load->view('login/loginfooter');
		}
		else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('LoginModel');
			$user = $this->LoginModel->cek_akun();
			if ($user) {  
				if (md5($password) == $user['password']) {
					if($user['is_aktif'] == 1){
						$data = [
							'nama'	=> $user['nama'],
							'role'	=> $user['role_id'],
							'id' => $user['id'],
						];
						$this->session->set_userdata($data);
						if ($user['role_id'] == 1) {
							redirect('Admin/history');
						}
						elseif ($user['role_id'] == 2) {
							redirect('Admin/history');
						}
					}else{
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
						User Tidak Aktif!!
						</div>');
						redirect('LoginController');
					}
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Password anda salah!!
					</div>');
					redirect('LoginController');
				}
			}
			else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Username tidak ditemukan!
					</div>');
				redirect('LoginController');
			}
		}
	}

	public function registrasi()
	{
		$data['judul'] = 'BISNIS CENTER UBHARA';
        $get_provinsi = $this->rajaongkir->province();
		$provinsi = json_decode($get_provinsi, true);
		$data['provinsi'] = $provinsi['rajaongkir']['results'];

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|max_length[20]|alpha_numeric_spaces');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]|alpha_numeric_spaces');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
		$this->form_validation->set_rules('kota', 'Kota', 'required');
		$this->form_validation->set_rules('alamat_lengkap', 'Alamat Lengkap', 'required|max_length[100]');
		$this->form_validation->set_rules('telp', 'No.Telp', 'required|is_natural|max_length[12]');

		if($this->form_validation->run() == false)
		{
			$this->load->view('login/loginheader',$data);
			$this->load->view('login/registrasi',$data);
			$this->load->view('login/loginfooter');
		}
		else{
            
			$this->load->model('LoginModel');
			if(!empty($this->LoginModel->tambah_akun())){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Akun telah berhasil dibuat. Please login now!
                </div>');
                redirect('LoginController');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-error" role="alert">'.$this->db->error().'</div>');
                redirect('LoginController/registrasi');
            }
			
		}

	}

    public function kota()
	{
		$provinsi = $this->input->post('provinsi');
	   	$get_kota = $this->rajaongkir->city($provinsi);
	   	$kota = json_decode($get_kota, true);
	   	// var_dump($kota['rajaongkir']['results']);
	   	echo json_encode($kota['rajaongkir']['results']);
	}

	public function logout()
	{
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akun telah keluar.
          	</div>');
            redirect('LoginController');
	}
}