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
<?php echo h(date('d-m-Y',strtotime($anm['AnmMeeting']['meeting_date']))); ?>
&nbsp;
</td>
</tr>-->
<tr>
    <td><?php echo __('Meeting chaired by'); ?></td><td><?php echo __('Issues Discussed'); ?></td><td><?php echo __('Issue Category'); ?></td><td><?php echo __('Issue Resolved'); ?></td><td><?php echo __('Decission Taken'); ?></td><td class="actions">Actions</td>
</tr>
<?php foreach ($anms as $anm) {?>
<tr>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['meeting_chaired_by'])); ?>
&nbsp;
</td>
<td><?php echo h(ucfirst($anm['AnmMeeting']['key_issues_discussed'])); ?></td>
<td><?php echo h(ucfirst($anm['IssueCategory']['name'])); ?></td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['issue_resolved'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['decisions_taken'])); ?>
&nbsp;
</td>
<td><?php 
if($sessionval=='regular') {
?>
 <?php
if(in_array($this->request->params['controller'].":edit",$menu) && $anm['AnmMeeting']['updated']==0){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $anm['AnmMeeting']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
   <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $anm['AnmMeeting']['id']),array('class'=>'btn btn-dnager'));?>

<?php } ?>

<?php } else {?>
 <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $anm['AnmMeeting']['id']),array('class' => 'btn btn-primary')); ?>
 <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $anm['AnmMeeting']['id']),array('class'=>'btn btn-danger'));?>

     <?php } ?></td>
</tr>
<?php } ?>

<!--<tr>
<td><?php echo __('Issues Raised by'); ?></td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['issues_raised_by_bpc'])); ?>
&nbsp;
</td>
</tr>-->

<!--<tr>
<td><?php echo __('Issue  Lavel'); ?></td>
<td>
<?php echo h(ucfirst($anm['IssueSubcategory']['name'])); ?>
&nbsp;
</td>
</tr>-->

<!--<tr>
<td><?php echo __('Decission Details'); ?></td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['decision_details'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Issue Resolved'); ?></td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['issue_resolved'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Issue Resolved Date'); ?></td>
<td>
<?php if($anm['AnmMeeting']['resolved_date']!='1970-01-01' && $anm['AnmMeeting']['resolved_date']!='0000-00-00' && $anm['AnmMeeting']['resolved_date']!='' ){
    
    echo h(date('d-m-Y',strtotime($anm['AnmMeeting']['resolved_date'])));
    
}?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Details of Iissues Resolved'); ?></td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['details_of_issues_resolved'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['remarks'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['status'])); ?>
&nbsp;
</td>
</tr>-->
</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
