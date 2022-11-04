<?php defined('BASEPATH') || exit('No direct script access allowed');

class Tracker_model extends BF_Model
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
    // public function find($id = null)
    // {
    //     $this->preFind();
    //     return parent::find($id);
    // }

    /**
     * Find all user records and the associated role information.
     *
     * @return bool An array of objects with each user's information.
     */
    // public function find_all()
    // {
    //     $this->preFind();
    //     return parent::find_all();
    // }
    
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
    // All Listed Stocks (including Crypto)
    public function get_all_symbols()
    {
        $this->db->from('bf_investment_stock_listing');
        $this->db->order_by('symbol');
        $this->db->cache_on();
        $getSym = $this->db->get();
        return $getSym;
    }

    public function get_symbol_tickers()
    {
        $this->db->select('id, symbol, type');
        $this->db->from('bf_investment_stock_listing');
        $this->db->order_by('symbol');
        $this->db->cache_on();
        $getSym = $this->db->get()->result_array();
        return $getSym;
    }
    
    public function get_symbol_info($stockSym)
    {
        $this->db->from('bf_investment_stock_listing');
        $this->db->where('symbol', $stockSym);
        $getStockInfo 							= $this->db->get();
        return $getStockInfo;
    }
    
    public function get_user_wallets($cuID)
    {
        $this->db->select('id, broker, nickname');
        $this->db->from('bf_users_wallet');
        $this->db->where('user_id', $cuID);
        $this->db->where('default_wallet', 'No');
        $getUserWallets							= $this->db->get()->result_array();
        return $getUserWallets;
    }

    public function get_user_info($cuID)
    {
        $this->db->select('email, username');
        $this->db->from('bf_users');
        $this->db->where('id', $cuID);
        $getUserInfo							= $this->db->get();
        return $getUserInfo;
    }

    public function get_user_trades($cuID)
    {
        $this->db->select('id, order_id, trading_account_id, trading_account, trading_account_tag, order_status, category, trade_type, closed, symbol_id, symbol, symbol_tag, current_price, entry_price, close_price')
        $this->db->from('bf_users_trades');
        $this->db->where('user_id', $cuID);
        $getUserTrades 						= $this->db->get()->result_array();
        return $getUserTrades;
    }
    
    public function get_user_closed_trades($cuID)
    {
        $this->db->select_sum('net_gains');
        $this->db->from('bf_users_trades');
        $this->db->where('user_id', $cuID);
        $this->db->where('order_status', 'CLOSING');
        $getUserTrades 							= $this->db->get();
        return $getUserTrades;
    }
    
    public function get_user_trades_sum($cuID)
    {
        $this->db->select_sum('net_gains');
        $this->db->from('bf_users_trades');
        $this->db->where('user_id', $cuID);
        $this->db->where('status', 'Closed');
        $getUserTrades 							= $this->db->get();
        return $getUserTrades;
    }
    
    public function get_user_trades_percent_change($cuID)
    {
        $this->db->select_avg('percent_change');
        $this->db->from('bf_users_trades');
        $this->db->where('user_id', $cuID);
        $this->db->where('status', 'Closed');
        $getUserTrades							= $this->db->get();
        return $getUserTrades;
    }
    
    public function get_user_single_trades($tradeID)
    {
        $this->db->from('bf_users_trades');
        $this->db->where('id', $tradeID);
        $getUserTrades 						= $this->db->get();
        return $getUserTrades;
    }
    // Get All Net Gains Summary
    public function get_all_net_gains($walletID)
    {
        $this->db->select_sum('net_gains');
        $this->db->from('bf_users_trades');
        $this->db->where('trading_account', $walletID);
        $getAllNetGains							= $this->db->get();
        return $getAllNetGains;
    }
    // Get All Percent Change Summary
    public function get_all_percent_change($walletID)
    {
        $this->db->select_sum('closed_perc');
        $this->db->from('bf_users_trades');
        $this->db->where('trading_account', $walletID);
        $getAllPercentChange					= $this->db->get();
        return $getAllPercentChange;
    }
    // Get Wallet Trades
    public function get_wallet_trades($walletID)
    {
        // $this->db->select_sum('net_gains');
        $this->db->from('bf_users_trades');
        $this->db->where('wallet', $walletID);
        $getWalletTrades						= $this->db->get();
        return $getWalletTrades;
    }
    // Get Wallet Trades - Openings
    public function get_wallet_trades_openings($walletID)
    {
        // $this->db->select_sum('net_gains');
        $this->db->from('bf_users_trades');
        $this->db->where('wallet', $walletID);
        $this->db->where('order_status', 'OPENING');
        $getWalletTradesOpening					= $this->db->get();
        return $getWalletTradesOpening;
    }
    // Get Wallet Trades - Net Gains
    public function get_wallet_trades_net_gains($walletID)
    {
        $this->db->select_sum('net_gains');
        $this->db->from('bf_users_trades');
        $this->db->where('wallet', $walletID);
        $getWalletTrades						= $this->db->get();
        return $getWalletTrades;
    }
    
    // Get Net Gains Summary
    public function get_net_gains($trade_id)
    {
        $this->db->select_sum('net_gains');
        $this->db->from('bf_users_trades');
        $this->db->where('trade_id', $trade_id);
        // $this->db->where('order_status', 'CLOSING')
        $getNetGains 							= $this->db->get();
        return $getNetGains;
    }
    // Get Percent Change Summary
    public function get_percent_change($trade_id)
    {
        $this->db->select_sum('percent_change');
        $this->db->from('bf_users_trades');
        $this->db->where('trade_id', $trade_id);
        $getPercentChange						= $this->db->get();
        return $getPercentChange;
    }
    // Get Remaining Position Summary
    public function get_remaining_position($trade_id)
    {
        $this->db->select_sum('remaining_position');
        $this->db->from('bf_users_trades');
        $this->db->where('trade_id', $trade_id);
        $getRemainingPosition					= $this->db->get();
        return $getRemainingPosition;
    }
    // Get Last Remaining Position Summary
    public function get_last_remaining_position($trade_id)
    {
        $this->db->from('bf_users_trades');
        $this->db->where('trade_id', $trade_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $getLastRemainingPosition				= $this->db->get();
        return $getLastRemainingPosition;
    }
    
    // Get Other Investor's Most Recent Trades
    public function get_most_recent_trades($cuID)
    {
        $this->db->from('bf_users_trades');
        $this->db->not_like('user_id', $cuID);
        $this->db->limit(5);
        $this->db->order_by('id', 'DESC');
        $getMostRecentTrades = $this->db->get();
        return $getMostRecentTrades;
    }
    
    public function get_user_weekly_gains($cuID, $walletID)
    {
        $currentDay								= date("l");
        $todayDate		 						= date("F jS, Y");
        if ($currentDay === 'Monday') {
            $weekStart							= date("F jS, Y", time() - 60 * 60 * 24 * 7);
            //Last Week's Trades
        }
        if ($currentDay === 'Tuesday') {
            $weekStart							= date("F jS, Y", time() - 60 * 60 * 24);
            //This Week's Trades
        }
        if ($currentDay === 'Wednesday') {
            $weekStart							= date("F jS, Y", time() - 60 * 60 * 24 * 2);
            //This Week's Trades
        }
        if ($currentDay === 'Thursday') {
            $weekStart							= date("F jS, Y", time() - 60 * 60 * 24 * 3);
            //This Week's Trades
        }
        if ($currentDay === 'Friday') {
            $weekStart							= date("F jS, Y", time() - 60 * 60 * 24 * 4);
            //This Week's Trades
        }
        if ($currentDay === 'Saturday') {
            $weekStart							= date("F jS, Y", time() - 60 * 60 * 24 * 5);
            //This Week's Trades
        }
        if ($currentDay === 'Sunday') {
            $weekStart							= date("n/j/y", time() - 60 * 60 * 48 * 6);
            //This Week's Trades
        }
        $this->db->from('bf_users_trades');
        $this->db->where('user_id', $cuID);
        $this->db->where('wallet_id', $walletID);
        $this->db->where('submitted_date >=', $currentDay);
        $this->db->where('submitted_date <=', $weekStart);
        $getWeeklyGains = $this->db->get();
        return $getWeeklyGains;
    }
      
    public function get_avg_trade($cuID)
    {
        $today									= date("l");
        if ($today === 'Monday') {
            $yesterday							= date("F jS, Y", time() - 60 * 60 * 24 * 7);
            //Last Week's Trades
        }
        if ($today === 'Tuesday') {
            $yesterday							= date("F jS, Y", time() - 60 * 60 * 24);
            //This Week's Trades
        }
        if ($today === 'Wednesday') {
            $yesterday							= date("F jS, Y", time() - 60 * 60 * 24 * 2);
            //This Week's Trades
        }
        if ($today === 'Thursday') {
            $yesterday							= date("F jS, Y", time() - 60 * 60 * 24 * 3);
            //This Week's Trades
        }
        if ($today === 'Friday') {
            $yesterday							= date("F jS, Y", time() - 60 * 60 * 24 * 4);
            //This Week's Trades
        }
        if ($today === 'Saturday') {
            $yesterday							= date("F jS, Y", time() - 60 * 60 * 24 * 5);
            //This Week's Trades
        }
        if ($today === 'Sunday') {
            $yesterday							= date("n/j/y", time() - 60 * 60 * 48 * 6);
            //This Week's Trades
        }
        $this->db->from('bf_users_trades');
        $this->db->where('user_id', $cuID);
        $this->db->where('submitted_date >=', $yesterday);
        $this->db->where('submitted_date <=', $yesterday);
        $this->db->select_avg('percent_change');
        $getPerAverage = $this->db->get();
        return $getPerAverage;
    }
    
    public function get_user_stock_info($stockID)
    {
        $this->db->from('bf_users_trades');
        $this->db->where('id', $stockID);
        $getStockInfo = $this->db->get();
        return $getStockInfo;
    }
        
    public function add_trade($submitted_date, $submitted_time, $trade_date, $trade_time, $user_type, $user_id, $username, $email, $trading_account, $trade_type, $purchase_type, $symbol_type, $exchange, $symbol, $company, $link, $current_price, $price_target, $position_size, $remaining_position, $total_trade_cost, $differential, $potential_gain, $stop_loss_percent, $stop_loss_differential, $stop_loss, $option_type, $exp_day, $exp_month, $exp_year, $expiration, $option_price, $strike, $details)
    {
        $user = array(
            'submitted_date'					=> $submitted_date,
            'submitted_time'					=> $submitted_time,
            'trade_date'						=> $trade_date,
            'trade_time'						=> $trade_time,
            'user_type'							=> $user_type,
            'user_id'							=> $user_id,
            'username'							=> $username,
            'email'								=> $email,
            'trading_account'					=> $trading_account,
            'trade_type'						=> $trade_type,
            'purchase_type'						=> $purchase_type,
            'symbol_type'						=> $symbol_type,
            'exchange'							=> $exchange,
            'symbol'							=> $symbol,
            'company'							=> $company,
            'link'								=> $link,
            'total_trade_cost'					=> $total_trade_cost,
            'current_price'						=> $current_price,
            'price_target'						=> $price_target,
            'position_size'						=> $position_size,
            'remaining_position'				=> $remaining_position,
            'differential'						=> $differential,
            'potential_gain'					=> $potential_gain,
            'stop_loss_percent'					=> $stop_loss_percent,
            'stop_loss_differential'			=> $stop_loss_differential,
            'stop_loss'							=> $stop_loss,
            'option_type'						=> $option_type,
            'exp_day'							=> $exp_day,
            'exp_month'							=> $exp_month,
            'exp_year'							=> $exp_year,
            'expiration'						=> $expiration,
            'option_price'						=> $option_price,
            'strike'							=> $strike,
            'details'							=> $details,
            
        );
        return $this->db->insert('bf_users_trades', $user);
    }
    
    public function add_quick_trade($submitted_date, $submitted_time, $trade_date, $trade_time, $user_type, $user_id, $username, $email, $trading_account, $trade_type, $purchase_type, $symbol_type, $exchange, $symbol, $company, $link, $current_price, $sell_price, $position_size, $total_trade_cost, $net_gains, $percent_change, $option_type, $exp_day, $exp_month, $exp_year, $expiration, $option_price, $strike, $details)
    {
        $user = array(
            'submitted_date'					=> $submitted_date,
            'submitted_time'					=> $submitted_time,
            'trade_date'						=> $trade_date,
            'trade_time'						=> $trade_time,
            'user_type'							=> $user_type,
            'user_id'							=> $user_id,
            'username'							=> $username,
            'email'								=> $email,
            'trading_account'					=> $trading_account,
            'trade_type'						=> $trade_type,
            'purchase_type'						=> $purchase_type,
            'symbol_type'						=> $symbol_type,
            'exchange'							=> $exchange,
            'symbol'							=> $symbol,
            'company'							=> $company,
            'link'								=> $link,
            'current_price'						=> $current_price,
            'sell_price'						=> $sell_price,
            'position_size'						=> $position_size,
            'total_trade_cost'					=> $total_trade_cost,
            'net_gains'							=> $net_gains,
            'percent_change'					=> $percent_change,
            'option_type'						=> $option_type,
            'exp_day'							=> $exp_day,
            'exp_month'							=> $exp_month,
            'exp_year'							=> $exp_year,
            'expiration'						=> $expiration,
            'option_price'						=> $option_price,
            'strike'							=> $strike,
            'details'							=> $details,
            
        );
        return $this->db->insert('bf_users_trades', $user);
    }
    
    public function sell_trade($trade_id, $submitted_date, $submitted_time, $trade_date, $trade_time, $user_type, $user_id, $username, $email, $trading_account, $trade_type, $purchase_type, $symbol_type, $exchange, $symbol, $company, $link, $total_trade_cost, $purchase_price, $sell_price, $price_differential, $position_size, $net_gains, $percent_change, $original_position, $remaining_position, $underlying_price, $price_target, $target_differential, $potential_gain, $gain_differential, $stop_loss_percent, $stop_loss_differential, $stop_loss, $details)
    {
        $user = array(
            'trade_id'							=> $trade_id,
            'submitted_date'					=> $submitted_date,
            'submitted_time'					=> $submitted_time,
            'trade_date'						=> $trade_date,
            'trade_time'						=> $trade_time,
            'user_type'							=> $user_type,
            'user_id'							=> $user_id,
            'username'							=> $username,
            'email'								=> $email,
            'trading_account'					=> $trading_account,
            'trade_type'						=> $trade_type,
            'purchase_type'						=> $purchase_type,
            'symbol_type'						=> $symbol_type,
            'exchange'							=> $exchange,
            'symbol'							=> $symbol,
            'company'							=> $company,
            'link'								=> $link,
            'total_trade_cost'					=> $total_trade_cost,
            'current_price'						=> $sell_price,
            'purchase_price'					=> $purchase_price,
            'sell_price'						=> $sell_price,
            'price_differential'				=> $price_differential,
            'position_size'						=> $position_size,
            'net_gains'							=> $net_gains,
            'percent_change'					=> $percent_change,
            'original_position'					=> $original_position,
            'remaining_position'				=> $remaining_position,
            'underlying_price'					=> $underlying_price,
            'price_target'						=> $price_target,
            'target_differential'				=> $target_differential,
            'potential_gain'					=> $potential_gain,
            'gain_differential'					=> $gain_differential,
            'stop_loss_percent'					=> $stop_loss_percent,
            'stop_loss_differential'			=> $stop_loss_differential,
            'stop_loss'							=> $stop_loss,
            'details'							=> $details,
            
        );
        return $this->db->insert('bf_users_trades', $user);
    }
    
    public function close_trade($trade_id, $submitted_date, $submitted_time, $trade_date, $trade_time, $user_type, $user_id, $username, $email, $trading_account, $trade_type, $purchase_type, $symbol_type, $exchange, $symbol, $company, $link, $total_trade_cost, $purchase_price, $sell_price, $price_differential, $position_size, $net_gains, $percent_change, $original_position, $remaining_position, $underlying_price, $price_target, $target_differential, $potential_gain, $gain_differential, $stop_loss_percent, $stop_loss_differential, $stop_loss, $details)
    {
        $user = array(
            'trade_id'							=> $trade_id,
            'submitted_date'					=> $submitted_date,
            'submitted_time'					=> $submitted_time,
            'trade_date'						=> $trade_date,
            'trade_time'						=> $trade_time,
            'user_type'							=> $user_type,
            'user_id'							=> $user_id,
            'username'							=> $username,
            'email'								=> $email,
            'trading_account'					=> $trading_account,
            'trade_type'						=> $trade_type,
            'purchase_type'						=> $purchase_type,
            'symbol_type'						=> $symbol_type,
            'exchange'							=> $exchange,
            'symbol'							=> $symbol,
            'company'							=> $company,
            'link'								=> $link,
            'total_trade_cost'					=> $total_trade_cost,
            'current_price'						=> $sell_price,
            'purchase_price'					=> $purchase_price,
            'sell_price'						=> $sell_price,
            'price_differential'				=> $price_differential,
            'position_size'						=> $position_size,
            'net_gains'							=> $net_gains,
            'percent_change'					=> $percent_change,
            'original_position'					=> $original_position,
            'remaining_position'				=> $remaining_position,
            'underlying_price'					=> $underlying_price,
            'price_target'						=> $price_target,
            'target_differential'				=> $target_differential,
            'potential_gain'					=> $potential_gain,
            'gain_differential'					=> $gain_differential,
            'stop_loss_percent'					=> $stop_loss_percent,
            'stop_loss_differential'			=> $stop_loss_differential,
            'stop_loss'							=> $stop_loss,
            'details'							=> $details,
            
        );
        return $this->db->insert('bf_users_trades', $user);
    }
    
    public function update_initial_trade($trade_id, $remaining_position)
    {
        $user									= array(
            'remaining_position'				=> $remaining_position,
        );
        
        $this->db->where('id', $trade_id);
        return $this->db->update('bf_users_trades', $user);
    }
    
    public function trade_status_closed($trade_id, $status, $purchase_type, $remaining_position)
    {
        $user = array(
            'status'							=> $status,
            'purchase_type'						=> $purchase_type,
            'remaining_position'				=> $remaining_position,
        );
        
        $this->db->where('id', $trade_id);
        return $this->db->update('bf_users_trades', $user);
    }
    
    public function update_trade($id, $last_updated, $last_updated_time, $price_high, $net_gains_per, $total_net_gains, $percent_change, $underlying_price, $gain_differntial, $stop_loss_differential, $stop_loss, $updated_details)
    {
        $user = array(
            'last_updated'						=> $last_updated,
            'last_updated_time'					=> $last_updated_time,
            'price_high'						=> $price_high,
            'net_gains_per'						=> $net_gains_per,
            'total_net_gains'					=> $total_net_gains,
            'percent_change'					=> $percent_change,
            'underlying_price'					=> $underlying_price,
            'updated_gain_differential'			=> $gain_differntial,
            'updated_stop_loss_differential'	=> $stop_loss_differential,
            'updated_stop_loss'					=> $stop_loss,
            'updated_details'					=> $updated_details,
        );
        $this->db->where('id', $id);
        return $this->db->update('bf_users_trades', $user);
    }
    
    public function delete_trade($tradeID)
    {
        $this->db->where('id', $tradeID);
        return $this->db->delete('bf_users_trades');
    }
    
    public function delete_subtrade($tradeID)
    {
        $this->db->where('trade_id', $tradeID);
        return $this->db->delete('bf_users_trades');
    }
    
    public function get_all_wallet_trades($walletID)
    {
        //~ $this->db->from('bf_users_trades');
        $this->db->from('bf_users_trades');
        $this->db->where('trading_account', $walletID);
        $getClosedTrades 						= $this->db->get();
        return $getClosedTrades;
    }
    
    public function get_closed_trades($walletID)
    {
        $this->db->from('bf_users_trades');
        $this->db->where('trading_account', $walletID);
        $this->db->where('status', 'Closed');
        $getClosedTrades 						= $this->db->get();
        return $getClosedTrades;
    }
    
    public function get_todays_trades($cuID)
    {
        $today									= date("F jS, Y");
        $this->db->from('bf_users_trades');
        $this->db->where('user_id', $cuID);
        $this->db->where('submitted_date', $today);
        $this->db->where('status', 'Closed');
        $getTodaysGains							= $this->db->get();
        return $getTodaysGains;
    }
    
    public function get_last_trade_info_by_user($cuID)
    {
        $this->db->from('bf_users_trades');
        $this->db->where('user_id', $cuID);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $getLastTradeByUser						= $this->db->get();
        return $getLastTradeByUser;
    }

    public function get_trade_log_details($trade_id)
    {
        $this->db->from('bf_users_trades');
        $this->db->where('id', $trade_id);
        $this->db->or_where('trade_id', $trade_id);
        $this->db->order_by('id', 'ASC');
        $getTradeLogDetails 					= $this->db->get();
        return $getTradeLogDetails;
    }
    
    public function add_stock($type, $symbol, $market, $company, $url_link, $tradingview_link, $website_link)
    {
        $user = array(
            'type'								=> $type,
            'symbol'							=> $symbol,
            'market'							=> $market,
            'company'							=> $company,
            'url_link'							=> $url_link,
            'tradingview_link'					=> $tradingview_link,
            'website_link'						=> $website_link,
        );
        
        return $this->db->insert('bf_investment_stock_listing', $user);
    }
}
