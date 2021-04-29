
<div class="actions">
<?php /*?><h3><?php echo __('Actions'); ?></h3><?php */?>
<h3><?php echo __('Add Enquiry'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Enquiries'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<?php echo $this->Form->create('Enquiry'); ?>
<div class="panel panel-default">
<?php /*?><fieldset><?php */?>
<?php /*?><legend><?php echo __('Add Enquiry'); ?></legend><?php */?>
<div class="panel-body">
<div class="row">
<?php $datauser='';$chk=''; if(CakeSession::read('User.type')==='regular'){
$datauser='<option value="'.CakeSession::read('User.id').'" '.$chk.' >---- '.CakeSession::read('User.name').'</option>';
$datauser.=$this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),0,@implode('##',$users)));
} else {$datauser= $this->requestAction(array("controller"=>"users","action"=>"test",0)); }

echo "<div class='col-sm-3'><div class='input select required'><label for='EnquiryUserId'>User</label><select name='data[Enquiry][user_id]' id='EnquiryUserId' required='required' class='form-control'><option value=''>Select User</option>".$datauser."</select></div></div>
<div class='col-sm-3'>".$this->Form->input('name',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('email',array('class' => 'form-control'))."</div><div class='col-sm-3'>".$this->Form->input('contact',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('builder_id',array('class' => 'form-control','options'=>array(''=>'Select Builder',$builders)))."</div><div class='col-sm-3'>".$this->Form->input('project_id',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('country_id',array('class' => 'form-control',"options"=>array(''=>"Select Country",$countries)))."</div><div class='col-sm-3'>".$this->Form->input('lead_source_id',array('class' => 'form-control',"options"=>array(''=>"Select Lead Source",$leadSources)))."</div>";
//echo "<tr><td colspan='2'>".$this->Form->input('city_id')."</td></tr>";
echo "<div class='col-sm-12'>".$this->Form->input('query',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-12'><div class='radio'>".$this->Form->input('type',array('type'=>'radio','options'=>array('buyer'=>'Buyer','seller'=>'Seller','owner'=>'Owner','tenant'=>'Tenant'),'value'=>'buyer'))."</div></div>";
echo "<div class='col-sm-12'>".$this->Form->input('posted_date')."</div>";
//echo $this->Form->input('posted_date');

?>
<?php /*?></fieldset><?php */?>
<div class="col-sm-12"><?php echo $this->Form->input('referer',array('type'=>'hidden','value'=>$this->request->referer())); echo $this->Form->end(__('Submit')); ?></div>
</div>
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


</script>
