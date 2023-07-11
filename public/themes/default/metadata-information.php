<?php
// Get URI Information
<<<<<<< HEAD
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
// $pageTitle                              = str_replace(array('/', '-'), array(' | ', ' '), $thisURL);
// $pageURL                                = $this->uri->uri_string(); 
// Default Values
$siteLogo  	                            = 'https://www.mymiwallet.com/assets/images/MyMI-Wallet-Logo-1024x1024.png';
$defaultImage 	                        = base_url('/assets/images/Company/MyMI-Wallet-White.png');

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

if ($pageType === 'register') {
    if ($pageURIA === 'Free' or $pageURIA === 'free' and $pageURIB === 'register') {
        $page_title				        = 'Free Membership Registration | MyMI Wallet';
        $page_description 		        = 'Our Free Memberships allow our members to access Investment Accounting & Analytical Tools to optimize their trading strategies in Financial Markets and more!';
        $page_image 			        = $defaultImage;
        // $page_image 			        = 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        $page_url 				        = 'https://www.mymiwallet.com/Free/register';
        $page_sitemap_url 		        = 'https://www.mymiwallet.com/Free/register';
    } elseif ($pageURIA === 'Beta' or $pageURIA === 'beta' and $pageURIB === 'register') {
        $page_title				        = 'Beta Membership Registration | MyMI Wallet';
        $page_description 		        = 'Our Beta Memberships allow our members to access Investment Accounting & Analytical Tools to optimize their trading strategies in Financial Markets and more!';
        $page_image 			        = $defaultImage;
        // $page_image 			        = 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        $page_url 				        = 'https://www.mymiwallet.com/Beta/register';
        $page_sitemap_url 		        = 'https://www.mymiwallet.com/Beta/register';
    } elseif ($pageURIA === 'Partner' or $pageURIA === 'partner' and $pageURIB === 'register') {
        $page_title				        = 'MyMI Partnership Registration | MyMI Wallet';
        $page_description 		        = 'Register your MyMI Partnership Account to access our community of investment & trading leaders and collaborators to assist each other in growing together!';
        $page_image 			        = $defaultImage;
        // $page_image 			        = 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        $page_url 				        = 'https://www.mymiwallet.com/Premium/register';
        $page_sitemap_url 		        = 'https://www.mymiwallet.com/Premium/register';
    } elseif ($pageURIA === 'Investor' and $pageURIB === 'register') {
        $page_title				        = 'MyMI Investor Registration | MyMI Wallet';
        $page_description 		        = 'Register your MyMI Investor Account to access our community of investors and news regarding upcoming events in the MyMI Investment Platforms!';
        $page_image 			        = $defaultImage;
        // $page_image 			        = 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        $page_url 				        = 'https://www.mymiwallet.com/Investor/register';
        $page_sitemap_url 		        = 'https://www.mymiwallet.com/Investor/register';
    } else {
        $page_title				        = 'Investor Membership Registration | MyMI Wallet';
        $page_description 		        = 'Our Investor Memberships allow our members to access Investment Accounting & Analytical Tools to optimize their trading strategies in Financial Markets and more!';
        $page_image 			        = $defaultImage;
        // $page_image 			        = 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        $page_url 				        = 'https://www.mymiwallet.com/Free/register';
        $page_sitemap_url 		        = 'https://www.mymiwallet.com/Free/register';
=======
$pageURIA 						= $this->uri->segment(1);
$pageURIB 						= $this->uri->segment(2);
$pageURIC 						= $this->uri->segment(3);
$pageURID 						= $this->uri->segment(4);
// Get Page Info
$pageType 						= Template::get('pageType');
$pageName 						= Template::get('pageName');

// Default Values
$defaultImage 	= 'https://www.mymiwallet.com/assets/images/MyMI-Wallet-Logo-1024x1024.png';

// Get Marketing Page SEO from Database
$getPageInfo 					= $this->public_model->get_marketing_seo($pageName);
if ($pageType === 'Standard') {
    foreach ($getPageInfo->result_array() as $pageInfo) {
        $page_title 			= $pageInfo['page_title'];
        $page_description 		= $pageInfo['page_description'];
        $page_url 				= $pageInfo['page_url'];
        $page_sitemap_url 		= $pageInfo['page_sitemap_url'];
        $page_image 			= $pageInfo['page_image'];
        
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
	<meta property="og:image" content="' . $page_image . '" >
	<meta name="twitter:image:" content="' . $page_image . '" >
	<meta property="og:description" content="' . $page_description . '">
	<meta name="twitter:description" content="' . $page_description . '">      
			
		';
    };
} elseif ($pageType === 'Release') { 
    $page_title 			= $pageURIB . ' Release - ' . $pageURIC . ' | Releases | MyMI Wallet';
    $page_description 		= 'View more details and in-depth information regarding our most recent ' . $pageURIC . ' Beta Release at MyMI Wallet';
    $page_url 				= site_url($this->uri->uri_string());
    $page_sitemap_url 		= $page_url;
    $page_image 			= $defaultImage;
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
<meta property="og:image" content="' . $page_image . '" >
<meta name="twitter:image:" content="' . $page_image . '" >
<meta property="og:description" content="' . $page_description . '">
<meta name="twitter:description" content="' . $page_description . '">      
        
    ';
} elseif ($pageType === 'Search') {
    $page_title 				= 'Search ' . $pageURIC . ' | MyMI Wallet';
    $page_description 			= 'Search for ' . $pageURIC . ' and discover technical analysis and fundamental information to discover your next potential investment';
    $page_url 					= 'https://www.mymiwallet.com/Tools/Search/' . $pageURIC;
    $page_sitemap_url 			= 'https://www.mymiwallet.com/Tools/Search/' . $pageURIC;
    $page_image 				= $defaultImage;
    
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
	<meta property="og:image" content="' . $page_image . '" >
	<meta name="twitter:image:" content="' . $page_image . '" >
	<meta property="og:description" content="' . $page_description . '">
	<meta name="twitter:description" content="' . $page_description . '">   ';
} elseif ($pageType === 'Screener') {
    $page_title 				= $pageURIC . ' Screener | MyMI Wallet';
    $page_description 			= $pageURIC . ' Screener | Search for stocks and discover technical analysis and fundamental information to discover your next potential investment';
    $page_url 					= 'https://www.mymiwallet.com/Tools/Screener/' . $pageURIC;
    $page_sitemap_url 			= 'https://www.mymiwallet.com/Tools/Screener/' . $pageURIC;
    $page_image 				= $defaultImage;
    
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
	<meta property="og:image" content="' . $page_image . '" >
	<meta name="twitter:image:" content="' . $page_image . '" >
	<meta property="og:description" content="' . $page_description . '">
	<meta name="twitter:description" content="' . $page_description . '">   ';
} elseif ($pageType === 'Purchase_Memberships') {
    $ftSegmentB = $this->uri->segment(1);
    if ($ftSegmentB === 'Memberships') {
        $page_title 			= 'Premium Memberships | $69/Month | MyMI Wallet';
        $page_description 		= 'Discover the investing resources and tools we can provide to improve your daily investment profits at MyMI Wallet';
        $page_url 	= 'https://www.mymiwallet.com/Memberships/Premium';
          
        $page_image 			= $defaultImage;

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
		<meta property="og:image" content="' . $page_image . '" >
		<meta name="twitter:image:" content="' . $page_image . '" >
		<meta property="og:description" content="' . $page_description . '">
		<meta name="twitter:description" content="' . $page_description . '">     
			
		';
    }
    $ftSegmentB = $this->uri->segment(2);
    if ($ftSegmentB === 'Premium') {
        $page_title 			= 'Premium Memberships | $69/Month | MyMI Wallet';
        $page_description 		= 'Discover the investing resources and tools we can provide to improve your daily investment profits at MyMI Wallet';
        $page_url 	= 'https://www.mymiwallet.com/Memberships/Premium';
          
        $page_image 			= $defaultImage;

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
		<meta property="og:image" content="' . $page_image . '" >
		<meta name="twitter:image:" content="' . $page_image . '" >
		<meta property="og:description" content="' . $page_description . '">
		<meta name="twitter:description" content="' . $page_description . '">     
			
		';
    }
} elseif ($pageType === 'Memberships') {
    $page_title 			= 'Investor Memberships | MyMI Wallet';
    $page_description 		= 'Investor Memberships | Discover the investing resources and tools we can provide to improve your daily investment profits at MyMI Wallet';
    $page_url 				= 'https://www.mymiwallet.com/Memberships';
    $page_image				= 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        
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
	<meta property="og:image" content="' . $page_image . '" >
	<meta name="twitter:image:" content="' . $page_image . '" >
	<meta property="og:description" content="' . $page_description . '">
	<meta name="twitter:description" content="' . $page_description . '">   
			
		';
} elseif ($pageType === 'Customer_Support') {
    $page_title 			= 'Customer Support Center | MyMI Wallet';
    $page_description 		= 'Customer Support Center | Get assistance and support to better utilize our trading alert system and optimize your return on investments.';
    $page_url 				= 'https://www.mymiwallet.com/Customer-Support';
    $page_image				= 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
    
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
	<meta property="og:image" content="' . $page_image . '" >
	<meta name="twitter:image:" content="' . $page_image . '" >
	<meta property="og:description" content="' . $page_description . '">
	<meta name="twitter:description" content="' . $page_description . '">   ';
} elseif ($pageType === 'ETF') {
    $symbol = $this->uri->segment(3);
    $getSymbolHeader			= $this->public_model->get_symbol_header($symbol);
    
    foreach ($getPageInfo->result_array() as $pageInfo) {
        $market					= $pageInfo['market'];
        $symbol					= $pageInfo['symbol'];
        $company				= $pageInfo['company'];
        
        $page_title				= $company . ' (' . $symbol . ') | Stock Quotes, Historical Charts & Company News';
        $page_description 		= 'Discover ' . $company . ' (' . $symbol . ') real-time trading data, historical charts, latest news, and trends from the newest community of investors and traders.';
        $page_url				= 'https://www.mymiwallet.com/Stock/' . $market . '/' . $symbol;
        $page_sitemap_url		= $page_url;
        $page_image				= 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        
        
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
	<meta property="og:image" content="' . $page_image . '" >
	<meta name="twitter:image:" content="' . $page_image . '" >
	<meta property="og:description" content="' . $page_description . '">
	<meta name="twitter:description" content="' . $page_description . '">    
			
		';
    };
} elseif ($pageType === 'Stock') {
    $symbol = $this->uri->segment(3);
    $this->db->from('bf_investment_stock_listing');
    $this->db->where('symbol', $symbol);
    $this->db->cache_on();
    $getPageInfo = $this->db->get();
    
    foreach ($getPageInfo->result_array() as $pageInfo) {
        $market					= $pageInfo['market'];
        $symbol					= $pageInfo['symbol'];
        $company				= $pageInfo['company'];
        
        $page_title				= $company . ' (' . $symbol . ') | Stock Quotes, Historical Charts & Company News';
        $page_description 		= 'Discover ' . $company . ' (' . $symbol . ') real-time trading data, historical charts, latest news, and trends from the newest community of investors and traders.';
        $page_url				= 'https://www.mymiwallet.com/Stock/' . $market . '/' . $symbol;
        $page_sitemap_url		= $page_url;
        $page_image				= 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        
        
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
	<meta property="og:image" content="' . $page_image . '" >
	<meta name="twitter:image:" content="' . $page_image . '" >
	<meta property="og:description" content="' . $page_description . '">
	<meta name="twitter:description" content="' . $page_description . '">   
			
		';
    };
    $this->db->from('bf_investment_chart_analysis');
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $this->db->where('symbol', $symbol);
    $getChartInfo = $this->db->get();
    
    foreach ($getChartInfo->result_array() as $chartInfo) {
        if ($chartInfo['url_link'] !== null) {
            echo '
			<meta property="og:image" content="' . $chartInfo['url_link'] . '" >
			<meta name="twitter:image:" content="' . $chartInfo['url_link'] . '" >
			';
        } else {
            echo '
				<meta property="og:image" content="' . $page_image . '" >
				<meta name="twitter:image:" content="' . $page_image . '" >
			';
        }
    }
} elseif ($pageType === 'Blog') {
    $this->db->from('bf_marketing_page_seo_blog');
    $this->db->where('page_name', $pageName);
    $getPageInfo = $this->db->get();
    
    foreach ($getPageInfo->result_array() as $pageInfo) {
        $page_title 			= $pageInfo['page_title'];
        $page_description 		= $pageInfo['page_description'];
        $page_url 				= $pageInfo['page_url'];
        $page_sitemap_url 		= $pageInfo['page_sitemap_url'];
        $page_image 			= $pageInfo['page_image'];
        
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
	<meta property="og:image" content="' . $page_image . '" >
	<meta name="twitter:image:" content="' . $page_image . '" >
	<meta property="og:description" content="' . $page_description . '">
	<meta name="twitter:description" content="' . $page_description . '">    		
		';
    };
} elseif ($pageType === 'Activate') {
}
if ($pageType === 'register') {
    if ($pageURIA === 'Free' or $pageURIA === 'free' and $pageURIB === 'register') {
        $page_title				= 'Free Membership Registration | MyMI Wallet';
        $page_description 		= 'Our Free Memberships allow our members to access Investment Accounting & Analytical Tools to optimize their trading strategies in Financial Markets and more!';
        $page_image 			= 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        $page_url 				= 'https://www.mymiwallet.com/Free/register';
        $page_sitemap_url 		= 'https://www.mymiwallet.com/Free/register';
    } elseif ($pageURIA === 'Beta' or $pageURIA === 'beta' and $pageURIB === 'register') {
        $page_title				= 'Beta Membership Registration | MyMI Wallet';
        $page_description 		= 'Our Beta Memberships allow our members to access Investment Accounting & Analytical Tools to optimize their trading strategies in Financial Markets and more!';
        $page_image 			= 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        $page_url 				= 'https://www.mymiwallet.com/Beta/register';
        $page_sitemap_url 		= 'https://www.mymiwallet.com/Beta/register';
    } elseif ($pageURIA === 'Partner' or $pageURIA === 'partner' and $pageURIB === 'register') {
        $page_title				= 'MyMI Partnership Registration | MyMI Wallet';
        $page_description 		= 'Register your MyMI Partnership Account to access our community of investment & trading leaders and collaborators to assist each other in growing together!';
        $page_image 			= 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        $page_url 				= 'https://www.mymiwallet.com/Premium/register';
        $page_sitemap_url 		= 'https://www.mymiwallet.com/Premium/register';
    } elseif ($pageURIA === 'Investor' and $pageURIB === 'register') {
        $page_title				= 'MyMI Investor Registration | MyMI Wallet';
        $page_description 		= 'Register your MyMI Investor Account to access our community of investors and news regarding upcoming events in the MyMI Investment Platforms!';
        $page_image 			= 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        $page_url 				= 'https://www.mymiwallet.com/Investor/register';
        $page_sitemap_url 		= 'https://www.mymiwallet.com/Investor/register';
    } else {
        $page_title				= 'Investor Membership Registration | MyMI Wallet';
        $page_description 		= 'Our Investor Memberships allow our members to access Investment Accounting & Analytical Tools to optimize their trading strategies in Financial Markets and more!';
        $page_image 			= 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';
        $page_url 				= 'https://www.mymiwallet.com/Free/register';
        $page_sitemap_url 		= 'https://www.mymiwallet.com/Free/register';
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    };
        
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
<<<<<<< HEAD
	<meta name="image" property="og:image" content="' . $page_image . '" >
=======
	<meta property="og:image" content="' . $page_image . '" >
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
	<meta name="twitter:image:" content="' . $page_image . '" >
	<meta property="og:description" content="' . $page_description . '">
	<meta name="twitter:description" content="' . $page_description . '">   
	';
}
