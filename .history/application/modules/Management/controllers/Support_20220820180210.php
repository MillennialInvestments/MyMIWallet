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

class Support extends Admin_Controller
{
    /** @var array Site's settings to be passed to the view. */
    private $siteSettings;

    private $logViewer;

    /**
     * Setup the required libraries etc.
     *
     * @retun void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('directory', 'form', 'file', 'url'));
        $this->load->library(array('auth', 'form_validation', 'upload', 'Services/auth', 'user_agent', 'Users/auth'));
        $this->load->model('Management/announcements_model');
        $this->load->model('Management/design_model');
        $this->load->model(array('API/api_model', 'User/exchange_model', 'User/mymigold_model', 'User/tracker_model'));
        $this->load->module('Announcements');
        $this->load->module('Exchange');
        //~ $testModule		= $this->config->item['test_module'];
        //~ $this->load->module('\'' . $testModule . '\'');

        //$this->lang->load('Blog_lang');
        $this->logViewer = new \CILogViewer\CILogViewer();

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
        $pageName = 'Web_Design_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function index()
    {
        $pageType = 'Standard';
        $pageName = 'Web_Design_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Requests()
    {
        $pageType = 'Standard';
        $pageName = 'Web_Design_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Reporting()
    {
        $pageType = 'Standard';
        $pageName = 'Web_Design_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Content_Creator()
    {
        $pageType = 'Standard';
        $pageName = 'Web_Design_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Curl_Generator()
    {
        $pageType = 'Standard';
        $pageName = 'Web_Design_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Pages()
    {
        $pageType = 'Standard';
        $pageName = 'Web_Design_Pages';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Page_Template()
    {
        $pageType = 'Standard';
        $pageName = 'Page_Template';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Test_Page()
    {
        $pageType = 'Standard';
        $pageName = 'Web_Design_Test_Page';
        
        $this->set_current_user();
        $this->auth->restrict();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Test_Page_Email()
    {
        $pageType = 'Standard';
        $pageName = 'Web_Design_Test_Page_Email';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Test_Page_CB()
    {
        $pageType = 'Standard';
        $pageName = 'Web_Design_Test_Page_CB';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Sitemap_Generator()
    {
        $pageType = 'Standard';
        $pageName = 'Sitemap_Generator';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
            
    //--------------------------------------------------------------------

    public function Basic_UI()
    {
        $pageType = 'Standard';
        $pageName = 'Basic_UI';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Icons()
    {
        $pageType = 'Standard';
        $pageName = 'Icons';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Forms()
    {
        $pageType = 'Standard';
        $pageName = 'Forms';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Charts()
    {
        $pageType = 'Standard';
        $pageName = 'Charts';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Tables()
    {
        $pageType = 'Standard';
        $pageName = 'Tables';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function UI_Elements()
    {
        $pageType = 'Standard';
        $pageName = 'UI_Elements';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Email_Test()
    {
        $data = new stdClass();
        $emailLink 			= $this->input->post($emailLink);
        $userEmail 			= 'tburks2392@gmail.com';
        $displayName 		= 'Tim';
        $alert = array(
            'from'		=> 'support@mymillennialinvestments.com',
            'to'		=> $userEmail,
            'subject'	=> 'Test Email | Millennial Investments',
            'message'	=> $this->load->view($emailLink),
        );

        $this->emailer->send($alert);
        
        Template::set_message('Updated Successfully', 'success');
        Template::redirect('/Web-Design/Test-Page-Email');
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
