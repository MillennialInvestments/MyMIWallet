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
										<li class="breadcrumb-item active" aria-current="page">Purchase Complete</li>
									</ol>
								</nav>        
								<h1 class="card-title display-5">MyMI Coin - Purchase Complete</h1>    
								<p class="card-description">STEP 3: Purchase Completed</p>
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
