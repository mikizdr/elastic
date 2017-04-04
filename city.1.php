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
$params1 = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id',
    'body' => ['testField' => 'The quick brown fox jump over a lazy dog.']
];


/*
    get the document with _id 'my_id' GET
*/    
$params2 = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id'
];

/*
    search for a document SEARCH
*/
$params3 = [
    'index' => 'my_index',
    'type' => 'my_type',
    'body' => [
        'query' => [
            'match' => [
                'testField' => 'abc'
            ]
        ]
    ]
];

/*
    delete a document DELETE
*/
$params4 = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id'
];

//$response = $client->get($params2);
//print_r($response);

/*
    delete an index
*/
$deleteParams = [
    'index' => 'library'
];
//$response = $client->indices()->delete($deleteParams);
//print_r($response);


$params5 = [
    'index' => 'my_index',
    'body' => [
        'settings' => [
            'number_of_shards' => 2,
            'number_of_replicas' => 0
        ]
    ]
];

//$response = $client->indices()->create($params5);
//print_r($response);

for($i = 0; $i < 100; $i++) {
    $params6['body'][] = [
        'index' => [
            '_index' => 'my_index',
            '_type' => 'my_type',
        ]
    ];

    $params6['body'][] = [
        'my_field' => 'my_value',
        'second_field' => 'some more values'
    ];
}

/*
    Search Operations
*/

$char = $_GET['c'];

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

$count = [
    'body' => [
        'query' => [
            'match_phrase_prefix' => [
                'city' => $char
            ]
        ]
    ]
];  

$num = $client->count($count);

if ($num['count']!=0) {

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



$milliseconds = $responses['took'];
$maxScore     = $responses['hits']['max_score'];
$shards       = $responses['_shards']['total'];


if(!$shards) {

$score = $responses['hits']['hits'][0]['_score'];
$doc   = $responses['hits']['hits'][0]['_source']['city'];
$hits  = $responses['hits']['total'];

for ($i=0;$i<10;$i++) {
$label   = $responses['hits']['hits'][$i]['_source']['city'];
$value   = $responses['hits']['hits'][$i]['_source']['count'];

$array[] = array (
    'label' => $label,
    'value' => $value
);
}
echo json_encode($array);

}