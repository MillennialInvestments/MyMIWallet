<?php
defined('BASEPATH') || exit('No direct script access allowed');
// Website Platform Configurations
$config['beta']						    = 0;
$config['siteOperations']               = 1;    
$config['investmentOperations']         = 1;
$config['assetOperations']              = 0;
$config['debtOperations']               = 1;
$config['educateOperations']            = 0;
$config['integrationOperations']        = 1;
$config['exchangeOperations']           = 0;
$config['marketplaceOperations']        = 0; 
$config['partnerOperations']            = 0; 
$config['referralOperations']           = 1; 
$config['website_directory'] 		    = 'Site-v7';
$config['website_version'] 			    = 'v1.7.7';
$config['date']                         = date("F jS, Y");
$config['hostTime']                     = date("g:i A");
$config['time']                         = date("g:i A", strtotime($config['hostTime']) - 60 * 60 * 5);

// Finance APIs
$config['fred_api']                     = 'fca45608ff16f51703621abcd773a598';   // Federal Reserve API
$config['gemini_auditing_key']          = 'master-VdHVHsmKw17PWryuzuwz';        // Gemini Master Auditing API Key
$config['gemini_auditing_secret']       = '2a8XaAoeqRFSREy1eTae2RA5jTJB';       // Gemini Master Auditing API Secret
$config['gemini_management_secret']     = '2a8XaAoeqRFSREy1eTae2RA5jTJB';       // Gemini Master Management API Key
$config['gemini_management_secret']     = '2a8XaAoeqRFSREy1eTae2RA5jTJB';       // Gemini Master Management API Secret
// Management - Dashboard Configurations
$config['managementActionItems']        = 'col-xxl-2 col-lg-4 pb-4';
$config['googleRecaptchaSiteKey']       = '6Ld-35olAAAAAKfXFhwLJ6RYLZuYcuVN5NLUqBTF';
$config['googleRecaptchaSecretKey']     = '6Ld-35olAAAAAHprc31OgPQCTx6N4acPz_e5i8hG';
$config['recaptcha_site_key']           = '6Ld-35olAAAAAKfXFhwLJ6RYLZuYcuVN5NLUqBTF';
$config['recaptcha_secret_key']         = '6Ld-35olAAAAAHprc31OgPQCTx6N4acPz_e5i8hG';

// Management - Web Design Configurations
$config['test_module']				    = 'Exchange';
$config['test_view_page'] 			    = 'Exchange/Stock_Chart_Manager';
$config['test_market_pair']			    = 'USD';
$config['test_market']				    = 'MYMI';

// Template Configurations
$config['communityTabs']			    = 0;
$config['exchangeTab']				    = 1;

// MyMI Gold Coin Purchases
$config['ownership_coins']			    = 57500000;
$config['minimum_purchase']			    = 5;
$config['mymig_coin_value']			    = 1;
$config['mymig_coin_available']	        = 1000000000;
$config['gas_fee']					    = 0.007457;
$config['trans_fee']				    = 0.60;
$config['trans_percent']			    = 1.058;

// MyMI Gold Bundles                
$config['tier_one']                     = 10;
$config['tier_two']                     = 25;
$config['tier_three']                   = 50;
$config['tier_four']                    = 100;
$config['tier_five']                    = 250;

// MyMI Referrals   
$config['referral_rate']                = 5; // Flat-Rate Based
$config['multiplierA']                  = .1;
$config['multiplierB']                  = .15;
$config['multiplierC']                  = .25;
// $config['multiplierA']                  = 1;
// $config['multiplierB']                  = 2;
// $config['multiplierC']                  = 4;

// $config['referral_rate']             = 10; // Percentage-Based
// Form Input Styling
$config['form_wrap'] 				    = 'form-control-wrap';
$config['form_container'] 			    = 'form-group row';
$config['form_label'] 				    = 'col-3 form-label pr-0';
$config['form_control_column'] 		    = 'col-9';
$config['form_control'] 			    = 'form-control';
$config['form_select_div']			    = 'dropdown bootstrap-select clear custom-dropdown';
$config['form_select'] 				    = 'form-select form-control form-control-lg';
$config['form_selectpicker']		    = 'form-control selectpicker';
$config['form_text']				    = 'form-text';
$config['form_custom_text']			    = 'form-text custom-form-text';

// Coin Settings
$config['wallet_cost']				    = '5';
$config['banking_integration']	   	    = '40';
$config['investment_integration']	   	= '20';
$config['tracking_integration']	   	    = '20';


// Social Media Links            
$config['facebook_page']                = 'https://www.facebook.com/MyMIWalletNews';
$config['facebook_group']               = 'https://www.facebook.com/InvestorsTalk';
$config['linkedin']                     = 'https://www.linkedin.com/MyMIWallet';
$config['twitter']                      = 'https://www.twitter.com/MyMIWallet';
$config['stocktwits']                   = 'https://www.stocktwits.com/';
$config['discord']                      = 'https://discord.gg/UUMexvA';
$config['youtube']                      = 'https://www.youtube.com/@MyMIWallet';