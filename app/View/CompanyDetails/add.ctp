<style>
    input[type=checkbox]{clear:left;float:left;margin: 6px 31px 25px 1px;width:auto;}
    </style>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Company'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('CompanyDetail',array("enctype"=>"multipart/form-data")); ?>
<fieldset>
<legend><?php echo __('Company Information'); ?></legend>
<div class="row">
<?php

//print_r($res);

echo "<div class='col-sm-3'>".$this->Form->input('name_of_company',array('class' => 'form-control','label'=>'Name of Company'),array('required'=>'required'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('company_email',array('class' => 'form-control','type'=>'email'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('company_phone',array('class' => 'form-control','type'=>'number'))."</div>";

echo "<legend class='col-sm-12'>Register Address Details </legend>";
echo "<div class='col-sm-3'>".$this->Form->input('permanent_address',array('type'=>'text','class'=>'calbsp form-control','label'=>'House/Street'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('post_office_p',array('type'=>'text','class'=>'calbsp form-control','label'=>'Post Office'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district_p',array('class'=>'form-control','label'=>'City'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('state_p',array('class' => 'form-control','label'=>'State'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('country_p',array('class' => 'form-control','label'=>'Country'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('permanent_pincode',array('class' => 'form-control','label'=>'Pincode'))."</div>";

echo "<legend class='col-sm-12'><div class='col-sm-6'>Correspondence Address Details </div><div class='col-sm-4'>".$this->Form->input('same_as',array('type'=>'checkbox','label'=>'Same as Permanent Address'))."</div></legend>";
echo "<div class='col-sm-3'>".$this->Form->input('correspondence_address',array('type'=>'text','class'=>'calbsp form-control','label'=>'House/Street'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('post_office_c',array('type'=>'text','class'=>'calbsp form-control','label'=>'Post office'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district_c',array('class'=>'form-control','label'=>'City'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('state_c',array('class' => 'form-control','label'=>'State'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('country_c',array('class' => 'form-control','label'=>'Country'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('correspondence_pincode',array('class' => 'form-control','label'=>'Pincode'))."</div>";


//echo "<legend class='col-sm-12'>Registration Details </legend>";
//
//echo "<div class='col-sm-3'>".$this->Form->input('fcra_number',array('class' => 'form-control','label'=>'FCRA Number'),array('required'=>'required'))."</div>";
//
//echo "<div class='col-sm-3'>".$this->Form->input('fcra_registration_date',array('type'=>'text','class'=>'form-control','label'=>'FCRA Registration Date'))."</div>";
//
//echo "<div class='col-sm-3'>".$this->Form->input('fcra_registration_valid_till',array('type'=>'text','class' => 'form-control','label'=>'FCRA Registration Valid Till'))."</div>";
//echo " <div class='col-sm-3'>".$this->Form->input('society_registration_no',array('class' => 'form-control'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('society_registration_date',array('type'=> 'text','class' => 'form-control'))."</div>";
echo "<legend class='col-sm-12'> Bank Detail </legend>";
echo "<div class='col-sm-3'>".$this->Form->input('company_bank_ac_no',array('class' => 'form-control','label'=>'Company Bank Account No'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('name_of_bank',array('class' => 'form-control','type'=>'text','label'=>'Name of Bank'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('ifsc',array('class' => 'form-control','label'=>'IFSC'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('branch',array('type'=>'text','class'=>'calbsp form-control'))."</div>";
echo "<legend class='col-sm-12'>Other Details </legend>";
echo "<div class='col-sm-3'>".$this->Form->input('gst',array('class' => 'form-control','label'=>'GST Applicable','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('gst_number',array('class' => 'form-control','type'=>'text','label'=>'GST Number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('pan_number',array('type'=>'text','class' => 'form-control','label'=>'PAN Number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('digital_signature',array('type'=>'text','class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('company_logo',array('type'=>'file','class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('signature',array('type'=>'file','class' => 'form-control'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control','label'=>'Remarks'))."</div>";




?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;  var dp_cal3; var dp_cal4;  var dp_cal5; var dp_cal6;   
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('CompanyDetailFcraRegistrationDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('CompanyDetailFcraRegistrationValidTill'));
//dp_cal3  = new Epoch('epoch_popup','popup',document.getElementById('CompanyDetailAgreementSignDate'));
//dp_cal4  = new Epoch('epoch_popup','popup',document.getElementById('CompanyDetailProjectStartDate'));
//dp_cal5  = new Epoch('epoch_popup','popup',document.getElementById('CompanyDetailProjectEndDate'));
//dp_cal6  = new Epoch('epoch_popup','popup',document.getElementById('CompanyDetailSocietyRegistrationDate'));

 $("#CompanyDetailFcraRegistrationValidTill").click( function(e) {
 $('#CompanyDetailFcraRegistrationValidTill').attr('type', 'date');
   }); 
 
 
  $("#CompanyDetailFcraRegistrationDate").click( function(e) {
 $('#CompanyDetailFcraRegistrationDate').attr('type', 'date');
    }); 
 
 
  $("#CompanyDetailAgreementSignDate").click( function(e) {
 $('#CompanyDetailAgreementSignDate').attr('type', 'date');
    }); 
 
 
  $("#CompanyDetailProjectStartDate").click( function(e) {
 $('#CompanyDetailProjectStartDate').attr('type', 'date');
    }); 


$("#CompanyDetailProjectEndDate").click( function(e) {
 $('#CompanyDetailProjectEndDate').attr('type', 'date');
    }); 
    
    
    $("#CompanyDetailSocietyRegistrationDate").click( function(e) {
 $('#CompanyDetailSocietyRegistrationDate').attr('type', 'date');
    }); 

$(document).ready(function(){
$("#CompanyDetailAllocatedDistrict").change(function(){
var c=$(this).val();
$('#CompanyDetailBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#CompanyDetailBlock").html(result);}});
$('#CompanyDetailAllocatedBlockOne').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#CompanyDetailAllocatedBlockOne").html(result);}});
$('#CompanyDetailAllocatedBlockTwo').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#CompanyDetailAllocatedBlockTwo").html(result);}});

});

$('#CompanyDetailSameAs').click(function() {
     var a=$('#CompanyDetailPermanentAddress').val();
     var o=$('#CompanyDetailPostOfficeP').val();
     var d=$('#CompanyDetailDistrictP').val();
     var s=$('#CompanyDetailStateP').val();
     var p=$('#CompanyDetailPermanentPincode').val();
     var c=$('#CompanyDetailCountryP').val();
     if (this.checked) { 
    $("#CompanyDetailCorrespondenceAddress").val(a);
    $("#CompanyDetailPostOfficeC").val(o);
    $("#CompanyDetailDistrictC").val(d);
    $("#CompanyDetailStateC").val(s);
    $("#CompanyDetailCorrespondencePincode").val(p);
    $("#CompanyDetailCountryC").val('c');
     }
     else {
         
    $("#CompanyDetailCorrespondenceAddress").val('');
    $("#CompanyDetailPostOfficeC").val('');
    $("#CompanyDetailDistrictC").val('');
    $("#CompanyDetailStateC").val('');
    $("#CompanyDetailCorrespondencePincode").val('');
     $("#CompanyDetailCountryC").val('');
     }
     
});



$( "#CompanyDetailGst" ).change(function() {
    var c=$(this).val();
    if (c==='yes')
           {
                
             $("#CompanyDetailGstNumber").focus();
             $("#CompanyDetailGstNumber").prop('required', 'required');
               alert("Enter Your 10 GST Number");
           }
         else {     
         }  
    });
   

});
</script>