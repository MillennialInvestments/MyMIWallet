<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Assets_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Add other methods for interacting with the assets table as needed, such as addAsset()

    public function getAllAssets() {
        $this->db->from('bf_exchange_assets');
        $query = $this->db->get();

        return $query->result_array();
    }

    // Get asset details by asset ID
    public function getAsset($assetID)
    {
        $query = $this->db->get_where('bf_exchanges_assets', array('id' => $assetID));
        return $query->row_array();
    }

    // Get all tradable assets
    public function listTradableAssets()
    {
        $query = $this->db->get_where('bf_exchanges_assets', array('is_tradable' => 1));
        return $query->result_array();
    }

    // Get closed trade history for a specified asset
    public function getClosedTradeHistory($assetID)
    {
        $this->db->select('*');
        $this->db->from('bf_users_trades');
        $this->db->where('asset_id', $assetID);
        $this->db->where('status', 'closed');
        $query = $this->db->get();

        return $query->result_array();
    }

    // Get wallet private key by user ID
    public function getPrivateKey($userID)
    {
        $query = $this->db->get_where('wallets', array('user_id' => $userID));
        $wallet = $query->row_array();

        if ($wallet) {
            return $wallet['private_key'];
        }

        return null;
    }

    // Get wallet address by user ID
    public function getAddress($userID)
    {
        $query = $this->db->get_where('wallets', array('user_id' => $userID));
        $wallet = $query->row_array();

        if ($wallet) {
            return $wallet['address'];
        }

        return null;
    }

    // Get user open orders by user ID
    public function getUserOpenOrders($userID)
    {
        $this->db->select('*');
        $this->db->from('bf_exchanges_orders');
        $this->db->where('user_id', $userID);
        $this->db->where('status', 'open');
        $query = $this->db->get();

        return $query->result_array();
    }

    // Get user trade history by user ID
    public function getUserTradeHistory($userID)
    {
        $this->db->select('*');
        $this->db->from('bf_users_trades');
        $this->db->where('user_id', $userID);
        $query = $this->db->get();

        return $query->result_array();
    }

    // Create auction
    public function createAuction($assetID, $startPrice, $minIncrement)
    {
        $data = array(
            'asset_id' => $assetID,
            'start_price' => $startPrice,
            'min_increment' => $minIncrement,
            'status' => 'open'
        );

        $this->db->insert('bf_auctions', $data);
        return $this->db->insert_id();
    }

    // Get auction details by auction ID
    public function getAuction($auctionID)
    {
        $query = $this->db->get_where('bf_auctions', array('id' => $auctionID));
        return $query->row_array();
    }

    // Place a bid
    public function placeBid($userID, $auctionID, $amount)
    {
        $data = array(
            'user_id' => $userID,
            'auction_id' => $auctionID,
            'amount' => $amount
        );

        $this->db->insert('bids', $data);
        return $this->db->insert_id();
    }

    // End auction by auction ID
    public function endAuction($auctionID)
    {
        $data = array(
            'status' => 'closed'
        );

        $this->db->update('bf_auctions', $data, array('id' => $auctionID));
    }
}