<?php
class AD0001 extends HZ_Controller{
public $id_module = 'ad0001';
	public function __CONSTRUCT(){
		parent::__CONSTRUCT();
		$this->secure();
	}
	public function index(){
		$this->load->module_view($this->id_module);
	}
}
?>