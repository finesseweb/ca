<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Projects'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Builders'), array('controller' => 'builders', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Builder'), array('controller' => 'builders', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Project'); ?>
<fieldset>
<legend><?php echo __('Add Project'); ?></legend>
<div class="row">
<div class="col-sm-4"><?php echo $this->Form->input('builder_id',array('class' => 'form-control')); ?></div>
<div class="col-sm-4"><?php echo $this->Form->input('state_id',array('class' => 'form-control')); ?></div>
<div class="col-sm-4"><?php echo $this->Form->input('city_id',array('class' => 'form-control')); ?></div>
<div class="col-sm-4"><?php echo $this->Form->input('name',array('class' => 'form-control')); ?></div>
<div class="col-sm-4"><?php echo $this->Form->input('title',array('class' => 'form-control')); ?></div>
<div class="col-sm-4"><?php echo $this->Form->input('property_type_id',array('class' => 'form-control')); ?></div>
<?php //echo $this->Form->input('status'); ?>
<div class="col-sm-6"><?php echo $this->Form->input('posted_date'); //echo $this->Form->input('updated_date');?></div>
</div>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$("#ProjectStateId").change(function(){
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>projects/getcity/"+c,success:function(result){$("#ProjectCityId").html(result);}});

});
});
</script>