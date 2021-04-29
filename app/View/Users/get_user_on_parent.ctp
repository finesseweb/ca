       <?php if(!empty($users)) { foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
        <td><?php echo h($this->requestAction(array("controller"=>"users","action"=>"getParent",$user['User']['parent']))); ?>&nbsp;</td>
		<td><?php echo h($user['User']['role']); ?>&nbsp;</td>
        <td><?php echo h($user['User']['status']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td class="actions">
		<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>

<tr><td colspan="13"> <?=$this->requestAction(array("controller"=>"enquiries","action"=>"ajaxpaging",$currentpage,$total));?></td></tr>
     <? } else { ?>
    <tr><td colspan="13">
   DATA NOT FOUND.PLEASE CHANGE YOUR SEARCH CRITERIA.
    </td></tr>
    <? } ?>
	
</div>
<script type="text/javascript">
$("div.paging span").click(function(){
var c=$(this).attr('p'); 
var searchval = "?"+$( "form#mastersearch" ).serialize()+"&startpage="+c;
$('#response').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>users/getUserOnParent/"+searchval,dataType:"html",success:function(result){
if(result!=''){$("#response").html(result);} else {$("#response").html("<div class='loading'>data not found</div>");}
}});
});
</script>