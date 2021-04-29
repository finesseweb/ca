<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($financial['FinancialDetail']['id']); ?>
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
<td><?php echo __('Category'); ?></td>
<td>
<?php echo h(ucfirst($financial['Financial']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Sub Category'); ?></td>
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

<!--<tr>
<td><?php echo __('Reporting Period'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($financial['ReportingPeriod']['from_date'])).' To '.date('d-m-Y',strtotime($financial['ReportingPeriod']['to_date']))); ?>
&nbsp;
</td>
</tr>-->

<tr>
<td><?php echo __('Unit Cost '); ?></td>
<td>
<?php echo h($financial['FinancialDetail']['unit_cost']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('No of Unit'); ?></td>
<td>
<?php echo h($financial['FinancialDetail']['no_of_unit']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Frequency'); ?></td>
<td>
<?php echo h($financial['FinancialDetail']['frequency']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Amount (INR)'); ?></td>
<td>
<?php echo h($financial['FinancialDetail']['amount']); ?>
&nbsp;
</td>
</tr>


<!--<tr>
<td><?php echo __('Grant Releases by PFI'); ?></td>
<td>
<?php echo h($financial['FinancialDetail']['grant_release']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Previous Expenditure'); ?></td>
<td>
<?php echo h($financial['FinancialDetail']['previous_expenditure']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Opening Balance as on'); ?></td>
<td>
<?php echo h($financial['FinancialDetail']['opening_balance']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Closing fund Balance'); ?></td>
<td>
<?php echo h($financial['FinancialDetail']['closing_fund_balance']); ?>
&nbsp;
</td>
</tr>-->

<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h($financial['FinancialDetail']['remarks']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($financial['FinancialDetail']['status'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
