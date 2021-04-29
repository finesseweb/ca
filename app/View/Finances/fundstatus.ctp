<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Financial Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Report'), array('action' => 'report'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Financestatus'); ?>
<fieldset>
<legend><?php echo __('Fund Status'); ?></legend>
<div class="row">
<?php

echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select Organization',$ngo)),array('required'=>'required'))."</div>";

?>
    <div class="col-sm-3"><div class="input select"><label for="NgoPeriodId">Grant Period <span style="color:red">*</span></label>
         <select name="data[Financestatus][period_id]" class="form-control" id="FinancePeriodId" required="required">
<option value="">Select Period</option>
<?php foreach ($period as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['periods']['id']?>"><?=date('d-m-Y',strtotime($value['periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['periods']['to_date']))?></option>
<?php } ?>
</select></div></div>
    <div class="col-sm-3"><div class="input select"><label for="NgoPeriodId">Reporting Period <span style="color:red">*</span></label>
<select name="data[Financestatus][reporting_period]" class="form-control" id="FinanceReportingId">
<option value="">Select Period</option>
<?php foreach ($reporting_periods as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['reporting_periods']['id']?>"><?=date('d-m-Y',strtotime($value['reporting_periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['reporting_periods']['to_date']))?></option>
<?php } ?>
</select></div></div>
    <?php
//echo "<legend class='col-sm-12'>Expenditure Status</legend>"; 
//
//echo "<div class='col-sm-3'>".$this->Form->input('cat_id',array('name'=>'data[Finance][cat_id][]','class'=>'form-control','label'=>'Category','options'=>array(''=>'--Select--',$cat),'required'=>'required'))."</div>";
//
//echo "<div class='col-sm-3'>".$this->Form->input('subcat_id',array('name'=>'data[Finance][subcat_id][]','class' => 'form-control','label'=>'Particulars/Activity','options'=>array(''=>'--Select--',$subcat),'required'=>'required'))."</div>";

//echo "<legend>Apporved Budget </legend>"; 
//echo "<div class='col-sm-2'>".$this->Form->input('unit_cost',array('name'=>'data[Finance][unit_cost][]','class' => 'form-control','required'=>'required','readonly'=>'readonly'))."</div>";

//echo "<div class='col-sm-2'>".$this->Form->input('no_of_unit',array('name'=>'data[Finance][no_of_unit][]','class' => 'form-control','label'=>'No of Unit','required'=>'required','readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('frequency',array('name'=>'data[Finance][frequency][]','class' => 'form-control','type'=>'text','readonly'=>'readonly'))."</div>";
//
//echo "<div class='col-sm-3'>".$this->Form->input('amount',array('name'=>'data[Finance][amount][]','class' => 'form-control','readonly'=>'readonly','required'=>'required'))."</div>"; 
//
//echo "<div class='col-sm-3'>".$this->Form->input('previous_expenditure',array('name'=>'data[Finance][previous_expenditure][]','type'=>'number','class' => 'form-control','required'=>'required'))."</div>";
//
//echo "<div class='col-sm-3'>".$this->Form->input('current_expediture',array('name'=>'data[Finance][current_expediture][]','type'=>'number','class' => 'form-control','required'=>'required'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('cumulative_expenditure',array('name'=>'data[Finance][cumulative_expenditure][]','class' => 'form-control','required'=>'required','readonly'=>'readonly'))."</div>"; 
//echo "<div class='col-sm-2'>".$this->Form->input('variane',array('name'=>'data[Finance][variane][]','class' => 'form-control','required'=>'required','readonly'=>'readonly'))."</div>";
//
//echo "<div class='col-sm-2'>".$this->Form->input('variance_percentage',array('name'=>'data[Finance][variance_percentage][]','class' => 'form-control','required'=>'required','readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('next_quater_projection',array('name'=>'data[Finance][next_quater_projection][]','type'=>'number','class' => 'form-control','label'=>'Estimated Budget For Next Quater','readonly'=>'readonly'))."</div>";
//
//echo "<div class='col-sm-5'>".$this->Form->input('reason_variance',array('name'=>'data[Finance][reason_variance][]','class' => 'form-control','label'=>'Reason for Variance'))."</div>"; 
//echo "<div class='col-sm-12 field_div'></div>";
//echo "<div class='col-sm-12'><div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-3'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left: 95%;'>+</a></div></div>";

//echo "<legend class='col-sm-12'>Projection</legend>"; 
echo "<div class='col-sm-3'>".$this->Form->input('opening_balance',array('type'=>'number','class' => 'form-control','required'=>'required'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('next_quater_projection',array('type'=>'number','class' => 'form-control','label'=>'Projection For Next Quater'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('grant_received_from_pfi',array('type'=>'number','class' => 'form-control','label'=>'Grant Received From PFI','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('interest_earned',array('class' => 'form-control','required'=>'required'))."</div>"; 
echo "<div class='col-sm-3'>".$this->Form->input('closing_fund_balance',array('type'=>'number','class' => 'form-control','readonly'=>'readonly'))."</div>"; 

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
 $("#FinanceCatId").change(function(){
  var c=$(this).val();
  $('#FinanceSubcatId').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>subcategorys/getsubcat/"+c,success:function(result){$("#FinanceSubcatId").html(result);}});

  
 } );  
    
    
$("#FinanceReportingId").change(function(){
var o =$("#FinancestatusOrganization").val();  
var p =$("#FinancePeriodId").val(); 
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>finances/getclosingbalance/?rid="+c+"&gid="+o+"&pid="+p,success:function(result){
        
            $("#FinancestatusClosingFundBalance").val(result);}});
   
$.ajax({url:"<?=SITE_PATH?>finances/getopenigbalance/?rid="+c+"&gid="+o+"&pid="+p,success:function(result){
        
            $("#FinancestatusOpeningBalance").val(result);}});
    
 $.ajax({url:"<?=SITE_PATH?>financialDetails/getgrantbalance/?gid="+o+"&pid="+p,success:function(result){
        
            $("#FinancestatusGrantReceivedFromPfi").val(result);}});
   

});


//$( "#FinanceAmount" ).click(function() {
//   
//  var u=   $("#FinanceUnitCost").val();
//  var v=  $("#FinanceNoOfUnit").val();
//  var f=   $("#FinanceFrequecy").val();
//   var total = u*v*f;
//   $( "#FinanceAmount" ).val(total);
//   $("#FinanceAmount").prop('readonly', 'readonly');
//    });
   $("#FinanceCurrentExpediture").focusout(function() {
       var c=$(this).val();
       var u=   $("#FinancePreviousExpenditure").val();
       var f=   $("#FinanceAmount").val();
      
        var total = +u + +c;
        $( "#FinanceCumulativeExpenditure" ).val(total);
        var subtotal = f-total;
         $( "#FinanceVariane" ).val(subtotal);
         $( "#FinanceNextQuaterProjection" ).val(subtotal);
         var percent = subtotal/f*100;
          $( "#FinanceVariancePercentage" ).val(Math.round(percent));
         
        
        
    }); 
   $("#FinancePreviousExpenditure").focusout(function() {
       var c=$(this).val();
       var u=   $("#FinanceCurrentExpediture").val();
        var f=   $("#FinanceAmount").val();
         var total = +u + +c;
        $( "#FinanceCumulativeExpenditure" ).val(total);
        
        var subtotal = f-total;
         $( "#FinanceVariane" ).val(subtotal);
         $( "#FinanceNextQuaterProjection" ).val(subtotal);
         
         var percent = subtotal/f*100;
          $( "#FinanceVariancePercentage" ).val(Math.round(percent));
         
    });
    
    $("#FinanceFrequecy").focusout(function() {
       var c=$(this).val();
       var u=   $("#FinanceUnitCost").val();
       var v=  $("#FinanceNoOfUnit").val();
        var total = u*v*c;
        $( "#FinanceAmount" ).val(total);
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
                <div class="col-sm-3"><label>Category</label><select class="form-control" id="FinanceCatId'+dt+'" name="data[Finance][cat_id][]"><option value="">Select</option></select></div>\
                <div class="col-sm-3"><label>Particulars/Activity</label><select class="form-control"  id="FinanceSubcatId'+dt+'" name="data[Finance][subcat_id][]"><option value="">Select</option></select></div>\
                <div class="col-sm-2"><label>Unit Cost</label><input type="number" class="form-control decisions" id="unit_cost'+dt+'" name="data[Finance][unit_cost][]" readonly></div>\
                <div class="col-sm-2"><label>No of Unit</label><input type="number" class="calbsp form-control" id="unit_no'+dt+'" name="data[Finance][no_of_unit][]" readonly></div>\
                <div class="col-sm-2"><label>Frequency</label><input type="number"  class="form-control resolved" id="frequency'+dt+'" name="data[Finance][frequency][]" readonly></div>\
                <div class="col-sm-3"><label>Amount</label><input type="text" class="form-control" id="amount'+dt+'" name="data[Finance][amount][]" readonly> </div>\
                <div class="col-sm-3"><label>Previous Expenditure</label><input type="text" class="form-control" id="previous_expenditure'+dt+'" name="data[Finance][previous_expenditure][]"> </div>\
                <div class="col-sm-3"><label>Current Expediture</label><input type="text" class="form-control" id="current_expediture'+dt+'" name="data[Finance][current_expediture][]"> </div>\
                <div class="col-sm-3"><label>Cumulative Expenditure</label><input type="text" class="form-control" id="cumulative_expenditure'+dt+'" name="data[Finance][cumulative_expenditure][]" readonly> </div>\
                <div class="col-sm-2"><label>Variane</label><input type="text" class="form-control" id="variane'+dt+'" name="data[Finance][variane][]" readonly> </div>\
                <div class="col-sm-2"><label>Variance Percentage</label><input type="text" class="form-control" id="variance_percentage'+dt+'" name="data[Finance][variance_percentage][]" readonly> </div>\
                <div class="col-sm-3"><label>Estimated Budget For Next Quater</label><input type="text" class="form-control" id="next_quater_projection'+dt+'" name="data[Finance][next_quater_projection][]" readonly> </div>\
                <div class="col-sm-4"><label>Reason for Variance</label><input type="text" class="form-control" id="reason_variance'+dt+'" name="data[Finance][reason_variance][]"> </div>\
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
$("#FinanceCatId"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>financials/getcat/",success:function(result){$("#FinanceCatId"+st).html(result);}});

$("#FinanceSubcatId"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>subcategorys/getsubcate/",success:function(result){$("#FinanceSubcatId"+st).html(result);}});

$("#FinanceCatId"+st).change( function() {
//alert(st);
 var r=$(this).val();
$("#FinanceSubcatId"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>subcategorys/getsubcat/"+r,success:function(result){$("#FinanceSubcatId"+st).html(result);}});
});

$("#FinanceSubcatId"+st).change( function() {
//alert(st);
 var c=$(this).val();
 var o =$("#FinanceOrganization").val();
 //alert(o);
 
 $.ajax({url:"<?=SITE_PATH?>financialDetails/getUnitCost/?cat_id="+c+"&gid="+o,success:function(result){
        
            $("#unit_cost"+st).val(result);}});
    $.ajax({url:"<?=SITE_PATH?>financialDetails/getUnits/?cat_id="+c+"&gid="+o,success:function(result){
        
            $("#unit_no"+st).val(result);}});
$.ajax({url:"<?=SITE_PATH?>financialDetails/getFrequecy/?cat_id="+c+"&gid="+o,success:function(result){
        
            $("#frequency"+st).val(result);}});

$.ajax({url:"<?=SITE_PATH?>financialDetails/getDetails/?cat_id="+c+"&gid="+o,success:function(result){
        
            $("#amount"+st).val(result);}});
});


$("#current_expediture"+st).focusout(function() {
       var c=$(this).val();
       var u=   $("#previous_expenditure"+st).val();
       var f=   $("#amount"+st).val();
      
        var total = +u + +c;
        $( "#cumulative_expenditure"+st).val(total);
        var subtotal = f-total;
         $( "#variane"+st).val(subtotal);
         $( "#next_quater_projection"+st).val(subtotal);
         var percent = subtotal/f*100;
          $( "#variance_percentage"+st).val(Math.round(percent));
         
        
        
    }); 
    
  $("#previous_expenditure"+st).focusout(function() {
       var c=$(this).val();
       var u=   $("#current_expediture"+st).val();
        var f=   $("#amount"+st).val();
         var total = +u + +c;
        $( "#cumulative_expenditure"+st ).val(total);
        
        var subtotal = f-total;
         $( "#variane"+st).val(subtotal);
         $( "#next_quater_projection"+st).val(subtotal);
         
         var percent = subtotal/f*100;
          $( "#variance_percentage"+st).val(Math.round(percent));
         
    });
    
    $("#frequency"+st).focusout(function() {
       var c=$(this).val();
       var u=   $("#unit_cost"+st).val();
       var v=  $("#unit_no"+st).val();
        var total = u*v*c;
        $( "#amount"+st).val(total);
    });

});
  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('VhsncMeetingMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('VhsncMeetingIssueResolvedDate'));
 
// $("#VhsncMeetingMeetingDate").click( function(e) {
// $('#VhsncMeetingMeetingDate').attr('type', 'date');
//    });
    
  //$("#VhsncMeetingIssueResolvedDate").click( function(e) {
 //$('#VhsncMeetingIssueResolvedDate').attr('type', 'date');
   // });  
        
    

</script>