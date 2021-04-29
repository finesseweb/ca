<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Period.id')),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Period.id'))); ?>
<?php echo $this->Html->link(__('List Financial Year'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Subcategory'), array('controller' => 'subcategorys', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Subcategory'), array('controller' => 'subcategorys', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Period'); ?>
<fieldset>
<legend><?php echo __('Edit Financial Year'); ?></legend>
<?php
echo $this->Form->input('id',array('class' => 'form-control'));
echo "<div class=col-sm-3>".$this->Form->input('from_date',array('class' => 'form-control','type'=>'text','value'=>date('d-m-Y',strtotime($this->request->data['Period']['from_date']))))."</div>";
echo "<div class=col-sm-3>". $this->Form->input('to_date',array('class' => 'form-control','type'=>'text','value'=>date('d-m-Y',strtotime($this->request->data['Period']['to_date']))))."</div>";
echo "<div class=col-sm-3>". $this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>  
<script>
//    var dp_cal1;var dp_cal2;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('PeriodFromDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('PeriodToDate'));
$("#PeriodFromDate").click( function(e) {
 $('#PeriodFromDate').attr('type', 'date');
    });
    
    
    $("#PeriodToDate").click( function(e) {
 $('#PeriodToDate').attr('type', 'date');
    });
    </script>