<?php /*?><div class="moreCustomerFeeds index"><?php */?>
<h2><?php echo __('More Customer Feeds'); ?></h2>
<div class="btn-group">
<?php echo $this->Html->link(__('New More Customer Feed'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Customer Feedbacks'), array('controller' => 'customer_feedbacks', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>

<div class="panel panel-default">
<div class="panel-body">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>moreCustomerFeeds/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="row"><div class="col-sm-3">
<select name="customer_feedback_id" id="search_user" class="form-control">
<option value="">CUSTOMERS</option>
<? $select='';$customer_feedback_id='';

if(isset($this->params->query['customer_feedback_id'])) { $customer_feedback_id=$this->params->query['customer_feedback_id'];  }
if(!empty($customerFeedbacks)) { foreach($customerFeedbacks as $key=>$values){
if($key==$customer_feedback_id){$select="selected='selected'";} else { $select=''; }
echo '<option value="'.$key.'" '.$select.'>'.$values.'</option>';
}
}
?>
</select></div>
<div class="small_slect"><input type="submit" name="confirm" value="search" class="searchbtn btn btn-warning"/> </div> <div class="small_slect"><input type="button" name="reset" value="reset" class="btn btn-info" onclick="window.location.href='<?=SITE_PATH?>moreCustomerFeeds/'"/></div>
</div>
</form>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="left_resale table-responsive">
<table class="table table-hover table-condensed" id="resultTable">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('project'); ?></th>
<th><?php echo $this->Paginator->sort('location'); ?></th>
<th><?php echo $this->Paginator->sort('broker Names'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($moreCustomerFeeds as $moreCustomerFeed): ?>
<tr>
<td><?php echo h($moreCustomerFeed['MoreCustomerFeed']['id']); ?>&nbsp;</td>
<td><?php echo h($moreCustomerFeed['MoreCustomerFeed']['project']); ?>&nbsp;</td>
<td><?php echo h($moreCustomerFeed['MoreCustomerFeed']['location']); ?>&nbsp;</td>
<td>
<?php echo h($moreCustomerFeed['CustomerFeedback']['name']); ?>
</td>
<td class="actions">
<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="more btn btn-success" data-id="<?=$moreCustomerFeed['MoreCustomerFeed']['id']?>">More</a>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $moreCustomerFeed['MoreCustomerFeed']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $moreCustomerFeed['MoreCustomerFeed']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $moreCustomerFeed['MoreCustomerFeed']['id'])); ?>
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
</div>
</div></div>



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

<?php /*?></div>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<ul>
<li><?php echo $this->Html->link(__('New More Customer Feed'), array('action' => 'add')); ?></li>
<li><?php echo $this->Html->link(__('List Broker Feeds'), array('controller' => 'broker_feeds', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New Broker Feed'), array('controller' => 'broker_feeds', 'action' => 'add')); ?> </li>
</ul>
</div><?php */?>
<script type="text/javascript">
$(".more").click(function(){
$('#resultTable tr').removeClass("done");
$(this).parent().parent().addClass("done");
var dataid=$(this).attr('data-id');
$('.right_resale').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>moreCustomerFeeds/view/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});

</script>
