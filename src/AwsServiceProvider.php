<?php namespace Aws\Laravel;

use Aws\Sdk;
use Illuminate\Support\ServiceProvider;

/**
 * AWS SDK for PHP service provider for Laravel applications
 */
class AwsServiceProvider extends ServiceProvider
{
    const VERSION = '3.1.0';
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap the configuration
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__ . '/../config/aws.php');

        //加载项目中aws配置
        $this->app->configure('aws');

        $this->mergeConfigFrom($source, 'aws');

        $awsConfig = $this->app->make('config')->get('aws');
        
        if (empty($awsConfig['credentials']['key']) || empty($awsConfig['credentials']['secret'])) {
            unset($awsConfig['credentials']);
        }

        if (empty($awsConfig['endpoint'])) {
            unset($awsConfig['endpoint']);
        }
        
        $this->app->singleton('aws', function ($awsConfig) {
            return new Sdk($awsConfig);
        });

        $this->app->alias('aws', 'Aws\Sdk');
    }
}
