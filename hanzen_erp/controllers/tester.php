<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tester extends HZ_Controller{
public $id_module = false;
	public function index(){
		echo '<title>Tool Tester / Hanzen ERP</title>';
		echo li(anchor('tester/add_ip','Daftar IP'));
		echo li(anchor('tester/reset_error','Reset Error Password'));
	}
	public function add_ip(){
		$token = $this->session_model->generateToken();
		echo 'IP anda: '.$_SERVER['REMOTE_ADDR'];
		echo '<form method="post" action="'.base_url('tester/save/'.$token['token.key']).'">';
		echo 'Nama Device: <input type="text" name="text" /> <input type="submit" value="Simpan" /></form>';
		echo 'NB: IP anda harus statis, untuk memeriksanya, refresh halaman ini atau tekan F5';
		echo '<p>'.$this->session->flashdata('error').'</p>';
	}
	public function save($token){
		$this->load->model('hanzen/computers_model');
		$data = array(
			'device_name' => $this->input->post('text'),
			'ip'	=> $_SERVER['REMOTE_ADDR'],
			'active' => 1
		);
		if(!empty($data['device_name']) and $this->session_model->validateToken($token)){
			if($this->computers_model->add($data)){
				$this->session->set_flashdata('error','Sukses tambahkan device');
				redirect('hanzen/login');
			}
			else{
				$this->session->set_flashdata('error','Gagal, ip sudah terdaftar');
				redirect('tester/add_ip');
			}
		}
		else{
			$this->session->set_flashdata('error','Gagal,device kosong');
			redirect('tester/add_ip');
		}
	}
	public function reset_error(){
		$this->users_model->resetErrorLogin('hansen');
		$this->session->set_flashdata('error','Error Password Reset, you can login now');
		redirect('hanzen/login');
	}
}