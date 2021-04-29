<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Contraceptive'), array('action' => 'edit', $contraceptive['Contraceptive']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Contraceptive'), array('action' => 'delete', $contraceptive['Contraceptive']['id']),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $contraceptive['Contraceptive']['id'])); ?>
<?php echo $this->Html->link(__('List Contraceptive'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Contraceptive'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
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
<?php echo h($contraceptive['Contraceptive']['id']); ?>
&nbsp;
</dd>-->
<dt><?php echo __('Name'); ?></dt>
<dd>
<?php echo h(ucfirst($contraceptive['Contraceptive']['name'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Status'); ?></dt>
<dd>
<?php echo h(ucfirst($contraceptive['Contraceptive']['status'])); ?>
&nbsp;
</dd>

</dl>
</div>
</div>
