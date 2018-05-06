<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<?php include("include/header.php"); ?>
	<style>
	p{
		color:#ae1111;
	}
	</style>
	<div class="limiter">
		<div class="container-login" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login">
            

			<?php echo form_open('Auth/register_data'); ?>
					<a href="<?php echo base_url(); ?>"><span class="login-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span></a>

					<span class="login-form-title p-b-34 p-t-27">
						Create New User
					</span>
					<div class="wrap-input validate-input" data-validate = "Enter username">
                    <?php 
					
					echo form_error('username');
					
					 ?>
                    
						<input class="input" type="text" name="username" placeholder="Username" required>
					</div>

					<div class="wrap-input validate-input" data-validate="Enter password">
                    	 <?php echo form_error('password'); ?>
						<input class="input" type="password" name="password" placeholder="Password" required>
					</div>
                    
                    <div class="wrap-input validate-input" data-validate="Confirmation password">
                    	 <?php echo form_error('c_password'); ?>
						<input class="input" type="password" name="c_password" placeholder="Confirmation Password" required>
					</div>
                    
                    <div class="wrap-input validate-input" data-validate = "Enter Email">
                   	    <?php echo form_error('email'); ?>
						<input class="input" type="email" name="email" placeholder="E-mail" required>
					</div>
                    
                    <div class="wrap-input validate-input" data-validate = "Enter Mobile">
                    	 <?php echo form_error('mobile'); ?>
						<input class="input" type="text" name="mobile" placeholder="Mobile" required>
					</div>

				
					<div class="container-login-form-btn">
						<button class="login-form-btn">
							Register
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="<?php echo base_url("index.php/Auth/register"); ?>">
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
    <?php include("include/footer.php"); ?>
