<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

</head>
<body>
<?php if($this->Session->check('OTP')){ echo $this->Html->link('Logout', array('action' => 'otpOnPassword','logout')); echo " | ".$this->Html->link('reset', array('action' => 'otpOnPassword'));} else { echo $this->Session->flash(); ?>
<?php echo $this->Form->create('userAccesses'); ?>
	<fieldset>
		<legend><?php echo __('User Login'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); } ?>

<table cellspacing="10">
<? if(!empty($otps)) { foreach($otps as $key=>$otp) {  ?>
<tr><td><?=$otp['ManageOtp']['name']?> </td><td> <?=$otp['ManageOtp']['otp']?></td></tr>
<? } }  ?>
</table>

</body>
</html>
<script src="<?=SITE_PATH?>js/jquery.js"></script>
<script>
$(document).ready(function(){
    $("tr:even").css("background-color", "#e7e7e7");
    $("tr:odd").css("background-color", "#e4e4e4");
});
</script>

