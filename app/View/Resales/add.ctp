<?php /*?><div class="resales form"><?php */?>
<?php echo $this->Form->create('Resale'); ?>
	<fieldset>
		<legend><?php echo __('Add Resale'); ?></legend>
        <div class="edit_author">
        <table>
	<?php
	echo "<tr><td colspan='3' height='30px'><b>User Details</b><hr/></td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('client_type',array('options'=>array(''=>'Select','buyer'=>'Buyer','seller'=>'Seller','dealer'=>'Dealer','landlord'=>'Landlord','tenant'=>'Tenant')))."</td><td width='30%'>".$this->Form->input('name')."</td><td width='30%'>".$this->Form->input('second_name')."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('email')."</td><td width='30%'>".$this->Form->input('email2')."</td><td width='30%'>".$this->Form->input('contact')."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('user_id',array('label'=>'Enquiry Executive Name','options'=>array(''=>'Select User',$users)))."</td><td width='30%'>".$this->Form->input('refer_to',array('label'=>'Refer Executive Name','options'=>array(''=>'Select User',$users)))."</td><td width='30%'>".$this->Form->input('resale_type',array('options'=>array(''=>'Select','purchase'=>'Purchase','sales'=>'Sales','lease-rent'=>'Lease / Rent')))."</td></tr>";
	
	echo "<tr><td colspan='3' height='30px'><b>Project Details</b><hr/></td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('unit_type')."</td><td width='30%'>".$this->Form->input('tower')."</td><td width='30%'>".$this->Form->input('booking')."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('demand')."</td><td width='30%'>".$this->Form->input('plc')."</td><td width='30%'>".$this->Form->input('paid')."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('budget')."</td><td width='30%'>".$this->Form->input('unit_no')."</td><td width='30%'>".$this->Form->input('area')."</td></tr>";
	
	echo "<tr><td colspan='3' height='30px'><b>Other Details</b><hr/></td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('builder_id',array('options'=>array(''=>'Select Builder',$builders)))."</td><td width='30%'>".$this->Form->input('project_id',array('options'=>array(''=>'Select Project')))."</td><td width='30%'>".$this->Form->input('property_type_id',array('options'=>array(''=>'Select Prop Type',$propertyTypes)))."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('sub_type')."</td><td width='30%'>".$this->Form->input('country_id')."</td><td width='30%'>".$this->Form->input('lead_source_id')."</td></tr>";
	
	echo "<tr><td width='30%'>".$this->Form->input('sector_id',array('options'=>array(''=>'Select Sector',$sectors)))."</td><td width='30%'>".$this->Form->input('sector_other')."</td><td width='30%'>".$this->Form->input('query')."</td></tr>";
	?>
	</table></div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<?php /*?></div><div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Resales'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Builders'), array('controller' => 'builders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Builder'), array('controller' => 'builders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Property Types'), array('controller' => 'property_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Property Type'), array('controller' => 'property_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Close Reasons'), array('controller' => 'close_reasons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Close Reason'), array('controller' => 'close_reasons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lead Sources'), array('controller' => 'lead_sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lead Source'), array('controller' => 'lead_sources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
	</ul>
</div><?php */?>
<script>
$(document).ready(function(){
  $("#ResaleBuilderId").change(function(){
  var c=$(this).val();
  $('#ResaleProjectId').html("<option value=''>loading......</option>"); 
  $.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#ResaleProjectId").html(result);}});
  
  });
});
</script>