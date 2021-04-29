<style>
    input[type=checkbox]{clear:left;float:left;margin: 6px 31px 25px 1px;width:auto;}
    </style>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Clients'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('ClientDetail',array("enctype"=>"multipart/form-data")); ?>
<fieldset>
<legend><?php echo __('Client Information'); ?></legend>
<div class="row">
<?php

//print_r($res);

echo "<div class='col-sm-3'>".$this->Form->input('name_of_client',array('class' => 'form-control','label'=>'Name of Client'),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('company_name',array('type'=>'text','class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('client_email',array('class' => 'form-control','type'=>'email'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('client_phone',array('class' => 'form-control','type'=>'number'))."</div>";

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
//echo "<legend class='col-sm-12'> Bank Detail </legend>";
//echo "<div class='col-sm-3'>".$this->Form->input('client_bank_ac_no',array('class' => 'form-control','label'=>'Company Bank Account No'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('name_of_bank',array('class' => 'form-control','type'=>'text','label'=>'Name of Bank'))."</div>";
//
//echo "<div class='col-sm-3'>".$this->Form->input('ifsc',array('class' => 'form-control','label'=>'IFSC'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('branch',array('type'=>'text','class'=>'calbsp form-control'))."</div>";
echo "<legend class='col-sm-12'>Other Details </legend>";
//echo "<div class='col-sm-3'>".$this->Form->input('gst',array('class' => 'form-control','label'=>'GST Applicable','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('gst_number',array('class' => 'form-control','type'=>'text','label'=>'GST Number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('pan_number',array('type'=>'text','class' => 'form-control','label'=>'PAN Number'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('client_logo',array('type'=>'file','class' => 'form-control'))."</div>";
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
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('ClientDetailFcraRegistrationDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('ClientDetailFcraRegistrationValidTill'));
//dp_cal3  = new Epoch('epoch_popup','popup',document.getElementById('ClientDetailAgreementSignDate'));
//dp_cal4  = new Epoch('epoch_popup','popup',document.getElementById('ClientDetailProjectStartDate'));
//dp_cal5  = new Epoch('epoch_popup','popup',document.getElementById('ClientDetailProjectEndDate'));
//dp_cal6  = new Epoch('epoch_popup','popup',document.getElementById('ClientDetailSocietyRegistrationDate'));

 $("#ClientDetailFcraRegistrationValidTill").click( function(e) {
 $('#ClientDetailFcraRegistrationValidTill').attr('type', 'date');
   }); 
 
 
  $("#ClientDetailFcraRegistrationDate").click( function(e) {
 $('#ClientDetailFcraRegistrationDate').attr('type', 'date');
    }); 
 
 
  $("#ClientDetailAgreementSignDate").click( function(e) {
 $('#ClientDetailAgreementSignDate').attr('type', 'date');
    }); 
 
 
  $("#ClientDetailProjectStartDate").click( function(e) {
 $('#ClientDetailProjectStartDate').attr('type', 'date');
    }); 


$("#ClientDetailProjectEndDate").click( function(e) {
 $('#ClientDetailProjectEndDate').attr('type', 'date');
    }); 
    
    
    $("#ClientDetailSocietyRegistrationDate").click( function(e) {
 $('#ClientDetailSocietyRegistrationDate').attr('type', 'date');
    }); 

$(document).ready(function(){
$("#ClientDetailAllocatedDistrict").change(function(){
var c=$(this).val();
$('#ClientDetailBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#ClientDetailBlock").html(result);}});
$('#ClientDetailAllocatedBlockOne').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#ClientDetailAllocatedBlockOne").html(result);}});
$('#ClientDetailAllocatedBlockTwo').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#ClientDetailAllocatedBlockTwo").html(result);}});

});

$('#ClientDetailSameAs').click(function() {
     var a=$('#ClientDetailPermanentAddress').val();
     var o=$('#ClientDetailPostOfficeP').val();
     var d=$('#ClientDetailDistrictP').val();
     var s=$('#ClientDetailStateP').val();
     var p=$('#ClientDetailPermanentPincode').val();
     var c=$('#ClientDetailCountryP').val();
     if (this.checked) { 
    $("#ClientDetailCorrespondenceAddress").val(a);
    $("#ClientDetailPostOfficeC").val(o);
    $("#ClientDetailDistrictC").val(d);
    $("#ClientDetailStateC").val(s);
    $("#ClientDetailCorrespondencePincode").val(p);
    $("#ClientDetailCountryC").val(c);
     }
     else {
         
    $("#ClientDetailCorrespondenceAddress").val('');
    $("#ClientDetailPostOfficeC").val('');
    $("#ClientDetailDistrictC").val('');
    $("#ClientDetailStateC").val('');
    $("#ClientDetailCorrespondencePincode").val('');
     }
     
});



$( "#ClientDetailMobileOne" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
              // $("#ClientDetailMobileOne").focus();
               setTimeout(function(){$('#ClientDetailMobileOne').focus();}, 2);
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
                setTimeout(function(){$('#ClientDetailMobileOne').focus();}, 2);
                return false;  
             
         }  
    });
    $( "#ClientDetailMobileTwo" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
              // $("#ClientDetailMobileOne").focus();
               setTimeout(function(){$('#ClientDetailMobileTwo').focus();}, 2);
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
                setTimeout(function(){$('#ClientDetailMobileTwo').focus();}, 2);
                return false;  
             
         }  
    });

});
</script>