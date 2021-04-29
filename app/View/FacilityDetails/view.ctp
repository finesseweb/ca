<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($geographical['Geographical']['id']); ?>
&nbsp;
</td>
</tr>-->
<tr><td><?php echo __('Organization'); ?></td>
<td>
<?php echo h(ucfirst($geographical['Ngo']['name_of_ngo'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($geographical['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($geographical['Block']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($geographical['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
<?php echo h(ucfirst($geographical['Village']['name'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Health facility name'); ?></td>
<td>
<?php echo h(ucfirst($geographical['FacilityDetail']['health_facility_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Facility type'); ?></td>
<td>
<?php echo h($geographical['FacilityDetail']['facility_type']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Health facility place'); ?></td>
<td>
<?php echo h($geographical['FacilityDetail']['health_facility_place']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Functionality '); ?></td>
<td>
<?php echo h($geographical['FacilityDetail']['functionality']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Doctor Name '); ?></td>
<td>
<?php echo h(ucfirst($geographical['FacilityDetail']['doctor_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Mobile No of Doctor '); ?></td>
<td>
<?php echo h($geographical['FacilityDetail']['doctor_mobile']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('ANM Name'); ?></td>
<td>
<?php echo h(ucfirst($geographical['FacilityDetail']['anm_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Mobile No of ANM '); ?></td>
<td>
<?php echo h($geographical['FacilityDetail']['anm_mobile']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks '); ?></td>
<td>
<?php echo h(ucfirst($geographical['FacilityDetail']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($geographical['FacilityDetail']['status'])); ?>
&nbsp;
</td>
</tr>

<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
