<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');      
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
  

<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Adolescent Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Youthleader'); ?>
<fieldset>
<legend><?php echo __('Adolescent'); ?></legend>
<div class="row">
<?php

////print_r($this->request->data['Youthleader']['date_of_joining']);
//die();
echo $this->Form->input('id',array('class' => 'form-control'));
echo "<div class='col-sm-3'>".$this->Form->input('group_name',array('class' => 'form-control','type'=>'text'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('allocated_district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('allocated_block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
?>
    
    <div class="col-sm-3"><div class="input select required"><label for="YouthleaderAllocatedPanchayat">Allocated Panchayat</label>
            <select name="data[Youthleader][allocated_panchayat][]" class="form-control" multiple="multiple" id="YouthleaderAllocatedPanchayat" required="required">
<option value="">--Select--</option>
<?php  foreach ($panchayat as $key=>$value) {
    $men =explode(',',$this->request->data['Youthleader']['allocated_panchayat']);

?>
<option value="<?=$key?>"  <?php for($i=0;$i<count($men);$i++){ if($key==$men[$i]) { echo "style=display:block".' '.'selected'.""; ?><?php }  }?> style="display: none;"><?=$value?></option>
 
<?php }?>
</select></div></div>
<?php
//echo "<div class='col-sm-3'>".$this->Form->input('allocated_panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('allocated_village',array('class' => 'form-control','options'=>array(''=>'All Villages',$village)))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('class' => 'form-control','type'=>'text'))."</div>";
echo "<legend class='col-sm-12'>Members details</legend>";
echo "<div class='col-sm-3'>".$this->Form->input('first_name',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('last_name',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('designation',array('class' => 'form-control','options'=>array(''=>'Select Designtion',$desig)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('gender',array('class' => 'form-control','options'=>array('male'=>'Male','female'=>'Female','transgender'=>'Transgender')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('age',array('class' => 'form-control','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('mobile',array('class' => 'form-control','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('email',array('class' => 'form-control','type'=>'text'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('qualification',array('class' => 'form-control','label'=>'Education','options'=>array('Illiterate'=>'Illiterate','Primary'=>'Primary','Non-Matric'=>'Non-Matric','matric'=>'Matric','intermediate'=>'Intermediate','graducation'=>'Graduation','Post Graduate'=>'Post Graduate','other'=>'Other')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('address',array('class' => 'form-control','type'=>'text'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('date_of_joining',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date of Joining','value'=>date('d-m-Y',strtotime($this->request->data['Youthleader']['date_of_joining']))))."</div>";

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
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('YouthleaderDateOfJoining'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('YouthleaderContractEndDate'));



$(document).ready(function(){
<?php if($sessionval!='regular') { ?>
$("#YouthleaderAllocatedDistrict").change(function(){
var c=$(this).val();
$('#YouthleaderAllocatedBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#YouthleaderAllocatedBlock").html(result);}});

});

<?php } ?>
<?php if($sessionrole!='CC') { ?>
$("#YouthleaderAllocatedBlock").change(function(){
var c=$(this).val();
$('#YouthleaderAllocatedPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){
        
            
 $("#YouthleaderAllocatedPanchayat").empty();
 $("#YouthleaderAllocatedPanchayat").html(result);
$("#YouthleaderAllocatedPanchayat").multiselect('destroy');
$('#YouthleaderAllocatedPanchayat').multiselect({
  nonSelectedText: 'Select Panchayat',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});

        
        
        }});

});
<?php } ?>

$("#YouthleaderAllocatedPanchayat").change(function(){
var c=$(this).val();
$('#YouthleaderAllocatedVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#YouthleaderAllocatedVillage").html(result);}});

});

$('#YouthleaderAllocatedPanchayat').multiselect({
  nonSelectedText: 'Select Panchayat',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'auto'});
  $('.dropdown-menu li').css({'display':'none','width':'240px'});
$('.dropdown-menu li.active').css({'display':'block'});  



$( "#YouthleaderMobile" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
                setTimeout(function(){$('#YouthleaderMobile').focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter min 10 digit");
               setTimeout(function(){$('#YouthleaderMobile').focus();}, 2);
                return false;  
             
         }  
    });
});
</script>