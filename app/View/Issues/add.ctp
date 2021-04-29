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
<?php echo $this->Html->link(__('List Issue Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Issue'); ?>
<fieldset>
<legend><?php echo __(' Issue'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'--Select--')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_issue',array('class' => 'form-control','label'=>' No. New Issues Identified ','readonly'=>'readonly','value'=>'1'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_decision',array('class' => 'form-control','label'=>'No of Decisions taken','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('class' => 'form-control','type'=>'text'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue resolved','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('decision_details',array('class' => 'form-control','name'=>'data[Issue][decision_details][]','type'=>'text'))."</div>";
//echo "<a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;'>+</a>";

//echo "</div></div>";
//
echo "<legend class='col-sm-12'>Issue details</legend>";
echo "<div class='col-sm-12'><label>Issue:1</label>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('new_issues_identified',array('type'=>'text','class' => 'form-control','label'=>'New Issues identified <span style="color:red">*</span>','name'=>'data[Issue][new_issues_identified][]','required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_category',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[Issue][issue_category][]','options'=>array(''=>'Select Category',$issue),'required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','name'=>'data[Issue][issue_level][]','options'=>array(''=>'Select Category',$subissue),'required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('decision_taken',array('class' => 'form-control','label'=>'Decision Taken <span style="color:red">*</span>','name'=>'data[Issue][decision_taken][]','required'=>'required','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";

echo "<div class='col-sm-6'>".$this->Form->input('decision_details',array('type'=>'text','class' => 'form-control','label'=>'Decision Deatils','name'=>'data[Issue][decision_details][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue Resolved <span style="color:red">*</span>','name'=>'data[Issue][issue_resolved][]','required'=>'required','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved_date',array('class' => 'form-control','type'=>'text','label'=>'Date of Resolved Issued','name'=>'data[Issue][issue_resolved_date][]','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('described_resolved_issue',array('class' => 'form-control','type'=>'text','label'=>'Describe Resolved Issue','name'=>'data[Issue][described_resolved_issue][]'))."</div>";
echo "</div></div>";
echo "<div class='col-sm-12 field_div'></div>";
echo "<div class='col-sm-12'><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left:13px;'>+</a></div>";



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
$("#IssueIssueCategory").change(function(){
var c=$(this).val();
$('#IssueIssueSubcategory').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/fetchsubcat/"+c,success:function(result){$("#IssueIssueSubcategory").html(result);}});

});
<?php if($sessionrole!='CC' || $sessionrole!='BPC' ) { ?>
$("#IssueDistrict").change(function(){
var c=$(this).val();
$('#IssueBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#IssueBlock").html(result);}});

});
<?php } ?>
<?php if($sessionrole!='CC') { ?>

$("#IssueBlock").change(function(){
var c=$(this).val();
$('#IssuePanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#IssuePanchayat").html(result);}});

});
<?php } ?>

$("#IssuePanchayat").change(function(){
var c=$(this).val();
$('#IssueVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#IssueVillage").html(result);}});

});

//$("#IssueVillage").change(function(){
//var c=$(this).val();
//$('#IssueWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#IssueWard").html(result);}});
//
//});
$("#IssueDecisionTaken").change(function(){
var c=$(this).val();
var d = $('#IssueNoOfDecision').val();
if(c==='yes'){
    $('#IssueNoOfDecision').val(1);
        }
       else if(c==='no') {
            if(d>0) {
                d--;
           $('#IssueNoOfDecision').val(d); 
            }
        }
});
$("#IssueIssueResolved").change(function(){
var c=$(this).val();
var s=$('#IssueSolvedIssue').val();
var d=$('#IssueMeetingDate').val();
if(c==='yes'){
    $('#IssueSolvedIssue').val(1);
    $('#IssueIssueResolvedDate').val(d);
        }
        else {
            if(s>0)
                s--
           $('#IssueSolvedIssue').val(s); 
            $('#IssueIssueResolvedDate').val('');
        }
});

});
</script>
<script>
jQuery(document).ready( function () {
     var dt=1;
     var t=2;
        $("#append").click( function(e) {
           
          e.preventDefault();
        $(".field_div").append('<div class="row append"><label>Issue:'+t+'</label>\
                <div class="col-sm-12"><div class="row"><div class="col-sm-6"><label>New Issues identified</label><input type="text" class="calbsp form-control"  id="induction_training_date" name="data[Issue][new_issues_identified][]"></div>\
                <div class="col-sm-3"><label>Issue Category <span style="color:red">*</span></label><select class="form-control" id="issue_category'+dt+'" name="data[Issue][issue_category][]" required><option value="">Select</option></select></div>\
                <div class="col-sm-3"><label>Issue Level <span style="color:red">*</span></label><select class="form-control"  id="issue_level'+dt+'" name="data[Issue][issue_level][]" required><option value="">Select</option></select></div></div></div>\
                <div class="col-sm-12"><div class="row"><div class="col-sm-3"><label>Decision Taken <span style="color:red">*</span></label><select class="form-control decisions"  id="taken'+dt+'" name="data[Issue][decision_taken][]" required><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>\
                <div class="col-sm-6"><label>Decision Details</label><input type="text" class="form-control"  name="data[Issue][decision_details][]"></textarea></div>\
                <div class="col-sm-3"><label>Issue Resolved <span style="color:red">*</span></label><select class="form-control resolved" id="resolved'+dt+'" name="data[Issue][issue_resolved][]" required><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div></div></div>\
                <div class="col-sm-3"><label>Date of Resolved Issued</label><input type="text" class="form-control" id="date'+dt+'" name="data[Issue][issue_resolved_date][]" readonly="readonly"></div>\
                <div class="col-sm-6"><label>Describe Resolved issue</label><input class="calbsp form-control" type="text" name="data[Issue][described_resolved_issue][]"></div>\
                 <a href="#" class="remove_this btn btn-danger" style="margin-top:18px">X</a>\
</div>');
    dt++;
     t++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
        dt--;
        var nodec = $('#taken'+dt).val();
        var nores = $('#resolved'+dt).val();  
        var num= $('#IssueNoOfIssue').val();
       if(num>0) {
            num-- ;
                    $('#IssueNoOfIssue').val(num);
                    
        }
        var dec= $('#IssueNoOfDecision').val();
            
               if(dec==''){
                  $('#IssueNoOfDecision').val(0);
                   }
                else {
                   if(nodec==='yes'){ 
                    if(dec>0){
                   dec-- ;
                    $('#IssueNoOfDecision').val(dec);
                }
                 }
                 }   
          var res= $('#IssueSolvedIssue').val();
                if(res==''){
                  $('#IssueSolvedIssue').val(0);
                   }
                else {
                   if(nores==='yes'){ 
                    if(res>0){
                    res-- ;
                    $('#IssueSolvedIssue').val(res); 
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

 var r=$(this).val();
var m = $("#IssueMeetingDate").val();

 if(r==='yes'){
  $("#date"+st).val(m);
}
else {
     $("#date"+st).val(''); 
}
});
});
  });

</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
          
            var num= $('#IssueNoOfIssue').val();
            num++ ;
                    $('#IssueNoOfIssue').val(num);
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
         var num= $('#IssueNoOfDecision').val();
         if(c==='yes'){
              ++num ;
                    $('#IssueNoOfDecision').val(num);
         }
        else if(c==='no') {
            if(previous==='yes') {
                  num--
                    $('#IssueNoOfDecision').val(num);
              }
           }
         else {
             
            $('#IssueNoOfDecision').val(num);
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
         var num= $('#IssueSolvedIssue').val();
         if(c==='yes'){
              ++num ;
                    $('#IssueSolvedIssue').val(num);
         }
        else if(c==='no') {
            if(prevalue==='yes') {
                  num--
                    $('#IssueSolvedIssue').val(num);
              }
           }
         else {
             
            $('#IssueSolvedIssue').val(num);
         }
          prevalue = this.value;   
        });
})();



</script>
