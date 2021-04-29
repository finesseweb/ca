
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

echo $this->Form->input('id',array('class' => 'form-control'));
echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'--Select--',$ngo),'required'=>'required'))."</div>";


 ?>      
 <div class="col-sm-3"><div class="input select"><label for="NgoPeriodId">Grant Period</label>
<select name="data[OverheadDetail][period_id]" class="form-control" id="NgoPeriodId" required="required">
<option value="">Select Period</option>
<?php foreach ($period as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['periods']['id']?>" <?php if($this->request->data['OverheadDetail']['period_id']==$value['periods']['id']){ echo "selected"; }?>><?=date('d-m-Y',strtotime($value['periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['periods']['to_date']))?></option>
<?php } ?>
</select></div></div>
    
<div class="col-sm-3" style="display:none;"><div class="input select"><label for="OverheadDetailCategory">Category</label><input type="hidden" name="data[OverheadDetail][category]" value="" id="OverheadDetailCategory_">
        <select name="data[OverheadDetail][category][]" class="form-control b" multiple="multiple" id="OverheadDetailCategory">
<?php foreach ($cat as $key=>$value){
    //print_r($cat);
    $data='';
    $data.=$value;
    ?>
    <option value="<?=$key?>" selected="selected"><?=$value?></option>
<?php } ?>
</select></div></div>
<?php 
foreach ($cat as $key=>$value){
    //print_r($cat);
    $data='';
    $data.=$value;
}
//echo "<div class='col-sm-3'>".$this->Form->input('category',array('class' => 'form-control','options'=>array($cat),'multiple'=>'multiple','selected'=>'selected'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('seleted cateogry',array('class' => 'form-control','readonly'=>'readonly','value'=>$data))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('totalamount',array('class' => 'form-control','readonly'=>'readonly','label'=>'Total Amount'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('percentage',array('class' => 'form-control','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('overhead_amount',array('class' => 'form-control','type'=>'number','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('remarks',array('class' => 'form-control'))."</div>";
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
var d =$("#OverheadDetailOrganization").val();
$.ajax({url:"<?=SITE_PATH?>financials/getcatename/"+d,success:function(result){
 $("#OverheadDetailSeletedCateogry").val(result);
 }});

   $("#OverheadDetailPercentage").focusout(function() {
       var c=$(this).val();
       var u=   $("#OverheadDetailTotalamount").val();
      
        var total = u*c/100;
        $( "#OverheadDetailOverheadAmount" ).val(total);
    }); 
   
    
});
</script>
<script>
jQuery(document).ready( function () {
     var dt=1;
     var n=2
        $("#append").click( function(e) {
           
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                <div class="col-sm-3"><label>Category</label><select class="form-control" id="issue_category'+dt+'" name="data[FinancialDetail][cat_id][]"><option value="">Select</option></select></div>\
                <div class="col-sm-3"><label>Subcategory</label><select class="form-control"  id="issue_level'+dt+'" name="data[FinancialDetail][subcat_id][]"><option value="">Select</option></select></div>\
                <div class="col-sm-3"><label>Unit Cost</label><input type="number" class="form-control decisions" id="unit_cost'+dt+'" name="data[FinancialDetail][unit_cost][]"></div>\
                <div class="col-sm-3"><label>No of Unit</label><input type="number" value="1" class="calbsp form-control" id="unit_no'+dt+'" name="data[FinancialDetail][no_of_unit][]"></div>\
                <div class="col-sm-3"><label>Frequecy</label><input type="number" value="1" class="form-control resolved" id="frequency'+dt+'" name="data[FinancialDetail][frequecy][]"></div>\
                <div class="col-sm-3"><label>Amount</label><input type="text" class="form-control" id="amount'+dt+'" name="data[FinancialDetail][amount][]" readonly> </div>\
                <a href="#" class="remove_this btn btn-danger" id="'+n+'" style="margin-top:18px;">X</a>\
</div>');
    dt++;
    n++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
            
            jQuery(this).parent().remove();
          
        return false;
        });

$("#append").click( function() {
    var s =1;
    var st = dt-s;
$("#issue_category"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>financials/getcat/",success:function(result){$("#issue_category"+st).html(result);}});

$("#issue_level"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>subcategorys/getsubcate/",success:function(result){$("#issue_level"+st).html(result);}});

$("#issue_category"+st).change( function() {
//alert(st);
 var r=$(this).val();
$("#issue_level"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>subcategorys/getsubcat/"+r,success:function(result){$("#issue_level"+st).html(result);}});
});



$("#unit_cost"+st).focusout(function() {
       var c=$(this).val();
       var u=   $("#unit_no"+st).val();
       var f=   $("#frequency"+st).val();
        var total = u*c*f;
        $( "#amount"+st ).val(total);
    }); 
   $("#unit_no"+st).focusout(function() {
       var c=$(this).val();
       var u=   $("#unit_cost"+st).val();
       var f=   $("#frequency"+st).val();
        var total = u*c*f;
        $( "#amount"+st ).val(total);
    });
    
    $("#frequency"+st).focusout(function() {
       var c=$(this).val();
       var u=   $("#unit_cost"+st).val();
       var v=  $("#unit_no"+st).val();
        var total = u*v*c;
        $( "#amount"+st ).val(total);
    });

});
  });
$('#OverheadDetailCategory').on('focus', function(){
    $('#OverheadDetailCategory').prop('disabled', 'disabled');
    
});

$('body').on('click', function(){
    $('#OverheadDetailCategory').removeAttr('disabled');
    
});
 
</script>