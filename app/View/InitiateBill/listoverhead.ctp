<? $allparentids=@implode('##',$users);?>
<div class="actions"><h2><?php echo __('Financial Details'); ?></h2></div>
<div class="btn-group">
<?php echo $this->Html->link(__('New Financial Detail'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Add Overhead'), array('action' => 'addoverhead'),array('class' => 'btn btn-primary')); ?>
</div>

<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>financialDetails/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="col-sm-3"><input type="text" name="search_key" placeholder="Amount" class="form-control" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>"/></div>

<!--<div class="col-sm-3"><div class="input-group"><input type="text" name="from_date" id="from_date" class="form-control" placeholder="DATE FROM" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="text" name="to_date" id="to_date" class="form-control" placeholder="DATE TO" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>-->


<div class="col-sm-3"><select name="organization" id="organization" class="form-control">
<option value="">Select NGO</option>
<?php foreach ($ngos as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['organization']) && $this->params->query['organization']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>

<div class="col-sm-3"><select name="category" id="category" class="form-control">
<option value="">Select Category</option>
<?php foreach ($cats as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['category']) && $this->params->query['category']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>

<div class="col-sm-3"><select name="subcategory" id="subcategory" class="form-control">
<option value="">Select Subcategory</option>
<?php foreach ($subcats as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['subcategory']) && $this->params->query['subcategory']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>
<div class="col-sm-1"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 

<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>financialDetails/'"/></div>
<div class="col-sm-1" style="float:right; margin-top:15px;"><input type="button" name="reset" value="Export" class="btn btn-block export" onclick="window.open('<?=SITE_PATH?>financialDetails/export/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/></div>

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
<th><?php echo $this->Paginator->sort('grant_period'); ?></th>
<th><?php echo $this->Paginator->sort('totalamount'); ?></th>
<th><?php echo $this->Paginator->sort('percentage'); ?></th>
<th><?php echo $this->Paginator->sort('overhead_amount'); ?></th>

<?php /*?> <th><?php echo $this->Paginator->sort('Total Budget'); ?></th><?php */?>
<th><?php echo $this->Paginator->sort('remarks'); ?></th>


<?php /*?> <th><?php echo $this->Paginator->sort('B.form'); ?></th><?php */?>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($financials as $financial): ?>
<tr>
<td><?php echo h($financial['OverheadDetail']['id']); ?></td>
<td><?php echo h(ucfirst($financial['Ngo']['name_of_ngo'])); ?></td>
<td><?php echo h(date('d-m-Y',strtotime($financial['Period']['from_date'])).' To '.date('d-m-Y',strtotime($financial['Period']['to_date']))); ?></td>
<td><?php echo h(ucfirst($financial['OverheadDetail']['totalamount'])); ?>:00</td>
<td><?php echo h(ucfirst($financial['OverheadDetail']['percentage'])); ?></td>
<td><?php echo h(ucfirst($financial['OverheadDetail']['overhead_amount'])); ?>:00</td>

<?php /*?><td>
    <!--<a href="javascript:void(0)" class="moredetails" data-toggle="modal" data-target="#myModal" data-id="<?=$financial['FinancialDetail']['cat_id']?>">-->
    <?php 
$subtotal = $this->requestAction(array("controller"=>"financialDetails","action"=>"getall",$financial['FinancialDetail']['cat_id'])); 
echo $subtotal; 
?><!--</a>--></td><?php */?>
<td><?php echo h(ucfirst($financial['OverheadDetail']['remarks'])); ?></td>
<td class="actions">
<!--<a href="javascript:void(0)" class="moredetails btn btn-success" data-toggle="modal" data-target="#myModal" data-id="<?=$financial['FinancialDetail']['cat_id']?>">More</a>-->
<?php echo $this->Html->link(__('Edit'), array('action' => 'editoverhead', $financial['OverheadDetail']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'deleteoverhead', $financial['OverheadDetail']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $financial['OverheadDetail']['id'])); ?>
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
$.ajax({url:"<?=SITE_PATH?>financialDetails/view/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});

$(".moredetails").click(function(){
$('#resultTable tr').removeClass("done");
$(this).parent().parent().addClass("done");
var dataid=$(this).attr('data-id');
$('.right_resale').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>financialDetails/viewdetails/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});


$(document).ready(function(){
$("#category").change(function(){
var c=$(this).val();
$('#subcategory').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>subcategorys/getsubcat/"+c,success:function(result){$("#subcategory").html(result);}});

});
});

</script>
