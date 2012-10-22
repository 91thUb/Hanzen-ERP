<?php
echo $error;
?>
<script>
if(typeof HZ === 'undefined'){
	alert('Nice try.');
}
else{
	HZ.Msg.show({
		title:d.lang.about,
		buttons: Ext.MessageBox.OK,
		msg:'<?php echo $error;?>'
	});
}
</script>