<?php
$client = new Codenixsv\BittrexApi\BittrexClient;
$client->setCredential('82122111507946599fe903f058758e92', '466bfcbc6ba0425e8b429bde2eaecf13');
$cuID					 						= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
$cuEmail				 						= isset($current_user->email) && ! empty($current_user->email) ? $current_user->email : '';
$total_coins									= 23000000;
$coins_exchanged								= $_SESSION['allSessionData']['userAccount']['coinsExchanged'];
$open_listing_app								= $_SESSION['allSessionData']['userAccount']['open_listing_app'];
$applicationData								= array(
    'cuID'										=> $cuID,
    'cuEmail'									=> $cuEmail,
);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<div class="nk-block">
				<div class="nk-block-head">
					<?php echo theme_view('navigation_breadcrumbs'); ?>
					<div class="nk-block-between-md g-4">
						<div class="nk-block-head-content">
							<h2 class="nk-block-title fw-bold">MyMI Exchange</h2>
							<div class="nk-block-des">
								<p>
									<span class="d-none d-md-block">Buy/Sell/Trade Your DigiAssets With MyMI Exchange!</span>
									<span class="d-block d-md-none">Trade Your DigiAssets With MyMI Exchange!</span>
								</p>
							</div>
						</div>
						<div class="nk-block-head-content">
							<ul class="nk-block-tools gx-3">
								<li>
									<a href="#" class="btn btn-primary text-white depositFundsBtn" data-toggle="modal" data-target="#transactionModal">
										<span>Deposit Funds</span> <em class="icon icon-arrow-right"></em>
									</a>
								</li>
								<li>
									<a href="#" class="btn btn-primary text-white withdrawFundsBtn" data-toggle="modal" data-target="#transactionModal">
										<span>Withdraw Funds</span> <em class="icon icon-arrow-right"></em>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="d-none d-md-block col-md-12 mb-3">  			
			<div class="nk-block">
				<div class="nk-block-head">
					<div class="nk-block-head-content"><h5 class="nk-block-title title">Trending Markets</h5></div>
				</div>
			</div> 
		</div>	
		<?php
            $ownership_coins						= $this->config->item('ownership_coins');
            $getExchanges							= $this->exchange_model->get_exchanges();
            foreach ($getExchanges->result_array() as $exchange) {
                $alt_cur							= $exchange['alt_cur'];
                $int_cur							= $exchange['int_cur'];
                $market_pair						= $exchange['market_pair'];
                $market								= $exchange['market'];
                $current_value						= $exchange['current_value'];
                $total_coins						= $exchange['total_coins'];
                $description						= $exchange['description'];
                $initial_value						= $exchange['initial_value'];
                if ($market === 'MYMI') {
                    $coins_available				= $exchange['coins_available'] - $ownership_coins;
                } else {
                    $coins_available				= $exchange['coins_available'];
                }
                if ($alt_cur === 'Yes') {
                    $cur_ticker_add                 = $exchange['market_pair'];
                    $alt_cur_ticker					= $market_pair . '-USD';
                    $altCurGetSum 					= $client->public()->getMarketSummaryTicker($alt_cur_ticker);
                    $alt_cur_mark					= $altCurGetSum['lastTradeRate'];
                    $current_coin_value				= number_format(($current_value / $alt_cur_mark) / $total_coins, 8);
                    $coin_value						= ($current_value / $alt_cur_mark) / $total_coins;
                } elseif ($int_cur === 'Yes') {
                    $cur_ticker_add                 = '';
                    $api_url						= urldecode($exchange['api_url']);
                    $curl 							= curl_init();
                    $curlURL						= 'https://api.tdameritrade.com/v1/marketdata/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF&symbol=' . $api_url . '&interval=1min';
                    curl_setopt_array($curl, array(
                      CURLOPT_URL 					=> $curlURL,
                      CURLOPT_RETURNTRANSFER		=> true,
                      CURLOPT_TIMEOUT 				=> 30,
                      CURLOPT_HTTP_VERSION 			=> CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST 		=> "GET",
                      CURLOPT_HTTPHEADER 			=> array(
                        "cache-control: no-cache",
                      ),
                    ));

                    $response 						= curl_exec($curl);
                    $err 							= curl_error($curl);

                    curl_close($curl);
                    $response 						= json_decode($response, true); //because of true, it's in an array
                    $cur_mark						= $response[$api_url]['mark'];
                                                                  
                    $current_coin_value				= number_format(($current_value / $cur_mark) / $total_coins, 8);
                    $coin_value						= ($current_value / $cur_mark) / $total_coins;
                } elseif ($market_pair === 'MYMIG') {
                    $cur_ticker_add                 = '';
                    $MyMIGoldValue					= $userDefaultData['MyMIGoldValue'];
                    $current_coin_value				= '$' . number_format('1', 2);
                    $coin_value						= ($current_value / $MyMIGoldValue) / $total_coins;
                } else {
                    $current_coin_value				= '$' . number_format($current_value / $total_coins, 8);
                    $coin_value						= $current_value / $total_coins;
                }
                $total_percent_growth				= number_format((($current_value - $initial_value) / $initial_value) * 100, 2);
                $total_volume						= $exchange['total_volume'];
                $total_growth						= $coin_value * $total_volume;
                if ($total_growth > 0) {
                    $total_growth                   = '<strong class="statusGreen">+ $' . number_format($total_growth, 2) . '</strong><br>';
                } elseif ($total_growth < 0) {
                    $total_growth                   = '<strong class="statusRed">- $' . number_format($total_growth, 2) . '</strong><br>';
                } else {
                    $total_growth                   = '<strong> $' . number_format($total_growth, 2) . '</strong><br>';
                }
                echo '
		<div class="col-6 col-md-3">
			<div class="card bg-light">
				<div class="nk-wgw sm">
					<a class="nk-wgw-inner" href="' . site_url('Exchange/Market/' . $market_pair . '/' . $market). '" data-toggle="tooltip" data-placement="bottom" title="' . $description . ' (' . $market . '-' . $market_pair . ')">
						<div class="nk-wgw-name">
							<div class="nk-wgw-icon text-green"><img class="icon ni" src="' . base_url('assets/images/Exchanges/Icons/' . $exchange['image_icon']) . '" /></div>
							<h5 class="nk-wgw-title title"><span class="d-none d-md-block">' . $description . ' (' . $market . '-' . $market_pair . ')</span><span class="d-block d-md-block">' . $market . '-' . $market_pair . '</span></h5>
						</div>
						<div class="nk-wgw-balance">
							<div class="amount">
								<div class="row">
									<div class="col-12">
										<h5 class="card-title display-5 d-none d-md-block">' . $current_coin_value . ' ' . $market_pair . '</h5>
										<h6 class="d-block d-md-none">' . $current_coin_value . '</h6>
									</div>
								</div>
								<div class="row">
									<div class="col">   															
										<div class="amount">
                                            ' . $total_growth . '
											<small>Total Growth</small>
										</div>
									</div>
<!--
									<div class="col">     
										<div class="amount">
											<strong>5,744,000</strong><br>
											<small>Total Volume</small>
										</div>
									</div>
-->
									<div class="col">     
										<div class="amount">
											<strong>$' . number_format($current_value, 2) . '</strong><br>
											<small>Market Cap</small>
										</div>
									</div>
								</div>													
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
			';
            }
        ?>	
		<div class="col-12 mt-5">
			<div class="nk-block">
				<div class="nk-block-head-xs">
					<div class="nk-block-head-content">
						<h5 class="nk-block-title title">Exchange Markets</h5>
						<br>
					</div>
				</div>
			</div>  
			<table class="table display" id="exchangeOverviewDataTable">
				<thead>
					<tr>
						<th class="text-center">Exchange</th>             
						<th class="text-center">Price</th>  
						<th class="text-center">Market Cap</th>    
						<th class="text-center">Total Growth</th>  
						<th class="text-center">Total Volume</th>  
						<th class="d-none d-md-block text-center full-width">Circulating Coins</th>
					</tr>
				</thead>
				<tbody>
					<?php
                    $ownership_coins						= $this->config->item('ownership_coins');
                    $getExchanges							= $this->exchange_model->get_exchanges();
                    foreach ($getExchanges->result_array() as $exchange) {
                        $alt_cur							= $exchange['alt_cur'];
                        $int_cur							= $exchange['int_cur'];
                        $market_pair						= $exchange['market_pair'];
                        $market								= $exchange['market'];
                        $current_value						= $exchange['current_value'];
                        $total_coins						= $exchange['total_coins'];
                        $description						= $exchange['description'];
                        $initial_value						= $exchange['initial_value'];
                        if ($market === 'MYMI') {
                            $coins_available				= $exchange['coins_available'] - $ownership_coins;
                        } else {
                            $coins_available				= $exchange['coins_available'];
                        }
                        if ($alt_cur === 'Yes') {
                            $alt_cur_ticker					= $market_pair . '-USD';
                            $altCurGetSum 					= $client->public()->getMarketSummaryTicker($alt_cur_ticker);
                            $alt_cur_mark					= $altCurGetSum['lastTradeRate'];
                            $current_coin_value				= number_format(($current_value / $alt_cur_mark) / $total_coins, 8) . ' ' . $exchange['market_pair'];
                            $coin_value						= ($current_value / $alt_cur_mark) / $total_coins;
                        } elseif ($int_cur === 'Yes') {
                            $api_url						= urldecode($exchange['api_url']);
                            $curl 							= curl_init();
                            $curlURL						= 'https://api.tdameritrade.com/v1/marketdata/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF&symbol=' . $api_url . '&interval=1min';
                            curl_setopt_array($curl, array(
                              CURLOPT_URL 					=> $curlURL,
                              CURLOPT_RETURNTRANSFER		=> true,
                              CURLOPT_TIMEOUT 				=> 30,
                              CURLOPT_HTTP_VERSION 			=> CURL_HTTP_VERSION_1_1,
                              CURLOPT_CUSTOMREQUEST 		=> "GET",
                              CURLOPT_HTTPHEADER 			=> array(
                                "cache-control: no-cache",
                              ),
                            ));

                            $response 						= curl_exec($curl);
                            $err 							= curl_error($curl);

                            curl_close($curl);
                            $response 						= json_decode($response, true); //because of true, it's in an array
                            $cur_mark						= $response[$api_url]['mark'];
                                                                          
                            $current_coin_value				= number_format(($current_value / $cur_mark) / $total_coins, 8);
                            $coin_value						= ($current_value / $cur_mark) / $total_coins;
                        } elseif ($market_pair === 'MYMIG') {
                            $MyMIGoldValue					= $userDefaultData['MyMIGoldValue'];
                            $current_coin_value				= '$' . number_format(($current_value / $MyMIGoldValue) / $total_coins, 8);
                            $coin_value						= ($current_value / $MyMIGoldValue) / $total_coins;
                        } else {
                            $current_coin_value				= '$' . number_format($current_value / $total_coins, 8);
                            $coin_value						= $current_value / $total_coins;
                        }
                        $total_percent_growth				= number_format((($current_value - $initial_value) / $initial_value) * 100, 2);
                        $total_volume						= $exchange['total_volume'];
                        $total_growth						= $coin_value * $total_volume;
                        if ($total_growth > 0) {
                            $total_growth                   = '<td class="text-center pt-4 statusGreen">+$' . number_format($total_growth, 2) . '</td>';
                        } elseif ($total_growth < 0) {
                            $total_growth                   = '<td class="text-center pt-4 statusRed">-$' . number_format($total_growth, 2) . '</td>';
                        } else {
                            $total_growth                   = '<td class="text-center pt-4">$' . number_format($total_growth, 2) . '</td>';
                        }
                        $icon								= $exchange['image_icon'];
                        echo '
					<tr class="pt-3">
						<th class="text-center pt-3 pl-5">
							<a href="' . site_url('Exchange/Market/' . $market_pair . '/' . $market). '">
								<div class="row">
									<span class="d-none d-md-block col-2 col-md-2 px-0" style="max-width: 50px;"><img src="' . base_url('assets/images/Exchanges/Icons/' . $icon) . '" alt="" /><br> </span> 
									<span class="col-2 col-md-8 pl-1 text-left d-none d-md-block">' . $market. ' <span class="badge badge-light">' . $market_pair . '</span><br><small>' . $description . '</small></span>
									<span class="col-2 col-md-2 text-left d-block d-md-none pl-0">' . $market. ' <span class="badge badge-light ">' . $market_pair . '</span><br><small class="d-none d-md-block">' . $description . '</small></span>
								</div>
							</a>
						</th>                
						<td class="text-center pt-4">' . $current_coin_value . '</td>   
						<td class="text-center pt-4">$' . number_format($current_value, 2) . '</td> 
						' . $total_growth . '          
						<td class="text-center pt-4">' . number_format($total_volume, 0) . '</td>
						<td class="d-none d-md-block text-center pt-4">' . number_format($total_coins, 0) . '</td>
					</tr>	
						';
                    }
                    ?>
				</tbody>
			</table>
		</div>
		<div class="col-12 mt-5">
			<div class="nk-block">
				<div class="card card-bordered">
					<div class="card-inner card-inner-lg">
						<div class="align-center flex-wrap flex-md-nowrap g-4">
							<div class="nk-block-image w-120px flex-shrink-0">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 118">
									<path
										d="M8.916,94.745C-.318,79.153-2.164,58.569,2.382,40.578,7.155,21.69,19.045,9.451,35.162,4.32,46.609.676,58.716.331,70.456,1.845,84.683,3.68,99.57,8.694,108.892,21.408c10.03,13.679,12.071,34.71,10.747,52.054-1.173,15.359-7.441,27.489-19.231,34.494-10.689,6.351-22.92,8.733-34.715,10.331-16.181,2.192-34.195-.336-47.6-12.281A47.243,47.243,0,0,1,8.916,94.745Z"
										transform="translate(0 -1)"
										fill="#f6faff"
									/>
									<rect x="18" y="32" width="84" height="50" rx="4" ry="4" fill="#fff" />
									<rect x="26" y="44" width="20" height="12" rx="1" ry="1" fill="#e5effe" />
									<rect x="50" y="44" width="20" height="12" rx="1" ry="1" fill="#e5effe" />
									<rect x="74" y="44" width="20" height="12" rx="1" ry="1" fill="#e5effe" />
									<rect x="38" y="60" width="20" height="12" rx="1" ry="1" fill="#e5effe" />
									<rect x="62" y="60" width="20" height="12" rx="1" ry="1" fill="#e5effe" />
									<path
										d="M98,32H22a5.006,5.006,0,0,0-5,5V79a5.006,5.006,0,0,0,5,5H52v8H45a2,2,0,0,0-2,2v4a2,2,0,0,0,2,2H73a2,2,0,0,0,2-2V94a2,2,0,0,0-2-2H66V84H98a5.006,5.006,0,0,0,5-5V37A5.006,5.006,0,0,0,98,32ZM73,94v4H45V94Zm-9-2H54V84H64Zm37-13a3,3,0,0,1-3,3H22a3,3,0,0,1-3-3V37a3,3,0,0,1,3-3H98a3,3,0,0,1,3,3Z"
										transform="translate(0 -1)"
										fill="#798bff"
									/>
									<path d="M61.444,41H40.111L33,48.143V19.7A3.632,3.632,0,0,1,36.556,16H61.444A3.632,3.632,0,0,1,65,19.7V37.3A3.632,3.632,0,0,1,61.444,41Z" transform="translate(0 -1)" fill="#6576ff" />
									<path
										d="M61.444,41H40.111L33,48.143V19.7A3.632,3.632,0,0,1,36.556,16H61.444A3.632,3.632,0,0,1,65,19.7V37.3A3.632,3.632,0,0,1,61.444,41Z"
										transform="translate(0 -1)"
										fill="none"
										stroke="#6576ff"
										stroke-miterlimit="10"
										stroke-width="2"
									/>
									<line x1="40" y1="22" x2="57" y2="22" fill="none" stroke="#fffffe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
									<line x1="40" y1="27" x2="57" y2="27" fill="none" stroke="#fffffe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
									<line x1="40" y1="32" x2="50" y2="32" fill="none" stroke="#fffffe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
									<line x1="30.5" y1="87.5" x2="30.5" y2="91.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round" />
									<line x1="28.5" y1="89.5" x2="32.5" y2="89.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round" />
									<line x1="79.5" y1="22.5" x2="79.5" y2="26.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round" />
									<line x1="77.5" y1="24.5" x2="81.5" y2="24.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round" />
									<circle cx="90.5" cy="97.5" r="3" fill="none" stroke="#9cabff" stroke-miterlimit="10" />
									<circle cx="24" cy="23" r="2.5" fill="none" stroke="#9cabff" stroke-miterlimit="10" />
								</svg>
							</div>
							<?php
                                $KYCStatus					= $_SESSION['allSessionData']['userAccount']['cuKYC'];
                                $open_listing_app			= $_SESSION['allSessionData']['userAccount']['open_listing_app'];
                                $getAppInfo 				= $this->exchange_model->get_open_listing_app($cuID, $open_listing_app);
                                foreach ($getAppInfo->result_array() as $appInfo) {
                                    $status					= $appInfo['status'];
                                }
                                if ($KYCStatus === 'No') {
                                    // New Application
                                    echo '
									<div class="nk-block-content">
										<div class="nk-block-content-head px-lg-4">
											<h5>New Digital Asset/Crypto Token Listing Request</h5>
											<p class="text-soft">Looking to have your DigiAsset or Coin listed on MyMI Exchange? Complete our application to have your Coin Listing reviewed and listed.</p>
										</div>
									</div>
									<div class="nk-block-content flex-shrink-0">
										<a class="btn btn-lg btn-outline-primary" id="contactAppBtn" data-toggle="modal" data-target="#coinListingApplication\Modal">Apply Now!</a>
									</div>
									';
                                } elseif ($KYCStatus === 'Yes') {
                                    if ($status === 'Started') {
                                        // Incomplete Application
                                        echo '
										<div class="nk-block-content">
											<div class="nk-block-content-head px-lg-4">
												<h5>Complete Your Digital Asset/Crypto Token Listing Application</h5>
												<p class="text-soft">It seems you have not complete your application to have your Digital Asset or Crypto Token listed on MyMI Exchange. Click below to complete your application today.</p>
											</div>
										</div>
										<div class="nk-block-content flex-shrink-0">
											<a class="btn btn-lg btn-outline-primary" id="completeAppBtn" href="' . site_url('/Exchange/Coin-Listing/Asset-Information') . '">Continue Now!</a>
										</div>
										';
                                    } elseif ($status === 'Pending') {
                                        // Application Pending Approval
                                        echo '
										<div class="nk-block-content">
											<div class="nk-block-content-head px-lg-4">
												<h5>Your Current Application is Pending</h5>
												<p class="text-soft">We are still processing your application to list your Digital Asset/Crypto Token on MyMI Exchange. If you have any questions, contact us here or by emailing our Customer Support Team via <a href="mailto:support@mymiwallet.com">support@mymiwallet.com</a>!</p>
											</div>
										</div>
										<div class="nk-block-content flex-shrink-0">
											<a class="btn btn-lg btn-outline-primary" id="supportAppBtn" data-toggle="modal" data-target="#coinListingApplication\Modal">Contact Us!</a>
										</div>
										';
                                    } elseif ($status === 'Complete') {
                                        // Coin Listing Dashboard
                                        echo '
										<div class="nk-block-content">
											<div class="nk-block-content-head px-lg-4">
												<h5>View Your Coin Listing Dashboard</h5>
												<p class="text-soft">{PLACE COIN LISTING STATISTICS HERE}</p>
											</div>
										</div>
										<div class="nk-block-content flex-shrink-0">
											<a class="btn btn-lg btn-outline-primary" id="coinDashboardBtn" data-toggle="modal" data-target="#coinListingApplication\Modal">Continue Now!</a>
										</div>
										';
                                    } else {
                                        // Go Straight to Asset Listing Application
                                        echo '
										<div class="nk-block-content">
											<div class="nk-block-content-head px-lg-4">
											<h5>New Digital Asset/Crypto Token Listing Request</h5>
											<p class="text-soft">Looking to have your DigiAsset or Coin listed on MyMI Exchange? Complete our application to have your Coin Listing reviewed and listed.</p>
											</div>
										</div>
										<div class="nk-block-content flex-shrink-0">
											<a class="btn btn-lg btn-outline-primary" id="completeAppBtn" href="' . site_url('/Exchange/Coin-Listing/Asset-Information') . '">Apply Now!</a>
										</div>
										';
                                    }
                                } else {
                                    // New Application
                                    echo '
									<div class="nk-block-content">
										<div class="nk-block-content-head px-lg-4">
											<h5>New Digital Asset/Crypto Token Listing Request</h5>
											<p class="text-soft">Looking to have your DigiAsset or Coin listed on MyMI Exchange? Complete our application to have your Coin Listing reviewed and listed.</p>
										</div>
									</div>
									<div class="nk-block-content flex-shrink-0">
										<a class="btn btn-lg btn-outline-primary" id="contactAppBtn" data-toggle="modal" data-target="#coinListingApplication\Modal">Apply Now!</a>
									</div>
									';
                                }
                            ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$this->load->view('Exchange/includes/application-modal');
// $this->load->view('includes/Coin_Listing_Request', $applicationData);
?>
