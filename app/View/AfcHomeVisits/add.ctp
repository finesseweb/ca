<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   
<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
 $sessionrole=$this->Session->read('User.subrole');     
?>
<style>
    .col-sm-2{
        width:19%!important;
    }
.intro {
display: none;
margin-top:30%;
}

    </style>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List AFC Visit Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List  VHSNC Constitution Details'), array('controller' => 'vhsncConstitutions','action' => 'index'),array('class' => 'btn btn-primary')); ?>

</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('AfcHomeVisit'); ?>
<fieldset>
<legend><?php echo __(' AFC Home Visit'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
//echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'--Select--')))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('ward',array('class'=>'calbsp form-control','options'=>array(''=>'--Select--',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('visit_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";


echo  "<div class='col-sm-3'>".$this->Form->input('asha_accompanied',array('class'=>'calbsp form-control','label'=>'Is ASHA Accompanied ','options'=>array('yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('asha_reason',array('class' => 'form-control','label'=>'Reason (IF No)','options'=>array(''=>'Select',$reasonafcv)))."</div>";

echo  "<div class='col-sm-3'>".$this->Form->input('aww_accompanied',array('class'=>'calbsp form-control','label'=>'Is AWW Accompanied ','options'=>array('yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('aww_reason',array('class' => 'form-control','label'=>'Reason (IF No)','options'=>array(''=>'Select',$reasonafcv)))."</div>";

echo  "<div class='col-sm-3'>".$this->Form->input('pri_accompanied',array('class'=>'calbsp form-control','label'=>'Is PRI Accompanied ','options'=>array('yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('pri_reason',array('class' => 'form-control','label'=>'Reason (IF No)','options'=>array(''=>'Select',$reasonafcv)))."</div>";

echo  "<div class='col-sm-3'>".$this->Form->input('shg_accompanied',array('class'=>'calbsp form-control','label'=>'Is SHG Accompanied ','options'=>array('yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('shg_reason',array('class' => 'form-control','label'=>'Reason (IF No)','options'=>array(''=>'Select',$reasonafcv)))."</div>";

echo "<legend class='col-sm-12'>Beneficiary</legend>";
echo "<div class='col-sm-12' id='contactform'>";
echo "<div class='row'>";

echo "<div class='col-sm-3'>".$this->Form->input('couple_name',array('class'=>'calbsp form-control','label'=>'Name'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('age',array('class' => 'form-control','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('gender',array('class' => 'form-control','options'=>array('male'=>'Male','female'=>'Female','transgender'=>'Transgender')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('mobile',array('class' => 'form-control','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_child',array('class' => 'form-control','label'=>'No of child','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('yonger_child_age',array('type'=>'text','class' => 'form-control','type'=>'number','label'=>'Age of younger child'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('current_contraceptives',array('class' => 'form-control','label'=>'Currently using Contraceptives','options'=>array(''=>'Select Option',$opt)))."</div>";
echo "<div class='col-sm-3' id='regular'>".$this->Form->input('commodities_regular_supply',array('class'=>'calbsp form-control','label'=>'If spacing methods Commodities regular supplied ','options'=>array('yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3' id='commodities_reason'>".$this->Form->input('commodities_reason',array('class' => 'form-control','options'=>array(''=>'Select',$reasonafcb)))."</div>";
echo "<div class='col-sm-3' id='beneficiary_couselled'>".$this->Form->input('beneficiary_couselled',array('class' => 'form-control','label'=>'Counselled by AFC to beneficiary','multiple'=>'multiple','options'=>array($opt)))."</div>";
echo "<div class='col-sm-3' id='convinced'>".$this->Form->input('convinced',array('class' => 'form-control','label'=>'Convinced to Opt','options'=>array(''=>'Select Option',$opt)))."</div>";
echo "<div class='col-sm-3' id='contraceptivesdeliverydate'>".$this->Form->input('contraceptives_delivery_date',array('class' => 'form-control','type'=>'text','label'=>'If Spacing - Possible Date for delivery of contraceptives'))."</div>";
echo "<div class='col-sm-3' id='sterilisationofmonth'>".$this->Form->input('sterilisation_of_month',
        array('class' => 'form-control',
            'label'=>'If Sterilisation - Possible Month of Sterilisation',
            'options'=>array(
                ''=>'--Select--','January'=>'January','February'=>'February','March'=>'March','April'=>'April','May'=>'May','June'=>'June',
                'July'=>'July','August'=>'August','September'=>'September','October'=>'October','November'=>'November','December'=>'December')
            ))."</div>";
echo "<div class='col-sm-3' id='visitDate'>".$this->Form->input('follow_visit_date',array('class' => 'form-control followdate','type'=>'text'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control'))."</div>";




?>
<?php 
echo "<a href='#' class='btn btn-danger intro'>To enter new record click OK button</a>";
echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

//var dp_cal1;var dp_cal2;  var dp_cal3; var dp_cal4;  var dp_cal5; var dp_cal6;   
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('AfcHomeVisitFollowVisitDate'));	

$(document).ready(function(){
    <?php if($sessionval!='regular') { ?>
$("#AfcHomeVisitDistrict").change(function(){
var c=$(this).val();
$('#AfcHomeVisitBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#AfcHomeVisitBlock").html(result);}});

});
<?php } ?>
<?php if($sessionrole!='CC') { ?>
$("#AfcHomeVisitBlock").change(function(){
var c=$(this).val();
$('#AfcHomeVisitPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#AfcHomeVisitPanchayat").html(result);}});

});
  <?php } ?>
$("#AfcHomeVisitPanchayat").change(function(){
var c=$(this).val();
$('#AfcHomeVisitVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#AfcHomeVisitVillage").html(result);}});

});
  
//$("#AfcHomeVisitVillage").change(function(){
//var c=$(this).val();
//$('#AfcHomeVisitWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#AfcHomeVisitWard").html(result);}});
//
//});

$("#ajaxsubmit").click(function(){
    
alert('hii');
$('#VhsncMemberVhsncName').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getpvhsnc/"+c,success:function(result){$("#VhsncMemberVhsncName").html(result);}});

});




 var a= $("#AfcHomeVisitAshaAccompanied").val();
if(a==='yes') {
 $("#AfcHomeVisitAshaReason").prop('disabled', 'disabled');
 $("#AfcHomeVisitAshaReason").val(' ');
}
$("#AfcHomeVisitAshaAccompanied").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#AfcHomeVisitAshaReason").removeAttr('disabled');
   }
  else {
$("#AfcHomeVisitAshaReason").prop('disabled', 'disabled');
$("#AfcHomeVisitAshaReason").val(' ');
   }
});


var a= $("#AfcHomeVisitAwwAccompanied").val();
if(a==='yes') {
 $("#AfcHomeVisitAwwReason").prop('disabled', 'disabled');
 $("#AfcHomeVisitAwwReason").val(' ');
}
$("#AfcHomeVisitAwwAccompanied").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#AfcHomeVisitAwwReason").removeAttr('disabled');
   }
  else {
$("#AfcHomeVisitAwwReason").prop('disabled', 'disabled');
$("#AfcHomeVisitAwwReason").val(' ');
   }
});

var a= $("#AfcHomeVisitPriAccompanied").val();
if(a==='yes') {
 $("#AfcHomeVisitPriReason").prop('disabled', 'disabled');
 $("#AfcHomeVisitPriReason").val(' ');
}
$("#AfcHomeVisitPriAccompanied").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#AfcHomeVisitPriReason").removeAttr('disabled');
   }
  else {
$("#AfcHomeVisitPriReason").prop('disabled', 'disabled');
$("#AfcHomeVisitPriReason").val(' ');
   }
});


var a= $("#AfcHomeVisitShgAccompanied").val();
if(a==='yes') {
 $("#AfcHomeVisitShgReason").prop('disabled', 'disabled');
 $("#AfcHomeVisitShgReason").val(' ');
}
$("#AfcHomeVisitShgAccompanied").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#AfcHomeVisitShgReason").removeAttr('disabled');
   }
  else {
$("#AfcHomeVisitShgReason").prop('disabled', 'disabled');
$("#AfcHomeVisitShgReason").val(' ');

   }
});

var b= $("#AfcHomeVisitCommoditiesRegularSupply").val();
if(b==='yes') {
 $("#AfcHomeVisitCommoditiesReason").prop('disabled', 'disabled');
 $("#AfcHomeVisitCommoditiesReason").val(' ');
}
$("#AfcHomeVisitCommoditiesRegularSupply").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#AfcHomeVisitCommoditiesReason").removeAttr('disabled');
   }
  else {
$("#AfcHomeVisitCommoditiesReason").prop('disabled', 'disabled');
$("#AfcHomeVisitCommoditiesReason").val(' ');
   }
});
});
</script>
<script>
jQuery(document).ready( function () {
        $("#append").click( function(e) {
            var dt=1;
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                <div class="col-sm-4"><label>Name</label><select class="form-control name" name="data[VhsncMember][member_name][]"></select></div>\
                <div class="col-sm-4"><label>Mobile</label><input class="form-control mobile" type="text" name="data[VhsncMember][mobile][]" readonly></div>\
               <a href="#" id="remove" class="remove_this btn btn-danger" style="margin-top:18px">X</a>\
            </div>');
    dt++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
       
        jQuery(this).parent().remove();
        return false;
        });

 $("#append").click( function() {
$('.desig').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>designations/getdesig/",success:function(result){$(".desig").html(result);}});
});

$("#append").click( function() {
$('.name').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>vhsncAfcs/getvhsnc/",success:function(result){$(".name").html(result);}});
});

  });
//var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
////dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('AfcHomeVisitDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('AfcHomeVisitContraceptivesDeliveryDate'));
// 
 $(".followdate").click( function(e) {
 $('.followdate').attr('type', 'date');
    });
    
  $("#AfcHomeVisitContraceptivesDeliveryDate").click( function(e) {
 $('#AfcHomeVisitContraceptivesDeliveryDate').attr('type', 'date');
   });  
        
    
$("#AfcHomeVisitAddForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');
    $(".intro").css("display","block");
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert('Your Record has been Saved');
                     document.getElementById('AfcHomeVisitFollowVisitDate').value = '';
                     document.getElementById('AfcHomeVisitCoupleName').value = '';
                     document.getElementById('AfcHomeVisitAge').value = '';
                     document.getElementById('AfcHomeVisitGender').value = '';
                     document.getElementById('AfcHomeVisitMobile').value = '';
                     document.getElementById('AfcHomeVisitNoOfChild').value = '';
                     document.getElementById('AfcHomeVisitYongerChildAge').value = '';
                     document.getElementById('AfcHomeVisitCurrentContraceptives').value = '';
                     document.getElementById('AfcHomeVisitCommoditiesRegularSupply').value = '';
                     document.getElementById('AfcHomeVisitCommoditiesReason').value = '';
                     document.getElementById('AfcHomeVisitBeneficiaryCouselled').value = '';
                     document.getElementById('AfcHomeVisitConvinced').value = '';
                     document.getElementById('AfcHomeVisitContraceptivesDeliveryDate').value = '';
                     document.getElementById('AfcHomeVisitSterilisationOfMonth').value = '';
                     document.getElementById('AfcHomeVisitFollowVisitDate').value = '';
                     document.getElementById('AfcHomeVisitRemarks').value = '';
                   //setTimeout(function () {
                   //$( "#contactform" ).load(window.location.href + " #contactform" );//will redirect to your blog page (an ex: blog.html)
                  //}, 2000); //will call the function after 2 secs.
          
               
              $(".intro").css("display","none");
             //  alert(data); // show response from the php script.
           }
         });


});
</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#VhsncMemberTotalMembers').val();
            num++ ;
                    $('#VhsncMemberTotalMembers').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
         var num= $('#VhsncMemberTotalMembers').val();
            num-- ;
                    $('#VhsncMemberTotalMembers').val(num);
        });
        
    jQuery(document).on('change', '.name', function() {
         var c=$(this).val();
           $.ajax({url:"<?=SITE_PATH?>vhsncAfcs/getmobile/"+c,success:function(result){$(".mobile").val(result);}});
        });     

    });
    
    $("#VhsncMemberName").change( function() {
            var c=$(this).val();
           $.ajax({url:"<?=SITE_PATH?>vhsncAfcs/getmobile/"+c,success:function(result){$("#VhsncMemberMobile").val(result);}});
      
        });
        
        
        
        
        
        /////validation ////
        
        
         $("#AfcHomeVisitCurrentContraceptives").change( function() {
        
          var b =$('#AfcHomeVisitCurrentContraceptives').find(":selected").text();
          if(b=='Female Sterilization' || b=='NSV'){
          $('#regular').hide();
          $('#commodities_reason').hide();
          $('#beneficiary_couselled').hide();
          $('#convinced').hide();
          $('#contraceptivesdeliverydate').hide();
          $('#sterilisationofmonth').hide();
          $('#visitDate').hide();
      }
      else if(b=='None') {
           $('#regular').hide();
           $('#commodities_reason').hide();
           $('#beneficiary_couselled').show();
          $('#convinced').show();
          $('#contraceptivesdeliverydate').show();
          $('#sterilisationofmonth').show();
          $('#visitDate').show();
      }
          else {
          $('#regular').show();
          $('#commodities_reason').show();
          $('#beneficiary_couselled').show();
          $('#convinced').show();
          $('#contraceptivesdeliverydate').show();
          $('#sterilisationofmonth').show();
          $('#visitDate').show();  
          }
      
        });
        
        
        
        
         $("#AfcHomeVisitConvinced").change( function() {
        
          var b =$('#AfcHomeVisitConvinced').find(":selected").text();
          if(b=='Female Sterilization' || b=='NSV'){
         
          $('#contraceptivesdeliverydate').hide();
          $('#sterilisationofmonth').show();
          $('#visitDate').show();
      }
          else if (b=='None') { 
         $('#contraceptivesdeliverydate').hide();
           $('#sterilisationofmonth').hide();
           $('#visitDate').hide();   
        
        }
          
        else {
          
          $('#contraceptivesdeliverydate').show();
          $('#sterilisationofmonth').hide();
          $('#visitDate').hide();  
          }
      
        });
        
   $( "#AfcHomeVisitMobile" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
               setTimeout(function(){$('#AfcHomeVisitMobile').focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter min 10 digit");
               setTimeout(function(){$('#AfcHomeVisitMobile').focus();}, 2);
                return false;  
             
         }  
    });
    
    
 $('#AfcHomeVisitBeneficiaryCouselled').multiselect({
  nonSelectedText: 'Select',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});
 


    </script>