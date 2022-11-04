<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2014, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

/**
 * Users Controller.
 *
 * Provides front-end functions for users, including access to login and logout.
 *
 * @package Bonfire\Modules\Users\Controllers\Users
 * @author     Bonfire Dev Team
 * @link    http://cibonfire.com/docs/developer
 */
class Referral_Program extends Admin_Controller
{
    /** @var array Site's settings to be passed to the view. */
    private $siteSettings;

    /**
     * Setup the required libraries etc.
     *
     * @retun void
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('directory', 'form', 'file', 'url'));
        $this->load->library(array('form_validation', 'upload', 'Services/auth', 'user_agent', 'Users/auth'));
        $this->load->model('User/referral_model');
        $this->load->model('Management/investment_model');
        $this->load->module('ContactUs');

        //$this->lang->load('Blog_lang');
        $this->siteSettings = $this->settings_lib->find_all();
        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            add_module_js('users', 'password_strength.js');
            Assets::add_module_js('users', 'jquery.strength.js');
        }
    }

    // -------------------------------------------------------------------------
    // Main Blog Post Page
    // -------------------------------------------------------------------------

    public function index()
    {
        $pageType = 'Standard';
        $pageName = 'Admin_Dashboard';
        $this->load->library('users/auth');
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Users()
    {
        $pageType = 'Standard';
        $pageName = 'Admin_Dashboard';
        $this->load->library('users/auth');
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Marketing_Affiliate_Program_Agreement()
    {
        $pageType = 'Standard';
        $pageName = 'Marketing_Affiliate_Program_Agreement';
        $this->load->library('users/auth');
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    
    // Add/Edit/Update Dashboards
    public function Apply()
    {
        $pageType = 'Standard';
        $pageName = 'Referral_Program_Apply';
        $this->load->library('users/auth');
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function New_Affiliate_Information()
    {
        $pageType = 'Standard';
        $pageName = 'Referral_Program_Activate_Affiliate';
        $this->load->library('users/auth');
        $this->set_current_user();
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        $this->form_validation->set_rules('subpage_name', 'Subpage Name', 'trim');
        $this->form_validation->set_rules('subpage_link', 'Subpage Link', 'trim');
        $this->form_validation->set_rules('subpage_icon', 'Subpage Icon', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Referral_Program/New_Affiliate_Information');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $user_id								= $this->input->post('user_id');
            $referrer_code							= $this->input->post('referrer_code');
            $basic_code								= $this->input->post('basic_code');
            $premium_code							= $this->input->post('premium_code');
            $gold_code								= $this->input->post('gold_code');
            
            if ($this->referral_model->affiliate_account_setup($user_id, $referrer_code, $basic_code, $premium_code, $gold_code)) {
                // user creation ok
                Template::set_message('Submitted Successfully', 'success');
                redirect('/Referral-Program/Applications');
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('Referral_Program/New_Affiliate_Information', $data);
                Template::set_message('Submission Unsuccessful', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Activate_Affiliate($id)
    {
        // create the data object
        $data = new stdClass();
        $this->db->from('bf_users_referral_program');
        $this->db->where('id', $id);
        $getUserInfo	= $this->db->get();
        
        foreach ($getUserInfo->result_array() as $userInfo) {
            $first_name 	= $userInfo['first_name'];
            $last_name 		= $userInfo['last_name'];
            $email			= $userInfo['email'];
            $phone 			= $userInfo['phone'];
            $address 		= $userInfo['address'];
            $city 			= $userInfo['city'];
            $state 			= $userInfo['state'];
            $country 		= $userInfo['country'];
            $zipcode 		= $userInfo['zipcode'];
            $referrer_code 	= $userInfo['zipcode'];
            $zipcode 		= $userInfo['zipcode'];
        }
        $subject	= 'Millennial Investments - Affiliate Application Approved';
        // set variables from the form
        
        if ($this->referral_model->activate_affiliate($id)) {
            $alert = array(
            'from'		=> 'referrals@mymillennialinvestments.com',
            'to'		=> $email,
            'subject'	=> $subject,
            'message'	=> $this->load->view('Referral_Program/Emails/Affiliate_Approved', $email_message_data, true),
            );

            $this->emailer->send($alert);
            // user creation ok
            Template::set_message('Application Approved', 'success');
            redirect('/Referral-Program/Applications');
        }
    }
    
    public function New_Affiliate_Procedure()
    {
        $pageType = 'Standard';
        $pageName = 'Admin_Dashboard';
        $this->load->library('users/auth');
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    /**
     * If the Auth lib is loaded, it will set the current user, since users
     * will never be needed if the Auth library is not loaded. By not requiring
     * this to be executed and loaded for every command, we can speed up calls
     * that don't need users at all, or rely on a different type of auth, like
     * an API or cronjob.
     *
     * Copied from Base_Controller
     */
    
    private function saveData($type = 'insert', $id = 0)
    {
        if ($type != 'insert') {
            if ($id == 0) {
                $id = $navbarID;
            }
            $_POST['id'] = $id;
            
            // Security check to ensure the posted id is the current navbar's id.
            if ($_POST['id'] != $id) {
                $this->form_validation->set_message('email', 'Invalid Navbar ID');
                return false;
            }
        }
        
        $this->form_validation->set_rules($this->dashboard_model->get_validation_rules($type));
        
        // Setting the payload for Events System.
        $payload = array('id' => $id, 'data' => $this->input->post());
        
        // Events "before_navbar_validation to run before the form validation.
        Events::trigger('before_user_validation', $payload);
        
        if ($this->form_validation->run() === false) {
            return false;
        }
        
        //Compile our core user elements to save.
        $data = $this->dashboard_model->prep_data($this->input->post());
        $result = false;
        
        if ($type == 'insert') {
            $id = $this->dashboard_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->dashboard_model->update($id, $data);
        }
        
        // Add result to payload.
        $payload['result'] = $result;
        // Trigger Event after saving the user.
        Events::trigger('save_user', $payload);
        
        return $result;
    }
    
    protected function set_current_user()
    {
        if (class_exists('Auth')) {
            // Load our current logged in user for convenience
            if ($this->auth->is_logged_in()) {
                $this->current_user = clone $this->auth->user();

                $this->current_user->user_img = gravatar_link($this->current_user->email, 22, $this->current_user->email, "{$this->current_user->email} Profile");

                // if the user has a language setting then use it
                if (isset($this->current_user->language)) {
                    $this->config->set_item('language', $this->current_user->language);
                }
            } else {
                $this->current_user = null;
            }

            // Make the current user available in the views
            if (! class_exists('Template')) {
                $this->load->library('Template');
            }
            Template::set('current_user', $this->current_user);
        }
    }
    /* end ./application/controllers/home.php */
}
