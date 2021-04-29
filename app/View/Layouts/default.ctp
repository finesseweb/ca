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

$cakeDescription = __d('cake_dev', 'CA: JayantKumar');
?><?php  echo $this->element('session'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php // echo $this->Html->charset(); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $cakeDescription ?>:<?php echo $title_for_layout; ?></title>
<?php echo $this->Html->meta('icon');echo $this->Html->css('bootstrap'); echo $this->Html->css('cake.generic');echo $this->Html->css('dropdown');echo $this->Html->css('admin_crm');echo $this->fetch('meta');echo $this->fetch('css');echo $this->fetch('script');?>
<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script src="<?=SITE_PATH?>js/jquery.js"></script>
  
 
<script>$(window).load(function() {$(".se-pre-con").fadeOut("slow");});</script>
<!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script><![endif]-->
</head>
<body class="skin-blue">
<div class='loading se-pre-con'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>
<?php  echo $this->element('adminmenu'); ?>

<aside class="right-side">
<?php echo $this->Session->flash(); ?><?php echo $this->fetch('content'); ?>
</section>
</aside>
</div>
<!--<div id="footer"><?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),'http://www.cakephp.org/',array('target' => '_blank', 'escape' => false));?>
</div>-->
<?php // echo $this->element('sql_dump'); ?>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
<script src="<?=SITE_PATH?>js/bootstrap.min.js"></script>
<script src="<?=SITE_PATH?>js/app.js"></script>

</body>
</html>
