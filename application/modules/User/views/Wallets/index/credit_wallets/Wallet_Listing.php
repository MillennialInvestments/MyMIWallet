<?php
echo '
<div class="col-xxl-3 col-lg-4 col-sm-6 mt-3">
	<div class="card card-bordered">
		<div class="nk-wgw">
			<div class="nk-wgw-inner">
				<a class="nk-wgw-name" href="' . site_url('Wallets/Credit/Details/' . $accountID) . '">
					<div class="nk-wgw-icon is-default"><i class="icon ni ni-wallet"></i></div>';
                    if ($accountStatus === 2) {
                        echo '<h5 class="nk-wgw-title title">' . $accountName . ' <small>(Closed)</small></h5>';
                    } else {
                        echo '<h5 class="nk-wgw-title title">' . $accountName . '</h5>';
                    }
                echo '
				</a>
				<div class="nk-wgw-balance">
					<div class="amount">$' . number_format($accountBalance, 2) . '<span class="currency currency-usd">USD</span></div>
					<div class="amount-sm">
						<span class="currency currency-usd">USD</span>
					</div>
				</div>
			</div>
			<div class="nk-wgw-actions">
                <ul class="vertical-divider">
					<li class="' . $btnSizing . '">
						<a href="' . site_url('Wallets/Credit/Details/' . $accountID) . '"><i class="icon ni ni-list-index mr-1"></i> <span>Details</span></a>
					</li>
					<li class="' . $btnSizing . '">
                        <a href="' . site_url('Wallets/Credit/Edit/Account/' . $accountID) . '"><i class="icon ni ni-pen2 mr-1"></i> <span>Edit</span></a>
					</li>
					<li class="' . $btnSizing . '">
                        <a href="#" data-toggle="modal" data-target="#deleteWalletModal' . $accountID . '"><i class="icon ni ni-cross mr-1"></i> <span>Delete</span></a>
					</li>
				</ul>
			</div>
			<div class="nk-wgw-more dropdown">
				<a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown">
                    <i class="icon ni ni-more-h full-width"></i>
                </a>
				<div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
					<ul class="link-list-plain sm">
						<li><a href="' . site_url('Wallets/Credit/Details/' . $accountID) . '">Details</a></li>   
						<li><a href="' . site_url('/Wallets/Credit/Edit/Account/' . $walletID) . '">Edit</a></li>
						<li><a href="" data-toggle="modal" data-target="#deleteWalletModal' . $accountID . '">Delete</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div> 
';
?>


