<?php

require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$hosts = [
    'http://elastic:kikiriki@localhost:9200',       // HTTP Basic Authentication
];

$logger = ClientBuilder::defaultLogger('log/log.log', Logger::INFO);
$serializer = '\Elasticsearch\Serializers\SmartSerializer';

$client = ClientBuilder::create()
                        ->setHosts($hosts)
                        ->setRetries(0)
                        ->setLogger($logger)
                        ->setSerializer($serializer)
                        ->build();

//$char = $_GET['c'];

# body for API
$city = [
    'index' => 'city_data',
    'type' => 'data',
    'body' => [
        'suggest' => [
            'suggest-result' => [
                'prefix' => 'new'          
            ],
            'completion' => [
                    'field' => 'city-suggest'
            ]
        ]
    ]
];    

//$responses = $client->search($city);

/*
    index a document INDEX
*/    
$params = [
    'index' => 'city_data'
];

$response = $client->get($city);
print_r($response);
