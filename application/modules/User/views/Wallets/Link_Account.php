<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$errorClass                                     = empty($errorClass) ? ' error' : $errorClass;
$controlClass                                   = empty($controlClass) ? 'span6' : $controlClass;
$cuID 					                        = isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuEmail				                        = isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$cuUsername 			                        = isset($current_user->username) && ! empty($current_user->username) ? $current_user->username : '';
$beta                                           = $this->config->item('beta');
if ($beta === 1) {
    $beta                                       = 'Yes';
} else {
    $beta                                       = 'No';
}
$pageURIC                                       = $this->uri->segment(3);
$fieldData = array(
    'errorClass'                                => $errorClass,
    'controlClass'                              => $controlClass,
    'cuID'                                      => $cuID,
    'cuEmail'                                   => $cuEmail,
    'cuUsername'                                => $cuUsername,
    'beta'                                      => $beta,
    'pageURIC'                                  => $pageURIC,
);
// $id                         = $id;
$this->load->view('User/Wallets/Link_Account/header', $fieldData);
if ($pageURIC === 'Brokerage') {
    $this->load->view('User/Wallets/Link_Account/Brokerage', $fieldData);
} elseif ($pageURIC === 'Details') {
    $this->load->view('User/Wallets/Link_Account/Details', $fieldData);
} elseif ($pageURIC === 'Confirm') {
    $this->load->view('User/Wallets/Link_Account/Confirm', $fieldData);
} elseif ($pageURIC === 'Delete') {
    $this->load->view('User/Wallets/Link_Account/Delete', $fieldData);
} elseif ($pageURIC === 'Edit') {
    $this->load->view('User/Wallets/Link_Account/Edit', $fieldData);
} elseif ($pageURIC === 'Success') {
    $this->load->view('User/Wallets/Link_Account/Success', $fieldData);
} elseif ($pageURIC === 'Upload-Trades') {
    $this->load->View('User/Wallets/Link_Account/Upload-Trades', $fieldData);
} elseif ($pageURIC === 'Successful') {
    $this->load->view('User/Wallets/Link_Account/Successful', $fieldData);
    echo '<hr class="mb-3">';
    $this->load->view('User/Dashboard/index/Announcements');
}

// ---------------------------------------------
// ---------------------------------------------
// ---------------------------------------------


// $order_data                     = array();
// foreach($order_response as $key=>$value) {
//     $open_date                  = date_create($value['enterTime']);
//     $close_date                 = date_create($value['closeTime']);
//     $order_data[$key]           = array(
//         'order_id'              => $value['orderId'],
//         'user_id'               => $cuID,
//         'user_email'            => $cuEmail,
//         'username'              => $cuUsername,
//         'trading_account_id'    => $account_id,
//         'trading_account'       => $broker,
//         'category'              => $value['orderLegCollection']['orderLegType'],
//         'trade_type'            => $value['orderLegCollection']['instrument']['putCall'],
//         'symbol_id'             => $value['orderLegCollection']['instrument']['cusip'],
//         'symbol'                => $value['orderLegCollection']['instrument']['underlyingSymbol'],
//         'entry_price'           => $value['price'],
//         'open_date'             => date_format($open_date, "Y/m/d"),
//         'open_time'             => date_format($open_time, "h:i:s"),
//         'close_date'            => date_format($close_date, "Y/m/d"),
//         'close_time'            => date_format($close_time, "h:i:s"),
//         'shares'                => $value['filledQuantity'],
//         'remaining_shares'      => $value['remainingQuantity'],
//         'total_trade_cost'      => $value['price'] * $value['filledQuantity'],
//         'details'               => $value['orderLegCollection']['instrument']['description'],
//     );
// }
// ---------------------------------------------
// ---------------------------------------------
// ---------------------------------------------
// $userAccountData                = array(
//     'accountID'                 => $accountId,
// );
?>

