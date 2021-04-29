<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   
<style>
    .form-control{
            margin-bottom: 0px!important;
    }
    .tform{
        margin-bottom: 15px!important;
    }
    .target{
        width: 150px;
    }
    </style>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Target'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Subcategory'), array('controller' => 'subcategorys', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Subcategory'), array('controller' => 'subcategorys', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Target'); ?>
<fieldset>
<legend><?php echo __('Add Target'); ?></legend>
<?php

//echo "<div class='col-sm-3'>".$this->Form->input('target_for',array('class' => 'form-control tform','options'=>array(''=>'Select','anm'=>'ANM','vhsnc'=>'VHSNC','BPMC'=>'BPMC','DPMC','Social Audit'=>'Social Audit')))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('organization',array('class' => 'form-control tform','options'=>array(''=>'Select NGO',$ngos)),array('required'=>'required'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('district',array('class'=>'form-control tform','options'=>array(''=>'--Select--',$cities)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('block',array('class' => 'form-control tform','options'=>array(''=>'--Select--',$blocks)))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('panchayat',array('class' => 'form-control tform','options'=>array($panchayat),'multiple'=>'multiple'))."</div>";

?>
<div class="col-sm-3"><div class="input select"><label for="NgoPeriodId">Grant Period<span style="color:red">*</span></label>
         <select name="data[Target][period_id]" class="form-control tform" id="NgoPeriodId" required="required">
<option value="">Select Period</option>
<?php foreach ($period as $key=>$value){
    //print_r($value);
    ?>
<option value="<?=$value['periods']['id']?>"><?=date('d-m-Y',strtotime($value['periods']['from_date']))?> To <?=date('d-m-Y',strtotime($value['periods']['to_date']))?></option>
<?php } ?>
</select></div></div>
<?php
echo "<div class='col-sm-3'>".$this->Form->input('total_months',array('class' => 'form-control','readonly'=>'readonly'))."</div>";
//echo "<div class='col-sm-3'>".$this->Form->input('',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";

?>
<table>
    <tr><th>S No </th><th>Indicator Name</th><th>Target</th></tr>
    <tr><td>1</td><td>VHSNC Meeting Organised	</td><td class="target"><input name="data[Target][vhsnc_meeting_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>2</td><td>VHSNC Provided feedback</td><td class="target"><input name="data[Target][feedback_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>3</td><td>Issues identified	</td><td class="target"><input name="data[Target][vhsnc_issue_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>4</td><td>Issues resolved</td><td class="target"><input name="data[Target][vhsnc_issueresolved_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>5</td><td>VHSND sites monitored</td><td class="target"><input name="data[Target][vhsnd_monitor_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>6</td><td>VHSNC Member monitored local services</td><td class="target"><input name="data[Target][vhsnc_monitor_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>7</td><td>M-shakti (IVRS) User Provided Community feedback</td><td class="target"><input name="data[Target][ivrs_feedback_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>8</td><td>Participated in ANM Meeting</td><td class="target"><input name="data[Target][anm_meeting_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>9</td><td>DPMC Meeting Organised</td><td class="target"><input name="data[Target][dpmc_meeting_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>10</td><td>BPMC Meeting Organised</td><td class="target"><input name="data[Target][bpmc_meeting_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>11</td><td>RKS Meeting Organised</td><td class="target"><input name="data[Target][rks_meeting_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>12</td><td>VHSNC monitoring quality checklist filled</td><td class="target"><input name="data[Target][vhsnc_checklist_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>13</td><td>VHSND monitoring quality checklist filled</td><td class="target"><input name="data[Target][vhsnd_checklist_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>14</td><td>Facility Assessement Conducted</td><td class="target"><input name="data[Target][facility_assessement_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>15</td><td>Facilities providing IUCD services on fixed day</td><td class="target"><input name="data[Target][iucd_services_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>16</td><td>Facilities providing Antara services on fixed day</td><td class="target"><input name="data[Target][antara_services_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>17</td><td>VHSNC Untied Fund expenditure against total balance</td><td class="target"><input name="data[Target][vhsnc_expenditure_total_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>18</td><td>VHSNC Untied Fund expenditure against total allocation</td><td class="target"><input name="data[Target][vhsnc_expenditure_allocation_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>19</td><td>Project Budget Utilized</td><td class="target"><input name="data[Target][budget_utilized_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>20</td><td>Aviailiabilty of all ANC services at outreach against VHSND site monitored</td><td class="target"><input name="data[Target][anc_service_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    <tr><td>21</td><td>Issues Pending</td><td class="target"><input name="data[Target][issue_pending_target]" class="form-control" type="number" id="TargetMeetingTarget" autocomplete="off"></td></tr>
    
    
    
    
    
    
</table>	
		
	
	
		
	
		
		
	
		
		
		
		
	
		
		
		
		
	
		
		


</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>

<script type="text/javascript" language="javascript">
$(document).ready(function(){
$("#TargetOrganization").change(function(){
var c=$(this).val();
$('#TargetDistrict').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getngodistrict/"+c,success:function(result){$("#TargetDistrict").html(result);}});

})
$("#TargetDistrict").change(function(){
var c=$(this).val();
var o= $("#TargetOrganization").val();
$('#TargetBlock').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getblocksngo/?c="+c+"&nid="+o,success:function(result){$("#TargetBlock").html(result);}});

});

$("#TargetBlock").change(function(){
var c=$(this).val();
$('#TargetPanchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){
        
$("#TargetPanchayat").empty();
$("#TargetPanchayat").html(result);
$("#TargetPanchayat").multiselect('destroy');
$('#TargetPanchayat').multiselect({
  nonSelectedText: 'Select Panchayat',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});
    }});

});

$("#NgoPeriodId").change(function(){
var c=$(this).val();
//$('#TargetTotalMonths').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>periods/getmonths/"+c,success:function(result){$("#TargetTotalMonths").val(result);}});

});

 $('#TargetPanchayat').multiselect({
  nonSelectedText: 'Select Panchayat',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});    
   
});
</script>