<?php
$cuID						= $_SESSION['allSessionData']['userAccount']['cuID'];
$orderID					= $this->uri->segment(3);
$wallet_id					= $_SESSION['allSessionData']['userLastCompletedOrder']['wallet_id'];
$total						= $_SESSION['allSessionData']['userLastCompletedOrder']['total'];
$amount						= $_SESSION['allSessionData']['userLastCompletedOrder']['amount'];
$user_trans_fee				= $_SESSION['allSessionData']['userLastCompletedOrder']['user_trans_fee'];
$user_trans_percent			= $_SESSION['allSessionData']['userLastCompletedOrder']['user_trans_percent'];
$redirect_url               = $_SESSION['allSessionData']['userLastCompletedOrder']['redirect_url'];
$total_fees					= $user_trans_fee + $user_trans_percent;
if ($redirect_url === 'Purchase-Wallet/Fiat') {
    $redirectURLText        = 'Create Fiat Wallet';
} elseif ($redirect_url === 'Purchase-Wallet/Digital') {
    $redirectURLText        = 'Create Crypto Wallet';
} else {
    $redirect_url           = '/Wallets'; 
    $redirectURLText        = 'View Wallets';
}
$detailData                 = array(
    'total'                 => $total,
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
		<div class="col-12 mb-3">  
			<div class="nk-block"> 
				<div class="nk-block-head">
					<?php echo theme_view('navigation_breadcrumbs'); ?>
					<div class="nk-block-between-md g-4">
						<div class="nk-block-head-content">
							<h2 class="nk-block-title fw-bold">Purchase Complete!</h2>
							<div class="nk-block-des"><p>You Have Successfully Purchase Your MyMI Gold!</p></div>
						</div>
					</div>
                    <hr>
				</div>
			</div>
		</div>
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
                                <!-- <div class="card-text">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="h4 fw-500">5 <small>MyMIG</small></span>
                                            <span class="sub-text">Per Wallet</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="h4 fw-500">Monthly</span>
                                            <span class="sub-text">Renewal</span>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="pricing-body">
                                <div class="pricing-action mt-0">
                                    <p class="sub-text">Get Started By Clicking Below</p>
                                    <a class="btn btn-primary btn-sm text-center text-white"  id="nextActionBtn" data-toggle="modal" data-target="#nextActionModal"><?php echo $redirectURLText; ?></a> 
                                </div>
                            </div>
                        </div>    
                        <hr>
                        <div class="card card-bordered pricing">
                            <div class="pricing-head">
                                <div class="pricing-title">
                                    <h4 class="card-title title">Need Support</h4>
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
		</div>
        <div class="col-12 col-md-8">
            <div class="row">
                <div class="col-12">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered pricing">
                            <div class="pricing-body">
                                <?php $this->load->view('User/Knowledgebase/Tutorials/Categories/MyMIGold/Purchase_Complete', $detailData); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<div class="modal fade" id="nextActionModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="loading-content">
			<?php $this->load->view('User/Dashboard/index/modal-loading-page'); ?>
		</div>
		<div class="modal-content" id="nextActionContainer">
		</div>
    </div>
</div>
<script>
	$('#nextActionBtn').click(function(e) {
		// prevent the default action when a nav button link is clicked
		e.preventDefault();
		// ajax query to retrieve the HTML view without refreshing the page.
		// $('#loading-image').show();
		$.ajax({
			type: 'get',
			url: <?php echo '\'' . site_url($redirect_url) . '\''; ?>,
			dataType: 'html',
			beforeSend: function() {
				$('#loading-content').show(); 
				$('#nextActionContainer').hide(); 
			},
			// complete: function(){
			// 	$('#loading-content').hide(); 
			// },
			success: function (html) {
				// success callback -- replace the div's innerHTML with
				// the response from the server.
				$('#loading-content').hide(); 
				$('#nextActionContainer').show(); 
				$('#nextActionContainer').html(html);
			}
		});
	});	
</script>
