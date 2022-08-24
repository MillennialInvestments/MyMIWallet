<?php
//! Security issue
//TODO: perform scan to see whether this user has a table and the wallets are available
$cuID									    = $this->session->userdata('user_id');
$this->db->select('email, username');
$this->db->from('bf_users');
$this->db->where('id', $cuID);
$getUserInfo							    = $this->db->get();
foreach ($getUserInfo->result_array() as $userInfo) {
    $cuEmail							    = $userInfo['email'];
    $cuUsername							    = $userInfo['username'];
}
$tradeForm								    = trim(file_get_contents('php://input'));
$tradeForm								    = json_decode($tradeForm, true);

$trade = $tradeForm['trade'];

$message = '';
/**
 * What the response of this api will look like;
 * @var '1' | '0'
 */
$status = '0'; 

$response = array('status' => $status, 'message'=> $message);

function throwErr($errMsg){
    $response['message'] = $errMsg;
    header('Content-Type: application/json');
    echo json_encode($response);
    ob_flush();
    flush();
    exit;
}

function strIsArray($str){
    return (substr_count($str,"[") == 1 && strpos($str,"[") == 0) && (substr_count($str,"]") == 1 && strrpos($str,"[",-0) == (strlen($str)-1));          
}

function checkAndPrepTrade($trade){
    $checkedTrade = [];
    foreach($trade as $key => $value) {
            //Here we are checking that the data we get is completely in string format
            if(empty($trade[$key])){ 
                $checkedTrade['key'] = '';
            }
            else{
                if(gettype($value) != "string") throwErr('The '+$key+' field does not hold a string value');

                switch($key){
                    case 'json_user_fields':
                        if(json_decode($value) == null) throwErr('The juf field is not valid json');                    
                        break;                   
                    case 'saved_sorting':
                        if(intval($value) == 0) throwErr('The saved sorting is not a valid integer or is 0');
                        break;
                    case 'closed_ref':
                        if(intval($value)!= 0 && intval($value)<-1) throwErr('The closed ref is a negative integer');
                        break;
                    case 'closed_list':
                        if(!strIsArray($value)) throwErr("The closed list is not a valid array");
                        break;
                    case 'stats_interpolated_fields':
                            if(!strIsArray($value)) throwErr("The closed list is not a valid array");
                            break;
                            
                    /*
                    TODO: Do more checking: 
                    - Wallet ownership and whether the given wallet can be edited. 
                    - Valid closed_list ids
                    */
                }
                //Do not include useless keys in the object
                switch($key){
                    case 'legend':
                    case 'pseudo_id':
                    case 'save':
                    case 'cancel':
                    case 'delete':
                        break;
                    default:
                        $checkedTrade[$key] = $value;
                }
            }
        }
    return $checkedTrade; 
}

if (empty($tradeForm)) {
    throwErr('The received obj was empty');
} else {
   switch ($tradeForm['tag']){
    case 'New':
        if(count($this->db->get_where('bf_users_trades', array('id' => $trade["id"]))->result_array()) != 0) 
        throwErr('Trade with '+ $trade["id"]+' already exists');

        if($trade['pseudo_id'] == $trade['id'])
        throwErr('New trade contained equal id and pseudoId');
        //Clean all the unnecessary elements
        unset($trade['id']);
        

        //Check the validity of the given trade and create the db tradeobj
        $newTrade = checkAndPrepTrade($trade);

        //Add user information
        $postedTrade = $newTrade;
        $postedTrade['user_id'] = $cuID;
        $postedTrade['user_email'] = $cuEmail;
        $postedTrade['username'] = $cuUsername;

        $parentList = [];
        if($trade["closed_ref"] != "-1"){
            $parentList = $this->db->get_where('bf_users_trades', array('id' => $trade["closed_ref"]))->result_array();
        }

        //Insert the row
        $this->db->insert('bf_users_trades', $tradeData);
        $newTrade["id"] = $newTrade["pseudo_id"] = $this->db->insert_id();

        //The parent trade will have either already appeared or still have to come up.
        if (count($parentList) == 1){
            //It already appeared
            //It's going to be edited in the frontend and saved next. 
            //-> The frontend WILL edit the closelist and send the change to the backend,
            // here we assume this doesn't happen and change it anyways
            
            //We can expect the list to be in the right format because we don't allow otherwise - FUTUREBUG
            $childList = json_decode($parentList[0]['closed_list']);
            if(array_search($trade['pseudo_id'],$childList)) array_splice(
                $childList,
                array_search($trade['pseudo_id'],$childList),
                1,
                $newTrade['id']
            );
            else array_push($childList, $newTrade['id']);

            $this->db->set('closed_list',json_encode($childList) );
            //We already know this yelds one result
            $this->db->where('id', $trade["closed_ref"]);
            $this->db->update('bf_users_trades');
           
        }else if(count($parentList) > 1){
            //! Log error
        }
           
        //If the parent comes afterward, it will already have been updated in the frontend with the necessary information
        //If it comes before, then it either has no children, or they will 
        //REFER TO WEIRDS#1
        //!current
        //TODO: If the child comes first, then make sure that the parent updates all the pseudoids in the refs of the closedLists coming through
        //!current
        if($trade["closed_list"] != [])
        //...


        $status = "1";
        $response['message'] = json_encode($newTrade);
        header('Content-Type: application/json');
        echo json_encode($response);
        ob_flush();
        flush();
        exit;
        

        break;
    case 'Edit':
        if($trade['id'] == '') throwErr("Received to-edit trade with no id");
        if($trade['id'] != $trade['pseudo_id']) throwErr("Received to-edit trade with no id");

        $checkedTrade = checkAndPrepTrade($trade);

        break;
    case 'Delete':
        break;
    default:
        throwErr('The tag obj was not of type New|Edit|Delete');
   }
   
   
   
   
   
   
    //The id of the order coming from the broker (such as 110238aefi3482j)
    $order_id                               = $tradeForm['trade']['order_id'];
    //Trading account bundle
    $trading_account_id						= $tradeForm['trade']['trading_account_id'];
    $trading_account						= $tradeForm['trade']['trading_account'];
    $trading_account_tag					= $tradeForm['trade']['trading_account_tag'];
    // $order_status                           = $tradeForm['trade']['order_status'];
    
    //Enum: equity | option_buy ...
    $category								= $tradeForm['trade']['category'];
    //Enum buy | sell | call | put ... 
    $trade_type								= $tradeForm['trade']['trade_type'];
    // true
    $closed									= $tradeForm['trade']['closed'];
    // symbol bundle
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
    // $remaining_shares						= $tradeForm['trade']['remaining_shares'];
    $number_of_contracts					= $tradeForm['trade']['number_of_contracts'];
    $strike									= $tradeForm['trade']['strike'];
    // $wallet									= $tradeForm['trade']['wallet'];
    $details								= $tradeForm['trade']['details'];
    $premium								= $tradeForm['trade']['premium'];
    $leverage								= $tradeForm['trade']['leverage'];
    $variation_perc							= $tradeForm['trade']['variation_perc'];
    $variation								= $tradeForm['trade']['variation'];
    // $closed_perc							= $tradeForm['trade']['closed_perc'];
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
        // 'wallet'							=> $wallet,
        'details'							=> $details,
        'premium'							=> $premium,
        'leverage'							=> $leverage,
        'variation_perc'					=> $variation_perc,
        'variation'							=> $variation,
        // 'closed_perc'						=> $closed_perc,
        'closed_ref'						=> $closed_ref,
        'closed_list'						=> $closed_list,
        'on_open_fees'						=> $on_open_fees,
        'on_close_fees'						=> $on_close_fees,
        'total_fees'						=> $total_fees,
        'json_user_fields'					=> $json_user_fields,
    );
    if ($closed_ref !== '-1') {
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
        $response = array('status' => 'success', 'message' => $trade_id);
        header('Content-Type: application/json');
        echo json_encode($response);
        // $this->response($response, REST_Controller::HTTP_OK);
        ob_flush();
        flush();
    } elseif ($tradeForm['tag'] === 'Edit') {
        $status									= 'Active';
        $this->db->where('id', $order_id);
        $this->db->update('bf_users_trades', $tradeData);

        $response = array('status' => 'success', 'message' => $order_id); //The fact that the message is the old trade id right now doesn't mean anything. It's a 'checking' script for now - but can come in handy later
        header('Content-Type: application/json');
        return json_encode($response);
    // $this->response($response, REST_Controller::HTTP_OK);
    } elseif ($tradeForm['tag'] === 'Delete') {
        $status									= 'Archived';
        // Add a Date/Time for Purging Old Records after so long
        $deleteData								= array(
            'status'							=> $status,
        );
        $this->db->where('id', $order_id);
        $this->db->update('bf_users_trades', $deleteData);
        $response = array('status' => 'success', 'message' => $order_id); //The fact that the message is the old trade id right now doesn't mean anything. It's a 'checking' script for now - but can come in handy later
        header('Content-Type: application/json');
        echo json_encode($response);
        // $this->response($response, REST_Controller::HTTP_OK);
        ob_flush();
        flush();
    } else {
        //For some weird reason the whole else-if got skipped.
        $response = array('status' => 'error', 'message' => 'Exited with no tag matching');
        header('Content-Type: application/json');
        echo json_encode($response);
        // $this->response($response, REST_Controller::HTTP_OK);
        ob_flush();
        flush();
    }
}
?>

