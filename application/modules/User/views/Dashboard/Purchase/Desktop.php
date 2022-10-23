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
					<div class="card-body px-5 pt-5 mt-3">
						<div class="row">
							<div class="col">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="<?php echo site_url('/Dashboard'); ?>">Dashboard</a></li>
										<li class="breadcrumb-item active" aria-current="page">Confirm Purchase</li>
									</ol>
								</nav>        
								<h1 class="card-title display-5">MyMI Coin - Purchase Confirmation</h1>    
								<p class="card-description">STEP 2: Confirm Your Purchase</p>
							</div>
						</div>       
						<hr> 
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-12 col-md-10">      
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
										<td class="text-right">' . $order['wallet_id']. '</td> 										
									</tr> 
									<tr>
										<th>Total Coins:</th>
										<td class="text-right">' . number_format($order['total'], 0). ' MyMI Gold</td>
									</tr>
									<tr>
										<th>Coin Value:</th>
										<td class="text-right">$' . $order['initial_coin_value']. '</td>
									</tr>
									<tr>
										<th>Purchase Amount:</th>
										<td class="text-right">$' . number_format($order['amount'], 2) . '</td>
									</tr>
									<tr>
										<th>Transaction Fees:</th>
										<td class="text-right">$' . number_format($order['total_fees'], 2) . '</td>
									</tr>
									<tr>
										<th>Cost:</th>
										<td class="text-right">$' . number_format($order['amount'] + $order['total_fees'], 2) . '</td>
									</tr>
										';
                                    }
                                    ?>
								</table>
								<hr>
								<?php $this->load->view('Dashboard/Purchase/paypal_checkout', $data); ?>
							</div>
						</div>     
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
