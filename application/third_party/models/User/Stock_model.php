<?php defined('BASEPATH') || exit('No direct script access allowed');

class Stock_model extends BF_Model
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
    
    public function get_trade_alert($symbol)
    {
        // Stock Alert Information
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('stock', $symbol);
        $this->db->where('status', 'Opened');
        $this->db->limit(1);
        $getStockInfo = $this->db->get();
        return $getStockInfo;
    }
    
    public function add_stock($symbol, $market, $company, $url_link)
    {
        $user = array(
            'symbol'					=> $symbol,
            'market'					=> $market,
            'company'					=> $company,
            'url_link'					=> $url_link,
        );
        
        return $this->db->insert('bf_investment_stock_listing', $user);
    }
    
    public function edit_dashboard($id, $dashboard, $dashboard_link)
    {
        $user = array(
            'dashboard'					=> $dashboard,
            'dashboard_link'			=> $dashboard_link,
        );
        
        $this->db->where('id', $id);
        return $this->db->update('bf_dashboards', $user);
    }
    
    public function delete_dashboard($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('bf_dashboards');
    }
    
    /*
     * Dashboard Navbar Add/Edit/Delete
     * function to add/delete/update bf_dashboard_navbar
    */
    public function add_dashboard_navbar($url_link, $subpage_type, $subpage_name, $subpage_link, $subpage_icon, $display_in_navbar)
    {
        $user = array(
            'url_link'					=> $url_link,
            'subpage_type'				=> $subpage_type,
            'subpage_name'				=> $subpage_name,
            'subpage_link'				=> $subpage_link,
            'subpage_icon'				=> $subpage_icon,
            'display_in_navbar'			=> $display_in_navbar,
        );
        
        return $this->db->insert('bf_dashboard_navbar', $user);
    }
    
    public function edit_dashboard_navbar($id, $url_link, $subpage_type, $subpage_name, $subpage_link, $subpage_icon, $display_in_navbar)
    {
        $user = array(
            'url_link'					=> $url_link,
            'subpage_type'				=> $subpage_type,
            'subpage_name'				=> $subpage_name,
            'subpage_link'				=> $subpage_link,
            'subpage_icon'				=> $subpage_icon,
            'display_in_navbar'			=> $display_in_navbar,
        );
        
        $this->db->where('id', $id);
        return $this->db->update('bf_dashboard_navbar', $user);
    }
    
    public function delete_navbar($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('bf_dashboard_navbar');
    }
    
    /*
     * Dashboard Indash Navbar Add/Edit/Delete
     * function to add/delete/update bf_dashboard_navbar_indash
    */
    public function add_indash_navbar($navbar, $url_link, $subpage_name, $subpage_link, $subpage_content, $subpage_status, $subpage_icon)
    {
        $user = array(
            'navbar'					=> $navbar,
            'url_link'					=> $url_link,
            'subpage_name'				=> $subpage_name,
            'subpage_link'				=> $subpage_link,
            'subpage_content'			=> $subpage_content,
            'subpage_status'			=> $subpage_status,
            'subpage_icon'				=> $subpage_icon,
        );
        
        return $this->db->insert('bf_dashboard_navbar_indash', $user);
    }
    
    public function edit_indash_navbar($id, $navbar, $url_link, $subpage_name, $subpage_link, $subpage_content, $subpage_status, $subpage_icon)
    {
        $user = array(
            'navbar'					=> $navbar,
            'url_link'					=> $url_link,
            'subpage_name'				=> $subpage_name,
            'subpage_link'				=> $subpage_link,
            'subpage_content'			=> $subpage_content,
            'subpage_status'			=> $subpage_status,
            'subpage_icon'				=> $subpage_icon,
        );
        
        $this->db->where('id', $id);
        return $this->db->update('bf_dashboard_navbar_indash', $user);
    }
    
    public function delete_indash_navbar($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('bf_dashboard_navbar_indash');
    }
    
    /*
     * Dashboard Operational Tasks & Subtasks Add/Edit/Delete
     * function to add/delete/update bf_dashboard_construction_to_do_list
    */
    public function add_construction_tasks($assigner_id, $user_id, $type, $dashboard, $tasks, $details, $completed)
    {
        $user = array(
            'assigner_id'				=> $assigner_id,
            'user_id'					=> $user_id,
            'type'						=> $type,
            'dashboard'					=> $dashboard,
            'tasks'						=> $tasks,
            'details'					=> $details,
            'completed'					=> $completed,
        );
        
        return $this->db->insert('bf_dashboard_construction_to_do_list', $user);
    }
    
    public function add_construction_subtasks($assigner_id, $user_id, $tasks_id, $type, $dashboard, $subtasks, $details, $completed)
    {
        $user = array(
            'assigner_id'				=> $assigner_id,
            'user_id'					=> $user_id,
            'tasks_id'					=> $tasks_id,
            'type'						=> $type,
            'dashboard'					=> $dashboard,
            'subtasks'					=> $subtasks,
            'details'					=> $details,
            'completed'					=> $completed,
        );
        
        return $this->db->insert('bf_dashboard_construction_to_do_list', $user);
    }
    
    public function complete_construction_tasks($id, $completed)
    {
        $user = array(
            'completed'					=> $completed,
        );
        $this->db->where('id', $id);
        return $this->db->update('bf_dashboard_construction_to_do_list', $user);
    }
    
    public function not_complete_construction_tasks($id, $completed)
    {
        $user = array(
            'completed'					=> $completed,
        );
        $this->db->where('id', $id);
        return $this->db->update('bf_dashboard_construction_to_do_list', $user);
    }
      
    public function update_construction_tasks($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('bf_dashboard_construction_to_do_list', $data);
    }
    
    public function delete_construction_tasks($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('bf_dashboard_construction_to_do_list');
    }
    
    /*
     * Dashboard Upgrade Add/Edit/Delete
     * function to add/delete/update bf_asset_management
     */
    public function add_dashboard_upgrade($page, $page_b, $page_c, $page_d, $page_e, $page_f, $page_g, $page_h, $title, $description)
    {
        $user = array(
            'page'						=> $page,
            'page_b'					=> $page_b,
            'page_c'					=> $page_c,
            'page_d'					=> $page_d,
            'page_e'					=> $page_e,
            'page_f'					=> $page_f,
            'page_g'					=> $page_g,
            'page_h'					=> $page_h,
            'title'						=> $title,
            'description'				=> $description,
        );
        
                
        return $this->db->insert('bf_dashboard_upgrade', $user);
    }
    
    public function edit_dashboard_upgrade($id, $page, $page_b, $page_c, $page_d, $page_e, $page_f, $page_g, $page_h, $title, $description)
    {
        $user = array(
            'page'						=> $page,
            'page_b'					=> $page_b,
            'page_c'					=> $page_c,
            'page_d'					=> $page_d,
            'page_e'					=> $page_e,
            'page_f'					=> $page_f,
            'page_g'					=> $page_g,
            'page_h'					=> $page_h,
            'title'						=> $title,
            'description'				=> $description,
        );
        
        $this->db->where('id', $id);
        return $this->db->update('bf_dashboard_upgrade', $user);
    }
    
    public function delete_upgrade($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('bf_dashboard_upgrades');
    }
        
    /*
     * function to add/delete/update bf_asset_management
     */
    public function inventory_update($date, $location, $cable_boxes, $keystones, $keystone_blanks, $single_faceplates, $quad_faceplates, $blank_faceplates, $low_voltage_boxes, $raceways, $sm_boxes, $twenty_four_patch_panels, $forty_eight_patch_panels, $five_patch_cables, $seven_patch_cables, $ten_patch_cables, $forthteen_patch_cables, $fire_caulk, $four_ladders, $seven_ladders, $fishing_rods, $fish_tape, $power_drills, $carts, $additional_carts)
    {
        $user = array(
            'date'												=> $date,
            'location'											=> $location,
            'cable_boxes'										=> $cable_boxes,
            'keystones'											=> $keystones,
            'keystone_blanks'									=> $keystone_blanks,
            'single_faceplates'									=> $single_faceplates,
            'quad_faceplates'									=> $quad_faceplates,
            'blank_faceplates'									=> $blank_faceplates,
            'low_voltage_boxes'									=> $low_voltage_boxes,
            'raceways'											=> $raceways,
            'sm_boxes'											=> $sm_boxes,
            'twenty_four_patch_panels'							=> $twenty_four_patch_panels,
            'forty_eight_patch_panels'							=> $forty_eight_patch_panels,
            'five_patch_cables'									=> $five_patch_cables,
            'seven_patch_cables'								=> $seven_patch_cables,
            'ten_patch_cables'									=> $ten_patch_cables,
            'forthteen_patch_cables'							=> $forthteen_patch_cables,
            'fire_caulk'										=> $fire_caulk,
            'four_ladders'										=> $four_ladders,
            'seven_ladders'										=> $seven_ladders,
            'fishing_rods'										=> $fishing_rods,
            'fish_tape'											=> $fish_tape,
            'power_drills'										=> $power_drills,
            'carts'												=> $carts,
            'additional_carts'									=> $additional_carts,
        );
        
        return $this->db->insert('bf_asset_management', $user);
    }
    

    public function add_residential_tv_mount($customer_name, $customer_email, $customer_phone, $customer_address, $customer_city, $customer_state, $customer_zipcode, $additional_details, $date, $tv_size, $mount_type, $wall_type, $over_fireplace)
    {
        $user = array(
            'customer_name'				=> $customer_name,
            'customer_email'			=> $customer_email,
            'customer_phone'			=> $customer_phone,
            'customer_address'			=> $customer_address,
            'customer_city'				=> $customer_city,
            'customer_state'			=> $customer_state,
            'customer_zipcode'			=> $customer_zipcode,
            'additional_details'		=> $additional_details,
            'date'						=> $date,
            'tv_size'					=> $tv_size,
            'mount_type'				=> $mount_type,
            'wall_type'					=> $wall_type,
            'over_fireplace'			=> $over_fireplace,
        );
        
        return $this->db->insert('bf_project_scheduling', $user);
    }
    
    /*
     * Messaging Add/Edit/Delete
     * function to add/delete/update bf_asset_management
     */
    public function send_message($date_submitted, $sender, $sender_name, $receiver, $topic, $details)
    {
        $user = array(
            'date_submitted'				=> $date_submitted,
            'sender'						=> $sender,
            'sender_name'					=> $sender_name,
            'receiver'						=> $receiver,
            'topic'							=> $topic,
            'details'						=> $details,
        );
        
        return $this->db->insert('bf_messaging', $user);
    }


    public function message_reply($receiver, $date_submitted, $original, $sender, $details)
    {
        $user = array(
            'receiver'				=> $receiver,
            'date_submitted'		=> $date_submitted,
            'original'				=> $original,
            'sender'				=> $sender,
            'details'				=> $details,
        );
        
        return $this->db->insert('bf_messaging', $user);
    }
    
    public function delete_message($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('bf_dashboard_upgrades');
    }
    
    public function add_contractors($type, $company, $contact, $email, $phone, $location)
    {
        $user = array(
            'type'				=> $type,
            'company'			=> $company,
            'contact'			=> $contact,
            'email'				=> $email,
            'phone'				=> $phone,
            'location'			=> $location,
        );
        
        return $this->db->insert('bf_contractors', $user);
    }
    
    public function ask_question($topic, $details)
    {
        $user = array(
           'topic'				=> $topic,
           'details'			=> $details,
        );
        
        return $this->db->insert('bf_questions', $user);
    }
    
    public function submit_suggestion($topic, $details)
    {
        $user = array(
           'topic'				=> $topic,
           'details'			=> $details,
         );
         
        return $this->db->insert('bf_suggestions', $user);
    }
}
