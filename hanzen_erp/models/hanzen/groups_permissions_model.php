<?php
/**
 * Groups and Permissions model
 * table name 'user_groups' , 'permissions'
 **/
class Groups_permissions_model extends HZ_Model{
private $table;

	public function __CONSTRUCT(){
		parent::__CONSTRUCT();
		$this->table = array(
			'groups' => $this->db->dbprefix('user_groups'),
			'permissions' => $this->db->dbprefix('permissions')
		);
	}
	/**
	 * @param $module_id
	 * @param $group_id "NB: Special group_id '1' it's mean super administrator, can accessible all modules"
	 * @return boolean
	 **/
	public function isAccessible($module_id = null) {
		$group = $this->session->userdata('id_group');
		if($group == 1){
			return true;
		}
		else{
			$query = $this->db->get_where($this->table['permissions'],array('user_group_id'=> $group, 'module_id'=>$module_id));
			if($query->num_rows() == 1 ){
				return true;
			}
			else{
				$this->error->set($this->error_lang['module_access_deny'].' '.strtoupper($module_id));
				return false;
			}
		}
	}
	public function getPermission(){
		$query = $this->db->get_where($this->table['permissions'],array());
	}
	/**
	 * @param $data array [module_id],['user_group']
	 * @return booelan
	 **/
	public function addPermission($data = array()){
		$query = $this->db->get_where($this->table['permissions'],$data);
		if($query->num_rows() == 0){
			return $this->db->insert($this->table['permissions'],$data);
		}
		else{
			$this->error->set($this->error_lang['fail_created']);
		}
	}
}