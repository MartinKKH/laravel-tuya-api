<?php

use Givenergy\LaravelTuyaApi\Tests\TestCase;
use Givenergy\LaravelTuyaApi\AuthorizationManagement\GetToken;
use Givenergy\LaravelTuyaApi\Service;

class GetTokenTest  extends TestCase{
    
    public function testSignUrlMatch(){
        $params = ['grant_type' => 1];
        $service = new GetToken($params);
        $signUrl = $service->getSignUrl();
        $this->assertEquals($signUrl, '/v1.0/token?grant_type=1'); 
    }

}