<div class="nk-block nk-block-lg">
	<div class="nk-block-head-sm">
		<div class="nk-block-head-content"><h5 class="nk-block-title title">Bank Accounts</h5></div>
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
            $this->load->view('User/Wallets/index/financial_wallets/Wallet_Listing', $walletData);
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
    $elementText		                            = 'Connect your Bank Account to determine your current financial liquidity.';
    $purchaseWalletData					            = array(
        'btnID'							            => $btnID,
        'elementTitle'					            => $elementTitle,
        'elementText'					            => $elementText,
    );
    $this->load->view('User/Wallets/index/financial_wallets/Purchase_Wallet', $purchaseWalletData);
?>
</div>
