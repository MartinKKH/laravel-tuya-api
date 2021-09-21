<?php

use Givenergy\LaravelTuyaApi\DeviceControl\DeviceInfo;
use Givenergy\LaravelTuyaApi\Tests\TestCase;

class DeviceInfoTest extends TestCase {
    public function testGetUrl(): void {
        $deviceId = getenv('DEVICE_ID');
        $service = new DeviceInfo($deviceId);
        $this->assertEquals($service->getUrl(), 'https://openapi.tuyaeu.com/v1.0/devices/03001768c4dd573e579a');
    }
}