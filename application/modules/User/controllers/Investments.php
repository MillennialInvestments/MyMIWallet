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
class Investments extends Admin_Controller
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
        $pageType = 'Automated';
        $pageName = 'User_Budget';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function getInvestmentPerformance($userId) {
        // Fetch investment performance data from the database
        $this->db->select('investment_id, performance');
        $this->db->where('user_id', $userId);
        $query = $this->db->get('investments');
    
        return $query->result();
    }
    
    public function getInvestmentSuggestions($userId) {
        // Fetch investment suggestions from the database based on the user's profile and risk assessment
        // This is a simplified example and would need to be adapted to your specific needs
        $this->db->select('investment_id, suggestion');
        $this->db->where('user_id', $userId);
        $query = $this->db->get('investment_suggestions');
    
        return $query->result();
    }
    
    public function getEconomicData() {
        // Fetch economic data from the database
        $query = $this->db->get('economic_data');
    
        return $query->result();
    }
    
    public function getDueDiligenceData($investmentId) {
        // Fetch due diligence data for a specific investment from the database
        $this->db->select('investment_id, due_diligence_data');
        $this->db->where('investment_id', $investmentId);
        $query = $this->db->get('due_diligence');
    
        return $query->result();
    }
    public function addDueDiligenceData($investmentId, $data) {
    public function addDueDiligenceData($investmentId, $data) {
        // Prepare data for insertion
        $insertData = array(
            'investment_id' => $investmentId,
            'due_diligence_data' => $data,
        );
    
        // Insert the data into the database
        $this->db->insert('due_diligence', $insertData);
    
        // Return the ID of the inserted record
        return $this->db->insert_id();
    }
    
    public function editDueDiligenceData($investmentId, $data) {
        // Prepare data for update
        $updateData = array(
            'due_diligence_data' => $data,
        );
    
        // Update the record in the database
        $this->db->where('investment_id', $investmentId);
        $this->db->update('due_diligence', $updateData);
    
        // Return the number of affected rows
        return $this->db->affected_rows();
    }
    
    public function deleteDueDiligenceData($investmentId) {
        // Delete the record from the database
        $this->db->where('investment_id', $investmentId);
        $this->db->delete('due_diligence');
    
        // Return the number of affected rows
        return $this->db->affected_rows();
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
