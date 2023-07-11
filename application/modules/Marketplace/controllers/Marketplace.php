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
class Marketplace extends Admin_Controller
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
        $this->load->model(array('User/auction_model', 'User/bidding_model'));
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

    // Display list of all auctions
    public function index()
    {
        $pageType                   = 'Automated';
        $pageName                   = 'Home';
        
        $data['auctions']           = $this->auction_model->get_all_auctions();
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    // Display form for creating a new auction
    public function create() {
        $this->load->view('auctions/create');
    }

    // Display a single auction
    public function view($id) {
        $data['auction'] = $this->auction_model->get_auction($id);
        $data['bids'] = $this->bidding_model->get_bids_for_auction($id);
        $this->load->view('auctions/view', $data);
    }

    // Place a bid on an auction
    public function place_bid($auction_id) {
        $this->form_validation->set_rules('bid_amount', 'Bid Amount', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Invalid bid amount.');
            redirect("auctions/view/$auction_id");
        } else {
            $user_id = $this->session->userdata('user_id'); // Assuming you store user ID in session data
            $bid_amount = $this->input->post('bid_amount');
            $this->bidding_model->place_bid($auction_id, $user_id, $bid_amount);
            redirect("auctions/view/$auction_id");
        }
    }

    // View a user's own bids
    public function my_bids() {
        $user_id = $this->session->userdata('user_id'); // Assuming you store user ID in session data
        $data['bids'] = $this->bidding_model->get_bids_for_user($user_id);
        $this->load->view('bids/my_bids', $data);
    }   
    
    // Process form submission for creating a new auction
    public function store() {
        $this->form_validation->set_rules('item_id', 'Item ID', 'required');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required');
        $this->form_validation->set_rules('end_time', 'End Time', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auctions/create');
        } else {
            $this->auction_model->create_auction();
            redirect('auctions');
        }
    }

    // Display form for editing an existing auction
    public function edit($id) {
        $data['auction'] = $this->auction_model->get_auction($id);
        $this->load->view('auctions/edit', $data);
    }

    // Process form submission for editing an existing auction
    public function update($id) {
        $this->form_validation->set_rules('item_id', 'Item ID', 'required');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required');
        $this->form_validation->set_rules('end_time', 'End Time', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auctions/edit');
        } else {
            $this->auction_model->update_auction($id);
            redirect('auctions');
        }
    }

    // Delete an existing auction
    public function delete($id) {
        $this->auction_model->delete_auction($id);
        redirect('auctions');
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
