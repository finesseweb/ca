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
echo $this->Form->input('id',array('class' => 'form-control'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control','options'=>array(''=>'--Select--',$panchayat)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'--Select--',$village)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y',strtotime($this->request->data['Issue']['meeting_date'])),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_decision',array('class' => 'form-control','label'=>'No of Decisions taken','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('class' => 'form-control','type'=>'text'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue resolved','options'=>array(''=>'Select','yes'=>'Yes','no'=>'No')))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('decision_details',array('class' => 'form-control','name'=>'data[Issue][decision_details][]','type'=>'text'))."</div>";
//echo "<a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;'>+</a>";

//echo "</div></div>";
//
echo "<legend class='col-sm-12'>Issue details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('new_issues_identified',array('type'=>'text','class' => 'form-control','label'=>'New Issues identified','name'=>'data[Issue][new_issues_identified]'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('issue_category',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[Issue][issue_category]','required'=>'required','options'=>array(''=>'Select Category',$issue)))."</div>";
 echo "<div class='col-sm-2'>".$this->Form->input('issue_level',array('class' => 'form-control','label'=>'Level of Issue <span style="color:red">*</span>','name'=>'data[Issue][issue_level]','required'=>'required','options'=>array(''=>'Select',$subissue)))."</div>";

 echo "<div class='col-sm-3'>".$this->Form->input('decision_taken',array('class' => 'form-control','label'=>'Decision Taken <span style="color:red">*</span>','required'=>'required','name'=>'data[Issue][decision_taken]','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";

echo "<div class='col-sm-6'>".$this->Form->input('decision_details',array('type'=>'text','class' => 'form-control','label'=>'Decision Deatils','name'=>'data[Issue][decision_details]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue Resolved <span style="color:red">*</span>','required'=>'required','name'=>'data[Issue][issue_resolved]','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3' style='display:none'>".$this->Form->input('issue_resolved_date_new',array('class' => 'form-control','name'=>'data[Issue][issue_resolved_date_new]','type'=>'text','label'=>'Date of Resolved Issued','value'=>date('Y-m-d',strtotime($this->request->data['Issue']['meeting_date']))))."</div>";


echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved_date',array('class' => 'form-control','type'=>'text','label'=>'Date of Resolved Issued','name'=>'data[Issue][issue_resolved_date]','value'=>date('d-m-Y',strtotime($this->request->data['Issue']['issue_resolved_date']))))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('described_resolved_issue',array('class' => 'form-control','type'=>'text','label'=>'Describe resolved issue','name'=>'data[Issue][described_resolved_issue]'))."</div>";
echo "</div></div>";
//echo "<div class='col-sm-12 field_div'></div>";
//echo "<div class='col-sm-12'><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left:13px;'>+</a></div>";



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
<?php if($sessionval!='regular') { ?>
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
var d= $('#IssueNoOfDecision').val();
if(c==='yes'){
    d++;
    $('#IssueNoOfDecision').val(d);
        }
        else if(c==='no') {
            if(d>0){
             d--;   
           $('#IssueNoOfDecision').val(d);
            }
        }
});
$("#IssueIssueResolved").change(function(){
var c=$(this).val();
 var s = $('#IssueSolvedIssue').val();
//alert(c);
if(c==='yes'){
    s++;
    $('#IssueSolvedIssue').val(s);
        }
        else if(c==='no') {
            if(s>0){
                s--;
           $('#IssueSolvedIssue').val(s); 
            }
        }
        else {
             $('#IssueSolvedIssue').val(s);
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
                 <div class="col-sm-2"><label>New Issues identified</label><input class="calbsp form-control" type="text" id="induction_training_date" name="data[Issue][new_issues_identified][]"></div>\
                <div class="col-sm-2"><label>Issue Category</label><select class="form-control" id="issue_category'+dt+'" name="data[Issue][issue_category][]" required><option value="">Select</option></select></div>\
                <div class="col-sm-2"><label>Issue Level</label><select class="form-control"  id="issue_level'+dt+'" name="data[Issue][issue_level][]" required><option value="">Select</option></select></div>\
                <div class="col-sm-2"><label>Date of Resolved Issued</label><input type="date" class="form-control" id="vhsnc_desig" name="data[Issue][issue_resolved_date][]"></div>\
                <div class="col-sm-2"><label>Describe Resolved issue</label><input class="calbsp form-control" type="text" name="data[Issue][described_resolved_issue][]"></div>\
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

$("#issue_level"+st).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/getsubcat/",success:function(result){$("#issue_subcategory"+st).html(result);}});

});
  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('IssueMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('IssueIssueResolvedDate'));
 
// $("#IssueMeetingDate").click( function(e) {
// $('#IssueMeetingDate').attr('type', 'date');
//    });
//    
  $("#IssueIssueResolvedDate").click( function(e) {
 $('#IssueIssueResolvedDate').attr('type', 'date');
    });  
        
    

</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#IssueNewIssue').val();
            num++ ;
                    $('#IssueNewIssue').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
         var num= $('#IssueNewIssue').val();
            num-- ;
                    $('#IssueNewIssue').val(num);
        });
        
        jQuery(document).on('change', '.decisions', function() {
            c=$(this).val();
         var num= $('#IssueDecisionTaken').val();
         if(c==='yes'){
              num++ ;
                    $('#IssueDecisionTaken').val(num);
         }
         else {
              num-- ;
                    $('#IssueDecisionTaken').val(num);
         }
           
        });
        jQuery(document).on('change', '.resolved', function() {
            c=$(this).val();
         var num= $('#IssueSolvedIssue').val();
         if(c==='yes'){
              num++ ;
                    $('#IssueSolvedIssue').val(num);
         }
         else {
              num-- ;
                    $('#IssueSolvedIssue').val(num);
         }
           
        });
var resolve = $("#IssueIssueResolved").val();
if(resolve==='no'){
$("#IssueIssueResolvedDate").val('');
}
$("#IssueIssueResolved").change( function(e) {
      c=$(this).val();
var m = $("#IssueMeetingDate").val();

 if(c==='yes'){
  $("#IssueIssueResolvedDate").val(m);
}
else {
     $("#IssueIssueResolvedDate").val(''); 
}
 });
 
 
 $("#IssueIssueResolvedDate").change( function(e) {

       var startDate = $("#IssueIssueResolvedDateNew").val(); 
       var endDate = $("#IssueIssueResolvedDate").val();  
       var d = new Date(); 
    
       var month = d.getMonth()+1;
        var day = d.getDate();
      var output = d.getFullYear() + '-' +
    ((''+month).length<2 ? '0' : '') + month + '-' +
    ((''+day).length<2 ? '0' : '') + day;

    if ((Date.parse(startDate) > Date.parse(endDate) || Date.parse(endDate) > Date.parse(output))) {
        alert("Date should be Between or Equal Meeting Date and Current Date");
        $("#IssueIssueResolvedDate").val("");
    }
   }); 
   
   
  
    });
    
    
   
    </script>
    
    