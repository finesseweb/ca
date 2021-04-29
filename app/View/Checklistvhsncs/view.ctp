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
<td><?php echo __('VHSNC Name'); ?></td>
<td>
<?php 

echo h(ucfirst($vhsncAfc['Checklistvhsnc']['vhsnc_name'])); 

?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Date'); ?></td>
<td>
<?php echo h(   date('d-m-Y',strtotime($vhsncAfc['Checklistvhsnc']['meeting_date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Name of Monitor'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Checklistvhsnc']['name_of_monitor'])); ?>
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
<?php echo h(ucfirst($vhsncAfc['Checklistvhsnc']['remarks'])); ?>
&nbsp;
</td>
</tr><tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['Checklistvhsnc']['status'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
