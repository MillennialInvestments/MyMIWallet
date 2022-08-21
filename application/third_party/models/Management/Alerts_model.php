<?php defined('BASEPATH') || exit('No direct script access allowed');

class Alerts_model extends BF_Model
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
    public function find($id = null)
    {
        $this->preFind();
        return parent::find($id);
    }

    /**
     * Find all user records and the associated role information.
     *
     * @return bool An array of objects with each user's information.
     */
    public function find_all()
    {
        $this->preFind();
        return parent::find_all();
    }
    
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
    
    public function get_free_bs_count($date)
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('category', 'Breakout Stock');
        $this->db->where('submitted_date', $date);
        $this->db->where('Free', 'Yes');
        $getFreeBSCount 						= $this->db->get();
        $FreeBSCount 							= $getFreeBSCount->num_rows();
        return $FreeBSCount;
    }
    
    public function get_alert_status_info($symbol)
    {
        $this->db->from('bf_investment_trade_alerts');
        $this->db->where('stock', $symbol);
        $getAlertInfo							= $this->db->get();
        return $getAlertInfo;
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
        
    public function add_trade($submitted_date, $time, $user_id, $username, $trading_account, $type, $symType, $stock_one, $stock_one_exchange, $stock_one_company, $category, $current_price, $potential_price, $position, $total_trade_cost, $differential, $potential_gain, $stop_loss_percent, $stop_loss_differential, $stop_loss, $option_type, $exp_day, $exp_month, $exp_year, $expiration, $option_price, $strike, $details)
    {
        $user = array(
            'submitted_date'					=> $submitted_date,
            'time'								=> $time,
            'user_id'							=> $user_id,
            'trading_account'					=> $trading_account,
            'username'							=> $username,
            'type'								=> $type,
            'symType'							=> $symType,
            'stock'								=> $stock_one,
            'exchange'							=> $stock_one_exchange,
            'company'							=> $stock_one_company,
            'category'							=> $category,
            'current_price'						=> $current_price,
            'potential_price'					=> $potential_price,
            'position'							=> $position,
            'total_trade_cost'					=> $total_trade_cost,
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
        return $this->db->insert('bf_investment_trade_alerts', $user);
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
        return $this->db->update('bf_investment_trade_alerts', $user);
    }
    
    public function close_trade($id, $last_updated, $last_updated_time, $price_high, $net_gains_per, $total_net_gains, $percent_change, $underlying_price, $gain_differntial, $updated_details)
    {
        $user = array(
            'status'							=> 'Closed',
            'closing_date'						=> $last_updated,
            'closing_time'						=> $last_updated_time,
            'price_high'						=> $price_high,
            'net_gains_per'						=> $net_gains_per,
            'total_net_gains'					=> $total_net_gains,
            'percent_change'					=> $percent_change,
            'underlying_price'					=> $underlying_price,
            'closing_gain_differential'			=> $gain_differntial,
            'closing_details'					=> $updated_details,
        );
        $this->db->where('id', $id);
        return $this->db->update('bf_investment_trade_alerts', $user);
    }
    
    public function delete_trade($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('bf_investment_trade_alerts');
    }
    
    public function add_stock($type, $symbol, $market, $company, $url_link, $tradingview_link, $website_link)
    {
        $user = array(
            'type'						=> $type,
            'symbol'					=> $symbol,
            'market'					=> $market,
            'company'					=> $company,
            'url_link'					=> $url_link,
            'tradingview_link'			=> $tradingview_link,
            'website_link'				=> $website_link,
        );
        
        return $this->db->insert('bf_investment_stock_listing', $user);
    }
        
    public function add_chart_analysis($date_submitted, $symbol, $url_link, $embed_link)
    {
        $user = array(
            'date_submitted'			=> $date_submitted,
            'symbol'					=> $symbol,
            'url_link'					=> $url_link,
            'embed_link'				=> $embed_link,
        );
        return $this->db->insert('bf_investment_chart_analysis', $user);
    }
}
