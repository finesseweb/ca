<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Financial Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('FinancialDetail'); ?>
<fieldset>
<legend><?php echo __(' Financial Details'); ?></legend>
<div class="row">
<?php

//print_r($this->request->data['FinancialDetail']['period_id']);
//die();
echo $this->Form->input('id',array('class' => 'form-control'));
echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select Organization',$ngo)),array('required'=>'required'))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('cat_id',array('class'=>'form-control','label'=>'Category','options'=>array(''=>'Select Sategory',$cat)))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('subcat_id',array('class' => 'form-control','label'=>'Subcategory','options'=>array(''=>'Select Subcategory',$subcat)))."</div>"
  ?>      
 <div class="col-sm-3"><div class="input select"><label for="NgoPeriodId">Grant Period</label>
<select name="data[FinancialDetail][period_id]" class="form-control" id="NgoPeriodId">
<option value="">Select Period</option>
<?php foreach ($period as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['periods']['id']?>" <?php if($this->request->data['FinancialDetail']['period_id']==$value['periods']['id']) { echo "selected" ;} ?>><?=date('d-m-Y',strtotime($value['periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['periods']['to_date']))?></option>
<?php } ?>
</select></div></div>
 <?php

 
echo "<legend class='col-sm-12'>Apporved Budget </legend>"; 
echo "<div class='col-sm-3'>".$this->Form->input('cat_id',array('class'=>'form-control','label'=>'Category','options'=>array(''=>'Select Sategory',$cat)))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('subcat_id',array('class' => 'form-control','label'=>'Subcategory','options'=>array(''=>'Select Subcategory',$subcat)))."</div>";
 
echo "<div class='col-sm-3'>".$this->Form->input('unit_cost',array('class' => 'form-control','type'=>'number'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('no_of_unit',array('class' => 'form-control','label'=>'No of Unit'))."</div><div class='col-sm-3'>".$this->Form->input('frequency',array('class' => 'form-control','type'=>'text'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('amount',array('class' => 'form-control','readonly'=>'readonly'))."</div>"; 
echo "<div class='col-sm-3'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control'))."</div>";
   
?>
 
<!--   <div class="col-sm-3"><div class="input select"><label for="NgoPeriodId">Reporting Period</label>
<select name="data[FinancialDetail][reporting_period]" class="form-control" id="NgoPeriodId">
<option value="">Select Period</option>
<?php foreach ($reporting_periods as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['reporting_periods']['id']?>" <?php if($this->request->data['FinancialDetail']['period_id']==$value['reporting_periods']['id']) { echo "selected" ;} ?>><?=date('d-m-Y',strtotime($value['reporting_periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['reporting_periods']['to_date']))?></option>
<?php } ?>
</select></div></div> -->
    <?php
//echo "<div class='col-sm-3'>".$this->Form->input('grant_release',array('class'=>'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('previous_expenditure',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('opening_balance',array('type'=>'text','class'=>'calbsp form-control'))."</div>";







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
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('NgoFcraRegistrationDate'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('NgoFcraRegistrationValidTill'));
dp_cal3  = new Epoch('epoch_popup','popup',document.getElementById('NgoAgreementSignDate'));
dp_cal4  = new Epoch('epoch_popup','popup',document.getElementById('NgoProjectStartDate'));
dp_cal5  = new Epoch('epoch_popup','popup',document.getElementById('NgoProjectEndDate'));
dp_cal6  = new Epoch('epoch_popup','popup',document.getElementById('NgoSocietyRegistrationDate'));




$(document).ready(function(){
$("#FinancialDetailCatId").change(function(){
var c=$(this).val();
$('#FinancialDetailSubcatId').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>subcategorys/getsubcat/"+c,success:function(result){$("#FinancialDetailSubcatId").html(result);}});

});

//$( "#FinancialDetailAmount" ).click(function() {
//   
//  var u=   $("#FinancialDetailUnitCost").val();
//  var v=  $("#FinancialDetailNoOfUnit").val();
//  var f=   $("#FinancialDetailFrequecy").val();
//   var total = u*v*f;
//   $( "#FinancialDetailAmount" ).val(total);
//   $("#FinancialDetailAmount").prop('readonly', 'readonly');
//    });
    
    $("#FinancialDetailUnitCost").focusout(function() {
       var c=$(this).val();
       var u=   $("#FinancialDetailNoOfUnit").val();
       var f=   $("#FinancialDetailFrequency").val();
        var total = u*c*f;
        $( "#FinancialDetailAmount" ).val(total);
    }); 
   $("#FinancialDetailNoOfUnit").focusout(function() {
       var c=$(this).val();
       var u=   $("#FinancialDetailUnitCost").val();
       var f=   $("#FinancialDetailFrequency").val();
        var total = u*c*f;
        $( "#FinancialDetailAmount" ).val(total);
    });
    
    $("#FinancialDetailFrequency").focusout(function() {
       var c=$(this).val();
       var u=   $("#FinancialDetailUnitCost").val();
       var v=  $("#FinancialDetailNoOfUnit").val();
        var total = u*v*c;
        $( "#FinancialDetailAmount" ).val(total);
    });
    
});
</script>