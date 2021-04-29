<div class="related">
<h3><?php echo __('Show More'); ?> : <span style="cursor:pointer" class="showhide" data-id="show">[+]</span></h3>
<div class="table-responsive"><table class="table table-striped" id="alldata" style="display:none">
	<tr><th width="13%"><?php echo __('Id'); ?></th><td><?php echo h($enquiry['Enquiry']['id']); ?></td>
    <th><?php echo __('User'); ?></th><td><?php echo h($enquiry['User']['name']); ?></td></tr>
    <tr><th><?php echo __('Posted Date'); ?></th><td><?php echo date("d M,Y H:i:s",strtotime($enquiry['Enquiry']['posted_date'])); ?></td>
    <th><?php echo __('Name'); ?></th><td><?php echo h($enquiry['Enquiry']['name']); ?></td></tr>
    <tr><th><?php echo __('Email'); ?></th><td><?php echo h($enquiry['Enquiry']['email']); ?></td>
    <th><?php echo __('Contact'); ?></th><td><?php echo h('+ '.$enquiry['Country']['country_code']."  ".$enquiry['Enquiry']['contact']); ?></td></tr>
    <tr><th><?php echo __('Project'); ?></th><td><?php echo h($enquiry['Project']['name']); ?></td>
    <th><?php echo __('Query'); ?></th><td><?php echo h($enquiry['Enquiry']['query']); ?></td></tr>
    <tr><th><?php echo __('Builder'); ?></th><td><?php echo h($enquiry['Builder']['name']); ?></td>
    <th><?php echo __('Country'); ?></th><td><?php echo h($enquiry['Country']['name']); ?></td></tr>
    <tr><th><?php echo __('State'); ?></th><td><?php echo h($enquiry['State']['name']); ?></td>
    <th><?php echo __('City'); ?></th><td><?php echo h($enquiry['City']['name']); ?></td></tr>
    <tr><th><?php echo __('Status'); ?></th><td><?php echo h($enquiry['Enquiry']['status']); ?></td>
    <th><?php echo __('Is Reminder'); ?></th><td><?php echo h($enquiry['Enquiry']['is_reminder']); ?></td></tr>
    <tr><th><?php echo __('Reminder Date'); ?></th><td><?php echo h($enquiry['Enquiry']['reminder_date']); ?></td>
    <th><?php echo __('Updated Date'); ?></th><td><?php echo h($enquiry['Enquiry']['updated_date']); ?></td></tr>
</table></div>
</div>
<div class="related">
	<h3><?php echo __('Related Meetings'); ?></h3>
    <div class="table-responsive"><table class="table table-striped" id="allremarks">
	<?php if (!empty($enquiry['Meeting'])){ ?>
	<tr>
		<th><?php echo __('S.N'); ?></th>
		<th><?php echo __('Name'); ?></th>
        <th><?php echo __('Contact'); ?></th>
		<th><?php echo __('Meeting Place'); ?></th>
        <th><?php echo __('Timing'); ?></th>
        <th><?php echo __('Representative'); ?></th>
        <th><?php echo __('Feed By'); ?></th>
        
		<?php /*?><th class="actions"><?php echo __('Actions'); ?></th><?php */?>
	</tr>
	<?php $class='';$stat='';$remarkcount=count($enquiry['Meeting'])-1;  foreach ($enquiry['Meeting'] as $key=>$meetings):  ?>
		<tr class="<? echo $meetings['status'] ; ?>" title="<? echo $meetings['status'] ;?>">
			<td><?php echo $key+1; ?></td>
			<td><?php echo $meetings['client_name']; ?></td>
            <td><?php echo $meetings['client_contact']; ?></td>
            <td><?php echo $meetings['meeting_place']; ?></td>
			<td><?php echo date("d M,Y H:i:s",strtotime($meetings['timing'])); ?></td>
            <td><?php echo $this->requestAction(array("controller"=>"users","action"=>"getUser",$meetings['representative'])); ?></td>
            <td><?php echo $this->requestAction(array("controller"=>"users","action"=>"getUser",$meetings['feedBy'])); ?></td>
		</tr>
	<?php endforeach; ?>
	
<?php } else {  ?>
<tr><td colspan="2">NO MORE RECORD FOUND.</td></tr>
<? } ?>
</table></div>
</div>
	<div class="related">
    <h3><?php echo "Add New Meeting"; ?></h3>
    <?php echo $this->Form->create('Meeting'); ?>
    <div class="table-responsive"><table class="table table-striped">
	<?php
	$res=array();
	$start=0;
	for($start;$start<=100;$start+=10){ $res[$start]=$start.' % '; }
		echo "<tr><td width='50%'>".$this->Form->input('project_id',array('class' => 'form-control','options'=>array(''=>'Select',$projects),'selected'=>$enquiry['Project']['id']))."</td><td>".$this->Form->input('user_id',array('label'=>'Lead Of','class' => 'form-control','options'=>array($enquiry['User']['id']=>$enquiry['User']['name'])))."</td></tr>";
		echo "<tr><td>".$this->Form->input('client_name',array('class' => 'form-control','value'=>$enquiry['Enquiry']['name']))."</td><td>".$this->Form->input('client_contact',array('class' => 'form-control','value'=>$enquiry['Enquiry']['contact']))."</td></tr>";
		echo "<tr><td colspan='2'>".$this->Form->input('meeting_place',array('class' => 'form-control'))."</td></tr>";
		echo "<tr><td>".$this->Form->input('representative',array('class' => 'form-control','options'=>array(''=>'Select',$users)))."</td><td>".$this->Form->input('second_representative',array('class'=>'notrequired','class' => 'form-control','options'=>array(''=>'Select',$users)))."</td></tr>";
		echo "<tr><td>".$this->Form->input('status',array('class' => 'form-control','options'=>array('pending'=>'Pending','done'=>'Done','cancel'=>'Cancel')))."</td><td>".$this->Form->input('response',array('class' => 'form-control','options'=>$res))."</td></tr>";
		echo "<tr><td>".$this->Form->input('form_received',array('class' => 'form-control','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</td><td>".$this->Form->input('form_repeat',array('class' => 'form-control','options'=>array('new'=>'New','repeat one'=>'Repeat one','repeat two'=>'Repeat two','repeat three'=>'Repeat three','repeat four'=>'Repeat four','repeat five'=>'Repeat five','repeat six'=>'Repeat Six','many times'=>'Many Times')))."</td></tr>";	
		echo "<tr><td colspan='2'>".$this->Form->input('timing').$this->Form->input('enquiry_id',array('type'=>'hidden','value'=>$enquiry['Enquiry']['id']))."</td></tr>";

	?>
    </table></div>
    <?php echo $this->Form->end(__('Submit')); ?>
	</div>
<script>
$(".showhide").click(function()
{
var attr=$(this).attr('data-id');
if(attr=="show"){
$("#alldata").show();
$(this).text("[-]");
$(this).attr('data-id','hide');
} 
else
{
$("#alldata").hide();
$(this).text("[+]");
$(this).attr('data-id','show');
}
})

$('#RemarkViewForm :input[type=submit]').click(function() {
	var c=$("#RemarkViewForm").serialize();
	$.ajax({url:$(this).attr('action')+"/"+c,success:function(result){$("#search_project").html(result);}});
	});
</script>

