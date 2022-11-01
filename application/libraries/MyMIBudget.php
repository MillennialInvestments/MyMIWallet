<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIBudget
{
    private $cuID;
    private $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library(array('Auth', 'MyMICoin', 'MyMIGold', 'MyMIWallet', 'session', 'settings/settings_lib', 'Template'));
        $this->CI->load->model(array('User/budget_model'));
        $this->CI->load->library('users/auth');
        $cuID 								= $this->CI->auth->user_id();
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
    public function user_budget_info($cuID)
    {
        $financialAccountSummary            = $this->get_financial_account_summary($cuID); 
        $incomeAccountSummary               = $this->get_income_account_summary($cuID);
        $expenseAccountSummary              = $this->get_expense_account_summary($cuID);
        $debtAccountSummary                 = $this->get_debt_account_summary($cuID); 
        $accountSurplus                     = $incomeAccountSummary['income'] - $expenseAccountSummary['expenses']; 
        $userBudget                         = array(
            'cuID'                       	=> $cuID,
            'incomeAccountSummary'          => $incomeAccountSummary,
            'debtAccountSummary'            => $debtAccountSummary,
            'expenseAccountSummary'         => $expenseAccountSummary,
            'accountSurplus'                => $accountSurplus,
            'accountTotalSurplus'           => number_format($accountSurplus,2),
        );
        
        return $userBudget;
    }
    
    public function get_financial_account_summary($cuID) {
        $incomeAccountSummary    		    = $this->get_income_account_summary($cuID);
        $expenseAccountSummary    		    = $this->get_expense_account_summary($cuID);
        $budgetIncome                       = $incomeAccountSummary['income'];
        $budgetExpenses                     = $expenseAccountSummary['expenses'];
        $budgetFinancialTotals              = $budgetIncome - $budgetExpenses;

        $financialAccountSummary            = array(
            'budgetFinancialTotals'         => $budgetFinancialTotals,
        );
        return $financialAccountSummary;
    }
        
    public function get_income_account_summary($cuID) {
        $getIncomeAccountSummary            = $this->CI->budget_model->get_income_account_summary($cuID);
        foreach($getIncomeAccountSummary->result_array() as $incomeAccount) {
            if ($incomeAccount['net_amount'] > 0) {
                $income                     = $incomeAccount['net_amount'];
            } else {
                $income                     = 0.00;
            }
        }
        $getTMIncomeAccountSummary          = $this->CI->budget_model->get_this_month_income_account_summary($cuID);
        foreach($getTMIncomeAccountSummary->result_array() as $thisIncomeAccount) {
            if ($thisIncomeAccount['net_amount'] > 0) {
                $thisMonthIncome            = $thisIncomeAccount['net_amount'];
            } else {
                $thisMonthIncome            = 0.00;
            }
        }
        $getLMIncomeAccountSummary          = $this->CI->budget_model->get_last_month_income_account_summary($cuID);
        foreach($getLMIncomeAccountSummary->result_array() as $lastIncomeAccount) {
            if ($lastIncomeAccount['net_amount'] > 0) {
                $lastMonthIncome            = $lastIncomeAccount['net_amount'];
            } else {
                $lastMonthIncome            = 0.00;
            }
        }
        if (!empty($lastMonthIncome)) {
            $momIncomeAverages              = ($thisMonthIncome - $lastMonthIncome)/$lastMonthIncome * 100;  
        } else {
            $momIncomeAverages              = 0.00;
        }
        $incomeAccountSummary               = array(
            'income'                        => $income,
            'thisMonthIncome'               => $thisMonthIncome,
            'lastMonthIncome'               => $lastMonthIncome,
            'momIncomeAverages'             => $momIncomeAverages,
        );
        return $incomeAccountSummary;
    }

    public function get_expense_account_summary($cuID) {
        $getExpenseAccountSummary           = $this->CI->budget_model->get_expense_account_summary($cuID);
        // print_r($getExpenseAccountSummary->result_array());
        foreach($getExpenseAccountSummary->result_array() as $expenseAccount) {
            if ($expenseAccount['net_amount'] > 0) {
                $expenses                   = $expenseAccount['net_amount'];
            } else {    
                $expenses                   = 0.00;
            }
        }
        $getTMExpenseAccountSummary         = $this->CI->budget_model->get_this_month_expense_account_summary($cuID);
        // print_r($getExpenseAccountSummary->result_array());
        foreach($getTMExpenseAccountSummary->result_array() as $thisExpenseAccount) {
            if ($thisExpenseAccount['net_amount'] > 0) {
                $thisMonthExpenses          = $thisExpenseAccount['net_amount'];
            } else {    
                $thisMonthExpenses          = 0.00;
            }
        }
        $getLMExpenseAccountSummary         = $this->CI->budget_model->get_last_month_expense_account_summary($cuID);
        // print_r($getExpenseAccountSummary->result_array());
        foreach($getLMExpenseAccountSummary->result_array() as $lastExpenseAccount) {
            if ($lastExpenseAccount['net_amount'] > 0) {
                $lastMonthExpenses          = $lastExpenseAccount['net_amount'];
            } else {    
                $lastMonthExpenses          = 0.00;
            }
        }
        if (!empty($lastMonthExpenses)) {
            $momExpenseAverages             = ($thisMonthExpenses - $lastMonthExpenses)/$lastMonthExpenses * 100;  
        } else {
            $momExpenseAverages             = 0.00;
        }
        $expenseAccountSummary              = array(
            'expenses'                      => $expenses,
            'thisMonthExpenses'             => $thisMonthExpenses,
            'lastMonthExpenses'             => $lastMonthExpenses,
            'momExpenseAverages'            => $momExpenseAverages,
        );
        return $expenseAccountSummary;
    }

    public function get_debt_account_summary($cuID) {
        $getDebtAccounts                    = $this->CI->budget_model->get_debt_accounts($cuID); 
        foreach($getDebtAccounts->result_array() as $thisDebtAccount) {
            if ($thisDebtAccount['net_amount'] > 0) {
                $totalDebt                  = $thisDebtAccount['net_amount'];
            } else {    
                $totalDebt                  = 0.00;
            }
        }

        $debtAccountSummary                 = array(
            'totalDebt'                     => $totalDebt,
        );

        return $debtAccountSummary; 
    }
    

    // public function get_last_account() {
    //     $getLastAccount                         = $this->investor_model->get_last_account(); 
    //     foreach ($getLastAccount->result_array() as $lastAccount) {
    //         $userDat
    //     }
    // }
}
