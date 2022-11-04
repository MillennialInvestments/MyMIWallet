<?php defined('BASEPATH') || exit('No direct script access allowed');

class Investor_model extends BF_Model
{
    protected $table_name	= 'bf_applications';
    protected $key			= 'id';
    protected $date_format	= 'datetime';

    protected $log_user 	= true;
    protected $set_created	= true;
    protected $set_modified = true;
    protected $soft_deletes	= false;

    protected $created_field     = 'created_on';
    protected $created_by_field  = 'created_by';
    protected $modified_field    = 'modified_on';
    protected $modified_by_field = 'modified_by';

    // Customize the operations of the model without recreating the insert,
    // update, etc. methods by adding the method names to act as callbacks here.
    protected $before_insert 	= array();
    protected $after_insert 	= array();
    protected $before_update 	= array();
    protected $after_update 	= array();
    protected $before_find 	    = array();
    protected $after_find 		= array();
    protected $before_delete 	= array();
    protected $after_delete 	= array();

    // For performance reasons, you may require your model to NOT return the id
    // of the last inserted row as it is a bit of a slow method. This is
    // primarily helpful when running big loops over data.
    protected $return_insert_id = true;

    // The default type for returned row data.
    protected $return_type = 'object';

    // Items that are always removed from data prior to inserts or updates.
    protected $protected_attributes = array();

    // You may need to move certain rules (like required) into the
    // $insert_validation_rules array and out of the standard validation array.
    // That way it is only required during inserts, not updates which may only
    // be updating a portion of the data.
    protected $validation_rules 		= array(
        array(
            'field' => 'Name',
            'label' => 'lang:contact_us_field_Name',
            'rules' => 'required|unique[bf_contactus.Name,bf_contactus.id]|alpha|max_length[255]',
        ),
        array(
            'field' => 'email',
            'label' => 'lang:contact_us_field_email',
            'rules' => 'required|unique[bf_contactus.email,bf_contactus.id]|valid_email|max_length[255]',
        ),
        array(
            'field' => 'phone',
            'label' => 'lang:contact_us_field_phone',
            'rules' => 'required|unique[bf_contactus.phone,bf_contactus.id]|max_length[30]',
        ),
        array(
            'field' => 'message',
            'label' => 'lang:contact_us_field_message',
            'rules' => 'alpha_dash|max_length[255]',
        ),
    );
    protected $insert_validation_rules  = array();
    protected $skip_validation 			= false;
    
    public $gallery_path;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->gallery_path = realpath(APPPATH . '../images/');
    }
    
    
    /**
    * Find a user's record and role information.
    *
    * @param int $id The user's ID.
    *
    * @return bool|object An object with the user's information.
    */
    public function prep_data($post_data)
    {
        // Take advantage of BF_Model's prep_data() method.
        $data = parent::prep_data($post_data);
        
        return $data;
    }
    
    /*
     * Dashboard Add/Edit/Delete
     * function to add/delete/update bf_dashboards
     */
    public function get_user_data($cuID)
    {
        $this->db->from('bf_users');
        $this->db->where('id', $cuID);
        $getUserData			= $this->db->get();
        return $getUserData;
    }
    
    public function add_account_information($id, $first_name, $middle_name, $last_name, $name_suffix, $phone, $address, $city, $state, $country, $zipcode, $timezones, $language, $advertisement)
    {
        $user					= array(
            'first_name'		=> $first_name,
            'middle_name'		=> $middle_name,
            'last_name'			=> $last_name,
            'name_suffix'		=> $name_suffix,
            'phone'				=> $phone,
            'address'			=> $address,
            'city'				=> $city,
            'state'				=> $state,
            'country'			=> $country,
            'zipcode'			=> $zipcode,
            'timezones'			=> $timezones,
            'language'			=> $language,
            'advertisement'		=> $advertisement,
        );
         
        $this->db->where('id', $id);
        return $this->db->update('bf_users');
    }
    
    public function get_trade_alerts()
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('status', 'Opened');
        $this->db->order_by('id', 'DESC');
        $getTradeAlerts = $this->db->get();
        return $getTradeAlerts;
    }
            
    public function get_user_single_trades($tradeID)
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('id', $tradeID);
        $getUserTrades = $this->db->get();
        return $getUserTrades;
    }
    
    public function add_wallet($user_id, $user_email, $broker, $type, $amount, $nickname)
    {
        $user = array(
            'user_id'			=> $user_id,
            'user_email'		=> $user_email,
            'broker'			=> $broker,
            'type'				=> $type,
            'amount'			=> $amount,
            'nickname'			=> $nickname,
        );
        
        return $this->db->insert('bf_users_wallet', $user);
    }
    
    public function edit_wallet($wallet_id, $user_id, $user_email, $broker, $type, $amount, $nickname)
    {
        $user = array(
            'user_id'			=> $user_id,
            'user_email'		=> $user_email,
            'broker'			=> $broker,
            'type'				=> $type,
            'amount'			=> $amount,
            'nickname'			=> $nickname,
        );
        $this->db->where('id', $wallet_id);
        return $this->db->update('bf_users_wallet', $user);
    }
    
    public function add_wallet_deposit($date, $time, $trans_type, $wallet_id, $user_id, $user_email, $type, $broker, $trans_date, $amount, $nickname, $details)
    {
        $user = array(
            'submitted_date'	=> $date,
            'time'				=> $time,
            'trans_type'		=> $trans_type,
            'wallet_id'			=> $wallet_id,
            'user_id'			=> $user_id,
            'user_email'		=> $user_email,
            'type'				=> $type,
            'broker'			=> $broker,
            'deposit_date'		=> $trans_date,
            'amount'			=> $amount,
            'nickname'			=> $nickname,
            'details'			=> $details,
        );
        
        return $this->db->insert('bf_users_wallet_transactions', $user);
    }
    
    public function add_wallet_withdraw($date, $time, $trans_type, $wallet_id, $user_id, $user_email, $type, $broker, $trans_date, $amount, $nickname, $details)
    {
        $user = array(
            'submitted_date'	=> $date,
            'time'				=> $time,
            'trans_type'		=> $trans_type,
            'wallet_id'			=> $wallet_id,
            'user_id'			=> $user_id,
            'user_email'		=> $user_email,
            'type'				=> $type,
            'broker'			=> $broker,
            'withdraw_date'		=> $trans_date,
            'amount'			=> $amount,
            'nickname'			=> $nickname,
            'details'			=> $details,
        );
        
        return $this->db->insert('bf_users_wallet_transactions', $user);
    }
    
    public function get_wallet_count($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $getWallets				= $this->db->get();
        $getWalletCount			= $getWallets->num_rows();
        return $getWalletCount;
    }
    
    public function get_user_default_wallet_id($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('default_wallet', 'Yes');
        $getUserDefaultWalletID	= $this->db->get();
        return $getUserDefaultWalletID;
    }

    public function get_wallet_info($walletID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('id', $walletID);
        $getWalletInfo			= $this->db->get();
        return $getWalletInfo;
    }
    
    public function get_wallet_initial_summary($walletID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet');
        $this->db->where('id', $walletID);
        $getWalletInitialSum	= $this->db->get();
        return $getWalletInitialSum;
    }
     
    public function get_all_wallets($cuID)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $getWallets				= $this->db->get();
        return $getWallets;
    }
     
    public function get_fiat_wallets($cuID, $limit)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $this->db->where('type', 'Fiat');
        $this->db->order_by('amount', 'DESC');
        $this->db->limit($limit);
        $getFiatWallets			= $this->db->get();
        return $getFiatWallets;
    }
     
    public function get_digital_wallets($cuID, $limit)
    {
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $this->db->where('type', 'Digital');
        $this->db->order_by('amount', 'DESC');
        $this->db->limit($limit);
        $getDigitalWallets		= $this->db->get();
        return $getDigitalWallets;
    }
    
    public function get_wallet_totals($cuID)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('active', 'Yes');
        $walletTotals 			= $this->db->get();
        return $walletTotals;
    }
    
    public function get_wallet_deposits($cuID, $walletID)
    {
        if ($walletID !== null) {
            $this->db->select_sum('amount');
            $this->db->from('bf_users_wallet_transactions');
            $this->db->where('trans_type', 'Deposit');
            $this->db->where('wallet_id', $walletID);
            $getWalletDeposits 		= $this->db->get();
            return $getWalletDeposits;
        } else {
            $this->db->select_sum('amount');
            $this->db->from('bf_users_wallet_transactions');
            $this->db->where('trans_type', 'Deposit');
            $this->db->where('user_id', $cuID);
            $getWalletDeposits 		= $this->db->get();
            return $getWalletDeposits;
        }
    }
    
    public function get_wallet_withdrawals($cuID, $walletID)
    {
        if ($walletID !== null) {
            $this->db->select_sum('amount');
            $this->db->from('bf_users_wallet_transactions');
            $this->db->where('trans_type', 'Withdraw');
            $this->db->where('wallet_id', $walletID);
            $getWalletWithdrawals 	= $this->db->get();
            return $getWalletWithdrawals;
        } else {
            $this->db->select_sum('amount');
            $this->db->from('bf_users_wallet_transactions');
            $this->db->where('trans_type', 'Withdraw');
            $this->db->where('user_id', $cuID);
            $getWalletWithdrawals 	= $this->db->get();
            return $getWalletWithdrawals;
        }
    }
    
    public function get_single_wallet_deposits($wallet_id)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('trans_type', 'Deposit');
        $this->db->where('wallet_id', $wallet_id);
        $getSingleWalletDeposits	= $this->db->get();
        return $getSingleWalletDeposits;
    }
    
    public function get_single_wallet_withdrawals($wallet_id)
    {
        $this->db->select_sum('amount');
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('trans_type', 'Withdraw');
        $this->db->where('wallet_id', $wallet_id);
        $getSingleWalletWithdrawals	= $this->db->get();
        return $getSingleWalletWithdrawals;
    }
    
    public function get_last_wallet_deposit($cuID, $walletID)
    {
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('trans_type', 'Deposit');
        $this->db->where('wallet_id', $walletID);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $getLastDeposit = $this->db->get();
        return $getLastDeposit;
    }
        
    public function get_last_wallet_withdraw($cuID, $walletID)
    {
        $this->db->from('bf_users_wallet_transactions');
        $this->db->where('trans_type', 'Withdraw');
        $this->db->where('wallet_id', $walletID);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $getLastWithdraw                    = $this->db->get();
        return $getLastWithdraw;
    }
    
    public function get_user_coin_purchases($cuID) {
        $this->db->from('bf_users_coin_purchases'); 
        $this->db->where('user_id', $cuID); 
        $getUserCoinPurchases               = $this->db->get();
        return $getUserCoinPurchases;
    }
    
    public function get_user_bank_accounts($cuID) {
        $this->db->from('bf_users_bank_accounts'); 
        $this->db->where('user_id', $cuID); 
        $getUserBankAccounts                = $this->db->get();
        return $getUserBankAccounts;
    }
    
    public function get_user_exchange_orders($cuID) {
        $this->db->from('bf_exchanges_orders'); 
        $this->db->where('user_id', $cuID); 
        $getUserExchangeOrders               = $this->db->get();
        return $getUserExchangeOrders;
    }
    
    public function get_user_purchases($cuID) {
        $this->db->from('bf_users_purchases'); 
        $this->db->where('user_id', $cuID); 
        $getUserPurchases               = $this->db->get();
        return $getUserPurchases;
    }
    
    public function get_user_activity($cuID) {
        $this->db->from('bf'); 
        $this->db->where('user_id', $cuID); 
        $this->db->order_by('activity_id', 'DESC'); 
        $this->db->limit(20); 
        $getUserActivities               = $this->db->get();
        return $getUserActivities;
    }

    public function get_user_assets($cuID) {
        $this->db->from('bf_exchanges_assets'); 
        $this->db->where('user_id', $cuID); 
        $getUserAssets                  = $this->db->get(); 
        return $getUserAssets;
    }

    // All Listed Stocks (including Crypto)
    public function get_all_symbols()
    {
        $this->db->from('bf_investment_stock_listing');
        $this->db->order_by('symbol');
        $getSym = $this->db->get();
        return $getSym;
    }
    
    public function get_stock_symbols()
    {
        $this->db->from('bf_investment_stock_listing');
        $this->db->order_by('symbol');
        $this->db->where('type', 'Stock');
        $this->db->or_where('type', 'ETF');
        $getSym = $this->db->get();
        return $getSym;
    }
    
    public function get_active_swing_trade_alerts($type)
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('status', 'Opened');
        $this->db->where('category', 'Equity Trade');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(5);
        $getSwingTradeAlerts = $this->db->get();
        return $getSwingTradeAlerts;
    }
    
    public function get_active_option_trade_alerts($type)
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('status', 'Opened');
        $this->db->where('category', 'Option Trade');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(5);
        $getOptionTradeAlerts = $this->db->get();
        return $getOptionTradeAlerts;
    }
    
    public function get_announcements($cuType, $groupID)
    {
        $this->db->from('bf_users_posts');
        $this->db->order_by('id', 'DESC');
        if ($cuType === 'Premium') {
            $this->db->where('member_type', 'Free');
            $this->db->where('member_type', 'Premium');
        } else {
            $this->db->where('member_type', 'Free');
        }
        $this->db->where('announcement', 1);
        $this->db->where('group', $groupID);
        $this->db->limit(1);
        $getAnnouncements				= $this->db->get();
        return $getAnnouncements;
    }
    
    public function get_user_posts($groupID)
    {
        $this->db->from('bf_users_posts');
        $this->db->order_by('id', 'DESC');
        $this->db->where('announcement', 0);
        $this->db->where('group', $groupID);
        $getPosts				= $this->db->get();
        return $getPosts;
    }
    
    public function get_user_social_media_by_id($userID)
    {
        $this->db->from('bf_users_social_media');
        $this->db->where('id', $userID);
        $getSocialInfo		= $this->db->get();
        return $getSocialInfo;
    }
    
    public function get_follower_status($memberID, $cuUserID)
    {
        $this->db->from('bf_users_followers');
        $this->db->where('user_id', $memberID);
        $this->db->where('follower_id', $cuUserID);
        $getFollowStatus	= $this->db->get();
        return $getFollowStatus;
    }
    
    public function get_last_comment($postID)
    {
        $this->db->from('bf_users_posts_comments');
        $this->db->where('post_id', $postID);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $getComments				= $this->db->get();
        return $getComments;
    }
    
    public function get_last_comment_user_info($commentUserID)
    {
        $this->db->from('bf_users');
        $this->db->where('id', $commentUserID);
        $getCommentUser	= $this->db->get();
        return $getCommentUser;
    }
    
    public function get_last_comment_user_social_media($commentUserID)
    {
        $this->db->from('bf_users');
        $this->db->where('id', $commentUserID);
        $getComUserSoc	= $this->db->get();
        return $getComUserSoc;
    }
    
    public function get_remaining_user_comments($postID)
    {
        $this->db->from('bf_users_posts_comments');
        $this->db->where('post_id', $postID);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(20, 1);
        $getAddComments				= $this->db->get();
        return $getAddComments;
    }
    
    public function get_symbol_info($symbol)
    {
        $this->db->from('bf_investment_stock_listing');
        $this->db->where('symbol', $symbol);
        $getSymbolInfo = $this->db->get();
        return $getSymbolInfo;
    }
    
    public function get_post_likes($postID)
    {
        $this->db->from('bf_users_post_likes');
        $this->db->where('post_id', $postID);
        $getPostsLike					= $this->db->get();
        return $getPostsLike;
    }
    
    public function get_post_like_status($postID, $cuUserID)
    {
        $this->db->from('bf_users_post_likes');
        $this->db->where('user_id', $cuUserID);
        $this->db->where('post_id', $postID);
        $getPostLikeStatus				= $this->db->get();
        return $getPostLikeStatus;
    }
    
    public function add_investor_profile($user_id, $risk_tolerance, $bonds, $cryptos, $stocks, $forex, $futures, $cap_micro, $cap_small, $cap_mid, $cap_large, $cap_mega, $investment_strategy, $evaluation_analysis)
    {
        $user = array(
            'user_id' 					=> $user_id,
            'risk_tolerance' 			=> $risk_tolerance,
            'bonds'			 			=> $bonds,
            'cryptos'		 			=> $cryptos,
            'stocks'			 		=> $stocks,
            'forex'			 			=> $forex,
            'futures'			 		=> $futures,
            'cap_micro'			 		=> $cap_micro,
            'cap_small'			 		=> $cap_small,
            'cap_mid'			 		=> $cap_mid,
            'cap_large'			 		=> $cap_large,
            'cap_mega'			 		=> $cap_mega,
            'investment_strategy'		=> $investment_strategy,
            'evaluation_analysis'		=> $evaluation_analysis,
        );
        
        return $this->db->insert('bf_users_investor_profile', $user);
    }
    
    
    public function edit_profile($id, $email, $display_name, $username, $phone, $address, $city, $state, $country, $zipcode)
    {
        $user = array(
            'email'			 			=> $email,
            'display_name'				=> $display_name,
            'username'			 		=> $username,
            'phone'			 			=> $phone,
            'address'			 		=> $address,
            'city'			 			=> $city,
            'state'			 			=> $state,
            'country'			 		=> $country,
            'zipcode'			 		=> $zipcode,
        );
        $this->db->cache_delete('User', 'Edit_Investor_Profile');
        $this->db->cache_delete('Profile-Settings', 'Investor-Profile');
        $this->db->cache_delete('Profile-Settings', 'Investor_Profile');
        $this->db->cache_delete('Profile-Settings', 'Images');
        $this->db->cache_delete('Profile-Settings', 'Security');
        $this->db->cache_delete('Profile-Settings', 'Subscription');
        $this->db->cache_delete('Profile-Settings', 'Social_Media');
        
        $this->db->where('id', $id);
        return $this->db->update('bf_users', $user);
    }
    
    public function edit_investor_profile($email, $risk_tolerance, $investment_strategy, $evaluation_analysis, $bonds, $stocks, $forex, $futures, $cryptos, $cap_micro, $cap_small, $cap_mid, $cap_large, $cap_mega)
    {
        $user = array(
            'risk_tolerance' 			=> $risk_tolerance,
            'investment_strategy'		=> $investment_strategy,
            'evaluation_analysis'		=> $evaluation_analysis,
            'bonds'			 			=> $bonds,
            'stocks'			 		=> $stocks,
            'forex'			 			=> $forex,
            'futures'			 		=> $futures,
            'cryptos'		 			=> $cryptos,
            'cap_micro'			 		=> $cap_micro,
            'cap_small'			 		=> $cap_small,
            'cap_mid'			 		=> $cap_mid,
            'cap_large'			 		=> $cap_large,
            'cap_mega'			 		=> $cap_mega,
        );
        
        $this->db->cache_delete('User', 'Edit_Investor_Profile');
        $this->db->cache_delete('Profile-Settings', 'Investor-Profile');
        $this->db->cache_delete('Profile-Settings', 'Investor_Profile');
        $this->db->cache_delete('Profile-Settings', 'Images');
        $this->db->cache_delete('Profile-Settings', 'Security');
        $this->db->cache_delete('Profile-Settings', 'Subscription');
        $this->db->cache_delete('Profile-Settings', 'Social_Media');
        $this->db->where('email', $email);
        return $this->db->update('bf_users_investor_profile', $user);
    }
    
    public function edit_social_media($email, $facebook, $twitter, $stocktwits, $youtube, $discord)
    {
        $user = array(
            'facebook'			 		=> $facebook,
            'twitter'			 		=> $twitter,
            'stocktwits'				=> $stocktwits,
            'youtube'			 		=> $youtube,
            'discord'			 		=> $discord,
        );
        
        $this->db->cache_delete('User', 'Edit_Investor_Profile');
        $this->db->cache_delete('Profile-Settings', 'Investor-Profile');
        $this->db->cache_delete('Profile-Settings', 'Investor_Profile');
        $this->db->cache_delete('Profile-Settings', 'Images');
        $this->db->cache_delete('Profile-Settings', 'Security');
        $this->db->cache_delete('Profile-Settings', 'Subscription');
        $this->db->cache_delete('Profile-Settings', 'Social_Media');
        $this->db->where('email', $email);
        return $this->db->update('bf_users_social_media', $user);
    }
    
    public function get_user_social_media($memberEmail)
    {
        // User Social Media Information
        $this->db->from('bf_users_social_media');
        $this->db->where('email', $memberEmail);
        $getSocialInfo		= $this->db->get();
        return $getSocialInfo;
    }
    
    
    public function cancel_user($userID, $date, $extDate, $time)
    {
        $user = array(
            'user_id'					=> $userID,
            'date'						=> $date,
            'extDate'					=> $extDate,
            'time'						=> $time,
        );
        
        return $this->db->insert('bf_users_cancellations', $user);
    }
    
    public function user_cancellation($userID, $active, $reactivate)
    {
        $user = array(
            'active'					=> $active,
            'reactivate'				=> $reactivate,
        );
        
        $this->db->where('email', $userID);
        return $this->db->update('bf_users', $user);
    }
    
    public function deactivate_user($id, $active, $promote)
    {
        $user = array(
            'active'					=> $active,
            'promote'					=> $promote,
        );
        
        $this->db->where('id', $id);
        return $this->db->update('bf_users', $user);
    }
    
    public function user_upgraded($userID, $type, $date, $extDate, $time)
    {
        $user = array(
            'user_id'					=> $userID,
            'type'						=> $type,
            'date'						=> $date,
            'extDate'					=> $extDate,
            'time'						=> $time,
        );
        
        return $this->db->insert('bf_users_upgrades', $user);
    }
    
    public function upgrade_user($userID, $type)
    {
        $user = array(
            'email'						=> $userID,
            'type'						=> $type,
        );
        
        return $this->db->update('bf_users', $user);
    }
    
    public function user_downgraded($userID, $type, $date, $extDate, $time)
    {
        $user = array(
            'user_id'					=> $userID,
            'type'						=> $type,
            'date'						=> $date,
            'extDate'					=> $extDate,
            'time'						=> $time,
        );
        
        return $this->db->insert('bf_users_downgrades', $user);
    }
    
    public function downgrade_user($userID, $type)
    {
        $user = array(
            'email'						=> $userID,
            'type'						=> $type,
        );
        
        return $this->db->update('bf_users', $user);
    }
    
    public function delete_dashboard($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('bf_dashboards');
    }
   
        
    public function update_view($user_id)
    {
        $this->db->from('bf_users_social_media');
        $this->db->where('id', $user_id);
        $getUserData = $this->db->get();
        foreach ($getUserData->result_array() as $userData) {
            $viewCount									= $userData['views'];
            $newCount									= $viewCount + 1;
        }
         
        $user = array(
            'views'								=> $newCount,
        );
        $this->db->where('id', $user_id);
        return $this->db->update('bf_users_social_media', $user);
    }
}
