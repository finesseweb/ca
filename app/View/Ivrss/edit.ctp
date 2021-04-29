<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   
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
<?php echo $this->Html->link(__('List M-Shakti'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List  VHSNC Constitution Details'), array('controller' => 'vhsncConstitutions','action' => 'index'),array('class' => 'btn btn-primary')); ?>

</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Ivrs'); ?>
<fieldset>
<legend><?php echo __('M-Shakti'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('id',array('class' => 'form-control'));
//echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'Select District',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'Select Block',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'Select Panchayat',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('ward',array('class'=>'calbsp form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3' style='display:none'>".$this->Form->input('date',array('type'=>'hidden','class'=>'calbsp form-control','label'=>'Date'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('date1',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y',strtotime($this->request->data['Ivrs']['date'])),'readonly'=>'readonly'))."</div>";

echo  "<div class='col-sm-3'>".$this->Form->input('ivrs_user_name',array('class'=>'calbsp form-control','label'=>'Name of M-Shakti User'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('age',array('class' => 'form-control','label'=>'Age','type'=>'number'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('gender',array('class'=>'calbsp form-control','label'=>'Gender','options'=>array('male'=>'Male','female'=>'Female','transgender'=>'Transgender')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ivrs_user_mobile',array('class' => 'form-control','label'=>'Mobile','type'=>'number'))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('ivrs_user_type',array('class'=>'calbsp form-control','label'=>'Type of M-Shakti User','options'=>array('Pregnant Woman'=>'Pregnant Woman','Lactatating Woman'=>'Lactatating Woman','Eligible Couple'=>'Eligible Couple','Adolescent'=>'Adolescent','other'=>'Other')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('registration_status',array('class' => 'form-control','label'=>'Registration held today','options'=>array('yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('registration_reason',array('class' => 'form-control','label'=>'Reason (If No)'))."</div>";
?>
<div class="col-sm-3"><div class="input select"><label for="IvrsSurveyParticipated">Survey Participated</label><input type="hidden" name="data[Ivrs][survey_participated]" value="" id="IvrsSurveyParticipated_">
<select name="data[Ivrs][survey_participated][]" class="calbsp form-control" multiple="multiple" id="IvrsSurveyParticipated">
    <?php 
     $men =explode(',',$this->request->data['Ivrs']['survey_participated']);
     
           
           ?>
    ?>
    <option value="Family Planning" <?php   for($i=0;$i<count($men);$i++){ if('Family Planning'==$men[$i]) { echo "selected" ;} } ?> >Family Planning</option>
<option value="Maternal Health (ANC)" <?php    for($i=0;$i<count($men);$i++){ if('Maternal Health (ANC)'==$men[$i]) { echo "selected" ;} }?>>Maternal Health (ANC)</option>
<option value="Maternal Health (Delivery JBSY PMC)" <?php   for($i=0;$i<count($men);$i++){ if('Maternal Health (Delivery JBSY PMC)'==$men[$i]) { echo "selected" ;} }?>>Maternal Health (Delivery,JBSY,PMC)</option>
<option value="JSSK" <?php   for($i=0;$i<count($men);$i++){ if('JSSK'==$men[$i]) { echo "selected" ;} }?>>JSSK</option>
<option value="VHSND" <?php   for($i=0;$i<count($men);$i++){ if('VHSND'==$men[$i]) { echo "selected" ;} }?>>VHSND</option>
<option value="HSC" <?php   for($i=0;$i<count($men);$i++){ if('HSC'==$men[$i]) { echo "selected" ;} }?>>HSC</option>
<option value="PHC" <?php   for($i=0;$i<count($men);$i++){ if('PHC'==$men[$i]) { echo "selected" ;} } ?>>PHC</option>
      
</select></div></div> 
    <?php 
//echo  "<div class='col-sm-3'>".$this->Form->input('survey_participated',array('class'=>'calbsp form-control','label'=>'Survey Participated','multiple'=>'multiple','options'=>array('Family Planning'=>'Family Planning','Maternal Health (ANC)'=>'Maternal Health (ANC)','Maternal Health (Delivery,JBSY,PMC)'=>'Maternal Health (Delivery,JBSY,PMC)','JSSK'=>'JSSK','VHSND'=>'VHSND','HSC'=>'HSC','PHC'=>'PHC')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('voice_feedback_recorded',array('class' => 'form-control','label'=>'Voice Feedback Recorded','options'=>array('yes'=>'Yes','no'=>'NO')))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('voice_reason',array('class'=>'calbsp form-control','label'=>'Reason (If No)'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('information_pack_listen',array('class' => 'form-control','label'=>'Information Pack Listen ','options'=>array('yes'=>'Yes','no'=>'No')))."</div>";
echo  "<div class='col-sm-3'>".$this->Form->input('info_pack_reason',array('class'=>'calbsp form-control','label'=>'Reason (If No)'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control','label'=>'Remarks '))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";


?>
<?php 
//echo "<a href='#' class='btn btn-primary' id='ajaxsubmit'>Submit</a>";
echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
 <?php if($sessionval!='regular') { ?>
$("#IvrsDistrict").change(function(){
var c=$(this).val();
$('#IvrsBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#IvrsBlock").html(result);}});

});
<?php } ?>
	<?php if($sessionrole!='CC') { ?>
$("#IvrsBlock").change(function(){
var c=$(this).val();
$('#IvrsPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#IvrsPanchayat").html(result);}});

});
<?php } ?>
$("#IvrsPanchayat").change(function(){
var c=$(this).val();
$('#IvrsVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#IvrsVillage").html(result);}});

});
//$("#IvrsVillage").change(function(){
//var c=$(this).val();
//$('#IvrsWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#IvrsWard").html(result);}});
//
//});

$("#AdolescentMeetingDate").click( function(e) {
 $('#AdolescentMeetingDate').attr('type', 'date');
    });
    
    
var a= $("#IvrsRegistrationStatus").val();
if(a==='yes') {
 $("#IvrsRegistrationReason").prop('disabled', 'disabled');
$("#IvrsRegistrationReason").val(' ');
}
$("#IvrsRegistrationStatus").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#IvrsRegistrationReason").removeAttr('disabled');
   }
  else {
$("#IvrsRegistrationReason").prop('disabled', 'disabled');
$("#IvrsRegistrationReason").val(' ');
   }
});
  
  
  var a= $("#IvrsVoiceFeedbackRecorded").val();
if(a==='yes') {
 $("#IvrsVoiceReason").prop('disabled', 'disabled');
 $("#IvrsVoiceReason").val(' ');
}
$("#IvrsVoiceFeedbackRecorded").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#IvrsVoiceReason").removeAttr('disabled');
   }
  else {
$("#IvrsVoiceReason").prop('disabled', 'disabled');
$("#IvrsVoiceReason").val(' ');
   }
});


var a= $("#IvrsInformationPackListen").val();
if(a==='yes') {
 $("#IvrsInfoPackReason").prop('disabled', 'disabled');
}
$("#IvrsInformationPackListen").change(function() {
   var c=$(this).val();
   if(c==='no') {
$("#IvrsInfoPackReason").removeAttr('disabled');
   }
  else {
$("#IvrsInfoPackReason").prop('disabled', 'disabled');
   }
});
   
   
    $("#IvrsDate").click( function(e) {
 $('#IvrsDate').attr('type', 'date');
    });
    
$('#IvrsSurveyParticipated').multiselect({
  nonSelectedText: 'Select Members',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});



$( "#IvrsIvrsUserMobile" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
               setTimeout(function(){$('#IvrsIvrsUserMobile').focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
               setTimeout(function(){$('#IvrsIvrsUserMobile').focus();}, 2);
                return false;  
             
         }  
    });
});


</script>
<!--<script>
jQuery(document).ready( function () {
        $("#append").click( function(e) {
            var dt=1;
          e.preventDefault();
        $(".field_div").append('<div class="row append">\
                <div class="col-sm-4"><label>Name</label><select class="form-control name" name="data[VhsncMember][member_name][]"></select></div>\
                <div class="col-sm-4"><label>Mobile</label><input class="form-control mobile" type="text" name="data[VhsncMember][mobile][]" readonly></div>\
               <a href="#" id="remove" class="remove_this btn btn-danger" style="margin-top:18px">X</a>\
            </div>');
    dt++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
       
        jQuery(this).parent().remove();
        return false;
        });

 $("#append").click( function() {
$('.desig').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>designations/getdesig/",success:function(result){$(".desig").html(result);}});
});

$("#append").click( function() {
$('.name').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>vhsncAfcs/getvhsnc/",success:function(result){$(".name").html(result);}});
});

  });

 
    
 // $("#VhsncAfcRefresherDate").click( function(e) {
 //$('#VhsncAfcRefresherDate').attr('type', 'date');
 //   });  
        
    
$("#AfcHomeVisitAddForm").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
               
                   setTimeout(function () {
                   $( "#contactform" ).load(window.location.href + " #contactform" );//will redirect to your blog page (an ex: blog.html)
                  }, 2000); //will call the function after 2 secs.

               
            
               //alert(data); // show response from the php script.
           }
         });


});
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
 
    </script>-->