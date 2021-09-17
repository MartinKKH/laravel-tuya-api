<?php

use Givenergy\LaravelTuyaApi\AuthorizationManagement\GetToken;
use Givenergy\LaravelTuyaApi\DeviceControl\DeviceInfo;
use Givenergy\LaravelTuyaApi\LaravelTuyaApi;
use Givenergy\LaravelTuyaApi\Tests\TestCase;

class LaravelTuyaApiUnitTest extends TestCase{

    protected function getApiClient(): LaravelTuyaApi
    {
        $clientId = getenv('CLIENT_ID');
        $secret = getenv('SECRET');
        return new LaravelTuyaApi($clientId, $secret);
    }

    public function testClientIdMatch(): void
    {
        $client = $this->getApiClient();
        $this->assertEquals($client->clientId, getenv('CLIENT_ID'));
    }
    public function testSecretMatch(): void
    {
        $client = $this->getApiClient();
        $this->assertEquals($client->secret, getenv('SECRET'));
    }

    /**
     * @depends testClientIdMatch
     * @depends testSecretMatch
     */
    public function testGetToken(): void {
        $params = ['grant_type' => 1];
        $client = $this->getApiClient();
        $result = $client->call(GetToken::class,$params);
        $accessToken = $result["result"]["access_token"];
        $this->assertNotNull($accessToken);
    }
    
    /**
     * @depends testGetToken
     */
    public function testDeviceInfo($client): void {
       
        $deviceId = getenv('DEVICE_ID');
        // $result = $client->call(GetToken::class, ['grant_type' => 1]);
        // $accessToken = $result["result"]["access_token"];

        // $client->setAccessToken($accessToken);
        $client->call(DeviceInfo::class, $deviceId);
        $this->assertTrue(true);

    }
}