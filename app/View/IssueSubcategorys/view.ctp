<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Level of Issue'), array('action' => 'edit', $subcategory['IssueSubcategory']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Subcategory'), array('action' => 'delete', $subcategory['IssueSubcategory']['id']),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $subcategory['IssueSubcategory']['id'])); ?>
<?php echo $this->Html->link(__('List Level of Issues'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Level of Issue'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Cateory'), array('controller' => 'financials', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New  Cateory'), array('controller' => 'financials', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Level of Issue'); ?></h2>
<dl>
<!--<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($subcategory['IssueSubcategory']['id']); ?>
&nbsp;
</dd>-->
<dt><?php echo __('Level of Issue'); ?></dt>
<dd>
<?php echo h(ucfirst($subcategory['IssueSubcategory']['name'])); ?>
&nbsp;
</dd>
<!--<dt><?php //echo __('Issue Category Name'); ?></dt>
<dd>
<?php //echo h(ucfirst($subcategory['IssueSubcategory']['name'])); ?>
&nbsp;
</dd>-->
<dt><?php echo __('Status'); ?></dt>
<dd>
<?php echo h(ucfirst($subcategory['IssueSubcategory']['status'])); ?>
&nbsp;
</dd>

</dl>
</div>
</div>
