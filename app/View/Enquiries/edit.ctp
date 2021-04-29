<div class="actions">
<h3><?php echo __('Actions');  ?></h3>
<div class="btn-group">
<?php /*?><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Enquiry.id')),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Enquiry.id'))); ?><?php */?>
<?php echo $this->Html->link(__('List Enquiries'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'),array('class' => 'btn btn-primary')); ?> 
<?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'),array('class' => 'btn btn-primary')); ?> 
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Enquiry'); ?>
<fieldset>
<legend><?php echo __('Edit Enquiry'); ?></legend>
<div class="row">
<?php 
$lastRemarks=$this->requestAction(array('controller'=>'remarks','action'=>'lastRemarks',$this->data['Enquiry']['id']));
$style='display:block'; $datauser='';$chk=''; if($this->data['Enquiry']['status']=='open') {$style='display:none'; } 
if(CakeSession::read('User.type')==='regular'){
if($this->data['Enquiry']['user_id']==CakeSession::read('User.id')){ $chk='selected="selected"'; }
$datauser='<option value="'.CakeSession::read('User.id').'" '.$chk.' >---- '.CakeSession::read('User.name').'</option>';
$datauser.=$this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),$this->data['Enquiry']['user_id'],@implode('##',$users)));
}   else {$datauser= $this->requestAction(array("controller"=>"users","action"=>"test",$this->request->data['Enquiry']['user_id'])); }
echo "<div class='col-sm-3'><div class='input select required'><label for='EnquiryUserId'>Select User</label><select name='data[Enquiry][user_id]' id='EnquiryUserId' required='required' class='form-control'><option value=''>Select User</option>".$datauser."</select></div></div><div class='col-sm-3'>".$this->Form->input('name',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('email',array('class' => 'form-control'),array('type'=>'text'))."</div><div class='col-sm-3'>".$this->Form->input('contact',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('builder_id',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('project_id',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('country_id',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('lead_source_id',array('class' => 'form-control'))."</div>";
//echo "<div class='col-sm-3' colspan='2'>".$this->Form->input('city_id')."</div>";
echo "<div class='col-sm-12'>".$this->Form->input('query',array('class' => 'form-control'))."</div>"; 

echo "<div class='col-sm-6'><b>Last Remark </b>: ".$lastRemarks."</div>";


if(CakeSession::read('User.type')!='regular'){
echo "<div class='col-sm-6' >".$this->Form->input('posted_date')."</div>";
}


echo "<div class='col-sm-12'>".$this->Form->input('is_reminder',array('type'=>'checkbox','value'=>'yes','hiddenField'=>'no'))."</div>";

echo "<div class='col-sm-12'>".$this->Form->input('type',array('type'=>'radio','options'=>array('buyer'=>'Buyer','seller'=>'Seller','owner'=>'Owner','tenant'=>'Tenant')))."</div>";


if(CakeSession::read('User.type')==='admin') {

$statusoptions=array('open'=>'Open','close'=>'Close','done'=>'Done','trash'=>'Trash','sold out'=>'Sold out','waiting'=>'Waiting');
}
else
{
$statusoptions=array('open'=>'Open','close'=>'Close','done'=>'Done','sold out'=>'Sold out','waiting'=>'Waiting');

}

echo "<tr id='clsid'><div class='col-sm-3'>".$this->Form->input('status',array('class' => 'form-control','type'=>'select','options' =>$statusoptions))."</div>";





echo "<tr id='clsresid' style='$style'><div class='col-sm-3' colspan='2'>".$this->Form->input('close_reason_id',array('class' => 'form-control')).$this->Form->input('referer',array('type'=>'hidden','value'=>$this->request->referer())).$this->Form->input('leadof',array('type'=>'hidden','value'=>$this->data['Enquiry']['user_id'])).$this->Form->input('history_of_lead',array('type'=>'hidden','value'=>$this->data['Enquiry']['history_of_lead']))."</div>";

echo "<div class='col-sm-6'>".$this->Form->input('hot_lead',array('label'=>'Marked Hot','type'=>'checkbox','value'=>'Y','hiddenField'=>'N'))."</div>";

echo "<div class='col-sm-3'>".$this->Form->input('send_sms',array('type'=>'checkbox','value'=>'yes','hiddenField'=>'no'))."</div><div class='col-sm-3'>".$this->Form->input('send_mail',array('type'=>'checkbox','value'=>'yes','hiddenField'=>'no'))."</div>";

echo "<div class='col-sm-6'>".$this->Form->input('Type Of Lead',array('name'=>'type_of_lead','type'=>'radio','options'=>array('Fresh Lead'=>'Fresh Lead','Recycle Lead'=>'Recycle Lead'),'value' => 'Fresh Lead'))."</div>";
?>
</div>
</fieldset>
<?php echo $this->Form->input('id'); echo $this->Form->end(__('Submit')); ?>

</div>
</div>
<script type="text/javascript">

$(document).ready(function(){
$("#EnquiryCountryId").change(function(){
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>projects/getstate/"+c,success:function(result){$("#EnquiryStateId").html(result);}});

});
});

$(document).ready(function(){
$("#EnquiryStateId").change(function(){
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>projects/getcity/"+c,success:function(result){$("#EnquiryCityId").html(result);}});

});
});

$(document).ready(function(){
$("#EnquiryBuilderId").change(function(){
var c=$(this).val();
$.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#EnquiryProjectId").html(result);}});

});
});

$(document).ready(function(){
$("#EnquiryStatus").change(function(){ if($(this).val()=='open' || $(this).val()=='done') {$("#clsresid").css('display','none');} else { $("#clsresid").css('display','block');}});

});

</script>
