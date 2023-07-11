<?php
defined('BASEPATH') or exit('No direct script access allowed');

// $config['plaid'] = [
//     'plaid_client_id'                       => '61d9ba14ecdeba001b3619f6',
//     'plaid_secret'                          => '0a10554c2dd48888bc13c5c29bdbbc',
// //     'plaid_public_key'                      => 'your_plaid_public_key',
//     'plaid_environment'                     => 'sandbox' // Change this to 'development' or 'production' as needed
// ];
$config['plaid_client_id']                  = '61d9ba14ecdeba001b3619f6';
$config['plaid_secret']                     = '432e5c1a0716e15fd26ca0d8c56640'; // Development
// $config['plaid_secret']                     = '0a10554c2dd48888bc13c5c29bdbbc'; // Sandbox
// $config['plaid_public_key']                = 'your_plaid_public_key';
$config['plaid_environment']                = 'development'; // Change this to 'development' or 'production' as needed

// $config['plaid_client_id']                 = '61d9ba14ecdeba001b3619f6';
// $config['plaid_secret']                    = '0a10554c2dd48888bc13c5c29bdbbc';
// $config['plaid_environment']               = 'sandbox'; // Change this to 'development' or 'production' as needed