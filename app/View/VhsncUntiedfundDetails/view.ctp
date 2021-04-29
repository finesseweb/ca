<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($untiedfund['Untiedfund']['id']); ?>
&nbsp;
</td>
</tr>-->

<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Block']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Village']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Ward'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Ward']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Vhsnc name'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncConstitution']['vhsnc_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Bank Account Number '); ?></td>
<td>
<?php echo h($untiedfund['VhsncUntiedfundDetail']['bank_account_number']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('VHNSC Funds Recieved '); ?></td>
<td>
<?php echo h($untiedfund['VhsncUntiedfundDetail']['vhsnc_funds_recieved']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Amount Recieved From'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfundDetail']['amount_received_from'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Payment Mode'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfundDetail']['payment_mode'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Payment Recieved Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($untiedfund['VhsncUntiedfundDetail']['payment_received_date']))); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Amount Recieved From Other Source'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfundDetail']['amount_recieved_from_other_source'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Bank interest credit '); ?></td>
<td>
<?php echo h($untiedfund['VhsncUntiedfundDetail']['bank_interest_credit']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Bank charge deduct'); ?></td>
<td>
<?php echo h($untiedfund['VhsncUntiedfundDetail']['bank_charge_deduct']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Financial year '); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($untiedfund['ReportingPeriod']['from_date']))); ?> To <?php echo h(date('d-m-Y',strtotime($untiedfund['ReportingPeriod']['to_date']))); ?>
&nbsp;
</td>
</tr>
<!--<tr>
<td><?php echo __('Total Expenditure '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfundDetail']['total_expenditure'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Balance check Date '); ?></td>
<td>
<?php echo date('d-m-Y',strtotime($untiedfund['VhsncUntiedfundDetail']['balance_check_date'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Balance on Date '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfundDetail']['balance_on_date'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Current Total Amount '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfundDetail']['current_total_amount'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Expenditure Date '); ?></td>
<td>
<?php echo date('d-m-Y',strtotime($untiedfund['VhsncUntiedfundDetail']['expenditure_date'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Expenditure Details '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfundDetail']['expenditure_details'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Expenditure Amount '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfundDetail']['expenditure_amount'])); ?>
&nbsp;
</td>
</tr>-->
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['VhsncUntiedfundDetail']['status'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
