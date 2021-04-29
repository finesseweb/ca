 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List CC Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Bpccc'); ?>
<fieldset>
<legend><?php echo __(' Cluster coordinator'); ?></legend>
<div class="row">
<?php

//print_r($res);

echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
?>
<div class="col-sm-3"><div class="input select"><label for="BpcccFirstName">Name<span class="after">*</span></label><select name="data[Bpccc][first_name]" class="form-control" id="BpcccFirstName" required="required">
<option value="">Select User</option>
<?php
foreach($executives as $usr){
    
    echo "<option value=".$usr['User']['id'].">".$usr['User']['name'].' '.$usr['User']['last_name']."</option>";
}
?>
</select></div></div>
<?php
//echo "<div class='col-sm-3'>".$this->Form->input('first_name',array('class' => 'form-control'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('last_name',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('designation',array('class' => 'form-control','value'=>'CC','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('gender',array('class' => 'form-control','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('mobile',array('class' => 'form-control','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('email_id',array('class' => 'form-control','type'=>'text','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('address',array('class' => 'form-control','type'=>'text'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('allocated_district',array('class'=>'form-control','options'=>array(''=>'Select District',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('allocated_block',array('class' => 'form-control','options'=>array(''=>'Select Block',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('allocated_panchayat',array('class' => 'form-control','multiple'=>'multiple','options'=>array($panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('allocated_village',array('class' => 'form-control','options'=>array(''=>'--Select--')))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('date_of_joining',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date of Joining'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('contract_end_date',array('class' => 'form-control','type'=>'text'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('aphc_no',array('class' => 'form-control','label'=>'No of APHC'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('hsc_no',array('class' => 'form-control','label'=>'No of HSC'),array('required'=>'required'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('awc_no',array('type'=>'text','class'=>'form-control','label'=>'No of AWC'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('aww_no',array('type'=>'text','class' => 'form-control','label'=>'No of AWW'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('vhsnd_no',array('type'=>'text','class' => 'form-control','label'=>'No of VHSND'))."</div>";
echo " <div class='col-sm-3'>".$this->Form->input('anm_no',array('class' => 'form-control','label'=>'No of ANM'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('asha_facilitators_no',array('type'=> 'text','class' => 'form-control','label'=>'No of ASHA Facilitators'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('asha_no',array('class' => 'form-control','label'=>'No of ASHA '))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('remarks',array('class' => 'form-control','type'=>'text'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";




?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('BpcccDateOfJoining'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('BpcccContractEndDate'));



$(document).ready(function(){
    
$("#BpcccOrganization").change(function(){
var c=$(this).val();
$('#BpcccAllocatedDistrict').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getngodistrict/"+c,success:function(result){$("#BpcccAllocatedDistrict").html(result);}});

});

$("#BpcccAllocatedDistrict").change(function(){
var c=$(this).val();
var o= $("#BpcccOrganization").val();
$('#BpcccAllocatedBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getblocksngo/?c="+c+"&nid="+o,success:function(result){$("#BpcccAllocatedBlock").html(result);}});

});



$("#BpcccAllocatedBlock").change(function(){
var c=$(this).val();
$('#BpcccAllocatedPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){
$("#BpcccAllocatedPanchayat").empty();
 $("#BpcccAllocatedPanchayat").html(result);
$("#BpcccAllocatedPanchayat").multiselect('destroy');
$('#BpcccAllocatedPanchayat').multiselect({
  nonSelectedText: 'Select Panchayat',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});

}});

});


$("#BpcccAllocatedPanchayat").change(function(){
var c=$(this).val();
$('#BpcccAllocatedVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#BpcccAllocatedVillage").html(result);}});

});
});
</script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
$("#BpcccFirstName").change(function(){
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>users/getUserdetails/"+c,success:function(result){$("#BpcccGender").val(result);}});
$.ajax({url:"<?=SITE_PATH?>users/getUserMobile/"+c,success:function(result){$("#BpcccMobile").val(result);}});
$.ajax({url:"<?=SITE_PATH?>users/getUserEmail/"+c,success:function(result){$("#BpcccEmailId").val(result);}});


});

 $('#BpcccAllocatedPanchayat').multiselect({
  nonSelectedText: 'Select Panchayat',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});
});

 $("#BpcccDateOfJoining").click( function(e) {
 $('#BpcccDateOfJoining').attr('type', 'date');
    });

$("#BpcccContractEndDate").click( function(e) {
 $('#BpcccContractEndDate').attr('type', 'date');
    });

$("#BpcccContractEndDate").change( function(e) {
   var startDate = $("#BpcccDateOfJoining").val();
       var endDate = $("#BpcccContractEndDate").val();
       if (startDate != '' && endDate !='') {
           if (Date.parse(startDate) > Date.parse(endDate)) {
               $("txttodate").val('');
               alert("Contract End Date should not be less than Date of Joining");
           }
       }
       return false;
    });  

</script>
