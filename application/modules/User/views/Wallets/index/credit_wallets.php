<div class="nk-block nk-block-lg">
	<div class="nk-block-head-sm">
		<div class="nk-block-head-content">
            <h5 class="nk-block-title title">Credit Cards - <?php echo $creditAvailableFMT . ' / ' . $creditLimitFMT . '  <small>(' . $creditLimitPercentage . ' Used)</small>'; ?></h5>
            <a href="<?php echo site_url('/Wallets/Credit'); ?>"><small>View All</small></a>
        </div>
	</div>
</div>
<div class="row">
<?php
    // $this->load->model('User/Wallet_model');
    $getCreditAccounts							    = $this->accounts_model->get_user_credit_accounts($cuID);
    if (!empty($getCreditAccounts)) {
        foreach ($getCreditAccounts->result_array() as $accountInfo) {
            $accountStatus                          = $accountInfo['status']; 
            if ($accountStatus === 2) {

            }
            $accountID							    = $accountInfo['id'];
            $accountStatus  					    = $accountInfo['status'];
            $accountWalletID					    = $accountInfo['wallet_id'];
            $accountType                            = $accountInfo['account_type']; 
            $accountBankName					    = $accountInfo['bank_name'];
            $accountName					        = $accountInfo['nickname'];
            $accountAccountNumber                   = $accountInfo['account_number'];
            $accountBalance                         = $accountInfo['available_balance']; 
            
            $walletData							    = array(
                'accountID'						    => $accountID,
                'accountStatus'					    => $accountStatus,
                'accountWalletID'				    => $accountWalletID,
                'accountType'				        => $accountType,
                'accountBankName'				    => $accountBankName,
                'accountName'				        => $accountName,
                'accountAccountNumber'		        => $accountAccountNumber,
                'accountBalance'		            => $accountBalance,
            );
            $this->load->view('User/Wallets/index/credit_wallets/Wallet_Listing', $walletData);
        }
    }
    /*
    <strong>Cost: <small>Free</small></strong><br>
    Utilize your Free Wallet to manage an additional brokerage account separately.
    */
    // if ($cuWalletCount < 2) {
    //     $btnID				= 'walletSelectionFreeFiat';
    //     $elementTitle		= 'Add Free Wallet';
    //     $elementText		= 'Utilize your Free Wallet to manage an additional brokerage account separately.';
    // } else {
    //     $elementText		= '<strong>Cost:</strong> ' . $walletCost . ' MyMI Gold';
    //     if ($MyMIGCoinSum < $walletCost) {
    //         $btnID			= 'purMyMIGold';
    //         $elementTitle	= 'Purchase MyMI Gold';
    //     } else {
    //         $btnID			= 'purFiatWalletBtn';
    //         $elementTitle	= 'Purchase Fiat Wallet';
    //     }
    // }
    $btnID				                            = 'addCreditAccount';
    $elementTitle		                            = 'Add Credit Card Account';
    $elementText		                            = 'Connect your Credit Card to include in your Financial Forecasting.';
    $purchaseWalletData					            = array(
        'btnID'							            => $btnID,
        'elementTitle'					            => $elementTitle,
        'elementText'					            => $elementText,
    );
    $this->load->view('User/Wallets/index/Purchase_Wallet', $purchaseWalletData);
?>
</div>
