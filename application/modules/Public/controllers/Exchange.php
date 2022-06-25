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
class Exchange extends CI_Controller
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
        $this->load->model('API/api_model');
        //$this->load->module('ContactUs');

        //$this->lang->load('Blog_lang');
        //~ $this->siteSettings = $this->settings_lib->find_all();
        //~ if ($this->siteSettings['auth.password_show_labels'] == 1) {
            //~ add_module_js('users', 'password_strength.js');
            //~ Assets::add_module_js('users', 'jquery.strength.js');
        //~ }
    }

    // -------------------------------------------------------------------------
    // Main Blog Post Page
    // -------------------------------------------------------------------------

    public function Order_Event_Manager($market_pair, $market, $lastOrderID)
    {
        $pageType = 'Standard';
        $pageName = 'User_Dashboard';
        $this->load->view('Public/Exchange/Order_Event_Manager');
    }
    /* end ./application/controllers/home.php */
}
