<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIMarketing
{
    public function __construct()
    {
        $this->CI =& get_instance();
        // $this->CI->load->library(array('Auth','MyMIGold','MyMICoin'));
        $this->CI->load->model('Management/analytical_model');
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
    public function marketing() {
        $pageName                               = Template::get('pageName'); 
        $department                             = $this->department(); 
        $links                                  = $this->social_media();
        // $getPageSEO                             = $this->get_page_headers_by_name($pageName);
        $marketingDepartment                    = array(
            'links'                             => $links,
            // 'page_seo'                          => $getPageSEO,
            'department'                        => $department,
        );

        return $marketingDepartment;
    }

    public function social_media() {
        $links                                  = array(
            'discord'                           => $this->CI->config->item('discord'),
            'facebook_page'                     => $this->CI->config->item('facebook_page'), 
            'facebook_group'                    => $this->CI->config->item('facebook_group'),
            'linkedin'                          => $this->CI->config->item('linkedin'),
            'twitter'                           => $this->CI->config->item('twitter'),
            'youtube'                           => $this->CI->config->item('youtube'),
        );

        return $links;                            
    }

    public function department() {
        $getActiveCampaigns                     = $this->CI->marketing_model->get_active_campaigns(); 
        $totalActiveCampaigns                   = $getActiveCampaigns->num_rows(); 
        $department                             = array(
            'getActiveCampaigns'                => $getActiveCampaigns,
            'totalActiveCampaigns'              => $totalActiveCampaigns,
        );

        return $department; 
    }

    public function seo_check() {
        $uri_string = $this->CI->uri->uri_string();
        $query = $this->CI->db->get_where('bf_marketing_page_seo', array('url' => $uri_string));
        
        if($query->num_rows() == 0){
            $data = array(
                'url' => $uri_string,
                'title' => str_replace(array('_', '/'), array(' ', ' - '), $uri_string),
                'description' => "Experience the future of personal finance with MyMI Wallet. We provide advanced budgeting and investment portfolio management solutions, empowering individuals to better manage their finances. Streamline your financial journey with our intuitive online fintech application and service.",
                'image' => base_url('/assets/images/Company/MyMI-Wallet-White.png'),
            );
    
            $this->CI->db->insert('bf_marketing_page_seo', $data);
            $insert_id = $this->CI->db->insert_id();
    
            $task_info = array(
                'task' => 'Page SEO Edit',
                'title' => str_replace(array('_', '/'), array(' ', ' - '), $uri_string),
                'seo_id' => $insert_id,
                'url' => $uri_string,
            );
    
            $this->assign_marketing_task($task_info);
    
            // $html = file_get_contents(site_url($uri_string));
    
            // $dom = new DOMDocument;
            // libxml_use_internal_errors(true);
            // $dom->loadHTML($html);
            // libxml_clear_errors();
            
            // $xpath = new DOMXPath($dom);
            // $description_element = $xpath->query("//*[@id='page_seo_description']");
            // $image_element = $xpath->query("//*[@id='page_seo_image']");
    
            // if($description_element->length > 0) {
            //     $data['description'] = $description_element->item(0)->nodeValue;
            // }
            
            // if($image_element->length > 0) {
            //     $data['image'] = $image_element->item(0)->getAttribute('src');
            // }
            
            // $this->CI->db->update('bf_marketing_page_seo', $data, array('id' => $insert_id));
        }
    }
    

    public function assign_marketing_task($task_info){
        $data = array(
            'status'                                            => 'Pending', // Assuming there's a status field for tasks
            'group'                                             => 'Marketing', // Assuming tasks are assigned based on role_id
            'task'                                              => $task_info['task'],
            'title'                                             => $task_info['title'],
            'description'                                       => 'Complete SEO for ' . $task_info['url'],
            'url'                                               => site_url('/Management/Marketing/Page-SEO/' . $task_info['seo_id']),
        );
    
        $this->db->insert('bf_management_tasks', $data);
    }

    public function get_page_headers()
    {
        $getPageSEO     			            = $this->CI->marketing_model->get_marketing_page_seo();
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
}
