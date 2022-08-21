<?php
$redirect_url				= $this->uri->uri_string();
$today						= date('h:i A');
$cuID                       = $_SESSION['allSessionData']['userAccount']['cuID']; 
$walletID					= $this->uri->segment(2);
$getWalletInfo				= $this->mymiwallet->get_wallet_info($cuID, $walletID);
$walletInitial				= isset($getWalletInfo['walletInitial']) && ! empty($getWalletInfo['walletInitial']) ? $getWalletInfo['walletInitial'] : '';
// Wallet Details
if (!empty($getWalletInfo['walletInitial'])) {
    $walletInitial			= $getWalletInfo['walletInitial'];
} else {
    $walletInitial			= '0.00';
}
if (!empty($getWalletInfo['walletInitialAmount'])) {
    $walletInitialAmount	= $getWalletInfo['walletInitialAmount'];
} else {
    $walletInitialAmount	= '0.00';
}
if (!empty($getWalletInfo['depositAmount'])) {
    $depositAmount	= $getWalletInfo['depositAmount'];
} else {
    $depositAmount	= '0.00';
}
if (!empty($getWalletInfo['withdrawAmount'])) {
    $withdrawAmount	= $getWalletInfo['withdrawAmount'];
} else {
    $withdrawAmount	= '0.00';
}
if (!empty($getWalletInfo['withdrawAmount'])) {
    $withdrawAmount	= $getWalletInfo['withdrawAmount'];
} else {
    $withdrawAmount	= '0.00';
}
if (!empty($getWalletInfo['walletGains'])) {
    $walletGains	= $getWalletInfo['walletGains'];
} else {
    $walletGains	= '0.00';
}
if (!empty($getWalletInfo['walletTotalAmount'])) {
    $walletTotalAmount	= $getWalletInfo['walletTotalAmount'];
} else {
    $walletTotalAmount	= '0.00';
}
$walletTitle				= $getWalletInfo['walletTitle'];
$wallet_nickname			= $getWalletInfo['walletNickname'];
$wallet_default				= $getWalletInfo['walletDefault'];
$exchange_wallet			= $getWalletInfo['walletExchange'];
$wallet_market_pair			= $getWalletInfo['walletMarketPair'];
$wallet_market				= $getWalletInfo['walletMarket'];


$getAllPercentChange		= $this->tracker_model->get_all_percent_change($walletID);
foreach ($getAllPercentChange->result_array() as $walletTrades) {
    $percent_change			= $walletTrades['closed_perc'];
    if ($percent_change === null) {
        $percentChange			= '<span">0%</span>';
    } elseif ($percent_change >= 0) {
        $percentChange			= '<span class="text-success">' . $percent_change . '%</span>';
    } else {
        $percentChange			= '<span class="text-danger">' . $percent_change . '%</span>';
    }
}

$getLastTradeByUser							= $this->tracker_model->get_last_trade_info_by_user($cuID);
foreach ($getLastTradeByUser->result_array() as $lastTradeByUser) {
    $lastTradeActivityDate					= $lastTradeByUser['submitted_date'];
}
// Get User Trades
$getTrades		= $this->tracker_model->get_all_wallet_trades($walletID);
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<div class="nk-block">
				<div class="nk-block-head">
					<?php echo theme_view('navigation_breadcrumbs'); ?>
					<div class="nk-block-between-md g-4">
						<div class="nk-block-head-content">
							<div class="nk-wgwh">
								<em class="icon-circle icon-circle-lg icon ni ni-sign-usd" style="margin-top: -35px;"></em>
								<div class="nk-wgwh-title h5">
									<h2 class="nk-block-title fw-bold"><?php echo $walletTitle; ?></h2>
									<div class="nk-block-des">
										<p>
											<span class="d-block d-md-none">View Your Financial Growth</span>
											<span class="d-none d-md-block">View Your Financial Growth All In One Place!</span>
										</p>
									</div>
								</div>
							</div>
						</div>
						<?php
                        if ($exchange_wallet === 'Yes') {
                            ?>
						<div class="nk-block-head-content">
							<ul class="nk-block-tools gx-3">
								<li class="opt-menu-md dropdown">
									<a href="<?php echo site_url('/Exchange/Market/' . $wallet_market_pair . '/' . $wallet_market); ?>" class="btn btn-primary"><span>Trade <?= $wallet_market; ?></span> <em class="icon icon-arrow-right"></em></a>
								</li>
							</ul>
						</div>
						<?php
                        }
                        ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="nk-block">
				<div class="nk-block-between-md g-4">
					<div class="nk-block-content">
						<div class="nk-wg1">
							<div class="nk-wg1-group g-2">
								<div class="nk-wg1-item mr-xl-4">
									<div class="nk-wg1-title text-soft">Available Balance</div>
									<div class="nk-wg1-amount">
										<div class="amount"><?php echo $walletTotalAmount; ?> <small class="currency currency-usd">USD</small></div>
										<div class="amount-sm">
											Total Growth <span><?php echo $walletGains; ?> <span class="currency currency-usd">USD</span></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="nk-block-content">
						<ul class="nk-block-tools gx-3">
							<li class="btn-wrap dropdown">
								<a class="btn btn-icon btn-xl btn-dark dropdown-toggle" style="color: white;" type="button"  data-toggle="dropdown"><em class="icon ni ni-setting"></em></a><span class="btn-extext">Wallet Settings</span>
								<div class="dropdown-menu">
									<ul class="link-list-opt">
										<li>
											<a href="<?php echo site_url('/Edit-Wallet/' . $walletID); ?>">Edit Wallet</a>
										</li>
										<li>
											<a href="" data-toggle="modal" data-target="#deleteWalletModal<?= $walletID; ?>">Delete Wallet</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="btn-wrap dropdown">
								<a class="btn btn-icon btn-xl btn-dark dropdown-toggle" style="color: white;" type="button"  data-toggle="dropdown"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Quick Trade</span>
								<div class="dropdown-menu">
									<ul class="link-list-opt">
										<li>
											<a data-toggle="modal" data-target="#quickEquityTradeModel">Equity Trade</a>
										</li>
										<li>
											<a data-toggle="modal" data-target="#quickOptionTradeModel">Option Trade</a>
										</li>
									</ul>
								</div>
							</li>
							<li class="btn-wrap">
								<a href="<?php echo site_url('/Add-Wallet-Deposit/' . $walletID); ?>" class="btn btn-icon btn-xl btn-dark"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Deposit Funds</span>
							</li>
							<li class="btn-wrap">
								<a href="<?php echo site_url('/Add-Wallet-Withdraw/' . $walletID); ?>" class="btn btn-icon btn-xl btn-primary"><em class="icon ni ni-arrow-to-right"></em></a><span class="btn-extext">Withdraw Funds</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="nk-block nk-block-lg pb-3">
				<div class="row g-gs">
					<div class="col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title">Total Gains/Losses</h6></div>
									<div class="nk-wg5-text pb-2">
										<div class="nk-wg5-amount">
											<div class="amount"><?php echo $walletGains; ?> <span class="currency currency-btc">USD</span></div>
											<div class="amount-sm"><?php echo $percentChange; ?> <span class="currency currency-usd">USD</span></div>
										</div>
									</div>
									<div class="nk-wg5-foot">
										<!-- <span class="text-soft"><strong>Last Trade at</strong> <span class="text-base"><?php //print_r($$_SESSION['allSessionData']['userLastActivity']); ?></span></span> -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title">Total Deposits</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php echo $depositAmount; ?> <span class="currency currency-btc">USD</span></div>
<!--
											<div class="amount-sm"><?php echo $lastDepositAmount; ?> <span class="currency currency-usd">USD</span></div>
-->
										</div>
									</div>
									<div class="nk-wg5-foot">
										<!-- <span class="text-soft"><strong>Last Deposit at</strong> <span class="text-base"><?php //$userLastActivity['depositActivity']; ?></span></span> -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title">Total Withdraw</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php echo $withdrawAmount; ?> <span class="currency currency-btc">USD</span></div>
<!--
											<div class="amount-sm"><?php echo $lastWithdrawAmount; ?> <span class="currency currency-usd">USD</span></div>
-->
										</div>
									</div>
									<div class="nk-wg5-foot">
										<!-- <span class="text-soft"><strong>Last Withdraw at</strong> <span class="text-base"><?php //$userLastActivity['withdrawActivity']; ?></span></span> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row gy-gs">
		<div class="col-md-12">
			<div class="nk-block">	
				<ul class="nav nav-tabs nav-fill">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#current_trades">Current Trades</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#trade_history">Trade History</a>
					</li>
				</ul>			
				<div class="tab-content">
					<div class="tab-pane container active" id="current_trades">   									
						<div class="card card-preview">
							<div class="card-inner">     
								<div class="nk-block-head-xs">
									<div class="nk-block-head-content"><h5 class="nk-block-title title">Current Trades</h5></div>
								</div>	
								<div class="dt-bootstrap4 no-footer">
									<div class="my-3">
										<table class="table display" id="alertOverviewDatatable" role="grid" aria-describedby="DataTables_Table_0_info">
											<?php
                                            $cuID		 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
                                            $cuRole 						= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
                                            $cuType							= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';
                                            $today				            = date("F jS, Y");
                                            $yesterday			            = date("m/d/y", time() - 60 * 60 * 24);
                                            $years                          = 5;
                                            $list                           = '';
                                            $getSymbols                     = $this->tracker_model->get_wallet_trades($walletID);
                                            if (!empty($getSymbols)) {
                                                foreach ($getSymbols->result_array() as $val) {
                                                    if (is_array($val)) {
                                                        $list .= $val['symbol'].',';
                                                    }
                                                }

                                                $curl 			= curl_init();
                                                $curlURL		= 'https://api.tdameritrade.com/v1/marketdata/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF&symbol=' . $list;
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
                                                $response 			= json_decode($response, true); ?>    
												<thead>
													<tr>     
														<th>Date Submitted</th>
														<th class="text-center">Type</th>
														<th class="text-center">Stock</th>
														<th class="text-center">Alert Price</th>
														<th class="text-center">Market Price</th>
														<th class="text-center">Trade % Change</th>
														<th class="text-center">More Actions..</th>
													</tr>
												</thead>
												<tbody>
													<?php
                                                    foreach ($getSymbols->result_array() as $info) {
                                                        $tradeID			= $info['id'];
                                                        $submitted_date		= $info['submitted_date'];
                                                        // $last_updated		= $info['last_updated'];
                                                        // $date1 				= $today;
                                                        // $date2 				= $submitted_date;
                                                        // $date3 				= $last_updated;
                                                        // $diff 				= abs(strtotime($date2) - strtotime($date1));
                                                        // $diffB 				= abs(strtotime($date3) - strtotime($date1));
                                                        // $days 				= floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                        // $daysB 				= floor(($diffB - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                        // $tradeLength		= $days;
                                                        // if (!empty($last_updated)) {
                                                        //     $updatedLength		= $daysB;
                                                        // } else {
                                                        //     $updatedLength		= 0;
                                                        // }
                                                        // $type				= $info['type'];
                                                        $stock				= $info['symbol'];
                                                        $exchange			= $info['exchange'];
                                                        $stockURL			= $category . '/' . $exchange . '/' . $stock;
                                                        $targetPrice		= $info['potential_price'];
                                                        if ($info['stock'] = $response[$stock]) {
                                                            //~ if ($info['category'] === 'Option Trade') {
                                                            //~ } elseif ($info['category'] === 'Equity Trade') {
                                                            //~ } elseif ($info['category'] === 'Crypto') {
                                                            //~ } else {
                                                            //~ }
                                                            $description		= $response[$stock]['description'];
                                                            $lastPrice			= round($response[$stock]['lastPrice'], 2);
                                                            $markPrice			= round($response[$stock]['mark'], 2);
                                                            $closePrice			= round($response[$stock]['closePrice'], 2);
                                                            $netChangeTotal		= round($response[$stock]['netChange'], 2);
                                                            if ($netChangeTotal === null) {
                                                                $netChange = 0;
                                                            } else {
                                                                $netChange = $netChangeTotal;
                                                            }
                                                            $categoryType		= $info['trade_type'];
                                                            if ($categoryType === 'Equity Trade') {
                                                                $category		= 'Equity';
                                                            } elseif ($categoryType === 'Option Trade') {
                                                                $category		= 'Option';
                                                            }
                                                            $alertPrice			= $info['current_price'];
                                                            $compPrice			= $markPrice;
                                                            $alertChange 		= round((($compPrice - $alertPrice)/$alertPrice) * 100, 2);
                                                            if ($alertChange > 0) {
                                                                $alertPercent	= '<span class="text-success">' . round($alertChange, 2) . '%</span>';
                                                            } elseif ($alertChange < 0) {
                                                                $alertPercent	= '<span class="text-danger">' . round($alertChange, 2) . '%</span>';
                                                            }
                                                            $markChange			= $response[$stock]['markChangeInDouble'];
                                                            $markPercent		= $response[$stock]['markPercentChangeInDouble'];
                                                            if ($markPercent > 0) {
                                                                $perChange	= '<span class="text-success">' . round($markPercent, 2) . '%</span>';
                                                            } elseif ($markPercent < 0) {
                                                                $perChange	= '<span class="text-danger">' . round($markPercent, 2) . '%</span>';
                                                            }
                                                            $offRange			= $targetPrice - $lastPrice;
                                                            if ($offRange > 0) {
                                                                $offRangePrice	= '<span class="text-danger">-$' . $offRange . '</span>';
                                                            } elseif ($offRange < 0) {
                                                                $offRangePrice 	= '<span class="text-success">+$' . $offRange . '</span>';
                                                            }
                                                            if ($lastPrice > 0 and $closePrice > 0) {
                                                                echo '
																<tr>
																	<td>' . $submitted_date . '</td>
																	<td class="text-center">' . $category . '</td>
																	<td class="text-center"><a href="' . site_url($stockURL) . '">' . $stock . '</a></td>
																	<td class="text-center">$' . $alertPrice . '</td>
																	<td class="text-center">$' . $lastPrice . '</td>
																	<td class="text-center">' . $alertPercent . '</td>
																	<td class="text-center">																		
																		<a class="mr-2" href="https://www.mymillennialinvestments.com/' . $stockURL . '"><i class="icon-chart" data-toggle="tooltip" data-placement="bottom" title="View Stock Chart"></i></a>
																		
																		<a class="mr-2" href="' . site_url('Trade-Tracker/Log/' . $stock . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="View Trade Log"><i class="icon-notebook"></i></a>
																		
																		<a class="mr-2" href="' . site_url('Trade-Tracker/Update/' . $stock . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Update Trade Log"><i class="icon-note"></i></a>
																		
																		<a class="mr-2 text-danger" href="' . site_url('Trade-Tracker/Close/' . $stock . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Close Trade Log"><i class="icon ni ni-wallet-out" style="font-size:1rem !important;"></i></a>
																		
																		<a class="text-danger" data-toggle="modal" data-target="#deleteModal' . $info['id'] . '" data-toggle="tooltip" data-placement="bottom" title="Delete Trade Log"><i class="icon ni ni-file-remove" style="font-size:1rem !important;"></i></a>
																	</td>
																</tr>';
                                                            }
                                                        }
                                                    } ?>
												</tbody>
											<?php
                                            }
                                            ?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane container fade" id="trade_history">								
						<div class="card card-preview">
							<div class="card-inner">    
								<div class="nk-block-head-xs">
									<div class="nk-block-head-content"><h5 class="nk-block-title title">Trade History</h5></div>
								</div>	
								<div class="dt-bootstrap4 no-footer">
									<div class="my-3">
										<table class="table display" id="tradeHistoryDatatable" role="grid" aria-describedby="DataTables_Table_0_info">
											<?php
                                            $cuID		 					= isset($current_user->id) && ! empty($current_user->id) ? $current_user->id : '';
                                            $cuRole 						= isset($current_user->role_id) && ! empty($current_user->role_id) ? $current_user->role_id : '';
                                            $cuType							= isset($current_user->type) && ! empty($current_user->type) ? $current_user->type : '';
                                            $today				= date("F jS, Y");
                                            $yesterday			= date("m/d/y", time() - 60 * 60 * 24);

                                            $getSymbols 		= $this->tracker_model->get_user_closed_trades($cuID);
                                            if (!empty($getSymbols)) {
                                                foreach ($getSymbols->result_array() as $val) {
                                                    if (is_array($val)) {
                                                        $list .= $val['stock'].',';
                                                    }
                                                }

                                                $curl 			= curl_init();
                                                $curlURL		= 'https://api.tdameritrade.com/v1/marketdata/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF&symbol=' . $list;
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
                                                $response 			= json_decode($response, true); ?>    
												<thead>
													<tr>     
														<th>Date Submitted</th>
														<th class="text-center">Type</th>
														<th class="text-center">Stock</th>
														<th class="text-center">Alert Price</th>
														<th class="text-center">Market Price</th>
														<th class="text-center">Trade % Change</th>
														<th class="text-center">More Actions..</th>
													</tr>
												</thead>
												<tbody>
													<?php
                                                    foreach ($getSymbols->result_array() as $info) {
                                                        $tradeID			= $info['id'];
                                                        $submitted_date		= $info['submitted_date'];
                                                        // $last_updated		= $info['last_updated'];
                                                        // $date1 				= $today;
                                                        // $date2 				= $submitted_date;
                                                        // $date3 				= $last_updated;
                                                        // $diff 				= abs(strtotime($date2) - strtotime($date1));
                                                        // $diffB 				= abs(strtotime($date3) - strtotime($date1));
                                                        // $days 				= floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                        // $daysB 				= floor(($diffB - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                        // $tradeLength		= $days;
                                                        // if (!empty($last_updated)) {
                                                        //     $updatedLength		= $daysB;
                                                        // } else {
                                                        //     $updatedLength		= 0;
                                                        // }
                                                        // $type				= $info['type'];
                                                        $stock				= $info['symbol'];
                                                        $exchange			= $info['exchange'];
                                                        $stockURL			= $category . '/' . $exchange . '/' . $stock;
                                                        $targetPrice		= $info['potential_price'];
                                                        if ($info['stock'] = $response[$stock]) {
                                                            //~ if ($info['category'] === 'Option Trade') {
                                                            //~ } elseif ($info['category'] === 'Equity Trade') {
                                                            //~ } elseif ($info['category'] === 'Crypto') {
                                                            //~ } else {
                                                            //~ }
                                                            $description		= $response[$stock]['description'];
                                                            $lastPrice			= round($response[$stock]['lastPrice'], 2);
                                                            $markPrice			= round($response[$stock]['mark'], 2);
                                                            $closePrice			= round($response[$stock]['closePrice'], 2);
                                                            $netChangeTotal		= round($response[$stock]['netChange'], 2);
                                                            if ($netChangeTotal === null) {
                                                                $netChange = 0;
                                                            } else {
                                                                $netChange = $netChangeTotal;
                                                            }
                                                            $categoryType		= $info['category'];
                                                            if ($categoryType === 'Equity Trade') {
                                                                $category		= 'Equity';
                                                            } elseif ($categoryType === 'Option Trade') {
                                                                $category		= 'Option';
                                                            }
                                                            $alertPrice			= $info['current_price'];
                                                            $compPrice			= $markPrice;
                                                            $alertChange 		= round((($compPrice - $alertPrice)/$alertPrice) * 100, 2);
                                                            if ($alertChange > 0) {
                                                                $alertPercent	= '<span class="text-success">' . round($alertChange, 2) . '%</span>';
                                                            } elseif ($alertChange < 0) {
                                                                $alertPercent	= '<span class="text-danger">' . round($alertChange, 2) . '%</span>';
                                                            }
                                                            $markChange			= $response[$stock]['markChangeInDouble'];
                                                            $markPercent		= $response[$stock]['markPercentChangeInDouble'];
                                                            if ($markPercent > 0) {
                                                                $perChange	= '<span class="text-success">' . round($markPercent, 2) . '%</span>';
                                                            } elseif ($markPercent < 0) {
                                                                $perChange	= '<span class="text-danger">' . round($markPercent, 2) . '%</span>';
                                                            }
                                                            $offRange			= $targetPrice - $lastPrice;
                                                            if ($offRange > 0) {
                                                                $offRangePrice	= '<span class="text-danger">-$' . $offRange . '</span>';
                                                            } elseif ($offRange < 0) {
                                                                $offRangePrice 	= '<span class="text-success">+$' . $offRange . '</span>';
                                                            }
                                                            if ($lastPrice > 0 and $closePrice > 0) {
                                                                echo '
																<tr>
																	<td>' . $submitted_date . '</td>
																	<td class="text-center">' . $category . '</td>
																	<td class="text-center"><a href="' . site_url($stockURL) . '">' . $stock . '</a></td>
																	<td class="text-center">$' . $alertPrice . '</td>
																	<td class="text-center">$' . $lastPrice . '</td>
																	<td class="text-center">' . $alertPercent . '</td>
																	<td class="text-center">																		
																		<a class="mr-2" href="https://www.mymillennialinvestments.com/' . $stockURL . '"><i class="icon-chart" data-toggle="tooltip" data-placement="bottom" title="View Stock Chart"></i></a>
																		
																		<a class="mr-2" href="' . site_url('Trade-Tracker/Log/' . $stock . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="View Trade Log"><i class="icon-notebook"></i></a>
																		
																		<a class="mr-2" href="' . site_url('Trade-Tracker/Update/' . $stock . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Update Trade Log"><i class="icon-note"></i></a>
																		
																		<a class="mr-2 text-danger" href="' . site_url('Trade-Tracker/Close/' . $stock . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Close Trade Log"><i class="icon ni ni-wallet-out" style="font-size:1rem !important;"></i></a>
																		
																		<a class="text-danger" data-toggle="modal" data-target="#deleteModal' . $info['id'] . '" data-toggle="tooltip" data-placement="bottom" title="Delete Trade Log"><i class="icon ni ni-file-remove" style="font-size:1rem !important;"></i></a>
																	</td>
																</tr>';
                                                            }
                                                        }
                                                    } ?>
												</tbody>
											<?php
                                            }
                                            ?>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>
<?php
foreach ($getTrades->result_array() as $trade) {
                                                $trade_id							= $trade['id'];
                                                echo '
<div class="modal fade" id="deleteModal' . $trade_id . '" tabindex="-1" role="dialog" aria-labelledby="deleteModal' . $trade_id . '" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Delete Trade?</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are you sure you want to delete this trade from the trade tracker?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				<a type="button" class="btn btn-primary" href="' . site_url('Trade-Tracker/Delete/' . $trade_id . '/' . $redirect_url) . '">Yes</a>
			</div>
		</div>
	</div>
</div>
';
                                            }
?>
<div class="modal fade" id="quickEquityTradeModel" tabindex="-1" role="dialog" aria-labelledby="quickTradeModel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Add Quick Trade</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-1">
				<?php
                $walletTranfer[]			= 'Equity';
                $walletTransfer				= array(
                    'wallet_id'				=> $wallet_id,
                    'walletTitle'			=> $walletTitle,
                    'current_trade_type'	=> 'Option',
                );
                $this->load->view('User/Trade_Tracker/Quick_Trade', $walletTransfer);
                ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
				<div class="control-group">
					<div class="controls ml-3">
						<input class="btn btn-primary" type="submit" name="register" id="submit" value="Submit" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="quickOptionTradeModel" tabindex="-1" role="dialog" aria-labelledby="quickTradeModel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Add Quick Trade</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pt-1">
				<?php
                $walletTransfer				= array(
                    'wallet_id'				=> $wallet_id,
                    'walletTitle'			=> $walletTitle,
                    'current_trade_type'	=> 'Option',
                );
                $this->load->view('User/Trade_Tracker/Quick_Trade', $walletTransfer);
                ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
				<div class="control-group">
					<div class="controls ml-3">
						<input class="btn btn-primary" type="submit" name="register" id="submit" value="Submit" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
echo '
<div class="modal fade" id="deleteWalletModal' . $walletID . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Delete This Wallet?</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this wallet? </p>
				<table class="table table-borderless pt-3">
					<tbody>
						<tr>
							<th>Wallet Name:</th>
							<td>' . $walletTitle . '</td>
						</tr>
					</tbody>
				</table>
			</div>             
			<div class="modal-footer">                                                    
				<a type="button" class="btn btn-success" href="' . site_url('Delete-Wallet/' . $walletID) . '">Yes</a>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
';
?>
