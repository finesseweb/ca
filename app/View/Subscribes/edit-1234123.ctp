<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Remote.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Remote.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Remotes'), array('action' => 'index')); ?></li>
	</ul>
</div><div class="remotes form">
<?php echo $this->Form->create('Remote'); ?>
	<fieldset>
		<legend><?php echo __('Edit Data'); ?></legend>
        <div class="edit_author">
     <table>
	<?php //print_r($countries); exit;
	echo "<tr><td width='50%'>".$this->Form->input('website')."</td><td width='50%'>".$this->Form->input('project_name')."</td></tr>";
	echo "<tr><td>".$this->Form->input('client')."</td><td>".$this->Form->input('phone')."</td></tr>";
	echo "<tr><td>".$this->Form->input('email')."</td><td><div class='input select'><label for='RemoteCountry'>Country</label><select name='data[Remote][country]' id='RemoteCountry' required> <option value=''>Select Country</option>"; 
if(!empty($countries)) { foreach($countries as $key1=>$val1) { if($key1."##".$val1===$selectedcon) {?>
<option value='<? echo $key1?>##<? echo $val1; ?>' selected="selected"><? echo $val1?></option>
<? } else {?>
<option value='<? echo $key1?>##<? echo $val1; ?>'><? echo $val1?></option>
<? } ?>
<? }  }?>
<? echo "</select></div></td></tr>";
	echo "<tr><td colspan='2'>".$this->Form->input('message')."</td></tr>";
	echo "<tr><td colspan='2'></td></tr>";
	echo "<td><div class='input select required'><label for='RemoteUserId'>User</label>
	<select name='data[Remote][user_id]' id='RemoteUserId' required='required'>
<option value=''>SELECT USER</option>";
if(!empty($users)) { foreach($users as $key=>$val) {?>
<option value='<? echo $val['User']['id']?>##<? echo $val['User']['name']." ".$val['User']['last_name']?>'><? echo $val['User']['name']." ".$val['User']['last_name']?></option>
<? }  }?>
</select>
	<? 
	echo "</div></td><td>".$this->Form->input('lead_source_id',array("options"=>array(''=>"SELECT LEAD SOURCE",$leadSources),"selected"=>$leadsourceval))."</td></tr>";
	echo "<tr><td>".$this->Form->input('builder_id',array("options"=>array(''=>"SELECT BUILDER",$builders)))."</td><td>".$this->Form->input('project_id')."</td></tr>";
	
	echo "<tr><td colspan='2' >".$this->Form->input('posted_date',array('type'=>'datetime'))."</td></tr>";
	?>
    </table></div>
	</fieldset>
<?php  echo $this->Form->input('id'); echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript">

$(document).ready(function(){
  $("#RemoteBuilderId").change(function(){
  var c=$(this).val();
  $.ajax({url:"<?=SITE_PATH?>projects/getprojectajax/"+c,success:function(result){$("#RemoteProjectId").html(result);}});
  
  });
});


</script>