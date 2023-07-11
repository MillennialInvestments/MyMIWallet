<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIReferrals
{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('users/auth', 'MyMIUser', 'Session');
        $this->CI->load->model(array('Management/analytical_model', 'User/referral_model'));
        $this->CI->load->config('site_settings');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID                               = $this->CI->auth->user_id();
    }
    
    public function all_user_referral_info($cuID, $cuReferrerCode) {        // Compile all User Referral Data to a single array to be distributed accordingly
        $getTotalReferrals                  = $this->CI->referral_model->get_total_referrals($cuID, $cuReferrerCode); 
        $totalReferrals                     = $getTotalReferrals->num_rows(); 
        $getTotalActiveReferrals            = $this->CI->referral_model->get_total_active_referrals($cuID, $cuReferrerCode); 
        $totalActiveReferrals               = $getTotalActiveReferrals->num_rows(); 
        $commissionsData                    = $this->CI->referral_model->calculate_commission($cuID, $cuReferrerCode);
        $userReferrals                      = array(
            'getTotalReferrals'             => $getTotalReferrals,
            'totalReferrals'                => $totalReferrals,
            'getTotalActiveReferrals'       => $getTotalActiveReferrals,
            'totalActiveReferrals'          => $totalActiveReferrals,
        ); 

        return $userReferrals;
    }

    public function activate_payments() {   // Activate/Transfer Monthly Payment based on user's referral totals

    }

    public function commission_per_user($cuID, $cuReferrerCode) {
        
        $commissionsData                    = $this->CI->referral_model->calculate_commission($cuID, $cuReferrerCode);
        return $commissionsData; 
    }
    

    public function history() {             // Gather Referral Code History per user's referral code

    }

    public function payment_history() {     // Gather History All Referral Code Payments | Complete Checks/Balance of history()

    }

}