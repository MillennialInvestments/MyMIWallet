<?php defined('BASEPATH') || exit('No direct script access allowed');

class Mymigold_model extends BF_Model
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
    public function get_order_information($orderID)
    {
        $this->db->from('bf_users_coin_purchases');
        $this->db->where('id', $orderID);
        $getOrderInformation 		= $this->db->get();
        return $getOrderInformation;
    }

    public function get_initial_coin_value()
    {
        $this->db->from('bf_mymigold_overview');
        $this->db->limit(1);
        $this->db->order_by('id', 'ASC');
        $getInitialCoinValue		= $this->db->get();
        return $getInitialCoinValue;
    }

    public function get_coin_value()
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_coin_purchases');
        $this->db->where('coin', 'MYMIG');
        $this->db->where('status', 'Complete');
        $getCoinValue				= $this->db->get();
        return $getCoinValue;
    }

    public function get_coin_info()
    {
        $this->db->from('bf_users_coin_purchases');
        $this->db->limit(1);
        $this->db->where('status', 'Complete');
        $this->db->order_by('id', 'DESC');
        $getCoinInfo				= $this->db->get();
        return $getCoinInfo;
    }
    
    public function get_user_coin_total($cuID)
    {
        $this->db->select_sum('total');
        $this->db->select_sum('initial_coin_value');
        $this->db->from('bf_users_coin_purchases');
        $this->db->where('user_id', $cuID);
        $this->db->where('status', 'Complete');
        $getUserCoinTotal			= $this->db->get();
        return $getUserCoinTotal;
    }
        
    public function complete_purchase($trans_id)
    {
        // Update User Coin Purchase
        $user 						= array(
            'status'				=> 'Complete',
        );
             
        $this->db->where('id', $trans_id);
        return $this->db->update('bf_users_coin_purchases', $user);
    }
    
    public function complete_overview($trans_id)
    {
        // Update User Coin Purchase
        $user 						= array(
            'status'				=> 'Complete',
        );
             
        $this->db->where('trans_id', $trans_id);
        return $this->db->update('bf_mymigold_overview', $user);
    }
    
    public function get_user_coin_transaction_totals($cuID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_purchases');
        $this->db->where('user_id', $cuID);
        $getUserCoinTransTotal 		= $this->db->get();
        return $getUserCoinTransTotal;
    }
    
    public function update_available_coins($beta, $available_coins, $initial_value, $coin_value, $minimum_purchase, $minimum_coin_amount, $gas_fee, $trans_percent, $trans_fee)
    {
        $user						= array(
            'beta'					=> $beta,
            'available_coins'		=> $available_coins,
            'initial_value'			=> $initial_value,
            'coin_value'			=> $coin_value,
            'minimum_purchase'		=> $minimum_purchase,
            'minimum_coin_amount'	=> $minimum_coin_amount,
            'gas_fee'				=> $gas_fee,
            'trans_percent'			=> $trans_percent,
            'trans_fee'				=> $trans_fee,
        );
        
        return $this->db->insert('bf_mymigold_overview', $user);
    }

    public function add_user_request($beta, $user_id, $user_email, $coin, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $new_coin_value, $amount, $total, $total_cost, $total_fees, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent)
    {
        $user = array(
            'beta'					=> $beta,
            'user_id'				=> $user_id,
            'user_email'			=> $user_email,
            'coin'					=> $coin,
            'wallet_id'				=> $wallet_id,
            'initial_value'			=> $initial_value,
            'current_value'			=> $current_value,
            'available_coins'		=> $available_coins,
            'new_availability'		=> $new_availability,
            'initial_coin_value'	=> $initial_coin_value,
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
        );
        $this->db->insert('bf_users_wallet_transactions', $user);
        $this->db->insert('bf_users_coin_purchases', $user);
        return $insert_id = $this->db->insert_id();
    }

    public function add_user_feature_request($status, $beta, $user_id, $user_email, $coin, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $new_coin_value, $amount, $total, $total_cost, $total_fees, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent)
    {
        $user = array(
            'status'				=> $status,
            'beta'					=> $beta,
            'user_id'				=> $user_id,
            'user_email'			=> $user_email,
            'coin'					=> $coin,
            'wallet_id'				=> $wallet_id,
            'initial_value'			=> $initial_value,
            'current_value'			=> $current_value,
            'available_coins'		=> $available_coins,
            'new_availability'		=> $new_availability,
            'initial_coin_value'	=> $initial_coin_value,
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
        );
        
        $this->db->insert('bf_users_coin_purchases', $user);
        return $insert_id = $this->db->insert_id();
    }
    
    public function adjust_value($status, $purchase_id, $beta, $user_id, $user_email, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $new_coin_value, $amount, $total, $total_cost, $total_fees, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent)
    {
        $user = array(
            'status'				=> $status,
            'trans_id'				=> $purchase_id,
            'beta'					=> $beta,
            'wallet_id'				=> $wallet_id,
            'user_id'				=> $user_id,
            'user_email'			=> $user_email,
            'initial_value'			=> $initial_value,
            'current_value'			=> $current_value,
            'available_coins'		=> $available_coins,
            'new_availability'		=> $new_availability,
            'initial_coin_value'	=> $initial_coin_value,
            'coin_value'			=> $new_coin_value,
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
        );
        
        return $this->db->insert('bf_mymigold_overview', $user);
    }
    
    public function get_last_purchase_id()
    {
        $this->db->from('bf_users_coin_purchases');
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $getPurchaseID				= $this->db->get();
        return $getPurchaseID;
    }

    public function get_last_order_info($cuID)
    {
        $this->db->from('bf_users_coin_purchases');
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $this->db->where('user_id', $cuID);
        $this->db->where('coin', 'MYMIG');
        $this->db->where('status', 'Incomplete');
        $getUserLastOrder		= $this->db->get();
        return $getUserLastOrder;
    }

    public function get_last_incomplete_order_info($cuID)
    {
        $this->db->from('bf_users_coin_purchases');
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $this->db->where('user_id', $cuID);
        $this->db->where('status', 'Incomplete');
        $this->db->where('coin', 'MYMIG');
        $getUserLastOrder		= $this->db->get();
        return $getUserLastOrder;
    }

    public function get_last_completed_order_info($cuID)
    {
        $this->db->from('bf_users_coin_purchases');
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $this->db->where('user_id', $cuID);
        $this->db->where('status', 'Complete');
        $this->db->where('coin', 'MYMIG');
        $getUserLastOrder		= $this->db->get();
        return $getUserLastOrder;
    }
        
    public function purchase_feature($purchase_id, $status, $beta, $user_id, $user_email, $wallet_id, $feature_cost, $purchase_type, $initial_balance, $amount, $total, $remaining_balance)
    {
        $user = array(
            'trans_id'			=> $purchase_id,
            'status'			=> $status,
            'beta'				=> $beta,
            'user_id'			=> $user_id,
            'user_email'		=> $user_email,
            'wallet_id'			=> $wallet_id,
            'feature_cost'		=> $feature_cost,
            'purchase_type'		=> $purchase_type,
            'initial_balance'	=> $initial_balance,
            'amount'			=> $amount,
            'total'				=> $total,
            'remaining_balance'	=> $remaining_balance,
        );
        
        return $this->db->insert('bf_users_purchases', $user);
    }
    
    // public function get_withdrawals($cuID)
    // {
    // }
}
