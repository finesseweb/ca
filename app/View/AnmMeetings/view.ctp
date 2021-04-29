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

<tr>
<td><?php echo __('Block Name '); ?></td>
<td>
<?php echo h(ucfirst($anm['Block']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Meeting Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($anm['AnmMeeting']['meeting_date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Meeting chaired by'); ?></td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['meeting_chaired_by'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Key Issues Discussed'); ?></td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['key_issues_discussed'])); ?>
&nbsp;
</td>
</tr>



<tr>
<td><?php echo __('Issues Raised by'); ?></td>
<td>
<?php echo h(ucfirst($anm['AnmMeeting']['issues_raised_by_bpc'])); ?>
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
<td><?php echo __('Issue  Lavel'); ?></td>
<td>
<?php echo h(ucfirst($anm['IssueSubcategory']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
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
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
