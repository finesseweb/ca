<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?>
<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 



<!--<tr>
<td><?php echo __('District Name '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['City']['name'])); ?>
&nbsp;
</td>-->
<!--</tr>
<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php 

echo h(ucfirst($vhsncAfc['Block']['name'])); 

?>
&nbsp;
</td>


</tr>
    <tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php 

echo h(ucfirst($vhsncAfc['Panchayat']['name'])); 

?>
&nbsp;
</td>
</tr>-->
<tr><td><?php echo __('Id'); ?></td><td><?php echo __('Date'); ?></td><td><?php echo __('Activity'); ?></td><td><?php echo __('Details of Work'); ?></td><td><?php echo __('Action'); ?></td>
</tr>
<?php foreach ($vhsncAfcs as $vhsncAfc) {?>
<tr>
    <td>
<?php echo h($vhsncAfc['Commonreport']['id']); ?>
&nbsp;
</td>

<td>
<?php echo h(date('d-m-Y',strtotime($vhsncAfc['Commonreport']['date']))); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($vhsncAfc['Commonreport']['activity'])); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($vhsncAfc['Commonreport']['remarks'])); ?>
&nbsp;
</td>
<td><?php 
if($sessionval=='regular') {
?>
<?php
if(in_array($this->request->params['controller'].":edit",$menu)){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsncAfc['Checklist']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
  <?php echo ' '.$this->Form->postLink(__('Delete'), array('action' => 'delete', $vhsncAfc['Checklist']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $vhsncAfc['Checklist']['id'])); ?>

<?php } ?>
<?php }  else {?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsncAfc['Commonreport']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo ' '.$this->Form->postLink(__('Delete'), array('action' => 'delete', $vhsncAfc['Commonreport']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $vhsncAfc['Commonreport']['id'])); ?>

<?php } ?></td>
</tr>   
<?php } ?>





<!--<tr>
<td><?php echo __('Feedback Title'); ?></td>
<td>
<?php 
                  $questionlist=$this->requestAction(array("controller"=>"subfeedbacks","action"=>"gettitle",$vhsncAfc['FacilityAssessment']['feed_title'])); 
                  $title=$this->requestAction(array("controller"=>"feedbacks","action"=>"gettitle",$questionlist['Subfeedback']['cat_id'])); 
                  
                  
                  echo ucwords($title['Feedback']['name']); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
    <td><?php echo __('Question'); ?></td>
<td class="question">
<?php 
 $questionlist=$this->requestAction(array("controller"=>"subfeedbacks","action"=>"gettitle",$vhsncAfc['FacilityAssessment']['question'])); 
                 echo $questionlist['Subfeedback']['name'];

//echo h(ucfirst($vhsncAfc['FacilityAssessment']['question'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Response'); ?></td>
<td class="question">
<?php echo h(($vhsncAfc['FacilityAssessment']['response'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Feedback Remarks '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['FacilityAssessment']['feedback_remarks'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Commonreport']['remarks'])); ?>
&nbsp;
</td>
</tr><tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Commonreport']['status'])); ?>
&nbsp;
</td>
</tr>-->
</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
