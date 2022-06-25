<?php
use Codenixsv\BittrexApi\BittrexClient;

$client = new BittrexClient();
$client->setCredential('82122111507946599fe903f058758e92', '466bfcbc6ba0425e8b429bde2eaecf13');
$pageURIB												= $this->uri->segment(3);
$pageURIC                                               = $this->uri->segment(4);
$market_pair                                            = $pageURIB;
$market		                                            = $pageURIC;
$cuID													= $_SESSION['allSessionData']['userAccount']['cuID'];
$cuEmail												= $_SESSION['allSessionData']['userAccount']['cuEmail'];
$cuUserType												= $_SESSION['allSessionData']['userAccount']['cuUserType'];
$cuWalletID												= $_SESSION['allSessionData']['userAccount']['cuWalletID'];
$cuWalletCount											= $_SESSION['allSessionData']['userAccount']['cuWalletCount'];
$walletID												= $_SESSION['allSessionData']['userAccount']['walletID'];
$walletTitle											= $_SESSION['allSessionData']['userAccount']['walletTitle'];
$walletBroker											= $_SESSION['allSessionData']['userAccount']['walletBroker'];
$walletNickname											= $_SESSION['allSessionData']['userAccount']['walletNickname'];
$walletDefault											= $_SESSION['allSessionData']['userAccount']['walletDefault'];
$walletExchange											= $_SESSION['allSessionData']['userAccount']['walletExchange'];
$walletMarketPair										= $_SESSION['allSessionData']['userAccount']['walletMarketPair'];
$walletMarket											= $_SESSION['allSessionData']['userAccount']['walletMarket'];
$walletFunds											= $_SESSION['allSessionData']['userAccount']['walletFunds'];
$walletInitialAmount									= $_SESSION['allSessionData']['userAccount']['walletInitialAmount'];
$walletAmount											= $_SESSION['allSessionData']['userAccount']['walletAmount'];
$walletPercentChange									= $_SESSION['allSessionData']['userAccount']['walletPercentChange'];
$walletGains											= $_SESSION['allSessionData']['userAccount']['walletGains'];
$depositAmount											= $_SESSION['allSessionData']['userAccount']['depositAmount'];
$withdrawAmount											= $_SESSION['allSessionData']['userAccount']['withdrawAmount'];
$MyMICoinValue											= $_SESSION['allSessionData']['userAccount']['MyMICoinValue'];
$MyMICCurrentValue										= $_SESSION['allSessionData']['userAccount']['MyMICCurrentValue'];
$MyMICCoinSum											= $_SESSION['allSessionData']['userAccount']['MyMICCoinSum'];
$MyMIGoldValue											= $_SESSION['allSessionData']['userAccount']['MyMIGoldValue'];
$MyMIGCurrentValue										= $_SESSION['allSessionData']['userAccount']['MyMIGCurrentValue'];
$MyMIGCoinSum											= $_SESSION['allSessionData']['userAccount']['MyMIGCoinSum'];
$minimum_purchase                                       = $this->config->item('minimum_purchase');
$getExchanges                                           = $this->exchange_model->get_exchanges();
$getExchange											= $this->exchange_model->get_exchange_summary($market_pair, $market);
$total_coins											= 23000000;
$fundAccountData										= array(
    'redirectURL'										=> $this->uri->uri_string(),
    'cuID'												=> $cuID,
    'cuEmail'											=> $cuEmail,
    'walletID'											=> $walletID,
    'walletBroker'										=> $walletBroker,
    'walletNickname'									=> $walletNickname,
    'walletFunds'										=> $walletFunds,
    'walletAmount'										=> $walletAmount,
    'walletInitialAmount'								=> $walletInitialAmount,
    'depositAmount'										=> $depositAmount,
    'withdrawAmount'									=> $withdrawAmount,
    // 'nickname'											=> $walletInfo['nickname'],
);
foreach ($getExchange->result_array() as $exchange) {
    $alt_cur											= $exchange['alt_cur'];
    $int_cur											= $exchange['int_cur'];
    $market_pair										= $exchange['market_pair'];
    $current_value										= $exchange['current_value'];
    $coins_available									= $exchange['coins_available'];
    if ($alt_cur === 'Yes') {
        $alt_cur_ticker									= 'USD-' . $market_pair;
        $altCurGetSum 									= $client->public()->getMarketSummary($alt_cur_ticker);
        $cur_mark									    = $altCurGetSum['result'][0]['Last'];
        $current_coin_value								= number_format(($current_value / $cur_mark) / $coins_available, 8);
    } elseif ($int_cur === 'Yes') {
        $api_url										= urldecode($exchange['api_url']);
        $curl 											= curl_init();
        $curlURL										= 'https://api.tdameritrade.com/v1/marketdata/quotes?apikey=XGCE3NA1BXIGQG2NHDTLHZ6OUSIZTITF&symbol=' . $api_url . '&interval=1min';
        curl_setopt_array($curl, array(
          CURLOPT_URL 									=> $curlURL,
          CURLOPT_RETURNTRANSFER						=> true,
          CURLOPT_TIMEOUT 								=> 30,
          CURLOPT_HTTP_VERSION 							=> CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST 						=> "GET",
          CURLOPT_HTTPHEADER 							=> array(
            "cache-control: no-cache",
          ),
        ));

        $response 										= curl_exec($curl);
        $err 											= curl_error($curl);

        curl_close($curl);
        $response 										= json_decode($response, true); //because of true, it's in an array
        $cur_mark										= $response[$api_url]['mark'];
                                                      
        $current_coin_value								= number_format(($current_value / $cur_mark) / $coins_available, 8);
    } elseif ($market_pair === 'MYMIG') {
        $MyMIGoldValue									= $_SESSION['allSessionData']['userAccount']['MyMIGoldValue'];
        $current_coin_value								= number_format(($current_value / $MyMIGoldValue) / $total_coins, 8);
    } else {
        $current_coin_value								= $_SESSION['allSessionData']['userAccount']['MyMICoinValue'];
        $cur_mark                                       = 1;
    }
    $market												= $exchange['market'];
    $description										= $exchange['description'];
    $total_coins										= $exchange['total_coins'];
    $initial_value										= $exchange['initial_value'];
    $total_growth										= number_format((($current_value - $initial_value) / $initial_value) * 100, 2);
    $total_volume										= $total_coins - $coins_available;
    $gas_fee											= $exchange['gas_fee'];
    $trans_percent										= $exchange['trans_percent'];
    $trans_fee											= $exchange['trans_fee'];
    $data												= array(
        'cuID'											=> $cuID,
        'cuEmail'										=> $cuEmail,
        'cuWalletID'									=> $cuWalletID,
        'cuUserType'									=> $cuUserType,
        'alt_cur'										=> $alt_cur,
        'int_cur'										=> $int_cur,
        'market_pair'									=> $market_pair,
        'market'										=> $market,
        'current_value'									=> $current_value,
        'coins_available'								=> $coins_available,
        // 'alt_cur_mark'									=> $alt_cur_mark,
        'current_coin_value'							=> $current_coin_value,
        'cur_mark'										=> $cur_mark,
        'description'									=> $description,
        'total_coins'									=> $total_coins,
        'initial_value'									=> $initial_value,
        'total_growth'									=> $total_growth,
        'total_volume'									=> $total_volume,
        'gas_fee'										=> $gas_fee,
        'trans_percent'									=> $trans_percent,
        'trans_fee'										=> $trans_fee,
        'minimum_purchase'                              => $minimum_purchase,
    );
}
?>
<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-12 col-md-12 mb-3">  
			<div class="nk-block">
				<div class="nk-block-head">
					<?php echo theme_view('navigation_breadcrumbs'); ?>
					<div class="nk-block-between-md g-4">
						<div class="nk-block-head-content">
							<h2 class="nk-block-title fw-bold">MyMI Exchange</h2>
							<div class="nk-block-des"><p>Purchase or Sell Your <?= $market; ?> Coin!</p></div>
						</div>
						<div class="nk-block-head-content">
							<ul class="nk-block-tools gx-3">
								<li>
									<button class="btn btn-primary" class="d-none d-md-block" id="open" style="display:hidden;"><span>Refresh</span><span class="d-block d-md-none"><em class="icon icon-check"></em></span></button>
									<button class="btn btn-danger" class="d-none d-md-block" id="close"><span>Disconnect</span><span class="d-block d-md-none"><em class="icon icon-close"></em></span></button> 
								</li>
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
		<div class=" col-12 col-md-12 mb-3"> 
			<div class="nk-block">
				<div class="row"> 
					<?php
                    $this->load->view('Exchange/includes/Stock_Chart', $data);
                    $this->load->view('Exchange/includes/Order_Book', $data);
                    ?>
				</div>
				<hr>
				<div class="row">
					<div class="col-12 col-md-4">
						<h5 class="nk-block-title title pt-3">Buy <?php echo $market . '-' . $market_pair; ?></h5>
						<br>
						<div class="row">
							<div class="col text-center border-right">
								<button class="btn btn-default" onclick="changeBuyCoinValueLimit();">Limit</button>
							</div>
							<div class="col text-center">
								<button class="btn btn-default" onclick="changeBuyCoinValueMarket();">Market</button>
							</div>
						</div>
						<hr>
						<?php $this->load->view('Exchange/Buy', $data); ?>
					</div>
					<div class="col-12 col-md-4">
						<h5 class="nk-block-title title pt-3">Sell <?php echo $market . '-' . $market_pair; ?></h5>
						<br>    
						<div class="row">
							<div class="col text-center border-right">
								<button class="btn btn-default" onclick="changeSellCoinValueLimit();">Limit</button>
							</div>
							<div class="col text-center">
								<button class="btn btn-default" onclick="changeSellCoinValueMarket();">Market</button>
							</div>
						</div>
						<hr>                            
						<?php $this->load->view('Exchange/Sell', $data); ?>
					</div>   
					<div class="col-12 col-md-4">
						<h5 class="nk-block-title title pt-3 d-none d-md-block">Most Recent Orders</h5>
						<br>
						<?php
                        $this->load->view('Exchange/includes/Recent_Orders', $data);
                        ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>   
