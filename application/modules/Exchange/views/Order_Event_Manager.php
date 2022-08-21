<?php
//~ // https://example.com/exchange/USD/MYMI
header("Cache-Control: no-cache");
header("Content-Type: text/event-stream");
// Get URI from URL Segment 2 = Market Pair
$pageURIB							= $this->uri->segment(3);
// Get URI from URL Segment 3 = Market
$pageURIC							= $this->uri->segment(4);
// Get URI from URL Segment 4 = Market
$pageURID							= $this->uri->segment(5);
// Attach URI Segment 2 to $market_pair Variable
$market_pair						= $pageURIB;
// Attach URI Segment 3 to $market Variable
$market								= $pageURIC;
// Attach URI Segment 4 to $market Variable
$lastOrderID						= $pageURID;

while (true) {
    if (connection_status() != CONNECTION_NORMAL) {
        break;
    }
    $this->db->from('bf_exchanges_orders');
    $this->db->where('market_pair', $market_pair);
    $this->db->where('market', $market);
    //~ $this->db->where('status', 'Open');
    $getOpenOrders 					= $this->db->get()->result_array();
    $getOrdersJSON					= json_encode($getOpenOrders);
    $decodeOpenOrders				= json_decode($getOrdersJSON, true);
    $newOrderID						= $decodeOpenOrders[0]['id'];
    
    $output 						= "data: " . $getOrdersJSON . "\n\n";
    echo $output;
    // Set Sleep Timer to 1 a second
    ob_flush();
    flush();
    session_write_close();
    sleep(1);
}
?>

