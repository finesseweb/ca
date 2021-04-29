<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($financial['Finance']['id']); ?>
&nbsp;
</td>
</tr>-->
<tr><td><?php echo __('Name of NGO'); ?></td>
<td>
<?php echo h(ucfirst($financial['Ngo']['name_of_ngo'])); ?>
&nbsp;
</td>
</tr>
<tr>


<tr>
<td><?php echo __('Particulars/Activity'); ?></td>
<td>
<?php echo h(ucfirst($financial['Subcategory']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Grant Period'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($financial['Period']['from_date'])).' To '.date('d-m-Y',strtotime($financial['Period']['to_date']))); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Reporting Period'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($financial['ReportingPeriod']['from_date'])).' To '.date('d-m-Y',strtotime($financial['ReportingPeriod']['to_date']))); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Unit Cost '); ?></td>
<td>
<?php echo h($financial['Finance']['unit_cost']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('No of Unit'); ?></td>
<td>
<?php echo h($financial['Finance']['no_of_unit']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Frequency'); ?></td>
<td>
<?php echo h($financial['Finance']['frequecy']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Amount (INR)'); ?></td>
<td>
<?php echo h($financial['Finance']['amount']); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Previous Expenditure'); ?></td>
<td>
<?php echo h($financial['Finance']['previous_expenditure']); ?>
&nbsp;
</td>
</tr>
<tr>
    
    
<tr>
<td><?php echo __('Current Expenditure'); ?></td>
<td>
<?php echo h($financial['Finance']['previous_expenditure']); ?>
&nbsp;
</td>
</tr>

 <tr>
<td><?php echo __('Cumulative Expenditure'); ?></td>
<td>
<?php echo h($financial['Finance']['previous_expenditure']); ?>
&nbsp;
</td>
</tr>
 <tr>
<td><?php echo __('Variance'); ?></td>
<td>
<?php echo h($financial['Finance']['previous_expenditure']); ?>
&nbsp;
</td>
</tr>

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

<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($financial['Finance']['status'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
