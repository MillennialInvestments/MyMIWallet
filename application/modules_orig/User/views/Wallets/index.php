<?php
// Plaid Integration
$plaid                                  = 0;
$btnSizing                              = 'pr-2';
$beta                                   = $this->config->item('beta');
$investmentOperations                   = $this->config->item('investmentOperations');
// $plaid                                  = 1;
// print_r($_SESSION['allSessionData']['userAccount']); 
$userAccount                            = $_SESSION['allSessionData']['userAccount']; 
$cuID									= $userAccount['cuID'];
$cuRole									= $userAccount['cuRole'];
$cuEmail								= $userAccount['cuEmail'];
$cuWalletID								= $userAccount['cuWalletID'];
$cuWalletCount							= $userAccount['cuWalletCount'];
$walletID								= $userAccount['walletID'];
$walletTitle							= $userAccount['walletTitle'];
$walletBroker							= $userAccount['walletBroker'];
$walletNickname							= $userAccount['walletNickname'];
$walletDefault							= $userAccount['walletDefault'];
$walletExchange							= $userAccount['walletExchange'];
$walletMarketPair						= $userAccount['walletMarketPair'];
$walletMarket							= $userAccount['walletMarket'];
$walletFunds							= $userAccount['walletFunds'];
$walletInitialAmount					= $userAccount['walletInitialAmount'];
$walletAmount							= $userAccount['walletAmount'];
$walletPercentChange					= $userAccount['walletPercentChange'];
$walletGains							= $userAccount['walletGains'];
$depositAmount							= $userAccount['depositAmount'];
$withdrawAmount							= $userAccount['withdrawAmount'];
$MyMICoinValue							= $userAccount['MyMICoinValue'];
$MyMICCurrentValue						= $userAccount['MyMICCurrentValue'];
$MyMICCoinSum							= $userAccount['MyMICCoinSum'];
$MyMIGoldValue							= $userAccount['MyMIGoldValue'];
$MyMIGCurrentValue						= $userAccount['MyMIGCurrentValue'];
$MyMIGCoinSum							= $userAccount['MyMIGCoinSum'];

        
$walletCost								= $this->config->item('wallet_cost');  			 		// $5
$limit                                  = 4;
$gas_fee								= $this->config->item('gas_fee');
$trans_fee								= $this->config->item('trans_fee');
$trans_percent							= $this->config->item('trans_percent');
$expenses								= ($walletCost * $trans_percent) + $trans_fee;			// Total Fees
$total_fees								= number_format($expenses, 2);
$fee_coins								= round(($total_fees / $MyMICoinValue), 8);
$walletCoins							= ($walletCost / $MyMICoinValue) + $fee_coins;
$remainingCoins							= $MyMICCoinSum - $walletCoins;
if ($MyMIGCoinSum <= 0) {
    $purchaseFiatWalletName				= '#coinModal';
    $purchaseDigitalWalletName			= '#coinModal';
} else {
    $purchaseFiatWalletName				= '#purchaseFiatWalletModal';
    $purchaseDigitalWalletName			= '#purchaseDigitalWalletModal';
}
$getWallets								= $this->wallet_model->get_all_wallets($cuID);
$walletData								= array(
    'getWallets'						=> $getWallets,
    'cuID'								=> $cuID,
    'cuWalletCount'						=> $cuWalletCount,
    'walletID'							=> $walletID,
    'walletTitle'						=> $walletTitle,
    'walletNickname'					=> $walletNickname,
    'walletAmount'						=> $walletAmount,
    'walletFunds'						=> $walletFunds,
    'walletGains'						=> $walletGains,
    'MyMICCoinSum'						=> $MyMICCoinSum,
    'MyMICCurrentValue'					=> $MyMICCurrentValue,
    'MyMIGCoinSum'						=> $MyMIGCoinSum,
    'MyMIGCurrentValue'					=> $MyMIGCurrentValue,
    // 'lastTradeActivity'					=> $lastTradeActivity,
    'walletCoins'						=> $walletCoins,
    'walletCost'                        => $walletCost,
    'limit'                             => $limit,
    'purchaseFiatWalletName'			=> $purchaseFiatWalletName,
    'purchaseDigitalWalletName'			=> $purchaseDigitalWalletName,
    'btnSizing'                         => $btnSizing,
);
$fundAccountData						= array(
    'redirectURL'						=> $this->uri->uri_string(),
    'cuID'								=> $cuID,
    'cuEmail'							=> $cuEmail,
    'walletID'							=> $walletID,
    'walletBroker'						=> $walletBroker,
    'walletNickname'					=> $walletNickname,
    'walletFunds'						=> $walletFunds,
    'walletAmount'						=> $walletAmount,
    'walletInitialAmount'				=> $walletInitialAmount,
    'depositAmount'						=> $depositAmount,
    'withdrawAmount'					=> $withdrawAmount,
    // 'nickname'							=> $walletInfo['nickname'],
);
?>

<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<?php $this->load->view('User/Wallets/index/header', $walletData); ?>
		</div>
        <?php 
        if (empty($this->uri->segment(2))) {
            echo '
            <div class="col-md-12 mb-3">';
                $this->load->view('User/Wallets/index/financial_wallets', $walletData);
            echo '
            </div>
            <div class="col-md-12 mb-3">';
                $this->load->view('User/Wallets/index/credit_wallets', $walletData); 
            echo '
            </div>';
            if ($investmentOperations === 1) {
                echo '
                <div class="col-md-12 mb-3">';
                    $this->load->view('User/Wallets/index/investment_wallets', $walletData); 
                echo '
                </div>
                ';
            }
        } elseif ($this->uri->segment(2) === 'Checking') {
            echo '
            <div class="col-md-12 mb-3">';
                $this->load->view('User/Wallets/index/financial_wallets', $walletData);
            echo '
            </div>
            ';
        } elseif ($this->uri->segment(2) === 'Credit') {
            echo '
            <div class="col-md-12 mb-3">';
                $this->load->view('User/Wallets/index/credit_wallets', $walletData); 
            echo '
            </div>
            ';
        }
        ?>
		<!-- <div class="col-md-12 mb-3">
			<?php //$this->load->view('User/Wallets/index/fiat_wallets', $walletData); ?>
		</div>
        <div class="col-md-12 mb-3">
			<?php //$this->load->view('User/Wallets/index/crypto_wallets', $walletData); ?>
		</div> -->
	</div>
</div>
<div class="modal fade" id="deleteWalletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Delete This Wallet?</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
    			</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this wallet? </p>
			</div>             
			<div class="modal-footer">                                                    
				<a type="button" class="btn btn-success" href="' . site_url('Delete-Wallet/' . $wallets['id']) . '">Yes</a>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
<?php
// foreach ($getWallets->result_array() as $wallets) {
//             if ($wallets['nickname'] !== null) {
//                 $nickname					= ' - ' . $wallets['nickname'];
//             } else {
//                 $nickname					= null;
//             }
//             echo '

// <div class="modal fade" id="deleteWalletModal' . $wallets['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
// 	<div class="modal-dialog modal-md">
// 		<div class="modal-content">
// 			<div class="modal-header">
// 				<h3 class="modal-title" id="exampleModalLabel">Delete This Wallet?</h3>
// 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    // 				<span aria-hidden="true">&times;</span>
    // 			</button>
// 			</div>
// 			<div class="modal-body">
// 				<p>Are you sure you want to delete this wallet? </p>
// 			</div>             
// 			<div class="modal-footer">                                                    
// 				<a type="button" class="btn btn-success" href="' . site_url('Delete-Wallet/' . $wallets['id']) . '">Yes</a>
// 				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
// 			</div>
// 		</div>
// 	</div>
// </div>
// 	';
//         }
?>
<?php
// if ($cuRole === '1') {
// 	echo '<br><br>';
// 	echo '<h2 class="nk-block-title fw-bold">User Data Transfer</h2>';
//     print_r($_SESSION['allSessionData']);
//     echo '<br><br>';
//     print_r($walletData);
//     echo '<br><br>';
//     print_r($fundAccountData);
// }
?>
