<div class="menus form">
<?php echo $this->Form->create('Menu'); ?>
	<fieldset>
		<legend><?php echo __('Admin Assign Menu'); ?></legend>
	<div class="float_none"><table>
		<tr><td><label for="UserUsername">Menus</label></td></tr>
 <? if(!empty($menuheaders)){ foreach($menuheaders as $key=>$header) { $menu=$this->requestAction(array('controller'=>'users','action'=>'menusonheader',$header['headers']['controller']));?>
        <tr style="height:25px">
        <td width="20%" class="dvtCellLabel"  colspan="4"><input type="checkbox"   id="UserMenuheader" name="data[User][menuheader][]" value="<?=$header['headers']['menuheader_id'].":".$header['headers']['controller']?>"><?=ucwords($header['headers']['controller'])?> : <? if(!empty($menu)){ foreach($menu as $key2=>$menus) {?><span><input type="checkbox"   id="UserMenu" name="data[User][menu][]" value="<?=$header['headers']['controller'].":".$menus['menus']['action']?>"><?=$menus['menus']['action']?></span><? } }?><span><input type="checkbox"  value="<?=$header['headers']['controller'].":view"?>" name="data[User][menu][]" id="UserMenu">View</span> <span><input type="checkbox"  value="<?=$header['headers']['controller'].":add"?>" name="data[User][menu][]" id="UserMenu">Add</span> <span><input type="checkbox"  value="<?=$header['headers']['controller'].":edit"?>" name="data[User][menu][]" id="UserMenu">Edit</span> <span><input type="checkbox"  value="<?=$header['headers']['controller'].":delete"?>" name="data[User][menu][]" id="UserMenu">Delete</span></td>
        </tr><? } }?>
              </table></div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Menuheaders'), array('controller' => 'menuheaders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menuheader'), array('controller' => 'menuheaders', 'action' => 'add')); ?> </li>
	</ul>
</div>
