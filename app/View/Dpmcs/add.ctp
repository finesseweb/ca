<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
  
<style>
    .col-sm-2{
        width:19%!important;
    }
    </style>

<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List DPMC Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Dpmc'); ?>
<fieldset>
<legend><?php echo __('DPMC'); ?></legend>
<div class="row">
<?php

//print_r($res);

echo "<div class='col-sm-3'>".$this->Form->input('district',array('class' => 'form-control','options'=>array(''=>'Select District',$cities)))."</div>";
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('register_member',array('class' => 'form-control','label'=>'DPMC Registered Member Participated','max'=>20))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('other_participated',array('class' => 'form-control','label'=>'Other Participated'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('register_member_type',array('class' => 'form-control','label'=>'Registered Member Participated','options'=>array($reg),'multiple'=>'multiple'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('meeting_facilitated_by',array('class' => 'form-control','label'=>'Meeting chaired by','options'=>array(''=>'Select Options',$facilitated)))."</div>";
//echo "<div class='col-sm-2'>".$this->Form->input('testimonial_shared',array('class' => 'form-control','label'=>'Testimonials shared'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('issue_shared_dpmc',array('class' => 'form-control','label'=>'Issues Shared in DPMC','type'=>'number','value'=>'0','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_decision',array('class' => 'form-control','label'=>'No of Decisions taken','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control'))."</div>";
echo  "<div class='col-sm-2'><button type='button' class='btn btn-primary' id='showHide'>Add Issue</button></div>";
echo "<legend class='col-sm-12 issuedetails'>Issue details</legend>";
echo "<div class='col-sm-12 issuedetails'><label>Issue : 1</label>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('details_of_issues',array('type'=>'text','class' => 'form-control','label'=>'Details of Issues','name'=>'data[Dpmc][details_of_issues][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_category',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[Dpmc][issue_category][]','options'=>array(''=>'--Select--',$issue)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issues_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','name'=>'data[Dpmc][issues_level][]','options'=>array(''=>'--Select--',$subissue)))."</div>";
echo "</div></div>";
echo "<div class='col-sm-12 issuedetails'>";
echo "<div class='row'>";
echo "<div class='col-sm-3'>".$this->Form->input('decisions_taken',array('class' => 'form-control','label'=>'Decisions Taken <span style="color:red">*</span>','name'=>'data[Dpmc][decisions_taken][]','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('decision_details',array('type'=>'text','class' => 'form-control','name'=>'data[Dpmc][decision_details][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue resolved <span style="color:red">*</span>','name'=>'data[Dpmc][issue_resolved][]','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('resolved_date',array('type'=>'text','class' => 'form-control','label'=>'Resolved Date','name'=>'data[Dpmc][resolved_date][]','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('details_of_issues_resolved',array('type'=>'text','class' => 'form-control','name'=>'data[Dpmc][details_of_issues_resolved][]','label'=>'Details of Issues Resolved'))."</div>";

echo "<div class='col-sm-4'>".$this->Form->input('letter_to_higher_authority',array('class' => 'form-control','label'=>'No. of issues forwarded to higher authority','name'=>'data[Dpmc][letter_to_higher_authority][]','options'=>array(''=>'Select Options','DPMC'=>'DPMC','SHSB'=>'SHSB')))."</div>";
echo "<div class='col-sm-1'><a href='#' id='remove' class='btn btn-danger' name='remove' style='margin-top: 18px;'>X</a></div>";
echo "</div></div>";
echo "<div class='col-sm-12 field_div '></div>";
echo "<div class='col-sm-12 issuedetails'><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left:15px;'>+</a></div>";


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
$("#DpmcIssueCategory").change(function(){
var c=$(this).val();
$('#DpmcIssueSubcategory').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/fetchsubcat/"+c,success:function(result){$("#DpmcIssueSubcategory").html(result);}});

});

$("#DpmcPanchayat").change(function(){
var c=$(this).val();
$('#DpmcVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#DpmcVillage").html(result);}});

});

$("#DpmcVillage").change(function(){
var c=$(this).val();
$('#DpmcWard').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#DpmcWard").html(result);}});

});
$("#DpmcDecisionsTaken").change(function(){
var d = $('#DpmcNoOfDecision').val();
var c=$(this).val();
//alert(c);
if(c==='yes'){
    $('#DpmcNoOfDecision').val(1);
        }
        else if(c==='no') {
            if(d>0) {
                d--;
           $('#DpmcNoOfDecision').val(d); 
            }
        }
});
$("#DpmcIssueResolved").change(function(){
var c=$(this).val();
var d = $('#DpmcSolvedIssue').val();
var t = $('#DpmcMeetingDate').val();

//alert(c);
if(c==='yes'){
    $('#DpmcSolvedIssue').val(1);
$('#DpmcResolvedDate').val(t);

        }
         else if(c==='no') {
            if(d>0) {
                d--;
           $('#DpmcSolvedIssue').val(d); 
           $('#DpmcResolvedDate').val(''); 
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
        $(".field_div").append('<div class="row append"><div class="col-sm-12"><label>Issue :'+' '+t+'</label></div>\
                     <div class="col-sm-12"><div class="row">  <div class="col-sm-6"><label>Details of Issues</label><input type="text" class="calbsp form-control" name="data[Dpmc][details_of_issues][]"></div>\
                      <div class="col-sm-3"><label>Issue Category <span style="color:red">*</span></label><select class="form-control" id="issue_category'+dt+'" name="data[Dpmc][issue_category][]" required><option value="">Select</option></select></div>\
                      <div class="col-sm-3"><label>Issues Level <span style="color:red">*</span></label><select class="form-control"  id="issue_level'+dt+'" name="data[Dpmc][issues_level][]" required><option value="">Select</option></select></div></div></div>\
                       <div class="col-sm-12"><div class="row"> <div class="col-sm-3"><label>Decisions Taken <span style="color:red">*</span></label><select class="form-control decisions"  id="taken'+dt+'" name="data[Dpmc][decisions_taken][]" required><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>\
                       <div class="col-sm-6"><label>Decisions Details</label><input type="text" class="form-control" name="data[Dpmc][decision_details][]"></div>\
                       <div class="col-sm-3"><label>Issue resolved <span style="color:red">*</span></label><select class="form-control resolved"  id="resolved'+dt+'" name="data[Dpmc][issue_resolved][]" required><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div></div></div>\
                       <div class="col-sm-2"><label>Resolved Date</label><input type="text" class="form-control"  id="resolved_date'+dt+'" name="data[Dpmc][resolved_date][]" readonly="readonly"></div>\
                       <div class="col-sm-5"><label>Details of Issue resolved</label><input type="text" class="form-control" name="data[Dpmc][details_of_issues_resolved][]"></div>\
                       <div class="col-sm-4"><label>No. of issues forwarded to higher authority</label><select class="form-control" name="data[Dpmc][letter_to_higher_authority][]"><option value="">Select Options</option><option value="DPMC">DPMC</option><option value="SHSB">SHSB</option></select></div>\
                <a href="#" class="remove_this btn btn-danger" value=dt style="margin-top:18px">X</a>\
</div>');
    dt++;
     t++;
        return false;
        });

    jQuery(document).on('click', '.remove_this', function() {
      dt--;
        var nodec = $('#taken'+dt).val();
        var nores = $('#resolved'+dt).val(); 
//alert(nores); 
        var num= $('#DpmcIssueSharedDpmc').val();
       if(num>0) {
            num-- ;
                    $('#DpmcIssueSharedDpmc').val(num);
                    
        }
           
            var dec= $('#DpmcNoOfDecision').val();
            
               if(dec==''){
                  $('#DpmcNoOfDecision').val(0);
                   }
                else {
                   if(nodec==='yes'){ 
                    if(dec>0){
                   dec-- ;
                    $('#DpmcNoOfDecision').val(dec);
                }
                 }
                 }   
             var res= $('#DpmcSolvedIssue').val();
                if(res==''){
                  $('#DpmcSolvedIssue').val(0);
                   }
                else {
                   if(nores==='yes'){ 
                    if(res>0){
                    res-- ;
                    $('#DpmcSolvedIssue').val(res); 
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
var m = $("#DpmcMeetingDate").val();

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
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('DpmcMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('DpmcIssueResolvedDate'));
 
// $("#DpmcMeetingDate").click( function(e) {
// $('#DpmcMeetingDate').attr('type', 'date');
//    });
//    
  $("#DpmcIssueResolvedDate").click( function(e) {
 $('#DpmcIssueResolvedDate').attr('type', 'date');
    });  
        
    

</script>
<script>
    $(document).ready( function () {
 $(".issuedetails").hide(); 
$("#showHide").click(function() { 
   $(".issuedetails").show(); 
  
   $("#DpmcIssueSharedDpmc").val(1); 
    $("#showHide").prop('disabled','disabled'); 
       
    $("#DpmcIssueCategory").prop('required','required');
   $("#DpmcIssuesLevel").prop('required','required');
   $("#DpmcDecisionsTaken").prop('required','required');
   $("#DpmcIssueResolved").prop('required','required');    
   });
$("#remove").click(function() { 
   $(".issuedetails").hide(); 
   var c =$("#DpmcIssueSharedDpmc").val(); 
   if(c>0){
       c--;
       $("#DpmcIssueSharedDpmc").val(c);
   }
var d =$("#DpmcNoOfDecision").val(); 
   if(d>0){
       d--;
       $("#DpmcNoOfDecision").val(d);
   }
   var s =$("#DpmcSolvedIssue").val(); 
   if(s>0){
       s--;
       $("#DpmcSolvedIssue").val(s);
   }
   var v =$("#DpmcIssueSharedDpmc").val(); 
     if(v==='0'){
   $("#showHide").removeAttr('disabled'); 
   }       
   });
        $("#append").click( function() {
            var num= $('#DpmcIssueSharedDpmc').val();
            num++ ;
                    $('#DpmcIssueSharedDpmc').val(num);
        });


       
        
    });


$('#DpmcRegisterMemberType').multiselect({
  nonSelectedText: 'Select Members',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'270px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});
 
   </script>

 <script>

(function() {
  var previous;

  jQuery(document).on('focus', '.decisions', function() {
            previous = this.value;    
            
        }).on('change', '.decisions', function() {
          // alert(previous);
            c=$(this).val();
         var num= $('#DpmcNoOfDecision').val();
         if(c==='yes'){
              ++num ;
                    $('#DpmcNoOfDecision').val(num);
         }
        else if(c==='no') {
            if(previous==='yes') {
                  num--
                    $('#DpmcNoOfDecision').val(num);
              }
           }
         else {
             
            $('#DpmcNoOfDecision').val(num);
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
         var num= $('#DpmcSolvedIssue').val();
         if(c==='yes'){
              ++num ;
                    $('#DpmcSolvedIssue').val(num);
         }
        else if(c==='no') {
            if(prevalue==='yes') {
                  num--
                    $('#DpmcSolvedIssue').val(num);
              }
           }
         else {
             
            $('#DpmcSolvedIssue').val(num);
         }
          prevalue = this.value;   
        });
})();


</script>