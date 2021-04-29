<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Panchayat'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Blocks'), array('controller' => 'blocks', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New BLock'), array('controller' => 'blocks', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php ////echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Panchayat'); ?>
<fieldset>
<legend><?php echo __('Add Panchayat'); ?></legend>
<?php
echo $this->Form->input('name',array('class' => 'form-control','label'=>'Panchayat'));
echo $this->Form->input('city_id',array('class' => 'form-control','label'=>'District'));
echo $this->Form->input('block_id',array('class' => 'form-control'));
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