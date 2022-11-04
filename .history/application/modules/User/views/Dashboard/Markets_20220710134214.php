<?php
$pageURIA                       = $this->uri->segment(1);
$pageURIB                       = $this->uri->segment(2);
$pageURIC                       = $this->uri->segment(3);
$pageURID                       = $this->uri->segment(4);
$pageURIE                       = $this->uri->segment(5);
$marketType                     = $pageURIB; 
$date						    = date("m/d/Y");
if ($marketType === 'US-Markets') {
    $marketTitle                = 'US Financial Markets';
    $marketView                 = 'User/Dashboard/index/US_Market_Overview'; 
    $marketOverview             = 'User/Dashboard/Markets/Market_Overview';
    $marketOverviewTitle        = 'US Financial Market Overview'; 

} elseif ($marketType === 'Additional-Markets') {
    $marketTitle                = 'Additional US Markets';
    $marketView                 = 'User/Dashboard/index/US_Additional_Overview'; 
    $marketOverview             = 'User/Dashboard/Markets/Market_Overview';
    $marketOverviewTitle        = 'Additional US Financial Market Overview'; 

    $curl 						= curl_init();
    $symbols					= '%24VIX.X%2C%2FDXY%2C%2FCL%2C%2FBZ%2C%2FHG';
    $curlURL					= 'https://api.tdameritrade.com/v1/marketdata/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF&symbol=' . $symbols . '&interval=1min';
    curl_setopt_array($curl, array(
      CURLOPT_URL 				=> $curlURL,
      CURLOPT_RETURNTRANSFER	=> true,
      CURLOPT_TIMEOUT 			=> 30,
      CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST 	=> "GET",
      CURLOPT_HTTPHEADER 		=> array(
        "cache-control: no-cache",
        //~ "Authorization: Bearer qR3usBX+nmaKe1YpNAVem+rGx7itMd3v5TiuyiUTi6HseA6+LEC+lPhygGBm2cjNFutH/ElNRcXApLqRLqs+KS1zXD1B89rab6RjxDEd9Qmqey+8nhO/kMKbOoJUvFkGrJDbm1lD0uPxfpolIbTBqh7vE6qzhwe7Xs9XSdU4w75VzxYgIsn8VC6SrxfDjGM4cqlUslZbLFn3nVrV61/J8gk35G2RpL3LNHzdgulSiuAlkUIo8L9duEAJQyf5+6YO8eLQjAZwIglRVARZRW+PV3/OkatiEhplgFepTane81TY3uo0QW9G1ukRZIg8r2qSZ3Bt7KKjJVBNh46P9fT6GOPlWAx3uEcFmpCuchf0K0cmiCOMp8BLve6kHVVMBtHxBURhFQgSmCzn/pRgrqnfHxhZbDqmifNEVtN/pUm+u0iR6TFYgFKiTfFBqJBJmVvTGbVlzHhFOrX/JD9yEzES1rT1DrNEgK4Z0AyNbAjpGLZEi8+82PLGSmlviFUMJ6tSjsR+5Rj/b+KAqVlIbgTexwSVblLmEhhAU6qn8100MQuG4LYrgoVi/JHHvlw0vm7dIyDxuV7Nro4L4wZVqm8WSodlvqsu0Ko+XJSqmJzAVkO1lnPlRcFMVS8qeStqPKAkEWz3pX+DIlIxILWoUFe1IPEQ5G2X+E0xs2KcoPDCvWQAUdI4WbiX9lL5ivFaIhmX0Z9+LeYKM7roN9X5Xk+c/C5HfpabU2+HF11VqY85nlvNa1EVMmNZd65sxypTUNqs94RxV0T8yN3mqwhuCml3qos83JKa4eqeOXR2X328h2sRlpNABhgLbhKoqbiFBobX7zN3tGe/b1i6cbX0FXSET14+mHx6spbpzAAJObaYRrXLzlLs/guCRn5iqGOnlppqNMoDHvlkeSEZQ0g975o2nOWktkPXGOZ/9gXKe3GJXHMDgVoLJlBioLsM+CVYWqK1oWvUwo0t2hPidvSdEdyOPhNI7itJM6Q2pTWmBKOn0am1uEK9J1mZMNp0qz0TxYcQ5hsizsWW2cWzwqkXV2mR93uTxhp5Wq2GFAkFr5dRdo4+sd1mq8ItOaSSpvUMrIqM+cdhuIyUqlGzQ3L2rwZWcXxSFpIwIeta212FD3x19z9sWBHDJACbC00B75E"
      ),
    ));

    $response 					= curl_exec($curl);
    $err 						= curl_error($curl);

    curl_close($curl);
    $response 					= json_decode($response, true); //because of true, it's in an array
} elseif ($marketType === 'International-Markets') {
    $marketTitle                = 'International Markets';
    $marketView                 = 'User/Dashboard/index/International_Market_Overview'; 
    $marketOverview             = 'User/Dashboard/Markets/Market_Overview';
    $marketOverviewTitle        = 'International Financial Market Overview'; 
    $curl 						= curl_init();
    $symbols					= '%24FTSE%2C%2FNKD%2C%24DAX%2C%24HSI';
    $curlURL					= 'https://api.tdameritrade.com/v1/marketdata/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF&symbol=' . $symbols . '&interval=1min';
    curl_setopt_array($curl, array(
      CURLOPT_URL 				=> $curlURL,
      CURLOPT_RETURNTRANSFER	=> true,
      CURLOPT_TIMEOUT 			=> 30,
      CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST 	=> "GET",
      CURLOPT_HTTPHEADER 		=> array(
        "cache-control: no-cache",
        //~ "Authorization: Bearer qR3usBX+nmaKe1YpNAVem+rGx7itMd3v5TiuyiUTi6HseA6+LEC+lPhygGBm2cjNFutH/ElNRcXApLqRLqs+KS1zXD1B89rab6RjxDEd9Qmqey+8nhO/kMKbOoJUvFkGrJDbm1lD0uPxfpolIbTBqh7vE6qzhwe7Xs9XSdU4w75VzxYgIsn8VC6SrxfDjGM4cqlUslZbLFn3nVrV61/J8gk35G2RpL3LNHzdgulSiuAlkUIo8L9duEAJQyf5+6YO8eLQjAZwIglRVARZRW+PV3/OkatiEhplgFepTane81TY3uo0QW9G1ukRZIg8r2qSZ3Bt7KKjJVBNh46P9fT6GOPlWAx3uEcFmpCuchf0K0cmiCOMp8BLve6kHVVMBtHxBURhFQgSmCzn/pRgrqnfHxhZbDqmifNEVtN/pUm+u0iR6TFYgFKiTfFBqJBJmVvTGbVlzHhFOrX/JD9yEzES1rT1DrNEgK4Z0AyNbAjpGLZEi8+82PLGSmlviFUMJ6tSjsR+5Rj/b+KAqVlIbgTexwSVblLmEhhAU6qn8100MQuG4LYrgoVi/JHHvlw0vm7dIyDxuV7Nro4L4wZVqm8WSodlvqsu0Ko+XJSqmJzAVkO1lnPlRcFMVS8qeStqPKAkEWz3pX+DIlIxILWoUFe1IPEQ5G2X+E0xs2KcoPDCvWQAUdI4WbiX9lL5ivFaIhmX0Z9+LeYKM7roN9X5Xk+c/C5HfpabU2+HF11VqY85nlvNa1EVMmNZd65sxypTUNqs94RxV0T8yN3mqwhuCml3qos83JKa4eqeOXR2X328h2sRlpNABhgLbhKoqbiFBobX7zN3tGe/b1i6cbX0FXSET14+mHx6spbpzAAJObaYRrXLzlLs/guCRn5iqGOnlppqNMoDHvlkeSEZQ0g975o2nOWktkPXGOZ/9gXKe3GJXHMDgVoLJlBioLsM+CVYWqK1oWvUwo0t2hPidvSdEdyOPhNI7itJM6Q2pTWmBKOn0am1uEK9J1mZMNp0qz0TxYcQ5hsizsWW2cWzwqkXV2mR93uTxhp5Wq2GFAkFr5dRdo4+sd1mq8ItOaSSpvUMrIqM+cdhuIyUqlGzQ3L2rwZWcXxSFpIwIeta212FD3x19z9sWBHDJACbC00B75E"
      ),
    ));

    $response 					= curl_exec($curl);
    $err 						= curl_error($curl);

    curl_close($curl);
    $response 					= json_decode($response, true); //because of true, it's in an array
} elseif ($marketType === 'Crypto-Markets') {
    $marketTitle                = 'Crypto Markets';
    $marketView                 = 'User/Dashboard/index/Crypto_Market_Overview'; 
    $marketOverview             = 'User/Dashboard/Content_Coming_Soon';
    $marketOverviewTitle        = 'Crypto Financial Market Overview'; 
    $response                   = array(); 
} elseif ($marketType === 'MyMI-Markets') {
    $marketTitle                = 'MyMI Markets';
    $marketView                 = 'User/Dashboard/index/MyMI_Market_Overview'; 
    $marketOverview             = 'User/Dashboard/Content_Coming_Soon';
    $marketOverviewTitle        = 'MyMI Financial Market Overview'; 
    $response                   = array(); 
}
$dashboardData          = array(
    'marketType'        => $marketType,
    'marketTitle'       => $marketTitle,
    'marketOverview'    => $marketOverview,
    'overviewTitle'     => $marketOverviewTitle,
    'date'              => $date,
    'response'          => $response,
);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<?php $this->load->view('User/Dashboard/Markets/header', $dashboardData); ?>
		</div>
		<div class="col-12 col-md-3">
            <?php $this->load->view($marketView, $dashboardData); ?>
		</div>
		<div class="col-12 col-md-9">
			<?php $this->load->view('User/Dashboard/Markets/Announcements', $dashboardData); ?>
		</div>
	</div>
    <hr>
    <div class="row gy-gs">
        <div class="col-md-12 mb-3">
            <?php $this->load->view($marketOverview, $dashboardData); ?>
        </div>
    </div>
</div>