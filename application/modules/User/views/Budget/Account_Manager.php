<?php
$this->load->helper('date');
$orderForm								            = trim(file_get_contents("php://input"));
$orderForm								            = json_decode($orderForm, true);

// GET Request Defined Variables
$status									            = 1;
$beta									            = $orderForm['beta'];
$formMode                                           = $orderForm['form_mode']; 
$user_id								            = $orderForm['user_id'];
$user_email 							            = $orderForm['user_email'];
$username    							            = $orderForm['username'];
$accountID                                          = $orderForm['account_id'];
$account_type  							            = $orderForm['account_type'];

// $date                                               = date_create_from_format("j-M-Y",$orderForm['designated_date']);
// $designated_date                                    = $orderForm['designated_date'];
$nickname    							            = $orderForm['nickname'];
$net_amount							                = str_replace(',', '', $orderForm['net_amount']);
// $gross_amount   	                                = str_replace(',', '', $orderForm['gross_amount']);
$accountRecurringAccount   	                        = $orderForm['recurring_account'];
$source_type    					                = $orderForm['source_type'];
if ($formMode === 'Add') {
    if (preg_match('(Debt|Loan|Mortgage)', $source_type) === 1) {
        $is_debt                                    = 1; 
    } else {
        $is_debt                                    = 0;
    }
    if ($accountRecurringAccount === 'Yes') {
        $accountRecurringPrimary 	                = 'Yes';
    } else {
        $accountRecurringPrimary 	                = 'No';
    }
    $accountRecurringPrimaryID 	                    = 0;
    $designated_date_override                       = '';
    $dateTranslator                                 = strtotime($orderForm['designated_date']);
    $designated_date                                = date('m-d-Y', $dateTranslator);
    $month                                          = date('m', $dateTranslator);
    $day                                            = date('d', $dateTranslator);
    $year                                           = date('Y', $dateTranslator);
    
} elseif ($formMode === 'Edit') {
    $is_debt                                        = $orderForm['is_debt'];
    $accountRecurringPrimary 	                    = $orderForm['recurring_account'];
    $accountRecurringPrimaryID 	                    = $orderForm['recurring_account_id'];
    // // If Designated Date Override is required or activated
    // $designated_date_override                       = date('m-d-Y', strtotime($orderForm['designated_date_override']));
    // if (!empty($designated_date_override)) {
    //     $dateTranslator                             = strtotime($orderForm['designated_date_override']);
    //     $designated_date                            = date('m-d-Y', $dateTranslator);
    // } else {
    //     $dateTranslator                             = strtotime($orderForm['designated_date']);
    //     $designated_date                            = $orderForm['designated_date'];
    // }
    $designated_date                                = $orderForm['designated_date'];
    $dateTranslator                                 = strtotime($designated_date);
    $month                                          = date('m', $dateTranslator);
    $day                                            = date('d', $dateTranslator);
    $year                                           = date('Y', $dateTranslator);
}
$intervals    							            = $orderForm['intervals'];
$initial_weeks_left                                 = 0; 
$accountData							            = array(
    'status'							            => $status,
    'beta'								            => $beta,
    'mode'                                          => $formMode,
    'created_by'						            => $user_id,
    'created_by_email'	    			            => $user_email,
    'unix_timestamp'				                => time(),
    'designated_date'			                    => $designated_date,
    // // If Designated Date Override is required or activated, read line
    // 'designated_date_override'			            => $designated_date_override,
    'initial_weeks_left'                            => $initial_weeks_left,
    'month'                                         => $month, 
    'day'                                           => $day,
    'year'                                          => $year,
    'time'                                          => date("H:i:s A"),
    'username'							            => $username,
    'name'							                => $nickname,
    'net_amount'						            => $net_amount,
    // 'gross_amount'						            => $gross_amount,
    'recurring_account'				                => $accountRecurringAccount,
    'recurring_account_primary'                     => $accountRecurringPrimary,
    'account_type'					                => $account_type,
    'source_type'					                => $source_type,
    'is_debt'                                       => $is_debt,
    'intervals'							            => $intervals,
);

if ($formMode === 'Add') {
    return $this->db->insert('bf_users_budgeting', $accountData);
} elseif ($formMode === 'Edit') {
    // if ($accountRecurringPrimary === 'Yes') {
    //     $this->db->where('id', $accountID); 
    //     return $this->db->update('bf_users_budgeting', $accountData);     
    // } else {        
    //     $this->db->where('id', $accountID); 
    //     return $this->db->update('bf_users_budgeting', $accountData);     
    // }
    $this->db->where('id', $accountID); 
    return $this->db->update('bf_users_budgeting', $accountData);    
}

?>