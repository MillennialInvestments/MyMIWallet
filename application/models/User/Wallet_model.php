<?php defined('BASEPATH') || exit('No direct script access allowed');

class Wallet_model extends BF_Model
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
        $data = parent::prep_data($post_data);
        
        return $data;
    }
    
    /*
     * Dashboard Add/Edit/Delete
     * function to add/delete/update bf_dashboards
     */
    

    // Attach Wallet to Budget Record for Processing
    public function attach_wallet_to_budget_record($recordID, $walletID) {
        $userData                               = array(
            'wallet_id'                         => $walletID,
        ); 

        $this->db->where('id', $recordID); 
        return $this->db->update('bf_users_budgeting', $userData);
    }
    
    // Get All Wallet Accounts (Based on Wallet Type)
    public function get_checking_wallets($cuID) {
        $this->db->from('bf_users_bank_accounts');
        $this->db->where('account_type', 'Checking');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID); 
        $getCheckingWallets                     = $this->db->get();
        return $getCheckingWallets;
    }

    public function get_checking_wallets_summary($cuID) {
        $this->db->select_sum('balance');
        $this->db->from('bf_users_bank_accounts');
        $this->db->where('account_type', 'Checking');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID); 
        $getCheckingWalletsSummary              = $this->db->get();
        return $getCheckingWalletsSummary;
    }

    public function get_credit_wallets($cuID) {
        $this->db->from('bf_users_credit_accounts');
        $this->db->where('account_type', 'Credit');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID); 
        $getCreditWallets                       = $this->db->get();
        return $getCreditWallets;
    }

    public function get_credit_wallets_summary($cuID) {
        $this->db->select_sum('available_balance', 'credit_limit', 'current_balance');
        $this->db->from('bf_users_credit_accounts');
        $this->db->where('account_type', 'Credit');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID); 
        $getCreditWalletsSummary              = $this->db->get();
        return $getCreditWalletsSummary;
    }

    public function get_debt_wallets($cuID) {
        $this->db->from('bf_users_credit_accounts');
        $this->db->where('account_type', 'Debt');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID); 
        $getDebtWallets                       = $this->db->get();
        return $getDebtWallets;
    }

    public function get_investment_wallets($cuID) {
        $this->db->from('bf_users_invest_accounts');
        $this->db->where('account_type', 'Investment');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID); 
        $getInvestmentWallets                   = $this->db->get();
        return $getInvestmentWallets;
    }

    public function get_investment_wallets_summary($cuID) {
        $this->db->select_sum('net_worth');
        $this->db->from('bf_users_invest_accounts');
        $this->db->where('account_type', 'Investment');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID); 
        $getCreditWalletsSummary              = $this->db->get();
        return $getCreditWalletsSummary;
    }

    public function get_savings_wallets($cuID) {
        $this->db->from('bf_users_bank_accounts');
        $this->db->where('account_type', 'Savings');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID); 
        $getSavingsWallets                      = $this->db->get();
        return $getSavingsWallets;
    }

    public function get_savings_wallets_summary($cuID) {
        $this->db->select_sum('balance');
        $this->db->from('bf_users_bank_accounts');
        $this->db->where('account_type', 'Savings');
        $this->db->where('status', 1);
        $this->db->where('deleted', 0); 
        $this->db->where('user_id', $cuID); 
        $getCheckingWalletsSummary              = $this->db->get();
        return $getCheckingWalletsSummary;
    }
    
    // Get Summary of all Wallet Types (Checking / Credit / Debt / Loans)
    // Get Summary of Wallet Percent Change Summary
    public function get_all_percent_change($walletID)
    {
        $this->db->select_sum('closed_perc');
        $this->db->from('bf_users_trades');
        $this->db->where('wallet', $walletID);
        $getAllPercentChange					= $this->db->get();
        return $getAllPercentChange;
    }
    
    public function wallet_trade_gains($walletID)
    {
        $this->db->select_sum('net_gains'); 
        $this->db->from('bf_users_trades');
        $this->db->where('wallet', $walletID);
        $getWalletTradeGains 	                = $this->db->get();
        return $getWalletTradeGains;
    }
    
    public function generate_wallet($user_id, $beta, $private_key, $public_key)
    {
        $user 					                = array(
            'beta_wallet'				        => $beta,
            'private_key'				        => $private_key,
            'wallet_id'					        => $public_key,
        );
        
        $this->db->where('id', $user_id);
        return $this->db->update('bf_users', $user);
    }
         
    public function get_user_default_wallet($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('default_wallet', 'Yes');
        $getDefaultWallet   	                = $this->db->get();
        return $getDefaultWallet;
    }
 
    public function get_all_transactions($cuID)
    {
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $getTransactions                        = $this->db->get();
        return $getTransactions;
    }

    public function get_trade_alerts()
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('status', 'Opened');
        $this->db->order_by('id', 'DESC');
        $getTradeAlerts                         = $this->db->get();
        return $getTradeAlerts;
    }
            
    public function get_user_single_trades($tradeID)
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('id', $tradeID);
        $getUserTrades                          = $this->db->get();
        return $getUserTrades;
    }
            
    // Get All Wallet Trades
    public function get_wallet_trades($walletID)
    {
        $this->db->from('bf_users_trades');
        $this->db->where('wallet', $walletID);
        $getWalletTrades            = $this->db->get();
        return $getWalletTrades;
    }

    // Get Wallet Trades - Openings
    public function get_wallet_trades_openings($walletID)
    {
        // $this->db->select_sum('net_gains');
        $this->db->from('bf_users_trades');
        $this->db->where('wallet', $walletID);
        $this->db->where('order_status', 'OPENING');
        $getWalletTradesOpening					= $this->db->get();
        return $getWalletTradesOpening;
    }
    
    // Get Wallet, MyMI Coin, MyMI Gold Deposits
    public function get_all_deposits($cuID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('trans_type', 'Deposit');
        $getWalletDeposits              = $this->db->get();
    }   
     
    public function get_all_withdrawals($cuID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('trans_type', 'Withdraw');
        $getWalletDeposits              = $this->db->get();
    }

    public function get_wallet_deposits($cuID, $walletID)
    {
        if (!empty($walletID)) {
            $this->db->select_sum('amount');
            $this->db->from('bf_users_wallet_transactions');
            $this->db->where('trans_type', 'Deposit');
            $this->db->where('wallet_id', $walletID);
            $getWalletDeposits 		= $this->db->get();
            return $getWalletDeposits;
        } else {
            $this->db->select_sum('amount');
            $this->db->from('bf_users_wallet_transactions');
            $this->db->where('trans_type', 'Deposit');
            $this->db->where('user_id', $cuID);
            $getWalletDeposits 		= $this->db->get();
            return $getWalletDeposits;
        }
    }
    
    public function get_wallet_withdrawals($cuID, $walletID)
    {
        if ($walletID !== null) {
            $this->db->select_sum('amount');
            $this->db->from('bf_users_wallet_transactions');
            $this->db->where('trans_type', 'Withdraw');
            $this->db->where('wallet_id', $walletID);
            $getWalletWithdrawals 	= $this->db->get();
            return $getWalletWithdrawals;
        } else {
            $this->db->select_sum('amount');
            $this->db->from('bf_users_wallet_transactions');
            $this->db->where('trans_type', 'Withdraw');
            $this->db->where('user_id', $cuID);
            $getWalletWithdrawals 	= $this->db->get();
            return $getWalletWithdrawals;
        }
    }
    
    public function get_single_wallet_deposits($wallet_id)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('trans_type', 'Deposit');
        $this->db->where('wallet_id', $wallet_id);
        $getSingleWalletDeposits	= $this->db->get();
        return $getSingleWalletDeposits;
    }
    
    public function get_single_wallet_withdrawals($wallet_id)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('trans_type', 'Withdraw');
        $this->db->where('wallet_id', $wallet_id);
        $getSingleWalletWithdrawals	= $this->db->get();
        return $getSingleWalletWithdrawals;
    }
    
    public function get_last_wallet_deposit($cuID, $walletID)
    {
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('trans_type', 'Deposit');
        $this->db->where('wallet_id', $walletID);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $getLastDeposit = $this->db->get();
        return $getLastDeposit;
    }
        
    public function get_last_wallet_withdraw($cuID, $walletID)
    {
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('trans_type', 'Withdraw');
        $this->db->where('wallet_id', $walletID);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $getLastWithdraw = $this->db->get();
        return $getLastWithdraw;
    }
    
    public function complete_deposit($transID)
    {
        $user				= array(
            'active'		=> 'Yes',
        );
        
        $this->db->where('id', $transID);
        return $this->db->update('bf_users_wallet_transactions', $user);
    }
    
    public function get_mymic_deposits($cuID)
    {
        $this->db->from('bf_exchanges_orders');
        $this->db->where('user_id', $cuID);
        $this->db->order_by('id', 'ASC');
        $this->db->limit(1);
        $getMyMICDeposits				= $this->db->get();
        return $getMyMICDeposits;
    }

    public function get_mymig_deposits($cuID)
    {
        $this->db->from('bf_uers_coin_purchases');
        $this->db->where('user_id', $cuID);
        $this->db->where('coin', 'MYMIG');
        $this->db->limit(1);
        $getMyMICDeposits				= $this->db->get();
        return $getMyMICDeposits;
    }
    
    public function purchase_feature($user_id, $user_email, $wallet_id, $feature_cost, $purchase_type, $initial_balance, $amount, $total_coins, $remaining_balance)
    {
        $user = array(
            'user_id'					=> $user_id,
            'user_email'				=> $user_email,
            'wallet_id'					=> $wallet_id,
            'feature_cost'				=> $feature_cost,
            'purchase_type'				=> $purchase_type,
            'initial_balance'			=> $initial_balance,
            'amount'					=> $amount,
            'total'						=> $total_coins,
            'remaining_balance'			=> $remaining_balance,
        );
        
        return $this->db->insert('bf_users_purchases', $user);
    }
    
    public function add_wallet($beta, $user_id, $username, $user_email, $broker, $type, $amount, $nickname)
    {
        $user = array(
            'beta'						=> $beta,
            'user_id'					=> $user_id,
            'username'					=> $username,
            'user_email'				=> $user_email,
            'broker'					=> $broker,
            'type'						=> $type,
            'amount'					=> $amount,
            'initial_value'				=> $amount,
            'nickname'					=> $nickname,
        );
        
        return $this->db->insert('bf_users_wallet', $user);
    }
    
    public function approve_wallet($wallet_id)
    {
        $user                           = array(
            'active'                    => 'Yes',
        );
        $this->db->where('id'. $wallet_id);
        return $this->db->update('bf_users_wallet', $user);
    }

    public function edit_wallet($wallet_id, $user_id, $user_email, $broker, $type, $amount, $nickname)
    {
        $user = array(
            'user_id'					=> $user_id,
            'user_email'				=> $user_email,
            'broker'					=> $broker,
            'type'						=> $type,
            'amount'					=> $amount,
            'nickname'					=> $nickname,
        );
        $this->db->where('id', $wallet_id);
        return $this->db->update('bf_users_wallet', $user);
    }
    
    public function delete_wallet($wallet_id)
    {
        $this->db->where('id', $wallet_id);
        return $this->db->delete('bf_users_wallet');
    }
    
    public function add_fund_deposit($active, $unix_timestamp, $date, $month, $day, $year, $time, $trans_type, $currency, $wallet_id, $bank_account_id, $broker, $nickname, $user_id, $user_email, $type, $trans_date, $wallet_sum, $new_amount, $amount, $fees, $total_cost)
    {
        $wallet = array(
            'amount'				=> $amount,
        );
        $this->db->where('id', $wallet_id);
        $this->db->update('bf_users_wallet', $wallet);
        
        $user = array(
            'active'					=> $active,
            'unix_timestamp'			=> $unix_timestamp,
            'submitted_date'			=> $date,
            'time'						=> $time,
            'month'						=> $month,
            'day'						=> $day,
            'year'						=> $year,
            'trans_type'				=> $trans_type,
            'currency'					=> $currency,
            'wallet_id'					=> $wallet_id,
            'bank_account'				=> $bank_account_id,
            'broker'					=> $broker,
            'nickname'					=> $nickname,
            'user_id'					=> $user_id,
            'user_email'				=> $user_email,
            'type'						=> $type,
            'deposit_date'				=> $trans_date,
            'amount'                    => $new_amount,
            'initial_amount'            => $wallet_sum,
            'current_amount'			=> $amount,
            'fees'						=> $fees,
            'total_cost'				=> $total_cost,
        );
        
        return $this->db->insert('bf_users_wallet_transactions', $user);
    }
    
    public function add_fund_withdraw($active, $unix_timestamp, $date, $month, $day, $year, $time, $trans_type, $currency, $wallet_id, $bank_account_id, $broker, $nickname, $user_id, $user_email, $type, $trans_date, $amount, $fees, $total_cost)
    {
        $wallet = array(
            'amount'					=> $amount,
        );
        $this->db->where('wallet_id', $wallet_id);
        $this->db->update('bf_users_wallet', $wallet);
        
        $user = array(
            'active'					=> $active,
            'unix_timestamp'			=> $unix_timestamp,
            'submitted_date'			=> $date,
            'time'						=> $time,
            'month'						=> $month,
            'day'						=> $day,
            'year'						=> $year,
            'trans_type'				=> $trans_type,
            'currency'					=> $currency,
            'wallet_id'					=> $wallet_id,
            'bank_account'				=> $bank_account_id,
            'broker'					=> $broker,
            'nickname'					=> $nickname,
            'user_id'					=> $user_id,
            'user_email'				=> $user_email,
            'type'						=> $type,
            'deposit_date'				=> $trans_date,
            'amount'					=> $amount,
            'fees'						=> $fees,
            'total_cost'				=> $total_cost,
        );
        
        return $this->db->insert('bf_users_wallet_transactions', $user);
    }
   
    
    public function add_wallet_deposit($wallet_id, $unix_timestamp, $date, $time, $month, $day, $year, $trans_date, $trans_type, $user_id, $user_email, $type, $broker, $nickname, $wallet_sum, $amount)
    {
        $newWalletAmount				= $wallet_sum + $amount;
        $wallet = array(
            'amount'					=> $newWalletAmount,
            'initial_value'				=> $wallet_sum,
        );
        $this->db->where('wallet_id', $wallet_id);
        $this->db->update('bf_users_wallet', $wallet);
        
        $user = array(
            'unix_timestamp'			=> $unix_timestamp,
            'submitted_date'			=> $date,
            'time'						=> $time,
            'month'						=> $month,
            'day'						=> $day,
            'year'						=> $year,
            'trans_type'				=> $trans_type,
            'wallet_id'					=> $wallet_id,
            'user_id'					=> $user_id,
            'user_email'				=> $user_email,
            'type'						=> $type,
            'broker'					=> $broker,
            'nickname'					=> $nickname,
            'deposit_date'				=> $trans_date,
            'amount'					=> $amount,
            'initial_amount'			=> $wallet_sum,
            'current_amount'			=> $newWalletAmount,
        );
        
        return $this->db->insert('bf_users_wallet_transactions', $user);
    }
    
    public function add_wallet_withdraw($wallet_id, $unix_timestamp, $date, $time, $month, $day, $year, $trans_date, $trans_type, $user_id, $user_email, $type, $broker, $nickname, $wallet_sum, $amount)
    {
        $newWalletAmount				= $wallet_sum - $amount;
        $wallet = array(
            'amount'					=> $newWalletAmount,
            'initial_value'				=> $wallet_sum,
        );
        $this->db->where('wallet_id', $wallet_id);
        $this->db->update('bf_users_wallet', $wallet);
         
        $user = array(
            'unix_timestamp'			=> $unix_timestamp,
            'submitted_date'			=> $date,
            'time'						=> $time,
            'month'						=> $month,
            'day'						=> $day,
            'year'						=> $year,
            'trans_type'				=> $trans_type,
            'wallet_id'					=> $wallet_id,
            'user_id'					=> $user_id,
            'user_email'				=> $user_email,
            'type'						=> $type,
            'broker'					=> $broker,
            'withdraw_date'				=> $trans_date,
            'amount'					=> $amount,
            'nickname'					=> $nickname,
            'initial_amount'			=> $wallet_sum,
            'current_amount'			=> $newWalletAmount,
        );
        
        return $this->db->insert('bf_users_wallet_transactions', $user);
    }
    
    public function connect_bank_account($date, $time, $user_id, $user_email, $wallet_id, $account_type, $bank_account_owner, $bank_name, $routing_number, $account_number, $verify_account, $nickname, $balance)
    {
        $user							= array(
            'status'                    => 1,
            'date'						=> $date,
            'time'						=> $time,
            'user_id'					=> $user_id,
            'user_email'				=> $user_email,
            'wallet_id'					=> $wallet_id,
            'account_type'				=> $account_type,
            'bank_account_owner'		=> $bank_account_owner,
            'bank_name'					=> $bank_name,
            'routing_number'			=> $routing_number,
            'account_number'			=> $account_number,
            'verify_account'			=> $verify_account,
            'nickname'					=> $nickname,
            'balance'					=> $balance,
        );
        return $this->db->insert('bf_users_bank_accounts', $user);
    }

    public function save_user_account($cuID, $refresh_auth_code)
    {
        $user							= array(
            'cuID'						=> $cuID,
            'refresh_token'			    => $refresh_auth_code,
        );
        return $this->db->insert('bf_users_trading_accounts', $user);
    }
    
    public function get_user_bank_accounts($cuID)
    {
        $this->db->from('bf_users_bank_accounts');
        $this->db->where('user_id', $cuID);
        $this->db->where('status', 1); 
        $getBankAccounts				= $this->db->get();
        return $getBankAccounts;
    }
    
    public function get_user_credit_accounts($cuID)
    {
        $this->db->from('bf_users_credit_accounts');
        $this->db->where('user_id', $cuID);
        $this->db->where('status', 1); 
        $getCreditAccounts				= $this->db->get();
        return $getCreditAccounts;
    }
    
    public function get_user_closed_credit_accounts($cuID)
    {
        $this->db->from('bf_users_credit_accounts');
        $this->db->where('user_id', $cuID);
        $this->db->where('status', 2); 
        $getCreditAccounts				= $this->db->get();
        return $getCreditAccounts;
    }
    
    public function get_user_invest_accounts($cuID)
    {
        $this->db->from('bf_users_credi_accounts');
        $this->db->where('user_id', $cuID);
        $this->db->where('status', 1); 
        $getCreditAccounts				= $this->db->get();
        return $getCreditAccounts;
    }
    
    public function get_bank_account_info($accountID) {
        $this->db->from('bf_users_bank_accounts');
        $this->db->where('id', $accountID); 
        $getBankAccount                 = $this->db->get();
        return $getBankAccount;
    }

    public function get_bank_account_information() {
        $this->db->from('bf_users_bank_accounts');
        // $this->db->where('id', $accountID); 
        $getBankAccountInfo             = $this->db->get();
        return $getBankAccountInfo;
    }
    
    public function get_wallet_count($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('status', 1);
        $getWallets				        = $this->db->get();
        $getWalletCount			        = $getWallets->num_rows();
        return $getWalletCount;
    }
    
    public function get_nondefault_wallet_count($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('default_wallet', 'No');
        $getWallets				        = $this->db->get();
        $getWalletCount			        = $getWallets->num_rows();
        return $getWalletCount;
    }
    
    public function get_wallet_info($walletID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('id', $walletID);
        $getWalletInfo			        = $this->db->get();
        return $getWalletInfo;
    }
    
    public function get_wallet_initial_summary($walletID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet');
        $this->db->where('id', $walletID);
        $getWalletInitialSum	        = $this->db->get();
        return $getWalletInitialSum;
    }
     
    public function get_all_wallets($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('active', 'Yes');
        $getUserWallets                     = $this->db->get();
        return $getUserWallets;
    }
     
    public function get_fiat_wallets($cuID, $limit)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $this->db->where('wallet_type', 'Fiat');
        $this->db->where('default_wallet', 'No');
        $this->db->order_by('id', 'ASC');
        $this->db->limit($limit);
        $getFiatWallets			= $this->db->get();
        return $getFiatWallets;
    }
     
    public function get_fiat_wallet_total_count($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $this->db->where('wallet_type', 'Fiat');
        $getFiatWallets			= $this->db->get();
        return $getFiatWallets;
    }
     
    public function get_crypto_wallet_total_count($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $this->db->where('wallet_type', 'Digital');
        $getDigitalWallets			= $this->db->get();
        return $getDigitalWallets;
    }
     
    public function get_digital_wallets($cuID, $limit)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $this->db->where('wallet_type', 'Digital');
        $this->db->where('default_wallet', 'No');
        $this->db->order_by('id', 'ASC');
        $this->db->limit($limit);
        $getDigitalWallets		= $this->db->get();
        return $getDigitalWallets;
    }
    
    public function get_wallet_totals($cuID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $walletTotals 			= $this->db->get();
        return $walletTotals;
    }
    
    public function get_non_default_wallet_totals($cuID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $this->db->where('default_wallet !=', 'Yes');
        $walletTotals 			= $this->db->get();
        return $walletTotals;
    }
    
    public function get_inactive_wallets($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'No');
        $getInactiveWallets         = $this->db->get();
        return $getInactiveWallets;
    }
    
    // All Listed Stocks (including Crypto)
    public function get_all_symbols()
    {
        $this->db->from('bf_investment_stock_listing');
        $this->db->order_by('symbol');
        $getSym = $this->db->get();
        return $getSym;
    }
    
    public function get_stock_symbols()
    {
        $this->db->from('bf_investment_stock_listing');
        $this->db->order_by('symbol');
        $this->db->where('type', 'Stock');
        $this->db->or_where('type', 'ETF');
        $getSym = $this->db->get();
        return $getSym;
    }
    
    public function get_active_swing_trade_alerts($type)
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('status', 'Opened');
        $this->db->where('category', 'Equity Trade');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(5);
        $getSwingTradeAlerts = $this->db->get();
        return $getSwingTradeAlerts;
    }
    
    public function get_active_option_trade_alerts($type)
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('status', 'Opened');
        $this->db->where('category', 'Option Trade');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(5);
        $getOptionTradeAlerts = $this->db->get();
        return $getOptionTradeAlerts;
    }

    public function get_symbol_info($symbol)
    {
        $this->db->from('bf_investment_stock_listing');
        $this->db->where('symbol', $symbol);
        $getSymbolInfo = $this->db->get();
        return $getSymbolInfo;
    }
}
