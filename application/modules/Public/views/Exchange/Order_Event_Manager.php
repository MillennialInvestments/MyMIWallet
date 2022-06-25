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
//~ while (true) {
    //~ $getAllOpenOrders				= $this->exchange_model->get_all_open_orders($market_pair, $market);
    //~ $getOrdersJSON					= json_encode($getAllOpenOrders);
    //~ $decodeOpenOrders				= json_decode($getOrdersJSON, true);
    //~ $newOrderID						= $decodeOpenOrders[0]['id'];
    //~ if ($newOrderID > $lastOrderID) {
        //~ $output = "data:{$getOrdersJSON}\n\n";
        //~ $this->output->set_content_type('text/event-stream');
        //~ $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        //~ $lastOrderID 				= $newOrderID;
    //~ }
    //~ // Set Sleep Timer to 1 a second
    //~ flush();
    //~ if ( connection_aborted() ) break;
    //~ sleep('1');
//~ }
                                  
    $getAllOpenOrders				= $this->api_model->get_all_open_orders($market_pair, $market);
    $getOrdersJSON					= json_encode($getAllOpenOrders);
    print_r($getAllOpenOrders);
    $output = "data: " . json_encode($getOrdersJSON) . "\n\n";
    echo $output;
    $lastOrderID 				= $newOrderID;
    // Set Sleep Timer to 1 a second
    flush();
