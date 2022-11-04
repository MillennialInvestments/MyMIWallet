<?php
// Get URI Information
$pageURIA 						= $this->uri->segment(1);
$pageURIB 						    = $this->uri->segment(2);
$pageURIC 						    = $this->uri->segment(3);
$pageURID 						    = $this->uri->segment(4);
// Get Page Info
$pageType 						    = Template::get('pageType');
$pageName 						    = Template::get('pageName');

// Default Values
$defaultImage 	= 'https://www.mymiwallet.com/assets/images/MyMI-Wallet-Logo-1024x1024.png';

// Get Marketing Page SEO from Database
$pageSEOData                        = $_SESSION['allSessionData']['pageSEOData']; 
print_r()
// if ($pageType === 'Standard') {
//     foreach($pageSEOData->result_array() as $pageData) {
//         $page_title 			    = $pageData['page_title'];
//         $page_description 		    = $pageData['page_description'];
//         $page_url 				    = $pageData['page_url'];
//         $page_sitemap_url 		    = $pageData['page_sitemap_url'];
//         $page_image 			    = $pageData['page_image'];
                        
//         echo
//         '<title>' . $page_title . '</title>
//         <meta name="description" content="' . $page_description . '">
//         <meta property="fb:app_id" content="272102760777052" >
//         <meta property="og:type" content="product">
//         <meta property="og:url" content="'    . $page_url . '" >
//         <meta name="twitter:url" content="' . $page_url . '">
//         <link rel="canonical" href="'        . $page_url . '"/>
//         <meta property="og:title" content="' . $page_title . '" >
//         <meta name="twitter:title" content="' . $page_title . '" >
//         <meta property="og:image" content="' . $page_image . '" >
//         <meta name="twitter:image:" content="' . $page_image . '" >
//         <meta property="og:description" content="' . $page_description . '">
//         <meta name="twitter:description" content="' . $page_description . '">      
                    
//         ';
//         }
// }
?> 
    