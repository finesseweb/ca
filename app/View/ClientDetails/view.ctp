<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($client['ClientDetail']['id']); ?>
&nbsp;
</td>
</tr>-->
<tr><td><?php echo __('Name of Client'); ?></td>
<td>
<?php echo h(ucfirst($client['ClientDetail']['name_of_client'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Client email'); ?></td>
<td>
<?php echo h(ucfirst($client['ClientDetail']['client_email'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Mobile No'); ?></td>
<td>
<?php echo h($client['ClientDetail']['client_phone']); ?>
&nbsp;
</td>
</tr>



<tr>
<td><?php echo __('City'); ?></td>
<td>
<?php echo h($client['ClientDetail']['district_p']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Post office'); ?></td>
<td>
<?php echo h($client['ClientDetail']['post_office_p']); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Permanent address'); ?></td>
<td>
<?php echo h($client['ClientDetail']['permanent_address']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Permanent pincode'); ?></td>
<td>
<?php echo h($client['ClientDetail']['permanent_pincode']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Correspondence address'); ?></td>
<td>
<?php echo h($client['ClientDetail']['correspondence_address']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Correspondence pincode'); ?></td>
<td>
<?php echo h($client['ClientDetail']['correspondence_pincode']); ?>
&nbsp;
</td>
</tr>



<tr>
<td><?php echo __('GST Number'); ?></td>
<td>
<?php echo h(ucfirst($client['ClientDetail']['gst_number'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Pan Number'); ?></td>
<td>
<?php echo h(ucfirst($client['ClientDetail']['pan_number'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Company  Name'); ?></td>
<td>
<?php echo h(ucfirst($client['ClientDetail']['company_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks '); ?></td>
<td>
<?php echo h(ucfirst($client['ClientDetail']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($client['ClientDetail']['status'])); ?>
&nbsp;
</td>
</tr>
</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
