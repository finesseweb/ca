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
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'1'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class' => 'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";

//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y',strtotime($this->request->data['Bpmc']['meeting_date'])),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('register_member',array('class' => 'form-control','label'=>'BPMC Registered Member Participated','max'=>20))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('other_participated',array('class' => 'form-control','label'=>'Other Participated'))."</div>";

?>
    
<div class="col-sm-4"><div class="input select"><label for="BpmcRegisterMemberType">Registered Member Participated </label><input type="hidden" name="data[Bpmc][register_member_type]" value="" id="VhsncMeetingRegisterMember_">
<select name="data[Bpmc][register_member_type][]" class="form-control select" multiple="multiple" id="BpmcRegisterMemberType">

    <?php 
   
    foreach($reg as $key=>$value) {
        
     $men =explode(',',$this->request->data['Bpmc']['register_member_type']);
         
        
        ?>
    <option value="<?=$key?>" <?php for($i=0;$i<count($men);$i++){ if($key==$men[$i]) { echo "selected" ;} }?> ><?=$value?></option>
    <?php  } ?>
</select></div></div>
<?php

//echo "<div class='col-sm-3'>".$this->Form->input('register_member_type',array('class' => 'form-control','label'=>'Type Of Registered Member participated','options'=>array($reg),'multiple'=>'multiple'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_facilitated_by',array('class' => 'form-control','label'=>'Meeting chaired by','options'=>array(''=>'Select Options',$facilitated)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_decision',array('class' => 'form-control','label'=>'No of Decisions taken','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('testimonial_shared',array('class' => 'form-control','label'=>'Testimonials shared'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('issue_shared_bpmc',array('class' => 'form-control','label'=>'Issues Shared in BPMC'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control'))."</div>";
echo "<legend class='col-sm-12'>Issue details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('details_of_issues',array('type'=>'text','class' => 'form-control','label'=>'Details of Issues','name'=>'data[Bpmc][details_of_issues]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_category',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','name'=>'data[Bpmc][issue_category]','required'=>'required','options'=>array(''=>'Select Category',$issue)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issues_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','name'=>'data[Bpmc][issues_level]','required'=>'required','options'=>array(''=>'Select Level',$subissue)))."</div>";
echo "</div></div>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-3'>".$this->Form->input('decisions_taken',array('class' => 'form-control','label'=>'Decision Taken <span style="color:red">*</span>','name'=>'data[Bpmc][decisions_taken]','required'=>'required','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('decision_details',array('type'=>'text','class' => 'form-control','name'=>'data[Bpmc][decision_details]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue resolved <span style="color:red">*</span>','name'=>'data[Bpmc][issue_resolved]','required'=>'required','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "</div></div>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-3' style='display:none'>".$this->Form->input('issue_resolved_date_new',array('class' => 'form-control','name'=>'data[Bpmc][issue_resolved_date_new]','type'=>'text','label'=>'Date of Resolved Issued','value'=>date('Y-m-d',strtotime($this->request->data['Bpmc']['meeting_date']))))."</div>";

echo "<div class='col-sm-2'>".$this->Form->input('resolved_date',array('class' => 'form-control','label'=>'Resolved Date','name'=>'data[Bpmc][resolved_date]','type'=>'text','value'=>date('d-m-Y',strtotime($this->request->data['Bpmc']['resolved_date']))))."</div>";
echo "<div class='col-sm-5'>".$this->Form->input('details_of_issues_resolved',array('type'=>'text','class' => 'form-control','name'=>'data[Bpmc][details_of_issues_resolved]','label'=>'Details of Issues Resolved'))."</div>";

echo "<div class='col-sm-4'>".$this->Form->input('letter_to_higher_authority',array('class' => 'form-control','label'=>'No. of issues forwarded to higher authority','name'=>'data[Bpmc][letter_to_higher_authority]','options'=>array(''=>'Select Options','BPMC'=>'BPMC','DPMC'=>'DPMC','SHSB'=>'SHSB')))."</div>";
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
 var b = $('#BpmcNoOfDecision').val();
//alert(c);
if(c==='yes'){
   b++;
    $('#BpmcNoOfDecision').val(b);
        }
        else if(c==='no') {
        b--;
           $('#BpmcNoOfDecision').val(b); 
        }
       else {
        $('#BpmcNoOfDecision').val(b); 
}
});
$("#BpmcIssueResolved").change(function(){
var c=$(this).val();
//alert(c);
var b= $('#BpmcSolvedIssue').val();
if(c==='yes'){
b++;
    $('#BpmcSolvedIssue').val(b);
        }
        else if(c==='no') {
        b--;
           $('#BpmcSolvedIssue').val(b); 
        }
   else {
$('#BpmcSolvedIssue').val(b);
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
                      <div class="col-sm-2"><label>Details of Issues</label><input class="calbsp form-control" type="text" name="data[Bpmc][details_of_issues][]"></div>\
                      <div class="col-sm-2"><label>Issue Category</label><select class="form-control" id="issue_category'+dt+'" name="data[Bpmc][issue_category][]"><option value="">Select</option></select></div>\
                      <div class="col-sm-2"><label>Issue Level</label><select class="form-control"  id="issue_level'+dt+'" name="data[Bpmc][issue_level][]"><option value="">Select</option><option value="Community level">Community level</option><option value="Service Delivery level">Service Delivery level</option><option value="Institution level">Institution level</option><option value="System level">System level</option></select></div>\
                      <div class="col-sm-2"><label>Decisions Taken</label><input class="form-control" type="text" name="data[Bpmc][decisions_taken][]"></div>\
                      <div class="col-sm-2"><label>Letter issued to higher Authority</label><select class="form-control" name="data[Bpmc][letter_to_higher_authority][]"><option value="">Select Options</option><option value="BPMC">BPMC</option><option value="DPMC">DPMC</option><option value="SHSB">SHSB</option></select></div>\
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
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('BpmcMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('BpmcIssueResolvedDate'));
 
// $("#BpmcMeetingDate").click( function(e) {
// $('#BpmcMeetingDate').attr('type', 'date');
//    });
//    
  $("#BpmcResolvedDate").click( function(e) {
 $('#BpmcResolvedDate').attr('type', 'date');
    });  
        
    

</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#BpmcNewIssue').val();
            num++ ;
                    $('#BpmcNewIssue').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
         var num= $('#BpmcNewIssue').val();
            num-- ;
                    $('#BpmcNewIssue').val(num);
        });
        
        jQuery(document).on('change', '.decisions', function() {
            c=$(this).val();
         var num= $('#BpmcDecisionTaken').val();
         if(c==='yes'){
              num++ ;
                    $('#BpmcDecisionTaken').val(num);
         }
         else {
              num-- ;
                    $('#BpmcDecisionTaken').val(num);
         }
           
        });
        jQuery(document).on('change', '.resolved', function() {
            c=$(this).val();
         var num= $('#BpmcSolvedIssue').val();
         if(c==='yes'){
              num++ ;
                    $('#BpmcSolvedIssue').val(num);
         }
         else {
              num-- ;
                    $('#BpmcSolvedIssue').val(num);
         }
           
        });

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
 var resolve = $("#BpmcIssueResolved").val();
if(resolve==='no' || resolve===''){
$("#BpmcResolvedDate").val('');
}
$("#BpmcIssueResolved").change( function(e) {
      c=$(this).val();
var m = $("#BpmcMeetingDate").val();

 if(c==='yes'){
  $("#BpmcResolvedDate").val(m);
}
else {
     $("#BpmcResolvedDate").val(''); 
}
 });
 
 
 $("#BpmcResolvedDate").change( function(e) {

       var startDate = $("#BpmcIssueResolvedDateNew").val(); 
       var endDate = $("#BpmcResolvedDate").val();  
       var d = new Date(); 
    
       var month = d.getMonth()+1;
        var day = d.getDate();
      var output = d.getFullYear() + '-' +
    ((''+month).length<2 ? '0' : '') + month + '-' +
    ((''+day).length<2 ? '0' : '') + day;

    if ((Date.parse(startDate) > Date.parse(endDate) || Date.parse(endDate) > Date.parse(output))) {
        alert("Date should be Between or Equal Meeting Date and Current Date");
        $("#BpmcResolvedDate").val("");
    }
   });


        </script>