<? $allparentids=@implode('##',$users);?>
<div class="actions"><h2><?php echo __('Monthly Report'); ?></h2></div>
<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?>
<div class="btn-group">
<?php echo $this->Html->link(__('New Report'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Daily Reports'), array('controller' => 'commonreports','action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Daily Report'), array('controller' => 'commonreports','action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>

<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>monthlyreports/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<!--<div class="col-sm-3"><input type="text" name="search_key" placeholder="By Name of Monitor,VHSNC Name,Response,Status" class="form-control" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>"/></div>-->

<div class="col-sm-5"><div class="input-group"><input type="month" name="from_date" id="from_date" class="form-control" placeholder="Month From" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="month" name="to_date" id="to_date" class="form-control" placeholder="Month To" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>
<div class="col-sm-2"><select name="block" id="block" class="form-control">
<option value="">Select Block</option>
<?php foreach ($blocks as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['block']) && $this->params->query['block']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>
<div class="col-sm-3"><select name="panchayat" id="panchayat" class="form-control">
<option value="">Select Panchayat</option>
<? foreach ($panchayats as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['panchayat']) && $this->params->query['panchayat']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>

<div class="col-sm-2"><select name="level" id="level" class="form-control">
<option value="">Select Level</option>
<?php if(!empty($levels)) { foreach ($levels as $key2=>$level){?>
<option value="<? echo $key2; ?>" <? if(isset($this->params->query['level']) && $this->params->query['level']==$key2) { ?> selected="selected"<? } ?>><? echo $level; ?></option>
<? } } ?>
</select></div>
<!--<div class="col-sm-2"><select name="ward" id="ward" class="form-control">
<option value="">Select Ward</option>
<?php if(!empty($wards)) { foreach ($wards as $key2=>$ward){?>
<option value="<? echo $key2; ?>" <? if(isset($this->params->query['ward']) && $this->params->query['ward']==$key2) { ?> selected="selected"<? } ?>><? echo $ward; ?></option>
<? } } ?>
</select></div>-->

<div class="col-sm-1"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 

<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>monthlyreports/'"/></div>
<div class="col-sm-1" style="float:right; margin-top:15px;"><input type="button" name="reset" value="Export" class="btn btn-block export" onclick="window.open('<?=SITE_PATH?>monthlyreports/export/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/></div>

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
<th><?php echo $this->Paginator->sort('panchayat'); ?> </th>
<th><?php echo $this->Paginator->sort('month'); ?></th>
<th><?php echo $this->Paginator->sort('level'); ?></th>



<?php /*?> <th><?php echo $this->Paginator->sort('B.form'); ?></th><?php */?>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($vhsncafcs as $vhsncafc): ?>
<tr>
<td><?php echo h($vhsncafc['Monthlyreport']['id']); ?></td>
<td><?php echo h(ucfirst($vhsncafc['City']['name'])); ?></td>
<td><?php echo h(ucfirst($vhsncafc['Block']['name'])); ?></td>
<td><?php  echo h(ucfirst($vhsncafc['Panchayat']['name']) ? $vhsncafc['Panchayat']['name'] : 'All Panchayats' );  ?></td>
<!--<td class="question"><?php
///if($vhsncafc['Checklist']['question']!='') {
//$questionlist=$this->requestAction(array("controller"=>"subfeedbacks","action"=>"gettitle",$vhsncafc['Checklist']['question'])); 
               //  echo $questionlist['Subfeedback']['name'];
//}
//echo h(ucfirst($vhsncafc['Ward']['name'])); ?></td>-->
<td><?php echo h(date('M-Y',strtotime($vhsncafc['Monthlyreport']['month']))); ?></td>
<td><?php echo h($vhsncafc['Level']['name']); ?></td>
<td class="actions">
<a href="javascript:void(0)" class="more btn btn-success" data-toggle="modal" data-target="#myModal" data-id="<?=$vhsncafc['Monthlyreport']['id']?>">More</a>
<?php 
if($sessionval=='regular') {
?>
<?php
if(in_array($this->request->params['controller'].":edit",$menu)){
  
?>
<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsncafc['Checklist']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
  <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vhsncafc['Checklist']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $vhsncafc['Checklist']['id'])); ?>

<?php } ?>
<?php }  else {?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vhsncafc['Monthlyreport']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vhsncafc['Monthlyreport']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $vhsncafc['Monthlyreport']['id'])); ?>

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
<script type="text/javascript" language="javascript">

</script>

<script type="text/javascript">
$(".more").click(function(){
$('#resultTable tr').removeClass("done");
$(this).parent().parent().addClass("done");
var dataid=$(this).attr('data-id');
$('.right_resale').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>/monthlyreports/view/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});


$("#block").change(function(){
var c=$(this).val();
$('#panchayat').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>panchayats/getpanchayats/"+c,success:function(result){$("#panchayat").html(result);}});

});

$(document).ready(function(){
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
