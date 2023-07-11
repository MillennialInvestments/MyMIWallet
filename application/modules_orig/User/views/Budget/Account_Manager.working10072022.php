<?php
$orderForm								            = trim(file_get_contents("php://input"));
$orderForm								            = json_decode($orderForm, true);

// GET Request Defined Variables
$status									            = '1';
$beta									            = $orderForm['beta'];
$user_id								            = $orderForm['user_id'];
$user_email 							            = $orderForm['user_email'];
$username    							            = $orderForm['username'];
$nickname    							            = $orderForm['nickname'];
$recurring_account         	                        = $orderForm['recurring_account'];
$account_type  							            = $orderForm['account_type'];
$net_amount							                = str_replace(',', '', $orderForm['net_amount']);
// $gross_amount   	                                = str_replace(',', '', $orderForm['gross_amount']);
$source_type    					                = $orderForm['source_type'];
$intervals    							            = $orderForm['intervals'];
$designated_date						            = $orderForm['designated_date'];
$month                                              = date("m", strtotime($designated_date));
$day                                                = date("d", strtotime($designated_date));
$year                                               = date("Y", strtotime($designated_date));
$accountData							            = array(
    'status'							            => $status,
    'beta'								            => $beta,
    'created_by'						            => $user_id,
    'created_by_email'	    			            => $user_email,
    'unix_timestamp'				                => time(),
    'month'                                         => $month, 
    'day'                                           => $day,
    'year'                                          => $year,
    'time'                                          => date("H:i:s A"),
    'username'							            => $username,
    'name'							                => $nickname,
    'net_amount'						            => $net_amount,
    // 'gross_amount'						            => $gross_amount,
    'recurring_account'				                => $recurring_account,
    'account_type'					                => $account_type,
    'source_type'					                => $source_type,
    'intervals'							            => $intervals,
    'designated_date'			                    => $designated_date,
);
return $this->db->insert('bf_users_budgeting', $accountData);

?>