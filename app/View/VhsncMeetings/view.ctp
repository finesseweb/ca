<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncAfc']['id']); ?>
&nbsp;
</td>
</tr>-->

<tr>
    <td style="width:175px;"><?php echo __('Panchayat Name '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td style="width:175px;"><?php echo __('Village Name'); ?></td>
<td>
<?php if($vhsncAfc['Village']['name']=='0' || $vhsncAfc['Village']['name']=='') {
    echo "All Village";
    
}
else {
echo h(ucfirst($vhsncAfc['Village']['name'])); 

} ?>
&nbsp;
</td>
</tr>
<tr>
<td style="width:175px;"><?php echo __('Ward Name'); ?></td>
<td>
<?php if($vhsncAfc['Ward']['name']=='0' || $vhsncAfc['Ward']['name']=='') {
    echo "All Ward";
    
}
else {
echo h(ucfirst($vhsncAfc['Ward']['name'])); 

} ?>&nbsp;
</td>
</tr>

<tr>
<td style="width:175px;"><?php echo __('Meeting Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsncAfc['VhsncMeeting']['meeting_date']))); ?>
&nbsp;
</td>
</tr>

<tr>
<td style="width:180px;"><?php echo __('VHSNC Quorum Completed'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['vhsnc_quorum_ompleted'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td style="width:250px;"><?php echo __('Types of Reg. Member Participated'); ?></td>
<td>
  

<?php
$mem = explode(',',$vhsncAfc['VhsncMeeting']['register_member']);
//print_r($mem);
foreach($mem as $m) {
  $questionlist=$this->requestAction(array("controller"=>"registerMembers","action"=>"gettitle",$m)); 
        if(!empty($questionlist))           
                  echo ucwords($questionlist['RegisterMember']['name'].' ');
}

 ?>
&nbsp;
</td>
</tr>

<tr>
<td style="width:175px;"><?php echo __('Meeting Facilitated by'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['MeetingFacilitated']['name'])); ?>
&nbsp;
</td>
</tr>


<!--<tr>
<td style="width:175px;"><?php echo __('No. New Issues Identified '); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncMeeting']['new_issue']); ?>
&nbsp;
</td>
</tr>
<tr>
<td style="width:175px;"><?php echo __('Decisions Taken (No.)'); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncMeeting']['decision_taken']); ?>
&nbsp;
</td>
</tr>-->


<!--<tr>
<td style="width:175px;"><?php echo __('Issues resolved (No.)'); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncMeeting']['solved_issue']); ?>
&nbsp;
</td>
</tr>-->
<tr>
<td style="width:175px;"><?php echo __('Issues Category'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['IssueCategory']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td style="width:175px;"><?php echo __('Issues Level'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['IssueSubcategory']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td style="width:175px;"><?php echo __('Details of Identified Issue '); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncMeeting']['issue_details']); ?>
&nbsp;
</td>
</tr><tr>
<td style="width:175px;"><?php echo __('Decisions Taken'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['decisions_taken'])); ?>
&nbsp;
</td>
</tr><tr>
<td style="width:175px;"><?php echo __('Details of Decisions Taken '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['decision_details'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td style="width:175px;"><?php echo __('Issues Resolved'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['issue_resolved'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td style="width:175px;"><?php echo __('Issues Resolved date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsncAfc['VhsncMeeting']['issue_resolved_date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td style="width:175px;"><?php echo __('Details of issues Resolved'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['issue_remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td style="width:175px;"><?php echo __('Letter Issued to BPMC'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['letter_issued_bpmc'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td style="width:175px;"><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['status'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
