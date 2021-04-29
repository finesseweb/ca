<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($untiedfund['Untiedfund']['id']); ?>
&nbsp;
</td>
</tr>-->
<tr><td><?php echo __('Organization'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Ngo']['name_of_ngo'])); ?>
&nbsp;
</td>
</tr>
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
<td><?php echo __('CC Name'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Untiedfund']['cc_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Member\'s number'); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Untiedfund']['member_num'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Constitution date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($untiedfund['Untiedfund']['constitution_date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Bank Account '); ?></td>
<td>
<?php echo h($untiedfund['Untiedfund']['bank_account']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Bank name '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Untiedfund']['bank_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('IFSC '); ?></td>
<td>
<?php echo h($untiedfund['Untiedfund']['ifsc']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Untied funds received'); ?></td>
<td>
<?php echo h($untiedfund['Untiedfund']['untied_funds_received']); ?>
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
<tr>
<td><?php echo __('status '); ?></td>
<td>
<?php echo h(ucfirst($untiedfund['Untiedfund']['status'])); ?>
&nbsp;
</td>
</tr>

<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
