<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AC0001 extends HZ_Controller{
public $id_module = 'ac0001';
	function __CONSTRUCT(){
		parent::__CONSTRUCT();
		$this->secure();
	}
	function index(){
		$this->load->module_view($this->id_module);
	}
}
?>