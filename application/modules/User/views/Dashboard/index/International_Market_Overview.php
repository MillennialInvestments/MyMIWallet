<div class="card-head">
	<div class="card-title mb-0 py-3"><h5 class="title">International Markets</h5></div>
	<div class="card-tools">
		<ul class="card-tools-nav">
		</ul>
	</div>
</div>
<div class="tranx-list card card-bordered">
	<?php
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
    // Get EURO Stoxx 50 Variable
    $date						= date("m/d/Y");

    // Variables
     
    $nik_mark					= $response['/NKD']['mark'];
    $nik_netChange				= $response['/NKD']['changeInDouble'];
    $nik_perChange				= $response['/NKD']['futurePercentChange'] * 100;
    if (!empty($response['$FTSE'])) {
        $euro_mark					= $response['$FTSE']['lastPrice'];
        $euro_netChange				= $response['$FTSE']['netChange'];
        $euro_perChange				= round($response['$FTSE']['netPercentChangeInDouble'], 2);
    } else {
        $euro_mark              = 'N/A';
        $euro_netChange         = 'N/A';
        $euro_perChange         = 'N/A';
    }
    $hsi_mark					= $response['$HSI']['lastPrice'];
    $hsi_netChange				= $response['$HSI']['netChange'];
    $hsi_perChange				= round($response['$HSI']['netPercentChangeInDouble'], 2);
    $dax_mark					= $response['$DAX']['lastPrice'];
    $dax_netChange				= $response['$DAX']['netChange'];
    $dax_perChange				= round($response['$DAX']['netPercentChangeInDouble'], 2);

    $int_equities				= round(($dax_perChange + $nik_perChange + $euro_perChange + $hsi_perChange)/4, 2);
    // Calculate INT Equity Score
    if ($nik_perChange >= 0) {
        $nikScore				= 1;
        $nikScoreCard			= '<span class="statusGreen statusGreenBg">+' . $nikScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($nik_perChange <= 0) {
        $nikScore				= -1;
        $nikScoreCard 			= '<span class="statusRed statusRedBg">' . $nikScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    if ($euro_perChange >= 0) {
        $euroScore				= 1;
        $euroScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $euroScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($euro_perChange <= 0) {
        $euroScore				= -1;
        $euroScoreCard 			= '<span class="statusRed statusRedBg">' . $euroScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    if ($hsi_perChange >= 0) {
        $hsiScore				= 1;
        $hsiScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $hsiScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($hsi_perChange <= 0) {
        $hsiScore				= -1;
        $hsiScoreCard 			= '<span class="statusRed statusRedBg">' . $hsiScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    if ($dax_perChange >= 0) {
        $daxScore				= 1;
        $daxScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $daxScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($dax_perChange <= 0) {
        $daxScore				= -1;
        $daxScoreCard 			= '<span class="statusRed statusRedBg">' . $daxScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    $intScore 					= $nikScore + $euroScore + $hsiScore + $daxScore;
    $int_mark					= round(($nik_netChange + $euro_netChange + $hsi_netChange + $dax_netChange)/4, 2);
    $intScoreCard 				= $nikScore + $euroScore + $hsiScore + $daxScore;
    if ($intScoreCard >= 0) {
        $intScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $intScoreCard . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($intScoreCard <= 0) {
        $intScoreCard			= '<span class="statusRed statusRedBg">' . $intScoreCard . ' </span> <span class="pl-1 statusRed">Bearish</span>';
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
					<div class="tranx-label">International Markets</div>
					<div class="tranx-date">Score: <?php echo $intScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $int_mark; ?></div>
				<div class="number-sm"><?php echo $int_equities; ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">Euro Stoxx 100</div>
					<div class="tranx-date">Score: <?php echo $euroScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $euro_mark; ?></div>
				<div class="number-sm"><?php echo round($euro_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">DAX</div>
					<div class="tranx-date">Score: <?php echo $daxScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo round($dax_mark,2); ?></div>
				<div class="number-sm"><?php echo round($dax_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">Hang Seng</div>
					<div class="tranx-date">Score: <?php echo $hsiScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo round($hsi_mark,2); ?></div>
				<div class="number-sm"><?php echo round($hsi_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">Nikkei 225</div>
					<div class="tranx-date">Score: <?php echo $nikScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo round($nik_mark,2); ?></div>
				<div class="number-sm"><?php echo round($nik_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<?php
    if ($this->uri->segment(1) === 'Dashboard') {
        $marketURL                              = 'Markets/International-Markets';
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
