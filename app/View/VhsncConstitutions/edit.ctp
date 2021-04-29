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
<?php echo $this->Html->link(__('List VHSNC Constitution Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('VhsncConstitution'); ?>
<fieldset>
<legend><?php echo __(' VHSNC Constitution'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'1'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'All Villages',$village)))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('ward',array('class'=>'calbsp form-control','options'=>array(''=>'--Select--',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('constitution_date',array('class' => 'form-control','type'=>'text','label'=>'Constitution Date','value'=>date('d-m-Y',strtotime($this->request->data['VhsncConstitution']['constitution_date']))))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_constitution_level',array('class' => 'form-control','label'=>'VHSNC Constitution Level','options'=>array(''=>'Select Level','panchayat'=>'Panchayat','revenue village'=>'Revenue Village','ward'=>'Ward')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_name',array('class' => 'form-control','label'=>'VHSNC Name','readonly'=>'readonly'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_bank_name',array('class' => 'form-control','label'=>'VHSNC Bank Name'),array('required'=>'required'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('account_type',array('class'=>'form-control','options'=>array('saving'=>'Saving','current'=>'Current')))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('account_no',array('type'=>'number','class' => 'form-control','label'=>'Account No'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ifsc',array('type'=>'text','class' => 'form-control','label'=>'IFS CODE'))."</div>";
echo " <div class='col-sm-3'>".$this->Form->input('branch_address',array('class' => 'form-control','type'=>'text'))."</div>";
echo " <div class='col-sm-3'>".$this->Form->input('opening_balance',array('class' => 'form-control','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('primary_signatory',array('type'=> 'text','class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('secondary_signatory',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('class' => 'form-control','type'=>'text','lable'=>'ASHA Name'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('status',array('class'=>'calbsp form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('total_members',array('class' => 'form-control','max'=>'21','value'=>'1','readonly'=>'readonly'))."</div>";
//echo "<legend>Member Details</legend>";
//echo "<div class='col-sm-12'>";
//echo "<div class='row'>";
//echo "<div class='col-sm-2'>".$this->Form->input('name',array('type'=>'text','class'=>'calbsp form-control','name'=>'data[VhsncConstitution][member_name]'))."</div>";

//echo "<div class='col-sm-2'>".$this->Form->input('mobile',array('class' => 'form-control','name'=>'data[VhsncConstitution][mobile]'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('designation',array('class' => 'form-control','type'=>'text','name'=>'data[VhsncConstitution][designation]'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('vhsnc_desig',array('class' => 'form-control','label'=>'VHSNC Designation','name'=>'data[VhsncConstitution][vhsnc_desig]','options'=>array(''=>'Select Designation',$desig)))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('members_type',array('class' => 'form-control','name'=>'data[VhsncConstitution][members_type]','options'=>array('core'=>'Core','invited'=>'Invited','other'=>'Other')))."</div>";
//echo "<a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;'>+</a></div></div>";
//echo "<div class='col-sm-12 field_div'></div>";

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