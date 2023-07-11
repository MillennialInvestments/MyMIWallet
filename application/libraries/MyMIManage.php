<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIManage
{
    public function __construct()
    {
        $this->CI =& get_instance();
<<<<<<< HEAD
        $this->CI->load->library('users/Auth');
=======
        $this->CI->load->library('Auth');
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        $this->CI->load->model('Users/investor_model');
        $this->CI->load->config('site_settings');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID = $this->CI->auth->user_id();
    }
    
    // public function user_account_info($userID)
    // {
        
    // }
}
