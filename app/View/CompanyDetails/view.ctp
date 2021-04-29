<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($booking['CompanyDetail']['id']); ?>
&nbsp;
</td>
</tr>-->
<tr><td><?php echo __('Name of Company'); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['name_of_company'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Phone'); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['company_phone'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Email'); ?></td>
<td>
<?php echo h($booking['CompanyDetail']['company_email']); ?>
&nbsp;
</td>
</tr>



<tr>
<td><?php echo __('City'); ?></td>
<td>
<?php echo h($booking['CompanyDetail']['district_p']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Post office'); ?></td>
<td>
<?php echo h($booking['CompanyDetail']['post_office_p']); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Permanent address'); ?></td>
<td>
<?php echo h($booking['CompanyDetail']['permanent_address']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Permanent pincode'); ?></td>
<td>
<?php echo h($booking['CompanyDetail']['permanent_pincode']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Correspondence address'); ?></td>
<td>
<?php echo h($booking['CompanyDetail']['correspondence_address']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Correspondence pincode'); ?></td>
<td>
<?php echo h($booking['CompanyDetail']['correspondence_pincode']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Compnay Bank A/C No '); ?></td>
<td>
<?php echo h($booking['CompanyDetail']['company_bank_ac_no']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('IFSC '); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['ifsc'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Branch'); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['branch'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Bank name'); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['name_of_bank'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('GST'); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['gst'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('GST Number'); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['gst_number'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Pan Number'); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['pan_number'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Digital  Signature'); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['digital_signature'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks '); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($booking['CompanyDetail']['status'])); ?>
&nbsp;
</td>
</tr>
</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
