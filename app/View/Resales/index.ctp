<? $allparentids=@implode('##',$users);?>
<div class="horizon_menu"><ul><li><?php echo $this->Html->link(__('Add New'), array('action' => 'add')); ?></li></ul></div>

	<h2><?php echo __('Resale'); ?></h2>
    <div class="edit_author">

    <form id="mastersearch" mathod="get" action="<?=SITE_PATH?>resales/">
    <div class="search_fltr"><div class="search_text"><input type="text" name="search_key" placeholder="BY NAME,EMAIL,LEAD,CONTACT" value="<? if(isset($this->params->query['search_key'])){ echo $this->params->query['search_key']; }?>" /></div>
    <div class="small_slect">
    <select name="user_id" id="search_user">
    <option value="">SELECT USER</option>
    <? $select=0;$userid=0;
	if(isset($this->params->query['user_id'])) { $userid=$this->params->query['user_id']; }
	echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",0,$userid,$allparentids));  ?>
    </select></div>
    <div class="small_slect">
    <select name="country_id" id="search_country">
    <option value="">SELECT COUNTRY</option>
    <? foreach ($countries as $key=>$country){?>
    <option value="<? echo $key; ?>" <? if(isset($this->params->query['country_id']) && $this->params->query['country_id']==$key) { ?> selected="selected"<? } ?>><? echo $country; ?></option>
    <? } ?>
    </select></div>
    <div class="small_slect">
    <select name="builder_id" id="ResaleBuilderId">
    <option value="">SELECT BUILDER</option>
    <? foreach ($builders as $key=>$builders){?>
    <option value="<? echo $key; ?>" <? if(isset($this->params->query['builder_id']) && $this->params->query['builder_id']==$key) { ?> selected="selected"<? } ?>><? echo $builders; ?></option>
    <? } ?>
    </select></div>
    <div class="small_slect"><select name="project_id" id="ResaleProjectId">
    <option value="">SELECT PROJECT</option>
    <? foreach ($projects as $key=>$project){?>
    <option value="<? echo $key; ?>" <? if(isset($this->params->query['project_id']) && $this->params->query['project_id']==$key) { ?> selected="selected"<? } ?>><? echo $project; ?></option>
    <? } ?>
    
    </select></div>
    
    <div class="small_slect">
    <select name="close_reason_id" id="close_reasons">
    <option value="">SELECT REASONS</option>
    <? foreach ($closeReasons as $key=>$closeReasons){?>
    <option value="<? echo $key; ?>" <? if(isset($this->params->query['close_reason_id']) && $this->params->query['close_reason_id']==$key) { ?> selected="selected"<? } ?>><? echo $closeReasons; ?></option>
    <? } ?>
    </select></div>
    
    <div class="small_slect">
    <select name="status" id="search_status">
    <option value="">SELECT STATUS</option>
    <option value="open" <? if(isset($this->params->query['status']) && $this->params->query['status']=='open') { ?> selected="selected"<? } ?>>Open</option>
    <option value="close" <? if(isset($this->params->query['status']) && $this->params->query['status']=='close') { ?> selected="selected"<? } ?>>Close</option>
    <option value="done" <? if(isset($this->params->query['status']) && $this->params->query['status']=='done') { ?> selected="selected"<? } ?>>Done</option>
    </select></div>
    
    <div class="small_slect">
    <select name="client_type" id="client_type">
    <option value="">CLIENT TYPE</option>
    <option value="buyer" <? if(isset($this->params->query['client_type']) && $this->params->query['client_type']=='buyer') { ?> selected="selected"<? } ?>>Buyer</option>
    
    <option value="seller" <? if(isset($this->params->query['client_type']) && $this->params->query['client_type']=='seller') { ?> selected="selected"<? } ?>>Seller</option>
    
    <option value="dealer" <? if(isset($this->params->query['client_type']) && $this->params->query['client_type']=='dealer') { ?> selected="selected"<? } ?>>Dealer</option>
    <option value="landlord" <? if(isset($this->params->query['client_type']) && $this->params->query['client_type']=='landlord') { ?> selected="selected"<? } ?>>landlord</option>
    <option value="tenant" <? if(isset($this->params->query['client_type']) && $this->params->query['client_type']=='tenant') { ?> selected="selected"<? } ?>>Tenant</option>
    
    </select></div>
    
     <div class="search_text"><input type="text" name="posted_date" id="posted_date" placeholder="DATE FROM" value="<? if(isset($this->params->query['posted_date'])){ echo trim($this->params->query['posted_date']); }?>"/></div>

     
    <div class="small_slect"><input type="submit" name="confirm" value="search" class="searchbtn"/> </div> <div class="small_slect"><input type="button" name="reset" value="reset" onclick="window.location.href='<?=SITE_PATH?>resales/'"/></div>
    
    <? if(CakeSession::read('User.type')==='admin'){?><div class="small_slect"><input type="button" name="reset" value="export" onclick="window.open('<?=SITE_PATH?>resales/export/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/></div><? } ?>
    </div>
    </form>
    </div>
    <div class="clearfix"></div>
	<div class="left_resale"><table cellpadding="0" cellspacing="0" id="resultTable">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<?php /*?><th><?php echo $this->Paginator->sort('email'); ?></th><?php */?>
			<th><?php echo $this->Paginator->sort('contact'); ?></th>
			<th><?php echo $this->Paginator->sort('client_type'); ?></th>
			<th><?php echo $this->Paginator->sort('resale_type'); ?></th>
			<th><?php echo $this->Paginator->sort('project_id'); ?></th>
			<th><?php echo $this->Paginator->sort('Executive'); ?></th>
			<th><?php echo $this->Paginator->sort('country_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('lead_source_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($resales as $resale): ?>
	<tr>
		<td><?php echo h($resale['Resale']['id']); ?>&nbsp;</td>
		<td> <?php if($resale['Resale']['user_id']==CakeSession::read('User.id') && CakeSession::read('User.type')==='regular'){?><?php echo h($resale['Resale']['name']); ?> <? } elseif(CakeSession::read('User.type')==='admin') { ?><?php echo h($resale['Resale']['name']); ?><?php } else { echo 'xxxxx' ; }?>&nbsp;</td>
		<?php /*?><td><?php echo h($resale['Resale']['email']); ?>&nbsp;</td><?php */?>
		<td><?php if($resale['Resale']['user_id']==CakeSession::read('User.id') && CakeSession::read('User.type')==='regular'){?><?php echo h($resale['Resale']['contact']); ?><? } elseif(CakeSession::read('User.type')==='admin') { ?><?php echo h($resale['Resale']['contact']); ?><?php } else { echo 'xxxxxxxxxx' ; }?>&nbsp;</td>
		<td><?php echo h(ucfirst($resale['Resale']['client_type'])); ?>&nbsp;</td>
		<td><?php echo h(ucfirst($resale['Resale']['resale_type'])); ?>&nbsp;</td>
        <td><?php echo $this->Html->link($resale['Project']['name'], array('controller' => 'projects', 'action' => 'view', $resale['Project']['id'])); ?></td>
        <td> <?php echo $this->Html->link($resale['User']['name'], array('controller' => 'users', 'action' => 'view', $resale['User']['id'])); ?></td>
        <td> <?php echo $this->Html->link($resale['Country']['name'], array('controller' => 'countries', 'action' => 'view', $resale['Country']['id'])); ?></td>
        <td><?php echo h($resale['Resale']['status']); ?>&nbsp;</td>
        <td> <?php echo $this->Html->link($resale['LeadSource']['name'], array('controller' => 'lead_sources', 'action' => 'view', $resale['LeadSource']['id'])); ?></td>
		<td class="actions">
		<a href="javascript:void(0)" class="resalemore" data-id="<?=$resale['Resale']['id']?>">More</a>
        <?php if((CakeSession::read('User.type')==='user') || (CakeSession::read('User.type')==='regular' and CakeSession::read('User.id')===$resale['Resale']['user_id'])) {  echo $this->Html->link(__('Edit'), array('action' => 'edit', $resale['Resale']['id'])); } ?>
        <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $resale['Resale']['id']), null, __('Are you sure you want to delete # %s?', $resale['Resale']['id'])); ?>
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
    
    <div class="right_resale" id="resalemore"><table cellpadding="0" cellspacing="0">
	<tr><td>!! MORE DATA SHOULD BE DISPLAY HERE !!</td></tr>
    </table></div>

<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('posted_date'));	
</script>

<script type="text/javascript">
$(".resalemore").click(function(){
$('#resultTable tr').removeClass("done");
$(this).parent().parent().addClass("done");
var resaleid=$(this).attr('data-id');
$('.right_resale').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>resales/view/"+resaleid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});

$(document).ready(function(){
  $("#ResaleBuilderId").change(function(){
  var c=$(this).val();
  $('#ResaleProjectId').html("<option value=''>loading......</option>"); 
  $.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#ResaleProjectId").html(result);}});
  
  });
});

</script>
