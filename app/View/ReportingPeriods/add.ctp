<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Reporting Period'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Grant Period'), array('controller' => 'periods', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Grant Period'), array('controller' => 'periods', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('ReportingPeriod'); ?>
<fieldset>
<legend><?php echo __('Add Reporting Period'); ?></legend>
<?php
echo "<div class=col-sm-3>".$this->Form->input('from_date',array('class' => 'form-control','type'=>'text'))."</div>";
echo "<div class=col-sm-3>". $this->Form->input('to_date',array('class' => 'form-control','type'=>'text'))."</div>";
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
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('ReportingPeriodFromDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('ReportingPeriodToDate'));

$("#ReportingPeriodFromDate").click( function(e) {
 $('#ReportingPeriodFromDate').attr('type', 'date');
    });
    
    
    $("#ReportingPeriodToDate").click( function(e) {
 $('#ReportingPeriodToDate').attr('type', 'date');
    });
    </script>
    