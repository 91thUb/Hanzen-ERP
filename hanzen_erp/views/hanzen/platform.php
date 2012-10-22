<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $this->config->item('hnz_company_name').' ('.$this->session->userdata('username'); ?>) | Hanzen ERP</title>
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo root('img/icon.ico');?>" />
<link type="text/css" href="<?php echo root('hnz_base.css');?>" rel="Stylesheet" />
<script language="javascript">function progress(t){document.getElementById('progress').innerHTML = t;}</script>
</head>
<body>
<div id="mask-loading"><div id="progress">Loading... 0/4</div></div>
<link type="text/css" href="<?php echo root('ext/resources/css/ext-all.css');?>" rel="Stylesheet" />
<script language="javascript">progress('Loading... 1/4');</script>
<script type="text/javascript" src="<?php echo root('ext/ext-all.js');?>" ></script>
<script language="javascript">progress('Loading... 2/4');</script>
<script type="text/javascript" src="<?php echo base_url('hanzen/data/?token='.$token);?>" ></script>
<link type="text/css" href="<?php echo root('hnz_icon.css');?>" rel="Stylesheet" />
<script language="javascript">progress('Loading... 3/4');</script>
<script type="text/javascript">var HZ = Ext;</script>
<script type="text/javascript" src="<?php echo root('js/hnz_hf.js');?>" ></script>
<script type="text/javascript" src="<?php echo root('js/hnz_hm.js');?>" ></script>
<script type="text/javascript" src="<?php echo root('js/hnz_init.js');?>" ></script>
</body>
</html>