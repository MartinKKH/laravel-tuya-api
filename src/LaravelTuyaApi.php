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


    public function setAccessToken($accessToken)
    {
        self::$accessToken = $accessToken;
    }

    public function call($serviceClass, ...$arguments)
    {
        if (class_exists($serviceClass)) {
            try {
                $service = new $serviceClass(...$arguments);

                /// LaravelTuyaApi Paramerters 
                $service->setClientId($this->clientId);
                $service->setSecret($this->secret);
                $service->setAccessToken(self::$accessToken);

                $service->setStringToSign();
                $url = $service->getUrl();
                $var = $service->__toArray();

                $req = $var;
                extract($var);

                if ($req['method'] ==  'GET') {
                    $request = Http::withHeaders($req['headers'])->get($url, $req['query']);
                }
                if ($req['method'] ==  'POST') {
                    $request = Http::withHeaders($req['headers'])->withBody($req['json'], 'application/json')->post($url);
                }





                $result = $request->json();
                if ($result['success'] === false) {
                    throw new \Exception($result['msg']);
                }

                if (in_array($serviceClass, [AuthorizationManagement\GetToken::class]) && isset($result['result']['access_token'])) {
                    $accessToken = $result['result']['access_token'];
                    self::$accessToken = $accessToken;
                }
                return $result;
            } catch (GuzzleException $e) {
                // Throw exception
                throw new \Exception('Service ' . $serviceClass . ' failed because ' . $e->getMessage());
            }
        }
    }
}
