<div class="horizon_menu"><ul><li><?php echo $this->Html->link(__('New Enquiry'), array('action' => 'add')); ?></li> <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li> <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li> <li><?php echo $this->Html->link(__('Today Reminders'), array('controller' => 'enquiries', 'action' => 'currentReminders')); ?> </li> <li><?php echo $this->Html->link(__('Meetings'), array('controller' => 'meetings', 'action' => 'index')); ?> </li> </ul></div><h2><?php echo __('Today Reminders'); ?></h2>
    <div class="edit_author">
    <form id="mastersearch" mathod="get" action="<?=SITE_PATH?>enquiries/currentReminders/">
    <div class="search_fltr">
    <div class="small_slect">
    <select name="search_user" id="search_user">
    <option value="">SELECT USER</option>
    <? $select='';$userid='';
    if(isset($this->params->query['search_user'])) { $userid=$this->params->query['search_user']; }
	if(CakeSession::read('User.type')==='regular'){
		if(CakeSession::read('User.id')==$userid) {$select='selected="selected"';}
	echo '<option value="'.CakeSession::read('User.id').'" '.$select.'">---- '.CakeSession::read('User.name').'</option>';
	echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),$userid));
	} else { echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",0,$userid)); } ?>
    </select></div> <div class="search_text"><input type="text" name="from_date" id="from_date" placeholder="DATE" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/></div>
    <div class="small_slect"><input type="submit" name="confirm" value="search" class="searchbtn" data-id='1'/></div><div class="small_slect"><input type="button" name="reset" value="reset" onclick="window.location.href='<?=SITE_PATH?>enquiries/currentReminders/'"/></div><? if(CakeSession::read('User.type')==='admin'){?><div class="small_slect"><input type="button" name="export" value="export" onclick="window.open('<?=SITE_PATH?>enquiries/currentExport/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/></div><? } ?>
    </div>
    </form>
    </div> 
    
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('user_id'); ?></th>
        <th><?php echo $this->Paginator->sort('posted_date'); ?></th>
        <th><?php echo $this->Paginator->sort('name'); ?></th>
        <th><?php echo $this->Paginator->sort('email'); ?></th>
        <th><?php echo $this->Paginator->sort('contact'); ?></th>
        <th><?php echo $this->Paginator->sort('project_id'); ?></th>
        <th><?php echo $this->Paginator->sort('country_id'); ?></th>
        <th><?php echo $this->Paginator->sort('reminder_date'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody id="response">
        <?php if(!empty($enquiries)) { foreach ($enquiries as $enquiry): ?>
        <tr <? if($enquiry['Enquiry']['last_reminder_update_date']!='0000-00-00 00:00:00' && date("y-m-d", strtotime($enquiry['Enquiry']['last_reminder_update_date']))==date("y-m-d")){?> class="done" title="Done" <? } ?>>
        <td><?php echo h($enquiry['Enquiry']['id']); ?>&nbsp;</td>
        <td><?php echo h($enquiry['User']['name'] .' '. $this->requestAction(array("controller"=>"users","action"=>"getParent",$enquiry['User']['parent']))); ?></td>
        <td><?php echo h(date('d M ,Y',strtotime($enquiry['Enquiry']['posted_date']))); ?>&nbsp;</td>
        <td><?php echo h($enquiry['Enquiry']['name']); ?>&nbsp;</td>
        <td><?php echo h(substr($enquiry['Enquiry']['email'],0,25)); ?>&nbsp;</td>
        <td><?php echo h($enquiry['Enquiry']['contact']); ?>&nbsp;</td>
       <td><?php echo $this->Html->link(substr($enquiry['Project']['name'],0,20), array('controller' => 'projects', 'action' => 'view', $enquiry['Project']['id']),array("title"=>$enquiry['Builder']['name']." - ".$enquiry['Project']['name'])); ?></td>
        <td>
        <?php echo $this->Html->link($enquiry['Country']['name'], array('#', $enquiry['Country']['id'])); ?>
        </td>
        <?php /*?><td><?php echo h($enquiry['Enquiry']['is_reminder']); ?>&nbsp;</td><?php */?>
        <td><?php if($enquiry['Enquiry']['reminder_date']!='0000-00-00 00:00:00') { echo h(date('d M ,Y',strtotime($enquiry['Enquiry']['reminder_date'])));} ?>&nbsp;</td>
        <td class="actions">
       <a href="javascript:void(0)"  title="<?php if($enquiry['Enquiry']['reminder_date']!='0000-00-00 00:00:00') { echo h(date('d M ,Y',strtotime($enquiry['Enquiry']['reminder_date'])));} ?>" <? if($enquiry['Enquiry']['is_reminder']=='no'){?>class="reminderno"<? } ?> onclick="window.open('<?=SITE_PATH."enquiries/view/".$enquiry['Enquiry']['id']."/".$enquiry['Enquiry']['user_id']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')" title="Remark">R</a>
       
      <a href="javascript:void(0)" <? if($enquiry['Enquiry']['is_meeting']=='pending'){?>class="pending"<? } ?> onclick="window.open('<?=SITE_PATH."meetings/view/".$enquiry['Enquiry']['id']?>','abhay','scrollbars=1,width=1400,height=750,left=100,top=50')" title="Meeting">M</a>
       
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $enquiry['Enquiry']['id'])); ?> 
        
        <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $enquiry['Enquiry']['id']), array(), __('Are you sure you want to delete # %s?', $enquiry['Enquiry']['id'])); ?>
        </td>
	</tr>
<?php endforeach; ?>

<tr><td colspan="13"><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?> </td></tr>
    
    <tr><td colspan="13">
     <div class="paging">
    <?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?></div>
    </td></tr>
     <? } else { ?>
    <tr><td colspan="13"> DATA NOT FOUND. </td></tr>
    <? } ?>
    <?php /*?><tr><td colspan="13"><?=$this->requestAction(array("controller"=>"enquiries","action"=>"ajaxpaging",1,3));?></td></tr><?php */?>
	</tbody>
	</table>
    
    <table cellpadding="0" cellspacing="0">
	<thead>
    <tr><th colspan="10">Pending Reminders</th></tr>
	<tr>
        <th><?php echo $this->Paginator->sort('id'); ?></th>
        <th><?php echo $this->Paginator->sort('user_id'); ?></th>
        <th><?php echo $this->Paginator->sort('posted_date'); ?></th>
        <th><?php echo $this->Paginator->sort('name'); ?></th>
        <th><?php echo $this->Paginator->sort('email'); ?></th>
        <th><?php echo $this->Paginator->sort('contact'); ?></th>
        <th><?php echo $this->Paginator->sort('project_id'); ?></th>
        <th><?php echo $this->Paginator->sort('country_id'); ?></th>
        <th><?php echo $this->Paginator->sort('reminder_date'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody id="response">
        <?php  if(!empty($pending)) { foreach ($pending as $pend): ?>
        <tr <? if($pend['Enquiry']['last_reminder_update_date']!='0000-00-00 00:00:00' && date("y-m-d", strtotime($pend['Enquiry']['last_reminder_update_date']))==date("y-m-d")){?> class="done" title="Done" <? } ?>>
        <td><?php echo h($pend['Enquiry']['id']); ?>&nbsp;</td>
        <td><?php echo h($pend['User']['name'] .' '. $this->requestAction(array("controller"=>"users","action"=>"getParent",$pend['User']['parent']))); ?></td>
        <td><?php echo h(date('d M ,Y',strtotime($pend['Enquiry']['posted_date']))); ?>&nbsp;</td>
        <td><?php echo h($pend['Enquiry']['name']); ?>&nbsp;</td>
        <td><?php echo h(substr($pend['Enquiry']['email'],0,25)); ?>&nbsp;</td>
        <td><?php echo h($pend['Enquiry']['contact']); ?>&nbsp;</td>
       <td><?php echo $this->Html->link(substr($pend['Project']['name'],0,20), array('controller' => 'projects', 'action' => 'view', $pend['Project']['id']),array("title"=>$pend['Builder']['name']." - ".$pend['Project']['name'])); ?></td>
        <td>
        <?php echo $this->Html->link($pend['Country']['name'], array('#', $pend['Country']['id'])); ?>
        </td>
        <?php /*?><td><?php echo h($pend['Enquiry']['is_reminder']); ?>&nbsp;</td><?php */?>
        <td><?php if($pend['Enquiry']['reminder_date']!='0000-00-00 00:00:00') { echo h(date('d M ,Y',strtotime($pend['Enquiry']['reminder_date'])));} ?>&nbsp;</td>
        <td class="actions">
       <a href="javascript:void(0)"  title="<?php if($pend['Enquiry']['reminder_date']!='0000-00-00 00:00:00') { echo h(date('d M ,Y',strtotime($pend['Enquiry']['reminder_date'])));} ?>" <? if($pend['Enquiry']['is_reminder']=='no'){?>class="reminderno"<? } ?> onclick="window.open('<?=SITE_PATH."enquiries/view/".$pend['Enquiry']['id']."/".$pend['Enquiry']['user_id']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')" title="Remark">R</a>
       
      <a href="javascript:void(0)" <? if($pend['Enquiry']['is_meeting']=='pending'){?>class="pending"<? } ?> onclick="window.open('<?=SITE_PATH."meetings/view/".$pend['Enquiry']['id']?>','abhay','scrollbars=1,width=1400,height=750,left=100,top=50')" title="Meeting">M</a>
       
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $pend['Enquiry']['id'])); ?> 
        
        <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $pend['Enquiry']['id']), array(), __('Are you sure you want to delete # %s?', $pend['Enquiry']['id'])); ?>
        </td>
	</tr>
<?php endforeach; ?>

<tr><td colspan="13"><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?> </td></tr>
    
    <tr><td colspan="13">
     <div class="paging">
    <?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?></div>
    </td></tr>
     <? } else { ?>
    <tr><td colspan="13"> DATA NOT FOUND. </td></tr>
    <? } ?>
    <?php /*?><tr><td colspan="13"><?=$this->requestAction(array("controller"=>"enquiries","action"=>"ajaxpaging",1,3));?></td></tr><?php */?>
	</tbody>
	</table>
	

<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('from_date'));	
</script>

<script type="text/javascript">

<?php /*?>$(".searchbtn").click(function(){
var startpage=$(this).attr('data-id');
var searchval = "?"+$( "form#mastersearch" ).serialize()+"&startpage="+startpage;
$('#response').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"enquiries/getCurrentReminders/"+searchval,dataType:"html",success:function(result){
if(result!=''){$("#response").html(result);} else {$("#response").html("<div class='loading'>data not found</div>");}
}});
});<?php */?>

<?php /*?>$("div.paging span").click(function(){
var c=$(this).attr('p'); 
var searchval = "?"+$( "form#mastersearch" ).serialize()+"&startpage="+c;
$('#response').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>enquiries/getCurrentReminders/"+searchval,dataType:"html",success:function(result){
if(result!=''){$("#response").html(result);} else {$("#response").html("<div class='loading'>data not found</div>");}
}});
});<?php */?>

$(document).ready(function(){
  $("#search_builder").change(function(){
  var c=$(this).val();
  $('#search_project').html("<img src='<?=SITE_PATH?>images/loader.gif'>");
  $.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#search_project").html(result);}});
  
  });
});

</script>
