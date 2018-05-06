
        

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('username') == NULL)
{
	redirect("auth/check_session");
} else{
?>

	<?php include("include/header.php"); ?>
    <title>Today's Market</title>
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
        
<?php
include("include/inc_json.php");
$i = 1;
?>
       

        <section id="demo">
            <div class="container">
                <div class="page-header">
                <div class="profit-top">
                <a href="<?php echo base_url(); ?>index.php/share/show_portfolio"> Portfolio </a>|<a href="<?php echo base_url(); ?>index.php/share/add_share"> Add Share </a>|<a href="<?php echo base_url(); ?>index.php/share/signout"> Signout </a>
                </div>
                
                    <h2>Today's Trading</h2>
                </div>
               
               
                <div data-responsive-table-toolbar="tech-companies-1"></div>
                
                <div class="table-responsive" data-pattern="priority-columns">
                
                    <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                        <thead>
                            <tr>
                            	<th>SN.</th>
                                <th>Company</th>
                                <th data-priority="1">Closing Price</th>
                                <th data-priority="3">Diff</th>
                                <th data-priority="1">Min</th>
                                <th data-priority="3">Max</th>
                                <th data-priority="3">Prev Close</th>
                                <th data-priority="6">Traded Shares</th>
                                <th data-priority="6">Traded Amount</th>
                                <th data-priority="6">Transactions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                         <?php foreach ($data as $datas) { ?>
                            <tr>
                            	<td><?php echo $i++; ?></td>
                                <td><?php echo $datas->companyName; ?></td>
                                <td><?php echo $datas->closingPrice; ?></td>
                                <?php if(($datas->closingPrice - $datas->previousClosing) < 0){ ?>
                                <td style=" background:#F00; color:#FFF;"><b><?php echo round($datas->closingPrice - $datas->previousClosing,2); ?></b></td>
                                <?php }else{ ?>
                                <td style="background: #0C6; color:#FFF;"><b><?php echo round($datas->closingPrice - $datas->previousClosing,2); ?></b></td><?php } ?>
                                <td><?php echo $datas->minPrice; ?></td>
                                <td><?php echo $datas->maxPrice; ?></td>
                                <td><?php echo $datas->previousClosing; ?></td>
                                <td><?php echo $datas->tradedShares; ?></td>
                                <td><?php echo $datas->amount; ?></td>
                                <td><?php echo $datas->noOfTransactions; ?></td>
                               
                            </tr>
                            <?php } ?>
                          
                           
                        </tbody>
                    </table>
                </div>
                <br>
              
            </div> <!-- end container -->
        </section> 
        
        <?php echo form_open('share/add_share'); ?>
		<div class="container-login-form-btn">
						<button class="login-form-btn">
							Add Share
						</button>
					</div><br>
<br>
<br>

      </form>              
    <?php include("include/footer.php"); } ?>
