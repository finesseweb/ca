<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
 $sessionrole=$this->Session->read('User.subrole');     
?>
<style>
    .col-sm-2{
        width:16%!important;
        
        }
    .form-control{
            margin-bottom: 0px!important;
    }
    .tform{
        margin-bottom: 15px!important;
    }
     select {
    text-transform: none !important;
}
    </style>

<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Checklist'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Checklist'); ?>
<fieldset>
<legend><?php echo __('Checklist'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control tform','options'=>array(''=>'--Select--')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('name_of_monitor',array('class' => 'form-control tform','label'=>'Name of Monitor'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('monitoring_date',array('type'=>'text','class'=>'calbsp tform form-control','label'=>'Date','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('awc_code',array('class' => 'form-control tform','label'=>'AWC Code','options'=>array(''=>'--select--')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('level',array('class' => 'form-control','options'=>array(''=>'--Select--',$level)))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('level',array('class' => 'form-control tform','label'=>'Level','options'=>array(''=>'--select--','level1'=>'Level 1','level2'=>'Level 2','level3'=>'Level 3','level4'=>'Level 4','level5'=>'Level 5')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('health_facility_type',array('class' => 'form-control tform','label'=>'Type of Health Facility','options'=>array(''=>'--Select--')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('name_of_responder_one',array('class' => 'form-control tform','label'=>'Name of Responder One'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('mobile_responder_one',array('class' => 'form-control tform','label'=>'Mobile Number','type'=>'number','size'=>'10'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('name_of_responder_two',array('class' => 'form-control tform','label'=>'Name of Responder Two'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('mobile_responder_two',array('class' => 'form-control tform','label'=>'Mobile Number','type'=>'number','size'=>'10'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('start_time_assessment',array('class' => 'form-control tform','label'=>'Start time of assessement','value'=>date("h:i:sa"),'readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-3' id='refresh' style='display:none;'>".$this->Form->input('end_time_assessment',array('class' => 'form-control tform','label'=>'End time of assessment','value'=>date("h:i:sa"),'readonly'=>'readonly'))."</div>";

echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control tform','label'=>'Remarks'))."</div>";

//echo "<legend class='col-sm-12'>Issue details</legend>";
//echo "<div class='col-sm-12'>";
//echo "<div class='row'>";
//echo "<div class='col-sm-3'>".$this->Form->input('issue_category',array('class' => 'form-control','name'=>'data[VhsncMeeting][issue_category][]','options'=>array(''=>'Select Category',$issue)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('issue_subcategory',array('class' => 'form-control','name'=>'data[VhsncMeeting][issue_subcategory][]','options'=>array(''=>'Select Subcategory',$subissue)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('issue_details',array('class' => 'form-control','type'=>'text','name'=>'data[VhsncMeeting][issue_details][]'))."</div>";
//echo "</div></div>";
//echo "<div class='col-sm-12'>";
//echo "<div class='row'>";
//echo "<div class='col-sm-3'>".$this->Form->input('decisions_taken',array('class' => 'form-control','name'=>'data[VhsncMeeting][decisions_taken][]','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('decision_details',array('class' => 'form-control','name'=>'data[VhsncMeeting][decision_details][]','type'=>'text'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','name'=>'data[VhsncMeeting][issue_resolved][]','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
//echo "<a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;'>+</a>";
//
//echo "</div></div>";
//
//echo "<div class='col-sm-12'>";
//echo "<div class='row'>";
//echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved_date',array('class' => 'form-control','name'=>'data[VhsncMeeting][issue_resolved_date][]','type'=>'text','label'=>'Date of Resolved Issued'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('issue_remarks',array('class' => 'form-control','name'=>'data[VhsncMeeting][issue_remarks][]','type'=>'text','label'=>'Remarks Of Issued'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('letter_issued_bpmc',array('class' => 'form-control','name'=>'data[VhsncMeeting][letter_issued_bpmc][]','type'=>'text','label'=>'Letter Issued BPMC'))."</div>";
//echo "</div></div>";
//echo "<div class='col-sm-12 field_div'></div>";



?>
    
    <table class="table table-striped" id="display_result" > 
        <thead>
        <th>Title/Question</th><th>Response</th><th>Remarks</th>
        <tbody>
             
        
           
        </tbody>
        </thead> 
        </table>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">



$(document).ready(function(){
    //$('#append').hide(); 
//var c=$(".feed").val();
// 
//$.ajax({url:"<?=SITE_PATH?>subfeedbacks/fetchcat/"+c,success:function(result){$("#getquestons").html(result);}});
 <?php if($sessionval!='regular') { ?>
$("#ChecklistDistrict").change(function(){
var c=$(this).val();
$('#ChecklistBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#ChecklistBlock").html(result);}});

});

<?php } ?>
<?php if($sessionrole!='CC') { ?>

$("#ChecklistBlock").change(function(){
var c=$(this).val();
$('#VhsncConstitutionPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#ChecklistPanchayat").html(result);}});

});
<?php } ?>
$("#ChecklistPanchayat").change(function(){
var c=$(this).val();
$('#ChecklistVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#ChecklistVillage").html(result);}});

});

$("#ChecklistVillage").change(function(){
var c=$(this).val();
$('#ChecklistHealthFacilityName').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>geographicals/getAwc/"+c,success:function(result){$("#ChecklistAwcCode").html(result);}});

});

$("#ChecklistHealthFacilityName").change(function(){
var c=$(this).val();
$('#ChecklistHealthFacilityType').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>facilityDetails/gettype/"+c,success:function(result){$("#ChecklistHealthFacilityType").html(result);}});

});

//$("#ChecklistVillage").change(function(){
//var c=$(this).val();
//$('#ChecklistWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#ChecklistWard").html(result);}});
//
//});

$("#VhsncMeetingDecisionsTaken").change(function(){
var c=$(this).val();
//alert(c);
if(c==='yes'){
    $('#VhsncMeetingDecisionTaken').val(1);
        }
        else {
           $('#VhsncMeetingDecisionTaken').val(' '); 
        }
});
$("#VhsncMeetingIssueResolved").change(function(){
var c=$(this).val();
//alert(c);
if(c==='yes'){
    $('#VhsncMeetingSolvedIssue').val(1);
        }
        else {
           $('#VhsncMeetingSolvedIssue').val(' '); 
        }
});

});
</script>
<script>
 
  $("#VhsncMeetingIssueResolvedDate").click( function(e) {
 $('#VhsncMeetingIssueResolvedDate').attr('type', 'date');
    });  
        
//  $("#ChecklistLevel").change(function(){
//var c=$(this).val();
////alert(c);
//if(c==='level1'){
//    $('.level1').show();
//    $('.level2').hide();
//    $('.level3').hide();
//    $('.level4').hide();
//    $('.level5').hide();
//        }
//   else if(c==='level2'){
//    $('.level1').hide();
//    $('.level2').show();
//    $('.level3').hide();
//    $('.level4').hide(); 
//    $('.level5').hide(); 
//   }
//   else if(c==='level3'){
//    $('.level1').hide();
//    $('.level2').hide();
//    $('.level3').show();
//    $('.level4').hide(); 
//    $('.level5').hide(); 
//   }
//   else if(c==='level4'){
//    $('.level1').hide();
//    $('.level2').hide();
//    $('.level3').hide();
//    $('.level4').show(); 
//    $('.level5').hide(); 
//   }
//   else if(c==='level5'){
//    $('.level1').hide();
//    $('.level2').hide();
//    $('.level3').hide();
//    $('.level4').hide(); 
//    $('.level5').show(); 
//   }
//    else {
//    $('.level1').show();
//    $('.level2').show();
//    $('.level3').show();
//    $('.level4').show(); 
//    $('.level5').show(); 
//        }
//});  


$("#ChecklistLevel").change(function(){
var c=$(this).val();
//var v = $("#ChecklistHidden").val();
//$('.' + $(this).val()).show();
$.ajax({url:"<?=SITE_PATH?>subfeedbacks/getquestions/?c="+c,success:function(result){
        $('#display_result tbody').html(result);
            
          //  $("#qutst").html(result);
        }});

  
});  

</script>
<script>
    $(document).ready( function () {
   
$( "#ChecklistMobileResponderOne" ).blur(function() {
    var c=$(this).val();
    if (c.length>12)
           {
                alert("Enter max 12 digit");
                $( "#ChecklistMobileResponderOne" ).val('');
                return false;
           }
         else if(c.length<10){
            alert("Enter min 10 digit");
                $( "#ChecklistMobileResponderOne" ).val('');
                return false;  
             
         }  
    });
    $( "#ChecklistMobileResponderTwo" ).blur(function() {
    var c=$(this).val();
    if (c.length>12)
           {
                alert("Enter max 12 digit");
                $( "#ChecklistMobileResponderTwo" ).val('');
                return false;
           }
         else if(c.length<10){
            alert("Enter min 10 digit");
                $( "#ChecklistMobileResponderTwo" ).val('');
                return false;  
             
         }  
    });
    
  }); 
  
  
  
  function my_function(){
      $('#refresh').load(location.href + ' #ChecklistEndTimeAssessment');
    }
    setInterval("my_function();",1000); 
    </script>