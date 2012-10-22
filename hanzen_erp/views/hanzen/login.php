<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Client Log In - Hanzen ERP</title>
<style>
h1, h2, h3, h4, h5, h6, p, ul, li, body, html, form, fieldset { color:#fff; outline:none; font-weight:normal; border:0; }
body{
background: #272b27;
background: -moz-linear-gradient(top,  #bbbbcb 0%, #999999 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#272b27), color-stop(100%,#282828)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #272b27 0%,#282828 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #272b27 0%,#282828 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #272b27 0%,#282828 100%); /* IE10+ */
background: linear-gradient(to bottom,  #272b27 0%,#282828 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#272b27', endColorstr='#282828',GradientType=0 ); /* IE6-9 */
	font:12px/15px Arial, Helvetica, sans-serif;
	color:white;
}
input[type^="text"]:focus,input[type^="password"]:focus{
	box-shadow: 1px 1px 10px #99a;
}
#warp{
	margin: 5 auto;
	width:80%;
}
#login-form{
background: #7d7e7d; /* Old browsers */
background: -moz-linear-gradient(top,  #7d7e7d 0%, #5b5b5b 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#7d7e7d), color-stop(100%,#5b5b5b)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #7d7e7d 0%,#5b5b5b 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #7d7e7d 0%,#5b5b5b 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #7d7e7d 0%,#5b5b5b 100%); /* IE10+ */
background: linear-gradient(to bottom,  #7d7e7d 0%,#5b5b5b 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7d7e7d', endColorstr='#5b5b5b',GradientType=0 ); /* IE6-9 */
	padding:20px;
	margin: 12% auto;
	width:30%;
	text-align:center;
	border-radius:10px;
	box-shadow: 3px 3px 3px #222;
}
#footer{
	bottom:0px;
	left:0px;
	font:10px/11px Arial, Helvetica, sans-serif;
	color:#555;
}
#error-display li{
	color:#ff5555;
}
#language li{
	list-style-type: none;
	float:left;
	padding-right:10px;
}
.clear{
	clear:both;
}
</style>
</head>
<body>
<div id="warp">
	<div id="login-form">
	<img src="<?php echo root('img/logo-hanzen-erp.png'); ?>" alt="Hanzen ERP" />
	<h1><?php echo $this->config->item('company_name'); ?></h1>
	<form method="POST" action="<?php echo base_url('security/auth/'.$token['token.key']);?>">
	<?php echo $lang['computer'];?> : <?php echo htmlspecialchars($computers['device_name']);?><br /><br />
	User Agent: <?php echo $_SERVER['HTTP_USER_AGENT'];?><br /><br />
	<label><?php echo $lang['username'];?> : </label><input id="username" type="text" name="username"/><br /><br />
	<label><?php echo $lang['password'];?> : </label><input id="password" type="password" name="password" /><br /><br />
	<input type="submit" value="<?php echo $lang['login'];?>" />
	</form>
	<?php echo $error; ?>
		<div id="language"><?php
			if(count($language_option) > 0){
				$language = '<li>'.$lang['language'].':</li>';
				foreach ($language_option as $name => $var){
					$language .= '<li><a href="'.base_url('hanzen/language/'.$name).'">'.$var.'</a></li>';  
				}
				echo $language;
			}
		?>
			<div class="clear"></div>
		</div>
	</div>
	
	<div id="footer">
		Hanzen ERP &copy; 2012 | Open Source Business Platform | Bench : <?php echo $this->benchmark->elapsed_time();?> sec / <?php  echo $this->benchmark->memory_usage(); ?>
	</div>
	<script language="javascript">
		document.getElementById('username').focus();
	</script>
</div>
</body>
</html>