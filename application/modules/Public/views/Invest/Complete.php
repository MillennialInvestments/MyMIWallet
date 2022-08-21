<?php
    $pageURIC	= $this->uri->segment(3);
    $orderID	= $pageURIC;
?>
<style>
	@media (max-width: 375px) {
	#header01-m {padding-top: 15px !important;}	
	}
	@media (min-width: 767px) {
	#header01-m {padding-top: 1rem !important;}
	}
	.breadcrumb{background-color: transparent !important;}
	.blog-text{font-size:1.25rem;} 
	. img-hgt{height:}
</style>
<section class="cid-s0KKUOB7cY py-0" id="header01-m">
    <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-10 grid-margin stretch-card px-5">
				<div class="card">
					<div class="card-body px-5 pt-3">
						<div class="row">
							<div class="col">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="<?php echo site_url('/Invest'); ?>">Invest</a></li>
										<li class="breadcrumb-item active" aria-current="page">Become An Investor</li>
									</ol>
								</nav>        
								<h1 class="card-title display-5">WE WELCOME YOU!</h1>    
								<p class="card-description">STEP 3: Purchase Successful</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-12 col-md-7">
								<h2 class="card-title display-7 text-center">WELCOME TO MYMI!</h2>
								<p class="card-text blog-text">
									You have successfully complete your purchase of MyMI Coins to carry the badge of an MyMI Investor!
								</p>
								<h3 class="card-title display-7 pt-3">REGISTER INVESTOR ACCOUNT</h3>
								<p class="card-text blog-text">
									Submit your email address to receive instructions to register your Investor Account and track your investment in MyMI!
								</p>            
								<a class="btn btn-primary btn-sm" href="<?php echo site_url('/Investor/register/' . $orderID); ?>">Register</a>
								<h3 class="card-title display-7 pt-5">ALREADY A MEMBER?</h3>
								<p class="card-text blog-text">
									Simply log in to activate your Investor Account!
								</p>
								<a class="btn btn-primary btn-sm" href="<?php echo site_url('/Investor/Activate/' . $orderID); ?>">Activate</a>
							</div> 
							<div class="col-12 col-md-5 pl-5 border-left border-right">     
								<p class="card-text blog-text text-center">
									<strong>MYMI ORDER INFORMATION</strong>
								</p>   
								<table class="table table-borderless">
									<?php
                                    $getOrderInformation		= $this->investment_model->get_order_information($orderID);
                                    foreach ($getOrderInformation->result_array() as $order) {
                                        $data					= array(
                                            'total_cost'		=> $order['total_cost'],
                                        );
                                        echo '
									<tr>
										<th>Wallet ID:</th>
									</tr>
									<tr>
										<td class="value-text py-0" style="font-size:0.8rem;">' . $order['wallet_id']. '</td> 										
									</tr>
								</table>
								<table class="table table-borderless">
									<tr>
									<tr>
										<th>Coin Value:</th>
										<td class="text-right">$' . $order['coin_value']. '</td>
									</tr>
									<tr>
										<th>Total Coins:</th>
										<td class="text-right">' . $order['total']. '</td>
									</tr>
									<tr>
										<th>Purchase Amount:</th>
										<td class="text-right">$' . number_format($order['amount'], 2) . '</td>
									</tr>
									<tr>
										<th>Transaction Fees:</th>
										<td class="text-right">$' . number_format($order['trans_fee'], 2) . '</td>
									</tr>
									<tr>
										<th>Cost:</th>
										<td class="text-right">$' . number_format($order['amount'] + $order['trans_fee'], 2) . '</td>
									</tr>
										';
                                    }
                                    ?>
								</table> 
								<hr>
								<h4 class="card-title display-7">Need Support?</h4>
								<p class="card-text">
									If you need further assistance with completing your purchase of MyMI Coins, please contact us via email:
								</p>                                                                                     
								<a class="btn btn-primary btn-sm" href="mailto:invest@mymillennialinvestments.com">Email Support</a>
							</div>
						</div>      
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
