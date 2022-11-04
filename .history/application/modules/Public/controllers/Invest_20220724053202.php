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
class Invest extends Front_Controller
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
        $this->load->library(array('form_validation', 'upload', 'user_agent'));
        $this->load->model('User/investment_model');
        $this->load->module('users');

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
        $pageName = 'Investment_Request';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Request()
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Request';
        
        $this->set_current_user();
        // create the data object
        $data = new stdClass();
        $getCoinValue = $this->investment_model->get_coin_value();
        foreach ($getCoinValue->result_array() as $coinValue) {
            $minimum_amount = $coinValue['minimum_purchase'] / $coinValue['coin_value'];
        }
        // set validation rules
        $this->form_validation->set_rules('amount', 'Amount', 'greater_than_equal_to[5]');
        
        if ($this->form_validation->run() === false) {
            // ALERT: Amount smaller than minimum requirement
            Template::set_message('Amount Must Be Larger Than ' . $minimum_amount, 'error');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
            redirect('/Invest');
        } else {
            // set variables from the form
            $score = get_recapture_score($_POST['g-recaptcha-response']);
             
                 if($score < RECAPTCHA_ACCEPTABLE_SPAM_SCORE){
                     // return an error of your choosing
            *    }
            $trade_type								= 'Buy';
            $unix_timestamp							= time();
            $month									= date("n");
            $day									= date("j");
            $year									= date("Y");
            $time									= date("h:i:s A");
            $beta									= $this->input->post('beta');
            $cuID									= $this->input->post('cuID');
            $cuEmail								= $this->input->post('cuEmail');
            $trading_account						= $this->input->post('trading_account');
            $wallet_id								= $this->input->post('wallet_id');
            $market_pair							= 'USD';
            $market									= 'MYMI';
            $initial_value							= $this->input->post('initial_value');
            $available_coins						= $this->input->post('available_coins');
            $amount									= $this->input->post('amount');
            $total									= round($this->input->post('total'), 2);
            $coin_value								= $this->input->post('coin_value');
            $minimum_purchase						= $this->input->post('minimum_purchase');
            $total_cost								= $this->input->post('total_cost');
            $gas_fee								= $this->config->item('gas_fee');
            $trans_fee								= $this->config->item('trans_fee');
            $trans_percent							= $this->config->item('trans_percent');
            $user_gas_fee							= $total * $gas_fee;
            $user_trans_fee							= $trans_fee;
            $user_trans_percent						= $amount * $trans_percent;
            $current_value							= $initial_value + $amount;
            $total_fees								= $user_trans_fee + $user_trans_percent;
            $new_availability						= round($available_coins - $total, 2);
            $new_coin_value							= round($current_value / $new_availability, 8);
            $minimum_coin_amount					= $minimum_purchase / $new_coin_value;
            $referral_id							= $this->input->post('referral_id');
            
            if ($this->investment_model->add_request($unix_timestamp, $month, $day, $year, $time, $beta, $market, $cuID, $cuEmail, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $coin_value, $new_coin_value, $amount, $total, $total_cost, $total_fees, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent, $referral_id)) {
                $getPurchaseID					= $this->investment_model->get_last_purchase_id();
                foreach ($getPurchaseID->result_array() as $purchase) {
                    $purchase_id				= $purchase['id'];
                }
                if ($this->investment_model->adjust_value($purchase_id, $unix_timestamp, $month, $day, $year, $time, $beta, $cuID, $cuEmail, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $coin_value, $new_coin_value, $amount, $total, $total_cost, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent)) {
                    if ($this->investment_model->add_exchange_orders($purchase_id, $trade_type, $unix_timestamp, $month, $day, $year, $time, $beta, $market_pair, $market, $cuID, $cuEmail, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $coin_value, $new_coin_value, $amount, $total, $total_cost, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent, $fees, $referral_id)) {
                        // user creation ok
                        Template::set_message('Submitted Successfully', 'success');
                        redirect('/Invest/Complete-Purchase/' . $purchase_id);
                    } else {
                    
                        // send error to the view
                        Template::set_message('New Coin Value Not Updated', 'error');
                        Template::set('pageType', $pageType);
                        Template::set('pageName', $pageName);
                        Template::redirect('Invest');
                    }
                } else {
                    
                    // send error to the view
                    Template::set_message('New Coin Value Not Updated', 'error');
                    Template::set('pageType', $pageType);
                    Template::set('pageName', $pageName);
                    Template::redirect('Invest');
                }
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                Template::set_message('Request Not Submitted', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::redirect('Invest');
            }
        }
    }
    
    public function Purchase()
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Confirmation';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Purchase_Complete($transID)
    {
        // create the data object
        $data = new stdClass();
        
        // set variables from the form
        $id		 	= $transID;
        
        if ($this->investment_model->purchase_complete($id)) {

            // user creation ok
            Template::set_message('Purchase Completed Successfully', 'success');
            redirect('/Invest/Complete/' . $transID);
        }
    }
    
    public function Complete()
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Complete';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Activate()
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Request';
        
        $this->set_current_user();
        // create the data object
        $data = new stdClass();
        
        if ($this->form_validation->run() === false) {
            // ALERT: Amount smaller than minimum requirement
            //~ Template::set_message('Amount Must Be Larger Than ' . $minimum_amount, 'error');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        //redirect('/Public/Invest/Activate');
        } else {
            // set variables from the form
            $wallet_id								= $this->input->post('wallet_id');
            $user_id								= $this->input->post('user_id');
            $investor								= 1;
            
            if ($this->investment_model->activate_investor_account($user_id, $wallet_id, $investor)) {
                // user creation ok
                Template::set_message('Submitted Successfully', 'success');
                redirect('/My-Investments');
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                Template::set_message('Request Not Submitted', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
                //redirect('/Public/Invest/Activate');
            }
        }
    }
        
    public function Opt_In()
    {
        $pageType = 'Standard';
        $pageName = 'Accounting_Add_Investor';
        
        $this->set_current_user();
        $this->auth->restrict();
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('amount', 'Amount', 'greater_than');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Public/Invest/Opt_In');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $name									= $this->input->post('name');
            $email									= $this->input->post('email');
            $phone									= $this->input->post('phone');
            $address								= $this->input->post('address');
            $city									= $this->input->post('city');
            $state									= $this->input->post('state');
            $country								= $this->input->post('country');
            $zipcode								= $this->input->post('zipcode');
            $amount									= $this->input->post('amount');
            $total									= $this->input->post('total');
            
            if ($this->investment_model->add_request($name, $email, $phone, $address, $city, $state, $country, $zip_code, $amount, $total)) {

                // user creation ok
                Template::set_message('Submitted Successfully', 'success');
                redirect('/Accounting');
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('Public/Invest/Opt_In', $data);
                Template::set_message('Submission Unsuccessful', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
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
