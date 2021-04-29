<div class="subscribes index">
<h2><?php echo __('For Email Subscription'); ?></h2>
<div class="table-responsive">
<table class="table table-hover table-condensed">
<tr><td colspan="9"><select name="status" id="statusValue">
<option value="Not verified" <? if(isset($this->request->params['pass'][0]) and $this->request->params['pass'][0]==="Not verified") { ?> selected="selected"<? } ?>>Not verified</option>
<option value="Verified" <? if(isset($this->request->params['pass'][0]) and $this->request->params['pass'][0]==="Verified") { ?> selected="selected"<? } ?>>Verified</option>
</select> <input type="button"  class="small_button resetall" name="reset" value="reset" onClick="location.href='<?=SITE_PATH?>subscribes/index/'"></td></tr>
<tr>
<th><input type="checkbox" name="lead_check_all" class="leadcheckall">&nbsp;<?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('website'); ?></th>
<th><?php echo $this->Paginator->sort('email'); ?></th>
<th><?php echo $this->Paginator->sort('status'); ?></th>
<th><?php echo $this->Paginator->sort('mail_sent'); ?></th>
<th><?php echo $this->Paginator->sort('mail_counter'); ?></th>
<th><?php echo $this->Paginator->sort('created'); ?></th>
<th><?php echo $this->Paginator->sort('mail_sent_on'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($subscribes as $subscribe): ?>
<tr <? if ($subscribe['Subscribe']['status'] == 'Verified') { ?> class="done" <? } ?>>
<td><input type="checkbox" name="lead_check[]" value="<?=$subscribe['Subscribe']['id']?>" class="leadcheck">&nbsp;<?php echo h($subscribe['Subscribe']['id']); ?>&nbsp;</td>
<td><?php echo h($subscribe['Subscribe']['website']); ?>&nbsp;</td>
<td><?php echo h($subscribe['Subscribe']['email']); ?>&nbsp;</td>
<td><?php echo h($subscribe['Subscribe']['status']); ?>&nbsp;</td>
<td><?php echo h($subscribe['Subscribe']['mail_sent']); ?>&nbsp;</td>
<td><?php echo h($subscribe['Subscribe']['mail_counter']); ?>&nbsp;</td>
<td><?php echo h($subscribe['Subscribe']['created']); ?>&nbsp;</td>
<td><?php echo h($subscribe['Subscribe']['mail_sent_on']); ?>&nbsp;</td>
<td class="actions">
<? if ($subscribe['Subscribe']['status'] == 'Not verified') { ?> <?php echo $this->Form->postLink(__('send subscription'), array('action' => 'view', $subscribe['Subscribe']['id']),array('class' => 'btn btn-warning'), null, __('Are you sure to send newsletter')); ?><? } ?>
</td>
</tr>
<?php endforeach; ?>

<tr  id="mark_data" style="display:none">
<td  colspan="8"><div class="submit"><input type="button" class="markdate" value="send subscription"></div></td>
</tr>
</table>
</div>
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
<div class="actions">
</div>
<script>
$(document).ready(function(){
$("#search_builder").change(function(){
var c=$(this).val();
$('#search_project').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#search_project").html(result);}});

});
});

$(function(){
$(".leadcheckall").click(function() { 
if($('.leadcheckall').is(':checked')){
$("#mark_data").removeAttr( "style" );	
$(".leadcheck").each(function (key , value) { 
$(this).prop("checked", true);
});		
}
else {      $("#mark_data").attr( "style","display:none" );
$(".leadcheck").each(function () {
$(this).prop("checked", false);
});
}
});


$(".leadcheck").change(function() {
if($('[name="lead_check[]"]:checked').length!=0){
$("#mark_data").removeAttr( "style" );
}
else{
$("#mark_data").attr( "style","display:none" );
}
});

$(".markdate").click(function() {
var ides =[];
var values="{" ;	
var i=0; 
$(".leadcheck").each(function (key , value) { 

if(this.checked)
{ 
ides.push($(this).val());

if(i==0) {

values+=$(this).val();
}
else
{  
values+=","+$(this).val();
}
i++   }

;});
values +="}";
if(ides.length!=0){ 
var conf=confirm("Are you sure to send newsletter");
if(conf) {
$(".subscribes").html("<img src='<?=SITE_PATH?>images/ajax-loader.gif'><p>Sending mail please wait......</p>");
$.ajax({url: "<?=SITE_PATH?>subscribes/sendSubscription?params="+values, success: function(result){location.reload();
}});
}

}
});


});

$(document).ready(function(){
$(".leadcheck").each(function (key , value) { 
if(this.checked)
{
$("#mark_data").removeAttr( "style" );
}
});
});


$(document).ready(function(){
$("#statusValue").change(function(){ 
var c=$(this).val();
window.location.href="<?=SITE_PATH?>subscribes/index/"+escape(c);
});
});		
</script>
