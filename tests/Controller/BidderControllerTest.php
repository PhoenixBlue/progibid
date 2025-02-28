<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class BidderControllerTest extends WebTestCase
{
    private function testResult() {
        $resultData = [
            "lux1800" => [
                "type" => "Luxury",
                "basicFee" => 1800,
                "variableCost" => 180.0,
                "sellerFee" => 72.0,
                "addedCost" => 15,
                "storageFee" => 100.0,
                "totalCost" => 2167.0
            ],
            "lux1M" => [
                "type" => "Luxury",
                "basicFee" => 1000000,
                "variableCost" => 200.0,
                "sellerFee" => 40000.0,
                "addedCost" => 20,
                "storageFee" => 100.0,
                "totalCost" => 1040320.0
            ],
            "com398" => [
                "type" => "Common",
                "basicFee" => 398.0,
                "variableCost" => 39.8,
                "sellerFee" => 7.96,
                "addedCost" => 5,
                "storageFee" => 100.0,
                "totalCost" => 550.76
            ],
            "com501" => [
                "type" => "Common",
                "basicFee" => 501.0,
                "variableCost" => 50.0,
                "sellerFee" => 10.02,
                "addedCost" => 10,
                "storageFee" => 100.0,
                "totalCost" => 671.02
            ],
            "Com57" => [
                "type" => "Common",
                "basicFee" => 57.0,
                "variableCost" => 10.0,
                "sellerFee" => 1.14,
                "addedCost" => 5,
                "storageFee" => 100.0,
                "totalCost" => 173.14
            ],
            "Com1100" => [
                "type" => "Common",
                "basicFee" => 1100,
                "variableCost" => 50.0,
                "sellerFee" => 22.0,
                "addedCost" => 15,
                "storageFee" => 100.0,
                "totalCost" => 1287.0
            ]
        ];

        return $resultData;
    } 

    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
    }

    public function testApiLux1800(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/bidder/Luxury/1800');
        self::assertResponseIsSuccessful();
        $resarray = (array)json_decode($client->getResponse()->getContent());
        self::assertEquals($this->testResult()['lux1800'], $resarray);
    }

    public function testApiLux1M(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/bidder/Luxury/1000000');
        self::assertResponseIsSuccessful();
        $resarray = (array)json_decode($client->getResponse()->getContent());
        self::assertEquals($this->testResult()['lux1M'], $resarray);
    }

    public function testApiCom398(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/bidder/Common/398');
        self::assertResponseIsSuccessful();
        $resarray = (array)json_decode($client->getResponse()->getContent());
        self::assertEquals($this->testResult()['com398'], $resarray);
    }

    public function testApiCom501(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/bidder/Common/501');
        self::assertResponseIsSuccessful();
        $resarray = (array)json_decode($client->getResponse()->getContent());
        self::assertEquals($this->testResult()['com501'], $resarray);
    }

    public function testApiCom57(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/bidder/Common/57');
        self::assertResponseIsSuccessful();
        $resarray = (array)json_decode($client->getResponse()->getContent());
        self::assertEquals($this->testResult()['Com57'], $resarray);
    }

    public function testApiCom1100(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/bidder/Common/1100');
        self::assertResponseIsSuccessful();
        $resarray = (array)json_decode($client->getResponse()->getContent());
        self::assertEquals($this->testResult()['Com1100'], $resarray);
    }
}
