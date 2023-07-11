<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIInvestments
{
    private $cuID;
    private $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library(array('Auth', 'MyMICoin', 'MyMIGold', 'MyMIUser', 'MyMIWallet', 'session', 'settings/settings_lib', 'Template'));
        $this->CI->load->model(array('Management/mgmt_budget_model'));
        $this->CI->load->model(array('User/investments_model', 'User/wallet_model'));
        $this->CI->load->library('users/auth');
        $cuID                                   = $this->CI->session->userdata('user_id');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
    }
    /**
     * User Default Information.
     *
     * Provides front-end functions for users, including access to login and logout.
     *
     * @package applications\library\MyMIWallet\Controllers\Users
     * User Information                         = $this->get_user_information($cuID);
     * User Default Wallet                      = $this->get_user_default_wallet($cuID);
     */
    public function all_user_investments_info($cuID) {
        $userInvestmentRecords                  = $this->CI->investments_model->all_active_user_investments_info($cuID); 
        $monthlyInvestmentsCount                = 0; 
        $annualInvestmentsCount                 = 0; 
        // $monthlyInvestmentsCount                = $this->CI->investments_model->all_user_monthly_investments($cuID); 
        // $annualInvestmentsCount                 = $this->CI->investments_model->all_user_annual_investents($cuID); 
        $allUserInvestments                     = array(
            'message_type'                      => 'Success',
            'message'                           => 'Data Retrieved Successfully',
            'userInvestmentRecords'             => $userInvestmentRecords->result_array(),
            'activeInvestmentCount'             => $userInvestmentRecords->num_rows(), 
            'monthlyInvestmentCount'            => $monthlyInvestmentsCount,
            'annualInvestmentsCount'            => $annualInvestmentsCount,
            // 'monthlyInvestmentCount'            => $monthlyInvestmentsCount->num_rows(),
            // 'annualInvestmentCount'             => $annualInvestmentsCount->num_rows(),
        );

        return $allUserInvestments;
    }
}
