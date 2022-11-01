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
class Budget extends Admin_Controller
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
        //$this->load->module('ContactUs');
        $this->load->library('Template');
        $this->load->model(array('User/budget_model'));
    }

    // -------------------------------------------------------------------------
    // Main Blog Post Page
    // -------------------------------------------------------------------------

    public function index()
    {
        $pageType = 'Standard';
        $pageName = 'User_Budget';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Account_Overview()
    {
        $pageType = 'Standard';
        $pageName = 'User_Budget_Account_Overview';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Add()
    {
        $pageType = 'Standard';
        $pageName = 'User_Budget_Add_Account';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Edit()
    {
        $pageType = 'Standard';
        $pageName = 'User_Budget_Edit_Account';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Account_Manager()
    {
        $pageType = 'Standard';
        $pageName = 'User_Budget_Account_Manager';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::set_view('User/Budget/Account_Manager');
        Template::render();
    }

    public function Recurring_Account_Schedule()
    {
        $pageType = 'Standard';
        $pageName = 'User_Budget_Recurring_Account_Schedule';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Approve_Recurring_Schedule($accountID) {
        if ($this->budget_model->approve_recurring_account($accountID)) {
            if ($this->budget_model->approve_recurring_schedule($accountID)) {
                Template::set_message('Recurring Schedule approved.', 'success');
                Template::redirect('/Budget'); 
            } else {
                Template::set_message('Recurring Schedule could not be approved.', 'error');
                Template::redirect('/Budget/Recurring-Account/Schedule/' . $accountID);
            }
        } else {
            Template::set_message('Recurring Schedule could not be approved.', 'error');
            Template::redirect('/Budget/Edit/' . $accountID);
        }
    }
    
    public function Cancel_Account($accountID) {
        $getAccountInformation                  = $this->budget_model->get_account_information($accountID); 
        foreach ($getAccountInformation->result_array() as $accountInfo) { 
            if ($accountInfo['recurring_account_primary'] === 'Yes') {
                if ($this->budget_model->cancel_account($accountID)) {
                    Template::set_message('Recurring Account deleted.', 'success');
                    Template::redirect('/Budget'); 
                } else {
                    Template::set_message('Recurring Account could not be deleted', 'error'); 
                    Template::redirect('Budget/Edit/' . $accountID); 
                }
            } else {
                if ($this->budget_model->cancel_subaccount($accountID)) {
                    Template::set_message('Recurring Account deleted.', 'success');
                    Template::redirect('/Budget/Edit/' . $accountID); 
                } else {
                    Template::set_message('Recurring Account could not be deleted', 'error'); 
                    Template::redirect('Budget/Recurring-Account/Schedule/' . $accountID); 
                }
            }
        }
    }

    public function Delete_Account($accountID) {
        if ($this->budget_model->cancel_account($accountID)) {
            Template::set_message('Recurring Account deleted.', 'success');
            Template::redirect('/Budget'); 
        } else {
            Template::set_message('Account could not be deleted', 'error'); 
            Template::redirect('/Budget'); 
        }
    }

    public function Paid($accountID) {
        if ($this->budget_model->paid_account($accountID)) {
            Template::set_message('Account status changed to: "Paid"', 'success');
            Template::redirect('/Budget'); 
        } else {
            Template::set_message('Account could not be updated', 'error'); 
            Template::redirect('/Budget'); 
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
