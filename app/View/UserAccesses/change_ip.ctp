<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style type="text/css">
html,body,div,table,tr,td{margin:0; padding:0;}
table{border-spacing:0; border-collapse:collapse; width:100%;}
.ip_form{ margin:0 auto; text-align:center; width:20%; background:url(images/ip_pattern.jpg) 0 0 repeat; border:0.3em solid #fff; outline:1px dotted #ccc; padding:1em 2em;}
.type_text{width:97%; padding:6px 5px;}
.add_type_text{width:77%; padding:6px 5px;}
input[type="submit"],input[type="button"]{ padding:0.5em 0.9em; cursor:pointer;}
img.background-image{min-height:100%;/* min-width:1024px; */width:100%;height:auto;position:fixed;top:0;left:0;z-index:-1}
/* Smartphones (portrait and landscape) ----------- */ 
@media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
.ip_form{width:80%;}
.add_type_text{width:62%;}
} 
/* Smartphones (landscape) ----------- */ 
@media only screen and (min-width : 321px) {
.ip_form{width:80%;}
.add_type_text{width:62%;}
} 
/* Smartphones (portrait) ----------- */ 
@media only screen and (max-width : 320px) {
.ip_form{width:80%;}
.add_type_text{width:62%;}
} 
/* iPads (portrait and landscape) ----------- */ 
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
.ip_form{width:20%;}
.add_type_text{width:62%;}
} 
/* iPads (landscape) ----------- */ 
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
.ip_form{width:20%;}
.add_type_text{width:62%;}
} 
/* iPads (portrait) ----------- */ 
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) {
.ip_form{width:20%;}
.add_type_text{width:62%;}
} 
/* Desktops and laptops ----------- */ 
@media only screen and (min-width : 1224px) {
.ip_form{width:20%;}
.add_type_text{width:62%;}
} 
/* Large screens ----------- */ 
@media only screen and (min-width : 1824px) {
.ip_form{width:20%;}
.add_type_text{width:62%;}
} 
/* iPhone 4 ----------- */ 
@media only screen and (-webkit-min-device-pixel-ratio : 1.5), only screen and (min-device-pixel-ratio : 1.5) {
.ip_form{width:20%;}
.add_type_text{width:62%;}
}
</style>
</head>
<body>
<div class="ip_form">
<h3>MANAGE IP</h3>
<p>[Note : Please replace ip if you have already exist]</p>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Form->create('UserAccess'); ?>
<? $key=''; if(!empty($userAccesses)) { foreach($userAccesses as $key=>$userAccess) { if($userAccess!=''){ ?>
<table><tr><td><input name="data[UserAccess][name][]" type="text" class="type_text" placeholder="ENTER IP" value="<?=$userAccess['UserAccess']['name']?>"><input name="data[UserAccess][id][]" type="hidden" class="type_text" placeholder="ENTER IP" value="<?=$userAccess['UserAccess']['id']?>"></td></tr>

<tr><td><? } } } $max=$key+1 ?>
<div id="itemRows"></div></td></tr>
<tr><td><input name="data[UserAccess][password]" type="password" class="type_text" required placeholder="Enter Password"></td></tr>
</table>
 <input type="submit" name="confirm" value="confirm"> <input  onClick="addRow(this.form);" type="button" value="Add More">
</form></div>
<script src="<?=SITE_PATH?>js/jquery.js"></script>
<script type="text/javascript">
var rowNum = <?=$max?>;
function addRow(frm) {
	rowNum ++;
	var row = '<div id="rowNum'+rowNum+'"><table><tr><td>IP '+rowNum+'</td><td><input name="data[UserAccess][name][]" type="text" class="add_type_text" placeholder="ENTER IP" required><input name="data[UserAccess][id][]" type="hidden" class="type_text" placeholder="ENTER IP" value=""><input type="button" value="Remove" onclick="removeRow('+rowNum+');"></td></tr></table></div>';
	jQuery('#itemRows').append(row);
	frm.add_qty.value = '';
	frm.add_name.value = '';
}

function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}

</script>
</body>
</html>

