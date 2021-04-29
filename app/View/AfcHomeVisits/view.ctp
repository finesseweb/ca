<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 

<!--<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($afc['AfcHomeVisit']['id']); ?>
&nbsp;
</td>
</tr>-->


<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($afc['City']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Block'); ?></td>
<td>
<?php echo h(ucfirst($afc['Block']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($afc['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
<?php echo h(ucfirst($afc['Village']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Ward '); ?></td>
<td>
<?php echo h(ucfirst($afc['Ward']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Couple Name'); ?></td>
<td>
<?php echo h($afc['AfcHomeVisit']['couple_name']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Mobile'); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['mobile'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Gender'); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['gender'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Age'); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['age'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('No of Child'); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['no_of_child'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Yonger child age'); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['yonger_child_age'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Date'); ?></td>
<td>
<?php echo h(date('d-m-Y',strtotime($afc['AfcHomeVisit']['visit_date']))); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('ASHA accompanied '); ?></td>
<td>
<?php echo h($afc['AfcHomeVisit']['asha_accompanied']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('ASHA reason '); ?></td>
<td>
        <?php
$mem = $afc['AfcHomeVisit']['asha_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>

&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('AWW accompanied '); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['aww_accompanied'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('AWW reason '); ?></td>
<td>
     <?php
$mem = $afc['AfcHomeVisit']['aww_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>

&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Pri accompanied '); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['pri_accompanied'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Pri reason '); ?></td>
<td>
     <?php
$mem = $afc['AfcHomeVisit']['pri_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>

&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('SHG accompanied '); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['shg_accompanied'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('SHG reason '); ?></td>
<td>
     <?php
$mem = $afc['AfcHomeVisit']['shg_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>

&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Current contraceptives '); ?></td>
<td>
<?php
$mem = $afc['AfcHomeVisit']['current_contraceptives'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"contraceptives","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Contraceptive']['name']);
}
 ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Commodities regular supply '); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['commodities_regular_supply'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Commodities reason '); ?></td>
<td>
       <?php
$mem = $afc['AfcHomeVisit']['commodities_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>

&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Beneficiary couselled '); ?></td>
<td>
    <?php
    $mem = explode(',',$afc['AfcHomeVisit']['beneficiary_couselled']);

if(!empty($mem)) {
foreach ($mem as $m){
  $questionlist=$this->requestAction(array("controller"=>"contraceptives","action"=>"gettitle",$m)); 
                 
                  echo ucwords($questionlist['Contraceptive']['name'].',');
}

}
 ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Convinced opt'); ?></td>
<td>
 <?php
$mem = $afc['AfcHomeVisit']['convinced'];

if(!empty($mem)) {
  $questionlist=$this->requestAction(array("controller"=>"contraceptives","action"=>"gettitle",$mem)); 
                 
                      echo ucwords($questionlist['Contraceptive']['name']);
}
 ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Contraceptives delivery date '); ?></td>
<td>
<?php 
if($afc['AfcHomeVisit']['contraceptives_delivery_date']!='1970-01-01' && $afc['AfcHomeVisit']['contraceptives_delivery_date']!='0000-00-00' && $afc['AfcHomeVisit']['contraceptives_delivery_date']!='') {

echo date('d-m-Y',strtotime($afc['AfcHomeVisit']['contraceptives_delivery_date']));
}
?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Sterilisation of month '); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['sterilisation_of_month'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Follow visit date '); ?></td>
<td>
<?php
if($afc['AfcHomeVisit']['follow_visit_date']!='1970-01-01' && $afc['AfcHomeVisit']['follow_visit_date']!='0000-00-00' && $afc['AfcHomeVisit']['follow_visit_date']!='') {
echo date('d-m-Y',strtotime($afc['AfcHomeVisit']['follow_visit_date']));
}
?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h(ucfirst($afc['AfcHomeVisit']['remarks'])); ?>
&nbsp;
</td>
</tr>
<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
