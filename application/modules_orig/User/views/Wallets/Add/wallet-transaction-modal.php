<?php 
$walletType                     = $this->uri->segment(2);
$MyMIGoldCoinSum                = $_SESSION['allSessionData']['userCoinData']['coinSum'];
$premium_wallet_cost            = $this->config->item('wallet_cost');
if ($walletType === 'Fiat') {
    $walletLink                 = 'Add-Wallet/Free/Fiat';
    if ($premium_wallet_cost > $MyMIGoldCoinSum) {
        $automatedWalletLink    = 'User/Wallets/Purchase_Gold';
    } elseif ($premium_wallet_cost < $MyMIGoldCoinSum) {
        $automatedWalletLink    = 'Purchase-Wallet/Fiat';
    }
} elseif ($walletType === 'Digital') {
    $walletLink                 = 'Add-Wallet/Free/Digital';
    if ($premium_wallet_cost > $MyMIGoldCoinSum) {
        $automatedWalletLink    = 'User/Wallets/Purchase_Gold';
    } elseif ($premium_wallet_cost < $MyMIGoldCoinSum) {
        $automatedWalletLink    = 'Purchase-Wallet/Digital';
    }
} else {
    $automatedWalletLink        = '';
}
?>
<div class="modal fade" id="walletTransactionModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="loading-content">
            <?php $this->load->view($automatedWalletLink); ?>
        </div>
    </div>
</div>