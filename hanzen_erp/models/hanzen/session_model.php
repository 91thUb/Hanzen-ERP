<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Session_model extends CI_Model{
public $token;
	/**
	 * Generate with get token key and token time
	 * @ return array
	 **/
	public function generateToken(){
		$this->token['token.key'] = md5(rand(999999,000001));
		$this->token['token.time'] = time();
		$this->session->set_userdata($this->token);
		return $this->token;
	}
	/**
	 * validate token key
	 * @param $token_key string
	 * @return booelan
	 **/
	public function validateToken($token_key = null){
		$time = FALSE;
		if($this->session->userdata('token.time')+$this->config->item('token_time') > time()){
			$time = TRUE;
		}
		else{
			$this->error->set($this->error_lang['expire_token']);
		}
		if($time AND $this->session->userdata('token.key') == $token_key AND $token_key != null){
			return TRUE;
		}
		else{
			$this->error->set($this->error_lang['invalid_token']);
		}
	}
	/**
	 * Get token key
	 * @return string
	 **/
	public function getToken(){
		return $this->session->userdata('token.key');
	}
	/**
	 * URL with token
	 * @param $target string/array, target page
	 * @return string
	 **/
	public function urlToken($target=''){
		return base_url($target).'?token='.$this->token['token.key'];
	}
}