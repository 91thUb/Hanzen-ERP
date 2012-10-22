<?php
class History_model extends HZ_Model{
private $table;
	public function __CONSTRUCT(){
		parent::__CONSTRUCT();
		$this->table = array(
			'history' => $this->db->dbprefix('history'),
		);
	}
	public function getLastUserHistory(){
		$this->db->order_by('date','DESC');
		$this->db->limit(20);
		$query = $this->db->get_where($this->table['history'],array('user_id'=>$this->session->userdata('id_user')));
		if($query->num_rows() > 0){
			return $query->result_array();
		}
	}
	public function record($id_referance = null,$description = null){
		if($id_referance != null){
			$data = array(
				'date'	=> time(),
				'id_referance'	=> $id_referance,
				'module_id'	=> $this->module_id,
				'info'	=> $description
			);
			return $this->db->insert($this->table['history'],$data);
		}
	}
}
?>