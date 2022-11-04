<?php
    $orderID			= $_SESSION['allSessionData']['userLastOrder']['orderID'];
    $wallet_id			= $_SESSION['allSessionData']['userLastOrder']['wallet_id'];
    $total				= $_SESSION['allSessionData']['userLastOrder']['total'];
    $amount				= $_SESSION['allSessionData']['userLastOrder']['amount'];
    $user_trans_fee		= $_SESSION['allSessionData']['userLastOrder']['user_trans_fee'];
    $user_trans_percent	= $_SESSION['allSessionData']['userLastOrder']['user_trans_percent'];
    $total_cost			= round($amount + $user_trans_fee + $user_trans_percent);
    $paypalData			= array(
        'orderID'		=> $orderID,
        'total_cost'	=> $total_cost,
    );
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
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-4"></div>
		<div class="col-12 col-md-4 mb-3">  
			<div class="nk-block">
				<div class="nk-block-head">
					<?php echo theme_view('navigation_breadcrumbs'); ?>
					<div class="nk-block-between-md g-4">
						<div class="nk-block-head-content">
							<h2 class="nk-block-title fw-bold">MYMI GOLD PURCHASE</h2>
							<div class="nk-block-des"><p>Confirm and Complete Your MyMI Gold Purchase Information!</p></div>
						</div>
					</div>
				</div>
			</div> 
		</div>
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
		<div class="col-12 col-md-4">  
			<div class="nk-block nk-block-lg">         
				<p class="card-text blog-text text-center">
					<strong>MYMI ORDER INFORMATION</strong>
				</p>   
				<table class="table table-borderless">
					<?php
                    echo '
					<tr>
						<th>WALLET ID:</th>
						<td class="text-right">' . $wallet_id . '</td> 										
					</tr> 
					<tr>
						<th>ORDER ID:</th>
						<td class="text-right">' . $orderID . '</td> 										
					</tr> 
					<tr>
						<th>TOTAL COINS:</th>
						<td class="text-right">' . number_format($total, 0). ' MyMI Gold</td>
					</tr>
					<tr>
						<th>PURCHASE AMOUNT:</th>
						<td class="text-right">$' . number_format($amount, 2) . '</td>
					</tr>
					<tr>
						<th>TRANSACTION FEES:</th>
						<td class="text-right">$' . number_format($user_trans_fee + $user_trans_percent, 2) . '</td>
					</tr>
					<tr>
						<th>COST:</th>
						<td class="text-right">$' . number_format($amount + $user_trans_fee + $user_trans_percent, 2) . '</td>
					</tr>
					';
                    ?>
				</table>
				<hr>
			</div>
		</div>
		<div class="col-md-2"></div>
		<?php $this->load->view('User/Dashboard/Purchase/paypal_checkout', $paypalData); ?>
	</div>
</div>
