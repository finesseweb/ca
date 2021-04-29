<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Cateory'), array('action' => 'edit', $financial['Overhead']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Cateory'), array('action' => 'delete', $financial['Overhead']['id']),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $financial['Overhead']['id'])); ?>
<?php echo $this->Html->link(__('List Cateory'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Cateory'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
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
<h2><?php echo __('Category'); ?></h2>
<!--<dl>
<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($financial['Financial']['id']); ?>
&nbsp;
</dd>-->
<dt><?php echo __('Organization'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Ngo']['name_of_ngo'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Category'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Financial']['name'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Period'); ?></dt>
<dd>
<?php echo h(date('d-m-Y',strtotime($financial['Period']['from_date'])).' To '.date('d-m-Y',strtotime($financial['Period']['to_date']))); ?>

&nbsp;
</dd>
<dt><?php echo __('Status'); ?></dt>
<dd>
<?php echo h(ucfirst($financial['Financial']['status'])); ?>
&nbsp;
</dd>

</dl>
</div>
</div>
