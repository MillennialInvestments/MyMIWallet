<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIManage
{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('Auth');
        $this->CI->load->model('Users/investor_model');
        $this->CI->load->config('site_settings');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID = $this->CI->auth->user_id();
    }
    
    // public function user_account_info($userID)
    // {
        
    // }
}
