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

//print_r($res);

//echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('group_name',array('class' => 'form-control','type'=>'text'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('allocated_district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('allocated_block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('allocated_panchayat',array('class' => 'form-control','multiple'=>'multiple','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('allocated_village',array('class' => 'form-control','options'=>array(''=>'--Select--')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('class' => 'form-control','type'=>'text'))."</div>";
echo "<legend class='col-sm-12'>Members details</legend>";
echo "<div class='col-sm-3'>".$this->Form->input('first_name',array('class' => 'form-control','name'=>'data[Youthleader][first_name][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('last_name',array('class' => 'form-control','name'=>'data[Youthleader][last_name][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('designation',array('class' => 'form-control','name'=>'data[Youthleader][designation][]','options'=>array(''=>'Select Designtion',$desig)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('gender',array('class' => 'form-control','name'=>'data[Youthleader][gender][]','options'=>array('male'=>'Male','female'=>'Female','transgender'=>'Transgender')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('age',array('class' => 'form-control','name'=>'data[Youthleader][age][]','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('mobile',array('class' => 'form-control','name'=>'data[Youthleader][mobile][]','type'=>'number'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('email',array('class' => 'form-control','name'=>'data[Youthleader][email][]','type'=>'email'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('qualification',array('class' => 'form-control','name'=>'data[Youthleader][qualification][]','label'=>'Education','options'=>array('Illiterate'=>'Illiterate','Primary'=>'Primary','Non-Matric'=>'Non-Matric','matric'=>'Matric','intermediate'=>'Intermediate','graducation'=>'Graduation','Post Graduate'=>'Post Graduate','other'=>'Other')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('address',array('class' => 'form-control','type'=>'text','name'=>'data[Youthleader][address][]'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('date_of_joining',array('type'=>'text','class'=>'calbsp form-control','name'=>'data[Youthleader][date_of_joining][]','label'=>'Date of Joining'))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";

echo "<div class='col-sm-12 field_div'></div>";
echo "<div class='col-sm-12'><div class='col-sm-3'></div><div class='col-sm-3'></div><div class='col-sm-3'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left: 95%;'>+</a></div></div>";



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
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('YouthleaderDateOfJoining'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('YouthleaderContractEndDate'));



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
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});



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

<script>
jQuery(document).ready( function () {
     var dt=1;
     var n=2
        $("#append").click( function(e) {
           
          e.preventDefault();
        $(".field_div").append('<div class="row append"><div class="col-sm-12"><legend></legend></div>\
                <div class="col-sm-3"><label>First Name</label><input class="calbsp form-control" type="text" id="induction_training_date" name="data[Youthleader][first_name][]"></div>\
                <div class="col-sm-3"><label>Last Name</label><input class="form-control" id="issue_category'+dt+'" name="data[Youthleader][last_name][]"></div>\
                <div class="col-sm-3"><label>Designation</label><select class="form-control"  id="issue_level'+dt+'" name="data[Youthleader][designation][]"><option value="">Select</option></select></div>\
                <div class="col-sm-3"><label>Gender</label><select class="form-control decisions" id="decision_taken" name="data[Youthleader][gender][]"><option value="">Select</option><option value="male">Male</option><option value="female">Female</option><option value="transgender">Transgender</option></select></div>\
                <div class="col-sm-3"><label>Age</label><input class="calbsp form-control" type="number" name="data[Youthleader][age][]"></div>\
                <div class="col-sm-3"><label>Mobile</label><input class="form-control resolved" type="number" id="YouthleaderMobile" name="data[Youthleader][mobile][]"></div>\
                <div class="col-sm-3"><label>Email</label><input type="email" class="form-control" id="issue_resolved_date'+dt+'" name="data[Youthleader][email][]"> </div>\
                <div class="col-sm-3"><label>Education</label><select class="calbsp form-control" name="data[Youthleader][qualification][]"><option value="Illiterate">Illiterate</option><option value="Primary">Primary</option><option value="Non-Matric">Non-Matric</option><option value="matric">Matric</option><option value="intermediate">Intermediate</option><option value="graducation">Graduation</option><option value="Post Graduate">Post Graduate</option><option value="other">Other</option></select></div>\
                <div class="col-sm-3"><label>Date of Joining</label><input class="form-control" type="date" name="data[Youthleader][date_of_joining][]"></div>\
                 <div class="col-sm-6"><label>Address</label><input class="form-control" type="text" name="data[Youthleader][address][]"></div>\
                <a href="#" class="remove_this btn btn-danger" id="'+n+'" style="margin-top:18px;">X</a>\
</div>');
    dt++;
    n++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
        //var c= $(this.id);
        // alert(c);
        jQuery(this).parent().remove();
      
        
       // $("$issue'+n+'").hide();
       
       var num= $('#YouthleaderNewIssue').val();
       if(num>0) {
            num-- ;
                    $('#YouthleaderNewIssue').val(num);
                    
        }
            var dec= $('#YouthleaderDecisionTaken').val();
            
               if(dec==''){
                  $('#YouthleaderDecisionTaken').val(0);
                   }
                else {
                    if(dec>0){
                   dec-- ;
                    $('#YouthleaderDecisionTaken').val(dec);
                }
                 }   
             var res= $('#YouthleaderSolvedIssue').val();
                if(res==''){
                  $('#YouthleaderSolvedIssue').val(0);
                   }
                else {
                    if(res>0){
                    res-- ;
                    $('#YouthleaderSolvedIssue').val(res); 
                }
                 }         
                
        return false;
        });

$("#append").click( function() {
    var s =1;
    var st = dt-s;
$("#issue_category"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueCategorys/getissue/",success:function(result){$("#issue_category"+st).html(result);}});

$("#issue_level"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>designations/getdesig/",success:function(result){$("#issue_level"+st).html(result);}});

$("#resolved"+st).change( function() {
//alert(st);
 r=$(this).val();
var m = $("#YouthleaderMeetingDate").val();

 if(r==='yes'){
  $("#issue_resolved_date"+st).val(m);
}
else {
     $("#issue_resolved_date"+st).val(''); 
}

});

});
  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('YouthleaderMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('YouthleaderIssueResolvedDate'));
 
 $("#YouthleaderDateOfJoining").click( function(e) {
 $('#YouthleaderDateOfJoining').attr('type', 'date');
    });
    
  //$("#YouthleaderIssueResolvedDate").click( function(e) {
 //$('#YouthleaderIssueResolvedDate').attr('type', 'date');
   // });  
        
    

</script>