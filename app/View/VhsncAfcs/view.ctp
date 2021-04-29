<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?>
<table class="table table-striped"> 

    <tr><td><?php echo __('Sr.No'); ?></td><td><?php echo __('Id'); ?></td><td><?php echo __('Member Type '); ?></td><td><?php echo __('Member name'); ?></td><td><?php echo __('Mobile'); ?></td><td><?php echo __('Action'); ?></td>

</tr>
<?php 
$i=1;
foreach($vhsncAfcs as $vhsncAfc) {
    //print_r($vhsncAfc)
    
    ?>
<tr>
 <td>
<?php echo $i; ?>
&nbsp;
</td>
<td>
<?php echo h($vhsncAfc['VhsncAfc']['id']); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncAfc']['member_type'])); ?>
&nbsp;
</td>
<td>
<?php echo h($vhsncAfc['VhsncAfc']['member_name']); ?>
&nbsp;
</td>
<td>
<?php echo h($vhsncAfc['VhsncAfc']['mobile']); ?>
&nbsp;
</td>
<td class="actions">
<!--<a href="javascript:void(0)" class="more btn btn-success" data-toggle="modal" data-target="#myModal" data-id="<?=$vhsncafc['VhsncAfc']['id']?>">More</a>-->
<?php 
if($sessionval=='regular') {
?>
<?php
if(in_array($this->request->params['controller'].":edit",$menu)){
  
?>
  <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsncAfc['VhsncAfc']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
  <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vhsncAfc['VhsncAfc']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $vhsncAfc['VhsncAfc']['id'])); ?>
 
<?php } ?>
   <?php  } else {?> 
    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsncAfc['VhsncAfc']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vhsncAfc['VhsncAfc']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $vhsncAfc['VhsncAfc']['id'])); ?>
   <?php } ?>
</td>
</tr>
<?php 
$i++;
   } ?>
</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
