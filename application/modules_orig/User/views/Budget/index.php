<?php
// Site Settings 
$beta                               = $this->config->item('beta');
$investmentOperations               = $this->config->item('investment_operations');
// User Account Information
$userAccount                        = $_SESSION['allSessionData']['userAccount'];
$userBudget                         = $_SESSION['allSessionData']['userBudget'];
// print_r($userBudget); 
// echo '<br><br>';
// print_r($userAccount);
$cuID                               = $userAccount['cuID'];
$cuRole                             = $userAccount['cuRole'];
// echo $cuRole; 
// Time Configurations
$current_year                       = date('Y');
$thisMonth                          = strtotime(date("m/1/Y"));
$sixMonthsAgo                       = date($thisMonth, strtotime("-6 months"));
$sixMonthsAhead                     = date($thisMonth, strtotime("-6 months"));
$last_year                          = date('Y') - 1;
$next_year                          = date('Y') + 1;
$current_date                       = date('m/d/Y');
$last_year_date                     = date('m/d' . $last_year);
$next_year_date                     = date('m/d' . $next_year);
$end_of_year                        = date('m/d/Y', strtotime('12/31'));
$daysLeft                           = date('dd', strtotime($end_of_year)) - date('dd', strtotime($current_date));
$weeksLeft                          = date('W', strtotime($end_of_year)) - date('W', strtotime($current_date));
$monthsLeft                         = date('m', strtotime($end_of_year)) - date('m', strtotime($current_date));
// Management Configurations
$managementActionItems              = $this->config->item('managementActionItems');

// ***New Library Configurations***
// Get User Investor Profile Savings Percentage
// Temporary Selection of 30%
$monthlySavingsPercentage           = 0.3;
$monthlySavingsPercentageFMT        = number_format($monthlySavingsPercentage * 100,0) . '%';
// !! MyMI Budget Variable Configuration (applications/libraries/MyMIBudget.php -> Function: all_user_budget_info($cuID)
$userBudgetRecords                  = $userBudget['userBudgetRecords'];
$thisMonthsIncome                   = $userBudget['thisMonthsIncome'];
$thisMonthsIncomeFMT                = $userBudget['thisMonthsIncomeFMT'];
$thisMonthsExpense                  = $userBudget['thisMonthsExpense'];
$thisMonthsExpenseFMT               = $userBudget['thisMonthsExpenseFMT'];
$thisMonthsExpense                  = $userBudget['thisMonthsExpense'];
$thisMonthsExpenseFMT               = $userBudget['thisMonthsExpenseFMT'];
$thisMonthsSurplus                  = $userBudget['thisMonthsSurplus'];
$thisMonthsSurplusFMT               = $userBudget['thisMonthsSurplusFMT'];
$thisMonthsInvestments              = $userBudget['thisMonthsInvestments'];
$thisMonthsInvestmentsFMT           = $userBudget['thisMonthsInvestmentsFMT'];
$thisMonthsInvestmentsSplitFMT      = $userBudget['thisMonthsInvestmentsSplitFMT'];
$lastMonthsIncome                   = $userBudget['lastMonthsIncome'];
$lastMonthsIncomeFMT                = $userBudget['lastMonthsIncomeFMT'];
$lastMonthsExpense                  = $userBudget['lastMonthsExpense'];
$lastMonthsExpenseFMT               = $userBudget['lastMonthsExpenseFMT'];
$lastMonthsSurplus                  = $userBudget['lastMonthsSurplus'];
$lastMonthsSurplusFMT               = $userBudget['lastMonthsSurplusFMT'];
$lastMonthsInvestments              = $userBudget['lastMonthsInvestments'];
$lastMonthsInvestmentsFMT           = $userBudget['lastMonthsInvestmentsFMT'];
$totalIncome                        = $userBudget['totalIncome'];
$totalIncomeFMT                     = $userBudget['totalIncomeFMT'];
$totalExpense                       = $userBudget['totalExpense'];
$totalExpenseFMT                    = $userBudget['totalExpenseFMT'];
$totalSurplus                       = $userBudget['totalSurplus'];
$totalSurplusFMT                    = $userBudget['totalSurplusFMT'];
$totalInvestments                   = $userBudget['totalInvestments'];
$totalInvestmentsFMT                = $userBudget['totalInvestmentsFMT'];
$checkingSummary                    = $userBudget['checkingSummary'];
$checkingSummaryFMT                 = $userBudget['checkingSummaryFMT'];
$incomeYTDSummary                   = $userBudget['incomeYTDSummary'];
$incomeYTDSummaryFMT                = $userBudget['incomeYTDSummaryFMT'];
$expenseYTDSummary                  = $userBudget['expenseYTDSummary'];
$expenseYTDSummaryFMT               = $userBudget['expenseYTDSummaryFMT'];
$creditLimit                        = $userBudget['creditLimit'];
$creditLimitFMT                     = $userBudget['creditLimitFMT'];
$creditAvailable                    = $userBudget['creditAvailable'];
$creditAvailableFMT                 = $userBudget['creditAvailableFMT'];
$debtSummary                        = $userBudget['debtSummary'];
$debtSummaryFMT                     = $userBudget['debtSummaryFMT'];
$totalAccountBalance                = $userBudget['totalAccountBalance'];
$totalAccountBalanceFMT             = $userBudget['totalAccountBalanceFMT'];
$allViewData                        = array(
    'beta'                          => $beta,
    'investmentOperations'          => $investmentOperations,
    'cuID'                          => $cuID,
    'userBudgetRecords'             => $userBudgetRecords,
    'monthlySavingsPercentageFMT'   => $monthlySavingsPercentageFMT,
    'checkingSummaryFMT'            => $checkingSummaryFMT,
    'incomeYTDSummaryFMT'           => $incomeYTDSummaryFMT,
    'expenseYTDSummaryFMT'          => $expenseYTDSummaryFMT,
    'thisMonthsIncomeFMT'           => $thisMonthsIncomeFMT,
    'thisMonthsExpenseFMT'          => $thisMonthsExpenseFMT,
    'thisMonthsSurplusFMT'          => $thisMonthsSurplusFMT,
    'thisMonthsInvestmentsFMT'      => $thisMonthsInvestmentsFMT,
    'thisMonthsInvestmentsSplitFMT' => $thisMonthsInvestmentsSplitFMT,
    'lastMonthsIncomeFMT'           => $lastMonthsIncomeFMT,
    'lastMonthsExpenseFMT'          => $lastMonthsExpenseFMT,
    'lastMonthsSurplusFMT'          => $lastMonthsSurplusFMT,
    'lastMonthsInvestmentsFMT'      => $lastMonthsInvestmentsFMT,
    'totalIncomeFMT'                => $totalIncomeFMT,
    'totalExpenseFMT'               => $totalExpenseFMT,
    'totalSurplusFMT'               => $totalSurplusFMT,
    'totalInvestmentsFMT'           => $totalInvestmentsFMT,
    'creditLimit'                   => $creditLimit,
    'creditLimitFMT'                => $creditLimitFMT,
    'creditAvailable'               => $creditAvailable,
    'creditAvailableFMT'            => $creditAvailableFMT,
    'debtSummary'                   => $debtSummary,
    'debtSummaryFMT'                => $debtSummaryFMT,
    'totalAccountBalance'           => $totalAccountBalance,
    'totalAccountBalanceFMT'        => $totalAccountBalanceFMT,
);
?>
<style>
    @media only screen and (max-width: 768px) {
        #userBudgetingDatatable_filter {
            padding-top: 1rem;
            text-align: left; 
        }
    }
    .nk-order-ovwg-data.income {
        border-color: #8ff0d6;
    }
    .nk-order-ovwg-data.expenses {
        border-color: #e85347;
    }
    .nk-order-ovwg-data.surplus {
        border-color: #84b8ff;
    }
    .nk-order-ovwg-data.investments {
        border-color: #f4bd0e;
    }
    .nk-order-ovwg-data .amount {
        font-size: 1.25rem;
        font-weight: 700;
    }
</style>
<?php 
if ($this->agent->is_browser()) {
echo '
<div class="nk-block d-none d-sm-block">
    <div class="row">
        <div class="d-lg-none d-xl-block col-md-12 col-xl-3 my-sm-3">';
            $this->load->view('User/Budget/index/control_center', $allViewData);
        echo '
        </div><!-- .col -->
        <div class="d-none d-sm-block col-md-12 col-xl-9 my-sm-3">';
            $this->load->view('User/Budget/index/overview_chart', $allViewData);
        echo '
        </div>
    </div>
</div>
';
}
?>
<div id="budgeting-monthly-financial-overview"></div>
<div class="nk-block">
    <div class="row">
        <div class="col-sm-12 col-md-12 my-sm-3">
            <?php
            if ($this->agent->is_mobile()) {
                echo '<div class="card h-100">';
            } elseif ($this->agent->is_browser()) {
                echo '<div class="card card-bordered h-100">';
            };
            ?>
                <div class="card-inner px-2 px-lg-4">
                    <div class="nk-order-ovwg">
                        <?php 
                        if ($this->agent->is_browser()) {
                            echo '
                        <div class="row g-4 align-end">
                            <div class="col-12">
                                <div class="card-title-group align-start mb-3">
                                    <div class="card-title">
                                        <h6 class="title">Monthly Financial Overview</h6>
                                        <p>Last 12 Months of Total Monthly ßFinancial Growth.</p>
                                    </div>
                                </div>
                                <div class="card-title-group align-start mb-3">
                                    <div class="card-tools mt-n1 me-n1">
                                        <a class="btn btn-success btn-sm text-white" href="' . site_url('/Budget/Add/Income') . '"><i class="icon ni ni-plus"></i> Income</a>
                                        <a class="btn btn-danger btn-sm text-white" href="' . site_url('/Budget/Add/Expense') . '"><i class="icon ni ni-plus"></i> Expense</a>
                                    </div>
                                </div>
                                <!-- <div class="card-title-group align-start mb-3">
                                    <div class="card-tools mt-n1 me-n1">
                                        <ul class="nav nav-pills p-lg-3">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Current</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">';
                                        $this->load->view('User/Budget/index/active_table', $allViewData);
                                        echo '
                                    </div>
                                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">';
                                    //$this->load->view('User/Budget/index/historical_table', $allViewData);
                                    echo '
                                    </div>
                                </div>
                            </div>
                        </div>
                            ';
                        } elseif ($this->agent->is_mobile()) {
                            echo '
                            <div class="row g-4 align-end">
                                <div class="col-12 pr-3">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Monthly Financial Overview</h6>
                                            <p>Last 12 Months of Total Monthly ßFinancial Growth.</p>
                                        </div>
                                        <div class="card-tools mt-n1 me-n1">
                                            <a class="btn btn-success btn-xs text-white" href="' . site_url('/Budget/Add/Income') . '"><i class="icon ni ni-plus"></i> Income</a>
                                            <a class="btn btn-danger btn-xs text-white" href="' . site_url('/Budget/Add/Expense') . '"><i class="icon ni ni-plus"></i> Expense</a>
                                        </div>
                                    </div>
                                    <!-- <div class="card-title-group align-start mb-3">
                                        <div class="card-tools mt-n1 me-n1">
                                            <ul class="nav nav-pills p-lg-3">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Current</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">History</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">';
                                            $this->load->view('User/Budget/index/active_table', $allViewData);
                                            echo '
                                        </div>
                                        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">';
                                        //$this->load->view('User/Budget/index/historical_table', $allViewData);
                                        echo '
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        ?>
                    </div><!-- .nk-order-ovwg -->
                </div><!-- .card-inner -->
            </div><!-- .card -->
        </div>
    </div>
</div>
<script type="text/javascript">
const data = JSON.parse(document.querySelector("#budget-data").innerText); 
console.log(data);
const getMonthLabels = (start = { year: 0, month: 0, day: 0 }, end = { year: 0, month: 0, day: 0 }, showYears) => {
    const MONTHS = [
        'JAN',
        'FEB',
        'MAR',
        'APR',
        'MAY',
        'JUN',
        'JUL',
        'AUG',
        'SEP',
        'OCT',
        'NOV',
        'DEC'
    ];



    const yearsBetween = end.year - start.year + 1;
    const monthsBetween = end.month  - start.month +1 + 12 * (yearsBetween-1);;

    //We use these months as labels
    const myNames = [];

    for (let index = 0; index < monthsBetween; index++) {
        const currentMonth = start.month + index;
        const currentYear = showYears ? start.year + Math.floor((currentMonth - 1) / 12) : "";
        const element = MONTHS[(currentMonth - 1) % 12];
        myNames.push(`${element} ${currentYear}`);
    }

    return myNames;
}
/**
 * type: Expense, Income

 */
const expensesOrIncomes = (type, budgetData,start = {year:0, month:0, day:0},end = {year:0,month:0,day:0} ) =>{
    const result = new Map([]);

    budgetData
    .filter((element) =>{
        const elementNumericalDate= parseInt(element.year)*10000+parseInt(element.month)*100+parseInt(element.day);
        const startNumericalDate= start.year*10000+start.month*100+start.day;
        const endNumericalDate=end.year*10000+end.month*100+end.day;

        return (element.account_type == type &&
        elementNumericalDate >= startNumericalDate&&
        elementNumericalDate<= endNumericalDate)
    })
    //We don't need to sort, -1 operation
    // .sort((first, second) =>{
    //      const firstNumericalDate= parseInt(first.year)*10000+parseInt(first.month)*100+parseInt(first.day);
    //      const secondNumericalDate= parseInt(second.year)*10000+parseInt(second.month)*100+parseInt(second.day);
        
    //      return firstNumericalDate - secondNumericalDate
        
    //     })
    .forEach( cleanElement =>{
        if(result.has(`${cleanElement.year}${cleanElement.month}`)){
            result.set(`${cleanElement.year}${cleanElement.month}`, result.get(`${cleanElement.year}${cleanElement.month}`)+parseFloat(cleanElement.net_amount));
        }else{
            result.set(`${cleanElement.year}${cleanElement.month}`, +parseFloat(cleanElement.net_amount));
        }
    })

    const yearsBetween = end.year - start.year + 1;
    const monthsBetween = end.month  - start.month +1 + 12 * (yearsBetween-1);;

    const resultArray = [];
    
    for (let index = 0; index < monthsBetween; index++) {
        let amount = 0;
        const currentMonth = start.month+index;
        const currentYear =start.year + Math.floor((currentMonth-1)/12);

        if(result.has(currentYear.toString() + ((currentMonth-1)%12+1).toString())){
            amount = result.get(currentYear.toString() + ((currentMonth-1)%12+1).toString())
        }

        resultArray.push(amount);
    }

    return resultArray;
}

const overall = (expenseArray, incomeArray) =>{
    const result = [];
    let total = 0;
    for (let i = 0; i < expenseArray.length; i++) {
        const expense = expenseArray[i];
        const income = incomeArray[i];
        total += income-expense;
        result.push(total);
    }
    return result;
}
//This double parsing is not needed because the JS api is very well made, but it works so there is no problem in using it.
function newDateFromMonths(date,amount){
    const variableDate = new Date(date);
    return new Date(date.setMonth(date.getMonth()+amount));
}
function dateInFormat(date){
    return {year: date.getFullYear(), month: date.getMonth()+1, day: date.getDate()};
}
const upperSelector = document.querySelector("#chart-upper");
const lowerSelector = document.querySelector("#chart-lower");

const defUpperAmount = parseInt(upperSelector.value);
const defLowerAmount = parseInt(lowerSelector.value);

const startingDate = new Date();

let globUpper = dateInFormat(newDateFromMonths(new Date(), defUpperAmount));
globUpper.day = 31;

let globLower = dateInFormat(newDateFromMonths(new Date(), defLowerAmount));
globLower.day = 1;


 const ctx = document.getElementById('report-chart');
 const chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: getMonthLabels(globLower,globUpper,true),
      datasets: [
        {
            type:"bar",
            label: 'Income',
            data: expensesOrIncomes("Income",data,globLower,globUpper),
            borderWidth: 1,
            borderColor: '#1ee0ac',
            backgroundColor: '#1ee0ac',
        },{
            type:"bar",
            label: 'Expenses',
            data: expensesOrIncomes("Expense",data,globLower,globUpper),
            borderWidth: 1,
            borderColor: '#e85347',
            backgroundColor: '#e85347', 
        },
        {
            type:"line",
            label: 'Overall',
            data: overall(expensesOrIncomes("Expense",data,globLower,globUpper),expensesOrIncomes("Income",data,globLower,globUpper)),
        },
    ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

function changeData(lower, upper, chart){
    lower.day = 1;
    upper.day = 31;

    chart.data.datasets[0].data = expensesOrIncomes("Income", data,lower, upper);
    chart.data.datasets[1].data = expensesOrIncomes("Expense", data,lower, upper);
    chart.data.datasets[2].data = overall(expensesOrIncomes("Expense", data,lower, upper),expensesOrIncomes("Income", data,lower, upper));
    
    chart.data.labels = getMonthLabels(lower,upper,true);

    chart.update();

    globLower = lower;
    globUpper = upper;
}

upperSelector.addEventListener("input", () =>{
    changeData(
        globLower,
        dateInFormat(newDateFromMonths(new Date(), parseInt(upperSelector.value))),
        chart
        )
});
lowerSelector.addEventListener("input", () =>{
    console.log(dateInFormat(newDateFromMonths(new Date(), parseInt(lowerSelector.value))),new Date(), parseInt(lowerSelector.value))
    changeData(
        dateInFormat(newDateFromMonths(new Date(), parseInt(lowerSelector.value))),
        globUpper,
       
        chart
        )
});


// const DATA_COUNT = 7;
// const NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

// const labels = Utils.months({count: 7});
// const data = {
//   labels: labels,
//   datasets: [
//     {
//       label: 'Dataset 1',
//       data: Utils.numbers(NUMBER_CFG),
//       borderColor: Utils.CHART_COLORS.red,
//       backgroundColor: Utils.transparentize(Utils.CHART_COLORS.red, 0.5),
//     },
//     {
//       label: 'Dataset 2',
//       data: Utils.numbers(NUMBER_CFG),
//       borderColor: Utils.CHART_COLORS.blue,
//       backgroundColor: Utils.transparentize(Utils.CHART_COLORS.blue, 0.5),
//     }
//   ]
// };

// const config = {
//   type: 'bar',
//   data: data,
//   options: {
//     responsive: true,
//     plugins: {
//       legend: {
//         position: 'top',
//       },
//       title: {
//         display: true,
//         text: 'Financial report'
//       }
//     }
//   },
// };

// const chart = new Chart(
//     document.getElementById('report-chart'),
//     config
// )



// const actions = [
//   {
//     name: 'Randomize',
//     handler(chart) {
//       chart.data.datasets.forEach(dataset => {
//         dataset.data = Utils.numbers({count: chart.data.labels.length, min: -100, max: 100});
//       });
//       chart.update();
//     }
//   },
//   {
//     name: 'Add Dataset',
//     handler(chart) {
//       const data = chart.data;
//       const dsColor = Utils.namedColor(chart.data.datasets.length);
//       const newDataset = {
//         label: 'Dataset ' + (data.datasets.length + 1),
//         backgroundColor: Utils.transparentize(dsColor, 0.5),
//         borderColor: dsColor,
//         borderWidth: 1,
//         data: Utils.numbers({count: data.labels.length, min: -100, max: 100}),
//       };
//       chart.data.datasets.push(newDataset);
//       chart.update();
//     }
//   },
//   {
//     name: 'Add Data',
//     handler(chart) {
//       const data = chart.data;
//       if (data.datasets.length > 0) {
//         data.labels = Utils.months({count: data.labels.length + 1});

//         for (let index = 0; index < data.datasets.length; ++index) {
//           data.datasets[index].data.push(Utils.rand(-100, 100));
//         }

//         chart.update();
//       }
//     }
//   },
//   {
//     name: 'Remove Dataset',
//     handler(chart) {
//       chart.data.datasets.pop();
//       chart.update();
//     }
//   },
//   {
//     name: 'Remove Data',
//     handler(chart) {
//       chart.data.labels.splice(-1, 1); // remove the label first

//       chart.data.datasets.forEach(dataset => {
//         dataset.data.pop();
//       });

//       chart.update();
//     }
//   }
// ];





// actions.foreach(action=>{

// })
</script>