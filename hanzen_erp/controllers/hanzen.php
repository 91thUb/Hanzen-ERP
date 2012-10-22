<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hanzen extends HZ_Controller{
public $id_module = false;
public $secure = false;
	public function index(){
		if(true){
			redirect('hanzen/login');
		}
	}
	/* Login Page */
	public function login(){
		if($this->session->userdata('username')){
			redirect('security/destroy');
		}
		$this->load->model('hanzen/computers_model');
		$this->language->load('base');
		$data = array(
			'computers' => $this->computers_model->get_device($_SERVER['REMOTE_ADDR']),
			'token'	=> $this->session_model->generateToken(),
			'error'	=> $this->session->flashdata('error'),
			'lang'	=> $this->lang->line('login_page'),
			'language_option' => $this->config->item('hnz_language')
		);
		$this->load->view('hanzen/login',$data);
	}
	/* UI Page */
	public function base(){
		$data = array(
			'token'	=> $this->input->get('token')
		);
		$this->output->set_status_header('200');
		$this->output->set_header("Date: ".gmdate(DATE_RFC822));
		$this->output->set_header("Content-Type: text/html charset=UTF-8");
		$this->load->view('hanzen/platform',$data);
	}
	/* Data for UI output with JSON data */
	public function data(){
		$this->secure();
		$this->language->load('base');
		$token_key = $this->session_model->generateToken();
		$data = array(
			'name' => $this->config->item('hnz_company_name'),
			'base_url'	=> base_url(),
			'token'=> $token_key['token.key'],
			'lang' => $this->lang->line('platform'),
			'is_error'	=> $this->error->isError(),
			'error'	=> $this->error->get(),
			'about' => file_get_contents(base_url('hanzen/about')),
		);
		$this->output->set_content_type('application/json');
		$this->output->set_output('var d ='.json_encode($data));
	}
	public function language($lang=null){
		$this->session->set_userdata('lang',$lang);
		redirect('hanzen/login');
	}
	public function about(){
		$this->load->view('hanzen/about');
	}
	public function ping(){
		for($i=1;$i<=28;$i++){
			if($this->session->userdata('username')){
				$data = array(
					'is_login' => true,
				);
				$this->load->model('users_model');
				$this->users_model->ping();
				sleep(1);
			}
			else{
				$i = 999;
				$data = array(
					'is_login' => false,
				);
			}
		}
		echo json_encode($data);
	}
	public function test(){
		echo $this->users_model->isConnected();
	}
}
