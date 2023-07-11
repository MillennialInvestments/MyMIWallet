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
$net_amount							                = str_replace(',', '', $orderForm['net_amount']);
$gross_amount   	                                = str_replace(',', '', $orderForm['gross_amount']);
$recurring_account         	                        = $orderForm['recurring_account'];
$account_type  							            = $orderForm['account_type'];
$source_type    					                = $orderForm['source_type'];
$intervals    							            = $orderForm['intervals'];
$designated_date						            = $orderForm['designated_date'];
$end_of_year_date                                   = date("m/d/Y"); 

$weeklyCounter                                      = 0;
if ($recurring_account === 'Yes') {
    if ($intervals === 'Daily') {
        $initialWeek                                = DateTime::createFromFormat('m/d/Y', $designated_date);
        $lastAnnualWeek                             = DateTime::createFromFormat('m/d/Y', $end_of_year_date);
        $initial_weeks_left                         = floor($lastAnnualWeek->diff($initialWeek)->days);

        $data                                       = array();
        for($i=0; $i<$initial_weeks_left; $i++) {
            $data[$i] = array(
                'status'							=> $status,
                'beta'								=> $beta,
                'created_by'						=> $user_id,
                'created_by_email'	    			=> $user_email,
                'unix_timestamp'				    => $username,
                'username'							=> $username,
                'name'							    => $nickname,
                'net_amount'						=> $net_amount,
                'gross_amount'						=> $gross_amount,
                'recurring_account'				    => $recurring_account,
                'recurring_account_id'  		    => [$i],
                'account_type'					    => $account_type,
                'source_type'					    => $source_type,
                'intervals'							=> $intervals,
                'designated_date'			        => $designated_date,
                'initial_weeks_lefts'               => $initial_weeks_left,
            );
            return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
    } elseif ($intervals === 'Weekly') {
        $initialWeek                                = DateTime::createFromFormat('m/d/Y', $designated_date);
        $lastAnnualWeek                             = DateTime::createFromFormat('m/d/Y', $end_of_year_date);
        $initial_weeks_left                         = floor($lastAnnualWeek->diff($initialWeek)->days/7);

        $data                                       = array();
        for($i=0; $i<$initial_weeks_left; $i++) {
            $data[$i] = array(
                'status'							=> $status,
                'beta'								=> $beta,
                'created_by'						=> $user_id,
                'created_by_email'	    			=> $user_email,
                'unix_timestamp'				    => $username,
                'username'							=> $username,
                'name'							    => $nickname,
                'net_amount'						=> $net_amount,
                'gross_amount'						=> $gross_amount,
                'recurring_account'				    => $recurring_account,
                'recurring_account_id'  		    => [$i],
                'account_type'					    => $account_type,
                'source_type'					    => $source_type,
                'intervals'							=> $intervals,
                'designated_date'			        => $designated_date,
                'initial_weeks_lefts'               => $initial_weeks_left,
            );
            return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
    } elseif ($intervals === 'Bi-Weekly') {
        $initialWeek                                = DateTime::createFromFormat('m/d/Y', $designated_date);
        $lastAnnualWeek                             = DateTime::createFromFormat('m/d/Y', $end_of_year_date);
        $initial_weeks_left                         = floor($lastAnnualWeek->diff($initialWeek)->days/14);

        $data                                       = array();
        for($i=0; $i<$initial_weeks_left; $i++) {
            $data[$i] = array(
                'status'							=> $status,
                'beta'								=> $beta,
                'created_by'						=> $user_id,
                'created_by_email'	    			=> $user_email,
                'unix_timestamp'				    => $username,
                'username'							=> $username,
                'name'							    => $nickname,
                'net_amount'						=> $net_amount,
                'gross_amount'						=> $gross_amount,
                'recurring_account'				    => $recurring_account,
                'recurring_account_id'  		    => $i,
                'account_type'					    => $account_type,
                'source_type'					    => $source_type,
                'intervals'							=> $intervals,
                'designated_date'			        => $designated_date,
                'initial_weeks_lefts'               => $initial_weeks_left,
            );
            return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
    } elseif ($intervals === 'Monthly') {
        $initialWeek                                = DateTime::createFromFormat('m/d/Y', $designated_date);
        $lastAnnualWeek                             = DateTime::createFromFormat('m/d/Y', $end_of_year_date);
        $initial_weeks_left                         = floor($lastAnnualWeek->diff($initialWeek)->days/30);

        $data                                       = array();
        for($i=0; $i<$initial_weeks_left; $i++) {
            $data[$i] = array(
                'status'							=> $status,
                'beta'								=> $beta,
                'created_by'						=> $user_id,
                'created_by_email'	    			=> $user_email,
                'unix_timestamp'				    => $username,
                'username'							=> $username,
                'name'							    => $nickname,
                'net_amount'						=> $net_amount,
                'gross_amount'						=> $gross_amount,
                'recurring_account'				    => $recurring_account,
                'recurring_account_id'  		    => [$i],
                'account_type'					    => $account_type,
                'source_type'					    => $source_type,
                'intervals'							=> $intervals,
                'designated_date'			        => $designated_date,
                'initial_weeks_lefts'               => $initial_weeks_left,
            );
            return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
    } elseif ($intervals === 'Quarterly') {
        $initialWeek                                = DateTime::createFromFormat('m/d/Y', $designated_date);
        $lastAnnualWeek                             = DateTime::createFromFormat('m/d/Y', $end_of_year_date);
        $initial_weeks_left                         = floor($lastAnnualWeek->diff($initialWeek)->days/90);

        $data                                       = array();
        for($i=0; $i<$initial_weeks_left; $i++) {
            $data[$i] = array(
                'status'							=> $status,
                'beta'								=> $beta,
                'created_by'						=> $user_id,
                'created_by_email'	    			=> $user_email,
                'unix_timestamp'				    => $username,
                'username'							=> $username,
                'name'							    => $nickname,
                'net_amount'						=> $net_amount,
                'gross_amount'						=> $gross_amount,
                'recurring_account'				    => $recurring_account,
                'recurring_account_id'  		    => [$i],
                'account_type'					    => $account_type,
                'source_type'					    => $source_type,
                'intervals'							=> $intervals,
                'designated_date'			        => $designated_date,
                'initial_weeks_lefts'               => $initial_weeks_left,
            );
            return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
    } elseif ($intervals === 'Semi-Annually') {
        $initialWeek                                = DateTime::createFromFormat('m/d/Y', $designated_date);
        $lastAnnualWeek                             = DateTime::createFromFormat('m/d/Y', $end_of_year_date);
        $initial_weeks_left                         = floor($lastAnnualWeek->diff($initialWeek)->days/180);

        $data                                       = array();
        for($i=0; $i<$initial_weeks_left; $i++) {
            $data[$i] = array(
                'status'							=> $status,
                'beta'								=> $beta,
                'created_by'						=> $user_id,
                'created_by_email'	    			=> $user_email,
                'unix_timestamp'				    => $username,
                'username'							=> $username,
                'name'							    => $nickname,
                'net_amount'						=> $net_amount,
                'gross_amount'						=> $gross_amount,
                'recurring_account'				    => $recurring_account,
                'recurring_account_id'  		    => [$i],
                'account_type'					    => $account_type,
                'source_type'					    => $source_type,
                'intervals'							=> $intervals,
                'designated_date'			        => $designated_date,
                'initial_weeks_lefts'               => $initial_weeks_left,
            );
            return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
    } elseif ($intervals === 'Annually'){
        $initialWeek                                = DateTime::createFromFormat('m/d/Y', $designated_date);
        $lastAnnualWeek                             = DateTime::createFromFormat('m/d/Y', $end_of_year_date);
        $initial_weeks_left                         = floor($lastAnnualWeek->diff($initialWeek)->days/365);

        $data                                       = array();
        for($i=0; $i<$initial_weeks_left; $i++) {
            $data[$i] = array(
                'status'							=> $status,
                'beta'								=> $beta,
                'created_by'						=> $user_id,
                'created_by_email'	    			=> $user_email,
                'unix_timestamp'				    => $username,
                'username'							=> $username,
                'name'							    => $nickname,
                'net_amount'						=> $net_amount,
                'gross_amount'						=> $gross_amount,
                'recurring_account'				    => $recurring_account,
                'recurring_account_id'  		    => [$i],
                'account_type'					    => $account_type,
                'source_type'					    => $source_type,
                'intervals'							=> $intervals,
                'designated_date'			        => $designated_date,
                'initial_weeks_lefts'               => $initial_weeks_left,
            );
            return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
    }
} else {
    $accountData							        = array(
        'status'							        => $status,
        'beta'								        => $beta,
        'created_by'						        => $user_id,
        'created_by_email'	    			        => $user_email,
        'unix_timestamp'				            => $username,
        'username'							        => $username,
        'name'							            => $nickname,
        'net_amount'						        => $net_amount,
        'gross_amount'						        => $gross_amount,
        'recurring_account'				            => $recurring_account,
        'account_type'					            => $account_type,
        'source_type'					            => $source_type,
        'intervals'							        => $intervals,
        'designated_date'			                => $designated_date,
        'initial_weeks_lefts'                       => $initial_weeks_left,
    );
    return $this->db->insert('bf_users_budgeting', $accountData);
}

?>


