<?php
$orderForm								            = trim(file_get_contents("php://input"));
$orderForm								            = json_decode($orderForm, true);

// GET Request Defined Variables
$status									            = 1;
$formMode                                           = $orderForm['form_mode']; 
$beta									            = $orderForm['beta'];
$user_id								            = $orderForm['user_id'];
$user_email 							            = $orderForm['user_email'];
$username    							            = $orderForm['username'];
$nickname    							            = $orderForm['nickname'];
$net_amount							                = str_replace(',', '', $orderForm['net_amount']);
// $gross_amount   	                                = str_replace(',', '', $orderForm['gross_amount']);
$recurring_account         	                        = $orderForm['recurring_account'];
$account_type  							            = $orderForm['account_type'];
$source_type    					                = $orderForm['source_type'];
if(preg_match('(Debt|Loan|Mortgage)', $source_type) === 1) {
    $is_debt                                        = 1; 
} else {
    $is_debt                                        = 0;
}
$intervals    							            = $orderForm['intervals'];
$designated_date						            = date("Y-m-d", strtotime($orderForm['designated_date']));
$month                                              = date("m", strtotime($designated_date));
$day                                                = date("d", strtotime($designated_date));
$year                                               = date("Y", strtotime($designated_date));
if ($recurring_account === 'Yes') {
    $end_of_year                                    = date('m-d-Y', strtotime('12/31'));
    $current_date                                   = date('m-d-Y', strtotime($designated_date));
    $initial_weeks_left                             = date('W', strtotime($end_of_year)) - date('W', strtotime($current_date));
} else {
    $initial_weeks_left                             = 0; 
}
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
    'recurring_account_primary'                     => 'Yes',
    'account_type'					                => $account_type,
    'source_type'					                => $source_type,
    'is_debt'                                       => $is_debt,
    'intervals'							            => $intervals,
    'designated_date'			                    => $designated_date,
    'initial_weeks_left'                            => $initial_weeks_left,
);

if ($formMode === 'Add') {
    return $this->db->insert('bf_users_budgeting', $accountData);
} elseif ($formMode === 'Edit') {
    $accountID                                      = $orderForm['account_id']; 
    $this->db->where('id', $accountID); 
    return $this->db->update('bf_users_budgeting', $accountData);     
}

?>