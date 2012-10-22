<?php
class Error{
	public $error;
	public function __CONSTRUCT(){
		$this->error = array();
		$this->error['date'] = date('d-m-y, h:i a');
	}
	public function set($reason = null){
		$this->error['error'][] = $reason;
	}
	public function get(){
		if($this->isError()){
			$this->error['success'] = false;
			return $this->error;
		}
		else{
			return array('No Error');
		}
	}
	public function get_html(){
		if($this->isError()){
			$error = $this->error;
			$data = '';
			foreach($error['error'] as $e ){
				$data .= '<li>'.$e.'</li>';
			}
			return '<div id="error-display"><p>Date & Time: '.$error['date'].'</p><ul>'.$data.'</ul></div>';
		}
	}
	public function clear(){
		$this->error['error'] = array();
	}
	public function isError(){
		if(empty($this->error['error'])){
			return false;
		}
		else{
			return true;
		}
	}
}
?>