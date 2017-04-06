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


$param  = array();
$param['index']                 = 'user_index';
$param['type']                  = 'user';
$param['body']                  = array(
    'properties'    => array(
        'body'          => array(
            'type'  => 'string'
        ),
        'autosuggest'   => array(
            'type'              => 'completion',
            'index_analyzer'    => 'simple',
            'search_analyzer'   => 'simple',
            'payloads'          => true
        )
    )
);
$client->indices()->putMapping($param);