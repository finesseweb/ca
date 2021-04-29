<? $allparentids=@implode('##',$users);?>
<div class="actions"><h2><?php echo __('DPMC Meeting Details'); ?></h2></div>
<?php $menu= $this->Session->read('User.mainmenu');
      $sessionval=$this->Session->read('User.type');
      
?>
<style>
    .showactive{
        background-color: #89191d !important;
    }
    </style>
<div class="btn-group">
<?php echo $this->Html->link(__('New DPMC Meeting'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Review Pending Issues'), array('action' => 'viewpendingissue'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Resolved Issues'), array('action' => 'viewresolvedissue'),array('class' => 'btn btn-primary showactive')); ?>
</div>

<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>dpmcs/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="col-sm-3"><input type="text" name="search_key" placeholder="By Decisions taken,Issue resolved,Issue details" class="form-control" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>"/></div>

<div class="col-sm-3"><div class="input-group"><input type="text" name="from_date" id="from_date" class="form-control" placeholder="Date From" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="text" name="to_date" id="to_date" class="form-control" placeholder="Date To" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>

<div class="col-sm-2"><select name="district" id="block" class="form-control">
<option value="">Select District</option>
<?php foreach ($cities as $key=>$citie){?>
<option value="<?php echo $key; ?>" <?php if(isset($this->params->query['district']) && $this->params->query['district']==$key) { ?> selected="selected"<? } ?>><?php echo $citie; ?></option>
<? } ?>
</select></div>

<div class="col-sm-1"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 

<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>dpmcs/'"/></div>
<div class="col-sm-1" style="float:right;"><input type="button" name="reset" value="Export" class="btn btn-block export" onclick="window.open('<?=SITE_PATH?>dpmcs/export/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/></div>

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
<th><?php echo $this->Paginator->sort('meeting_date'); ?></th>
<th><?php echo $this->Paginator->sort('issues_shared_in_dPMC'); ?></th>
<th><?php echo $this->Paginator->sort('decision_taken'); ?></th>
<th><?php echo $this->Paginator->sort('issues_resolved'); ?></th>
 <th><?php echo $this->Paginator->sort('issues_forwarded'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($anms as $anm): ?>
<tr>
<td><?php echo h($anm['Dpmc']['id']); ?></td>
<td><?php echo h(ucfirst($anm['City']['name'])); ?></td>
<td><?php echo h(date('d-m-Y',strtotime($anm['Dpmc']['meeting_date']))); ?></td>
<td>
           <?php
//$mem = explode(',',$anm['Dpmc']['register_member_type']);
////print_r($mem);
//foreach($mem as $m) {
//  $questionlist=$this->requestAction(array("controller"=>"registerMembers","action"=>"gettitle",$m)); 
//                 
//                  echo ucwords($questionlist['RegisterMember']['name'].' ');
//}
echo h(ucfirst($anm['Dpmc']['issue_shared_dpmc']));
 ?>

</td>
<td><?php echo h(ucfirst($anm['Dpmc']['decisions_taken'])); ?></td>
<td><?php echo h(ucfirst($anm['Dpmc']['issue_resolved'])); ?></td>
<td><?php echo h(ucfirst($anm['Dpmc']['letter_to_higher_authority'])); ?></td>
<td class="actions">
<a href="javascript:void(0)" class="more btn btn-success" data-toggle="modal" data-target="#myModal" data-id="<?=$anm['Dpmc']['id']?>">More</a>
<?php 
if($sessionval=='regular') {
?>
 <?php
if(in_array($this->request->params['controller'].":edit",$menu) && $anm['Dpmc']['updated']==0){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $anm['Dpmc']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
   <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
   <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $anm['Dpmc']['id']),array('class'=>'btn btn-dnager'));?>

<?php } ?>

<?php } else {?>
 <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $anm['Dpmc']['id']),array('class' => 'btn btn-primary')); ?>
 <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $anm['Dpmc']['id']),array('class'=>'btn btn-danger'));?>

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
$.ajax({url:"<?=SITE_PATH?>/dpmcs/view/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
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
