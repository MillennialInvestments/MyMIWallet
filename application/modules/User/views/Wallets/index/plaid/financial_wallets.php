<div class="nk-block nk-block-lg">
	<div class="nk-block-head-sm">
		<div class="nk-block-head-content"><h5 class="nk-block-title title">Financial Banking Accounts</h5></div>
	</div>
</div>
<div class="row">
<?php
    $getBankAccount									= $this->wallet_model->get_user_bank_accounts($cuID);
    if (!empty($getBankAccount)) {
        foreach ($getBankAccount->result_array() as $accountInfo) {
            $accountID							    = $accountInfo['id'];
            $accountWalletID					    = $accountInfo['wallet_id'];
            $accountType                            = $accountInfo['account_type']; 
            $accountBankName					    = $accountInfo['bank_name'];
            $accountName					        = $accountInfo['nickname'];
            $accountRoutingNumber                   = $accountInfo['routing_number'];
            $accountAccountNumber                   = $accountInfo['account_number'];
            $accountBalance                         = $accountInfo['balance']; 
            
            $walletData							    = array(
                'accountID'						    => $accountID,
                'accountWalletID'				    => $accountWalletID,
                'accountType'				        => $accountType,
                'accountBankName'				    => $accountBankName,
                'accountName'				        => $accountName,
                'accountRoutingNumber'		        => $accountRoutingNumber,
                'accountAccountNumber'		        => $accountAccountNumber,
                'accountBalance'		            => $accountBalance,
            );
<<<<<<< HEAD
            $this->load->view('User/Wallets/index/financial_wallets/Wallet_Listing', $walletData);
=======
            $this->load->view('User/Wallets/index/fiat_wallets/Wallet_Listing', $walletData);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
    $btnID				                            = 'addBankAccount';
    $elementTitle		                            = 'Add Banking Account';
<<<<<<< HEAD
    $elementText		                            = 'Connect your Bank Account to determine your current financial liquidity.';
=======
    $elementText		                            = 'Create your Free Financial Account to manage an additional banking account separately.';
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    $purchaseWalletData					            = array(
        'btnID'							            => $btnID,
        'elementTitle'					            => $elementTitle,
        'elementText'					            => $elementText,
    );
    $this->load->view('User/Wallets/index/plaid/fiat_wallets/Purchase_Wallet', $purchaseWalletData);
?>
</div>
