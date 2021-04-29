<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
 $sessionrole=$this->Session->read('User.subrole');     
?>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Expenditure Details'), array('controller'=>'vhsncUntiedfunds','action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('VhsncUntiedfund'); ?>
<fieldset>
<legend><?php echo __(' Expenditure Detail'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
///echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'--Select--')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'--Select--',$ward)))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('vhsnc_name',array('class'=>'calbsp form-control','label'=>'VHSNC Name','options'=>array(''=>'--Select--')))."</div>";
echo  $this->Form->input('vhsnc_id',array('type'=>'hidden','class'=>'calbsp form-control'));
?>
<!--    <div class="col-sm-3"><div class="input select"><label for="VhsncUntiedfundfinacialId">Financial Years</label>
<select name="data[VhsncUntiedfund][financial_year]" class="form-control" id="UntiedfundfinacialId">
<option value="">Select Period</option>
<?php foreach ($reporting_periods as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['reporting_periods']['id']?>"><?=date('d-m-Y',strtotime($value['reporting_periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['reporting_periods']['to_date']))?></option>
<?php } ?>
</select></div></div>-->
    <?php 
//echo "<div class='col-sm-3'>".$this->Form->input('financial_year',array('class' => 'form-control','type'=>'text'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_funds_recieved',array('class' => 'form-control','type'=>'text','label'=>'VHSNC Funds Recieved'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('amount_recieved_from_other_source',array('class' => 'form-control'),array('required'=>'required'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('amount_received_from',array('type'=>'text','class' => 'form-control','label'=>'Amount Received From'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('payment_mode',array('class' => 'form-control','label'=>'Payment Mode','options'=>array('cash'=>'Cash','check/dd'=>'Check/DD','online payment'=>'Online Payment')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('payment_received_date',array('type'=>'text','class' => 'form-control','label'=>'Payment Received Date'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('bank_interest_credit',array('type'=>'text','class' => 'form-control','label'=>'Interest Credited by Bank '))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('bank_charge_deduct',array('type'=>'text','class' => 'form-control','label'=>'Charge Deducted by Bank'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('total_expenditure',array('type'=>'text','class' => 'form-control','label'=>'Total Expenditure (Previous)','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('balance_check_date',array('type'=>'text','class'=>'form-control','value'=>date('d-m-Y'),'readonly'=>'readonly','label'=>'Balance as on Date'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('balance_on_date',array('type'=>'text','class' => 'form-control','label'=>'Balance Amount as on Date','readonly'=>'readonly'))."</div>";

?>
 
<?php 
echo "<legend class='col-sm-12'>Expenditure Details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-3'>".$this->Form->input('expenditure_date',array('type'=>'text','class'=>'calbsp form-control','name'=>'data[VhsncUntiedfund][expenditure_date][]'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('expenditure_details',array('class' => 'form-control','name'=>'data[VhsncUntiedfund][expenditure_details][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('expenditure_amount',array('class' => 'form-control quantity','type'=>'number','name'=>'data[VhsncUntiedfund][expenditure_amount][]','id'=>'VhsncUntiedfundExpenditureAmount1'))."</div>";
echo "</div></div>";
echo "<div class='col-sm-12 field_div'></div>";
echo "<div class='col-sm-12'><div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-3'>".$this->Form->input('current_total_amount',array('type'=>'text','class' => 'form-control total','value'=>'0','label'=>'Total Amount','readonly'=>'readonly'))."</div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;'>+</a>  <a href='#sum' id='sum' class='btn btn-primary' name='append' style='margin-top: 18px;'>Total Sum</a></div>";


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
  <?php if($sessionrole!='CC' || $sessionrole!='BPC' ) { ?>
$("#VhsncUntiedfundDistrict").change(function(){
var c=$(this).val();
$('#VhsncUntiedfundBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#VhsncUntiedfundBlock").html(result);}});

});

<?php } ?>
<?php if($sessionrole!='CC') { ?>
$("#VhsncUntiedfundBlock").change(function(){
var c=$(this).val();
$('#VhsncUntiedfundPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#VhsncUntiedfundPanchayat").html(result);}});

});
  <?php } ?>

$("#VhsncUntiedfundPanchayat").change(function(){
var c=$(this).val();
$('#VhsncUntiedfundVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#VhsncUntiedfundVillage").html(result);}});
});
  
//$("#VhsncUntiedfundVillage").change(function(){
//var c=$(this).val();
//$('#VhsncUntiedfundWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#VhsncUntiedfundWard").html(result);}});
//
//});

$("#VhsncUntiedfundPanchayat").change(function(){
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getpvhsncId/"+c,success:function(result){$("#VhsncUntiedfundVhsncId").val(result);}});
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getpvhsncn/"+c,success:function(result){$("#VhsncUntiedfundVhsncName").html(result);}});

});


});
</script>
<script>
jQuery(document).ready( function () {
     var dt=2;
        $("#append").click( function(e) {
           
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                <div class="col-sm-3"><label>Expenditure Date</label><input class="calbsp form-control" type="date" id="induction_training_date'+dt+'" name="data[VhsncUntiedfund][expenditure_date][]"></div>\
                <div class="col-sm-3"><label>Expenditure Details</label><input class="calbsp form-control" type="text" id="induction_training_date" name="data[VhsncUntiedfund][expenditure_details][]"></div>\
                <div class="col-sm-3"><label>Expenditure Amount</label><input type="number" class="form-control quantity" id="VhsncUntiedfundExpenditureAmount'+dt+'" name="data[VhsncUntiedfund][expenditure_amount][]"></div>\
                 <a href="#" class="remove_this btn btn-danger" style="margin-top:18px">X</a>\
            </div>');
    dt++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
       
       dt--;
      
       var qua = $('#VhsncUntiedfundExpenditureAmount'+dt).val();
       var total = parseInt($('#VhsncUntiedfundCurrentTotalAmount').val());
     //$('.total').val(quantity);
     if(dt===2) {
         $('#VhsncUntiedfundCurrentTotalAmount').val('0');
        } else {
       $('#VhsncUntiedfundCurrentTotalAmount').val(total-qua);
   }
//        alert(qua);
        
         jQuery(this).parent().remove();
         i--;
        return false;
        });
//    $("input[type=submit]").click(function(e) {
//      e.preventDefault();
//      $(this).next("[name=textbox]")
//      .val(
//        $.map($(".field_div :text"), function(el) {
//          return el.value
//        }).join(",\n")
//      )
//    })
$("#append").click( function() {
$('.desig').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>designations/getdesig/",success:function(result){$(".desig").html(result);}});
});
  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('VhsncAfcInductionTrainingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('VhsncAfcRefresherDate'));
 
 $("#VhsncUntiedfundExpenditureDate").click( function(e) {
 $('#VhsncUntiedfundExpenditureDate').attr('type', 'date');
    });
    
//  $("#VhsncUntiedfundBalanceCheckDate").click( function(e) {
// $('#VhsncUntiedfundBalanceCheckDate').attr('type', 'date');
//    });
    
    
    $("#VhsncUntiedfundPaymentReceivedDate").click( function(e) {
 $('#VhsncUntiedfundPaymentReceivedDate').attr('type', 'date');
    });
    
  
  
//  $(".quantity").keyup( function() {    
//     // alert('hii');
//  $('.quantity').on('input', function(){
//    var quantity = parseInt($(this).val());
//   // $('.total').val(quantity);
//     console.log(quantity);
//})  ;
//  });
//  $("#append").click( function() {
//  jQuery(document).keyup('.exp', function() {
//        $('.exp').on('input', function(){
//    
//    var totalAmt = parseInt($('.total').val());
//    var quantity = parseInt($(this).val());
//    //$('.total').val(+quantity + +totalAmt);
//    console.log(+quantity + +totalAmt);
//})  ;
//        });
//    });
  var i =1;
 $("#append").click( function() { 
      $("#sum").show();
      //alert(i)
   var quantity = $('#VhsncUntiedfundExpenditureAmount'+i).val();
    
     var totalAmt = $('#VhsncUntiedfundCurrentTotalAmount').val();
     
     //$('.total').val(quantity);
     if(parseInt(quantity)){
     $('#VhsncUntiedfundCurrentTotalAmount').val(+quantity + +totalAmt);
 }
 i++;
    });
    
    $("#sum").click( function() {
        //alert(i);
     var quantity = parseInt($('#VhsncUntiedfundExpenditureAmount'+i).val());
     //alert(quantity);
     var totalAmt = parseInt($('#VhsncUntiedfundCurrentTotalAmount').val());
     //$('.total').val(quantity);
     $('#VhsncUntiedfundCurrentTotalAmount').val(+quantity + +totalAmt);
     
     $("#sum").hide();
    });

</script>
<script>
    $(document).ready(function(){
        $("#VhsncUntiedfundVhsncName").change(function(){
        var bal = $("#VhsncUntiedfundBalanceCheckDate").val();
        
        var v=$(this).val();
       // alert(v);
       $.ajax({url:"<?=SITE_PATH?>vhsncUntiedfunds/getbalance/?bal="+bal+"&v="+v,success:function(result){$("#VhsncUntiedfundBalanceOnDate").val(result);}});
       
       $.ajax({url:"<?=SITE_PATH?>vhsncUntiedfunds/getprevious/?bal="+bal+"&v="+v,success:function(result){$("#VhsncUntiedfundTotalExpenditure").val(result);}});
  //alert(bal);
    });
    });  
    
   
    </script>
    
    
   