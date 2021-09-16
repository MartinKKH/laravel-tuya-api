<?php

namespace Givenergy\LaravelTuyaApi;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;

class LaravelTuyaApi
{
    private $baseUrl = 'https://openapi.tuyaeu.com';
    private static $accessToken;

    public function __construct(string $clientId, String $secret)
    {
        $this->clientId = $clientId;
        $this->secret = $secret;
    }

    public function call($serviceClass, ...$arguments)
    {
        if (class_exists($serviceClass)) {
            try {
                $service = new $serviceClass(...$arguments);
                $service->setClientId($this->clientId);
                $service->setSecret($this->secret);
                $service->setAccessToken(self::$accessToken);
                $service->setStringToSign();
                $var = $service->__toArray();
                $req = $var;
                extract($var);
                unset($req['url']);
                unset($req['method']);
                $request = Http::withHeaders($req['headers'])->get("https://openapi.tuyaeu.com/v1.0/token?grant_type=1");
                $result = $request->json();
                if ($result['success'] === false) {
                    throw new \Exception($result['msg']);
                }
                if (in_array($serviceClass, [AuthorizationManagement\GetToken::class]) && isset($result['result']['access_token'])) {
                    self::$accessToken = $result['result']['access_token'];
                }
                return $result;
     
            } catch (GuzzleException $e) {
                // Throw exception
                throw new \Exception('Service ' . $serviceClass . ' failed because ' . $e->getMessage());
            }
        }
    }
}
