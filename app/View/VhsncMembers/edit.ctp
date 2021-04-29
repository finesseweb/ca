<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');
      ?>
<style>
    .col-sm-2{
        width:20%!important;
    }
    </style>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List VHSNC Member Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('VhsncMember'); ?>
<fieldset>
<legend><?php echo __(' VHSNC Member'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'1'));
//echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'Select District',$cities)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'Select Block',$blocks)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'Select Panchayat',$panchayat)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
//echo  "<div class='col-sm-3'>".$this->Form->input('ward',array('class'=>'calbsp form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
//echo  "<div class='col-sm-3'>".$this->Form->input('vhsnc_name',array('class'=>'calbsp form-control','options'=>array(''=>'Select VHSNC Name',$vhsnc)))."</div>";
//
//echo "<div class='col-sm-3'>".$this->Form->input('total_members',array('class' => 'form-control','max'=>'21','value'=>'1','readonly'=>'readonly'))."</div>";
//echo "<legend class='col-sm-12'>Member Details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";

echo "<div class='col-sm-3'>".$this->Form->input('member_name',array('class'=>'calbsp form-control','name'=>'data[VhsncMember][member_name]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('member_mobile',array('class' => 'form-control membermobile','name'=>'data[VhsncMember][member_mobile]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('designation',array('class' => 'form-control','type'=>'text','name'=>'data[VhsncMember][designation]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_desig',array('class' => 'form-control','label'=>'VHSNC Designation','name'=>'data[VhsncMember][vhsnc_desig]','options'=>array(''=>'Select Designation',$desig)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('members_type',array('class' => 'form-control','name'=>'data[VhsncMember][members_type]','label'=>'Type of VHSNC Member','options'=>array('core'=>'Core','invited'=>'Invited','other'=>'Other')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('induction_training_date',array('type'=>'text','name'=>'data[VhsncMember][induction_training_date]','class'=>'calbsp form-control','label'=>'Date of Induction Training','value'=>date('d-m-Y',strtotime($this->request->data['VhsncMember']['induction_training_date']))))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('refresher_date',array('class' => 'form-control','name'=>'data[VhsncMember][refresher_date]','type'=>'text','label'=>'Date of Refresher Training','value'=>date('d-m-Y',strtotime($this->request->data['VhsncMember']['refresher_date']))))."</div>";
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

var dp_cal1;var dp_cal2;  var dp_cal3; var dp_cal4;  var dp_cal5; var dp_cal6;   
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('VhsncMemberInductionTrainingDate'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('VhsncMemberRefresherDate'));




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
//$('#VhsncConstitutionWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#VhsncMemberWard").html(result);}});
//
//});

$("#VhsncMemberPanchayat").change(function(){
var c=$(this).val();
$('#VhsncMemberVhsncName').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getpvhsnc/"+c,success:function(result){$("#VhsncMemberVhsncName").html(result);}});

});
$("#VhsncMemberVillage").change(function(){
var c=$(this).val();
$('#VhsncMemberVhsncName').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getvvhsnc/"+c,success:function(result){$("#VhsncMemberVhsncName").html(result);}});

});
$("#VhsncMemberWard").change(function(){
var c=$(this).val();
$('#VhsncMemberVhsncName').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getwvhsnc/"+c,success:function(result){$("#VhsncMemberVhsncName").html(result);}});

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
});

</script>