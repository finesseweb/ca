<style>
    .col-sm-2{
        width:19%!important;
    }
    </style>
<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
 $sessionrole=$this->Session->read('User.subrole');     
?>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List ANM Meeting Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('AnmMeeting'); ?>
<fieldset>
<legend><?php echo __('ANM Meeting'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class' => 'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_chaired_by',array('class' => 'form-control','label'=>'Meeting chaired by','options'=>array(''=>'Select Options','MOIC'=>'MOIC','BHM'=>'BHM','BCM'=>'BCM','others'=>'Other')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('register_member',array('class' => 'form-control','label'=>'Types of Reg. Member Participated','multiple'=>'multiple','options'=>array($reg)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_issue',array('class' => 'form-control','label'=>' No. New Issues Identified ','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_decision',array('class' => 'form-control','label'=>'No of Decisions taken','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control'))."</div>";
echo  "<div class='col-sm-4'><button type='button' class='btn btn-primary' id='showHide'>Add Issue</button></div>";
echo "<div id='issuedetails'>";
echo "<legend class='col-sm-12'>Issue details</legend>";
echo "<div class='col-sm-12'><label>Issue : 1</label>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('key_issues_discussed',array('type'=>'text','class' => 'form-control','name'=>'data[AnmMeeting][key_issues_discussed][]'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('issues_raised_by',array('class' => 'form-control','name'=>'data[AnmMeeting][issues_raised_by_bpc][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_category',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[AnmMeeting][issue_category][]','options'=>array(''=>'Select Category',$issue)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','name'=>'data[AnmMeeting][issue_level][]','options'=>array(''=>'Select Category',$subissue)))."</div>";

echo "<div class='col-sm-2'>".$this->Form->input('decisions_taken',array('class' => 'form-control','label'=>'Decisions Taken <span style="color:red">*</span>','name'=>'data[AnmMeeting][decisions_taken][]','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";

echo "<div class='col-sm-6'>".$this->Form->input('decision_details',array('type'=>'text','class' => 'form-control','name'=>'data[AnmMeeting][decision_details][]'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue Resolved <span style="color:red">*</span>','name'=>'data[AnmMeeting][issue_resolved][]','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('resolved_date',array('class' => 'form-control','name'=>'data[AnmMeeting][resolved_date][]','type'=>'text','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('details_of_issues_resolved',array('class' => 'form-control','name'=>'data[AnmMeeting][details_of_issues_resolved][]','type'=>'text','label'=>'Details of Issues Resolved/Reason'))."</div>";
echo "<div class='col-sm-1'><a href='#' id='remove' class='btn btn-danger' name='remove' style='margin-top: 18px;'>X</a></div>";
echo "</div></div>";
echo "<div class='col-sm-12 field_div'></div>";
echo "<div class='col-sm-12'><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left:15px;'>+</a></div></div>";


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
$("#AnmMeetingIssueCategory").change(function(){
var c=$(this).val();
$('#AnmMeetingIssueSubcategory').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/fetchsubcat/"+c,success:function(result){$("#AnmMeetingIssueSubcategory").html(result);}});

});
<?php if($sessionval!='regular') { ?>
$("#AnmMeetingDistrict").change(function(){
var c=$(this).val();
$('#AnmMeetingBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#AnmMeetingBlock").html(result);}});

});
<?php }?>
$("#AnmMeetingVillage").change(function(){
var c=$(this).val();
$('#AnmMeetingWard').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#AnmMeetingWard").html(result);}});

});
$("#AnmMeetingDecisionsTaken").change(function(){
var c=$(this).val();
 var d = $('#AnmMeetingNoOfDecision').val();
//alert(c);
if(c==='yes'){
    $('#AnmMeetingNoOfDecision').val(1);
        }
       else if(c==='no') {
            if(d>0) {
                d--;
           $('#AnmMeetingNoOfDecision').val(d); 
            }
        }
});
$("#AnmMeetingIssueResolved").change(function(){
var c=$(this).val();
var d = $('#AnmMeetingSolvedIssue').val();
//alert(c);
if(c==='yes'){
    $('#AnmMeetingSolvedIssue').val(1);
        }
         else if(c==='no') {
            if(d>0) {
                d--;
           $('#AnmMeetingSolvedIssue').val(d); 
           
            }
        }
});

});
</script>
<script>
jQuery(document).ready( function () {
     var dt=1;
     var t=2
        $("#append").click( function(e) {
           
          e.preventDefault();
        $(".field_div").append('<div class="row append"><label>Issue :'+' '+t+'</label>\
                <div class="col-sm-6"><label>Key Issues Discussed</label><input type="text" class="form-control" id="issue_discuss'+dt+'" name="data[AnmMeeting][key_issues_discussed][]"></div>\
                <div class="col-sm-3"><label>Issues Raised By</label><input class="calbsp form-control" type="text" id="induction_training_date" name="data[AnmMeeting][issues_raised_by_bpc][]"></div>\
                <div class="col-sm-3"><label>Issue Category <span style="color:red">*</span></label><select class="form-control" id="issue_category'+dt+'" name="data[AnmMeeting][issue_category][]" required><option value="">Select</option></select></div>\
                <div class="col-sm-3"><label>Issue Level <span style="color:red">*</span></label><select class="form-control"  id="issue_level'+dt+'" name="data[AnmMeeting][issue_level][]" required><option value="">Select</option></select></div>\
                 <div class="col-sm-3"><label>Decisions Taken <span style="color:red">*</span> </label><select class="calbsp form-control decisions" id="decisions'+dt+'" name="data[AnmMeeting][decisions_taken][]" required><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>\
                <div class="col-sm-6"><label>Decisions Details</label><input type="text" class="calbsp form-control" type="text" name="data[AnmMeeting][decision_details][]"></div>\
                <div class="col-sm-3"><label>Issue Resolved <span style="color:red">*</span></label><select class="form-control resolved" id="resolved'+dt+'" name="data[AnmMeeting][issue_resolved][]" required><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>\
                 <div class="col-sm-2"><label>Resolved Date</label><input class="form-control" id="resolved_date'+dt+'" name="data[AnmMeeting][resolved_date][]" type="text" readonly="readonly"></div>\
                <div class="col-sm-6"><label>Details of Issues Resolved/Reason</label><input class="form-control" type="text" name="data[AnmMeeting][details_of_issues_resolved][]"></div>\
               <a href="#" class="remove_this btn btn-danger" style="margin-top:18px">X</a>\
</div>');
    dt++;
     t++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
        dt--;
        var nodec = $('#decisions'+dt).val();
        var nores = $('#resolved'+dt).val();  
        var num= $('#AnmMeetingNoOfIssue').val();
       if(num>0) {
            num-- ;
                    $('#AnmMeetingNoOfIssue').val(num);
                    
        }
           
            var dec= $('#AnmMeetingNoOfDecision').val();
            
               if(dec==''){
                  $('#AnmMeetingNoOfDecision').val(0);
                   }
                else {
                   if(nodec==='yes'){ 
                    if(dec>0){
                   dec-- ;
                    $('#AnmMeetingNoOfDecision').val(dec);
                }
                 }
                 }   
             var res= $('#AnmMeetingSolvedIssue').val();
                if(res==''){
                  $('#AnmMeetingSolvedIssue').val(0);
                   }
                else {
                   if(nores==='yes'){ 
                    if(res>0){
                    res-- ;
                    $('#AnmMeetingSolvedIssue').val(res); 
                }
                }
                 } 
                 
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
var m = $("#AnmMeetingMeetingDate").val();

 if(r==='yes'){
  $("#resolved_date"+st).val(m);
}
else {
     $("#resolved_date"+st).val(''); 
}

});
});
  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('AnmMeetingMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('AnmMeetingIssueResolvedDate'));
// 
// $("#AnmMeetingMeetingDate").click( function(e) {
// $('#AnmMeetingMeetingDate').attr('type', 'date');
//    });
    
//  $("#AnmMeetingResolvedDate").click( function(e) {
// $('#AnmMeetingResolvedDate').attr('type', 'date');
//    });  
  $("#AnmMeetingIssueResolved").change( function() {
//alert(st);
 r=$(this).val();
var m = $("#AnmMeetingMeetingDate").val();

 if(r==='yes'){
  $("#AnmMeetingResolvedDate").val(m);
}
else {
     $("#AnmMeetingResolvedDate").val(''); 
}

});      
   $("#issuedetails").hide(); 
   $("#showHide").click(function() { 
   $("#issuedetails").show(); 
    $("#issuefirst").show(); 
   $("#AnmMeetingNoOfIssue").val(1); 
    $("#showHide").prop('disabled','disabled'); 
    $("#AnmMeetingIssueCategory").prop('required','required');
   $("#AnmMeetingIssueLevel").prop('required','required');
   $("#AnmMeetingDecisionsTaken").prop('required','required');
   $("#AnmMeetingIssueResolved").prop('required','required');
   }); 
   
  $("#remove").click(function() { 
   $("#issuedetails").hide(); 
   var c =$("#AnmMeetingNoOfIssue").val(); 
   if(c>0){
       c--;
       $("#AnmMeetingNoOfIssue").val(c);
   }
   var d =$("#AnmMeetingNoOfDecision").val(); 
   if(d>0){
       d--;
       $("#AnmMeetingNoOfDecision").val(d);
   }
   var s =$("#AnmMeetingSolvedIssue").val(); 
   if(s>0){
       s--;
       $("#AnmMeetingSolvedIssue").val(s);
   }
   var v =$("#AnmMeetingNoOfIssue").val(); 
     if(v==='0'){
   $("#showHide").removeAttr('disabled'); 
   }       
       
   });  

</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#AnmMeetingNoOfIssue').val();
            num++ ;
                    $('#AnmMeetingNoOfIssue').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
         var v= $('#AnmMeetingNoOfIssue').val();
             if(v==='0'){
   $("#showHide").removeAttr('disabled'); 
   } 
       
        });
        
      
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
         var num= $('#AnmMeetingNoOfDecision').val();
         if(c==='yes'){
              ++num ;
                    $('#AnmMeetingNoOfDecision').val(num);
         }
        else if(c==='no') {
            if(previous==='yes') {
                  num--
                    $('#AnmMeetingNoOfDecision').val(num);
              }
           }
         else {
             
            $('#AnmMeetingNoOfDecision').val(num);
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
         var num= $('#AnmMeetingSolvedIssue').val();
         if(c==='yes'){
              ++num ;
                    $('#AnmMeetingSolvedIssue').val(num);
         }
        else if(c==='no') {
            if(prevalue==='yes') {
                  num--
                    $('#AnmMeetingSolvedIssue').val(num);
              }
           }
         else {
             
            $('#AnmMeetingSolvedIssue').val(num);
         }
          prevalue = this.value;   
        });
})();

</script>