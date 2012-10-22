<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Security extends HZ_Controller {
	/**
	 * @param $token string
	 * @param $redirect string (optional)
	 * @return none
	 **/
	public function auth($token = null,$redirect = 'hanzen/base/'){
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
		);
		/* Load Library */
		$this->load->model('hanzen/computers_model');
		
		// checking ip computer and validate token request
		if($this->computers_model->is_valid() AND $this->session_model->validateToken($token)){
			$this->users_model->login($data);
		}
		// checking if have error login
		if($this->error->isError()){
			$this->session->set_flashdata('error',$this->error->get_html());
			redirect('hanzen/login/');
			exit();
		}
		else{
			$this->users_model->ping($data['username']);
			$token = $this->session_model->generateToken();
			redirect($redirect.'?token='.$token['token.key']);
		}
	}
	/**
	 * Destroy session
	 * @return none
	 **/
	public function destroy(){
		$user = $this->users_model->getData($this->session->userdata('username'));
		$setting_delay = $this->config->item('hnz_user_delay_ping');
		if($user['ping']+$setting_delay >= time()){
			$this->db->where(array('username'=>$user['username']));
			$this->db->update($this->users_model->table['users'],array('ping'=>$user['ping']-$setting_delay));
		}
		$this->session->set_userdata(array(
			'username'	=> null,
			'id_user'	=> null,
		));
		redirect('hanzen/login','refresh');
	}
}
?>