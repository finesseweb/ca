<div class="actions">
<h3><?php echo __('Edit Data'); ?></h3>
<div class="btn-group">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Remote.id')),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $this->Form->value('Remote.id'))); ?>
<?php echo $this->Html->link(__('List Remotes'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div><div class="remotes form">
<?php echo $this->Form->create('Remote'); ?>
<fieldset>
<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<?php //print_r($countries); exit;
echo "<div class='col-sm-4'>".$this->Form->input('website',array('class' => 'form-control'))."</div><div class='col-sm-4'>".$this->Form->input('project_name',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('client',array('class' => 'form-control'))."</div><div class='col-sm-4'>".$this->Form->input('phone',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('email',array('class' => 'form-control'))."</div><div class='col-sm-4'><div class='input select'><label for='RemoteCountry'>Country</label><select name='data[Remote][country]' id='RemoteCountry' class='form-control' required> <option value=''>Select Country</option>"; 
if(!empty($countries)) { foreach($countries as $key1=>$val1) { if($key1."##".$val1===$selectedcon) {?>
<option value='<? echo $key1?>##<? echo $val1; ?>' selected="selected"><? echo $val1?></option>
<? } else {?>
<option value='<? echo $key1?>##<? echo $val1; ?>'><? echo $val1?></option>
<? } ?>
<? }  }?>
<? echo "</select></div></div>";
echo "<div class='col-sm-12'>".$this->Form->input('message',array('class' => 'form-control'))."</div>";
echo "<div></div>";
echo "<div class='col-sm-3'><div class='input select required'><label for='RemoteUserId'>User</label>
<select name='data[Remote][user_id]' id='RemoteUserId' class='form-control' required='required'>
<option value=''>SELECT USER</option>";
if(!empty($users)) { foreach($users as $key=>$val) {?>
<option value='<? echo $val['User']['id']?>##<? echo $val['User']['name']." ".$val['User']['last_name']?>'><? echo $val['User']['name']." ".$val['User']['last_name']?></option>
<? }  }?>
</select>
<? 
echo "</div></div><div class='col-sm-3'>".$this->Form->input('lead_source_id',array('class' => 'form-control',"options"=>array(''=>"SELECT LEAD SOURCE",$leadSources),"selected"=>$leadsourceval))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('builder_id',array('class' => 'form-control',"options"=>array(''=>"SELECT BUILDER",$builders)))."</div><div class='col-sm-3'>".$this->Form->input('project_id',array('class' => 'form-control'))."</div>";

echo "<div class='col-sm-12'>".$this->Form->input('posted_date',array('type'=>'datetime'))."</div>";
?>
<div class="col-sm-12"><?php  echo $this->Form->input('id'); echo $this->Form->end(__('Submit')); ?></div>
</div>
</div></div>
</fieldset>
</div>
<script type="text/javascript">

$(document).ready(function(){
$("#RemoteBuilderId").change(function(){
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>projects/getprojectajax/"+c,success:function(result){$("#RemoteProjectId").html(result);}});

});
});
</script>