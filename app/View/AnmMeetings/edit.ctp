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
<legend><?php echo __(' ANM Meeting'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'1'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class' => 'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'Select Block',$blocks)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y',strtotime($this->request->data['AnmMeeting']['meeting_date'])),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_chaired_by',array('class' => 'form-control','label'=>'Meeting chaired by','options'=>array(''=>'Select Options','MOIC'=>'MOIC','BHM'=>'BHM','BCM'=>'BCM','others'=>'Other')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('register_member',array('class' => 'form-control','label'=>'Types of Reg. Member Participated','multiple'=>'multiple','options'=>array($reg)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_decision',array('class' => 'form-control','label'=>'No of Decisions taken','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";
echo "<legend class='col-sm-12'>Issue details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('key_issues_discussed',array('type'=>'text','class' => 'form-control','name'=>'data[AnmMeeting][key_issues_discussed]'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('issues_raised_by_bpc',array('class' => 'form-control','name'=>'data[AnmMeeting][issues_raised_by_bpc]','label'=>'Issues Raised By'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_category',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[AnmMeeting][issue_category]','required'=>'required','options'=>array(''=>'Select Category',$issue)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','name'=>'data[AnmMeeting][issue_level]','required'=>'required','options'=>array(''=>'Select Category',$subissue)))."</div>";

echo "<div class='col-sm-2'>".$this->Form->input('decisions_taken',array('class' => 'form-control','label'=>'Decisions Taken <span style="color:red">*</span>','name'=>'data[AnmMeeting][decisions_taken]','required'=>'required','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('decision_details',array('class' => 'form-control','type'=>'text','name'=>'data[AnmMeeting][decision_details]'))."</div>";
echo "<div class='col-sm-3' style='display:none'>".$this->Form->input('issue_resolved_date_new',array('class' => 'form-control','name'=>'data[AnmMeeting][issue_resolved_date_new]','type'=>'text','label'=>'Date of Resolved Issued','value'=>date('Y-m-d',strtotime($this->request->data['AnmMeeting']['meeting_date']))))."</div>";

echo "<div class='col-sm-2'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue Resolved <span style="color:red">*</span>','name'=>'data[AnmMeeting][issue_resolved]','required'=>'required','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('resolved_date',array('class' => 'form-control','type'=>'text','name'=>'data[AnmMeeting][resolved_date]','value'=>date('d-m-Y',strtotime($this->request->data['AnmMeeting']['resolved_date']))))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('details_of_issues_resolved',array('class' => 'form-control','name'=>'data[AnmMeeting][details_of_issues_resolved]','type'=>'text','label'=>'Details of Issues Resolved'))."</div>";
echo "</div></div>";
//echo "<div class='col-sm-12 field_div'></div>";
//echo "<div class='col-sm-12'><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left:15px;'>+</a></div>";


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
$("#AnmMeetingPanchayat").change(function(){
var c=$(this).val();
$('#AnmMeetingVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#AnmMeetingVillage").html(result);}});

});

$("#AnmMeetingVillage").change(function(){
var c=$(this).val();
$('#AnmMeetingWard').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#AnmMeetingWard").html(result);}});

});
$("#AnmMeetingDecisionsTaken").change(function(){
var c=$(this).val();
var a =$('#AnmMeetingNoOfDecision').val();
if(c==='yes'){
    a++;
    $('#AnmMeetingNoOfDecision').val(a);
        }
        else if(c==='no') {
            if(a>0){
            a--;
           $('#AnmMeetingNoOfDecision').val(a);
            }
        }
        else {
          $('#AnmMeetingNoOfDecision').val(a);   
        }
});
$("#AnmMeetingIssueResolved").change(function(){
var c=$(this).val();
var a= $('#AnmMeetingSolvedIssue').val();
if(c==='yes'){
    a++;
    $('#AnmMeetingSolvedIssue').val(a);
        }
        else if(c==='no') {
            if(a>0){
            a--;
           $('#AnmMeetingSolvedIssue').val(a); 
            }
        }
        else {
           $('#AnmMeetingSolvedIssue').val(a);    
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
                <div class="col-sm-2"><label>Key Issues Discussed</label><input class="form-control" id="issue_category'+dt+'" name="data[AnmMeeting][key_issues_discussed][]"></div>\
                <div class="col-sm-2"><label>Issues Raised By Bpc</label><input class="calbsp form-control" type="text" id="induction_training_date" name="data[AnmMeeting][issues_raised_by_bpc][]"></div>\
                <div class="col-sm-2"><label>Decisions Taken</label><select class="calbsp form-control" type="text" name="data[AnmMeeting][decisions_taken][]"><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>\
                <div class="col-sm-2"><label>Issue Resolved</label><select class="form-control" type="text" name="data[AnmMeeting][issue_resolved][]"><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>\
                <div class="col-sm-2"><label>Details of Issues Resolved</label><input class="form-control" type="text" name="data[AnmMeeting][details_of_issues_resolved][]"></div>\
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
    var s =1;
    var st = dt-s;
$("#issue_category"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueCategorys/getissue/",success:function(result){$("#issue_category"+st).html(result);}});

$("#issue_subcategory"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/getsubcat/",success:function(result){$("#issue_subcategory"+st).html(result);}});

});
  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('AnmMeetingMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('AnmMeetingIssueResolvedDate'));
 
// $("#AnmMeetingMeetingDate").click( function(e) {
// $('#AnmMeetingMeetingDate').attr('type', 'date');
//    });
    
  $("#AnmMeetingResolvedDate").click( function(e) {
 $('#AnmMeetingResolvedDate').attr('type', 'date');
    });  
        
    

</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#AnmMeetingNewIssue').val();
            num++ ;
                    $('#AnmMeetingNewIssue').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
         var num= $('#AnmMeetingNewIssue').val();
            num-- ;
                    $('#AnmMeetingNewIssue').val(num);
        });
        
        jQuery(document).on('change', '.decisions', function() {
            c=$(this).val();
         var num= $('#AnmMeetingDecisionTaken').val();
         if(c==='yes'){
              num++ ;
                    $('#AnmMeetingDecisionTaken').val(num);
         }
         else {
              num-- ;
                    $('#AnmMeetingDecisionTaken').val(num);
         }
           
        });
        jQuery(document).on('change', '.resolved', function() {
            c=$(this).val();
         var num= $('#AnmMeetingSolvedIssue').val();
         if(c==='yes'){
              num++ ;
                    $('#AnmMeetingSolvedIssue').val(num);
         }
         else {
              num-- ;
                    $('#AnmMeetingSolvedIssue').val(num);
         }
           
        });

    });
    </script>
    
    
    <script>
        var resolve = $("#AnmMeetingIssueResolved").val();
if(resolve==='no' || resolve===''){
$("#AnmMeetingResolvedDate").val('');
}
$("#AnmMeetingIssueResolved").change( function(e) {
      c=$(this).val();
var m = $("#AnmMeetingMeetingDate").val();

 if(c==='yes'){
  $("#AnmMeetingResolvedDate").val(m);
}
else {
     $("#AnmMeetingResolvedDate").val(''); 
}
 });
 
 
 $("#AnmMeetingResolvedDate").change( function(e) {

       var startDate = $("#AnmMeetingIssueResolvedDateNew").val(); 
       var endDate = $("#AnmMeetingResolvedDate").val();  
       var d = new Date(); 
    
       var month = d.getMonth()+1;
        var day = d.getDate();
      var output = d.getFullYear() + '-' +
    ((''+month).length<2 ? '0' : '') + month + '-' +
    ((''+day).length<2 ? '0' : '') + day;

    if ((Date.parse(startDate) > Date.parse(endDate) || Date.parse(endDate) > Date.parse(output))) {
        alert("Date should be Between or Equal Meeting Date and Current Date");
        $("#AnmMeetingResolvedDate").val("");
    }
   });
   
   
     </script>