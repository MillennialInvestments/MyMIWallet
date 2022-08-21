<?php
echo '
	<div class="col-6 col-md-3">
		<div class="card bg-light">
			<div class="nk-wgw sm">
				<a class="nk-wgw-inner" href="' . site_url('/MyMI-Wallet') . '" data-toggle="tooltip" data-placement="bottom" title="View Wallet Details">
					<div class="nk-wgw-name">
						<div class="nk-wgw-icon"><i class="icon-wallet"></i></div>
						<h5 class="nk-wgw-title title">' . $walletTitle . '</h5>
					</div>
					<div class="nk-wgw-balance">
						<div class="amount text-bold">
						<strong>$' . number_format($walletFunds, 2) . '<span class="currency currency-usd">USD</span></strong>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div> 
	';
