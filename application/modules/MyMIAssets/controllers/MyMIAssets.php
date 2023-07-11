<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DigiAssets extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('DigiAssetCreator');
        $this->load->library('DigiAssetExchange');
        $this->load->model('Assets_model');
    }

    public function index()
    {
        // List tradable assets
        $data['assets'] = $this->DigiAssetExchange->listTradableAssets();

        // Load the view
        $this->load->view('digiassets_view', $data);
    }

    public function create_asset()
    {
        // Create a new asset
        $name = 'Sample Asset';
        $description = 'This is a sample asset for demonstration purposes.';
        $initial_value = 1000.00;
        $this->DigiAssetCreator->createDigiAsset($name, $description, $initial_value);
    }

    public function get_asset($asset_id)
    {
        // Get asset details
        $data['asset'] = $this->DigiAssetCreator->getDigiAsset($asset_id);

        // Load the view
        $this->load->view('digiasset_view', $data);
    }

    // Add other controller methods for remaining functions as needed.
    public function create_auction($asset_id, $start_price, $min_increment)
    {
        $this->DigiAssetCreator->createAuction($asset_id, $start_price, $min_increment);
    }

    public function place_bid($auction_id, $user_id, $amount)
    {
        $this->DigiAssetCreator->placeBid($auction_id, $user_id, $amount);
    }

    public function end_auction($auction_id)
    {
        $this->DigiAssetCreator->endAuction($auction_id);
    }

    public function list_open_orders()
    {
        $data['open_orders'] = $this->DigiAssetExchange->listOpenOrders();
        $this->load->view('open_orders_view', $data);
    }

    public function place_buy_order($user_id, $asset_id, $quantity, $price)
    {
        $this->DigiAssetExchange->placeBuyOrder($user_id, $asset_id, $quantity, $price);
    }

    public function place_sell_order($user_id, $asset_id, $quantity, $price)
    {
        $this->DigiAssetExchange->placeSellOrder($user_id, $asset_id, $quantity, $price);
    }

    public function cancel_order($user_id, $order_id)
    {
        $this->DigiAssetExchange->cancelOrder($user_id, $order_id);
    }

    public function get_user_open_orders($user_id)
    {
        $data['user_open_orders'] = $this->DigiAssetExchange->getUserOpenOrders($user_id);
        $this->load->view('user_open_orders_view', $data);
    }

    public function get_user_trade_history($user_id)
    {
        $data['user_trade_history'] = $this->DigiAssetExchange->getUserTradeHistory($user_id);
        $this->load->view('user_trade_history_view', $data);
    }

    public function transfer_assets($sender_id, $recipient_id, $asset_id, $quantity)
    {
        $this->DigiAssetExchange->transferAssets($sender_id, $recipient_id, $asset_id, $quantity);
    }
}