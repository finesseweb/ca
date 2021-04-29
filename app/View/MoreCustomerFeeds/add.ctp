<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List More Customer Feeds'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Customer Feedbacks'), array('controller' => 'customer_feedbacks', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Customer Feedback'), array('controller' => 'customer_feedbacks', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>


<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('MoreCustomerFeed'); ?>
<fieldset>
<legend><?php echo __('Add More Customer Feed'); ?></legend>
<div class="row">
<table>
<?php
echo "<div class='col-sm-12'>".$this->Form->input('customer_feedback_id',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('project',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][project][]"))."</div><div class='col-sm-3'>".$this->Form->input('sector',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][sector][]"))."</div><div class='col-sm-3'>".$this->Form->input('location',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][location][]"))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('projecttype',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][projecttype][]"))."</div><div class='col-sm-3'>".$this->Form->input('area',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][area][]"))."</div><div class='col-sm-3'>".$this->Form->input('bhk',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][bhk][]"))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('tower',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][tower][]"))."</div><div class='col-sm-3'>".$this->Form->input('floor',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][floor][]"))."</div><div class='col-sm-3'>".$this->Form->input('plc',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][plc][]"))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('rate',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][rate][]"))."</div><div class='col-sm-3'>".$this->Form->input('demand',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][demand][]"))."</div><div class='col-sm-3'>".$this->Form->input('paid',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][paid][]"))."</div>";

?>
</table>
<div id="itemRows"> </div>
</div>
</fieldset>
<div class="col-sm-12"><div class="small_button"><input  onClick="addRow(this.form);" type="button" value="Add row"></div>
<?php echo $this->Form->end(__('Submit')); ?></div>
</div>
</div>





<script type="text/javascript">
var rowNum = 0;
function addRow(frm) {
rowNum ++;
var row = '<div id="rowNum'+rowNum+'"><div class="col-sm-12"><div class="input text required"><label for="MoreCustomerFeedProject">Resale inventory details '+rowNum+'</label></div></div><div class="col-sm-3"><?=$this->Form->input('project',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][project][]"))?></div><div class="col-sm-3"><?=$this->Form->input('sector',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][sector][]"))?></div><div class="col-sm-3"><?=$this->Form->input('location',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][location][]"))?></div><div class="col-sm-3"><?=$this->Form->input('projecttype',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][projecttype][]"))?></div><div class="col-sm-3"><?=$this->Form->input('area',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][area][]"))?></div><div class="col-sm-3"><?=$this->Form->input('bhk',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][bhk][]"))?></div><div class="col-sm-3"><?=$this->Form->input('tower',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][tower][]"))?></div><div class="col-sm-3"><?=$this->Form->input('floor',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][floor][]"))?></div><div class="col-sm-3"><?=$this->Form->input('plc',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][plc][]"))?></div><div class="col-sm-3"><?=$this->Form->input('rate',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][rate][]"))?></div><div class="col-sm-3"><?=$this->Form->input('demand',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][demand][]"))?></div><div class="col-sm-3"><?=$this->Form->input('paid',array('class' => 'form-control'),array("name"=>"data[MoreCustomerFeed][paid][]"))?></div><div class="col-sm-12"><input type="button" class="small_button" value="Remove" onclick="removeRow('+rowNum+');"></div>';
jQuery('#itemRows').append(row);
frm.add_qty.value = '';
frm.add_name.value = '';
}

function removeRow(rnum) {
jQuery('#rowNum'+rnum).remove();
}
</script>