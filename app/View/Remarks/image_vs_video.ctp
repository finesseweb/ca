<? echo $this->Html->link(" << Back ",$this->request->referer(),array('class'=>'actions'));  ?><br/>
<? if($source!=null) {?>
<object width="1000" height="600" data="<?php echo SITE_PATH.'img/remarks/'.$source; ?>"></object>
<? } else { echo "Unknown information" ; }?>