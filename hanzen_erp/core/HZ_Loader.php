<?php
class HZ_Loader extends CI_Loader{
	public function data_view($data){
		$dataType = !isset($_GET['dataType'])?'':$_GET['dataType'];
		if($dataType == 'json'){
			$this->view('hanzen/json',$data);
		}
		elseif($dataType == 'xml'){
			$this->view('hanzen/xml');
		}
	}
	public function module_view($module){
		if(file_exists(APPPATH.'/views/modules/'.$module.'_view.php')){
			$this->view('modules/'.$module.'_view');
		}
		else{
			echo 'not found';
		}
	}
}
?>