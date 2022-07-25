<?php
$getStockInfo = $this->stock_model->get_trade_alert($symbol);

foreach ($getStockInfo->result_array() as $stockInfo) {
    $submitted_date				= $stockInfo['submitted_date'];
    $category					= $stockInfo['category'];
    $type						= $stockInfo['type'];
    $stock						= $stockInfo['stock'];
    $exchange					= $stockInfo['exchange'];
    $company					= $stockInfo['company'];
    $alertPrice					= $stockInfo['current_price'];
    $targetPrice				= $stockInfo['potential_price'];
    $differential				= $stockInfo['differential'];
    $potential_gain				= $stockInfo['potential_gain'];
    $stop_loss_percent			= $stockInfo['stop_loss_percent'];
    $stop_loss_differential		= $stockInfo['stop_loss_differential'];
    $stop_loss					= $stockInfo['stop_loss'];
    $support					= $stockInfo['support'];
    $max_entry					= $stockInfo['max_entry'];
    $price_high					= $stockInfo['price_high'];
    $percent_change				= $stockInfo['percent_change'];
    $last_updated				= $stockInfo['last_updated'];
    $last_updated_time			= $stockInfo['last_updated_time'];
    $closing_date				= $stockInfo['closing_date'];
    $details					= $stockInfo['details'];
    $updated_details			= $stockInfo['updated_details'];
    $closing_details			= $stockInfo['closing_details'];
    $curl 			= curl_init();
    $curlURL		= 'https://api.tdameritrade.com/v1/marketdata/' . $symbol . '/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF';
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

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $response 			= json_decode($response, true); //because of true, it's in an array
    //~ $exchangeName		= $response[$symbol]['exchangeName'];
    //~ if ($exchangeName === 'NASD') {
    //~ $exchange = 'NASDAQ';
    //~ } elseif ($exchangeName === 'NYSE') {
    //~ $exchange = 'NYSE';
    //~ } elseif ($exchangeName === 'AMEX') {
    //~ $exchange = 'AMEX';
    //~ } elseif ($exchangeName === 'PACIFIC') {
    //~ $exchange = 'AMEX';
    //~ }
    $description		= $response[$symbol]['description'];
    $closePrice			= round($response[$symbol]['closePrice'], 2);
    $lastPrice			= round($response[$symbol]['lastPrice'], 2);
    $highPrice			= round($response[$symbol]['highPrice'], 2);
    $lowPrice			= round($response[$symbol]['lowPrice'], 2);
    $closePrice			= round($response[$symbol]['closePrice'], 2);
    $netChange			= round($response[$symbol]['netChange'], 2);
    $f2High				= round($response[$symbol]['52WkHigh'], 2);
    $f2Low				= round($response[$symbol]['52WkLow'], 2);
    $markChange			= $response[$symbol]['markChangeInDouble'];
    $markPercent		= $response[$symbol]['markPercentChangeInDouble'];
    if ($markPercent === null) {
        if ($markPercent > 0) {
            $perChange	= '<span class="text-success">' . round($markPercent, 2) . '%</span>';
        } elseif ($markPercent < 0) {
            $perChange	= '<span class="text-danger">' . round($markPercent, 2) . '%</span>';
        }
    } else {
        $perChange = 0.00;
    }
    $close_f2High 		= round((($closePrice - $f2High)/$f2High) * 100, 2);
    if ($close_f2High > 0) {
        $closef2High = '<span class="text-success">' . $close_f2High . '%</span>';
    } elseif ($close_f2High < 0) {
        $closef2High = '<span class="text-danger">' . $close_f2High . '%</span>';
    }
    $close_f2Low 		= round((($closePrice - $f2Low)/$f2Low) * 100, 2);
    if ($close_f2Low > 0) {
        $closef2Low = '<span class="text-success">' . $close_f2Low . '%</span>';
    } elseif ($close_f2Low < 0) {
        $closef2Low = '<span class="text-danger">' . $close_f2Low . '%</span>';
    }
    $last_f2High 		= round((($lastPrice - $f2High)/$f2High) * 100, 2);
    if ($last_f2High > 0) {
        $lastf2High = '<span class="text-success">' . $last_f2High . '%</span>';
    } elseif ($last_f2High < 0) {
        $lastf2High = '<span class="text-danger">' . $last_f2High . '%</span>';
    }
    $last_f2Low 		= round((($lastPrice - $f2Low)/$f2Low) * 100, 2);
    if ($last_f2Low > 0) {
        $lastf2Low = '<span class="text-success">' . $last_f2Low . '%</span>';
    } elseif ($last_f2Low < 0) {
        $lastf2Low = '<span class="text-danger">' . $last_f2Low . '%</span>';
    }
    $high_f2High 		= round((($highPrice - $f2High)/$f2High) * 100, 2);
    if ($high_f2High > 0) {
        $highf2High = '<span class="text-success">' . $high_f2High . '%</span>';
    } elseif ($high_f2High < 0) {
        $highf2High = '<span class="text-danger">' . $high_f2High . '%</span>';
    }
    $high_f2Low 		= round((($highPrice - $f2Low)/$f2Low) * 100, 2);
    if ($high_f2Low > 0) {
        $highf2Low = '<span class="text-success">' . $high_f2Low . '%</span>';
    } elseif ($high_f2Low < 0) {
        $highf2Low = '<span class="text-danger">' . $high_f2Low . '%</span>';
    }
    $low_f2High 		= round((($lowPrice - $f2High)/$f2High) * 100, 2);
    if ($low_f2High > 0) {
        $lowf2High = '<span class="text-success">' . $low_f2High . '%</span>';
    } elseif ($low_f2High < 0) {
        $lowf2High = '<span class="text-danger">' . $low_f2High . '%</span>';
    }
    $low_f2Low 		= round((($lowPrice - $f2Low)/$f2Low) * 100, 2);
    if ($low_f2Low > 0) {
        $lowf2Low = '<span class="text-success">' . $low_f2Low . '%</span>';
    } elseif ($low_f2Low < 0) {
        $lowf2Low = '<span class="text-danger">' . $low_f2Low . '%</span>';
    }
    $alertChangeA 		= round((($lastPrice - $alertPrice)/$alertPrice) * 100, 2);
    $alertChangeB 		= round((($highPrice - $alertPrice)/$alertPrice) * 100, 2);
    $alertChange		= $alertChangeB;
    if ($alertChange > 0) {
        $alertPercent	= '<span class="text-success">' . round($alertChange, 2) . '%</span>';
    } elseif ($alertChange < 0) {
        $alertPercent	= '<span class="text-danger">' . round($alertChange, 2) . '%</span>';
    } ?>
<style>
	.text-success{color: green;}
	.text-danger{color: red;}
</style>
<?php
echo '<h4 class="card-title text-center">Active Trade Alert Information</h4>'; ?>
<?php
if ($alertPrice !== null) {
    ?>
<table class="table table-borderless table-responsive">
	<thead>
		<tr>
			<th class="w-30"></th>
			<th class="w-30"></th>
			<th class="w-30"></th>
			<th class="w-30"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Alert Price:</th>
			<td><?php echo '$' . $alertPrice; ?></td>
			<th>Target Price:</th>
			<td><?php echo '$' . $targetPrice; ?></td>
		</tr>
		<tr>
			<th>Differential:</th>
			<td><?php echo '$' . $differential; ?></td>
			<th>Potential Gain:</th>
			<td><?php echo '$' . $potential_gain; ?></td>
		</tr>
		<tr>
			<th>Potential Gain:</th>
			<td><?php echo '$' . $potential_gain; ?></td>
			<th>Stop Loss:</th>
			<td><?php echo '$' . $stop_loss; ?></td>
		</tr>
		<tr>
			<th>Stop Loss Differential:</th>
			<td><?php echo '$' . $stop_loss_differential; ?></td>
			<th>Stop Loss %:</th>
			<td><?php echo '$' . $stop_loss_percent; ?></td>
		</tr>
		<tr>
			<th>Support:</th>
			<td><?php echo '$' . $support; ?></td>
			<th>Max_Entry:</th>
			<td><?php echo '$' . $max_entry; ?></td>
		</tr>
		<tr>
			<th>Price High:</th>
			<td><?php echo '$' . $price_high; ?></td>
			<th>Percent Change:</th>
			<td><?php echo $alertPercent; ?></td>
		</tr>
	</tbody>
</table>
<hr>
<?php
} ?>
<?php
// Mobile Version
echo '
		<h4 class="card-title text-center">Trade Alert Details</h4>
	'; ?>                       
<p class="card-text full-width pt-3 pl-3"><?php echo $details; ?></p>
<?php
if ($last_updated !== null) {
    echo '<hr>';
    // Mobile Version
    if ($this->agent->is_mobile()) {
        echo '
			<h4 class="card-title text-center">Trade Alert Update Details</h4>
			<p class="card-text full-width pt-3 pl-3">' . $updated_details . '</p>
		';
    } else {
        echo '
			<h1 class="card-title">Trade Alert Update Details</h1>  
			<p class="card-text full-width pt-3 pl-3">' . $updated_details . '</p>
		';
    }
}
    echo '<hr>';
    // Mobile Version
    if ($this->agent->is_mobile()) {
        echo '
		<h4 class="card-title text-center">Stock Information &amp; Overview</h4>
		<table class="table table-borderless table-responsive">
	';
    } else {
        echo '
		<h1 class="card-title">Stock Information &amp; Overview</h1> 
		<table class="table table-borderless">
	';
    } ?>
	<thead>
		<tr>
			<th class="w-30"></th>
			<th class="w-30"></th>
			<th class="w-30">52-Wk High: $<?php echo $f2High; ?></th>
			<th class="w-30">52-Wk Low: $<?php echo $f2Low; ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Company:</th>
			<td><?php echo $symbol . ' (' . $description . ')'; ?></td>
			<td></td>
		</tr>  
		<tr>
			<th>Net Change:</th>
			<td><?php echo '$' . $markChange . ' (' . $perChange . ')'; ?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th>Potential Price:</th>
			<td><?php echo '$' . $targetPrice . ' (' . $perChange . ')'; ?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th>Close Price:</th>
			<td><?php echo '$' . $closePrice; ?></td>
			<td><?php echo '$' . ($closePrice - $f2High) . ' (' . $closef2High . ')'; ?></td> 
			<td><?php echo '$' . ($closePrice - $f2Low) . ' (' . $closef2Low . ')'; ?></td> 
		</tr>
		<tr>
			<th>Last Price:</th>
			<td><?php echo '$' . $lastPrice; ?></td>          
			<td><?php echo '$' . ($lastPrice - $f2High) . ' (' . $lastf2High . ')'; ?></td> 
			<td><?php echo '$' . ($lastPrice - $f2Low) . ' (' . $lastf2Low . ')'; ?></td> 
		</tr>
		<tr>
			<th>Intrady High:</th>
			<td><?php echo '$' . $highPrice . ' (' . ($lastPrice - $highPrice) . ')'; ?></td>
			<td><?php echo '$' . ($highPrice - $f2High) . ' (' . $highf2High . ')'; ?></td> 
			<td><?php echo '$' . ($highPrice - $f2Low) . ' (' . $highf2Low . ')'; ?></td> 
		</tr>
		<tr>
			<th>Intrady Low:</th>
			<td><?php echo '$' . $lowPrice . ' (' . ($lastPrice - $lowPrice) . ')'; ?></td>  
			<td><?php echo '$' . ($lowPrice - $f2High) . ' (' . $lowf2High . ')'; ?></td> 
			<td><?php echo '$' . ($lowPrice - $f2Low) . ' (' . $lowf2Low . ')'; ?></td>
		</tr>
	</tbody>
</table>

<?php
}
?>
