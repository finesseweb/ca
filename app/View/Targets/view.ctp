<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Target'), array('action' => 'edit', $financial['Target']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Target'), array('action' => 'delete', $financial['Target']['id']),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $financial['Target']['id'])); ?>
<?php echo $this->Html->link(__('List Target'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Target'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List SubCateory'), array('controller' => 'subcategorys', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New SubCateory'), array('controller' => 'subcategorys', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Target'); ?></h2>
<dl>

<!--<dt><?php echo __('Name'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['target_for'])); ?>
&nbsp;
</dd>-->
<dt><?php echo __('Organization'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Ngo']['name_of_ngo'])); ?>
&nbsp;
</dd>
<dt><?php echo __('District'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['City']['name'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Block'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Block']['name'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Panchayat'); ?></dt>
<dd>
<?php //echo h(ucfirst($financial['Panchayat']['name'])); ?>
     <?php
$mem = explode(',',$financial['Target']['panchayat']);
//print_r($mem);
foreach($mem as $m) {
  $questionlist=$this->requestAction(array("controller"=>"panchayats","action"=>"gettitle",$m)); 
                 
                  echo ucwords($questionlist['Panchayat']['name'].', ');
}

 ?>
&nbsp;
</dd>

<dt><?php echo __('Grant Period'); ?></dt>
<dd>
<?php echo h(date('d-m-Y',strtotime($financial['Period']['from_date'])).' To '.date('d-m-Y',strtotime($financial['Period']['to_date']))); ?>
&nbsp;
</dd>
<dt><?php echo __('VHSNC Meeting Organised'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['vhsnc_meeting_target'])); ?>
&nbsp;
</dd>

<dt><?php echo __('VHSNC Provided feedback'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['feedback_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Issues identified'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['vhsnc_issue_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Issues resolved'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['vhsnc_issueresolved_target'])); ?>
&nbsp;
</dd><dt><?php echo __('VHSND sites monitored'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['vhsnd_monitor_target'])); ?>
&nbsp;
</dd><dt><?php echo __('VHSNC Member monitored local services'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['vhsnc_monitor_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('M-shakti (IVRS) User Provided Community feedback'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['ivrs_feedback_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Participated in ANM Meeting'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['anm_meeting_target'])); ?>
&nbsp;
</dd><dt><?php echo __('DPMC Meeting Organised'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['dpmc_meeting_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('BPMC Meeting Organised'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['bpmc_meeting_target'])); ?>
&nbsp;
</dd><dt><?php echo __('RKS Meeting Organised'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['rks_meeting_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('VHSNC monitoring quality checklist filled'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['vhsnc_checklist_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('VHSND monitoring quality checklist filled'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['vhsnd_checklist_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Facility Assessement Conducted'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['facility_assessement_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Facilities providing IUCD services on fixed day'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['iucd_services_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Facilities providing Antara services on fixed day'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['antara_services_target'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Status'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Target']['status'])); ?>
&nbsp;
</dd>
</dl>
</div>
</div>
