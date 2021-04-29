<?php 
$menu= $this->Session->read('User.mainmenu');
$sessionval=$this->Session->read('User.type');
 $sessionrole=$this->Session->read('User.subrole');     
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
   
<!--    <div class="row-one">
        <div class="col-md-4 widget upper">
	<div class="stats-left ">
	  <h5>District</h5>
		</div>
		<div class="stats-right">
		<label id='city'><?=$citie?></label>
	</div>
	<div class="clearfix"> </div>	
	</div>
	<div class="col-md-4 widget upper states-md3">
	<div class="stats-left">
	<h5>Block</h5>
	</div>
	<div class="stats-right">
           <label id='blockss'><?=$block?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget upper states-md3">
	<div class="stats-left">
	<h5>Panchayat</h5>
	</div>
	<div class="stats-right">
           <label id='panchayt'><?=$panchayat?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget upper states-md3">
	<div class="stats-left">
	<h5>Village</h5>
	</div>
	<div class="stats-right">
            <label id='villagess'><?=$village?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget upper states-md3">
	<div class="stats-left">
	<h5>Household</h5>
	</div>
	<div class="stats-right">
            <label id='house'><?=$house['0']['0']['totalhouse']?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget upper states-md3">
	<div class="stats-left">
	<h5>Population</h5>
	</div>
	<div class="stats-right">
            <label id='population'> <?=$population['0']['0']['totalpop']?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget upper states-md3">
	<div class="stats-left">
	<h5>AWC</h5>
	</div>
	<div class="stats-right">
            <label id='awc'><?=$awc?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget upper  states-md3">
	<div class="stats-left">
	<h5>VHSND</h5>
	</div>
	<div class="stats-right">
            <label id='vhsnd'> <?=$vhsnd[0][0]['totalvhsnd']?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget bottom states-mdl">
	<div class="stats-left">
	<h5>HSC</h5>
	</div>
	<div class="stats-right">
             <label id='hsc'> <?=$hsc?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget bottom states-mdl">
	<div class="stats-left">
	<h5>APHC</h5>
	</div>
	<div class="stats-right">
            <label id='aphc'> <?php if($aphc) { echo $aphc; } else { echo "0" ;} ?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget bottom states-mdl">
	<div class="stats-left">
	<h5>H&WC</h5>
	</div>
	<div class="stats-right">
            <label id='hwc'><?=$facility?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget bottom states-mdl">
	<div class="stats-left">
	<h5>ASHA</h5>
	</div>
	<div class="stats-right">
            <label id='asha'> <?=$asha[0][0]['totalasha']?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget bottom states-mdl">
	<div class="stats-left">
	<h5>ASHA Facilitator</h5>
	</div>
	<div class="stats-right">
            <label id='ashafaci'> <?=$ashafacilitator[0][0]['totalashafac']?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget bottom states-mdl">
	<div class="stats-left">
	<h5>AWW</h5>
	</div>
	<div class="stats-right">
           <label id='aww'> <?=$aww[0][0]['totalaww']?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
        <div class="col-md-4 widget bottom states-mdl">
	<div class="stats-left">
	<h5>ANM</h5>
	</div>
	<div class="stats-right">
            <label id='anm'> <?=$anm[0][0]['totalanm']?></label>
			</div>
	<div class="clearfix"> </div>	
		</div>
		<div class="col-md-4 bottom widget states-mdl">
		<div class="stats-left">
		<h5>Youth Leader</h5>
		
		</div>
		<div class="stats-right">
			 <label id='youthleader'> <?=$youthleader?></label>
		</div>
		<div class="clearfix"> </div>	
					</div>
					<div class="clearfix"> </div>	
				</div>


<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>users/welcome/">
<div class="col-sm-3"><select name="organization" id="organization" class="form-control" required>
<option value="">Select NGO <p background-color: red";>*</p></option>
<?php foreach ($ngos as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['organization']) && $this->params->query['organization']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>
<div class="col-sm-3"><select name="district" id="district" class="form-control" required>
<option value="">Select District <span background-color: red";>*</span></option>
<?php foreach ($cities as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['district']) && $this->params->query['district']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>
<div class="col-sm-3"><select name="block" id="block" class="form-control" required>
<option value="">Select Block <span background-color: red";>*</span></option>
<?php foreach ($blocks as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['block']) && $this->params->query['block']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>

<div class="col-sm-3"><select name="panchayat[]" id="panchayat" class="form-control" multiple="multiple">
<option value="">Select Panchayat</option>
<?php foreach ($panchayats as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['panchayat']) && $this->params->query['panchayat']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>
<div class="col-sm-3"><select name="village" id="village" class="form-control">
<option value="">Select Village</option>
<?php foreach ($villages as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['village']) && $this->params->query['village']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>

<div class="col-sm-3"><div class="input-group"><label>From Month</label><input type="month" name="from_date" id="from_date" class="form-control" placeholder="DATE FROM" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/></div></div>
<div class="col-sm-3"><div class="input-group"><label>To Month</label><input type="month" name="to_date" id="from_date" class="form-control" placeholder="DATE FROM" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/></div></div>
<div class="col-sm-1"><input type="submit" name="confirm" value="Search" id="search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 
<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>users/welcome/'"/></div>
<div class="col-sm-1" style="float:right; margin-top:15px;"></div>
<input type="hidden" name="total" id="totalpanchayat" value="">

</form>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12"><div class="left_resale">
<div class="table-responsive">
<table class="table table-hover table-condensed" id="resultTable">
<tr>
<th>S.No</th>
<th><?php echo $this->Paginator->sort('Performance Indicator'); ?></th>
<th><?php echo $this->Paginator->sort('Target'); ?></th>
<th><?php echo $this->Paginator->sort('Total'); ?></th>
<th><?php echo $this->Paginator->sort('Percent (%)'); ?></th>
</tr>
<tr>
<td>1</td>
<td>VHSNC Meeting Organised </td>
<td id="vhnsc_meeitng"> <?php if(!empty($aspermonthvhsnctarget)){ echo round($aspermonthvhsnctarget); }?></td>
<td><p class="clear"><?php if(!empty($meeting)){ echo $meeting; }?></p></td>
<td><p class="clear"><?php if(!empty($aspermonthvhsnctarget) && !empty($meeting) ){ echo round($meeting*100/$aspermonthvhsnctarget);} ?></p></td>

</tr>
<tr>
    <td>2</td>
<td>VHSNC Untied Fund expenditure against total balance </td>
<td id="vhsnc_exp"><?php if(!empty($aspermonthexpendituretarget)){ echo round($aspermonthexpendituretarget); }?></td></td>
<td><p class="clear"><?php if(!empty($VhsncUntiedfund)){ echo $VhsncUntiedfund['0']['0']['total']; }?></p></td>
<td><p class="clear"><?php if(!empty($VhsncUntiedfunddetail)){ echo round($VhsncUntiedfund['0']['0']['total']*100/$VhsncUntiedfunddetail); }?></p></td>
</tr>
<tr>
    <td>3</td>
<td>VHSNC Untied Fund expenditure against total allocation </td>
<td id="vhsnc_all_exp"><?php if(!empty($aspermonthalloexptarget)){ echo round($aspermonthalloexptarget); }?></td></td>
<td><p class="clear"><?php if(!empty($vhsncfunrecieced)){ echo $vhsncfunrecieced; }?></p></td>
<td><p class="clear"><?php if(!empty($vhsncfunrecieced)){ echo round($VhsncUntiedfund['0']['0']['total']*100/$vhsncfunrecieced); }?></p></td>

</tr>
<tr>
    <td>4</td>
<td>VHSNC Provided feedback  </td>
<td id="vhsnc_feedback"><?php if(!empty($aspermonthfeedbacktraget)){ echo round($aspermonthfeedbacktraget); }?></td>
<td><p class="clear"><?php if(!empty($VhsncFeedback)){ echo $VhsncFeedback; }?></p></td>
<td><p class="clear"><?php if(!empty($Vhsncconstition)){ echo round($VhsncFeedback*100/$Vhsncconstition); }?></p></td>
</tr>
<tr>
    <td>5</td>
<td>Issues identified   </td>
<td id="issue_identified"><?php if(!empty($aspermonthissuetarget)){ echo round($aspermonthissuetarget); }?></td>
<td><p class="clear"><?php if(!empty($issuecount)){ echo $issuecount; }?></p></td>
<td><p class="clear"><?php if(!empty($aspermonthissuetarget)){ echo round($issuecount*100/$aspermonthissuetarget); }?></p></td></td>
</tr>
<tr>
    <td>6</td>
<td>Issues resolved   </td>
<td id="issue_resolved"><?php if(!empty($aspermonthresolvedissuetarget)){ echo round($aspermonthresolvedissuetarget); }?></td>
<td><p class="clear"><?php if(!empty($issueresolve)){ echo $issueresolve; }?></p></td>
<td><p class="clear"><?php if(!empty($issueresolve)){ echo round($issueresolve*100/$issuecount); }?></p></td>
</tr>
<tr>
    <td>7</td>
<td>Issues pending   </td>
<td id="issue_pending"><?php if(!empty($aspermonthissuependingtarget)){ echo round($aspermonthissuependingtarget); }?></td></td>
<td><p class="clear"><?php if(!empty($issuepending)){ echo $issuepending; }?></p></td>
<td><p class="clear"><?php if(!empty($issuecount)){ echo  round($issuecount-$issueresolve*100/$issuecount); }?></p></td>
</tr>
<tr>
    <td>8</td>
<td>VHSND sites monitored   </td>
<td id="vhsnd_monitored"><?php if(!empty($aspermonthvhsndtarget)){ echo round($aspermonthvhsndtarget); }?></td>
<td><p class="clear"><?php if(!empty($vhsndmonitored)){ echo $vhsndmonitored; }?></p></td>
<td><p class="clear"><?php if(!empty($aspermonthvhsndtarget)){ echo round($vhsndmonitored*100/$aspermonthvhsndtarget); }?></p></td>
</tr>
<tr>
    <td>9</td>
<td>Aviailiabilty of all ANC services at outreach against VHSND site monitored   </td>
<td id="anc_sevices"><?php if(!empty($aspermonthancservicetarget)){ echo round($aspermonthancservicetarget); }?></td></td>
<td><p class="clear"><?php if(!empty($vhsndservice)){ echo $vhsndservice; }?></p></td>
<td><p class="clear"><?php if(!empty($vhsndmonitored)){ echo round($vhsndservice*100/$vhsndmonitored); }?></p></td>
</tr>
<tr>
    <td>10</td>
<td>VHSNC Member monitored local services   </td>
<td id="vhsnc_monitored"><?php if(!empty($aspermonthvhsncmonitortarget)){ echo round($aspermonthvhsncmonitortarget); }?></td>
<td><p class="clear"></p></td>
<td><p class="clear"></p></td>
</tr>
<tr>
    <td>11</td>
<td>M-shakti (IVRS) User Provided Community feedback  </td>
<td id="ivrs_feedback"><?php if(!empty($aspermonthivrstarget)){ echo round($aspermonthivrstarget); }?></td>
<td><p class="clear"><?php if(!empty($ivrsfeedback)){ echo $ivrsfeedback; }?></p></td>
<td><p class="clear"><?php if(!empty($ivrsuser)){ echo round($ivrsfeedback*100/$ivrsuser); }?></p></td>
</tr>
<tr>
    <td>12</td>
<td>Participated in ANM Meeting   </td>
<td id="anm_meeting"><?php if(!empty($aspermonthanmmeetingtarget)){ echo round($aspermonthanmmeetingtarget); }?></td>
<td><p class="clear"><?php if(!empty($AnmMeeting)){ echo $AnmMeeting; }?></p></td>
<td><p class="clear"><?php if(!empty($aspermonthanmmeetingtarget)){ echo round($AnmMeeting*100/$aspermonthanmmeetingtarget); }?></p></td>
</tr>
<tr>
    <td>13</td>
<td>DPMC meeting organised   </td>
<td id="dpmc_meeting"><?php if(!empty($aspermonthdpmctarget)){ echo round($aspermonthdpmctarget); }?></td>
<td><p class="clear"><?php if(!empty($dpmcmeeting)){ echo $dpmcmeeting; } ?></p></td>
<td><p class="clear"><?php if(!empty($aspermonthdpmctarget)){ echo round($dpmcmeeting*100/$aspermonthdpmctarget); }?></p></td>
</tr>
<tr>
    <td>14</td>
<td>BPMC Meeting Organised   </td>
<td id="bpmc_meeting"><?php if(!empty($aspermonthbpmctarget)){ echo round($aspermonthbpmctarget); }?></td>
<td><p class="clear"><?php if(!empty($bpmcmeeting)){ echo $bpmcmeeting; } ?></p></td>
<td><p class="clear"><?php if(!empty($aspermonthbpmctarget)){ echo round($bpmcmeeting*100/$aspermonthbpmctarget); } ?></p></td>
</tr>
<tr>
    <td>15</td>
<td>RKS Meeting Organised   </td>
<td id="rks_meeting"><?php if(!empty($aspermonthrkstarget)){ echo round($aspermonthrkstarget); } ?></td>
<td><p class="clear"></p></td>
<td><p class="clear"></p></td>
</tr>
<tr>
    <td>16</td>
<td>VHSNC  monitoring quality checklist filled   </td>
<td id="vhsnc_checklist"><?php if(!empty($aspermonthvhsncchecklisttarget)){ echo round($aspermonthvhsncchecklisttarget); }?></td>
<td><p class="clear"><?php if(!empty($checklist)) { echo $checklist; } ?></p></td>
<td><p class="clear"><?php if(!empty($aspermonthvhsncchecklisttarget)){ echo round($checklist*100/$aspermonthvhsncchecklisttarget); }?></p></td>
</tr>
<tr>
    <td>17</td>
<td>VHSND monitoring quality checklist filled   </td>
<td id="vhsnd_checklist"><?php if(!empty($aspermonthvhsndchecklisttarget)){ echo round($aspermonthvhsndchecklisttarget); }?></td>
<td><p class="clear"><?php if(!empty($checklistvhsnd)) { echo $checklistvhsnd; } ?></p></td>
<td><p class="clear"><?php if(!empty($aspermonthvhsndchecklisttarget)) { echo round($checklistvhsnd*100/$aspermonthvhsndchecklisttarget); } ?></p></td>
</tr>
<tr>
    <td>18</td>
<td>Facility Assessement Conducted   </td>
<td id="facility_assessment"><?php if(!empty($aspermonthassessementtarget)){ echo round($aspermonthassessementtarget); }?></td>
<td><p class="clear"><?php if(!empty($checklistassessement)) { echo $checklistassessement; } ?></p></td>
<td><p class="clear"><?php if(!empty($checklistassessement)) { echo round($checklistassessement*100/$facilityDetail); } ?></p></td>
</tr>
<tr>
<td>19</td>
<td>Facilities providing IUCD services on fixed day   </td>
<td id="iucd_service"><?php if(!empty($aspermonthicudservicetarget)){ echo round($aspermonthicudservicetarget); }?></td>
<td><p class="clear"><?php if(!empty($afcmeeting)){ echo $afcmeeting; }?></p></td>
<td><p class="clear"><?php if(!empty($aspermonthicudservicetarget)){ echo round($afcmeeting*100/$aspermonthicudservicetarget); }?></p></td>
</tr>
<tr>
<td>20</td>
<td>Facilities providing Antara services on fixed day </td>
<td id="antara_service"><?php if(!empty($aspermonthantaraservicetarget)){ echo round($aspermonthantaraservicetarget); }?></td>
<td><p class="clear"><?php if(!empty($afcmeeting1)){  echo $afcmeeting1;}?></p></td>
<td><p class="clear"><?php if(!empty($aspermonthantaraservicetarget)){ echo round($afcmeeting1*100/$aspermonthantaraservicetarget); }?></p></td>
</tr>
<tr>
    <td>21</td>
<td>Project Budget Utilized   </td>
<td id="project_budget"><?php if(!empty($aspermonthanbudgetutilizedtarget)){ echo round($aspermonthanbudgetutilizedtarget); }?></td></td>
<td><p class="clear"><?php if(!empty($financialDetail)){ echo $financialDetail['0']['0']['ftotal']; }?></p></td>
<td><p class="clear"><?php if(!empty($finance['0']['0']['etotal'])){ echo round($finance['0']['0']['etotal']*100/$financialDetail['0']['0']['ftotal']); }?></p></td>
</tr>

<?php //endforeach; ?>
</table>
<p>

</div>
</div></div></div>
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">More Details</h4>
</div>
<div class="modal-body">
<div class="right_resale" id="resalemore"><table cellpadding="0" cellspacing="0">
<tr><td>!! MORE DATA SHOULD BE DISPLAY HERE !!</td></tr>
</table></div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>-->


<!--</div>-->
<?php /*?><div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<ul>
<?php echo $this->Html->link(__('New Booking'), array('action' => 'add')); ?>
</ul>
</div><?php */?>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

//var dp_cal1;var dp_cal2;      
//dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('to_date'));	
//dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('from_date'));	
</script>

<script type="text/javascript">
$(".more").click(function(){
$('#resultTable tr').removeClass("done");
$(this).parent().parent().addClass("done");
var dataid=$(this).attr('data-id');
$('.right_resale').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>youthleaders/view/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});



$(document).ready(function(){
$("#organization").change(function(){
var c=$(this).val();
$('#district').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getngodistrict/"+c,success:function(result){$("#district").html(result);}});
$.ajax({url:"<?=SITE_PATH?>targets/getpanchayats/"+c,success:function(result){$("#totalpanchayat").val(result);}});
$('.clear').css('display', 'none');
});
<?php if($sessionval!='regular') { ?>
$("#district").change(function(){
var c=$(this).val();
var o= $("#organization").val();
$('#block').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getblocksngo/?c="+c+"&nid="+o,success:function(result){$("#block").html(result);}});
});
<?php }?>
<?php if($sessionrole!='CC') { ?>
$("#block").change(function(){
var c=$(this).val();
var p= $('#totalpanchayat').val();
$('#panchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getallpanchayats/?c="+c+"&p="+p,success:function(result){

$("#panchayat").empty();
$("#panchayat").html(result);
$("#panchayat").multiselect('destroy');
$('#panchayat').multiselect({
  nonSelectedText: 'Select Panchayat',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});
$('.dropdown-menu li').addClass("active");
$('.dropdown-menu li input[type="checkbox"]').prop("checked");

}});

});
<?php } ?>

$("#panchayat").change(function(){
var c=$(this).val();
$('#village').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#village").html(result);}});

});



$('#panchayat').multiselect({
  nonSelectedText: 'Select panchayat',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'245px'
 });
$('.dropdown-menu').css({'overflow-y':'scroll','height':'200px'});


$('#organization').change(function(){

var c=$(this).val();
//alert(c);
if(c===''){
    location.reload();
    } else { 
$.ajax({url:"<?=SITE_PATH?>users/getalldata/?c="+c,success:function(result){
var objData = jQuery.parseJSON(result);
 $('#city').html(objData['city']);
 $('#blockss').html(objData['block']);
$('#panchayt').html(objData['panchayat']);
$('#villagess').html(objData['village']);
$('#house').html(objData['house']);
$('#population').html(objData['population']);
$('#awc').html(objData['awc']);
$('#vhsnd').html(objData['vhsnd']);
$('#hsc').html(objData['hsc']);
$('#aphc').html(objData['aphc']);
$('#hwc').html(objData['facility']);
$('#asha').html(objData['asha']);
$('#ashafaci').html(objData['ashafacilitator']);
$('#aww').html(objData['aww']);
$('#anm').html(objData['anm']);
$('#youthleader').html(objData['youthleader']);
}});


$.ajax({url:"<?=SITE_PATH?>users/getalltarget/?c="+c,success:function(result){

 
if(result){
       var objData = jQuery.parseJSON(result);

 //alert(objData['vhsnc_meeting_target']);
$('#vhnsc_meeitng').html(objData['vhsnc_meeting_target']);
$('#vhsnc_exp').html(objData['vhsnc_expenditure_total_target']);
$('#vhsnc_all_exp').html(objData['vhsnc_expenditure_allocation_target']);
$('#vhsnc_feedback').html(objData['feedback_target']);
$('#issue_identified').html(objData['vhsnc_issue_target']);
$('#issue_resolved').html(objData['vhsnc_issueresolved_target']);
$('#issue_pending').html(objData['issue_pending_target']);
$('#vhsnd_monitored').html(objData['vhsnd_monitor_target']);
$('#anc_sevices').html(objData['anc_service_target']);
$('#vhsnc_monitored').html(objData['vhsnc_monitor_target']);
$('#ivrs_feedback').html(objData['ivrs_feedback_target']);
$('#anm_meeting').html(objData['anm_meeting_target']);
$('#dpmc_meeting').html(objData['dpmc_meeting_target']);
$('#bpmc_meeting').html(objData['bpmc_meeting_target']);
$('#rks_meeting').html(objData['rks_meeting_target']);
$('#vhsnc_checklist').html(objData['vhsnc_checklist_target']);
$('#vhsnd_checklist').html(objData['vhsnd_checklist_target']);
$('#facility_assessment').html(objData['facility_assessement_target']);
$('#iucd_service').html(objData['iucd_services_target']);
$('#antara_service').html(objData['antara_services_target']);
$('#project_budget').html(objData['issue_pending_target']);               
 
}
else {
//alert('Target ie not exists');
$('#vhnsc_meeitng').html('');
$('#vhsnc_exp').html('');
$('#vhsnc_all_exp').html('');
$('#vhsnc_feedback').html('');
$('#issue_identified').html('');
$('#issue_resolved').html('');
$('#issue_pending').html('');
$('#vhsnd_monitored').html('');
$('#anc_sevices').html('');
$('#vhsnc_monitored').html('');
$('#ivrs_feedback').html('');
$('#anm_meeting').html('');
$('#dpmc_meeting').html('');
$('#bpmc_meeting').html('');
$('#rks_meeting').html('');
$('#vhsnc_checklist').html('');
$('#vhsnd_checklist').html('');
$('#facility_assessment').html('');
$('#iucd_service').html('');
$('#antara_service').html('');
$('#project_budget').html('');
return false ;
}

}});
    }});
});

</script>

