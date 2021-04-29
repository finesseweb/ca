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
<?php echo $this->Html->link(__('List VHSNC Member Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List  VHSNC Constitution Details'), array('controller' => 'vhsncConstitutions','action' => 'index'),array('class' => 'btn btn-primary')); ?>

</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('VhsncMember'); ?>
<fieldset>
<legend><?php echo __(' VHSNC Members Into Constitution '); ?></legend>
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
echo  "<div class='col-sm-3' style='display: none;'>".$this->Form->input('vhsnc_id',array('class'=>'calbsp form-control','type'=>'text','label'=>'VHSNC Name'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('vhsnc_name',array('class'=>'calbsp form-control','label'=>'VHSNC Name','readonly'=>'readonly'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('total_members',array('class' => 'form-control','max'=>'21','value'=>'1','readonly'=>'readonly'))."</div>";
echo "<legend class='col-sm-12'>Member Details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";

echo "<div class='col-sm-2'>".$this->Form->input('member_name',array('class'=>'calbsp form-control','name'=>'data[VhsncMember][member_name][]'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('member_mobile',array('class' => 'form-control membermobile','type'=>'number','name'=>'data[VhsncMember][member_mobile][]'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('designation',array('class' => 'form-control','type'=>'text','name'=>'data[VhsncMember][designation][]'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('vhsnc_desig',array('class' => 'form-control','label'=>'VHSNC Designation','name'=>'data[VhsncMember][vhsnc_desig][]','options'=>array(''=>'Select Designation',$desig)))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('members_type',array('class' => 'form-control','name'=>'data[VhsncMember][members_type][]','label'=>'Type of VHSNC Member','options'=>array('core'=>'Core','invited'=>'Invited','other'=>'Other')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('induction_training_date',array('type'=>'text','name'=>'data[VhsncMember][induction_training_date]','class'=>'calbsp form-control','label'=>'Date of Induction Training'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('refresher_date',array('class' => 'form-control','name'=>'data[VhsncMember][refresher_date]','type'=>'text','label'=>'Date of Refresher Training'))."</div>";

//echo "<div class='col-sm-4'>".$this->Form->input('name',array('class'=>'calbsp form-control','name'=>'data[VhsncMember][member_name][]','options'=>array(''=>'Select Members',$vhsncmembers)))."</div>";
//echo "<div class='col-sm-4'>".$this->Form->input('mobile',array('class' => 'form-control','name'=>'data[VhsncMember][mobile][]','readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('designation',array('class' => 'form-control','type'=>'text','name'=>'data[VhsncConstitution][designation][]'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('vhsnc_desig',array('class' => 'form-control','label'=>'VHSNC Designation','name'=>'data[VhsncConstitution][vhsnc_desig][]','options'=>array(''=>'Select Designation',$desig)))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('members_type',array('class' => 'form-control','name'=>'data[VhsncConstitution][members_type][]','options'=>array('core'=>'Core','invited'=>'Invited','other'=>'Other')))."</div>";
echo  "</div></div>";
echo "<div class='col-sm-12 field_div'></div>";
echo "<div class='col-sm-12'><div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-2'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left: 25px;'>+</a></div>";

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
$("#VhsncMemberDistrict").change(function(){
var c=$(this).val();
$('#VhsncMemberBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#VhsncMemberBlock").html(result);}});

});

<?php } ?>
	<?php if($sessionrole!='CC') { ?>
$("#VhsncMemberBlock").change(function(){
var c=$(this).val();
$('#VhsncMemberPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#VhsncMemberPanchayat").html(result);}});

});
 <?php } ?>

$("#VhsncMemberPanchayat").change(function(){
var c=$(this).val();
$('#VhsncMemberVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#VhsncMemberVillage").html(result);}});

});
//$("#VhsncMemberVillage").change(function(){
//var c=$(this).val();
//$('#VhsncMemberWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#VhsncMemberWard").html(result);}});
//
//});

    

$("#VhsncMemberPanchayat").change(function(){
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getpvhsncId/"+c,success:function(result){$("#VhsncMemberVhsncId").val(result);}});
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getpvhsnc/"+c,success:function(result){$("#VhsncMemberVhsncName").val(result);}});

});
//$("#VhsncMemberVillage").change(function(){
//var c=$(this).val();
//
//$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getvvhsncId/"+c,success:function(result){$("#VhsncMemberVhsncId").val(result);}});
//$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getpvhsnc/"+c,success:function(result){$("#VhsncMemberVhsncName").val(result);}});
//
//});
//$("#VhsncMemberWard").change(function(){
//var c=$(this).val();
//$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getwvhsncId/"+c,success:function(result){$("#VhsncMemberVhsncId").val(result);}});
//$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getpvhsnc/"+c,success:function(result){$("#VhsncMemberVhsncName").val(result);}});
//
//});

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
     var dt=1;
        $("#append").click( function(e) {
           
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                <div class="col-sm-2"><label>Member Name</label><input class="form-control" name="data[VhsncMember][member_name][]"></div>\
                <div class="col-sm-2"><label>Member Mobile</label><input class="form-control membermobile" type="number" name="data[VhsncMember][member_mobile][]"></div>\
                <div class="col-sm-2"><label>Designation</label><input class="form-control" name="data[VhsncMember][designation][]"></select></div>\
                <div class="col-sm-2"><label>VHSNC Designation</label><select class="form-control" id="desig'+dt+'"  name="data[VhsncMember][vhsnc_desig][]"></select></div>\
                <div class="col-sm-2"><label>Type of VHSNC Member</label><select class="form-control" name="data[VhsncMember][members_type][]"><option value="core">Core</option><option value="invited">Invited</option><option value="other">Other</option></select></div>\
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
     var t =1;
    var di= dt-t ;
$('#desig'+di).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>designations/getdesig/",success:function(result){$("#desig"+di).html(result);}});
});

$("#append").click( function() {
$('.name').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>vhsncAfcs/getvhsnc/",success:function(result){$(".name").html(result);}});



jQuery(document).on('blur', '.membermobile', function() {
     var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
               setTimeout(function(){$('.membermobile').focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
                 setTimeout(function(){$('.membermobile').focus();}, 2);
                return false;  
             
         }         
    
    
    });
});

  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('VhsncMemberInductionTrainingDate'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('VhsncMemberRefresherDate'));
 
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
        
        
 $( ".membermobile" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
               setTimeout(function(){$('.membermobile').focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
                 setTimeout(function(){$('.membermobile').focus();}, 2);
                return false;  
             
         }  
    });  
 
 
    </script>