
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('username') != NULL)
{
	redirect("auth/check_session");
} else{
?>


	<?php include("include/header.php"); ?>
    <style>
	p{
	color: #FF6633;
	margin-bottom: 18px;
	}
    </style>
	<div class="limiter">
		<div class="container-login" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login">
			<?php echo form_open('auth/validate'); ?>
					<a href="<?php echo base_url(); ?> " title="Free nepse portfolio for share in nepal"><span class="login-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span></a>

					<span class="login-form-title p-b-34 p-t-27">
                    <p style="font-size: 24px; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif;">Free Portfolio Management System</p>						
			  </span>
              <div class="error" align="center"><?php echo $this->session->flashdata('success'); ?></div>
                    <div class="error" align="center"><?php echo $this->session->flashdata('fail'); ?></div>
					<div class="error" align="center"><?php echo validation_errors(); ?></div>
					<div class="wrap-input validate-input" data-validate = "Enter username">
						<input class="input" type="text" name="username" placeholder="Username">
						<span class="focus-input" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input validate-input" data-validate="Enter password">
						<input class="input" type="password" name="password" placeholder="Password">
						<span class="focus-input" data-placeholder="&#xf191;"></span>
					</div>

				
					<div class="container-login-form-btn">
						<button class="login-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="<?php echo base_url("index.php/auth/register"); ?>">
							Signup 
						</a> | <a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
				</form>
                
		  </div>
	  </div>
	</div>
	

	<div id="dropDownSelect1"></div>
    <?php include("include/footer.php");} ?> s
