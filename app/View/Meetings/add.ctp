<?php /*?><div class="meetings form">
<?php echo $this->Form->create('Meeting'); ?>
	<fieldset>
		<legend><?php echo __('Add Meeting'); ?></legend>
         <div class="edit_author">
     <table>
	<?php
	$res=array();
	$start=10;
	for($start;$start<=100;$start+=10){ $res[$start]=$start.' % '; }
	
		echo "<tr><td width='50%'>".$this->Form->input('project_id',array('options'=>array(''=>'Select',$projects)))."</td><td>".$this->Form->input('user_id',array('options'=>array(''=>'Select',$users)))."</td></tr>";
		echo "<tr><td>".$this->Form->input('client_name')."</td><td>".$this->Form->input('client_contact')."</td></tr>";
		echo "<tr><td colspan='2'>".$this->Form->input('meeting_place')."</td></tr>";
		echo "<tr><td>".$this->Form->input('representative',array('options'=>array(''=>'Select',$users)))."</td><td>".$this->Form->input('second_representative',array('class'=>'notrequired','options'=>array(''=>'Select',$users)))."</td></tr>";
		echo "<tr><td>".$this->Form->input('status',array('options'=>array('pending'=>'Pending','close'=>'Close','done'=>'Done')))."</td><td>".$this->Form->input('response',array('options'=>$res))."</td></tr>";
		echo "<tr><td>".$this->Form->input('form_received',array('options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</td><td>".$this->Form->input('form_repeat',array('options'=>array('repeat one'=>'Repeat one','repeat two'=>'Repeat two','repeat three'=>'Repeat three','repeat four'=>'Repeat four','repeat five'=>'Repeat five')))."</td></tr>";
		
		echo "<tr><td colspan='2'>".$this->Form->input('timing')."</td></tr>";
		//echo $this->Form->input('send_mail');
		//echo $this->Form->input('posted');
	?>
    </table></div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Meetings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php */?>