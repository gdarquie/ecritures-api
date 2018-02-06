<?php
require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://127.0.0.1:8000',
    'defaults' => [
        'exceptions' => false
    ]
]);


$data = array(
    'titre' => "Test guzzle",
    'description' => 'Projet de test'
);

$response = $client->post('/projet', [
    'body' => json_encode($data)
]);

echo "\n\n";
echo $response->getReasonPhrase().', '.$response->getStatusCode().', body-content : '.$response->getBody();
echo "\n\n";