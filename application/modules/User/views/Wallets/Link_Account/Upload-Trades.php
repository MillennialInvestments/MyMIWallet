<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass                                     = empty($errorClass) ? ' error' : $errorClass;
$controlClass                                   = empty($controlClass) ? 'span6' : $controlClass;
$walletType                                     = $this->uri->segment(2);
$walletID                                       = $this->uri->segment(4);
$cuID 					                        = isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuEmail				                        = isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$cuUsername 			                        = isset($current_user->username) && ! empty($current_user->username) ? $current_user->username : '';
$beta                                           = $this->config->item('beta');
if ($beta === 1) {
    $beta                                       = 'Yes';
} else {
    $beta                                       = 'No';
}
$getInactiveWallets                             = $this->wallet_model->get_inactive_wallets($cuID);
$fieldData = array(
    'errorClass'                                => $errorClass,
    'controlClass'                              => $controlClass,
    'cuID'                                      => $cuID,
    'cuEmail'                                   => $cuEmail,
    'cuUsername'                                => $cuUsername,
    'beta'                                      => $beta,
    'walletID'                                  => $walletID,
    'walletType'	                            => $walletType,
);

// $id                         = $id;
echo '
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-12 mb-3">  
            <div class="card card-bordered dashed h-100">
                <div class="nk-wgw-inner">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head-sm">
                            <div class="nk-block-head-content"><h5 class="nk-block-title title">Import Account Trades</h5></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">';
                            $this->load->view('Wallets/Link_Account/Import-Trades', $fieldData);
                        echo '
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
?>

