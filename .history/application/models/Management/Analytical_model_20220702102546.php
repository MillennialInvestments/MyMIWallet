<?php defined('BASEPATH') || exit('No direct script access allowed');

class Analytical_model extends BF_Model
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
    
    public function get_pending_assets(){
        $today                              = date("m/d/Y");
        $this->db->from('bf_exchanges_listing_request');
        // $this->db->where('date', $today); 
        $this->db->where('status !=', 'Approved');
        $getPendingAssets                   = $this->db->get(); 
        return $getPendingAssets;
    }

    public function get_pending_asset_by_id($appID) {
        $this->db

    };

    public function get_approved_assets() {
        $today                              = date("m/d/Y");
        $this->db->from('bf_exchanges_assets');
        $this->db->where('date', $today); 
        $this->db->where('status', 'Approved');
        $getApprovedAssets                  = $this->db->get(); 
        return $getApprovedAssets;
    }    

    public function get_pending_partner_assets(){
        $today                              = date("m/d/Y");
        $this->db->from('bf_exchanges_listing_request');
        $this->db->where('date', $today); 
        $this->db->where('status !=', 'Viewed');
        $getPendingPartnerAssets            = $this->db->get(); 
        return $getPendingPartnerAssets;
    }

    public function get_approved_partner_assets() {
        $today                              = date("m/d/Y");
        $this->db->from('bf_exchanges_assets');
        $this->db->where('date', $today); 
        $this->db->where('status', 'Approved');
        $getApprovedPartnerAssets           = $this->db->get(); 
        return $getApprovedPartnerAssets;
    }

    public function get_total_transactions() {
        $this->db->from('bf_exchanges_orders');
        // $this->db->where('month', $month); 
        // $this->db->where('day', $day); 
        // $this->db->where('year', $year); 
        $this->db->where('status', 'Closed');
        $getTotalTrans                      = $this->db->get(); 
        return $getTotalTrans;
    }

    public function get_total_amounts() {
        $this->db->select_sum('amount');
        $this->db->select_sum('fees');
        $this->db->from('bf_exchanges_orders');
        // $this->db->where('month', $month); 
        // $this->db->where('day', $day); 
        // $this->db->where('year', $year); 
        $this->db->where('status', 'Closed');
        $getTotalAmounts                    = $this->db->get(); 
        return $getTotalAmounts;
    }

    public function get_last_total_amount() {        
        $this->db->select_sum('amount');
        $this->db->select_sum('fees');
        $this->db->from('bf_exchanges_orders');
        // $this->db->where('month', $last_month); 
        // $this->db->where('year', $year); 
        $this->db->where('status', 'Closed');
        $getLastTotalAmounts                = $this->db->get(); 
        return $getLastTotalAmounts;
    }

    public function get_pending_support($department) {
        if (!empty($department)) {
            $this->db->from('bf_support_requests');
            // $this->db->where('date', $today); 
            $this->db->where('status', 'Pending');
            // $this->db->where('topic', $department);
            $getPendingSupport                  = $this->db->get(); 
        } else {
            $this->db->from('bf_support_requests');
            // $this->db->where('date', $today); 
            $this->db->where('status', 'Pending');
            $this->db->where('topic', $department);
            $getPendingSupport                  = $this->db->get();         
        }
        return $getPendingSupport;    
    }

    public function get_pending_partner_support($department) {
        if (!empty($department)) {
            $this->db->from('bf_support_requests');
            // $this->db->where('date', $today); 
            $this->db->where('status', 'Pending');
            $this->db->where('partner', 1);
            // $this->db->where('topic', $department);
            $getPendingSupport                  = $this->db->get(); 
        } else {
            $this->db->from('bf_support_requests');
            // $this->db->where('date', $today); 
            $this->db->where('status', 'Pending');
            $this->db->where('partner', 1);
            $this->db->where('topic', $department);
            $getPendingSupport                  = $this->db->get();         
        }
        return $getPendingSupport;    
    }

    public function get_complete_support($department) {
        if (!empty($department)) {
            $this->db->from('bf_support_requests');
            // $this->db->where('date', $today); 
            $this->db->where('status', 'Complete');
            // $this->db->where('topic', $department); 
            $getCompleteSupport                 = $this->db->get(); 
        } else {
            $this->db->from('bf_support_requests');
            // $this->db->where('date', $today); 
            $this->db->where('status', 'Complete');
            $this->db->where('topic', $department); 
            $getCompleteSupport                 = $this->db->get(); 
        }
        return $getCompleteSupport;
    }

    public function get_complete_partner_support($department) {
        if (!empty($department)) {
            $this->db->from('bf_support_requests');
            // $this->db->where('date', $today); 
            $this->db->where('status', 'Complete');
            $this->db->where('partner', 1);
            // $this->db->where('topic', $department); 
            $getCompletePartnerSupport          = $this->db->get(); 
        } else {
            $this->db->from('bf_support_requests');
            // $this->db->where('date', $today); 
            $this->db->where('status', 'Complete');
            $this->db->where('partner', 1);
            $this->db->where('topic', $department); 
            $getCompletePartnerSupport          = $this->db->get(); 
        }
        return $getCompletePartnerSupport;
    }

    public function get_total_trades_tracked() {
        $this->db->from('bf_users_trades'); 
        $this->db->where('order_status', 'OPENING'); 
        $getTotalTradesTracked                  = $this->db->get();
        return $getTotalTradesTracked; 
    }

    public function get_total_active_wallets() {
        $this->db->from('bf_users_wallet');
        $this->db->where('active', 'Yes');
        $getTotalActiveWallets                  = $this->db->get();
        return $getTotalActiveWallets;
    }

    public function get_pending_users() {        
        $this->db->from('bf_users');
        $this->db->where('active', 0); 
        $getPendingUsers                        = $this->db->get(); 
        return $getPendingUsers;
    }

    public function get_active_users() {
        $this->db->from('bf_users');
        $this->db->where('active', 1); 
        $getActiveUsers                         = $this->db->get(); 
        return $getActiveUsers;
    }

    public function get_pending_partners() {
        $this->db->from('bf_users');
        $this->db->where('active', 0); 
        $this->db->where('partner', 1); 
        $getPendingPartners                     = $this->db->get();
        return $getPendingPartners;
    }

    public function get_active_partners() {
        $this->db->from('bf_users');
        $this->db->where('active', 1); 
        $this->db->where('partner', 1); 
        $getActivePartners                      = $this->db->get(); 
        return $getActivePartners;
    }
}
