<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Overhead'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
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
<?php echo $this->Form->create('Overhead'); ?>
<fieldset>
<legend><?php echo __('Add Overhead'); ?></legend>
<?php
echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'--Select--',$ngo),'required'=>'required'))."</div>";
?>
<div class="col-sm-3"><div class="input select"><label for="NgoPeriodId">Grant Period</label>
         <select name="data[Overhead][period_id]" class="form-control" id="NgoPeriodId" required="required">
<option value="">Select Period</option>
<?php foreach ($period as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['periods']['id']?>"><?=date('d-m-Y',strtotime($value['periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['periods']['to_date']))?></option>
<?php } ?>
</select></div></div>
<?php

echo "<div class='col-sm-3'>".$this->Form->input('category',array('class' => 'form-control','options'=>array($cats),'multiple'=>'multiple'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('remarks',array('class' => 'form-control'))."</div>";

?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
<script type="text/javascript">
    
 $('#OverheadCategory').multiselect({
  nonSelectedText: 'Select Category',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'200px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});
    </script>