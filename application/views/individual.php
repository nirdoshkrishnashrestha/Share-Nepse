
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($this->session->userdata('username') == NULL)
{
	redirect("auth/check_session");
} else{
	
	$user = $this->session->userdata('username');
?>

	<?php include("include/header.php"); ?>
    <title><?php echo ucfirst($this->session->userdata('username'))."'s "; ?>Account</title>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    
	<style>

		
	a:hover{text-decoration: none; color: #701F17}
    .login-form-btn::before{
	 background-color: #5aa732
	}
	th,td{ text-align:center}
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
                <a href="<?php echo base_url(); ?>index.php/auth/check_session"> Today's Trade </a>|<a href="<?php echo base_url(); ?>index.php/share/add_share"> Add Share </a>|<a href="<?php echo base_url(); ?>index.php/share/signout"> Signout </a>
                </div>
                    <h2>My Portfolio</h2>
                
               </div>
         
                <div data-responsive-table-toolbar="tech-companies-1"></div>
                
                 

                <div class="table-responsive" data-pattern="priority-columns">
                    <table cellspacing="0" id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                        <thead>

                        
                            <tr>
                            	
                                <th>Company</th>
                                <th data-priority="3">Quantity</th>
                                <th data-priority="1">Buy Rate</th>
                                <th data-priority="3">Tax</th>
                                <th data-priority="3">SEBON Comm</th>
                                 <th data-priority="3">Remove</th>
                                 <th data-priority="3">Edit</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        
                               <?php
		
		$total_amt = 0;
		$grand_investment = 0;
		$total_investment = 0;
		$ltp_quantity = 0;
		$today_earning = 0;
		$charts = "";
		$share_name = "";
		
		//var_dump($data);
		
			foreach($values as $share){
				foreach($data as $datas){
					
					if($datas->companyName == $share->share_name){
					$today_rate = $datas->closingPrice;
					$ltp_quantity += $datas->closingPrice*$share->num;
					$diff = $datas->difference;
					
					} }
					

		
				//$sql_indi = "select * from share_info where username = '$user' and share_name = '$share->share_name'";
				//$query_indi = $this->db->query($sql_indi)->result();
				//foreach($query_indi as $share_check){ 
				//$sum += $share->num;
				$net_invert = $share->num*$share->buy_rate;	
				if($share->type == "sec")
				{
				//$total_investment += $net_invert;
					 if($net_invert < 50000)
				{
					$tax = $net_invert*0.6/100;
				}
				if($net_invert < 500000 and $net_invert > 49999)
				{
					/// inv is greater then 49999 thousand i.e 50 thou or above AND smaller then 5 lakh
					 $tax = $net_invert*0.55/100;
				}
				if($net_invert < 2000000 and $net_invert > 499999)
				{
					/// inv is greater then 5 lakh AND smaller then 20 lakh
					$tax = $investment*0.5/100;
				}
				if($net_invert < 10000000 and $net_invert > 1999999)
				{
					$tax = $net_invert*0.45/100;
				}
				if($net_invert > 10000000)
				{
					$tax = $net_invert*0.40/100;
				}
				$stockExchange_commisson = $net_invert*0.015/100;
				$broker_commission = 25;
				$in_fri = $net_invert+$tax+$broker_commission+$stockExchange_commisson;
					}
				
				if($share->type == "ipo")
				{
				$net_invert1 = $share->num*$share->buy_rate;	
				$stockExchange_commisson = 0;
				$broker_commission = 0;
				$tax = 0;
				}
				
				if($share->type == "fpo")
				{
				$net_invert2 = $share->num*$share->buy_rate;	
				$stockExchange_commisson = 0;
				$broker_commission = 0;
				$tax = 0;
				}
				
				if($share->type == "bonus")
				{
				$net_invert3 = $share->num*$share->buy_rate;	
				$stockExchange_commisson = 0;
				$broker_commission = 0;
				$tax += 0;
				}
				
				if($share->type == "rights")
				{
				$net_invert4 = $share->num*$share->buy_rate;	
				$stockExchange_commisson = 0;
				$broker_commission = 0;
				$tax = 0;
				} 
				 $show_in = $in_fri+$net_invert1+$net_invert2+$net_invert3+$net_invert4;
					//}
				
				$grant_tax_commission = $tax+$broker_commission+$stockExchange_commisson;
							  
				$grand_investment += $show_in;	
						 
				$total_amt += $share->diff_amt*$share->buy_rate;
				
				$individual_investment = $grant_tax_commission+$net_invert;
				
				 $individual_pro_loss = $today_rate*$share->diff_amt;  //
				
				$today_earning += $diff*$share->diff_amt;
				
				$sum_individual = $individual_pro_loss-$show_in;  //
				
				$ltp_investment += $sum_individual;
				
			 ?>
        <tr>
			
           <td><?php echo $share->share_name;  /// company  ?></td>
           <td><?php echo $share->num; /// Quantity?></td>
           <td><?php echo $share->buy_rate;  /// buy rate ?></td>	
            <td><?php echo $tax; ?></td>
			<td><?php echo $stockExchange_commisson; ?></td>
            <td align="center"><a href="<?php echo base_url(); ?>index.php/share/delete/<?php echo $share->share_id; ?>">
            <i class="fa fa-trash-o" style="font-size:24px;color:red;"></i></a></td>
            <td align="center"><a href="<?php echo base_url(); ?>index.php/share/edit_share/<?php echo $share->share_id; ?>">
            <i class="fa fa-edit" style="font-size:24px;color:green;"></i></a></td>
		</tr>
                            <?php } ?>
							
                        </tbody>
                    </table>
                </div>
               
             <!-- end container -->
        <div > 
       <?php  ?>
    
    </div>
    
	</div>  
    <br />
</section>
   

<br />
		 <?php include("include/footer.php"); } ?>
