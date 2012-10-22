<?php
/**
 * Language Model
 * No Database
 **/
class Lang_model extends HZ_Model{
public $set_lang;
	/**
	 * @ access public
	 * @ param $language string
	 * @ return none
	 */
	public function set($language = 'en'){
		if(empty($language) or $language == ''){
			$this->set_lang = $this->config->item('default_lang');
		}
		else{
			$this->set_lang = $language;
		}
	}
	/**
	 * @ access public
	 * @ param $file string load file language
	 * @ return none
	 **/
	public function load($file){
		$dir = APPPATH.'language/'.$this->set_lang.'/'.$file.'_lang.php';
		if(file_exists($dir)){
			$this->lang->load($file,$this->set_lang);	
		}
		elseif(file_exists(APPPATH.'language/'.$this->config->item('default_lang').'/'.$file.'_lang.php')){
			$this->lang->load($file,$this->config->item('default_lang'));
			$this->error->set('('.$file.'/'.$this->set_lang.') Missing language, default language loaded');
		}
		else{
			$this->error->set('('.$dir.') Missing language.');
		}
	}
}
?>