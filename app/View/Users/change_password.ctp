<? $allparentids=@implode('##',$users);?>
<?php 
      $sessionval=$this->Session->read('User.id');
      
?>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Users'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('User'); ?>
<fieldset>
<legend><?php echo __('Change Password'); ?></legend>
<?php echo "<div class='row'>";
echo $this->Form->input('id',array('value'=>$sessionval));
echo "<div class='col-sm-3'>". $this->Form->input('password',array('class' => 'form-control'),array("type"=>"password"))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('confirm_password',array('class' => 'form-control'))."</div>";
?> 
</table></div>
<?php echo $this->Form->end(__('Submit')); ?>
</fieldset>
</div>
</div>