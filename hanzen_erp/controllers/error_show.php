<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Error_show extends HZ_Controller{
public $module_id = false;
public $secure = false;
	public function index(){
		$result['data'] = $this->session->flashdata('error');
		$result['data']['success'] = false;
		$dataType = $this->input->get('dataType');
		$this->error->error = $result['data'];
		if($dataType == 'json'){
			$this->load->view('hanzen/json',$result);
		}
		elseif($dataType == 'module'){
			$this->load->view('hanzen/error_module',array('error'=>$this->error->get_html()));
		}
		else{
			if(!$this->error->isError()){
				$this->error->error['date'] = date('d-m-y, h:i a');
				$this->error->set(anchor(base_url(),$this->error_lang['back']));
			}
			show_error($this->error->get_html());
		}
	}
}
?>