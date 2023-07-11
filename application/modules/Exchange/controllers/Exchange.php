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
class Exchange extends Admin_Controller
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
        $this->load->library(array('form_validation', 'upload'));
        $this->load->model('User/exchange_model');
        //~ $this->load->model('API/api_model');
        //$this->load->module('ContactUs');

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

    public function index() {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Dashboard() {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Application_Manager() {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        $this->load->view('Exchange/Application_Manager');
    }

    public function Coin_Listing_Request() {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Coin_Listing_Asset_Information() {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Coin_Listing_Asset_Information_Modal() {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Coin_Listing_Request_Complete() {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Order_Event_Manager($market_pair, $market, $lastOrderID) {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        $this->load->view('Exchange/Order_Event_Manager');
    }

    public function Order_Buy_Manager() {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        $this->load->view('Exchange/Order_Buy_Manager');
    }

    public function Order_Sell_Manager() {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        $this->load->view('Exchange/Order_Sell_Manager');
    }

    public function Order_Event_Manager_Working($market_pair, $market, $lastOrderID) {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->load->view('Exchange/Order_Event_Manager');
    }
    
    public function Overview($market_pair, $market) {
        $pageType = 'Automated';
        $pageName = 'Home';
        $this->set_current_user();
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Update_Account_Information() {
        // Code for updating account information
    
        // Assuming you want to update the user's account information
        // Retrieve the user's ID
        $userID = $this->session->userdata('user_id');
    
        // Retrieve the updated account information from the form
        $newAccountInfo = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            // Add more fields as needed
        );
    
        // Update the user's account information in the database
        $this->db->where('id', $userID);
        $this->db->update('users', $newAccountInfo);
    
        // Redirect or display a success message to the user
        redirect('account');
    }

    public function Coin_Sell($market_pair, $market) {
        // Code for selling a coin
    
        // Assuming you want to sell a specific coin based on the market pair and market
    
        // Retrieve the user's ID
        $userID = $this->session->userdata('user_id');
    
        // Retrieve the coin's information from the database based on the market pair and market
        $coinInfo = $this->db->get_where('coins', array('market_pair' => $market_pair, 'market' => $market))->row_array();
    
        // Perform the necessary calculations and operations for selling the coin
    
        // Update the user's balance or transaction history in the database
    
        // Redirect or display a success message to the user
        redirect('portfolio');
    }

    public function Update_User_Preferences() {
        // Code for updating user preferences
    
        // Assuming you want to update the user's preferences based on the form input
    
        // Retrieve the user's ID
        $userID = $this->session->userdata('user_id');
    
        // Retrieve the updated preferences from the form
        $newPreferences = array(
            'theme' => $this->input->post('theme'),
            'notification' => $this->input->post('notification'),
            // Add more fields as needed
        );
    
        // Update the user's preferences in the database
        $this->db->where('id', $userID);
        $this->db->update('users', $newPreferences);
    
        // Redirect or display a success message to the user
        redirect('preferences');
    }
    
    public function Update_Broker_Listing_Request() {
        // Code for updating broker listing request
    
        // Assuming you want to update the broker listing request based on the form input
    
        // Retrieve the request ID from the form or URL parameter
        $requestID = $this->input->post('request_id');
    
        // Retrieve the updated request information from the form
        $updatedRequest = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            // Add more fields as needed
        );
    
        // Update the broker listing request in the database
        $this->db->where('id', $requestID);
        $this->db->update('broker_requests', $updatedRequest);
    
        // Redirect or display a success message to the user
        redirect('broker-requests');
    }

    public function get_user_info($cuID) {
        // Code for retrieving user information
    
        // Assuming you want to retrieve the user's information based on their ID
    
        // Retrieve the user's information from the database
        $userInfo = $this->db->get_where('users', array('id' => $cuID))->row_array();
    
        // Return the user's information
        return $userInfo;
    }
    
    public function User_Reward($cuID) {
        // Code for user rewards
    
        // Assuming you want to process the user's rewards based on their ID
    
        // Perform the necessary calculations and operations for processing the rewards
    
        // Update the user's balance or transaction history in the database
    
        // Redirect or display a success message to the user
        redirect('rewards');
    }
    
    public function Get_Coin_History($market_pair) {
        // Code for getting coin history
    
        // Assuming you want to retrieve the historical data for a specific coin based on the market pair
    
        // Retrieve the coin's history from an API or database
        $coinHistory = ''; // Retrieve the coin's history data
    
        // Process the coin's history and perform any necessary calculations
    
        // Return the coin's history data
        return $coinHistory;
    }
    
    public function Exchange_Controller() {
        // Code for exchange controller
    
        // Assuming you have a controller logic for handling exchange operations
    
        // Perform the necessary exchange operations, such as buying/selling coins, managing orders, etc.
    
        // Redirect or display relevant information to the user
        redirect('exchange');
    }
    
    public function Coin_Purchase($market_pair, $market) {
        // Code for purchasing a coin
    
        // Assuming you want to purchase a specific coin based on the market pair and market
    
        // Retrieve the user's ID
        $userID = $this->session->userdata('user_id');
    
        // Retrieve the coin's information from the database based on the market pair and market
        $coinInfo = $this->db->get_where('coins', array('market_pair' => $market_pair, 'market' => $market))->row_array();
    
        // Perform the necessary calculations and operations for purchasing the coin
    
        // Update the user's balance or transaction history in the database
    
        // Redirect or display a success message to the user
        redirect('portfolio');
    }    

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
