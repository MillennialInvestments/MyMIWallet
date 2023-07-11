	
<!-- <div class="nk-block">
    <div class="card card-bordered">
        <div class="card-body">

        </div>
    </div>
</div>     -->
<?php 
$debtAmount             = 20000;
// $months                 = 36; 
$months                 = 60; 
$totalDebt              = $debtAmount;
$debtTerm               = $months; 
$totalPerMonth          = $totalDebt / $debtTerm;
$coinMultiplier         = 1000; 
$totalCoins             = $debtAmount * $coinMultiplier; 
?>
<h4 class="nk-block-header page-title">Amortization Schedule</h4>
<!-- <table class="table">
    <tbody>
        <tr>
            <th>Loan Amount</th>
            <td><?php //'$' . number_format($totalDebt,2); ?></td>
        </tr>
        <tr>
            <th>Debt Term (Months)</th>
            <td><?php //$debtTerm; ?></td>
        </tr>
        <tr>
            <th>Monthly Recurring</th>
            <td><?php //'$' . number_format($totalPerMonth,2); ?></td>
        </tr>
        <tr>
            <th>Total Coins</th>
            <td><?php //number_format($totalCoins,0); ?> Coins</td>
        </tr>
    </tbody>
</table> -->
<?php 

?>