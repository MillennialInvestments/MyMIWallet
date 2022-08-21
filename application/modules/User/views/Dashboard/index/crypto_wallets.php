<div class="nk-block nk-block-lg">
	<div class="nk-block-head-xs">
		<div class="nk-block-between-md g-2 py-3">
			<div class="nk-block-head-content"><h5 class="nk-block-title title">Digital Wallets <span class="fw-light">(Crypto Accounts)</span></h5></div>
			<div class="nk-block-head-content"><a href="<?php echo site_url('/Wallets'); ?>" class="link link-primary" data-toggle="tooltip" data-placement="bottom" title="Seel All Wallets">See All</a></div>
		</div>
	</div>
</div>
<div class="row">
<?php
    if ($MyMICCoinSum > 0) {
        echo '
		<div class="col-6 col-md-3">
			<div class="card bg-light">
				<div class="nk-wgw sm">
					<a class="nk-wgw-inner" href="' . site_url('/MyMI-Coin/') . '" data-toggle="tooltip" data-placement="bottom" title="View Wallet Details">
						<div class="nk-wgw-name">
							<div class="nk-wgw-icon"><i class="icon-wallet"></i></div>
							<h5 class="nk-wgw-title title">MyMI Coin</h5>
						</div>
						<div class="nk-wgw-balance">
							<div class="amount">$' . number_format($MyMICCurrentValue, 2) . '<span class="currency currency-usd">USD</span></div>
						</div>
					</a>
				</div>
			</div>
		</div>  
		';
    }
    if ($MyMIGCoinSum > 0) {
        echo '
		<div class="col-6 col-md-3">
			<div class="card bg-light">
				<div class="nk-wgw sm">
					<a class="nk-wgw-inner" href="' . site_url('/MyMI-Gold') . '" data-toggle="tooltip" data-placement="bottom" title="View Wallet Details">
						<div class="nk-wgw-name">
							<div class="nk-wgw-icon"><i class="icon-wallet"></i></div>
							<h5 class="nk-wgw-title title">MyMI Gold</h5>
						</div>
						<div class="nk-wgw-balance">
							<div class="amount">$' . number_format($MyMIGCurrentValue, 2) . '<span class="currency currency-usd">USD</span></div>
						</div>
					</a>
				</div>
			</div>
		</div>  
		';
    }
if ($MyMICCoinSum > 0 || $MyMIGCoinSum > 0) {
    $limit							= 1;
} elseif ($MyMICCoinSum > 0) {
    $limit							= 2;
} elseif ($MyMIGCoinSum > 0) {
    $limit							= 2;
} else {
    $limit							= 3;
}
if ($limit > 0) {
    $getDigitalWallets							= $this->wallet_model->get_digital_wallets($cuID, $limit);
    if (!empty($getDigitalWallets)) {
        foreach ($getDigitalWallets->result_array() as $walletInfo) {
            $wallet_default						= $walletInfo['default_wallet'];
            if ($wallet_default === 'No') {
                $walletID							= $walletInfo['id'];
                $wallet_broker						= $walletInfo['broker'];
                $wallet_type						= $walletInfo['type'];
                $wallet_nickname					= $walletInfo['nickname'];
                if (!empty($wallet_nickname)) {
                    $walletTitle					= $wallet_nickname;
                } else {
                    $walletTitle					= $walletInfo['broker'];
                }
                // Get Individual Wallet Withdrawals
                $getSingleWalletDeposits			= $this->wallet_model->get_single_wallet_deposits($walletID);
                foreach ($getSingleWalletDeposits->result_array() as $walletDeposits) {
                    $walletDeposits					= $walletDeposits['amount'];
                }
                $getSingleWalletWithdrawals			= $this->wallet_model->get_single_wallet_withdrawals($walletID);
                foreach ($getSingleWalletWithdrawals->result_array() as $walletWithdrawals) {
                    $walletWithdrawals				= $walletWithdrawals['amount'];
                }
                $getWalletTrades					= $this->tracker_model->get_wallet_trades($walletID);
                foreach ($getWalletTrades->result_array() as $walletTrades) {
                    $perWalletGains					= $walletTrades['total_net_gains'];
                    if ($perWalletGains > 0) {
                        $perWalletGains				= '<span class="statusGreen">' . $perWalletGains . '</span>';
                    } elseif ($perWalletGains < 0) {
                        $perWalletGains				= '<span class="statusRed">' . $perWalletGains . '</span>';
                    } else {
                        $perWalletGains				= '0.00';
                    }
                }
                $walletInitialAmount				= $walletInfo['amount'] + $walletDeposits - $walletWithdrawals;
                $walletTotalAmount					= $walletInfo['amount'] + $perWalletGains + $walletDeposits - $walletWithdrawals;
                if (!empty($walletInitialAmount)) {
                    $walletPercentChange				= number_format(($walletTotalAmount - $walletInitialAmount) / $walletInitialAmount, 2);
                    if ($walletPercentChange > 0) {
                        $walletPercentChangeDisplay     = '<span class="statusGreen">' . $walletPercentChange . '</span>';
                    } elseif ($walletPerchange < 0) {
                        $walletPercentChangeDisplay     = '<span class="statusGreen">' . $walletPercentChange . '</span>';
                    } else {
                        $walletPercentChangeDisplay     = '0.00%';
                    }
                } else {
                    $walletPercentChangeDisplay     = '0.00%';
                }
                echo '
				<div class="col-6 col-md-3">
					<div class="card bg-light">
						<div class="nk-wgw sm">
							<a class="nk-wgw-inner" href="' . site_url('/Wallet-Details/' . $walletID) . '" data-toggle="tooltip" data-placement="bottom" title="View Wallet Details">
								<div class="nk-wgw-name">
									<div class="nk-wgw-icon"><i class="icon-wallet"></i></div>
									<h5 class="nk-wgw-title title">' . $wallet_broker . '</h5>
								</div>
								<div class="nk-wgw-balance">
									<div class="amount">$' . number_format($walletTotalAmount, 2) . '<span class="currency currency-usd">USD</span></div>
								</div>
							</a>
						</div>
					</div>
				</div> 
					';
            }
        }
        if ($cuWalletCount < 2) {
            echo '
				<div class="col-6 col-md-3">
					<div class="card bg-light">
						<div class="nk-wgw sm">
							<a class="nk-wgw-inner" data-toggle="modal" data-target="' . $purchaseDigitalWalletName . '" data-whatever="' . $walletCoins . '">
								<div class="nk-wgw-name">
									<div class="nk-wgw-icon"><i class="icon-plus"></i></div>
									<h5 class="nk-wgw-title title">Add Digital Wallet</h5>
								</div>
								<div class="nk-wgw-balance">
									<div class="amount text-center">Free Additional Wallet</div>
								</div>
							</a>
						</div>
					</div>
				</div>
				';
        } else {
            echo '  
				<div class="col-6 col-md-3">
					<div class="card bg-light">
						<div class="nk-wgw sm">
							<a class="nk-wgw-inner" data-toggle="modal" data-target="' . $purchaseDigitalWalletName . '" data-whatever="' . $walletCoins . '">
								<div class="nk-wgw-name">
									<div class="nk-wgw-icon"><i class="icon-plus"></i></div>
									<h5 class="nk-wgw-title title">Add Digital Wallet</h5>
								</div>
								<div class="nk-wgw-balance">
									<div class="amount"><strong>Cost: </strong>' . number_format($walletCost, 0) . ' MyMI Gold</div>
								</div>
							</a>
						</div>
					</div>
				</div>
				';
        }
        echo '</div>';
    } else {
        if ($cuWalletCount < 2) {
            echo '
			<div class="col-6 col-md-3">
				<div class="card bg-light">
					<div class="nk-wgw sm">
						<a class="nk-wgw-inner" data-toggle="modal" data-target="' . $purchaseDigitalWalletName . '" data-whatever="' . $walletCoins . '">
							<div class="nk-wgw-name">
								<div class="nk-wgw-icon"><i class="icon-plus"></i></div>
								<h5 class="nk-wgw-title title">Add Digital Wallet</h5>
							</div>
							<div class="nk-wgw-balance">
								<div class="amount text-center">Free Additional Wallet</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			';
        } else {
            echo '  
			<div class="col-6 col-md-3">
				<div class="card bg-light">
					<div class="nk-wgw sm">
						<a class="nk-wgw-inner" data-toggle="modal" data-target="' . $purchaseDigitalWalletName . '" data-whatever="' . $walletCoins . '">
							<div class="nk-wgw-name">
								<div class="nk-wgw-icon"><i class="icon-plus"></i></div>
								<h5 class="nk-wgw-title title">Add Digital Wallet</h5>
							</div>
							<div class="nk-wgw-balance">
								<div class="amount"><strong>Cost: </strong> <small>' . number_format($walletCost, 0) . ' MyMI Gold</small></div>
							</div>
						</a>
					</div>
				</div>
			</div>
			';
        }
        echo '</div>';
    }
} else {
    if ($cuWalletCount < 2) {
        echo '
		<div class="col-6 col-md-3">
			<div class="card bg-light">
				<div class="nk-wgw sm">
					<a class="nk-wgw-inner" data-toggle="modal" data-target="' . $purchaseDigitalWalletName . '" data-whatever="' . $walletCoins . '">
						<div class="nk-wgw-name">
							<div class="nk-wgw-icon"><i class="icon-plus"></i></div>
							<h5 class="nk-wgw-title title">Add Crypto Wallet</h5>
						</div>
						<div class="nk-wgw-balance">
							<div class="amount text-center">Free Additional Wallet</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		';
    } else {
        echo '
		<div class="col-6 col-md-3">
			<div class="card bg-light">
				<div class="nk-wgw sm">
					<a class="nk-wgw-inner" data-toggle="modal" data-target="' . $purchaseDigitalWalletName . '" data-whatever="' . $walletCoins . '">
						<div class="nk-wgw-name">
							<div class="nk-wgw-icon"><i class="icon-plus"></i></div>
							<h5 class="nk-wgw-title title">Add Crypto Wallet</h5>
						</div>
						<div class="nk-wgw-balance">
							<div class="amount"><strong>Cost: </strong> <small>' . number_format($walletCost, 0) . ' MyMI Gold</small></div>
						</div>
					</a>
				</div>
			</div>
		</div>
		';
    }
    echo '</div>';
}
?>
