<?php
require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://localhost:8000',
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

echo $response->getBody();