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
    Search Operations
*/

$char = $_GET['c'];

/* # template for Edge NGram 

$city = [
    'index' => 'city',
    'type' => 'data',
    'body' => [
        '_source' => [
            'city', 'count'            
        ],
        'query' => [
            'match_phrase_prefix' => [
                'city' => $char
            ]
        ],
        'sort' => [
            'count' => [
                'order' => 'desc'
            ]
        ],
        'size' => 10
    ]
];    

*/

/* # template for Completion Suggester
$city = [
    'suggest' => [
        'suggest-result' => [
            'prefix', $char           
        ],
        'completion' => [
                'field' => 'city-suggest'
        ]
    ]
];  
*/

/* # template for Edge NGram 

$count = [
    'body' => [
        'query' => [
            'match_phrase_prefix' => [
                'city' => $char
            ]
        ]
    ]
]; 

*/ 

/* # template for Completion Suggester 
$count = [
    'suggest' => [
        'suggest-result' => [
            'prefix' => $char,
            'completion' => [
                'field' => 'city_suggest'
            ]
        ]
    ]
];  
*/

//$num = $client->count($count);

//$responses = $client->search($city);

/*if ($num['count']!=0) {

    $responses = $client->search($city);

    $n = $num['count'];

    echo gettype($n);

    for ($i=0;$i<$n;$i++) {

        $label   = $responses['hits']['hits'][2]['_source']['city'];
        $value   = $responses['hits']['hits'][2]['_source']['count'];

        $array[] = array (
            'label' => $label,
            'value' => $value
        );

    }

    echo json_encode($array);
}
*/


/*
$milliseconds = $responses['took'];
$maxScore     = $responses['hits']['max_score'];
$shards       = $responses['_shards']['total'];


$score = $responses['hits']['hits'][0]['_score'];
$doc   = $responses['hits']['hits'][0]['_source']['city'];
$hits  = $responses['hits']['total'];


$label   = $responses['hits']['hits'][0]['_source']['city'];
$value   = $responses['hits']['hits'][0]['_source']['count'];

$array[] = array (
    'label' => $label,
    'value' => $value
);
*/





//$hits  = $responses['hits']['total'];

//if ($hits!=0) {

    /*$label   = $responses['hits']['hits'][0]['_source']['city'];
    $value   = $responses['hits']['hits'][0]['_source']['count'];
    
    $array[] = array (
        'label' => $label,
        'value' => $value
    );*/
    echo json_encode($char);
/*} else {
    echo "Nothing found.";
}*/
