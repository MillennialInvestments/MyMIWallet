<?php
// Get URI Information
$pageURIA 						= $this->uri->segment(1);
$pageURIB 						= $this->uri->segment(2);
$pageURIC 						= $this->uri->segment(3);
$pageURID 						= $this->uri->segment(4);
// Get Page Info
$pageType 						= Template::get('pageType');
$pageName 						= Template::get('pageName');

// Default Values
$defaultImage 	= 'https://www.mymiwallet.com/assets/images/Millennial-Investments.png';

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
    $page_image				= 'https://www.mymiwallet.com/assets/images/Millennial-Investments-The-Best-In-Investments-Logo.png';
        
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
	<meta property="og:image" content="' . $page_image . '" >
	<meta name="twitter:image:" content="' . $page_image . '" >
	<meta property="og:description" content="' . $page_description . '">
	<meta name="twitter:description" content="' . $page_description . '">   
	';
}
