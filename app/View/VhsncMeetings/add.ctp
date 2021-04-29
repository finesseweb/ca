<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');
      ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   

<style>
    .col-sm-2{
        width:16%!important;
    }
    </style>

<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List VHSNC Meeting Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('VhsncMeeting'); ?>
<fieldset>
<legend><?php echo __(' VHSNC Meeting'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities),'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'--Select--')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'--Select--',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date of Meeting','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('vhsnc_quorum_ompleted',array('class' => 'form-control','label'=>' VHSNC Quorum Completed (More than 50%)','options'=>array(''=>'Select Quorum Status','yes'=>'Yes','no'=>'No')))."</div>";
?>
<!--<div class="col-sm-3">
     <label for="VhsncMeetingRegisterMember">Types of Reg. Member Participated</label>
    <?php  foreach($reg as $key=>$value) {
    ?>
     <div class="form-check">
         <input class="form-check-input" type="checkbox" name="data[VhsncMeeting][register_member][]" value="<?=$key?>" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
    <?=$value?>
  </label>
</div>
    <?php }?>
   </div>-->
<?php
//echo "<div class='col-sm-3'>".$this->Form->input('register_member',array('class' => 'form-control','type'=>'checkbox','label'=>'Types of Reg. Member Participated','multiple'=>'checkbox','value'=>$reg))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('register_member',array('class' => 'form-control','label'=>'Types of Reg. Member Participated','multiple'=>'multiple','options'=>array($reg),'style'=>'height:150px'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_facilitated',array('class' => 'form-control','label'=>'Meeting Facilitated by','options'=>array(''=>'Select Member Type',$facilitated)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('new_issue',array('class' => 'form-control','label'=>' No. New Issues Identified ','readonly'=>'readonly','value'=>'0','max'=>'9'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('decision_taken',array('class' => 'form-control','label'=>'Decisions Taken (No.)','readonly'=>'readonly','max'=>'9'))."</div>";
echo "<div class='col-sm-3'></div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues Resolved (No.)','readonly'=>'readonly','max'=>'9'))."</div>";
echo  "<div class='col-sm-3'><button type='button' class='btn btn-primary' id='showHide'>Add Issue</button></div>";
echo "<div id='issuedetails'>";
echo "<div class='issuefirst' id='issuefirst'>";
echo "<legend class='col-sm-12'>Issue details</legend>";
echo "<div class='col-sm-12'><label>Issue : 1</label>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('issue_details',array('class' => 'form-control','type'=>'text','name'=>'data[VhsncMeeting][issue_details][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_category',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[VhsncMeeting][issue_category][]','options'=>array(''=>'--Select--',$issue)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','name'=>'data[VhsncMeeting][issue_level][]','options'=>array(''=>'--Select--',$subissue)))."</div>";
echo "</div></div>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-3'>".$this->Form->input('decisions_taken',array('class' => 'form-control','label'=>'Decision Taken <span style="color:red">*</span>','name'=>'data[VhsncMeeting][decisions_taken][] ','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('decision_details',array('class' => 'form-control','name'=>'data[VhsncMeeting][decision_details][]','type'=>'text'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue Resolved <span style="color:red">*</span>','name'=>'data[VhsncMeeting][issue_resolved][]','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No','not applicable'=>'Not Applicable')))."</div>";


echo "</div></div>";

echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved_date',array('class' => 'form-control','name'=>'data[VhsncMeeting][issue_resolved_date][]','type'=>'text','label'=>'Date of Resolved Issued','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('issue_remarks',array('class' => 'form-control','name'=>'data[VhsncMeeting][issue_remarks][]','type'=>'text','label'=>'Remarks of Issued'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('letter_issued_bpmc',array('class' => 'form-control','name'=>'data[VhsncMeeting][letter_issued_bpmc][]','type'=>'number','label'=>'Letter Issued to Higher Authority'))."</div>";
echo "<div class='col-sm-2'><a href='#' id='remove' class='btn btn-danger' name='remove' style='margin-top: 18px;'>X</a></div>";
echo "</div></div></div>";
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



$(document).ready(function(){
    //$('#append').hide(); 
$("#VhsncMeetingIssueCategory").change(function(){
var c=$(this).val();
$('#VhsncMeetingIssueSubcategory').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/fetchsubcat/"+c,success:function(result){$("#VhsncMeetingIssueSubcategory").html(result);}});

});
 <?php if($sessionrole!='CC' || $sessionrole!='BPC' ) { ?>

$("#VhsncMeetingDistrict").change(function(){
var c=$(this).val();
$('#VhsncMeetingBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#VhsncMeetingBlock").html(result);}});

});
 <?php } ?>
 <?php if($sessionrole!='CC') { ?>

$("#VhsncMeetingBlock").change(function(){
var c=$(this).val();
$('#VhsncMeetingPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#VhsncMeetingPanchayat").html(result);}});

});
 <?php } ?>
$("#VhsncMeetingPanchayat").change(function(){
var c=$(this).val();
$('#VhsncMeetingVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#VhsncMeetingVillage").html(result);}});

});

//$("#VhsncMeetingVillage").change(function(){
//var c=$(this).val();
//$('#VhsncMeetingWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#VhsncMeetingWard").html(result);}});

//});

$("#VhsncMeetingDecisionsTaken").change(function(){
var c=$(this).val();
var d = $('#VhsncMeetingDecisionTaken').val();
//alert(c);
if(c==='yes'){
    $('#VhsncMeetingDecisionTaken').val(1);
        }
        else if(c==='no') {
            if(d>0) {
                d--;
           $('#VhsncMeetingDecisionTaken').val(d); 
            }
        }
});
$("#VhsncMeetingIssueResolved").change(function(){
var c=$(this).val();
var d = $('#VhsncMeetingSolvedIssue').val();
//alert(c);
if(c==='yes'){
    $('#VhsncMeetingSolvedIssue').val(1);
        }
        else if(c==='no'){
            
          if(d>0) {
                d--;
           $('#VhsncMeetingSolvedIssue').val(d); 
            } 
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
        $(".field_div").append('<div class="row append"><div class="col-sm-12"><label id="issue'+n+'">Issue : '+' '+n+' </label></div>\
                <div class="col-sm-6"><label>Issue Details</label><input class="calbsp form-control" type="text" id="induction_training_date" name="data[VhsncMeeting][issue_details][]"></div>\
                <div class="col-sm-3"><label>Issue Category <span style="color:red">*</span></label><select class="form-control" id="issue_category'+dt+'" name="data[VhsncMeeting][issue_category][]" required><option value="">Select</option></select></div>\
                <div class="col-sm-3"><label>Issue Level <span style="color:red">*</span></label><select class="form-control"  id="issue_level'+dt+'" name="data[VhsncMeeting][issue_level][]" required><option value="">Select</option></select></div>\
                <div class="col-sm-3"><label>Decision Taken <span style="color:red">*</span></label><select class="form-control decisions" id="decision_taken'+dt+'" name="data[VhsncMeeting][decisions_taken][]" required><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>\
                <div class="col-sm-6"><label>Decision Details</label><input class="calbsp form-control" type="text" name="data[VhsncMeeting][decision_details][]"></div>\
                <div class="col-sm-3"><label>Issue Resolved <span style="color:red">*</span></label><select class="form-control resolved" id="resolved'+dt+'" name="data[VhsncMeeting][issue_resolved][]" required><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option><option value="not applicable">Not Applicable</option></select></div>\
                <div class="col-sm-3"><label>Date of Resolved Issued</label><input type="text" class="form-control" id="issue_resolved_date'+dt+'" name="data[VhsncMeeting][issue_resolved_date][]" readonly> </div>\
                <div class="col-sm-4"><label>Remarks of Issued</label><input class="calbsp form-control" type="text" name="data[VhsncMeeting][issue_remarks][]"></div>\
                <div class="col-sm-4"><label>Letter Issued to Higher Authority</label><input class="form-control" type="text" name="data[VhsncMeeting][letter_issued_bpmc][]"></div>\
                <a href="#" class="remove_this btn btn-danger" id="'+n+'" style="margin-top:18px;">X</a>\
</div>');
    dt++;
    n++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
         dt--;
        var nodec = $('#decision_taken'+dt).val();
        var nores = $('#resolved'+dt).val(); 
        
        
       // $("$issue'+n+'").hide();
       
       var num= $('#VhsncMeetingNewIssue').val();
       if(num>0) {
            num-- ;
                    $('#VhsncMeetingNewIssue').val(num);
                    
        }
            var dec= $('#VhsncMeetingDecisionTaken').val();
            
               if(dec==''){
                  $('#VhsncMeetingDecisionTaken').val(0);
                   }
                else {
                    if(nodec==='yes'){
                    if(dec>0){
                   dec-- ;
                    $('#VhsncMeetingDecisionTaken').val(dec);
                }
                 } }  
             var res= $('#VhsncMeetingSolvedIssue').val();
                if(res==''){
                  $('#VhsncMeetingSolvedIssue').val(0);
                   }
                else {
                     if(nores==='yes'){ 
                    if(res>0){
                    res-- ;
                    $('#VhsncMeetingSolvedIssue').val(res); 
                }
                 } }        
             
            jQuery(this).parent().remove();
          
        return false;
        });

$("#append").click( function() {
    var s =1;
    var st = dt-s;
$("#issue_category"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueCategorys/getissue/",success:function(result){$("#issue_category"+st).html(result);}});

$("#issue_level"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/getsubcat/",success:function(result){$("#issue_level"+st).html(result);}});

$("#resolved"+st).change( function() {
//alert(st);
 r=$(this).val();
var m = $("#VhsncMeetingMeetingDate").val();

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
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('VhsncMeetingMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('VhsncMeetingIssueResolvedDate'));
 
// $("#VhsncMeetingMeetingDate").click( function(e) {
// $('#VhsncMeetingMeetingDate').attr('type', 'date');
//    });
    
  //$("#VhsncMeetingIssueResolvedDate").click( function(e) {
 //$('#VhsncMeetingIssueResolvedDate').attr('type', 'date');
   // });  
        
    

</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#VhsncMeetingNewIssue').val();
            num++ ;
                    $('#VhsncMeetingNewIssue').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
    var v =$("#VhsncMeetingNewIssue").val(); 
     if(v==='0'){
   $("#showHide").removeAttr('disabled'); 
   } 
            
        });
        
   $("#issuedetails").hide(); 
   $("#showHide").click(function() { 
   $("#issuedetails").show(); 
    $("#issuefirst").show(); 
   $("#VhsncMeetingNewIssue").val(1); 
   $("#VhsncMeetingDecisionsTaken").prop('required','required');
   $("#VhsncMeetingIssueResolved").prop('required','required');
   $("#VhsncMeetingIssueCategory").prop('required','required');
   $("#VhsncMeetingIssueLevel").prop('required','required');
   
    $("#showHide").prop('disabled','disabled'); 
       
       
   });
   $("#remove").click(function() { 
   $("#issuefirst").hide(); 
   var c =$("#VhsncMeetingNewIssue").val(); 
   if(c>0){
       c--;
       $("#VhsncMeetingNewIssue").val(c);
   }
   var v =$("#VhsncMeetingNewIssue").val(); 
     if(v==='0'){
   $("#showHide").removeAttr('disabled'); 
   }       
   });
   // var c =$("#VhsncMeetingNewIssue").val(); 
   
    
  
    });
    
    
 $('#VhsncMeetingRegisterMember').multiselect({
  nonSelectedText: 'Select Members',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});


 $("#VhsncMeetingIssueResolved").change( function(e) {
      c=$(this).val();
var m = $("#VhsncMeetingMeetingDate").val();

 if(c==='yes'){
  $("#VhsncMeetingIssueResolvedDate").val(m);
}
else {
     $("#VhsncMeetingIssueResolvedDate").val(''); 
}

    });
    </script>

<script>

(function() {
  var previous;

  jQuery(document).on('focus', '.decisions', function() {
            previous = this.value;    
            
        }).on('change', '.decisions', function() {
          // alert(previous);
            c=$(this).val();
         var num= $('#VhsncMeetingDecisionTaken').val();
         if(c==='yes'){
              ++num ;
                    $('#VhsncMeetingDecisionTaken').val(num);
         }
        else if(c==='no') {
            if(previous==='yes') {
                  num--
                    $('#VhsncMeetingDecisionTaken').val(num);
              }
           }
         else {
             
            $('#VhsncMeetingDecisionTaken').val(num);
         }
         previous = this.value;  
        });
})();


(function() {
  var prevalue;

  jQuery(document).on('focus', '.resolved', function() {
            prevalue = this.value;    
            
        }).on('change', '.resolved', function() {
          /// alert(previous);
            c=$(this).val();
         var num= $('#VhsncMeetingSolvedIssue').val();
         if(c==='yes'){
              ++num ;
                    $('#VhsncMeetingSolvedIssue').val(num);
         }
        else if(c==='no') {
            if(prevalue==='yes') {
                  num--
                    $('#VhsncMeetingSolvedIssue').val(num);
              }
           }
         else {
             
            $('#VhsncMeetingSolvedIssue').val(num);
         }
          prevalue = this.value;   
        });
})();



</script>