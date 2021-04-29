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
    .clock span {
        
        width: 65px;
	max-width: 92px;
	font: bold 48px 'Droid Sans', Arial, sans-serif;
	text-align: center;
	color: #111;
	background-color: #ddd;
	background-image: -webkit-linear-gradient(top, #bbb, #eee); 
	background-image:    -moz-linear-gradient(top, #bbb, #eee);
	background-image:     -ms-linear-gradient(top, #bbb, #eee);
	background-image:      -o-linear-gradient(top, #bbb, #eee);
	border-top: 1px solid #fff;
	border-radius: 3px;
	box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.7);
	margin: 0 7px;
	
	display: inline-block;
	position: relative;
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
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
//echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control tform','options'=>array(''=>'--Select--',$cities),'required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$blocks),'required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$panchayat),'required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control tform','options'=>array(''=>'-Select--')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$ward)))."</div>";
?>
    <div class="col-sm-3"><div class="input select"><label for="VhsndAwcCode">AWC Code<!--<span class="after">*</span>--></label><select name="data[Vhsnd][awc_code]" class="calbsp form-control tform" id="VhsndAwcCode">
<option value="">Select Option</option>
    <?php  
$questionlist=$this->requestAction(array("controller"=>"geographicals","action"=>"getall")); 
    foreach($questionlist as $key=>$value){
       
        echo '<option value="'.$value['Geographical']['id'].'">'.$value['Geographical']['awc_code'].'</option>';
    }
               
                  ?>
</select></div></div>
    
    <div class="col-sm-3"><div class="input select"><label for="VhsndAwwName">AWW Name<!--<span class="after">*</span>--></label><select name="data[Vhsnd][aww_name]" class="form-control tform" id="VhsndAwwName">
<option value="">Select Option</option>
<?php  
$questionlist=$this->requestAction(array("controller"=>"geographicals","action"=>"getall")); 
    foreach($questionlist as $key=>$value){
       
       // echo '<option value="'.$value['Geographical']['id'].'">'.$value['Geographical']['aww_name'].'</option>';
    }
               
                  ?>
</select></div></div>
   <div class="col-sm-3"><div class="input select"><label for="VhsndAshaName">ASHA Name<!--<span class="after">*</span>--></label><select name="data[Vhsnd][asha_name]" class="form-control tform" id="VhsndAshaName">
<option value="">Select Option</option>
<?php  
$questionlist=$this->requestAction(array("controller"=>"geographicals","action"=>"getall")); 
    foreach($questionlist as $key=>$value){
       
       // echo '<option value="'.$value['Geographical']['id'].'">'.$value['Geographical']['asha_name'].'</option>';
    }
               
                  ?>
</select></div></div> 
<!--    <div class="col-sm-3"><div class="input select"><label for="VhsndAnmName">ANM Name<span class="after">*</span></label><select name="data[Vhsnd][anm_name]" class="form-control tform" id="VhsndAnmName" required="required">
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

echo "<div class='col-sm-3'>".$this->Form->input('pw_due_list',array('type'=>'number','class'=>'form-control tform','label'=>'PW in Due list (No)'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('child_due_list',array('type'=>'number','class' => 'form-control tform','label'=>'Child in Due list (No) '))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ec_due_list',array('type'=>'number','class' => 'form-control tform','label'=>'EC in Due list (No)'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('visit_date1',array('class' => 'form-control tform','type'=>'text','label'=>'Visit Date','readonly'=>'readonly','value'=>date('d-m-Y')))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('visit_date',array('class' => 'form-control tform','type'=>'hidden','value'=>date('Y-m-d')))."</div>";
//echo "<div class='col-sm-3'><button type='button' class='btn btn-primary' id='hideFootfall'>Session Start</button></div>";

?>
<!--    <div class="col-sm-5">
        
        <div class="clock"><span id="hours">00</span>: <span id="minutes">00</span> : <span id="seconds">00</span></div>
    </div>-->
    <div class="col-sm-1" id="refresh">
    <?php 
    //date_default_timezone_set("Asia/Kolkata");
    //echo date("h:i:sa");?>
        <input type="hidden" value="<?=date("h:i:sa")?>" id="time" name="data[Vhsnd][time]">
    </div>
    <div id="totalHide">
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> <legend class="col-sm-12">ANC Service Availability/Footfall</legend></a>
    <div id="collapseOne" class="col-sm-12 collapse in">
        <table class="table">
        <thead><th>ANC Service</th><th>Service Availability</th><th>Reason (If No)</th><th>Footfall</th></thead>
    <tbody>
        <?php
        echo "<tr><td>TD</td><td>".$this->Form->input('it_availability',array('class' => 'form-control avilable','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('it_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('it_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>Height</td><td>".$this->Form->input('height_availability',array('class' => 'form-control avilable','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('height_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('height_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>Weight</td><td>".$this->Form->input('weight_availability',array('class' => 'form-control avilable','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('weight_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('weight_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>IFA</td><td>".$this->Form->input('ifa_availability',array('class' => 'form-control avilable','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('ifa_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('ifa_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>Calcium</td><td>".$this->Form->input('calcium_availability',array('class' => 'form-control avilable','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('calcium_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('calcium_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>B.P Check</td><td>".$this->Form->input('bp_availability',array('class' => 'form-control avilable','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('bp_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('bp_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>HB Test</td><td>".$this->Form->input('hb_availability',array('class' => 'form-control avilable','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('hb_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('hb_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>Urine Test</td><td>".$this->Form->input('urine_availability',array('class' => 'form-control avilable','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('urine_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('urine_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
        echo "<tr><td>Abdomen Check</td><td>".$this->Form->input('abdomen_availability',array('class' => 'form-control avilable','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('abdomen_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonanc)))."</td><td>".$this->Form->input('abdomen_footfall_number',array('class' => 'form-control anc'))."</td></tr>";
              
        ?>
        
        
    </tbody>
    </table>
    </div>
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> <legend class="col-sm-12">Child Service Availability/Footfall</legend></a>
    <div id="collapseTwo" class="col-sm-12 collapse in">
    <table>
        <thead><th>Child Service </th><th>Availability</th><th>Reason (If No)</th><th>Footfall</th></thead>
    <tbody>
        <?php
        echo "<tr><td>Immunisation</td><td>".$this->Form->input('immunisation_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('immunisation_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonchild)))."</td><td>".$this->Form->input('immunisation_footfall_number',array('class' => 'form-control child'))."</td></tr>";
        echo "<tr><td>Growth Monitoring & Plotting</td><td>".$this->Form->input('growth_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('growth_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonchild)))."</td><td>".$this->Form->input('growth_footfall_number',array('class' => 'form-control child'))."</td></tr>";
        
        ?>
        
        
    </tbody>
    </table>
    </div>
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><legend class="col-sm-12">Family Planning Services Availability/Footfall</legend></a>
    <div id="collapseThree" class="col-sm-12 collapse in">
    <table>
        <thead><th>Family Planning</th><th>Service Availability</th><th>Reason (If No)</th><th>Footfall</th></thead>
    <tbody>
        <?php
        echo "<tr><td>Condom</td><td>".$this->Form->input('condom_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('condom_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonfamily)))."</td><td>".$this->Form->input('condom_footfall_number',array('class' => 'form-control family'))."</td></tr>";
        echo "<tr><td>Mala N</td><td>".$this->Form->input('mala_n_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('mala_n_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonfamily)))."</td><td>".$this->Form->input('mala_n_footfall_number',array('class' => 'form-control family'))."</td></tr>";
        echo "<tr><td>Chaya</td><td>".$this->Form->input('chaya_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('chaya_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonfamily)))."</td><td>".$this->Form->input('chaya_footfall_number',array('class' => 'form-control family'))."</td></tr>";
        echo "<tr><td>Antara</td><td>".$this->Form->input('antara_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('antara_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonfamily)))."</td><td>".$this->Form->input('antara_footfall_number',array('class' => 'form-control family'))."</td></tr>";
        
        ?>
        
        
    </tbody>
    </table>
    </div>
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"> <legend class="col-sm-12">Adolescent Services Availability/Footfall</legend></a>
    <div id="collapseFour" class="col-sm-12 collapse in">
    <table>
        <thead><th>Adolescent Service</th><th>Service Availability</th><th>Reason (If No)</th><th>Footfall</th></thead>
    <tbody>
        <?php
        echo "<tr><td>TD</td><td>".$this->Form->input('td_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('td_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonado)))."</td><td>".$this->Form->input('td_footfall_number',array('class' => 'form-control adolescent'))."</td></tr>";
        echo "<tr><td>IFA(Blue)</td><td>".$this->Form->input('ifa_blue_availability',array('class' => 'form-control','options'=>array(''=>'Select Option','yes'=>'Yes','no'=>'No'),'required'=>'required'))."</td><td>".$this->Form->input('ifa_blue_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonado)))."</td><td>".$this->Form->input('ifa_blue_footfall_number',array('class' => 'form-control adolescent'))."</td></tr>";
       
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
        echo  "<div class='col-sm-4'><button type='button' class='btn btn-primary' id='showFootfall'>Footfall Entry</button></div>";
 ?>  
    </div>
 <?php /*?><div class="col-sm-3"><div class="input select"><label for="UntiedfundfinacialId">Financial Years</label>
<select name="data[Untiedfund][financial_year]" class="form-control" id="UntiedfundfinacialId">
<option value="">Select Period</option>
<?php foreach ($reporting_periods as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['reporting_periods']['id']?>"><?=date('d-m-Y',strtotime($value['reporting_periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['reporting_periods']['to_date']))?></option>
<?php } ?>
</select></div></div><?php */?>

<?php 
echo "<div class='col-sm-12'><button type='button' class='btn btn-primary' id='hideFootfall'>Session Start</button></div>";

echo $this->Form->end(__('Submit')); ?>
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

    
$("#VhsndVillage").change(function(){
var c=$(this).val();
//$('#VhsndWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#VhsndWard").html(result);}});
$.ajax({url:"<?=SITE_PATH?>geographicals/getAwc/"+c,success:function(result){$("#VhsndAwcCode").html(result);}});
//$.ajax({url:"<?=SITE_PATH?>geographicals/getAww/"+c,success:function(result){$("#VhsndAwwName").html(result);}});
//$.ajax({url:"<?=SITE_PATH?>geographicals/getAsha/"+c,success:function(result){$("#VhsndAshaName").html(result);}});
//$.ajax({url:"<?=SITE_PATH?>facilityDetails/getAnm/"+c,success:function(result){$("#VhsndAnmName").html(result);}});

});


$("#VhsndWard").change(function(){
var c=$(this).val();
var v=$("#VhsndVillage").val();
//$('#VhsndWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#VhsndWard").html(result);}});
$.ajax({url:"<?=SITE_PATH?>geographicals/getAwcw/?c="+c+"&v="+v,success:function(result){$("#VhsndAwcCode").html(result);}});
//$.ajax({url:"<?=SITE_PATH?>geographicals/getAwww/?c="+c+"&v="+v,success:function(result){$("#VhsndAwwName").html(result);}});
//$.ajax({url:"<?=SITE_PATH?>geographicals/getAshaw/?c="+c+"&v="+v,success:function(result){$("#VhsndAshaName").html(result);}});
//$.ajax({url:"<?=SITE_PATH?>facilityDetails/getAnm/"+c,success:function(result){$("#VhsndAnmName").html(result);}});

});

$("#VhsndAwcCode").change(function(){
var c=$(this).val();
//$('#VhsndWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#VhsndWard").html(result);}});
//$.ajax({url:"<?=SITE_PATH?>geographicals/getAwcw/?c="+c+"&v="+v,success:function(result){$("#VhsndAwcCode").html(result);}});
$.ajax({url:"<?=SITE_PATH?>geographicals/getAww/"+c,success:function(result){$("#VhsndAwwName").html(result);}});
$.ajax({url:"<?=SITE_PATH?>geographicals/getAsha/"+c,success:function(result){$("#VhsndAshaName").html(result);}});
//$.ajax({url:"<?=SITE_PATH?>facilityDetails/getAnm/"+c,success:function(result){$("#VhsndAnmName").html(result);}});

});

});


/////yes-no ///

//var a= $("#VhsndItAvailability").val();

 $("#VhsndItReason").prop('disabled', 'disabled');
 $("#VhsndItFootfallNumber").prop('disabled', 'disabled');
$("#VhsndItAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndItReason").removeAttr('disabled');
$("#VhsndItFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndItReason").prop('disabled', 'disabled');
$("#VhsndItReason").val(' ');
$("#VhsndItFootfallNumber").removeAttr('disabled');
$("#VhsndItFootfallNumber").prop('required', 'required');
$("#VhsndAncCounselling").prop('required', 'required');
   }
});
///
//var a= $("#VhsndHeightAvailability").val();

 $("#VhsndHeightReason").prop('disabled', 'disabled');
 $("#VhsndHeightFootfallNumber").prop('disabled', 'disabled');

$("#VhsndHeightAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndHeightReason").removeAttr('disabled');
 $("#VhsndHeightFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndHeightReason").prop('disabled', 'disabled');
$("#VhsndHeightReason").val(' ');
$("#VhsndHeightFootfallNumber").removeAttr('disabled');
$("#VhsndHeightFootfallNumber").prop('required', 'required');
$("#VhsndAncCounselling").prop('required', 'required');
   }
});
///
//var a= $("#VhsndHbAvailability").val();

 $("#VhsndHbReason").prop('disabled', 'disabled');
 $("#VhsndHbFootfallNumber").prop('disabled', 'disabled');

$("#VhsndHbAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndHbReason").removeAttr('disabled');
$("#VhsndHbFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndHbReason").prop('disabled', 'disabled');
$("#VhsndHbReason").val(' ');
$("#VhsndHbFootfallNumber").removeAttr('disabled');
$("#VhsndHbFootfallNumber").prop('required', 'required');
$("#VhsndAncCounselling").prop('required', 'required');
   }
});
///
//var a= $("#VhsndAbdomenAvailability").val();

 $("#VhsndAbdomenReason").prop('disabled', 'disabled');
 $("#VhsndAbdomenFootfallNumber").prop('disabled', 'disabled');
$("#VhsndAbdomenAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndAbdomenReason").removeAttr('disabled');
 $("#VhsndAbdomenFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndAbdomenReason").prop('disabled', 'disabled');
$("#VhsndAbdomenReason").val(' ');
$("#VhsndAbdomenFootfallNumber").removeAttr('disabled');
$("#VhsndAbdomenFootfallNumber").prop('required', 'required');
$("#VhsndAncCounselling").prop('required', 'required');
   }
});
///
//var a= $("#VhsndCalciumAvailability").val();

 $("#VhsndCalciumReason").prop('disabled', 'disabled');
$("#VhsndCalciumFootfallNumber").prop('disabled', 'disabled');
$("#VhsndCalciumAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndCalciumReason").removeAttr('disabled');
$("#VhsndCalciumFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndCalciumReason").prop('disabled', 'disabled');
$("#VhsndCalciumReason").val(' ');
$("#VhsndCalciumFootfallNumber").removeAttr('disabled');
$("#VhsndCalciumFootfallNumber").prop('required', 'required');
$("#VhsndAncCounselling").prop('required', 'required');
   }
});

//
//var a= $("#VhsndWeightAvailability").val();

 $("#VhsndWeightReason").prop('disabled', 'disabled');
$("#VhsndWeightFootfallNumber").prop('disabled', 'disabled');
$("#VhsndWeightAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndWeightReason").removeAttr('disabled');
$("#VhsndWeightFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndWeightReason").prop('disabled', 'disabled');
$("#VhsndWeightReason").val(' ');
$("#VhsndWeightFootfallNumber").removeAttr('disabled');
$("#VhsndWeightFootfallNumber").prop('required', 'required');
("#VhsndAncCounselling").prop('required', 'required');
   }
});
///
//var a= $("#VhsndBpAvailability").val();

 $("#VhsndBpReason").prop('disabled', 'disabled');
 $("#VhsndBpFootfallNumber").prop('disabled', 'disabled');
$("#VhsndBpAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndBpReason").removeAttr('disabled');
$("#VhsndBpFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndBpReason").prop('disabled', 'disabled');
$("#VhsndBpReason").val(' ');
$("#VhsndBpFootfallNumber").removeAttr('disabled');
$("#VhsndBpFootfallNumber").prop('required', 'required');
$("#VhsndAncCounselling").prop('required', 'required');
   }
});
///
//var a= $("#VhsndUrineAvailability").val();

 $("#VhsndUrineReason").prop('disabled', 'disabled');
 $("#VhsndUrineFootfallNumber").prop('disabled', 'disabled');
$("#VhsndUrineAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndUrineReason").removeAttr('disabled');
$("#VhsndUrineFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndUrineReason").prop('disabled', 'disabled');
$("#VhsndUrineReason").val(' ');
$("#VhsndUrineFootfallNumber").removeAttr('disabled');
$("#VhsndUrineFootfallNumber").prop('required', 'required');
$("#VhsndAncCounselling").prop('required', 'required');
   }
});

///
//var a= $("#VhsndIfaAvailability").val();

 $("#VhsndIfaReason").prop('disabled', 'disabled');
$("#VhsndIfaFootfallNumber").prop('disabled', 'disabled');
$("#VhsndIfaAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndIfaReason").removeAttr('disabled');
$("#VhsndIfaFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndIfaReason").prop('disabled', 'disabled');
$("#VhsndIfaReason").val(' ');
$("#VhsndIfaFootfallNumber").removeAttr('disabled');
$("#VhsndIfaFootfallNumber").prop('required', 'required');
$("#VhsndAncCounselling").prop('required', 'required');
   }
});

////Child Service Availability/Footfall

//var a= $("#VhsndImmunisationAvailability").val();

 $("#VhsndImmunisationReason").prop('disabled', 'disabled');
$("#VhsndImmunisationFootfallNumber").prop('disabled', 'disabled');
$("#VhsndImmunisationAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndImmunisationReason").removeAttr('disabled');
$("#VhsndImmunisationFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndImmunisationReason").prop('disabled', 'disabled');
$("#VhsndImmunisationReason").val(' ');
$("#VhsndImmunisationFootfallNumber").removeAttr('disabled');
$("#VhsndImmunisationFootfallNumber").prop('required', 'required');
$("#VhsndChildCounselling").prop('required', 'required');
   }
});
////
//var a= $("#VhsndGrowthAvailability").val();

 $("#VhsndGrowthReason").prop('disabled', 'disabled');
$("#VhsndGrowthFootfallNumber").prop('disabled', 'disabled');
$("#VhsndGrowthAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndGrowthReason").removeAttr('disabled');
$("#VhsndGrowthFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndGrowthReason").prop('disabled', 'disabled');
$("#VhsndGrowthReason").val(' ');
$("#VhsndGrowthFootfallNumber").removeAttr('disabled');
$("#VhsndGrowthFootfallNumber").prop('required', 'required');
$("#VhsndChildCounselling").prop('required', 'required');
   }
});


//Family Planning Services Availability/Footfall

//var a= $("#VhsndCondomAvailability").val();

 $("#VhsndCondomReason").prop('disabled', 'disabled');
$("#VhsndCondomFootfallNumber").prop('disabled', 'disabled');
$("#VhsndCondomAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndCondomReason").removeAttr('disabled');
$("#VhsndCondomFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndCondomReason").prop('disabled', 'disabled');
$("#VhsndCondomReason").val(' ');
$("#VhsndCondomFootfallNumber").removeAttr('disabled');
$("#VhsndCondomFootfallNumber").prop('required', 'required');
$("#VhsndFamilyCounselling").prop('required', 'required');
   }
   
});
////
//var a= $("#VhsndMalaNAvailability").val();

 $("#VhsndMalaNReason").prop('disabled', 'disabled');
 $("#VhsndMalaNFootfallNumber").prop('disabled', 'disabled');
$("#VhsndMalaNAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndMalaNReason").removeAttr('disabled');
$("#VhsndMalaNFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndMalaNReason").prop('disabled', 'disabled');
$("#VhsndMalaNReason").val(' ');
$("#VhsndMalaNFootfallNumber").removeAttr('disabled');
$("#VhsndMalaNFootfallNumber").prop('required', 'required');
$("#VhsndFamilyCounselling").prop('required', 'required');
   }
});



//var a= $("#VhsndChayaAvailability").val();

 $("#VhsndChayaReason").prop('disabled', 'disabled');
$("#VhsndChayaFootfallNumber").prop('disabled', 'disabled');
$("#VhsndChayaAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndChayaReason").removeAttr('disabled');
$("#VhsndChayaFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndChayaReason").prop('disabled', 'disabled');
$("#VhsndChayaReason").val(' ');
$("#VhsndChayaFootfallNumber").removeAttr('disabled');
$("#VhsndChayaFootfallNumber").prop('required', 'required');
$("#VhsndFamilyCounselling").prop('required', 'required');
   }
});
////

//var a= $("#VhsndAntaraAvailability").val();

 $("#VhsndAntaraReason").prop('disabled', 'disabled');
$("#VhsndAntaraFootfallNumber").prop('disabled', 'disabled');
$("#VhsndAntaraAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndAntaraReason").removeAttr('disabled');
$("#VhsndAntaraFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndAntaraReason").prop('disabled', 'disabled');
$("#VhsndAntaraReason").val(' ');
$("#VhsndAntaraFootfallNumber").removeAttr('disabled');
$("#VhsndAntaraFootfallNumber").prop('required', 'required');
$("#VhsndFamilyCounselling").prop('required', 'required');
   }
});


////Adolescent Services Availability/Footfall

//var a= $("#VhsndTdAvailability").val();

 $("#VhsndTdReason").prop('disabled', 'disabled');
 $("#VhsndTdFootfallNumber").prop('disabled', 'disabled');
$("#VhsndTdAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndTdReason").removeAttr('disabled');
 $("#VhsndTdFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndTdReason").prop('disabled', 'disabled');
$("#VhsndTdReason").val(' ');
$("#VhsndTdFootfallNumber").removeAttr('disabled');
$("#VhsndTdFootfallNumber").prop('required', 'required');
$("#VhsndAdolescentcOunselling").prop('required', 'required');
   }
});

////

//var a= $("#VhsndIfaBlueAvailability").val();

 $("#VhsndIfaBlueReason").prop('disabled', 'disabled');
$("#VhsndIfaBlueFootfallNumber").prop('disabled', 'disabled');
$("#VhsndIfaBlueAvailability").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#VhsndIfaBlueReason").removeAttr('disabled');
$("#VhsndIfaBlueFootfallNumber").prop('disabled', 'disabled');
   }
  else {
$("#VhsndIfaBlueReason").prop('disabled', 'disabled');
$("#VhsndIfaBlueReason").val(' ');
$("#VhsndIfaBlueFootfallNumber").removeAttr('disabled');
$("#VhsndIfaBlueFootfallNumber").prop('required', 'required');
$("#VhsndAdolescentcOunselling").prop('required', 'required');
   }
});

$("#VhsndVisitDate").click( function(e) {
 $('#VhsndVisitDate').attr('type', 'date');
   });
   
   
 
 

   
 $( "#VhsndAncCounselling" ).blur(function() {
        var c=$(this).val();
    var inputs = $(".anc");
    var points= [];
    for(var i = 0; i < inputs.length; i++){
     points.push($(inputs[i]).val());
    
  
}
 var num = Math.max.apply( Math, points );
   if(c<=num) {
        return true ;
    } else {
        
          alert('Counselling Number do not greater than footfall');
          $( "#VhsndAncCounselling" ).val('');
          return false;
    }
 

});
  
 $( "#VhsndChildCounselling" ).blur(function() {
        var c=$(this).val();
    var inputs = $(".child");
    var points= [];
    for(var i = 0; i < inputs.length; i++){
     points.push($(inputs[i]).val());
    
  
}
 var num = Math.max.apply( Math, points );
   if(c<=num) {
        return true ;
    } else {
        
          alert('Counselling Number do not greater than footfall');
          $( "#VhsndChildCounselling" ).val('');
          return false;
    }
 

});

//$( "#VhsndFamilyCounselling" ).blur(function() {
//    var c=$(this).val();
//    var inputs = $(".family");
//    var points= [];
//    for(var i = 0; i < inputs.length; i++){
//     points.push($(inputs[i]).val());
//    
//  
//}
// var num = Math.max.apply( Math, points );
//   if(c<=num) {
//        return true ;
//    } else {
//        
//          alert('Counselling Number do not greater than footfall');
//          $( "#VhsndFamilyCounselling" ).val('');
//          return false;
//    }
// 
//
//});
//  $( "#VhsndFamilyCounselling" ).blur(function() {
//    var c=$(this).val();
//   var con=$( "#VhsndCondomFootfallNumber" ).val();
//   var mal=$( "#VhsndMalaNFootfallNumber" ).val();
//   var cha=$( "#VhsndChayaFootfallNumber" ).val();
//   var ana=$( "#VhsndAntaraFootfallNumber" ).val();
//   var num = +con + +mal + +cha + +ana
//   
//   if(c<=num) {
//        return true ;
//    } else {
//        
//         alert('Counselling Number do not greater than footfall');
//         $( "#VhsndFamilyCounselling" ).val('');
//         return false;
//   }
//
//});
$( "#VhsndAdolescentcOunselling" ).blur(function() {
    var c=$(this).val();
    var inputs = $(".adolescent");
    var points= [];
    for(var i = 0; i < inputs.length; i++){
     points.push($(inputs[i]).val());
    
  
}
 var num = Math.max.apply( Math, points );
   if(c<=num) {
        return true ;
    } else {
        
          alert('Counselling Number do not greater than footfall');
          $( "#VhsndAdolescentcOunselling" ).val('');
          return false;
    }
 

});
  
  $('#totalHide').hide();
  $('.submit').hide();
  $('.clock').hide();
  
 $("#showFootfall").prop('disabled', 'disabled');
 $("#hideFootfall").click( function(e) {
 $("#hideFootfall").prop('disabled', 'disabled');
 $('.clock').show();
 $("#hideFootfall").hide();
 $('#totalHide').show();
 $('#VhsndItFootfallNumber').hide();
 $('#VhsndHeightFootfallNumber').hide();
 $('#VhsndWeightFootfallNumber').hide();
 $('#VhsndIfaFootfallNumber').hide();
 $('#VhsndCalciumFootfallNumber').hide();
 $('#VhsndBpFootfallNumber').hide();
 $('#VhsndHbFootfallNumber').hide(); 
 $('#VhsndUrineFootfallNumber').hide();
 $('#VhsndAbdomenFootfallNumber').hide();
 $('#VhsndImmunisationFootfallNumber').hide();
 $('#VhsndGrowthFootfallNumber').hide();
 $('#VhsndCondomFootfallNumber').hide();
 $('#VhsndMalaNFootfallNumber').hide();
 $('#VhsndChayaFootfallNumber').hide();
 $('#VhsndAntaraFootfallNumber').hide();
 $('#VhsndTdFootfallNumber').hide();
 $('#VhsndIfaBlueFootfallNumber').hide();
 $("#showFootfall").removeAttr('disabled');
 $("#VhsndAncCounselling").prop('disabled', 'disabled');
 $("#VhsndChildCounselling").prop('disabled', 'disabled');
 $("#VhsndAdolescentcOunselling").prop('disabled', 'disabled');
  $("#VhsndFamilyCounselling").prop('disabled', 'disabled');
   });
    $("#showFootfall").click( function(e) {
   
 $('#VhsndItFootfallNumber').show();
 $('#VhsndHeightFootfallNumber').show();
 $('#VhsndWeightFootfallNumber').show();
 $('#VhsndIfaFootfallNumber').show();
 $('#VhsndCalciumFootfallNumber').show();
 $('#VhsndBpFootfallNumber').show();
 $('#VhsndHbFootfallNumber').show(); 
 $('#VhsndUrineFootfallNumber').show();
 $('#VhsndAbdomenFootfallNumber').show();
 $('#VhsndImmunisationFootfallNumber').show();
 $('#VhsndGrowthFootfallNumber').show();
 $('#VhsndCondomFootfallNumber').show();
 $('#VhsndMalaNFootfallNumber').show();
 $('#VhsndChayaFootfallNumber').show();
 $('#VhsndAntaraFootfallNumber').show();
 $('#VhsndTdFootfallNumber').show();
 $('#VhsndIfaBlueFootfallNumber').show();
 $("#hideFootfall").prop('disabled', 'disabled');
 $("#VhsndAncCounselling").removeAttr('disabled');
 $("#VhsndChildCounselling").removeAttr('disabled');
 $("#VhsndAdolescentcOunselling").removeAttr('disabled');
 $("#VhsndFamilyCounselling").removeAttr('disabled');
 $("#showFootfall").hide();
 $('.submit').show();
   });
   
//$(function() {
//   
//    $("#VhsndVisitDate").on("change",function(){
//        var selected = $(this).val();
//        alert(selected);
//    });
//});




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