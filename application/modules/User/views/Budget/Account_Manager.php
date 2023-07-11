<?php
<<<<<<< HEAD
$this->load->helper('date');
$date                                               = date("F jS, Y");
$hostTime                                           = date("g:i A");
$time                                               = date("g:i A", strtotime($hostTime) - 60 * 60 * 5);
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
$orderForm								            = trim(file_get_contents("php://input"));
$orderForm								            = json_decode($orderForm, true);

// GET Request Defined Variables
$status									            = 1;
<<<<<<< HEAD
$beta									            = $orderForm['beta'];
$formMode                                           = $orderForm['form_mode']; 
$user_id								            = $orderForm['user_id'];
$user_email 							            = $orderForm['user_email'];
$username    							            = $orderForm['username'];
$accountID                                          = $orderForm['account_id'];
$account_type  							            = $orderForm['account_type'];
$paid                                               = $orderForm['paid'];

// $date                                               = date_create_from_format("j-M-Y",$orderForm['designated_date']);
// $designated_date                                    = $orderForm['designated_date'];
$nickname    							            = $orderForm['nickname'];
$net_amount							                = str_replace(',', '', $orderForm['net_amount']);
if (!empty($orderForm['gross_amount'])) {
    $gross_amount   	                                = str_replace(',', '', $orderForm['gross_amount']);
} else {
    $gross_amount                                   = 0; 
}
if (!empty($orderForm['monthly_payment'])) {
    $monthly_payment   	                                = str_replace(',', '', $orderForm['monthly_payment']);
} else {
    $monthly_payment                                   = 0; 
}
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
    $designated_date                                = date('m/d/Y', $dateTranslator);
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
    $dateTranslator                                 = $orderForm['designated_date'];
    $month                                          = date('m', strtotime($dateTranslator));
    $day                                            = date('d', strtotime($dateTranslator));
    $year                                           = date('Y', strtotime($dateTranslator));
} elseif ($formMode === 'Copy') { 
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
    $dateTranslator                                 = $orderForm['designated_date'];
    $month                                          = date('m', strtotime($dateTranslator));
    $day                                            = date('d', strtotime($dateTranslator));
    $year                                           = date('Y', strtotime($dateTranslator));
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
=======
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
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    'month'                                         => $month, 
    'day'                                           => $day,
    'year'                                          => $year,
    'time'                                          => date("H:i:s A"),
    'username'							            => $username,
    'name'							                => $nickname,
<<<<<<< HEAD
    'monthly_payment'                               => $monthly_payment,
    'net_amount'						            => $net_amount,
    'gross_amount'						            => $gross_amount,
    'paid'                                          => $paid,
    'recurring_account'				                => $accountRecurringAccount,
    'recurring_account_primary'                     => $accountRecurringPrimary,
=======
    'net_amount'						            => $net_amount,
    // 'gross_amount'						            => $gross_amount,
    'recurring_account'				                => $recurring_account,
    'recurring_account_primary'                     => 'Yes',
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    'account_type'					                => $account_type,
    'source_type'					                => $source_type,
    'is_debt'                                       => $is_debt,
    'intervals'							            => $intervals,
<<<<<<< HEAD
);

if ($formMode === 'Add') {
    if ($is_debt === 1) {
        $debtData                                   = array(
            'beta'                                  => $beta,
            'status'                                => $status,
            'date'                                  => $date,
            'time'                                  => $time,
            'user_id'                               => $user_id,
            'user_email'                            => $user_email,
            'username'                              => $username,
            'account_type'                          => $account_type,
            'debtor'                                => $nickname,
            'available_balance'                     => $gross_amount,
            'current_balance'                       => $net_amount,
            'monthly_payment'                       => $monthly_payment,
        );
        $this->db->insert('bf_users_debt_accounts', $debtData); 
    }
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
    // // Update Other Related Records
    // $updateOriginalRecord                           = $this->db->update('bf_users_budgeting', $accountData);    
    // if ($updateOriginalRecord) {
    //     $this->db->where('name', $nickname); 
    //     $this->db->where('status', 1); 
    //     $this->db->where('paid', 0); 
    //     return $this->db->update('bf_users_budgeting', $accountData); 
    // }  
} elseif ($formMode === 'Copy') {
    return $this->db->insert('bf_users_budgeting', $accountData); 
=======
    'designated_date'			                    => $designated_date,
    'initial_weeks_left'                            => $initial_weeks_left,
);

if ($formMode === 'Add') {
    return $this->db->insert('bf_users_budgeting', $accountData);
} elseif ($formMode === 'Edit') {
    $accountID                                      = $orderForm['account_id']; 
    $this->db->where('id', $accountID); 
    return $this->db->update('bf_users_budgeting', $accountData);     
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
}

?>