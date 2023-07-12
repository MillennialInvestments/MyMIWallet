<?php
use Codenixsv\BittrexApi\BittrexClient;

$client = new BittrexClient();
$client->setCredential('82122111507946599fe903f058758e92', '466bfcbc6ba0425e8b429bde2eaecf13');

if ($_SERVER['SERVER_ADDR'] == $this->input->ip_address()) {
    //! The differentiation between otptions, crypto and equity comes from the apis in use
    //* Current use:
    //* bittrex (crypto pairs)
    //* ? (options)
    //* tdameritrade (equity, forex, etfs and everything else remaining; single call per array - "symbols" call)
    //? When printing back to the user, the only difference required is between options and equity - based on the current js implementation.
    //Snippet to switch elements of the array, useful for bittrex
    function moveElement(&$array, $a, $b)
    {
        $out = array_splice($array, $a, 1);
        array_splice($array, $b, 0, $out);
    }

    //This function is made to make the request, then this request gets interpolated by interpolateList, then it gets sent back as a response
    //$list:
    function curlTickers($list, $type, $client)
    {
        if ($type == "optionArray") {
        }
        if ($type == "cryptoArray") {
            //* This implementation doesn't care about which tickers are currently open
            //* as interpolating the incoming data probably takes more resources than printing 4000 lines in a db
            // Get data in this format https://api.bittrex.com/api/v1.1/public/getmarketsummaries
            $data = $client->public()->getMarketSummaries();
            $data = json_encode($data);
            $data = json_decode($data, true);
            if (!$data["success"]) {
                return array("status" => "error", "response" => $data);
            }
            $data = $data["result"];
            $response = interpolateList($data, $type);
            return array("status" => "ok", "response" => $response);
        }
        if ($type == "equityArray") {
            $curl = curl_init();
            $symbols = "";
            //Get in tdameritrade format
            foreach ($list as $symbol) {
                $symbols = $symbols . $symbol . "%2C";
            }
            $curlURL = 'https://api.tdameritrade.com/v1/marketdata/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF&symbol=' . $symbols;
            curl_setopt_array($curl, array(
                CURLOPT_URL => $curlURL,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    //~ "Authorization: Bearer qR3usBX+nmaKe1YpNAVem+rGx7itMd3v5TiuyiUTi6HseA6+LEC+lPhygGBm2cjNFutH/ElNRcXApLqRLqs+KS1zXD1B89rab6RjxDEd9Qmqey+8nhO/kMKbOoJUvFkGrJDbm1lD0uPxfpolIbTBqh7vE6qzhwe7Xs9XSdU4w75VzxYgIsn8VC6SrxfDjGM4cqlUslZbLFn3nVrV61/J8gk35G2RpL3LNHzdgulSiuAlkUIo8L9duEAJQyf5+6YO8eLQjAZwIglRVARZRW+PV3/OkatiEhplgFepTane81TY3uo0QW9G1ukRZIg8r2qSZ3Bt7KKjJVBNh46P9fT6GOPlWAx3uEcFmpCuchf0K0cmiCOMp8BLve6kHVVMBtHxBURhFQgSmCzn/pRgrqnfHxhZbDqmifNEVtN/pUm+u0iR6TFYgFKiTfFBqJBJmVvTGbVlzHhFOrX/JD9yEzES1rT1DrNEgK4Z0AyNbAjpGLZEi8+82PLGSmlviFUMJ6tSjsR+5Rj/b+KAqVlIbgTexwSVblLmEhhAU6qn8100MQuG4LYrgoVi/JHHvlw0vm7dIyDxuV7Nro4L4wZVqm8WSodlvqsu0Ko+XJSqmJzAVkO1lnPlRcFMVS8qeStqPKAkEWz3pX+DIlIxILWoUFe1IPEQ5G2X+E0xs2KcoPDCvWQAUdI4WbiX9lL5ivFaIhmX0Z9+LeYKM7roN9X5Xk+c/C5HfpabU2+HF11VqY85nlvNa1EVMmNZd65sxypTUNqs94RxV0T8yN3mqwhuCml3qos83JKa4eqeOXR2X328h2sRlpNABhgLbhKoqbiFBobX7zN3tGe/b1i6cbX0FXSET14+mHx6spbpzAAJObaYRrXLzlLs/guCRn5iqGOnlppqNMoDHvlkeSEZQ0g975o2nOWktkPXGOZ/9gXKe3GJXHMDgVoLJlBioLsM+CVYWqK1oWvUwo0t2hPidvSdEdyOPhNI7itJM6Q2pTWmBKOn0am1uEK9J1mZMNp0qz0TxYcQ5hsizsWW2cWzwqkXV2mR93uTxhp5Wq2GFAkFr5dRdo4+sd1mq8ItOaSSpvUMrIqM+cdhuIyUqlGzQ3L2rwZWcXxSFpIwIeta212FD3x19z9sWBHDJACbC00B75E"
                ),
            ));

            $rawResponse = curl_exec($curl);
            //This will be an object of objects. Luck will decide whether we'll be able to iterate through it's properties
            $error = curl_error($curl);
            //
            if (!empty($error)) {
                return array("status" => "error", "response" => $error);
            }
            $response = interpolateList(json_decode($rawResponse, true), $type);
            return array("status" => "ok", "response" => $response);
        }
    }
    //Function to turn fetched array into usable data
    //Fetched list type: php associative array
    // TD Ameritrade example: ["SPY"=>[],...] -
//
    function interpolateList($data, $type)
    {
        $returnedList = [];

        if ($type == "optionArray") {
        }
        if ($type == "cryptoArray") {
            foreach ($data as $index) {
                //We have to invert the first and the second parameter to get a standard pair
                // $tempSym = explode("-", $data[$index]["MarketName"]);
                // moveElement($tempSym, 0, 1);

                $item = array("symbol" => $data[$index]["MarketName"], "current_price" => $data[$index]["Last"], "tag" => "crypto", "category" => "equity");
                array_push($returnedList, $item);
            }
        }
        if ($type == "equityArray") {

            // * This is where the structure of what gets sent back is decided.
            // For all accessible properties, check this: https://api.tdameritrade.com/v1/marketdata/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF&symbol=SPY%2C
            foreach ($data as $ticker) {
                //TD ameritrade already filters out hollow tickers
                $item = array("symbol" => $ticker["symbol"], "current_price" => $ticker["lastPrice"], "tag" => $ticker["assetSubType"], "category" => "equity");
                array_push($returnedList, $item);
            }
        }
        return $returnedList;
    }
    $this->db->from('bf_users_trades');
    $this->db->where('closed', "false");
    //~ $this->db->where('status', 'Open');
    $getOpenTrades = $this->db->get()->result_array();
    //JSON format array
    $getTradesJSON = json_encode($getOpenTrades);
    //PHP form array
    $decodeOpenTrades = json_decode($getTradesJSON, true);
    //Create array of all arrays, to run code in an iteration
    //Contains all the requested tickers - thanks to foreach right below
    $tickerArrays = array(
            "optionArray" => [],
            "equityArray" => [],
            "cryptoArray" => [], );
    //This right here is the array which gets printed back to the end user

    foreach ($decodeOpenTrades as $order) {
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

    foreach ($tickerArrays as $type => $list) {
        $responseArray = curlTickers($list, $type, $client);
        // array = [status:"", response: []]
        if ($responseArray["status"] == "ok") {
            //Set target array - REMEMBER, THIS GOES TO THE END USER - NO OTHER DIFFERENTIATION BETWEEN OPTIONS AND TICKERS IN THE FRONTEND
            if ($type == "optionArray") {
                //Using a temp list to merge previous content of the array with the newly printed one. Only useful below because of different pulls for crypto and normal equity
                    // $this->db->where("category", "options");
                    // $this->db->replace("category", "options");
            } else {
                $table = "bf_users_trades_pricing_updates";
                foreach ($responseArray["response"] as $tickerRow) {
                    $this->db->from($table);
                    $this->db->where("symbol", $tickerRow["symbol"]);
                    $quantityCheck = $this->db->get()->result_array();
                    if (sizeof($quantityCheck) == 0) {
                        $this->db->insert($table, $tickerRow);
                    } elseif (sizeof($quantityCheck) == 1) {
                        $this->db->from($table);
                        $this->db->where("symbol", $tickerRow["symbol"]);
                        return $this->db->update($table, $tickerRow);
                    } else {
                        //Multiple rows have been pulled
                        log_message("error", "> ticker-price-server.php 168: Multiple tickers found with the same query. \n Following are the parameters used and the response object \nTable: " . $trades . "\nWHERE 'sybol' == " . $tickerRow["symbol"] . "\nResponse: " . $quantityCheck);
                    }
                        ;
                }
            }
        } elseif ($responseArray["status"] == "error") {
            //* Here is where errors are logged
            log_message("error", "> ticker-price-server.php 183: " . $responseArray["error"]);
        } //If nothing happens, for now it defaults to not doing anything
    }
    // replace the "demo" apikey below with your own key from https://www.alphavantage.co/support/#api-key
} else {
    log_message('error', 'Server IP Address is incorrect.');
    redirect("https://mymiwallet.com/Dashboard");
}
