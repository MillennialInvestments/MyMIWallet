<div class="card-head">
	<div class="card-title mb-0 py-3"><h5 class="title">US Markets</h5></div>
	<div class="card-tools">
		<ul class="card-tools-nav">
		</ul>
	</div>
</div>
<div class="tranx-list card card-bordered">
	<?php
    $curl 						= curl_init();
    $symbols					= '%24DJI%2C%2FYM%2C%2FES%2C%2FNQ%2C%2FRTY';
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
    $dji_mark					= $response['/YM']['mark'];
    $dji_netChange				= $response['/YM']['changeInDouble'];
    $dji_perChange				= $response['/YM']['futurePercentChange'] * 100;
    $dji_URL                    = 'Indexes/CBOT_MINI/YM1';
    $sp_mark					= $response['/ES']['mark'];
    $sp_netChange				= $response['/ES']['changeInDouble'];
    $sp_perChange				= $response['/ES']['futurePercentChange'] * 100;
    $sp_URL                     = 'Indexes/';
    $ndx_mark					= $response['/NQ']['mark'];
    $ndx_netChange				= $response['/NQ']['changeInDouble'];
    $ndx_perChange				= $response['/NQ']['futurePercentChange'] * 100;
    $ndx_URL                    = 'Indexes/';
    $rut_mark					= $response['/RTY']['mark'];
    $rut_netChange				= $response['/RTY']['changeInDouble'];
    $rut_perChange				= $response['/RTY']['futurePercentChange'] * 100;
    $rut_URL                    = 'Indexes/';
    $us_equities				= round(($dji_perChange + $sp_perChange + $ndx_perChange + $rut_perChange)/4, 2);
    // Calculate US Equity Score
    if ($dji_perChange >= 0) {
        $djiScore				= 1;
        $djiScoreCard			= '<span class="statusGreen statusGreenBg">+' . $djiScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($dji_perChange <= 0) {
        $djiScore				= -1;
        $djiScoreCard 			= '<span class="statusRed statusRedBg">' . $djiScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    if ($sp_perChange >= 0) {
        $spScore				= 1;
        $spScoreCard			= '<span class="statusGreen statusGreenBg">+' . $spScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($sp_perChange <= 0) {
        $spScore				= -1;
        $spScoreCard 			= '<span class="statusRed statusRedBg">' . $spScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    if ($ndx_perChange >= 0) {
        $ndxScore				= 1;
        $ndxScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $ndxScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($ndx_perChange <= 0) {
        $ndxScore				= -1;
        $ndxScoreCard 			= '<span class="statusRed statusRedBg">' . $ndxScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    if ($rut_perChange >= 0) {
        $rutScore				= 1;
        $rutScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $rutScore . ' </span> <span class="pl-1 statusGreen">Bullish</span>';
    } elseif ($rut_perChange <= 0) {
        $rutScore				= -1;
        $rutScoreCard 			= '<span class="statusRed statusRedBg">' . $rutScore . ' </span> <span class="pl-1 statusRed">Bearish</span>';
    }
    $usScore 					= $djiScore + $spScore + $ndxScore + $rutScore;
    $us_mark					= round(($dji_netChange + $sp_netChange + $ndx_netChange + $rut_netChange)/4, 2);
    $usScoreCard 				= $djiScore + $spScore + $ndxScore + $rutScore;
    if ($usScoreCard >= 0) {
        $usScoreCard 			= '<span class="statusGreen statusGreenBg">+' . $spScore . ' </span> <span class="pl-3 statusGreen">Bullish</span>';
    } elseif ($usScoreCard <= 0) {
        $usScoreCard			= '<span class="statusRed statusRedBg">' . $usScoreCard . ' </span> <span class="pl-3 statusRed">Bearish</span>';
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
					<div class="tranx-label">US Overall Markets</div>
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
					<div class="tranx-label">Dow Jones</div>
					<div class="tranx-date">Score: <?php echo $djiScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $dji_mark; ?></div>
				<div class="number-sm"><?php echo round($dji_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">NASDAQ</div>
					<div class="tranx-date">Score: <?php echo $ndxScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $ndx_mark; ?></div>
				<div class="number-sm"><?php echo round($ndx_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">S&amp;P 500</div>
					<div class="tranx-date">Score: <?php echo $spScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $sp_mark; ?></div>
				<div class="number-sm"><?php echo round($sp_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<div class="tranx-item">
		<div class="tranx-col">
			<div class="tranx-info">
				<div class="tranx-data">
					<div class="tranx-label">Rusell 2000</div>
					<div class="tranx-date">Score: <?php echo $rutScoreCard; ?></div>
				</div>
			</div>
		</div>
		<div class="tranx-col">
			<div class="tranx-amount">
				<div class="number"><?php echo $rut_mark; ?></div>
				<div class="number-sm"><?php echo round($rut_perChange,2); ?>%</div>
			</div>
		</div>
	</div>
	<?php
    if ($this->uri->segment(1) === 'Dashboard') {
        $marketURL                              = 'Markets/US-Markets';
        echo '
    <div class="tranx-item">
		<div class="tranx-col col">
			<div class="tranx-info text-center">
				<div class="tranx-data">
					<div class="tranx-label"><a class="btn btn-primary btn-md" href="' . $marketURL . '">View Markets</a></div>
				</div>
			</div>
		</div>
	</div>
    ';
    }
    ?>
</div>
