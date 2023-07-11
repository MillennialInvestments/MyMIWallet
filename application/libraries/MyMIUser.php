<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIUser
{
    private $cuID;
    private $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
<<<<<<< HEAD
        $this->CI->load->library(array('MyMICoin', 'MyMIGold', 'MyMIWallet', 'session', 'settings/settings_lib', 'Template'));
=======
        $this->CI->load->library(array('Auth', 'MyMICoin', 'MyMIGold', 'MyMIWallet', 'session', 'settings/settings_lib', 'Template'));
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        $this->CI->load->model(array('User/exchange_model', 'User/investor_model', 'User/tracker_model', 'User/wallet_model'));
        $this->CI->load->library('users/auth');
        $cuID 								= $this->CI->auth->user_id();
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
    }
    /**
     * User Default Information.
     *
     * Provides front-end functions for users, including access to login and logout.
     *
     * @package applications\library\MyMIWallet\Controllers\Users
     * User Information                         = $this->get_user_information($cuID);
     * User Default Wallet                      = $this->get_user_default_wallet($cuID);
     */
<<<<<<< HEAD
    public function default_user_account_info() {
        if (!empty($_SESSION['user_id'])) {
            $cuID                           = $_SESSION['user_id']; 
        } else {
            if (!empty($this->CI->user_id())) {
                $cuID                       = $this->CI->auth->user_id(); 
            } elseif (!empty($this->CI->input->ip_address())) {
                $cuID                       = $this->CI->input->ip_address();
            } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $cuID                       = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $cuID                       = $_SERVER['HTTP_X_FORWARDED_FOR']; 
            } elseif (!empty($_SERVER['REMOTE_ADDR'])) { 
                $cuID                       = $_SERVER['REMOTE_ADDR'];
            }
            
        }

        if (isset($_POST['timezoneOffset'])) {
            $timezoneOffset = intval($_POST['timezoneOffset']);
            
            // Calculate the user's timezone in hours
            $timezone = $timezoneOffset / -60;
            
            // Create a timezone string like "UTC+2" or "UTC-5"
            $timezoneStr = 'UTC' . ($timezone >= 0 ? '+' : '') . $timezone;
            
            // Set the default timezone
            date_default_timezone_set($timezoneStr);

            // Store the user's timezone in session data for future use
            $this->session->set_userdata('user_timezone', $timezoneStr);

            echo '<script>console.log("Timezone set to ' . $timezoneStr . '"); </script>';
        } else {
            $timezoneStr                    = 'ERROR: Could not set Timezone String';
            echo '<script>console.log("Error: Timezone offset not received"); </script>';
        }
        $_SESSION['cuID']                   = $cuID;
        $_SESSION['timezoneStr']            = $timezoneStr;

        $defaultAccountArray                = array(
            'message'                       => $message,
            'cuID'                          => $cuID, 
            'timezoneStr'                   => $timezoneStr,
        );

        return $defaultAccountArray; 
    }

    public function user_account_info($cuID)
    {
        if (empty($cuID)) {
            $cuID 						    = $this->CI->auth->user_id();
        } else {
            $cuID 						    = $cuID;
        }
=======
    public function user_account_info($cuID)
    {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        $userInfo                           = $this->get_user_information($cuID);
        $cuEmail                            = $userInfo['cuEmail'];
        $userExchangeInfo					= $this->get_user_exchange_info($cuID);
        $userDefaultWallet                  = $this->get_user_default_wallet_for_existing($cuID);
        $userAssetSummary                   = $this->get_user_asset_summary($cuID);
<<<<<<< HEAD
        $userSocialInfo                     = $this->get_user_social_info($cuID);
        if (!empty($userInfo['cuFirstName'])) {
            $cuDisplayName                  = $userInfo['cuFirstName'] . ' ' . strtoupper(substr($userInfo['cuLastName'], 0, 1)) . '.';
        } else {
            $cuDisplayName                  = $userInfo['cuUsername'];
        }
=======
        $userSocialInfo                     = $this->get_user_social_info($cuEmail);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        $userAccount	                    = array(
            'cuID'                       	=> $cuID,
            'cuRole'                        => $userInfo['cuRole'],
            'cuPartner'                     => $userInfo['cuPartner'],
            'cuReferrer'                    => $userInfo['cuReferrer'],
            'cuUserType'                    => $userInfo['cuUserType'],
            'cuEmail'                       => $userInfo['cuEmail'],
            'cuUsername'                    => $userInfo['cuUsername'],
<<<<<<< HEAD
            'cuDisplayName'                 => $cuDisplayName,
=======
            'cuDisplayName'                 => $userInfo['cuUsername'],
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            'cuFirstName'                 	=> $userInfo['cuFirstName'],
            'cuMiddleName'                 	=> $userInfo['cuMiddleName'],
            'cuLastName'                 	=> $userInfo['cuLastName'],
            'cuNameSuffix'                	=> $userInfo['cuNameSuffix'],
            'cuKYC'                			=> $userInfo['cuKYC'],
            'cuKYCVerified'                 => $userInfo['cuKYCVerified'],
<<<<<<< HEAD
            'cuDOB'                 		=> $userInfo['cuDOB'],
            'cuSSN'                         => $userInfo['cuSSN'], 
=======
            // 'cuDOB'                 		=> $userInfo['cuDOB'],
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            'cuPhone'                 		=> $userInfo['cuPhone'],
            'cuCompany'                		=> $userInfo['cuCompany'],
            'cuAddress'                 	=> $userInfo['cuAddress'],
            'cuCity'                 		=> $userInfo['cuCity'],
            'cuState'                 		=> $userInfo['cuState'],
            'cuCountry'                 	=> $userInfo['cuCountry'],
            'cuZipCode'                 	=> $userInfo['cuZipCode'],
<<<<<<< HEAD
            'cuMailingAddress'              => $userInfo['cuMailingAddress'],
            'cuEmployment'                  => $userInfo['cuEmployment'],
            'cuOccupation'                  => $userInfo['cuOccupation'],
            'cuSalary'                      => $userInfo['cuSalary'],
            'cuProofIdentity'               => $userInfo['cuProofIdentity'],
            'cuProofAddress'                => $userInfo['cuProofAddress'],
            'cuUserType'                    => $userInfo['cuUserType'],
            'cuWalletID'                    => $userInfo['cuWalletID'],
            'cuPublicKey'                   => $userInfo['cuPublicKey'],
            'cuPrivateKey'                  => $userInfo['cuPrivateKey'],
            'walletID'                      => $userInfo['walletID'],
            'cuSignupDate'                  => $userInfo['cuSignupDate'],
            'cuLastLogin'                   => $userInfo['cuLastLogin'],
=======
            'cuUserType'                    => $userInfo['cuUserType'],
            'cuWalletID'                    => $userInfo['cuWalletID'],
            'walletID'                      => $userInfo['walletID'],
            'cuRealizeID'                   => $userInfo['cuRealizeID'],
            'cuSignupDate'                  => $userInfo['cuSignupDate'],
            'cuLastLogin'                   => $userInfo['cuLastLogin'],
            'cuAdvertisement'               => $userInfo['cuAdvertisement'],
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            'cuReferrerCode'                => $userInfo['cuReferrerCode'],
            'cuWalletCount'                 => $userDefaultWallet['cuWalletCount'],
            'cuTotalWalletCount'            => $userDefaultWallet['cuTotalWalletCount'],
            'lastTradeActivity'             => $userDefaultWallet['lastTradeActivity'],
            'depositActivity'               => $userDefaultWallet['depositActivity'],
            'withdrawActivity'              => $userDefaultWallet['withdrawActivity'],
            'walletID'                      => $userDefaultWallet['walletID'],
            'walletTitle'                   => $userDefaultWallet['walletTitle'],
            'walletBroker'                  => $userDefaultWallet['walletBroker'],
            'walletNickname'                => $userDefaultWallet['walletNickname'],
            'walletDefault'                 => $userDefaultWallet['walletDefault'],
            'walletExchange'                => $userDefaultWallet['walletExchange'],
            'walletMarketPair'              => $userDefaultWallet['walletMarketPair'],
            'walletMarket'                  => $userDefaultWallet['walletMarket'],
            'walletFunds'                   => $userDefaultWallet['walletFunds'],
            'walletInitialAmount'           => $userDefaultWallet['walletInitialAmount'],
            'walletAmount'                  => $userDefaultWallet['walletAmount'],
            'walletPercentChange'           => $userDefaultWallet['walletPercentChange'],
            'walletGains'                   => $userDefaultWallet['walletGains'],
            'depositAmount'                 => $userDefaultWallet['depositAmount'],
            'withdrawAmount'                => $userDefaultWallet['withdrawAmount'],
            'walletDepositAmount'           => $userDefaultWallet['walletDepositAmount'],
            'walletWithdrawAmount'          => $userDefaultWallet['walletWithdrawAmount'],
            'MyMICoinValue'                 => $userDefaultWallet['MyMICoinValue'],
            'MyMICCurrentValue'             => $userDefaultWallet['MyMICCurrentValue'],
            'MyMICCoinSum'                  => $userDefaultWallet['MyMICCoinSum'],
            'coinsExchanged'                => $userDefaultWallet['coinsExchanged'],
            'MyMIGoldValue'                 => $userDefaultWallet['MyMIGoldValue'],
            'MyMIGCurrentValue'             => $userDefaultWallet['MyMIGCurrentValue'],
            'MyMIGCoinSum'                  => $userDefaultWallet['MyMIGCoinSum'],
            'getWallets'					=> $userDefaultWallet['getWallets'],
            'assetTotalCount'               => $userAssetSummary['assetTotalCount'],
            'assetNetValue'                 => $userAssetSummary['assetNetValue'],
            'assetTotalGains'               => $userAssetSummary['assetTotalGains'],
            'open_listing_app'				=> $userExchangeInfo['open_listing_app'],
<<<<<<< HEAD
            // 'cuCoverart'                    => $userSocialInfo['cuCoverart'],
            // 'cuProfilePic'                  => $userSocialInfo['cuProfilePic'],
            // 'cuFollowers'                   => $userSocialInfo['cuFollowers'],
            // 'cuViews'                       => $userSocialInfo['cuViews'],
            // 'cuWebsite'                     => $userSocialInfo['cuWebsite'],
            // 'cuFacebook'                    => $userSocialInfo['cuFacebook'],
            // 'cuTwitter'                     => $userSocialInfo['cuTwitter'],
            // 'cuStocktwits'                  => $userSocialInfo['cuStocktwits'],
            // 'cuYoutube'                     => $userSocialInfo['cuYoutube'],
            // 'cuDiscord'                     => $userSocialInfo['cuDiscord'],
=======
            'cuCoverart'                    => $userSocialInfo['cuCoverart'],
            'cuProfilePic'                  => $userSocialInfo['cuProfilePic'],
            'cuFollowers'                   => $userSocialInfo['cuFollowers'],
            'cuViews'                       => $userSocialInfo['cuViews'],
            'cuWebsite'                     => $userSocialInfo['cuWebsite'],
            'cuFacebook'                    => $userSocialInfo['cuFacebook'],
            'cuTwitter'                     => $userSocialInfo['cuTwitter'],
            'cuStocktwits'                  => $userSocialInfo['cuStocktwits'],
            'cuYoutube'                     => $userSocialInfo['cuYoutube'],
            'cuDiscord'                     => $userSocialInfo['cuDiscord'],
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        );
        
        return $userAccount;
    }
        
    public function get_user_information($cuID)
    {
<<<<<<< HEAD
        if (empty($cuID)) {
            $cuID 						    = $this->auth->user_id();
        } else {
            $cuID 						    = $cuID;
        }
        $getUserData                        = $this->CI->investor_model->get_user_data($cuID);
        $getDefaultWallet                   = $this->CI->investor_model->get_user_default_wallet_id($cuID);
        // if (empty($getUserData->result_array())) {
        //     echo '<script>console.log("Investor Model not working");</script>';
        //     $this->CI->db->from('bf_users');
        //     $this->CI->db->where('id', $cuID);
        //     $getDirectUserData			    = $this->CI->db->get();
        //     echo '<script>console.log("Option #1: Using Direct Database Connection to acquire User Information");</script>';
        //     foreach ($getDirectUserData->result_array() as $userData) {
        //         $cuRole                     = $userData['role_id'];
        //         $cuEmail                    = $userData['email'];
        //         $cuUsername                 = $userData['username'];
        //         $cuDisplayName              = $userData['display_name'];
        //         $cuFirstName			    = $userData['first_name'];
        //         $cuMiddleName			    = $userData['middle_name'];
        //         $cuLastName				    = $userData['last_name'];
        //         $cuNameSuffix			    = $userData['name_suffix'];
        //         $cuPartner  			    = $userData['partner'];
        //         $cuReferrer  			    = $userData['referrer'];
        //         $cuKYC					    = $userData['kyc'];
        //         $cuKYCVerified			    = $userData['kyc_verified'];
        //         // $cuDOB						    = $userData['dob'];
        //         $cuPhone				    = $userData['phone'];
        //         $cuCompany				    = $userData['organization'];
        //         $cuAddress				    = $userData['address'];
        //         $cuCity					    = $userData['city'];
        //         $cuState				    = $userData['state'];
        //         $cuCountry				    = $userData['country'];
        //         $cuZipCode				    = $userData['zipcode'];
        //         $cuUserType                 = $userData['type'];
        //         $cuWalletID                 = $userData['wallet_id'];
        //         $cuRealizeID                = $userData['realize_id'];
        //         $cuSignupDate               = $userData['signup_date']; 
        //         $cuLastLogin                = $userData['last_login']; 
        //         $cuAdvertisement            = $userData['advertisement']; 
        //         $cuReferrerCode             = $userData['referrer_code'];
        //     };
        //     foreach ($getDefaultWallet->result_array() as $defaultWallet) {
        //         $walletID                       = $defaultWallet['id'];
        //     }
        // } else {
        //     echo '<script>console.log("Option #2: Using Investor Model to acquire User Information");</script>';
        //     echo '<script>console.log("Option #2: User ID - ' . $cuID . '");</script>';
        //     echo '<script>console.log("' . $getUserData->result_array() . '");</script>';
        //     foreach ($getUserData->result_array() as $userData) {
        //         $cuRole                     = $userData['role_id'];
        //         $cuEmail                    = $userData['email'];
        //         $cuUsername                 = $userData['username'];
        //         $cuDisplayName              = $userData['display_name'];
        //         $cuFirstName			    = $userData['first_name'];
        //         $cuMiddleName			    = $userData['middle_name'];
        //         $cuLastName			        = $userData['last_name'];
        //         $cuNameSuffix			    = $userData['name_suffix'];
        //         $cuPartner  			    = $userData['partner'];
        //         $cuReferrer  			    = $userData['referrer'];
        //         $cuKYC					    = $userData['kyc'];
        //         $cuKYCVerified			    = $userData['kyc_verified'];
        //         // $cuDOB						    = $userData['dob'];
        //         $cuPhone				    = $userData['phone'];
        //         $cuCompany				    = $userData['organization'];
        //         $cuAddress				    = $userData['address'];
        //         $cuCity					    = $userData['city'];
        //         $cuState			        = $userData['state'];
        //         $cuCountry				    = $userData['country'];
        //         $cuZipCode				    = $userData['zipcode'];
        //         $cuUserType                 = $userData['type'];
        //         $cuWalletID                 = $userData['wallet_id'];
        //         $cuRealizeID                = $userData['realize_id'];
        //         $cuSignupDate               = $userData['signup_date']; 
        //         $cuLastLogin                = $userData['last_login']; 
        //         $cuAdvertisement            = $userData['advertisement']; 
        //         $cuReferrerCode             = $userData['referrer_code'];
        //     };
        //     foreach ($getDefaultWallet->result_array() as $defaultWallet) {
        //         $walletID                       = $defaultWallet['id'];
        //     }
        // }
        
        echo '<script>console.log("Investor Model not working");</script>';
        $this->CI->db->from('bf_users');
        $this->CI->db->where('id', $cuID);
        $getDirectUserData			        = $this->CI->db->get();
        echo '<script>console.log("Option #1: Using Direct Database Connection to acquire User Information");</script>';
        foreach ($getDirectUserData->result_array() as $userData) {
=======
        $getUserData                        = $this->CI->investor_model->get_user_data($cuID);
        foreach ($getUserData->result_array() as $userData) {
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
            $cuRole                         = $userData['role_id'];
            $cuEmail                        = $userData['email'];
            $cuUsername                     = $userData['username'];
            $cuDisplayName                  = $userData['display_name'];
<<<<<<< HEAD
            $cuFirstName			        = $userData['first_name'];
            $cuMiddleName			        = $userData['middle_name'];
            $cuLastName				        = $userData['last_name'];
            $cuNameSuffix			        = $userData['name_suffix'];
            $cuPartner  			        = $userData['partner'];
            $cuReferrer  			        = $userData['referrer'];
            $cuKYC					        = $userData['kyc'];
            $cuKYCVerified			        = $userData['kyc_verified'];
            $cuDOB						    = $userData['dob'];
            $cuSSN                          = $userData['ssn']; 
            $cuPhone				        = $userData['phone'];
            $cuCompany				        = $userData['organization'];
            $cuAddress				        = $userData['address'];
            $cuCity					        = $userData['city'];
            $cuState				        = $userData['state'];
            $cuCountry				        = $userData['country'];
            $cuZipCode				        = $userData['zipcode'];
            $cuMailingAddress               = $userData['mailing_address']; 
            $cuEmployment                   = $userData['employment'];
            $cuOccupation                   = $userData['occupation']; 
            $cuSalary                       = $userData['salary']; 
            $cuProofIdentity                = $userData['proof_identity'];
            $cuProofAddress                 = $userData['proof_address'];
            $cuUserType                     = $userData['type'];
            $cuWalletID                     = $userData['wallet_id'];
            $cuPublicKey                    = $userData['wallet_id'];
            $cuPrivateKey                   = $userData['private_key'];
            $cuSignupDate                   = $userData['signup_date']; 
            $cuLastLogin                    = $userData['last_login'];  
            $cuReferrerCode                 = $userData['referrer_code'];
            foreach ($getDefaultWallet->result_array() as $defaultWallet) {
                $walletID                   = $defaultWallet['id'];
            }
            $userInfo                       = array(
                'cuID'                      => $cuID,
                'cuRole'                    => $cuRole,
                'cuEmail'                   => $cuEmail,
                'cuUsername'                => $cuUsername,
                'cuDisplayName'             => $cuDisplayName,
                'cuFirstName'               => $cuFirstName,
                'cuMiddleName'              => $cuMiddleName,
                'cuLastName'                => $cuLastName,
                'cuNameSuffix'              => $cuNameSuffix,
                'cuPartner'                 => $cuPartner,
                'cuReferrer'                => $cuReferrer,
                'cuKYC'                	    => $cuKYC,
                'cuKYCVerified'             => $cuKYCVerified,
                'cuDOB'                     => $cuDOB,
                'cuSSN'                     => $cuSSN,
                'cuPhone'                   => $cuPhone,
                'cuCompany'                 => $cuCompany,
                'cuAddress'                 => $cuAddress,
                'cuCity'                    => $cuCity,
                'cuState'                   => $cuState,
                'cuCountry'                 => $cuCountry,
                'cuZipCode'                 => $cuZipCode,
                'cuMailingAddress'          => $cuMailingAddress,
                'cuEmployment'              => $cuEmployment,
                'cuOccupation'              => $cuOccupation,
                'cuSalary'                  => $cuSalary,
                'cuProofIdentity'           => $cuProofIdentity,
                'cuProofAddress'            => $cuProofAddress,
                'cuUserType'                => $cuUserType,
                'cuWalletID'                => $cuWalletID,
                'walletID'                  => $cuWalletID,
                'cuPublicKey'               => $cuPublicKey,
                'cuPrivateKey'              => $cuPrivateKey,
                'cuSignupDate'              => $cuSignupDate,
                'cuLastLogin'               => $cuLastLogin,
                'cuReferrerCode'            => $cuReferrerCode,
            );
            return $userInfo;
        };
    }

    public function get_user_financial_assessment($cuID) {
        $getUserFinancialAssessment         = $this->CI->investor_model->get_user_data($cuID); 
        // $getUserFinancialAssessment         = $this->CI->investor_model->get_user_financial_assessment($cuID); 
        foreach($getUserFinancialAssessment->result_array() as $financialAssessment) {
            $account_activated              = $financialAssessment['active']; 
            $account_information            = $financialAssessment['account_information']; 
            $kyc_verified                   = $financialAssessment['kyc_verified']; 
            $features_activated             = $financialAssessment['features_activated']; 
            $banking_accounts               = $financialAssessment['banking_accounts']; 
            $banking_wallets                = $financialAssessment['banking_wallets'];
            $last_banking_update            = $financialAssessment['last_banking_update'];
            $banking_integration            = $financialAssessment['banking_integration'];
            $credit_summary                 = $financialAssessment['credit_summary'];
            $credit_wallets                 = $financialAssessment['credit_wallets'];
            $last_credit_update             = $financialAssessment['last_credit_update'];
            $credit_integration             = $financialAssessment['credit_integration'];
            $debt_summary                   = $financialAssessment['debt_summary'];
            $debt_wallets                   = $financialAssessment['debt_wallets'];
            $last_debt_update               = $financialAssessment['last_debt_update'];
            $debt_integration               = $financialAssessment['debt_integration'];
            $investment_wallets             = $financialAssessment['investment_wallets'];
            $last_investment_update         = $financialAssessment['last_investment_update'];
            $brokerage_integration          = $financialAssessment['brokerage_integration'];
            $financial_goals                = $financialAssessment['financial_goals'];
            $time_horizon                   = $financialAssessment['time_horizon'];
            $financial_rating               = $financialAssessment['financial_rating'];
            $investment_experience          = $financialAssessment['investment_experience'];
            $investment_knowledge           = $financialAssessment['investment_knowledge'];
            $market_sentiment               = $financialAssessment['market_sentiment'];
            $investment_availability        = $financialAssessment['investment_availability'];

            $userAssessment = array(
                'account_activated'         => $account_activated,
                'account_information'       => $account_information,
                'kyc_verified'              => $kyc_verified,
                'features_activated'        => $features_activated,
                'banking_accounts'          => $banking_accounts,
                'banking_wallets'           => $banking_wallets,
                'last_banking_update'       => $last_banking_update,
                'banking_integration'       => $banking_integration,
                'credit_summary'            => $credit_summary,
                'credit_wallets'            => $credit_wallets,
                'last_credit_update'        => $last_credit_update,
                'credit_integration'        => $credit_integration,
                'debt_summary'              => $debt_summary,
                'debt_wallets'              => $debt_wallets,
                'last_debt_update'          => $last_debt_update,
                'debt_integration'          => $debt_integration,
                'investment_wallets'        => $investment_wallets,
                'last_investment_update'    => $last_investment_update,
                'brokerage_integration'     => $brokerage_integration,
                'financial_goals'           => $financial_goals,
                'time_horizon'              => $time_horizon,
                'financial_rating'          => $financial_rating,
                'investment_experience'     => $investment_experience,
                'investment_knowledge'      => $investment_knowledge,
                'market_sentiment'          => $market_sentiment,
                'investment_availability'   => $investment_availability
            );
            
            // Assign $userAssessment to $_SESSION['allSession']['userAssessment']
            return $userAssessment; 
            
        };
=======
            $cuFirstName					= $userData['first_name'];
            $cuMiddleName					= $userData['middle_name'];
            $cuLastName						= $userData['last_name'];
            $cuNameSuffix					= $userData['name_suffix'];
            $cuPartner  					= $userData['partner'];
            $cuReferrer  					= $userData['referrer'];
            $cuKYC							= $userData['kyc'];
            $cuKYCVerified					= $userData['kyc_verified'];
            // $cuDOB						    = $userData['dob'];
            $cuPhone						= $userData['phone'];
            $cuCompany						= $userData['organization'];
            $cuAddress						= $userData['address'];
            $cuCity							= $userData['city'];
            $cuState						= $userData['state'];
            $cuCountry						= $userData['country'];
            $cuZipCode						= $userData['zipcode'];
            $cuUserType                     = $userData['type'];
            $cuWalletID                     = $userData['wallet_id'];
            $cuRealizeID                    = $userData['realize_id'];
            $cuSignupDate                   = $userData['signup_date']; 
            $cuLastLogin                    = $userData['last_login']; 
            $cuAdvertisement                = $userData['advertisement']; 
            $cuReferrerCode                 = $userData['referrer_code'];
        };
        $getDefaultWallet                   = $this->CI->investor_model->get_user_default_wallet_id($cuID);
        foreach ($getDefaultWallet->result_array() as $defaultWallet) {
            $walletID                       = $defaultWallet['id'];
        }
        $userInfo                           = array(
            'cuID'                          => $cuID,
            'cuRole'                        => $cuRole,
            'cuEmail'                       => $cuEmail,
            'cuUsername'                    => $cuUsername,
            'cuDisplayName'                 => $cuDisplayName,
            'cuFirstName'                 	=> $cuFirstName,
            'cuMiddleName'                 	=> $cuMiddleName,
            'cuLastName'                 	=> $cuLastName,
            'cuNameSuffix'                	=> $cuNameSuffix,
            'cuPartner'            			=> $cuPartner,
            'cuReferrer'                    => $cuReferrer,
            'cuKYC'                			=> $cuKYC,
            'cuKYCVerified'                	=> $cuKYCVerified,
            // 'cuDOB'                 		=> $cuDOB,
            'cuPhone'                 		=> $cuPhone,
            'cuCompany'                 	=> $cuCompany,
            'cuAddress'                 	=> $cuAddress,
            'cuCity'                 		=> $cuCity,
            'cuState'                 		=> $cuState,
            'cuCountry'                 	=> $cuCountry,
            'cuZipCode'                 	=> $cuZipCode,
            'cuUserType'                    => $cuUserType,
            'cuWalletID'                    => $cuWalletID,
            'walletID'                      => $cuWalletID,
            'cuRealizeID'                   => $cuRealizeID,
            'cuSignupDate'                  => $cuSignupDate,
            'cuLastLogin'                   => $cuLastLogin,
            'cuAdvertisement'               => $cuAdvertisement,
            'cuReferrerCode'                => $cuReferrerCode,
        );
        return $userInfo;
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    }

    public function get_user_default_wallet($cuID)
    {
        $userInfo                           = $this->get_user_information($cuID); 
        $userDefaultWalletInfo              = $this->CI->mymiwallet->get_default_wallet_info($cuID);
        $walletID	                        = $userDefaultWalletInfo['walletID'];
        $walletTitle                        = $userDefaultWalletInfo['walletTitle'];
        $walletBroker                       = $userDefaultWalletInfo['walletBroker'];
        $walletNickname                     = $userDefaultWalletInfo['walletNickname'];
        $walletDefault                      = $userDefaultWalletInfo['walletDefault'];
        $walletExchange                     = $userDefaultWalletInfo['walletExchange'];
        $walletMarketPair                   = $userDefaultWalletInfo['walletMarketPair'];
        $walletMarket                       = $userDefaultWalletInfo['walletMarket'];
        $walletFunds                        = $userDefaultWalletInfo['walletFunds'];
        $walletInitialAmount                = $userDefaultWalletInfo['walletInitialAmount'];
        $walletAmount                       = $userDefaultWalletInfo['walletAmount'];
        $walletPercentChange                = $userDefaultWalletInfo['walletPercentChange'];
        $walletGains                        = $userDefaultWalletInfo['walletGains'];
        $depositAmount                      = $userDefaultWalletInfo['depositAmount'];
        $withdrawAmount                     = $userDefaultWalletInfo['withdrawAmount'];
        $walletDepositAmount                = $userDefaultWalletInfo['walletDepositAmount'];
        $walletWithdrawAmount               = $userDefaultWalletInfo['walletWithdrawAmount'];
        $MyMICoinValue                      = $userDefaultWalletInfo['MyMICoinValue'];
        $MyMICCurrentValue                  = $userDefaultWalletInfo['MyMICCurrentValue'];
        $MyMICCoinSum					    = $userDefaultWalletInfo['MyMICCoinSum'];
        $coinsExchanged					    = $userDefaultWalletInfo['coinsExchanged'];
        $MyMIGoldValue					    = $userDefaultWalletInfo['MyMIGoldValue'];
        $MyMIGCurrentValue				    = $userDefaultWalletInfo['MyMIGCurrentValue'];
        $MyMIGCoinSum					    = $userDefaultWalletInfo['MyMIGCoinSum'];
        $getWallets						    = $userDefaultWalletInfo['getWallets'];
        $getWalletCount 				    = $this->CI->wallet_model->get_nondefault_wallet_count($cuID);
        $getWalletCount                     = $this->CI->wallet_model->get_wallet_count($cuID);
        if ($MyMICCoinSum > 0) {
            $cuTotalWalletCount             = $getWalletCount + 2;
        } elseif ($MyMIGCoinSum > 0) {
            $cuTotalWalletCount             = $getWalletCount + 2;
        } elseif ($MyMICCoinSum > 0 || $MyMIGCoinSum > 0) {
            $cuTotalWalletCount             = $getWalletCount + 3;
        } else {
            $cuTotalWalletCount             = $getWalletCount;
        }
        
        // User Last Activity
        $userLastActivity				    = $this->CI->mymiwallet->get_last_activity($cuID, $walletID);
        // $lastTradeActivity				 = $userLastActivity['$lastTradeActivity'];
        // $depositActivity				    = $userLastActivity['$depositActivity'];
        // $withdrawActivity				 = $userLastActivity['$withdrawActivity'];
        $lastTradeActivity				    = 'N/A';
        $depositActivity				    = 'N/A';
        $withdrawActivity				    = 'N/A';
        
        // Set Array Definitions
        $userDefaultData				    = array(
            'cuID'                          => $cuID,
            'cuEmail'                       => $userInfo['cuEmail'],
            'cuUsername'				    => $userInfo['cuUsername'],
            'cuDisplayName'				    => $userInfo['cuDisplayName'],
            'cuUserType'				    => $userInfo['cuUserType'],
            'cuWalletID'				    => $userInfo['cuWalletID'],
            'walletID'                      => $userInfo['walletID'],
            'getWallets'				    => $getWallets,
            'cuWalletCount'				    => $getWalletCount,
            'cuTotalWalletCount'            => $cuTotalWalletCount,
            'lastTradeActivity'			    => $lastTradeActivity,
            'depositActivity'			    => $depositActivity,
            'withdrawActivity'			    => $withdrawActivity,
            'walletID'                      => $userDefaultWalletInfo['walletID'],
            'walletTitle'				    => $walletTitle,
            'walletBroker'				    => $walletBroker,
            'walletNickname'			    => $walletNickname,
            'walletDefault'				    => $walletDefault,
            'walletExchange'			    => $walletExchange,
            'walletMarketPair'			    => $walletMarketPair,
            'walletMarket'				    => $walletMarket,
            'walletFunds'				    => $walletFunds,
            'walletInitialAmount'           => $walletInitialAmount,
            'walletAmount'				    => $walletAmount,
            'walletPercentChange'           => $walletPercentChange,
            'walletGains'				    => $walletGains,
            'depositAmount'				    => $depositAmount,
            'withdrawAmount'			    => $withdrawAmount,
            'walletDepositAmount'           => $walletDepositAmount,
            'walletWithdrawAmount'          => $walletWithdrawAmount,
            'MyMICoinValue'			        => $MyMICoinValue,
            'MyMICCurrentValue'		        => $MyMICCurrentValue,
            'MyMICCoinSum'			        => $MyMICCoinSum,
            'coinsExchanged'		        => $coinsExchanged,
            'MyMIGoldValue'				    => $MyMIGoldValue,
            'MyMIGCurrentValue'			    => $MyMIGCurrentValue,
            'MyMIGCoinSum'				    => $MyMIGCoinSum,
        );
        return $userDefaultData;
    }
    
    public function get_user_default_wallet_for_existing($cuID)
    {
        $userInfo                           = $this->get_user_information($cuID); 
        $userDefaultWalletInfo              = $this->CI->mymiwallet->get_default_wallet_info($cuID);
        if (empty($userDefaultWalletInfo)) {
            $userInfo                       = $this->get_user_information($cuID);
            $active				            = 'Yes';
            $beta                           = 'Yes'; 
            $default_wallet		            = 'Yes';
            $exchange_wallet	            = 'Yes';
            $market_pair		            = 'USD';
            $market				            = 'MYMI';
            $cuID                           = $userInfo['cuID'];
            $username                       = $userInfo['cuUsername'];
            $email                          = $userInfo['cuEmail']; 
            $broker				            = 'Default';
            $nickname			            = 'MyMI Funds';
            $wallet_type		            = 'Fiat';
            $amount				            = '0.00';

            $newWalletData                  = array(
                'active'                    => $active,
                'beta'                      => $beta,
                'default_wallet'            => $default_wallet,
                'exchange_wallet'           => $exchange_wallet,
                'market_pair'               => $market_pair,
                'market'                    => $market,
                'user_id'                   => $cuID,
                'username'                  => $username,
                'user_email'                => $email,
                'broker'                    => $broker,
                'nickname'                  => $nickname,
                'wallet_type'               => $wallet_type,
                'amount'                    => $amount,
            );          

            $this->CI->db->insert('bf_users_wallet', $newWalletData); 
<<<<<<< HEAD
        }
        $userDefaultWalletInfo          = $this->CI->mymiwallet->get_default_wallet_info($cuID);
        $walletID	                    = $userDefaultWalletInfo['walletID'];
        $walletTitle                    = $userDefaultWalletInfo['walletTitle'];
        $walletBroker                   = $userDefaultWalletInfo['walletBroker'];
        $walletNickname                 = $userDefaultWalletInfo['walletNickname'];
        $walletDefault                  = $userDefaultWalletInfo['walletDefault'];
        $walletExchange                 = $userDefaultWalletInfo['walletExchange'];
        $walletMarketPair               = $userDefaultWalletInfo['walletMarketPair'];
        $walletMarket                   = $userDefaultWalletInfo['walletMarket'];
        $walletFunds                    = $userDefaultWalletInfo['walletFunds'];
        $walletInitialAmount            = $userDefaultWalletInfo['walletInitialAmount'];
        $walletAmount                   = $userDefaultWalletInfo['walletAmount'];
        $walletPercentChange            = $userDefaultWalletInfo['walletPercentChange'];
        $walletGains                    = $userDefaultWalletInfo['walletGains'];
        $depositAmount                  = $userDefaultWalletInfo['depositAmount'];
        $withdrawAmount                 = $userDefaultWalletInfo['withdrawAmount'];
        $walletDepositAmount            = $userDefaultWalletInfo['walletDepositAmount'];
        $walletWithdrawAmount           = $userDefaultWalletInfo['walletWithdrawAmount'];
        $MyMICoinValue                  = $userDefaultWalletInfo['MyMICoinValue'];
        $MyMICCurrentValue              = $userDefaultWalletInfo['MyMICCurrentValue'];
        $MyMICCoinSum					= $userDefaultWalletInfo['MyMICCoinSum'];
        $coinsExchanged					= $userDefaultWalletInfo['coinsExchanged'];
        $MyMIGoldValue					= $userDefaultWalletInfo['MyMIGoldValue'];
        $MyMIGCurrentValue				= $userDefaultWalletInfo['MyMIGCurrentValue'];
        $MyMIGCoinSum					= $userDefaultWalletInfo['MyMIGCoinSum'];
        $getWallets						= $userDefaultWalletInfo['getWallets'];
        $getWalletCount 				= $this->CI->wallet_model->get_nondefault_wallet_count($cuID);
        $getWalletCount                 = $this->CI->wallet_model->get_wallet_count($cuID);
        if ($MyMICCoinSum > 0) {
            $cuTotalWalletCount         = $getWalletCount + 2;
        } elseif ($MyMIGCoinSum > 0) {
            $cuTotalWalletCount         = $getWalletCount + 2;
        } elseif ($MyMICCoinSum > 0 || $MyMIGCoinSum > 0) {
            $cuTotalWalletCount         = $getWalletCount + 3;
        } else {
            $cuTotalWalletCount         = $getWalletCount;
        }
        
        // User Last Activity
        $userLastActivity				= $this->CI->mymiwallet->get_last_activity($cuID, $walletID);
        // $lastTradeActivity			= $userLastActivity['$lastTradeActivity'];
        // $depositActivity				= $userLastActivity['$depositActivity'];
        // $withdrawActivity			= $userLastActivity['$withdrawActivity'];
        $lastTradeActivity				= 'N/A';
        $depositActivity				= 'N/A';
        $withdrawActivity				= 'N/A';
        
        // Set Array Definitions
        $userDefaultData				= array(
            'cuID'                      => $cuID,
            'cuEmail'                   => $userInfo['cuEmail'],
            'cuUsername'				=> $userInfo['cuUsername'],
            'cuDisplayName'				=> $userInfo['cuDisplayName'],
            'cuUserType'				=> $userInfo['cuUserType'],
            'cuWalletID'				=> $userInfo['cuWalletID'],
            'walletID'                  => $userInfo['walletID'],
            'getWallets'				=> $getWallets,
            'cuWalletCount'				=> $getWalletCount,
            'cuTotalWalletCount'        => $cuTotalWalletCount,
            'lastTradeActivity'			=> $lastTradeActivity,
            'depositActivity'			=> $depositActivity,
            'withdrawActivity'			=> $withdrawActivity,
            'walletID'                  => $userDefaultWalletInfo['walletID'],
            'walletTitle'				=> $walletTitle,
            'walletBroker'				=> $walletBroker,
            'walletNickname'			=> $walletNickname,
            'walletDefault'				=> $walletDefault,
            'walletExchange'			=> $walletExchange,
            'walletMarketPair'			=> $walletMarketPair,
            'walletMarket'				=> $walletMarket,
            'walletFunds'				=> $walletFunds,
            'walletInitialAmount'       => $walletInitialAmount,
            'walletAmount'				=> $walletAmount,
            'walletPercentChange'       => $walletPercentChange,
            'walletGains'				=> $walletGains,
            'depositAmount'				=> $depositAmount,
            'withdrawAmount'			=> $withdrawAmount,
            'walletDepositAmount'       => $walletDepositAmount,
            'walletWithdrawAmount'      => $walletWithdrawAmount,
            'MyMICoinValue'				=> $MyMICoinValue,
            'MyMICCurrentValue'			=> $MyMICCurrentValue,
            'MyMICCoinSum'				=> $MyMICCoinSum,
            'coinsExchanged'			=> $coinsExchanged,
            'MyMIGoldValue'				=> $MyMIGoldValue,
            'MyMIGCurrentValue'			=> $MyMIGCurrentValue,
            'MyMIGCoinSum'				=> $MyMIGCoinSum,
        );
        return $userDefaultData;
=======

            $userDefaultWalletInfo          = $this->CI->mymiwallet->get_default_wallet_info($cuID);
            $walletID	                    = $userDefaultWalletInfo['walletID'];
            $walletTitle                    = $userDefaultWalletInfo['walletTitle'];
            $walletBroker                   = $userDefaultWalletInfo['walletBroker'];
            $walletNickname                 = $userDefaultWalletInfo['walletNickname'];
            $walletDefault                  = $userDefaultWalletInfo['walletDefault'];
            $walletExchange                 = $userDefaultWalletInfo['walletExchange'];
            $walletMarketPair               = $userDefaultWalletInfo['walletMarketPair'];
            $walletMarket                   = $userDefaultWalletInfo['walletMarket'];
            $walletFunds                    = $userDefaultWalletInfo['walletFunds'];
            $walletInitialAmount            = $userDefaultWalletInfo['walletInitialAmount'];
            $walletAmount                   = $userDefaultWalletInfo['walletAmount'];
            $walletPercentChange            = $userDefaultWalletInfo['walletPercentChange'];
            $walletGains                    = $userDefaultWalletInfo['walletGains'];
            $depositAmount                  = $userDefaultWalletInfo['depositAmount'];
            $withdrawAmount                 = $userDefaultWalletInfo['withdrawAmount'];
            $walletDepositAmount            = $userDefaultWalletInfo['walletDepositAmount'];
            $walletWithdrawAmount           = $userDefaultWalletInfo['walletWithdrawAmount'];
            $MyMICoinValue                  = $userDefaultWalletInfo['MyMICoinValue'];
            $MyMICCurrentValue              = $userDefaultWalletInfo['MyMICCurrentValue'];
            $MyMICCoinSum					= $userDefaultWalletInfo['MyMICCoinSum'];
            $coinsExchanged					= $userDefaultWalletInfo['coinsExchanged'];
            $MyMIGoldValue					= $userDefaultWalletInfo['MyMIGoldValue'];
            $MyMIGCurrentValue				= $userDefaultWalletInfo['MyMIGCurrentValue'];
            $MyMIGCoinSum					= $userDefaultWalletInfo['MyMIGCoinSum'];
            $getWallets						= $userDefaultWalletInfo['getWallets'];
            $getWalletCount 				= $this->CI->wallet_model->get_nondefault_wallet_count($cuID);
            $getWalletCount                 = $this->CI->wallet_model->get_wallet_count($cuID);
            if ($MyMICCoinSum > 0) {
                $cuTotalWalletCount         = $getWalletCount + 2;
            } elseif ($MyMIGCoinSum > 0) {
                $cuTotalWalletCount         = $getWalletCount + 2;
            } elseif ($MyMICCoinSum > 0 || $MyMIGCoinSum > 0) {
                $cuTotalWalletCount         = $getWalletCount + 3;
            } else {
                $cuTotalWalletCount         = $getWalletCount;
            }
            
            // User Last Activity
            $userLastActivity				= $this->CI->mymiwallet->get_last_activity($cuID, $walletID);
            // $lastTradeActivity			= $userLastActivity['$lastTradeActivity'];
            // $depositActivity				= $userLastActivity['$depositActivity'];
            // $withdrawActivity			= $userLastActivity['$withdrawActivity'];
            $lastTradeActivity				= 'N/A';
            $depositActivity				= 'N/A';
            $withdrawActivity				= 'N/A';
            
            // Set Array Definitions
            $userDefaultData				= array(
                'cuID'                      => $cuID,
                'cuEmail'                   => $userInfo['cuEmail'],
                'cuUsername'				=> $userInfo['cuUsername'],
                'cuDisplayName'				=> $userInfo['cuDisplayName'],
                'cuUserType'				=> $userInfo['cuUserType'],
                'cuWalletID'				=> $userInfo['cuWalletID'],
                'walletID'                  => $userInfo['walletID'],
                'getWallets'				=> $getWallets,
                'cuWalletCount'				=> $getWalletCount,
                'cuTotalWalletCount'        => $cuTotalWalletCount,
                'lastTradeActivity'			=> $lastTradeActivity,
                'depositActivity'			=> $depositActivity,
                'withdrawActivity'			=> $withdrawActivity,
                'walletID'                  => $userDefaultWalletInfo['walletID'],
                'walletTitle'				=> $walletTitle,
                'walletBroker'				=> $walletBroker,
                'walletNickname'			=> $walletNickname,
                'walletDefault'				=> $walletDefault,
                'walletExchange'			=> $walletExchange,
                'walletMarketPair'			=> $walletMarketPair,
                'walletMarket'				=> $walletMarket,
                'walletFunds'				=> $walletFunds,
                'walletInitialAmount'       => $walletInitialAmount,
                'walletAmount'				=> $walletAmount,
                'walletPercentChange'       => $walletPercentChange,
                'walletGains'				=> $walletGains,
                'depositAmount'				=> $depositAmount,
                'withdrawAmount'			=> $withdrawAmount,
                'walletDepositAmount'       => $walletDepositAmount,
                'walletWithdrawAmount'      => $walletWithdrawAmount,
                'MyMICoinValue'				=> $MyMICoinValue,
                'MyMICCurrentValue'			=> $MyMICCurrentValue,
                'MyMICCoinSum'				=> $MyMICCoinSum,
                'coinsExchanged'			=> $coinsExchanged,
                'MyMIGoldValue'				=> $MyMIGoldValue,
                'MyMIGCurrentValue'			=> $MyMIGCurrentValue,
                'MyMIGCoinSum'				=> $MyMIGCoinSum,
            );
            return $userDefaultData;
        } else {
            $walletID	                    = $userDefaultWalletInfo['walletID'];
            $walletTitle                    = $userDefaultWalletInfo['walletTitle'];
            $walletBroker                   = $userDefaultWalletInfo['walletBroker'];
            $walletNickname                 = $userDefaultWalletInfo['walletNickname'];
            $walletDefault                  = $userDefaultWalletInfo['walletDefault'];
            $walletExchange                 = $userDefaultWalletInfo['walletExchange'];
            $walletMarketPair               = $userDefaultWalletInfo['walletMarketPair'];
            $walletMarket                   = $userDefaultWalletInfo['walletMarket'];
            $walletFunds                    = $userDefaultWalletInfo['walletFunds'];
            $walletInitialAmount            = $userDefaultWalletInfo['walletInitialAmount'];
            $walletAmount                   = $userDefaultWalletInfo['walletAmount'];
            $walletPercentChange            = $userDefaultWalletInfo['walletPercentChange'];
            $walletGains                    = $userDefaultWalletInfo['walletGains'];
            $depositAmount                  = $userDefaultWalletInfo['depositAmount'];
            $withdrawAmount                 = $userDefaultWalletInfo['withdrawAmount'];
            $walletDepositAmount            = $userDefaultWalletInfo['walletDepositAmount'];
            $walletWithdrawAmount           = $userDefaultWalletInfo['walletWithdrawAmount'];
            $MyMICoinValue                  = $userDefaultWalletInfo['MyMICoinValue'];
            $MyMICCurrentValue              = $userDefaultWalletInfo['MyMICCurrentValue'];
            $MyMICCoinSum					= $userDefaultWalletInfo['MyMICCoinSum'];
            $coinsExchanged					= $userDefaultWalletInfo['coinsExchanged'];
            $MyMIGoldValue					= $userDefaultWalletInfo['MyMIGoldValue'];
            $MyMIGCurrentValue				= $userDefaultWalletInfo['MyMIGCurrentValue'];
            $MyMIGCoinSum					= $userDefaultWalletInfo['MyMIGCoinSum'];
            $getWallets						= $userDefaultWalletInfo['getWallets'];
            $getWalletCount 				= $this->CI->wallet_model->get_nondefault_wallet_count($cuID);
            $getWalletCount                 = $this->CI->wallet_model->get_wallet_count($cuID);
            if ($MyMICCoinSum > 0) {
                $cuTotalWalletCount         = $getWalletCount + 2;
            } elseif ($MyMIGCoinSum > 0) {
                $cuTotalWalletCount         = $getWalletCount + 2;
            } elseif ($MyMICCoinSum > 0 || $MyMIGCoinSum > 0) {
                $cuTotalWalletCount         = $getWalletCount + 3;
            } else {
                $cuTotalWalletCount         = $getWalletCount;
            }
            
            // User Last Activity
            $userLastActivity				= $this->CI->mymiwallet->get_last_activity($cuID, $walletID);
            // $lastTradeActivity				 = $userLastActivity['$lastTradeActivity'];
            // $depositActivity				 = $userLastActivity['$depositActivity'];
            // $withdrawActivity				 = $userLastActivity['$withdrawActivity'];
            $lastTradeActivity				= 'N/A';
            $depositActivity				= 'N/A';
            $withdrawActivity				= 'N/A';
            
            // Set Array Definitions
            $userDefaultData				= array(
                'cuID'                      => $cuID,
                'cuEmail'                   => $userInfo['cuEmail'],
                'cuUsername'				=> $userInfo['cuUsername'],
                'cuDisplayName'				=> $userInfo['cuDisplayName'],
                'cuUserType'				=> $userInfo['cuUserType'],
                'cuWalletID'				=> $userInfo['cuWalletID'],
                'walletID'                  => $userInfo['walletID'],
                'getWallets'				=> $getWallets,
                'cuWalletCount'				=> $getWalletCount,
                'cuTotalWalletCount'        => $cuTotalWalletCount,
                'lastTradeActivity'			=> $lastTradeActivity,
                'depositActivity'			=> $depositActivity,
                'withdrawActivity'			=> $withdrawActivity,
                'walletID'                  => $userDefaultWalletInfo['walletID'],
                'walletTitle'				=> $walletTitle,
                'walletBroker'				=> $walletBroker,
                'walletNickname'			=> $walletNickname,
                'walletDefault'				=> $walletDefault,
                'walletExchange'			=> $walletExchange,
                'walletMarketPair'			=> $walletMarketPair,
                'walletMarket'				=> $walletMarket,
                'walletFunds'				=> $walletFunds,
                'walletInitialAmount'       => $walletInitialAmount,
                'walletAmount'				=> $walletAmount,
                'walletPercentChange'       => $walletPercentChange,
                'walletGains'				=> $walletGains,
                'depositAmount'				=> $depositAmount,
                'withdrawAmount'			=> $withdrawAmount,
                'walletDepositAmount'       => $walletDepositAmount,
                'walletWithdrawAmount'      => $walletWithdrawAmount,
                'MyMICoinValue'			    => $MyMICoinValue,
                'MyMICCurrentValue'		    => $MyMICCurrentValue,
                'MyMICCoinSum'			    => $MyMICCoinSum,
                'coinsExchanged'		    => $coinsExchanged,
                'MyMIGoldValue'				=> $MyMIGoldValue,
                'MyMIGCurrentValue'			=> $MyMIGCurrentValue,
                'MyMIGCoinSum'				=> $MyMIGCoinSum,
            );
            return $userDefaultData;

        }
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    }

    public function user_default_wallet($cuID)
    {
        $getUserData                        = $this->get_user_information($cuID);
        $userDefaultWalletInfo              = $this->CI->mymiwallet->get_default_wallet_info($cuID);
        $walletID	                        = $userDefaultWalletInfo['walletID'];
        $walletTitle                        = $userDefaultWalletInfo['walletTitle'];
        $walletBroker                       = $userDefaultWalletInfo['walletBroker'];
        $walletNickname                     = $userDefaultWalletInfo['walletNickname'];
        $walletDefault                      = $userDefaultWalletInfo['walletDefault'];
        $walletExchange                     = $userDefaultWalletInfo['walletExchange'];
        $walletMarketPair                   = $userDefaultWalletInfo['walletMarketPair'];
        $walletMarket                       = $userDefaultWalletInfo['walletMarket'];
        $walletInitialAmount                = $userDefaultWalletInfo['walletInitialAmount'];
        $walletAmount                       = $userDefaultWalletInfo['walletAmount'];
        $walletPercentChange                = $userDefaultWalletInfo['walletPercentChange'];
        $walletGains                        = $userDefaultWalletInfo['walletGains'];
        $walletFunds                        = $userDefaultWalletInfo['walletFunds'];
        $depositAmount                      = $userDefaultWalletInfo['depositAmount'];
        $withdrawAmount                     = $userDefaultWalletInfo['withdrawAmount'];
        $walletDepositAmount                = $userDefaultWalletInfo['walletDepositAmount'];
        $walletWithdrawAmount               = $userDefaultWalletInfo['walletWithdrawAmount'];
        $MyMICoinValue                      = $userDefaultWalletInfo['MyMICoinValue'];
        $MyMICCurrentValue                  = $userDefaultWalletInfo['MyMICCurrentValue'];
        $MyMICCoinSum						= $userDefaultWalletInfo['MyMICCoinSum'];
        $coinsExchanged						= $userDefaultWalletInfo['coinsExchanged'];
        $MyMIGoldValue						= $userDefaultWalletInfo['MyMIGoldValue'];
        $MyMIGCurrentValue					= $userDefaultWalletInfo['MyMIGCurrentValue'];
        $MyMIGCoinSum						= $userDefaultWalletInfo['MyMIGCoinSum'];
        $getWalletCount 					= $this->CI->wallet_model->get_nondefault_wallet_count($cuID);
        //~ $getWalletCount                     = $this->CI->wallet_model->get_wallet_count($cuID);
        if ($MyMICCoinSum > 0) {
            $cuWalletCount                  = $getWalletCount + 2;
        } elseif ($MyMIGCoinSum > 0) {
            $cuWalletCount                  = $getWalletCount + 2;
        } elseif ($MyMICCoinSum > 0 || $MyMIGCoinSum > 0) {
            $cuWalletCount                  = $getWalletCount + 3;
        } else {
            $cuWalletCount                  = $getWalletCount;
        }
        
        // User Last Activity
        $userLastActivity					= $this->CI->mymiwallet->get_last_activity($cuID, $walletID);
        $lastTradeActivity				 	= $userLastActivity['$lastTradeActivity'];
        $depositActivity				 	= $userLastActivity['$depositActivity'];
        $withdrawActivity				 	= $userLastActivity['$withdrawActivity'];
        
        // Set Array Definitions
        $userDefaultData					= array(
            'cuID'                          => $cuID,
            'cuEmail'                       => $getUserData['cuEmail'],
            'cuUsername'					=> $getUserData['cuUsername'],
            'cuDisplayName'					=> $getUserData['cuDisplayName'],
            'cuUserType'					=> $getUserData['cuUserType'],
            'cuWalletID'					=> $getUserData['cuWalletID'],
            'walletID'                      => $getUserData['walletID'],
            'cuWalletCount'					=> $cuWalletCount,
            'lastTradeActivity'				=> $lastTradeActivity,
            'depositActivity'				=> $depositActivity,
            'withdrawActivity'				=> $withdrawActivity,
            'walletID'                      => $userDefaultWalletInfo['walletID'],
            'walletTitle'					=> $walletTitle,
            'walletBroker'					=> $walletBroker,
            'walletNickname'				=> $walletNickname,
            'walletDefault'					=> $walletDefault,
            'walletExchange'				=> $walletExchange,
            'walletMarketPair'				=> $walletMarketPair,
            'walletMarket'					=> $walletMarket,
            'walletFunds'					=> $walletFunds,
            'walletInitialAmount'           => $walletInitialAmount,
            'walletAmount'					=> $walletAmount,
            'walletPercentChange'           => $walletPercentChange,
            'walletGains'					=> $walletGains,
            'depositAmount'					=> $depositAmount,
            'withdrawAmount'				=> $withdrawAmount,
            'walletDepositAmount'           => $walletDepositAmount,
            'walletWithdrawAmount'          => $walletWithdrawAmount,
            'MyMICoinValue'					=> $MyMICoinValue,
            'MyMICCurrentValue'				=> $MyMICCurrentValue,
            'MyMICCoinSum'					=> $MyMICCoinSum,
            'coinsExchanged'				=> $coinsExchanged,
            'MyMIGoldValue'					=> $MyMIGoldValue,
            'MyMIGCurrentValue'				=> $MyMIGCurrentValue,
            'MyMIGCoinSum'					=> $MyMIGCoinSum,
        );
        return $userDefaultData;
    }

    public function get_user_exchange_info($cuID)
    {
        $this->CI->db->from('bf_exchanges_listing_request');
        $this->CI->db->where('user_id', $cuID);
        $getAppInfo                         = $this->CI->db->get()->result_array();
        if (empty($getAppInfo[0]['id'])) {
            $open_listing_app               = 0;
        } else {
            $open_listing_app               = $getAppInfo[0]['id'];
        }
        $userExchangeInfo                   = array(
            'open_listing_app'              => $open_listing_app,
        );
        return $userExchangeInfo;
    }

    public function get_user_asset_summary($cuID)
    {
        $getUserAssetCount                  = $this->CI->exchange_model->get_user_asset_count($cuID);
        if (!isset($getUserAssetCount)) {
            $userAssetSummary               = array(
                'assetTotalCount'           => 0,
                'assetNetValue'             => 0,
                'assetTotalGains'           => 0,
            );
            return $userAssetSummary;
        } else {
            $assetTotalCount                = $getUserAssetCount->num_rows();
            $getUserAssetNetWorth           = $this->CI->exchange_model->get_user_asset_net_worth($cuID)->result_array();
            if (empty($getUserAssetNetWorth)) {
                $assetNetValue              = 0;
            } else {
                $assetNetValue              = $getUserAssetNetWorth[0]['current_value'];
            }
            $getUserAssetInfo               = $this->CI->exchange_model->get_user_asset_info($cuID)->result_array();
            if (empty($getUserAssetInfo)) {
                $assetTotalGains            = 0;
            } else {
                $assetTotalGains            = $getUserAssetInfo[0]['current_value'] - $getUserAssetInfo[0]['initial_value'];
            }
            $userAssetSummary               = array(
                'assetTotalCount'           => $assetTotalCount,
                'assetNetValue'             => $assetNetValue,
                'assetTotalGains'           => number_format($assetTotalGains, 2),
            );
            return $userAssetSummary;
        }
    }

<<<<<<< HEAD
    public function get_user_social_info($cuID) 
    {
        $getSocialInfo						= $this->CI->investor_model->get_user_social_media_by_id($cuID);
=======
    public function get_user_social_info($cuEmail) 
    {
        $getSocialInfo						= $this->CI->investor_model->get_user_social_media($cuEmail);
>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
        foreach($getSocialInfo->result_array() as $socialInfo) {
            $cuCoverart			            = $socialInfo['coverart'];
            $cuProfilePic                   = $socialInfo['profile_pic'];
            $cuFollowers                    = $socialInfo['followers'];
            $cuViews                        = $socialInfo['views'];
            $cuWebsite                      = $socialInfo['website'];
            $cuFacebook                     = $socialInfo['facebook'];
            $cuTwitter                      = $socialInfo['twitter'];
            $cuStocktwits                   = $socialInfo['stocktwits'];
            $cuYoutube                      = $socialInfo['youtube'];
            $cuDiscord                      = $socialInfo['discord'];
        }
        
        $userSocialInfo                     = array(
            // 'cuCoverart'                    => $cuCoverart,
            'cuProfilePic'                  => $cuProfilePic,
            'cuFollowers'                   => $cuFollowers,
            'cuViews'                       => $cuViews,
            'cuWebsite'                     => $cuWebsite,
            'cuFacebook'                    => $cuFacebook,
            'cuTwitter'                     => $cuTwitter,
            'cuStocktwits'                  => $cuStocktwits,
            'cuYoutube'                     => $cuYoutube,
            'cuDiscord'                     => $cuDiscord,
        );
        
        return $userSocialInfo;         
    }
    
<<<<<<< HEAD
    public function get_all_trade_tracker_configs()
    {
        $getAllTTConfigs                    = $this->CI->tracker_model->get_all_trade_tracker_configs();
        $allTradeTrackerConfigs             = array(
            'allTradeTrackerConfigs'        => $getAllTTConfigs->result_array(), 
        );

        return $allTradeTrackerConfigs;

    }
=======

>>>>>>> 76bba32f875dbfd8e00d213db849802fb5378283
    // public function get_last_account() {
    //     $getLastAccount                         = $this->investor_model->get_last_account(); 
    //     foreach ($getLastAccount->result_array() as $lastAccount) {
    //         $userDat
    //     }
    // }
}
