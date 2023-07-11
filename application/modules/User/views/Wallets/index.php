<?php
// Plaid Integration
$plaid                                  = 0;
$btnSizing                              = 'pr-2';
$beta                                   = $this->config->item('beta');
$debtOperations                         = $this->config->item('debtOperations');
$investmentOperations                   = $this->config->item('investmentOperations');
// $plaid                                  = 1;
// print_r($_SESSION['allSessionData']['userAccount']); 
$userAccount                            = $_SESSION['allSessionData']['userAccount']; 
$userBudget                             = $_SESSION['allSessionData']['userBudget'];
$cuID									= $userAccount['cuID'];
$cuRole									= $userAccount['cuRole'];
$cuEmail								= $userAccount['cuEmail'];
$cuWalletID								= $userAccount['cuWalletID'];
$cuWalletCount							= $userAccount['cuWalletCount'];
$walletID								= $userAccount['walletID'];
$walletTitle							= $userAccount['walletTitle'];
$walletBroker							= $userAccount['walletBroker'];
$walletNickname							= $userAccount['walletNickname'];
$walletDefault							= $userAccount['walletDefault'];
$walletExchange							= $userAccount['walletExchange'];
$walletMarketPair						= $userAccount['walletMarketPair'];
$walletMarket							= $userAccount['walletMarket'];
$walletFunds							= $userAccount['walletFunds'];
$walletInitialAmount					= $userAccount['walletInitialAmount'];
$walletAmount							= $userAccount['walletAmount'];
$walletPercentChange					= $userAccount['walletPercentChange'];
$walletGains							= $userAccount['walletGains'];
$depositAmount							= $userAccount['depositAmount'];
$withdrawAmount							= $userAccount['withdrawAmount'];
$MyMICoinValue							= $userAccount['MyMICoinValue'];
$MyMICCurrentValue						= $userAccount['MyMICCurrentValue'];
$MyMICCoinSum							= $userAccount['MyMICCoinSum'];
$MyMIGoldValue							= $userAccount['MyMIGoldValue'];
$MyMIGCurrentValue						= $userAccount['MyMIGCurrentValue'];
$MyMIGCoinSum							= $userAccount['MyMIGCoinSum'];
$checkingSummaryFMT                     = $userBudget['checkingSummaryFMT']; 
$creditAvailable                        = $userBudget['creditAvailable'];
$creditAvailableFMT                     = $userBudget['creditAvailableFMT']; 
$creditLimit                            = $userBudget['creditLimit'];
$creditLimitFMT                         = $userBudget['creditLimitFMT']; 
if (number_format(($creditAvailable / $creditLimit) * -100, 2) > 30) { 
    $creditLimitPercentage              = '<span class="statusRed">'. number_format(($creditAvailable / $creditLimit) * -100, 2) . '%</span>';
} else {
    $creditLimitPercentage              = '<span>'. number_format(($creditAvailable / $creditLimit) * -100, 2) . '%</span>';
}
$debtSummaryFMT                         = $userBudget['debtSummaryFMT']; 

        
$walletCost								= $this->config->item('wallet_cost');  			 		// $5
$limit                                  = 4;
$gas_fee								= $this->config->item('gas_fee');
$trans_fee								= $this->config->item('trans_fee');
$trans_percent							= $this->config->item('trans_percent');
$expenses								= ($walletCost * $trans_percent) + $trans_fee;			// Total Fees
$total_fees								= number_format($expenses, 2);
$fee_coins								= round(($total_fees / $MyMICoinValue), 8);
$walletCoins							= ($walletCost / $MyMICoinValue) + $fee_coins;
$remainingCoins							= $MyMICCoinSum - $walletCoins;
if ($MyMIGCoinSum <= 0) {
    $purchaseFiatWalletName				= '#coinModal';
    $purchaseDigitalWalletName			= '#coinModal';
} else {
    $purchaseFiatWalletName				= '#purchaseFiatWalletModal';
    $purchaseDigitalWalletName			= '#purchaseDigitalWalletModal';
}
$getWallets								= $this->wallet_model->get_all_wallets($cuID);
$walletData								= array(
    'getWallets'						=> $getWallets,
    'cuID'								=> $cuID,
    'cuWalletCount'						=> $cuWalletCount,
    'walletID'							=> $walletID,
    'walletTitle'						=> $walletTitle,
    'walletNickname'					=> $walletNickname,
    'walletAmount'						=> $walletAmount,
    'walletFunds'						=> $walletFunds,
    'walletGains'						=> $walletGains,
    'MyMICCoinSum'						=> $MyMICCoinSum,
    'MyMICCurrentValue'					=> $MyMICCurrentValue,
    'MyMIGCoinSum'						=> $MyMIGCoinSum,
    'MyMIGCurrentValue'					=> $MyMIGCurrentValue,
    // 'lastTradeActivity'					=> $lastTradeActivity,
    'walletCoins'						=> $walletCoins,
    'walletCost'                        => $walletCost,
    'limit'                             => $limit,
    'purchaseFiatWalletName'			=> $purchaseFiatWalletName,
    'purchaseDigitalWalletName'			=> $purchaseDigitalWalletName,
    'btnSizing'                         => $btnSizing,
    'checkingSummaryFMT'                => $checkingSummaryFMT,
    'creditAvailable'                   => $creditAvailable,
    'creditAvailableFMT'                => $creditAvailableFMT,
    'creditLimit'                       => $creditLimit,
    'creditLimitFMT'                    => $creditLimitFMT,
    'creditLimitPercentage'             => $creditLimitPercentage,
    'debtSummaryFMT'                    => $debtSummaryFMT,
);
$fundAccountData						= array(
    'redirectURL'						=> $this->uri->uri_string(),
    'cuID'								=> $cuID,
    'cuEmail'							=> $cuEmail,
    'walletID'							=> $walletID,
    'walletBroker'						=> $walletBroker,
    'walletNickname'					=> $walletNickname,
    'walletFunds'						=> $walletFunds,
    'walletAmount'						=> $walletAmount,
    'walletInitialAmount'				=> $walletInitialAmount,
    'depositAmount'						=> $depositAmount,
    'withdrawAmount'					=> $withdrawAmount,
    // 'nickname'							=> $walletInfo['nickname'],
);

if (empty($this->uri->segment(2))) {
    $viewFileNameA                      = 'User/Wallets/index/financial_wallets';
    $viewFileNameB                      = 'User/Wallets/index/credit_wallets';
    if ($debtOperations === 1) {
        $viewFileNameC                  = 'User/Wallets/index/debt_wallets';
    }
    if ($investmentOperations === 1) {
        $viewFileNameD                  = 'User/Wallets/index/investment_wallets';
    }
} elseif ($this->uri->segment(2) === 'Checking') {
    $viewFileNameA                      = 'User/Wallets/index/financial_wallets';
} elseif ($this->uri->segment(2) === 'Credit') {
    $viewFileNameA                      = 'User/Wallets/index/credit_wallets';
    if ($debtOperations === 1) {
        $viewFileNameB                  = 'User/Wallets/index/debt_summary';
    }
} elseif ($this->uri->segment(2) === 'Debt') {
    if ($debtOperations === 1) {
        $viewFileNameA                  = 'User/Wallets/index/credit_wallets'; 
        $viewFileNameB                  = 'User/Wallets/index/debt_wallets'; 
        $viewFileNameC                  = 'User/Wallets/index/debt_summary';
    }
}


$cuID                           = $_SESSION['allSessionData']['userAccount']['cuID'];
$beta                           = $this->config->item('beta');
/** !! 
 PLAID SETTINGS 
*/
$client_id                      = '61d9ba14ecdeba001b3619f6';
// Sandbox Settings
// $secret                         = '432e5c1a0716e15fd26ca0d8c56640';
// $environment                    = 'sandbox';
// // Development Settings
$secret                         = 'aee78c834d39555f7d3b488acfcb2f';
$environment                    = 'development';
        
$api_base_url                   = 'https://sandbox.plaid.com'; // Default to sandbox
if ($environment === 'development') {
    $api_base_url               = 'https://development.plaid.com';
} elseif ($environment === 'production') {
    $api_base_url               = 'https://production.plaid.com';
}

$ch                             = curl_init();
$url                            = $api_base_url . '/link/token/create';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
$data                           = array(
    'client_id'                 => $client_id,
    'secret'                    => $secret,
    'user'                      => array('client_user_id' => $cuID,),
    'client_name'               => 'MyMI Wallet',
    'products'                  => array('auth', 'transactions'),
    'country_codes'             => array('US'),
    'language'                  => 'en',
    'webhook'                   => 'https://sample-web-hook.com',
    'redirect_uri'              => site_url('/Content-Creator'),
    'account_filters'           => array('depository' => array('account_subtypes' => array('all')))
);
$data_string                    = json_encode($data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
$result                         = curl_exec($ch);
curl_close($ch);
$response                       = json_decode($result, true);
// print_r($response); 
$link_token                     = $response['link_token'];
// echo '<br><br>' . $link_token; 
$request_id                     = $response['request_id'];
$end_date                       = date('Y-m-d', strtotime('-1 day'));
$start_date                     = date('Y-m-d', strtotime('-5 years -1 day', strtotime($end_date)));
?>

<div class="nk-block">
	<div class="row gy-gs">
		<div class="col-md-12 mb-3">  
			<?php $this->load->view('User/Wallets/index/header', $walletData); ?>
		</div>
        <?php 
            if (!empty($viewFileNameA)) { 
                echo '
                <div class="col-md-12 mb-3">';
                    $this->load->view($viewFileNameA, $walletData);
                echo '
                </div>';
            }
            if (!empty($viewFileNameB)) { 
                echo '
                <div class="col-md-12 mb-3">';
                    $this->load->view($viewFileNameB, $walletData);
                echo '
                </div>';
            }
            if (!empty($viewFileNameC)) { 
                echo '
                <div class="col-md-12 mb-3">';
                    $this->load->view($viewFileNameC, $walletData);
                echo '
                </div>';
            }
            if (!empty($viewFileNameD)) { 
                echo '
                <div class="col-md-12 mb-3">';
                    $this->load->view($viewFileNameD, $walletData);
                echo '
                </div>';
            }
            if (!empty($viewFileNameE)) { 
                echo '
                <div class="col-md-12 mb-3">';
                    $this->load->view($viewFileNameE, $walletData);
                echo '
                </div>';
            }
        ?>
		<!-- <div class="col-md-12 mb-3">
			<?php //$this->load->view('User/Wallets/index/fiat_wallets', $walletData); ?>
		</div>
        <div class="col-md-12 mb-3">
			<?php //$this->load->view('User/Wallets/index/crypto_wallets', $walletData); ?>
		</div> -->
	</div>
</div>
<div class="modal fade" id="deleteWalletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
			</div>             
			<div class="modal-footer">                                                    
				<a type="button" class="btn btn-success" href="' . site_url('Delete-Wallet/' . $wallets['id']) . '">Yes</a>
				<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
<script>
    const cuID                  =<?php echo '\''.$cuID.'\''; ?>; 
    const request_id            =<?php echo '\''.$request_id.'\''; ?>; 
    document.addEventListener("DOMContentLoaded", function() {
        const linkHandler           = Plaid.create({
            token:<?php echo '\''.$link_token.'\''; ?>,
            onSuccess: (public_token, metadata) => {
                // Save the public token
                fetch('<?php echo site_url('/Institutions/Integrations/savePublicToken'); ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        cuID: cuID,
                        public_token: public_token,
                        request_id: request_id
                    }),
                })
                .then(response => {
                    console.log('Raw response A:', response);
                    return response.json();
                })
                .then(data => {
                    console.log('Success:', data['publicToken'] + " | " + data.publicToken);
                    const publicToken   = data.publicToken;
                    console.log("Public Token: " + publicToken);
                    // Exchange the public token for Access Token
                    fetch('<?php echo site_url('Institutions/Integrations/exchange_public_token'); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            cuID: cuID,
                            request_id: request_id,
                            public_token: publicToken,
                        }),
                    })
                    .then(response => {
                        const contentType = response.headers.get('Content-Type');

                        if (!contentType || !contentType.includes('application/json')) {
                        throw new TypeError(`Expected a JSON response, but got ${contentType || 'unknown content type'}`);
                        }

                        if (!response.ok) {
                        return response.json().then(errorData => {
                            throw new Error(`Server error: ${errorData.message || 'Unknown error'}`);
                        });
                        }

                        return response.json();
                    })
                    .then(data => {
                        console.log('Success:', data);
                        fetch('<?php echo site_url('Institutions/Integrations/create_wallet'); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                status: 1,
                                active: 'Yes',
                                beta:<?php echo '\''.$beta.'\''; ?>,
                                default_wallet: 'No',
                                exchange_wallet: 'No',
                                premium_wallet: 'No',
                                ach_enabled: 0,
                                market_pair: 'USD',
                                market: 'MYMI', 
                                user_id: cuID,
                                broker_id: data.item_id,
                                public_token: data.public_token,
                                request_id: data.request_id,
                                account_id: data.dbID,
                                access_token: data.access_token,
                            }),
                        })
                        .then(response => {
                            const contentType = response.headers.get('Content-Type');

                            if (!contentType || !contentType.includes('application/json')) {
                            throw new TypeError(`Expected a JSON response, but got ${contentType || 'unknown content type'}`);
                            }

                            if (!response.ok) {
                            return response.json().then(errorData => {
                                throw new Error(`Server error: ${errorData.message || 'Unknown error'}`);
                            });
                            }

                            return response.json();
                        })
                        .then(data => {
                            console.log('Success:', data);
                        })
                        .catch(error => {
                            console.error('Error:', error.message);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error.message);
                    });
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

            },
            onExit: (err, metadata) => {
                console.log('onExit', err, metadata);
            },
        });
        document.getElementById('link-button').addEventListener('click', () => {
            linkHandler.open();
        });
    })
</script>