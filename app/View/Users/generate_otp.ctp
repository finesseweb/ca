<div class="row">
<div class="col-sm-5  col-sm-offset-3">
<form class="form-signin" action="<?=ROOT_PATH?>users/generateOtp/" id="UserAdminLoginForm" method="post" accept-charset="utf-8">
<div class="row"><div class="col-sm-4"></div><div class="col-sm-8 white_clr"><h1>GET OTP</h1></div></div><br/>
<div class="row"><div class="col-sm-4"></div><div class="col-sm-8"><?php echo $this->Session->flash(); ?></div></div>
<div class="row"><div class="col-sm-4"><label>User Name</label></div><div class="col-sm-8"><input type="text" class="input-block-level" placeholder="Username" name="data[User][username]"></div></div><br/>
<div class="row"><div class="col-sm-4"></div><div class="col-sm-4 col-xs-6"><button class="btn btn-lg btn-success" type="submit">Generate OTP</button></div>
<div class="col-sm-4 col-xs-6"><div class="otp btn-warning"><a href="<?=ROOT_PATH?>users/login/">Login</a></div>
</div>
</form>
</div>
</div>