<?php  $allparentids=@implode('##',$users);?>

<style>
    .showactive{
        background-color: #89191d !important;
    }
    </style>
    <div class="actions"><h2><?php echo __('VHSNC Issue Pending'); ?></h2></div>
<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?>
<div class="btn-group">
<?php echo $this->Html->link(__('New Issue'), array('controller' => 'issues','action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Pending Issues for Review'), array('controller' => 'vhsncMeetings','action' => 'reviewissue'),array('class' => 'btn btn-primary showactive')); ?>
<?php echo $this->Html->link(__('Resolved Issues'), array('controller' => 'vhsncMeetings','action' => 'revieresolved'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('All Issues'), array('controller' => 'issues','action' => 'allissues'),array('class' => 'btn btn-primary')); ?>

</div>

<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>vhsncMeetings/reviewissue">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="col-sm-3"><input type="text" name="search_key" placeholder="By Decisions taken,Issue resolved,Issue details,VHSNC quorum" class="form-control" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>"/></div>

<div class="col-sm-3"><div class="input-group"><input type="text" name="from_date" id="from_date" class="form-control" placeholder="Date From" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="text" name="to_date" id="to_date" class="form-control" placeholder="Date To" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>
<div class="col-sm-2"><select name="block" id="block" class="form-control">
<option value="">Select Block</option>
<?php foreach ($blocks as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['block']) && $this->params->query['block']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>
<div class="col-sm-2"><select name="panchayat" id="panchayat" class="form-control">
<option value="">Select Panchayat</option>
<? foreach ($panchayats as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['panchayat']) && $this->params->query['panchayat']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>

<div class="col-sm-2"><select name="village" id="village" class="form-control">
<option value="">Select Village</option>
<?php if(!empty($villages)) { foreach ($villages as $key2=>$village){?>
<option value="<? echo $key2; ?>" <? if(isset($this->params->query['village']) && $this->params->query['village']==$key2) { ?> selected="selected"<? } ?>><? echo $village; ?></option>
<? } } ?>
</select></div>
<!--<div class="col-sm-2"><select name="ward" id="ward" class="form-control">
<option value="">SELECT Ward</option>
<?php if(!empty($wards)) { foreach ($wards as $key2=>$ward){?>
<option value="<? echo $key2; ?>" <? if(isset($this->params->query['ward']) && $this->params->query['ward']==$key2) { ?> selected="selected"<? } ?>><? echo $ward; ?></option>
<? } } ?>
</select></div>-->

<div class="col-sm-1"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 

<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>vhsncMeetings/reviewissue'"/></div>
<div class="col-sm-1" style="float:right;"><input type="button" name="reset" value="Export" class="btn btn-block export" onclick="window.open('<?=SITE_PATH?>vhsncMeetings/exportpendingissue/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/></div>

</form>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12"><div class="left_resale">
<div class="table-responsive">
<table class="table table-hover table-condensed" id="resultTable">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('district'); ?></th>
<th><?php echo $this->Paginator->sort('block'); ?></th>
<th><?php echo $this->Paginator->sort('panchayat'); ?></th>
<th><?php echo $this->Paginator->sort('issue_category'); ?></th>
<th><?php echo $this->Paginator->sort('issue_level'); ?></th>
<th><?php echo $this->Paginator->sort('meeting_date'); ?></th>
<th><?php echo $this->Paginator->sort('issue_resolved'); ?></th>




<?php /*?> <th><?php echo $this->Paginator->sort('B.form'); ?></th><?php */?>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($vhsncafcs as $vhsncafc): ?>
<tr>
<td><?php echo h($vhsncafc['VhsncMeeting']['id']); ?></td>
<td><?php echo h(ucfirst($vhsncafc['City']['name'])); ?></td>
<td><?php  echo h(ucfirst($vhsncafc['Block']['name'])); ?></td>
<td><?php echo h(ucfirst($vhsncafc['Panchayat']['name'])); ?></td>
<td><?php echo h(ucfirst($vhsncafc['IssueCategory']['name'])); ?></td>
<td><?php echo h(ucfirst($vhsncafc['IssueSubcategory']['name'])); ?></td>
<td><?php echo h(date('d-m-Y',strtotime($vhsncafc['VhsncMeeting']['meeting_date']))); ?></td>
<td><?php echo h(ucfirst($vhsncafc['VhsncMeeting']['issue_resolved'])); ?></td>
<td class="actions">
<a href="javascript:void(0)" class="more btn btn-success" data-toggle="modal" data-target="#myModal" data-id="<?=$vhsncafc['VhsncMeeting']['id']?>">More</a>
<?php 
if($sessionval=='regular') {
?>
 <?php
if(in_array($this->request->params['controller'].":edit",$menu) && $vhsncafc['VhsncMeeting']['updated']==0){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'editissue', $vhsncafc['VhsncMeeting']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
   <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $vhsncafc['VhsncMeeting']['id']),array('class'=>'btn btn-dnager'));?>

<?php } ?>

<?php } else {?>
 <?php echo $this->Html->link(__('Edit'), array('action' => 'editissue', $vhsncafc['VhsncMeeting']['id']),array('class' => 'btn btn-primary')); ?>
 <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $vhsncafc['VhsncMeeting']['id']),array('class'=>'btn btn-danger'));?>

<?php } ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<p>

<?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>	</p>
<div class="paging">
<?php
echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
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
$.ajax({url:"<?=SITE_PATH?>/vhsncMeetings/view/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});



$(document).ready(function(){
    
$("#block").change(function(){
var c=$(this).val();
$('#panchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#panchayat").html(result);}});

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
