<?php
class HZ_Benchmark extends CI_Benchmark{
	public function all(){
		return array('time'=>$this->elapsed_time(),'mem'=>$this->memory_usage());
	}
}
?>