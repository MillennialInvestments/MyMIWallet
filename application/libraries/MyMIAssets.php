<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load BitcoinJS library for DigiByte
require_once('path/to/bitcoinjs-lib.php');

class MyMIAssets {

    protected $bitcoinJS;

    public function __construct() {
        // Initialize BitcoinJS for DigiByte
        $this->bitcoinJS = new BitcoinJS();
        $this->bitcoinJS->initializeDigiByte();

        // Load the Assets_model, Auctions_model, and Bids_model
        $this->CI->load->model('User/Assets_model');
        // $this->CI->load->model('Auctions_model');
        // $this->CI->load->model('Bids_model');
    }

    public function createDigiAsset() {
        // Example code for creating a Digi Asset using BitcoinJS
        // Check if the DigiByte Core wallet is running and available
        if (!$this->isDigiByteCoreAvailable()) {
            throw new Exception('DigiByte Core wallet is not available');
        }

        // Generate a new DigiByte address to issue the asset
        $issuerAddress = $this->getNewAddress();

        // Create a Digi Asset issuance transaction
        $transactionHex = $this->createAssetIssuanceTransaction($issuerAddress, $name, $amount, $metadata);

        // Sign the transaction
        $signedTransactionHex = $this->signTransaction($transactionHex);

        // Broadcast the transaction
        $transactionId = $this->sendTransaction($signedTransactionHex);

        // Store the asset information in the database (assumes you have an Assets_model)
        $assetId = $this->CI->Assets_model->addAsset($name, $issuerAddress, $amount, $metadata, $transactionId);

        // Return the asset ID from the database
        return $assetId;
    }

    public function listDigiAssets() {
        // Example code for listing Digi Assets from the database

        // Fetch the list of Digi Assets from the database
        $assets = $this->CI->Assets_model->getAllAssets();

        // Return the list of Digi Assets
        return $assets;
    }

    public function listTradableAssets()
    {
        // Load the database library
        $this->CI->load->database();

        // Prepare the query to fetch tradable assets
        $this->CI->db->select('id, symbol, name');
        $this->CI->db->from('assets');
        $this->CI->db->where('is_tradable', 1);

        // Execute the query
        $query = $this->CI->db->get();

        // Return the result as an array of objects
        return $query->result();
    }

    public function getDigiAsset($assetID) {
        // Fetch the Digi Asset details from the database
        $asset = $this->CI->Assets_model->getAssetById($assetID);
    
        // Check if the asset was found
        if (!$asset) {
            throw new Exception('Digi Asset not found');
        }
    
        // Return the Digi Asset details
        return $asset;
    }

    public function getAssetPrice($assetID)
    {
        // Load the database library
        $this->CI->load->database();

        // Fetch the symbol for the assetID from the database
        $this->CI->db->select('symbol');
        $this->CI->db->from('assets');
        $this->CI->db->where('id', $assetID);

        $query = $this->CI->db->get();
        $result = $query->row();

        // Check if the asset is found
        if ($result) {
            $symbol = $result->symbol;

            // Fetch the asset price from the CoinGecko API
            $url = "https://api.coingecko.com/api/v3/simple/price?ids={$symbol}&vs_currencies=usd";
            $response = file_get_contents($url);
            $priceData = json_decode($response, true);

            // Return the asset price in USD
            if (isset($priceData[$symbol]['usd'])) {
                return $priceData[$symbol]['usd'];
            }
        }

        // Return null if the asset price is not found or an error occurs
        return null;
    }

    public function createAuction($assetID, $startPrice, $minIncrement) {
        // Example code for creating an auction for the specified Digi Asset

        // Fetch the Digi Asset details from the database
        $asset = $this->CI->Assets_model->getAssetById($assetID);

        // Check if the asset was found
        if (!$asset) {
            throw new Exception('Digi Asset not found');
        }

        // Create a new auction record in the database
        $auctionID = $this->CI->assets_model->addAuction($assetID, $startPrice, $minIncrement);

        // Return the auction ID from the database
        return $auctionID;
    }

    public function placeBid($auctionID, $userID, $amount) {
        // Example code for placing a bid on an auction

        // Fetch the auction details from the database
        $auction = $this->CI->assets_model->getAuctionById($auctionID);

        // Check if the auction was found
        if (!$auction) {
            throw new Exception('Auction not found');
        }

        // Check if the bid amount is valid (greater than the current highest bid + minimum increment)
        $highestBid = $this->CI->assets_model->getHighestBid($auctionID);
        if ($amount <= ($highestBid['amount'] + $auction['min_increment'])) {
            throw new Exception('Bid amount is too low');
        }

        // Create a new bid record in the database
        $bidID = $this->CI->assets_model->addBid($auctionID, $userID, $amount);

        // Return the bid ID from the database
        return $bidID;
    }

    public function endAuction($auctionID) {
        // Example code for ending an auction and transferring Digi Assets to the highest bidder

        // Fetch the auction details from the database
        $auction = $this->CI->assets_model->getAuctionById($auctionID);

        // Check if the auction was found
        if (!$auction) {
            throw new Exception('Auction not found');
        }

        // Get the highest bid for the auction
        $highestBid = $this->CI->assets_model->getHighestBid($auctionID);

        // Check if there is a winning bid
        if (!$highestBid) {
            throw new Exception('No bids placed on this auction');
        }

        // Update the auction record with the winner and set the status to 'ended'
        $this->CI->assets_model->endAuction($auctionID, $highestBid['user_id']);

        // Return the winning bid details
        return $highestBid;
    }
}