<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?><?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncAfc']['id']); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('District Name '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Block']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Panchayat Name '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
 <?php if($vhsncAfc['Issue']['village']!='0' && $vhsncAfc['Issue']['village']!='' ) 
{ echo h(ucfirst($vhsncAfc['Village']['name'])); } else { echo "All Village"; }?>
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
<?php echo h(date('d-m-Y',strtotime($vhsncAfc['Issue']['meeting_date']))); ?>
&nbsp;
</td>
</tr>-->

<tr>
    <td>Sr No</td><td><?php echo __('New Issues identified'); ?></td><td><?php echo __('Issue category '); ?></td><td><?php echo __('Issue Level'); ?></td><td><?php echo __('Decision  Taken'); ?></td> <td><?php echo __('Issue  Resolved'); ?></td><td><?php echo __('Action'); ?></td>
</tr>
<?php $i=1 ;
foreach($vhsncAfcs as $vhsncAfc) {
   
    ?>
<tr>
    <td><?=$i?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Issue']['new_issues_identified'])); ?>
&nbsp;
</td>
<td>
<?php echo h($vhsncAfc['IssueCategory']['name']); ?>
&nbsp;
</td>

<td>
<?php echo h(ucfirst($vhsncAfc['IssueSubcategory']['name'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($vhsncAfc['Issue']['decision_taken'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($vhsncAfc['Issue']['issue_resolved'])); ?>
&nbsp;
</td>
<td><?php 
if($sessionval=='regular') {
?>
 <?php
if(in_array($this->request->params['controller'].":edit",$menu)){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsncAfc['Issue']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
   <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $vhsncAfc['Issue']['id']),array('class'=>'btn btn-dnager'));?>

<?php } ?>

<?php } else {?>
 <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsncAfc['Issue']['id']),array('class' => 'btn btn-primary')); ?>
 <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $vhsncAfc['Issue']['id']),array('class'=>'btn btn-danger'));?>

<?php } ?></td>
</tr>
<?php  $i++; }?>


<!--<tr>
<td><?php echo __('Described Resolved Issue Level'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Issue']['described_resolved_issue'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Issues Resolved date'); ?></td>
<td>
<?php 
if($vhsncAfc['Issue']['issue_resolved_date']!='1970-01-01' && $vhsncAfc['Issue']['issue_resolved_date']!='0000-00-00' && $vhsncAfc['Issue']['issue_resolved_date']!='') {
echo h(date('d-m-Y',strtotime($vhsncAfc['Issue']['issue_resolved_date'])));

}
?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Issue']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Issue']['status'])); ?>
&nbsp;
</td>
</tr>-->
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
