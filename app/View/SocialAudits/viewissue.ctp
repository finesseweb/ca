<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?><?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
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
</tr>-->


<!--<tr>
<td><?php echo __('Meeting Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($anm['SocialAudit']['meeting_date']))); ?>
&nbsp;
</td>
</tr>-->

<tr>
    <td>Sr No</td><td><?php echo __('Participated'); ?><td><?php echo __('Panellist'); ?></td><td><?php echo __('Issues shared in Jan Samwaad'); ?></td><td><?php echo __('Decisions taken'); ?></td><td><?php echo __('Issue Resolved'); ?></td><td class="actions">Actions</td>
</tr>

<?php $i = 1; 
foreach ($anms as $anm){

?>
<tr>
    <td><?=$i?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['participants'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['panellist'])); ?>
&nbsp;
</td>

<td>
<?php echo h(ucfirst($anm['SocialAudit']['details_of_issues'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['decisions_taken'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['issue_resolved'])); ?>
&nbsp;
</td>

<td><?php 
if($sessionval=='regular') {
?>
 <?php
if(in_array($this->request->params['controller'].":edit",$menu)){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $anm['SocialAudit']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
   <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $anm['SocialAudit']['id']),array('class'=>'btn btn-dnager'));?>

<?php } ?>

<?php } else {?>
 <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $anm['SocialAudit']['id']),array('class' => 'btn btn-primary')); ?>
 <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $anm['SocialAudit']['id']),array('class'=>'btn btn-danger'));?>

<?php $i++ ;} ?>
    
</td>
</tr>


<?php } ?>


<!--
<tr>
<td><?php echo __('Case study shared'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['case_study_shared'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Testimonials shared'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['testimonial_shared'])); ?>
&nbsp;
</td>
</tr>
<tr>

</tr>

<tr>
<td><?php echo __('Issues shared by PRI member'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['issue_shared_pri'])); ?>
&nbsp;
</td>
</tr>


<tr>
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
<td><?php echo __('Details of issues'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['details_of_issues'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Decisions taken'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['decisions_taken'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Decisions Details'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['decisions_details'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Issue resolved'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['issue_resolved'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Issue resolved Date'); ?></td>
<td>
<?php if($anm['SocialAudit']['issue_resolved_date']!='1970-01-01' && $anm['SocialAudit']['issue_resolved_date']!='0000-00-00' && $anm['SocialAudit']['issue_resolved_date']!=''){
echo h(date('d-m-Y',strtotime($anm['SocialAudit']['issue_resolved_date']))); } ?>
    
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Resolved Issue Details'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['details_of_issues_resolved'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Letter issued to govt./higher authority'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['letter_to_higher_authority'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Action Taken Report Status'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['action_taken'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['remarks'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($anm['SocialAudit']['status'])); ?>
&nbsp;
</td>
</tr>-->
</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
