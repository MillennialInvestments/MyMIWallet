<?php
// Plaid Integration
// $plaid                                  = 0;
$plaid                                  = 1;
$cuID									= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuRole									= $_SESSION['allSessionData']['userAccount']['cuRole'];
$cuEmail								= $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuWalletID								= $_SESSION['allSessionData']['userAccount']['cuWalletID'];
$cuWalletCount							= $_SESSION['allSessionData']['userAccount']['cuWalletCount'];
$walletID								= $_SESSION['allSessionData']['userAccount']['walletID'];
$walletTitle							= $_SESSION['allSessionData']['userAccount']['walletTitle'];
$walletBroker							= $_SESSION['allSessionData']['userAccount']['walletBroker'];
$walletNickname							= $_SESSION['allSessionData']['userAccount']['walletNickname'];
$walletDefault							= $_SESSION['allSessionData']['userAccount']['walletDefault'];
$walletExchange							= $_SESSION['allSessionData']['userAccount']['walletExchange'];
$walletMarketPair						= $_SESSION['allSessionData']['userAccount']['walletMarketPair'];
$walletMarket							= $_SESSION['allSessionData']['userAccount']['walletMarket'];
$walletFunds							= $_SESSION['allSessionData']['userAccount']['walletFunds'];
$walletInitialAmount					= $_SESSION['allSessionData']['userAccount']['walletInitialAmount'];
$walletAmount							= $_SESSION['allSessionData']['userAccount']['walletAmount'];
$walletPercentChange					= $_SESSION['allSessionData']['userAccount']['walletPercentChange'];
$walletGains							= $_SESSION['allSessionData']['userAccount']['walletGains'];
$depositAmount							= $_SESSION['allSessionData']['userAccount']['depositAmount'];
$withdrawAmount							= $_SESSION['allSessionData']['userAccount']['withdrawAmount'];
$MyMICoinValue							= $_SESSION['allSessionData']['userAccount']['MyMICoinValue'];
$MyMICCurrentValue						= $_SESSION['allSessionData']['userAccount']['MyMICCurrentValue'];
$MyMICCoinSum							= $_SESSION['allSessionData']['userAccount']['MyMICCoinSum'];
$MyMIGoldValue							= $_SESSION['allSessionData']['userAccount']['MyMIGoldValue'];
$MyMIGCurrentValue						= $_SESSION['allSessionData']['userAccount']['MyMIGCurrentValue'];
$MyMIGCoinSum							= $_SESSION['allSessionData']['userAccount']['MyMIGCoinSum'];

        
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
        if ($plaid === '0') {
            ?>
		<div class="col-md-12 mb-3">
			<?php $this->load->view('User/Wallets/index/fiat_wallets', $walletData); ?>
		</div>
		<div class="col-md-12 mb-3">
			<?php $this->load->view('User/Wallets/index/crypto_wallets', $walletData); ?>
		</div>
		<hr>
		<div class="col-md-12">			
			<?php $this->load->view('User/Wallets/index/wallet_transactions', $walletData); ?>
		</div>
        <?php
        } else {
            ?>
		<div class="col-md-12 mb-3">
			<?php $this->load->view('User/Wallets/index/plaid/fiat_wallets', $walletData); ?>
		</div>
        <div class="col-md-12 mb-3">
			<?php $this->load->view('User/Wallets/index/plaid/crypto_wallets', $walletData); ?>
		</div>
        <?php
        }
        ?>
	</div>
</div>

<?php
foreach ($getWallets->result_array() as $wallets) {
            if ($wallets['nickname'] !== null) {
                $nickname					= ' - ' . $wallets['nickname'];
            } else {
                $nickname					= null;
            }
            echo '

<div class="modal fade" id="deleteWalletModal' . $wallets['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				<table class="table table-borderless pt-3">
					<tbody>
						<tr>
							<th>Wallet Name:</th>
							<td>' . $wallets['broker'] .  $nickname . '</td>
						</tr>
					</tbody>
				</table>
			</div>             
			<div class="modal-footer">                                                    
				<a type="button" class="btn btn-success" href="' . site_url('Delete-Wallet/' . $wallets['id']) . '">Yes</a>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
	';
        }
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
