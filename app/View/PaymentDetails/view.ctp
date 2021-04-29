<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($financial['Finance']['id']); ?>
&nbsp;
</td>
</tr>-->
<tr><td><?php echo __('Name of Company'); ?></td>
<td>
<?php echo h(ucfirst($financial['CompanyDetail']['name_of_company'])); ?>
&nbsp;
</td>
</tr>
<tr>


<tr>
<td><?php echo __('Name of Client'); ?></td>
<td>
<?php echo h(ucfirst($financial['ClientDetail']['company_name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Bill Number'); ?></td>
<td>
<?php echo h($financial['Finance']['bill_number']); ?>
&nbsp;
</td>
</tr>



<tr>
<td><?php echo __('Billing Amount '); ?></td>
<td>
<?php echo h($financial['PaymentDetail']['billing_amount']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Payment Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($financial['PaymentDetail']['payment_date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Paid Amount'); ?></td>
<td>
<?php echo h($financial['PaymentDetail']['paid_amount']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Due Amount'); ?></td>
<td>
<?php echo h($financial['PaymentDetail']['due_amount']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Payment Mode)'); ?></td>
<td>
<?php echo h($financial['PaymentDetail']['payment_mode']); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Bank Name'); ?></td>
<td>
<?php echo h($financial['PaymentDetail']['bank_name']); ?>
&nbsp;
</td>
</tr>
<tr>
    
    
<tr>
<td><?php echo __('IFSC'); ?></td>
<td>
<?php echo h($financial['PaymentDetail']['ifsc']); ?>
&nbsp;
</td>
</tr>

 <tr>
<td><?php echo __('Transaction/DD/Cheque Number'); ?></td>
<td>
<?php echo h($financial['PaymentDetail']['transction_number']); ?>
&nbsp;
</td>
</tr>


<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($financial['PaymentDetail']['status'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
