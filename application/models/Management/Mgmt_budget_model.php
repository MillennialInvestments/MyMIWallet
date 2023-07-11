<?php defined('BASEPATH') || exit('No direct script access allowed');

class Mgmt_budget_model extends BF_Model
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

    public function get_account_information($accountID) {
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('id', $accountID); 
        $getAccountInfo                         = $this->db->get();
        return $getAccountInfo; 
    }

    public function get_accounts() {
        $this->db->from('bf_users_budgeting');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        // $this->db->where('created_by', $cuID); 
        $getAccounts                            = $this->db->get();
        return $getAccounts;
    }

    public function get_income_accounts() {
        $this->db->from('bf_users_budgeting');
        $this->db->where('account_type', 'Income'); 
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        // $this->db->where('created_by', $cuID); 
        $getAccounts                            = $this->db->get();
        return $getAccounts;
    }

    public function get_expense_accounts() {
        $this->db->from('bf_users_budgeting');
        $this->db->where('account_type', 'Income'); 
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        // $this->db->where('created_by', $cuID); 
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
        $statusUpdate                           = array(
            'paid'                              => 1,
        );

        $this->db->where('id', $accountID); 
        return $this->db->update('bf_users_budgeting', $statusUpdate); 
    }


    public function unpaid_account($accountID) {
        $statusUpdate                           = array(
            'paid'                              => 0,
        );

        $this->db->where('id', $accountID); 
        return $this->db->update('bf_users_budgeting', $statusUpdate); 
    }

    public function get_income_account_summary($cuID) {
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

    public function get_debt_accounts($cuID) {
        $this->db->select_sum('net_amount'); 
        $this->db->select('account_type');
        $this->db->from('bf_users_budgeting'); 
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('created_by', $cuID); 
        $this->db->where('is_debt', 1);        
        $getDebtAccounts                        = $this->db->get(); 
        return $getDebtAccounts;
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
