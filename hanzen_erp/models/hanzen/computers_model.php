<?php 
/* Computers Model
 * Table name 'computers'
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Computers_model extends HZ_Model{
private $table;
	/**
	 * define table db
	 **/
	public function __CONSTRUCT(){
		$this->table = array(
			'computers' => $this->db->dbprefix('computers'),
		);
		parent::__CONSTRUCT();
	}
	/**
	 * Check validating IP
	 * @return Boolean
	 **/
	public function is_valid(){
		$cpu = $this->get_device($_SERVER['REMOTE_ADDR']);
		if($cpu['active'] == 1 OR !$this->config->item('ip_security')){ return true;}
		else{$this->error->set($this->error_lang['not_allow']);}
	}
	/**
	 * @param $ip
	 * @return mix
	 **/
	public function deactive($ip){
		$this->db->where(array('ip' => $ip, 'active' => 1));
		return $this->db->update($this->table['computers'],array('active'=>0));
	}
	public function active($ip){
		$this->db->where(array('ip' => $ip, 'active' => 0));
		return $this->db->update($this->table['computers'],array('active'=>1));
	}
	public function get_device($ip){
		$query = $this->db->get_where($this->table['computers'],array('ip'=> $ip),1);
		if($query->num_rows() > 0){
			foreach ($query->result() as $row){
				return array('device_name'=>$row->device_name,'active'=>$row->active);
			}
		}
		else{return array('device_name'=>$ip.' (Unknow Device)','active'=>false);}
	}
	/**
	 * @param $data array
	 * return mix
	 **/
	public function add($data = array()){
		$query = $this->db->get_where($this->table['computers'],array('ip'=> $data['ip']),1);
		if($query->num_rows() == 0){
			return $this->db->insert($this->table['computers'],$data);
		}
	}
}
?>