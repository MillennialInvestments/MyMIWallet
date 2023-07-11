<div class="nk-block nk-block-lg">
	<div class="nk-block-head-sm">
		<div class="nk-block-head-content"><h5 class="nk-block-title title">Investment &amp; Accounts</h5></div>
	</div>
</div>
<div class="row">
<?php
    // $this->load->model('User/Wallet_model');
    $getInvestmentAccounts						    = $this->accounts_model->get_user_invest_accounts($cuID);
    if (!empty($getInvestmentAccounts)) {
        foreach ($getInvestmentAccounts->result_array() as $accountInfo) {
            $accountID							    = $accountInfo['id'];
            $accountWalletID					    = $accountInfo['wallet_id'];
            $accountType                            = $accountInfo['account_type']; 
            $accountBroker  					    = $accountInfo['broker'];
            $accountName					        = $accountInfo['nickname'];
            $accountAccountNumber                   = $accountInfo['account_id'];
            $accountNetWorth                        = $accountInfo['net_worth']; 
            
            $walletData							    = array(
                'accountID'						    => $accountID,
                'accountWalletID'				    => $accountWalletID,
                'accountType'				        => $accountType,
                'accountBroker'				        => $accountBroker,
                'accountName'				        => $accountName,
                'accountAccountNumber'		        => $accountAccountNumber,
                'accountNetWorth'		            => $accountNetWorth,
            );
            $this->load->view('User/Wallets/index/investment_wallets/Wallet_Listing', $walletData);
        }
    }
    /*
    <strong>Cost: <small>Free</small></strong><br>
    Utilize your Free Wallet to mag dzrefcnage an additional brokerage account separately.
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
    $btnID				                            = 'addInvestAccount';
    $elementTitle		                            = 'Add Investment Account';
    $elementText		                            = 'Connect your Investment Account to include to your Financial Investments.';
    $purchaseWalletData					            = array(
        'btnID'							            => $btnID,
        'elementTitle'					            => $elementTitle,
        'elementText'					            => $elementText,
    );
    $this->load->view('User/Wallets/index/investment_wallets/Purchase_Wallet', $purchaseWalletData);
?>
</div>
