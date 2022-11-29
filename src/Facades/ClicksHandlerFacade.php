<?php
namespace Tapfiliate\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class ClicksHandlerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ClicksHandler';
    }
}
