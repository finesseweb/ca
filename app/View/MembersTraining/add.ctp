<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');      
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   
<style>
    .col-sm-2{
        width:19%!important;
    }
    </style>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Member\'s Training'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List  VHSNC Constitution Details'), array('controller' => 'vhsncConstitutions','action' => 'index'),array('class' => 'btn btn-primary')); ?>

</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('MembersTraining'); ?>
<fieldset>
<legend><?php echo __('Member\'s Training'); ?></legend>
<div class="row">
<?php

//print_r($res);

echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
//echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'--Select--')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('member_name',array('class'=>'calbsp form-control','multiple'=>'multiple','options'=>array(),'style'=>'height:250px'))."</div>";


//echo  "<div class='col-sm-3'>".$this->Form->input('ward',array('class'=>'calbsp form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('induction_training_date',array('type'=>'text','name'=>'data[MembersTraining][induction_training_date]','class'=>'calbsp form-control','label'=>'Date of Training'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('refresher_date',array('class' => 'form-control','name'=>'data[MembersTraining][refresher_date]','type'=>'text','label'=>'Date of Refresher Training'))."</div>";
?>
    <div class="col-sm-3"><label>Date of Training <span style="color:red">*</span></label><div class="input-group"><input type="text" name="data[MembersTraining][from_date]" id="from_date" class="form-control" placeholder="Date From"  required="required"/><span class="input-group-addon">To</span><input type="text" name="data[MembersTraining][to_date]" id="to_date" class="form-control" placeholder="Date To" /></div></div>

    
    <?php

//echo  "<div class='col-sm-3'>".$this->Form->input('vhsnc_name',array('class'=>'calbsp form-control','label'=>'VHSNC Name','readonly'=>'readonly'))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('total_members',array('class' => 'form-control','max'=>'21','value'=>'1','readonly'=>'readonly'))."</div>";
echo "<legend class='col-sm-12' style='margin-top: 14px;'>Member Details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";

echo "<div class='col-sm-3'>".$this->Form->input('member_name',array('class'=>'calbsp form-control','name'=>'data[MembersTraining][member_name][]'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('member_mobile',array('class' => 'form-control','name'=>'data[MembersTraining][member_mobile][]'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('designation',array('class' => 'form-control','type'=>'text','name'=>'data[MembersTraining][designation]'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_desig',array('class' => 'form-control','label'=>'VHSNC Designation','name'=>'data[MembersTraining][vhsnc_desig]','options'=>array(''=>'Select Designation',$desig)))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('members_type',array('class' => 'form-control','name'=>'data[MembersTraining][members_type][]','options'=>array(''=>'--Select--','AFC'=>'AFC','VHSNC'=>'VHSNC','Adolescent'=>'Adolescent','Youth Leaders'=>'Youth Leaders','BCM'=>'BCM','ASHA Facilitators'=>'ASHA Facilitators')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('induction_training_date',array('type'=>'text','name'=>'data[MembersTraining][induction_training_date]','class'=>'calbsp form-control','label'=>'Date of Induction Training'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('remarks',array('class' => 'form-control','name'=>'data[MembersTraining][remarks][]'))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('refresher_date',array('class' => 'form-control','name'=>'data[MembersTraining][refresher_date]','type'=>'text','label'=>'Date of Refresher Training'))."</div>";

//echo "<div class='col-sm-4'>".$this->Form->input('name',array('class'=>'calbsp form-control','name'=>'data[MembersTraining][member_name][]','options'=>array(''=>'Select Members',$vhsncmembers)))."</div>";
//echo "<div class='col-sm-4'>".$this->Form->input('mobile',array('class' => 'form-control','name'=>'data[MembersTraining][mobile][]','readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('designation',array('class' => 'form-control','type'=>'text','name'=>'data[VhsncConstitution][designation][]'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('vhsnc_desig',array('class' => 'form-control','label'=>'VHSNC Designation','name'=>'data[VhsncConstitution][vhsnc_desig][]','options'=>array(''=>'Select Designation',$desig)))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('members_type',array('class' => 'form-control','name'=>'data[VhsncConstitution][members_type][]','options'=>array('core'=>'Core','invited'=>'Invited','other'=>'Other')))."</div>";
echo "</div></div>";
echo "<div class='col-sm-12 field_div'></div>";
echo "<div class='col-sm-12'><div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-3'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left: 98%;'>+</a></div></div>";




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
     <?php if($sessionval!='regular') { ?>
$("#MembersTrainingDistrict").change(function(){
var c=$(this).val();
$('#MembersTrainingBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#MembersTrainingBlock").html(result);}});

});
<?php } ?>
<?php if($sessionrole!='CC') { ?>

$("#MembersTrainingBlock").change(function(){
var c=$(this).val();
$('#MembersTrainingPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#MembersTrainingPanchayat").html(result);}});

});

  <?php } ?>
$("#MembersTrainingPanchayat").change(function(){
var c=$(this).val();
$('#MembersTrainingVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#MembersTrainingVillage").html(result);}});

});
$("#MembersTrainingVillage").change(function(){
var c=$(this).val();
$('#MembersTrainingWard').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#MembersTrainingWard").html(result);}});

});

   

$("#MembersTrainingPanchayat").change(function(){
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getpvhsnc/"+c,success:function(result){$("#MembersTrainingVhsncName").val(result);}});

});
$("#MembersTrainingVillage").change(function(){
var c=$(this).val();

$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getvvhsnc/"+c,success:function(result){$("#MembersTrainingVhsncName").val(result);}});

});
$("#MembersTrainingWard").change(function(){
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getwvhsnc/"+c,success:function(result){$("#MembersTrainingVhsncName").val(result);}});

});

//$("#VhsncConstitutionVhsncConstitutionLevel").change(function(){
//var v=$(this).val();
//if(v==='panchayat'){
//    var p =$('#VhsncConstitutionPanchayat').find(":selected").text();
//    $('#VhsncConstitutionVhsncName').val(p+'-VHSNC'); 
//
//    }
//   else if(v==='village'){
//    var p =$('#VhsncConstitutionVillage').find(":selected").text();
//    $('#VhsncConstitutionVhsncName').val(p+'-VHSNC'); 
//
//    }
//    else {
//      var p =$('#VhsncConstitutionWard').find(":selected").text();
//    $('#VhsncConstitutionVhsncName').val(p+'-VHSNC'); 
//  
//    }
//});

});
</script>
<script>
jQuery(document).ready( function () {
        $("#append").click( function(e) {
            var dt=1;
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                <div class="col-sm-3"><div class="input select required"><label>Member Name</label><input class="form-control name" name="data[MembersTraining][member_name][]" required></div></div>\
                <div class="col-sm-2"><div class="input select required"><label>Member Mobile</label><input class="form-control mobile" type="text" name="data[MembersTraining][member_mobile][]" required></div></div>\
               <div class="col-sm-2"><div class="input select required"><label for="MembersTrainingMembersType">Members Type</label><select name="data[MembersTraining][members_type][]" class="form-control" id="MembersTrainingMembersType" required="required"><option value="">--Select--</option><option value="AFC">AFC</option><option value="VHSNC">VHSNC</option><option value="Adolescent">Adolescent</option><option value="Youth Leaders">Youth Leaders</option><option value="BCM">BCM</option><option value="ASHA Facilitators">ASHA Facilitators</option></select></div></div>\n\
               <div class="col-sm-4"><label>Remarks</label><input class="form-control mobile" type="text" name="data[MembersTraining][remarks][]" required></div>\
               <a href="#" id="remove" class="remove_this btn btn-danger" style="margin-top:18px">X</a>\
            </div>');
    dt++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
       
        jQuery(this).parent().remove();
        return false;
        });
  });

 $("#from_date").click( function(e) {
 $('#from_date').attr('type', 'date');
    });
    
  $("#to_date").click( function(e) {
 $('#to_date').attr('type', 'date');
    });  
        
    

</script>
<script>
//    $(document).ready( function () {
//        
//        $("#append").click( function() {
//            var num= $('#MembersTrainingTotalMembers').val();
//            num++ ;
//                    $('#MembersTrainingTotalMembers').val(num);
//        });
//        jQuery(document).on('click', '.remove_this', function() {
//         var num= $('#MembersTrainingTotalMembers').val();
//            num-- ;
//                    $('#MembersTrainingTotalMembers').val(num);
//        });
//        
//    jQuery(document).on('change', '.name', function() {
//         var c=$(this).val();
//           $.ajax({url:"<?=SITE_PATH?>vhsncAfcs/getmobile/"+c,success:function(result){$(".mobile").val(result);}});
//        });     
//
//    });
    
//    $("#MembersTrainingMembersType").change( function() {
//          var v= $('#MembersTrainingVillage').val();
//            var c=$(this).val();
//          if(c==='AFC'){
//           $.ajax({url:"<?=SITE_PATH?>vhsncAfcs/getmembers/"+v,success:function(result){
//                   
//   $("#MembersTrainingMemberName").empty();
// $("#MembersTrainingMemberName").html(result);
//$("#MembersTrainingMemberName").multiselect('destroy');
//$('#MembersTrainingMemberName').multiselect({
//  nonSelectedText: 'Select Members',
//  enableFiltering: true,
//  enableCaseInsensitiveFiltering: true,
//  buttonWidth:'245px'
// });
//$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});
//
//        
//        }});
//              }
//               else {
//           $.ajax({url:"<?=SITE_PATH?>vhsncMembers/getmembers/"+v,success:function(result){
//                   
//         
//        
//          $("#MembersTrainingMemberName").empty();
// $("#MembersTrainingMemberName").html(result);
//$("#MembersTrainingMemberName").multiselect('destroy');
//$('#MembersTrainingMemberName').multiselect({
//  nonSelectedText: 'Select Members',
//  enableFiltering: true,
//  enableCaseInsensitiveFiltering: true,
//  buttonWidth:'245px'
// });
//$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});
//        }});
//              }
//        });
// 
 
// $('#MembersTrainingMemberName').multiselect({
//  nonSelectedText: 'Select Members',
//  enableFiltering: true,
//  enableCaseInsensitiveFiltering: true,
//  buttonWidth:'245px'
// });
//$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});
//

        
 
    </script>