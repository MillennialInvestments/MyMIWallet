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
class Trade_Tracker extends Admin_Controller
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
        //~ $this->load->model('User/tracker_model');
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
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Log()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }

    public function Overview()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        Template::set('pageType', $pageType);
        Template::set('pageName', $pageName);
        Template::render();
    }
        
    public function Holdings_Manager()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('Exchange/Order_Buy_Manager');
    }

    public function Trade_Manager()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Trade_Tracker/Trade_Manager');
    }
    
    public function Trade_Tracker_Editor()
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        
        $this->set_current_user();
        
        $this->load->view('User/Trade_Tracker/Trade_Tracker_Editor');
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
            $this->load->view('User/Trade_Tracker/Search');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $stock_one					= $this->input->post('stock');
            $alert_type					= $this->input->post('alert_type');
            
            if ($this->tracker_model->add_trade($submitted_date, $submitted_time, $trade_date, $trade_time, $user_type, $user_id, $username, $email, $trading_account, $trade_type, $purchase_type, $symbol_type, $exchange, $symbol, $company, $link, $current_price, $sell_price, $position_size, $total_trade_cost, $net_gains, $percent_change, $option_type, $expiration, $option_price, $strike, $details)) {
                // set variables from the form
                
                redirect('/Trade-Tracker/Add/' . $stock_one . '/' . $alert_type);
            } else {
                $this->load->view('User/Trade_Tracker/Search');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Add()
    {
        $pageType = 'Standard';
        $pageName = 'Add';
        
        $this->set_current_user();
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Trade_Tracker/Add');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $submitted_date				= $this->input->post('submitted_date');
            $submitted_time				= $this->input->post('submitted_time');
            $trade_date					= $this->input->post('trade_date');
            $trade_time					= $this->input->post('trade_time');
            $user_type					= $this->input->post('user_type');
            $user_id					= $this->input->post('user_id');
            $username					= $this->input->post('username');
            $email						= $this->input->post('email');
            $trading_account			= $this->input->post('trading_account');
            $trade_type					= $this->input->post('trade_type');
            $purchase_type				= 'Buy';
            $symbol_type				= $this->input->post('symbol_type');
            $exchange					= $this->input->post('exchange');
            $symbol						= $this->input->post('symbol');
            $company					= $this->input->post('company');
            $link						= $symbol_type . '/' . $exchange . '/' . $symbol;
            if ($trade_type === 'Equity Trade') {
                $current_price			= $this->input->post('current_price');
                $position_size			= $this->input->post('position_size');
                $remaining_position		= $this->input->post('position_size');
                $total_trade_cost		= $current_price * $position_size;
                $price_target			= $this->input->post('price_target');
                if ($price_target !== null) {
                    $differential			= $price_target - $current_price;
                    $potential_gain			= round(($differential / $current_price) * 100, 2);
                }
                $stop_loss_percent		= $this->input->post('stop_loss_percent');
                if ($stop_loss_percent !== null) {
                    $stop_loss_differential	= $current_price * $stop_loss_percent;
                    $stop_loss 				= $current_price - $stop_loss_differential;
                }
                $option_type			= null;
                $expiration				= null;
                $option_price			= null;
                $strike					= null;
            } elseif ($trade_type === 'Option Trade') {
                $current_price			= $this->input->post('current_price');
                $position_size			= $this->input->post('position_size');
                $remaining_position		= $this->input->post('position_size');
                $option_type			= $this->input->post('option_type');
                $exp_day				= $this->input->post('exp_day');
                $exp_month				= $this->input->post('exp_month');
                $exp_year				= $this->input->post('exp_year');
                $expiration				= $exp_day . ' ' . $exp_month . ' ' . $exp_year;
                $option_price			= $this->input->post('option_price');
                $strike					= $this->input->post('strike');
                $total_trade_cost		= ($option_price * 100) * $position_size;
                $price_target			= $this->input->post('price_target');
                if ($price_target !== null) {
                    $differential			= $price_target - $current_price;
                    $potential_gain			= round(($differential / $current_price) * 100, 2);
                }
                $stop_loss_percent		= $this->input->post('stop_loss_percent');
                if ($stop_loss_percent !== null) {
                    $stop_loss_differential	= $current_price * $stop_loss_percent;
                    $stop_loss 				= $current_price - $stop_loss_differential;
                }
            }
            $details					= $this->input->post('details');
            
            if ($this->tracker_model->add_trade($submitted_date, $submitted_time, $trade_date, $trade_time, $user_type, $user_id, $username, $email, $trading_account, $trade_type, $purchase_type, $symbol_type, $exchange, $symbol, $company, $link, $current_price, $price_target, $position_size, $remaining_position, $total_trade_cost, $differential, $potential_gain, $stop_loss_percent, $stop_loss_differential, $stop_loss, $option_type, $exp_day, $exp_month, $exp_year, $expiration, $option_price, $strike, $details)) {
                // Redirect to Alert Procedures
                Template::set_message('Trade Submitted Successfully', 'success');
                redirect('/Wallet-Details/' . $trading_account);
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('User/Trade_Tracker/Add', $data);
                Template::set_message('Form Information Not Entered Correctly', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Quick_Trade()
    {
        $pageType = 'Standard';
        $pageName = 'Quick_Trade';
        
        $this->set_current_user();
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Trade_Tracker/Quick_Trade');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $submitted_date				= $this->input->post('submitted_date');
            $submitted_time				= $this->input->post('submitted_time');
            $trade_date					= $this->input->post('trade_date');
            $trade_time					= $this->input->post('trade_time');
            $user_type					= $this->input->post('user_type');
            $user_id					= $this->input->post('user_id');
            $username					= $this->input->post('username');
            $email						= $this->input->post('email');
            $trading_account			= $this->input->post('trading_account');
            $trade_type					= $this->input->post('trade_type');
            $purchase_type				= 'Buy/Sell';
            $symbol_type				= $this->input->post('symbol_type');
            $exchange					= $this->input->post('exchange');
            $symbol						= $this->input->post('symbol');
            $company					= $this->input->post('company');
            $link						= $symbol_type . '/' . $exchange . '/' . $symbol;
            $current_price				= $this->input->post('current_price');
            $sell_price					= $this->input->post('sell_price');
            $position_size				= $this->input->post('position_size');
            $total_trade_cost			= $current_price * $position_size;
            $total_trade_sell			= $sell_price * $position_size;
            $net_gains					= $sell_price - $current_price;
            $percent_change				= round((($total_trade_sell - $total_trade_cost) / $total_trade_cost) * 100, 2);
            $option_type				= null;
            $expiration					= null;
            $option_price				= null;
            $strike						= null;
            $details					= $this->input->post('details');
            
            if ($this->tracker_model->add_trade($submitted_date, $submitted_time, $trade_date, $trade_time, $user_type, $user_id, $username, $email, $trading_account, $trade_type, $purchase_type, $symbol_type, $exchange, $symbol, $company, $link, $current_price, $sell_price, $position_size, $total_trade_cost, $net_gains, $percent_change, $option_type, $expiration, $option_price, $strike, $details)) {
                // Redirect to Alert Procedures
                Template::set_message('Trade Submitted Successfully', 'success');
                redirect('/Wallet-Details/' . $trading_account);
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('User/Trade_Tracker/Quick_Trade', $data);
                Template::set_message('Form Information Not Entered Correctly', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Sell()
    {
        $pageType = 'Standard';
        $pageName = 'Sell';
        
        $this->set_current_user();
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Trade_Tracker/Sell');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $trade_id							= $this->input->post('trade_id');
            $submitted_date						= $this->input->post('submitted_date');
            $submitted_time						= $this->input->post('submitted_time');
            $trade_date							= $this->input->post('trade_date');
            $trade_time							= $this->input->post('trade_time');
            $user_type							= $this->input->post('user_type');
            $user_id							= $this->input->post('user_id');
            $username							= $this->input->post('username');
            $email								= $this->input->post('email');
            $trading_account					= $this->input->post('trading_account');
            $trade_type							= $this->input->post('trade_type');
            $purchase_type						= 'Sell';
            $symbol_type						= $this->input->post('symbol_type');
            $exchange							= $this->input->post('exchange');
            $symbol								= $this->input->post('symbol');
            $company							= $this->input->post('company');
            $link								= $this->input->post('link');
            if ($trade_type === 'Equity Trade') {
                // Trade Sell Information
                $purchase_price					= $this->input->post('purchase_price');
                $sell_price						= $this->input->post('sell_price');
                $price_differential				= $sell_price - $purchase_price;
                $position_size					= $this->input->post('position_size');
                $net_gains						= $price_differential * $position_size;
                $percent_change					= round((($sell_price - $purchase_price) / $purchase_price) * 100, 2);
                $total_trade_cost				= $sell_price * $position_size;
                $original_position				= $this->input->post('original_position');
                $last_remaining_position		= $this->input->post('last_remaining_position');
                $remaining_position				= $original_position - $position_size;
                $underlying_price				= null;
                $price_target					= $this->input->post('price_target');
                $target_differential			= $price_target - $sell_price;
                $potential_gain					= $this->input->post('potential_gain');			// Potential Percentage Gain
                $gain_differential				= $potential_gain - $target_differential;
                if ($remaining_position > 0) {
                    $stop_loss_percent			= 0.05;
                    $stop_loss_differential		= $sell_price * $stop_loss_percent;
                    $stop_loss					= $sell_price - $stop_loss_differential;
                } else {
                    $stop_loss_percent			= 0.05;
                    $stop_loss_differential		= '0.00';
                    $stop_loss					= '0.00';
                }
            } elseif ($trade_type === 'Option Trade') {
                $purchase_price					= $this->input->post('purchase_price'); 		// Original Option Cost (option_price)
                $sell_price						= $this->input->post('sell_price');				// Current Option Cost
                $price_differential				= $sell_price - $purchase_price;				// Gains Differentials
                $position_size					= $this->input->post('position_size'); 			// # of Contracts Sold
                $net_gains						= $price_differential * $position_size;			// Total Net Gains Made/Lost
                $percent_change					= round((($sell_price - $purchase_price) / $purchase_price) * 100, 4);
                $total_trade_cost				= $sell_price * $position_size;					// Total Trade Cost
                $original_position				= $this->input->post('remaining_position');							// # of Contracts Originally Owned
                $remaining_position				= $original_position - $position_size;			// Remaining Option Contracts
                $underlying_price				= $this->input->post('underlying_price');		// Underlying Stock Price
                $price_target					= $this->input->post('price_target'); 			// Original Price Target
                $target_differential			= $price_target - $underlying_price;			// Differential Of Price Target vs. Current Underlying Value
                $potential_gain					= $this->input->post('potential_gain');			// Original Expected Potential Gains
                $gain_differential				= $potential_gain - $target_differential;		// Different Between Expected Gains vs. Current Gains
                if ($remaining_position > 0) {
                    $stop_loss_percent			= 0.1;
                    $stop_loss_differential		= $sell_price * $stop_loss_percent;
                    $stop_loss					= $sell_price - $stop_loss_differential;
                } else {
                    $stop_loss_percent			= 0.1;
                    $stop_loss_differential		= '0.00';
                    $stop_loss					= '0.00';
                }
            }
            $details							= $this->input->post('details');
            
            if ($this->tracker_model->sell_trade($trade_id, $submitted_date, $submitted_time, $trade_date, $trade_time, $user_type, $user_id, $username, $email, $trading_account, $trade_type, $purchase_type, $symbol_type, $exchange, $symbol, $company, $link, $total_trade_cost, $purchase_price, $sell_price, $price_differential, $position_size, $net_gains, $percent_change, $original_position, $remaining_position, $underlying_price, $price_target, $target_differential, $potential_gain, $gain_differential, $stop_loss_percent, $stop_loss_differential, $stop_loss, $details)) {
                if ($remaining_position === 0) {
                    $status						= 'Closed';
                    if ($this->tracker_model->trade_status_closed($trade_id, $status, $purchase_type)) {
                        // Redirect to Alert Procedures
                        //~ Template::set_message('Trade Submitted Successfully', 'success');
                        redirect('/Wallet-Details/' . $trading_account);
                    }
                } else {
                    if ($this->tracker_model->update_initial_trade($trade_id, $remaining_position)) {
                        // Redirect to Alert Procedures
                        //~ Template::set_message('Trade Submitted Successfully', 'success');
                        redirect('/Wallet-Details/' . $trading_account);
                    }
                }
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('User/Trade_Tracker/Sell', $data);
                Template::set_message('Form Information Not Entered Correctly', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Update($stockID)
    {
        $pageType = 'Standard';
        $pageName = 'Trade_Tracker_Update';
        
        $this->set_current_user();
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Trade_Tracker/Update');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $id							= $this->input->post('id');
            $trading_account			= $this->input->post('trading_account');
            $last_updated				= $this->input->post('last_updated');
            $last_updated_time			= $this->input->post('last_updated_time');
            $category					= $this->input->post('category');
            if ($category === 'Option Trade') {
                $price_high				= $this->input->post('price_high');
                $current_price			= $this->input->post('current_price');
                $position				= $this->input->post('position');
                $net_gains_per			= ($price_high - $current_price) * 100;
                $total_net_gains		= round($net_gains_per * $position, 2);
                $underlying_price		= $this->input->post('underlying_price');
                $percent_total	 		= ($price_high - $current_price) / $current_price;
                $percent_change			= round($percent_total * 100, 2);
                $potential_gain			= $this->input->post('potential_gain');
                $gain_differential 		= $potential_gain - $percent_change;
                $stop_loss_percent		= 0.05;
                $stop_loss_differential	= $price_high * $stop_loss_percent;
                $stop_loss 				= $price_high - $stop_loss_differential;
                $updated_details		= $this->input->post('updated_details');
            } elseif ($category === 'Equity Trade') {
                $price_high				= $this->input->post('price_high');
                $current_price			= $this->input->post('current_price');
                $position				= $this->input->post('position');
                $net_gains_per			= $price_high - $current_price;
                $total_net_gains		= round($net_gains_per * $position, 2);
                $underlying_price		= null;
                $percent_total	 		= ($price_high - $current_price) / $current_price;
                $percent_change			= round($percent_total * 100, 2);
                $potential_gain			= $this->input->post('potential_gain');
                $gain_differential 		= $potential_gain - $percent_change;
                $stop_loss_percent		= 0.05;
                $stop_loss_differential	= $price_high * $stop_loss_percent;
                $stop_loss 				= $price_high - $stop_loss_differential;
                $updated_details		= $this->input->post('updated_details');
            }
            
            if ($this->tracker_model->update_trade($id, $last_updated, $last_updated_time, $price_high, $net_gains_per, $total_net_gains, $percent_change, $underlying_price, $gain_differential, $stop_loss_differential, $stop_loss, $updated_details)) {
                // Redirect to Alert Procedures
                Template::set_message('Trade Update Submitted Successfully', 'success');
                redirect('/Wallet-Details/' . $trading_account);
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('User/Trade_Tracker/Update', $data);
                Template::set_message('Form Information Not Entered Correctly', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Close()
    {
        $pageType = 'Standard';
        $pageName = 'Close';
        
        $this->set_current_user();
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Trade_Tracker/Close');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $trade_id							= $this->input->post('trade_id');
            $submitted_date						= $this->input->post('submitted_date');
            $submitted_time						= $this->input->post('submitted_time');
            $trade_date							= $this->input->post('trade_date');
            $trade_time							= $this->input->post('trade_time');
            $user_type							= $this->input->post('user_type');
            $user_id							= $this->input->post('user_id');
            $username							= $this->input->post('username');
            $email								= $this->input->post('email');
            $trading_account					= $this->input->post('trading_account');
            $trade_type							= $this->input->post('trade_type');
            $purchase_type						= 'Sell';
            $symbol_type						= $this->input->post('symbol_type');
            $exchange							= $this->input->post('exchange');
            $symbol								= $this->input->post('symbol');
            $company							= $this->input->post('company');
            $link								= $this->input->post('link');
            if ($trade_type === 'Equity Trade') {
                // Trade Sell Information
                $purchase_price					= $this->input->post('purchase_price');
                $sell_price						= $this->input->post('sell_price');
                $price_differential				= $sell_price - $purchase_price;
                $position_size					= $this->input->post('position_size');
                $net_gains						= $price_differential * $position_size;
                $percent_change					= round((($sell_price - $purchase_price) / $purchase_price) * 100, 2);
                $total_trade_cost				= $sell_price * $position_size;
                $original_position				= $this->input->post('original_position');
                $last_remaining_position		= $this->input->post('last_remaining_position');
                $remaining_position				= $original_position - $position_size;
                $underlying_price				= null;
                $price_target					= $this->input->post('price_target');
                $target_differential			= $price_target - $sell_price;
                $potential_gain					= $this->input->post('potential_gain');			// Potential Percentage Gain
                $gain_differential				= $potential_gain - $target_differential;
                if ($remaining_position > 0) {
                    $stop_loss_percent			= 0.05;
                    $stop_loss_differential		= $sell_price * $stop_loss_percent;
                    $stop_loss					= $sell_price - $stop_loss_differential;
                } else {
                    $stop_loss_percent			= 0.05;
                    $stop_loss_differential		= '0.00';
                    $stop_loss					= '0.00';
                }
            } elseif ($trade_type === 'Option Trade') {
                $purchase_price					= $this->input->post('purchase_price'); 		// Original Option Cost (option_price)
                $sell_price						= $this->input->post('sell_price');				// Current Option Cost
                $price_differential				= $sell_price - $purchase_price;				// Gains Differentials
                $position_size					= $this->input->post('position_size'); 			// # of Contracts Sold
                $net_gains						= $price_differential * $position_size;			// Total Net Gains Made/Lost
                $percent_change					= round((($sell_price - $purchase_price) / $purchase_price) * 100, 4);
                $total_trade_cost				= $sell_price * $position_size;					// Total Trade Cost
                $original_position				= $this->input->post('remaining_position');		// # of Contracts Originally Owned
                $remaining_position				= $original_position - $position_size;			// Remaining Option Contracts
                $underlying_price				= $this->input->post('underlying_price');		// Underlying Stock Price
                $price_target					= $this->input->post('price_target'); 			// Original Price Target
                $target_differential			= $price_target - $underlying_price;			// Differential Of Price Target vs. Current Underlying Value
                $potential_gain					= $this->input->post('potential_gain');			// Original Expected Potential Gains
                $gain_differential				= $potential_gain - $target_differential;		// Different Between Expected Gains vs. Current Gains
                if ($remaining_position > 0) {
                    $stop_loss_percent			= 0.1;
                    $stop_loss_differential		= $sell_price * $stop_loss_percent;
                    $stop_loss					= $sell_price - $stop_loss_differential;
                } else {
                    $stop_loss_percent			= 0.1;
                    $stop_loss_differential		= '0.00';
                    $stop_loss					= '0.00';
                }
            }
            $details							= $this->input->post('details');
            
            if ($this->tracker_model->close_trade($trade_id, $submitted_date, $submitted_time, $trade_date, $trade_time, $user_type, $user_id, $username, $email, $trading_account, $trade_type, $purchase_type, $symbol_type, $exchange, $symbol, $company, $link, $total_trade_cost, $purchase_price, $sell_price, $price_differential, $position_size, $net_gains, $percent_change, $original_position, $remaining_position, $underlying_price, $price_target, $target_differential, $potential_gain, $gain_differential, $stop_loss_percent, $stop_loss_differential, $stop_loss, $details)) {
                if ($remaining_position === 0) {
                    $status						= 'Closed';
                    $purchase_type				= 'Sell';
                    $remaining_position			= 0;
                    if ($this->tracker_model->trade_status_closed($trade_id, $status, $purchase_type, $remaining_position)) {
                        // Redirect to Alert Procedures
                        //~ Template::set_message('Trade Submitted Successfully', 'success');
                        redirect('/Wallet-Details/' . $trading_account);
                    }
                }
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('User/Trade_Tracker/Close', $data);
                Template::set_message('Form Information Not Entered Correctly', 'error');
                Template::set('pageType', $pageType);
                Template::set('pageName', $pageName);
                Template::render();
            }
        }
    }
    
    public function Delete($tradeID)
    {
        // create the data object
        $data = new stdClass();
        
        // set variables from the form
        
        if ($this->tracker_model->delete_trade($tradeID)) {
            if ($this->tracker_model->delete_subtrades($tradeID)) {
                // user creation ok
                Template::set_message('Deleted Successfully', 'error');
                redirect('/Trade-Tracker');
            }
        }
    }
    
    public function Add_Stock()
    {
        $pageType = 'Standard';
        $pageName = 'Add_Stock';
        
        $this->set_current_user();
        
        // create the data object
        $data = new stdClass();
        // set validation rules
        $this->form_validation->set_rules('webpage', 'Webpage', 'trim');
        $this->form_validation->set_rules('url_link', 'URL Link', 'trim');
        
        if ($this->form_validation->run() === false) {
            $this->load->view('User/Trade_Tracker/Add_Stock');
            Template::set('pageType', $pageType);
            Template::set('pageName', $pageName);
            Template::render();
        } else {
            // set variables from the form
            $type						= $this->input->post('type');
            $symbol						= $this->input->post('symbol');
            $market						= $this->input->post('market');
            $company					= $this->input->post('company');
            $url_link					= $market . '/' . $symbol;
            $tradingview_link			= 'https://www.tradingview.com/symbols/' . $url_link;
            $website_link				= 'https://www.mymillennialinvestments.com/index.php/' . $type . '/' . $url_link;
            
            
            if ($this->tracker_model->add_stock($type, $symbol, $market, $company, $url_link, $tradingview_link, $website_link)) {
                // user creation ok
                $this->db->cache_delete_all();
                Template::set_message('Submitted Successfully', 'success');
                redirect('/User/Trade_Tracker/Search');
            } else {
                
                // user creation failed, this should never happen
                $data->error = 'There was a problem submitting your request. Please try again.';
                
                // send error to the view
                $this->load->view('Stock/Add_Stock', $data);
                Template::set_message('Form Information Not Entered Correctly', 'error');
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
