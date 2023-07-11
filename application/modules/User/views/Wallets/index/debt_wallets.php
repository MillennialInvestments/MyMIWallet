<div class="nk-block nk-block-lg">
	<div class="nk-block-head-sm">
		<div class="nk-block-head-content">
            <h5 class="nk-block-title title">Debt Accounts - <?php echo $debtSummaryFMT; ?></h5>
            <a href="<?php echo site_url('/Wallets/Debt'); ?>"><small>View All</small></a>
        </div>
	</div>
</div>
<div class="row">
<?php
    // $this->load->model('User/Wallet_model');
    $getDebtAccounts							    = $this->accounts_model->get_user_debt_accounts($cuID);
    if (!empty($getDebtAccounts)) {
        foreach ($getDebtAccounts->result_array() as $accountInfo) {
            $accountID							    = $accountInfo['id'];
            $accountWalletID					    = $accountInfo['wallet_id'];
            $accountType                            = $accountInfo['account_type']; 
            $accountBankName					    = $accountInfo['debtor'];
            $accountName					        = $accountInfo['nickname'];
            $accountAccountNumber                   = $accountInfo['account_number'];
            $accountBalance                         = $accountInfo['available_balance']; 
            
            $walletData							    = array(
                'accountID'						    => $accountID,
                'accountWalletID'				    => $accountWalletID,
                'accountType'				        => $accountType,
                'accountBankName'				    => $accountBankName,
                'accountName'				        => $accountName,
                'accountAccountNumber'		        => $accountAccountNumber,
                'accountBalance'		            => $accountBalance,
            );
            $this->load->view('User/Wallets/index/debt_wallets/Wallet_Listing', $walletData);
        }
    }
    $btnID				                            = 'addDebtAccount';
    $elementTitle		                            = 'Add Debt Account';
    $elementText		                            = 'Create an account for your Debt to include to your Financial Forecasting.';
    $purchaseWalletData					            = array(
        'btnID'							            => $btnID,
        'elementTitle'					            => $elementTitle,
        'elementText'					            => $elementText,
    );
    $this->load->view('User/Wallets/index/Purchase_Wallet', $purchaseWalletData);
?>
</div>
