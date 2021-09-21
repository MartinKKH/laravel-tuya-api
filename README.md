# LaravelTuyaApi

<!-- [![Latest Version on Packagist](https://img.shields.io/packagist/v/givenergy/laravel-tuya-api.svg?style=flat-square)](https://packagist.org/packages/givenergy/laravel-tuya-api)
[![Total Downloads](https://img.shields.io/packagist/dt/givenergy/laravel-tuya-api.svg?style=flat-square)](https://packagist.org/packages/givenergy/laravel-tuya-api) -->
<!-- ![GitHub Actions](https://github.com/givenergy/laravel-tuya-api/actions/workflows/main.yml/badge.svg) -->

Tuya API script using laravel backend, currently only the [Tuya Smart Home APIs](https://developer.tuya.com/en/docs/iot/industrial-general-api?id=Kainbj5886ptz#title-1-Smart%20home%20APIs) is implemented.

## Installation

Add the following to `"repositories"` in composer.json
```
{
  "type": "github",
  "url": "https://github.com/MartinKKH/laravel-tuya-api/"
}
```

then install the package via composer:

```bash
composer require martinkkh/laravel-tuya-api
```

## Usage

This package implements the API listed in the [Tuya Smart Home APIs](https://developer.tuya.com/en/docs/iot/industrial-general-api?id=Kainbj5886ptz#title-1-Smart%20home%20APIs).

You are required to create a [Tuya Cloud account](https://developer.tuya.com/en/docs/iot/quick-start1?id=K95ztz9u9t89n) to obtain the `client_id` and `secret` of your own project.

Example

```php

  /// Initistaion
  $client = new LaravelTuyaApi($clientId, $secret);
   
  /// Generate API Token
  $client->call(GetToken::class,$params);
  
  /// Get Device Info
  $deviceInfo = $client->call(DeviceInfo::class, $deviceId);

```

### Testing

Rename phpunit.xml.dist to phpunit.xml and edit your own configurations.

```
<env name="CLIENT_ID" value={YOUR_OWN_CLIEN_ID}/>
<env name="SECRET" value={YOUR_OWN_SECRET} />
<env name="DEVICE_ID" value={DEVICE_ID} />
```
Run the test in the command line.
```bash
composer test
```

<!-- ### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
 -->
### Security

If you discover any security related issues, please email martin.kong@givenergy.co.uk instead of using the issue tracker.

## Credits

-   [Martin Kong](https://github.com/givenergy)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


## References

- [codetheweb/tuyapi](https://github.com/codetheweb/tuyapi)
- [tuya-connector-nodejs](https://github.com/tuya/tuya-connector-nodejs)
- [dwedaz/tuya-api-wrapper](https://github.com/dwedaz/tuya-api-wrapper)
<!-- 
## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
 -->
