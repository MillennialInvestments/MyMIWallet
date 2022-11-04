<?php
$cuID									    = $this->session->userdata('user_id');
$this->db->select('email, username');
$this->db->from('bf_users');
$this->db->where('id', $cuID);
$getUserInfo							    = $this->db->get();
foreach ($getUserInfo->result_array() as $userInfo) {
    $cuEmail							    = $userInfo['email'];
    $cuUsername							    = $userInfo['username'];
}
$tradeForm								    = trim(file_get_contents("php://input"));
$tradeForm								    = json_decode($tradeForm, true);

function submissionEmpty($errno, $errstr)
{
}
if (empty($tradeForm)) {
    $response = array("status" => "error", "message" => "something went wrong in the preliminary phase");
    header('Content-Type: application/json');
    return json_encode($response);
// echo json_encode($response);
} else {
    $order_id                               = $tradeForm['trade']['order_id'];
    $trading_account_id						= $tradeForm['trade']['trading_account_id'];
    $trading_account						= $tradeForm['trade']['trading_account'];
    $trading_account_tag					= $tradeForm['trade']['trading_account_tag'];
    // $order_status                           = $tradeForm['trade']['order_status'];
    $category								= $tradeForm['trade']['category'];
    $trade_type								= $tradeForm['trade']['trade_type'];
    $closed									= $tradeForm['trade']['closed'];
    $symbol_id								= $tradeForm['trade']['symbol_id'];
    $symbol									= $tradeForm['trade']['symbol'];
    $symbol_tag								= $tradeForm['trade']['symbol_tag'];
    $current_price							= $tradeForm['trade']['current_price'];
    $entry_price							= $tradeForm['trade']['entry_price'];
    $close_price							= $tradeForm['trade']['close_price'];
    // $net_gains							    = $tradeForm['trade']['net_gains'];
    $open_date								= $tradeForm['trade']['open_date'];
    $open_time								= $tradeForm['trade']['open_time'];
    $close_date								= $tradeForm['trade']['close_date'];
    $close_time								= $tradeForm['trade']['close_time'];
    $price_target							= $tradeForm['trade']['price_target'];
    $stop_loss								= $tradeForm['trade']['stop_loss'];
    $total_trade_cost						= $tradeForm['trade']['total_trade_cost'];
    $expiration								= $tradeForm['trade']['expiration'];
    $shares									= $tradeForm['trade']['shares'];
    $remaining_shares						= $tradeForm['trade']['remaining_shares'];
    $number_of_contracts					= $tradeForm['trade']['number_of_contracts'];
    $strike									= $tradeForm['trade']['strike'];
    $wallet									= $tradeForm['trade']['wallet'];
    $details								= $tradeForm['trade']['details'];
    $premium								= $tradeForm['trade']['premium'];
    $leverage								= $tradeForm['trade']['leverage'];
    $variation_perc							= $tradeForm['trade']['variation_perc'];
    $variation								= $tradeForm['trade']['variation'];
    $closed_perc							= $tradeForm['trade']['closed_perc'];
    $closed_ref								= $tradeForm['trade']['closed_ref'];
    $closed_list							= $tradeForm['trade']['closed_list'];
    $on_open_fees							= $tradeForm['trade']['on_open_fees'];
    $on_close_fees							= $tradeForm['trade']['on_close_fees'];
    $total_fees								= $tradeForm['trade']['total_fees'];
    $json_user_fields       				= $tradeForm['trade']['json_user_fields'];
    $tradeData								= array(
        'user_id'							=> $cuID,
        'user_email'						=> $cuEmail,
        'username'							=> $cuUsername,
        'order_id'                          => $order_id,
        'trading_account_id'				=> $trading_account_id,
        'trading_account'					=> $trading_account,
        'trading_account_tag'				=> $trading_account_tag,
        // 'order_status'                      => $order_status,
        'category'							=> $category,
        'trade_type'						=> $trade_type,
        'closed'							=> $closed,
        'symbol_id'							=> $symbol_id,
        'symbol'							=> $symbol,
        'symbol_tag'						=> $symbol_tag,
        'current_price'						=> $current_price,
        'entry_price'						=> $entry_price,
        'close_price'						=> $close_price,
        // 'net_gains'						    => $net_gains,
        'open_date'							=> $open_date,
        'open_time'							=> $open_time,
        'close_date'						=> $close_date,
        'close_time'						=> $close_time,
        'price_target'						=> $price_target,
        'stop_loss'							=> $stop_loss,
        'total_trade_cost'					=> $total_trade_cost,
        'expiration'						=> $expiration,
        'shares'							=> $shares,
        // 'remaining_shares'                  => $remaining_shares,
        'number_of_contracts'				=> $number_of_contracts,
        'strike'							=> $strike,
        'wallet'							=> $wallet,
        'details'							=> $details,
        'premium'							=> $premium,
        'leverage'							=> $leverage,
        'variation_perc'					=> $variation_perc,
        'variation'							=> $variation,
        'closed_perc'						=> $closed_perc,
        'closed_ref'						=> $closed_ref,
        'closed_list'						=> $closed_list,
        'on_open_fees'						=> $on_open_fees,
        'on_close_fees'						=> $on_close_fees,
        'total_fees'						=> $total_fees,
        'json_user_fields'					=> $json_user_fields,
    );
    if ($tradeForm['closed_ref'] !== "-1") {
        $this->db->from('bf_users_trades'); 
        $this->db->where('id', $tradeForm['closed_ref']); 
        $getOriginalTrade                   = $this->db->get(); 
        foreach ($getOriginalTrade->result_array() as $origTrade) {
            if (empty($origTrade['closed_list'])) {
                $closed_list                = $tradeForm['id'];
            } else {
                $closed_list                = $origTrade['closed_list'] . ',' . $tradeForm['id'];
            }
        }
        $origTradeNewData                   = array(
            'closed_list'                   => $closed_list,
        );

        $this->db->where('id', $tradeForm['closed_ref']); 
        $this->db->update('bf_users_trades', $origTradeNewData);
    }
    if ($tradeForm['tag'] === 'New') {
        // GET Request Defined Variables
        $tradeData['status']				= 'Active';
        $this->db->insert('bf_users_trades', $tradeData);
        $trade_id 							= $this->db->insert_id();
        //get back the $new_trade_id
        $response = array("status" => "success", "message" => $trade_id);
        header('Content-Type: application/json');
        echo json_encode($response);
        // $this->response($response, REST_Controller::HTTP_OK);
        ob_flush();
        flush();
    } elseif ($tradeForm['tag'] === 'Edit') {
        $status									= 'Active';
        $this->db->where('id', $trade_id);
        $this->db->update('bf_users_trades', $tradeData);

        $response = array("status" => "success", "message" => $trade_id); //The fact that the message is the old trade id right now doesn't mean anything. It's a "checking" script for now - but can come in handy later
        header('Content-Type: application/json');
        return json_encode($response);
    // $this->response($response, REST_Controller::HTTP_OK);
    } elseif ($tradeForm['tag'] === 'Delete') {
        $status									= 'Archived';
        // Add a Date/Time for Purging Old Records after so long
        $deleteData								= array(
            'status'							=> $status,
        );
        $this->db->where('id', $trade_id);
        $this->db->update('bf_users_trades', $deleteData);
        $response = array("status" => "success", "message" => $trade_id); //The fact that the message is the old trade id right now doesn't mean anything. It's a "checking" script for now - but can come in handy later
        header('Content-Type: application/json');
        echo json_encode($response);
        // $this->response($response, REST_Controller::HTTP_OK);
        ob_flush();
        flush();
    } else {
        //For some weird reason the whole else-if got skipped.
        $response = array("status" => "error", "message" => "Exited with no tag matching");
        header('Content-Type: application/json');
        echo json_encode($response);
        // $this->response($response, REST_Controller::HTTP_OK);
        ob_flush();
        flush();
    }
}
?>

