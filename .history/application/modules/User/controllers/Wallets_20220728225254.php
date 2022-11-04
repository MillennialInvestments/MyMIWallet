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
class Wallets extends Admin_Controller
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
        $this->load->library('Template');
        $this->load->model('User/investment_model', 'User/wallet_model');
        $this->load->module('Exchange');

        //$this->lang->load('Blog_lang');
    }

    // -------------------------------------------------------------------------
    // Main Blog Post Page
    // -------------------------------------------------------------------------

    public function index()
    {
        $pageType = 'Standard';
        $pageName = 'Wallets';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function MyMI_Wallet()
    {
        $pageType = 'Standard';
        $pageName = 'MyMI_Wallet';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Add()
    {
        $pageType                           = 'Standard';
        $pageURIA                           = $this->uri->segment(1);
        $pageURIB                           = $this->uri->segment(2);
        if ($pageURIA === 'Free') {
            if ($pageURIB === 'Fiat') {
                $pageName                   = 'Add_Wallet_Free_Fiat';
            } else {
                $pageName                   = 'Add_Wallet_Free_Digital';
            }
        } elseif ($pageURIA === 'Premium') {
            if ($pageURIB === 'Fiat') {
                $pageName                   = 'Add_Wallet_Premium_Fiat';
            } else {
                $pageName                   = 'Add_Wallet_Free_Digital';
            }
        }
        $pageName                           = 'Add_Wallet';
        
        $this->set_current_user();
        //~ $this->output->cache(1440);
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Wallets/Add');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $beta							= $this->input->post('beta');
            $user_id						= $this->input->post('user_id');
            $username						= $this->input->post('username');
            $user_email						= $this->input->post('user_email');
            $broker							= $this->input->post('broker');
            $type							= $this->input->post('type');
            $amount							= $this->input->post('amount');
            $nickname						= $this->input->post('nickname');
            
            if ($this->wallet_model->add_wallet($beta, $user_id, $username, $user_email, $broker, $type, $amount, $nickname)) {
                Template::set_message('Wallet Added Successfully', 'success');
                redirect('Wallets');
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('Wallets/Add', $data);
                Template::set_message('Form Information Not Entered Correctly', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }



    public function Generate_Wallet()
    {
        $pageType = 'Standard';
        $pageName = 'Generate_Wallet';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Wallet_Generator()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Wallets/Wallet_Generator');
    }

    public function Wallet_Manager()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Wallets/Wallet_Manager');
    }

    public function Wallet_Selection()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Wallets/Wallet_Selection');
    }

    public function Link_Account($pageLink)
    {
        $pageType = 'Standard';
        
        $this->set_current_user();
        if ($this->uri->segment(2)) {
            $wallet_id  = $this->uri->segment(2); 
        }
        if ($pageLink === 'Brokerage') {
            $pageName = 'Dashboard';
        } elseif ($pageLink === 'Approve') {
            if ($this->wallet_model->approve_wallet($wallet_id)) {
                Template::redirect('Wallets/Link-Account/Successful/' . $wallet_id);
            }
        } elseif ($pageLink === 'Delete') {
            if ($this->wallet_model->delete_wallet($wallet_id)) {
                Template::redirect('Wallets');
            }
        } elseif ($pageLink === 'Edit') {
            if ($this->wallet_model->delete_wallet($wallet_id)) {
                Template::redirect('Wallets/Link-Account/Edit/' . $wallet_id);
            }
        } elseif ($pageLink ==='Upload-Trades') {
            if ($this->input->post('upload') != null) {
                $data = array();
                if (!empty($_FILES['file']['name'])) {
                    // Set Preference
                    $config['upload_path']          = 'assets/files/'; // CHANGE THIS PATH
                    $config['allowed_types']        = 'csv';
                    $config['max_size']             = '1000';
                    $config['file_name']            = $_FILES['file']['name'];

                    // Load Upload Library
                    $this->load->library('upload', $config);

                    // File Upload
                    if ($this->upload->do_upload('file')) {
                        // Get Data About The File
                    }
                }
            }
        }
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Link_Account_Success($id)
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Purchase()
    {
        $pageType = 'Standard';
        $pageName = 'Purchase_Wallet';
        
        $this->set_current_user();
        //~ $this->output->cache(1440);
        
        // create the data object
        $gas_fee								= $this->config->item('gas_fee');
        $trans_fee								= $this->config->item('trans_fee');
        $trans_percent							= $this->config->item('trans_percent');
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Wallets/Purchase');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $status									= 'Complete';
            $beta									= $this->input->post('beta');
            $coin									= 'MYMIG';
            $user_id								= $this->input->post('user_id');
            $user_email								= $this->input->post('user_email');
            $wallet_id								= $this->input->post('wallet_id');
            $wallet_type							= $this->input->post('wallet_type');
            $purchase_type							= 'Premium Wallet';
            $feature_cost							= $this->input->post('feature_cost');
            $initial_value							= $this->input->post('initial_value');
            $available_coins						= $this->input->post('available_coins');
            $initial_coin_value						= $this->input->post('coin_value');
            $orig_total								= '-' . $feature_cost / $initial_coin_value;
            $amount									= round(-$orig_total * $initial_coin_value, 2);
            $gas_fee								= $gas_fee;
            $trans_fee								= $trans_fee;
            $trans_percent							= $trans_percent;
            $subtotal								= $amount / $initial_coin_value;
            $expenses								= ($amount * $trans_percent) + $trans_fee;
            $total_cost								= number_format($amount + $expenses, 2);
            $total_fees								= number_format($expenses, 2);
            $user_gas_fee							= number_format($amount * $gas_fee, 2);
            $user_trans_fee							= $trans_fee;
            $user_trans_percent						= number_format($amount * $trans_percent, 2);
            $current_value							= $initial_value + $total_cost;
            $new_availability						= $available_coins + $orig_total - $gas_fee;
            $new_coin_value							= round($current_value / $new_availability, 8);
            $initial_balance						= $this->input->post('initial_balance');
            $remaining_balance						= $initial_balance + $orig_total;
            $fee_coins								= $expenses / $initial_coin_value;
            $total									= $orig_total - $fee_coins;
            if ($wallet_type === 'Fiat') {
                $redirectURL						= 'Add-Fiat-Wallet';
                $purchase_type						= 'Premium Fiat Wallet';
            } elseif ($wallet_type === 'Digital') {
                $redirectURL						= 'Add-Digital-Wallet';
                $purchase_type						= 'Premium Crypto Wallet';
            }
            if ($this->mymigold_model->add_user_feature_request($status, $beta, $user_id, $user_email, $coin, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $new_coin_value, $amount, $total, $total_cost, $total_fees, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent)) {
                $getPurchaseID					= $this->mymigold_model->get_last_purchase_id();
                foreach ($getPurchaseID->result_array() as $purchase) {
                    $purchase_id				= $purchase['id'];
                }
                if ($this->mymigold_model->purchase_feature($purchase_id, $status, $beta, $user_id, $user_email, $wallet_id, $feature_cost, $purchase_type, $initial_balance, $amount, $total, $remaining_balance)) {
                    if ($this->mymigold_model->adjust_value($status, $purchase_id, $beta, $user_id, $user_email, $wallet_id, $initial_value, $current_value, $available_coins, $new_availability, $initial_coin_value, $new_coin_value, $amount, $total, $total_cost, $total_fees, $gas_fee, $trans_fee, $trans_percent, $user_gas_fee, $user_trans_fee, $user_trans_percent)) {
                        Template::set_message('Premium Wallet Purchased Successfully', 'success');
                        redirect($redirectURL);
                    } else {
                        Template::set_message('Coin Overview not updated', 'error');
                        Template::set('pageType', $pageType);
                        Template::set('pageName', $pageName);
                        Template::render();
                    }
                } else {
                    Template::set_message('Transaction not submitted', 'error');
                    Template::set('pageType', $pageType);
                    Template::set('pageName', $pageName);
                    Template::render();
                }
            } else {
                Template::set_message('Form Information Not Entered Correctly', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
               
    public function Purchase_MyMI_Gold()
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Confirmation';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }    

    public function Complete_Purchase()
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Confirmation';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Purchase_Complete($trans_id)
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
    
    public function Feature_Manager()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Wallets/Feature_Manager');
    }

    public function Purchase_Manager()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('Exchange/Purchase_Manager');
    }

    public function Purchase_Coins_Transaction()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Wallets/Purchase_Coins_Transaction');
    }

    public function Add_Fiat_Wallet()
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Confirmation';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Add_Digital_Wallet()
    {
        $pageType = 'Standard';
        $pageName = 'Investment_Confirmation';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Edit()
    {
        $pageType = 'Standard';
        $pageName = 'Edit_Wallet';
        
        $this->set_current_user();
        //~ $this->output->cache(1440);
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Wallets/Edit');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $wallet_id						= $this->input->post('id');
            $user_id						= $this->input->post('user_id');
            $user_email						= $this->input->post('user_email');
            $broker							= $this->input->post('broker');
            $type							= $this->input->post('type');
            $amount							= $this->input->post('amount');
            $nickname						= $this->input->post('nickname');
            
            if ($this->investor_model->edit_wallet($wallet_id, $user_id, $user_email, $broker, $type, $amount, $nickname)) {
                Template::set_message('Wallet Edited Successfully', 'success');
                redirect('Wallets');
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('Wallets/Edit', $data);
                Template::set_message('Form Information Not Entered Correctly', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Deposit_Funds()
    {
        $pageType = 'Standard';
        $pageName = 'Deposit_Funds';
        
        $this->set_current_user();
        //~ $this->output->cache(1440);
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Wallets/Deposit_Funds');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $active							= 'No';
            $unix_timestamp					= time();
            $date							= date('d F y');
            $month							= date("m");
            $day							= date("d");
            $year							= date("Y");
            $time							= date('h:i A');
            $trans_type						= 'Deposit';
            $currency						= 'USD';
            $wallet_id						= $this->input->post('wallet_id');
            $bank_account_id				= null;
            $broker							= $this->input->post('broker');
            $nickname						= $this->input->post('nickname');
            $user_id						= $this->input->post('user_id');
            $user_email						= $this->input->post('user_email');
            $type							= $this->input->post('type');
            $trans_date						= $year . '-' . $month . '-' . $day;
            $wallet_sum                     = $this->input->post('wallet_sum');
            $new_amount						= $this->input->post('amount');
            $amount                         = $wallet_sum + $new_amount;
            $fees							= $amount * 0.03;
            $total_cost						= $amount + $fees;
            if ($this->wallet_model->add_fund_deposit($active, $unix_timestamp, $date, $month, $day, $year, $time, $trans_type, $currency, $wallet_id, $bank_account_id, $broker, $nickname, $user_id, $user_email, $type, $trans_date, $wallet_sum, $new_amount, $amount, $fees, $total_cost)) {
                // Template::set_message('Funds Deposited Successfully', 'success');
                redirect('Wallets/Confirm-Deposit/' . $wallet_id);
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('Wallets/Deposit_Funds', $data);
                Template::set_message('Form Information Not Entered Correctly', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Confirm_Deposit()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Deposit_Complete($transID)
    {
        // create the data object
        $data = new stdClass();
        
        // set variables from the form
        $id		 	= $transID;
        
        if ($this->wallet_model->complete_deposit($transID)) {

            // user creation ok
            Template::set_message('Funds Deposited Successfully', 'success');
            redirect('/Wallets');
        }
    }
    
    public function Withdraw_Funds()
    {
        $pageType = 'Standard';
        $pageName = 'Withdraw_Funds';
        
        $this->set_current_user();
        //~ $this->output->cache(1440);
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Wallets/Withdraw_Funds');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $active							= 'Yes';
            $unix_timestamp					= time();
            $date							= date('d F y');
            $month							= date("m");
            $day							= date("d");
            $year							= date("Y");
            $time							= date('h:i A');
            $trans_type						= 'Withdraw';
            $currency						= 'USD';
            $redirectURL					= $this->input->post('redirectURL');
            $wallet_id						= $this->input->post('wallet_id');
            $wallet_sum						= $this->input->post('wallet_sum');
            $bank_account_id				= $this->input->post('account');
            $broker							= $this->input->post('broker');
            $nickname						= $this->input->post('nickname');
            $user_id						= $this->input->post('user_id');
            $user_email						= $this->input->post('user_email');
            $type							= $this->input->post('type');
            $trans_date						= $year . '-' . $month . '-' . $day;
            $amount							= $this->input->post('amount');
            $fees							= 0;
            $total_cost						= $amount;
            
            if ($amount < $wallet_sum) {
                if ($this->wallet_model->add_fund_withdraw($active, $unix_timestamp, $date, $month, $day, $year, $time, $trans_type, $currency, $wallet_id, $bank_account_id, $broker, $nickname, $user_id, $user_email, $type, $trans_date, $amount, $fees, $total_cost)) {
                    Template::set_message('Funds Withdrawn Successfully', 'success');
                    redirect($redirectURL);
                } else {
                    
                    // user creation failed, this should never happen
                    $data->error = 'There was a problem submitting your request. Please try again.';
                    
                    // send error to the view
                    $this->load->view('Wallets/Withdraw_Funds', $data);
                    Template::set_message('Form Information Not Entered Correctly', 'error');
                    Template::set('pageType', $pageType);
                    Template::set('pageName', $pageName);
                    Template::render();
                }
            } else {
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                Template::set_message('Withdrawal Request Amoount is larger than the balance on the account', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::redirect('Add-Wallet-Withdraw/' . $wallet_id);
            }
        }
    }
    
    public function Create_Bank_Account()
    {
        $pageType = 'Standard';
        $pageName = 'Create_Bank_Account';
        
        $this->set_current_user();
        //~ $this->output->cache(1440);
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('Wallets/Create_Bank_Account');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $redirectURL					= $this->input->post('redirectURL');
            $date							= date('d F y');
            $time							= date('h:i A');
            $user_id						= $this->input->post('user_id');
            $user_email						= $this->input->post('user_email');
            $wallet_id						= $this->input->post('wallet_id');
            $account_type					= $this->input->post('account_type');
            $bank_account_owner				= $this->input->post('bank_account_owner');
            $bank_name						= $this->input->post('bank_name');
            $routing_number					= $this->input->post('routing_number');
            $account_number					= $this->input->post('account_number');
            $verify_account					= $this->input->post('verify_account');
            $nickname						= $this->input->post('nickname');
            
            if ($this->wallet_model->connect_bank_account($date, $time, $user_id, $user_email, $wallet_id, $account_type, $bank_account_owner, $bank_name, $routing_number, $account_number, $verify_account, $nickname)) {
                Template::set_message('Bank Account Connected Successfully', 'success');
                redirect($redirectURL);
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                Template::set_message('Form Information Not Entered Correctly', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::set('data', $data);
                Template::redirect('Wallets');
            }
        }
    }
    
    public function Transfer_Funds()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
    
    public function Wallet_Transaction()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Wallets/Wallet_Transaction');
    }
   
    public function Add_Deposit_Fetch()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Wallets/Add_Deposit_Fetch');
    }
    
    public function Add_Withdraw_Fetch()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Wallets/Add_Withdraw_Fetch');
    }

    public function Purchase_Gold()
    {
        $pageType = 'Standard';
        $pageName = 'Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Wallets/Purchase_Gold');
    }

    public function Details()
    {
        $pageType = 'Standard';
        $pageName = 'Wallet_Details';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
            
    public function Delete($wallet_id)
    {
        // create the data object
        $data = new stdClass();
        
        // set variables from the form
        
        if ($this->wallet_model->delete_wallet($wallet_id)) {
            // user creation ok
            Template::set_message('Deleted Successfully', 'error');
            redirect('/Wallets');
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
