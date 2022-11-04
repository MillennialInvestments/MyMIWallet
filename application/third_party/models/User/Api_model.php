<?php defined('BASEPATH') || exit('No direct script access allowed');

class Api_model extends BF_Model
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


    public function get_exchange_orders($trade_type, $market_pair, $market)
    {
        $this->db->from('bf_exchanges_orders');
        $this->db->where('trade_type', $trade_type);
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $getExchangeOrders		= $this->db->get()->result_array();
        return $getExchangeOrders;
    }
    
    public function get_single_exchange_orders($market_pair, $market, $status)
    {
        $this->db->from('bf_exchanges_orders');
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $this->db->where('status', $status);
        $getExchangeOrders		= $this->db->get()->result_array();
        return $getExchangeOrders;
    }
    
    //~ public function get_all_open_orders($market_pair, $market) {
    //~ $this->db->from('bf_exchanges_orders');
    //~ $this->db->where('market_pair', $market_pair);
    //~ $this->db->where('market', $market);
    //~ $this->db->order_by('id', 'DESC');
    //~ $getAllOpenOrders 					= $this->db->get();
    //~ return $getAllOpenOrders;
    //~ }
    
    public function get_all_open_orders($market_pair, $market)
    {
        $this->db->from('bf_exchanges_orders');
        $this->db->where('status', 'Open');
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $getAllOpenOrders 							= $this->db->get();
        return $getAllOpenOrders;
    }
    
    public function get_recent_orders($market_pair, $market, $cuID)
    {
        $this->db->from('bf_exchanges_orders');
        $this->db->where('status', 'Closed');
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $this->db->where('user_id', $cuID);
        $getExchangeOrders 							= $this->db->get();
        return $getExchangeOrders;
    }
    
    public function get_market_closed_orders($market_pair, $market)
    {
        $this->db->select('new_coin_value');
        $this->db->from('bf_exchanges_orders');
        $this->db->where('status', 'Closed');
        $this->db->where('market_pair', $market_pair);
        $this->db->where('market', $market);
        $getExchangeClosedOrders					= $this->db->get()->result_array();
        return $getExchangeClosedOrders;
    }
}
