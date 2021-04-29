<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');     
?>

<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List AFC Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('VhsncAfc'); ?>
<fieldset>
<legend><?php echo __(' AFC'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('id',array('class' => 'form-control'));
echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'--Select--',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'All Villages',$village)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('member_type',array('class' => 'form-control','options'=>array('ASHA'=>'ASHA','AWW'=>'AWW','PRI'=>'PRI','SHG'=>'SHG')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('cc_name',array('class' => 'form-control','label'=>'Cluster Coordinator'))."</div>";
//echo "<div class='col-sm-3' id='VhsncType'>".$this->Form->input('vhsnc_type',array('class' => 'form-control','label'=>'Types of VHSNC Member'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('member_name',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('mobile',array('class' => 'form-control afcmobile','type'=>'number'))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('designation',array('class' => 'form-control','type'=>'text'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_desig',array('class' => 'form-control','label'=>'VHSNC Designation','options'=>array(''=>'Select Designation',$desig)))."</div>";

//echo  "<div class='col-sm-3'>".$this->Form->input('induction_training_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date of Induction Training','value'=>date('d-m-Y',strtotime($this->request->data['VhsncAfc']['induction_training_date']))))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('refresher_date',array('class' => 'form-control','type'=>'text','label'=>'Date of Refresher Training','value'=>date('d-m-Y',strtotime($this->request->data['VhsncAfc']['refresher_date']))))."</div>";
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

var dp_cal1;var dp_cal2;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('VhsncAfcInductionTrainingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('VhsncAfcRefresherDate'));



$(document).ready(function(){
   <?php if($sessionval!='regular') { ?>     
$("#VhsncAfcOrganization").change(function(){
var c=$(this).val();
$('#VhsncAfcDistrict').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getngodistrict/"+c,success:function(result){$("#VhsncAfcDistrict").html(result);}});

})
$("#VhsncAfcDistrict").change(function(){
var c=$(this).val();
var o= $("#VhsncAfcOrganization").val();
$('#VhsncAfcBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getblocksngo/?c="+c+"&nid="+o,success:function(result){$("#VhsncAfcBlock").html(result);}});

});
<?php } ?>
	<?php if($sessionrole!='CC') { ?>
$("#VhsncAfcBlock").change(function(){
var c=$(this).val();
$('#VhsncAfcPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#VhsncAfcPanchayat").html(result);}});

});
        <?php } ?>

$("#VhsncAfcPanchayat").change(function(){
var c=$(this).val();
$('#VhsncAfcVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#VhsncAfcVillage").html(result);}});

});

$("#VhsncAfcMemberType").change(function(){
var c=$(this).val();
//alert(c);
if(c==='VHSNC'){
   $('#append').hide(); 
   $('.append').hide();
   $('#VhsncType').show();
}
else if(c==='AFC'){
    $('#append').show(); 
    $('#VhsncType').hide();
}
});

});
</script>
<script>
$("#VhsncAfcInductionTrainingDate").click( function(e) {
 $('#VhsncAfcInductionTrainingDate').attr('type', 'date');
    });
    
  $("#VhsncAfcRefresherDate").click( function(e) {
 $('#VhsncAfcRefresherDate').attr('type', 'date');
    });  
</script>

<script>
$(document).ready(function(){
   var v = $("#VhsncAfcMemberType").val();
  
if(v==='VHSNC'){
   $('#append').hide(); 
   $('.append').hide();
   $('#VhsncType').show();
}
else if(v==='AFC'){
    $('#append').show(); 
    $('#VhsncType').hide();
    
    
}


 $( ".afcmobile" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
                setTimeout(function(){$('.afcmobile').focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
               setTimeout(function(){$('.afcmobile').focus();}, 2);
                return false;  
             
         }  
    });  

});
</script>