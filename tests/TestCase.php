<?php 

namespace Givenergy\LaravelTuyaApi\Tests;

use Givenergy\LaravelTuyaApi\LaravelTuyaApiServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelTuyaApiServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
