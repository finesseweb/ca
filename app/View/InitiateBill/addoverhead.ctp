<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Overhead Details'), array('action' => 'listoverhead'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('OverheadDetail'); ?>
<fieldset>
<legend><?php echo __(' Overhead Details'); ?></legend>
<div class="row">
<?php

//print_r($res);

echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'--Select--',$ngo),'required'=>'required'))."</div>";


 ?>      
 <div class="col-sm-3"><div class="input select"><label for="NgoPeriodId">Grant Period</label>
<select name="data[OverheadDetail][period_id]" class="form-control" id="NgoPeriodId" required="required">
<option value="">Select Period</option>
<?php foreach ($period as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['periods']['id']?>"><?=date('d-m-Y',strtotime($value['periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['periods']['to_date']))?></option>
<?php } ?>
</select></div></div>
    
<?php 

echo "<div class='col-sm-3' style='display:none;'>".$this->Form->input('category',array('class' => 'form-control','options'=>array(),'multiple'=>'multiple'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('seleted cateogry',array('class' => 'form-control','readonly'=>'readonly'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('totalamount',array('class' => 'form-control','readonly'=>'readonly','label'=>'Total Amount'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('percentage',array('class' => 'form-control','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('overhead_amount',array('class' => 'form-control','type'=>'number','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('remarks',array('class' => 'form-control'))."</div>";


?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">


$(document).ready(function(){
$("#OverheadDetailOrganization").change(function(){
var c=$(this).val();
$('#NgoPeriodId').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>periods/getperiod/"+c,success:function(result){$("#NgoPeriodId").html(result);}});
$.ajax({url:"<?=SITE_PATH?>financialDetails/gettotal/"+c,success:function(result){$("#OverheadDetailTotalamount").val(result);}});
$.ajax({url:"<?=SITE_PATH?>financials/getcate/"+c,success:function(result){
 $("#OverheadDetailCategory").html(result);
 }});
$.ajax({url:"<?=SITE_PATH?>financials/getcatename/"+c,success:function(result){
 $("#OverheadDetailSeletedCateogry").val(result);
 }});
});


   $("#OverheadDetailPercentage").focusout(function() {
       var c=$(this).val();
       var u=   $("#OverheadDetailTotalamount").val();
      
        var total = u*c/100;
        $( "#OverheadDetailOverheadAmount" ).val(total);
    }); 
   
    
});
</script>
