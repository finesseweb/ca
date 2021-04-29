<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');
      ?>
<style>
    table label {
        display : none!important;
    }
     .form-control{
            margin-bottom: 0px!important;
    }
    .tform{
        margin-bottom: 15px!important;
    }
</style>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List VHSNDS'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Vhsnd'); ?>
<fieldset>
<legend><?php echo __(' VHSND'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'1'));
//echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control tform','options'=>array(''=>'--Select--',$cities),'required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$blocks),'required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$panchayat),'required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control tform','options'=>array(''=>'All Villages',$village)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$ward)))."</div>";
?>
<div class="col-sm-3"><div class="input select"><label for="VhsndAwcCode">AWC Code</label><select name="data[Vhsnd][awc_code]" class="calbsp form-control tform" id="VhsndAwcCode">
<option value="">Select Option</option>
    <?php  
$questionlist=$this->requestAction(array("controller"=>"geographicals","action"=>"getall")); 
    foreach($questionlist as $key=>$value){
       ?>
        <option value="<?php echo $value['Geographical']['id']?>" <?php if($value['Geographical']['id']==$this->request->data['Vhsnd']['awc_code']) { echo "selected"; }?>><?php echo $value['Geographical']['awc_code']?> </option>
    
            <?php }
               
                  ?>
</select></div></div>
    
    <div class="col-sm-3"><div class="input select"><label for="VhsndAwwName">AWW Name</label><select name="data[Vhsnd][aww_name]" class="form-control tform" id="VhsndAwwName">
<option value="">Select Option</option>
<?php  
$questionlist=$this->requestAction(array("controller"=>"geographicals","action"=>"getall")); 
    foreach($questionlist as $key=>$value){
       ?>
<option value="<?php echo $value['Geographical']['id']?>" <?php if($value['Geographical']['id']==$this->request->data['Vhsnd']['aww_name']) { echo "selected"; }?>><?php echo $value['Geographical']['aww_name']?> </option>
    
         
  <?php //      echo '<option value="'.$value['Geographical']['id'].'">'.$value['Geographical']['aww_name'].'</option>';
    }
               
                  ?>

</select></div></div>
    
   
<div class="col-sm-3"><div class="input select"><label for="VhsndAshaName">ASHA Name</label><select name="data[Vhsnd][asha_name]" class="form-control tform" id="VhsndAshaName">
<option value="">Select Option</option>
<?php  
$questionlist=$this->requestAction(array("controller"=>"geographicals","action"=>"getall")); 
    foreach($questionlist as $key=>$value){
     ?>
<option value="<?php echo $value['Geographical']['id']?>" <?php if($value['Geographical']['id']==$this->request->data['Vhsnd']['asha_name']) { echo "selected"; }?> ><?php echo $value['Geographical']['asha_name']?> </option>
    
 
   <?php 
   }
               
                  ?>
</select></div></div>
    
<!--     <div class="col-sm-3"><div class="input select"><label for="VhsndAnmName">ANM Name</label><select name="data[Vhsnd][anm_name]" class="form-control tform" id="VhsndAnmName">
<option value="">Select Option</option>
<?php  
//$questionlist=$this->requestAction(array("controller"=>"facilityDetails","action"=>"getall")); 
//    foreach($questionlist as $key=>$value){
//       
//        echo '<option value="'.$value['FacilityDetail']['id'].'">'.$value['FacilityDetail']['anm_name'].'</option>';
//    }
//               
                  ?>
</select></div></div>-->
    <?php
//echo  "<div class='col-sm-3'>".$this->Form->input('awc_code',array('class'=>'calbsp form-control','label'=>'AWC Code','options'=>array(''=>'Select Option')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('aww_name',array('class' => 'form-control','label'=>'AWW Name','options'=>array(''=>'Select Option')))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('anm_name',array('class' => 'form-control','label'=>'ANM Name'))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('asha_name',array('class' => 'form-control','label'=>'ASHA Name','options'=>array(''=>'Select Option')),array('required'=>'required'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('pw_due_list',array('type'=>'number','class'=>'form-control tform','label'=>'PW in Due list (No) '))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('child_due_list',array('type'=>'number','class' => 'form-control tform','label'=>'Child in Due list (No)'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ec_due_list',array('type'=>'text','number' => 'form-control tform','label'=>'EC in Due list (No)'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('visit_date1',array('class' => 'form-control tform','type'=>'text','label'=>'Visit Date','readonly'=>'readonly','value'=>date('d-m-Y',strtotime($this->request->data['Vhsnd']['visit_date']))))."</div>";
echo "<div class='col-sm-3' style='display:none'>".$this->Form->input('visit_date',array('class' => 'form-control tform','type'=>'text'))."</div>";

?>
     <div class="col-sm-1" id="refresh">
    <?php 
    //date_default_timezone_set("Asia/Kolkata");
    //echo date("h:i:sa");?>
        <input type="hidden" value="<?=date("h:i:sa")?>" id="time" name="data[Vhsnd][time]">
    </div>
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> <legend class="col-sm-12">ANC Service Availability/Footfall</legend></a>
    <div id="collapseOne" class="col-sm-12 collapse">
        <table class="table">
        <thead><th>ANC Service</th><th>Service Availability</th><th>Reason (If No)</th><th>Footfall</th></thead>
    <tbody>
        <?php
       echo "<tr><td>TD</td><td>".$this->Form->input('it_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('it_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('it_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>Height</td><td>".$this->Form->input('height_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('height_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('height_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>Weight</td><td>".$this->Form->input('weight_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('weight_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('weight_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>IFA</td><td>".$this->Form->input('ifa_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('ifa_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('ifa_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>Calcium</td><td>".$this->Form->input('calcium_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('calcium_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('calcium_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>B.P Check</td><td>".$this->Form->input('bp_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('bp_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('bp_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>HB Test</td><td>".$this->Form->input('hb_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('hb_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('hb_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>Urine Test</td><td>".$this->Form->input('urine_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('urine_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('urine_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>Abdomen Test</td><td>".$this->Form->input('abdomen_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No','required'=>'required')))."</td><td>".$this->Form->input('abdomen_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('abdomen_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
              
        ?>
        
        
    </tbody>
    </table>
    </div>
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> <legend class="col-sm-12">Child Service Availability/Footfall</legend></a>
    <div id="collapseTwo" class="col-sm-12 collapse">
    <table>
        <thead><th>Child Service </th><th>Service Availability</th><th>Reason (If No)</th><th>Footfall</th></thead>
    <tbody>
        <?php
       echo "<tr><td>Immunisation</td><td>".$this->Form->input('immunisation_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('immunisation_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonchild)))."</td><td>".$this->Form->input('immunisation_footfall_number',array('class' => 'form-control child'))."</td></tr>";
        echo "<tr><td>Growth Monitoring & Plotting</td><td>".$this->Form->input('growth_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('growth_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonchild)))."</td><td>".$this->Form->input('growth_footfall_number',array('class' => 'form-control child'))."</td></tr>";
        
        ?>
        
        
    </tbody>
    </table>
    </div>
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><legend class="col-sm-12">Family Planning Services Availability/Footfall</legend></a>
    <div id="collapseThree" class="col-sm-12 collapse">
    <table>
        <thead><th>Family Planning</th><th>Service Availability</th><th>Reason (If No)</th><th>Footfall</th></thead>
    <tbody>
        <?php
         echo "<tr><td>Condom</td><td>".$this->Form->input('condom_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('condom_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonfamily)))."</td><td>".$this->Form->input('condom_footfall_number',array('class' => 'form-control'))."</td></tr>";
        echo "<tr><td>Mala N</td><td>".$this->Form->input('mala_n_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('mala_n_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonfamily)))."</td><td>".$this->Form->input('mala_n_footfall_number',array('class' => 'form-control'))."</td></tr>";
        echo "<tr><td>Chaya</td><td>".$this->Form->input('chaya_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('chaya_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonfamily)))."</td><td>".$this->Form->input('chaya_footfall_number',array('class' => 'form-control'))."</td></tr>";
        echo "<tr><td>Antara</td><td>".$this->Form->input('antara_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('antara_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonfamily)))."</td><td>".$this->Form->input('antara_footfall_number',array('class' => 'form-control'))."</td></tr>";
        
        ?>
        
        
    </tbody>
    </table>
    </div>
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"> <legend class="col-sm-12">Adolescent Services Availability/Footfall</legend></a>
    <div id="collapseFour" class="col-sm-12 collapse">
    <table>
        <thead><th>Adolescent Service</th><th>Service Availability</th><th>Reason (If No)</th><th>Footfall</th></thead>
    <tbody>
        <?php
       echo "<tr><td>TD</td><td>".$this->Form->input('td_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('td_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonado)))."</td><td>".$this->Form->input('td_footfall_number',array('class' => 'form-control'))."</td></tr>";
        echo "<tr><td>IFA(Blue)</td><td>".$this->Form->input('ifa_blue_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('ifa_blue_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonado)))."</td><td>".$this->Form->input('ifa_blue_footfall_number',array('class' => 'form-control'))."</td></tr>";
       
        ?>
        
        
    </tbody>
    </table>
            </div>
    
    
    <legend class="col-sm-12">Counselled on</legend>
    <?php
    
        echo  "<div class='col-sm-4'>".$this->Form->input('anc_counselling',array('type'=>'text','class'=>'calbsp form-control tform','label'=>'ANC'))."</div>";
        echo  "<div class='col-sm-4'>".$this->Form->input('child_counselling',array('type'=>'text','class'=>'calbsp form-control tform','label'=>'Child'))."</div>";
         echo  "<div class='col-sm-4'>".$this->Form->input('family_counselling',array('type'=>'text','class'=>'calbsp form-control tform','label'=>'Family Planning'))."</div>";
       
        echo  "<div class='col-sm-4'>".$this->Form->input('adolescentc_ounselling',array('type'=>'text','class'=>'calbsp form-control tform','label'=>'Adolescent'))."</div>";
        echo  "<div class='col-sm-4'>".$this->Form->input('pnc_visit',array('type'=>'text','class'=>'calbsp form-control tform','label'=>'PNC visit'))."</div>";
        echo  "<div class='col-sm-4'>".$this->Form->input('remarks',array('class'=>'calbsp form-control tform','label'=>'VHSND site monitored by VHSNC President','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No','representative'=>'Representative')))."</div>";
        ?>   
 <?php /*?><div class="col-sm-3"><div class="input select"><label for="UntiedfundfinacialId">Financial Years</label>
<select name="data[Untiedfund][financial_year]" class="form-control" id="UntiedfundfinacialId">
<option value="">Select Period</option>
<?php foreach ($reporting_periods as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['reporting_periods']['id']?>"><?=date('d-m-Y',strtotime($value['reporting_periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['reporting_periods']['to_date']))?></option>
<?php } ?>
</select></div></div><?php */?>

<?php echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;  var dp_cal3; var dp_cal4;  var dp_cal5; var dp_cal6;   
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('VhsndVisitDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('NgoFcraRegistrationValidTill'));


$(document).ready(function(){
    
     <?php if($sessionval!='regular') { ?>
$("#VhsndDistrict").change(function(){
var c=$(this).val();
$('#VhsndBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#VhsndBlock").html(result);}});

});

<?php } ?>
	<?php if($sessionrole!='CC') { ?>
$("#VhsndBlock").change(function(){
var c=$(this).val();
$('#VhsndPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#VhsndPanchayat").html(result);}});

});

<?php } ?>
$("#VhsndPanchayat").change(function(){
var c=$(this).val();
$('#VhsndVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#VhsndVillage").html(result);}});

});


//$("#VhsndVillage").change(function(){
//var c=$(this).val();
//$('#VhsndWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#VhsndWard").html(result);}});
//});
});


/////yes-no ///

var a= $("#VhsndItAvailability").val();
if(a==='yes'){
$("#VhsndItFootfallNumber").removeAttr('disabled');
$("#VhsndItReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndItReason").removeAttr('disabled');
 $("#VhsndItFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndItAvailability").change(function(e) {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndItReason").removeAttr('disabled');
$("#VhsndItFootfallNumber").val('0');
$("#VhsndItFootfallNumber").prop('readonly', true);

   }
  else {
 $('select#VhsndItReason option').removeAttr("selected");
 $("#VhsndItReason").val('0');
 $("#VhsndItReason").prop('disabled', 'disabled');
//$("#VhsndItReason").attr('readonly', true);
$("#VhsndItFootfallNumber").removeAttr('disabled');
   }
});
///
var a= $("#VhsndHeightAvailability").val();
if(a==='yes'){
$("#VhsndHeightFootfallNumber").removeAttr('disabled');
$("#VhsndHeightReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndHeightReason").removeAttr('disabled');
 $("#VhsndHeightFootfallNumber").prop('disabled', 'disabled');
 }
 

$("#VhsndHeightAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndHeightReason").removeAttr('disabled');
$("#VhsndHeightFootfallNumber").val('0');
 $("#VhsndHeightFootfallNumber").prop('readonly', true);
 
   }
  else {
 $('select#VhsndHeightReason option').removeAttr("selected");
 $("#VhsndHeightReason").val('0');
$("#VhsndHeightReason").prop('disabled', 'disabled');
$("#VhsndHeightFootfallNumber").removeAttr('disabled');
   }
});
///
var a= $("#VhsndHbAvailability").val();
if(a==='yes'){
$("#VhsndHbFootfallNumber").removeAttr('disabled');
$("#VhsndHbReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndHbReason").removeAttr('disabled');
 $("#VhsndHbFootfallNumber").prop('disabled', 'disabled');
 }
 //$("#VhsndHbReason").prop('disabled', 'disabled');
 //$("#VhsndHbFootfallNumber").prop('disabled', 'disabled');

$("#VhsndHbAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndHbReason").removeAttr('disabled');
$("#VhsndHbFootfallNumber").val('0');
$("#VhsndHbFootfallNumber").prop('readonly', true);

   }
  else {
  $('select#VhsndHbReason option').removeAttr("selected"); 
  $("#VhsndHbReason").val('0');
$("#VhsndHbReason").prop('disabled', 'disabled');
$("#VhsndHbFootfallNumber").removeAttr('disabled');
   }
});
///
var a= $("#VhsndAbdomenAvailability").val();
if(a==='yes'){
$("#VhsndAbdomenFootfallNumber").removeAttr('disabled');
$("#VhsndAbdomenReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndAbdomenReason").removeAttr('disabled');
 $("#VhsndAbdomenFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndAbdomenAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndAbdomenReason").removeAttr('disabled');
$("#VhsndAbdomenFootfallNumber").val('0');
 $("#VhsndAbdomenFootfallNumber").prop('readonly', true);
 
   }
  else {
$('select#VhsndAbdomenReason option').removeAttr("selected"); 
$("#VhsndAbdomenReason").val('0');
$("#VhsndAbdomenReason").prop('disabled', 'disabled');
$("#VhsndAbdomenFootfallNumber").removeAttr('disabled');
   }
});
///
var a= $("#VhsndCalciumAvailability").val();
if(a==='yes'){
$("#VhsndCalciumFootfallNumber").removeAttr('disabled');
$("#VhsndCalciumReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndCalciumReason").removeAttr('disabled');
 $("#VhsndCalciumFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndCalciumAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndCalciumReason").removeAttr('disabled');
$("#VhsndCalciumFootfallNumber").val('0');
$("#VhsndCalciumFootfallNumber").prop('readonly', true);

   }
  else {
$('select#VhsndCalciumReason option').removeAttr("selected");    
$("#VhsndCalciumReason").val('0');
$("#VhsndCalciumReason").prop('disabled', 'disabled');
$("#VhsndCalciumFootfallNumber").removeAttr('disabled');
   }
});

//
var a= $("#VhsndWeightAvailability").val();
if(a==='yes'){
$("#VhsndWeightFootfallNumber").removeAttr('disabled');
$("#VhsndWeightReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndWeightReason").removeAttr('disabled');
 $("#VhsndWeightFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndWeightAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndWeightReason").removeAttr('disabled');
$("#VhsndWeightFootfallNumber").val('0');
$("#VhsndWeightFootfallNumber").prop('readonly', true);

   }
  else {
 $('select#VhsndWeightReason option').removeAttr("selected");
 $("#VhsndWeightFootfallNumber").val('0');
$("#VhsndWeightReason").prop('disabled', 'disabled');
$("#VhsndWeightFootfallNumber").removeAttr('disabled');
   }
});
///
var a= $("#VhsndBpAvailability").val();
if(a==='yes'){
$("#VhsndBpFootfallNumber").removeAttr('disabled');
$("#VhsndBpReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndBpReason").removeAttr('disabled');
 $("#VhsndBpFootfallNumber").prop('disabled', 'disabled');
 }

$("#VhsndBpAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndBpReason").removeAttr('disabled');
$("#VhsndBpFootfallNumber").val('0');
$("#VhsndBpFootfallNumber").prop('readonly', true);

   }
  else {
$('select#VhsndBpReason option').removeAttr("selected");
$("#VhsndBpFootfallNumber").val('0');
$("#VhsndBpReason").prop('disabled', 'disabled');
$("#VhsndBpFootfallNumber").removeAttr('disabled');
   }
});
///
var a= $("#VhsndUrineAvailability").val();
if(a==='yes'){
$("#VhsndUrineFootfallNumber").removeAttr('disabled');
$("#VhsndUrineReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndUrineReason").removeAttr('disabled');
 $("#VhsndUrineFootfallNumber").prop('disabled', 'disabled');
 }


$("#VhsndUrineAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndUrineReason").removeAttr('disabled');
$("#VhsndUrineFootfallNumber").val('0');
$("#VhsndUrineFootfallNumber").prop('readonly', true);

   }
  else {
$('select#VhsndUrineReason option').removeAttr("selected");
$("#VhsndUrineReason").val('0');
$("#VhsndUrineReason").prop('disabled', 'disabled');
$("#VhsndUrineFootfallNumber").removeAttr('disabled');
   }
});

///
var a= $("#VhsndIfaAvailability").val();
if(a==='yes'){
$("#VhsndIfaFootfallNumber").removeAttr('disabled');
$("#VhsndIfaReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndIfaReason").removeAttr('disabled');
 $("#VhsndIfaFootfallNumber").prop('disabled', 'disabled');
 }

$("#VhsndIfaAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndIfaReason").removeAttr('disabled');
$("#VhsndIfaFootfallNumber").val('0');
$("#VhsndIfaFootfallNumber").prop('readonly', true);

   }
  else {
 $('select#VhsndIfaReason option').removeAttr("selected");
  $("#VhsndIfaReason").val('0');    
$("#VhsndIfaReason").prop('disabled', 'disabled');
$("#VhsndIfaFootfallNumber").removeAttr('disabled');

   }
});

////Child Service Availability/Footfall

var a= $("#VhsndImmunisationAvailability").val();
if(a==='yes'){
$("#VhsndImmunisationFootfallNumber").removeAttr('disabled');
$("#VhsndImmunisationReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndImmunisationReason").removeAttr('disabled');
 $("#VhsndImmunisationFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndImmunisationAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndImmunisationReason").removeAttr('disabled');
$("#VhsndImmunisationFootfallNumber").val('0');
$("#VhsndImmunisationFootfallNumber").prop('readonly', true);

   }
  else {
$('select#VhsndImmunisationReason option').removeAttr("selected");
$("#VhsndImmunisationReason").val('0');
$("#VhsndImmunisationReason").prop('disabled', 'disabled');
$("#VhsndImmunisationFootfallNumber").removeAttr('disabled');
   }
});
////
var a= $("#VhsndGrowthAvailability").val();
if(a==='yes'){
$("#VhsndGrowthFootfallNumber").removeAttr('disabled');
$("#VhsndGrowthReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndGrowthReason").removeAttr('disabled');
 $("#VhsndGrowthFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndGrowthAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndGrowthReason").removeAttr('disabled');
$("#VhsndGrowthFootfallNumber").val('0');
$("#VhsndGrowthFootfallNumber").prop('readonly', true);

   }
  else {
$('select#VhsndGrowthReason option').removeAttr("selected");
$("#VhsndGrowthReason").val('0');
$("#VhsndGrowthReason").prop('disabled', 'disabled');
$("#VhsndGrowthFootfallNumber").removeAttr('disabled');
   }
});


//Family Planning Services Availability/Footfall

var a= $("#VhsndCondomAvailability").val();
if(a==='yes'){
$("#VhsndCondomFootfallNumber").removeAttr('disabled');
$("#VhsndCondomReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndCondomReason").removeAttr('disabled');
 $("#VhsndCondomFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndCondomAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndCondomReason").removeAttr('disabled');
$("#VhsndCondomFootfallNumber").val('0');
$("#VhsndCondomFootfallNumber").prop('readonly', true);

   }
  else {
$('select#VhsndCondomReason option').removeAttr("selected");
$("#VhsndCondomReason").val('0');
$("#VhsndCondomReason").prop('disabled', 'disabled');
$("#VhsndCondomFootfallNumber").removeAttr('disabled');
   }
   
});
////
var a= $("#VhsndMalaNAvailability").val();
if(a==='yes'){
$("#VhsndMalaNFootfallNumber").removeAttr('disabled');
$("#VhsndMalaNReason").prop('disabled', 'disabled');

}
 else if(a==='no') {
 $("#VhsndMalaNReason").removeAttr('disabled');
 $("#VhsndMalaNFootfallNumber").prop('disabled', 'disabled');
 }
 

$("#VhsndMalaNAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndMalaNReason").removeAttr('disabled');
$("#VhsndMalaNFootfallNumber").val('0');
$("#VhsndMalaNFootfallNumber").prop('readonly', true);

   }
  else {
$('select#VhsndMalaNReason option').removeAttr("selected");
$("#VhsndMalaNReason").val('0');
$("#VhsndMalaNReason").prop('disabled', 'disabled');
$("#VhsndMalaNFootfallNumber").removeAttr('disabled');
   }
});

/////

var a= $("#VhsndChayaAvailability").val();
if(a==='yes'){
$("#VhsndChayaFootfallNumber").removeAttr('disabled');
$("#VhsndChayaReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndChayaReason").removeAttr('disabled');
 $("#VhsndChayaFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndChayaAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndChayaReason").removeAttr('disabled');
$("#VhsndChayaFootfallNumber").val('0');
$("#VhsndChayaFootfallNumber").prop('readonly', true);

   }
  else {
$('select#VhsndChayaReason option').removeAttr("selected");
$("#VhsndChayaReason").val('0');
$("#VhsndChayaReason").prop('disabled', 'disabled');
$("#VhsndChayaFootfallNumber").removeAttr('disabled');
   }
});
////

var a= $("#VhsndAntaraAvailability").val();
if(a==='yes'){
$("#VhsndAntaraFootfallNumber").removeAttr('disabled');
$("#VhsndAntaraReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndAntaraReason").removeAttr('disabled');
 $("#VhsndAntaraFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndAntaraAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndAntaraReason").removeAttr('disabled');
$("#VhsndAntaraFootfallNumber").val('0');
$("#VhsndAntaraFootfallNumber").prop('readonly', true);

   }
  else {
$('select#VhsndAntaraReason option').removeAttr("selected");
$("#VhsndAntaraReason").val('0');
$("#VhsndAntaraReason").prop('disabled', 'disabled');
$("#VhsndAntaraFootfallNumber").removeAttr('disabled');
   }
});


////Adolescent Services Availability/Footfall

var a= $("#VhsndTdAvailability").val();
if(a==='yes'){
$("#VhsndTdFootfallNumber").removeAttr('disabled');
$("#VhsndTdReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndTdReason").removeAttr('disabled');
 $("#VhsndTdFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndTdAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndTdReason").removeAttr('disabled');
$("#VhsndTdFootfallNumber").val('0');
 $("#VhsndTdFootfallNumber").prop('readonly', true);
 
   }
  else {
$('select#VhsndTdReason option').removeAttr("selected");
$("#VhsndTdReason").val('0');
$("#VhsndTdReason").prop('disabled', 'disabled');
$("#VhsndTdFootfallNumber").removeAttr('disabled');
   }
});

////

var a= $("#VhsndIfaBlueAvailability").val();
if(a==='yes'){
$("#VhsndIfaBlueFootfallNumber").removeAttr('disabled');
$("#VhsndIfaBlueReason").prop('disabled', 'disabled');
}
 else if(a==='no') {
 $("#VhsndIfaBlueReason").removeAttr('disabled');
 $("#VhsndIfaBlueFootfallNumber").prop('disabled', 'disabled');
 }
 
$("#VhsndIfaBlueAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndIfaBlueReason").removeAttr('disabled');
$("#VhsndIfaBlueFootfallNumber").val('0');
$("#VhsndIfaBlueFootfallNumber").prop('readonly', true);

   }
  else {
$('select#VhsndIfaBlueReason option').removeAttr("selected");
$("#VhsndIfaBlueReason").val('0');
$("#VhsndIfaBlueReason").prop('disabled', 'disabled');
$("#VhsndIfaBlueFootfallNumber").removeAttr('disabled');
   }
});

$("#VhsndVisitDate").click( function(e) {
 $('#VhsndVisitDate').attr('type', 'date');
   });
//$(function() {
//   
//    $("#VhsndVisitDate").on("change",function(){
//        var selected = $(this).val();
//        alert(selected);
//    });
//});




$('#VhsndEditForm').submit(function() {
    $('select').removeAttr('disabled');
});




</script>
<script type="text/javascript">
    
    
    function clock() {
    var hours = document.getElementById('hours');
    var minutes = document.getElementById('minutes');
    var seconds = document.getElementById('seconds');
    
    var h = new Date().getHours();
    var m = new Date().getMinutes();
    var s = new Date().getSeconds();
    
    hours.innerHTML= h;
    minutes.innerHTML= m;
    seconds.innerHTML= s;
    
}   
var interval = setInterval(clock,1000);

 
    function my_function(){
      $('#refresh').load(location.href + ' #time');
    }
    setInterval("my_function();",1000); 
    
    
   
    </script>
