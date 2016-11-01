# AWS Service Provider for Lumen 5

This is a simple [Lumen](http://lumen.laravel.com/) service provider for making it easy to include the official
[AWS SDK for PHP](https://github.com/aws/aws-sdk-php) in your Lumen applications.

This README is for version 1.x of the service provider, which is implemented to work with Version 3 of the AWS SDK for
PHP and Lumen 5.X.

## Installation

The AWS Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`icyboy/lumen-aws-sdk` package in your project's `composer.json`.

```json
{
    "require": {
        "icyboy/lumen-aws-sdk": "^1.0"
    }
}
```

Then run a composer update
```sh
php composer.phar update
```

To use the AWS Service Provider, you must register the provider when bootstrapping your Lumen application.

Find the `providers` key in your `bootstarp/app.php` and register the AWS Service Provider.

```php
    $app->register(Icyboy\LumenAws\AwsServiceProvider::class);
    
    class_alias('Icyboy\LumenAws\AwsFacade', 'Aws');
```


## Configuration

By default, the package uses the following environment variables to auto-configure the plugin without modification:
```
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
AWS_REGION (default = us-east-1)
```

To customize the configuration file, publish the package configuration using Artisan.

```sh
php artisan vendor:publish
```

Update your settings in the generated `config/aws.php` configuration file.

```php
return [
    'credentials' => [
        'key'    => 'YOUR_AWS_ACCESS_KEY_ID',
        'secret' => 'YOUR_AWS_SECRET_ACCESS_KEY',
    ],
    'region' => 'us-west-2',
    'version' => 'latest',
    
    // You can override settings for specific services
    'Ses' => [
        'region' => 'us-east-1',
    ],
    
    // if you use fake s3, you must used endpoint
    'endpoint' => "http://xxxx",
];
```

## Usage

```php
$s3 = App::make('aws')->createClient('s3');
$s3->putObject(array(
    'Bucket'     => 'YOUR_BUCKET',
    'Key'        => 'YOUR_OBJECT_KEY',
    'SourceFile' => '/the/path/to/the/file/you/are/uploading.ext',
));
```

If the AWS facade is registered within the `aliases` section of the application configuration, you can also use the
following technique.

```php
$s3 = Aws::createClient('s3');
$s3->putObject(array(
    'Bucket'     => 'YOUR_BUCKET',
    'Key'        => 'YOUR_OBJECT_KEY',
    'SourceFile' => '/the/path/to/the/file/you/are/uploading.ext',
));
```

## Links

* [AWS SDK for PHP on Github](http://github.com/aws/aws-sdk-php/)
* [AWS SDK for PHP website](http://aws.amazon.com/sdkforphp/)
* [AWS on Packagist](https://packagist.org/packages/aws/)
* [License](http://aws.amazon.com/apache2.0/)
* [Lumen website](http://lumen.laravel.com/)
