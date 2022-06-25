<?php
echo '
<div class="col-md-6 col-lg-4 mt-3">
	<div class="card card-bordered">
		<div class="nk-wgw">
			<div class="nk-wgw-inner">
				<a class="nk-wgw-name" href="' . site_url('/Wallet-Details/' . $walletID) . '">
					<div class="nk-wgw-icon is-default"><i class="icon-wallet"></i></div>
					<h5 class="nk-wgw-title title">' . $addWalletTitle . '</h5>
				</a>
				<div class="nk-wgw-balance">
					<div class="amount">$' . number_format($walletTotalAmount, 2) . '<span class="currency currency-usd">USD</span></div>
					<div class="amount-sm">
						' . $perWalletGains . '<span class="currency currency-usd">USD</span>
					</div>
				</div>
			</div>
			<div class="nk-wgw-actions">
				<ul>
					<li>
						<a class="trackDepositBtn" href="#" data-toggle="modal" data-target="#transactionModal"><i class="icon icon-arrow-up"></i> <span>Track Deposit</span></a>
					</li>
					<li>
						<a class="trackWithdrawBtn" href="#" data-toggle="modal" data-target="#transactionModal"><i class="icon icon-arrow-down"></i> <span>Track Withdraw</span></a>
					</li>
				</ul>
			</div>
			<div class="nk-wgw-more dropdown">
				<a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown"><i class="icon-options full-width"></i></a>
				<div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
					<ul class="link-list-plain sm">
						<li><a href="' . site_url('/Wallet-Details/' . $walletID) . '">Details</a></li>   
						<li><a href="' . site_url('/Edit-Wallet/' . $walletID) . '">Edit</a></li>
						<li><a href="" data-toggle="modal" data-target="#deleteWalletModal' . $walletID . '">Delete</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div> 
';
?>


