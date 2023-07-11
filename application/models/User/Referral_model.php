<?php defined('BASEPATH') || exit('No direct script access allowed');

class Referral_model extends BF_Model
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
    
    public function apply($user_id, $referrer_code, $active, $signup_date, $user_type, $first_name, $last_name, $email, $phone, $address, $city, $state, $country, $zipcode, $paypal, $other_payment)
    {
        $user = array(
            'user_id'						=> $user_id,
            'referrer_code'					=> $referrer_code,
            'active'						=> $active,
            'signup_date'					=> $signup_date,
            'user_type'						=> $user_type,
            'first_name'					=> $first_name,
            'last_name'						=> $last_name,
            'email'							=> $email,
            'phone'							=> $phone,
            'address'						=> $address,
            'city'							=> $city,
            'state'							=> $state,
            'country'						=> $country,
            'zipcode'						=> $zipcode,
            'paypal'						=> $paypal,
            //~ 'google_pay'					=> $google_pay,
            //~ 'cash_app'						=> $cash_app,
            //~ 'venmo'							=> $venmo,
            'other_payment'					=> $other_payment,
        );
        
        return $this->db->insert('bf_users_referral_program', $user);
    }
    
    public function update_user($user_id, $signup_date, $referrer_code, $first_name, $last_name)
    {
        $user = array(
            'ref_signup_date'				=> $signup_date,
            'referrer'						=> 'Yes',
            'referrer_code'					=> $referrer_code,
            'first_name'					=> $first_name,
            'last_name'						=> $last_name,
        );
        
        $this->db->where('id', $user_id);
        return $this->db->update('bf_users', $user);
    }
    
    public function affiliate_account_setup($user_id, $referrer_code, $basic_code, $premium_code, $gold_code)
    {
        $user = array(
            'links_created'   				=> 1,
            'basic_code'					=> $basic_code,
            'premium_code'					=> $premium_code,
            'gold_code'						=> $gold_code,
        );
        
        $this->db->where('user_id', $user_id);
        return $this->db->update('bf_users_referral_program', $user);
    }
    
    public function activate_affiliate($id)
    {
        $user = array(
<<<<<<< HEAD
            'active'   				        => 1,
=======
            'active'   				=> 1,
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        );
        
        $this->db->where('id', $id);
        return $this->db->update('bf_users_referral_program', $user);
    }
<<<<<<< HEAD

    public function get_total_referrals($cuID, $cuReferrerCode) {
        $this->db->select('COUNT(*) as count, signup_date');
        $this->db->from('bf_users_referral_program');
        $this->db->where('referrer_code', $cuReferrerCode);
        $this->db->group_by('DATE(signup_date)');
        $getTotalReferrals                  = $this->db->get();
        return $getTotalReferrals;
    }

    public function get_total_active_referrals($cuID, $cuReferrerCode) {
        $this->db->select('COUNT(*) as count, signup_date');
        $this->db->from('bf_users_referral_program');
        $this->db->where('referrer_code', $cuReferrerCode);
        $this->db->where('active', 1);
        $this->db->group_by('DATE(signup_date)');
        $getTotalActiveReferrals            = $this->db->get();
        return $getTotalActiveReferrals;
    }

    public function calculate_commission($cuID, $cuReferrerCode) {
        $this->db->select('SUM(amount) as total_spending');
        // $this->db->join('bf_users_referrals', 'bf_users_transactions.user_id = bf_users_referrals.user_id');
        $this->db->where('referral_code', $cuReferrerCode);
        $this->db->where('MONTH(date)', date('m')); // Current month
        $this->db->where('YEAR(date)', date('Y')); // Current year
        $getTotalSpend                      = $this->db->get('bf_users_transactions');
        // $totalSpendCommissions              = $getTotalSpend->row();
        $commissionsData                    = array(
            'getTotalSpend'                 => $getTotalSpend,
            // 'totalSpendCommissions'         => $totalSpendCommissions,
            // 'totalCommissionsPayment'       => $totalSpendCommissions->total_spending * 0.25,
        );
        return $commissionsData;
    }
=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
}
