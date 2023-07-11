<?php defined('BASEPATH') or exit('No direct script access allowed');

class PreControllerHook {
    public function seo_check() {
        $CI =& get_instance();
        $CI->load->controller('Management/Marketing');
        if ($CI->marketing->seo_check()) {
            log_message('custom', 'SEO Check Completed: ' . $this->uri->uri_string());
        } else {
            log_message('error', 'SEO Check Failed: ' . $this->uri->uri_string()); 
        }
        // $CI->marketing->seo_check();
    }
}
