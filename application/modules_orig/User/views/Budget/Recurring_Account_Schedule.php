<?php
$beta                                           = $this->config->item('beta'); 
$todaysDate                                     = date("m/d/Y"); 
$todaysMonth                                    = date("m");
$todaysDay                                      = date("d");
$todaysYear                                     = date("Y");
if ($beta === 1) {
    $beta                                       = 'Yes';
} else {
    $beta                                       = 'No';
}
$userAccount                                    = $_SESSION['allSessionData']['userAccount'];
$cuID                                           = $userAccount['cuID'];
$cuEmail                                        = $userAccount['cuEmail'];
$cuUsername                                     = $userAccount['cuUsername'];
if (!empty($this->uri->segment(4))) {
    // Define Account ID
    $accountID                                  = $this->uri->segment(4); 
    $getAccountInfo                             = $this->budget_model->get_account_information($accountID); 
    // print_r($getAccountInfo->result_array()); 
    // Create Variables from Database Query JSON Array/Results
    foreach($getAccountInfo->result_array() as $account) {
        $accountName                            = $account['name'];
        $accountType                            = $account['account_type'];
        $accountSourceType                      = $account['source_type'];
        $accountNetAmount                       = $account['net_amount'];
        $accountGrossAmount                     = $account['gross_amount'];
        $accountRecAccount                      = $account['recurring_account'];
        $accountRecSchedule                     = $account['recurring_schedule'];
        $accountIntervals                       = $account['intervals'];
        $accountDesDate                         = strtotime($account['designated_date']);
        $accountMonth                           = $account['month']; 
        $accountDay                             = $account['day']; 
        $accountYear                            = $account['year']; 
        $accountTime                            = $account['time']; 
    }
} else {
    // Begin MySQL Query to Database
    // $getLastRecurringAccountInfo                = $this->budget_model->get_last_recurring_account_info($cuID); 
    $this->db->from('bf_users_budgeting'); 
    $this->db->where('created_by', $cuID); 
    $this->db->where('recurring_account_primary', 'Yes'); 
    $this->db->where('status', 1); 
    $this->db->where('deleted', 0); 
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $getLastRecurringAccountInfo             = $this->db->get();
    // print_r($getLastRecurringAccountInfo->result_array());
    // print_r($getAccountInfo->result_array()); 
    // echo '<br>';
    // Create Variables from Database Query JSON Array/Results
    foreach($getLastRecurringAccountInfo->result_array() as $account) {
        $accountID                              = $account['id'];
        $accountName                            = $account['name'];
        $accountType                            = $account['account_type'];
        $accountSourceType                      = $account['source_type'];
        $accountNetAmount                       = $account['net_amount'];
        $accountGrossAmount                     = $account['gross_amount'];
        $accountRecAccount                      = $account['recurring_account'];
        $accountRecSchedule                     = $account['recurring_schedule'];
        $accountIntervals                       = $account['intervals'];
        $accountDesDate                         = $account['designated_date'];
        $accountMonth                           = $account['month']; 
        $accountDay                             = $account['day']; 
        $accountYear                            = $account['year']; 
        $accountTime                            = $account['time']; 
    }
}
$i                                          = 1;
$current_year                               = date('12/31/Y');
$end_of_year                                = date('12/31/Y');
$EOY                                        = date('12/31/Y');
$thisMonth                                  = date('m/1/Y');
$nextYear                                   = date('m/1/Y', strtotime('+1 Year'));
$daysLeft                                   = round(strtotime($end_of_year) - strtotime($accountDesDate),0);
$monthsLeft                                 = round(strtotime($end_of_year) - strtotime($accountDesDate),0);
$tmDateTime                                 = DateTime::createFromFormat('m/d/Y', $thisMonth); 
$eoyDateTime                                = DateTime::createFromFormat('m/d/Y', $EOY); 
$neoyDateTime                               = DateTime::createFromFormat('m/d/Y', $nextYear); 
$desDateTime                                = DateTime::createFromFormat('m/d/Y', $accountDesDate);
$accountDesDate                             = $desDateTime->format('m/d/Y'); 
$accountMonth                               = $desDateTime->format('m'); 
$accountDay                                 = $desDateTime->format('d'); 
$accountYear                                = $desDateTime->format('Y'); 
// echo $thisMonth . ' - ' . $nextYear . '<br>';
// print_r($tmDateTime);
// echo '<br>';
// print_r($neoyDateTime); 
$interval                                   = date_diff($tmDateTime, $neoyDateTime);
// print_r($interval);
$daysLeft                                   = round($interval->days,1);
$weeksLeft                                  = round($interval->days/7,1);
$monthsLeft                                 = $weeksLeft / 4.3416666666667; 
// echo $monthsLeft;
if ($accountIntervals === 'Daily') {
    $variable                               = 1;
    $timeInterval                           = $daysLeft/$variable;
    $timeIntText                            = 'day';
} elseif ($accountIntervals === 'Weekly') {
    $variable                               = 1;
    $timeInterval                           = $weeksLeft/$variable;
    $timeIntText                            = 'week';
} elseif ($accountIntervals === 'Bi-Weekly') {
    $variable                               = 2;
    $timeInterval                           = $weeksLeft/$variable;
    $timeIntText                            = 'week';
} elseif ($accountIntervals === '15th/Last') {
    $variable                               = 2;
    $timeInterval                           = $weeksLeft/$variable;
    $timeIntText                            = 'week';
} elseif ($accountIntervals === 'Monthly') {
    $variable                               = 1;
    $timeInterval                           = $monthsLeft/$variable;
    $timeIntText                            = 'month';
} elseif ($accountIntervals === 'Quarterly') {
    $variable                               = 3;
    $timeInterval                           = $monthsLeft/$variable;
    $timeIntText                            = 'month';
} elseif ($accountIntervals === 'Semi-Annually') {
    $variable                               = 6;
    $timeInterval                           = $monthsLeft/$variable;
    $timeIntText                            = 'month';
} elseif ($accountIntervals === 'Annually') {
    $variable                               = 12;
    $timeInterval                           = $monthsLeft/$variable;
    $timeIntText                            = 'month';
}
while (($i)<=$timeInterval) {
    if ($accountIntervals === '15th/Last') { 
        if ($i === 1) {
            if ($accountDay <= 16) {
                $thisI                      = round($i * $variable, 0);
                $thisTimeInterval           = '+' . $thisI  . ' ' . $timeIntText;
                $newDate                    = DateTime::createFromFormat('m/d/Y',$accountDesDate);
                $newIntervalDate            = $newDate->modify($thisTimeInterval);
                $newDueDate                 = $newIntervalDate->format('m/t/Y');
                $newDueDateMonth            = $newIntervalDate->format('m'); 
                $newDueDateDay              = $newIntervalDate->format('t'); 
                $newDueDateYear             = $newIntervalDate->format('Y'); 
                $listedDates[$i]            = array(
                    'date'                  => $newDueDate,
                );
            } else {
                $midDate                    = 15;
                $thisI                      = round($i * $variable, 0);
                $thisTimeInterval           = '+' . $thisI  . ' ' . $timeIntText;
                $newDate                    = DateTime::createFromFormat('m/d/Y',$accountDesDate);
                $newIntervalDate            = $newDate->modify($thisTimeInterval);
                $newDueDate                 = $newIntervalDate->format('m/' . $midDate .'/Y');
                $newDueDateMonth            = $newIntervalDate->format('m'); 
                $newDueDateDay              = $newIntervalDate->format('d'); 
                $newDueDateYear             = $newIntervalDate->format('Y'); 
                $listedDates[$i]            = array(
                    'date'                  => $newDueDate,
                );
            }
            $lastListedDate                 = $accountDesDate; 
        } else {
            $oldI                           = $i - 1;
            $thisI                          = round($i * $variable, 0);
            $thisTimeInterval               = '+' . $thisI  . ' ' . $timeIntText;
            $newDate                        = DateTime::createFromFormat('m/d/Y',$accountDesDate);
            $newIntervalDate                = $newDate->modify($thisTimeInterval);
            $newDateDay                     = $newIntervalDate->format('d');
            if ($newDateDay >= 16) {    
                $newDueDate                 = $newIntervalDate->format('m/t/Y');
                $newDueDateMonth            = $newIntervalDate->format('m'); 
                $newDueDateDay              = $newIntervalDate->format('t'); 
                $newDueDateYear             = $newIntervalDate->format('Y'); 
            } else {
                $newDueDate                 = $newIntervalDate->format('m/15/Y');
                $newDueDateMonth            = $newIntervalDate->format('m'); 
                $newDueDateDay              = $newIntervalDate->format('d'); 
                $newDueDateYear             = $newIntervalDate->format('Y'); 
            }
            if (!empty($listedDates)) {
                $lastListedDate             = $listedDates[$oldI]['date'];
            } else {
                $lastListedDate             = 'N/A'; 
            }
            $listedDates[$i]                = array(
                'oldI'                      => $oldI,
                'date'                      => $newDueDate,
                'last_date'                 => $lastListedDate,
            );
        }    
    } else {
        if ($i === 1) {
            $thisI                          = round($i * $variable, 0);
            $thisTimeInterval               = '+' . $thisI  . ' ' . $timeIntText;
            $newDate                        = DateTime::createFromFormat('m/d/Y',$accountDesDate);
            $newIntervalDate                = $newDate->modify($thisTimeInterval);
            $newDueDate                     = $newIntervalDate->format('m/d/Y');
            $newDueDateMonth                = $newIntervalDate->format('m'); 
            $newDueDateDay                  = $newIntervalDate->format('d'); 
            $newDueDateYear                 = $newIntervalDate->format('Y'); 
            if (!empty($listedDates)) {
                $lastListedDate             = $listedDates[$oldI]['date'];
            } else {
                $lastListedDate             = 'N/A'; 
            }
            $listedDates[$i]                = array(
                'date'                      => $newDueDate,
            );
        } else {
            $oldI                           = $i - 1;
            $thisI                          = round($i * $variable, 0);
            $thisTimeInterval               = '+' . $thisI  . ' ' . $timeIntText;
            $newDate                        = DateTime::createFromFormat('m/d/Y',$accountDesDate);
            $newIntervalDate                = $newDate->modify($thisTimeInterval);
            $newDueDate                     = $newIntervalDate->format('m/d/Y');
            $newDueDateMonth                = $newIntervalDate->format('m'); 
            $newDueDateDay                  = $newIntervalDate->format('d'); 
            $newDueDateYear                 = $newIntervalDate->format('Y'); 
            if (!empty($listedDates)) {
                $lastListedDate             = $listedDates[$oldI]['date'];
            } else {
                $lastListedDate             = 'N/A'; 
            }
            $listedDates[$i]                = array(
                'oldI'                      => $oldI,
                'date'                      => $newDueDate,
                'last_date'                 => $lastListedDate,
            );
        }
    }
    $data[$i] = array(
        'i'                                 => $i,
        'status'							=> 0,
        'mode'                              => 'Recurring',
        'beta'								=> $beta,
        'unix_timestamp'				    => time(),
        'created_by'						=> $cuID,
        'created_by_email'	    			=> $cuEmail,
        'username'							=> $cuUsername,
        'name'							    => $accountName,
        'net_amount'						=> $accountNetAmount,
        'gross_amount'						=> $accountGrossAmount - $accountNetAmount,
        'recurring_account'				    => $accountRecAccount,
        'recurring_account_id'  		    => $accountID,
        'recurring_account_order'           => $i,
        'recurring_schedule'                => $accountRecSchedule,
        'account_type'					    => $accountType,
        'source_type'					    => $accountSourceType,
        'intervals'						    => $accountIntervals,
        'designated_date'			        => $newDueDate,
        'initial_weeks_left'                => $thisI . ' - ' . $thisTimeInterval,
        'last_date'                         => $lastListedDate,
        'month'                             => $newDueDateMonth,
        'day'                               => $newDueDateDay,
        'year'                              => $newDueDateYear,
    );
    // echo '<br>' . print_r($data[$i]) . '<br>';
    $i++;
}
// echo '<br>' . print_r($data) . '<br>';
?>
<style>                    
    .success-nk-block {
        text-align: center;
    }
    .success-header {
        color: #1ee0ac;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
        }
        p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size:1.05rem;
        margin: 0;
        }
    .success-checkmark {
        color: #1ee0ac;
        font-size: 50px;
        line-height: 100px;
        margin-left:-15px;
    }
    .success-card {
        background: white;
        padding: 60px;
        border-radius: 25px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
    }
</style>
<div class="nk-block">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-4">
            <div class="nk-block success-nk-block">
                <div class="card card-bordered success-card h-100">
                    <div style="border-radius:200px; height:100px; width:100px; background: #F8FAF5; margin:0 auto;">
                        <i class="checkmark success-checkmark">✓</i>
                    </div>
                    <h1 class="success-header">Next!</h1> 
                    <p>
                        Confirm your Recurring Account Information to complete your New <?php echo $accountType; ?> Account!
                    </p>
                </div>                
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card card-bordered h-100">
                <div class="card-inner-group">
                    <div class="card-inner card-inner-md">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Please Confirm Your Recurring Schedule</h6>
                            </div>
                            <div class="card-tools me-n1">
                                <!-- <a class="btn btn-success text-white" href="<?php //echo site_url('/Budget/Approve-Recurring-Schedule/' . $accountID); ?>">Approve</a>
                                <a class="btn btn-danger text-white" href="<?php //echo site_url('/Budget/Cancel-Account/' . $accountID); ?>">Cancel</a> -->
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Account Name:</th>
                                    <td><?= $accountName; ?></td>
                                </tr>
                                <tr>
                                    <th>Account Type:</th>
                                    <td><?= $accountType; ?></td>
                                    <th>Account Source:</th>
                                    <td><?= $accountSourceType; ?></td>
                                </tr>
                                <tr>
                                    <th>Recurring:</th>
                                    <td><?= $accountRecAccount; ?></td>
                                    <th>Recurring Cycle:</th>
                                    <td><?= $accountIntervals; ?></td>
                                </tr>
                                <tr>
                                    <th>Date Due:</th>
                                    <td><?= $accountDesDate; ?></td>
                                    <th>Amount Due:</th>
                                    <td>$<?= number_format($accountNetAmount,2); ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><a class="btn btn-success text-white" href="<?php echo site_url('Budget/Edit/' . $accountID); ?>">Edit</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-lg-12">
            <div class="card card-bordered h-100">
                <div class="card-inner-group">
                    <div class="card-inner card-inner-md">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Please Confirm Your Recurring Schedule</h6>
                            </div>
                            <div class="card-tools me-n1">
                                <a class="btn btn-success text-white" href="<?php echo site_url('/Budget/Approve-Recurring-Schedule/' . $accountID); ?>">Approve</a>
                                <a class="btn btn-danger text-white" href="<?php echo site_url('/Budget/Cancel-Account/' . $accountID); ?>">Cancel</a>
                                <!-- <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger full-width" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="<?php //echo site_url('/Budget/Edit/' . $accountID); ?>"><em class="icon ni ni-setting"></em><span>Account Settings</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                                        </ul>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <table class="table table-hover display" id="#budgetRecurringTable">
                            <thead>
                                <tr>
                                    <th>Due Date</th>
                                    <th>Account</th>
                                    <th>Type</th>
                                    <th>Source</th>
                                    <th>Interval</th>
                                    <th>Amount</th>
                                    <th>Subtotal</th>
                                    <th class="text-center">More Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    // print_r($listedDates);
                                    // echo '<br>';
                                    // print_r($data);
                                    $sum = 0;
                                    echo '
                                    <tr>
                                        <td>' . $accountDesDate . '</td>
                                        <td>' . $accountName . '</td>
                                        <td>' . $accountType . '</td>
                                        <td>' . $accountSourceType     . '</td>
                                        <td>' . $accountIntervals . '</td>
                                        <td>' . $accountNetAmount . '</td>
                                        <td>' . number_format($accountNetAmount,2) . '</td>
                                        <td class="text-center">
                                            <a class="data-more" href="' . site_url('Budget/Recurring-Account/Edit/' . $accountID . $account['recurring_account_order']) . '" onClick="email_Switch(this)"><em class="icon ni ni-pen2"></em></a>
                                        </td>
                                    </tr>
                                    '; 
                                    $sum                                                    = $accountNetAmount;
                                    foreach($data as $id=>$account) {
                                        $accountDate                                        = $account['designated_date'];
                                        $accountMonth                                       = $newIntervalDate->format('m'); 
                                        $accountDay                                         = $newIntervalDate->format('d'); 
                                        $accountYear                                        = $newIntervalDate->format('Y'); 
                                        if (!empty($initialAmount)) {
                                            $sum                                            += $initialAmount;
                                        } else {
                                            $sum                                            = $sum;
                                        }
                                        $amountSummary                                      = $sum; 
                                        if ($account['initial_weeks_left'] == $account['last_date']) {
                                            continue; 
                                        } else {
                                            $submitData                                     = array(      
                                                'status'							        => $account['status'],
                                                'mode'							            => $account['mode'],
                                                'beta'								        => $account['beta'],
                                                'month'                                     => $account['month'], 
                                                'day'                                       => $account['day'], 
                                                'year'                                      => $account['year'], 
                                                'unix_timestamp'				            => time(),
                                                'created_by'						        => $account['created_by'],
                                                'created_by_email'	    			        => $account['created_by_email'],
                                                'username'							        => $account['username'],
                                                'name'							            => $account['name'],
                                                'net_amount'						        => $account['net_amount'],
                                                'gross_amount'						        => $account['gross_amount'],
                                                'account_summary'                           => $amountSummary,
                                                'recurring_account'				            => $account['recurring_account'],
                                                'recurring_account_primary' 	            => 'No',
                                                'recurring_account_id'  		            => $account['recurring_account_id'],
                                                'recurring_account_order'                   => $account['recurring_account_order'],
                                                'account_type'					            => $account['account_type'],
                                                'source_type'					            => $account['source_type'],
                                                'intervals'							        => $account['intervals'],
                                                'designated_date'			                => $accountDate,
                                                'initial_weeks_left'                        => '',
                                            );
                                            // echo '<br><br>'; 
                                            echo '
                                            <tr>
                                                <td>' . $accountDate . '</td>
                                                <td>' . $account['name'] . '</td>
                                                <td>' . $account['account_type'] . '</td>
                                                <td>' . $account['source_type'] . '</td>
                                                <td>' . $account['intervals'] . '</td>
                                                <td>' . $account['net_amount'] . '</td>
                                                <td>' . number_format($amountSummary,2) . '</td>
                                                <td class="text-center">
                                                    <a class="data-more" href="' . site_url('Budget/Recurring-Account/Edit/' . $accountID . $account['recurring_account_order']) . '" onClick="email_Switch(this)"><em class="icon ni ni-pen2"></em></a>
                                                </td>
                                            </tr>
                                            ';
                                            if ($accountRecSchedule != 1) {
                                                $this->db->insert('bf_users_budgeting', $submitData);

                                                $updateData                                 = array(
                                                    'recurring_schedule'                    => 1,
                                                );

                                                $this->db->where('id', $accountID); 
                                                $this->db->update('bf_users_budgeting', $updateData); 
                                            };
                                        }
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total:</strong></th>
                                    <td>$<?php echo number_format($amountSummary,2); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
