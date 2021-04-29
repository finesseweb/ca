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
<? if(CakeSession::read('User.type')==='admin'){?><table><tr><td class="actions"><span><a href="javascript:void(0)" <? if($enquiry['Enquiry']['is_discrepency']=='Y'){?>class="pending"<? } ?> onclick="window.open('<?=SITE_PATH."enquiries/view/".$enquiry['Enquiry']['id']?>','abhay','scrollbars=1,width=1400,height=750,left=100,top=50')" title="Discrepency"> &laquo; GO TO REMARKS</a></span></td></tr></table><? } ?>
</div>
<div class="related">
	<h3><?php echo __('Related Discrepency'); ?></h3>
    <div class="table-responsive"><table class="table table-striped" id="allremarks">
	<?php if (!empty($discrepencies)){ ?>
	<tr>
		<th><?php echo __('S.N'); ?></th>
		<th><?php echo __('Discrepency'); ?></th>
		<th><?php echo __('posted'); ?></th>
        <th><?php echo __('Feed By'); ?></th>
        
		<?php /*?><th class="actions"><?php echo __('Actions'); ?></th><?php */?>
	</tr>
	<?php $class='';$stat='';$remarkcount=count($discrepencies)-1;  foreach ($discrepencies as $key=>$discrepency):  ?>
		<tr class="<? echo $discrepency['Discrepency']['status'] ; ?>" title="<? echo $discrepency['Discrepency']['status'] ;?>">
			<td><?php echo $key+1; ?></td>
			<td><?php echo $discrepency['Discrepency']['comment']; ?></td>
			<td><?php echo date("d M,Y H:i:s",strtotime($discrepency['Discrepency']['posted'])); ?></td>
            <td><?php echo $this->requestAction(array("controller"=>"users","action"=>"getUser",$discrepency['Discrepency']['feedBy'])); ?></td>
		</tr>
	<?php endforeach; ?>
	
<?php } else {  ?>
<tr><td colspan="2">NO MORE RECORD FOUND.</td></tr>
<? } ?>
</table></div>
</div>

<div class="related">
    <h3><?php echo "Send New Discrepency"; ?></h3>
    <?php echo $this->Form->create('Discrepency'); ?>
    <table>
	<?php
	echo "<tr><td>".$this->Form->input('comment',array('class' => 'form-control','label'=>'Discrepency','placeholder'=>'THIS MESAGE WILL SEND TO ADMIN AND EXECUTIVE')).$this->Form->input('enquiry_id',array('type'=>'hidden','value'=>$enquiry['Enquiry']['id'])).$this->Form->input('user_id',array('type'=>'hidden','value'=>$enquiry['User']['id']))."</td></tr>";
	if(CakeSession::read('User.type')=='admin'){
	echo "<tr><td>".$this->Form->input('status',array('label'=>'If you want to close check this','type'=>'checkbox','value'=>'D','hiddenField'=>'Y'))."</td></tr>";
	}
	?>
    </table>
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

