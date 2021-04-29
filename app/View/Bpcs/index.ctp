<? $allparentids=@implode('##',$users);?>
<div class="actions">
<h2><?php echo __('BPC Details'); ?></h2>
</div>
<div class="btn-group">
<?php echo $this->Html->link(__('New BPC'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('NGO'), array('controller' => 'ngos','action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>

<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>bpcs/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="col-sm-3"><input type="text" name="search_key" placeholder="By Staff Mobile,Email Id" class="form-control" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>"/></div>

<div class="col-sm-3"><select name="organization" id="organization" class="form-control">
<option value="">Select NGO</option>
<?php foreach ($ngos as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['organization']) && $this->params->query['organization']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>
<div class="col-sm-3"><select name="user" class="form-control" id="BpcccFirstName">
<option value="">Select User</option>
<?php
foreach($executives as $usr){ ?>


<!--<option value="<?php echo $usr['User']['id']?>" <? if(isset($this->params->query['user']) && $this->params->query['user']==$usr['User']['id']) { ?> selected="selected"<? } ?> ><?php echo $usr['User']['name'].' '.$usr['User']['last_name'] ?> </option>-->

    
<?php
//echo "<option value=".$usr['User']['id'].">".$usr['User']['name'].' '.$usr['User']['last_name']."</option>";
}
?>

</select></div>


<div class="col-sm-1"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 

<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>bpcs/'"/></div>
<div class="col-sm-1" style="float:right; margin-top:15px;"><input type="button" name="reset" value="Export" class="btn btn-block export" onclick="window.open('<?=SITE_PATH?>bpcs/export/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/></div>

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
<th><?php echo $this->Paginator->sort('organization'); ?></th>
<th><?php echo $this->Paginator->sort('staff_name'); ?></th>
<th><?php echo $this->Paginator->sort('mobile'); ?></th>
<th><?php echo $this->Paginator->sort('allocated_district'); ?></th>
<th><?php echo $this->Paginator->sort('allocated_block'); ?></th>
<th><?php //echo $this->Paginator->sort('Date of Joining'); ?>Date of Joining</th>
<th><?php //echo $this->Paginator->sort(''); ?>Contract End Date</th>


<?php /*?> <th><?php echo $this->Paginator->sort('B.form'); ?></th><?php */?>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($geographicals as $geographical): ?>
<tr>
<td><?php echo h($geographical['Bpc']['id']); ?></td>
<td><?php echo h(ucfirst($geographical['Ngo']['name_of_ngo'])); ?></td>
<td><?php echo h(ucfirst($geographical['User']['name'].' '.$geographical['User']['last_name'])); ?></td>
<td><?php echo h(ucfirst($geographical['Bpc']['mobile'])); ?></td>
<td><?php echo h(ucfirst($geographical['City']['name'])); ?></td>
<td><?php 
$mem = explode(',',$geographical['Bpc']['allocated_block']);
//print_r($mem);
foreach($mem as $m) {
  $questionlist=$this->requestAction(array("controller"=>"blocks","action"=>"gettitle",$m)); 
                 
                  echo ucwords($questionlist['Block']['name'].' ');
}

//echo h(ucfirst($geographical['Block']['name'])); ?></td>
<td><?php echo h(date('d-m-Y',strtotime($geographical['Bpc']['date_of_joining']))); ?></td>
<td><?php echo h(date('d-m-Y',strtotime($geographical['Bpc']['contract_end_date']))); ?></td>
<td class="actions">
<a href="javascript:void(0)" class="more btn btn-success" data-toggle="modal" data-target="#myModal" data-id="<?=$geographical['Bpc']['id']?>">More</a>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $geographical['Bpc']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $geographical['Bpc']['id']), array('class' => 'btn btn-danger'),null, __('Are you sure you want to delete # %s?', $geographical['Bpc']['id'])); ?>
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
$.ajax({url:"<?=SITE_PATH?>bpcs/view/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});



$(document).ready(function(){
$("#organization").change(function(){
var c=$(this).val();
$('#BpcccFirstName').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>bpcs/getuser/"+c,success:function(result){$("#BpcccFirstName").html(result);}});

});
});

</script>
