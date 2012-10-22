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
	public function get_folderChild($parent_id){
		$result = array();
		$this->db->where('parent_id',$parent_id);
		$this->db->from($this->table['folders']);
		$this->db->order_by('folder_name');
		$folder = $this->db->get();
		if($folder->num_rows()>0){
			foreach($folder->result_array() as $row){
				$result[] = array(
					'text' => $row['folder_name'],
					'id' => $row['id_folder'],
					'leaf' => false
				);
			}
			
		}
		return $result;
	}
}
?>