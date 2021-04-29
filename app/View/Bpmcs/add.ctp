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
<?php echo $this->Html->link(__('List BPMC Details'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Bpmc'); ?>
<fieldset>
<legend><?php echo __('BPMC'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class' => 'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y'),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('register_member',array('class' => 'form-control','label'=>'BPMC Registered Member Participated','max'=>20))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('other_participated',array('class' => 'form-control','label'=>'Other Participated'))."</div>";

?>
<!--<div class="col-sm-3">
     <label for="VhsncMeetingRegisterMember">Types of Reg. Member Participated</label>
    <?php  foreach($reg as $key=>$value) {
    ?>
     <div class="form-check">
         <input class="form-check-input" type="checkbox" name="data[Bpmc][register_member_type][]" value="<?=$key?>" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
    <?=$value?>
  </label>
</div>
    <?php }?>
   </div>-->
<?php

echo "<div class='col-sm-4'>".$this->Form->input('register_member_type',array('class' => 'form-control','label'=>'Registered Member Participated','options'=>array($reg),'multiple'=>'multiple'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_facilitated_by',array('class' => 'form-control','label'=>'Meeting chaired by','options'=>array(''=>'Select Options',$facilitated)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('testimonial_shared',array('class' => 'form-control','label'=>'Testimonials shared'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_shared_bpmc',array('class' => 'form-control','label'=>'Issues Shared in BPMC','value'=>'0','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_decision',array('class' => 'form-control','label'=>'No of Decisions taken','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control'))."</div>";
echo  "<div class='col-sm-4'><button type='button' class='btn btn-primary' id='showHide'>Add Issue</button></div>";
echo "<legend class='col-sm-12 issuedetails'>Issue details</legend>";
echo "<div class='col-sm-12 issuedetails'><label>Issue : 1</label>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('details_of_issues',array('type'=>'text','class' => 'form-control','label'=>'Details of Issues','name'=>'data[Bpmc][details_of_issues][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_category',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[Bpmc][issue_category][]','options'=>array(''=>'Select Category',$issue)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issues_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','name'=>'data[Bpmc][issues_level][]','options'=>array(''=>'Select Level',$subissue)))."</div>";
echo "</div></div>";
echo "<div class='col-sm-12 issuedetails'>";
echo "<div class='row'>";
echo "<div class='col-sm-3'>".$this->Form->input('decisions_taken',array('class' => 'form-control','label'=>'Decision Taken <span style="color:red">*</span>','name'=>'data[Bpmc][decisions_taken][]','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('decision_details',array('type'=>'text','class' => 'form-control','name'=>'data[Bpmc][decision_details][]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue resolved <span style="color:red">*</span>','name'=>'data[Bpmc][issue_resolved][]','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('resolved_date',array('class' => 'form-control','label'=>'Resolved Date','name'=>'data[Bpmc][resolved_date][]','type'=>'text','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('details_of_issues_resolved',array('type'=>'text','class' => 'form-control','name'=>'data[Bpmc][details_of_issues_resolved][]','label'=>'Details of Issues Resolved'))."</div>";

echo "<div class='col-sm-4'>".$this->Form->input('letter_to_higher_authority',array('class' => 'form-control','label'=>'No. of issues forwarded to higher authority','name'=>'data[Bpmc][letter_to_higher_authority][]','options'=>array(''=>'Select Options','BPMC'=>'BPMC','DPMC'=>'DPMC','SHSB'=>'SHSB')))."</div>";
echo "<div class='col-sm-1'><a href='#' id='remove' class='btn btn-danger' name='remove' style='margin-top: 18px;'>X</a></div>";
echo "</div></div>";
echo "<div class='col-sm-12 field_div issuedetails'></div>";
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
$("#BpmcIssueCategory").change(function(){
var c=$(this).val();
$('#BpmcIssueSubcategory').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/fetchsubcat/"+c,success:function(result){$("#BpmcIssueSubcategory").html(result);}});

});

$("#BpmcDistrict").change(function(){
var c=$(this).val();
$('#BpmcBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#BpmcBlock").html(result);}});

});

$("#BpmcVillage").change(function(){
var c=$(this).val();
$('#BpmcWard').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#BpmcWard").html(result);}});

});
$("#BpmcDecisionsTaken").change(function(){
var c=$(this).val();
var d = $('#BpmcNoOfDecision').val();
//alert(c);
if(c==='yes'){
    $('#BpmcNoOfDecision').val(1);
        }
        else if(c==='no') {
            if(d>0) {
                d--;
           $('#BpmcNoOfDecision').val(d); 
            }
        }
});
$("#BpmcIssueResolved").change(function(){
var c=$(this).val();
var d=$("#BpmcMeetingDate").val();
var s = $('#BpmcSolvedIssue').val();
//alert(c);
if(c==='yes'){
    $('#BpmcSolvedIssue').val(1);
     $('#BpmcResolvedDate').val(d);

        }
        else if(c==='no') {
            if(s>0) {
                s--;
           $('#BpmcSolvedIssue').val(s); 
          $('#BpmcResolvedDate').val('');
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
                     <div class="col-sm-12"><div class="row"> <div class="col-sm-6"><label>Details of Issues</label><input type="text" class="calbsp form-control" type="text" name="data[Bpmc][details_of_issues][]"></div>\
                      <div class="col-sm-3"><label>Issue Category <span style="color:red">*</span></label><select class="form-control" id="issue_category'+dt+'" name="data[Bpmc][issue_category][]" required><option value="">Select</option></select></div>\
                      <div class="col-sm-3"><label>Issue Level <span style="color:red">*</span></label><select class="form-control"  id="issue_level'+dt+'" name="data[Bpmc][issues_level][]" required><option value="">Select</option></select></div></div></div>\
                      <div class="col-sm-12"><div class="row"> <div class="col-sm-3"><label>Decision Taken <span style="color:red">*</span></label><select class="form-control decisions"  id="taken'+dt+'" name="data[Bpmc][decisions_taken][]" required><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div>\
                       <div class="col-sm-6"><label>Decision Details</label><input type="text" class="form-control" name="data[Bpmc][decision_details][]"></div>\
                       <div class="col-sm-3"><label>Issue resolved <span style="color:red">*</span></label><select class="form-control resolved"  id="resolved'+dt+'" name="data[Bpmc][issue_resolved][]" required><option value="">Select</option><option value="yes">Yes</option><option value="no">No</option></select></div></div></div>\
                       <div class="col-sm-2"><label>Resolved Date</label><input type="text" class="form-control" id="resolved_date'+dt+'" name="data[Bpmc][resolved_date][]" readonly="readonly"></div>\
                       <div class="col-sm-5"><label>Details of Issues Resolved</label><input type="text" class="form-control" name="data[Bpmc][details_of_issues_resolved][]"></div>\
                       <div class="col-sm-4"><label>No. of issues forwarded to higher authority</label><select class="form-control" name="data[Bpmc][letter_to_higher_authority][]"><option value="">Select Options</option><option value="BPMC">BPMC</option><option value="DPMC">DPMC</option><option value="SHSB">SHSB</option></select></div>\
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
        var num= $('#BpmcIssueSharedBpmc').val();
          if(num>0) {
            num-- ;
                    $('#BpmcIssueSharedBpmc').val(num);
                    
              }

            var dec= $('#BpmcNoOfDecision').val();
            
               if(dec==''){
                  $('#BpmcNoOfDecision').val(0);
                   }
                else {
                   if(nodec==='yes'){ 
                    if(dec>0){
                   dec-- ;
                    $('#BpmcNoOfDecision').val(dec);
                }
                 }
                 }   
             var res= $('#BpmcSolvedIssue').val();
                if(res==''){
                  $('#BpmcSolvedIssue').val(0);
                   }
                else {
                   if(nores==='yes'){ 
                    if(res>0){
                    res-- ;
                    $('#BpmcSolvedIssue').val(res); 
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
var m = $("#BpmcMeetingDate").val();

 if(r==='yes'){
  $("#resolved_date"+st).val(m);
}
else {
     $("#resolved_date"+st).val(''); 
}

});
});


  });

// $("#BpmcMeetingDate").click( function(e) {
// $('#BpmcMeetingDate').attr('type', 'date');
//    });
//    
  //$("#BpmcIssueResolvedDate").click( function(e) {
 //$('#BpmcIssueResolvedDate').attr('type', 'date');
   // });  
        
    

</script>
<script>
    $(document).ready( function () {
         $(".issuedetails").hide();


$("#showHide").click(function() { 
   $(".issuedetails").show(); 
  
   $("#BpmcIssueSharedBpmc").val(1); 
    $("#showHide").prop('disabled','disabled'); 
   $("#BpmcIssueCategory").prop('required','required');
   $("#BpmcIssuesLevel").prop('required','required');
   $("#BpmcDecisionsTaken").prop('required','required');
   $("#BpmcIssueResolved").prop('required','required');
   
       
   }); 

$("#remove").click(function() { 
   $(".issuedetails").hide(); 
   var c =$("#BpmcIssueSharedBpmc").val(); 
   if(c>0){
       c--;
       $("#BpmcIssueSharedBpmc").val(c);
   }
  var d =$("#BpmcNoOfDecision").val(); 
   if(d>0){
       d--;
       $("#BpmcNoOfDecision").val(d);
   }
   var s =$("#BpmcSolvedIssue").val(); 
   if(s>0){
       s--;
       $("#BpmcSolvedIssue").val(s);
   }
   var v =$("#BpmcIssueSharedBpmc").val(); 
     if(v==='0'){
   $("#showHide").removeAttr('disabled'); 
   }       
   });
        $("#append").click( function() {
            var num= $('#BpmcIssueSharedBpmc').val();
            num++ ;
                    $('#BpmcIssueSharedBpmc').val(num);
        });
        //jQuery(document).on('click', '.remove_this', function() {
        // var num= $('#BpmcIssueSharedBpmc').val();
        //    num-- ;
        //            $('#BpmcIssueSharedBpmc').val(num);
       // });
        
      

    });
    
    
 $('#BpmcRegisterMemberType').multiselect({
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
         var num= $('#BpmcNoOfDecision').val();
         if(c==='yes'){
              ++num ;
                    $('#BpmcNoOfDecision').val(num);
         }
        else if(c==='no') {
            if(previous==='yes') {
                  num--
                    $('#BpmcNoOfDecision').val(num);
              }
           }
         else {
             
            $('#BpmcNoOfDecision').val(num);
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
         var num= $('#BpmcSolvedIssue').val();
         if(c==='yes'){
              ++num ;
                    $('#BpmcSolvedIssue').val(num);
         }
        else if(c==='no') {
            if(prevalue==='yes') {
                  num--
                    $('#BpmcSolvedIssue').val(num);
              }
           }
         else {
             
            $('#BpmcSolvedIssue').val(num);
         }
          prevalue = this.value;   
        });
})();


</script>