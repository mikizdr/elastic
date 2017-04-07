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

$char = $_GET['c'];

# body for API
$city = [
    'index' => 'city_data',
    'type' => 'city',
    'body' => [
        'query' => [
            'match_phrase' => [
                'city-suggest' => $char         
            ]
        ],
        'sort' => [
            'count' => [
                'order' => 'desc'
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

$response = $client->search($city);

$total = $response['hits']['total'];
$city_suggest = $response['hits']['hits'][0]['_source']['city-suggest'];
$city_suggest_arr_length = count($city_suggest);

$hits_arr_length = count($response['hits']['hits']);


$_index = $response['hits']['hits'][0]['_index'];
$_type = $response['hits']['hits'][0]['_type'];
$_id = $response['hits']['hits'][0]['_id'];
$_score = $response['hits']['hits'][0]['_score'];
$_path = $response['hits']['hits'][0]['_source']['path'];
$timestamp = $response['hits']['hits'][0]['_source']['@timestamp'];
$source_city = $response['hits']['hits'][0]['_source']['city'];
$city_suggest = $response['hits']['hits'][0]['_source']['city-suggest'][0]; /* arr */
$version = $response['hits']['hits'][0]['_source']['@version'];
$host = $response['hits']['hits'][0]['_source']['host'];
$count = $response['hits']['hits'][0]['_source']['count'];
$message = $response['hits']['hits'][0]['_source']['message'];
$type = $response['hits']['hits'][0]['_source']['type'];
$sort = $response['hits']['hits'][0]['sort'][0]; /* arr */



echo 'Array lengt of _source: '.count($response['hits']['hits'][0]['_source']).'<br>';
    echo '*********************************************<br>';
    echo '*********************************************<br>';

for ($i = 0; $i < $city_suggest_arr_length; $i++) {

    echo '<span style="color: red;">SUGGESTIONS:</span> '.$response['hits']['hits'][0]['_source']['city-suggest'][$i].',<br>';

}
    echo '*********************************************<br>';
    echo '*********************************************<br>';



$city_name = $response['hits']['hits'][0]['_source']['city'];


echo '=================================================================<br>';
echo '_index: '.$_index.'<br><br>';
echo '_type: '.$_type.'<br><br>';
echo '_id: '.$_id.'<br><br>';
echo '_score: '.$_score.'<br><br>';
echo '_path: '.$_path.'<br><br>';
echo '@timestamp: '.$timestamp.'<br><br>';
echo 'city: '.$source_city.'<br><br>';
echo 'city-suggest: '.$city_suggest.'<br><br>';
echo '@version'.$version.'<br><br>';
echo 'host: '.$host.'<br><br>';
echo 'count: '.$count.'<br><br>';
echo 'message: '.$message.'<br><br>';
echo 'type: '.$type.'<br><br>';
echo 'sort: '.$sort.'<br><br>';
echo '=================================================================<br>';

echo '<h1>Total: '.$total.'</h1>';
echo '<h2>Message: '.$message.'</h2>';
echo '<h3>Length of hits arr: '.$hits_arr_length.'</h4>';
echo '<h3>city-suggest: '.$city_suggest_arr_length.'</h3>';
echo '<h1 style="color: red;">City name: '.$city_name.'</h1>';
echo '<h1 style="color: red;">City suggest: '.$city_suggest.'</h1>';


$json_data = json_encode($response, JSON_PRETTY_PRINT);

echo $json_data;



