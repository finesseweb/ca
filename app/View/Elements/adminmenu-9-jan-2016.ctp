<header class="header">
<span class="logo">CRM</span>
<nav class="navbar navbar-static-top" role="navigation">
<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</a>
<div class="navbar-right">
<ul class="nav navbar-nav">
<li class="dropdown user user-menu">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="glyphicon glyphicon-user"></i>
<span><?php $sessionval=$this->Session->read('User');  if(!empty($sessionval['username'])){ echo $sessionval['name'] ;}  ?> <i class="caret"></i></span>
</a>
<ul class="dropdown-menu">
<li class="user-header bg-light-blue">
<? if($sessionval['gender']=='male') {?><img src="<?=SITE_PATH?>images/male-icon.png" class="img-circle" /> <? } else if($sessionval['gender']=='female') { ?>  <img src="<?=SITE_PATH?>images/female-icon.png" class="img-circle"/><? }else { }?> 
<p><? echo $sessionval['name'] ;?></p>
</li>
<li class="user-footer">
<div class="pull-right">
<? echo  $this->Html->link(__('Logout', true),array('controller' => 'users','action'=>'logout'),array('class'=>'btn btn-default btn-flat'))?>
</div>
</li>
</ul>
</li>
</ul>
</div>
</nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
<aside class="left-side sidebar-offcanvas">
<section class="sidebar">
<? if($sessionval['type']==='regular' and !empty($sessionval['mainmenu'])){ 
if (in_array($this->request->params['controller'].":".$this->request->params['action'], $sessionval['mainmenu']) || $this->requestAction(array('controller' => 'menus', 'action' => 'checkMenu',$this->request->params['controller'],$this->request->params['action']))==true) { } else { $this->requestAction(array('controller' => 'users', 'action' => 'checkRestriction',$sessionval['mainmenu'][1]));}

echo $sessionval['menus']; 
} 
else if($sessionval['type']!=='regular')
 {
	  echo $sessionval['menus'];
	  } 

else if($sessionval['type']=='regular' and empty($sessionval['mainmenu'])) 
{  
$this->requestAction(array('controller' => 'users', 'action' => 'checkSession','YOU ARE NOT ACTIVE USER NOW.PLEASE TRY AFTER SOMETIME'));
} else { }?>
</section>
<!-- /.sidebar -->
</aside>


