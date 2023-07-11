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

class Marketing extends Admin_Controller
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
<<<<<<< HEAD
        $this->load->library(array('auth', 'form_validation', 'upload', 'Services/auth', 'Users/auth'));
=======
        $this->load->library(array('auth', 'form_validation', 'upload', 'Services/auth', 'user_agent', 'Users/auth'));
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        $this->load->model('Management/announcements_model');
        $this->load->model('Management/design_model');
        $this->load->model(array('API/api_model', 'User/exchange_model', 'User/mymigold_model', 'User/tracker_model'));
        $this->load->module('Announcements');
        $this->load->module('Exchange');
        //~ $testModule		= $this->config->item['test_module'];
        //~ $this->load->module('\'' . $testModule . '\'');

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
<<<<<<< HEAD
        $pageType = 'Automated';
        $pageName = 'Management_Marketing';
=======
        $pageType = 'Standard';
        $pageName = 'Web_Design_Dashboard';
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

<<<<<<< HEAD
    public function Campaigns()
    {
        $pageType = 'Automated';
        $pageName = 'Management_Marketing_Campaigns';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Tasks()
    {
        $pageType = 'Automated';
        $pageName = 'Management_Marketing_Tasks';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Blog_Subscribe()
    {
        $pageType = 'Automated';
        $pageName = 'Management_Marketing_Blog_Subscribe';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function seo_check() {
        $uri_string                                             = $this->uri->uri_string();

        // Check if URI already exists in the database
        $query                                                  = $this->db->get_where('bf_marketing_page_seo', array('url' => $uri_string));
        if ($query->num_rows() == 0) {
            // If not, create a new entry
            $data                                               = array(
                'url'                                           => $uri_string,
                'title'                                         => str_replace(array('_', '/'), array(' ', ' - '), $uri_string), // Update this according to your needs
                'description'                                   => '',
                'image'                                         => '',
            );
            $this->db->insert('bf_marketing_page_seo', $data);

            // Get the inserted ID for later update
            $insert_id                                          = $this->db->insert_id();
            
            // After we have created a new SEO record, we create and assign a new task
            $task_info                                          = array(
                'task'                                          => 'Page SEO Edit',
                'title'                                         => str_replace(array('_', '/'), array(' ', ' - '), $uri_string),
                'seo_id'                                        => $insert_id,
                'url'                                           => $uri_string,
            );
            $this->assign_marketing_task($task_info); // Replace $role_id with the actual role_id of the user you want to assign the task to
            
            // Fetch the page HTML to parse
            $html                                               = file_get_contents(site_url($uri_string));
            $dom                                                = new DOMDocument;
            libxml_use_internal_errors(true);
            $dom->loadHTML($html);
            libxml_clear_errors();
            $xpath                                              = new DOMXPath($dom);

            // Look for #page_seo_description and #page_seo_image
            $description_element                                = $xpath->query("//*[@id='page_seo_description']");
            $image_element                                      = $xpath->query("//*[@id='page_seo_image']");

            if ($description_element->length > 0) {
                $data['description']                            = $description_element->item(0)->nodeValue;
            }
            if ($image_element->length > 0) {
                $data['image']                                  = $image_element->item(0)->getAttribute('src');
            }

            // Update the newly created record with the found data
            $this->db->update('bf_marketing_page_seo', $data, array('id' => $insert_id));
        }
    }

    public function assign_marketing_task($task_info){
        $data = array(
            'status'                                            => 'Pending', // Assuming there's a status field for tasks
            'group'                                             => 'Marketing', // Assuming tasks are assigned based on role_id
            'task'                                              => $task_info['task'],
            'title'                                             => $task_info['title'],
            'description'                                       => 'Complete SEO for ' . $task_info['url'],
            'url'                                               => site_url('/Management/Marketing/Page-SEO/' . $task_info['seo_id']),
        );
    
        $this->db->insert('bf_management_tasks', $data);
    }

=======
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
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
