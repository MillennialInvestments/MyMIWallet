<?php
header("Cache-Control: no-cache");
header("Content-Type: text/event-stream");

//! The differentiation between otptions, crypto and equity comes from the apis in use
//* Current use:
//* check ticker-price-server.php
//* This script serves the data to the user, temporary until we get an api going.
//? When printing back to the user, the only difference required is between options and equity - based on the current js implementation.

while (true) {
    if (connection_status() != CONNECTION_NORMAL) {
        break;
    }

    $this->db->from('bf_users_trades');
    $this->db->where('user_id', $_SESSION['user_id']);
    $this->db->where('closed', 'false');
    $getOpenTrades = $this->db->get()->result_array();

    $getOpenTrades = json_encode($getOpenTrades);
    $openTrades = json_decode($getOpenTrades, true);

    //Create array of all arrays, to run code in an iteration
    //Contains all the requested tickers - thanks to foreach right below
    $tickerArrays = array(
        "optionArray" => [],
        "equityArray" => [],
        "cryptoArray" => [], );
    //This right here is the array which gets printed back to the end user
    $output = array("options" => [], "equity" => []);

    foreach ($openTrades as $order) {
        $symbol = $order["symbol"];
        if ($order["category"] == "option_buy" || $order["category"] == "option_sell") {
            // If it's not in the array, push it there
            if (!in_array($symbol, $tickerArrays["optionArray"])) {
                array_push($tickerArrays["optionArray"], $symbol);
            }
        } elseif ($order["symbol_tag"] == "crypto") {
            if (!in_array($symbol, $tickerArrays["cryptoArray"])) {
                array_push($tickerArrays["cryptoArray"], $symbol);
            }
        } else {
            if (!in_array($symbol, $tickerArrays["equityArray"])) {
                array_push($tickerArrays["equityArray"], $symbol);
            }
        }
    }
    $responseArray = [];
    foreach ($tickerArrays as $type => $list) {
        // $responseArray = curlTickers($list, $type,$this);

        if ($type == "optionArray") {
        }
        if ($type == "equityArray" || $type == "cryptoArray") {
            $table = "bf_users_trades_pricing_updates";
            $response = [];
            foreach ($list as $pointer => $symbol) {
                $this->db->from($table);
                $this->db->where('symbol', $symbol);
                $resultTicker = $this->db->get()->result_array();
                $response = array_merge($response, $resultTicker);
            }
            
            //! Currently not handling errors
            //  NO NEED FOR INTERPOLATION AS WE ARE PULLING FROM OUR DATABASE CURRENTLY
        }
        if (!empty($error)) {
            $responseArray = array("status" => "error", "response" => $error);
        } else {
            if (empty($resultTicker)) {
                $responseArray = array("status" => "empty", "response" => $response);
            } else {
                $responseArray = array("status" => "ok", "response" => $response);
            }
        }
        // array = [status:"", response: []]
        if ($responseArray["status"] == "ok") {
            //TODO: Handle response
            //* Attach the response array to an object to pass back to the end user.
            //Set target array - REMEMBER, THIS GOES TO THE END USER - NO OTHER DIFFERENTIATION BETWEEN OPTIONS AND TICKERS IN THE FRONTEND
            if ($type == "optionArray") {
                //Using a temp list to merge previous content of the array with the newly printed one. Only useful below because of different pulls for crypto and normal equity
                if ($output["options"]== []) {
                    $output["options"] = $responseArray["response"];
                } else {
                    $tempNewList = array_merge($output["options"], $responseArray["response"]);
                    $output["options"] = $tempNewList;
                }
            } else {
                if ($output["equity"]== []) {
                    $output["equity"] = $responseArray["response"];
                }
                $tempNewList = array_merge($output["equity"], $responseArray["response"]);
                $output["equity"] = $tempNewList;
            }
        } elseif ($responseArray["status"] == "empty") {
            $output = array("empty" => "true");
        } elseif ($responseArray["status"] == "error") {
            echo "data: v23:47 - An error occourred, this was the error message: " . $responseArray . "\n\n";
            ob_flush();
            flush();
            session_write_close();
            //Break foreach, break while
            break 2;
        } else {
        }
    }
    echo "data:" . json_encode($output) . "\n\n";
    ob_flush();
    flush();
    session_write_close();
    // Set Sleep Timer to 1 a second
    sleep(1);
}
