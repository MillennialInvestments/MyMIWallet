<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass                     = empty($errorClass) ? ' error' : $errorClass;
$controlClass                   = empty($controlClass) ? 'span6' : $controlClass;
$walletType                     = $this->uri->segment(2);
$MyMIGoldCoinSum                = $_SESSION['allSessionData']['userCoinData']['coinSum'];
$premium_wallet_cost            = $this->config->item('wallet_cost');
$fieldData = array(
    'errorClass'                => $errorClass,
    'controlClass'              => $controlClass,
    'walletType'	            => $walletType,
);
if ($walletType === 'Fiat') {
    $walletLink                 = 'Add-Wallet/Free/Fiat';
    if ($premium_wallet_cost > $MyMIGoldCoinSum) {
        $purchaseLinkID         = 'data-toggle="modal" data-target="#walletTransactionModal"';
        $automatedWalletLink    = 'User/Wallets/Purchase_Gold';
        // $purchaseLinkID = 'href="' . site_url('Purchase-MyMI-Gold') . '"';
    } elseif ($premium_wallet_cost < $MyMIGoldCoinSum) {
        $purchaseLinkID         = 'data-toggle="modal" data-target="#walletTransactionModal"';
        $automatedWalletLink    = 'Purchase-Wallet/Fiat';
        // $purchaseLinkID = 'href="' . site_url('Purchase-MyMI-Wallet') . '"';
    }
} elseif ($walletType === 'Digital') {
    $walletLink                 = 'Add-Wallet/Free/Digital';
    if ($premium_wallet_cost > $MyMIGoldCoinSum) {
        $purchaseLinkID         = 'data-toggle="modal" data-target="#walletTransactionModal"';
        $automatedWalletLink    = 'User/Wallets/Purchase_Gold';
        // $purchaseLinkID = 'href="' . site_url('Purchase-MyMI-Gold') . '"';
    } elseif ($premium_wallet_cost < $MyMIGoldCoinSum) {
        $purchaseLinkID         = 'data-toggle="modal" data-target="#walletTransactionModal"';
        $automatedWalletLink    = 'Purchase-Wallet/Digital';
        // $purchaseLinkID = 'href="' . site_url('Purchase-MyMI-Wallet') . '"';
    }
}
?>
<div class="modal-header">
	<h3 class="modal-title" id="useCoinModalLabel">Select Wallet Integration</h3>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	  <span aria-hidden="true">&times;</span>
	</button>
</div> 
<div class="modal-body">
	<div class="row justify-content-center">
		<span class="col-12 text-center">
			<a class="btn btn-primary btn-lg text-white" href="<?php echo site_url($walletLink); ?>">Manually Add Wallet</a>
            <strong class="sub-text text-center">
                Cost: <small><strong>FREE</strong></small>
            </strong>
			<!-- <a class="btn btn-primary btn-lg text-white" id="addFiatWalletBtn" data-toggle="modal" data-target="#transactionModal">Manually Add Wallet</a> -->
		</span>
    </div>
    <div class="row justify-content-center">
		<span class="col-12 text-center">
			<h4 class="py-3">-OR-</h4>
		</span>
    </div>
	<div class="row justify-content-center">
		<span class="col-12 text-center">
			<a class="btn btn-primary btn-lg text-white" <?= $purchaseLinkID; ?>>Automated Add Wallet</a>
            <strong class="sub-text text-center">
                **PREMIUM FEATURE**<br>
                Cost: <small><?php echo $premium_wallet_cost; ?> MyMI Gold</small>
            </strong>
            <p class="help-text">
                
            </p>
		</span>
    </div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
	  Close
	</button>
</div>
<div class="modal fade" id="walletTransactionModal" tabindex="-1" aria-labelledby="trackDepositsModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="loading-content">
            <?php $this->load->view($automatedWalletLink); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById("purchaseFiatWalletBtn").onclick = function() {hideFiatTransactionModal()};

    function hideFiatTransactionModal() {
        $('#transactionModal').modal('hide');
    } 
    document.getElementById("purchaseDigitalWalletBtn").onclick = function() {hideDigitalTransactionModal()};

    function hideDigitalTransactionModal() {
        $('#transactionModal').modal('hide');
    }
</script>
