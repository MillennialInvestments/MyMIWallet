<?php 
$userAccount                                        = $_SESSION['allSessionData']['userAccount'];
$cuID                                               = $userAccount['cuID'];
$firstBudgetAccount                                 = $this->mymibudget->get_first_budget_account($cuID);
print_r($firstBudgetAccount['firstAccountMonth']);
$monthA                                             = $firstBudgetAccount['firstAccountMonth'];
$monthB                                             = $monthA + 1;
if (($monthB < 13)) {
    $monthB                                         = $monthB;
} else {
    $monthB                                         = 1;
}
$monthC                                             = $monthB + 1;
if (($monthC < 13)) {
    $monthC                                         = $monthC;
} else {
    $monthC                                         = 1;
}
$monthD                                             = $monthC + 1;
if (($monthD < 13)) {
    $monthD                                         = $monthD;
} else {
    $monthD                                         = 1;
}
$monthE                                             = $monthD + 1;
if (($monthE < 13)) {
    $monthE                                         = $monthE;
} else {
    $monthE                                         = 1;
}
$monthF                                             = $monthE + 1;
if (($monthF < 13)) {
    $monthF                                         = $monthF;
} else {
    $monthF                                         = 1;
}
$monthG                                             = $monthF + 1;
if (($monthG < 13)) {
    $monthG                                         = $monthG;
} else {
    $monthG                                         = 1;
}
$monthH                                             = $monthG + 1;
if (($monthH < 13)) {
    $monthH                                         = $monthH;
} else {
    $monthH                                         = 1;
}
$monthI                                             = $monthH + 1;
if (($monthI < 13)) {
    $monthI                                         = $monthI;
} else {
    $monthI                                         = 1;
}
$monthJ                                             = $monthI + 1;
if (($monthJ < 13)) {
    $monthJ                                         = $monthJ;
} else {
    $monthJ                                         = 1;
}
$monthK                                             = $monthJ + 1;
if (($monthK < 13)) {
    $monthK                                         = $monthK;
} else {
    $monthK                                         = 1;
}
$monthL                                             = $monthK + 1;
if (($monthL < 13)) {
    $monthL                                         = $monthL;
} else {
    $monthL                                         = 1;
}
?>
<div class="card card-bordered pricing">
    <div class="pricing-head">
        <div class="pricing-title">
            <h4 class="card-title title">Financial Forecasting</h4>
            <p class="sub-text"><?php //$monthASum; ?></p>
        </div>
    </div>
    <div class="pricing-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Year</th>
                    <th class="text-center"><?php echo $monthA; ?></th>
                    <th class="text-center"><?php echo $monthB; ?></th>
                    <th class="text-center"><?php echo $monthC; ?></th>
                    <th class="text-center"><?php echo $monthD; ?></th>
                    <th class="text-center"><?php echo $monthE; ?></th>
                    <th class="text-center"><?php echo $monthF; ?></th>
                    <th class="text-center"><?php echo $monthG; ?></th>
                    <th class="text-center"><?php echo $monthH; ?></th>
                    <th class="text-center"><?php echo $monthI; ?></th>
                    <th class="text-center"><?php echo $monthJ; ?></th>
                    <th class="text-center"><?php echo $monthK; ?></th>
                    <th class="text-center"><?php echo $monthL; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $monthASum                          = 0;
                $monthBSum                          = 0;
                $monthCSum                          = 0;
                $monthDSum                          = 0;
                $monthESum                          = 0;
                $monthFSum                          = 0;
                $monthGSum                          = 0;
                $monthHSum                          = 0;
                $monthISum                          = 0;
                $monthJSum                          = 0;
                $monthKSum                          = 0;
                $monthLSum                          = 0;
                $this->db->from('bf_users_budgeting'); 
                $this->db->where('created_by', $cuID); 
                $this->db->where('status', 1); 
                $getUserBudgets                     = $this->db->get(); 
                foreach($getUserBudgets->result_array() as $budget) {
                    if ($budget['account_type'] === 'Income') {
                        if ($budget['month'] === $monthA) {
                            $monthASum              += $budget['net_amount'];
                        } elseif ($budget['month'] === $monthB) {
                            $monthBSum              += $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthC) {
                            $monthCSum              += $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthD) {
                            $monthDSum              += $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthE) {
                            $monthESum              += $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthF) {
                            $monthFSum              += $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthG) {
                            $monthGSum              += $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthH) {
                            $monthHSum              += $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthI) {
                            $monthISum              += $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthJ) {
                            $monthJSum              += $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthK) {
                            $monthKSum              += $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthL) {
                            $monthLSum              += $budget['net_amount']; 
                        } 
                    } elseif ($budget['account_type'] === 'Expense') {
                        if ($budget['month'] === $monthA) {
                            $monthASum              += '-' . $budget['net_amount'];
                        } elseif ($budget['month'] === $monthB) {
                            $monthBSum              += '-' . $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthC) {
                            $monthCSum              += '-' . $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthD) {
                            $monthDSum              += '-' . $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthE) {
                            $monthESum              += '-' . $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthF) {
                            $monthFSum              += '-' . $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthG) {
                            $monthGSum              += '-' . $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthH) {
                            $monthHSum              += '-' . $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthI) {
                            $monthISum              += '-' . $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthJ) {
                            $monthJSum              += '-' . $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthK) {
                            $monthKSum              += '-' . $budget['net_amount']; 
                        } elseif ($budget['month'] === $monthL) {
                            $monthLSum              += '-' . $budget['net_amount']; 
                        } 
                    }
                    $accountMonth                   = $budget['month'];
                    $accountDay                     = $budget['day'];
                    $accountYear                    = $budget['year'];
                }
                echo '
                <tr>
                    <td>' . $accountYear. '</td>
                    <td>' . $monthASum . '</td>
                    <td>' . $monthBSum . '</td>
                    <td>' . $monthCSum . '</td>
                    <td>' . $monthDSum . '</td>
                    <td>' . $monthESum . '</td>
                    <td>' . $monthFSum . '</td>
                    <td>' . $monthGSum . '</td>
                    <td>' . $monthHSum . '</td>
                    <td>' . $monthISum . '</td>
                    <td>' . $monthJSum . '</td>
                    <td>' . $monthKSum . '</td>
                    <td>' . $monthLSum . '</td>
                </tr>
                ';
                ?>
            </tbody>
        </table>
    </div>
</div>