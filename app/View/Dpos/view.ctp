<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($administration['Administration']['id']); ?>
&nbsp;
</td>
</tr>-->
<!--<tr><td><?php echo __('Name Of Ngo'); ?></td>
<td>
<?php echo h(ucfirst($administration['Ngo']['name_of_ngo'])); ?>
&nbsp;
</td>
</tr>-->
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
<?php echo h($administration['Dpo']['mobile']); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Email Id '); ?></td>
<td>
<?php echo h($administration['Dpo']['email_id']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Designation '); ?></td>
<td>
<?php echo h(ucfirst($administration['Dpo']['designation'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Gender'); ?></td>
<td>
<?php echo h(ucfirst($administration['Dpo']['gender'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('District'); ?></td>
<td>
<?php echo h(ucfirst($administration['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Address'); ?></td>
<td>
<?php echo h($administration['Dpo']['address']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h($administration['Dpo']['remarks']); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($administration['Dpo']['status'])); ?>
&nbsp;
</td>
</tr>


<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
