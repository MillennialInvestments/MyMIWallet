<?php
$beta                           = $this->config->item('beta'); 
$userAccount                    = $_SESSION['allSessionData']['userAccount'];
$cuID                           = $userAccount['cuID'];
$client_id                      = '61d9ba14ecdeba001b3619f6';
// Sandbox Settings
$secret                         = '432e5c1a0716e15fd26ca0d8c56640';
$environment                    = 'sandbox';
// // Development Settings
// $secret                 = 'aee78c834d39555f7d3b488acfcb2f';
// $environment            = 'development';
        
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
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
<button class="btn btn-primary" id="link-button">Connect a bank account</button>
<script>
    const cuID                  = <?php echo '\'' . $cuID . '\''; ?>; 
    const request_id            = <?php echo '\'' . $request_id . '\''; ?>; 
    const linkHandler           = Plaid.create({
        token: <?php echo '\'' . $link_token . '\''; ?>,
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
                            beta: <?php echo '\'' . $beta . '\''; ?>,
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
</script>


