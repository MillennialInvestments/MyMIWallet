<div class="nk-block nk-block-lg">
	<div class="nk-block-head-xs">
		<div class="nk-block-between-md g-2 py-3">
			<div class="nk-block-head-content"><h5 class="nk-block-title title">Fiat Wallets <span class="fw-light">(Trading Accounts)</span></h5></div>
			<div class="nk-block-head-content"><a href="<?php echo site_url('/Wallets'); ?>" class="link link-primary" data-toggle="tooltip" data-placement="bottom" title="Seel All Wallets">See All</a></div>
		</div>
	</div>
</div>
<div class="row">
<?php
    $MyMIWalletData								= array(
        'walletTitle'							=> $walletTitle,
        'walletFunds'							=> $walletFunds,
    );
    $this->load->view('User/Dashboard/index/fiat_wallets/MyMIWallet', $MyMIWalletData);
    $getFiatWallets								= $this->wallet_model->get_fiat_wallets($cuID, $limit);
    if (!empty($getFiatWallets)) {
        foreach ($getFiatWallets->result_array() as $walletInfo) {
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
                $walletData							= array(
                'walletID'						=> $walletID,
                'wallet_broker'					=> $wallet_broker,
                'walletTotalAmount'				=> $walletTotalAmount,
            );
                $this->load->view('User/Dashboard/index/fiat_wallets/Wallet_Listing', $walletData);
            }
            if ($cuWalletCount < 2) {
                $btnID				= 'addFiatWalletBtn';
                $elementTitle		= 'Add Fiat Wallet';
                $elementText		= 'Free Additional Wallet';
            } else {
                $elementText		= '<strong>Cost:</strong> ' . $walletCost . ' MyMI Gold';
                if ($MyMIGCoinSum < $walletCost) {
                    $btnID			= 'purMyMIGold';
                    $elementTitle	= 'Purchase Fiat Wallet';
                } else {
                    $btnID			= 'purFiatWalletBtn';
                    $elementTitle	= 'Purchase Fiat Wallet';
                }
            }
            $purchaseWalletData					= array(
                'btnID'							=> $btnID,
                'elementTitle'					=> $elementTitle,
                'elementText'					=> $elementText,
            );
            $this->load->view('User/Dashboard/index/fiat_wallets/Purchase_Wallet', $purchaseWalletData);
            echo '
		</div>
		';
        }
    }
?>
</div>
