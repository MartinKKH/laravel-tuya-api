<?php

use Givenergy\LaravelTuyaApi\AuthorizationManagement\GetToken;
use Givenergy\LaravelTuyaApi\DeviceControl\ControlDevice;
use Givenergy\LaravelTuyaApi\DeviceControl\DeviceFunction;
use Givenergy\LaravelTuyaApi\DeviceControl\DeviceInfo;
use Givenergy\LaravelTuyaApi\DeviceControl\DeviceStatus;
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

 
    public function testGetToken(): LaravelTuyaApi {
        $params = ['grant_type' => 1];
        $client = $this->getApiClient();
        $result = $client->call(GetToken::class,$params);
        $accessToken = $result["result"]["access_token"];
        $this->assertNotNull($accessToken);
        return $client;
    }
    
    /**
     * @depends testGetToken
     */
    public function testDeviceInfo($client): void {
        $deviceId = getenv('DEVICE_ID');
        $result = $client->call(DeviceInfo::class, $deviceId);
        $this->assertNotNull($result);
        $this->assertTrue($result['success']);

    }

    /**
     * @depends testGetToken
     */
    public function testDeviceFunction($client): void
    {
        $deviceId = getenv('DEVICE_ID');
        $result = $client->call(DeviceFunction::class, $deviceId);
        $this->assertNotNull($result);
        $this->assertTrue($result['success']);
    }

    /**
     * @depends testGetToken
     */
    public function testDeviceStatus($client): void
    {
        $deviceId = getenv('DEVICE_ID');
        $result = $client->call(DeviceStatus::class, $deviceId);
        $this->assertNotNull($result);
        $this->assertTrue($result['success']);
    }

    /**
     * @depends testGetToken
     */
    public function testControlDevice($client): void

        
    {
        $deviceId = getenv('DEVICE_ID');
        $result = $client->call(ControlDevice::class, [$deviceId, ['commands' => [['code' => 'switch_1', 'value' => true]]]]);
        $this->assertNotNull($result);
        $this->assertTrue($result['success']);
    }
}