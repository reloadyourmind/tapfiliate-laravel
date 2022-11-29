<?php
namespace Tapfiliate\Laravel;

use Psr\Log\NullLogger;
use Tapfiliate\Api\ApiClient;
use Tapfiliate\Handlers\ClicksHandler;
use Tapfiliate\Handlers\ConversionsHandler;
use Tapfiliate\Handlers\CustomersHandler;
use Tapfiliate\Helpers\ModelFiller;
use Illuminate\Support\ServiceProvider;
use Config;

class TapfiliateServiceProvider extends ServiceProvider
{
    const VERSION = '1.0.0';

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tapfiliate_config.php' => config_path('tapfiliate.php')
        ]);
    }

    public function register()
    {
        $this->bindModelHelper();
        $this->bindApiClient();
        $this->bindClicksHandler();
        $this->bindCustomersHandler();
        $this->bindConversionsHandler();
    }

    protected function bindModelHelper()
    {
        $this->app->bind('ModelHelper', function () {
            return new ModelFiller();
        });
    }

    protected function bindApiClient()
    {
        $this->app->bind('TapfiliateClient', function (){
            return new ApiClient(
                new NullLogger(Config::get('tapfiliate.logger_level')),
                Config::get('tapfiliate.api_key'),
                Config::get('tapfiliate.host')
            );
        });
    }

    protected function bindClicksHandler()
    {
        $this->app->bind('ClicksHandler', function () {
            return new ClicksHandler(
                $this->app->make('TapfiliateClient'),
                $this->app->make('ModelHelper'),
            );
        });
    }

    protected function bindCustomersHandler()
    {
        $this->app->bind('CustomerHandler', function () {
            return new CustomersHandler(
                $this->app->make('TapfiliateClient'),
                $this->app->make('ModelHelper'),
            );
        });
    }

    protected function bindConversionsHandler()
    {
        $this->app->bind('ConversionHandler', function () {
            return new ConversionsHandler(
                $this->app->make('TapfiliateClient'),
                $this->app->make('ModelHelper'),
            );
        });
    }
}
