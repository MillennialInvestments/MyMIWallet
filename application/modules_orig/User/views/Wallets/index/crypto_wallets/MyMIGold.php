<?php
echo '
<div class="col-xxl-3 col-lg-4 col-sm-6 mt-3">
	<div class="card card-bordered">
		<div class="nk-wgw">
			<div class="nk-wgw-inner">
				<a class="nk-wgw-name" href="' . site_url('/MyMI-Wallet') . '">
					<div class="nk-wgw-icon is-default"><i class="icon-wallet"></i></div>
					<h5 class="nk-wgw-title title">' . $walletNickname . '</h5>
				</a>
				<div class="nk-wgw-balance">
					<div class="amount">$' . number_format($walletFunds, 2) . '<span class="currency currency-usd">USD</span></div>
					<div class="amount-sm">
						' . $walletGains . '<span class="currency currency-usd">Gold</span>
					</div>
				</div>
			</div>
			<div class="nk-wgw-actions">
				<ul>
                    <li class="' . $btnSizing . '">
                        <a href="' . site_url('/MyMI-Gold') . '"><em class="icon ni ni-menu"></em><span>Details</span></a>
                    </li>
					<li class="' . $btnSizing . '">
						<a class="depositFundsBtn" href="#" data-toggle="modal" data-target="#transactionModal"><em class="icon ni ni-plus"></em> <span>Deposit</span></a>
					</li>
					<li class="' . $btnSizing . '">
						<a class="withdrawFundsBtn" href="#" data-toggle="modal" data-target="#transactionModal"><em class="icon ni ni-minus"></em><span>Withdraw</span></a>
					</li>
				</ul>
			</div>
			<div class="nk-wgw-more dropdown">
				<a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown"><i class="icon-options full-width"></i></a>
				<div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
					<ul class="link-list-plain sm">
						<li><a href="' . site_url('/MyMI-Wallet') . '">Details</a></li>   
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
	';
?>


