<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');      
?>
<style>
    .col-sm-2{
        width:19%!important;
    }
    </style>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List VHSNC Constitution Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List  VHSNC Member'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>

</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('VhsncConstitution'); ?>
<fieldset>
<legend><?php echo __('VHSNC Constitution'); ?></legend>
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
echo "<div class='col-sm-3'>".$this->Form->input('constitution_date',array('class' => 'form-control','type'=>'text','label'=>'Constitution Date','value'=>date('d-m-Y')))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_constitution_level',array('class' => 'form-control','label'=>'VHSNC Constitution Level','options'=>array(''=>'Select Level','panchayat'=>'Panchayat','village'=>'Revenue Village','ward'=>'Ward',)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_name',array('class' => 'form-control','label'=>'VHSNC Name','readonly'=>'readonly'))."</div>";


echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_bank_name',array('class' => 'form-control','label'=>'VHSNC Bank Name'),array('required'=>'required'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('account_type',array('class'=>'form-control','options'=>array('Saving'=>'Saving','Current'=>'Current')))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('account_no',array('type'=>'number','class' => 'form-control','label'=>'Account No'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ifsc',array('type'=>'text','class' => 'form-control','label'=>'IFS CODE'))."</div>";
echo " <div class='col-sm-3'>".$this->Form->input('branch_address',array('class' => 'form-control','type'=>'text'))."</div>";
echo " <div class='col-sm-3'>".$this->Form->input('opening_balance',array('class' => 'form-control','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('primary_signatory',array('type'=> 'text','class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('secondary_signatory',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('class' => 'form-control','type'=>'text','lable'=>'ASHA Name'))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('total_members',array('class' => 'form-control','max'=>'21','value'=>'1','readonly'=>'readonly'))."</div>";
//echo "<legend>Member Details</legend>";
//echo "<div class='col-sm-12'>";
//echo "<div class='row'>";
//echo "<div class='col-sm-2'>".$this->Form->input('name',array('type'=>'text','class'=>'calbsp form-control','name'=>'data[VhsncConstitution][member_name][]'))."</div>";

//echo "<div class='col-sm-2'>".$this->Form->input('mobile',array('class' => 'form-control','name'=>'data[VhsncConstitution][mobile][]'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('designation',array('class' => 'form-control','type'=>'text','name'=>'data[VhsncConstitution][designation][]'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('vhsnc_desig',array('class' => 'form-control','label'=>'VHSNC Designation','name'=>'data[VhsncConstitution][vhsnc_desig][]','options'=>array(''=>'Select Designation',$desig)))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('members_type',array('class' => 'form-control','name'=>'data[VhsncConstitution][members_type][]','options'=>array('core'=>'Core','invited'=>'Invited','other'=>'Other')))."</div>";
//echo "<a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;'>+</a></div></div>";
//echo "<div class='col-sm-12 field_div'></div>";
//echo "<div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";




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
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('VhsncConstitutionConstitutionDate'));	




$(document).ready(function(){
    <?php if($sessionrole!='CC' || $sessionrole!='BPC' ) { ?>
$("#VhsncConstitutionDistrict").change(function(){
var c=$(this).val();
$('#VhsncConstitutionBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#VhsncConstitutionBlock").html(result);}});

});
<?php } ?>
<?php if($sessionrole!='CC') { ?>

$("#VhsncConstitutionBlock").change(function(){
var c=$(this).val();
$('#VhsncConstitutionPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#VhsncConstitutionPanchayat").html(result);}});

});

<?php } ?>
$("#VhsncConstitutionPanchayat").change(function(){
var c=$(this).val();
$('#VhsncConstitutionVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#VhsncConstitutionVillage").html(result);}});

});

//$("#VhsncConstitutionVillage").change(function(){
//var c=$(this).val();
//$('#VhsncConstitutionWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#VhsncConstitutionWard").html(result);}});
//
//});
    
$("#VhsncConstitutionVhsncConstitutionLevel").change(function(){
var v=$(this).val();
   var b =$('#VhsncConstitutionBlock').find(":selected").text();
   var d =$('#VhsncConstitutionDistrict').find(":selected").text();
   var bl = b.substring(0,2);
   var dt = d.substring(0,2);
if(v==='panchayat'){
   var p =$('#VhsncConstitutionPanchayat').find(":selected").text();
    $('#VhsncConstitutionVhsncName').val(dt+'-'+bl+'-'+p+'-VHSNC'); 
    }
   else if(v==='village'){
    var p =$('#VhsncConstitutionPanchayat').find(":selected").text();
    var v =$('#VhsncConstitutionVillage').find(":selected").text();
     $('#VhsncConstitutionVhsncName').val(dt+'-'+bl+'-'+p+'-'+v+'-VHSNC'); 

    }
    else {
      var p =$('#VhsncConstitutionPanchayat').find(":selected").text();
      var v =$('#VhsncConstitutionVillage').find(":selected").text(); 
      var w =$('#VhsncConstitutionWard').find(":selected").text();
     $('#VhsncConstitutionVhsncName').val(dt+'-'+bl+'-'+p+'-'+v+'-'+w+'-VHSNC'); 
  
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
                <div class="col-sm-2"><label>Name</label><input class="form-control" type="text" name="data[VhsncConstitution][member_name][]"></div>\
                <div class="col-sm-2"><label>Mobile</label><input class="form-control" type="text" name="data[VhsncConstitution][mobile][]"></div>\
                <div class="col-sm-2"><label>Designation</label><input class="calbsp form-control" type="text" id="induction_training_date" name="data[VhsncConstitution][designation][]"></div>\
                <div class="col-sm-2"><label>VHSNC Designation</label><select class="form-control desig" id="vhsnc_desig" name="data[VhsncConstitution][vhsnc_desig][]"><option value="">Select Designation</option></select></div>\
                <div class="col-sm-2"><label>Members Type</label><select class="form-control" id="members_type" name="data[VhsncConstitution][members_type][]"><option value="core">Core</option><option value="invited">Invited</option><option value="other">Other</option></select></div>\
                <a href="#" id="remove" class="remove_this btn btn-danger" style="margin-top:18px">X</a>\
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
 
 //$("#VhsncAfcInductionTrainingDate").click( function(e) {
 //$('#VhsncAfcInductionTrainingDate').attr('type', 'date');
 //   });
    
 // $("#VhsncAfcRefresherDate").click( function(e) {
 //$('#VhsncAfcRefresherDate').attr('type', 'date');
 //   });  
        
    

</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#VhsncConstitutionTotalMembers').val();
            num++ ;
                    $('#VhsncConstitutionTotalMembers').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
         var num= $('#VhsncConstitutionTotalMembers').val();
            num-- ;
                    $('#VhsncConstitutionTotalMembers').val(num);
        });
    });
    </script>