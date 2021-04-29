<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?><?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($untiedfund['Untiedfund']['id']); ?>
&nbsp;
</td>
</tr>-->

<!--<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['City']['name'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Block']['name'])); ?>
&nbsp;
</td>
</tr>-->
<!--
<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>-->

<!--<tr>
<td><?php echo __('Village'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Village']['name'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Ward'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Ward']['name'])); ?>
&nbsp;
</td>
</tr>-->

<!--<tr>
<td><?php echo __('Total Expenditure '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfund']['total_expenditure'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Balance check Date '); ?></td>
<td>
<?php echo date('d-m-Y',strtotime($untiedfund['VhsncUntiedfund']['balance_check_date'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Balance on Date '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfund']['balance_on_date'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Current Total Amount '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfund']['current_total_amount'])); ?>
&nbsp;
</td>
</tr>-->
<tr>
    <td><?php echo __('Expenditure Date '); ?></td><td><?php echo __('Expenditure Amount '); ?></td><td><?php echo __('Expenditure Details '); ?></td><td>Actions</td>

</tr>  
<?php foreach($untiedfunds as $untiedfund){?>
<tr>
    <td>
<?php echo date('d-m-Y',strtotime($untiedfund['VhsncUntiedfund']['expenditure_date'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfund']['expenditure_amount'])); ?>
&nbsp;
</td>

<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfund']['expenditure_details'])); ?>
&nbsp;
</td>
<td>
    <?php 
if($sessionval=='regular') {
?>
<?php
if(in_array($this->request->params['controller'].":edit",$menu)){
  
?>
 <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $untiedfund['VhsncUntiedfund']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
  <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $untiedfund['VhsncUntiedfund']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $untiedfund['VhsncUntiedfund']['id'])); ?>

<?php } ?>
<?php } else {?>
    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $untiedfund['VhsncUntiedfund']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $untiedfund['VhsncUntiedfund']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $untiedfund['VhsncUntiedfund']['id'])); ?>
<?php } ?>
</td>
</tr><?php } ?>
<!--<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfund']['status'])); ?>
&nbsp;
</td>
</tr>-->
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
