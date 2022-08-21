<?php

declare(strict_types=1);

namespace MyMIWallet\BrokerageAPI;

use MyMIWallet\BrokerageAPI\API\TDAmeritrade\Account;
use MyMIWallet\BrokerageAPI\API\TDAmeritrade\GetQuote;
use MyMIWallet\BrokerageAPI\API\Exceptions\InvalidCredentialException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class BrokerageClient 
{
    private const BASE_URI = 'https://api.mymiwallet.com/';

    /** @var Client */
    private $publicClient;
    
    /** @var Client */
    private $privateClient;

    /** @var string */
    private $key = '';

    /** @var string */
    private $secret = '';
    
    /**
     * @param string $key
     * @param string $secret
     */
    
}
