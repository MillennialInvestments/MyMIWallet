<?php
$managementActionItems = $this->config->item('managementActionItems');
$userAccount = $_SESSION['allSessionData']['userAccount'];
$cuID = $userAccount['cuID'];
$accountType = $this->uri->segment(2);

if ($accountType === 'Expenses') {
    $accountType = 'Expense';
}

$startOfCurrentPeriod = date('Y-m-d H:i:s', strtotime(date('Y-m-01')));
$totalIncome = 0;
$totalLastIncome = 0;
$totalExpenses = 0;
$threeMonthExpenses = $totalExpenses * 3;
$sixMonthExpenses = $totalExpenses * 3;
$twelveMonthExpenses = $totalExpenses * 3;
$totalLastExpenses = 0;
$totalSurplus = $totalIncome - $totalExpenses;
$totalInvestPercentage = 0;
$totalInvestment = $totalSurplus * $totalInvestPercentage;

$this->db->from('bf_users_budgeting');
$this->db->where('status', 1);
$this->db->where('account_type', $accountType);
$this->db->where('created_by', $cuID);
$getSources = $this->db->get();
$sources = [];
$lastSources = []; 
$totalSourceBreakdown = 0;
$totalSourceAccount = 0;

function calculateChange($current, $last)
{
    if ($last == 0) {
        return $current * 100;
    }
    return (($current - $last) / $last) * 100;
}

foreach ($getSources->result_array() as $source) {
    $sourceType = $source['source_type'];
    $amount = $source['net_amount'];
    $totalSourceAccount += $amount;
    if (!array_key_exists($sourceType, $sources)) {
        $sources[$sourceType] = 0;
    }
    $sources[$sourceType] += $amount;
}

$sourceBreakdown = [];
$colors = ["#798bff", "#baaeff", "#7de1f8"];
$colorIndex = 0;

$uniqueSources = []; // Array to store unique source types

foreach ($getSources->result_array() as $source) {
    $sourceType = $source['source_type'];
    $amount = $source['net_amount'];

    if (!isset($uniqueSources[$sourceType])) {
        $uniqueSources[$sourceType] = $amount;

        $totalSourceAccount += $amount;

        $lastAmount = array_key_exists($sourceType, $lastSources) ? $lastSources[$sourceType] : 0;
        $change = calculateChange($amount, $lastAmount);

        $percentage = ($amount / $totalSourceAccount) * 1000;
        $sourceBreakdown[] = [
            'source_type' => $sourceType,
            'percentage' => number_format($percentage, 2),
            'color' => $colors[$colorIndex],
            'change' => number_format($change, 2)
        ];

        $colorIndex = ($colorIndex + 1) % count($colors);
    }
}

$viewFileData = [
    'accountType' => $accountType,
    'totalIncome' => $totalIncome,
    'totalLastIncome' => $totalLastIncome,
    'totalExpenses' => $totalExpenses,
    'totalLastExpenses' => $totalLastExpenses,
    'totalSurplus' => $totalSurplus,
    'totalInvestment' => $totalInvestment,
    'getSources' => $getSources,
    'sourceBreakdown' => $sourceBreakdown,
];

// print_r($viewFileData);

?><style>.nk-order-ovwg-data.income{border-color:#8ff0d6}.nk-order-ovwg-data.expenses{border-color:#e85347}.nk-order-ovwg-data.surplus{border-color:#84b8ff}.nk-order-ovwg-data.investments{border-color:#f4bd0e}</style>
<div class="nk-block">
    <div class="row">
        <div class="col-lg-4">
            <?php $this->load->view('Budget/Account_Overview/action_center', $viewFileData); ?>
        </div>
        <div class="col-lg-8">
            <?php $this->load->view('Budget/Account_Overview/monthly_overview', $viewFileData); ?>
        </div>
    </div>
</div>
<div class="nk-block">
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <?php $this->load->view('Budget/Account_Overview/source_breakdown', $viewFileData); ?>
        </div>
        <div class="col-lg-8 col-sm-6">
            <?php $this->load->view('Budget/Account_Overview/history_overview', $viewFileData); ?>
        </div>
    </div>
</div>
