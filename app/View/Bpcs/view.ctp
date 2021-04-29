<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($bpccc['Bpc']['id']); ?>
&nbsp;
</td>
</tr>-->
<tr><td><?php echo __('Organization'); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Ngo']['name_of_ngo'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($bpccc['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
    
    <?php
$mem = explode(',',$bpccc['Bpc']['allocated_block']);
//print_r($mem);
foreach($mem as $m) {
  $questionlist=$this->requestAction(array("controller"=>"blocks","action"=>"gettitle",$m)); 
                 
                  echo ucwords($questionlist['Block']['name'].',');
}

 ?>
<?php //echo h(ucfirst($bpccc['Block']['name'])); ?>
&nbsp;
</td>
</tr>

<!--<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Village']['name'])); ?>
&nbsp;
</td>
</tr>-->

<tr>
<td><?php echo __('Name of Staff '); ?></td>
<td>
<?php echo h(ucfirst($bpccc['User']['name'].' '.$bpccc['User']['last_name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Designation'); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Bpc']['designation'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Gender'); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Bpc']['gender'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Mobile'); ?></td>
<td>
<?php echo h($bpccc['Bpc']['mobile']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Email id'); ?></td>
<td>
<?php echo h($bpccc['Bpc']['email_id']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Address'); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Bpc']['address'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Date of Joining'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($bpccc['Bpc']['date_of_joining']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Contract End Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($bpccc['Bpc']['contract_end_date']))); ?>
&nbsp;
</td>
</tr>

<td><?php echo __('Remarks '); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Bpc']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Bpc']['status'])); ?>
&nbsp;
</td>
</tr>

<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
