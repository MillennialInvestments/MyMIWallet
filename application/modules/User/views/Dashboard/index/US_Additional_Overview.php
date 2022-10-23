<div class="card-head">
	<div class="card-title mb-0 py-3"><h5 class="title">Additional Markets</h5></div>
	<div class="card-tools">
		<ul class="card-tools-nav">
		</ul>
	</div>
</div>
<div class="tranx-list card card-bordered">
	<?php
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
    // Get EURO Stoxx 50 Variable
    $date						= date("m/d/Y");

    // Variables
    if (!empty($response['$DX'])) {
        $dx_mark					= $response['/DXY']['lastPrice'];
        $dx_perChange				= round($response['/DXY']['percentChange'], 2);
        $dx_netChange               = $response['/DXY']['changeInDouble'];
        $dx							= $dx_perChange * -1;
    } else {
        $dx_mark                = 0;
        $dx_perChange           = 0;
        $dx_netChange           = 0;
        $dx                     = 0;
    }
    // print_r($response['/CL']); 
    $vix_mark					= $response['$VIX.X']['lastPrice'];
    $vix_netChange			    = $response['$VIX.X']['netChange'];
    $vix_perChange				= round($response['$VIX.X']['netPercentChangeInDouble'], 2);
    $vix						= $vix_perChange * -1;
    $cl_mark					= $response['/CL']['mark'];
    $cl_netChange				= $response['/CL']['changeInDouble'];
    $cl_perChange				= $response['/CL']['futurePercentChange'] * 100;
    $bz_mark					= $response['/BZ']['mark'];
    $bz_netChange               = $response['/BZ']['changeInDouble'];
    $bz_perChange				= $response['/BZ']['futurePercentChange'] * 100;
    $hg_mark					= $response['/HG']['mark'];
    $hg_netChange				= $response['/HG']['changeInDouble'];
    $hg_perChange				= $response['/HG']['futurePercentChange'] * 100;
    $crude_mark     			= round(($cl_mark + $bz_mark)/2, 2);
    $crude_netChange			= round(($cl_netChange + $bz_netChange)/2, 2);
    $crude_perChange			= round(($cl_perChange + $bz_perChange)/2, 2);
    $hg							= round($hg_perChange, 3);
    if ($dx <= 0) {
        $dxScore				= 1;
        $dxScoreCard			= -4;
    } elseif ($dx >= 0) {
        $dxScore				= 1;
        $dxScoreCard 			= 4;
    }
    if ($vix <= 0) {
        $vixScore				= 1;
        $vixScoreCard 			= '<span class="statusRed statusRedBg">' . $vixScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    } elseif ($vix >= 0) {
        $vixScore				= -1;
        $vixScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $vixScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    }
    if ($crude_perChange >= 0) {
        $crudeScore				= 1;
        $crudeScoreCard 		= '<span class="statusGreen statusGreenBg">+' . $crudeScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($crude_perChange <= 0) {
        $crudeScore				= -1;
        $crudeScoreCard 		= '<span class="statusRed statusRedBg">' . $crudeScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    if ($hg_perChange >= 0) {
        $hgScore				= 1;
        $hgScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $hgScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($hg_perChange <= 0) {
        $hgScore				= -1;
        $hgScoreCard 			= '<span class="statusRed statusRedBg">' . $hgScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    $us_equities				= round(($dx_perChange + $vix_perChange + $crude_perChange + $hg_perChange)/4, 2);
    $us_mark					= round(($dx_netChange + $vix_netChange + $crude_netChange + $hg_netChange)/4, 2);
    $usScoreCard 				= $dxScore + $vixScore + $crudeScore + $hgScore;
    if ($usScoreCard >= 0) {
        $usScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $usScoreCard . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($usScoreCard <= 0) {
        $usScoreCard			= '<span class="statusRed statusRedBg">' . $usScoreCard . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    //~ $overallScore 				= $usScore + $intScore + $vixScore + $crudeScore;
    ?>
	<style>
	th, td {
		font-size: 0.75rem !important;
	}
	</style>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">Additional Markets</div>
					<div class="tranx-date">Score: <?php echo $usScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $us_mark; ?></div>
				<div class="number-sm"><?php echo $us_equities; ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">US Dollar (N/A)</div>
					<div class="tranx-date">Score: <?php echo $dxScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $dx_mark; ?></div>
				<div class="number-sm"><?php echo round($dx_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">Volatility Index</div>
					<div class="tranx-date">Score: <?php echo $vixScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $vix_mark; ?></div>
				<div class="number-sm"><?php echo round($vix_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">Oil Index</div>
					<div class="tranx-date">Score: <?php echo $crudeScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $crude_mark; ?></div>
				<div class="number-sm"><?php echo round($crude_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">Gold</div>
					<div class="tranx-date">Score: <?php echo $hgScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $hg_mark; ?></div>
				<div class="number-sm"><?php echo round($hg_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<?php
    if ($this->uri->segment(1) === 'Dashboard') {
        $marketURL                              = 'Markets/US-Additional-Markets';
        echo '
	<div class="tranx-item">
		<div class="tranx-col col">
			<div class="tranx-info text-center">
				<div class="tranx-data">
					<div class="tranx-label"><a class="btn btn-primary btn-md" href="' . site_url($marketURL) . '">View Markets</a></div>
				</div>
			</div>
		</div>
	</div>
        ';
    } 
    ?>
</div>
