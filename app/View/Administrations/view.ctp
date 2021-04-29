<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($administration['Administration']['id']); ?>
&nbsp;
</td>
</tr>-->
<tr><td><?php echo __('Name of NGO'); ?></td>
<td>
<?php echo h(ucfirst($administration['Ngo']['name_of_ngo'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('First Name'); ?></td>
<td>
<?php echo h(ucfirst($administration['User']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('last Name'); ?></td>
<td>
<?php echo h(ucfirst($administration['User']['last_name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Mobile No'); ?></td>
<td>
<?php echo h(ucfirst($administration['Administration']['mobile'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Email Id '); ?></td>
<td>
<?php echo h($administration['Administration']['emailid']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Designation '); ?></td>
<td>
<?php echo h(ucfirst($administration['Designation']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Gender'); ?></td>
<td>
<?php echo h(ucfirst($administration['Administration']['gender'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Permanent Address'); ?></td>
<td>
<?php echo h($administration['Administration']['permanent_address']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Correspondance Address'); ?></td>
<td>
<?php echo h($administration['Administration']['correspondence_address']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h($administration['Administration']['remarks']); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h($administration['Administration']['status']); ?>
&nbsp;
</td>
</tr>


<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
