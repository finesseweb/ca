<? $allparentids=@implode('##',$users);?><div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div><div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php $datauser='';$chk=''; echo "<div class='edit_author'><table>";
	    $this->Form->input('password_enc',array("type"=>"hidden"));
		echo "<tr><td width='50%'>".$this->Form->input('username')."</td><td>". $this->Form->input('password',array("type"=>"password"))."</td></tr>";
		echo "<tr><td>".$this->Form->input('name',array("label"=>"First Name"))."</td><td>".$this->Form->input('middle_name')."</td></tr>";
		echo "<tr><td>".$this->Form->input('last_name')."</td><td><div class='input text '><label for='UserGender'>Gender</label><select name='data[User][gender]'>
              <option value='male'>Male</option>
              <option value='female'>Female</option></select></div></td></tr>";
		echo "<tr><td>".$this->Form->input('phone')."</td><td>".$this->Form->input('email')."</td></tr>";
		if(CakeSession::read('User.type')=='admin' || CakeSession::read('User.type')=='user'){
		echo "<tr><td colspan='2'>".$this->Form->input('role',array('type'=>'radio','options'=>array('admin'=>'Admin','user'=>'User','regular'=>'Regular')))."</td></tr>";
		}
		
		
		if(CakeSession::read('User.type')==='regular'){
		$datauser='<option value="'.CakeSession::read('User.id').'" '.$chk.' >---- '.CakeSession::read('User.name').'</option>';
	    $datauser.=$this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),'0',$allparentids));
	} else {
		$datauser='<option value="0">Select Group</option>';
		$datauser.= $this->requestAction(array("controller"=>"users","action"=>"buildTree",'0','0',$allparentids)); }
		
		
			echo "<tr><td colspan='2'><div class='input text notrequired'><label for='UserParent'>Group</label><select name='data[User][parent]' id='UserParent' required='required'>".$datauser."</select></div></td></tr>";
			
			
		echo "</table></div>";
		
		
	?>
    <div class="float_none"><table style="<? echo $display; ?>">
		<tr><td><label for="UserUsername">Menus</label></td></tr>
        <? if(!empty($menuheaders)){ foreach($menuheaders as $key=>$header) { $menu=$this->requestAction(array('controller'=>'users','action'=>'menusonheader',$header['headers']['controller']));?>
        <tr style="height:25px">
        <td width="20%" class="dvtCellLabel"  colspan="4"><input type="checkbox" <? echo $checkedprop; ?>  id="UserMenuheader" name="data[User][menuheader][]" value="<?=$header['headers']['menuheader_id'].":".$header['headers']['controller']?>"><?=ucwords($header['headers']['controller'])?> : <? if(!empty($menu)){ foreach($menu as $key2=>$menus) {?><span><input type="checkbox" <? echo $checkedprop; ?>  id="UserMenu" name="data[User][menu][]" value="<?=$header['headers']['controller'].":".$menus['menus']['action']?>"><?=$menus['menus']['action']?></span><? } }?><span><input type="checkbox" <? echo $checkedprop; ?> value="<?=$header['headers']['controller'].":view"?>" name="data[User][menu][]" id="UserMenu">View</span> <span><input type="checkbox" <? echo $checkedprop; ?> value="<?=$header['headers']['controller'].":add"?>" name="data[User][menu][]" id="UserMenu">Add</span> <span><input type="checkbox" <? echo $checkedprop; ?> value="<?=$header['headers']['controller'].":edit"?>" name="data[User][menu][]" id="UserMenu">Edit</span> <span><input type="checkbox" <? echo $checkedprop; ?> value="<?=$header['headers']['controller'].":delete"?>" name="data[User][menu][]" id="UserMenu">Delete</span></td>
        </tr><? } }?>
              </table></div>
     <? echo $this->Form->end(__('Submit')); ?>
	</fieldset>

</div>