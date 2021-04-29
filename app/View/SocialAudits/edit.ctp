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
echo $this->Form->input('id',array('class' => 'form-control'));
//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'1'));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class' => 'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'Select Block',$blocks)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control','options'=>array(''=>'Select Village',$village)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('ward',array('class' => 'form-control','options'=>array(''=>'Select Ward',$ward)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('meeting_date',array('type'=>'text','class'=>'calbsp form-control','label'=>'Date','value'=>date('d-m-Y',strtotime($this->request->data['SocialAudit']['meeting_date'])),'readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('participants',array('class' => 'form-control','label'=>'Participants','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panellist',array('class' => 'form-control','label'=>'Panellist','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('case_study_shared',array('class' => 'form-control','label'=>'Case Study Shared','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('testimonial_shared',array('class' => 'form-control','label'=>'Testimonials Shared','readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('issue_shared_jansamwad',array('class' => 'form-control','label'=>'Issues Shared in Jan Samwaad'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('no_of_decision',array('class' => 'form-control','label'=>'No of Decisions taken','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('solved_issue',array('class' => 'form-control','label'=>'Issues resolved (No.)','readonly'=>'readonly'))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control'))."</div>";

echo "<legend class='col-sm-12'>Issue details</legend>";
echo "<div class='col-sm-12'>";
echo "<div class='row'>";
echo "<div class='col-sm-6'>".$this->Form->input('details_of_issues',array('type'=>'text','class' => 'form-control','label'=>'Details of Issues','name'=>'data[SocialAudit][details_of_issues]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_shared_pri',array('class' => 'form-control','label'=>'Issues Shared by (Name & Type of member)'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_cat',array('class' => 'form-control','label'=>'Issue Category <span style="color:red">*</span>','required'=>'required','name'=>'data[SocialAudit][issue_category]','options'=>array(''=>'--Select--',$issue)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_level',array('class' => 'form-control','label'=>'Issue Level <span style="color:red">*</span>','required'=>'required','name'=>'data[SocialAudit][issue_level]','options'=>array(''=>'--Select--',$subissue)))."</div>";
echo "</div></div>";
echo "<div class='row'>";
echo "<div class='col-sm-12'>";
echo "<div class='col-sm-3'>".$this->Form->input('decisions_taken',array('class' => 'form-control','name'=>'data[SocialAudit][decisions_taken]','label'=>'Decisions Taken <span style="color:red">*</span>','required'=>'required','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('decisions_details',array('type'=>'text','class' => 'form-control','name'=>'data[SocialAudit][decisions_details]'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved',array('class' => 'form-control','label'=>'Issue resolved <span style="color:red">*</span>','name'=>'data[SocialAudit][issue_resolved]','required'=>'required','options'=>array(''=>'--Select--','yes'=>'Yes','no'=>'No')))."</div>";
echo "<div class='col-sm-3' style='display:none'>".$this->Form->input('issue_resolved_date_new',array('class' => 'form-control','name'=>'data[SocialAudit][issue_resolved_date_new]','type'=>'text','label'=>'Date of Resolved Issued','value'=>date('Y-m-d',strtotime($this->request->data['SocialAudit']['meeting_date']))))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('issue_resolved_date',array('class' => 'form-control','label'=>'Issue resolved Date','type'=>'text','name'=>'data[SocialAudit][issue_resolved_date]','value'=>date('d-m-Y',strtotime($this->request->data['SocialAudit']['issue_resolved_date']))))."</div>";
echo "<div class='col-sm-6'>".$this->Form->input('details_of_issues_resolved',array('type'=>'text','class' => 'form-control','name'=>'data[SocialAudit][details_of_issues_resolved]','label'=>'Details of Issues Resolved'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('letter_to_higher_authority',array('class' => 'form-control','label'=>'Letter Issued to Higher Authority','name'=>'data[SocialAudit][letter_to_higher_authority]','options'=>array(''=>'Select Options','BPMC'=>'BPMC','DPMC'=>'DPMC','SHSB'=>'SHSB')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('action_taken',array('class' => 'form-control','label'=>'Action Taken Report Status','name'=>'data[SocialAudit][action_taken]','options'=>array(''=>'Select Options','pending'=>'Pending','completed'=>'Completed')))."</div>";

echo "</div></div>";
//echo "<div class='col-sm-12 field_div'></div>";
//echo "<div class='col-sm-12'><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><div class='col-sm-2'></div><a href='#' id='append' class='btn btn-primary' name='append' style='margin-top: 18px;margin-left:100%;'>+</a></div>";


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

$("#SocialAuditPanchayat").change(function(){
var c=$(this).val();
$('#SocialAuditVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#SocialAuditVillage").html(result);}});

});

$("#SocialAuditVillage").change(function(){
var c=$(this).val();
$('#SocialAuditWard').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#SocialAuditWard").html(result);}});

});
$("#SocialAuditDecisionsTaken").change(function(){
var c=$(this).val();
 var s= $('#SocialAuditNoOfDecision').val();
//alert(c);
if(c==='yes'){
    s++;
    $('#SocialAuditNoOfDecision').val(s);
        }
        else if(c==='no') {
            if(s>0) {
            s--;
           $('#SocialAuditNoOfDecision').val(s); 
            }
        }
        else {
            $('#SocialAuditNoOfDecision').val(s);  
        }
});
$("#SocialAuditIssueResolved").change(function(){
var c=$(this).val();
var s= $('#SocialAuditSolvedIssue').val();
//alert(c);
if(c==='yes'){
    s++;
    $('#SocialAuditSolvedIssue').val(s);
        }
        else if(c==='no') {
            if(s>0){
            s--;
           $('#SocialAuditSolvedIssue').val(s); 
            }
        }
        else {
             $('#SocialAuditSolvedIssue').val(s);  
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
                <div class="col-sm-2"><label>Issue Category</label><select class="form-control" id="issue_category'+dt+'" name="data[SocialAudit][issue_category][]"><option value="">Select</option></select></div>\
                <div class="col-sm-2"><label>Issue Level</label><select class="form-control"  id="issue_level'+dt+'" name="data[SocialAudit][issue_level][]"><option value="">Select</option><option value="Community level">Community level</option><option value="Service Delivery level">Service Delivery level</option><option value="Institution level">Institution level</option><option value="System level">System level</option></select></div>\
                <div class="col-sm-2"><label>Details of Issues</label><input class="calbsp form-control" type="text" name="data[SocialAudit][details_of_issues][]"></div>\
                <div class="col-sm-2"><label>Decisions Taken</label><input class="form-control" type="text" name="data[SocialAudit][decisions_taken][]"></div>\
                <div class="col-sm-2"><label>Letter issued to higher Authority</label><select class="form-control" name="data[SocialAudit][letter_to_higher_authority][]"><option value="">Select Options</option><option value="BPMC">BPMC</option><option value="DPMC">DPMC</option><option value="SHSB">SHSB</option></select></div>\
                 <div class="col-sm-2"><label>Action Taken Report Status</label><select class="form-control" name="data[SocialAudit][action_taken][]"><option value="">Select Options</option><option value="pending">Pending</option><option value="completed">Completed</option></select></div>\
                <a href="#" class="remove_this btn btn-danger" style="margin-top:18px;margin-left:99%">X</a>\
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
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('SocialAuditMeetingDate'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('SocialAuditIssueResolvedDate'));
 
// $("#SocialAuditMeetingDate").click( function(e) {
// $('#SocialAuditMeetingDate').attr('type', 'date');
//    });
    
  $("#SocialAuditIssueResolvedDate").click( function(e) {
 $('#SocialAuditIssueResolvedDate').attr('type', 'date');
    });  
        
    

</script>
<script>
    $(document).ready( function () {
        
        $("#append").click( function() {
            var num= $('#SocialAuditNewIssue').val();
            num++ ;
                    $('#SocialAuditNewIssue').val(num);
        });
        jQuery(document).on('click', '.remove_this', function() {
         var num= $('#SocialAuditNewIssue').val();
            num-- ;
                    $('#SocialAuditNewIssue').val(num);
        });
        
        jQuery(document).on('change', '.decisions', function() {
            c=$(this).val();
         var num= $('#SocialAuditDecisionTaken').val();
         if(c==='yes'){
              num++ ;
                    $('#SocialAuditDecisionTaken').val(num);
         }
         else {
              num-- ;
                    $('#SocialAuditDecisionTaken').val(num);
         }
           
        });
        jQuery(document).on('change', '.resolved', function() {
            c=$(this).val();
         var num= $('#SocialAuditSolvedIssue').val();
         if(c==='yes'){
              num++ ;
                    $('#SocialAuditSolvedIssue').val(num);
         }
         else {
              num-- ;
                    $('#SocialAuditSolvedIssue').val(num);
         }
           
        });

    });
    </script>
    
     <script>
 var resolve = $("#SocialAuditIssueResolved").val();
if(resolve==='no' || resolve===''){
$("#SocialAuditIssueResolvedDate").val('');
}
$("#SocialAuditIssueResolved").change( function(e) {
      c=$(this).val();
var m = $("#SocialAuditMeetingDate").val();

 if(c==='yes'){
  $("#SocialAuditIssueResolvedDate").val(m);
}
else {
     $("#SocialAuditIssueResolvedDate").val(''); 
}
 });
 
 
 $("#SocialAuditIssueResolvedDate").change( function(e) {

       var startDate = $("#SocialAuditIssueResolvedDateNew").val(); 
       var endDate = $("#SocialAuditIssueResolvedDate").val();  
       var d = new Date(); 
    
       var month = d.getMonth()+1;
        var day = d.getDate();
      var output = d.getFullYear() + '-' +
    ((''+month).length<2 ? '0' : '') + month + '-' +
    ((''+day).length<2 ? '0' : '') + day;

    if ((Date.parse(startDate) > Date.parse(endDate) || Date.parse(endDate) > Date.parse(output))) {
        alert("Date should be Between or Equal Meeting Date and Current Date");
        $("#SocialAuditIssueResolvedDate").val("");
    }
   });
   
   
         </script>