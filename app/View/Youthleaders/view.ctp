<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($youthleader['Bpccc']['id']); ?>
&nbsp;
</td>
</tr>-->

<tr>
      <td><?php echo __('Sr.No '); ?></td>  <td><?php echo __('Id '); ?></td><td><?php echo __('Name '); ?></td><td><?php echo __('Mobile '); ?></td><td><?php echo __('Action '); ?></td>
</tr>
<?php 
$i=1;
foreach($youthleaders as $youthleader) {
    
   // print_r($youthleader);
//    /die();
?>
<tr>
 <td>
<?php echo $i; ?>
&nbsp;
</td>
<td>
<?php echo h($youthleader['Youthleader']['id']); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($youthleader['Youthleader']['first_name'].' '.$youthleader['Youthleader']['last_name'])); ?>
&nbsp;
</td>
<td><?php echo h($youthleader['Youthleader']['mobile']); ?></td>

<td>
    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $youthleader['Youthleader']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo ' '.$this->Form->postLink(__('Delete'), array('action' => 'delete', $youthleader['Youthleader']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $youthleader['Youthleader']['id'])); ?>

</td>
</tr>

<?php 

$i++;
}  ?>
<!--<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($youthleader['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($youthleader['Block']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php 
$mem = explode(',',$youthleader['Youthleader']['allocated_panchayat']);
//print_r($mem);
foreach($mem as $m) {
  $questionlist=$this->requestAction(array("controller"=>"panchayats","action"=>"gettitle",$m)); 
                 
                  echo ucwords($questionlist['Panchayat']['name'].' ');
}
?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
<?php echo h(ucfirst($youthleader['Village']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Group Name'); ?></td>
<td>
<?php echo h(ucfirst($youthleader['Youthleader']['group_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Designation'); ?></td>
<td>
<?php echo h(ucfirst($youthleader['Designation']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Gender'); ?></td>
<td>
<?php echo h(ucfirst($youthleader['Youthleader']['gender'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Mobile'); ?></td>
<td>
<?php echo h($youthleader['Youthleader']['mobile']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Age'); ?></td>
<td>
<?php echo h($youthleader['Youthleader']['age']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Education'); ?></td>
<td>
<?php echo h(ucfirst($youthleader['Youthleader']['qualification'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Email id'); ?></td>
<td>
<?php echo h($youthleader['Youthleader']['email']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Address'); ?></td>
<td>
<?php echo h(ucfirst($youthleader['Youthleader']['address'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Date of Joining'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($youthleader['Youthleader']['date_of_joining']))); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Remarks '); ?></td>
<td>
<?php echo h(ucfirst($youthleader['Youthleader']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($youthleader['Youthleader']['status'])); ?>
&nbsp;
</td>
</tr>-->

<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
