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
class Support extends Front_Controller
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
        $this->load->library(array('form_validation', 'upload', 'user_agent', 'users/auth'));
        $this->load->model('user_model');
        $this->load->model(array('User/public_model', 'User/support_model'));
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

    public function index()
    {
        $pageType = 'Standard';
        $pageName = 'Customer_Support';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Member_Customer_Support_Request()
    {
        $pageType = 'Standard';
        $pageName = 'Customer_Support';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function FAQ()
    {
        $pageType = 'Standard';
        $pageName = 'Customer_Support_FAQ';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Request()
    {
        $pageType = 'Customer_Support';
        $pageName = 'Customer_Support_Request';
        
        $this->set_current_user();
        $this->output->cache(1);
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        $this->form_validation->set_rules('email', 'Subpage Name', 'trim');
        $this->form_validation->set_rules('name', 'Subpage Link', 'trim');
        $this->form_validation->set_rules('subpage_icon', 'Subpage Icon', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Support/Request');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $date								= date("n/j/Y");
            $time								= date("g:i A");
            $user_id							= $this->input->post('user_id');
            $email								= $this->input->post('email');
            $name								= $this->input->post('name');
            $details							= $this->input->post('details');
            
            if ($this->support_model->submit_request($date, $time, $user_id, $email, $name, $details)) {
                $email_message_data = array(
                    'user_id'						=> $user_id,
                    'email'							=> $email,
                    'name'							=> $name,
                    'details'						=> $details,
                );
                $alert = array(
                'from'		=> 'support@mymillennialinvestments.com',
                'to'		=> 'admin@mymillennialinvestments.com',
                'subject'	=> 'Customer Service Request | Millennial Investments',
                'message'	=> $this->load->view('Support/Emails/Requests', $email_message_data, true),
                );

                $this->emailer->send($alert);

                // user creation ok
                Template::set_message('Customer Support - Support Request Submitted Successfully', 'success');
                redirect('/Customer-Support');
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your service request. Please try again.';
                
                // send error to the view
                $this->load->view('Support/Request', $data);
                Template::set_message('Submission Unsuccessful', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Response()
    {
        $pageType = 'Customer_Support';
        $pageName = 'Customer_Support_Response';
        
        $this->set_current_user();
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        $this->form_validation->set_rules('email', 'Subpage Name', 'trim');
        $this->form_validation->set_rules('name', 'Subpage Link', 'trim');
        $this->form_validation->set_rules('subpage_icon', 'Subpage Icon', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Support/Response');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $date								= date("n/j/Y");
            $time								= date("g:i A");
            $res_id								= $this->input->post('res_id');
            $user_id							= $this->input->post('user_id');
            $email								= $this->input->post('email');
            $name								= $this->input->post('name');
            $details							= $this->input->post('details');
            $response							= 1;
            
            if ($this->support_model->submit_response($date, $time, $res_id, $user_id, $email, $name, $details, $response)) {
                $email_message_data = array(
                    'date'							=> $date,
                    'time'							=> $time,
                    'res_id'						=> $res_id,
                    'user_id'						=> $user_id,
                    'email'							=> $email,
                    'name'							=> $name,
                    'details'						=> $details,
                );
                $alert = array(
                'from'		=> 'support@mymillennialinvestments.com',
                'to'		=> 'admin@mymillennialinvestments.com',
                'subject'	=> 'Customer Service Request | Millennial Investments',
                'message'	=> $this->load->view('Support/Emails/Requests', $email_message_data, true),
                );

                $this->emailer->send($alert);

                // user creation ok
                Template::set_message('Customer Support - Support Request Submitted Successfully', 'success');
                redirect('Customer-Support/Response/' . $res_id);
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your service request. Please try again.';
                
                // send error to the view
                $this->load->view('Customer-Support/Response/' . $res_id, $data);
                Template::set_message('Submission Unsuccessful', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Close_Request($respID, $user_id)
    {
        // create the data object
        $data = new stdClass();
        
        // set variables from the form
        $id		 							= $respID;
        $date								= date("n/j/Y");
        $time								= date("g:i A");
        $userID								= $user_id;
        
        if ($this->support_model->close_request($id, $date, $time, $userID)) {

            // user creation ok
            Template::set_message('Request Closed Successfully', 'success');
            redirect('/Customer-Support/Requests');
        }
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
