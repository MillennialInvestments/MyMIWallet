<?php
$beta                                           = $this->config->item('beta'); 
$userAccount                                    = $_SESSION['allSessionData']['userAccount'];
$cuID                                           = $userAccount['cuID'];
$cuEmail                                        = $userAccount['cuEmail'];
$cuUsername                                     = $userAccount['cuUsername'];
if (!empty($this->uri->segment(4))) {
    // Define Account ID
    $accountID                                  = $this->uri->segment(4); 
    // Begin MySQL Query to Database
    $this->db->from('bf_users_budgeting'); 
    $this->db->where('id', $accountID);
    $getAccountInfo                             = $this->db->get(); 
    // Create Variables from Database Query JSON Array/Results
    foreach($getAccountInfo->result_array() as $account) {
        $accountName                            = $account['name'];
        $accountType                            = $account['account_type'];
        $accountSourceType                      = $account['source_type'];
        $accountNetAmount                       = $account['net_amount'];
        $accountGrossAmount                     = $account['gross_amount'];
        $accountRecAccount                      = $account['recurring_account'];
        $accountIntervals                       = $account['intervals'];
        $accountDesDate                         = $account['designated_date'];
    }
} else {
    // Begin MySQL Query to Database
    $this->db->from('bf_users_budgeting'); 
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $getAccountInfo                             = $this->db->get(); 
    // Create Variables from Database Query JSON Array/Results
    foreach($getAccountInfo->result_array() as $account) {
        $accountID                              = $account['id'];
        $accountName                            = $account['name'];
        $accountType                            = $account['account_type'];
        $accountSourceType                      = $account['source_type'];
        $accountNetAmount                       = $account['net_amount'];
        $accountGrossAmount                     = $account['gross_amount'];
        $accountRecAccount                      = $account['recurring_account'];
        $accountIntervals                       = $account['intervals'];
        $accountDesDate                         = $account['designated_date'];
    }
}
if ($accountRecAccount === 'Yes') {
    $current_year                               = date('Y');
    // echo $current_year;
    // echo '<br>';
    $end_of_year                                = date('m/d/Y', strtotime('12/31')); 
    // echo 'EOY: ' . $end_of_year;
    // echo '<br>';
    $current_date                               = date('m/d/Y', strtotime($accountDesDate)); 
    // echo 'Current Date: ' . $current_date;
    // echo '<br>';
    $daysLeft                                   = date( 'dd', strtotime($end_of_year) ) - date( 'dd', strtotime($current_date) );
    // echo $daysLeft;
    // echo '<br>';
    $weeksLeft                                  = date( 'W', strtotime($end_of_year) ) - date( 'W', strtotime($current_date) );
    // echo $weeksLeft;
    // echo '<br>';
    $monthsLeft                                 = date( 'm', strtotime($end_of_year) ) - date( 'm', strtotime($current_date) );
    // echo $monthsLeft;
    // echo '<br>';
    

    if ($accountIntervals === 'Daily') {    
        $data                                       = array();
        for($i=0; $i<$daysLeft; $i++) {
            $setWeek                                = $i . " week";
            $nextWeek                               = strtotime($week, $accountDesDate);
            $data[$i] = array(
                'status'							=> 1,
                'beta'								=> $beta,
                'unix_timestamp'				    => time(),
                'created_by'						=> $cuID,
                'created_by_email'	    			=> $cuEmail,
                'username'							=> $cuUsername,
                'name'							    => $accountName,
                'net_amount'						=> $accountNetAmount,
                'gross_amount'						=> $accountGrossAmount,
                'recurring_account'				    => $accountRecAccount,
                'recurring_account_id'  		    => $accountID . $i,
                'account_type'					    => $accountType,
                'source_type'					    => $accountSourceType,
                'intervals'							=> $accountIntervals,
                'designated_date'			        => $nextWeek,
            );
        //     // return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
        print_r($data);
    } elseif ($accountIntervals === 'Weekly') {
        $data                                       = array();
        for($i=0; $i<$daysLeft; $i++) {
            $data[$i] = array(
                'status'							=> 1,
                'beta'								=> $beta,
                'unix_timestamp'				    => time(),
                'created_by'						=> $cuID,
                'created_by_email'	    			=> $cuEmail,
                'username'							=> $cuUsername,
                'name'							    => $accountName,
                'net_amount'						=> $accountNetAmount,
                'gross_amount'						=> $accountGrossAmount,
                'recurring_account'				    => $accountRecAccount,
                'recurring_account_id'  		    => $accountID . $i,
                'account_type'					    => $accountType,
                'source_type'					    => $accountSourceType,
                'intervals'							=> $accountIntervals,
                'designated_date'			        => $accountDesDate,
                'time_left'                         => $days,
            );
        //     // return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
    } elseif ($accountIntervals === 'Bi-Weekly') {
        $biWeeksLeft                                = $weeksLeft/2; 
        echo $biWeeksLeft; 
        $data                                       = array();
        for($i=0; $i<$weeksLeft; $i++) {
            $date                                   = strtotime($accountDesDate);
            $numberOfWeeks                          = $i . " weeks";
            $weeksLeft                              = strtotime($numberOfWeeks, $date);
            $data[$i] = array(
                'status'							=> 1,
                'beta'								=> $beta,
                'unix_timestamp'				    => time(),
                'created_by'						=> $cuID,
                'created_by_email'	    			=> $cuEmail,
                'username'							=> $cuUsername,
                'name'							    => $accountName,
                'net_amount'						=> $accountNetAmount,
                'gross_amount'						=> $accountGrossAmount,
                'recurring_account'				    => $accountRecAccount,
                'recurring_account_id'  		    => $accountID . $i,
                'account_type'					    => $accountType,
                'source_type'					    => $accountSourceType,
                'intervals'							=> $accountIntervals,
                'designated_date'			        => $accountDesDate,
                'initial_weeks_lefts'               => date('m-d-Y', $biWeeksLeft),
            );
        //     // return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
    } elseif ($accountIntervals === 'Montlhy') {
        $data                                       = array();
        for($i=0; $i<$daysLeft; $i++) {
            $data[$i] = array(
                'status'							=> 1,
                'beta'								=> $beta,
                'unix_timestamp'				    => time(),
                'created_by'						=> $cuID,
                'created_by_email'	    			=> $cuEmail,
                'username'							=> $cuUsername,
                'name'							    => $accountName,
                'net_amount'						=> $accountNetAmount,
                'gross_amount'						=> $accountGrossAmount,
                'recurring_account'				    => $accountRecAccount,
                'recurring_account_id'  		    => $accountID . $i,
                'account_type'					    => $accountType,
                'source_type'					    => $accountSourceType,
                'intervals'							=> $accountIntervals,
                'designated_date'			        => $accountDesDate,
                'initial_weeks_lefts'               => $weeksLeft,
            );
        //     // return $this->db->insert('bf_users_budgeting', $data[$i]);
        }
    } elseif ($accountIntervals === 'Quarterly') {
        $data                                       = array();
        for ($i=0; $i<$daysLeft; $i++) {
            $data[$i] = array(
                'status'							=> 1,
                'beta'								=> $beta,
                'unix_timestamp'				    => time(),
                'created_by'						=> $cuID,
                'created_by_email'	    			=> $cuEmail,
                'username'							=> $cuUsername,
                'name'							    => $accountName,
                'net_amount'						=> $accountNetAmount,
                'gross_amount'						=> $accountGrossAmount,
                'recurring_account'				    => $accountRecAccount,
                'recurring_account_id'  		    => $accountID . $i,
                'account_type'					    => $accountType,
                'source_type'					    => $accountSourceType,
                'intervals'							=> $accountIntervals,
                'designated_date'			        => $accountDesDate,
                'initial_weeks_lefts'               => $weeksLeft,
            );
        }
        //     // return $this->db->insert('bf_users_budgeting', $data[$i]);
    } elseif ($accountIntervals === 'Semi-Annually') {
        $data                                       = array();
        for ($i=0; $i<$daysLeft; $i++) {
            $data[$i] = array(
                'status'							=> 1,
                'beta'								=> $beta,
                'unix_timestamp'				    => time(),
                'created_by'						=> $cuID,
                'created_by_email'	    			=> $cuEmail,
                'username'							=> $cuUsername,
                'name'							    => $accountName,
                'net_amount'						=> $accountNetAmount,
                'gross_amount'						=> $accountGrossAmount,
                'recurring_account'				    => $accountRecAccount,
                'recurring_account_id'  		    => $accountID . $i,
                'account_type'					    => $accountType,
                'source_type'					    => $accountSourceType,
                'intervals'							=> $accountIntervals,
                'designated_date'			        => $accountDesDate,
                'initial_weeks_lefts'               => $weeksLeft,
            );
        }
        //     // return $this->db->insert('bf_users_budgeting', $data[$i]);
    } elseif ($accountIntervals === 'Annually'){
        $data                                       = array();
        for($i=0; $i<$daysLeft; $i++) {
            $data[$i] = array(
                'status'							=> 1,
                'beta'								=> $beta,
                'unix_timestamp'				    => time(),
                'created_by'						=> $cuID,
                'created_by_email'	    			=> $cuEmail,
                'username'							=> $cuUsername,
                'name'							    => $accountName,
                'net_amount'						=> $accountNetAmount,
                'gross_amount'						=> $accountGrossAmount,
                'recurring_account'				    => $accountRecAccount,
                'recurring_account_id'  		    => $accountID . $i,
                'account_type'					    => $accountType,
                'source_type'					    => $accountSourceType,
                'intervals'							=> $accountIntervals,
                'designated_date'			        => $accountDesDate,
                'initial_weeks_lefts'               => $weeksLeft,
            );
        }
        //     // return $this->db->insert('bf_users_budgeting', $data[$i]);
    }
} else {
    $data							                = array(
        'status'							        => $status,
        'beta'								        => $beta,
        'unix_timestamp'				            => time(),
        'created_by'						        => $cuID,
        'created_by_email'	    			        => $cuEmail,
        'username'							        => $cuUsername,
        'name'							            => $accountName,
        'net_amount'						        => $accountNetAmount,
        'gross_amount'						        => $accountGrossmount,
        'recurring_account'				            => $accountRecAccount,
        'recurring_account_id'  		            => $accountID . [$i],
        'account_type'					            => $accountType,
        'source_type'					            => $accountSourceType,
        'intervals'							        => $accountIntervals,
        'designated_date'			                => $accountDesDate,
        'initial_weeks_lefts'                       => $initial_weeks_left . 'else',
    );
    // return $this->db->insert('bf_users_budgeting', $accountData);
    print_r($data);
} 
?>
<div class="nk-block">
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-bordered h-100">
                <div class="card-inner-group">
                    <div class="card-inner card-inner-md">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Account Information</h6>
                            </div>
                            <div class="card-tools me-n1">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger full-width" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="<?php echo site_url('/Budget/Edit/' . $accountID); ?>"><em class="icon ni ni-setting"></em><span>Account Settings</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <table class="table table-default">
                            <tbody>
                                <tr>
                                    <th>Account Type</th>
                                    <td><?php echo $accountType; ?></td>
                                </tr>
                                <tr>
                                    <th>Source Type</th>
                                    <td><?php echo $accountSourceType; ?></td>
                                </tr>
                                <tr>
                                    <th>Account Name</th>
                                    <td><?php echo $accountName; ?></td>
                                </tr>
                                <tr>
                                    <th>Net Amount</th>
                                    <td><?php echo $accountNetAmount; ?></td>
                                </tr>
                                <tr>
                                    <th>Intervals</th>
                                    <td><?php echo $accountIntervals; ?></td>
                                </tr>
                                <tr>
                                    <th>Due Date</th>
                                    <td><?php echo $accountDesDate; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card card-bordered h-100">
                <div class="card-inner-group">
                    <div class="card-inner card-inner-md">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Recurring Schedule</h6>
                            </div>
                            <div class="card-tools me-n1">
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger full-width" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="<?php echo site_url('/Budget/Edit/' . $accountID); ?>"><em class="icon ni ni-setting"></em><span>Account Settings</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <table class="table table-default">
                            <thead>
                                <tr>
                                    <th>Due Date</th>
                                    <th>Account</th>
                                    <th>Source</th>
                                    <th>Amount</th>
                                    <th>Interval</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($data as $id=>$account) {
                                        // print_r($account); 
                                        echo '
                                        <tr>
                                            <td>' . $account['initial_weeks_lefts'] . '</td>
                                            <td>' . $account['name'] . '</td>
                                            <td>' . $account['account_type'] . '</td>
                                            <td>' . $account['source_type'] . '</td>
                                            <td>' . $account['net_amount'] . '</td>
                                            <td>' . $account['intervals'] . '</td>
                                        </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
