<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MyMIUser
{
    private $cuID;
    private $ci;
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library(array('Auth', 'MyMICoin', 'MyMIGold', 'MyMIWallet', 'session', 'settings/settings_lib', 'Template'));
        $this->ci->load->model(array('User/exchange_model', 'User/investor_model', 'User/tracker_model', 'User/wallet_model'));
        $this->ci->load->library('users/auth');
        $cuID 								= $this->ci->auth->user_id();
        //~ $this->ci->load->library(array('Auth', 'MyMIWallets'));
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
    public function user_account_info($cuID)
    {
        $userInfo                           = $this->get_user_information($cuID);
        $cu
        $userExchangeInfo					= $this->get_user_exchange_info($cuID);
        $userDefaultWallet                  = $this->get_user_default_wallet($cuID);
        $userAssetSummary                   = $this->get_user_asset_summary($cuID);
        $userSocialInfo                     = $this->get_user_social_info($cuEmail);
        $userAccount	                    = array(
            'cuID'                       	=> $cuID,
            'cuRole'                        => $userInfo['cuRole'],
            'cuPartner'                     => $userInfo['cuPartner'],
            'cuReferrer'                    => $userInfo['cuReferrer'],
            'cuUserType'                    => $userInfo['cuUserType'],
            'cuEmail'                       => $userInfo['cuEmail'],
            'cuUsername'                    => $userInfo['cuUsername'],
            'cuDisplayName'                 => $userInfo['cuDisplayName'],
            'cuFirstName'                 	=> $userInfo['cuFirstName'],
            'cuMiddleName'                 	=> $userInfo['cuMiddleName'],
            'cuLastName'                 	=> $userInfo['cuLastName'],
            'cuNameSuffix'                	=> $userInfo['cuNameSuffix'],
            'cuKYC'                			=> $userInfo['cuKYC'],
            'cuKYCVerified'                 => $userInfo['cuKYCVerified'],
            'cuPhone'                 		=> $userInfo['cuPhone'],
            'cuCompany'                		=> $userInfo['cuCompany'],
            'cuAddress'                 	=> $userInfo['cuAddress'],
            'cuCity'                 		=> $userInfo['cuCity'],
            'cuState'                 		=> $userInfo['cuState'],
            'cuCountry'                 	=> $userInfo['cuCountry'],
            'cuZipCode'                 	=> $userInfo['cuZipCode'],
            'cuUserType'                    => $userInfo['cuUserType'],
            'cuWalletID'                    => $userInfo['cuWalletID'],
            'walletID'                      => $userInfo['walletID'],
            'cuRealizeID'                   => $userInfo['cuRealizeID'],
            'cuSignupDate'                  => $userInfo['cuSignupDate'],
            'cuLastLogin'                   => $userInfo['cuLastLogin'],
            'cuAdvertisement'               => $userInfo['cuAdvertisement'],
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
        );
        
        return $userAccount;
    }
        
        
    public function get_user_information($cuID)
    {
        $getUserData                        = $this->ci->investor_model->get_user_data($cuID);
        foreach ($getUserData->result_array() as $userData) {
            $cuRole                         = $userData['role_id'];
            $cuEmail                        = $userData['email'];
            $cuUsername                     = $userData['username'];
            $cuDisplayName                  = $userData['display_name'];
            $cuFirstName					= $userData['first_name'];
            $cuMiddleName					= $userData['middle_name'];
            $cuLastName						= $userData['last_name'];
            $cuNameSuffix					= $userData['name_suffix'];
            $cuPartner  					= $userData['partner'];
            $cuReferrer  					= $userData['referrer'];
            $cuKYC							= $userData['kyc'];
            $cuKYCVerified					= $userData['kyc_verified'];
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
        $getDefaultWallet                   = $this->ci->investor_model->get_user_default_wallet_id($cuID);
        foreach ($getDefaultWallet->result_array() as $defaultWallet) {
            $walletID                     = $defaultWallet['id'];
        }
        $userInfo                           = array(
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
    }
    
    public function get_user_default_wallet($cuID)
    {
        $getUserData                        = $this->get_user_information($cuID);
        $userDefaultWalletInfo              = $this->ci->mymiwallet->get_default_wallet_info($cuID);
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
        $MyMICCoinSum						= $userDefaultWalletInfo['MyMICCoinSum'];
        $coinsExchanged						= $userDefaultWalletInfo['coinsExchanged'];
        $MyMIGoldValue						= $userDefaultWalletInfo['MyMIGoldValue'];
        $MyMIGCurrentValue					= $userDefaultWalletInfo['MyMIGCurrentValue'];
        $MyMIGCoinSum						= $userDefaultWalletInfo['MyMIGCoinSum'];
        $getWallets							= $userDefaultWalletInfo['getWallets'];
        $getWalletCount 					= $this->ci->wallet_model->get_nondefault_wallet_count($cuID);
        $getWalletCount                     = $this->ci->wallet_model->get_wallet_count($cuID);
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
        $userLastActivity					= $this->ci->mymiwallet->get_last_activity($cuID, $walletID);
        // $lastTradeActivity				 	= $userLastActivity['$lastTradeActivity'];
        // $depositActivity				 	= $userLastActivity['$depositActivity'];
        // $withdrawActivity				 	= $userLastActivity['$withdrawActivity'];
        $lastTradeActivity				 	= 'N/A';
        $depositActivity				 	= 'N/A';
        $withdrawActivity				 	= 'N/A';
        
        // Set Array Definitions
        $userDefaultData					= array(
            'cuID'                          => $cuID,
            'cuEmail'                       => $getUserData['cuEmail'],
            'cuUsername'					=> $getUserData['cuUsername'],
            'cuDisplayName'					=> $getUserData['cuDisplayName'],
            'cuUserType'					=> $getUserData['cuUserType'],
            'cuWalletID'					=> $getUserData['cuWalletID'],
            'walletID'                      => $getUserData['walletID'],
            'getWallets'					=> $getWallets,
            'cuWalletCount'					=> $getWalletCount,
            'cuTotalWalletCount'            => $cuTotalWalletCount,
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

    public function user_default_wallet($cuID)
    {
        $getUserData                        = $this->get_user_information($cuID);
        $userDefaultWalletInfo              = $this->ci->mymiwallet->get_default_wallet_info($cuID);
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
        $getWalletCount 					= $this->ci->wallet_model->get_nondefault_wallet_count($cuID);
        //~ $getWalletCount                     = $this->ci->wallet_model->get_wallet_count($cuID);
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
        $userLastActivity					= $this->ci->mymiwallet->get_last_activity($cuID, $walletID);
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
        $this->ci->db->from('bf_exchanges_listing_request');
        $this->ci->db->where('user_id', $cuID);
        $getAppInfo                             = $this->ci->db->get()->result_array();
        if (empty($getAppInfo[0]['id'])) {
            $open_listing_app                   = 0;
        } else {
            $open_listing_app                   = $getAppInfo[0]['id'];
        }
        $userExchangeInfo                       = array(
            'open_listing_app'                  => $open_listing_app,
        );
        return $userExchangeInfo;
    }

    public function get_user_asset_summary($cuID)
    {
        $getUserAssetCount                  = $this->ci->exchange_model->get_user_asset_count($cuID);
        if (!isset($getUserAssetCount)) {
            $userAssetSummary               = array(
                'assetTotalCount'           => 0,
                'assetNetValue'             => 0,
                'assetTotalGains'           => 0,
            );
            return $userAssetSummary;
        } else {
            $assetTotalCount                = $getUserAssetCount->num_rows();
            $getUserAssetNetWorth           = $this->ci->exchange_model->get_user_asset_net_worth($cuID)->result_array();
            if (empty($getUserAssetNetWorth)) {
                $assetNetValue              = 0;
            } else {
                $assetNetValue              = $getUserAssetNetWorth[0]['current_value'];
            }
            $getUserAssetInfo               = $this->ci->exchange_model->get_user_asset_info($cuID)->result_array();
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

    // public function get_last_account() {
    //     $getLastAccount                         = $this->investor_model->get_last_account(); 
    //     foreach ($getLastAccount->result_array() as $lastAccount) {
    //         $userDat
    //     }
    // }
}
