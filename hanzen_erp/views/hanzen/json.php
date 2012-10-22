<?php
if($this->config->item('hnz_benchmark')){$data['benchmark'] = $this->benchmark->all();}
$this->output->set_content_type('application/json');
$this->output->set_output(json_encode($data));
?>