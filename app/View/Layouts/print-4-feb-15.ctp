<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?><?php  echo $this->element('session'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $this->Html->charset(); ?>
<title>Dashbord : <?php echo ucfirst($this->request->params['controller']); ?></title>
<?php echo $this->Html->meta('icon'); echo $this->Html->css('cake.generic'); echo $this->fetch('meta');echo $this->fetch('css');echo $this->fetch('script');?>
<script src="<?=SITE_PATH?>js/jquery.js"></script>
<script>$(window).load(function() {$(".se-pre-con").fadeOut("slow");});</script>
</head>
<body>
<div class='loading se-pre-con'><img src='http://server/current/cake-crm2/images/loader.gif'> Please wait .Loading........</div>
<div id="container"><div id="header"><?php // echo $this->element('adminmenu'); ?>

<div id="content"><?php echo $this->Session->flash(); ?>
<?php echo $this->fetch('content'); ?></div>
<?php /*?><div id="footer"><?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),'http://www.cakephp.org/',array('target' => '_blank', 'escape' => false));?>
</div><?php */?></div></div><?php // echo $this->element('sql_dump'); ?>
<script> $(".index tr:odd").css("background-color","#fefbfd");</script>

</body>
</html>
