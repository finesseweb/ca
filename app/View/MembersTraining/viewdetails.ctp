<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($vhsnc['MembersTraining']['id']); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php ////echo __('District Name'); ?></td>
<td>
<?php //echo h(ucfirst($vhsnc['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php //echo __('Block Name'); ?></td>
<td>
<?php //echo h(ucfirst($vhsnc['Block']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php //echo __('Panchayat Name'); ?></td>
<td>
<?php //echo h(ucfirst($vhsnc['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php //echo __('Village Name'); ?></td>
<td>
<?php //echo h(ucfirst($vhsnc['Village']['name'])); ?>
&nbsp;
</td>
</tr>-->

<tr>
    <td><?php echo __('Sr No'); ?></td><td><?php echo __('Members type'); ?></td><td><?php echo __('Member Name'); ?></td><td><?php echo __('Member Mobile'); ?></td><td><?php echo __('Active'); ?></td></tr>
<?php 
$i=1;
foreach($vhsncs as $vhsnc) { ?>
<tr>
    <td><?=$i?></td>

<td>
<?php echo h(ucfirst($vhsnc['MembersTraining']['members_type'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($vhsnc['MembersTraining']['member_name'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($vhsnc['MembersTraining']['member_mobile'])); ?>
&nbsp;
</td>
<td>
     <?php 
if($sessionval=='regular') {
?>
<?php
if(in_array($this->request->params['controller'].":edit",$menu)){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsnc['MembersTraining']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
  <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vhsnc['MembersTraining']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $vhsnc['MembersTraining']['id'])); ?>

<?php } ?>
<?php } else { ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsnc['MembersTraining']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo ' '.$this->Form->postLink(__('Delete'), array('action' => 'delete', $vhsnc['MembersTraining']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $vhsnc['MembersTraining']['id'])); ?>
<?php } ?>
</td>
</tr>
<?php $i++ ;} ?>


<!--<tr>
<td><?php echo __('Induction Training Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsnc['MembersTraining']['induction_training_date']))); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Refresher Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsnc['MembersTraining']['refresher_date']))); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Remarks '); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['MembersTraining']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['MembersTraining']['status'])); ?>
&nbsp;
</td>
</tr>-->


</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
