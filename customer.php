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

/*
    index a document INDEX
*/    
$params = [
    'index' => 'customer',
    'type' => 'external',
    'id' => 3
    //'body' => ['testField' => 'The quick brown fox jump over a lazy dog.']
];

$response = $client->indices()->create($params);
print_r($response);