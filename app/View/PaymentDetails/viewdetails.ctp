<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php //echo __('Id'); ?></td>
<td>
<?php //echo h($financial['Finance']['id']); ?>
&nbsp;
</td>
</tr>-->
<!--<tr><td><?php //echo __('Name of NGO'); ?></td>
<td>
<?php //echo h(ucfirst($financial['Ngo']['name_of_ngo'])); ?>
&nbsp;
</td>
</tr>
<tr>-->


<tr>
    <td><?php echo __('Id'); ?><td><?php echo __('Description'); ?></td><td><?php echo __('Amount (INR)'); ?></td></td></tr>
<?php  foreach ($financials as $financial) {?>
<tr>

<td>
<?php echo h($financial['Finance']['id']); ?>
&nbsp;
</td>
<td>
<?php echo h($financial['Finance']['description_details']); ?>
&nbsp;
</td>
<td>
<?php echo h($financial['Finance']['amount']); ?>
&nbsp;
</td>

<!--<td class="actions">
<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $financial['Finance']['id']),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $financial['Finance']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $financial['Finance']['id'])); ?>
</td>-->
</tr>
<?php } ?>


<!--<tr>
<td><?php echo __('Previous Expenditure'); ?></td>
<td>
<?php echo h($financial['Finance']['previous_expenditure']); ?>
&nbsp;
</td>
</tr>
<tr>-->
    
    
<!--<tr>
<td><?php echo __('Current Expenditure'); ?></td>
<td>
<?php echo h($financial['Finance']['previous_expenditure']); ?>
&nbsp;
</td>
</tr>-->

<!-- <tr>
<td><?php echo __('Cumulative Expenditure'); ?></td>
<td>
<?php echo h($financial['Finance']['previous_expenditure']); ?>
&nbsp;
</td>
</tr>-->
<!-- <tr>
<td><?php echo __('Variance'); ?></td>
<td>
<?php echo h($financial['Finance']['previous_expenditure']); ?>
&nbsp;
</td>
</tr>-->
<!--
<tr>
<td><?php echo __('Variance Percantage'); ?></td>
<td>
<?php echo h($financial['Finance']['previous_expenditure']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Opening Balance as on'); ?></td>
<td>
<?php echo h($financial['Finance']['opening_balance']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Grant Releases by PFI'); ?></td>
<td>
<?php echo h($financial['Finance']['grant_received_from_pfi']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Closing fund Balance'); ?></td>
<td>
<?php echo h($financial['Finance']['closing_fund_balance']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($financial['Finance']['status'])); ?>
&nbsp;
</td>
</tr>-->
</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
