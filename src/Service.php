<?php

namespace Givenergy\LaravelTuyaApi;

use Exception;



abstract class Service
{
    private  $uri = 'https://openapi.tuya%s.com';
    private $region = 'eu';
    protected $method = '';
    protected $path = '';
    protected $params = [];
    // Headers
    protected $headers = [];
    protected $timeStamp = '';
    protected $clientId = '';
    protected $secret = '';
    protected $nouce = '';
    protected $stringToSign ='';

    private $accessToken = '';
    protected $requiredAccessToken = true;

    public function __construct($params)
    {
        
    }

    public final function __toArray()
    {
        $returnValue = [
            'url' => $this->getUrl(),
            'method' => $this->getMethod(),
            'headers' => $this->getHeaders(),
        ];

        if ($this->getMethod() == 'GET') {
            $returnValue['query'] = $this->getParams();
        } else if ($this->getMethod() == 'POST') {
            $returnValue['form_params'] = $this->getParams();
        } else if ($this->getMethod() == 'JSON') {
            $returnValue['json'] = $this->getParams();
            $returnValue['method'] = 'POST';
        }

        return $returnValue;
    }

    protected function getParams()
    {
        return $this->params;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    private function getSign($currentTime)
    {
        if ($this->requiredAccessToken && empty($this->accessToken)) {
            throw new Exception("Access token required");
        }

        if ($this->requiredAccessToken) {
            $string = $this->clientId . $this->accessToken . $currentTime . $this->nouce . $this->stringToSign;
        } else {
            $string = $this->clientId . $currentTime . $this->nouce . $this->stringToSign;
        }

        $sig = hash_hmac('sha256', $string, $this->secret);
        return strtoupper($sig);
    }

    public function getTimeStamp()
    {
        return (string) (time() * 1000);
    }

    protected function getHeaders()
    {
        $currentTime = $this->getTimeStamp();
        $addHeaders = [
            'client_id' => $this->clientId,
            'sign' =>  $this->getSign($currentTime),
            't' => $currentTime,
            'sign_method' => 'HMAC-SHA256',
            'nouce' => $this->nouce,
        ];

        if (!empty($this->accessToken)) {
            
            $addHeaders['access_token'] = $this->accessToken;
        }else{
            /// stringToSign is not required for GetToken
            $addHeaders['stringToSign'] = $this->stringToSign;
        }


        return $addHeaders + $this->headers;
    }

    public function getUrl()
    {
        return $this->getUri() . '/' . $this->getPath();
    }

    protected function getUri()
    {
        return sprintf($this->uri, $this->getRegion());
    }

    protected function getRegion()
    {
        return $this->region;
    }


    protected function getPath()
    {
        return $this->path;
    }
    protected function getMethod()
    {
        return $this->method;
    }

    public final function __toString()
    {
        return json_encode($this->__toArray());
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }


    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    public function getSignUrl()
    {
        $bodystr = '';
        foreach ($this->params as $key => $value) {
            $bodystr = $bodystr . $key . '=' . $value . "&";
        }
        if (empty($bodystr)) {
            return '/' . $this->getPath();
        } else {
            return '/' . $this->getPath() . '?' . substr($bodystr, 0, -1);
        }
    }

    public function setStringToSign()
    {
        $method = $this->method;
        $contentHash = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";
        $signUrl = $this->getSignUrl();


        $this->stringToSign = $method . "\n" . $contentHash . "\n" . "" . "\n" . $signUrl;
    }

}
