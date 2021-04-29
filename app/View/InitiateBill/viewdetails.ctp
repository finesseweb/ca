<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<tr><td><?php echo __('Id'); ?></td><td><?php echo __('Sub Category'); ?></td><td><?php echo __('Unit Cost '); ?></td><td><?php echo __('No of Unit'); ?></td><td><?php echo __('Frequency'); ?></td><td><?php echo __('Amount (INR)'); ?></td>
   
</tr>
 <?php  
    foreach($financials as $financial)
    {    
    ?>
<tr>
<td>
<?php echo h($financial['FinancialDetail']['id']); ?>
&nbsp;
</td>
<td>
<?php echo h(ucfirst($financial['Subcategory']['name'])); ?>
&nbsp;
</td>
<td>
<?php echo h($financial['FinancialDetail']['unit_cost']); ?>
&nbsp;
</td>
<td>
<?php echo h($financial['FinancialDetail']['no_of_unit']); ?>
&nbsp;
</td>
<td>
<?php echo h($financial['FinancialDetail']['frequecny']); ?>
&nbsp;
</td>
<td>
<?php echo h($financial['FinancialDetail']['amount']); ?>
&nbsp;
</td>
</tr>
    <?php } ?>


<!--<tr>
<td><?php echo __('Grant Period'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($financial['Period']['from_date'])).' To '.date('d-m-Y',strtotime($financial['Period']['to_date']))); ?>
&nbsp;
</td>
</tr>-->
</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
