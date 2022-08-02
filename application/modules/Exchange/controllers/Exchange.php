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
        $this->load->library(array('form_validation', 'upload', 'user_agent'));
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

    public function index()
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Dashboard()
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Application_Manager()
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        $this->load->view('Exchange/Application_Manager');
    }

    public function Coin_Listing_Request()
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Coin_Listing_Asset_Information()
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Coin_Listing_Asset_Information_Modal()
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Coin_Listing_Request_Complete()
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Order_Event_Manager($market_pair, $market, $lastOrderID)
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        $this->load->view('Exchange/Order_Event_Manager');
    }
    
    public function Order_Buy_Manager()
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        $this->load->view('Exchange/Order_Buy_Manager');
    }
    
    public function Order_Sell_Manager()
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        $this->load->view('Exchange/Order_Sell_Manager');
    }

    public function Order_Event_Manager_Working($market_pair, $market, $lastOrderID)
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        $this->load->view('Exchange/Order_Event_Manager');
    }
    
    public function Overview($market_pair, $market)
    {
        $pageType = 'Standard';
        $pageName = 'Home';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Order_Fetch()
    {
        
        $this->set_current_user();
        // create the data object
        $data = new stdClass();
        // set variables from the form
        $redirectURL							= $this->input->post('redirectURL');
        $month									= $this->input->post('month');
        $day									= $this->input->post('day');
        $year									= $this->input->post('year');
        $time									= $this->input->post('time');
        $trade_type								= $this->input->post('trade_type');
        $beta									= $this->input->post('beta');
        $user_id								= $this->input->post('user_id');
        $user_email								= $this->input->post('user_email');
        $wallet_id								= $this->input->post('wallet_id');
        $market_pair							= $this->input->post('market_pair');
        $market									= $this->input->post('market');
        $initial_value							= $this->input->post('initial_value');
        $coin_value								= $this->input->post('coin_value');
        $available_coins						= $this->input->post('available_coins');
        $amount									= $this->input->post('buy_amount');
        $minimum_purchase						= $this->input->post('minimum_purchase');
        $total									= $this->input->post('buy_total');
        $gas_fee								= $this->input->post('buy_user_gas_fee');
        $fees									= $this->input->post('buy_fees');
        $trans_percent							= $this->input->post('buy_trans_percent');
        $trans_fee								= $this->input->post('buy_trans_fee');
        $total_cost								= $this->input->post('buy_total_cost');
        $current_value							= $initial_value + $amount;
        $new_availability						= $available_coins - $total;
        $new_coin_value							= $current_value / $new_availability;
    
        
        /*
         * Verify Data on the backend coming in from Fetch
         * Check for error every time submitted and append all variables to error object
         * 		Ex: Check Data, if not equal to today, append to error object, display message
         *
         */
            
        $error 									= array(
            'month'						 		=> $month,
            'day'						 		=> $day,
            'year'						 		=> $year,
            'time'						 		=> $time,
            'trade_type'				 		=> $trade_type,
            'beta'						 		=> $beta,
            'user_id'					 		=> $user_id,
            'user_email'				 		=> $user_email,
            'wallet_id'					 		=> $wallet_id,
            'market_pair'				 		=> $market_pair,
            'market'					 		=> $market,
            'initial_value'				 		=> $initial_value,
            'available_coins'			 		=> $available_coins,
            'amount'					 		=> $amount,
            'minimum_purchase'			 		=> $minimum_purchase,
            'total'						 		=> $total,
            'gas_fee'					 		=> $gas_fee,
            'fees'						 		=> $fees,
            'trans_percent'				 		=> $trans_percent,
            'trans_fee'							=> $trans_fee,
            'total_cost'						=> $total_cost,
            'current_value'						=> $current_value,
            'new_availability'					=> $new_availability,
            'initial_coin_value'		 		=> $coin_value,
            'new_coin_value'					=> $new_coin_value,
        );
        if (isset($error)) {
            $this->output->set_status_header('404');
            $heading = "404 Page Not Found";
            $message = "An Error occurred while submitting your order";
            echo $error;
            ob_flush();
            flush();
        } else {
            if (!$this->exchange_model->add_order($month, $day, $year, $time, $trade_type, $beta, $user_id, $user_email, $wallet_id, $market_pair, $market, $initial_value, $coin_value, $available_coins, $amount, $minimum_purchase, $total, $gas_fee, $fees, $trans_percent, $trans_fee, $total_cost, $current_value, $new_availability, $new_coin_value)) {
            } else {
                // user creation ok
                Template::set_message('Order Submitted Successfully', 'success');
            }
        }
    }

    public function Buy()
    {
        //~ $pageType = 'Standard';
        //~ $pageName = 'Investment_Request_Coins';
        
        $this->set_current_user();
        // create the data object
        $data = new stdClass();

        // set validation rules
        $this->form_validation->set_rules('amount', 'Amount', 'greater_than_equal_to[5]');
        
        if ($this->form_validation->run() === false) {
            // ALERT: Amount smaller than minimum requirement
            Template::set_message('Amount Must Be Larger Than ' . $minimum_amount, 'error');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
            redirect('/Dashboard');
        } else {
            // set variables from the form
            $redirectURL							= $this->input->post('redirectURL');
            $month									= $this->input->post('month');
            $day									= $this->input->post('day');
            $year									= $this->input->post('year');
            $time									= $this->input->post('time');
            $trade_type								= $this->input->post('trade_type');
            $beta									= $this->input->post('beta');
            $user_id								= $this->input->post('user_id');
            $user_email								= $this->input->post('user_email');
            $wallet_id								= $this->input->post('wallet_id');
            $market_pair							= $this->input->post('market_pair');
            $market									= $this->input->post('market');
            $initial_value							= $this->input->post('initial_value');
            $coin_value								= $this->input->post('coin_value');
            $available_coins						= $this->input->post('available_coins');
            $amount									= $this->input->post('buy_amount');
            $minimum_purchase						= $this->input->post('minimum_purchase');
            $total									= $this->input->post('buy_total');
            $gas_fee								= $this->input->post('buy_user_gas_fee');
            $fees									= $this->input->post('buy_fees');
            $trans_percent							= $this->input->post('buy_trans_percent');
            $trans_fee								= $this->input->post('buy_trans_fee');
            $total_cost								= $this->input->post('buy_total_cost');
            $current_value							= $initial_value + $amount;
            $new_availability						= $available_coins - $total;
            $new_coin_value							= $current_value / $new_availability;
            
            //~ $error 									= array(
            //~ 'month'						 		=> $month,
            //~ 'day'						 		=> $day,
            //~ 'year'						 		=> $year,
            //~ 'time'						 		=> $time,
            //~ 'trade_type'				 		=> $trade_type,
            //~ 'beta'						 		=> $beta,
            //~ 'user_id'					 		=> $user_id,
            //~ 'user_email'				 		=> $user_email,
            //~ 'wallet_id'					 		=> $wallet_id,
            //~ 'market_pair'				 		=> $market_pair,
            //~ 'market'					 		=> $market,
            //~ 'initial_value'				 		=> $initial_value,
            //~ 'available_coins'			 		=> $available_coins,
            //~ 'amount'					 		=> $amount,
            //~ 'minimum_purchase'			 		=> $minimum_purchase,
            //~ 'total'						 		=> $total,
            //~ 'gas_fee'					 		=> $gas_fee,
            //~ 'fees'						 		=> $fees,
            //~ 'trans_percent'				 		=> $trans_percent,
            //~ 'trans_fee'							=> $trans_fee,
            //~ 'total_cost'						=> $total_cost,
            //~ 'current_value'						=> $current_value,
            //~ 'new_availability'					=> $new_availability,
            //~ 'initial_coin_value'		 		=> $coin_value,
            //~ 'new_coin_value'					=> $new_coin_value,
            //~ );
            
            if ($this->exchange_model->add_order($month, $day, $year, $time, $trade_type, $beta, $user_id, $user_email, $wallet_id, $market_pair, $market, $initial_value, $coin_value, $available_coins, $amount, $minimum_purchase, $total, $gas_fee, $fees, $trans_percent, $trans_fee, $total_cost, $current_value, $new_availability, $new_coin_value)) {
                // user creation ok
                Template::set_message('Order Submitted Successfully', 'success');
                redirect($redirectURL);
            } else {
                
                // send error to the view
                Template::set_message('Order Could Not Be Submitted!', 'error');
                //~ Template::set('pageType', $pageType);
                //~ Template::set('pageName', $pageName);
                Template::render();
                redirect($redirectURL);
            }
        }
    }
        
    public function Sell()
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Request_Coins';
        
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
            redirect('/Dashboard');
        } else {
            // set variables from the form
            $redirectURL							= $this->input->post('redirectURL');
            $month									= $this->input->post('month');
            $day									= $this->input->post('day');
            $year									= $this->input->post('year');
            $time									= $this->input->post('time');
            $trade_type								= $this->input->post('trade_type');
            $beta									= $this->input->post('beta');
            $user_id								= $this->input->post('user_id');
            $user_email								= $this->input->post('user_email');
            $wallet_id								= $this->input->post('wallet_id');
            $market_pair							= $this->input->post('market_pair');
            $market									= $this->input->post('market');
            $initial_value							= $this->input->post('initial_value');
            $coin_value								= $this->input->post('coin_value');
            $available_coins						= $this->input->post('available_coins');
            $amount									= $this->input->post('sell_amount');
            $minimum_purchase						= $this->input->post('minimum_purchase');
            $total									= $this->input->post('sell_total');
            $gas_fee								= $this->input->post('sell_user_gas_fee');
            $fees									= $this->input->post('sell_fees');
            $trans_percent							= $this->input->post('sell_trans_percent');
            $trans_fee								= $this->input->post('sell_trans_fee');
            $total_cost								= $this->input->post('sell_total_cost');
            $current_value							= $initial_value + $amount;
            $new_availability						= $available_coins - $total;
            $new_coin_value							= $current_value / $new_availability;
            
            if ($this->exchange_model->add_order($month, $day, $year, $time, $trade_type, $beta, $user_id, $user_email, $wallet_id, $market_pair, $market, $initial_value, $coin_value, $available_coins, $amount, $minimum_purchase, $total, $gas_fee, $fees, $trans_percent, $trans_fee, $total_cost, $current_value, $new_availability, $new_coin_value)) {
                // user creation ok
                Template::set_message('Order Submitted Successfully', 'success');
                redirect($redirectURL);
            } else {
                
                // send error to the view
                Template::set_message('Order Could Not Be Submitted!', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
                redirect($redirectURL);
            }
        }
    }

    public function Account_Information()
    {
        $pageType = 'Standard';
        $pageName = 'Account_Information';
        
        $this->set_current_user();
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        $this->form_validation->set_rules('subpage_name', 'Subpage Name', 'trim');
        $this->form_validation->set_rules('subpage_link', 'Subpage Link', 'trim');
        $this->form_validation->set_rules('subpage_icon', 'Subpage Icon', 'trim');
        $this->load->model('roles/role_model');
        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');
        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');
        Template::set('meta_fields', $meta_fields);
        Template::set('pageType', $pageType);
        // Default Wallet Information
        $active				= 'Yes';
        $broker				= 'Default';
        $wallet_type		= 'Fiat';
        $amount				= '0.00';
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Exchange/Account_Information');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $kyc					= 'Yes';
            $user_id				= $this->input->post('user_id');
            $email					= $this->input->post('user_email');
            $username				= $this->input->post('user_username');
            $first_name				= $this->input->post('first_name');
            $middle_name			= $this->input->post('middle_name');
            $last_name				= $this->input->post('last_name');
            $name_suffix			= $this->input->post('name_suffix');
            $phone					= $this->input->post('phone');
            $address				= $this->input->post('address');
            $city					= $this->input->post('city');
            $state					= $this->input->post('state');
            $country				= $this->input->post('country');
            $zipcode				= $this->input->post('zipcode');
            $timezones				= $this->input->post('timezones');
            $language				= $this->input->post('language');
            $advertisement			= $this->input->post('advertisement');
            
            if ($this->exchange_model->add_account_information($user_id, $kyc, $first_name, $middle_name, $last_name, $name_suffix, $phone, $address, $city, $state, $country, $zipcode, $timezones, $language, $advertisement)) {
                // user creation ok
                Template::set_message('Account Information Updated Successfully', 'success');
                Template::redirect('/Exchange/KYC-Registration-Reward/' . $user_id);
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem udpating your account information. Please try again or contact us at <a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a>.';
                
                // send error to the view
                $this->load->view('Exchange/Account_Information', $data);
                Template::set_message('Submission Unsuccessful', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function KYC_Reward($cuID)
    {
        // create the data object
        $data 							= new stdClass();
        $reward							= 'Yes';
        $reward_type					= 'KYC';
        $status						= 'Complete';
        // Get User Information
        $getUserInfo					= $this->exchange_model->get_user_info($cuID);
        foreach ($getUserInfo->result_array() as $userInfo) {
            $user_type					= $userInfo['type'];
            if ($user_type === 'Beta') {
                $cuBeta					= 'Yes';
            } else {
                $cuBeta					= 'No';
            }
            $cuEmail					= $userInfo['email'];
            $cuWalletID					= $userInfo['wallet_id'];
        }
        // Get Coin Values
        $getCoinValue					= $this->exchange_model->get_coin_value();
        foreach ($getCoinValue->result_array() as $coinValue) {
            $initial_value				= $coinValue['current_value'];
            $available_coins			= $coinValue['new_availability'];
            $total						= 10000;
            $new_availability			= $available_coins - $total;
            $current_value				= $initial_value;
            $initial_coin_value			= $coinValue['coin_value'];
            $coin_value					= round($current_value / $new_availability, 8);
            $amount						= 0;
            $total_cost					= 0;
            $gas_fee					= 0;
            $trans_fee					= 0;
            $trans_percent				= 0;
        }
         
        if ($this->exchange_model->kyc_reward($status, $cuBeta, $cuID, $cuEmail, $cuWalletID, $reward, $reward_type, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $coin_value, $amount, $total, $total_cost, $gas_fee, $trans_fee, $trans_percent)) {
            if ($this->exchange_model->add_reward($status, $cuBeta, $cuID, $cuEmail, $cuWalletID, $reward, $reward_type, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $coin_value, $amount, $total, $total_cost, $gas_fee, $trans_fee, $trans_percent)) {
                // user creation ok
                //~ Template::set_message('Account Information Submitted Successfully', 'success');
                Template::set('KYC_Reward', 'Yes');
                redirect('/Exchange');
            } else {
                Template::set_message('Coin Purchases Not Updated', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::redirect('/Exchange');
            }
        } else {
            Template::set_message('Reward Not Submitted', 'error');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::redirect('/Exchange');
        }
    }
    
    public function Update_Order()
    {
        // POST values
        $id = $this->input->post('id');
        $field = $this->input->post('field');
        $value = $this->input->post('value');

        // Update records
        $this->exchange_model->update_orders($id, $field, $value);

        echo 1;
        exit;
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
