<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Widget extends HZ_Controller{
public $module_id = false;
public $secure = true;
	public function find(){
		$query = mysql_escape_string($this->input->get('query'));
		$start = mysql_escape_string($this->input->get('start'));
		$limit = mysql_escape_string($this->input->get('limit'));
		$id_group = $this->session->userdata('id_group');
		$table = array(
			'modules' => $this->db->dbprefix('modules'),
			'permissions'	=> $this->db->dbprefix('permissions')
		);
		if($id_group == 1){
			$sql =  'SELECT `id_module` as `id`, `module_name` as `name`, `description` as `description` '.
					'FROM '.$table['modules'].
					" WHERE (`module_name` LIKE '%$query%' OR `id_module` = '$query')".
					' ORDER BY `module_name` LIMIT '.$start.','.$limit;
			$total = 'SELECT COUNT(`id_module`) as `total`'.
					'FROM '.$table['modules'].
					" WHERE (`module_name` LIKE '%$query%' OR `id_module` = '$query')";
		}
		else{
			$sql =  'SELECT `id_module` as `id`, `module_name` as `name`, `description` as `description` '.
					'FROM '.$table['modules'].', '.$table['permissions'].
					' WHERE `module_id` = `id_module` AND `user_group_id` = '.$id_group.
					" AND (`module_name` LIKE '%$query%' OR `id_module` = '$query')".
					' ORDER BY `module_name` LIMIT '.$start.','.$limit;
			$total =  'SELECT COUNT(`id_module`) as `total`'.
					'FROM '.$table['modules'].', '.$table['permissions'].
					' WHERE `module_id` = `id_module` AND `user_group_id` = '.$id_group.
					" AND (`module_name` LIKE '%$query%' OR `id_module` = '$query')";
		}
		$find = $this->db->query($sql);
		$t = $this->db->query($total);
		$total_row = $t->result_array();
		$data['data'] = array(
			'total' => $total_row[0]['total'],
			'result' => $find->result_array()
		);
		$this->load->data_view($data);
	}
	public function tree_modules(){
		$this->secure();
		$node = mysql_escape_string($this->input->get('node'));
		$id_group = $this->session->userdata('id_group');
		$this->load->model('hanzen/modules_folders_model','folder');
		$table = array(
			'modules' => $this->db->dbprefix('modules'),
			'permissions' => $this->db->dbprefix('permissions'),
		);
		if($id_group == 1){
			$sql =  'SELECT `id_module`, `module_name` '.
					'FROM '.$table['modules'].
					" WHERE  `folder_id` = '$node'";
		}
		else{
			$sql =  'SELECT `id_module`, `module_name` '.
					'FROM '.$table['modules'].', '.$table['permissions'].
					' WHERE `module_id` = `id_module` AND `user_group_id` = '.$id_group.
					" AND `folder_id` = '$node'";
		}
		$module = $this->db->query($sql);
		$modules =array();
		if($module->num_rows()>0){
			foreach ($module->result_array() as $row){
				$text = $this->config->item('show_module_code')?$row['id_module'].' - '.$row['module_name']:$row['module_name'];
				$modules[] = array(
					'text' => $text,
					'id'	=> $row['id_module'],
					'leaf'	=> true
				);
			}
		}
		$folders= $this->folder->get_folderChild($node);
		$tree['data'] = array_merge($folders,$modules);
		$this->load->data_view($tree);
	}
	public function history(){
		$this->load->model('hanzen/history_model','history');
		$this->load->helper('date');
		$data = $this->history->getLastUserHistory();
		$history['data'] = array();
		if(is_array($data)){
			foreach($data as $row){
				$history['data']['history'][] = array(
					'date' => date($this->config->item('hnz_date_format'),$row['date']),
					'module_id'	=> $row['module_id'],
					'referance_id' => $row['referance_id'],
					'info'	=> htmlspecialchars($row['info'])
				);
			}
		}
		$this->load->data_view($history);
	}
}