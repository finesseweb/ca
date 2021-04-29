<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');
      ?>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Expenditure Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
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
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'1'));
///echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'All Villages',$village)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('vhsnc_name',array('class'=>'calbsp form-control','label'=>'VHSNC Name','options'=>array(''=>'Select Option',$vhsnc)))."</div>";
echo  $this->Form->input('vhsnc_id',array('type'=>'hidden','class'=>'calbsp form-control'));

echo "<div class='col-sm-3'>".$this->Form->input('total_expenditure',array('type'=>'text','class' => 'form-control','label'=>'Total Expenditure (Previous)','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('balance_check_date',array('type'=>'text','class'=>'form-control','value'=>date('d-m-Y',strtotime($this->request->data['VhsncUntiedfund']['balance_check_date'])),'readonly'=>'readonly','label'=>'Balance as on Date'))."</div>";
echo $this->Form->input('balance_check_date1',array('type'=>'hidden','class'=>'form-control','value'=>date('Y-m-d'),'readonly'=>'readonly','label'=>'Balance as on Date'));
echo "<div class='col-sm-3'>".$this->Form->input('balance_on_date',array('type'=>'text','class' => 'form-control','label'=>'Balance Amount as on Date','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('current_total_amount',array('type'=>'text','class' => 'form-control','label'=>'Total Expenditure Amount','readonly'=>'readonly'))."</div>";
echo $this->Form->input('current_total_amount1',array('class' => 'form-control quantity','type'=>'hidden','value'=>$this->request->data['VhsncUntiedfund']['current_total_amount']));

?>
 
<?php 
echo "<legend class='col-sm-12'>Expenditure Details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-3'>".$this->Form->input('expenditure_date',array('type'=>'text','class'=>'calbsp form-control','name'=>'data[VhsncUntiedfund][expenditure_date]','value'=>date('d-m-Y',strtotime($this->request->data['VhsncUntiedfund']['expenditure_date']))))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('expenditure_details',array('class' => 'form-control','name'=>'data[VhsncUntiedfund][expenditure_details]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('expenditure_amount',array('class' => 'form-control quantity','type'=>'number','name'=>'data[VhsncUntiedfund][expenditure_amount]','id'=>'VhsncUntiedfundExpenditureAmount'))."</div>";
echo $this->Form->input('expenditure_amount1',array('class' => 'form-control quantity','type'=>'hidden','value'=>$this->request->data['VhsncUntiedfund']['expenditure_amount']));

echo "</div></div>";
//echo "<div class='col-sm-12 field_div'></div>";
//echo "<div class='col-sm-12'><div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-3'>".$this->Form->input('current_total_amount',array('type'=>'text','class' => 'form-control total','value'=>'0','label'=>'Total Amount','readonly'=>'readonly'))."</div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;'>+</a>  <a href='#sum' id='sum' class='btn btn-primary' name='append' style='margin-top: 18px;'>Total Sum</a></div>";


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
                <div class="col-sm-3"><label>Expenditure Amount</label><input type="text" class="form-control quantity" id="VhsncUntiedfundExpenditureAmount'+dt+'" name="data[VhsncUntiedfund][expenditure_amount][]"></div>\
                 <a href="#" class="remove_this btn btn-danger" style="margin-top:18px">X</a>\
            </div>');
    dt++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
        jQuery(this).parent().remove();
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
 
 
//  $("#VhsncUntiedfundBalanceCheckDate").click( function(e) {
// $('#VhsncUntiedfundBalanceCheckDate').attr('type', 'date');
//    });
    
    
    $("#VhsncUntiedfundPaymentReceivedDate").click( function(e) {
 $('#VhsncUntiedfundPaymentReceivedDate').attr('type', 'date');
    });
    
  
  
  
  $("#VhsncUntiedfundExpenditureAmount").focusout(function() {
       var c=$(this).val();
       var u=   $("#VhsncUntiedfundCurrentTotalAmount1").val();
       var f=   $("#VhsncUntiedfundExpenditureAmount1").val();
       if(c>f){
           var tot=c-f;
        var total = (+u + +tot);
          }
          else if(c<f){
              var sub = f-c
            var total = (u-sub);
          }
          else {
             var total = f;  
        }
        $( "#VhsncUntiedfundCurrentTotalAmount" ).val(total);
    }); 
    
    
 

  var i =1;
 $("#append").click( function() { 
     
   var quantity = parseInt($('#VhsncUntiedfundExpenditureAmount'+i).val());
   // alert(quantity);
     var totalAmt = parseInt($('#VhsncUntiedfundCurrentTotalAmount').val());
     //$('.total').val(quantity);
     $('#VhsncUntiedfundCurrentTotalAmount').val(+quantity + +totalAmt);
 i++;
    });
    
    $("#sum").click( function() {
     var quantity = parseInt($('#VhsncUntiedfundExpenditureAmount'+i).val());
    // alert(quantity);
     var totalAmt = parseInt($('#VhsncUntiedfundCurrentTotalAmount').val());
     //$('.total').val(quantity);
     $('#VhsncUntiedfundCurrentTotalAmount').val(+quantity + +totalAmt);
 
    });

</script>
<script>
    $(document).ready(function(){
        $("#VhsncUntiedfundVhsncName").change(function(){
        var bal = $("#VhsncUntiedfundBalanceCheckDate").val();
        var v = $("#VhsncUntiedfundVhsncName").val();
       $.ajax({url:"<?=SITE_PATH?>vhsncUntiedfunds/getbalance/?bal="+bal+"&v="+v,success:function(result){$("#VhsncUntiedfundBalanceOnDate").val(result);}});
       
       $.ajax({url:"<?=SITE_PATH?>vhsncUntiedfunds/getprevious/"+bal+v,success:function(result){$("#VhsncUntiedfundTotalExpenditure").val(result);}});
  //alert(bal);
    });
    
   
    }); 
     
    </script>
    
    <script type="text/javascript">

var q = new Date();
var m = q.getMonth()+1;
var d = q.getDay();
var y = q.getFullYear();

var date = new Date(y,m,d);
var predate = document.getElementById("VhsncUntiedfundBalanceCheckDate1").value;  
mydate=new Date(predate);
console.log(date);
console.log(mydate)

if(date>mydate)
{
     document.getElementById("VhsncUntiedfundExpenditureDate").readOnly = true;
      document.getElementById("VhsncUntiedfundExpenditureAmount").readOnly = true;
}
else if(date<mydate)
{
    document.getElementById("VhsncUntiedfundExpenditureDate").readOnly = true;
      document.getElementById("VhsncUntiedfundExpenditureAmount").readOnly = true;

}


</script>
    
    
   