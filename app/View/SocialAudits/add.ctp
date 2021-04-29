<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
      
?>


<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Social Audit Details (Jan Samwaad)'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('SocialAudit'); ?>
<fieldset>
<legend><?php echo __(' Social Audit (Jan Samwaad)'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));

echo "<div class='col-sm-3'>".$this->Form->input('district',array('class' => 'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'Select Block',$blocks)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('participants',array('class' => 'form-control','label'=>'Participants'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panellist',array('class' => 'form-control','label'=>'Panellist'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('case_study_shared',array('class' => 'form-control','label'=>'Case Study Shared'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('testimonial_shared',array('class' => 'form-control','label'=>'Testimonials Shared'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_shared_jansamwad',array('class' => 'form-control','label'=>'Issues Shared in Jan Samwaad','value'=>'0','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_decision',array('class' => 'form-control','label'=>'No of Decisions taken','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly'))."</div>";

echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control'))."</div>";
echo  "<div class='col-sm-4'><button type='button' class='btn btn-primary' id='showHide'>Add Issue</button></div>";

echo "<legend class='col-sm-12 issuedetails'>Issue details</legend>";
echo "<div class='col-sm-12 issuedetails'><label>Issue : 1</label>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('details_of_issues',array('type'=>'text','class' => 'form-control','label'=>'Details of Issues','name'=>'data[SocialAudit][details_of_issues][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_shared_pri',array('class' => 'form-control','label'=>'Issues Shared by (Name & Type of member)','name'=>'data[SocialAudit][issue_shared_pri][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_cat',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[SocialAudit][issue_category][]','options'=>array(''=>'--Select--',$issue)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','name'=>'data[SocialAudit][issue_level][]','options'=>array(''=>'--Select--',$subissue)))."</div>";
echo "</div></div>";
echo "<div class='row'>";
echo "<div class='col-sm-12 issuedetails'>";
echo "<div class='col-sm-3'>".$this->Form->input('decisions_taken',array('class' => 'form-control','label'=>'Decisions Taken <span style="color:red">*</span>','name'=>'data[SocialAudit][decisions_taken][]','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('decisions_details',array('type'=>'text','class' => 'form-control','name'=>'data[SocialAudit][decisions_details][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue resolved <span style="color:red">*</span>','name'=>'data[SocialAudit][issue_resolved][]','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved_date',array('class' => 'form-control','type'=>'text','label'=>'Issue resolved Date','name'=>'data[SocialAudit][issue_resolved_date][]','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-5'>".$this->Form->input('details_of_issues_resolved',array('type'=>'text','class' => 'form-control','name'=>'data[SocialAudit][details_of_issues_resolved][]','label'=>'Details of Issues Resolved'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('letter_to_higher_authority',array('class' => 'form-control','label'=>'Letter Issued to Higher Authority','name'=>'data[SocialAudit][letter_to_higher_authority][]','options'=>array(''=>'Select Options','BPMC'=>'BPMC','DPMC'=>'DPMC','SHSB'=>'SHSB')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('action_taken',array('class' => 'form-control','label'=>'Action Taken','name'=>'data[SocialAudit][action_taken][]','options'=>array(''=>'Select Options','pending'=>'Pending','completed'=>'Completed')))."</div>";
echo "<div class='col-sm-1'><a href='#' id='remove' class='btn btn-danger' name='remove' style='margin-top: 18px;'>X</a></div>";
echo "</div></div>";
echo "<div class='col-sm-12 field_div issuedetails'></div>";
echo "<div class='col-sm-12 issuedetails'><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left:97%;'>+</a></div>";


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
$("#SocialAuditIssueCategory").change(function(){
var c=$(this).val();
$('#SocialAuditIssueSubcategory').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/fetchsubcat/"+c,success:function(result){$("#SocialAuditIssueSubcategory").html(result);}});

});

$("#SocialAuditDistrict").change(function(){
var c=$(this).val();
$('#SocialAuditBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#SocialAuditBlock").html(result);}});

});

$("#SocialAuditVillage").change(function(){
var c=$(this).val();
$('#SocialAuditWard').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#SocialAuditWard").html(result);}});

});
$("#SocialAuditDecisionsTaken").change(function(){
var c=$(this).val();
 var d = $('#SocialAuditNoOfDecision').val();
//alert(c);
if(c==='yes'){
    $('#SocialAuditNoOfDecision').val(1);
        }
        else if(c==='no') {
            if(d>0) {
                d--;
           $('#SocialAuditNoOfDecision').val(d); 
            }
        }
});
$("#SocialAuditIssueResolved").change(function(){
var c=$(this).val();
var d = $('#SocialAuditSolvedIssue').val();
var t=$("#SocialAuditMeetingDate").val();
//alert(c);
if(c==='yes'){
    $('#SocialAuditSolvedIssue').val(1);
      $('#SocialAuditIssueResolvedDate').val(t);
    
        }
          else if(c==='no') {
            if(d>0) {
                d--;
           $('#SocialAuditSolvedIssue').val(d); 
            $('#SocialAuditIssueResolvedDate').val('');
            }
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
        $(".field_div").append('<div class="row append"><label>Issue :'+' '+t+'</label>\
                 <div class="col-sm-12"><div class="row"><div class="col-sm-6"><label>Details of Issues</label><input type="text" class="calbsp form-control" name="data[SocialAudit][details_of_issues][]"></div>\
                <div class="col-sm-3"><label>Issues Shared by (Name & Type of member)</label><input class="form-control" id="shared'+dt+'" name="data[SocialAudit][issue_shared_pri][]"></div>\
                <div class="col-sm-3"><label>Issue Category <span style="color:red">*</span></label><select class="form-control" id="issue_category'+dt+'" name="data[SocialAudit][issue_category][]" required><option value="">--Select--</option></select></div>\
                <div class="col-sm-3"><label>Issue Level <span style="color:red">*</span></label><select class="form-control"  id="issue_level'+dt+'" name="data[SocialAudit][issue_level][]" required><option value="">--Select--</option></select></div></div></div>\
               <div class="col-sm-12"><div class="row">  <div class="col-sm-3"><label>Decisions Taken  <span style="color:red">*</span></label><select class="form-control decisions"  id="taken'+dt+'" name="data[SocialAudit][decisions_taken][]" required><option value="">--Select--</option><option value="yes">Yes</option><option value="no">No</option></select></div>\
                <div class="col-sm-6"><label>Decisions Deatils</label><input type="text" class="form-control" name="data[SocialAudit][decisions_details][]"></div>\
                <div class="col-sm-3"><label>Issue resolved <span style="color:red">*</span></label><select class="form-control resolved"  id="resolved'+dt+'" name="data[SocialAudit][issue_resolved][]" required><option value="">--Select--</option><option value="yes">Yes</option><option value="no">No</option></select></div></div></div>\
                <div class="col-sm-3"><label>Issue resolved Date</label><input type="text" class="form-control"  id="date'+dt+'" name="data[SocialAudit][issue_resolved_date][]" readonly="readonly"></div>\
                <div class="col-sm-5"><label>Details of Issues Resolved</label><input type="text" class="form-control" name="data[SocialAudit][details_of_issues_resolved][]"></div>\
                 <div class="col-sm-3"><label>Action Taken</label><select class="form-control" name="data[SocialAudit][action_taken][]"><option value="">Select Options</option><option value="pending">Pending</option><option value="completed">Completed</option></select></div>\
                <a href="#" class="remove_this btn btn-danger" style="margin-top:18px;">X</a>\
</div>');
    dt++;
     t++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
        dt--;
        var nodec = $('#taken'+dt).val();
        var nores = $('#resolved'+dt).val();  
        var num= $('#SocialAuditIssueSharedJansamwad').val();
       if(num>0) {
            num-- ;
                    $('#SocialAuditIssueSharedJansamwad').val(num);
                    
        }
           
            var dec= $('#SocialAuditNoOfDecision').val();
            
               if(dec==''){
                  $('#SocialAuditNoOfDecision').val(0);
                   }
                else {
                   if(nodec==='yes'){ 
                    if(dec>0){
                   dec-- ;
                    $('#SocialAuditNoOfDecision').val(dec);
                }
                 }
                 }   
             var res= $('#SocialAuditSolvedIssue').val();
                if(res==''){
                  $('#SocialAuditSolvedIssue').val(0);
                   }
                else {
                   if(nores==='yes'){ 
                    if(res>0){
                    res-- ;
                    $('#SocialAuditSolvedIssue').val(res); 
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
var m = $("#SocialAuditMeetingDate").val();

 if(r==='yes'){
  $("#date"+st).val(m);
}
else {
     $("#date"+st).val(''); 
}
});
  });
  
  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('SocialAuditMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('SocialAuditIssueResolvedDate'));
 
// $("#SocialAuditMeetingDate").click( function(e) {
// $('#SocialAuditMeetingDate').attr('type', 'date');
//    });
    
//  $("#SocialAuditIssueResolvedDate").click( function(e) {
// $('#SocialAuditIssueResolvedDate').attr('type', 'date');
//    });  
        
    

</script>
<script>
    $(document).ready( function () {
        
       $(".issuedetails").hide(); 
       $("#showHide").click(function() { 
   $(".issuedetails").show(); 
  
   $("#SocialAuditIssueSharedJansamwad").val(1); 
    $("#showHide").prop('disabled','disabled'); 
    $("#SocialAuditIssueCat").prop('required','required');
   $("#SocialAuditIssueLevel").prop('required','required');
   $("#SocialAuditIssueResolved").prop('required','required');
   $("#SocialAuditDecisionsTaken").prop('required','required');  
       
   }); 
   $("#remove").click(function() { 
   $(".issuedetails").hide(); 
   var c =$("#SocialAuditIssueSharedJansamwad").val(); 
   if(c>0){
       c--;
       $("#SocialAuditIssueSharedJansamwad").val(c);
   }
    var d =$("#SocialAuditNoOfDecision").val(); 
   if(d>0){
       d--;
       $("#SocialAuditNoOfDecision").val(d);
   }
   var s =$("#SocialAuditSolvedIssue").val(); 
   if(s>0){
       s--;
       $("#SocialAuditSolvedIssue").val(s);
   }
   var v =$("#SocialAuditIssueSharedJansamwad").val(); 
     if(v==='0'){
   $("#showHide").removeAttr('disabled'); 
   }       
   });
        $("#append").click( function() {
            var num= $('#SocialAuditIssueSharedJansamwad').val();
            num++ ;
                    $('#SocialAuditIssueSharedJansamwad').val(num);
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
         var num= $('#SocialAuditNoOfDecision').val();
         if(c==='yes'){
              ++num ;
                    $('#SocialAuditNoOfDecision').val(num);
         }
        else if(c==='no') {
            if(previous==='yes') {
                  num--
                    $('#SocialAuditNoOfDecision').val(num);
              }
           }
         else {
             
            $('#SocialAuditNoOfDecision').val(num);
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
         var num= $('#SocialAuditSolvedIssue').val();
         if(c==='yes'){
              ++num ;
                    $('#SocialAuditSolvedIssue').val(num);
         }
        else if(c==='no') {
            if(prevalue==='yes') {
                  num--
                    $('#SocialAuditSolvedIssue').val(num);
              }
           }
         else {
             
            $('#SocialAuditSolvedIssue').val(num);
         }
          prevalue = this.value;   
        });
})();


</script>