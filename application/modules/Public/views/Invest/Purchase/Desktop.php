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
										<li class="breadcrumb-item active" aria-current="page">Confirm Purchase</li>
									</ol>
								</nav>        
								<h1 class="card-title display-5">BECOME AN INVESTMENT PARTNER OF MILLENNIAL INVESTMENTS</h1>    
								<p class="card-description">STEP 2: Purchase Confirmation</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-12 col-md-5 pl-5 border-left border-right">     
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
								<?php $this->load->view('Public/Invest/includes/paypal_checkout', $data); ?>
							</div>
							<div class="col-12 col-md-7 pl-5">
								<h3 class="card-title display-7 text-center">WELCOME TO THE FUTURE OF MYMI!</h3>
								<p class="card-text blog-text">
									Once you have completed your purchase, we will send the requested amount of coins to the Wallet ID provided during your submission!
								</p> 
								<p class="card-text blog-text">
									You will receive a confirmation email once the transfered has completed, along with information to access your Investor Dashboard to track, trade, or sell your MyMI Coins.
								</p>
								<h4 class="card-title display-7">Need Support?</h4>
								<p class="card-text blog-text">
									If you need further assistance with completing your purchase of MyMI Coins, please contact us via email by sending a requestto <a href="mailto:invest@mymillennialinvestments.com">invest@mymillennialinvestments.com</a>
								</p>
<!--
								<h5 class="card-title display-7 text-center">-OR-</h5>
								<p class="card-text blog-text">Simply click the link below:</p>
								<a href="<?php echo site_url('/Support/Investments'); ?>">Contact Support</a>
-->
<!--
								<h4 class="card-title text-center display-7 my-3">REGISTER AN INVESTOR ACCOUNT!</h4> 
								<p class="card-text blog-text">
									To purchase your share of MyMI Coins and own your stake in the Millennial Investments Platform, register an Investor Account by clicking the link below: 
								</p> 
								<p class="text-center">
									<a class="btn btn-primary text-center" href="<?php echo site_url('Investor/register'); ?>">REGISTER!</a>
								</p>
								<hr>
								<h4 class="card-title text-center display-7 my-3">ALREADY A REGISTERED MEMBER?</h4> 
								<p class="card-text blog-text">
									Already have an Membership with Millennial Investments? Not an issue! Claim your stake in Millennial Investments by clicking the link below: 
								</p> 
								<p class="text-center">
									<a class="btn btn-primary text-center" href="<?php echo site_url('Investor/login'); ?>">LOGIN!</a>
								</p> 
-->
							</div>
						</div>     
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
