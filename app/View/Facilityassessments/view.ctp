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


<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php 

echo h(ucfirst($vhsncAfc['Panchayat']['name']) ? $vhsncAfc['Panchayat']['name']: 'All Panchayat'); 

?>
&nbsp;
</td>


<tr>
<td><?php echo __('Date of Invsetigation'); ?></td>
<td>
<?php echo h(   date('d-m-Y',strtotime($vhsncAfc['FacilityAssessment']['invsetigation_date']))); ?>
&nbsp;
</td>
</tr>
</tr>
<tr>
<td><?php echo __('Name of Investigator'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['FacilityAssessment']['investigator_name'])); ?>
&nbsp;
</td>
</tr>   

<tr>
<td><?php echo __('Name of Health Facility'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['FacilityDetail']['health_facility_name'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Type of Health Facility'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['FacilityDetail']['facility_type'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Level'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['FacilityAssessment']['facility_level'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Name of Responder One'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['FacilityAssessment']['name_of_responder_one'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Mobile Number'); ?></td>
<td>
<?php echo h($vhsncAfc['FacilityAssessment']['mobile_responder_one']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Name of Responder Two'); ?></td>
<td>
<?php echo h($vhsncAfc['FacilityAssessment']['name_of_responder_two']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Mobile Number'); ?></td>
<td>
<?php echo h($vhsncAfc['FacilityAssessment']['mobile_responder_two']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Start time of assessement'); ?></td>
<td>
<?php echo h($vhsncAfc['FacilityAssessment']['start_time_assessment']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('End time of assessement'); ?></td>
<td>
<?php echo h($vhsncAfc['FacilityAssessment']['end_time_assessment']); ?>
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
<?php echo h(ucfirst($vhsncAfc['FacilityAssessment']['remarks'])); ?>
&nbsp;
</td>
</tr><tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['FacilityAssessment']['status'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
