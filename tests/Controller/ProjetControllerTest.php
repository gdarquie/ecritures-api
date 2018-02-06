<?php

namespace App\tests\Controller;

use App\Tests\GlobalTestCase;

class ProjetControllerTest extends GlobalTestCase
{
    public function testPOST()
    {

        $data = array(
            'titre' => "Test guzzle",
            'description' => 'Projet de test'
        );

        $response = $this->client->post('/projet', [
            'body' => json_encode($data)
        ]);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));
        $finishedData = json_decode($response->getBody(true), true);
        $this->assertEquals('Test guzzle', $data['titre']);

//        dump($response);die;
//        $this->assertArrayHasKey('titre', $finishedData);
//
//        echo "\n\n";
//        echo $response->getReasonPhrase().', '.$response->getStatusCode().', body-content : '.$response->getBody();
//        echo "\n\n";
    }
}