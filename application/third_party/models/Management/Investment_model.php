<?php defined('BASEPATH') || exit('No direct script access allowed');

class Investment_model extends BF_Model
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

    public function get_initial_coin_value()
    {
        $this->db->from('bf_mymicoin_overview');
        $this->db->limit(1);
        $this->db->order_by('id', 'ASC');
        $getInitialCoinValue		= $this->db->get();
        return $getInitialCoinValue;
    }

    public function get_coin_value()
    {
        $this->db->from('bf_mymicoin_overview');
        $this->db->where('status', 'Complete');
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $getCoinValue				= $this->db->get();
        return $getCoinValue;
    }
    
    public function get_last_purchase_id()
    {
        $this->db->from('bf_users_coin_purchases');
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $getPurchaseID				= $this->db->get();
        return $getPurchaseID;
    }
    
    public function get_growth_strategy()
    {
        $this->db->from('bf_investments_growth_strategy');
        $getGrowthStrategy			= $this->db->get();
        return $getGrowthStrategy;
    }
    
    public function get_average_sale()
    {
        $this->db->select_avg('total');
        $this->db->from('bf_users_coin_purchases');
        $getCoinAvgSale				= $this->db->get();
        return $getCoinAvgSale;
    }
    
    public function get_coin_investments($cuWalletID)
    {
        $this->db->from('bf_users_coin_purchases');
        $this->db->where('wallet_id', $cuWalletID);
        $this->db->order_by('id', 'DESC');
        $getCoinInvestments			= $this->db->get();
        return $getCoinInvestments;
    }
    
    public function get_total_coins($cuWalletID)
    {
        $this->db->select_sum('total');
        $this->db->from('bf_users_coin_purchases');
        $this->db->where('wallet_id', $cuWalletID);
        $getTotalCoins				= $this->db->get();
        return $getTotalCoins;
    }
    
    public function get_total_value($cuWalletID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_coin_purchases');
        $this->db->where('wallet_id', $cuWalletID);
        $getTotalValue				= $this->db->get();
        return $getTotalValue;
    }
    
    public function add_request($unix_timestamp, $month, $day, $year, $time, $beta, $market, $cuID, $cuEmail, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $coin_value, $new_coin_value, $amount, $total, $total_cost, $total_fees, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent, $referral_id)
    {
        $user = array(
            'unix_timestamp'		=> $unix_timestamp,
            'month'					=> $month,
            'day'					=> $day,
            'year'					=> $year,
            'time'					=> $time,
            'beta'					=> $beta,
            'user_id'				=> $cuID,
            'user_email'			=> $cuEmail,
            'coin'					=> $market,
            'wallet_id'				=> $wallet_id,
            'initial_value'			=> $initial_value,
            'current_value'			=> $current_value,
            'available_coins'		=> $available_coins,
            'new_availability'		=> $new_availability,
            'initial_coin_value'	=> $coin_value,
            'new_coin_value'		=> $new_coin_value,
            'amount'				=> $amount,
            'total'					=> $total,
            'total_cost'			=> $total_cost,
            'total_fees'			=> $total_fees,
            'gas_fee'				=> $gas_fee,
            'trans_fee'				=> $trans_fee,
            'trans_percent'			=> $trans_percent,
            'user_gas_fee'			=> $user_gas_fee,
            'user_trans_fee'		=> $user_trans_fee,
            'user_trans_percent'	=> $user_trans_percent,
            'referral_id'			=> $referral_id,
        );
        
        return $this->db->insert('bf_users_coin_purchases', $user);
    }
    
    public function adjust_value($purchase_id, $unix_timestamp, $month, $day, $year, $time, $beta, $cuID, $cuEmail, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $coin_value, $new_coin_value, $amount, $total, $total_cost, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent)
    {
        $user = array(
            'id'					=> $purchase_id,
            'unix_timestamp'		=> $unix_timestamp,
            'month'					=> $month,
            'day'					=> $day,
            'year'					=> $year,
            'time'					=> $time,
            'beta'					=> $beta,
            'user_id'				=> $cuID,
            'user_email'			=> $cuEmail,
            'wallet_id'				=> $wallet_id,
            'initial_value'			=> $initial_value,
            'current_value'			=> $current_value,
            'available_coins'		=> $available_coins,
            'new_availability'		=> $new_availability,
            'initial_coin_value'	=> $coin_value,
            'coin_value'			=> $new_coin_value,
            'amount'				=> $amount,
            'total'					=> $total,
            'total_cost'			=> $total_cost,
            'gas_fee'				=> $user_gas_fee,
            'trans_fee'				=> $trans_fee,
            'trans_percent'			=> $trans_percent,
        );
        
        return $this->db->insert('bf_mymicoin_overview', $user);
    }
        
    public function add_exchange_orders($purchase_id, $trade_type, $unix_timestamp, $month, $day, $year, $time, $beta, $market_pair, $market, $cuID, $cuEmail, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $coin_value, $new_coin_value, $amount, $total, $total_cost, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent, $fees, $referral_id)
    {
        $user = array(
            'id'					=> $purchase_id,
            'unix_timestamp'		=> $unix_timestamp,
            'month'					=> $month,
            'day'					=> $day,
            'year'					=> $year,
            'time'					=> $time,
            'trade_type'			=> $trade_type,
            'beta'					=> $beta,
            'user_id'				=> $cuID,
            'user_email'			=> $cuEmail,
            'wallet_id'				=> $wallet_id,
            'market_pair'			=> $market_pair,
            'market'				=> $market,
            'initial_value'			=> $initial_value,
            'current_value'			=> $current_value,
            'available_coins'		=> $available_coins,
            'new_availability'		=> $new_availability,
            'amount'				=> $amount,
            'remaining_amount'		=> $amount,
            'total'					=> $total,
            'remaining_coins'		=> $total,
            'total_cost'			=> $total_cost,
            'gas_fee'				=> $gas_fee,
            'trans_fee'				=> $trans_fee,
            'trans_percent'			=> $trans_percent,
            'user_gas_fee'			=> $user_gas_fee,
            'user_trans_fees'		=> $user_trans_fee,
            'user_trans_percent'	=> $user_trans_percent,
            'fees'					=> $fees,
            'initial_coin_value'	=> $coin_value,
            'new_coin_value'		=> $new_coin_value,
        );
        
        return $this->db->insert('bf_exchanges_orders', $user);
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
    
    public function get_order_information($orderID)
    {
        $this->db->from('bf_users_coin_purchases');
        $this->db->where('id', $orderID);
        $getOrderInformation		= $this->db->get();
        return $getOrderInformation;
    }
    
    public function purchase_complete($trans_id)
    {
        $orderID					= $trans_id;
        $getOrderInfo				= $this->investment_model->get_order_information($orderID);
        foreach ($getOrderInfo->result_array() as $orderInfo) {
            $market_pair			= $orderInfo['market_pair'];
            $market					= $orderInfo['market'];
            $current_value			= $orderInfo['current_value'];
            $coins_available		= $orderInfo['new_availability'];
            $new_coin_value			= $orderInfo['new_coin_value'];
        }
        $overviewInfo				= array(
            'status'				=> 'Complete',
         );
        $coinPurchase				= array(
            'status'				=> 'Complete',
         );
        $exchangeOrder				= array(
            'status'				=> 'Closed',
         );
        $exchangeInfo				= array(
            'current_value'			=> $current_value,
            'coins_available'		=> $coins_available,
            'coin_value'			=> $new_coin_value,
         );
        
        $this->db->like('market', $market);
        $this->db->update('bf_exchanges', $exchangeInfo);
         
        $this->db->where('id', $trans_id);
        $this->db->update('bf_mymicoin_overview', $overviewInfo);
         
        $this->db->where('id', $trans_id);
        $this->db->update('bf_users_coin_purchases', $coinPurchase);
         
        $this->db->where('id', $trans_id);
        return $this->db->update('bf_exchanges_orders', $exchangeOrder);
    }
    
    public function activate_investor_account($user_id, $wallet_id, $investor)
    {
        $user						= array(
            'wallet_id'				=> $wallet_id,
            'investor'				=> $investor,
        );
        
        $this->db->where('id', $user_id);
        return $this->db->update('bf_users');
    }
    
    public function submit_investment_request($id, $display_name, $email, $phone, $address, $city, $state, $country, $zipcode, $wallet_id, $amount, $total)
    {
        $user = array(
            'user_id' 				=> $id,
            'wallet_id'				=> $wallet_id,
            'name'	 				=> $display_name,
            'email'					=> $email,
            'phone'					=> $phone,
            'address'				=> $address,
            'city'					=> $city,
            'state'					=> $state,
            'country'				=> $country,
            'zipcode'				=> $zipcode,
            'amount'				=> $amount,
            'total'					=> $total,
        );
        
        return $this->db->insert('bf_users_coin_purchases', $user);
    }
    
    public function get_investment_request()
    {
        $this->db->from('bf_users_coin_purchases');
        $getInvestmentRequests 		= $this->db->get();
        return $getInvestmentRequests;
    }
}
