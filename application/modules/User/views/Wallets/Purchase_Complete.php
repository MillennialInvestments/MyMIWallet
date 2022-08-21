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
							<h2 class="nk-block-title fw-bold">MYMI GOLD - PURCHASE COMPLETE</h2>
							<div class="nk-block-des"><p>You Have Successfully Purchase Your MyMI Gold!</p></div>
						</div>
					</div>
                    <hr>
				</div>
			</div>
		</div>
		<div class="col-md-4"></div>
		<div class="col-md-4"></div>
		<div class="col-12 col-md-4">  
			<div class="nk-block nk-block-lg">        
				<p class="card-text blog-text text-center">
					<strong>MYMI ORDER INFORMATION</strong>
					<br> 
					<a class="btn btn-primary btn-sm text-center text-white"  id="nextActionBtn" data-toggle="modal" data-target="#nextActionModal"><?php echo $redirectURLText; ?></a> 
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
				<h4 class="card-title display-7">Need Support?</h4>
				<p class="card-text">
					If you need further assistance with completing your purchase of MyMI Coins, please contact us via email:
				</p>                                                                                     
				<a class="btn btn-primary btn-sm" href="mailto:invest@mymillennialinvestments.com">Email Support</a>
			</div>
		</div>
		<div class="col-md-2"></div>
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
