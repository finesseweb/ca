<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
 $sessionrole=$this->Session->read('User.subrole');     
?>
<style>
    .col-sm-2{
        width:16%!important;
        
        }
    .form-control{
            margin-bottom: 0px!important;
    }
    .tform{
        margin-bottom: 15px!important;
    }
     select {
    text-transform: none !important;
}
    </style>

<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Monthly Report'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Monthlyreport'); ?>
<fieldset>
<legend><?php echo __('Monthly Report'); ?></legend>
<div class="row">
<?php

//print_r($res);
echo $this->Form->input('updated',array('class' => 'form-control','type'=>'hidden','value'=>'0'));
echo $this->Form->input('user_id',array('class' => 'form-control','type'=>'hidden','value'=>$this->Session->read('User.id')));
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$panchayat)))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('village',array('class' => 'form-control tform','options'=>array(''=>'--Select--')))."</div>";
echo "<div class='col-sm-3' style='display:none'>".$this->Form->input('created_date',array('type'=>'text','class' => 'form-control tform','value'=>date('Y-m-d')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('month',array('type'=>'text','class'=>'calbsp tform form-control','label'=>'Month'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('awc_code',array('class' => 'form-control tform','label'=>'AWC Code','options'=>array(''=>'--select--')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('level',array('class' => 'form-control','options'=>array(''=>'--Select--',$level)))."</div>";


echo "<div class='col-sm-6'>".$this->Form->input('remarks',array('type'=>'text','class' => 'form-control tform','label'=>'Remarks'))."</div>";




?>
    
    <table class="table table-striped" id="display_result" > 
        <thead>
        <th>Title/Question</th><th>Response</th><!--<th>Remarks</th>-->
        <tbody>
             
        
           
        </tbody>
        </thead> 
        </table>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</fieldset>
</div>
</div>

<script type="text/javascript" language="javascript">



$(document).ready(function(){
    //$('#append').hide(); 
//var c=$(".feed").val();
// 
//$.ajax({url:"<?=SITE_PATH?>subfeedbacks/fetchcat/"+c,success:function(result){$("#getquestons").html(result);}});
 <?php if($sessionval!='regular') { ?>
$("#MonthlyreportDistrict").change(function(){
var c=$(this).val();
$('#MonthlyreportBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>blocks/getblocks/"+c,success:function(result){$("#MonthlyreportBlock").html(result);}});

});

<?php } ?>
<?php if($sessionrole!='CC') { ?>

$("#MonthlyreportBlock").change(function(){
var c=$(this).val();
$('#MonthlyreportPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#MonthlyreportPanchayat").html(result);}});

});
<?php } ?>
$("#MonthlyreportPanchayat").change(function(){
var c=$(this).val();
$('#MonthlyreportVillage').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#MonthlyreportVillage").html(result);}});

});

$("#MonthlyreportVillage").change(function(){
var c=$(this).val();
$('#MonthlyreportHealthFacilityName').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>geographicals/getAwc/"+c,success:function(result){$("#MonthlyreportAwcCode").html(result);}});

});

$("#MonthlyreportHealthFacilityName").change(function(){
var c=$(this).val();
$('#MonthlyreportHealthFacilityType').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>facilityDetails/gettype/"+c,success:function(result){$("#MonthlyreportHealthFacilityType").html(result);}});

});

//$("#MonthlyreportVillage").change(function(){
//var c=$(this).val();
//$('#MonthlyreportWard').html("<option value=''>loading......</option>"); 
//$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#MonthlyreportWard").html(result);}});
//
//});

$("#VhsncMeetingDecisionsTaken").change(function(){
var c=$(this).val();
//alert(c);
if(c==='yes'){
    $('#VhsncMeetingDecisionTaken').val(1);
        }
        else {
           $('#VhsncMeetingDecisionTaken').val(' '); 
        }
});
$("#VhsncMeetingIssueResolved").change(function(){
var c=$(this).val();
//alert(c);
if(c==='yes'){
    $('#VhsncMeetingSolvedIssue').val(1);
        }
        else {
           $('#VhsncMeetingSolvedIssue').val(' '); 
        }
});

});
</script>
<script>
 
  $("#MonthlyreportMonth").click( function(e) {
 $('#MonthlyreportMonth').attr('type', 'month');
    });  
 
$("#MonthlyreportLevel").change(function(){
var c=$(this).val();
//var v = $("#MonthlyreportHidden").val();
//$('.' + $(this).val()).show();
$.ajax({url:"<?=SITE_PATH?>subfeedbacks/getreportquestion/?c="+c,success:function(result){
        $('#display_result tbody').html(result);
            
          //  $("#qutst").html(result);
        }});

  
});  

</script>
<script>
    $(document).ready( function () {
   
$( "#MonthlyreportMobileResponderOne" ).blur(function() {
    var c=$(this).val();
    if (c.length>12)
           {
                alert("Enter max 12 digit");
                $( "#MonthlyreportMobileResponderOne" ).val('');
                return false;
           }
         else if(c.length<10){
            alert("Enter min 10 digit");
                $( "#MonthlyreportMobileResponderOne" ).val('');
                return false;  
             
         }  
    });
    $( "#MonthlyreportMobileResponderTwo" ).blur(function() {
    var c=$(this).val();
    if (c.length>12)
           {
                alert("Enter max 12 digit");
                $( "#MonthlyreportMobileResponderTwo" ).val('');
                return false;
           }
         else if(c.length<10){
            alert("Enter min 10 digit");
                $( "#MonthlyreportMobileResponderTwo" ).val('');
                return false;  
             
         }  
    });
    
  }); 
  
  
  
  function my_function(){
      $('#refresh').load(location.href + ' #MonthlyreportEndTimeAssessment');
    }
    setInterval("my_function();",1000); 
    </script>