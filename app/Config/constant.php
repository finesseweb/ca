<?php
ini_set('memory_limit', '-1');
@header('Content-type: text/html; charset=utf-8');
@header('Cache-Control: no-store, private, no-cache, must-revalidate');    
@header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);  
@header('Pragma: public');
@header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
@header('Expires: 0', false);
@header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
@header('Pragma: no-cache');
define('ROOT_PATH', 'http://'.$_SERVER['HTTP_HOST'].'/ca/');
define('SITE_PATH', 'http://'.$_SERVER['HTTP_HOST'].'/ca/');
define('DOCUMENT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('CSS_PATH', ROOT_PATH.'css/');
define('BOOT_CSS_PATH', ROOT_PATH.'/css/boot/');
define('JS_PATH', ROOT_PATH.'js/');
define('BOOT_JS_PATH', ROOT_PATH.'/js/boot/');
define('IMG_PATH', ROOT_PATH.'img/');
define('IMAGE_PATH', ROOT_PATH.'/images/');
define('ALBUM_PATH', ROOT_PATH.'/uploadfiles/');
define('GLOBAL_PATH', ROOT_PATH.'/');
define('LOG_OUT_PATH',ROOT_PATH.'/');
define('DOCUMENT_PATH_UPLOAD', DOCUMENT_PATH.'/');

//@date_default_timezone_set("Asia/Kolkata");
?>
