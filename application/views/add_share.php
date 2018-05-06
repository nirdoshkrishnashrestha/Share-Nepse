
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('username') == NULL)
{
	redirect("auth/check_session");
} else{
?>

	<?php include("include/header.php"); ?>
    
    <style>

	.profit-top{
		float:right;
		border-bottom:double;
		}
		
		.profit-top a{
		 font-size:16px;
		 font-weight:400;
			}
		
	a:hover{text-decoration: none; color: #701F17}
    .login-form-btn::before{
	 background-color: #5aa732
	}
	
	body{
		color:#212529;
	}
    </style>
	<style>
	p{
		color:#ae1111;
	}
	
	.styled-select {
   height: 29px;
   overflow: hidden;
   width: 240px;
}

.styled-select select {
   background: transparent;
   border: none;
   font-size: 14px;
   height: 29px;
   padding: 5px; /* If you add too much padding here, the options won't show in IE */
   width: 268px;
}

.styled-select.slate {
   height: 34px;
   width: 240px;
}

.styled-select.slate select {
   border: 1px solid #ccc;
   font-size: 16px;
   height: 34px;
   width: 268px;
}

/* -------------------- Rounded Corners */
.rounded {
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
}

.semi-square {
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border-radius: 5px;
}

/* -------------------- Colors: Background */
.slate   { background-color: #ddd; }
.green   { background-color: #779126; }
.blue    { background-color: #3b8ec2; }
.yellow  { background-color: #eec111; }
.black   { background-color: #000; }

/* -------------------- Colors: Text */
.slate select   { color: #000; }
.green select   { color: #fff; }
.blue select    { color: #fff; }
.yellow select  { color: #000; }
.black select   { color: #fff; }


/* -------------------- Select Box Styles: danielneumann.com Method */
/* -------------------- Source: http://danielneumann.com/blog/how-to-style-dropdown-with-css-only/ */
#mainselection select {
   border: 0;
   color: #EEE;
   background: transparent;
   font-size: 20px;
   font-weight: bold;
   padding: 2px 10px;
   width: 378px;
   *width: 350px;
   *background: #58B14C;
   -webkit-appearance: none;
}

#mainselection {
   overflow:hidden;
   width:350px;
   -moz-border-radius: 9px 9px 9px 9px;
   -webkit-border-radius: 9px 9px 9px 9px;
   border-radius: 9px 9px 9px 9px;
   box-shadow: 1px 1px 11px #330033;
}


/* -------------------- Select Box Styles: stackoverflow.com Method */
/* -------------------- Source: http://stackoverflow.com/a/5809186 */
select#soflow, select#soflow-color {
   -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
   background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   margin: 20px;
   overflow: hidden;
   padding: 5px 10px;
   text-overflow: ellipsis;
   white-space: nowrap;
   width: 200px;
}

select#soflow-color {
   color: #fff;
   background-color: #779126;
   -webkit-border-radius: 20px;
   -moz-border-radius: 20px;
   border-radius: 20px;
   padding-left: 15px; }
	
	</style>
    
    <section id="demo">
            <div class="container">
                              
               
                <div data-responsive-table-toolbar="tech-companies-1"></div>
                <br />
<br />
<br />

                <div class="profit-top">
                <a href="<?php echo base_url(); ?>index.php/auth/check_session"> Today's Trade </a>|<a href="<?php echo base_url(); ?>index.php/share/add_share"> Add Share </a>|<a href="<?php echo base_url(); ?>index.php/share/signout"> Signout </a>
                </div>
               <div class="limiter">
		<div class="container-login" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login">
            

			<?php echo form_open('share/insert_share'); ?>
					<a href="<?php echo base_url(); ?>" title="Free share portfolio of nepse"><span class="login-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span></a>

					<span class="login-form-title p-b-34 p-t-27">
						Add Share
					</span>
                    
                        <div class="validate-input" data-validate="Choose Share" align="center">
                    	
                      <div>  
                     
                      	<select name="stock_symbol" id="soflow-color" >
                        <option value="">Stock Symbol</option>
                        <?php 
						include("include/inc_json.php");
						foreach($data as $datas)
						{ ?>
							<option value="<?php echo $datas->companyName; ?>"><?php echo $datas->companyName; ?></option>
					<?php	}
						 ?>
                        </select>
						</div>
					</div>
                    <div class="validate-input" data-validate="Choose Share" align="center">
                    	
                      <div>  
                     
                      	<select name="type" id="soflow-color" >
                        <option value="">Select Type</option>
                       <option value="ipo">IPO</option>
                       <option value="fpo">FPO</option>
                       <option value="sec">Secondary</option>
                        <option value="bonus">Bonus</option>
                         <option value="rights">Rights Share</option>
                       
                        </select>
						</div>
					</div><br />


                    
					<div class="wrap-input validate-input" data-validate = "Enter date">
                    <?php echo form_error('date'); ?>
						<input class="input" type="text" name="date" placeholder="Enter Buy Date">
					</div>
                   

					<div class="wrap-input validate-input" data-validate="Enter rate">
                    	 <?php echo form_error('buy_rate'); ?>
						<input class="input" type="text" name="buy_rate" placeholder="Enter Buy Rate" required>
					</div>
                    
                   
                    <div class="wrap-input validate-input" data-validate = "No of Shares">
                   	    <?php echo form_error('num'); ?>
						<input class="input" type="text" name="num" placeholder="Enter No. of Shares" required>
					</div>
                    
                   <!-- <div class="wrap-input validate-input" data-validate = "Enter Mobile">
                    	 <?php echo form_error('mobile'); ?>
						<input class="input" type="text" name="mobile" placeholder="Mobile" required>
					</div>-->

				

					<div class="container-login-form-btn">
						<button class="login-form-btn">
							Insert
						</button>
					</div>
					<?php if($this->session->userdata("username") == NULL){ ?>
					<div class="text-center p-t-90">
						<a class="txt1" href="<?php echo base_url("index.php/auth/register"); ?>">
							Signup 
						</a> | <a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
                    <?php } ?>
				</form>
                
			</div>
		</div>
	</div>
              
            </div> <!-- end container -->
        </section>
    
	
	

	<div id="dropDownSelect1"></div>
    
    <?php include("include/footer.php"); } ?>
