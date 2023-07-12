<?php
// Get URI Information
$pageURIA 						        = $this->uri->segment(1);
$pageURIB 						        = $this->uri->segment(2);
$pageURIC 						        = $this->uri->segment(3);
$pageURID 						        = $this->uri->segment(4);
// Get Page Info
$pageType 						        = Template::get('pageType');
$pageName 						        = Template::get('pageName');
$thisController                         = $this->router->fetch_class();
$thisMethod                             = $this->router->fetch_method();
$thisURL                                = $this->uri->uri_string();
$thisFullURL                            = current_url();
if (!empty(str_replace(array('/', '-'), array('_', '_'), $thisURL))) {
    $pageTitle                          = str_replace(array('/', '-'), array(' | ', ' '), $thisURL);
} else {
    $pageTitle                          = $pageName;
}
// $pageURL                                = $this->uri->uri_string(); 
// Default Values
$siteLogo  	                            = 'https://www.mymiwallet.com/assets/images/MyMI-Wallet-Logo-1024x1024.png';
$defaultImage 	                        = base_url('/assets/images/Company/MyMI-Wallet-White.png');

// Get Marketing Page SEO from Database
// $pageSEOData                        = $_SESSION['allSessionData']['pageSEOData']->result_array(); 
$this->load->model('Management/Marketing_model'); 
$pageSEOData                        = $this->marketing_model->get_marketing_page_seo_by_name($pageName); 
if ($pageType === 'Standard') {
    foreach($pageSEOData->result_array() as $pageData) {
        $page_title 			    = $pageData['page_title'];
        $page_description 		    = $pageData['page_description'];
        $page_url 				    = $pageData['page_url'];
        $page_sitemap_url 		    = $pageData['page_sitemap_url'];
        $page_image 			    = $pageData['page_image'];
                        
        echo
        '<title>' . $page_title . '</title>
        <meta name="description" content="' . $page_description . '">
        <meta property="fb:app_id" content="272102760777052" >
        <meta property="og:type" content="product">
        <meta property="og:url" content="'    . $page_url . '" >
        <meta name="twitter:url" content="' . $page_url . '">
        <link rel="canonical" href="'        . $page_url . '"/>
        <meta property="og:title" content="' . $page_title . '" >
        <meta name="twitter:title" content="' . $page_title . '" >
        <meta name="image" property="og:image" content="' . $page_image . '" >
        <meta name="twitter:image:" content="' . $page_image . '" >
        <meta property="og:description" content="' . $page_description . '">
        <meta name="twitter:description" content="' . $page_description . '">      
                    
        ';
        }
}
// Get Marketing Page SEO from Database
if ($pageType === 'Automated') {
    $this->db->from('bf_marketing_page_seo'); 
    $this->db->where('page_name', $pageTitle); 
    $this->db->order_by('id', 'DESC'); 
    $this->db->limit(1); 
    $getPageSEOByName                   = $this->db->get(); 
    // $getPageSEOByName                   = $this->marketing_model->get_marketing_page_seo_by_name($pageTitle);
    // print_r(str_replace(array('/', '-'), array('_', '_'), $thisURL));
    // echo '<br>';
    // print_r($getPageSEOByName->result_array());
    if (empty($getPageSEOByName->result_array())) {
        $page_title 		            = $pageTitle;
        $page_description               = 'Experience the future of personal finance with MyMI Wallet. We provide advanced budgeting and investment portfolio management solutions, empowering individuals to better manage their finances. Streamline your financial journey with our intuitive online fintech application and service.';
        $page_url 			            = 'https://www.mymiwallet.com/' . $thisURL;
        $page_sitemap_url 	            = 'https://www.mymiwallet.com/' . $thisURL;
        $page_image 		            = $defaultImage;
        echo
        '<title>' . $page_title . '</title>
        <meta name="description" content="' . $page_description . '">
        <meta property="fb:app_id" content="272102760777052" >
        <meta property="og:type" content="website">
        <meta property="og:url" content="' . $page_url . '" >
        <meta name="twitter:url" content="' . $page_url . '">
        <link rel="canonical" href="' . $page_url . '"/>
        <meta property="og:title" content="' . $page_title . '" >
        <meta name="twitter:title" content="' . $page_title . '" >
        <meta name="image" property="og:image" content="' . $page_image . '" >
        <meta name="twitter:image:" content="' . $page_image . '" >
        <meta property="og:description" content="' . $page_description . '">
        <meta name="twitter:description" content="' . $page_description . '">      
                
            ';
        $thisControllerChecker          = str_replace('_', '-', $thisController);
        if ($pageURIB === $thisControllerChecker) {
            $thisController             = $pageURIA . '/' . $thisController;
        }
        if ($pageURIC === $thisControllerChecker) {
            $thisController             = $pageURIA . '/' . $pageURIB . '/' . $thisController;
        }
        if ($pageURID === $thisControllerChecker) {
            $thisController             = $pageURIA . '/' . $pageURIB . '/' . $pageURIC . '/' . $thisController;
        }
        $seoData                        = array(
            'page_name'                 => $pageTitle,
            'page_title'                => $page_title,
            'page_url'                  => $page_url,
            'page_sitemap_url'          => $page_url,
            'page_internal_url'         => $thisURL,
            'page_controller'           => $thisController,
            'page_controller_url'       => $thisController . '/' . $thisMethod,
            'page_controller_directory' => 'applications/modules/' . $thisController,
            'page_file_directory'       => 'applications/modules/' . $thisController . '/views',
        );

        $this->db->insert('bf_marketing_page_seo', $seoData);
        $insert_id                      = $this->db->insert_id();

        $this->db->from('bf_management_tasks'); 
        $this->db->where('page_id', $insert_id); 
        $checkPageStatus                = $this->db->get(); 
        // print_r($checkPageStatus->result_array());
        if (empty($checkPageStatus->result_array())) {
            $data = array(
                'status'                => 'Pending', // Assuming there's a status field for tasks
                'group'                 => 'Marketing', // Assuming tasks are assigned based on role_id
                'task'                  => 'Page SEO Edit',
                'title'                 => $page_title,
                'description'           => 'Complete SEO for ' . $page_url,
                'url'                   => $page_url,
                'page_id'               => $insert_id,
                'task_url'              => site_url('/Management/Marketing/Page-SEO/' . $insert_id),
            );
            $this->db->insert('bf_management_tasks', $data);
        }
    } else {
        foreach ($getPageSEOByName->result_array() as $pageSEO) {
            $page_title 		        = $pageSEO['page_title'];
            $page_description           = $pageSEO['page_description'];
            $page_url 			        = $pageSEO['page_url'];
            $page_sitemap_url 	        = $pageSEO['page_sitemap_url'];
            $page_image 		        = $pageSEO['page_image'];
            echo
            '<title>' . $page_title . '</title>
            <meta name="description" content="' . $page_description . '">
            <meta property="fb:app_id" content="272102760777052" >
            <meta property="og:type" content="product">
            <meta property="og:url" content="'    . $page_url . '" >
            <meta name="twitter:url" content="' . $page_url . '">
            <link rel="canonical" href="'        . $page_url . '"/>
            <meta property="og:title" content="' . $page_title . '" >
            <meta name="twitter:title" content="' . $page_title . '" >
            <meta name="image" property="og:image" content="' . $page_image . '" >
            <meta name="twitter:image:" content="' . $page_image . '" >
            <meta property="og:description" content="' . $page_description . '">
            <meta name="twitter:description" content="' . $page_description . '">      
                    
                ';
        }
    }
}
?> 
    