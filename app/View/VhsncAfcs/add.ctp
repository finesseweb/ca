<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');      
?>
<style>
    .col-sm-3{
        width:24%!important;
    }
    </style>

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

echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'--Select--',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'--Select--')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('member_type',array('class' => 'form-control','options'=>array('ASHA'=>'ASHA','AWW'=>'AWW','PRI'=>'PRI','SHG'=>'SHG')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('cc_name',array('class' => 'form-control','label'=>'Cluster Coordinator'))."</div>";
//echo "<div class='col-sm-3' id='VhsncType'>".$this->Form->input('vhsnc_type',array('class' => 'form-control','label'=>'Types of VHSNC Member','options'=>array(''=>'Select Member Type','core'=>'Core','invited'=>'Invited','other'=>'Other')))."</div>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-3'>".$this->Form->input('member_type',array('class' => 'form-control','name'=>'data[VhsncAfc][member_type][]','options'=>array('ASHA'=>'ASHA','AWW'=>'AWW','PRI'=>'PRI','SHG'=>'SHG')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('member_name',array('class' => 'form-control','name'=>'data[VhsncAfc][member_name][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('mobile',array('class' => 'form-control afcmobile','name'=>'data[VhsncAfc][mobile][]','type'=>'number'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('designation',array('class' => 'form-control','type'=>'text','name'=>'data[VhsncConstitution][designation][]'))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('vhsnc_desig',array('class' => 'form-control','label'=>'VHSNC Designation','name'=>'data[VhsncConstitution][vhsnc_desig][]','options'=>array(''=>'Select Designation',$desig)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('induction_training_date',array('type'=>'text','name'=>'data[VhsncAfc][induction_training_date][]','class'=>'calbsp form-control','label'=>'Date of Induction Training'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('refresher_date',array('class' => 'form-control','name'=>'data[VhsncAfc][refresher_date][]','type'=>'text','label'=>'Date of Refresher Training'))."</div>";
echo "</div></div>";
echo "<div class='col-sm-12 field_div'></div>";
echo "<div class='col-sm-12'><div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-3'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;'>+</a></div>";



?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">



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
   //$('#append').hide(); 
   //$('.append').hide();
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
jQuery(document).ready( function () {
        $("#append").click( function(e) {
            var dt=1;
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                <div class="col-sm-3"><label>Member Type</label><select class="form-control" name="data[VhsncAfc][member_type][]"><option value="ASHA">ASHA</option><option value="AWW">AWW</option><option value="PRI">PRI</option><option value="SHG">SHG</option></select></div>\
                <div class="col-sm-3"><label>Member Name</label><input class="form-control" type="text" name="data[VhsncAfc][member_name][]"></div>\
                <div class="col-sm-3"><label>Mobile</label><input class="form-control afcmobile" type="number" name="data[VhsncAfc][mobile][]"></div>\
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
    
    
    jQuery(document).on('blur', '.afcmobile', function() {
     var c=$(this).val();
    
    if (c.length<10)
           {
                alert("Enter min 10 digit");
               setTimeout(function(){$('.afcmobile').focus();}, 2);
               
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
                 setTimeout(function(){$('.afcmobile').focus();}, 2);
                return false;  
             
         }         
    
    
    }); 

});
  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('VhsncAfcInductionTrainingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('VhsncAfcRefresherDate'));
 
 $("#VhsncAfcInductionTrainingDate").click( function(e) {
 $('#VhsncAfcInductionTrainingDate').attr('type', 'date');
    });
    
  $("#VhsncAfcRefresherDate").click( function(e) {
 $('#VhsncAfcRefresherDate').attr('type', 'date');
    });  
        
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
 
</script>