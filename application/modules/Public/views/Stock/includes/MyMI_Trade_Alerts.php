<?php
// Set Page URI Segments
$pageURIA			= $this->uri->segment(1);
$pageURIB			= $this->uri->segment(2);
$pageURIC			= $this->uri->segment(3);
$pageURID			= $this->uri->segment(4);
$pageURIE			= $this->uri->segment(5);
$stockEx			= $pageURIB;
$stockSym			= $pageURIC;
//Get User Type
$cuType 					= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';
?>
<section class="cid-s0KKUOB7cY p-0">
    <div class="container-fluid px-0">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<h5 class="card-title">MyMI <?php echo($stockSym); ?> Trade Alerts &amp; Updates</h5>
								<p class="card-description">Information regarding <?php echo($stockSym); ?> Trade Alerts &amp; Updates</p>
							</div>
						</div>
								<?php
                                $today				= date("F jS, Y");
                                $this->db->from('bf_investment_trade_alerts');
                                $this->db->where('submitted_date', $today);
                                $this->db->where('type', $cuType);
                                $this->db->where('stock', $stockSym);
                                $this->db->or_where('last_updated', $today);
                                $this->db->order_by('id', 'DESC');
                                $getSymbols 		= $this->db->get();
                                $this->db->cache_on();
                                foreach ($getSymbols->result_array() as $results) {
                                    $category		= $results['category'];
                                    if ($category === 'Breakout Stock') {
                                        $categoryURL	= 'Breakout-Stocks';
                                    } elseif ($category === 'Liquidity Stock') {
                                        $categoryURL	= 'Liquidity-Stocks';
                                    } elseif ($category === 'Morning Mover') {
                                        $categoryURL	= 'Morning-Movers';
                                    } elseif ($category === 'Penny Stock') {
                                        $categoryURL	= 'Penny-Stocks';
                                    }
                                    $stockID			= $results['id'];
                                    $submitted_date		= $results['submitted_date'];
                                    $time				= $results['time'];
                                    $last_updated		= $results['last_updated'];
                                    if ($last_updated !== null) {
                                        $updateType		= $category . ' Update Alert';
                                    } else {
                                        $updateType		= 'New ' . $category . ' Alert';
                                    }
                                    $date1 				= $today;
                                    $date2 				= $submitted_date;
                                    $date3 				= $last_updated;
                                    $diff 				= abs(strtotime($date2) - strtotime($date1));
                                    $diffB 				= abs(strtotime($date3) - strtotime($date2));
                                    $days 				= floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    $daysB 				= floor(($diffB - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    $tradeLength		= $days;
                                    $updatedLength		= $daysB;
                                    $type				= $results['type'];
                                    $symbol				= $results['stock'];
                                    $exchange			= $results['exchange'];
                                    $alertPrice			= $results['current_price'];
                                    $targetPrice		= $results['potential_price'];
                                    $details			= $results['details'];
                                    $updatedDetails		= $results['updated_details'];
                                    $curl 				= curl_init();
                                    $curlURL			= 'https://api.tdameritrade.com/v1/marketdata/' . $symbol . '/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF';
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
                                    $description		= $response[$symbol]['description'];
                                    $closePrice			= round($response[$symbol]['closePrice'], 2);
                                    $lastPrice			= round($response[$symbol]['lastPrice'], 2);
                                    $highPrice			= round($response[$symbol]['highPrice'], 2);
                                    $lowPrice			= round($response[$symbol]['lowPrice'], 2);
                                    $markPrice			= round($response[$symbol]['mark'], 2);
                                    $closePrice			= round($response[$symbol]['closePrice'], 2);
                                    $netChangeTotal		= round($response[$symbol]['netChange'], 2);
                                    if ($netChangeTotal === null) {
                                        $netChange = 0;
                                    } else {
                                        $netChange = $netChangeTotal;
                                    }
                                    $compPrice			= $markPrice;
                                    $alertChange 		= round((($compPrice - $alertPrice)/$alertPrice) * 100, 2);
                                    if ($alertChange > 0) {
                                        $alertPercent	= '<span class="text-success">' . round($alertChange, 2) . '%</span>';
                                    } elseif ($alertChange < 0) {
                                        $alertPercent	= '<span class="text-danger">' . round($alertChange, 2) . '%</span>';
                                    }
                                    $markChange			= $response[$symbol]['markChangeInDouble'];
                                    $markPercent		= $response[$symbol]['markPercentChangeInDouble'];
                                    if ($markPercent > 0) {
                                        $perChange	= '<span class="text-success">' . round($markPercent, 2) . '%</span>';
                                    } elseif ($markPercent < 0) {
                                        $perChange	= '<span class="text-danger">' . round($markPercent, 2) . '%</span>';
                                    }
                                        
                                    //~ $netChange			= round((($lastPrice - $closePrice)/$closePrice) * 100, 2);
                                    $this->db->from('bf_investment_stock_listing');
                                    $this->db->where('symbol', $symbol);
                                    $getStockType		= $this->db->get();
                                    foreach ($getStockType->result_array() as $stocks) {
                                        $stockURL		= $stocks['type'] . '/' . $exchange . '/' . $symbol;
                                    }
                                    $this->db->from('bf_investment_chart_analysis');
                                    $this->db->where('symbol', $symbol);
                                    $getChart			= $this->db->get();
                                    foreach ($getChart->result_array() as $chart) {
                                        $chartImg		= $chart['url_link'];
                                    } ?>
									
						<div class="row">
							<div class="col">
								<?php
                                echo '
								<h1 class="card-subtitle" style="color:black;">' . $symbol . ' ' . $updateType . '</h1>
								<img class="full-width" src="https://www.tradingview.com/i/mDEC2w3w/" alt="' . $symbol . ' ' . $updateType . '">
								<table class="table pb-5">
									<tbody>
										<tr>
											<th>Alert Price:</th>
											<th>Market Price:</th>
											<th>Intra-Day % Change:</th>
											<th>Alert % Change</th>
											<th>More Details</th>
										</tr>
										<tr>
											<td>$' . $alertPrice . '</td>
											<td>$' . $markPrice . '</td>
											<td>' . $perChange . '</td>
											<td>' . $alertPercent . '</td>
											<td><a class="btn btn-primary btn-sm" href="' . site_url($stockType) . '">View Stock</a></td>
										</tr>
									</tbody>
								</table>
								<p><strong>Alerted On: </strong>' . $submitted_date . '</p>
								<p class="card-text">' . $details . '</p>';
                                    if ($last_updated !== null) {
                                        echo '
								<p><strong>Updated On: </strong>' . $last_updated . '</p>
								<p class="card-text">' . $updatedDetails . '</p>
								';
                                    }
                                    echo ' 
								<br>
								'; ?>
								<hr>
							</div>
						</div>
						<?php
                                }
                        ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

