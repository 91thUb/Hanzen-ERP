<?php
$config = array(
	'hnz_code_register'	=> 'HNZ1203254d',
	'hnz_company_name'	=> 'Hanzen ERP - Jakarta',
	'hnz_id_company'	=> '00001',
	'hnz_date_format'	=> 'd-M-y / h:i:s A',	// format date system
	'global_lang'		=> true,
	'hnz_user_delay_ping' 	=> 30,			// delay for ping user {sec}
	'ip_security'			=> true,		// activated ip checking permission when auth login user
	'token_time'			=> 3600,		// validate token time expire
	'wrong_password'		=> 3,
	'default_lang'			=> 'en',		// set default global langguage
	'hnz_language'	=> array(
		'en'	=> 'English',
		'id'	=> 'Indonesia'
	),
	'hnz_benchmark' 		=> false, 		// show benchmark on request (recomended false)
	'show_module_code' 		=> true,		// Show module code on tree module
);
?>