<?php
$redirect_url				    = $this->uri->uri_string();
$today						    = date('h:i A');
$cuID                           = $_SESSION['allSessionData']['userAccount']['cuID']; 
$cuEmail                        = $_SESSION['allSessionData']['userAccount']['cuEmail']; 
$cuUsername                     = $_SESSION['allSessionData']['userAccount']['cuUsername']; 
$walletID					    = $this->uri->segment(2);
$getWalletInfo				    = $this->mymiwallet->get_wallet_info($cuID, $walletID);
$walletInitial				    = isset($getWalletInfo['walletInitial']) && ! empty($getWalletInfo['walletInitial']) ? $getWalletInfo['walletInitial'] : '';
// Wallet Details
if (!empty($getWalletInfo['walletInitial'])) {
    $walletInitial			    = $getWalletInfo['walletInitial'];
} else {
    $walletInitial			    = '0.00';
}
if (!empty($getWalletInfo['walletInitialAmount'])) {
    $walletInitialAmount	    = number_format($getWalletInfo['walletInitialAmount'],2);
} else {
    $walletInitialAmount	    = '0.00';
}
if (!empty($getWalletInfo['depositAmount'])) {
    $depositAmount	            = number_format($getWalletInfo['depositAmount'],2);
} else {
    $depositAmount	            = '0.00';
}
if (!empty($getWalletInfo['withdrawAmount'])) {
    $withdrawAmount	            = number_format($getWalletInfo['withdrawAmount'],2);
} else {
    $withdrawAmount             = '0.00';
}
if (!empty($getWalletInfo['walletGains'])) {
    $walletGains	            = number_format($getWalletInfo['walletGains'],2);
} else {
    $walletGains	            = '0.00';
}
if (!empty($getWalletInfo['walletTotalAmount'])) {
    $walletTotalAmount	        = number_format($getWalletInfo['walletTotalAmount'],2);
} else {
    $walletTotalAmount	        = '0.00';
}
$walletBroker                   = $getWalletInfo['walletBroker'];
$walletAccountID                = $getWalletInfo['walletAccountID'];
$walletAccessCode               = $getWalletInfo['walletAccessCode'];
$walletPremium                  = $getWalletInfo['walletPremium'];
$walletTitle				    = $getWalletInfo['walletTitle'];
$wallet_nickname			    = $getWalletInfo['walletNickname'];
$wallet_default				    = $getWalletInfo['walletDefault'];
$exchange_wallet			    = $getWalletInfo['walletExchange'];
$wallet_market_pair			    = $getWalletInfo['walletMarketPair'];
$wallet_market				    = $getWalletInfo['walletMarket'];


$getAllPercentChange		    = $this->tracker_model->get_all_percent_change($walletID);
foreach ($getAllPercentChange->result_array() as $walletTrades) {
    $percent_change			    = $walletTrades['closed_perc'];
    if ($percent_change === null) {
        $percentChange			= '<span">0%</span>';
    } elseif ($percent_change >= 0) {
        $percentChange			= '<span class="text-success">' . $percent_change . '%</span>';
    } else {
        $percentChange			= '<span class="text-danger">' . $percent_change . '%</span>';
    }
}

$getLastTradeByUser				= $this->tracker_model->get_last_trade_info_by_user($cuID);
foreach ($getLastTradeByUser->result_array() as $lastTradeByUser) {
    $lastTradeActivityDate		= $lastTradeByUser['submitted_date'];
}
// Get User Trades
$getTrades		                = $this->tracker_model->get_all_wallet_trades($walletID);

$getSymbols                     = $this->tracker_model->get_wallet_trades_openings($walletID);
$total_trades                   = $getSymbols->num_rows();

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
									<div class="nk-wg5-title"><h6 class="title overline-title">Total Trades</h6></div>
									<div class="nk-wg5-text">
										<div class="nk-wg5-amount">
											<div class="amount"><?php echo $total_trades; ?> <span class="currency currency-btc">Trades</span></div>
<!--
											<div class="amount-sm"><?php //echo $lastDepositAmount; ?> <span class="currency currency-usd">USD</span></div>
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
											<div class="amount-sm"><?php //echo $lastWithdrawAmount; ?> <span class="currency currency-usd">USD</span></div>
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
                                            foreach ($getSymbols->result_array() as $info) {
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
                                                // $tradeID			            = $info['id'];
                                                // $open_date  		            = $info['open_date'];
                                                // $entry_price                    = $info['entry_price'];
                                                // if ($info['trade_type'] === 'call' OR 'put') {
                                                //     $stock			            = $info['symbol_id'];
                                                //     $symbol                     = $info['symbol'];
                                                //     $last_price                 = 'N/A'; 
                                                //     $this->db->from('bf_users_trades'); 
                                                //     $this->db->where('existing_order_id', $tradeID);
                                                //     $getClosingTrades           = $this->db->get(); 
                                                //     foreach ($getClosingTrades->result_array() as $closingTrade) {
                                                //         $exit_price         = $closingTrade['close_price'];
                                                //         $tradePercentChg    = ($exit_price / $entry_price) * 100; 
                                                //         echo '
                                                //         <tr>
                                                //             <td></td>
                                                //             <td class="text-center">' . $open_date . '</td>
                                                //             <td class="text-center">' . $symbol . ' - ' . $stock . '</td>
                                                //             <td class="text-center">$' . $entry_price . '</td>
                                                //             <td class="text-center">$' . $exit_price . '</td>
                                                //             <td class="text-center">$' . $last_price . '</td>
                                                //             <td class="text-center"></td>
                                                //             <td class="text-center">																		
                                                //                 <a class="mr-2" href=""><i class="icon-chart" data-toggle="tooltip" data-placement="bottom" title="View Stock Chart"></i></a>
                                                                
                                                //                 <a class="mr-2" href="' . site_url('Trade-Tracker/Log/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="View Trade Log"><i class="icon-notebook"></i></a>
                                                                
                                                //                 <a class="mr-2" href="' . site_url('Trade-Tracker/Update/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Update Trade Log"><i class="icon-note"></i></a>
                                                                
                                                //                 <a class="mr-2 text-danger" href="' . site_url('Trade-Tracker/Close/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Close Trade Log"><i class="icon ni ni-wallet-out" style="font-size:1rem !important;"></i></a>
                                                                
                                                //                 <a class="text-danger" data-toggle="modal" data-target="#deleteModal' . $info['id'] . '" data-toggle="tooltip" data-placement="bottom" title="Delete Trade Log"><i class="icon ni ni-file-remove" style="font-size:1rem !important;"></i></a>
                                                //             </td>
                                                //         </tr>';
                                                //     };
                                                //     // if (!empty($getClosingTrades)) {
                                                //     //     foreach ($getClosingTrades->result_array() as $closingTrade) {
                                                //     //         $exit_price         = $closingTrade['close_price'];
                                                //     //         $tradePercentChg    = ($exit_price / $entry_price) * 100; 
                                                //     //         echo '
                                                //     //         <tr>
                                                //     //             <td></td>
                                                //     //             <td class="text-center">' . $open_date . '</td>
                                                //     //             <td class="text-center">' . $symbol . ' - ' . $stock . '</td>
                                                //     //             <td class="text-center">$' . $entry_price . '</td>
                                                //     //             <td class="text-center">$' . $exit_price . '</td>
                                                //     //             <td class="text-center">$' . $last_price . '</td>
                                                //     //             <td class="text-center"></td>
                                                //     //             <td class="text-center">																		
                                                //     //                 <a class="mr-2" href=""><i class="icon-chart" data-toggle="tooltip" data-placement="bottom" title="View Stock Chart"></i></a>
                                                                    
                                                //     //                 <a class="mr-2" href="' . site_url('Trade-Tracker/Log/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="View Trade Log"><i class="icon-notebook"></i></a>
                                                                    
                                                //     //                 <a class="mr-2" href="' . site_url('Trade-Tracker/Update/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Update Trade Log"><i class="icon-note"></i></a>
                                                                    
                                                //     //                 <a class="mr-2 text-danger" href="' . site_url('Trade-Tracker/Close/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Close Trade Log"><i class="icon ni ni-wallet-out" style="font-size:1rem !important;"></i></a>
                                                                    
                                                //     //                 <a class="text-danger" data-toggle="modal" data-target="#deleteModal' . $info['id'] . '" data-toggle="tooltip" data-placement="bottom" title="Delete Trade Log"><i class="icon ni ni-file-remove" style="font-size:1rem !important;"></i></a>
                                                //     //             </td>
                                                //     //         </tr>';
                                                //     //     };
                                                //     // } else {
                                                //     //     $exit_price             = '0.00';
                                                //     //     $tradePercentChg        = 'N/A';
                                                //     //     echo '
                                                //     //     <tr>
                                                //     //         <td></td>
                                                //     //         <td class="text-center">' . $open_date . '</td>
                                                //     //         <td class="text-center">' . $symbol . ' - ' . $stock . '</td>
                                                //     //         <td class="text-center">$' . $entry_price . '</td>
                                                //     //         <td class="text-center">$' . $exit_price . '</td>
                                                //     //         <td class="text-center">$' . $last_price . '</td>
                                                //     //         <td class="text-center"></td>
                                                //     //         <td class="text-center">																		
                                                //     //             <a class="mr-2" href=""><i class="icon-chart" data-toggle="tooltip" data-placement="bottom" title="View Stock Chart"></i></a>
                                                                
                                                //     //             <a class="mr-2" href="' . site_url('Trade-Tracker/Log/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="View Trade Log"><i class="icon-notebook"></i></a>
                                                                
                                                //     //             <a class="mr-2" href="' . site_url('Trade-Tracker/Update/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Update Trade Log"><i class="icon-note"></i></a>
                                                                
                                                //     //             <a class="mr-2 text-danger" href="' . site_url('Trade-Tracker/Close/' . $symbol . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Close Trade Log"><i class="icon ni ni-wallet-out" style="font-size:1rem !important;"></i></a>
                                                                
                                                //     //             <a class="text-danger" data-toggle="modal" data-target="#deleteModal' . $info['id'] . '" data-toggle="tooltip" data-placement="bottom" title="Delete Trade Log"><i class="icon ni ni-file-remove" style="font-size:1rem !important;"></i></a>
                                                //     //         </td>
                                                //     //     </tr>';
                                                //     // }
                                                // } elseif ($info['trade_type'] === 'long' OR 'short') {
                                                //     $stock			= $info['symbol'];
                                                //     $last_price     = $response[$stock]['lastPrice'];
                                                //     $this->db->from('bf_users_trades'); 
                                                //     $this->db->where('existing_order_id', $tradeID);
                                                //     $getClosingTrades   = $this->db->get(); 
                                                //     foreach ($getClosingTrades->result_array() as $closingTrade) {
                                                //         $exit_price     = $closingTrade['close_price'];
                                                //     };
                                                //     $tradePercentChg    = ($exit_price / $entry_price) * 100; 
                                                //     if ($info['stock']  = $response[$stock]) {
                                                //         echo '
                                                //         <tr>
                                                //             <td></td>
                                                //             <td class="text-center">' . $open_date . '</td>
                                                //             <td class="text-center">' . $stock . '</td>
                                                //             <td class="text-center">$' . $entry_price . '</td>
                                                //             <td class="text-center">$' . $exit_price . '</td>
                                                //             <td class="text-center">$' . $response[$stock]['lastPrice'] . '</td>
                                                //             <td class="text-center"></td>
                                                //             <td class="text-center">																		
                                                //                 <a class="mr-2" href=""><i class="icon-chart" data-toggle="tooltip" data-placement="bottom" title="View Stock Chart"></i></a>
                                                                
                                                //                 <a class="mr-2" href="' . site_url('Trade-Tracker/Log/' . $stock . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="View Trade Log"><i class="icon-notebook"></i></a>
                                                                
                                                //                 <a class="mr-2" href="' . site_url('Trade-Tracker/Update/' . $stock . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Update Trade Log"><i class="icon-note"></i></a>
                                                                
                                                //                 <a class="mr-2 text-danger" href="' . site_url('Trade-Tracker/Close/' . $stock . '/' . $tradeID) . '" data-toggle="tooltip" data-placement="bottom" title="Close Trade Log"><i class="icon ni ni-wallet-out" style="font-size:1rem !important;"></i></a>
                                                                
                                                //                 <a class="text-danger" data-toggle="modal" data-target="#deleteModal' . $info['id'] . '" data-toggle="tooltip" data-placement="bottom" title="Delete Trade Log"><i class="icon ni ni-file-remove" style="font-size:1rem !important;"></i></a>
                                                //             </td>
                                                //         </tr>';
                                                //     }
                                                // }
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
</div>
<?php
// foreach ($getTrades->result_array() as $trade) {
//                                                 $trade_id							= $trade['id'];
//                                                 echo '
// <div class="modal fade" id="deleteModal' . $trade_id . '" tabindex="-1" role="dialog" aria-labelledby="deleteModal' . $trade_id . '" aria-hidden="true">
// 	<div class="modal-dialog" role="document">
// 		<div class="modal-content">
// 			<div class="modal-header">
// 				<h3 class="modal-title" id="exampleModalLabel">Delete Trade?</h3>
// 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
// 					<span aria-hidden="true">&times;</span>
// 				</button>
// 			</div>
// 			<div class="modal-body">
// 				Are you sure you want to delete this trade from the trade tracker?
// 			</div>
// 			<div class="modal-footer">
// 				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
// 				<a type="button" class="btn btn-primary" href="' . site_url('Trade-Tracker/Delete/' . $trade_id . '/' . $redirect_url) . '">Yes</a>
// 			</div>
// 		</div>
// 	</div>
// </div>
// ';
//                                             }
?>
<!-- <div class="modal fade" id="quickEquityTradeModel" tabindex="-1" role="dialog" aria-labelledby="quickTradeModel" aria-hidden="true">
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
                // $walletTranfer[]			= 'Equity';
                // $walletTransfer				= array(
                //     'wallet_id'				=> $wallet_id,
                //     'walletTitle'			=> $walletTitle,
                //     'current_trade_type'	=> 'Option',
                // );
                // $this->load->view('User/Trade_Tracker/Quick_Trade', $walletTransfer);
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
</div> -->
<!-- <div class="modal fade" id="quickOptionTradeModel" tabindex="-1" role="dialog" aria-labelledby="quickTradeModel" aria-hidden="true">
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
                // $walletTransfer				= array(
                //     'wallet_id'				=> $wallet_id,
                //     'walletTitle'			=> $walletTitle,
                //     'current_trade_type'	=> 'Option',
                // );
                // $this->load->view('User/Trade_Tracker/Quick_Trade', $walletTransfer);
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
</div> -->
<?php
// echo '
// <div class="modal fade" id="deleteWalletModal' . $walletID . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
// 	<div class="modal-dialog modal-md">
// 		<div class="modal-content">
// 			<div class="modal-header">
// 				<h3 class="modal-title" id="exampleModalLabel">Delete This Wallet?</h3>
// 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
// 				<span aria-hidden="true">&times;</span>
// 			</button>
// 			</div>
// 			<div class="modal-body">
// 				<p>Are you sure you want to delete this wallet? </p>
// 				<table class="table table-borderless pt-3">
// 					<tbody>
// 						<tr>
// 							<th>Wallet Name:</th>
// 							<td>' . $walletTitle . '</td>
// 						</tr>
// 					</tbody>
// 				</table>
// 			</div>             
// 			<div class="modal-footer">                                                    
// 				<a type="button" class="btn btn-success" href="' . site_url('Delete-Wallet/' . $walletID) . '">Yes</a>
// 				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
// 			</div>
// 		</div>
// 	</div>
// </div>
// ';
?>
<?php 
// if ($walletPremium === 'Yes') {
//     if ($walletBroker === 'TD Ameritrade') {
//         if($this->exchange_model->update_wallet_records($cuID, $cuEmail, $cuUsername, $walletID, $walletAccountID, $walletAccessCode, $walletBroker)) {
//             Template::set_message('Account successfully updated and up-to-date!', 'success'); 
//         } else {
//             Template::set_message('ERROR: Account could not be updated successfully', 'error'); 
//         }
//     }
// }
?>