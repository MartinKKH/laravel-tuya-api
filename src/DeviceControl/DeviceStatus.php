<?php

namespace Givenergy\LaravelTuyaApi\DeviceControl;

use Givenergy\LaravelTuyaApi\Service;

class DeviceStatus extends Service
{
    protected $method = 'GET';
    protected $path = 'v1.0/devices/%s/status';
    private $deviceId = '';

    public function __construct($params)
    {
        $this->deviceId = $params;
        parent::__construct($params);
    }

    public function getUrl()
    {
        return sprintf(parent::getUrl(), $this->deviceId);
    }

    public function getParams()
    {
        return [];
    }

    protected function getPath()
    {
        return sprintf($this->path, $this->deviceId);
    }
}
