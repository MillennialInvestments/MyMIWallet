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
class Dashboard extends Admin_Controller
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
        $this->load->model(array('User/dashboard_model', 'User/exchange_model', 'User/public_model'));
    }

    // -------------------------------------------------------------------------
    // Main Blog Post Page
    // -------------------------------------------------------------------------

    public function index()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Budget()
    {
        $pageType = 'Standard';
        $pageName = 'User_Budget';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Budget_Type_Overview()
    {
        $pageType = 'Standard';
        $pageName = 'User_Budget_Type_Over';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::set_view('User/Dashboard/Budget/Income'); 
        Template::render();
    }

    public function Budget_Add_Account()
    {
        $pageType = 'Standard';
        $pageName = 'User_Budget_Income';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::set_view('User/Dashboard/Budget/Add_Account'); 
        Template::render();
    }

    public function Investor_Profile()
    {
        $pageType = 'Standard';
        $pageName = 'Investor_Profile';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Profile_Manager()
    {
        $pageType = 'Standard';
        $pageName = 'Profile_Manager';
        
        $this->set_current_user();
        
        $this->load->view('User/Dashboard/Profile_Manager');
    }

    // -------------------------------------------------------------------------
    // OLD FILES
    // -------------------------------------------------------------------------

    public function Add_Investor_Profile()
    {
        $pageType = 'Standard';
        $pageName = 'Add_Investor_Profile';
        
        $this->set_current_user();
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        $this->form_validation->set_rules('subpage_name', 'Subpage Name', 'trim');
        $this->form_validation->set_rules('subpage_link', 'Subpage Link', 'trim');
        $this->form_validation->set_rules('subpage_icon', 'Subpage Icon', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Dashboard/Add_Investor_Profile');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $user_id		 			= $this->input->post('user_id');
            $risk_tolerance 			= $this->input->post('risk_tolerance');
            $bonds			 			= $this->input->post('bonds');
            $cryptos		 			= $this->input->post('cryptos');
            $stocks			 			= $this->input->post('stocks');
            $forex			 			= $this->input->post('forex');
            $futures			 		= $this->input->post('futures');
            $cap_micro			 		= $this->input->post('cap_micro');
            $cap_small			 		= $this->input->post('cap_small');
            $cap_mid			 		= $this->input->post('cap_mid');
            $cap_large			 		= $this->input->post('cap_large');
            $cap_mega			 		= $this->input->post('cap_mega');
            $investment_strategy		= $this->input->post('investment_strategy');
            $evaluation_analysis		= $this->input->post('evaluation_analysis');
             
            if ($this->investor_model->add_investor_profile($user_id, $risk_tolerance, $bonds, $cryptos, $stocks, $forex, $futures, $cap_micro, $cap_small, $cap_mid, $cap_large, $cap_mega, $investment_strategy, $evaluation_analysis)) {
                
                // user creation ok
                Template::set_message('Updated Successfully', 'success');
                redirect('/Profile');
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('User/Dashboard/Edit_Profile', $data);
                Template::set_message('Submission Unsuccessful', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
                                
    public function Announcements()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->load->model('Management/announcements_model');
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Edit_Profile()
    {
        $pageType = 'Standard';
        $pageName = 'Edit_Profile';
        
        $this->set_current_user();

        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');

        Template::set('meta_fields', $meta_fields);
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        $this->form_validation->set_rules('subpage_name', 'Subpage Name', 'trim');
        $this->form_validation->set_rules('subpage_link', 'Subpage Link', 'trim');
        $this->form_validation->set_rules('subpage_icon', 'Subpage Icon', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Dashboard/Edit_Profile');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $id								= $this->input->post('id');
            $email							= $this->input->post('email');
            $display_name					= $this->input->post('display_name');
            $username						= $this->input->post('username');
            $phone							= $this->input->post('phone');
            $address						= $this->input->post('address');
            $city							= $this->input->post('city');
            $state							= $this->input->post('state');
            $country						= $this->input->post('country');
            $zipcode						= $this->input->post('zipcode');
            
            if ($this->investor_model->edit_profile($id, $email, $display_name, $username, $phone, $address, $city, $state, $country, $zipcode)) {
                // user creation ok
                Template::set_message('Updated Successfully', 'success');
                redirect('/Profile' . $id);
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('User/Dashboard/Edit_Profile', $data);
                Template::set_message('Submission Unsuccessful', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }

    public function Edit_Investor_Profile()
    {
        $pageType = 'Standard';
        $pageName = 'Edit_Investor_Profile';
        
        $this->set_current_user();
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        $this->form_validation->set_rules('subpage_name', 'Subpage Name', 'trim');
        $this->form_validation->set_rules('subpage_link', 'Subpage Link', 'trim');
        $this->form_validation->set_rules('subpage_icon', 'Subpage Icon', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Dashboard/Edit_Investor_Profile');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $email		 				= $this->input->post('email');
            $risk_tolerance 			= $this->input->post('risk_tolerance');
            $investment_strategy		= $this->input->post('investment_strategy');
            $evaluation_analysis		= $this->input->post('evaluation_analysis');
            $bonds			 			= $this->input->post('bonds');
            $stocks			 			= $this->input->post('stocks');
            $forex			 			= $this->input->post('forex');
            $futures			 		= $this->input->post('futures');
            $cryptos		 			= $this->input->post('cryptos');
            $cap_micro			 		= $this->input->post('cap_micro');
            $cap_small			 		= $this->input->post('cap_small');
            $cap_mid			 		= $this->input->post('cap_mid');
            $cap_large			 		= $this->input->post('cap_large');
            $cap_mega			 		= $this->input->post('cap_mega');
            
            if ($this->investor_model->edit_investor_profile($email, $risk_tolerance, $investment_strategy, $evaluation_analysis, $bonds, $stocks, $forex, $futures, $cryptos, $cap_micro, $cap_small, $cap_mid, $cap_large, $cap_mega)) {
                // user creation ok
                Template::set_message('Updated Successfully', 'success');
                redirect('Profile-Settings/Investor-Profile');
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('User/Dashboard/Edit_Investor_Profile', $data);
                Template::set_message('Submission Unsuccessful', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Edit_Social_Media()
    {
        $pageType = 'Standard';
        $pageName = 'Edit_Social_Media';
        
        $this->set_current_user();
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        $this->form_validation->set_rules('subpage_name', 'Subpage Name', 'trim');
        $this->form_validation->set_rules('subpage_link', 'Subpage Link', 'trim');
        $this->form_validation->set_rules('subpage_icon', 'Subpage Icon', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Dashboard/Edit_Social_Media');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $email		 					= $this->input->post('email');
            $facebook			 			= $this->input->post('facebook');
            $twitter			 			= $this->input->post('twitter');
            $stocktwits			 			= $this->input->post('stocktwits');
            $youtube			 			= $this->input->post('youtube');
            $discord			 			= $this->input->post('discord');
            
            if ($this->investor_model->edit_social_media($email, $facebook, $twitter, $stocktwits, $youtube, $discord)) {
                // user creation ok
                Template::set_message('Updated Successfully', 'success');
                redirect('Profile-Settings/Social-Media');
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('User/Dashboard/Edit_Social_Media', $data);
                Template::set_message('Submission Unsuccessful', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
               
    public function Mymi_Coins()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
            
    public function My_Profile()
    {
        $pageType = 'Standard';
        $pageName = 'User_Profile';
        
        $this->set_current_user();

        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');

        Template::set('meta_fields', $meta_fields);
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
  
    public function Profile_Image_Upload()
    {
        $config['upload_path'] 		= './assets/images/Users/Profile_Pictures/';
        $config['allowed_types']	= '*';
        $config['encrypt_name']		= false;
        $config['overwrite']		= true;
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if ($this->upload->do_upload("userfile")) {
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            $email	= $this->input->post('email');

            
            if ($this->trader_model->save_user_profile_picture($email, $filename)) {
                Template::set_message('Profile Pictured Updated Successfully', 'success');
                redirect('/Profile-Settings/Images');
            } else {
                $this->load->view('User/Dashboard/Profile_Image_Upload');
                Template::set_message('File Information Could Not Uploaded To Database', 'error');
                Template::render();
            }
        } else {
            $this->load->view('User/Dashboard/Profile_Image_Upload');
            Template::set_message('File Information Could Not Uploaded To Directory', 'error');
            // Template::set('pageType', $pageType);
            // Template::set('pageName', $pageName);
            Template::render();
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

    public function Purchase_Coins()
    {
        $pageType = 'Standard';
        $pageName = 'Purchase_Coins';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Request_Coins()
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Request_Coins';
        
        $this->set_current_user();
        $coin									= 'MYMIG';
        $gas_fee								= $this->config->item('gas_fee');
        $trans_fee								= $this->config->item('trans_fee');
        $trans_percent							= $this->config->item('trans_percent');
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
            $status									= 'Incomplete';
            $beta									= $this->input->post('beta');
            $user_id								= $this->input->post('user_id');
            $user_email								= $this->input->post('user_email');
            $wallet_id								= $this->input->post('wallet_id');
            $initial_value							= $this->input->post('initial_value');
            $available_coins						= $this->input->post('available_coins');
            $initial_coin_value						= $this->input->post('initial_coin_value');
            $amount									= $this->input->post('amount');
            $total									= $this->input->post('total');
            $gas_fee								= $gas_fee;
            $trans_fee								= $trans_fee;
            $trans_percent							= $trans_percent;
            $subtotal								= $amount / $initial_coin_value;
            $expenses								= ($amount * $trans_percent) + $trans_fee;
            $total_cost								= $amount + $expenses;
            $total_coins							= $subtotal - $gas_fee;
            $total_fees								= $expenses;
            $user_gas_fee							= $amount * $gas_fee;
            $user_trans_fee							= $trans_fee;
            $user_trans_percent						= $amount * $trans_percent;
            $current_value							= $initial_value + $amount;
            $new_availability						= $available_coins - $total;
            $new_coin_value							= round($current_value / $new_availability, 8);
            
            if ($this->mymigold_model->add_user_request($beta, $user_id, $user_email, $coin, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $new_coin_value, $amount, $total, $total_cost, $total_fees, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent)) {
                $getPurchaseID					= $this->mymigold_model->get_last_purchase_id();
                foreach ($getPurchaseID->result_array() as $purchase) {
                    $purchase_id				= $purchase['id'];
                }
                if ($this->mymigold_model->adjust_value($status, $purchase_id, $beta, $user_id, $user_email, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $new_coin_value, $amount, $total, $total_cost, $total_fees, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent)) {
                    // user creation ok
                    redirect('MyMI-Gold/Complete-Purchase/' . $purchase_id);
                } else {
                    
                    // send error to the view
                    Template::set_message('New Coin Value Not Updated', 'error');
                    Template::set('pageType', $pageType);
                    Template::set('pageName', $pageName);
                    Template::render();
                    redirect('Dashboard');
                }
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                Template::set_message('Request Not Submitted', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
                redirect('Dashboard');
            }
        }
    }
    
    public function Complete($trans_id)
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Complete';
        
        $this->set_current_user();
        if ($this->mymigold_model->complete_purchase($trans_id)) {
            if ($this->mymigold_model->complete_overview($trans_id)) {
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
           
    public function Markets()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Search()
    {
        $pageType = 'Standard';
        $pageName = 'Search';
        
        $this->set_current_user();
        //~ $this->output->cache(1440);
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Dashboard/Search');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $symbol					= $this->input->post('stock');
            $getSymInfo 			= $this->investor_model->get_symbol_info($symbol);
            foreach ($getSymInfo->result_array() as $symbol) {
                $url_link = $symbol['url_link'];
                redirect($symbol['type'] . '/' . $url_link);
            }
        }
    }
           
    public function Trade_Alerts()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Trade_Alerts_Log()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
        
    public function User_Profile()
    {
        $pageType = 'Standard';
        $pageName = 'User_Profile';
        
        $this->set_current_user();

        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');

        Template::set('meta_fields', $meta_fields);
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
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
