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
	.value-text{font-size:1rem;}
</style>
<section class="cid-s0KKUOB7cY py-0" id="header01-m">
    <div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 grid-margin stretch-card px-5">
				<div class="card">
					<div class="card-body pt-3">
						<div class="row">
							<div class="col">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="<?php echo site_url('/Invest'); ?>">Invest</a></li>
										<li class="breadcrumb-item active" aria-current="page">Confirm Purchase</li>
									</ol>
								</nav>        
								<h1 class="card-title display-5">BECOME AN INVESTMENT PARTNER OF MILLENNIAL INVESTMENTS</h1>    
								<p class="card-description">STEP 2: Purchase Confirmation</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-12 col-md-5">     
								<h4 class="card-title text-center display-7 mb-5">COMPLETE YOUR PURCHASE!</h4>  
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
										<th>Coin Value:</th> 
										<td class="value-text text-right">$' . $order['coin_value']. '</td>
									</tr>
									<tr>
										<th>Total Coins:</th> 
										<td class="value-text text-right">' . $order['total']. '</td>
									</tr>
									<tr>
										<th>Amount:</th> 
										<td class="value-text text-right">$' . number_format($order['amount'], 2) . '</td>
									</tr>
									<tr>
										<th>Trans. Fees:</th> 
										<td class="value-text text-right">$' . number_format($order['trans_fee'], 2) . '</td>
									</tr>
									<tr>
										<th>Cost:</th>
										<td class="value-text text-right">$' . number_format($order['amount'] + $order['trans_fee'], 2) . '</td>
									</tr>
										';
                                    }
                                    ?>
								</table>
								<hr>
								<?php $this->load->view('Public/Invest/includes/paypal_checkout', $data); ?>
							</div>
							<div class="col-12 col-md-7">
								<h3 class="card-title display-7 text-center pt-3">THE FUTURE OF MYMI!</h3>
								<p class="card-text blog-text">
									Once you have completed your purchase, we will send the requested amount of coins to the Wallet ID provided during your submission!
								</p> 
								<p class="card-text blog-text">
									You will receive a confirmation email once the transfered has completed with information to access the Investor Dashboard to track, trade, or sell your MyMI Coins.
								</p>
								<h4 class="card-title display-7">Need Support?</h4>
								<p class="card-text blog-text">
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
