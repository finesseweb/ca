<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?>
<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncAfc']['id']); ?>
&nbsp;
</td>
</tr>-->

<!--<tr>
<td><?php echo __('Panchayat Name '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Village Name'); ?></td>
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
<td><?php echo __('Ward Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Ward']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Meeting Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsncAfc['VhsncMeeting']['meeting_date']))); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('VHSNC Quorum Completed'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['vhsnc_quorum_ompleted'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Types of Reg. Member Participated'); ?></td>
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
<td><?php echo __('Meeting Facilitated by'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['MeetingFacilitated']['name'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('No. New Issues Identified '); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncMeeting']['new_issue']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Decisions Taken (No.)'); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncMeeting']['decision_taken']); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Issues resolved (No.)'); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncMeeting']['solved_issue']); ?>
&nbsp;
</td>
</tr>-->
    
  
<tr>
    <td style="width:43px;">Sr No</td><td style="width:50px;"><?php echo __('Id'); ?></td><td style="width:116px;"><?php echo __('Issues Category'); ?></td><td style="width:150px;"><?php echo __('Issues Level'); ?></td><td style="width:200px"><?php echo __('Details of Identified Issue '); ?></td><td style="width:110px;"><?php echo __('Decision Taken '); ?></td><td style="width:110px;" ><?php echo __('Issue Resolved '); ?></td><td><?php echo __('Action'); ?></td>
</tr>

<?php $i =1 ; foreach($vhsncAfcs as $vhsncAfc) {?>  
<tr>
    <td><?=$i?></td>
    <td><?php echo h($vhsncAfc['VhsncMeeting']['id']); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['IssueCategory']['name'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($vhsncAfc['IssueSubcategory']['name'])); ?>
&nbsp;
</td>
<td>
<?php echo h($vhsncAfc['VhsncMeeting']['issue_details']); ?>
&nbsp;
</td>
<td>
<?php echo h($vhsncAfc['VhsncMeeting']['decisions_taken']); ?>
&nbsp;
</td>
<td>
<?php echo h($vhsncAfc['VhsncMeeting']['issue_resolved']); ?>
&nbsp;
</td>
<td class="actions">
    
    
    <?php 
if($sessionval=='regular') {
?>
 <?php
if(in_array($this->request->params['controller'].":edit",$menu) && $vhsncAfc['VhsncMeeting']['updated']==0){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsncAfc['VhsncMeeting']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
   <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $vhsncAfc['VhsncMeeting']['id']),array('class'=>'btn btn-dnager'));?>

<?php } ?>

<?php } else {?>
 <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsncAfc['VhsncMeeting']['id']),array('class' => 'btn btn-primary')); ?>
 <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $vhsncAfc['VhsncMeeting']['id']),array('class'=>'btn btn-danger'));?>

<?php } ?>
</td>
</tr>
<?php $i++ ;} ?>

<!--<tr>
<td><?php echo __('Decisions Taken'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['decisions_taken'])); ?>
&nbsp;
</td>
</tr><tr>
<td><?php echo __('Details of Decisions Taken '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['decision_details'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Issues Resolved'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['issue_resolved'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Issues Resolved date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsncAfc['VhsncMeeting']['issue_resolved_date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Details of issues Resolved'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['issue_remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Letter Issued to BPMC'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['letter_issued_bpmc'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncMeeting']['status'])); ?>
&nbsp;
</td>
</tr>-->
</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
