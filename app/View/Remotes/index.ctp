<?php /*?><div class="remotes index"><?php */?>
<h2><?php echo __('Remote Server Data'); ?></h2>
<div class="table-responsive">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>remotes/">
<div class="remote_srch">
<div class="col-sm-4"><input type="text" name="search_key" placeholder="By website name,project name, client name, phone,email" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>" class="form-control"/></div>
<div class="col-sm-2"><input type="submit" name="confirm" class="btn btn-block" value="search" class="searchbtn" data-id='1'/></div>
</div>
</form>
<form action="<?=SITE_PATH?>remotes/multidelete/" method="post" accept-charset="utf-8">
<table class="table table-hover table-condensed" id="myTable">
<tr><td colspan='11' align='left'><input type="submit" class="btn btn-danger" name="submit" value="Delete" onclick="if(confirm('Are you sure you want to delete')){ return true;}else{return false;}"> <input type="button" class="btn btn-info" name="reset" value="reset" onclick="window.location.href='<?=SITE_PATH?>remotes/'"><? if(CakeSession::read('User.type')==='admin'){?> <input type="button" class="btn btn-success" value="import" onclick="window.open('<?=SITE_PATH?>remotes/import_remote/')"><? }?></td></tr>
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('website'); ?></th>
<th><?php echo $this->Paginator->sort('project'); ?></th>
<th><?php echo $this->Paginator->sort('client'); ?></th>
<th><?php echo $this->Paginator->sort('phone'); ?></th>
<th><?php echo $this->Paginator->sort('email'); ?></th>
<th><?php echo $this->Paginator->sort('country'); ?></th>
<th><?php echo $this->Paginator->sort('posted_on'); ?></th>
<th><?php echo $this->Paginator->sort('message'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
 <? if(!(CakeSession::read('User.id')==='140')){?>
<th class="actions"><?php echo __('Status'); ?></th>
<? } ?>
</tr>
<?php foreach ($remotes as $remote): ?>
<tr <? if(date("Y-m-d")==date("Y-m-d",strtotime($remote['Remote']['posted_on']))) { ?>class='done'<? } else { ?>class='close' <? } ?>>
<td><?php echo h($remote['Remote']['id']); ?>&nbsp;<input type="checkbox" name="multi_delete[]" value="<?=$remote['Remote']['id']?>" class="kselItems"></td>
<td><?php echo h($remote['Remote']['website']); ?>&nbsp;</td>
<td title="<?php echo h($remote['Remote']['project_name']); ?>"><?php echo h(substr($remote['Remote']['project_name'],0,55)); ?>.&nbsp;</td>
<td><?php echo h($remote['Remote']['client']); ?>&nbsp;</td>
<td><?php echo h($remote['Remote']['phone']); ?>&nbsp;</td>
<td><?php echo h($remote['Remote']['email']); ?>&nbsp;</td>
<td><?php echo h($remote['Remote']['country']); ?>&nbsp;</td>
<td><?php echo h(date("Y M d H:i:s",strtotime($remote['Remote']['posted_on']))); ?>&nbsp;</td>
<td title="<?php echo h($remote['Remote']['message']); ?>"><?php echo h(substr($remote['Remote']['message'],0,30)); ?>..&nbsp;</td>

<td class="actions"><?php if($remote['Remote']['enquiry_id']==0) {echo $this->Html->link(__('Move'), array('action' => 'edit', $remote['Remote']['id']),array('class' => 'btn btn-success'));} else {echo '<a href="#" class="btn btn-dafault disabled">Moved</a>';} ?></td>
 <? if(!(CakeSession::read('User.id')==='140')){?>
<td class="actions"><?php if($remote['Remote']['enquiry_id']==0) {echo '<a href="#" class="btn btn-dafault disabled">Show</a>';} else { ?><a href="javascript:void(0)" onclick="window.open('<?=SITE_PATH."enquiries/show/".$remote['Remote']['phone']?>','abhay','scrollbars=1,width=1400,height=750,left=100,top=50')" class="btn btn-success" >Show</a> <? } ?></td>
<? } ?>
</tr>
<?php endforeach; ?>
<tr><td colspan='11' align='left'><input type="submit" name="submit" class="btn btn-danger" value="Delete" onclick="if(confirm('Are you sure you want to delete')){ return true;}else{return false;}"></td></tr>
</table>
</div>
</form>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>	</p>
<div class="paging">
<?php
echo $this->Paginator->first('< ' . __('First'), array(), null, array('class' => 'first disabled'));
echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
echo $this->Paginator->last(__('Last') . ' >', array(), null, array('class' => 'last disabled'));
?>
</div>
<?php /*?></div>
<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<ul>
<li><?php echo $this->Html->link(__('New Remote'), array('action' => 'add')); ?></li>
</ul>
</div><?php */?>
<script>
$("#checkall").click(function() {
if($('#checkall').is(':checked')){
$(".kselItems").attr('checked','checked');}
else{$(".kselItems").removeAttr('checked');}
});
</script>
