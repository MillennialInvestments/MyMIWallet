<?php defined('BASEPATH') || exit('No direct script access allowed');

class Mymicoin_model extends BF_Model
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
    public function find($id = null)
    {
        $this->preFind();
        return parent::find($id);
    }

    /**
     * Find all user records and the associated role information.
     *
     * @return bool An array of objects with each user's information.
     */
    public function find_all()
    {
        $this->preFind();
        return parent::find_all();
    }
    
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


    public function get_coin_value()
    {
        $this->db->from('bf_exchanges');
        $this->db->where('market_pair', 'USD');
        $this->db->where('market', 'MYMI');
        $getCoinValue				= $this->db->get();
        return $getCoinValue;
    }
    
    public function get_user_coin_total($cuID)
    {
        $this->db->select_sum('total');
        $this->db->from('bf_exchanges_orders');
        $this->db->where('user_id', $cuID);
        $this->db->where('market', 'MYMI');
        $this->db->where('status', 'Closed');
        $getUserCoinTotal			= $this->db->get();
        return $getUserCoinTotal;
    }
        
    public function complete_purchase($trans_id, $status)
    {
        $user 						= array(
            'status'				=> 'Complete',
         );
         
        $this->db->where('id', $trans_id);
        return $this->db->update('bf_users_coin_purchases', $user);
    }
    
    public function get_user_coin_transaction_totals($cuID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_purchases');
        $this->db->where('user_id', $cuID);
        $getUserCoinTransTotal 		= $this->db->get();
        return $getUserCoinTransTotal;
    }
    
    public function get_total_coins_exchanged()
    {
        $this->db->select_sum('total');
        $this->db->from('bf_exchanges_orders');
        $this->db->where('trade_type', 'Buy');
        $this->db->where('status', 'Closed');
        $this->db->where('user_id !=', 2);
        $getTotalCoinsExchanged		= $this->db->get();
        return $getTotalCoinsExchanged;
    }
    
    public function update_available_coins($available_coins, $initial_value, $coin_value, $minimum_purchase, $minimum_coin_amount, $gas_fee, $trans_percent, $trans_fee)
    {
        $user						= array(
            'available_coins'		=> $available_coins,
            'initial_value'			=> $initial_value,
            'coin_value'			=> $coin_value,
            'minimum_purchase'		=> $minimum_purchase,
            'minimum_coin_amount'	=> $minimum_coin_amount,
            'gas_fee'				=> $gas_fee,
            'trans_percent'			=> $trans_percent,
            'trans_fee'				=> $trans_fee,
        );
        
        return $this->db->insert('bf_investments_overview', $user);
    }

    public function add_user_request($user_id, $user_email, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $coin_value, $amount, $total, $total_cost, $user_gas_fee, $trans_fee)
    {
        $user = array(
            'user_id'				=> $user_id,
            'user_email'			=> $user_email,
            'wallet_id'				=> $wallet_id,
            'initial_value'			=> $initial_value,
            'current_value'			=> $current_value,
            'available_coins'		=> $available_coins,
            'new_availability'		=> $new_availability,
            'coin_value'			=> $coin_value,
            'amount'				=> $amount,
            'total'					=> $total,
            'total_cost'			=> $total_cost,
            'gas_fee'				=> $user_gas_fee,
            'trans_fee'				=> $trans_fee,
        );
        
        return $this->db->insert('bf_users_coin_purchases', $user);
    }
        
    //~ DELETE EVERYTHING BELOW THIS LINE
    public function get_trade_alerts()
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('status', 'Opened');
        $this->db->order_by('id', 'DESC');
        $getTradeAlerts = $this->db->get();
        return $getTradeAlerts;
    }
            
    public function get_user_single_trades($tradeID)
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('id', $tradeID);
        $getUserTrades = $this->db->get();
        return $getUserTrades;
    }
    
    public function add_wallet($user_id, $user_email, $broker, $type, $amount, $nickname)
    {
        $user = array(
            'user_id'			=> $user_id,
            'user_email'		=> $user_email,
            'broker'			=> $broker,
            'type'				=> $type,
            'amount'			=> $amount,
            'nickname'			=> $nickname,
        );
        
        return $this->db->insert('bf_users_wallet', $user);
    }
    
    public function edit_wallet($wallet_id, $user_id, $user_email, $broker, $type, $amount, $nickname)
    {
        $user = array(
            'user_id'			=> $user_id,
            'user_email'		=> $user_email,
            'broker'			=> $broker,
            'type'				=> $type,
            'amount'			=> $amount,
            'nickname'			=> $nickname,
        );
        $this->db->where('id', $wallet_id);
        return $this->db->update('bf_users_wallet', $user);
    }
    
    public function add_wallet_deposit($date, $time, $trans_type, $wallet_id, $user_id, $user_email, $type, $broker, $trans_date, $amount, $nickname, $details)
    {
        $user = array(
            'submitted_date'	=> $date,
            'time'				=> $time,
            'trans_type'		=> $trans_type,
            'wallet_id'			=> $wallet_id,
            'user_id'			=> $user_id,
            'user_email'		=> $user_email,
            'type'				=> $type,
            'broker'			=> $broker,
            'deposit_date'		=> $trans_date,
            'amount'			=> $amount,
            'nickname'			=> $nickname,
            'details'			=> $details,
        );
        
        return $this->db->insert('bf_users_wallet_transactions', $user);
    }
    
    public function add_wallet_withdraw($date, $time, $trans_type, $wallet_id, $user_id, $user_email, $type, $broker, $trans_date, $amount, $nickname, $details)
    {
        $user = array(
            'submitted_date'	=> $date,
            'time'				=> $time,
            'trans_type'		=> $trans_type,
            'wallet_id'			=> $wallet_id,
            'user_id'			=> $user_id,
            'user_email'		=> $user_email,
            'type'				=> $type,
            'broker'			=> $broker,
            'withdraw_date'		=> $trans_date,
            'amount'			=> $amount,
            'nickname'			=> $nickname,
            'details'			=> $details,
        );
        
        return $this->db->insert('bf_users_wallet_transactions', $user);
    }
    
    public function get_wallet_count($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $getWallets				= $this->db->get();
        $getWalletCount			= $getWallets->num_rows();
        return $getWalletCount;
    }
    
    public function get_wallet_info($walletID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('id', $walletID);
        $getWalletInfo			= $this->db->get();
        return $getWalletInfo;
    }
    
    public function get_wallet_initial_summary($walletID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet');
        $this->db->where('id', $walletID);
        $getWalletInitialSum	= $this->db->get();
        return $getWalletInitialSum;
    }
     
    public function get_all_wallets($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $getWallets				= $this->db->get();
        return $getWallets;
    }
     
    public function get_fiat_wallets($cuID, $limit)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $this->db->where('type', 'Fiat');
        $this->db->order_by('amount', 'DESC');
        $this->db->limit($limit);
        $getFiatWallets			= $this->db->get();
        return $getFiatWallets;
    }
     
    public function get_digital_wallets($cuID, $limit)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $this->db->where('type', 'Digital');
        $this->db->order_by('amount', 'DESC');
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
    
    public function get_wallet_deposits($cuID, $walletID)
    {
        if ($walletID !== null) {
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
