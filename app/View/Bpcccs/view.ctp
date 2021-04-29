<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['id']); ?>
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
<?php echo h(ucfirst($bpccc['Block']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
    <?php
$mem = explode(',',$bpccc['Bpccc']['allocated_panchayat']);
//print_r($mem);
foreach($mem as $m) {
  $questionlist=$this->requestAction(array("controller"=>"panchayats","action"=>"gettitle",$m)); 
                 
                  echo ucwords($questionlist['Panchayat']['name'].', ');
}

 ?>
<?php //echo h(ucfirst($bpccc['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
    
<?php 
if($bpccc['Village']['name']==0) {
    echo "All Village";
} else {
    echo h(ucfirst($bpccc['Village']['name']));


}?>
&nbsp;
</td>
</tr>

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
<?php echo h(ucfirst($bpccc['Bpccc']['designation'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Gender'); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Bpccc']['gender'])); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Mobile'); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['mobile']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Email id'); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['email_id']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Address'); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Bpccc']['address'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Date of Joining'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($bpccc['Bpccc']['date_of_joining']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Contract End Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($bpccc['Bpccc']['contract_end_date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('APHC No'); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['aphc_no']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('HSC No '); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['hsc_no']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('AWC No '); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['awc_no']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('AWW No'); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['aww_no']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('VHSND No '); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['vhsnd_no']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('ANM No'); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['anm_no']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('ASHA Facilitators '); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['asha_facilitators_no']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('ASHA No '); ?></td>
<td>
<?php echo h($bpccc['Bpccc']['asha_no']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks '); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Bpccc']['remarks'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Status '); ?></td>
<td>
<?php echo h(ucfirst($bpccc['Bpccc']['status'])); ?>
&nbsp;
</td>
</tr>

<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
