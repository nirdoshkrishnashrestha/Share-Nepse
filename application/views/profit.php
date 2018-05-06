
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
<!--                                <th data-priority="1">Buy Rate</th>
                                <th data-priority="3">Quantity</th>
-->                                 <th data-priority="3">LTP</th>
                                 <th data-priority="3">Diff</th>
                                 <th data-priority="3">Today's Gain/Loss</th>
                                
                               <!-- <th data-priority="3">Tax</th>
                                <th data-priority="3">SEBON Comm</th>-->
                                <th data-priority="3">Investment</th>
                                <th data-priority="3">Overall Gain/Loss</th>
                                <th data-priority="3">Overall Gain/Loss %</th>
<!--                                 <th data-priority="3">Remove</th>
                                 <th data-priority="3">Edit</th>
-->                                
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
		
			foreach($share_info as $share){
				foreach($data as $datas){
					
					if($datas->companyName == $share->share_name){
					$today_rate = $datas->closingPrice;
					$ltp_quantity += $datas->closingPrice*$share->num;
					$diff = $datas->difference;
					
					} }
					
		$stockExchange_commisson = 0;
		$broker_commission = 0;
		$tax = 0;
		$sum = 0;
		$net_invert = 0;
		$net_invert1=0;
		$net_invert2=0;
		$net_invert3=0;
		$net_invert4=0;
		$sum_individual = 0;
		
		
				$sql_indi = "select * from share_info where username = '$user' and share_name = '$share->share_name'";
				$query_indi = $this->db->query($sql_indi)->result();
				//echo "<pre>";var_dump($query_indi);
				foreach($query_indi as $share_check){ 
				$sum += $share_check->num;
					  $net_invert = $share_check->num*$share_check->buy_rate;	
				if($share_check->type == "sec")
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
				
				if($share_check->type == "ipo")
				{
				$net_invert1 = $share_check->num*$share_check->buy_rate;	
				$stockExchange_commisson += 0;
				$broker_commission += 0;
				$tax += 0;
				}
				
				if($share_check->type == "fpo")
				{
				$net_invert2 = $share_check->num*$share_check->buy_rate;	
				$stockExchange_commisson += 0;
				$broker_commission += 0;
				$tax += 0;
				}
				
				if($share_check->type == "bonus")
				{
				$net_invert3 = $share_check->num*$share_check->buy_rate;	
				$stockExchange_commisson += 0;
				$broker_commission += 0;
				$tax += 0;
				}
				
				if($share_check->type == "rights")
				{
				$net_invert4 = $share_check->num*$share_check->buy_rate;	
				$stockExchange_commisson += 0;
				$broker_commission += 0;
				$tax += 0;
				} 
				 $show_in = $in_fri+$net_invert1+$net_invert2+$net_invert3+$net_invert4;
					}
				
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
			
           <td><a href="<?php echo base_url();?>index.php/share/individual/<?php echo $share->share_name; ?>" ><?php echo $share->share_name;  /// company  ?></a></td>
           			
<!--           <td><?php echo $share->buy_rate;  /// buy rate ?></td>	
           <td><?php echo $share->num; /// Quantity?></td>
-->           <td><?php echo $today_rate;  /// LTP ?></td>
           <td><?php echo $diff;  /// diff ?></td> 
           <?php if($share->diff_amt*$diff < 0){  //// diff amt from sql query?>
            <td style="background:#F00; color:#FFF;"><b><?php echo $share->diff_amt*$diff; ?></b></td>
            <?php }else{ ?>
            <td style="background:#0C6; color:#FFF;"><b><?php echo $share->diff_amt*$diff; ?></b></td>
            <?php } ?>
           
            <td><?php echo round($show_in,2);  /// investment ?></td>
            <?php if($sum_individual < 0){   /// profit/loss ?>
            <td style="background:#F00; color:#FFF;"><b><?php echo round($sum_individual,2); ?></b></td>
            <?php }else{ ?>
             <td style="background:#0C6; color:#FFF;"><b><?php echo round($sum_individual,2); ?></b></td>
             <?php } ?>
            <td><?php echo round($sum_individual/$show_in*100,2); ?></td>
<!--            <td align="center"><a href="<?php echo base_url(); ?>index.php/share/delete/<?php echo $share->share_id; ?>">
            <i class="fa fa-trash-o" style="font-size:24px;color:red;"></i></a></td>
            <td align="center"><a href="<?php echo base_url(); ?>index.php/share/edit_share/<?php echo $share->share_id; ?>">
            <i class="fa fa-edit" style="font-size:24px;color:green;"></i></a></td>
-->		</tr>
                            <?php
							
							$charts .= "["."'";
							$charts .= $share->share_name;
							$charts .= "',";
							$charts .= $individual_investment;
							$charts .= "],";
						 } ?>
							
                        </tbody>
                    </table>
                </div>
                
             <!-- end container -->
        <div > 
       <?php  ?>
    <div class="first-text"><p align="center">Share Amount: <br>
<b><?php echo $total_amt; ?> </b></p><br /><!--(Amount Without any tax and commssion)--></div>
    
   <div class="first-text"><p align="center">Total Investment:<br>
<b><?php echo round($grand_investment,1); ?> </b></p><br /><!--(Amount including tax and commssion)--></div>
	   		
            <div style="float:left;">
			<?php if($today_earning >= 0){ ?>
           <div class="first-text" style=" background-color:#0C6"><p align="center">Totay's Earning:<br>
 <b><?php echo $today_earning; ?> </b></p></div>  
    <?php } else { ?>
		  <div class="first-text" style=" background-color:#F00"><p align="center">Totay's Loss:<br>
 <b><?php echo $today_earning; ?> </b></p></div>
		<?php }	?>  
    </div>            
            
            <div style="float:left;">
			<?php if($ltp_investment >= 0){ ?>
           <div class="first-text" style=" background-color:#0C6"><p align="center">Total Gain:<br>
 <b><?php echo round($ltp_investment,1); ?> </b></p></div>  
    <?php } else { ?>
		  <div class="first-text" style=" background-color:#F00"><p align="center">Total Loss:<br>
 <b><?php echo round($ltp_investment,1); ?> </b></p></div>
		<?php }	?>  
    </div>
    
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([

          ['Company', 'Profit'],
          
		  <?php echo $charts; ?>
          
        ]);

        var options = {
          title: 'Investment Chart',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    
    </div>
    
	</div> <div class="show-chart" align="left" id="piechart_3d" style="margin:auto; width: 450px; height: 200px;"></div>
    <br />
<div style="margin-left:15%"><strong><p style="color:#F00;">Note:</p></strong> <b><u>LTP:</u></b>last traded price. <b><u>Diff:</u></b>per share difference amount compare to yesterday. <b><u>Diff Amt:</u></b>Amount of Price loose or gain compare to yesterday.
    </div></section>
   

<br />
		 <?php include("include/footer.php"); } ?>
