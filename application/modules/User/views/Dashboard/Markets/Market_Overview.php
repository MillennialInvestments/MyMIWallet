<?php
$curl 						= curl_init();
$symbols					= '%24DJI%2C%2FYM%2C%2FES%2C%2FNQ%2C%2FRTY%2C%24VIX.X%2C%2FDXY%2C%2FCL%2C%2FBZ%2C%2FHG%2C%24FTSE%2C%2FNKD%2C%24DAX%2C%24HSI';
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
// Get EURO Stoxx 50 Variable
$date						= date("m/d/Y");

// // Variables
// $dji_mark					= $response['/YM']['mark'];
// $dji_netChange				= $response['/YM']['changeInDouble'];
// $dji_perChange				= $response['/YM']['futurePercentChange'] * 100;
// $sp_mark					= $response['/ES']['mark'];
// $sp_netChange				= $response['/ES']['changeInDouble'];
// $sp_perChange				= $response['/ES']['futurePercentChange'] * 100;
// $ndx_mark					= $response['/NQ']['mark'];
// $ndx_netChange				= $response['/NQ']['changeInDouble'];
// $ndx_perChange				= $response['/NQ']['futurePercentChange'] * 100;
// $rut_mark					= $response['/RTY']['mark'];
// $rut_netChange				= $response['/RTY']['changeInDouble'];
// $rut_perChange				= $response['/RTY']['futurePercentChange'] * 100;

// // Variables
// if (!empty($response['$DX'])) {
//     $dx_mark					= $response['/DXY']['lastPrice'];
//     $dx_perChange				= round($response['/DXY']['percentChange'], 2);
//     $dx_netChange               = $response['/DXY']['changeInDouble'];
//     $dx							= $dx_perChange * -1;
// } else {
//     $dx_mark                = 0;
//     $dx_perChange           = 0;
//     $dx_netChange           = 0;
//     $dx                     = 0;
// }
// // print_r($response['/CL']); 
// $vix_mark					= $response['$VIX.X']['lastPrice'];
// $vix_netChange			    = $response['$VIX.X']['netChange'];
// $vix_perChange				= round($response['$VIX.X']['netPercentChangeInDouble'], 2);
// $vix						= $vix_perChange * -1;
// $cl_mark					= $response['/CL']['mark'];
// $cl_netChange				= $response['/CL']['changeInDouble'];
// $cl_perChange				= $response['/CL']['futurePercentChange'] * 100;
// $bz_mark					= $response['/BZ']['mark'];
// $bz_netChange               = $response['/BZ']['changeInDouble'];
// $bz_perChange				= $response['/BZ']['futurePercentChange'] * 100;
// $hg_mark					= $response['/HG']['mark'];
// $hg_netChange				= $response['/HG']['changeInDouble'];
// $hg_perChange				= $response['/HG']['futurePercentChange'] * 100;
// $crude_mark     			= round(($cl_mark + $bz_mark)/2, 2);
// $crude_netChange			= round(($cl_netChange + $bz_netChange)/2, 2);
// $crude_perChange			= round(($cl_perChange + $bz_perChange)/2, 2);
// $hg							= round($hg_perChange, 3);
// $nik_mark					= $response['/NKD']['mark'];
// $nik_netChange				= $response['/NKD']['changeInDouble'];
// $nik_perChange				= $response['/NKD']['futurePercentChange'] * 100;
// if (!empty($response['$FTSE'])) {
//     $euro_mark					= $response['$FTSE']['lastPrice'];
//     $euro_netChange				= $response['$FTSE']['netChange'];
//     $euro_perChange				= round($response['$FTSE']['netPercentChangeInDouble'], 2);
// } else {
//     $euro_mark              = 'N/A';
//     $euro_netChange         = 'N/A';
//     $euro_perChange         = 'N/A';
// }
// $hsi_mark					= $response['$HSI']['lastPrice'];
// $hsi_netChange				= $response['$HSI']['netChange'];
// $hsi_perChange				= round($response['$HSI']['netPercentChangeInDouble'], 2);
// $dax_mark					= $response['$DAX']['lastPrice'];
// $dax_netChange				= $response['$DAX']['netChange'];
// $dax_perChange				= round($response['$DAX']['netPercentChangeInDouble'], 2);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12">
            <div class="card-head">
                <div class="card-title mb-0 py-3"><h5 class="title"><?php  echo $overviewTitle; ?></h5></div>
                <div class="card-tools">
                    <ul class="card-tools-nav">
                    </ul>
                </div>
            </div> 
            <div class="card card-bordered">
                <div class="card-inner">
                    <table class="table table-bordered datatableOverview">
                        <thead>
                            <tr>
                                <th>Ticker</th>
                                <th>Description</th>
                                <th>Last Price</th>
                                <th>Close Price</th>
                                <th>Net Change</th>
                                <th>% G/L</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($response as $market) {
                                if(!empty($market['lastPrice'])) {
                                    $lastPrice          = $market['lastPrice'];
                                } elseif (!empty($market['mark'])) {
                                    $lastPrice          = $market['mark'];
                                }
                                if(!empty($market['closePrice'])) {
                                    $closePrice         = $market['closePrice'];
                                } elseif (!empty($market['closePriceInDouble'])) {
                                    $closePrice         = $market['closePriceInDouble'];
                                }
                                if ($market['assetType'] === 'FUTURE') {
                                    $percentChange      = $market['futurePercentChange']; 
                                }
                                if ($market['assetType'] === 'INDEX') {
                                    $percentChange      = $market['netPercentChangeInDouble']; 
                                }
                                $netChange              = $lastPrice - $closePrice;
                                $percentChange          = ($netChange / $lastPrice) / 100;
                                echo '
                                <tr>
                                    <td>' . $market['symbol'] . '</td>
                                    <td>' . $market['description'] . '</td>
                                    <td>' . number_format($lastPrice,2) . '</td>
                                    <td>' . number_format($closePrice,2) . '</td>
                                    <td>' . number_format($netChange,2) . '</td>
                                    <td>' . round($percentChange,2) . '%</td>
                                </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>