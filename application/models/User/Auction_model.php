<?php defined('BASEPATH') || exit('No direct script access allowed');

class Auction_model extends BF_Model
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
    // Get all auctions
    public function get_all_auctions() {
        $query = $this->db->get('auctions');
        return $query->result_array();
    }

    // Get a single auction by ID
    public function get_auction($id) {
        $query = $this->db->get_where('auctions', array('id' => $id));
        return $query->row_array();
    }

    // Get auctions by user
    public function get_auctions_by_user($user_id) {
        $query = $this->db->get_where('auctions', array('user_id' => $user_id));
        return $query->result_array();
    }
    
    // Create a new auction
    public function create_auction() {
        $data = array(
            'item_id' => $this->input->post('item_id'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time')
        );

        return $this->db->insert('auctions', $data);
    }

    // Update an existing auction
    public function update_auction($id) {
        $data = array(
            'item_id' => $this->input->post('item_id'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time')
        );

        $this->db->where('id', $id);
        return $this->db->update('auctions', $data);
    }

    // Delete an auction
    public function delete_auction($id) {
        $this->db->where('id', $id);
        return $this->db->delete('auctions');
    }  
     
}
