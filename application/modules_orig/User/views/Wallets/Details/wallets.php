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
									<h2 class="nk-block-title fw-bold myfs-md"><?php echo $walletTitle; ?></h2>
									<div class="nk-block-des">
										<p class="sub-text">View Your Financial Growths</p>
									</div>
								</div>
							</div>
						</div>
						<?php
                        if ($walletExchange === 'Yes') {
                            ?>
						<div class="nk-block-head-content">
							<ul class="nk-block-tools gx-3">
								<li class="opt-menu-md dropdown">
									<a href="<?php echo site_url('/Exchange/Market/' . $walletMarketPair . '/' . $walletMarket); ?>" class="btn btn-primary"><span>Trade <?= $walletMarket; ?></span> <em class="icon icon-arrow-right"></em></a>
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
										<div class="amount"><?php echo $walletAmount; ?> <small class="currency currency-usd">USD</small></div>
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
                            <?php
                                if ($this->uri->segment(2) === 'Details') {
                                    echo '
                                    <li class="btn-wrap dropdown">
                                        <a class="btn btn-icon btn-lg btn-dark dropdown-toggle" style="color: white;" type="button"  data-toggle="dropdown"><em class="icon ni ni-setting"></em></a><span class="btn-extext">Wallet Settings</span>
                                        <div class="dropdown-menu">
                                            <ul class="link-list-opt">
                                                <li>
                                                    <a href="' . site_url('/Wallet/Edit/' . $walletID) . '">Edit</a>
                                                </li>
                                                <li>
                                                    <a id="deleteWalletBtn" href="#" data-toggle="modal" data-target="#transactionModal">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    ';
                                } elseif ($this->uri->segment(2) === 'Edit') {
                                    echo '                                   
                                    <li class="btn-wrap">
                                        <a id="deleteWalletBtn" href="#" data-toggle="modal" data-target="#transactionModal">Delete</a>
                                    </li>
                                    ';
                                }
                            ?>
							<li class="btn-wrap dropdown">
								<a class="btn btn-icon btn-lg btn-dark dropdown-toggle" style="color: white;" type="button"  data-toggle="dropdown"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Trade</span>
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
								<a href="<?php echo site_url('/Wallets/Track-Deposit/' . $walletID); ?>" class="btn btn-icon btn-lg btn-dark"><em class="icon ni ni-plus"></em></a><span class="btn-extext">Deposit</span>
							</li>
							<li class="btn-wrap">
								<a href="<?php echo site_url('/Wallets/Track-Withdraw/' . $walletID); ?>" class="btn btn-icon btn-lg btn-primary"><em class="icon ni ni-arrow-to-right"></em></a><span class="btn-extext">Withdraw</span>
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
									<div class="nk-wg5-title"><h6 class="title overline-title myfs-xs">Total Gains/Losses</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php echo $walletGains; ?> <span class="currency currency-btc">USD</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title myfs-xs">Total Trades</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php echo $totalTrades; ?> <span class="currency currency-btc">Trades</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-bordered">
							<div class="card-inner">
								<div class="nk-wg5">
									<div class="nk-wg5-title"><h6 class="title overline-title myfs-xs">Deposits/Withdraw</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php echo $transferBalance; ?> <span class="currency currency-btc">USD</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php 
    if ($this->uri->segment(2) === 'Details') {
    ?>
	<div class="row gy-gs">
		<div class="col-md-12">
			<div class="nk-block">	  									
                <div class="card card-preview">
                    <div class="card-inner">     
                        <div class="nk-block-head-xs">
                            <div class="nk-block-head-content"><h5 class="nk-block-title title">Current Trades</h5></div>
                        </div>	
                        <div class="dt-bootstrap4 no-footer">
                            <div class="my-3">
                                <table class="table display" id="walletTradeOverviewDatatable" role="grid" aria-describedby="DataTables_Table_0_info">
                                    <?php
                                    $cuID		 					= $_SESSION['allSessionData']['userAccount']['cuID'];
                                    $cuRole 						= $_SESSION['allSessionData']['userAccount']['cuRole'];
                                    $cuType							= $_SESSION['allSessionData']['userAccount']['cuUserType'];
                                    $today				            = date("F jS, Y");
                                    $yesterday			            = date("m/d/y", time() - 60 * 60 * 24);
                                    $years                          = 5;
                                    $list                           = '';
                                    if (!empty($getUserWalletTrades)) {
                                        foreach ($getUserWalletTrades->result_array() as $val) {
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
                                        $response 			= json_decode($response, true); 
                                        ?>    
                                        <thead>
                                            <tr>     
                                                <th>Date Submitted</th>
                                                <th class="text-center">Trade Type</th>
                                                <th class="text-center">Stock</th>
                                                <th class="text-center">Shares / Contracts</th>
                                                <th class="text-center">Entry Price</th>
                                                <th class="text-center">Closing Price</th>
                                                <th class="text-center">Total P/L</th>
                                                <th class="text-center">Trade % Change</th>
                                                <th class="text-center">More Actions..</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($getUserWalletTrades->result_array() as $info) {
                                                $tradeID                    = $info['id']; 
                                                $orderID                    = $info['order_id']; 
                                                $trade_type                 = $info['trade_type']; 
                                                if ($trade_type === 'call') {
                                                    $trade_type             = 'Call - Option';
                                                    $symbol                 = $info['symbol_id']; 
                                                    $shares                 = $info['number_of_contracts']; 
                                                } elseif ($trade_type === 'put') {
                                                    $trade_type             = 'Put - Option';
                                                    $symbol                 = $info['symbol_id']; 
                                                    $shares                 = $info['number_of_contracts']; 
                                                } elseif ($trade_type === 'long') {
                                                    $trade_type             = 'Long - Equity';
                                                    $symbol                 = $info['symbol'];
                                                    $shares                 = $info['shares']; 
                                                } elseif ($trade_type === 'short') {
                                                    $trade_type             = 'Short - Equity';
                                                    $symbol                 = $info['symbol'];
                                                    $shares                 = $info['shares']; 
                                                } else {
                                                    $trade_type             = 'N/A';
                                                }
                                                $open_date                  = $info['open_date'];
                                                $entry_price                = $info['entry_price'];
                                                $last_price                 = 'N/A'; 
                                                $this->db->from('bf_users_trades'); 
                                                $this->db->where('existing_order_id', $orderID); 
                                                $getClosedTrade             = $this->db->get();  
                                                if (!empty($getClosedTrade)) {
                                                    foreach($getClosedTrade->result_array() as $closedTrade) {
                                                        $closing_price      = '$' . $closedTrade['close_price'];
                                                        $profit_loss_total  = $closedTrade['close_price'] - $entry_price; 
                                                        $pl_total           = number_format($profit_loss_total * $shares, 2);
                                                        if ($pl_total > 0.00) {
                                                            $pl_total       = '<span class="statusGreen">' . $pl_total . '</span>'; 
                                                        } elseif ($pl_total < 0.00) {
                                                            $pl_total       = '<span class="statusRed">' . $pl_total . '</span>'; 
                                                        }
                                                        $trade_percent      = number_format((($closedTrade['close_price'] - $entry_price) / $entry_price),2) . '%';
                                                        if ($trade_percent > 0.00) {
                                                            $trade_percent  = '<span class="statusGreen">' . $trade_percent . '</span>'; 
                                                        } elseif ($trade_percent < 0.00) {
                                                            $trade_percent  = '<span class="statusRed">' . $trade_percent . '</span>'; 
                                                        }
                                                    }
                                                } else {
                                                    $closing_price          = 'N/A'; 
                                                    $profit_loss            = 'N/A'; 
                                                }
                                                //$tradePercentChg            = ($exit_price / $entry_price) * 100; 
                                                echo '
                                                <tr>
                                                    <td>' . $open_date . '</td>
                                                    <td class="text-center">' . $trade_type . '</td>
                                                    <td class="text-center">' . $symbol . '</td>
                                                    <td class="text-center">' . $shares . '</td>
                                                    <td class="text-center">$' . $entry_price . '</td>
                                                    <td class="text-center">' . $closing_price . '</td>
                                                    <td class="text-center">' . $pl_total . '</td>
                                                    <td class="text-center">' . $trade_percent . '</td>
                                                    <td class="text-center">																		
                                                        <a class="mr-2" href=""><i class="icon-chart" data-toggle="tooltip" data-placement="bottom" title="View Stock Chart"></i></a>
                                                        
                                                        <a class="mr-2" href="' . site_url('Trade-Tracker/Log/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="View Trade Log"><i class="icon-notebook"></i></a>
                                                        
                                                        <a class="mr-2" href="' . site_url('Trade-Tracker/Update/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Update Trade Log"><i class="icon-note"></i></a>
                                                        
                                                        <a class="mr-2 text-danger" href="' . site_url('Trade-Tracker/Close/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Close Trade Log"><i class="icon ni ni-wallet-out" style="font-size:1rem !important;"></i></a>
                                                        
                                                        <a class="text-danger" data-toggle="modal" data-target="#deleteModal' . $info['id'] . '" data-toggle="tooltip" data-placement="bottom" title="Delete Trade Log"><i class="icon ni ni-file-remove" style="font-size:1rem !important;"></i></a>
                                                    </td>
                                                </tr>';
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
	</div>
    <?php
    }
    ?>
</div>