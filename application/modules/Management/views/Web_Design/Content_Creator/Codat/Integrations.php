<?php 
/*
{
    "key": "suuo",
    "logoUrl": "https://static.codat.io/public/platforms/suuo.png",
    "name": "Plaid",
    "enabled": true,
    "sourceId": "46ee0089-dc88-405a-9667-9fb3d9976f19",
    "integrationId": "580146ed-7556-4f92-8bf9-7344667763ec",
    "sourceType": "Banking",
    "isOfflineConnector": false,
    "isBeta": false,
    "supportedEnvironments": "LiveAndSandbox",
    "linkedConnectionsCount": 0,
    "totalConnectionsCount": 0,
    "dataProvidedBy": "Codat",
    "datatypeFeatures": [
        {
            "datatype": "bankTransactions",
            "supportedFeatures": [
                {
                    "featureType": "Get",
                    "featureState": "Release"
                }
            ]
        },
        {
            "datatype": "bankAccounts",
            "supportedFeatures": [
                {
                    "featureType": "Get",
                    "featureState": "Release"
                }
            ]
        },
        {
            "datatype": "banking-accountBalances",
            "supportedFeatures": [
                {
                    "featureType": "Get",
                    "featureState": "Beta"
                }
            ]
        },
        {
            "datatype": "banking-accounts",
            "supportedFeatures": [
                {
                    "featureType": "Get",
                    "featureState": "Beta"
                }
            ]
        },
        {
            "datatype": "banking-transactionCategories",
            "supportedFeatures": [
                {
                    "featureType": "Get",
                    "featureState": "Beta"
                }
            ]
        },
        {
            "datatype": "banking-transactions",
            "supportedFeatures": [
                {
                    "featureType": "Get",
                    "featureState": "Beta"
                }
            ]
        },
        {
            "datatype": "company",
            "supportedFeatures": [
                {
                    "featureType": "Get",
                    "featureState": "NotImplemented"
                }
            ]
        }
    ]
},
*/
echo '<h1>Plaid Integration</h1>';
$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://api.codat.io/companies/1aeb6710-02a3-4e68-b4d2-773f86086d0f/connections', [
  'headers' => [
    'accept' => 'application/json',
    'content-type' => 'application/json',
  ],
]);

echo $response->getBody();
?>