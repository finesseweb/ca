<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Untied Fund Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Untiedfund'); ?>
<fieldset>
<legend><?php echo __('Edit Untied Fund Detail'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('id',array('class' => 'form-control'));
echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'Select District',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'Select Block',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'Select Panchayat',$panchayat)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('cc_name',array('type'=>'text','class'=>'calbsp form-control','label'=>'CC Name'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('member_num',array('class' => 'form-control','type'=>'text','label'=>'Member\'s Number'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('constitution_date',array('class' => 'form-control','type'=>'text','value'=>date('d-m-Y',strtotime($this->request->data['Untiedfund']['constitution_date']))))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('bank_account',array('class' => 'form-control'),array('required'=>'required'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('bank_name',array('type'=>'text','class'=>'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('ifsc',array('type'=>'text','class' => 'form-control','label'=>'IFSC'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('untied_funds_received',array('type'=>'text','class' => 'form-control'))."</div>";
?>
 <div class="col-sm-3"><div class="input select"><label for="UntiedfundfinacialId">Reporting Period</label>
<select name="data[Untiedfund][financial_year]" class="form-control" id="UntiedfundfinacialId">
<!--<option value="">Select Period</option>-->
<?php foreach ($reporting_periods as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['reporting_periods']['id']?>" <?php if($value['reporting_periods']['id']==$this->request->data['Untiedfund']['financial_year']) { echo "selected='selected'" ;}?> ><?=date('d-m-Y',strtotime($value['reporting_periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['reporting_periods']['to_date']))?></option>
<?php } ?>
</select></div></div>
<?php 
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

var dp_cal1;var dp_cal2;  var dp_cal3; var dp_cal4;  var dp_cal5; var dp_cal6;   
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('UntiedfundConstitutionDate'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('NgoFcraRegistrationValidTill'));


$(document).ready(function(){
$("#UntiedfundDistrict").change(function(){
var c=$(this).val();
$('#UntiedfundBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#UntiedfundBlock").html(result);}});

});


$("#UntiedfundBlock").change(function(){
var c=$(this).val();
$('#UntiedfundPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#UntiedfundPanchayat").html(result);}});

});


$("#FacilityDetailPanchayat").change(function(){
var c=$(this).val();
$('#FacilityDetailVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#FacilityDetailVillage").html(result);}});

});
});
</script>