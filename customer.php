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
$char = $_GET['q'];

/*
    index a document INDEX
*/    
$params1 = [
    'index' => 'customer',
    'type' => 'external',
    'id' => '2',
    'body' => [
        'id' => '3',
        'name' => 'kokoda'
        ]
];

$params1 = [
    'index' => 'customer',
    'type' => 'external',
    'id' => '3',
    'body' => [
        'doc' => [
            'id' => '30',
            'name' => 'kakadu'
        ]
    ]
];



//$response = $client->index($params);
//print_r($response);

/*
    Getting Documents
*/

$params = [
    'index' => 'customer',
    'type' => 'external',
    'id' => 2
];

$response = $client->get($params);
print_r(json_encode($response));