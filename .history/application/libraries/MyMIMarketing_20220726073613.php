<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIMarketing
{
    public function __construct()
    {
        $this->CI =& get_instance();
        // $this->CI->load->library(array('Auth','MyMIGold','MyMICoin'));
        $this->CI->load->model(array('Management/Marketing_model'));
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
        $cuID 								= $this->CI->auth->user_id();
    }
    /**
     * User Default Information.
     *
     * Provides front-end functions for users, including access to login and logout.
     *
     * @package applications\library\MyMIWallet\Controllers\Users
     */

    public function get_page_headers()
    {
        $getPageSEO     			= $this->CI->marketing_model->get_marketing_page_seo();
        foreach ($getPageSEO->result_array() as $pageSEO) {
            $page_id                = $pageSEO['id'];
            $page_name              = $pageSEO['name'];
            $page_title             = $pageSEO['title'];
            $page_url               = $pageSEO['url'];
            $page_sitemap_url       = $pageSEO['sitemap_url'];
            $page_image             = $pageSEO['image'];
            $page_description       = $pageSEO['description'];
            $page_address           = $pageSEO['address'];
            $page_city              = $pageSEO['city'];
            $page_state             = $pageSEO['state'];
            $page_country           = $pageSEO['country'];
            $page_zipcode           = $pageSEO['zipcode'];
            $page_facebook          = $pageSEO['facebook'];
        }

        $pageSEOData				= array(
            'page_id'			    => $page_id,
            'page_name'			    => $page_name,
            'page_title'			=> $page_title,
            'page_url'			    => $page_url,
            'page_sitemap_url'		=> $page_sitemap_url,
            'page_image'			=> $page_image,
            'page_description'		=> $page_description,
            'page_address'			=> $page_address,
            'page_city'			    => $page_city,
            'page_state'			=> $page_state,
            'page_country'			=> $page_country,
            'page_zipcode'			=> $page_zipcode,
            'page_facebook'			=> $page_facebook,
        );

        return $exchangeMarketData;
    }
}
