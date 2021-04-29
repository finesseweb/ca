<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($vhsnc['VhsncConstitution']['id']); ?>
&nbsp;
</td>
</tr>-->
<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['Block']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
<?php 
if($vhsnc['Village']['name']=='0' || $vhsnc['Village']['name']==''){
    echo "All Village";
} else {
    echo h(ucfirst($vhsnc['Village']['name']));
    
} ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Ward '); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['Ward']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('VHSNC Constitution name '); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncConstitution']['vhsnc_name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Constitution Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($vhsnc['VhsncConstitution']['constitution_date']))); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('VHSNC Constitution level'); ?></td>
<td>
<?php echo h($vhsnc['VhsncConstitution']['vhsnc_constitution_level']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('VHSNC Bank Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncConstitution']['vhsnc_bank_name'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Account Type'); ?></td>
<td>
<?php echo h($vhsnc['VhsncConstitution']['account_type']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Account No'); ?></td>
<td>
<?php echo h($vhsnc['VhsncConstitution']['account_no']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('IFSC'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncConstitution']['ifsc'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Branch Address'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncConstitution']['branch_address'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Opening Balanace'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncConstitution']['opening_balance'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Primary Signatory'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncConstitution']['primary_signatory'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Secondary Signatory'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncConstitution']['secondary_signatory'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncConstitution']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Total Members'); ?></td>
<td>
<?php echo h($vhsnc['VhsncConstitution']['total_members']); ?>
&nbsp;
</td>
</tr>



<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($vhsnc['VhsncConstitution']['status'])); ?>
&nbsp;
</td>
</tr>

<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
