<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($anm['VhsncAfc']['id']); ?>
&nbsp;
</td>
</tr>-->

<tr>
<td><?php echo __('District Name '); ?></td>
<td>
<?php echo h(ucfirst($anm['City']['name'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Meeting Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($anm['Dpmc']['meeting_date']))); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('DPMC Registered Member participated'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['register_member'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Other participated'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['other_participated'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Registered member participated'); ?></td>
<td>
        <?php
$mem = explode(',',$anm['Dpmc']['register_member_type']);
//print_r($mem);
foreach($mem as $m) {
  $questionlist=$this->requestAction(array("controller"=>"registerMembers","action"=>"gettitle",$m)); 
                 
                  echo ucwords($questionlist['RegisterMember']['name'].' ');
}

 ?>

&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Meeting chaired by'); ?></td>
<td>
<?php echo h(ucfirst($anm['MeetingFacilitated']['name'])); ?>
&nbsp;
</td>
</tr>
<!--<tr>
<td><?php echo __('testimonial_shared'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['testimonial_shared'])); ?>
&nbsp;
</td>
</tr>-->
<tr>
<td><?php echo __('Issue Shared By DPMC'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['issue_shared_dpmc'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Issues Details'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['details_of_issues'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Decisions taken'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['decisions_taken'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Details of Decision'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['decision_details'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Issue Category'); ?></td>
<td>
<?php echo h(ucfirst($anm['IssueCategory']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Issues Level'); ?></td>
<td>
<?php echo h(ucfirst($anm['IssueSubcategory']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
 <tr>
<td><?php echo __('Issue Resolved'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['issue_resolved'])); ?>
&nbsp;
</td>
</tr>
 <tr>
<td><?php echo __('Issue Resolved Date'); ?></td>
<td>
<?php if($anm['Dpmc']['resolved_date']!='1970-01-01' && $anm['Dpmc']['resolved_date']!='0000-00-00' && $anm['Dpmc']['resolved_date']!='' ) {
echo h(date('d-m-Y',strtotime($anm['Dpmc']['resolved_date'])));  }

?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Details of Issues resolved'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['details_of_issues_resolved'])); ?>
&nbsp;
</td>
</tr>
<td><?php echo __('letter to Authority'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['letter_to_higher_authority'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['remarks'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($anm['Dpmc']['status'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
