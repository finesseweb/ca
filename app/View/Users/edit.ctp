<? $allparentids=@implode('##',$users);?><div class="actions">
<style>
     .menu{
                margin-bottom: 0px !important;
            }

    </style>
    <h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Users'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('User'); ?>
<fieldset>
<legend><?php echo __('Edit User'); ?></legend>
<?php echo "<div class='row'>";
echo $this->Form->input('id');
echo $this->Form->input('parent',array('type'=>'hidden','hiddenField' => '0'));
echo "<div class='col-sm-3'>".$this->Form->input('username',array('class' => 'form-control'))."</div><div class='col-sm-3'>". $this->Form->input('password',array('class' => 'form-control'),array("type"=>"password"))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('name',array('class' => 'form-control'),array("label"=>"First Name"))."</div><div class='col-sm-3'>".$this->Form->input('middle_name',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('last_name',array('class' => 'form-control'))."</div><div class='col-sm-3'><div class='input text'><label for='UserGender'>Gender</label><select name='data[User][gender]' class='form-control'>
<option value='male'>Male</option>
<option value='female'>Female</option></select></div></div>";
echo "<div class='col-sm-3'>".$this->Form->input('phone',array('class' => 'form-control','type'=>'number'))."</div><div class='col-sm-3'>".$this->Form->input('email',array('class' => 'form-control'))."</div>";
if(CakeSession::read('User.type')=='admin' || CakeSession::read('User.type')=='user'){
echo "<div class='col-sm-3'>".$this->Form->input('type',array('type'=>'radio','class'=>'type','options'=>array('PFI'=>'PFI','NGO'=>'NGO')))."</div>";
echo "<div class='col-sm-5'>".$this->Form->input('role',array('type'=>'radio','class'=>'role','options'=>array('admin'=>'Master Admin','user'=>'Offcial User','regular'=>'Field User')))."</div>";


echo "<div class='col-sm-4'>".$this->Form->input('subrole',array('type'=>'radio','class'=>'subrole','legend'=>'Sub Role','options'=>array('DPO'=>'DPO','BPC'=>'BPC','CC'=>'CC')))."</div>";


}

echo "<div class='col-sm-12'>";
echo "<div class='col-sm-6'><label for='UserParent'>Group</label><select name='data[User][parent]' id='UserParent' required='required' class='form-control'><option value='0'>Select Group</option>".$this->requestAction(array("controller"=>"users","action"=>"buildTree",'0',$this->data['User']['parent'],$allparentids))."</select></div>";

echo "<div class='col-sm-6'>".$this->Form->input('status',array('type'=>'radio','options'=>array('active'=>'Active','deactive'=>'Deactive')))."</div>";
echo "</div>";


echo "</div>";
?>
<div class="float_none table-responsive">
 <table style="<?php echo $display; ?>" class="table table-hover table-condensed">
<tr><td colspan="20"><label for="UserUsername">Menus</label></td></tr>
<?php  
$hed=@unserialize($this->request->data['User']['menuheader']); 
$mnu=@unserialize($this->request->data['User']['menu']); 
if(!empty($menuheads)) {
  foreach($menuheads as $key=>$head) {  ?>
<tr style="background-color: #e3f10c"><td colspan="25"><?=$head['head']['name']?></td></tr> 
<?php
$menuheaders = $this->requestAction(array('controller'=>'users','action'=>'getSubmenu',$head['head']['id']));
  
if(!empty($menuheaders)){ foreach($menuheaders as $key=>$header) { 
  $menu=$this->requestAction(array('controller'=>'users','action'=>'menusonheader',$header['headers']['controller']));?>
<tr style="height:25px">
<td width="20%" class="dvtCellLabel"  colspan="4">
    <input type="checkbox"  id="UserMenuheader" name="data[User][menuheader][]" value="<?=$header['headers']['menuheader_id'].":".$header['headers']['controller']?>" <?php if(!empty($hed) and in_array($header['headers']['menuheader_id'].":".$header['headers']['controller'], $hed)) { ?> checked="checked"<?php } ?>><?=ucwords($header['headers']['controller'])?> : </td>
<td><table class="menu"><tr><?php if(!empty($menu)){ foreach($menu as $key2=>$menus) {?>
            <td><span><input type="checkbox"  id="UserMenu" name="data[User][menu][]" value="<?=$header['headers']['controller'].":".$menus['menus']['action']?>" <?php if(!empty($mnu) and in_array($header['headers']['controller'].":".$menus['menus']['action'], $mnu)) { ?> checked="checked"<?php } ?>><?=$menus['menus']['action']?></span></td><?php } } ?></tr></table></td>

<td><span><input type="checkbox" value="<?=$header['headers']['controller'].":view"?>" name="data[User][menu][]" id="UserMenu" <?php if(!empty($mnu) and in_array($header['headers']['controller'].":view", $mnu)) { ?> checked="checked"<?php } ?>>View</span></td> <td><span><input type="checkbox" value="<?=$header['headers']['controller'].":add"?>" name="data[User][menu][]" id="UserMenu" <?php if(!empty($mnu) and in_array($header['headers']['controller'].":add", $mnu)) { ?> checked="checked"<?php } ?>>Add</span> </td>
<td><span><input type="checkbox" value="<?=$header['headers']['controller'].":edit"?>" name="data[User][menu][]" id="UserMenu" <?php if(!empty($mnu) and in_array($header['headers']['controller'].":edit", $mnu)) { ?> checked="checked"<?php } ?>>Edit</span> </td>  

<td><span><input type="checkbox" value="<?=$header['headers']['controller'].":delete"?>" name="data[User][menu][]" id="UserMenu" <?php if(!empty($mnu) and in_array($header['headers']['controller'].":delete", $mnu)) { ?> checked="checked"<?php } ?>>Delete</span></td>		

</td>
</tr><?php } } } }?>
</table></div>
<?php echo $this->Form->end(__('Submit')); ?>
</fieldset>
</div>
</div>
<script>
    
$(document).ready(function(){
    
    
$('#UserSubroleDPO').attr('disabled','disabled'); 
$('#UserSubroleBPC').attr('disabled','disabled'); 
$('#UserSubroleCC').attr('disabled','disabled'); 
    if($(".type").is(":checked")){
     var c= $('.type:checked').val();
     var r= $('.role:checked').val();
      // alert(r);
   
    if(c==='NGO'){
        $('#UserRoleAdmin').attr('disabled','disabled');
    }
    else{
           $('#UserRoleAdmin').removeAttr("disabled");
    }  
    if(c==='NGO' && r==='regular'){
         $('#UserSubroleDPO').attr('disabled','disabled');
       $('#UserSubroleBPC').removeAttr("disabled");
        $('#UserSubroleCC').removeAttr("disabled");
    }
     else if(c==='PFI' && r==='regular' ){  
         $('#UserSubroleDPO').removeAttr("disabled");
            $('#UserSubroleBPC').attr('disabled','disabled'); 
            $('#UserSubroleCC').attr('disabled','disabled'); 
    }
     
    }
$(".type").click(function(){
    var c=$(this).val();
    if(c==='NGO'){
        $('#UserRoleAdmin').attr('disabled','disabled');
    }
    else{
           $('#UserRoleAdmin').removeAttr("disabled");
    }
});

$(".role").click(function(){
     var c=$(this).val(); 
    var radioValue = $("input[name='data[User][type]']:checked").val();
    //alert(radioValue);
   
    if(c==='regular' && radioValue==='NGO' ){  
        $('#UserSubroleDPO').attr('disabled','disabled');
       $('#UserSubroleBPC').removeAttr("disabled");
        $('#UserSubroleCC').removeAttr("disabled");
         
    }
    else if(c==='regular' && radioValue==='PFI' ){  
         $('#UserSubroleDPO').removeAttr("disabled");
            $('#UserSubroleBPC').attr('disabled','disabled'); 
            $('#UserSubroleCC').attr('disabled','disabled'); 
    }
    else{
           $('#UserSubroleDPO').attr('disabled','disabled'); 
            $('#UserSubroleBPC').attr('disabled','disabled'); 
            $('#UserSubroleCC').attr('disabled','disabled'); 
    }
});



$( "#UserPhone" ).blur(function() {
    var c=$(this).val();
    if (c.length<10)
           {
                alert("Enter min 10 digit");
               setTimeout(function(){$('#UserPhone').focus();}, 2);
                return false;
           }
         else if(c.length>10){
            alert("Enter max 10 digit");
                setTimeout(function(){$('#UserPhone').focus();}, 2);
                return false;  
             
         }  
    });
    });
    </script>