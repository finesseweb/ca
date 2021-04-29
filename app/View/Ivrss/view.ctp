<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($Ivrs['Ivrs']['id']); ?>
&nbsp;
</td>
</tr>-->

<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['City']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Block']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Village']['name'])? $Ivrs['Village']['name']: 'All Village'); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Ward '); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ward']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($Ivrs['Ivrs']['date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('IVRS User Name'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['ivrs_user_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Age'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['age'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Gender'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['gender'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('IVRS User mobile'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['ivrs_user_mobile'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('IVRS User type'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['ivrs_user_type'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Registration Status'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['registration_status'])); ?>
&nbsp;
</td>
</tr>
<tr>
<tr>
<td><?php echo __('Registration Reason'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['registration_reason'])); ?>
&nbsp;
</td>
</tr>
<tr>
<tr>
<td><?php echo __('Survey Participated'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['survey_participated'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Voice Feedback Recorded'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['voice_feedback_recorded'])); ?>
&nbsp;
</td>
</tr>
 <tr>
<td><?php echo __('Voice Reason'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['voice_reason'])); ?>
&nbsp;
</td>
</tr>
 <tr>
<td><?php echo __('Information pack listen'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['information_pack_listen'])); ?>
&nbsp;
</td>
</tr>
 <tr>
<td><?php echo __('Info pack Reason'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['info_pack_reason'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($Ivrs['Ivrs']['status'])); ?>
&nbsp;
</td>
</tr>

<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
