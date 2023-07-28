<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// This class interacts with the AlphaVantage API to retrieve various types of financial data.
class AlphaVantage
{

    // Constructor function. Loads the 'curl' library.
    public function __construct() {
        $this->CI                           =& get_instance();
        $this->CI->load->library(array('curl', 'MyMICoin', 'MyMIGold', 'MyMIWallet', 'session', 'settings/settings_lib', 'Template'));
        $this->CI->load->model(array('User/exchange_model', 'User/investor_model', 'User/tracker_model', 'User/wallet_model'));
        $this->CI->load->library('users/auth');
        $cuID 								= $this->CI->auth->user_id();
        // Your AlphaVantage API Key & Base URL Link for API Request
        $api_key                            = $this->CI->config->item('alpha_vantage_free_key');
        //~ $this->CI->load->library(array('Auth', 'MyMIWallets'));
    }

    // Retrieves the global quote for a specific commodity symbol.
    public function getCommodityData($symbol) {
        // The AlphaVantage function to use.
        $function = 'GLOBAL_QUOTE';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }

    // Retrieves the balance sheet for a specific symbol.
    public function getBalanceSheet($symbol) {
        // The AlphaVantage function to use.
        $function = 'BALANCE_SHEET';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }
    
    public function getBatchStockQuotes($symbols) {
        $function = 'BATCH_STOCK_QUOTES';
        $url = "https://www.alphavantage.co/query?function=$function&symbols=$symbols&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }

    // Retrieves the company overview for a specific symbol.
    public function getCompanyOverview($symbol) {
        // The AlphaVantage function to use.
        $function = 'OVERVIEW';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }
    
    public function getCryptoDaily($symbol, $market = 'USD') {
        $function = 'DIGITAL_CURRENCY_DAILY';
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&market=$market&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
        
    public function getCryptoRating($symbol) {
        $function = 'CRYPTO_RATING';
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }

    // Retrieves a specific economic indicator.
    public function getEconomicIndicator($indicator) {
        // The AlphaVantage function to use.
        $function = 'ECONOMIC_INDICATOR';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&indicator=$indicator&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }
    
    public function getFXIntraday($from_currency, $to_currency, $interval = '60min') {
        $function = 'FX_INTRADAY';
        $url = "https://www.alphavantage.co/query?function=$function&from_symbol=$from_currency&to_symbol=$to_currency&interval=$interval&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }

    // Retrieves the foreign exchange rate between two currencies.
    public function getFXRate($from_currency, $to_currency) {
        // The AlphaVantage function to use.
        $function = 'CURRENCY_EXCHANGE_RATE';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&from_currency=$from_currency&to_currency=$to_currency&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }

    // Retrieves the global quote for a specific symbol.
    public function getGlobalQuote($symbol) {
        // The AlphaVantage function to use.
        $function = 'GLOBAL_QUOTE';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }

    // Retrieves the income statement for a specific symbol.
    public function getIncomeStatement($symbol) {
        // The AlphaVantage function to use.
        $function = 'INCOME_STATEMENT';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }

    // Retrieves the news sentiment for a specific symbol.
    public function getNewsSentiment($symbol) {
        // The AlphaVantage function to use.
        $function = 'NEWS_SENTIMENT';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }

    public function getSectorPerformance() {
        $function = 'SECTOR';
        $url = "https://www.alphavantage.co/query?function=$function&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }

    // Retrieves a specific technical indicator for a specific symbol.
    public function getTechnicalIndicator($symbol, $indicator, $interval = 'daily', $time_period = 10, $series_type = 'close') {
        // The AlphaVantage function to use.
        $function = strtoupper($indicator);

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&interval=$interval&time_period=$time_period&series_type=$series_type&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }

    // Retrieves intraday time series data for a specific symbol.
    public function getTimeSeriesIntraday($symbol, $interval = '10min') {
        // The AlphaVantage function to use.
        $function = 'TIME_SERIES_INTRADAY';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&interval=$interval&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }

    // Retrieves daily time series data for a specific symbol.
    public function getTimeSeriesDaily($symbol) {
        // The AlphaVantage function to use.
        $function = 'TIME_SERIES_DAILY';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }

    // Retrieves weekly time series data for a specific symbol.
    public function getTimeSeriesWeekly($symbol) {
        // The AlphaVantage function to use.
        $function = 'TIME_SERIES_WEEKLY';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }

    // Retrieves monthly time series data for a specific symbol.
    public function getTimeSeriesMonthly($symbol) {
        // The AlphaVantage function to use.
        $function = 'TIME_SERIES_MONTHLY';

        // The URL to send the GET request to.
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";

        // Send the GET request and store the response.
        $response = $this->curl->simple_get($url);

        // If a response was received...
        if ($response) {
            // Decode the JSON response into an associative array.
            $data = json_decode($response, true);

            // If an error message was included in the response...
            if (isset($data['Error Message'])) {
                // Log the error message.
                log_message('error', 'AlphaVantage API error: ' . $data['Error Message']);

                // Return false to indicate that an error occurred.
                return false;
            }

            // Return the data from the response.
            return $data;
        } else {
            // If no response was received, log an error message.
            log_message('error', 'Failed to get response from AlphaVantage API');

            // Return false to indicate that an error occurred.
            return false;
        }
    }
    
    public function getSymbolSearch($keywords) {
        $function = 'SYMBOL_SEARCH';
        $url = "https://www.alphavantage.co/query?function=$function&keywords=$keywords&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
    
    public function getCryptoWeekly($symbol, $market = 'USD') {
        $function = 'DIGITAL_CURRENCY_WEEKLY';
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&market=$market&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
    
    public function getCryptoMonthly($symbol, $market = 'USD') {
        $function = 'DIGITAL_CURRENCY_MONTHLY';
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&market=$market&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
    
    public function getFXWeekly($from_currency, $to_currency) {
        $function = 'FX_WEEKLY';
        $url = "https://www.alphavantage.co/query?function=$function&from_symbol=$from_currency&to_symbol=$to_currency&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
    
    public function getFXMonthly($from_currency, $to_currency) {
        $function = 'FX_MONTHLY';
        $url = "https://www.alphavantage.co/query?function=$function&from_symbol=$from_currency&to_symbol=$to_currency&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
    
    public function getMutualFundDaily($symbol) {
        $function = 'TIME_SERIES_DAILY';
        $url = "https://www.alphavantage.co/query?function=$function&symbol=$symbol&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
    
    public function getIPOCalendar() {
        $function = 'IPO_CALENDAR';
        $url = "https://www.alphavantage.co/query?function=$function&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
    
    public function getEarningsCalendar() {
        $function = 'EARNINGS_CALENDAR';
        $url = "https://www.alphavantage.co/query?function=$function&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
    
    public function getListingDelistingStatus() {
        $function = 'LISTING_DELISTING_STATUS';
        $url = "https://www.alphavantage.co/query?function=$function&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
    
    public function getInternationalExchanges() {
        $function = 'INTERNATIONAL_EXCHANGES';
        $url = "https://www.alphavantage.co/query?function=$function&apikey={$this->api_key}";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }
    
}
