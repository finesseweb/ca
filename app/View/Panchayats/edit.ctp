<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Panchayat.id')),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Panchayat.id'))); ?>
<?php echo $this->Html->link(__('List Panchayat'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Panchayat'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Panchayat'); ?>
<fieldset>
<legend><?php echo __('Edit City'); ?></legend>
<?php
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('city_id',array('class' => 'form-control','label'=>'Distrct'));
echo $this->Form->input('block_id',array('class' => 'form-control'));

echo $this->Form->input('name',array('class' => 'form-control','label'=>'Panchayat'));

?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
<script>
$(document).ready(function(){
$("#PanchayatCityId").change(function(){
var c=$(this).val();
$('#PanchayatBlockId').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#PanchayatBlockId").html(result);}});

});
});
</script>