<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Payment Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('PaymentDetail'); ?>
<fieldset>
<legend><?php echo __('Paymet Details'); ?></legend>
<div class="row">
<?php
//echo date('Y-m-d');
//echo date('m');
if(date('m')>3){
    $nestyear =date('Y')+1;
     $nestyear1 =date('y')+1;
    $curryear =date('Y');
    $curryear1 =date('y');
    $finacialyear= $curryear.'-'.$nestyear;
    $finacialyear1= $curryear1.'-'.$nestyear1;
}
else {
    $preyear =date('Y')-1;
     $preyear1 =date('y')-1;
    $curryear =date('Y');
     $curryear1 =date('y');
    $finacialyear=  $preyear.'-'.$curryear;
    $finacialyear1=  $preyear1.'-'.$curryear1;
    //echo $finacialyear;
    //echo date('Y',strtotime($finacialyear));
}
$bill_number = $finacialyear1.'/'.'1';

echo "<div class='col-sm-3'>".$this->Form->input('company',array('class' => 'form-control','label'=>'Company','options'=>array(''=>'Select Company',$company)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('company_name',array('class' => 'form-control','label'=>'Client','options'=>array(''=>'Select Client',$client)),array('required'=>'required'))."</div>";
///echo "<div class='col-sm-3'>".$this->Form->input('financial_year',array('class' => 'form-control','required'=>'required','readonly'=>'readonly','value'=>$finacialyear))."</div>";
?>
<!--    <div class="col-sm-3"><div class="input select"><label for="FinancePeriodId">Financial Year</label>
         <select name="data[Finance][financial_year]" class="form-control" id="FinancePeriodId" required="required">
<option value="">Select Period</option>
<?php //foreach ($period as $key=>$value){
    //print_r($value);
    ?>
<option value="<? //$value['periods']['id']?>" <?php //if($finacialyear==$value['periods']['financial_year']){ echo "selected" ; }?>><? //$value['periods']['financial_year']?></option>
<?php //} ?>
</select></div></div>-->

    
   
    <?php
  echo "<div class='col-sm-3'>".$this->Form->input('bill_number',array('class' => 'form-control','required'=>'required','options'=>array(''=>'Select')))."</div>";
  echo "<div class='col-sm-3'>".$this->Form->input('billing_amount',array('class' => 'form-control','required'=>'required','readonly'=>'readonly'))."</div>";
  echo "<div class='col-sm-3'>".$this->Form->input('payment_date',array('type'=>'text','class' => 'form-control','required'=>'required','value'=>date('d-m-Y')))."</div>";

//echo "<legend class='col-sm-12'>Amount Details</legend>"; 
//echo "<div class='col-sm-4'>".$this->Form->input('description',array('class' => 'form-control','options'=>array(''=>'--Select--')),array('required'=>'required'))."</div>";
//echo "<div class='col-sm-3'><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;'>+</a>  </div>";
//
//echo "<div class='col-sm-12'><div class='row'><div class='col-sm-8'>".$this->Form->input('description_add',array('class' => 'form-control ','label'=>'Description','name'=>'data[Finance][description][]'))."</div>"; 
//echo "<div class='col-sm-3'>".$this->Form->input('amount',array('type'=>'number','class' => 'form-control totamt','required'=>'required','name'=>'data[Finance][amount][]','id'=>'FinanceAmount1'))."</div></div></div>";

//echo "<div class='col-sm-12 field_div'></div>";
//echo "<div class='col-sm-12'><div class='col-sm-8'></div><div class='col-sm-2'>".$this->Form->input('current_total_amount',array('type'=>'text','class' => 'form-control total','value'=>'0','label'=>'Total Amount','readonly'=>'readonly'))."</div>  <a href='#sum' id='sum' class='btn btn-primary' name='append' style='margin-top: 18px;'>Total Sum</a></div>";

//echo "<legend class='col-sm-12'>Other Amount</legend>"; 
echo "<div class='col-sm-3'>".$this->Form->input('due_amount',array('type'=>'number','class' => 'form-control','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('less_amount',array('type'=>'number','class' => 'form-control','required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('paid_amount',array('type'=>'number','class' => 'form-control','required'=>'required'))."</div>";
echo "<legend class='col-sm-12'>Payment Detail</legend>"; 
echo "<div class='col-sm-3'>".$this->Form->input('payment_mode',array('class' => 'form-control','required'=>'required','options'=>array(''=>'select','cash'=>'Cash','cheque/dd'=>'Cheque/DD','online'=>'Online')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('bank_name',array('type'=>'text','class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ifsc',array('type'=>'text','class' => 'form-control','label'=>'IFSC'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('transction_number',array('type'=>'text','class' => 'form-control','label'=>'Transaction/DD/Cheque Number'))."</div>";
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
 $("#FinanceCompany").change(function(){
  var c=$(this).val();
  var y = $('#FinancePeriodId').val();
  $('#FinanceDescription').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>company_details/getcompanydesc/"+c,success:function(result){$("#FinanceDescription").html(result);}});
$.ajax({url:"<?=SITE_PATH?>company_details/getbillnumber/?c="+c+"&y="+y,success:function(result){$("#FinanceBillNumber").val(result);}});

  
 } );  
    
    
$("#PaymentDetailCompanyName").change(function(){
  var y=$(this).val();
  var c = $('#PaymentDetailCompany').val();
$.ajax({url:"<?=SITE_PATH?>finances/getbillnumber/?c="+c+"&y="+y,success:function(result){$("#PaymentDetailBillNumber").html(result);}});

  
 } );
 
 
 $("#PaymentDetailBillNumber").change(function(){
  var y=$(this).val();
  //var c = $('#PaymentDetailCompany').val();
$.ajax({url:"<?=SITE_PATH?>finances/getamount/?y="+y,success:function(result){$("#PaymentDetailBillingAmount").val(result);}});

  
 } );
$("#PaymentDetailPaymentMode").change(function(){
  var y=$(this).val();
 if(y==='cash'){
     $('#PaymentDetailBankName').prop('readonly', true);
     $('#PaymentDetailIfsc').prop('readonly', true);
     $('#PaymentDetailTransctionNumber').prop('readonly', true);
        }  
        
        else {
      $('#PaymentDetailBankName').prop('readonly', false);
     $('#PaymentDetailIfsc').prop('readonly', false);
     $('#PaymentDetailTransctionNumber').prop('readonly', false); 
      $('#PaymentDetailBankName').prop('required', true);
     $('#PaymentDetailIfsc').prop('required', true);
     $('#PaymentDetailTransctionNumber').prop('required', true);
        }
 } );    
});
</script>


<script>
jQuery(document).ready( function () {
     var dt=1;
        $("#append").click( function(e) {
         var des=   $('#FinanceDescription option:selected').text();
         //alert(des);
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                 <div class="col-sm-8"><label>Description</label><input class="calbsp form-control" type="text" id="amountdescription'+dt+'" name="data[Finance][description_details][]"></div>\
                <div class="col-sm-3"><label> Amount</label><input type="number" class="form-control quantity totamt" id="FinanceAmount'+dt+'" name="data[Finance][amount][]"></div>\
                 <a href="#" class="remove_this btn btn-danger" style="margin-top:18px">X</a>\
            </div>');
         $("#amountdescription"+dt).val(des);
    dt++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
       $("#sum").show();
       dt--;
      
       var qua = $('#FinanceAmount'+dt).val();
       var total = parseInt($('#FinanceCurrentTotalAmount').val());
     //$('.total').val(quantity);
     if(dt===2) {
         
         $('#FinanceCurrentTotalAmount').val('0');
        } else {
       $('#FinanceCurrentTotalAmount').val(total-qua);
   }
//        alert(qua);
        
         jQuery(this).parent().remove();
         i--;
        return false;
         
        });

$("#append").click( function() {
$('.desig').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>designations/getdesig/",success:function(result){$(".desig").html(result);}});
});
  });


  var i =1;
 $("#append").click( function() { 
      $("#sum").show();
      //alert(i)
//   var quantity = $('#FinanceAmount'+i).val();
//    
//     var totalAmt = $('#FinanceCurrentTotalAmount').val();
//     
//     //$('.total').val(quantity);
//     if(parseInt(quantity)){
//     $('#FinanceCurrentTotalAmount').val(+quantity + +totalAmt);
// }
 i++;
    });
    
    $("#sum").click( function() {
       // alert(i);
     var sum = 0;   
        //var inputs = $(".totamt");
      var inputs = $(".totamt");
           for(var i = 0; i < inputs.length; i++){
             //     alert(inputs.length) ;
             sum = sum + parseInt($(inputs[i]).val());
               
          }
       $('#FinanceCurrentTotalAmount').val(sum); 
       
        $("#sum").hide();
    });
$("#PaymentDetailPaymentDate").click( function(e) {
$('#PaymentDetailPaymentDate').attr('type', 'date');
   });  
   
   $("#PaymentDetailPaidAmount").focusout(function() {
       var c=$(this).val();
       var u=   $("#PaymentDetailBillingAmount").val();
      
        var total = u-c;
        $( "#PaymentDetailDueAmount" ).val(total);
    });
</script>