<div class="related">
<h3><?php echo __('Show More'); ?> : <span style="cursor:pointer" class="showhide" data-id="show">[+]</span> </h3> 
<table cellpadding = "0" cellspacing = "0" id="alldata" style="display:none">
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
    <tr><th><?php echo __('Source'); ?></th><td><?php echo h($enquiry['LeadSource']['name']); ?></td><th><?php echo __('Close Reason'); ?></th><td><? echo h($enquiry['CloseReason']['name'])?></td></tr>
	<? if($enquiry['Enquiry']['lead_of']!=0) { ?><tr><th><?php echo __('Lead Of'); ?></th><td><?php echo $this->requestAction(array("controller"=>"users","action"=>"getUser",$enquiry['Enquiry']['lead_of'])); ?></td><th></th><td></td></tr><? } ?>
</table>

<? if(CakeSession::read('User.type')==='admin'){?><table><tr><td class="actions"><a href="javascript:void(0)" <? if($enquiry['Enquiry']['is_discrepency']=='Y'){?>class="pending"<? } ?> onclick="window.open('<?=SITE_PATH."discrepencies/view/".$enquiry['Enquiry']['id']?>','abhay','scrollbars=1,width=1400,height=750,left=100,top=50')" title="Discrepency"> &laquo; MARK DISCREPENCIES</a></td><td class="actions"><input value="&laquo; MOVE TO ABJ" class="searchbtn <?=$enquiry['Enquiry']['moved']?>" type="button" id="moveto" move-id="<?=$enquiry['Enquiry']['id']?>" move-val="<?=$enquiry['Enquiry']['moved']?>"></td></tr></table><? } ?>
</div>
<div class="related">

	<h3><?php echo __('Related Remarks'); ?></h3>
    <table cellpadding = "0" cellspacing = "0" id="allremarks">
	<?php if (!empty($remarks)){ ?>
    <? if($enquiry['Enquiry']['reminder_date']!='0000-00-00 00:00:00') { ?><tr>
		<th colspan="5">Reminder Date : <?php echo h(date('d M ,Y',strtotime($enquiry['Enquiry']['reminder_date']))); ?></th>
        </tr><? } ?>
	<tr>
		<th><?php echo __('S.N'); ?></th>
		<th><?php echo __('Remark'); ?></th>
        <th><?php echo __('Reminder'); ?></th>
		<th><?php echo __('Posted on'); ?></th>
        <th><?php echo __('Feed By'); ?></th>
        
		<?php /*?><th class="actions"><?php echo __('Actions'); ?></th><?php */?>
	</tr>
	<?php $class='';$stat='';$remarkcount=count($remarks)-1;  foreach ($remarks as $key=>$remark):  if($key==$remarkcount){ $class="close";$stat="Pending";}else{$class="done";$stat="Done";} ?>
		<tr class="<? echo $class ; ?>" title="<? echo $stat ;?>">
			<td><?php echo $key+1; ?></td>
			<td><?php echo $remark['Remark']['name']; ?></td>
            <td><?php echo $remark['Remark']['reminder']; ?></td>
			<td><?php echo date("d M,y H:i:s",strtotime($remark['Remark']['posted_date'])); ?></td>
            <td><?php echo $this->requestAction(array("controller"=>"users","action"=>"getUser",$remark['Remark']['feedBy'])); ?></td>
			<?php /*?><td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'remarks', 'action' => 'view', $remark['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'remarks', 'action' => 'edit', $remark['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'remarks', 'action' => 'delete', $remark['id']), array(), __('Are you sure you want to delete # %s?', $remark['id'])); ?>
			</td><?php */?>
		</tr>
	<?php endforeach; ?>
<?php } else {  ?>
<tr><td colspan="2">NO MORE REMARKS FOUND.</td></tr>
<? } ?>
</table>
</div>
	<?php /*?><div class="related">
    <h3><?php echo "Add New Remark"; ?></h3>
    <?php echo $this->Form->create('Remark'); ?>
    <table cellpadding = "0" cellspacing = "0">
	<tr><td><?php echo $this->Form->input('reminder_date',array('type'=>'text'));?></td></tr>
    <tr><td><?php echo $this->Form->input('name',array("type"=>"text","label"=>"Enter Remark"));?><?php echo $this->Form->input('enquiry_id',array("type"=>"hidden","value"=>$enquiry['Enquiry']['id']));?></td></tr>
<tr><td><div class="input text required"><label for="RemarkReminder">Reminder</label><select name="data[Remark][reminder]" id="RemarkReminder" required="required"> <option value="Call">Call</option> <option value="Meeting">Meeting</option> <option value="Email">Email</option> <option value="Sms">SMS</option> <option value="Important">Important</option> <option value="Working on resale">Working on Resale</option> <option value="Site visit">Site Visit</option></select></div></td></tr>
</table>
<? $selected=''; if(!empty($dailyReports) and ($dailyReports[0]['DailyReport']['enquiry_id']==$enquiry['Enquiry']['id'])){} else { if(!empty($dailyReports[0]['DailyReport']['customer_type'])){$selected=$dailyReports[0]['DailyReport']['customer_type'];} else { $selected='';} ?>
<table cellpadding = "0" cellspacing = "0"><tr><td><? echo $this->Form->input('customer_type',array('options'=>array('Buyer'=>'Buyer','Seller' => 'Seller','Dealer' => 'Dealer','Fake' => 'Fake','NA' => 'NA')));?></td> <td><div class="input select required"><label for="RemarkResponse">Response</label><select  name="data[Remark][response]" required="required"> <option value="">Select Response</option><? for($i=0;$i<=100;$i+=10) {?>><option value="<?=$i?>"><?=$i?> %</option><? }?> <option value="pending">Pending</option></select><input name="data[Remark][user_id]" type="hidden" required="required" value="<?=$enquiry['Enquiry']['user_id']?>"><input name="data[Remark][lead_source_id]" type="hidden" required="required" value="<?=$enquiry['Enquiry']['lead_source_id']?>"></div>
    </td> <td><div class="input select required"><label for="RemarkMsgSent">Msg Sent</label><select  name="data[Remark][msgsent]" required="required"><option value="yes">Yes</option><option value="no">No</option><option value="NA">NA</option></select><input name="data[Remark][lead_source_id]" type="hidden" required="required" value="<?=$enquiry['Enquiry']['lead_source_id']?>"></div>
    </td></tr></table><? } ?>
    <input name="data[Remark][user_id]" type="hidden" required="required" value="<?=$enquiry['Enquiry']['user_id']?>"><?php echo $this->Form->end(__('Submit')); ?> 
	</div><?php */?>
  <link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('RemarkReminderDate'));	
</script> 
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
	
	$("input[type=submit]").click(function(){
   var sure=confirm("Are you sure to add reminder on the date you selected");
   if(sure){return true;} else { return false;}
});
$(document).ready(function() {
var statusofthislead="<?=$enquiry['Enquiry']['moved']?>";
if(statusofthislead=='Yes') {
$("#moveto").val("Moved");
$("#moveto").prop('disabled', true); }
$("#moveto").click(function(){
alert("Are you Sure to move this");
 var id=$(this).attr("move-id");
 var val=$(this).attr("move-val");
$.ajax({url:"<?=SITE_PATH?>enquiries/moveThis/"+id+"/"+val,success:function(result){ res=result.split("#"); if(res[0]==1) { $("#moveto").attr("move-val",res[1]); $("#moveto").val("Moved"); $("#moveto").prop('disabled', true); alert("Data saved successfully");  } else { alert('Please try again');}}});
})})
</script>

