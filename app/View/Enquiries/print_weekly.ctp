    <h2><?php echo __('WEEKLY MONTHLY QUERY REPORT');  ?></h2> 
	<table cellpadding="0" cellspacing="0" id="attendence_form">
    <thead>
    <tr><td colspan="13"> <?=$date?></td></tr>
    <tr><td colspan="4">TOTAL</td><td colspan="9"><?=$total?></td></tr>
    <? $customerTypeUserLeadsWeekly=$this->requestAction(array('controller'=>'enquiries','action'=>'customerTypeUserLeadsWeekly',$fromdate,$todate,$searchProjectId,$total));?>
    <tr><td colspan="13"><? echo $customerTypeUserLeadsWeekly; ?></td></tr>
    <tr>
    <td>Executive</td>
    <td>No Of Queries</td>
    <td>Buyer/Seller/Dealer/Fake/Blank</td>
    <td>First Response Above 50</td>
    <td>Discrepencies</td>
    <td>Company Given Query</td>
    <td>Own Query</td>
    <td>Meetings</td>
    <td>Old Followup</td>
    <td>Response Of meeting above 50</td>
    <td>Open</td>
    <td>Close</td>
    <td>Done</td>
    
    </tr>
 </thead>
      <tbody id="response">
        <?php
		 $users='';$tot='';$enquiries='';$garndtotal=0;$garndtotalQuery=0; $totalcompanyGivenQuery=0;  $totalcompanyGivenQueryTotal=0;$totalFirstResponseAboveTotal=0;$totalownQuery=0;$totalownQueryTotal=0; $countopenWeeklyUserLeadstotal=0; $countdoneWeeklyUserLeadstotal=0;$countcloseWeeklyUserLeadstotal=0;$countallopenWeeklyUserLeadstotal=0; $countallcloseWeeklyUserLeadstotal=0; $countalldoneWeeklyUserLeadstotal=0; if(!empty($data)) { foreach ($data as $data): 
		$users=$this->requestAction(array('controller'=>'enquiries','action'=>'usersOnParentdata',$data['user']['id']));
		$totalFirstResponseAbove=0;
		?>
        <tr> <th colspan="13">Group ( <? echo $data['user']['name'].' '.$data['user']['last_name']; ?> ) (<? $count=count($users); echo $count; ?>)</th></tr>
        
        <? if(!empty($users)) { foreach ($users as $usr):
	
		$enquiries=$this->requestAction(array('controller'=>'enquiries','action'=>'weeklyAll',$fromdate,$todate,$searchProjectId,$usr['user']['id']));
		//print_r($enquiries);
		if(!empty($enquiries)) {
		//$dailyreports=$this->requestAction(array('controller'=>'dailyReports','action'=>'reportOnEnquiry',$enq['Enquiry']['id']));
		 //$getUser=$this->requestAction(array('controller'=>'users','action'=>'getUser',$enq['enq']['user_id']));
		 $countWeeklyUserLeads=$this->requestAction(array('controller'=>'enquiries','action'=>'countWeeklyUserLeads',$fromdate,$todate,$searchProjectId,$usr['user']['id']));
		 $countopenWeeklyUserLeads=$this->requestAction(array('controller'=>'enquiries','action'=>'countopenWeeklyUserLeads',$fromdate,$todate,$searchProjectId,$usr['user']['id']));
		 $countcloseWeeklyUserLeads=$this->requestAction(array('controller'=>'enquiries','action'=>'countcloseWeeklyUserLeads',$fromdate,$todate,$searchProjectId,$usr['user']['id']));
		  $countdoneWeeklyUserLeads=$this->requestAction(array('controller'=>'enquiries','action'=>'countdoneWeeklyUserLeads',$fromdate,$todate,$searchProjectId,$usr['user']['id']));
		 $customerTypeUserLeads=$this->requestAction(array('controller'=>'enquiries','action'=>'customerTypeUserLeads',$fromdate,$todate,$searchProjectId,$usr['user']['id'],$countWeeklyUserLeads));
		 $responseUserLeads=$this->requestAction(array('controller'=>'enquiries','action'=>'responseUserLeads',$fromdate,$todate,$searchProjectId,$usr['user']['id']));
		 $companyGivenQuery=$this->requestAction(array('controller'=>'enquiries','action'=>'leadsFromSource',$fromdate,$todate,$searchProjectId,$usr['user']['id'],'company_given_query'));
		 $ownQuery=$this->requestAction(array('controller'=>'enquiries','action'=>'leadsFromSource',$fromdate,$todate,$searchProjectId,$usr['user']['id'],'own_query'));
		 $garndtotal+=$countWeeklyUserLeads;
		 $totalFirstResponseAbove+=$responseUserLeads;
		 $totalcompanyGivenQuery+=$companyGivenQuery;
		 $totalownQuery+=$ownQuery;
		 $countopenWeeklyUserLeadstotal+= $countopenWeeklyUserLeads; 
		 $countcloseWeeklyUserLeadstotal+= $countcloseWeeklyUserLeads; 
		 $countdoneWeeklyUserLeadstotal+= $countdoneWeeklyUserLeads; 
		 ?>
     
      <tr>
        <td><?php echo $usr['user']['username']; ?></td>
      <td><?php echo $countWeeklyUserLeads; ?></td>
      <td><?php echo $customerTypeUserLeads; ?></td>
      <td style="text-align:center"><?php echo $responseUserLeads; ?></td>
      <td><input type="text" style="border:none;width:90%;"/></td>
      <td style="text-align:center"><?php echo $companyGivenQuery; ?></td>
      <td style="text-align:center"><?php echo $ownQuery; ?></td>
      <td><input type="text" style="border:none;width:90%;"/></td>
      <td><input type="text" style="border:none;width:90%;"/></td>
      <td><input type="text" style="border:none;width:90%;"/></td>
      <td><?php echo $countopenWeeklyUserLeads; ?></td>
      <td><?php echo $countcloseWeeklyUserLeads;  ?></td>
       <td><?php echo $countdoneWeeklyUserLeads;  ?></td>
      </tr>
     
      
      <? //endforeach; 
	  } ?> 
     
    <? endforeach; } ?>
      <tr><th>TOTAL</th><th colspan="1"><?=$garndtotal?></th><th colspan="1"></th><th colspan="1" style="text-align:center"><?=$totalFirstResponseAbove?></th><th colspan="1"></th><th colspan="1" style="text-align:center"><?=$totalcompanyGivenQuery?></th><th colspan="1" style="text-align:center"><?=$totalownQuery?></th><th colspan="1"></th><th colspan="1"><th colspan="1"></th><th colspan="1"><?=$countopenWeeklyUserLeadstotal?></th><th colspan="1"><?=$countcloseWeeklyUserLeadstotal?></th><th colspan="1"><?=$countdoneWeeklyUserLeadstotal?></th></tr> 
     
<?php $garndtotalQuery+=$garndtotal; $garndtotal=0;  $totalcompanyGivenQueryTotal+=$totalcompanyGivenQuery;$totalcompanyGivenQuery=0; $totalownQueryTotal+=$totalownQuery; $totalownQuery=0; $totalFirstResponseAboveTotal+=$totalFirstResponseAbove; $countallopenWeeklyUserLeadstotal+=$countopenWeeklyUserLeadstotal;$countopenWeeklyUserLeadstotal=0; $countallcloseWeeklyUserLeadstotal+=$countcloseWeeklyUserLeadstotal;$countcloseWeeklyUserLeadstotal=0; $countalldoneWeeklyUserLeadstotal+=$countdoneWeeklyUserLeadstotal;$countdoneWeeklyUserLeadstotal=0; endforeach;  ?>
 <tr><th>GRAND TOTAL</th><th colspan="1"></th><th colspan="1"></th><th colspan="1" style="text-align:center"><?=$totalFirstResponseAboveTotal?></th><th colspan="1"></th><th colspan="1" style="text-align:center"><?=$totalcompanyGivenQueryTotal?></th><th colspan="1" style="text-align:center"><?=$totalownQueryTotal?></th><th colspan="1"></th><th colspan="1"></th><th colspan="1"></th><th colspan="1"><?=$countallopenWeeklyUserLeadstotal?></th><th colspan="1"><?=$countallcloseWeeklyUserLeadstotal?></th><th colspan="1"><?=$countalldoneWeeklyUserLeadstotal?></th></tr> 
<? } else { ?><tr><td colspan="13">NO MORE RECORDS.</td></tr><? } ?>
    <tr><td colspan="13"><input type="button" name="reset" id="confirm" class="confirm" value="Print"/></td></tr>
    </tbody>
	</table>
<script>
$(".confirm").click(function() {
// Print the DIV.
$("#confirm").hide();
window.print('#attendence_form')
//$('#attendence_form').printElement();
//return (false);
});
</script>