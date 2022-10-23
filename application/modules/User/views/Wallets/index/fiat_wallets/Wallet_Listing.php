<?php
echo '
<div class="col-md-6 col-lg-4 mt-3">
	<div class="card card-bordered">
		<div class="nk-wgw">
			<div class="nk-wgw-inner">
				<a class="nk-wgw-name" href="' . site_url('/Bank-Account/Details/' . $accountID) . '">
					<div class="nk-wgw-icon is-default"><i class="icon-wallet"></i></div>
					<h5 class="nk-wgw-title title">' . $accountBankName . ' - ' . $accountName . '</h5>
				</a>
				<div class="nk-wgw-balance">
					<div class="amount">$' . number_format($accountBalance, 2) . '<span class="currency currency-usd">USD</span></div>
					<div class="amount-sm">
						<span class="currency currency-usd">USD</span>
					</div>
				</div>
			</div>
			<div class="nk-wgw-actions">
				<ul>
					<li>
						<!-- <a href="#" data-toggle="modal" data-target="#transactionModal"><i class="icon icon-arrow-up"></i> <span>Track Deposit</span></a> -->
						<!-- <a href="' . site_url('Wallets/Add-Deposit/' . $accountID) . '"><i class="icon icon-arrow-up"></i> <span>Track Deposit</span></a> -->
						<a href="' . site_url('/Bank-Account/Details/' . $accountID) . '"><i class="icon icon-arrow-up"></i> <span>View Details</span></a>
					</li>
					<li>
                        <!-- <a class="trackWithdrawBtn" href="#" data-toggle="modal" data-target="#transactionModal"><i class="icon icon-arrow-down"></i> <span>Track Withdraw</span></a> -->
						<!-- <a href="' . site_url('Wallets/Add-Withdraw/' . $accountID) . '"><i class="icon icon-arrow-up"></i> <span>Track Withdraw</span></a> -->
					</li>
				</ul>
			</div>
			<div class="nk-wgw-more dropdown">
				<a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown"><i class="icon-options full-width"></i></a>
				<div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
					<ul class="link-list-plain sm">
						<li><a href="' . site_url('/Bank-Account/Details/' . $accountID) . '">Details</a></li>   
						<li><a href="" data-toggle="modal" data-target="#deleteWalletModal' . $accountID . '">Delete</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div> 
';
?>


