<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');      
?>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Facility Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('FacilityDetail'); ?>
<fieldset>
<legend><?php echo __(' Facility Detail'); ?></legend>
<div class="row">
<?php

//print_r($res);

echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'--Select--',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'--Select--')))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('health_facility_name',array('type'=>'text','class'=>'calbsp form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('facility_type',array('class' => 'form-control','type'=>'text'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('health_facility_place',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('functionality',array('class' => 'form-control'),array('required'=>'required'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('doctor_name',array('type'=>'text','class'=>'form-control','label'=>'Doctor Name (if any)'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('doctor_mobile',array('type'=>'text','class' => 'form-control','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('remarks',array('type'=> 'text','class' => 'form-control'))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('anm_name',array('type'=>'text','class' => 'form-control','label'=>'ANM Name','name'=>'data[FacilityDetail][anm_name][]'))."</div>";
echo " <div class='col-sm-3'>".$this->Form->input('anm_mobile',array('class' => 'form-control','label'=>'ANM Mobile','type'=>'number','name'=>'data[FacilityDetail][anm_mobile][]'))."</div>";

echo "<div class='col-sm-12 field_div'></div>";
echo "<div class='col-sm-12'><div class='col-sm-3'></div><div class='col-sm-3'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px'>+</a></div></div>";



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
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('NgoFcraRegistrationDate'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('NgoFcraRegistrationValidTill'));
dp_cal3  = new Epoch('epoch_popup','popup',document.getElementById('NgoAgreementSignDate'));
dp_cal4  = new Epoch('epoch_popup','popup',document.getElementById('NgoProjectStartDate'));
dp_cal5  = new Epoch('epoch_popup','popup',document.getElementById('NgoProjectEndDate'));
dp_cal6  = new Epoch('epoch_popup','popup',document.getElementById('NgoSocietyRegistrationDate'));




$(document).ready(function(){
   <?php if($sessionval!='regular') { ?>  
 $("#FacilityDetailOrganization").change(function(){
var c=$(this).val();
$('#FacilityDetailDistrict').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getngodistrict/"+c,success:function(result){$("#FacilityDetailDistrict").html(result);}});

});
$("#FacilityDetailDistrict").change(function(){
var c=$(this).val();
var o= $("#FacilityDetailOrganization").val();
$('#FacilityDetailBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getblocksngo/?c="+c+"&nid="+o,success:function(result){$("#FacilityDetailBlock").html(result);}});

});

<?php } ?>
	<?php if($sessionrole!='CC') { ?>
$("#FacilityDetailBlock").change(function(){
var c=$(this).val();
$('#FacilityDetailPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#FacilityDetailPanchayat").html(result);}});

});

        <?php } ?>
$("#FacilityDetailPanchayat").change(function(){
var c=$(this).val();
$('#FacilityDetailVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#FacilityDetailVillage").html(result);}});

});

$( "#FacilityDetailDoctorMobile" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
               setTimeout(function(){$('#FacilityDetailDoctorMobile').focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
                 setTimeout(function(){$('#FacilityDetailDoctorMobile').focus();}, 2);
                return false;  
             
         }  
    });
    
    $( "#FacilityDetailAnmMobile" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
                setTimeout(function(){$('#FacilityDetailAnmMobile').focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
               setTimeout(function(){$('#FacilityDetailAnmMobile').focus();}, 2);
                return false;  
             
         }  
    });
});
</script>
<script>
jQuery(document).ready( function () {
     var dt=1;
     
        $("#append").click( function(e) {
           
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                <div class="col-sm-3"><label>ANM Name</label><input class="calbsp form-control" type="text" id="anmname" name="data[FacilityDetail][anm_name][]"></div>\
                <div class="col-sm-3"><label>ANM Mobile</label><input type="number" class="form-control" id="anmmobile'+dt+'" name="data[FacilityDetail][anm_mobile][]"></div>\
                <a href="#" class="remove_this btn btn-danger" style="margin-top:18px;">X</a>\
</div>');
    dt++;
   
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
        dt--;
            jQuery(this).parent().remove();
          
        return false;
        });
  
$("#append").click( function() {
   
    var s =1;
    var st = dt-s;
     //alert(st);

    $( "#anmmobile"+st ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
                setTimeout(function(){$('#anmmobile'+st).focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
               setTimeout(function(){$('#anmmobile'+st).focus();}, 2);
                return false;  
             
         }  
    });

});

  });


</script>