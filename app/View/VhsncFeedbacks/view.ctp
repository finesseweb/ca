<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncAfc']['id']); ?>
&nbsp;
</td>
</tr>-->

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
<?php 
if($vhsncAfc['Village']['name']=='0' || $vhsncAfc['Village']['name']=='') {
    echo "All Village";
}
else {
echo h(ucfirst($vhsncAfc['Village']['name'])); 
}
?>
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
<?php echo h(   date('d-m-Y',strtotime($vhsncAfc['VhsncFeedback']['meeting_date']))); ?>
&nbsp;
</td>
</tr>
<!--
<tr>
<td><?php echo __('VHSNC Quorum Completed'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncFeedback']['vhsnc_quorum_ompleted'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Types of Reg. Member Participated'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['RegisterMember']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Meeting Facilitated by'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['MeetingFacilitated']['name'])); ?>
&nbsp;
</td>
</tr>-->


<tr>
<td><?php echo __('Name '); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncFeedback']['name']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Mobile'); ?></td>
<td>
<?php echo h($vhsncAfc['VhsncFeedback']['mobile']); ?>
&nbsp;
</td>
</tr>


<!--<tr>
<td><?php echo __('Feedback Title'); ?></td>
<td>
<?php 
                  $questionlist=$this->requestAction(array("controller"=>"subfeedbacks","action"=>"gettitle",$vhsncAfc['VhsncFeedback']['feed_title'])); 
                  $title=$this->requestAction(array("controller"=>"feedbacks","action"=>"gettitle",$questionlist['Subfeedback']['cat_id'])); 
                  
                  
                  echo ucwords($title['Feedback']['name']); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
    <td><?php echo __('Question'); ?></td>
<td class="question">
<?php 
 $questionlist=$this->requestAction(array("controller"=>"subfeedbacks","action"=>"gettitle",$vhsncAfc['VhsncFeedback']['question'])); 
                 echo $questionlist['Subfeedback']['name'];

//echo h(ucfirst($vhsncAfc['VhsncFeedback']['question'])); ?>
&nbsp;
</td>
</tr>-->
<!--<tr>
<td><?php echo __('Response'); ?></td>
<td class="question">
<?php echo h(($vhsncAfc['VhsncFeedback']['response'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Feedback Remarks '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncFeedback']['feedback_remarks'])); ?>
&nbsp;
</td>
</tr>-->
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncFeedback']['remarks'])); ?>
&nbsp;
</td>
</tr><tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($vhsncAfc['VhsncFeedback']['status'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
