<?php

use Givenergy\LaravelTuyaApi\AuthorizationManagement\GetToken;
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

    public function testCall(): void {
        $client = $this->getApiClient();
        $accessToken = $client->call(GetToken::class, ['grant_type' => 1]);

     
        $this->assertNotNull($accessToken);
    }
}