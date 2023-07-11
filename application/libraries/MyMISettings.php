<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIAnalytics
{
    public function __construct()
    {
        $this->CI                                           =& get_instance();
        $this->CI->load->library('users/auth', 'MyMIUser', 'Session');
        $this->CI->load->model(array('Management/analytical_model', 'Users/Budget'));
        $this->CI->load->config('site_settings');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID                                                   = $this->CI->auth->user_id();
    }
    
    public function user_settings()
    {    
        $cuID                                                   = $this->CI->auth->user_id();
        $pageURIA                                               = $this->CI->uri->segment(1); 
        $pageURIB                                               = $this->CI->uri->segment(2); 
        $pageURIC                                               = $this->CI->uri->segment(3); 
        $pageURID                                               = $this->CI->uri->segment(4); 
        $pageURIE                                               = $this->CI->uri->segment(5); 

        $userbudgetSettings                                     = $this->get_user_budget_settings($cuID); 

        $userSettings                                           = array(
            // Get Approved Reports
            'userbudgetSettings'                                => $userbudgetSettings,
        );

        $_SESSION['user_settings']                              = $user_settings;
        return $user_settings;
    }

    public function get_user_budget_settings($cuID) {
        $getUserBudgetSettings                                  = $this->budget_model->get_user_budget_settings($cuID);

        // create an array to hold settings by type
        $budgetSettingsByTypeArr = [];

        foreach($getUserBudgetSettings->result_array() as $budgetSettings) {
            foreach($budgetSettings['setting'] as $budgetSettingType) {
                $budgetSettingsByTypeArr[$budgetSettingType]    = $budgetSettings['option'];
            }
        }
        $userBudgetSettings                                     = $budgetSettingsByTypeArr;
        $_SESSION['userBudgetSettings']                         = $userBudgetSettings;
        return $userBudgetSettings;
    }

    public function get_user_activity($cuID) {
        $getUserActivity                                        = $this->CI->analytical_model->get_users_activity($cuID); 
        return $getUserActivity;
    }

   
}
