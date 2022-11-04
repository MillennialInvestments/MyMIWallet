<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIMarketing
{
    public function __construct()
    {
        $this->CI =& get_instance();
        // $this->CI->load->library(array('Auth','MyMIGold','MyMICoin'));
        $this->CI->load->model('Management/marketing_model');
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
        $getPageSEO     			            = $this->CI->marketing_model->get_marketing_page_seo($pageName);
        foreach ($getPageSEO->result_array() as $pageSEO) {
            $page_id                            = $pageSEO['id'];
            $page_name                          = $pageSEO['page_name'];
            $page_title                         = $pageSEO['page_title'];
            $page_url                           = $pageSEO['page_url'];
            $page_sitemap_url                   = $pageSEO['page_sitemap_url'];
            $page_internal_url                  = $pageSEO['page_internal_url'];
            $page_controller                    = $pageSEO['page_controller'];
            $page_controller_url                = $pageSEO['page_controller_url'];
            $page_controller_directory          = $pageSEO['page_controller_directory'];
            $page_file_directory                = $pageSEO['page_file_directory'];
            $page_image                         = $pageSEO['page_image'];
            $page_description                   = $pageSEO['page_description'];
            $page_address                       = $pageSEO['page_address'];
            $page_city                          = $pageSEO['page_city'];
            $page_state                         = $pageSEO['page_state'];
            $page_country                       = $pageSEO['page_country'];
            $page_zipcode                       = $pageSEO['page_zipcode'];
            $page_facebook                      = $pageSEO['page_facebook'];
            $linked                             = $pageSEO['linked'];
            $functionality                      = $pageSEO['functionality'];
            $design                             = $pageSEO['design'];
            $seo                                = $pageSEO['seo'];
            $ext_links                          = $pageSEO['ext_links'];
            $grammar                            = $pageSEO['grammar'];
            $d_optimize                         = $pageSEO['d_optimize'];
            $load_perf                          = $pageSEO['load_perf'];
            $additional_notes                   = $pageSEO['additional_notes'];
        }

        $pageSEOData				            = array(
            'page_id'			                => $page_id,
            'page_name'			                => $page_name,
            'page_title'			            => $page_title,
            'page_url'			                => $page_url,
            'page_sitemap_url'		            => $page_sitemap_url,
            'page_internal_url'			        => $page_internal_url,
            'page_controller'			        => $page_controller,
            'page_controller_url'			    => $page_controller_url,
            'page_controller_directory'			=> $page_controller_directory,
            'page_file_directory'			    => $page_file_directory,
            'page_image'                        => $page_image,
            'page_description'		            => $page_description,
            'page_address'			            => $page_address,
            'page_city'			                => $page_city,
            'page_state'			            => $page_state,
            'page_country'			            => $page_country,
            'page_zipcode'			            => $page_zipcode,
            'page_facebook'			            => $page_facebook,
            'linked'			                => $linked,
            'functionality'			            => $functionality,
            'design'			                => $design,
            'seo'			                    => $seo,
            'ext_links'			                => $ext_links,
            'grammar'			                => $grammar,
            'd_optimize'			            => $d_optimize,
            'load_perf'			                => $load_perf,
            'additional_notes'			        => $additional_notes,
        );

        return $pageSEOData;
    }

    public function get_page_headers_by_name($pageName)
    {
        $getPageSEO     			            = $this->CI->marketing_model->get_marketing_page_seo_by_name($pageName);
        foreach ($getPageSEO->result_array() as $pageSEO) {
                $page_id                            = $pageSEO['id'];
                $page_name                          = $pageSEO['page_name'];
                $page_title                         = $pageSEO['page_title'];
                $page_url                           = $pageSEO['page_url'];
                $page_sitemap_url                   = $pageSEO['page_sitemap_url'];
                $page_internal_url                  = $pageSEO['page_internal_url'];
                $page_controller                    = $pageSEO['page_controller'];
                $page_controller_url                = $pageSEO['page_controller_url'];
                $page_controller_directory          = $pageSEO['page_controller_directory'];
                $page_file_directory                = $pageSEO['page_file_directory'];
                $page_image                         = $pageSEO['page_image'];
                $page_description                   = $pageSEO['page_description'];
                $page_address                       = $pageSEO['page_address'];
                $page_city                          = $pageSEO['page_city'];
                $page_state                         = $pageSEO['page_state'];
                $page_country                       = $pageSEO['page_country'];
                $page_zipcode                       = $pageSEO['page_zipcode'];
                $page_facebook                      = $pageSEO['page_facebook'];
                $linked                             = $pageSEO['linked'];
                $functionality                      = $pageSEO['functionality'];
                $design                             = $pageSEO['design'];
                $seo                                = $pageSEO['seo'];
                $ext_links                          = $pageSEO['ext_links'];
                $grammar                            = $pageSEO['grammar'];
                $d_optimize                         = $pageSEO['d_optimize'];
                $load_perf                          = $pageSEO['load_perf'];
                $additional_notes                   = $pageSEO['additional_notes'];
                
                $pageSEOData				            = array(
                    'page_id'			                => $page_id,
                    'page_name'			                => $page_name,
                    'page_title'			            => $page_title,
                    'page_url'			                => $page_url,
                    'page_sitemap_url'		            => $page_sitemap_url,
                    'page_internal_url'			        => $page_internal_url,
                    'page_controller'			        => $page_controller,
                    'page_controller_url'			    => $page_controller_url,
                    'page_controller_directory'			=> $page_controller_directory,
                    'page_file_directory'			    => $page_file_directory,
                    'page_image'                        => $page_image,
                    'page_description'		            => $page_description,
                    'page_address'			            => $page_address,
                    'page_city'			                => $page_city,
                    'page_state'			            => $page_state,
                    'page_country'			            => $page_country,
                    'page_zipcode'			            => $page_zipcode,
                    'page_facebook'			            => $page_facebook,
                    'linked'			                => $linked,
                    'functionality'			            => $functionality,
                    'design'			                => $design,
                    'seo'			                    => $seo,
                    'ext_links'			                => $ext_links,
                    'grammar'			                => $grammar,
                    'd_optimize'			            => $d_optimize,
                    'load_perf'			                => $load_perf,
                    'additional_notes'			        => $additional_notes,
                );
                return $pageSEOData;
            }
        }
    }
}
