<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Bill Number'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('InitiateBill'); ?>
<fieldset>
<legend><?php echo __(' Financial Details'); ?></legend>
<div class="row">
<?php

//print_r($res);

echo "<div class='col-sm-3'>".$this->Form->input('compnay',array('class' => 'form-control','options'=>array(''=>'--Select--',$company),'required'=>'required'))."</div>";


 ?>      
 <div class="col-sm-3"><div class="input select"><label for="NgoPeriodId">Financial Year</label>
         <select name="data[InitiateBill][period_id]" class="form-control" id="NgoPeriodId" required="required">
<option value="">Select Period</option>
<?php foreach ($period as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['periods']['id']?>"><?=date('d-m-Y',strtotime($value['periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['periods']['to_date']))?></option>
<?php } ?>
</select></div></div>
 <?php 
 

echo "<div class='col-sm-3'>".$this->Form->input('bill_number',array('class'=>'form-control','value'=>'001','required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('remarks',array('class'=>'form-control','type'=>'text'))."</div>";

?>
    
<?php /* ?><div class="col-sm-3"><div class="input select"><label for="NgoPeriodId">Reporting Period</label>
<select name="data[FinancialDetail][reporting_period]" class="form-control" id="NgoPeriodId">
<option value="">Select Period</option>
<?php //foreach ($reporting_periods as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['reporting_periods']['id']?>"><?=date('d-m-Y',strtotime($value['reporting_periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['reporting_periods']['to_date']))?></option>
<?php //} ?>
</select></div></div><?php */ ?>
   <?php 
//echo "<div class='col-sm-3'>".$this->Form->input('Reporting Period ',array('class' => 'form-control'))."</div>";  
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
       // alert(f);
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
                <div class="col-sm-3"><label>Frequency</label><input type="number" value="1" class="form-control resolved" id="frequency'+dt+'" name="data[FinancialDetail][frequency][]"></div>\
                <div class="col-sm-3"><label>Amount</label><input type="text" class="form-control" id="amount'+dt+'" name="data[FinancialDetail][amount][]" readonly> </div>\
                 <div class="col-sm-3"><label>Remarks</label><input type="text" class="form-control" id="remarks'+dt+'" name="data[FinancialDetail][remarks][]"> </div>\
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