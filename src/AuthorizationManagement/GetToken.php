<?php
namespace Givenergy\LaravelTuyaApi\AuthorizationManagement;

use Givenergy\LaravelTuyaApi\Service;

class GetToken extends Service{
    protected $method = 'GET';
    protected $path = 'v1.0/token';
    protected $requiredAccessToken = false;
}