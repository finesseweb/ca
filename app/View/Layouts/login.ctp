<!DOCTYPE html>
<html>
<head>
 
<meta charset="UTF-8">
<title>Admin CRM - Login</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="<?=CSS_PATH?>bootstrap.css" rel="stylesheet">
<link href="<?=CSS_PATH?>login.css" rel="stylesheet">
</head>
<body>
<div class="overlay_login"><div class="container"><?php echo $this->fetch('content'); ?>
<?php  //echo $this->element('sql_dump'); ?>
</div></div>

</body>
<script>
$('#show').click(function() {
if($('#user').val()=="")
{
$('#user-error').html("<span style='color:red'>fill the user name</span>");
}
else {
$.ajax({
type: 'GET',
url: '<?=ROOT_PATH?>/users/login',
dataType: 'html',
success: function(data) {
$('#user-error').html("<span style='color:red'>fill the user name</span>");
}
});
}
});</script>
</html>
