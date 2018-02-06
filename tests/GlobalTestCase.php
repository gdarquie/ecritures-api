<?php

namespace App\tests;

use Csa\Bundle\GuzzleBundle\GuzzleHttp\History\History;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GlobalTestCase extends KernelTestCase
{
    private static $staticClient;

    /**
     * @var Client
     */
    protected $client;

//    /**
//     * @var History
//     */
//    private static $history;

    public static function setUpBeforeClass()
    {
        self::$staticClient = new Client([
            'base_uri' => 'http://127.0.0.1:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);

        self::bootKernel();
    }

    public function setUp()
    {
        $this->client = self::$staticClient;
//        $this->purgeDatabase();
    }

    public function tearDown()
    {
        //nothing
    }

//    private function purgeDatabase()
//    {
//        $purger = new ORMPurger($this->getService('doctrine')->getManager());
//    }

//    protected function getService($id)
//    {
//        return self::$kernel->getContainer()->get($id);
//    }

//    protected function onNotSuccessfulTest(Exception $e)
//    {
//        if (self::$history && $lastResponse = self::$history->getLastResponse()) {
//            $this->printDebug('');
//            $this->printDebug('<error>Failure!</error> when making the following request:');
//            $this->printLastRequestUrl();
//            $this->printDebug('');
//            $this->debugResponse($lastResponse);
//        }
//        throw $e;
//    }

}