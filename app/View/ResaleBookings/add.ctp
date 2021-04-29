<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Resale Bookings'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<?php echo $this->Form->create('ResaleBooking'); ?>
<fieldset>
<legend><?php echo __('Add Resale Booking'); ?></legend>
<?php

echo "<div class='col-sm-3'>".$this->Form->input('date_of_booking',array('class' => 'form-control','type'=>'text','onFocus'=>'showDate("ResaleBookingDateOfBooking")'))."</div><div class='col-sm-3'>".$this->Form->input('builder_id',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('project_id',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('first_seller_name',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('second_seller_name',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('third_seller_name',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('first_buyer_name',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('second_buyer_name',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('third_buyer_name',array('class' => 'form-control'))."</div>";


echo "<div class='col-sm-3'>".$this->Form->input('unit_no',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('project_plan',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('area',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('areatype',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('rate',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('premium',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('bsp',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('plc',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('carparking',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('other',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('location_id',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('broker_name',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('broker_company',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('buyer',array('type'=>'checkbox','value'=>'Buyer'))."</div><div class='col-sm-3'>".$this->Form->input('seller',array('type'=>'checkbox','value'=>'Seller'))."</div>";

echo "<div class='clearfix'></div>";
/*echo "<div class='col-sm-3'>".$this->Form->input('cheque_no_1')."</div><div class='col-sm-3'>".$this->Form->input('cheque_date_1')."</div><div class='col-sm-3'>".$this->Form->input('drawn_on_1')."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('cheque_amount_1')."</div><div class='col-sm-3'>".$this->Form->input('cheque_no_2')."</div><div class='col-sm-3'>".$this->Form->input('cheque_date_2')."</div>";


echo "<div class='col-sm-3'>".$this->Form->input('drawn_on_2')."</div><div class='col-sm-3'>".$this->Form->input('cheque_amount_2')."</div><div class='col-sm-3'>".$this->Form->input('cheque_no_3')."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('cheque_date_3')."</div><div class='col-sm-3'>".$this->Form->input('drawn_on_3')."</div><div class='col-sm-3'>".$this->Form->input('cheque_amount_3')."</div>";*/


echo "<div class='col-sm-3'>".$this->Form->input('message_status',array('class' => 'form-control'),array('label'=>'Messaging Clearance Status','class' => 'form-control','type'=>'select','options'=>array('Pending'=>'Pending','Ok'=>'Ok')))."</div><div class='col-sm-3'>".$this->Form->input('message_status_date',array('class' => 'form-control','type'=>'text','onFocus'=>'showDate("ResaleBookingMessageStatusDate")'))."</div><div class='col-sm-3'>".$this->Form->input('message_status_comment',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('booked_by',array('class' => 'form-control','type'=>'select','options'=>array(''=>'Select user',$users)))."</div><div class='col-sm-3'>".$this->Form->input('booked_by_joint_one',array('class' => 'form-control','type'=>'select','options'=>array(''=>'Select user',$users)))."</div><div class='col-sm-3'>".$this->Form->input('booked_by_joint_two',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('booking_source',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('final_remark',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control'))."</div>";
?>
</fieldset>
<div class="col-sm-12"><?php echo $this->Form->end(__('Submit')); ?></div>
</div>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2; 
function showDate(id)
{ 
new Epoch('epoch_popup','popup',document.getElementById(id));	
}
</script>