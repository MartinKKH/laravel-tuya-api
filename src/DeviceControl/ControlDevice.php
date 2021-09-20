<?php

namespace Givenergy\LaravelTuyaApi\DeviceControl;

use Givenergy\LaravelTuyaApi\Service;

//Get the access token
class ControlDevice extends Service
{
    protected $method = 'JSON';
    protected $path = 'v1.0/devices/%s/commands';
    private $deviceId = '';

    public function __construct($params)
    {
        $this->deviceId = $params[0];
        $this->params = $params[1];
        parent::__construct($params);
    }

    public function getUrl()
    {
        return sprintf(parent::getUrl(), $this->deviceId);
    }

    public function getParams()
    {
        return  json_encode(parent::getParams(), JSON_PRETTY_PRINT);
    }

    protected function getHeaders()
    {
        /// Commented as the following header is not mandatory
        // $addHeaders = ['Content-Type' => 'application/json'];
        return parent::getHeaders();
    }

    protected function getPath()
    {

        return sprintf($this->path, $this->deviceId);
    }

    public function getSignUrl()
    {
        return '/' . $this->getPath();
    }
}
