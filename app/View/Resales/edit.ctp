<?php /*?><div class="resales form"><?php */?>
<?php if((CakeSession::read('User.type')==='user') || (CakeSession::read('User.type')==='regular' and CakeSession::read('User.id')===$this->request->data['Resale']['user_id'])) { ?>
<?php echo $this->Form->create('Resale'); ?>
	<fieldset>
		<legend><?php echo __('Edit Resale'); ?></legend>
        <div class="edit_author">
        <table>
	<?php
	echo "<tr><td colspan='3' height='30px'><b>User Details</b><hr/></td></tr>";
	echo "<tr><td width='30%'>".$this->Form->input('client_type',array('options'=>array(''=>'Select','buyer'=>'Buyer','seller'=>'Seller','dealer'=>'Dealer','customer'=>'Customer')))."</td><td width='30%'>".$this->Form->input('name')."</td><td width='30%'>".$this->Form->input('second_name')."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('email')."</td><td width='30%'>".$this->Form->input('email2')."</td><td width='30%'>".$this->Form->input('contact')."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('user_id',array('label'=>'Enquiry Executive Name','options'=>array(''=>'Select User',$users)))."</td><td width='30%'>".$this->Form->input('refer_to',array('label'=>'Refer Executive Name','options'=>array(''=>'Select User',$users)))."</td><td width='30%'>".$this->Form->input('resale_type',array('options'=>array(''=>'Select','purchase'=>'Purchase','sales'=>'Sales','lease-rent'=>'Lease / Rent')))."</td></tr>";
	
	echo "<tr><td colspan='3' height='30px'><b>Project Details</b><hr/></td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('unit_type')."</td><td width='30%'>".$this->Form->input('tower')."</td><td width='30%'>".$this->Form->input('booking')."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('demand')."</td><td width='30%'>".$this->Form->input('plc')."</td><td width='30%'>".$this->Form->input('paid')."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('budget')."</td><td width='30%'>".$this->Form->input('unit_no')."</td><td width='30%'>".$this->Form->input('area')."</td></tr>";
	
	echo "<tr><td colspan='3' height='30px'><b>Other Details</b><hr/></td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('builder_id')."</td><td width='30%'>".$this->Form->input('project_id')."</td><td width='30%'>".$this->Form->input('property_type_id',array('options'=>array(''=>'Select Prop Type',$propertyTypes)))."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('sub_type')."</td><td width='30%'>".$this->Form->input('country_id')."</td><td width='30%'>".$this->Form->input('close_reason_id',array('options'=>array(''=>'Select Reason',$closeReasons)))."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('status',array('options'=>array('open'=>'Open','close'=>'Close','done'=>'Done','trash'=>'Trash')))."</td><td width='30%'>".$this->Form->input('lead_source_id')."</td><td width='30%'>".$this->Form->input('sector_id',array('options'=>array(''=>'Select Sector',$sectors)))."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('sector_other')."</td><td width='30%'>".$this->Form->input('query')."</td><td width='30%'></td></tr>";
	
	?>
	</table></div>
	</fieldset>
<?php echo $this->Form->input('id'); echo $this->Form->end(__('Submit')); ?>
<? } else { ?>YOU CAN'T EDIT THIS IS NOT YOUR LEAD<? } ?>

<script>
$(document).ready(function(){
  $("#ResaleBuilderId").change(function(){
  var c=$(this).val();
  $('#ResaleProjectId').html("<option value=''>loading......</option>"); 
  $.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#ResaleProjectId").html(result);}});
  
  });
});
</script>