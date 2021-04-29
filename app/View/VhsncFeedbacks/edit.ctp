<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
$sessionrole=$this->Session->read('User.subrole');      
?>
<style>
    .col-sm-2{
        width:16%!important;
    }
    </style>

<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List VHSNC Feedback Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('VhsncFeedback'); ?>
<fieldset>
<legend><?php echo __(' VHSNC Feedback'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'1'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'All Villages',$village)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'--Select--',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date of Meeting','value'=>date('d-m-Y',strtotime($this->request->data['VhsncFeedback']['meeting_date'])),'readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('vhsnc_quorum_ompleted',array('class' => 'form-control','label'=>' VHSNC Quorum Completed','options'=>array(''=>'Select Quorum Status','yes'=>'Yes','no'=>'No')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('register_member',array('class' => 'form-control','label'=>'Types of Reg. Member Participated','options'=>array(''=>'Select Member Type',$reg)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('meeting_facilitated',array('class' => 'form-control','label'=>'Meeting Facilitated by','options'=>array(''=>'Select Member Type',$facilitated)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('name',array('class' => 'form-control','label'=>'Name'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('mobile',array('class' => 'form-control','label'=>'Mobile Number'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control','label'=>'Remarks'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";

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
    
<!--    <table class="table table-striped"> 
        <thead>
        <th>Title/Question</th><th>Response</th><th>Remarks</th>
        <tbody>
            
          <tr>
              <td colspan="3"><? //$this->request->data['VhsncFeedback']['feed_title']?>
                   <?php  $count=0;
                  $questionlist=$this->requestAction(array("controller"=>"subfeedbacks","action"=>"gettitle",$this->request->data['VhsncFeedback']['feed_title'])); 
                 // print_r($questionlist['Subfeedback']);
                 //die();
                  $title=$this->requestAction(array("controller"=>"feedbacks","action"=>"gettitle",$questionlist['Subfeedback']['cat_id'])); 
                  
                  
                  echo ucwords($title['Feedback']['name']);
                  ?>
                
               <input type="hidden" name="data[VhsncFeedback][hidden]" id="VhsncFeedbackHidden" value="<?=$this->request->data['VhsncFeedback']['feed_title']?>">
              </td>
       
            </tr>
            <tr><td  style="background-color: aliceblue" class="question" id="feedId">
                    
                     <?php
                     $questionlist=$this->requestAction(array("controller"=>"subfeedbacks","action"=>"gettitle",$this->request->data['VhsncFeedback']['question'])); 
                 echo $questionlist['Subfeedback']['name'];
                 ?>
                    <?php //$this->request->data['VhsncFeedback']['question']?>
<input class="form-control question" type="hidden" name="data[VhsncFeedback][question]" readonly="readonly" value="<?=ucfirst($this->request->data['VhsncFeedback']['question'])?>">
             
              </td>
              <td><select class="form-control question" name="data[VhsncFeedback][response]" id="FeedbackResponce">
                       <option value="">p;u djs</option> 
                   <option value="<?=$questionlist['Subfeedback']['responce_one']?>" <?php if($this->request->data['VhsncFeedback']['response']==$questionlist['Subfeedback']['responce_one']) { ?> selected="selected" <?php }?>> <?=($questionlist['Subfeedback']['responce_one'])?></option> 
                  <option value="<?=$questionlist['Subfeedback']['responce_two']?>" <?php if($this->request->data['VhsncFeedback']['response']==$questionlist['Subfeedback']['responce_two']) { ?> selected="selected" <?php }?>> <?=($questionlist['Subfeedback']['responce_two'])?> </option>
                   <?php if($questionlist['Subfeedback']['responce_three']!=''){?>
                  <option value="<?=$questionlist['Subfeedback']['responce_three']?>" <?php if($this->request->data['VhsncFeedback']['response']==$questionlist['Subfeedback']['responce_three']) { ?> selected="selected" <?php }?>> <?=($questionlist['Subfeedback']['responce_three'])?> </option>
                   <?php } ?>
                  </select>
              </td>
          <td><input class="form-control question" type="text" name="data[VhsncFeedback][feedback_remarks]" value="<?=ucfirst($this->request->data['VhsncFeedback']['feedback_remarks'])?>"></td>
          </tr>
    
         
           
        </tbody>
        </thead> 
        </table>-->
<?php 
//echo "<div class='col-sm-12'><a href='#' class='btn btn-danger intro'>Process Data please Wait ---</a></div>";

echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">



$(document).ready(function(){
    //$('#append').hide(); 
var c=$("#VhsncFeedbackHidden").val();
 
$.ajax({url:"<?=SITE_PATH?>subfeedbacks/fetchcat/"+c,success:function(result){$("#getquestons").html(result);}});
 <?php if($sessionval!='regular') { ?>
$("#VhsncFeedbackDistrict").change(function(){
var c=$(this).val();
$('#VhsncFeedbackBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#VhsncFeedbackBlock").html(result);}});

});

<?php } ?>
	<?php if($sessionrole!='CC') { ?>

$("#VhsncFeedbackBlock").change(function(){
var c=$(this).val();
$('#VhsncFeedbackPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#VhsncFeedbackPanchayat").html(result);}});

});
 <?php }?>
$("#VhsncFeedbackPanchayat").change(function(){
var c=$(this).val();
$('#VhsncFeedbackVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#VhsncFeedbackVillage").html(result);}});

});

//$("#VhsncFeedbackVillage").change(function(){
//var c=$(this).val();
//$('#VhsncFeedbackWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#VhsncFeedbackWard").html(result);}});
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
 
 $("#VhsncFeedbackMeetingDate").click( function(e) {
 $('#VhsncFeedbackMeetingDate').attr('type', 'date');
    });
    
  $("#VhsncMeetingIssueResolvedDate").click( function(e) {
 $('#VhsncMeetingIssueResolvedDate').attr('type', 'date');
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
$( "#VhsncFeedbackMobile" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
                 setTimeout(function(){$('#VhsncFeedbackMobile').focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
                 setTimeout(function(){$('#VhsncFeedbackMobile').focus();}, 2);
                return false;  
             
         }  
    });
    
    });
    </script>
       <script>
            
            $(document).ready(function(){
             var d=  $("#FeedbackResponce").val();  
               if(d=='gkWa'){
                      $("#feedId").css("background-color","lightgreen");
                        }
                        
                       else if(d=='ugha'){
                      $("#feedId").css("background-color","#ff7575");
                        }
                        
                        else if(d==''){
                      $("#feedId").css("background-color","aliceblue");
                        }
                        
                        
                       else {
                      $("#feedId").css("background-color","orange");
                        }  
                
               $("#FeedbackResponce").change(function(){
                   var c=$(this).val();
                   if(c=='gkWa'){
                      $("#feedId").css("background-color","lightgreen");
                        }
                        
                       else if(c=='ugha'){
                      $("#feedId").css("background-color","#ff7575");
                        }
                        
                        else if(c==''){
                      $("#feedId").css("background-color","aliceblue");
                        }
                        
                        
                       else {
                      $("#feedId").css("background-color","orange");
                        }
                   
               }); 
                
            });
            
//            
//            $('.submit').click(function(){
//   $(".intro").css("display","block");
//    
//});

            
              </script>