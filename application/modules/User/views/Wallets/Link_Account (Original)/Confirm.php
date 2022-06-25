<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass                                     = empty($errorClass) ? ' error' : $errorClass;
$controlClass                                   = empty($controlClass) ? 'span6' : $controlClass;
$walletType                                     = $this->uri->segment(2);
$fieldData = array(
    'errorClass'                                => $errorClass,
    'controlClass'                              => $controlClass,
    'walletType'	                            => $walletType,
);

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
// $id                         = $id;
echo '
<div class="nk-block">
    <div class="row gy-gs">
        <div class="col-12 mb-3">  
            <div class="card card-bordered dashed h-100">
                <div class="nk-wgw-inner">
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head-sm">
                            <div class="nk-block-head-content"><h5 class="nk-block-title title">Account Overview</h5></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-7 col-12">
                            <table class="table table-borderless">
                                <tbody>';
                                foreach ($getInactiveWallets->result_array() as $walletInfo) {
                                    echo '
                                    <tr>
                                        <th>Broker</th>
                                        <td>' . $walletInfo['broker'] . '</td>
                                    </tr>
                                    <tr>
                                        <th>Nickname</th>
                                        <td>' . $walletInfo['nickname'] . '</td>
                                    </tr>
                                    <tr>
                                        <th>Wallet Type:</th>
                                        <td>' . $walletInfo['wallet_type'] . '</td>
                                    </tr>
                                    <tr>
                                        <th>Initial Value</th>
                                        <td>$' . number_format($walletInfo['amount'], 2) . '</td>
                                    </tr>
                                    ';
                                };
                                echo '     
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-5 col-12">
                            <table class="table table-borderless">
                                <tbody>';
                                foreach ($getInactiveWallets->result_array() as $walletinfo) {
                                    echo '
                                    <tr>
                                        <th>Approve / Deny</th>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-block" href="' . site_url('Wallets/Link-Account/Upload-Trades/' . $walletInfo['id']) . '">Approve</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-block" href="' . site_url('Wallets/Link-Account/Delete/' . $walletInfo['id']) . '">Deny</a>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Edit Wallet</th>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-block" href="' . site_url('Wallets/Link-Account/Edit/' . $walletInfo['id']) . '">Edit</a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Delete Wallet</th>
                                        <td class="text-center">
                                            <a class="btn btn-outline-danger btn-block statusRed" href="' . site_url('Wallets/Link-Account/Delete/' . $walletInfo['id']) . '">Remove</a>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    ';
                                };
                                echo '
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';
?>

