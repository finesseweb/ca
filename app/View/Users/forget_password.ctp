<div class="limiter">
		<div class="container-login100">
		  <img src="<?=ROOT_PATH?>images/pfi.png">
			<div class="wrap-login100">
			    
				<div class="login100-pic">
		                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
									<div class="carousel-inner">
										<div class="carousel-item active">
										  <img class="d-block w-100" src="<?=ROOT_PATH?>images/1.jpg" alt="First slide">
										</div>
										<div class="carousel-item">
										  <img class="d-block w-100" src="<?=ROOT_PATH?>images/2.jpg" alt="Second slide">
										</div>
										<div class="carousel-item">
										  <img class="d-block w-100" src="<?=ROOT_PATH?>images/3.jpg" alt="Third slide">
										</div>
									<div class="carousel-item">
										  <img class="d-block w-100" src="<?=ROOT_PATH?>images/4.jpg" alt="Fourth slide">
									</div>
									</div>
									    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									    </a>
									    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									  </a>
								</div>
				</div>

				<form class="login100-form validate-form" action="<?=ROOT_PATH?>users/forgetPassword/" id="UserAdminLoginForm" method="post" accept-charset="utf-8">
					<span class="login100-form-title">
						Forget Password
					</span>
<span style=" text-align: center;">	<?php echo $this->Session->flash(); ?></span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="data[User][email]" value="<?php if(!empty($this->request->data['User']['email'])) { echo $this->request->data['User']['email'];}?>" placeholder="Enter Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Submit
						</button>
					</div>

					<div class="text-center p-t-12">
						<a class="txt1" href="<?=ROOT_PATH?>users/loginnew">
							Login
						</a>
						
					</div>

					<!--<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>-->
				</form>
			</div>
		</div>
	</div>
	