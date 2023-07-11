<?php
<<<<<<< HEAD
    $beta               = $this->config->item('beta');
    $userAccount        = $_SESSION['allSessionData']['userAccount']; 
    $userLastOrder      = $_SESSION['allSessionData']['userLastOrder']; 
    $cuID               = $userAccount['cuID']; 
    $cuEmail            = $userAccount['cuEmail']; 
    $cuFirstName        = $userAccount['cuFirstName'];
    $cuLastName         = $userAccount['cuLastName']; 
    $cuPhone            = $userAccount['cuPhone'];
    $orderID			= $userLastOrder['orderID'];
    $wallet_id			= $userLastOrder['wallet_id'];
    $total				= $userLastOrder['total'];
    $amount				= $userLastOrder['amount'];
    $user_trans_fee		= $userLastOrder['user_trans_fee'];
    $user_trans_percent	= $userLastOrder['user_trans_percent'];
    $redirect_url       = $userLastOrder['redirect_url'];
=======
    $orderID			= $_SESSION['allSessionData']['userLastOrder']['orderID'];
    $wallet_id			= $_SESSION['allSessionData']['userLastOrder']['wallet_id'];
    $total				= $_SESSION['allSessionData']['userLastOrder']['total'];
    $amount				= $_SESSION['allSessionData']['userLastOrder']['amount'];
    $user_trans_fee		= $_SESSION['allSessionData']['userLastOrder']['user_trans_fee'];
    $user_trans_percent	= $_SESSION['allSessionData']['userLastOrder']['user_trans_percent'];
    $redirect_url       = $_SESSION['allSessionData']['userLastOrder']['redirect_url'];
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    $total_cost			= round($amount + $user_trans_fee + $user_trans_percent);
    $paypalData			= array(
        'orderID'		=> $orderID,
        'total_cost'	=> $total_cost,
        'redirect_url'  => $redirect_url,
    );
<<<<<<< HEAD
    $detailData         = array(
        'total'         => $total,
    );
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
<<<<<<< HEAD
		<div class="col-12 mb-3" id="order-information">  
=======
		<div class="col-md-4"></div>
		<div class="col-12 col-md-4 mb-3">  
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
			<div class="nk-block">
				<div class="nk-block-head">
					<?php echo theme_view('navigation_breadcrumbs'); ?>
					<div class="nk-block-between-md g-4">
						<div class="nk-block-head-content">
<<<<<<< HEAD
							<h2 class="nk-block-title fw-bold">Complete Your Purchase!</h2>
=======
							<h2 class="nk-block-title fw-bold">MYMI GOLD PURCHASE</h2>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
							<div class="nk-block-des"><p>Confirm and Complete Your MyMI Gold Purchase Information!</p></div>
						</div>
					</div>
                    <hr>
				</div>
			</div> 
		</div>
<<<<<<< HEAD
		<div class="col-12 col-md-4">  
            <div class="row">
                <div class="col-12">
                    <div class="nk-block nk-block-lg">   
                        <div class="card card-bordered pricing">
                            <div class="pricing-head">
                                <div class="pricing-title">
                                    <h4 class="card-title title">MyMI Order Information</h4>
                                    <p class="sub-text"></p>
                                </div>
                                <ul class="pricing-features">
                                    <li><span class="w-30">Wallet ID:</span> <span class="ms-auto" id="walletID">xxxxxxxxxxxxxxxx <a id="viewWalletID" href=""><em class="icon ni ni-eye"></em></a></span></li>
                                    <li><span class="w-30">Order ID:</span> <span class="ms-auto"><?php echo $orderID; ?></span></li>
                                    <li><span class="w-30">Total Coins:</span> <span class="ms-auto"><?php echo number_format($total, 0) . ' MyMI Gold'; ?></span></li>
                                    <li><span class="w-30">Subtotal</span> <span class="ms-auto"><?php echo number_format($amount, 2); ?></span></li>
                                    <li><span class="w-30">Total Fees</span> - <span class="ms-auto"><?php echo number_format($user_trans_fee + $user_trans_percent, 2); ?></span></li>
                                    <li><span class="w-30">Total Costs</span> - <span class="ms-auto"><?php echo number_format($amount + $user_trans_fee + $user_trans_percent, 2); ?></span></li>
                                </ul>
                            </div>
                            <div class="pricing-body">
		                        <?php $this->load->view('User/Wallets/Complete_Purchase/paypal_checkout', $paypalData); ?>
                            </div>
                        </div>      
                        <?php 
                        if ($beta === 1) {
                        ?>
                        <hr>
                        <div class="card card-bordered pricing" id="virtual-credit-card-information">
                            <div class="pricing-head">
                                <div class="pricing-title">
                                    <h4 class="card-title title">Credit Card Information</h4>
                                    <p class="sub-text"><strong>(For Beta Use ONLY!)</strong></p>
                                </div>
                                <ul class="pricing-features">
                                    <li><span class="w-30">Email:</span> <span class="ms-auto">sb-svdso6894499@personal.example.com</span></li>
                                    <li><span class="w-30">Password:</span> <span class="ms-auto">q$6dryDI</span></li>
                                    <li><span class="w-30">First Name:</span> <span class="ms-auto"><?php echo $cuFirstName; ?></span></li>
                                    <li><span class="w-30">Last Name:</span> <span class="ms-auto"><?php echo $cuLastName; ?></span></li>
                                    <li><span class="w-30">Phone Number:</span> <span class="ms-auto"><?php echo $cuPhone; ?></span></li>
                                    <li><span class="w-30">Credit Card Number:</span> <span class="ms-auto">4032 0341 1448 8086</span></li>
                                    <li><span class="w-30">Expiration Date:</span> <span class="ms-auto">07/2025</span></li>
                                    <li><span class="w-30">Security Code:</span> <span class="ms-auto">279</span></li>
                                </ul>
                                <div class="pricing_body">
                                    <div class="pricing-action mt-0">
                                        <p class="sub-text"></p>
                                        <a class="btn btn-primary btn-sm" href="#order-information">Get Started!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>
		</div>	 
        <div class="col-12 col-md-8">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered pricing">
                            <div class="pricing-body">
                                <?php $this->load->view('User/Knowledgebase/Tutorials/Categories/MyMIGold/Completing_Your_Purchase', $detailData); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <div class="card card-bordered pricing">
                        <div class="pricing-head">
                            <div class="pricing-title">
                                <h4 class="card-title title">Need Support?</h4>
                                <p class="sub-text"></p>
                            </div>
                            <div class="pricing_body">
                                <div class="pricing-action mt-0">
                                    <p class="sub-text">If you need further assistance with completing your purchase of MyMI Coins, please contact us via email:</p>
                                    <a class="btn btn-primary btn-sm" href="<?php echo site_url('/Support'); ?>">Contact Support</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
=======
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
		<div class="col-12 col-md-4">  
			<div class="nk-block nk-block-lg">         
				<p class="card-text blog-text text-center">
					<strong>MYMI ORDER INFORMATION</strong>
				</p>   
				<table class="table table-borderless mb-3">
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
		<?php $this->load->view('User/Wallets/Complete_Purchase/paypal_checkout', $paypalData); ?>
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
	</div>
</div>
