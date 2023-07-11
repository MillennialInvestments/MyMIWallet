<?php defined('BASEPATH') || exit('No direct script access allowed');

class Budget_model extends BF_Model
{
    protected $table_name	= 'bf_applications';
    protected $key			= 'id';
    protected $date_format	= 'datetime';

    protected $log_user 	= true;
    protected $set_created	= true;
    protected $set_modified = true;
    protected $soft_deletes	= false;

    protected $created_field     = 'created_on';
    protected $created_by_field  = 'created_by';
    protected $modified_field    = 'modified_on';
    protected $modified_by_field = 'modified_by';

    // Customize the operations of the model without recreating the insert,
    // update, etc. methods by adding the method names to act as callbacks here.
    protected $before_insert 	= array();
    protected $after_insert 	= array();
    protected $before_update 	= array();
    protected $after_update 	= array();
    protected $before_find 	    = array();
    protected $after_find 		= array();
    protected $before_delete 	= array();
    protected $after_delete 	= array();

    // For performance reasons, you may require your model to NOT return the id
    // of the last inserted row as it is a bit of a slow method. This is
    // primarily helpful when running big loops over data.
    protected $return_insert_id = true;

    // The default type for returned row data.
    protected $return_type = 'object';

    // Items that are always removed from data prior to inserts or updates.
    protected $protected_attributes = array();

    // You may need to move certain rules (like required) into the
    // $insert_validation_rules array and out of the standard validation array.
    // That way it is only required during inserts, not updates which may only
    // be updating a portion of the data.
    protected $validation_rules 		= array(
        array(
            'field' => 'Name',
            'label' => 'lang:contact_us_field_Name',
            'rules' => 'required|unique[bf_contactus.Name,bf_contactus.id]|alpha|max_length[255]',
        ),
        array(
            'field' => 'email',
            'label' => 'lang:contact_us_field_email',
            'rules' => 'required|unique[bf_contactus.email,bf_contactus.id]|valid_email|max_length[255]',
        ),
        array(
            'field' => 'phone',
            'label' => 'lang:contact_us_field_phone',
            'rules' => 'required|unique[bf_contactus.phone,bf_contactus.id]|max_length[30]',
        ),
        array(
            'field' => 'message',
            'label' => 'lang:contact_us_field_message',
            'rules' => 'alpha_dash|max_length[255]',
        ),
    );
    protected $insert_validation_rules  = array();
    protected $skip_validation 			= false;
    
    public $gallery_path;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->gallery_path = realpath(APPPATH . '../images/');
    }
    
    
    /**
    * Find a user's record and role information.
    *
    * @param int $id The user's ID.
    *
    * @return bool|object An object with the user's information.
    */
    // public function find($id = null)
    // {
    //     $this->preFind();
    //     return parent::find($id);
    // }

    /**
     * Find all user records and the associated role information.
     *
     * @return bool An array of objects with each user's information.
     */
    // public function find_all()
    // {
    //     $this->preFind();
    //     return parent::find_all();
    // }
    
    public function prep_data($post_data)
    {
        // Take advantage of BF_Model's prep_data() method.
        $data                                   = parent::prep_data($post_data);
        
        return $data;
    }

    /* Get All Budget Records 'created_by' User's $cuID */
    public function get_user_budget_records($cuID) {
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('status', 1); 
        $userBudgetRecords                      = $this->db->get()->result_array(); 
        return $userBudgetRecords; 
    }

    /* Get Budget Records 'account_id' User's $recordID */
    public function get_user_budget_record($cuID, $recordID) {
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('id', $recordID); 
        $this->db->where('created_by', $cuID); 
        $getUserBudgetRecord                    = $this->db->get()->result_array(); 
        return $getUserBudgetRecord; 
    }

    /* Get All Budget Records 'created_by' User's $cuID */
    public function get_budget_account_related_records($cuID, $accountName) {
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('name', $accountName); 
        $getBudgetAccountRelatedRecords         = $this->db->get()->result_array(); 
        return $getBudgetAccountRelatedRecords; 
    }


    /* Get This Month's Income for User */
    public function get_this_months_income($cuID) { 
        $this->db->select_sum('net_amount'); 
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Income');
        $this->db->where('status', 1); 
        $this->db->where('month', date("m")); 
        $getThisMonthsIncome                    = $this->db->get()->result_array(); 
        return $getThisMonthsIncome; 
    }
    
    // Summarize this Month's Expense - Net Amount
    public function get_this_months_expense($cuID) {
        $this->db->select_sum('net_amount'); 
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Expense');
        $this->db->where('status', 1); 
        $this->db->where('month', date("m")); 
        $getThisMonthsExpense                   = $this->db->get()->result_array(); 
        return $getThisMonthsExpense; 
    }

    public function get_last_months_income($cuID) {
        // Summarize Last Month's Income - Net Amount
        $this->db->select_sum('net_amount'); 
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Income');
        $this->db->where('status', 1); 
        $this->db->where('month', date("m", strtotime("-1 months"))); 
        $getLastMonthsIncome                    = $this->db->get()->result_array(); 
        return $getLastMonthsIncome;
    }

    public function get_last_months_expense($cuID) {
        // Summarize Last Month's Expense - Net Amount
        $this->db->select_sum('net_amount'); 
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Expense');
        $this->db->where('status', 1); 
        $this->db->where('month', date("m", strtotime("-1 months"))); 
        $getLastMonthsExpense                   = $this->db->get()->result_array(); 
        return $getLastMonthsExpense;
    }

    public function get_next_months_income($cuID) {
        // Summarize Last Month's Income - Net Amount
        $this->db->select_sum('net_amount'); 
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Income');
        $this->db->where('status', 1); 
        $this->db->where('month', date("m", strtotime("+1 months"))); 
        $getLastMonthsIncome                    = $this->db->get()->result_array(); 
        return $getLastMonthsIncome;
    }

    public function get_next_months_expense($cuID) {
        // Summarize Last Month's Expense - Net Amount
        $this->db->select_sum('net_amount'); 
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Expense');
        $this->db->where('status', 1); 
        $this->db->where('month', date("m", strtotime("+1 months"))); 
        $getLastMonthsExpense                   = $this->db->get()->result_array(); 
        return $getLastMonthsExpense;
    }

    public function get_annual_income($cuID) {
        // Summarize Total Annual Income - Net Amount
        $this->db->select_sum('net_amount'); 
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Income');
        $this->db->where('status', 1); 
        $this->db->where('year', date("Y")); 
        $getAnnualIncome                        = $this->db->get()->result_array(); 
        return $getAnnualIncome; 
    }

    public function get_annual_expense($cuID) {
        // Summarize Last Month's Expense - Net Amount
        $this->db->select_sum('net_amount'); 
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Expense');
        $this->db->where('status', 1); 
        $this->db->where('year', date("Y")); 
        $getAnnualExpense                       = $this->db->get()->result_array(); 
        return $getAnnualExpense;
    }

    public function get_checking_summary($cuID) {
        // Get Summary of Checking Accounts
        $this->db->select_sum('balance'); 
        $this->db->from('bf_users_bank_accounts'); 
        $this->db->where('user_id', $cuID); 
        // $this->db->where('status', 1); 
        // $this->db->where('deleted', 0); 
        $getCheckingSummary                     = $this->db->get()->result_array(); 
        return $getCheckingSummary; 
    }

    public function get_income_ytd_summary($cuID) {
        // Get YTD Income Summary
        $this->db->select_sum('net_amount'); 
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID);
        $this->db->where('account_type', 'Income'); 
        $this->db->where('month <=', date('m')); 
        $this->db->where('day <=', date('d')); 
        $this->db->where('year', date('Y')); 
        $getIncomeYTDSummary                    = $this->db->get()->result_array();
        return $getIncomeYTDSummary; 
    }

    public function get_expense_ytd_summary($cuID) {
        // Get YTD Expense Summary
        $this->db->select_sum('net_amount'); 
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID);
        $this->db->where('account_type', 'Expense'); 
        $this->db->where('month <=', date('m')); 
        $this->db->where('day <=', date('d')); 
        $this->db->where('year', date('Y')); 
        $getExpenseYTDSummary                   = $this->db->get()->result_array();
        return $getExpenseYTDSummary; 
    }

    public function get_credit_limit_summary($cuID) {
        $this->db->select_sum('credit_limit'); 
        $this->db->from('bf_users_credit_accounts'); 
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID);     
        $getCreditLimit                         = $this->db->get()->result_array();
        return $getCreditLimit;
    }

    public function get_credit_available_summary($cuID) {
        $this->db->select_sum('available_balance'); 
        $this->db->from('bf_users_credit_accounts'); 
        $this->db->where('user_id', $cuID);     
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $getCreditAvailable                     = $this->db->get()->result_array();
        return $getCreditAvailable;
    }
    
    public function get_debt_accounts($cuID) {
        $this->db->select_sum('available_balance'); 
        $this->db->select('account_type');
        $this->db->from('bf_users_debt_accounts'); 
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID); 
        $getDebtAccounts                        = $this->db->get()->result_array(); 
        return $getDebtAccounts;
    }

    public function get_debt_accounts_summary($cuID) {
        $this->db->select_sum('net_amount'); 
        $this->db->select('account_type');
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('is_debt', 1);        
        $getDebtAccountsSummary                 = $this->db->get();
        return $getDebtAccountsSummary;
    }

    public function get_loan_accounts($cuID) {
        $this->db->select_sum('net_amount'); 
        $this->db->select('account_type');
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID);  
        $this->db->like('source_type', 'Loan');   
        $getLoanAccounts                        = $this->db->get(); 
        return $getLoanAccounts;
    }

    public function get_loan_accounts_summary($cuID) {
        $this->db->select_sum('net_amount'); 
        $this->db->select('account_type');
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->like('source_type', 'Loan');
        $getLoanAccountsSummary                 = $this->db->get();
        return $getLoanAccountsSummary;
    }

    
    /*
     * Dashboard Add/Edit/Delete
     * function to add/delete/update bf_dashboards
     */
    public function add_account($created_by, $created_by_date, $unix_timestamp, $month, $day, $year, $time, $status, $account_type, $source_type, $intervals, $name, $amount, $designated_date)
    {
        $user_data                              = array(
            'created_by'                        => $created_by,
            'created_by_date'                   => $created_by_date,
            'unix_timestamp'                    => $unix_timestamp,
            'month'                             => $month,
            'day'                               => $day,
            'year'                              => $year,
            'time'                              => $time,
            'status'                            => $status,
            'account_type'                      => $account_type,
            'source_type'                       => $source_type,
            'intervals'                         => $intervals,
            'name'                              => $name,
            'amount'                            => $amount,
            'designated_date'                   => $designated_date,
        );

        return $this->db->insert('bf_users_budgeting', $user_data); 
    }

    public function attach_account($accountID, $walletID) {
        $budgetData                             = array(
            'wallet_id'                         => $walletID,
        );

        $this->db->where('id', $accountID);
        return $this->db->update('bf_users_budgeting', $budgetData);
    }

    public function get_account_information($accountID) {
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('id', $accountID); 
        $getAccountInfo                         = $this->db->get();
        return $getAccountInfo; 
    }

    public function get_wallet_info($walletID) {
        $this->db->from('bf_users_wallet'); 
        $this->db->where('id', $walletID); 
        $getWalletInfo                         = $this->db->get();
        return $getWalletInfo; 
    }

    public function get_accounts($cuID) {
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1);
        // $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $getAccounts                            = $this->db->get();
        return $getAccounts;
    }
    
    public function get_accounts_order_asc_by_date($cuID) {
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->order_by('year', 'asc');
        $this->db->order_by('month', 'asc');
        $this->db->order_by('day', 'asc');
        $getAccounts                            = $this->db->get();
        return $getAccounts;
    }

    public function get_accounts_order_asc_by_date_paid($cuID) {
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1);
        $this->db->where('paid', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->order_by('year', 'asc');
        $this->db->order_by('month', 'asc');
        $this->db->order_by('day', 'asc');
        $getAccounts                            = $this->db->get();
        return $getAccounts;
    }

    public function get_accounts_order_asc_by_date_is_debt($cuID) {
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1);
        $this->db->where('is_debt', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->order_by('year', 'asc');
        $this->db->order_by('month', 'asc');
        $this->db->order_by('day', 'asc');
        $getAccounts                            = $this->db->get();
        return $getAccounts;
    }

    public function get_accounts_order_asc_by_date_unpaid($cuID) {
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1);
        $this->db->where('paid', 0);
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->order_by('year', 'asc');
        $this->db->order_by('month', 'asc');
        $this->db->order_by('day', 'asc');
        $getAccounts                            = $this->db->get();
        return $getAccounts;
    }
    
    public function get_last_recurring_account_info($cuID) {
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('recurring_account_primary', 'Yes'); 
        $this->db->where('status', 1); 
        $this->db->where('deleted', 0); 
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $getLastRecurringAccountInfo             = $this->db->get();
        return $getLastRecurringAccountInfo; 
    }

    public function get_recurring_accounts($accountID) {
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('recurring_account_id', $accountID); 
        $getRecurringAccounts                   = $this->db->get(); 
        return $getRecurringAccounts;
    }

    public function approve_recurring_account($accountID) {
        $statusUpdate                           = array(
            'status'                            => 1,
        );

        $this->db->where('id', $accountID); 
        return $this->db->update('bf_users_budgeting', $statusUpdate); 
    }

    public function approve_recurring_schedule($accountID) {
        $statusUpdate                           = array(
            'status'                            => 1,
        );

        $this->db->where('recurring_account_id', $accountID); 
        return $this->db->update('bf_users_budgeting', $statusUpdate); 
    }

    public function cancel_account($accountID) {
        $statusUpdate                           = array(
            'status'                            => 0,
            'deleted'                           => 1,
        );

        $this->db->where('id', $accountID); 
        return $this->db->update('bf_users_budgeting', $statusUpdate); 
    }

    public function cancel_subaccount($accountID) {
        $statusUpdate                           = array(
            'status'                            => 0,
            'deleted'                           => 1,
        );

        $this->db->where('recurring_account_id', $accountID); 
        return $this->db->update('bf_users_budgeting', $statusUpdate); 
    }

    public function get_paid_status($accountID) {
        $this->db->from('bf_users_budgeting');
        $this->db->where('id', $accountID);
        $getPaidStatus                          = $this->db->get(); 
        foreach($getPaidStatus->result_array() as $accountStatus) {
            $paidStatus                         = $accountStatus['paid'];
        }
        return $paidStatus;
    }

    public function paid_account($accountID) {
        $getAccountInfo                         = $this->get_account_information($accountID); 
        foreach ($getAccountInfo->result_array() as $accountInfo) {
            $walletID                           = $accountInfo['wallet_id'];
            if (!empty($walletID)) {
                $accountBalance                 = $accountInfo['net_amount'];
                $getWalletInfo                  = $this->get_wallet_info($walletID); 
                // foreach ($getWalletInfo->result_array() as $walletInfo) {
                    
                // }
                if ($this->update_wallet_balance($walletID)) {};
                $statusUpdate                   = array(
                    'paid'                      => 1,
                    'paid_date'                 => date("m-d-Y"),
                    'paid_time'                 => date("h:i:s A"),
                );
        
                $this->db->where('id', $accountID); 
                return $this->db->update('bf_users_budgeting', $statusUpdate); 
            } else{
                $statusUpdate                   = array(
                    'paid'                      => 1,
                    'paid_date'                 => date("m-d-Y"),
                    'paid_time'                 => date("h:i:s A"),
                );
        
                $this->db->where('id', $accountID); 
                return $this->db->update('bf_users_budgeting', $statusUpdate); 
            }
        }
    }

    public function update_wallet_balance($walletID) {
        $this->db->from('bf_users'); 
    }
    
    // public function paid_account($accountID) {

    //     $statusUpdate                           = array(
    //         'paid'                              => 1,
    //     );

    //     $this->db->where('id', $accountID); 
    //     return $this->db->update('bf_users_budgeting', $statusUpdate); 
    // }

    public function unpaid_account($accountID) {
        $statusUpdate                           = array(
            'paid'                              => 0,
        );

        $this->db->where('id', $accountID); 
        return $this->db->update('bf_users_budgeting', $statusUpdate); 
    }

    public function get_income_accounts($cuID) {
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1); 
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Income'); 
        $getIncomeAccounts                      = $this->db->get();
        return $getIncomeAccounts;
    }

    public function get_income_accounts_summary($cuID) {
        $this->db->select_sum('net_amount');
        // $this->db->select('account_type');
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1); 
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Income'); 
        $getIncomeAccountSummary                = $this->db->get();
        return $getIncomeAccountSummary;
    }

    public function get_expense_accounts($cuID) {
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1); 
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Expense'); 
        $getExpenseAccounts                     = $this->db->get();
        return $getExpenseAccounts;
    }

    public function get_expense_accounts_summary($cuID) {
        $this->db->select_sum('net_amount');
        // $this->db->select('account_type');
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1); 
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Expense'); 
        $getExpenseAccountSummary               = $this->db->get();
        return $getExpenseAccountSummary;
    }

    public function get_this_month_income_account_summary($cuID) {
        $thisMonth                              = date("m");
        $this->db->select_sum('net_amount');
        // $this->db->select('account_type');
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1); 
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Income'); 
        $this->db->where('month', $thisMonth); 
        $getIncomeAccountSummary                = $this->db->get();
        return $getIncomeAccountSummary;
    }

    public function get_last_month_income_account_summary($cuID) {
        $thisMonth                              = date("m");
        $lastMonth                              = $thisMonth - 1;
        $this->db->select_sum('net_amount');
        // $this->db->select('account_type');
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1); 
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Income'); 
        $this->db->where('month', $lastMonth); 
        $getIncomeAccountSummary                = $this->db->get();
        return $getIncomeAccountSummary;
    }
    
    public function get_expense_account_summary($cuID) {
        $this->db->select_sum('net_amount');
        $this->db->select('account_type');
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1); 
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Expense'); 
        $getExpenseAccountSummary               = $this->db->get();
        return $getExpenseAccountSummary;
    }

    public function get_this_month_expense_account_summary($cuID) {
        $thisMonth                              = date("m");
        $this->db->select_sum('net_amount');
        $this->db->select('account_type');
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1); 
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Expense'); 
        $this->db->where('month', $thisMonth); 
        $getExpenseAccountSummary               = $this->db->get();
        return $getExpenseAccountSummary;
    }

    public function get_last_month_expense_account_summary($cuID) {
        $thisMonth                              = date("m");
        $lastMonth                              = $thisMonth - 1;
        $this->db->select_sum('net_amount');
        $this->db->select('account_type');
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1); 
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('account_type', 'Expense'); 
        $this->db->where('month', $lastMonth); 
        $getExpenseAccountSummary               = $this->db->get();
        return $getExpenseAccountSummary;
    }

    public function get_first_budget_account($cuID) {
        $this->db->from('bf_users_budgeting');
        $this->db->where('created_by', $cuID);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'ASC');
        $this->db->limit(1);
        $getFirstBudgetAccount                  = $this->db->get();
        return $getFirstBudgetAccount;
    }
}
