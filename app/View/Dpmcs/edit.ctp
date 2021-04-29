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
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'1'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class' => 'form-control','options'=>array(''=>'Select District',$cities)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y',strtotime($this->request->data['Dpmc']['meeting_date'])),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('register_member',array('class' => 'form-control','label'=>'DPMC Registered Member Participated','max'=>20))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('other_participated',array('class' => 'form-control','label'=>'Other Participated'))."</div>";

?>

<div class="col-sm-4"><div class="input select"><label for="DpmcRegisterMemberType">Register Member Participated</label><input type="hidden" name="data[Bpmc][register_member_type]" value="" id="VhsncMeetingRegisterMember_">
<select name="data[Dpmc][register_member_type][]" class="form-control select" multiple="multiple" id="DpmcRegisterMemberType">

    <?php 
   
   foreach($reg as $key=>$value) {
         $men =explode(',',$this->request->data['Dpmc']['register_member_type']);
    
         
        
        ?>
    <option value="<?=$key?>" <?php for($i=0;$i<count($men);$i++){ if($key==$men[$i]) { echo "selected" ;} }?> ><?=$value?></option>
    <?php  } ?>
</select></div></div>
<?php


///echo "<div class='col-sm-3'>".$this->Form->input('register_member_type',array('class' => 'form-control','label'=>'Type of Registered Member participated','options'=>array($reg),'multiple'=>'multiple'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_facilitated_by',array('class' => 'form-control','label'=>'Meeting chaired by','options'=>array(''=>'Select Options',$facilitated)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('testimonial_shared',array('class' => 'form-control','label'=>'Testimonials shared'))."</div>";
///echo "<div class='col-sm-3'>".$this->Form->input('issue_shared_dpmc',array('class' => 'form-control','label'=>'Issues shared in DPMC'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_decision',array('class' => 'form-control','label'=>'No of Decisions taken','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control'))."</div>";
echo "<legend class='col-sm-12'>Issue details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('details_of_issues',array('class' => 'form-control','type'=>'text','label'=>'Details of Issues','name'=>'data[Dpmc][details_of_issues]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_category',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[Dpmc][issue_category]','required'=>'required','options'=>array(''=>'--Select--',$issue)))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('issues_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','name'=>'data[Dpmc][issues_level]','required'=>'required','options'=>array(''=>'--Select--',$subissue)))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('decisions_taken',array('class' => 'form-control','label'=>'Decisions Taken <span style="color:red">*</span>','name'=>'data[Dpmc][decisions_taken]','required'=>'required','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('decision_details',array('type'=>'text','class' => 'form-control','name'=>'data[Dpmc][decision_details]'))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue resolved <span style="color:red">*</span>','name'=>'data[Dpmc][issue_resolved]','required'=>'required','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3' style='display:none'>".$this->Form->input('issue_resolved_date_new',array('class' => 'form-control','name'=>'data[Dpmc][issue_resolved_date_new]','type'=>'text','label'=>'Date of Resolved Issued','value'=>date('Y-m-d',strtotime($this->request->data['Dpmc']['meeting_date']))))."</div>";
echo "<div class='col-sm-2'>".$this->Form->input('resolved_date',array('type'=>'text','class' => 'form-control','label'=>'Issue resolved','name'=>'data[Dpmc][resolved_date]','value'=>date('d-m-Y',strtotime($this->request->data['Dpmc']['resolved_date']))))."</div>";
echo "<div class='col-sm-5'>".$this->Form->input('details_of_issues_resolved',array('type'=>'text','class' => 'form-control','name'=>'data[Dpmc][details_of_issues_resolved]','label'=>'Details of Issues Resolved'))."</div>";

echo "<div class='col-sm-4'>".$this->Form->input('letter_to_higher_authority',array('class' => 'form-control','label'=>'No. of issues forwarded to higher authority','name'=>'data[Dpmc][letter_to_higher_authority]','options'=>array(''=>'Select Options','DPMC'=>'DPMC','SHSB'=>'SHSB')))."</div>";
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
var c=$(this).val();
var d=  $('#DpmcNoOfDecision').val(1);
//alert(c);
if(c==='yes'){
d++;
    $('#DpmcNoOfDecision').val(d);
        }
        else if(c==='no'){
          if(d>0) {
           $('#DpmcNoOfDecision').val(d); 
         } 
        } else {
$('#DpmcNoOfDecision').val(d); 
            }
});
$("#DpmcIssueResolved").change(function(){
var c=$(this).val();
 var d= $('#DpmcSolvedIssue').val();
//alert(c);
if(c==='yes'){
    d++;
    $('#DpmcSolvedIssue').val(d);
        }
        else if(c==='no'){
         if(d>0){
         d--;
           $('#DpmcSolvedIssue').val(d); 
         }
        }
else {
 $('#DpmcSolvedIssue').val(d);
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
                      <div class="col-sm-2"><label>Details of Issues</label><input class="calbsp form-control" type="text" name="data[Dpmc][details_of_issues][]"></div>\
                      <div class="col-sm-2"><label>Issue Category</label><select class="form-control" id="issue_category'+dt+'" name="data[Dpmc][issue_category][]"><option value="">--Select--</option></select></div>\
                      <div class="col-sm-2"><label>Issues Level</label><select class="form-control"  id="issue_level'+dt+'" name="data[Dpmc][issues_level][]"><option value="">--Select--</option></select></div>\
                      <div class="col-sm-2"><label>Decisions Taken</label><input class="form-control" type="text" name="data[Dpmc][decisions_taken][]"></div>\
                      <div class="col-sm-2"><label>Letter issued to higher Authority</label><select class="form-control" name="data[Dpmc][letter_to_higher_authority][]"><option value="">Select Options</option><option value="DPMC">DPMC</option><option value="SHSB">SHSB</option></select></div>\
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
$.ajax({url:"<?=SITE_PATH?>issueSubcategorys/getsubcat/",success:function(result){$("#issue_level"+st).html(result);}});

});
  });
var dp_cal1;var dp_cal2;var dp_cal3;var dp_cal4;var dp_cal5;    
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('DpmcMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('DpmcIssueResolvedDate'));
 
// $("#DpmcMeetingDate").click( function(e) {
// $('#DpmcMeetingDate').attr('type', 'date');
//    });
//    
  $("#DpmcResolvedDate").click( function(e) {
 $('#DpmcResolvedDate').attr('type', 'date');
    });  
        
    

</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#DpmcNewIssue').val();
            num++ ;
                    $('#DpmcNewIssue').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
         var num= $('#DpmcNewIssue').val();
            num-- ;
                    $('#DpmcNewIssue').val(num);
        });
        
        jQuery(document).on('change', '.decisions', function() {
            c=$(this).val();
         var num= $('#DpmcDecisionTaken').val();
         if(c==='yes'){
              num++ ;
                    $('#DpmcDecisionTaken').val(num);
         }
         else {
              num-- ;
                    $('#DpmcDecisionTaken').val(num);
         }
           
        });
        jQuery(document).on('change', '.resolved', function() {
            c=$(this).val();
         var num= $('#DpmcSolvedIssue').val();
         if(c==='yes'){
              num++ ;
                    $('#DpmcSolvedIssue').val(num);
         }
         else {
              num-- ;
                    $('#DpmcSolvedIssue').val(num);
         }
           
        });

    });
     $('#DpmcRegisterMemberType').multiselect({
  nonSelectedText: 'Select Members',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'270px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});


 var resolve = $("#DpmcIssueResolved").val();
//alert(resolve);
if(resolve==='no' || resolve===''){

$("#DpmcResolvedDate").val('');
}
$("#DpmcIssueResolved").change( function(e) {
      c=$(this).val();
//alert(c);
var m = $("#DpmcMeetingDate").val();

 if(c==='yes'){
  $("#DpmcResolvedDate").val(m);
}
else {
     $("#DpmcResolvedDate").val(''); 
}
 }); 

$("#DpmcResolvedDate").change( function(e) {

       var startDate = $("#SocialAuditIssueResolvedDateNew").val(); 
       var endDate = $("#DpmcResolvedDate").val();  
       var d = new Date(); 
    
       var month = d.getMonth()+1;
        var day = d.getDate();
      var output = d.getFullYear() + '-' +
    ((''+month).length<2 ? '0' : '') + month + '-' +
    ((''+day).length<2 ? '0' : '') + day;

    if ((Date.parse(startDate) > Date.parse(endDate) || Date.parse(endDate) > Date.parse(output))) {
        alert("Date should be Between or Equal Meeting Date and Current Date");
        $("#DpmcResolvedDate").val("");
    }
   });


    </script>