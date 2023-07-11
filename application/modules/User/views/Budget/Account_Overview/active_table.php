<?php 
foreach($getIncomeAccounts->result_array() as $income){
    $sourceType                     = $income['source_type'];
    $amount                         = $income['net_amount'];
    $totalIncome                    += $amount;
    if (!array_key_exists($sourceType, $incomeSources)) {
        $incomeSources[$sourceType] = 0;
    }
    $incomeSources[$sourceType] += $amount;
}
?>
<div class="card card-bordered h-100">
    <div class="card-inner">
        <div class="nk-order-ovwg">
            <div class="row g-4 align-end">
                <div class="col-12 pr-3">
                    <div class="card-title-group align-start mb-3">
                        <div class="card-title">
                            <h6 class="title">Monthly <?php echo $accountType; ?> Overview</h6>
                            <p>Last 12 Months of Total Monthly Spend &amp; Total Transaction Fees.</p>
                        </div>
                        <div class="card-tools mt-n1 me-n1">
                            <div class="drodown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger full-width" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a href="#" class="active"><span>15 Days</span></a></li>
                                        <li><a href="#"><span>30 Days</span></a></li>
                                        <li><a href="#"><span>3 Months</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="default table" id="userBudgetingIncomeDatatable">
                        <thead>
                            <tr>
                                <th>Income Source</th>
                                <th>Amount</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($incomeSources as $source => $amount) {
                                $percentage = round(($amount / $totalIncome) * 100, 2);
                                echo '
                                <tr>
                                    <td>' . $source . '</td>
                                    <td>$' . $amount . '</td>
                                    <td>' . $percentage . '%</td>
                                </tr>
                                ';
                            }
                            ?>
                            <tr>
                                <td><strong>Total Income</strong></td>
                                <td><strong><?php echo '$' . $totalIncome; ?></strong></td>
                                <td><strong>100%</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- .nk-order-ovwg -->
    </div><!-- .card-inner -->
</div><!-- .card -->