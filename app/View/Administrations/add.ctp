<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List of Administrator'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Administration'); ?>
<fieldset>
<legend><?php echo __(' Administrator'); ?></legend>
<div class="row">
<?php

//print_r($res);

echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select Organiaztion',$ngos)),array('required'=>'required'))."</div>";
?>
<div class="col-sm-3"><div class="input select"><label for="AdministrationFirstName">Name</label><select name="data[Administration][first_name]" class="form-control" id="AdministrationFirstName">
<option value="">Select User</option>
<?php
foreach($executives as $usr){
    
    echo "<option value=".$usr['User']['id'].">".$usr['User']['name'].' '.$usr['User']['last_name']."</option>";
}
?>
</select></div></div>
<?php
//echo "<div class='col-sm-3'>".$this->Form->input('first_name',array('class'=>'form-control'))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('last_name',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('designation',array('class' => 'form-control','options'=>array(''=>'Select Designation',$desig)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('gender',array('class' => 'form-control','options'=>array('male'=>'Male','female'=>'Female','transgender'=>'Transgender')))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('mobile',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('emailid',array('class' => 'form-control','label'=>' Email ID'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('remarks',array('class' => 'form-control','label'=>'Remarks'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('permanent_address',array('type'=>'text','class'=>'calbsp form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('same_as',array('type'=>'checkbox','label'=>'Same as Permanent Address'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('correspondence_address',array('type'=>'text','class'=>'calbsp form-control'))."</div>";




?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<!--<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;  var dp_cal3; var dp_cal4;  var dp_cal5; var dp_cal6;   
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('NgoFcraRegistrationDate'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('NgoFcraRegistrationValidTill'));
dp_cal3  = new Epoch('epoch_popup','popup',document.getElementById('NgoAgreementSignDate'));
dp_cal4  = new Epoch('epoch_popup','popup',document.getElementById('NgoProjectStartDate'));
dp_cal5  = new Epoch('epoch_popup','popup',document.getElementById('NgoProjectEndDate'));
dp_cal6  = new Epoch('epoch_popup','popup',document.getElementById('NgoSocietyRegistrationDate'));




$(document).ready(function(){
$("#NgoDistrict").change(function(){
var c=$(this).val();
$('#NgoBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#NgoBlock").html(result);}});

});
});
</script>-->

<script>
$('#AdministrationSameAs').click(function() {
    var c=$('#AdministrationPermanentAddress').val();
     var p=$('#NgoPermanentPincode').val();
     if (this.checked) { 
    $("#AdministrationCorrespondenceAddress").val(c);
    //$("#NgoCorrespondencePincode").val(p);
     }
     else {
         
    $("#AdministrationCorrespondenceAddress").val('');
    //$("#NgoCorrespondencePincode").val('');
     }
     
});    
</script>
    