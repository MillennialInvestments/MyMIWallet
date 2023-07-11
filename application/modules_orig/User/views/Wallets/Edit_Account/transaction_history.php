<div class="nk-block nk-block-lg">   
    <div class="card card-bordered pricing">
        <div class="pricing-head">
            <div class="pricing-title">
                <h4 class="card-title title">Transaction History</h4>
                <p class="sub-text">View and manage your Account Transaction History</p>
            </div>
        </div>
        <div class="pricing-body">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-12 py-2">
                    <table class="table table-default datatableOverview">
                        <thead>
                            <tr>
                                <th class="d-none"></th>
                                <th>Due Date</th>
                                <th>Account</th>
                                <th>Source</th>
                                <th>Amount</th>
                                <th>Subtotal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // print_r($getAccountTransactions);
                            $sum                                    = 0; 
                            if (!empty($getAccountTransactions)) {
                                foreach ($getAccountTransactions->result_array() as $transaction) {
                                    if ($transaction['account_type'] === 'Income') {
                                        $accountNetAmount           = $transaction['net_amount'];
                                    } elseif ($transaction['account_type'] === 'Expense') {
                                        $accountNetAmount           = '-' . $transaction['net_amount'];
                                    }
                                    $sum                            += $accountNetAmount;
                                    if ($transaction['paid'] == 0) {
                                        $accountPaidStatus          = '<a href="' . site_url('Budget/Status/Paid/' . $transaction['id']) . '"><i class="icon myfs-md ni ni-check-thick"></i></a>';
                                    } else {
                                        $accountPaidStatus          = '<a class="statusGreen" href="' . site_url('Budget/Status/Unpaid/' . $transaction['id']) . '"><i class="icon myfs-md ni ni-check-thick"></i></a>';
                                    }
                                    if ($sum >= 0) {
                                        $sumDisplay                 = '$' . number_format($sum,2);
                                    } elseif ($sum < 0) {
                                        $sumDisplay                 = '<span class="statusRed">-$' . number_format(($sum * -1),2) . '</span>';
                                    }
                                    $accountNewDate                 = $transaction['designated_date']; 
                                    echo '
                                    <tr>
                                        <td class="d-none">' . $transaction['id'] . '</td>
                                        <td>' . date("F jS, Y", strtotime($transaction['year'] . '-' . $transaction['month'] . '-' . $transaction['day'])) . '</td>
                                        <td>' . $transaction['name'] . '</td>
                                        <td>' . $transaction['source_type'] . '</td>
                                        <td>' . number_format($accountNetAmount,2) . '</td>
                                        <td>' . $sumDisplay . '</td>
                                        <td>
                                            ' . $accountPaidStatus . '
                                            <a href="' . site_url('Budget/Edit/' . $transaction['id']) . '"><i class="icon  myfs-md ni ni-edit"></i></a>
                                            <a class="text-red" href="' . site_url('Budget/Delete-Account/' . $transaction['id']) . '"><i class="icon myfs-md ni ni-cross-circle"></i></a>
                                        </td>
                                    </tr>
                                    ';
                                }
                            } else {
                                echo '
                                <tr>
                                    <td class="d-none">' . $transaction['id'] . '</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="pricing-action mt-0">
                <p class="sub-text">Need additional assistance or support?<br>Contact us via <a href="">email</a> or simply click below:</p>
                <a class="btn btn-primary btn-sm" href="<?php echo site_url('/Support'); ?>"><i class="icon ni ni-envelope"></i>Contact Support</a>
            </div>
        </div>
    </div>
</div>