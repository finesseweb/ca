<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncAfc']['id']); ?>
&nbsp;
</td>
</tr>-->

<tr>
<td><?php echo __('District Name '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['City']['name'])); ?>
&nbsp;
</td>
</tr>
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
</tr>
<tr>
<td><?php echo __('Month'); ?></td>
<td>
<?php echo h(   date('M-Y',strtotime($vhsncAfc['Monthlyreport']['month']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Level'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Level']['name'])); ?>
&nbsp;
</td>
</tr>   






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
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Monthlyreport']['remarks'])); ?>
&nbsp;
</td>
</tr><tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Monthlyreport']['status'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
