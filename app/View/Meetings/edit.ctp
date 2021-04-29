<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Meeting.id')),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Meeting.id'))); ?>
<?php echo $this->Html->link(__('List Meetings'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="meetings form">
<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<?php echo $this->Form->create('Meeting'); ?>
<fieldset>
<legend><?php echo __('Edit Meeting'); ?></legend>
<div class="edit_author">
<table>
<?php
$res=array();
$start=0;
for($start;$start<=100;$start+=10){ $res[$start]=$start.' % '; }

echo "<div class='col-sm-3'>".$this->Form->input('project_id',array('class' => 'form-control'),array('options'=>array(''=>'Select',$projects)))."</div><div class='col-sm-3'>".$this->Form->input('user_id',array('class' => 'form-control','options'=>array(''=>'Select',$users)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('client_name',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('client_contact',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_place',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('first_response',array('class' => 'form-control','options'=>$res,'selected'=>array($this->data['Meeting']['first_response'])))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('representative',array('class' => 'form-control','options'=>array(''=>'Select',$users)))."</div><div class='col-sm-3'>".$this->Form->input('second_representative',array('class'=>'notrequired form-control','options'=>array(''=>'Select',$users)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control','options'=>array('pending'=>'Pending','close'=>'Close','done'=>'Done','postponed'=>'Postponed','cancel'=>'Cancel')))."</div><div class='col-sm-3'>".$this->Form->input('response',array('class' => 'form-control','options'=>$res,'selected'=>array($this->data['Meeting']['response'])))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('form_received',array('class' => 'form-control','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div><div class='col-sm-3'>".$this->Form->input('form_repeat',array('class' => 'form-control','options'=>array('new'=>'New','repeat one'=>'Repeat one','repeat two'=>'Repeat two','repeat three'=>'Repeat three','repeat four'=>'Repeat four','repeat five'=>'Repeat five','repeat six'=>'Repeat Six','many times'=>'Many Times')))."</div>";

echo "<div class='col-sm-6'>".$this->Form->input('timing').$this->Form->input('id').$this->Form->input('enquiry_id',array('type'=>'hidden'))."</div>";

if(CakeSession::read('User.type')!='regular'){ echo "<div class='col-sm-6'>".$this->Form->input('posted')."</div>"; }

echo "<div class='col-sm-2'>".$this->Form->input('send_mail',array('type'=>'checkbox','value'=>'yes','hiddenField'=>'no'))."</div><div class='col-sm-3'>Lead No. : ".$this->data['Meeting']['enquiry_id']."</div>";
//echo $this->Form->input('send_mail');
//echo $this->Form->input('posted');
?>
</table></div>
</fieldset>
<div class="col-sm-12"><?php echo $this->Form->end(__('Submit')); ?></div>
</div></div></div>
</div>