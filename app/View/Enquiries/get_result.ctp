        <?php if(!empty($enquiries)) { foreach ($enquiries as $enquiry): ?>
        <tr class="<?=$enquiry['Enquiry']['status']?>">
        <td><?php echo h($enquiry['Enquiry']['id']); ?>&nbsp;</td>
        <td><?php echo h($enquiry['User']['name'] .' '. $this->requestAction(array("controller"=>"users","action"=>"getParent",$enquiry['User']['parent']))); ?></td>
        <td><?php echo h(date('d M ,Y',strtotime($enquiry['Enquiry']['posted_date']))); ?>&nbsp;</td>
        <td><?php echo h($enquiry['Enquiry']['name']); ?>&nbsp;</td>
        <td><?php echo h(substr($enquiry['Enquiry']['email'],0,25)); ?>&nbsp;</td>
        <td><?php echo h($enquiry['Enquiry']['contact']); ?>&nbsp;</td>
       <td><?php echo $this->Html->link(substr($enquiry['Project']['name'],0,20), array('controller' => 'projects', 'action' => 'view', $enquiry['Project']['id']),array("title"=>$enquiry['Builder']['name']." - ".$enquiry['Project']['name'])); ?></td>
        <td><?php echo $this->Html->link($enquiry['Country']['name'], array('controller' => 'countries', 'action' => 'view', $enquiry['Country']['id'])); ?></td>
        <?php /*?><td><?php echo h($enquiry['Enquiry']['is_reminder']); ?>&nbsp;</td><?php */?>
        <td><?php if($enquiry['Enquiry']['reminder_date']!='0000-00-00 00:00:00') { echo h(date('d M ,Y',strtotime($enquiry['Enquiry']['reminder_date'])));} ?>&nbsp;</td>
        <td class="actions">
       <a href="javascript:void(0)" <? if($enquiry['Enquiry']['is_reminder']=='no'){?>class="reminderno"<? } ?> onclick="window.open('<?=SITE_PATH."enquiries/view/".$enquiry['Enquiry']['id']."/".$enquiry['Enquiry']['user_id']?>','abhay','scrollbars=1,width=1100,height=650,left=100,top=50')" title="Remark">R</a>
       
      <a href="javascript:void(0)" <? if($enquiry['Enquiry']['is_meeting']=='pending'){?>class="pending"<? } ?> onclick="window.open('<?=SITE_PATH."meetings/view/".$enquiry['Enquiry']['id']?>','abhay','scrollbars=1,width=1400,height=750,left=100,top=50')" title="Meeting">M</a>
       
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $enquiry['Enquiry']['id'])); ?> 
        
        <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $enquiry['Enquiry']['id']), array(), __('Are you sure you want to delete # %s?', $enquiry['Enquiry']['id'])); ?>
        </td>
	</tr>
<?php endforeach; ?>

<?php /*?><tr><td colspan="13"><?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?></td></tr><?php */?>
    <tr><td colspan="13">
    <?=$this->requestAction(array("controller"=>"enquiries","action"=>"ajaxpaging",$currentpage,$total));?>
    </td></tr>
    <? } else { ?>
    <tr><td colspan="13">
   DATA NOT FOUND.PLEASE CHANGE YOUR SEARCH CRITERIA.
    </td></tr>
    <? } ?>

<script type="text/javascript">
$("div.paging span").click(function(){
var c=$(this).attr('p'); 
var searchval = "?"+$( "form#mastersearch" ).serialize()+"&startpage="+c;
$('#response').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>enquiries/getResult/"+searchval,dataType:"html",success:function(result){
if(result!=''){$("#response").html(result);} else {$("#response").html("<div class='loading'>Data not found</div>");}
}});
});
</script>