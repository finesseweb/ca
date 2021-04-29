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
    </style>

<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Checklist VHSNC'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Checklistvhsnc'); ?>
<fieldset>
<legend><?php echo __('Checklist VHSNC'); ?></legend>
<div class="row">
<?php
echo $this->Form->input('id',array('class' => 'form-control'));
//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$panchayat)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control tform','options'=>array(''=>'--Select--')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_name',array('class' => 'form-control tform','label'=>'VHSNC Name','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('name_of_monitor',array('class' => 'form-control tform','label'=>'Name of Monitor'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp tform form-control','label'=>'Date','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('awc_code',array('class' => 'form-control tform','label'=>'AWC Code','options'=>array(''=>'--select--')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('level',array('class' => 'form-control tform','label'=>'Level','options'=>array(''=>'--select--','level1'=>'Level 1','level2'=>'Level 2','level3'=>'Level 3','level4'=>'Level 4','level5'=>'Level 5')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('health_facility_type',array('class' => 'form-control tform','label'=>'Type of Health Facility','options'=>array(''=>'--Select--')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('name_of_responder_one',array('class' => 'form-control tform','label'=>'Name of Responder One'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('mobile_responder_one',array('class' => 'form-control tform','label'=>'Mobile Number','type'=>'number','size'=>'10'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('name_of_responder_two',array('class' => 'form-control tform','label'=>'Name of Responder Two'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('mobile_responder_two',array('class' => 'form-control tform','label'=>'Mobile Number','type'=>'number','size'=>'10'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('start_time_assessment',array('class' => 'form-control tform','label'=>'Start time of assessement','value'=>date("h:i:sa"),'readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-3' id='refresh' style='display:none;'>".$this->Form->input('end_time_assessment',array('class' => 'form-control tform','label'=>'End time of assessment','value'=>date("h:i:sa"),'readonly'=>'readonly'))."</div>";

echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('class' => 'form-control tform','label'=>'Remarks'))."</div>";

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
$("#ChecklistvhsncDistrict").change(function(){
var c=$(this).val();
$('#ChecklistvhsncBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#ChecklistvhsncBlock").html(result);}});

});

<?php } ?>
<?php if($sessionrole!='CC') { ?>

$("#ChecklistvhsncBlock").change(function(){
var c=$(this).val();
$('#ChecklistvhsncPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#ChecklistvhsncPanchayat").html(result);}});

});
<?php } ?>
$("#ChecklistvhsncPanchayat").change(function(){
var c=$(this).val();
//$('#ChecklistvhsncVillage').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#ChecklistvhsncVillage").html(result);}});
$.ajax({url:"<?=SITE_PATH?>vhsncConstitutions/getname/"+c,success:function(result){$("#ChecklistvhsncVhsncName").val(result);}});

});

$("#ChecklistvhsncVillage").change(function(){
var c=$(this).val();
$('#ChecklistvhsncHealthFacilityName').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>geographicals/getAwc/"+c,success:function(result){$("#ChecklistvhsncvhsncAwcCode").html(result);}});

});

$("#ChecklistvhsncvhsncHealthFacilityName").change(function(){
var c=$(this).val();
$('#ChecklistvhsncvhsncHealthFacilityType').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>facilityDetails/gettype/"+c,success:function(result){$("#ChecklistvhsncvhsncHealthFacilityType").html(result);}});

});

//$("#ChecklistvhsncvhsncVillage").change(function(){
//var c=$(this).val();
//$('#ChecklistvhsncvhsncWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#ChecklistvhsncvhsncWard").html(result);}});
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
jQuery(document).ready( function () {
     var dt=1;
        $("#append").click( function(e) {
           
          e.preventDefault();
        $(".field_div").append('<div class="row append"><div class="row">\
                <div class="col-sm-3"><label>Issue Category</label><select class="form-control" id="issue_category'+dt+'" name="data[VhsncMeeting][issue_category][]"><option value="">Select</option></select></div>\
                <div class="col-sm-3"><label>Issue Subcategory</label><select class="form-control"  id="issue_subcategory'+dt+'" name="data[VhsncMeeting][issue_subcategory][]"><option value="">Select</option></select></div>\
                <div class="col-sm-3"><label>Issue Details</label><input class="calbsp form-control" type="text" id="induction_training_date" name="data[VhsncMeeting][issue_details][]"></div></div>\
                <div class="row"><div class="col-sm-3"><label>Decision Taken</label><select class="form-control decisions" id="vhsnc_desig" name="data[VhsncMeeting][decisions_taken][]"><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>\
                <div class="col-sm-3"><label>Decision Details</label><input class="calbsp form-control" type="text" name="data[VhsncMeeting][decision_details][]"></div>\
                <div class="col-sm-3"><label>Issue Resolved</label><select class="form-control resolved" name="data[VhsncMeeting][issue_resolved][]"><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div></div>\
                <div class="row"><div class="col-sm-3"><label>Date of Resolved Issued</label><input type="date" class="form-control" id="vhsnc_desig" name="data[VhsncMeeting][issue_resolved_date][]"></div>\
                <div class="col-sm-3"><label>Remarks Of Issued</label><input class="calbsp form-control" type="text" name="data[VhsncMeeting][issue_remarks][]"></div>\
                <div class="col-sm-3"><label>Letter Issued BPMC</label><input class="form-control" type="text" name="data[VhsncMeeting][letter_issued_bpmc][]"></div></div>\
                <a href="#" class="remove_this btn btn-danger" style="margin-left:77%">X</a>\
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
    var s =1;
    var st = dt-s;
$("#issue_category"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueCategorys/getissue/",success:function(result){$("#issue_category"+st).html(result);}});

$("#issue_subcategory"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/getsubcat/",success:function(result){$("#issue_subcategory"+st).html(result);}});

});
  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('VhsncMeetingMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('VhsncMeetingIssueResolvedDate'));
 
// $("#ChecklistvhsncvhsncMeetingDate").click( function(e) {
// $('#ChecklistvhsncvhsncMeetingDate').attr('type', 'date');
//    });
    
  $("#VhsncMeetingIssueResolvedDate").click( function(e) {
 $('#VhsncMeetingIssueResolvedDate').attr('type', 'date');
    });  
        
  $("#ChecklistvhsncvhsncLevel").change(function(){
var c=$(this).val();
//alert(c);
if(c==='level1'){
    $('.level1').show();
    $('.level2').hide();
    $('.level3').hide();
    $('.level4').hide();
    $('.level5').hide();
        }
   else if(c==='level2'){
    $('.level1').hide();
    $('.level2').show();
    $('.level3').hide();
    $('.level4').hide(); 
    $('.level5').hide(); 
   }
   else if(c==='level3'){
    $('.level1').hide();
    $('.level2').hide();
    $('.level3').show();
    $('.level4').hide(); 
    $('.level5').hide(); 
   }
   else if(c==='level4'){
    $('.level1').hide();
    $('.level2').hide();
    $('.level3').hide();
    $('.level4').show(); 
    $('.level5').hide(); 
   }
   else if(c==='level5'){
    $('.level1').hide();
    $('.level2').hide();
    $('.level3').hide();
    $('.level4').hide(); 
    $('.level5').show(); 
   }
    else {
    $('.level1').show();
    $('.level2').show();
    $('.level3').show();
    $('.level4').show(); 
    $('.level5').show(); 
        }
});  

</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#VhsncMeetingNewIssue').val();
            num++ ;
                    $('#VhsncMeetingNewIssue').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
         var num= $('#VhsncMeetingNewIssue').val();
            num-- ;
                    $('#VhsncMeetingNewIssue').val(num);
        });
        
        jQuery(document).on('change', '.decisions', function() {
            c=$(this).val();
         var num= $('#VhsncMeetingDecisionTaken').val();
         if(c==='yes'){
              num++ ;
                    $('#VhsncMeetingDecisionTaken').val(num);
         }
         else {
              num-- ;
                    $('#VhsncMeetingDecisionTaken').val(num);
         }
           
        });
        jQuery(document).on('change', '.resolved', function() {
            c=$(this).val();
         var num= $('#VhsncMeetingSolvedIssue').val();
         if(c==='yes'){
              num++ ;
                    $('#VhsncMeetingSolvedIssue').val(num);
         }
         else {
              num-- ;
                    $('#VhsncMeetingSolvedIssue').val(num);
         }
           
        });




$( "#ChecklistvhsncvhsncMobileResponderOne" ).blur(function() {
    var c=$(this).val();
    if (c.length>12)
           {
                alert("Enter max 12 digit");
                $( "#ChecklistvhsncvhsncMobileResponderOne" ).val('');
                return false;
           }
         else if(c.length<10){
            alert("Enter min 10 digit");
                $( "#ChecklistvhsncvhsncMobileResponderOne" ).val('');
                return false;  
             
         }  
    });
    $( "#ChecklistvhsncvhsncMobileResponderTwo" ).blur(function() {
    var c=$(this).val();
    if (c.length>12)
           {
                alert("Enter max 12 digit");
                $( "#ChecklistvhsncvhsncMobileResponderTwo" ).val('');
                return false;
           }
         else if(c.length<10){
            alert("Enter min 10 digit");
                $( "#ChecklistvhsncvhsncMobileResponderTwo" ).val('');
                return false;  
             
         }  
    });
    
  }); 
  
  
  
  function my_function(){
      $('#refresh').load(location.href + ' #ChecklistvhsncvhsncEndTimeAssessment');
    }
    setInterval("my_function();",1000); 
    </script>