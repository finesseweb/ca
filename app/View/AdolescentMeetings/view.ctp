<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($adolescentmeeting['AdolescentMeeting']['id']); ?>
&nbsp;
</td>
</tr>-->

<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['City']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['Block']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['Village']['name']) ? $adolescentmeeting['Village']['name']: 'All Village'); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Ward '); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['Ward']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($adolescentmeeting['AdolescentMeeting']['date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Group  Name'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['Youthleader']['group_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Total  Member'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['AdolescentMeeting']['total_member'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('No of Participants'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['AdolescentMeeting']['no_of_participants'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Meeting Facilitated By'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['MeetingFacilitated']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Topic Discussed'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['Discussion']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Other Topic Discussed'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['AdolescentMeeting']['others_topic'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Material Used'); ?></td>
<td>
<?php echo h($adolescentmeeting['UseMaterial']['name']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h($adolescentmeeting['AdolescentMeeting']['remarks']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($adolescentmeeting['AdolescentMeeting']['status'])); ?>
&nbsp;
</td>
</tr>

<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
