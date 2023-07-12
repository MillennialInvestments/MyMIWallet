<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIBudget
{
    private $cuID;
    private $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library(array('Auth', 'MyMICoin', 'MyMIGold', 'MyMIUser', 'MyMIWallet', 'session', 'settings/settings_lib', 'Template'));
        $this->CI->load->model(array('Management/mgmt_budget_model'));
        $this->CI->load->model(array('User/budget_model', 'User/wallet_model'));
        $this->CI->load->library('users/auth');
        $cuID                                   = $this->CI->session->userdata('user_id');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
    }
    /**
     * User Default Information.
     *
     * Provides front-end functions for users, including access to login and logout.
     *
     * @package applications\library\MyMIWallet\Controllers\Users
     * User Information                         = $this->get_user_information($cuID);
     * User Default Wallet                      = $this->get_user_default_wallet($cuID);
     */
    public function all_user_budget_info($cuID) {
        $incomeAccountSummary                   = $this->get_income_account_summary($cuID);
        $expenseAccountSummary                  = $this->get_expense_account_summary($cuID);
        // $userBudgetRecords                      = $this->get_all_user_budget_records($cuID);
        $userAccount                            = $this->CI->mymiuser->user_account_info($cuID); 
        // New Configuration
        $monthlySavingsPercentageFMT            = number_format($monthlySavingsPercentage * 100,0) . '%';
        $userBudgetRecords                      = $this->CI->budget_model->get_user_budget_records($cuID);
        $getThisMonthsIncome                    = $this->CI->budget_model->get_this_months_income($cuID);
        // !! Start This Month Here:
        $thisMonthsIncome                       = $getThisMonthsIncome[0]['net_amount']; 
        if ($thisMonthsIncome < 0) {
            $thisMonthsIncomeFMT                = '-$' . number_format($thisMonthsIncome,2);
        } else {
            $thisMonthsIncomeFMT                = '$' . number_format($thisMonthsIncome,2);
        }
        $getThisMonthsExpense                   = $this->CI->budget_model->get_this_months_expense($cuID); 
        $thisMonthsExpense                      = $getThisMonthsExpense[0]['net_amount']; 
        if ($thisMonthsExpense > 0) {
            $thisMonthsExpenseFMT               = '-$' . number_format($thisMonthsExpense,2);
        } else {
            $thisMonthsExpenseFMT               = '$' . number_format($thisMonthsExpense,2);
        }
        $thisMonthsSurplus                      = $thisMonthsIncome - $thisMonthsExpense; 
        if ($thisMonthsSurplus < 0) {
            $thisMonthsSurplusFMT               = '-$' . number_format($thisMonthsSurplus,2);
        } else {
            $thisMonthsSurplusFMT               = '$' . number_format($thisMonthsSurplus,2);
        }
        $thisMonthsInvestments                  = $thisMonthsSurplus * $monthlySavingsPercentage;
        if ($thisMonthsInvestments < 0) {
            $thisMonthsInvestmentsFMT           = '-$' . number_format($thisMonthsInvestments,2);
            $thisMonthsInvestmentsSplitFMT      = '-$' . number_format($thisMonthsInvestments/2,2);
        } else {
            $thisMonthsInvestmentsFMT           = '$' . number_format($thisMonthsInvestments,2);
            $thisMonthsInvestmentsSplitFMT      = '$' . number_format($thisMonthsInvestments/2,2);
        }
        // !! Start Last Month Here:
        $getLastMonthsIncome                    = $this->CI->budget_model->get_last_months_income($cuID); 
        $lastMonthsIncome                       = $getLastMonthsIncome[0]['net_amount']; 
        if ($lastMonthsIncome < 0) {
            $lastMonthsIncomeFMT                = '-$' . number_format($lastMonthsIncome,2);
        } else {
            $lastMonthsIncomeFMT                = '$' . number_format($lastMonthsIncome,2);
        }
        $getLastMonthsExpense                   = $this->CI->budget_model->get_last_months_expense($cuID); 
        $lastMonthsExpense                      = $getLastMonthsExpense[0]['net_amount']; 
        if ($lastMonthsExpense > 0) {
            $lastMonthsExpenseFMT               = '-$' . number_format($lastMonthsExpense,2);
        } else {
            $lastMonthsExpenseFMT               = '$' . number_format($lastMonthsExpense,2);
        }
        $lastMonthsSurplus                      = $lastMonthsIncome - $lastMonthsExpense; 
        if ($lastMonthsSurplus < 0) {
            $lastMonthsSurplusFMT               = '-$' . number_format($lastMonthsSurplus,2);
        } else {
            $lastMonthsSurplusFMT               = '$' . number_format($lastMonthsSurplus,2);
        }
        $lastMonthsInvestments                  = $lastMonthsSurplus * $monthlySavingsPercentage;
        if ($lastMonthsInvestments < 0) {
            $lastMonthsInvestmentsFMT           = '-$' . number_format($lastMonthsInvestments,2);
        } else {
            $lastMonthsInvestmentsFMT           = '$' . number_format($lastMonthsInvestments,2);
        }
        // !! Start Next Months:
        $getNextMonthsIncome                    = $this->CI->budget_model->get_next_months_income($cuID); 
        $nextMonthsIncome                       = $getNextMonthsIncome[0]['net_amount']; 
        if ($nextMonthsIncome < 0) {
            $nextMonthsIncomeFMT                = '-$' . number_format($nextMonthsIncome,2);
        } else {
            $nextMonthsIncomeFMT                = '$' . number_format($nextMonthsIncome,2);
        }
        $getNextMonthsExpense                   = $this->CI->budget_model->get_next_months_expense($cuID); 
        $nextMonthsExpense                      = $getNextMonthsExpense[0]['net_amount']; 
        if ($nextMonthsExpense > 0) {
            $nextMonthsExpenseFMT               = '-$' . number_format($nextMonthsExpense,2);
        } else {
            $nextMonthsExpenseFMT               = '$' . number_format($nextMonthsExpense,2);
        }
        $nextMonthsSurplus                      = $nextMonthsIncome - $nextMonthsExpense; 
        if ($nextMonthsSurplus < 0) {
            $nextMonthsSurplusFMT               = '-$' . number_format($nextMonthsSurplus,2);
        } else {
            $nextMonthsSurplusFMT               = '$' . number_format($nextMonthsSurplus,2);
        }
        $nextMonthsInvestments                  = $nextMonthsSurplus * $monthlySavingsPercentage;
        if ($nextMonthsInvestments < 0) {
            $nextMonthsInvestmentsFMT           = '-$' . number_format($nextMonthsInvestments,2);
        } else {
            $nextMonthsInvestmentsFMT           = '$' . number_format($nextMonthsInvestments,2);
        }
        // !! Start Annual/Additionalh Here:
        $getAnnualIncome                        = $this->CI->budget_model->get_annual_income($cuID); 
        $totalIncome                            = $getAnnualIncome[0]['net_amount']; 
        if ($totalIncome < 0) {
            $totalIncomeFMT                     = '-$' . number_format($totalIncome,2);
        } else {
            $totalIncomeFMT                     = '$' . number_format($totalIncome,2);
        }
        $getAnnualExpense                       = $this->CI->budget_model->get_annual_expense($cuID); 
        $totalExpense                           = $getAnnualExpense[0]['net_amount']; 
        if ($totalExpense > 0) {
            $totalExpenseFMT                    = '-$' . number_format($totalExpense,2);
        } else {
            $totalExpenseFMT                    = '$' . number_format($totalExpense,2);
        }
        $totalSurplus                           = $totalIncome - $totalExpense; 
        if ($totalSurplus < 0) {
            $totalSurplusFMT                    = '-$' . number_format($totalSurplus,2);
        } else {
            $totalSurplusFMT                    = '$' . number_format($totalSurplus,2);
        }
        $totalInvestments                       = $totalSurplus * $monthlySavingsPercentage;
        if ($totalInvestments < 0) {
            $totalInvestmentsFMT                = '-$' . number_format($totalInvestments,2);
        } else {
            $totalInvestmentsFMT                = '$' . number_format($totalInvestments,2);
        }

        $getCheckingSummary                     = $this->CI->budget_model->get_checking_summary($cuID); 
        $checkingSummary                        = $getCheckingSummary[0]['balance']; 
        if ($checkingSummary < 0) {
            $checkingSummaryFMT                 = '-$' . number_format($checkingSummary,2);
        } else {
            $checkingSummaryFMT                 = '$' . number_format($checkingSummary,2);
        }
        $getIncomeYTDSummary                    = $this->CI->budget_model->get_income_ytd_summary($cuID);
        $incomeYTDSummary                       = $getIncomeYTDSummary[0]['net_amount'];
        if ($incomeYTDSummary < 0) {
            $incomeYTDSummaryFMT                = '-$' . number_format($incomeYTDSummary,2);
        } else {
            $incomeYTDSummaryFMT                = '$' . number_format($incomeYTDSummary,2);
        }
        $getExpenseYTDSummary                   = $this->CI->budget_model->get_expense_ytd_summary($cuID);
        $expenseYTDSummary                      = $getExpenseYTDSummary[0]['net_amount'];
        if ($expenseYTDSummary < 0) {
            $expenseYTDSummaryFMT               = '-$' . number_format($expenseYTDSummary,2);
        } else {
            $expenseYTDSummaryFMT               = '$' . number_format($expenseYTDSummary,2);
        }
        // !! Start Credit Here:
        $getCreditLimit                         = $this->CI->budget_model->get_credit_limit_summary($cuID); 
        $creditLimit                            = $getCreditLimit[0]['credit_limit'];
        if ($creditLimit < 0) {
            $creditLimitFMT                     = '<span class="statusRed">-$' . number_format($creditLimit,2) . '</span>';
        } else {
            $creditLimitFMT                     = '$' . number_format($creditLimit,2);
        }
        $getCreditAvailable                     = $this->CI->budget_model->get_credit_available_summary($cuID);
        $creditAvailable                        = $getCreditAvailable[0]['available_balance'] - $creditLimit;
        if ($creditAvailable > $creditLimit) {
            $creditAvailableFMT                 = '$' . number_format($creditAvailable,2);
        } else {
            $creditAvailableFMT                 = '<span>$' . number_format(($creditAvailable + $creditLimit) * 1,2) . '</span>';
        }
        // !! Start Debt Here:
        $getDebtSummary                         = $this->CI->budget_model->get_debt_accounts($cuID);
        $debtSummary                            = $getDebtSummary[0]['available_balance'];
        if ($debtSummary < 0) {
            $debtSummaryFMT                     = '-$' . number_format($debtSummary,2);
        } else {
            $debtSummaryFMT                     = '$' . number_format($debtSummary,2);
        }
        $allAccounts                            = $this->CI->mgmt_budget_model->get_accounts()->result_array();
        $totalAccountBalance                    = $checkingSummary; 
        $totalAccountBalance                    = $checkingSummary + $creditAvailable + $creditLimit; 
        if ($totalAccountBalance < 0) {
            $totalAccountBalanceFMT             = '-$' . number_format($totalAccountBalance,2);
        } else {
            $totalAccountBalanceFMT             = '$' . number_format($totalAccountBalance,2);
        }
        // Budget Summary Request from 'application/models/User/Budget_model.php
        $getIncomeAccountSummary                = $this->CI->budget_model->get_income_accounts_summary($cuID)->result_array();
        $getExpenseAccountSummary               = $this->CI->budget_model->get_expense_accounts_summary($cuID)->result_array();
        $getDebtAccountsSummary                 = $this->CI->budget_model->get_debt_accounts_summary($cuID)->result_array(); 
        $getLoanAccountsSummary                 = $this->CI->budget_model->get_loan_accounts_summary($cuID)->result_array(); 
        // Auto-Calculations
        // $accountSurplus                     = $getIncomeAccountSummary['net_amount'] - $getExpenseAccountSummary['net_amount'];
        $allUserBudgets                         = array(
            'message_type'                      => 'Success',
            'message'                           => 'Data Retrieved Successfully',
            'allAccounts'                       => $allAccounts,
            'userBudgetRecords'                 => $userBudgetRecords,
            // !! Start This Month Here:
            'thisMonthsIncome'                  => $thisMonthsIncome,
            'thisMonthsIncomeFMT'               => $thisMonthsIncomeFMT,
            'thisMonthsExpense'                 => $thisMonthsExpense,
            'thisMonthsExpenseFMT'              => $thisMonthsExpenseFMT,
            'thisMonthsExpense'                 => $thisMonthsExpense,
            'thisMonthsExpenseFMT'              => $thisMonthsExpenseFMT,
            'thisMonthsSurplus'                 => $thisMonthsSurplus,
            'thisMonthsSurplusFMT'              => $thisMonthsSurplusFMT,
            'thisMonthsInvestments'             => $thisMonthsInvestments,
            'thisMonthsInvestmentsFMT'          => $thisMonthsInvestmentsFMT,
            'thisMonthsInvestmentsSplitFMT'     => $thisMonthsInvestmentsSplitFMT,
            // !! Start Last Month Here:
            'lastMonthsIncome'                  => $lastMonthsIncome,
            'lastMonthsIncomeFMT'               => $lastMonthsIncomeFMT,
            'lastMonthsExpense'                 => $lastMonthsExpense,
            'lastMonthsExpenseFMT'              => $lastMonthsExpenseFMT,
            'lastMonthsSurplus'                 => $lastMonthsSurplus,
            'lastMonthsSurplusFMT'              => $lastMonthsSurplusFMT,
            'lastMonthsInvestments'             => $lastMonthsInvestments,
            'lastMonthsInvestmentsFMT'          => $lastMonthsInvestmentsFMT,
            // !! Start Next Month Here:
            'nextMonthsIncome'                  => $nextMonthsIncome,
            'nextMonthsIncomeFMT'               => $nextMonthsIncomeFMT,
            'nextMonthsExpense'                 => $nextMonthsExpense,
            'nextMonthsExpenseFMT'              => $nextMonthsExpenseFMT,
            'nextMonthsSurplus'                 => $nextMonthsSurplus,
            'nextMonthsSurplusFMT'              => $nextMonthsSurplusFMT,
            'nextMonthsInvestments'             => $nextMonthsInvestments,
            'nextMonthsInvestmentsFMT'          => $nextMonthsInvestmentsFMT,
            'totalIncome'                       => $totalIncome,
            'totalIncomeFMT'                    => $totalIncomeFMT,
            'totalExpense'                      => $totalExpense,
            'totalExpenseFMT'                   => $totalExpenseFMT,
            'totalSurplus'                      => $totalSurplus,
            'totalSurplusFMT'                   => $totalSurplusFMT,
            'totalInvestments'                  => $totalInvestments,
            'totalInvestmentsFMT'               => $totalInvestmentsFMT,
            'checkingSummary'                   => $checkingSummary,
            'checkingSummaryFMT'                => $checkingSummaryFMT,
            'incomeYTDSummary'                  => $incomeYTDSummary,
            'incomeYTDSummaryFMT'               => $incomeYTDSummaryFMT,
            'expenseYTDSummary'                 => $expenseYTDSummary,
            'expenseYTDSummaryFMT'              => $expenseYTDSummaryFMT,
            'creditLimit'                       => $creditLimit,
            'creditLimitFMT'                    => $creditLimitFMT,
            'creditAvailable'                   => $creditAvailable,
            'creditAvailableFMT'                => $creditAvailableFMT,
            'debtSummary'                       => $debtSummary,
            'debtSummaryFMT'                    => $debtSummaryFMT,
            'totalAccountBalance'               => $totalAccountBalance, 
            'totalAccountBalanceFMT'            => $totalAccountBalanceFMT, 
        );

        return $allUserBudgets;
    }

    public function user_budget_info($cuID)
    {
        $financialAccountSummary                = $this->get_financial_account_summary($cuID); 
        $incomeAccountSummary                   = $this->get_income_account_summary($cuID);
        $expenseAccountSummary                  = $this->get_expense_account_summary($cuID);
        $debtAccountSummary                     = $this->get_debt_account_summary($cuID); 
        $accountSurplus                         = $incomeAccountSummary['income'] - $expenseAccountSummary['expenses']; 
        $userBudgetRecords                      = $this->get_all_user_budget_records($cuID);
        $userBudget                             = array(
            'cuID'                       	    => $cuID,
            'incomeAccountSummary'              => $incomeAccountSummary,
            'debtAccountSummary'                => $debtAccountSummary,
            'expenseAccountSummary'             => $expenseAccountSummary,
            'accountSurplus'                    => $accountSurplus,
            'accountTotalSurplus'               => number_format($accountSurplus,2),
            'userBudgetRecords'                 => $userBudgetRecords,
        );
        return $financialAccountSummary;
    }
        
    public function get_income_account_summary($cuID) {
        $getIncomeAccountSummary                = $this->CI->budget_model->get_income_accounts_summary($cuID);
        foreach($getIncomeAccountSummary->result_array() as $incomeAccount) {
            if ($incomeAccount['net_amount'] > 0) {
                $income                         = $incomeAccount['net_amount'];
            } else {
                $income                         = 0.00;
            }
        }
        $getTMIncomeAccountSummary              = $this->CI->budget_model->get_this_month_income_account_summary($cuID);
        foreach($getTMIncomeAccountSummary->result_array() as $thisIncomeAccount) {
            if ($thisIncomeAccount['net_amount'] > 0) {
                $thisMonthIncome                = $thisIncomeAccount['net_amount'];
            } else {
                $thisMonthIncome                = 0.00;
            }
        }
        $getLMIncomeAccountSummary              = $this->CI->budget_model->get_last_month_income_account_summary($cuID);
        foreach($getLMIncomeAccountSummary->result_array() as $lastIncomeAccount) {
            if ($lastIncomeAccount['net_amount'] > 0) {
                $lastMonthIncome                = $lastIncomeAccount['net_amount'];
            } else {
                $lastMonthIncome                = 0.00;
            }
        }
        if (!empty($lastMonthIncome)) {
            $momIncomeAverages                  = ($thisMonthIncome - $lastMonthIncome)/$lastMonthIncome * 100;  
        } else {
            $momIncomeAverages                  = 0.00;
        }
        $incomeAccountSummary                   = array(
            'income'                            => $income,
            'thisMonthIncome'                   => $thisMonthIncome,
            'lastMonthIncome'                   => $lastMonthIncome,
            'momIncomeAverages'                 => $momIncomeAverages,
        );
        return $incomeAccountSummary;
    }

    public function get_expense_account_summary($cuID) {
        $getExpenseAccountSummary               = $this->CI->budget_model->get_expense_account_summary($cuID);
        // print_r($getExpenseAccountSummary->result_array());
        foreach($getExpenseAccountSummary->result_array() as $expenseAccount) {
            if ($expenseAccount['net_amount'] > 0) {
                $expenses                       = $expenseAccount['net_amount'];
            } else {    
                $expenses                       = 0.00;
            }
        }
        $getTMExpenseAccountSummary             = $this->CI->budget_model->get_this_month_expense_account_summary($cuID);
        // print_r($getExpenseAccountSummary->result_array());
        foreach($getTMExpenseAccountSummary->result_array() as $thisExpenseAccount) {
            if ($thisExpenseAccount['net_amount'] > 0) {
                $thisMonthExpenses              = $thisExpenseAccount['net_amount'];
            } else {    
                $thisMonthExpenses              = 0.00;
            }
        }
        $getLMExpenseAccountSummary             = $this->CI->budget_model->get_last_month_expense_account_summary($cuID);
        // print_r($getExpenseAccountSummary->result_array());
        foreach($getLMExpenseAccountSummary->result_array() as $lastExpenseAccount) {
            if ($lastExpenseAccount['net_amount'] > 0) {
                $lastMonthExpenses              = $lastExpenseAccount['net_amount'];
            } else {    
                $lastMonthExpenses              = 0.00;
            }
        }
        if (!empty($lastMonthExpenses)) {
            $momExpenseAverages                 = ($thisMonthExpenses - $lastMonthExpenses)/$lastMonthExpenses * 100;  
        } else {
            $momExpenseAverages                 = 0.00;
        }
        $expenseAccountSummary                  = array(
            'expenses'                          => $expenses,
            'thisMonthExpenses'                 => $thisMonthExpenses,
            'lastMonthExpenses'                 => $lastMonthExpenses,
            'momExpenseAverages'                => $momExpenseAverages,
        );
        return $expenseAccountSummary;
    }

    public function get_debt_account_summary($cuID) {
        $getDebtAccounts                        = $this->CI->budget_model->get_debt_accounts($cuID); 
        foreach($getDebtAccounts->result_array() as $thisDebtAccount) {
            if ($thisDebtAccount['net_amount'] > 0) {
                $totalDebt                      = $thisDebtAccount['net_amount'];
            } else {    
                $totalDebt                      = 0.00;
            }
        }

        $debtAccountSummary                     = array(
            'totalDebt'                         => $totalDebt,
        );

        return $debtAccountSummary; 
    }

    // public function get_user_budget_account($accountID) {
    //     $getUserBudgetAccount               = $this->CI->budget_model->get_account_information($accountID);
    //     foreach($getUserBudgetAccount->result_array() as $budgetAccount) {
    //         $accountPaidStatus              = $budgetAccount['paid'];
    //         $accountDesDate                 = $budgetAccount['designated_date'];
    //         $accountMonth                   = $budgetAccount['month'];
    //         $accountDay                     = $budgetAccount['day'];
    //         $accountYear                    = $budgetAccount['year'];
    //         $accountCreator                 = $budgetAccount['created_by'];
    //         $accountCreatorEmail            = $budgetAccount['created_by_email'];
    //         $accountName                    = $budgetAccount['name'];
    //         $accountNetAmount               = $budgetAccount['net_amount'];
    //         $accountGrossAmount             = $budgetAccount['gross_amount'];
    //         $accountSummary                 = $budgetAccount['account_summary'];
    //         $accountWallet                  = $budgetAccount['wallet_id'];
    //         $accountRecurring               = $budgetAccount['recurring_account'];
    //         $accountRecurringPrimary        = $budgetAccount['recurring_account_primary'];
    //         $accountRecurringID             = $budgetAccount['recurring_account_id'];
    //         $accountRecurringSchedule       = $budgetAccount['recurring_schedule'];
    //         $accountType                    = $budgetAccount['account_type'];
    //         $accountSource                  = $budgetAccount['source_type'];
    //         $accountIsDebt                  = $budgetAccount['is_debt'];
    //         $accountIntervals               = $budgetAccount['intervals'];
    //     }

    //     $selectedBudgetAccount              = array(
    //         'accountPaidStatus'             => $accountPaidStatus,
    //         'accountDesDate'                => $accountDesDate,
    //         'accountMonth'                  => $accountMonth,
    //         'accountDay'                    => $accountDay,
    //         'accountYear'                   => $accountYear,
    //         'accountCreator'                => $accountCreator,
    //         'accountCreatorEmail'           => $accountCreatorEmail,
    //         'accountName'                   => $accountName,
    //         'accountNetAmount'              => $accountNetAmount,
    //         'accountGrossAmount'            => $accountGrossAmount,
    //         'accountSummary'                => $accountSummary,
    //         'accountWallet'                 => $accountWallet,
    //         'accountRecurring'              => $accountRecurring,
    //         'accountRecurringPrimary'       => $accountRecurringPrimary,
    //         'accountRecurringID'            => $accountRecurringID,
    //         'accountRecurringSchedule'      => $accountRecurringSchedule,
    //         'accountType'                   => $accountType,
    //         'accountSource'                 => $accountSource,
    //         'accountIsDebt'                 => $accountIsDebt,
    //         'accountIntervals'              => $accountIntervals,
    //     );

    //     return $selectedBudgetAccount; 
    // }
    
    public function get_user_budget_accounts($cuID) {
        $getUserBudgetAccounts                  = $this->CI->budget_model->get_accounts($cuID);
        
        $userBudgetAccounts                     = array(
            'getUserBudgetAccounts'             => $getUserBudgetAccounts->result_array(), 
        );

        return $userBudgetAccounts;
    }

    public function get_first_budget_account($cuID) {
        $getFirstBudgetAccount                  = $this->CI->budget_model->get_first_budget_account($cuID);
        foreach($getFirstBudgetAccount->result_array() as $firstAccount) {
            $firstAccountDate                   = $firstAccount['designated_date'];
            $firstAccountMonth                  = $firstAccount['month'];
            $firstAccountDay                    = $firstAccount['day'];
            $firstAccountYear                   = $firstAccount['year'];
        }
        $firstBudgetAccount                     = array(
            'getFirstBudgetAccount'             => $getFirstBudgetAccount->result_array(),
            'firstAccountDate'                  => $firstAccountDate,
            'firstAccountMonth'                 => $firstAccountMonth,
            'firstAccountDay'                   => $firstAccountDay,
            'firstAccountYear'                  => $firstAccountYear,
        );
        return $firstBudgetAccount;
    }
    // public function get_last_account() {
    //     $getLastAccount                         = $this->investor_model->get_last_account(); 
    //     foreach ($getLastAccount->result_array() as $lastAccount) {
    //         $userDat
    //     }
    // }
}
