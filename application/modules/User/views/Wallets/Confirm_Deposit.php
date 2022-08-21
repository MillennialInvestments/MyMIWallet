<?php
    $cuID 											= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
    $pageURIC	= $this->uri->segment(3);
    $walletID	= $pageURIC;
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
<div class="nk-wrap">
	<div class="nk-content nk-content-fluid">
		<div class="container-xl wide-lg">
			<div class="nk-content-body">
				<div class="nk-block-head row justify-content-center">
					<?php echo theme_view('navigation_breadcrumbs'); ?>
					<div class="nk-block-between-md g-4">
						<div class="nk-block-head-content">
							<h2 class="nk-block-title fw-normal">My Wallets <small class="fw-light">(Trading Accounts)</small></h2>
							<div class="nk-block-des"><p>Here is the list of your assets / wallets!</p></div>
						</div>
					</div>
				</div>
				<div class="nk-block nk-block-lg"> 
					<div class="row justify-content-center">
						<div class="col-12 col-md-8">      
							<p class="card-text blog-text text-center">
								<strong>CONFIRM DEPOSIT INFORMATION</strong>
							</p>   
							<table class="table table-borderless">
								<?php
                                $getDepositInformation		= $this->wallet_model->get_last_wallet_deposit($cuID, $walletID);
                                foreach ($getDepositInformation->result_array() as $order) {
                                    $data					= array(
                                        'transID'			=> $order['id'],
                                        'total_cost'		=> $order['total_cost'],
                                    );
                                    echo '
								<tr>
									<th>Wallet ID:</th>
									<td class="text-right">' . $order['wallet_id']. '</td> 										
								</tr>
								<tr>
									<th>User Email:</th>
									<td class="text-right">' . $order['user_email']. '</td>
								</tr>
								<tr>
									<th>Purchase Amount:</th>
									<td class="text-right">$' . number_format($order['amount'], 2) . '</td>
								</tr>
								<tr>
									<th>Transaction Fees:</th>
									<td class="text-right">$' . number_format($order['fees'], 2) . '</td>
								</tr>
								<tr>
									<th>Cost:</th>
									<td class="text-right">$' . number_format($order['amount'] + $order['fees'], 2) . '</td>
								</tr>
									';
                                }
                                ?>
							</table>
							<hr>
						</div>
					</div> 
					<div class="row justify-content-center">
						<div class="col-12 col-md-8">
							<?php $this->load->view('User/Wallets/Deposit_Funds/paypal_checkout', $data); ?>
						</div>
					</div>   
				</div>
			</div>
		</div>
	</div>
</div>
