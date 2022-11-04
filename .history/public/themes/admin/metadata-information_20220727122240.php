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
$defaultImage 	= 'https://www.mymiwallet.com/assets/images/MyMI-Wallet-Logo-1024x1024.png';

// Get Marketing Page SEO from Database
$pageSEOData                    = $_SESSION['allSessionData']['pageSEOData']; 
print_r($pageSEOData);
if ($pageType === 'Standard') {
    foreach ($pageSEOData- as $pageInfo) {
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
}
print_r($pageSEOData);
?> 
    