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
<legend><?php echo __('VHSNC Meeting'); ?></legend>
<div class="row">
<?php

//print_r($this->request->data['VhsncMeeting']['register_member']);
//die();
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'1'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'Select District',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'Select Block',$blocks)))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'Select Panchayat',$panchayat)))."</div>";
?>
    <div class="col-sm-3"><div class="input select required"><label for="VhsncMeetingVillage">Village</label><select name="data[VhsncMeeting][village]" class="form-control" id="VhsncMeetingVillage" required="required">
<option value="">All Village</option>
<?php foreach($village as $key=>$value){
    ?>
<option value="<?=$key?>" <?php if($this->request->data['VhsncMeeting']['village']==$key) { echo "selected"; }?>><?=$value?></option>

<?php 
}
?>
</select></div></div>
    <?php
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date of Meeting','value'=>date('d-m-Y',strtotime($this->request->data['VhsncMeeting']['meeting_date'])),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('vhsnc_quorum_ompleted',array('class' => 'form-control','label'=>' VHSNC Quorum Completed','options'=>array(''=>'Select Quorum Status','yes'=>'Yes','no'=>'No')))."</div>";
?>
<!-- <div class="col-sm-3">
     <label for="VhsncMeetingRegisterMember">Types of Reg. Member Participated</label>
    <?php // foreach($reg as $key=>$value) {
          //////$men =explode(',',$this->request->data['VhsncMeeting']['register_member']);
    ?>
     <div class="form-check">
         <input class="form-check-input" type="checkbox" name="data[VhsncMeeting][register_member][]" value="<?$key?>" <?php //for($i=0;$i<count($men);$i++){ if($key==$men[$i]) { echo "checked" ;} }?> id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
    <?//$value?>
  </label>
</div>
    <?php //}?>
   </div>-->
<div class="col-sm-3"><div class="input select"><label for="VhsncMeetingRegisterMember">Types of Reg. Member Participated</label><input type="hidden" name="data[VhsncMeeting][register_member]" value="" id="VhsncMeetingRegisterMember_">
        <select name="data[VhsncMeeting][register_member][]" class="form-control select" multiple="multiple" id="VhsncMeetingRegisterMember" style="height:150px">

    <?php 
   
  foreach($reg as $key=>$value) {
         $men =explode(',',$this->request->data['VhsncMeeting']['register_member']);
    
         
        
        ?>
    <option value="<?=$key?>" <?php for($i=0;$i<count($men);$i++){ if($key==$men[$i]) { echo "selected" ;} }?> ><?=$value?></option>
    <?php  } ?>
</select></div></div>
<?php
//echo "<div class='col-sm-3'>".$this->Form->input('register_member',array('class' => 'form-control','label'=>'Types of Reg. Member Participated','multiple'=>'multiple','options'=>array($reg)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_facilitated',array('class' => 'form-control','label'=>'Meeting Facilitated by','options'=>array(''=>'Select Member Type',$facilitated)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('new_issue',array('class' => 'form-control','label'=>' No. New Issues Identified ','readonly'=>'readonly','value'=>'1','max'=>'9'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('decision_taken',array('class' => 'form-control','label'=>'Decisions Taken (No.)','readonly'=>'readonly','max'=>'9'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly','max'=>'9'))."</div>";
echo "<legend class='col-sm-12'>Issue details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('issue_details',array('class' => 'form-control','type'=>'text','name'=>'data[VhsncMeeting][issue_details]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_category',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[VhsncMeeting][issue_category]','required'=>'required','options'=>array(''=>'--Select',$issue)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','name'=>'data[VhsncMeeting][issue_level]','required'=>'required','options'=>array(''=>'--Select--',$subissue)))."</div>";
echo "</div></div>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-3'>".$this->Form->input('decisions_taken',array('class' => 'form-control','label'=>'Decisions Taken <span style="color:red">*</span>','name'=>'data[VhsncMeeting][decisions_taken]','required'=>'required','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('decision_details',array('class' => 'form-control','name'=>'data[VhsncMeeting][decision_details]','type'=>'text'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue Resolved <span style="color:red">*</span>','name'=>'data[VhsncMeeting][issue_resolved]','required'=>'required','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No','not applicable'=>'Not Applicable')))."</div>";
//echo "<a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;'>+</a>";

echo "</div></div>";

echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-3' style='display:none'>".$this->Form->input('issue_resolved_date_new',array('class' => 'form-control','name'=>'data[VhsncMeeting][issue_resolved_date_new]','type'=>'text','label'=>'Date of Resolved Issued','value'=>date('Y-m-d',strtotime($this->request->data['VhsncMeeting']['meeting_date']))))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved_date',array('class' => 'form-control','name'=>'data[VhsncMeeting][issue_resolved_date]','type'=>'text','label'=>'Date of Resolved Issued','value'=>date('d-m-Y',strtotime($this->request->data['VhsncMeeting']['issue_resolved_date']))))."</div>";
echo "<div class='col-sm-5'>".$this->Form->input('issue_remarks',array('class' => 'form-control','name'=>'data[VhsncMeeting][issue_remarks]','type'=>'text','label'=>'Remarks of Issued'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('letter_issued_bpmc',array('class' => 'form-control','name'=>'data[VhsncMeeting][letter_issued_bpmc]','type'=>'number','label'=>'Letter Issued to Higher Authority'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";

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

numtake= $('#VhsncMeetingDecisionTaken').val();
$("#VhsncMeetingDecisionsTaken").change(function(){
var c=$(this).val();
//alert(c);
if(c==='yes'){
 numtake++;
    $('#VhsncMeetingDecisionTaken').val(numtake);
        }
   else {
     numtake--;
           $('#VhsncMeetingDecisionTaken').val(numtake); 
        }
});

var numissue=$('#VhsncMeetingSolvedIssue').val();
$("#VhsncMeetingIssueResolved").change(function(){
var c=$(this).val();
//alert(num);
if(c==='yes'){
 numissue++
    $('#VhsncMeetingSolvedIssue').val(numissue);
        }
        else {
     numissue--
           $('#VhsncMeetingSolvedIssue').val(numissue); 
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
                <div class="col-sm-3"><label>Issue Level</label><select class="form-control"  id="issue_subcategory'+dt+'" name="data[VhsncMeeting][issue_subcategory][]"><option value="">Select</option></select></div>\
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
 
// $("#VhsncMeetingMeetingDate").click( function(e) {
// $('#VhsncMeetingMeetingDate').attr('type', 'date');
//    });
//    
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

    });
    
   $('#VhsncMeetingRegisterMember').multiselect({
  nonSelectedText: 'Select Members',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});
    </script>
  <script>
$("#VhsncMeetingIssueResolvedDate").change( function(e) {

       var startDate = $("#VhsncMeetingIssueResolvedDateNew").val(); 
       var endDate = $("#VhsncMeetingIssueResolvedDate").val();  
       var d = new Date(); 
    
       var month = d.getMonth()+1;
        var day = d.getDate();
      var output = d.getFullYear() + '-' +
    ((''+month).length<2 ? '0' : '') + month + '-' +
    ((''+day).length<2 ? '0' : '') + day;

    if ((Date.parse(startDate) > Date.parse(endDate) || Date.parse(endDate) > Date.parse(output))) {
        alert("Date should be Between or Equal Meeting Date and Current Date");
        $("#VhsncMeetingIssueResolvedDate").val("");
    }
   });  

var resolve = $("#VhsncMeetingIssueResolved").val();
if(resolve==='no' || resolve==='not applicable' || resolve===''){
$("#VhsncMeetingIssueResolvedDate").val('');
}
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