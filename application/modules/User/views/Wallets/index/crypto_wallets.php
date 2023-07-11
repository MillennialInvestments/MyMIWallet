<div class="nk-block nk-block-lg">
	<div class="nk-block-head-sm">
<<<<<<< HEAD
		<div class="nk-block-head-content"><h5 class="nk-block-title title">Crypto Investment Accounts</h5></div>
	</div>
</div>
<div class="row">
<?php
    $MyMIWalletData									= array(
        'walletTitle'								=> $walletTitle,
        'walletFunds'								=> $walletFunds,
    );
    $this->load->view('User/Wallets/index/crypto_wallets/MyMIGold', $MyMIWalletData);
    $getrCryptoWallets								= $this->wallet_model->get_digital_wallets($cuID, $limit);
    if (!empty($getrCryptoWallets)) {
        foreach ($getrCryptoWallets->result_array() as $walletInfo) {
            $wallet_default							= $walletInfo['default_wallet'];
            if ($wallet_default === 'No') {
                $walletID							= $walletInfo['id'];
                $walletTradingAccountID             = $walletInfo['account_id'];
                $wallet_broker						= $walletInfo['broker'];
                $wallet_type						= $walletInfo['wallet_type'];
=======
		<div class="nk-block-head-content"><h5 class="nk-block-title title">Crypto Accounts</h5></div>
	</div>
</div>
<div class="row">
	<?php
    if ($MyMICCoinSum > 0) {
        echo '
		<div class="col-md-6 col-lg-4 mt-3">
			<div class="card card-bordered">
				<div class="nk-wgw">
					<div class="nk-wgw-inner">
						<a class="nk-wgw-name" href="' . site_url('/MyMI-Coin') . '">
							<div class="nk-wgw-icon is-default"><i class="icon-wallet"></i></div>
							<h5 class="nk-wgw-title title">MyMI Coin</h5>
						</a>
						<div class="nk-wgw-balance">
							<div class="amount">$' . number_format($MyMICCurrentValue, 2) . '<span class="currency currency-usd">USD</span></div>
							<div class="amount-sm">
								' . $walletGains . '<span class="currency currency-usd">USD</span>
							</div>
						</div>
					</div>
					<div class="nk-wgw-actions">
						<ul>
							<li>
								<a href="#" data-toggle="modal" data-target="#depositFundsModal"><i class="icon icon-arrow-up"></i> <span>Deposit Funds</span></a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#withdrawFundsModal"><em class="icon icon-arrow-down"></em><span>Withdraw Funds</span></a>
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
    }
    if ($MyMIGCoinSum > 0) {
        echo '
		<div class="col-md-6 col-lg-4 mt-3">
			<div class="card card-bordered">
				<div class="nk-wgw">
					<div class="nk-wgw-inner">
						<a class="nk-wgw-name" href="' . site_url('/MyMI-Coin') . '">
							<div class="nk-wgw-icon is-default"><i class="icon-wallet"></i></div>
							<h5 class="nk-wgw-title title">MyMI Gold</h5>
						</a>
						<div class="nk-wgw-balance">
							<div class="amount">$' . number_format($MyMIGCurrentValue, 2) . '<span class="currency currency-usd">USD</span></div>
							<div class="amount-sm">
								' . $walletGains . '<span class="currency currency-usd">USD</span>
							</div>
						</div>
					</div>
					<div class="nk-wgw-actions">
						<ul>
							<li>
								<a href="#" data-toggle="modal" data-target="#depositFundsModal"><i class="icon icon-arrow-up"></i> <span>Deposit Funds</span></a>
							</li>
							<li>
								<a href="#" data-toggle="modal" data-target="#withdrawFundsModal"><em class="icon icon-arrow-down"></em><span>Withdraw Funds</span></a>
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
    }
    $getDigitalWallets								= $this->wallet_model->get_digital_wallets($cuID, $limit);
    if (!empty($getDigitalWallets)) {
        foreach ($getDigitalWallets->result_array() as $walletInfo) {
            $wallet_default						= $walletInfo['default_wallet'];
            if ($wallet_default === 'No') {
                $walletID							= $walletInfo['id'];
                $wallet_broker						= $walletInfo['broker'];
                $wallet_type						= $walletInfo['type'];
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                $wallet_nickname					= $walletInfo['nickname'];
                if (!empty($wallet_nickname)) {
                    $addWalletTitle					= $wallet_nickname;
                } else {
                    $addWalletTitle					= $walletInfo['broker'];
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
<<<<<<< HEAD
                    $perWalletGains					= $walletTrades['net_gains'];
=======
                    $perWalletGains					= $walletTrades['total_net_gains'];
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                    if ($perWalletGains > 0) {
                        $perWalletGains				= '<span class="statusGreen">' . $perWalletGains . '</span>';
                    } elseif ($perWalletGains < 0) {
                        $perWalletGains				= '<span class="statusRed">' . $perWalletGains . '</span>';
                    } else {
                        $perWalletGains				= '0.00';
                    }
                }
<<<<<<< HEAD
                $perWalletGains                     = 0;
                $walletInitialAmount				= $walletInfo['amount'] + $walletDeposits - $walletWithdrawals;
                $walletTotalAmount					= $walletInfo['amount'] + $perWalletGains + $walletDeposits - $walletWithdrawals;
                if (!empty($walletInitialAmount)) {
                    // $walletPercentChange				= number_format(($walletTotalAmount - $walletInitialAmount) / $walletInitialAmount, 2);
                    // if ($walletPercentChange > 0) {
                    // 	$walletPercentChangeDisplay     = '<span class="statusGreen">' . $walletPercentChange . '</span>';
                    // } elseif ($walletPerchange < 0) {
                    // 	$walletPercentChangeDisplay     = '<span class="statusGreen">' . $walletPercentChange . '</span>';
                    // } else {
                    // 	$walletPercentChangeDisplay     = '0.00%';
                    // }
=======
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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                } else {
                    $walletPercentChangeDisplay     = '0.00%';
                }
                $walletData							= array(
                    'walletID'						=> $walletID,
                    'addWalletTitle'				=> $addWalletTitle,
                    'wallet_broker'					=> $wallet_broker,
                    'walletTotalAmount'				=> $walletTotalAmount,
<<<<<<< HEAD
                    'perWalletGains'                => $perWalletGains,
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
                );
                $this->load->view('User/Wallets/index/crypto_wallets/Wallet_Listing', $walletData);
            }
        }
<<<<<<< HEAD
    }
    /*
    <strong>Cost: <small>Free</small></strong><br>
    Utilize your Free Wallet to manage an additional brokerage account separately.
    */
    if ($cuWalletCount < 2) {
        $btnID				= 'walletSelectionDigital';
        $elementTitle		= 'Add Free Wallet';
        $elementText		= 'Utilize your Free Wallet to manage an additional brokerage account separately.';
    } else {
        // // Per Wallet - Basis
        // $elementText		= '<strong>Cost:</strong> ' . $walletCost . ' MyMI Gold';
        // if ($MyMIGCoinSum < $walletCost) {
        //     $btnID			= 'purMyMIGold';
        //     $elementTitle	= 'Purchase MyMI Gold';
        // } else {
        //     $btnID			= 'purDigitalWalletBtn';
        //     $elementTitle	= '<em class="icon ni icon-plus"></em> Add Wallet';
        // }
        // Force to Wallet Selection between Manual (Free) and Integration (Premium) Wallet Selection
        $btnID			= 'walletSelectionFreeFiat';
        $elementTitle	= '<em class="icon ni icon-plus"></em> Add Wallet';
        $elementText    = '';
    }
    $purchaseWalletData					= array(
        'btnID'							=> $btnID,
        'elementTitle'					=> $elementTitle,
        'elementText'					=> $elementText,
    );
    $this->load->view('User/Wallets/index/Purchase_Wallet', $purchaseWalletData);
?>
</div>
=======
        if ($cuWalletCount < 2) {
            $btnID				= 'addDigitalWalletBtn';
            $elementTitle		= 'Add Digital Wallet';
            $elementText		= 'Free Additional Wallet';
        } else {
            $elementText		= '<strong>Cost:</strong> ' . $walletCost . ' MyMI Gold';
            if ($MyMIGCoinSum < $walletCost) {
                $btnID			= 'purMyMIGold';
                $elementTitle	= 'Purchase Digital Wallet';
            } else {
                $btnID			= 'purDigitalWalletBtn';
                $elementTitle	= 'Purchase Digital Wallet';
            }
        }
        $purchaseWalletData					= array(
            'btnID'							=> $btnID,
            'elementTitle'					=> $elementTitle,
            'elementText'					=> $elementText,
        );
        $this->load->view('User/Wallets/index/crypto_wallets/Purchase_Wallet', $purchaseWalletData);
        echo '
	</div>
	';
    }
    ?>
</div>

>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
