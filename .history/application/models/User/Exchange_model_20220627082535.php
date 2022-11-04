<?php defined('BASEPATH') || exit('No direct script access allowed');

class Exchange_model extends BF_Model
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
        $today                              = date("m/d/Y"); 
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
    
    public function get_exchanges()
    {
        $this->db->from('bf_exchanges');
        $this->db->where('status', 'Yes');
        $getExchanges 						= $this->db->get();
        return $getExchanges;
    }
    
    public function get_exchange_summary($market_pair, $market)
    {
        $this->db->from('bf_exchanges');
        $this->db->where('status', 'Yes');
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $getExchange 						= $this->db->get();
        return $getExchange;
    }
    
    public function get_all_open_orders($market_pair, $market)
    {
        $this->db->select('id, status, current_date, trade_type, amount, total');
        $this->db->from('bf_exchanges_orders');
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $this->db->order_by('id', 'DESC');
        $getAllOpenOrders 					= $this->db->get()->result_array();
        return $getAllOpenOrders;
    }
    
    public function get_market_summary_amount($market_pair, $market)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_exchanges_orders');
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $this->db->where('status', 'Closed');
        $getTotalCoinAmount					= $this->db->get();
        return $getTotalCoinAmount;
    }
    
    public function get_market_summary_total_coins($market_pair, $market)
    {
        $this->db->select_sum('total');
        $this->db->from('bf_exchanges_orders');
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $this->db->where('status', 'Closed');
        $getTotalCoinCount					= $this->db->get();
        return $getTotalCoinCount;
    }
    
    public function get_market_summary_open_coins($market_pair, $market)
    {
        $this->db->select_sum('total');
        $this->db->from('bf_exchanges_orders');
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $this->db->where('status', 'Open');
        $getTotalOpenCoins					= $this->db->get();
        return $getTotalOpenCoins;
    }
    
    public function add_order($month, $day, $year, $time, $trade_type, $beta, $user_id, $user_email, $wallet_id, $market_pair, $market, $initial_value, $coin_value, $available_coins, $amount, $minimum_purchase, $total, $gas_fee, $fees, $trans_percent, $trans_fee, $total_cost, $current_value, $new_availability, $new_coin_value)
    {
        $user 								= array(
            'month'						 	=> $month,
            'day'						 	=> $day,
            'year'						 	=> $year,
            'time'						 	=> $time,
            'trade_type'				 	=> $trade_type,
            'beta'						 	=> $beta,
            'user_id'					 	=> $user_id,
            'user_email'				 	=> $user_email,
            'wallet_id'					 	=> $wallet_id,
            'market_pair'				 	=> $market_pair,
            'market'					 	=> $market,
            'initial_value'				 	=> $initial_value,
            'available_coins'			 	=> $available_coins,
            'amount'					 	=> $amount,
            'minimum_purchase'			 	=> $minimum_purchase,
            'total'						 	=> $total,
            'gas_fee'					 	=> $gas_fee,
            'fees'						 	=> $fees,
            'trans_percent'				 	=> $trans_percent,
            'trans_fee'						=> $trans_fee,
            'total_cost'					=> $total_cost,
            'current_value'					=> $current_value,
            'new_availability'				=> $new_availability,
            'initial_coin_value'		 	=> $coin_value,
            'new_coin_value'				=> $new_coin_value,
        );
        return $this->db->insert('bf_exchanges_orders', $user);
    }
        
    public function add_order_fetch($month, $day, $year, $time, $trade_type, $beta, $user_id, $user_email, $wallet_id, $market_pair, $market, $initial_value, $coin_value, $available_coins, $amount, $minimum_purchase, $total, $gas_fee, $fees, $trans_percent, $trans_fee, $total_cost, $current_value, $new_availability, $new_coin_value)
    {
        $user 								= array(
            'month'						 	=> $month,
            'day'						 	=> $day,
            'year'						 	=> $year,
            'time'						 	=> $time,
            'trade_type'				 	=> $trade_type,
            'beta'						 	=> $beta,
            'user_id'					 	=> $user_id,
            'user_email'				 	=> $user_email,
            'wallet_id'					 	=> $wallet_id,
            'market_pair'				 	=> $market_pair,
            'market'					 	=> $market,
            'initial_value'				 	=> $initial_value,
            'available_coins'			 	=> $available_coins,
            'amount'					 	=> $amount,
            'minimum_purchase'			 	=> $minimum_purchase,
            'total'						 	=> $total,
            'gas_fee'					 	=> $gas_fee,
            'fees'						 	=> $fees,
            'trans_percent'				 	=> $trans_percent,
            'trans_fee'						=> $trans_fee,
            'total_cost'					=> $total_cost,
            'current_value'					=> $current_value,
            'new_availability'				=> $new_availability,
            'initial_coin_value'		 	=> $coin_value,
            'new_coin_value'				=> $new_coin_value,
        );
        return $this->db->insert('bf_exchanges_orders', $user);
    }
    
    public function getOrderById($orderId)
    {
        $this->db->from('bf_exchanges_orders');
        $this->db->where('id', $orderId);
        $getOrderID 						= $this->db->get();
        return $getOrderID->result();
    }
        
    public function add_account_information($user_id, $kyc, $first_name, $middle_name, $last_name, $name_suffix, $phone, $address, $city, $state, $country, $zipcode, $timezones, $language, $advertisement)
    {
        $user  = array(
            'kyc'							=> $kyc,
            'first_name'					=> $first_name,
            'middle_name'					=> $middle_name,
            'last_name'						=> $last_name,
            'name_suffix'					=> $name_suffix,
            'phone'							=> $phone,
            'address'						=> $address,
            'city'							=> $city,
            'state'							=> $state,
            'country'						=> $country,
            'zipcode'						=> $zipcode,
            'timezone'						=> $timezones,
            'language'						=> $language,
            'advertisement'					=> $advertisement,
        );
        
        $this->db->where('id', $user_id);
        return $this->db->update('bf_users', $user);
    }
    
    public function get_coin_value()
    {
        $this->db->from('bf_mymigold_overview');
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $getCoinValue						= $this->db->get();
        return $getCoinValue;
    }
    
    public function get_user_info($cuID)
    {
        $this->db->from('bf_users');
        $this->db->where('id', $cuID);
        $getUserInfo						= $this->db->get();
        return $getUserInfo;
    }
    
    public function get_user_contact_info($cuID)
    {
        $this->db->from('bf_exchanges_coin_listing');
        $this->db->where('user_id', $cuID);
        $getUserInfo						= $this->db->get();
        return $getUserInfo;
    }
    
    public function get_user_wallet_info($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('default_wallet', 'Yes');
        $getUserWalletInfo					= $this->db->get();
        return $getUserWalletInfo;
    }
    
    public function get_user_fund_total($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('default_wallet', 'Yes');
        $getUserWalletInfo					= $this->db->get();
        return $getUserWalletInfo;
    }
    
    public function kyc_reward($status, $cuBeta, $cuID, $cuEmail, $cuWalletID, $reward, $reward_type, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $coin_value, $amount, $total, $total_cost, $gas_fee, $trans_fee, $trans_percent)
    {
        $user								= array(
            'status'						=> $status,
            'beta'							=> $cuBeta,
            'user_id'						=> $cuID,
            'user_email'					=> $cuEmail,
            'wallet_id'						=> $cuWalletID,
            'reward'						=> $reward,
            'reward_type'					=> $reward_type,
            'initial_value'					=> $initial_value,
            'current_value'					=> $current_value,
            'available_coins'				=> $available_coins,
            'new_availability'				=> $new_availability,
            'initial_coin_value'			=> $initial_coin_value,
            'coin_value'					=> $coin_value,
            'amount'						=> $amount,
            'total'							=> $total,
            'total_cost'					=> $total_cost,
            'gas_fee'						=> $gas_fee,
            'trans_fee'						=> $trans_fee,
            'trans_percent'					=> $trans_percent,
        );
        return $this->db->insert('bf_mymigold_overview', $user);
    }
    
    public function add_reward($status, $cuBeta, $cuID, $cuEmail, $cuWalletID, $reward, $reward_type, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $coin_value, $amount, $total, $total_cost, $gas_fee, $trans_fee, $trans_percent)
    {
        $user								= array(
            'status'						=> $status,
            'beta'							=> $cuBeta,
            'user_id'						=> $cuID,
            'user_email'					=> $cuEmail,
            'wallet_id'						=> $cuWalletID,
            'reward'						=> $reward,
            'reward_type'					=> $reward_type,
            'coin'							=> 'MYMIG',
            'initial_value'					=> $initial_value,
            'current_value'					=> $current_value,
            'available_coins'				=> $available_coins,
            'new_availability'				=> $new_availability,
            'initial_coin_value'			=> $initial_coin_value,
            'coin_value'					=> $coin_value,
            'amount'						=> $amount,
            'total'							=> $total,
            'total_cost'					=> $total_cost,
            'gas_fee'						=> $gas_fee,
            'trans_fee'						=> $trans_fee,
            'trans_percent'					=> $trans_percent,
        );
        return $this->db->insert('bf_users_coin_purchases', $user);
    }
    
    public function get_market_closed_orders($market_pair, $market)
    {
        //~ $this->db->select($select);
        $this->db->from('bf_exchanges_orders');
        $this->db->where('status', 'Closed');
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $getAllClosedOrders					= $this->db->get();
        return $getAllClosedOrders;
    }

    public function get_open_listing_app($cuID, $appID)
    {
        if (!empty($appID)) {
            $this->db->from('bf_exchanges_listing_request');
            $this->db->where('id', $appID);
            $getAppInfo						= $this->db->get();
        } else {
            $this->db->from('bf_exchanges_listing_request');
            $this->db->where('user_id', $cuID);
            $this->db->not_like('status', 'Complete');
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $getAppInfo						= $this->db->get();
        }
        return $getAppInfo;
    }

    public function get_open_listing_app_count($cuID)
    {
        $this->db->from('bf_exchanges_listing_request');
        $this->db->where('user_id', $cuID);
        $this->db->not_like('status', 'Complete');
        $getAppInfo							= $this->db->get();
        return $getAppInfo;
    }

    public function get_blockchains()
    {
        $this->db->from('bf_exchanges_blockchains');
        $this->db->where('active', 'Yes');
        $getBlockchains						= $this->db->get();
        return $getBlockchains;
    }

    public function get_kyc_status($cuID)
    {
        $this->db->select('kyc');
        $this->db->from('bf_users');
        $this->db->where('id', $cuID);
        $getKYCStatus						= $this->db->get()->result_array();
        return $getKYCStatus;
    }

    public function get_asset_listing_requests($cuID)
    {
        $this->db->from('bf_exchanges_listing_request');
        $this->db->where('user_id', $cuID); 
        $this->db->not_like('status', 'Approved');
        $getAssetListingRequest				= $this->db->get();
        return $getAssetListingRequest;
    }
    
    public function get_user_asset_info($cuID)
    {
        $this->db->from('bf_exchanges');
        $this->db->where('creator', $cuID);
        $this->db->where('market_pair', 'USD');
        $this->db->where('status', 'Yes');
        $getUserAssetInfo					= $this->db->get();
        return $getUserAssetInfo;
    }
    
    public function get_user_asset_count($cuID)
    {
        $this->db->from('bf_exchanges_listing_request');
        $this->db->where('user_id', $cuID);
        $getUserAssetCount					= $this->db->get();
        return $getUserAssetCount;
    }

    public function get_user_asset_net_worth($cuID)
    {
        $this->db->select_sum('current_value');
        $this->db->from('bf_exchanges');
        $this->db->where('market_pair', 'USD');
        $this->db->where('creator', $cuID);
        $getUserAssetNetWorth				= $this->db->get();
        return $getUserAssetNetWorth;
    }

    public function get_user_asset_volume($cuID)
    {
        $this->db->select_sum('total_volume');
        $this->db->from('bf_exchanges');
        $this->db->where('creator', $cuID);
        $getUserAssetVolume				    = $this->db->get();
        return $getUserAssetVolume;
    }

    public function get_pending_assets(){
        $this->db->from('bf_exchanges_listing_request');
        $this->db->where('date', $today); 
        $this->db->where('status !=', 'Viewed');
        $getPendingAssets                   = $this->db->get(); 
        return $getPendingAssets;
    }

    public function get_approved_assets() {
        $this->db->from('bf_exchanges_assets');
        $this->db->where('date', $today); 
        $this->db->where('status', 'Approved');
        $getApprovedAssets                  = $this->db->get(); 
    }

    public function get_total_transactions
}
