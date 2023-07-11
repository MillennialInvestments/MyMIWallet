<?php
//! Security issue
//TODO: perform scan to see whether this user has a table and the wallets are available
$testSettingArray                       = array(
    'setting1'                          => 'testAnswer',
);
// Define User ID
$cuID                                   = $this->session->userdata('user_id');
// - Get User Information from Database
// - Define cuEmail & cuUsername
$this->db->select('email, username');
$this->db->from('bf_users');
$this->db->where('id', $cuID);
$getUserInfo                            = $this->db->get();
foreach ($getUserInfo->result_array() as $userInfo) {
    $cuEmail                            = $userInfo['email'];
    $cuUsername                         = $userInfo['username'];
}

// - Get Layout Form Data from Fetch Submission
$tradeForm                              = trim(file_get_contents('php://input'));
$tradeForm                              = json_decode($tradeForm, true);
// - Define User Layout Date Inputs
// $tt_user_settings                       = $testSettingArray;
$tt_user_settings                       = json_encode($tradeForm['tt_user_settings']);
// - Create Array that will be passed to Database on validation/completion
$ttUserSettings                         = array(
    'status'                            => 0,
    'month'                             => date("m"),
    'day'                               => date("d"),
    'year'                              => date("y"),
    'created_by'                        => $cuID, 
    'user_email'                        => $cuEmail,
    'username'                          => $cuUsername,
    'tt_user_settings'                  => $tt_user_settings,
);
// return $this->db->insert('bf_users_trades_configs', $ttUserSettings);
// // Get Existing User Configs
// $getAllConfigs                          = $this->mymiuser->get_all_trade_tracker_configs();

$this->db->from('bf_users_trades_configs');
$this->db->where('status', 1);
$getAllConfigs                          = $this->db->get();
if (!empty($getAllConfigs)) {
    foreach ($getAllConfigs->result_array() as $configs) {
        // - Determine if there is an existing layout record created by current user
        if ($configs['created_by'] === $cuID) {
            // - If created_by matches User ID, update instead of insert new row
            // - Define Record ID to be updated
            $recordID                       = $configs['id'];
            $this->db->where('id', $recordID); 
            return $this->db->update('bf_users_trades_configs', $ttUserSettings); 
        } else {
            // - If created_by does match User ID, insert new row
            return $this->db->insert('bf_users_trades_configs', $ttUserSettings); 
        }
    }    
} else {
    // - If created_by does match User ID, insert new row
    return $this->db->insert('bf_users_trades_configs', $ttUserSettings); 
}        
?>