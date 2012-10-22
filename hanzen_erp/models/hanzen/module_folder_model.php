<?php
<?php
/**
 * modules and folders model
 * table name 'modules' , 'folders'
 **/
class Modules_folders_model extends HZ_Model{
public $table;
	public function __CONSTRUCT(){
		parent::__CONSTRUCT();
		$this->table = array(
			'modules' => $this->db->dbprefix('modules'),
			'folders' => $this->db->dbprefix('folders')
		);
	}
}
?>