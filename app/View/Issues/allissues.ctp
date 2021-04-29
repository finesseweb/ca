<style>
    .showactive{
        background-color: #89191d !important;
    }
    </style>

<? $allparentids=@implode('##',$users);?>
<div class="actions"><h2><?php echo __('Issue Details'); ?></h2></div>
<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?>
<div class="btn-group">
<?php echo $this->Html->link(__('New Issue'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Pending Issues for Review'), array('controller' => 'vhsncMeetings','action' => 'reviewissue'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Resolved Issues'), array('controller' => 'vhsncMeetings','action' => 'revieresolved'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('All Issues'), array('action' => 'allissues'),array('class' => 'btn btn-primary showactive')); ?>

</div>
<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>issues/allissues/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>

<div class="col-sm-3"><div class="input-group"><input type="text" name="from_date" id="from_date" class="form-control" placeholder="Date From" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="text" name="to_date" id="to_date" class="form-control" placeholder="Date To" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>

<div class="col-sm-2"><select name="block" id="block" class="form-control">
<option value="">Select Block</option>
<?php foreach ($blocks as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['block']) && $this->params->query['block']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>

<div class="col-sm-2"><select name="panchayat" id="panchayat" class="form-control">
<option value="">Select Panchayat</option>
<?php foreach ($panchayats as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['panchayat']) && $this->params->query['panchayat']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>



<div class="col-sm-1"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 

<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>issues/allissues/'"/></div>
<!--<div class="col-sm-1" style="float:right;"><input type="button" name="reset" value="export" class="btn btn-block" onclick="window.open('<?=SITE_PATH?>issues/export/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/></div>-->

</form>
</div>
</div>
</div>


<div class="row">
<div class="col-sm-12"><div class="left_resale">
<div class="table-responsive">
<table class="table table-hover table-condensed" id="resultTable">
<tr>
<th>Activities</th>
<th>Identified Issues <br>(Resolved+Pending+NA) </th>
<th>Verified Issues</th>
<th>Resolved Issues <br>(Verification Pending)</th>
<th>Pending Issues</th>
<th>Not Applicable Issues</th>
</tr>
<tr>
<td>VHSNC Meeting</td>
<td><?=$vhsncmeeting?></td>
<td><?=$vhsncverified?></td>
<td><?=$vhsncresolved?></td>
<td><?=$vhsncpending?></td>
<td><?=$vhsncnot?></td>
</tr>
<tr>
<td>ANM Meeting</td>
<td><?=$anmMeeting ?></td>
<td><?=$anmverified?></td>
<td><?=$anmresolved?></td>
<td><?=$anmpending?></td>
<td>0</td>
</tr>
<tr>
<td>BPMC Meeting</td>
<td><?=$bpmcmeeting ?></td>
<td><?=$bpmcverified?></td>
<td><?=$bpmcresolved?></td>
<td><?=$bpmcpending?></td>
<td>0</td>
</tr>
<tr>
<td>DPMC Meeting</td>
<td><?=$dpmcmeeting?></td>
<td><?=$dpmcverified?></td>
<td><?=$dpmcresolved?></td>
<td><?=$dpmcpending?></td>
<td>0</td>
</tr>
<tr>
<td>Social Audit</td>
<td><?=$socialaudit?></td>
<td><?=$socialverified?></td>
<td><?=$socialresolved?></td>
<td><?=$socialpending?></td>
<td>0</td>
</tr>

</table>

</div></div></div></div>
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
</div>


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

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('to_date'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('from_date'));	
</script>

<script type="text/javascript">
$(".more").click(function(){
$('#resultTable tr').removeClass("done");
$(this).parent().parent().addClass("done");
var dataid=$(this).attr('data-id');
$('.right_resale').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>/issues/viewissues/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});


$("#block").change(function(){
var c=$(this).val();
$('#panchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#panchayat").html(result);}});

});

$(document).ready(function(){
    
    $("#organization").change(function(){
var c=$(this).val();
$('#block').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>ngos/getblocksngo/?nid="+c,success:function(result){$("#block").html(result);}});

});
$("#panchayat").change(function(){
var c=$(this).val();
$('#village').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>villages/getvillages/"+c,success:function(result){$("#village").html(result);}});

});

$("#village").change(function(){
var c=$(this).val();
$('#ward').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>wards/getwards/"+c,success:function(result){$("#ward").html(result);}});

});
});

</script>
