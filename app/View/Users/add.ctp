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
<legend><?php echo __(' User'); ?></legend>
<?php $datauser='';$chk=''; echo "<div class='row'><table>";
$this->Form->input('password_enc',array("type"=>"hidden"));
echo "<div class='col-sm-3'>".$this->Form->input('username',array('class' => 'form-control'))."</div><div class='col-sm-3'>". $this->Form->input('password',array('class' => 'form-control'),array("type"=>"password"))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('name',array('class' => 'form-control'),array("label"=>"First Name"))."</div><div class='col-sm-3'>".$this->Form->input('middle_name',array('class' => 'form-control'))."</div>";
echo "<div class='col-sm-3'>".$this->Form->input('last_name',array('class' => 'form-control'))."</div>
    <div class='col-sm-3'><div class='input text'>
    <label for='UserGender'>Gender</label><select name='data[User][gender]' class='form-control'>
<option value='male'>Male</option>
<option value='female'>Female</option>
<option value='transgender'>Transgender</option></select></div></div>";
echo "<div class='col-sm-3'>".$this->Form->input('phone',array('class' => 'form-control','type'=>'number'))."</div><div class='col-sm-3'>".$this->Form->input('email',array('class' => 'form-control'))."</div>";
if(CakeSession::read('User.type')==='regular'){
$datauser='<option value="'.CakeSession::read('User.id').'" '.$chk.' >---- '.CakeSession::read('User.name').'</option>';
$datauser.=$this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),'0',$allparentids));
} else {
$datauser='<option value="0">Select Group</option>';
$datauser.= $this->requestAction(array("controller"=>"users","action"=>"buildTree",'0','0',$allparentids)); }

echo "<div class='col-sm-3'><div class='input text notrequired'><label for='UserParent'>Group</label><select name='data[User][parent]' id='UserParent' required='required' class='form-control'>".$datauser."</select></div></div>";



if(CakeSession::read('User.type')=='admin' || CakeSession::read('User.type')=='user'){
echo "<div class='col-sm-12'>";
echo "<div class='col-sm-3'>".$this->Form->input('type',array('type'=>'radio','class'=>'type','options'=>array('PFI'=>'PFI','NGO'=>'NGO')))."</div>";
echo "<div class='col-sm-5'>".$this->Form->input('role',array('type'=>'radio','class'=>'role','options'=>array('admin'=>'Master Admin','user'=>'Offcial User','regular'=>'Field User')))."</div>";
echo "<div class='col-sm-4'>".$this->Form->input('subrole',array('type'=>'radio','class'=>'subrole','options'=>array('DPO'=>'DPO','BPC'=>'BPC','CC'=>'CC'),'legend'=>'Sub Role'))."</div>";

//echo "<div class='col-sm-4'>".$this->Form->input('subtype',array('type'=>'radio','options'=>array('DPO'=>'DPO','BPC'=>'BPC','CC'=>'CC')))."</div></div>";
}

echo "</table></div>";
?>
<div class="float_none table-responsive"><table style="<?php echo $display; ?>" class="table table-hover table-condensed">
        <tr><td colspan="20"><label for="UserUsername">Menus</label></td></tr>
<?php  

if(!empty($menuheads)) {
  foreach($menuheads as $key=>$head) {  ?>
        <tr style="background-color: #e3f10c"><td colspan="25"><?=$head['head']['name']?></td></tr>     
 <?php $menuheaders = $this->requestAction(array('controller'=>'users','action'=>'getSubmenu',$head['head']['id']));
   // print_r($menuheaders); exit; 
if(!empty($menuheaders))

{ foreach($menuheaders as $key=>$header) { 
    $menu=$this->requestAction(array('controller'=>'users','action'=>'menusonheader',$header['headers']['controller']));
  //print_r($menu); exit;  
    ?>
<tr>
    <td class="dvtCellLabel"  colspan="4"><input type="checkbox" <?php echo $checkedprop; ?>  id="UserMenuheader" class="<?=$header['headers']['usertype'];?>" name="data[User][menuheader][]" value="<?=$header['headers']['menuheader_id'].":".$header['headers']['controller']?>"><?=ucwords($header['headers']['controller'])?> : </td><td><table class="menu"><tr><?php if(!empty($menu)){ foreach($menu as $key2=>$menus) {?>
            <td><span><input type="checkbox" <?php echo $checkedprop; ?>  id="UserMenu" name="data[User][menu][]" class="<?=$header['headers']['usertype'];?>" value="<?=$header['headers']['controller'].":".$menus['menus']['action']?>"><?=$menus['menus']['action']?></span></td><?php } } ?></tr></table></td>
     <td><span><input type="checkbox" <?php echo $checkedprop; ?> value="<?=$header['headers']['controller'].":view"?>" name="data[User][menu][]" id="UserMenu" class="<?=$header['headers']['usertype'];?>" >View</span></td><td> <span><input type="checkbox" <?php echo $checkedprop; ?> value="<?=$header['headers']['controller'].":add"?>" name="data[User][menu][]" id="UserMenu">Add</span> </td>
    <td><span><input type="checkbox" <?php echo $checkedprop; ?> value="<?=$header['headers']['controller'].":edit"?>" name="data[User][menu][]" id="UserMenu">Edit</span> </td>
    <td><span><input type="checkbox" <?php echo $checkedprop; ?> value="<?=$header['headers']['controller'].":delete"?>" name="data[User][menu][]" id="UserMenu">Delete</span></td>
</tr><?php } } } }?>
</table></div>
<?php echo $this->Form->end(__('Submit')); ?>
</fieldset>
</div>
</div>
<script>
    
$(document).ready(function(){
$(".type").click(function(){
    var c=$(this).val();
    if(c==='NGO'){
        $('#UserRoleAdmin').attr('disabled','disabled');
    }
    else{
           $('#UserRoleAdmin').removeAttr("disabled");
    }
});


$('#UserSubroleDPO').attr('disabled','disabled'); 
$('#UserSubroleBPC').attr('disabled','disabled'); 
$('#UserSubroleCC').attr('disabled','disabled'); 
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
$(".subrole").click(function(){
    var c=$(this).val();
    
    if(c==='CC'){
     $(".CC").prop("checked", "checked"); 
     $(".BPC").removeAttr("checked"); 
     $(".DPO").removeAttr("checked"); 
    }
    else if(c==='BPC'){
       $(".CC").prop("checked", "checked");  
       $(".BPC").prop("checked", "checked"); 
       $(".DPO").removeAttr("checked");
    }
    else if(c==='DPO'){
       $(".CC").prop("checked", "checked");  
       $(".BPC").prop("checked", "checked"); 
       $(".DPO").prop("checked", "checked"); 
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