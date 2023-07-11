<?php 
if ($this->agent->is_mobile()) {
    echo '<table class="table table-default default" id="userBudgetingDatatable">';
} elseif ($this->agent->is_browser()) {
    echo '<table class="table table-default default" id="userBudgetingDatatable">';
}
?>

    <thead>
        <?php
        if ($this->agent->is_mobile()) {
            echo '
            <tr>
                <th class="d-none"></th>
                <th>Account</th>
                <th>Amount</th>
                <th>Subtotal</th>
            </tr>';
        } elseif ($this->agent->is_browser()) {
            echo '<tr>
                <th class="d-none"></th>
                <th>Due Date</th>
                <th>Account</th>
                <th>Source</th>
                <th>Wallet</th>
                <th>Amount</th>
                <th>Subtotal</th>
                <th>Actions</th>
            </tr>';
        }
        ?>
    </thead>
    <tbody>
        <?php
        $sum                                = 0;
        // // $getBankingAccounts                 = $this->budget_model->get_bank_account_summary($cuID); 
        $this->db->select_sum('balance');
        $this->db->from('bf_users_bank_accounts'); 
        $this->db->where('user_id', $cuID); 
        // $this->db->where('status', 1);
        $getBankAccounts                    = $this->db->get(); 
        // $getBankAccounts                    = $this->wallet_model->get_user_bank_accounts($cuID); 
        // print_r($getBankAccounts->result_array());
        if(empty($getBankAccounts->result_array())) {
            $bankAccountBalance             = 0;
        } else {
            $bankAccountBalance             = $getBankAccounts->result_array()[0]['balance'];
        } 
        $sum                                += $bankAccountBalance;
        if ($this->agent->is_mobile()) {
            $displayedDate                  = date("m") . '/1/' . date("Y");
            echo '
            <tr>
                <td class="d-none">' . date("Y-m-1", strtotime(date("Y") . '-' . date("m") . '-01')) . '</td>
                <td>
                    <a class="badge badge-xs badge-dim rounded-pill bg-primary text-white px-4" href="' . site_url('/Wallets') . '">Bank Accounts</a><br>
                </td>
                <td>' . number_format($bankAccountBalance,2) . '</td>
                <td>$' . number_format($sum,2) . '</td>
            </tr>
            ';         
        } elseif ($this->agent->is_browser()) {
            $displayedDate                  = date("F") . ' 1st, ' . date("Y");
            echo '
            <tr>
                <td class="d-none">' . date("Y-m-1", strtotime(date("Y") . '-' . date("m") . '-01')) . '</td>
                <td>' . $displayedDate. '</td>
                <td><a class="badge badge-sm badge-dim rounded-pill bg-primary text-white px-4" href="' . site_url('/Wallets') . '">Bank Accounts</a></td>
                <td></td>
                <td></td>
                <td>' . number_format($bankAccountBalance,2) . '</td>
                <td>$' . number_format($sum,2) . '</td>
                <td>
                    <a class="badge badge-sm badge-dim rounded-pill bg-success text-white addBankAccount" data-toggle="modal" data-target="#transactionModal"><i class="icon ni ni-plus"></i></a>
                    <a class="badge badge-sm badge-dim rounded-pill bg-primary text-white" href="' . site_url('Wallets') . '">Manage</a>
                </td>
            </tr>
            ';         
        }     
        // $getBankingAccounts                 = $this->budget_model->get_bank_account_summary($cuID); 
        $this->db->select_sum('available_balance');
        $this->db->from('bf_users_credit_accounts'); 
        $this->db->where('user_id', $cuID); 
        // $this->db->where('status', 1);
        $getCreditAccounts                  = $this->db->get(); 
        // print_r($getCreditAccounts->result_array());
        if(empty($getCreditAccounts->result_array())) {
            $creditAccountBalance           = 0;
        } else {
            $creditAccountBalance           = $getCreditAccounts->result_array()[0]['available_balance'];
        } 
        $sum                                += $creditAccountBalance;
        if ($this->agent->is_mobile()) {
            $displayedDate                  = date("m") . '/1/' . date("Y");
            echo '
            <tr>
                <td class="d-none">' . date("Y-m-1", strtotime(date("Y") . '-' . date("m") . '-01')) . '</td>
                <td><a class="badge badge-xs badge-dim rounded-pill bg-primary text-white px-4" href="' . site_url('/Wallets') . '">Credit Accounts</a></td>
                <td>' . number_format($creditAccountBalance,2) . '</td>
                <td>$' . number_format($sum,2) . '</td>
            </tr>
            ';         
        } elseif ($this->agent->is_browser()) {
            $displayedDate                  = date("F") . ' 1st, ' . date("Y");
            echo '
            <tr>
                <td class="d-none">' . date("Y-m-1", strtotime(date("Y") . '-' . date("m") . '-01')) . '</td>
                <td>' . $displayedDate. '</td>
                <td><a class="badge badge-sm badge-dim rounded-pill bg-warning text-white px-4" href="' . site_url('/Wallets') . '">Credit Accounts</a></td>
                <td class="d-none d-lg-block"></td>
                <td></td>
                <td>' . number_format($creditAccountBalance,2) . '</td>
                <td>$' . number_format($sum,2) . '</td>
                <td>
                    <a class="badge badge-sm badge-dim rounded-pill bg-success text-white addBankAccount" data-toggle="modal" data-target="#transactionModal"><i class="icon ni ni-plus"></i></a>
                    <a class="badge badge-sm badge-dim rounded-pill bg-primary text-white" href="' . site_url('Wallets') . '">Manage</a>
                </td>
            </tr>
            ';      
        }                                       
        // // Investment Summaries
        // // $getInvestAccounts                  = $this->budget_model->get_bank_account_summary($cuID); 
        // // $this->db->from('bf_users_brokerage_accounts'); 
        // $this->db->select_sum('amount');
        // $this->db->select_sum('amount');
        // $this->db->from('bf_users_invest_accounts'); 
        // $this->db->where('user_id', $cuID); 
        // $getInvestAccounts                  = $this->db->get(); 
        // // print_r($getInvestAccounts->result_array());
        // if(empty($getInvestAccounts->result_array())) {
        //     $investAccountBalance           = 0;
        // } else {
        //     $investAccountBalance           = $getInvestAccounts->result_array()[0]['amount'];
        // } 
        // $sum                                += $investAccountBalance;
        // if ($this->agent->is_mobile()) {
        //     $displayedDate                  = date("m") . '/1/' . date("Y");
        //     echo '
        //     <tr>
        //         <td class="d-none">' . date("Y-m-1", strtotime(date("Y") . '-' . date("m") . '-01')) . '</td>
        //         <td><a class="badge badge-xs badge-dim rounded-pill bg-success text-white px-4" href="' . site_url('/Wallets') . '">Investments</a></td>
        //         <td>' . number_format($investAccountBalance,2) . '</td>
        //         <td>$' . number_format($sum,2) . '</td>
        //     </tr>
        //     ';         
        // } elseif ($this->agent->is_browser()) {
        //     $displayedDate                  = date("F") . ' 1st, ' . date("Y");
        //     echo '
        //     <tr>
        //         <td class="d-none">' . date("Y-m-1", strtotime(date("Y") . '-' . date("m") . '-01')) . '</td>
        //         <td>' . $displayedDate. '</td>
        //         <td><a class="badge badge-sm badge-dim rounded-pill bg-warning text-white px-4" href="' . site_url('/Wallets') . '">Investments</a></td>
        //         <td class="d-none d-lg-block"></td>
        //         <td></td>
        //         <td>' . number_format($investAccountBalance,2) . '</td>
        //         <td>$' . number_format($sum,2) . '</td>
        //         <td>
        //         <a class="badge badge-sm badge-dim rounded-pill bg-success text-white" href="' . site_url('Wallets') . '">Add</a>
        //         <a class="badge badge-sm badge-dim rounded-pill bg-primary text-white" href="' . site_url('Wallets') . '">Manage</a>
        //         </td>
        //     </tr>
        //     ';      
        // }      
        
        $maxLength                          = 15;
        $getBudgets                         = $this->budget_model->get_accounts_order_asc_by_date_unpaid($cuID);
        foreach($getBudgets->result_array() as $account) {
            if ($account['account_type'] === 'Income') {
                $accountNetAmount           = $account['net_amount'];
                $accountNetAmountDisplay    = number_format($accountNetAmount,2);
            } elseif ($account['account_type'] === 'Expense') {
                $accountNetAmount           = '-' . $account['net_amount'];
                $accountNetAmountDisplay    = '<span class="statusRed">' . number_format($accountNetAmount,2). '</span>';
            }
            if ($account['paid'] == 0) {
                $accountPaidStatus          = '<a href="' . site_url('Budget/Status/Paid/' . $account['id']) . '"><i class="icon myfs-md ni ni-check-thick"></i></a>';
                $sum                        += $accountNetAmount;
            } else {
                $accountPaidStatus          = '<a class="statusGreen" href="' . site_url('Budget/Status/Unpaid/' . $account['id']) . '"><i class="icon myfs-md ni ni-check-thick"></i></a>';
                $sum                        += 0;
            }
            if ($sum >= 0) {
                $sumDisplay                 = '$' . number_format($sum,2);
            } elseif ($sum < 0) {
                $sumDisplay                 = '<span class="statusRed">$' . number_format(($sum * -1),2) . '</span>';
            }
            $accountNewDate                 = $account['designated_date']; 
            $this->db->from('bf_users_wallet');
            $this->db->where('user_id', $cuID);
            $this->db->where('active', 'Yes');
            $getUserWallets                 = $this->db->get();
            $this->db->from('bf_users_wallet');
            $this->db->where('id', $account['wallet_id']);
            $getUserWallet                  = $this->db->get();
            $accountName                    = $account['name']; 
            if (strlen($accountName) > $maxLength) {
                $accountNameDisplay         = substr($accountName, 0, $maxLength) . "...";
              } else {
                $accountNameDisplay         = $accountName;
              }
            if ($this->agent->is_mobile()) {
                $displayedDate                  = date("m") . '/1/' . date("Y");
                echo '
                <tr>
                    <td class="d-none">' . date("Y-m-1", strtotime(date("Y") . '-' . date("m") . '-01')) . '</td>
                    <td><a href="' . site_url('Budget/Details/' . $account['id']) . '">' . $accountNameDisplay . '</a></td>
                    <td>' . $accountNetAmountDisplay . '</td>
                    <td>' . $sumDisplay . '</td>
                </tr>
                ';         
            } elseif ($this->agent->is_browser()) {
                echo '
                <tr>
                    <td class="d-none">' . date("Y-m-d", strtotime($account['year'] . '-' . $account['month'] . '-' . $account['day'])) . '</td>
                    <td>' . date("F jS, Y", strtotime($account['year'] . '-' . $account['month'] . '-' . $account['day'])) . '</td>
                    <td><a href="' . site_url('Budget/Details/' . $account['id']) . '">' . $account['name'] . '</a></td>
                    <td>' . $account['source_type'] . '</td>
                    <td>';    
                        if (!empty($account['wallet_id'])) {
                            foreach ($getUserWallet->result_array() as $userWallets) {
                                if (!empty($userWallets['wallet_type'] === 'Banking')) {
                                    if ($getUserWallet->num_rows() > 0) {
                                        echo '
                                            <a href="' . site_url('Wallets/' . $account['account_type'] . '/Details/' . $account['id']) . '/' . $userWallets['id'] . '"><span>' . $userWallets['nickname'] . '</span></a>
                                        ';
                                    }
                                }
                            } 
                        } else {     
                            echo '
                            <div class="dropdown">      
                                <a class="badge badge-sm badge-dim rounded-pill bg-primary text-white dropdown-toggle" href="#" type="button" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em> Wallet</a>      
                                <div class="dropdown-menu">
                                    <ul class="link-list-opt">
                                        <li class="p-1 fw-bold">Bank Accounts</li>
                                    ';
                                    foreach ($getUserWallets->result_array() as $userWallets) {
                                        if (!empty($userWallets['wallet_type'] === 'Banking')) {
                                            if ($getUserWallets->num_rows() > 0) {
                                                echo '
                                                <li><a href="' . site_url('Wallets/Attach-Account/' . $account['account_type'] . '/' . $account['id']) . '/' . $userWallets['id'] . '"><span>' . $userWallets['nickname'] . '</span></a></li>    
                                                ';
                                            }
                                        }
                                    }      
                                echo '
                                    </ul>   
                                    <ul class="link-list-opt">
                                        <li class="p-1 fw-bold">Credit Accounts</li>
                                    ';
                                    foreach ($getUserWallets->result_array() as $userWallets) {
                                        if (!empty($userWallets['wallet_type'] === 'Credit')) {
                                            if ($getUserWallets->num_rows() > 0) {
                                                echo '
                                                <li><a href="' . site_url('Wallets/Attach-Account/' . $account['account_type'] . '/' . $account['id']) . '/' . $userWallets['id'] . '"><span>' . $userWallets['nickname'] . '</span></a></li>    
                                                ';
                                            }
                                        }
                                    }            
                                echo '  
                                        <li><a href="' . site_url('Wallets') . '"><span><em class="icon icon-xs ni ni-plus"></em> Create Wallet</span></a></li>    
                                    </ul>      
                                </div>    
                            </div>';
                        }
                    echo '
                    </td>
                    <td>' . $accountNetAmountDisplay . '</td>
                    <td>' . $sumDisplay . '</td>
                    <td>
                        ' . $accountPaidStatus . '
                        <a href="' . site_url('Budget/Edit/' . $account['id']) . '"><i class="icon  myfs-md ni ni-edit"></i></a>
                        <a href="' . site_url('Budget/Copy/' . $account['id']) . '"><i class="icon  myfs-md ni ni-copy"></i></a>
                        <a class="text-red" href="' . site_url('Budget/Delete-Account/' . $account['id']) . '"><i class="icon myfs-md ni ni-trash"></i></a>
                    </td>
                </tr>';
            }
        };
        ?>
    </tbody>
</table>