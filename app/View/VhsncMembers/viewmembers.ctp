<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?>
<table class="table table-striped"> 

    <tr><td><?php echo __('Sr.No'); ?><td><?php echo __('Id'); ?></td><td><?php echo __('Name'); ?></td><td><?php echo __('Mobile'); ?></td><td><?php echo __('Designation'); ?></td><td><?php echo __('Action'); ?></td></tr>
    
        <?php 
        $i=1;
        foreach($vhsncs as $vhsnc) {?>
    <tr>
 <td>
<?php echo $i;?>
&nbsp;
</td>
<td>
<?php echo h($vhsnc['VhsncMember']['id']); ?>
&nbsp;
</td>
<td>
<?php echo h($vhsnc['VhsncMember']['member_name']); ?>
&nbsp;
</td>
<td>
<?php echo h($vhsnc['VhsncMember']['member_mobile']); ?>
&nbsp;
</td>
<td>
<?php echo h($vhsnc['VhsncMember']['designation']); ?>
&nbsp;
</td>
<td>
    
 <?php 
if($sessionval=='regular') {
?>
    
<?php
if(in_array($this->request->params['controller'].":edit",$menu)){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsnc['VhsncMember']['id']),array('class' => 'btn btn-primary')); ?>
<?php  } ?>
    
   <?php
  
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
  <?php echo '  '.$this->Form->postLink(__('Delete'), array('action' => 'delete', $vhsnc['VhsncMember']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $vhsnc['VhsncMember']['id'])); ?>

<?php } ?>
<?php } else { ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsnc['VhsncMember']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo '  '.$this->Form->postLink(__('Delete'), array('action' => 'delete', $vhsnc['VhsncMember']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $vhsnc['VhsncMember']['id'])); ?>
<?php } ?>
</td>
</tr>
        <?php 
          $i++;
}
      
        ?>

<!--<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['Block']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
<?php
if($vhsnc['Village']['name']=='0') {
    echo "All Village";
} else {
echo h(ucfirst($vhsnc['Village']['name'])); 
}
?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Ward '); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['Ward']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('VHSC Name'); ?></td>
<td>
<?php echo h($vhsnc['VhsncConstitution']['vhsnc_name']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Member Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncMember']['member_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Member Mobile'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncMember']['member_mobile'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Member Designation'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncMember']['designation'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Member VHSNC Designation'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['Designation']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Members type'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncMember']['members_type'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Induction Training Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsnc['VhsncMember']['induction_training_date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Refresher Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsnc['VhsncMember']['refresher_date']))); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncMember']['status'])); ?>
&nbsp;
</td>
</tr>-->


</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
