<style type="text/css">
@media print{
table{page-break-after:always;}
}
</style>
<h2><?php echo __('DAILY QUERY REPORT');  ?><span style="margin-left:75%;">2</span></h2> 
<div id="attendence_form">
<table>
<thead>
<tr><th colspan="10" class="text-center">Daily Report As On <?=date('d-m-Y, l',strtotime($date))?></th></tr>
<tr><th colspan="3" class="text-center">TOTAL</th><th colspan="7"><?=$total?>(<?=$this->requestAction(array('controller'=>'enquiries','action'=>'totalUser'))?>)</th></tr>
<? $sourceWiseLeadsCounter=$this->requestAction(array('controller'=>'enquiries','action'=>'sourceWiseLeadsCounter',$date));?>
<tr><th colspan="10" class="text-center"><? echo $sourceWiseLeadsCounter; ?><?=$this->requestAction(array('controller'=>'enquiries','action'=>'movedToLeads',$date));?></th></tr>
<tr>
<th>Executive</th>
<th>Client</th>
<th>Country</th>
<th>Project</th>
<th>Status</th>
<th>Attended By</th>
<th>Client Type</th>
<th>Response</th>
<th>Source</th>
<th>Msg Sent</th>
</tr>
</thead>
<tbody id="response">
<?php $users='';$tot=0;$enquiries=''; if(!empty($data)) { foreach ($data as $data): 
$users=$this->requestAction(array('controller'=>'enquiries','action'=>'usersOnParent',$data['user']['id']));
?>

<tr> <th colspan="10" class="text-center">Group ( <? echo $data['user']['name'].' '.$data['user']['last_name']; ?> ) (<?=$this->requestAction(array('controller'=>'enquiries','action'=>'dailyLeadCountByUser',$date,$data['user']['id']))?>) / (<?=$this->requestAction(array('controller'=>'enquiries','action'=>'teamUser',$data['user']['id']))?>)</th></tr>

<?  if(!empty($users)) { foreach ($users as $usr):

$enquiries=$this->requestAction(array('controller'=>'enquiries','action'=>'dailyAll',$date,$usr['user']['id']));
//print_r($enquiries);

if(!empty($enquiries) and count($enquiries)!=0) {  foreach ($enquiries as $enq):
$tot+=1;
$dailyreports=$this->requestAction(array('controller'=>'dailyReports','action'=>'reportOnEnquiry',$enq['Enquiry']['id']));
$leadsource=$this->requestAction(array('controller'=>'enquiries','action'=>'leadsource',$enq['Enquiry']['lead_source_id']));

?>

<tr>
<td><?php echo h($usr['user']['name']); ?></td>
<td><?php echo h($enq['Enquiry']['name']); ?></td>
<td><?php echo h($enq['Country']['name']); ?></td>
<td><?php echo h($enq['Project']['name']); ?></td>
<td><?php echo h(ucfirst($enq['Enquiry']['status'])); ?></td>
<td><?php if(!empty($dailyreports)) { echo h($this->requestAction(array("controller"=>"users","action"=>"getUser",$dailyreports[0]['DailyReport']['attend_by'])));} ?></td>
<td><?php if(!empty($dailyreports)) {echo h($dailyreports[0]['DailyReport']['customer_type']);} ?></td>
<td><?php if(!empty($dailyreports)) {echo h($dailyreports[0]['DailyReport']['response']);} ?></td>
<td><?php if(!empty($leadsource)) {echo h($leadsource);} ?></td>
<td><?php if(!empty($dailyreports)) {echo h(ucfirst($dailyreports[0]['DailyReport']['msgsent'])); } ?></td>
</tr>


<? endforeach; } ?> 

<?  endforeach; } ?>
<tr><th colspan="10">&nbsp;&nbsp;</th></tr>
<?php $tot=0; endforeach;  ?>
<? } else { ?><tr><td colspan="13">NO MORE RECORDS.</td></tr><? } ?>
</tbody>

</table>
<?php /*?><div class="reprint"></div><?php */?>
<!--<div style='page-break-after:always;'></div>-->
<? $meetings=$this->requestAction(array('controller'=>'meetings','action'=>'report',$date)); ?>
<table cellpadding="0" cellspacing="0" class="meeting">
<thead>
<tr><th colspan="11" class="text-center">Daily Meeting Feeds As On  <?=date('d-m-Y, l',strtotime($date))?></th></tr>
<tr><th colspan="4">TOTAL</td><td colspan="7"><?=count($meetings)?></th></tr>
<tr><th colspan="11"><? echo $this->requestAction(array('controller'=>'meetings','action'=>'meetingStatusCounter',$date));?></td></tr>
<tr>
<th>Executive</th>
<th>Project Name</th>
<th>Timings</th>
<th>Client</th>
<th>Meeting Place</th>
<th>Representative</th>
<th>Status</th>
<th>Response</th>
<th>First Response</th>
<th>Form Received</th>
<th>Lead Repeat</th>
</tr>
</thead>
<tbody>
<? if(!empty($meetings)) { foreach($meetings as $value) { $representative=$this->requestAction(array('controller'=>'users','action'=>'getUser',$value['Meeting']['representative'])) ?>
<tr>
<td><?=$value['User']['username']?></td>
<td><?=$value['Project']['name']?></td>
<td><?=date('d-m-Y',strtotime($value['Meeting']['timing']))?><br/><?=date('H:i:s',strtotime($value['Meeting']['timing']))?><? //=$value['Meeting']['timing']?></td>
<td><?=$value['Meeting']['client_name']?></td>
<td><?=$value['Meeting']['meeting_place']?></td>
<td><?=$representative?></td>
<td><?=ucfirst($value['Meeting']['status'])?></td>
<td><?=$value['Meeting']['response']?></td>
<td><?=$value['Meeting']['first_response']?></td>
<td><?=ucfirst($value['Meeting']['form_received'])?></td>
<td><?=ucfirst($value['Meeting']['form_repeat'])?></td>
</tr>
<?  }  } else {  ?>
<tr><td colspan="11">No more records found.</td></tr>
<? }?></tbody>
</table>


<? //$campaigns=$this->requestAction(array('controller'=>'mailerFeeds','action'=>'dailyAll')); ?>
<? /* ?><table cellpadding="0" cellspacing="0">
<tr><th colspan="3" class="text-center">Mailers Campaign As On  <?=date('d-m-Y, l',strtotime($date))?></th><th colspan="2" class="report-heading">Total : <?=count($campaigns)?></th></tr>
<tr>
<th>Builder</th>
<th>Project</th>
<th>Total Data</th>
<th>Type Of Data</th>
<th>If No Any Mailer</th>
</tr>
<?
if($campaigns){ foreach($campaigns as $key=>$data) { 
?>
<tr>
<td class="text-nowrap"><?=ucfirst($data['MailerFeed']['builder'])?></td>
<td class="text-nowrap"><?=ucfirst($data['MailerFeed']['project'])?></td>
<td><?=ucfirst($data['MailerFeed']['total_data'])?></td>
<td><?=ucfirst($data['MailerFeed']['type_of_data'])?></td>
<td><?=ucfirst($data['MailerFeed']['if_no_any_mailer'])?></td>
</tr>
<? } } else { ?>  <tr><td colspan="5">No more records found.</td></tr> <? } ?></table>
<? */ ?>
<input type="button" name="reset" id="confirm" class="confirm" value="Print"/></td></tr>

</div>
<script>
$(".confirm").click(function() {
// Print the DIV.
$("#confirm").hide();
window.print('#attendence_form')
//$('#attendence_form').printElement();
//return (false);
});
</script>