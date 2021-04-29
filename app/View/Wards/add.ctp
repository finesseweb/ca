<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Wards'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Panchayats'), array('controller' => 'panchayats', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Panchayat'), array('controller' => 'panchayats', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Ward'); ?>
<fieldset>
<legend><?php echo __('Add Ward'); ?></legend>
<?php

//echo $this->Form->input('city_id',array('class' => 'form-control','label'=>'District'));
//echo $this->Form->input('block_id',array('class' => 'form-control'));
//echo $this->Form->input('panchayat_id',array('class' => 'form-control'));
//echo $this->Form->input('village_id',array('class' => 'form-control'));
echo $this->Form->input('name',array('class' => 'form-control','label'=>'Ward'));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
<script>
$(document).ready(function(){
$("#WardCityId").change(function(){
var c=$(this).val();
$('#WardBlockId').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#WardBlockId").html(result);}});

});

$("#WardBlockId").change(function(){
var c=$(this).val();
$('#WardPanchayatId').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#WardPanchayatId").html(result);}});

});

$("#WardPanchayatId").change(function(){
var c=$(this).val();
$('#WardVillageId').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#WardVillageId").html(result);}});

});
});
</script>