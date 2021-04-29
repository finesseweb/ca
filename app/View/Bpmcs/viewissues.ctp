<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($anm['VhsncAfc']['id']); ?>
&nbsp;
</td>
</tr>-->

<!--<tr>
<td><?php echo __('Block Name '); ?></td>
<td>
<?php echo h(ucfirst($anm['Block']['name'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Meeting Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($anm['Bpmc']['meeting_date']))); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('BPMC Registered Member participated'); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['register_member'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Other Participated'); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['other_participated'])); ?>
&nbsp;
</td>
</tr>-->


<tr>
    <td>Sr No</td><td><?php echo __('Registered Member Participated'); ?><td><?php echo __('Meeting chaired by'); ?></td><td><?php echo __('Issue Details'); ?></td><td><?php echo __('Decision Taken'); ?></td><td><?php echo __('Issue Resolved'); ?></td><td class="actions"><?php echo __('Actions'); ?></td></td>
</tr>
<?php $i = 1 ; foreach($anms as $anm) {?>
<tr>
    <td><?=$i?></td>
<td>
    
    <?php
$mem = explode(',',$anm['Bpmc']['register_member_type']);
//print_r($mem);
foreach($mem as $m) {
  $questionlist=$this->requestAction(array("controller"=>"registerMembers","action"=>"gettitle",$m)); 
                 
                  echo ucwords($questionlist['RegisterMember']['name'].',');
}

 ?>
<?php echo h(ucfirst($anm['RegisterMember']['name'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($anm['MeetingFacilitated']['name'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['details_of_issues'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['decisions_taken'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['issue_resolved'])); ?>
&nbsp;
</td>

    <td class="actions">
<?php 
if($sessionval=='regular') {
?>
 <?php
if(in_array($this->request->params['controller'].":edit",$menu)){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $anm['Bpmc']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
   <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $anm['Bpmc']['id']),array('class'=>'btn btn-dnager'));?>

<?php } ?>

<?php } else {?>
 <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $anm['Bpmc']['id']),array('class' => 'btn btn-primary')); ?>
 <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $anm['Bpmc']['id']),array('class'=>'btn btn-danger'));?>

<?php  $i++ ;} ?>
</td>
   
</tr>
<?php }?>
<!--<tr>
<td><?php echo __('testimonial_shared'); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['testimonial_shared'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('issue Shared  By BPMC'); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['issue_shared_bpmc'])); ?>
&nbsp;
</td>
</tr>-->

<!--<tr>
<td><?php echo __('Issue Category'); ?></td>
<td>
<?php echo h(ucfirst($anm['IssueCategory']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Issues Level'); ?></td>
<td>
<?php echo h(ucfirst($anm['IssueSubcategory']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Decision Taken'); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['decisions_taken'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Details of Decision'); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['decision_details'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Issue Resolved'); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['issue_resolved'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Resolved Date'); ?></td>
<td>
<?php if($anm['Bpmc']['resolved_date']!='1970-01-01' && $anm['Bpmc']['resolved_date']!='0000-00-00' && $anm['Bpmc']['resolved_date']!='')
{
    echo h(date('d-m-Y',strtotime($anm['Bpmc']['resolved_date']))); 
    
} ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Details of Issues resolved'); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['details_of_issues_resolved'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Letter to Higher Authority '); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['letter_to_higher_authority'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['remarks'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($anm['Bpmc']['status'])); ?>
&nbsp;
</td>
</tr>-->
</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
