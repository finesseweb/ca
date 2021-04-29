<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped"> 
<tr>
<td><?php echo __('District Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnds['City']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Block Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnds['Block']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Panchayat Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnds['Panchayat']['name'])); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Village Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnds['Village']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Ward Name'); ?></td>
<td>
<?php echo h(ucfirst($vhsnds['Ward']['name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('AWV Code '); ?></td>
<td>
<?php echo h($vhsnds['Geographical']['awc_code']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('AWW Name'); ?></td>
<td>
<?php echo h($vhsnds['Geographical']['aww_name']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('ANM Name '); ?></td>
<td>
<?php echo h(ucfirst($vhsnds['Vhsnd']['anm_name'])); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Asha Name'); ?></td>
<td>
<?php echo h($vhsnds['Geographical']['asha_name']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('PW due_list'); ?></td>
<td>
<?php echo h($vhsnds['Vhsnd']['pw_due_list']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Child  Due list'); ?></td>
<td>
<?php echo h($vhsnds['Vhsnd']['child_due_list']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('EC due list'); ?></td>
<td>
<?php echo h($vhsnds['Vhsnd']['ec_due_list']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Visit Date'); ?></td>
<td>
<?php echo date('d-m-Y',strtotime($vhsnds['Vhsnd']['visit_date'])); ?>
&nbsp;
</td>
</tr>
</table>

<table class="table table-striped">
    <h5>ANC Service Availability/Footfall</h5>
    <thead><th>Service</th><th>Availability</th><th>Reason</th><th>Footfall</th></thead>
<tbody>
 <tr>
     <td><?php echo __('TD'); ?></td>
     
     <td><?php echo h($vhsnds['Vhsnd']['it_availability']); ?></td>
     
     <td><?php $mem = $vhsnds['Vhsnd']['it_reason'];
             if(!empty($mem)) {
             $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
              echo ucwords($questionlist['Reason']['name']);} ?>
     </td>
     
 <td><?php echo h($vhsnds['Vhsnd']['it_footfall_number']); ?></td>
 
 <tr>
     <td><?php echo __('Height'); ?></td>
     
     <td><?php echo h($vhsnds['Vhsnd']['height_availability']); ?></td>
     <td><?php $mem = $vhsnds['Vhsnd']['height_reason'];
        if(!empty($mem)) {
            $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
             echo ucwords($questionlist['Reason']['name']);}?></td>
     <td><?php echo h($vhsnds['Vhsnd']['height_footfall_number']); ?></td></tr>
 
 
 <tr>
     <td><?php echo __('Weight'); ?></td><td><?php echo h($vhsnds['Vhsnd']['weight_availability']); ?></td>
     
     <td>
         <?php
$mem = $vhsnds['Vhsnd']['weight_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?></td>
     
     
     <td><?php echo h($vhsnds['Vhsnd']['weight_footfall_number']); ?></td>
 <tr><td><?php echo __('IFA'); ?></td><td><?php echo h($vhsnds['Vhsnd']['ifa_availability']); ?></td>
     <td><?php
$mem = $vhsnds['Vhsnd']['ifa_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?></td>
     
     <td><?php echo h($vhsnds['Vhsnd']['ifa_footfall_number']); ?></td>
 <tr><td><?php echo __('Calcium'); ?></td><td><?php echo h($vhsnds['Vhsnd']['calcium_availability']); ?></td>
     <td><?php
$mem = $vhsnds['Vhsnd']['calcium_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?></td>
     
     
     <td><?php echo h($vhsnds['Vhsnd']['calcium_footfall_number']); ?></td>
 <tr><td><?php echo __('B.P Check'); ?></td><td><?php echo h($vhsnds['Vhsnd']['bp_availability']); ?></td>
     
     <td><?php
$mem = $vhsnds['Vhsnd']['bp_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?></td>
     
     <td><?php echo h($vhsnds['Vhsnd']['bp_footfall_number']); ?></td>
<tr><td><?php echo __('HB Test'); ?></td><td><?php echo h($vhsnds['Vhsnd']['hb_availability']); ?></td>
    <td><?php
$mem = $vhsnds['Vhsnd']['hb_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?></td>
    
    <td><?php echo h($vhsnds['Vhsnd']['hb_footfall_number']); ?></td>
 <tr><td><?php echo __('Urine'); ?></td><td><?php echo h($vhsnds['Vhsnd']['urine_availability']); ?></td>
     
     <td><?php
$mem = $vhsnds['Vhsnd']['urine_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?></td>
     
     <td><?php echo h($vhsnds['Vhsnd']['urine_footfall_number']); ?></td>
<tr><td><?php echo __('Abdomen Test'); ?></td><td><?php echo h($vhsnds['Vhsnd']['abdomen_availability']); ?></td>
    
    <td><?php
$mem = $vhsnds['Vhsnd']['abdomen_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?></td>
    
    <td><?php echo h($vhsnds['Vhsnd']['abdomen_footfall_number']); ?></td>
<tr><td colspan="4"><h5>Child Service Availability/Footfall</h5>  </td></tr>      
<tr><td><?php echo __('Immunisation'); ?></td><td><?php echo h($vhsnds['Vhsnd']['immunisation_availability']); ?></td>
    
    <td>
    
    <?php
$mem = $vhsnds['Vhsnd']['immunisation_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>
    </td>
    <td><?php echo h($vhsnds['Vhsnd']['immunisation_footfall_number']); ?></td>
 <tr><td><?php echo __(' Growth Monitoring & Plotting'); ?></td><td><?php echo h($vhsnds['Vhsnd']['growth_availability']); ?></td>
     
     <td>
         
            <?php
$mem = $vhsnds['Vhsnd']['growth_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>
      </td><td><?php echo h($vhsnds['Vhsnd']['growth_footfall_number']); ?></td>
 
<tr><td colspan="4"><h5>Family Planning Services Availability/Footfall</h5>  </td></tr>      
        

 <tr><td><?php echo __('Condom'); ?></td><td><?php echo h($vhsnds['Vhsnd']['condom_availability']); ?></td>
     <td>
            <?php
$mem = $vhsnds['Vhsnd']['condom_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>
         
  </td>
     
     
     <td><?php echo h($vhsnds['Vhsnd']['condom_footfall_number']); ?></td>
 <tr><td><?php echo __('Mala N'); ?></td><td><?php echo h($vhsnds['Vhsnd']['mala_n_availability']); ?></td>
     <td>
          <?php
$mem = $vhsnds['Vhsnd']['mala_n_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>
  </td>
     
     
     <td><?php echo h($vhsnds['Vhsnd']['mala_n_footfall_number']); ?></td>
 <tr><td><?php echo __('Chaya'); ?></td><td><?php echo h($vhsnds['Vhsnd']['chaya_availability']); ?></td>
     
     <td>
         <?php
$mem = $vhsnds['Vhsnd']['chaya_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>
         
      </td>
     
     
     <td><?php echo h($vhsnds['Vhsnd']['chaya_footfall_number']); ?></td>
 <tr><td><?php echo __(' Antara'); ?></td><td><?php echo h($vhsnds['Vhsnd']['antara_availability']); ?></td>
     
     <td>
          <?php
$mem = $vhsnds['Vhsnd']['antara_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>
         </td>
     
     
     <td><?php echo h($vhsnds['Vhsnd']['antara_footfall_number']); ?></td>
 

<tr><td colspan="4"><h5>Adolescent Services Availability/Footfall</h5>  </td></tr>      
        
<tr><td><?php echo __('TD'); ?></td><td><?php echo h($vhsnds['Vhsnd']['td_availability']); ?></td>
    
    
    <td>
        <?php
$mem = $vhsnds['Vhsnd']['td_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>
        
  </td>
    
    
    <td><?php echo h($vhsnds['Vhsnd']['td_footfall_number']); ?></td>
 <tr><td><?php echo __('IFA (Blue)'); ?></td><td><?php echo h($vhsnds['Vhsnd']['ifa_blue_availability']); ?></td>
     
     <td>
          <?php
$mem = $vhsnds['Vhsnd']['ifa_blue_reason'];
if(!empty($mem)) {

  $questionlist=$this->requestAction(array("controller"=>"reasons","action"=>"gettitle",$mem)); 
                 
                  echo ucwords($questionlist['Reason']['name']);
}
?>
         
    </td>
     
     
     <td><?php echo h($vhsnds['Vhsnd']['ifa_blue_footfall_number']); ?></td>
 
  <tr><td colspan="4"><h5>Counselling Footfall</h5>  </td></tr>         
  <tr><td>ANC</td><td>Child</td><td colspan="2"> Family Planning</td><td colspan="2"> Adolescent</td></tr>     
  <tr><td><?php echo h($vhsnds['Vhsnd']['anc_counselling']); ?></td><td><?php echo h($vhsnds['Vhsnd']['child_counselling']); ?></td><td colspan="2"> <?php echo h($vhsnds['Vhsnd']['family_counselling']); ?></td><td colspan="2"> <?php echo h($vhsnds['Vhsnd']['adolescentc_ounselling']); ?></td></tr>         
</tbody>
</table>
<table class="table table-striped">
<tr>
<td><?php echo __('PNC Visit'); ?></td>
<td>
<?php echo h($vhsnds['Vhsnd']['pnc_visit']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Remarks'); ?></td>
<td>
<?php echo h($vhsnds['Vhsnd']['remarks']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h(ucfirst($vhsnds['Vhsnd']['status'])); ?>
&nbsp;
</td>
</tr>

</table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
